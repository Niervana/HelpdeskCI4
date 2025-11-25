<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\InventoryModel;
use App\Models\KaryawanModel;
use App\Models\NotificationModel;
use App\Models\UsersModel;

class Tiket extends BaseController
{
    protected $TiketModel;
    protected $InventoryModel;
    protected $KaryawanModel;
    protected $NotificationModel;
    protected $UsersModel;

    public function __construct()
    {
        $this->TiketModel = new TiketModel();
        $this->InventoryModel = new InventoryModel();
        $this->KaryawanModel = new KaryawanModel();
        $this->NotificationModel = new NotificationModel();
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        $user = userLogin();
        if ($user && $user->role == 1) {
            // Admin view - existing logic
            $filter = $this->request->getGet('filter') ?? 'all';
            $jenisFilter = $this->request->getGet('jenis') ?? 'all';
            $startDate = $this->request->getGet('start_date');
            $endDate = $this->request->getGet('end_date');

            // Hitung tanggal berdasarkan filter
            $dateCondition = $this->getDateCondition($filter, $startDate, $endDate);

            // Ambil data tiket dengan join ke tabel karyawan
            $query = $this->TiketModel
                ->select('tiket.*, nama_karyawan, departemen_karyawan')
                ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
                ->where($dateCondition);

            // Tambahkan filter jenis tiket jika bukan 'all'
            if ($jenisFilter !== 'all') {
                $query->where('tiket.jenis_tiket', $jenisFilter);
            }

            $tiket = $query->orderBy('tiket.create_date', 'DESC')->findAll();

            // Ambil semua data karyawan untuk datalist
            $karyawanList = $this->InventoryModel->findAll();

            // Daftar jenis tiket untuk filter
            $jenisTiketList = [
                'all' => 'Semua Jenis',
                'Software Trouble' => 'Software Trouble',
                'Hardware Trouble' => 'Hardware Trouble',
                'Phone Trouble' => 'Phone Trouble',
                'Password Trouble' => 'Password Trouble',
                'Network Trouble' => 'Network Trouble'
            ];

            $data = [
                'tiket' => $tiket,
                'karyawanList' => $karyawanList,
                'totalTicket' => count($tiket),
                'currentFilter' => $filter,
                'currentJenisFilter' => $jenisFilter,
                'jenisTiketList' => $jenisTiketList,
                'is_admin' => true
            ];
            return view('ticketing/v_ticketing', $data);
        } elseif ($user && $user->role == 2) {
            // User view - simplified
            // Hitung jumlah antrian (tiket yang belum solved)
            $unsolvedCount = $this->TiketModel->where('status', 'ongoing')->countAllResults();

            $data = [
                'unsolved_count' => $unsolvedCount,
                'is_admin' => false
            ];
            return view('ticketing/v_user_ticketing', $data);
        } else {
            return redirect()->to(site_url('auth/login'));
        }
    }

    private function getDateCondition($filter, $startDate = null, $endDate = null)
    {
        switch ($filter) {
            case 'today':
                return "DATE(tiket.create_date) = CURDATE()";
            case 'week':
                return "YEARWEEK(tiket.create_date, 1) = YEARWEEK(CURDATE(), 1)";
            case 'month':
                return "YEAR(tiket.create_date) = YEAR(CURDATE()) AND MONTH(tiket.create_date) = MONTH(CURDATE())";
            case 'custom':
                if ($startDate && $endDate) {
                    return "DATE(tiket.create_date) BETWEEN '$startDate' AND '$endDate'";
                }
                return "DATE(tiket.create_date) = CURDATE()";
            case 'all':
                return "1=1";
            default:
                return "DATE(tiket.create_date) = CURDATE()";
        }
    }

    public function store()
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $validation = \Config\Services::validation();

        if ($user->role == 1) {
            // Admin: validate nama karyawan
            $validation->setRules([
                'nama' => 'required',
                'jenis_tiket' => 'required|min_length[5]',
                'desk_tiket' => 'required|min_length[10]'
            ]);
        } else {
            // User: no nama field, use user data
            $validation->setRules([
                'jenis_tiket' => 'required|min_length[5]',
                'desk_tiket' => 'required|min_length[10]'
            ]);
        }

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode(', ', $validation->getErrors()));
        }

        if ($user->role == 1) {
            // Admin: get karyawan by name
            $karyawan = $this->KaryawanModel->where('nama_karyawan', $this->request->getPost('nama'))->first();
            if (!$karyawan) {
                return redirect()->back()->withInput()->with('error', 'Nama karyawan tidak ditemukan dalam database');
            }
            $karyawanId = $karyawan['karyawan_id'];
        } else {
            // User: get karyawan by user name
            $karyawan = $this->KaryawanModel->where('nama_karyawan', $user->nama_users)->first();
            if (!$karyawan) {
                return redirect()->back()->withInput()->with('error', 'Data karyawan tidak ditemukan untuk user ini');
            }
            $karyawanId = $karyawan['karyawan_id'];
        }

        // Data untuk insert
        $data = [
            'karyawan_id' => $karyawanId,
            'jenis_tiket' => $this->request->getPost('jenis_tiket'),
            'desk_tiket' => $this->request->getPost('desk_tiket'),
            'create_date' => date('Y-m-d H:i:s'),
            'status' => 'ongoing'
        ];

        $tiketId = $this->TiketModel->insert($data);

        // Trigger admin notification
        $this->triggerAdminNotification($tiketId, $data);

        return redirect()->to('/tiket')->with('success', 'Tiket berhasil ditambahkan');
    }

    public function detail($id)
    {
        // Ambil detail tiket dengan join
        $ticket = $this->TiketModel
            ->select('tiket.*, nama_karyawan, departemen_karyawan')
            ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
            ->where('tiket.tiket_id', $id)
            ->first();

        if (!$ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tiket tidak ditemukan');
        }

        return view('ticketing/v_detail_tiket', ['ticket' => $ticket]);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        // Validate status
        if (!in_array($status, ['ongoing', 'solved'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid status value'
            ]);
        }

        // Check if ticket exists
        $ticket = $this->TiketModel->find($id);
        if (!$ticket) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ticket not found'
            ]);
        }

        // Update the status
        $result = $this->TiketModel->update($id, ['status' => $status]);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update status'
            ]);
        }
    }

    private function triggerAdminNotification($tiketId, $tiketData)
    {
        $user = userLogin();
        if (!$user) {
            return;
        }

        // Get user info
        $userInfo = $this->UsersModel->find($user->id_users);

        // Only create notification for tickets that are not solved
        if ($tiketData['status'] !== 'solved') {
            // Check if notification already exists for this ticket
            $existingNotification = $this->NotificationModel
                ->where('type', 'new_ticket')
                ->where('data LIKE', '%"ticket_id":' . $tiketId . '%')
                ->first();

            if (!$existingNotification) {
                // Prepare notification data
                $notificationData = [
                    'type' => 'new_ticket',
                    'title' => 'Tiket Baru: ' . $tiketData['jenis_tiket'],
                    'message' => 'Tiket baru dari ' . ($userInfo['nama_users'] ?? 'Unknown'),
                    'data' => json_encode([
                        'ticket_id' => $tiketId,
                        'jenis_tiket' => $tiketData['jenis_tiket'],
                        'user_name' => $userInfo['nama_users'] ?? 'Unknown',
                        'desk_tiket' => substr($tiketData['desk_tiket'], 0, 100) . (strlen($tiketData['desk_tiket']) > 100 ? '...' : ''),
                        'create_date' => $tiketData['create_date'],
                        'status' => $tiketData['status']
                    ]),
                    'is_read' => 0
                ];

                // Insert notification
                $this->NotificationModel->insert($notificationData);
            }
        }
    }

    public function getNotifications()
    {
        $lastId = $this->request->getGet('lastId') ?? 0;

        // Get notifications that are unread and belong to tickets that are still ongoing
        $notifications = $this->NotificationModel
            ->select('notifications.*, tiket.status as ticket_status')
            ->join('tiket', 'JSON_EXTRACT(notifications.data, "$.ticket_id") = tiket.tiket_id', 'left')
            ->where('notifications.id >', $lastId)
            ->where('notifications.is_read', 0)
            ->where('tiket.status', 'ongoing') // Only show notifications for ongoing tickets
            ->orderBy('notifications.created_at', 'DESC')
            ->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'notifications' => $notifications,
            'count' => count($notifications)
        ]);
    }

    public function markNotificationsRead()
    {
        $ids = $this->request->getJSON(true)['ids'] ?? [];

        if (empty($ids)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No notification IDs provided'
            ]);
        }

        $result = $this->NotificationModel->markAsRead($ids);

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Notifikasi ditandai sudah dibaca'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menandai notifikasi'
            ]);
        }
    }

    public function bulkUpdateStatus()
    {
        $ids = $this->request->getPost('ids');
        $status = $this->request->getPost('status');

        // Validate inputs
        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No ticket IDs provided'
            ]);
        }

        if (!in_array($status, ['ongoing', 'solved'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid status value'
            ]);
        }

        $successCount = 0;
        $errors = [];

        foreach ($ids as $id) {
            // Check if ticket exists and is not already solved
            $ticket = $this->TiketModel->find($id);
            if (!$ticket) {
                $errors[] = "Ticket ID {$id} not found";
                continue;
            }

            if ($ticket['status'] == 'solved') {
                $errors[] = "Ticket ID {$id} is already solved";
                continue;
            }

            // Update the status
            $result = $this->TiketModel->update($id, ['status' => $status]);
            if ($result) {
                $successCount++;
            } else {
                $errors[] = "Failed to update ticket ID {$id}";
            }
        }

        if ($successCount > 0) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "{$successCount} ticket(s) updated successfully" . (!empty($errors) ? ". Some errors occurred." : ""),
                'updated_count' => $successCount,
                'errors' => $errors
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No tickets were updated',
                'errors' => $errors
            ]);
        }
    }



    public function getKaryawan()
    {
        $term = $this->request->getGet('term');
        $karyawan = $this->KaryawanModel
            ->like('nama_karyawan', $term)
            ->findAll();

        return $this->response->setJSON($karyawan);
    }

    public function getFilteredData()
    {
        $filter = $this->request->getGet('filter') ?? 'all';
        $jenisFilter = $this->request->getGet('jenis') ?? 'all';
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Hitung tanggal berdasarkan filter
        $dateCondition = $this->getDateCondition($filter, $startDate, $endDate);

        // Ambil data tiket dengan join ke tabel karyawan
        $query = $this->TiketModel
            ->select('tiket.*, nama_karyawan, departemen_karyawan')
            ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
            ->where($dateCondition);

        // Tambahkan filter jenis tiket jika bukan 'all'
        if ($jenisFilter !== 'all') {
            $query->where('tiket.jenis_tiket', $jenisFilter);
        }

        $tiket = $query->orderBy('tiket.create_date', 'DESC')->findAll();

        // Return data sebagai JSON
        return $this->response->setJSON([
            'tiket' => $tiket,
            'totalTicket' => count($tiket),
            'currentFilter' => $filter,
            'currentJenisFilter' => $jenisFilter
        ]);
    }

    public function print()
    {
        $filter = $this->request->getGet('filter') ?? 'all';
        $jenisFilter = $this->request->getGet('jenis') ?? 'all';
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Hitung tanggal berdasarkan filter
        $dateCondition = $this->getDateCondition($filter, $startDate, $endDate);

        // Ambil data tiket dengan join ke tabel karyawan
        $query = $this->TiketModel
            ->select('tiket.*, nama_karyawan, departemen_karyawan')
            ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
            ->where($dateCondition);

        // Tambahkan filter jenis tiket jika bukan 'all'
        if ($jenisFilter !== 'all') {
            $query->where('tiket.jenis_tiket', $jenisFilter);
        }

        $tiket = $query->orderBy('tiket.create_date', 'DESC')->findAll();

        if (empty($tiket)) {
            return redirect()->to(site_url('tiket'))->with('error', 'Tidak ada data untuk dicetak');
        }

        $data['tiket'] = $tiket;
        $data['filter'] = $filter;
        $data['jenisFilter'] = $jenisFilter;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        // Load dompdf
        $dompdf = new \Dompdf\Dompdf();
        $html = view('ticketing/v_print_tiket', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Generate filename
        $filename = 'data_tiket_';
        if ($filter === 'custom' && $startDate && $endDate) {
            $filename .= date('Ymd', strtotime($startDate)) . '_' . date('Ymd', strtotime($endDate));
        } else {
            $filename .= $filter;
        }
        $filename .= '_' . $jenisFilter . '.pdf';

        $dompdf->stream($filename, array('Attachment' => 0));
    }

    public function excel()
    {
        $filter = $this->request->getGet('filter') ?? 'today';
        $jenisFilter = $this->request->getGet('jenis') ?? 'all';
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Hitung tanggal berdasarkan filter
        $dateCondition = $this->getDateCondition($filter, $startDate, $endDate);

        // Ambil data tiket dengan join ke tabel karyawan
        $query = $this->TiketModel
            ->select('tiket.*, nama_karyawan, departemen_karyawan')
            ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
            ->where($dateCondition);

        // Tambahkan filter jenis tiket jika bukan 'all'
        if ($jenisFilter !== 'all') {
            $query->where('tiket.jenis_tiket', $jenisFilter);
        }

        $tiket = $query->orderBy('tiket.create_date', 'DESC')->findAll();

        if (empty($tiket)) {
            return redirect()->to(site_url('tiket'))->with('error', 'Tidak ada data untuk diekspor');
        }

        // Generate filename
        $filename = 'data_tiket_';
        if ($filter === 'custom' && $startDate && $endDate) {
            $filename .= date('Ymd', strtotime($startDate)) . '_' . date('Ymd', strtotime($endDate));
        } else {
            $filename .= $filter;
        }
        $filename .= '_' . $jenisFilter . '.csv';

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Write CSV header
        fputcsv($output, ['Date', 'Nama Karyawan', 'Departemen', 'Jenis Tiket', 'Deskripsi', 'Status']);

        // Write data rows
        foreach ($tiket as $item) {
            fputcsv($output, [
                date('d/m/Y H:i', strtotime($item['create_date'])),
                $item['nama_karyawan'],
                $item['departemen_karyawan'],
                $item['jenis_tiket'],
                $item['desk_tiket'],
                $item['status']
            ]);
        }

        fclose($output);
        exit;
    }
}
