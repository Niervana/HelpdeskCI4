<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\InventoryModel;
use App\Models\KaryawanModel; // Tambahkan ini

class Tiket extends BaseController
{
    protected $TiketModel;
    protected $InventoryModel;
    protected $KaryawanModel; // Deklarasikan properti ini

    public function __construct()
    {
        $this->TiketModel = new TiketModel();
        $this->InventoryModel = new InventoryModel();
        $this->KaryawanModel = new KaryawanModel(); // Inisialisasi KaryawanModel
    }

    public function index()
    {
        $filter = $this->request->getGet('filter') ?? 'today'; // today, week, month

        // Hitung tanggal berdasarkan filter
        $dateCondition = $this->getDateCondition($filter);

        // Ambil data tiket dengan join ke tabel karyawan
        $tiket = $this->TiketModel
            ->select('tiket.*, nama_karyawan, departemen_karyawan')
            ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
            ->where($dateCondition)
            ->orderBy('tiket.create_date', 'DESC')
            ->findAll();

        // Ambil semua data karyawan untuk datalist
        $karyawanList = $this->InventoryModel->findAll();

        $data = [
            'tiket' => $tiket,
            'karyawanList' => $karyawanList,
            'totalTicket' => count($tiket),
            'currentFilter' => $filter,
        ];
        return view('ticketing/v_ticketing', $data);
    }

    private function getDateCondition($filter)
    {
        switch ($filter) {
            case 'today':
                return "DATE(tiket.create_date) = CURDATE()";
            case 'week':
                return "YEARWEEK(tiket.create_date, 1) = YEARWEEK(CURDATE(), 1)";
            case 'month':
                return "YEAR(tiket.create_date) = YEAR(CURDATE()) AND MONTH(tiket.create_date) = MONTH(CURDATE())";
            case 'all':
                return "1=1";
            default:
                return "DATE(tiket.create_date) = CURDATE()";
        }
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required',
            'jenis_tiket' => 'required|min_length[5]',
            'desk_tiket' => 'required|min_length[10]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data karyawan berdasarkan nama
        $karyawan = $this->KaryawanModel->where('nama_karyawan', $this->request->getPost('nama_karyawan'))->first();

        if (!$karyawan) {
            return redirect()->back()->withInput()->with('error', 'Nama karyawan tidak ditemukan dalam database');
        }

        // Data untuk insert
        $data = [
            'karyawan_id' => $karyawan['karyawan_id'],
            'jenis_tiket' => $this->request->getPost('jenis_tiket'),
            'desk_tiket' => $this->request->getPost('desk_tiket'),
            'create_date' => date('Y-m-d H:i:s'), // Otomatis tanggal & waktu saat input
            'status' => 'ongoing' // Default status ongoing
        ];

        $this->TiketModel->insert($data);

        return redirect()->to('/ticket')->with('success', 'Tiket berhasil ditambahkan');
    }

    // public function detail($id)
    // {
    //     // Ambil detail tiket dengan join
    //     $ticket = $this->TiketModel
    //         ->select('tiket.*, karyawan.nama, karyawan.departemen, users.username')
    //         ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
    //         ->join('users', 'users.user_id = tiket.user_id')
    //         ->where('tiket.tiket_id', $id)
    //         ->first();

    //     if (!$ticket) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tiket tidak ditemukan');
    //     }

    //     return view('ticket/detail', ['ticket' => $ticket]);
    // }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        if (in_array($status, ['ongoing', 'solved'])) {
            $this->TiketModel->update($id, ['status' => $status]);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }

    // API untuk autocomplete nama karyawan (opsional, jika ingin menggunakan AJAX)
    public function getKaryawan()
    {
        $term = $this->request->getGet('term');
        $karyawan = $this->KaryawanModel
            ->like('nama_karyawan', $term)
            ->findAll();

        return $this->response->setJSON($karyawan);
    }
}
