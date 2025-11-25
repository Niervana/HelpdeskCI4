<?php

namespace App\Controllers;

use App\Models\InventoryModel;

class Inventory extends BaseController
{
    protected $db;
    protected $LogModel;

    public function __construct()
    {
        helper('form');
        $this->model = new InventoryModel();
        $this->db = \Config\Database::connect();
        $this->LogModel = new \App\Models\LogModel();
        date_default_timezone_set('Asia/Bangkok');
    }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $data['inventory'] = $this->model->getAllInventory();
        // inimah buat ngitung total datainventory
        $data['total_rows'] = $this->model->total_rows();
        return view('inventory/v_inventory', $data);
    }
    // ini fungsi untuk nge route ke view addinventory
    public function add()
    {
        return view('inventory/v_addinventory');
    }
    // ini fungsi untuk nambah data dari view add inventory
    public function insert()
    {
        $data = $this->request->getPost();
        // Insert into users table
        $userData = [
            'nama_users' => $data['nama_karyawan'],
            'email_users' => $data['email_users'],
            'password_users' => $data['password_users'], // Plain password
            'role' => 2, // User role
            'createdat_users' => date('Y-m-d H:i:s')
        ];
        $this->db->table('users')->insert($userData);
        $userId = $this->db->insertID();

        // Insert into karyawan table
        $karyawanData = [
            'nama_karyawan' => $data['nama_karyawan'],
            'departemen_karyawan' => $data['departemen_karyawan']
        ];
        $this->db->table('karyawan')->insert($karyawanData);
        $karyawanId = $this->db->insertID();

        // Insert into maindevice table
        $mainDeviceData = [
            'manufaktur' => $data['manufaktur'],
            'jenis' => $data['jenis'],
            'cpu' => $data['cpu'],
            'ram' => $data['ram'],
            'os' => $data['os'],
            'lisensi_windows' => $data['lisensi_windows'],
            'storage' => $data['storage'],
            'office' => $data['office'],
            'lisensi_office' => $data['lisensi_office'],
            'ipaddress' => $data['ipaddress'],
            'hostname' => $data['hostname'],
            'credential' => $data['credential']
        ];
        $this->db->table('maindevice')->insert($mainDeviceData);
        $mainId = $this->db->insertID();

        // Insert into supportdevice table
        $supportDeviceData = [
            'monitor' => $data['monitor'],
            'keyboard' => $data['keyboard'],
            'mouse' => $data['mouse'],
            'usb_converter' => $data['usb_converter'],
            'external_storage' => $data['external_storage'],
            'printer' => $data['printer'],
            'scanner' => $data['scanner']
        ];
        $this->db->table('supportdevice')->insert($supportDeviceData);
        $supportId = $this->db->insertID();

        // Insert into inventory table
        $inventoryData = [
            'karyawan_id' => $karyawanId,
            'main_id' => $mainId,
            'support_id' => $supportId
        ];
        $this->db->table('inventory')->insert($inventoryData);
        $inventoryId = $this->db->insertID();

        // Log the action
        $logModel = new \App\Models\LogModel();
        $logData = [
            'inventory_id' => $inventoryId,
            'nama_karyawan' => $data['nama_karyawan'],
            'action_type' => 'INSERT',
            'before_change' => null, // No previous state for creation
            'after_change' => json_encode($data), // Log the full input data
            'users_id' => userLogin()->id_users, // Assuming userLogin() is available
            'action_date' => date('Y-m-d H:i:s'),
            'ip_address' => $this->request->getIPAddress(true),
            'description' => 'Menambahkan inventaris baru untuk karyawan ' . $data['nama_karyawan'] . ' dengan perangkat utama ' . $data['manufaktur'] . ' ' . $data['jenis'] . '.',
        ];
        $logModel->insert($logData);

        return redirect()->to(site_url('inventory'))->with('success', 'Data Berhasil Ditambahkan');
    }

    // ini fungsi untuk nge route ke view editinventory
    public function edit($id = null)
    {
        if ($id != null) {
            $data['inventory'] = $this->model->getInventoryWithDetails($id);
            if ($data['inventory']) {
                return view('inventory/v_editinventory', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        unset($data['_method']);

        // Get current inventory data
        $model = new InventoryModel();
        $current = $model->getInventoryWithDetails($id);
        if (!$current) {
            return redirect()->back()->withInput()->with('error', 'Data inventory tidak ditemukan');
        }

        // Prepare before_change data
        $beforeChange = [
            'nama_karyawan' => $current->nama_karyawan,
            'departemen_karyawan' => $current->departemen_karyawan,
            'email_users' => $current->email_users ?? '',
            'password_users' => $current->password_users ?? '',
            'manufaktur' => $current->manufaktur,
            'jenis' => $current->jenis,
            'cpu' => $current->cpu,
            'ram' => $current->ram,
            'os' => $current->os,
            'lisensi_windows' => $current->lisensi_windows,
            'storage' => $current->storage,
            'office' => $current->office,
            'lisensi_office' => $current->lisensi_office,
            'ipaddress' => $current->ipaddress,
            'hostname' => $current->hostname,
            'credential' => $current->credential,
            'monitor' => $current->monitor,
            'keyboard' => $current->keyboard,
            'mouse' => $current->mouse,
            'usb_converter' => $current->usb_converter,
            'external_storage' => $current->external_storage,
            'printer' => $current->printer,
            'scanner' => $current->scanner
        ];

        // Update users table if email or password changed
        if (isset($data['email_users']) && isset($data['password_users'])) {
            $userData = [
                'nama_users' => $data['nama_karyawan'],
                'email_users' => $data['email_users'],
                'password_users' => $data['password_users'], // Plain password
                'role' => 2
            ];
            $this->db->table('users')->where('nama_users', $current->nama_karyawan)->update($userData);
        }

        // Update karyawan table
        $karyawanData = [
            'nama_karyawan' => $data['nama_karyawan'],
            'departemen_karyawan' => $data['departemen_karyawan']
        ];
        $this->db->table('karyawan')->where('karyawan_id', $current->karyawan_id)->update($karyawanData);

        // Check if main_id is null, if so, insert new maindevice
        if ($current->main_id === null) {
            $mainDeviceData = [
                'manufaktur' => $data['manufaktur'],
                'jenis' => $data['jenis'],
                'cpu' => $data['cpu'],
                'ram' => $data['ram'],
                'os' => $data['os'],
                'lisensi_windows' => $data['lisensi_windows'],
                'storage' => $data['storage'],
                'office' => $data['office'],
                'lisensi_office' => $data['lisensi_office'],
                'ipaddress' => $data['ipaddress'],
                'hostname' => $data['hostname'],
                'credential' => $data['credential']
            ];
            $this->db->table('maindevice')->insert($mainDeviceData);
            $mainId = $this->db->insertID();
            // Update inventory table with new main_id
            $this->db->table('inventory')->where('inventory_id', $id)->update(['main_id' => $mainId]);
        } else {
            // Update existing maindevice
            $mainDeviceData = [
                'manufaktur' => $data['manufaktur'],
                'jenis' => $data['jenis'],
                'cpu' => $data['cpu'],
                'ram' => $data['ram'],
                'os' => $data['os'],
                'lisensi_windows' => $data['lisensi_windows'],
                'storage' => $data['storage'],
                'office' => $data['office'],
                'lisensi_office' => $data['lisensi_office'],
                'ipaddress' => $data['ipaddress'],
                'hostname' => $data['hostname'],
                'credential' => $data['credential']
            ];
            $this->db->table('maindevice')->where('main_id', $current->main_id)->update($mainDeviceData);
        }

        // Check if support_id is null, if so, insert new supportdevice
        if ($current->support_id === null) {
            $supportDeviceData = [
                'monitor' => $data['monitor'],
                'keyboard' => $data['keyboard'],
                'mouse' => $data['mouse'],
                'usb_converter' => $data['usb_converter'],
                'external_storage' => $data['external_storage'],
                'printer' => $data['printer'],
                'scanner' => $data['scanner']
            ];
            $this->db->table('supportdevice')->insert($supportDeviceData);
            $supportId = $this->db->insertID();
            // Update inventory table with new support_id
            $this->db->table('inventory')->where('inventory_id', $id)->update(['support_id' => $supportId]);
        } else {
            // Update existing supportdevice
            $supportDeviceData = [
                'monitor' => $data['monitor'],
                'keyboard' => $data['keyboard'],
                'mouse' => $data['mouse'],
                'usb_converter' => $data['usb_converter'],
                'external_storage' => $data['external_storage'],
                'printer' => $data['printer'],
                'scanner' => $data['scanner']
            ];
            $this->db->table('supportdevice')->where('support_id', $current->support_id)->update($supportDeviceData);
        }

        // Get after_change data (need to refetch or build from data)
        $afterChange = [
            'nama_karyawan' => $karyawanData['nama_karyawan'],
            'departemen_karyawan' => $karyawanData['departemen_karyawan'],
            'email_users' => $data['email_users'] ?? '',
            'password_users' => $data['password_users'] ?? '',
            'manufaktur' => $mainDeviceData['manufaktur'],
            'jenis' => $mainDeviceData['jenis'],
            'cpu' => $mainDeviceData['cpu'],
            'ram' => $mainDeviceData['ram'],
            'os' => $mainDeviceData['os'],
            'lisensi_windows' => $mainDeviceData['lisensi_windows'],
            'storage' => $mainDeviceData['storage'],
            'office' => $mainDeviceData['office'],
            'lisensi_office' => $mainDeviceData['lisensi_office'],
            'ipaddress' => $mainDeviceData['ipaddress'],
            'hostname' => $mainDeviceData['hostname'],
            'credential' => $mainDeviceData['credential'],
            'monitor' => $supportDeviceData['monitor'],
            'keyboard' => $supportDeviceData['keyboard'],
            'mouse' => $supportDeviceData['mouse'],
            'usb_converter' => $supportDeviceData['usb_converter'],
            'external_storage' => $supportDeviceData['external_storage'],
            'printer' => $supportDeviceData['printer'],
            'scanner' => $supportDeviceData['scanner']
        ];

        // Log the action
        $logData = [
            'inventory_id' => $id,
            'nama_karyawan' => $data['nama_karyawan'],
            'action_type' => 'UPDATE',
            'before_change' => json_encode($beforeChange),
            'after_change' => json_encode($afterChange),
            'users_id' => userLogin()->id_users,
            'action_date' => date('Y-m-d H:i:s'),
            'ip_address' => $this->request->getIPAddress(true),
            'description' => 'Memperbarui inventaris untuk karyawan ' . $data['nama_karyawan'] . '.',
        ];
        $this->LogModel->insert($logData);

        return redirect()->to(site_url('inventory'))->with('success', 'Data Berhasil Diperbarui');
    }

    public function delete($id)
    {
        $model = new InventoryModel();
        $current = $model->getInventoryWithDetails($id);
        if ($current) {
            // Prepare before_change data for logging
            $beforeChange = [
                'nama_karyawan' => $current->nama_karyawan,
                'departemen_karyawan' => $current->departemen_karyawan,
                'email_users' => $current->email_users ?? '',
                'password_users' => $current->password_users ?? '',
                'manufaktur' => $current->manufaktur,
                'jenis' => $current->jenis,
                'cpu' => $current->cpu,
                'ram' => $current->ram,
                'os' => $current->os,
                'lisensi_windows' => $current->lisensi_windows,
                'storage' => $current->storage,
                'office' => $current->office,
                'lisensi_office' => $current->lisensi_office,
                'ipaddress' => $current->ipaddress,
                'hostname' => $current->hostname,
                'credential' => $current->credential,
                'monitor' => $current->monitor,
                'keyboard' => $current->keyboard,
                'mouse' => $current->mouse,
                'usb_converter' => $current->usb_converter,
                'external_storage' => $current->external_storage,
                'printer' => $current->printer,
                'scanner' => $current->scanner
            ];

            // Log the action before deleting
            $logData = [
                'inventory_id' => $id,
                'nama_karyawan' => $current->nama_karyawan,
                'action_type' => 'DELETE',
                'before_change' => json_encode($beforeChange),
                'after_change' => null, // No after state for deletion
                'users_id' => userLogin()->id_users,
                'action_date' => date('Y-m-d H:i:s'),
                'ip_address' => $this->request->getIPAddress(true),
                'description' => 'Menghapus inventaris untuk karyawan ' . $current->nama_karyawan . '.',
            ];
            $this->LogModel->insert($logData);

            try {
                $this->db->transStart();
                // Delete from inventory table
                $this->db->table('inventory')->where('inventory_id', $id)->delete();
                // Delete from related tables
                $this->db->table('karyawan')->where('karyawan_id', $current->karyawan_id)->delete();
                // Delete user if exists (for registered users)
                $user = $this->db->table('users')->where('nama_users', $current->nama_karyawan)->get()->getRow();
                if ($user) {
                    $this->db->table('users')->where('id_users', $user->id_users)->delete();
                }
                if ($current->main_id) {
                    $this->db->table('maindevice')->where('main_id', $current->main_id)->delete();
                }
                if ($current->support_id) {
                    $this->db->table('supportdevice')->where('support_id', $current->support_id)->delete();
                }
                $this->db->transCommit();
            } catch (\Exception $e) {
                $this->db->transRollback();
                return redirect()->to(site_url('inventory'))->with('error', 'Gagal menghapus data: ' . $e->getMessage());
            }
        }
        return redirect()->to(site_url('inventory'))->with('success', 'Data Berhasil Dihapus');
    }

    public function show_detail($id)
    {
        if ($id != null) {
            $model = new InventoryModel();
            $data['inventory'] = $model->getInventoryWithDetails($id);
            if ($data['inventory']) {
                return view('inventory/v_detailinventory', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function printMain()
    {
        $model = new InventoryModel();
        $data['inventory'] = $model->getAllInventory();

        $dompdf = new \Dompdf\Dompdf();
        $html = view('inventory/v_print_inventory_main', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('data_inventory_main_device.pdf', array('Attachment' => 0));
    }

    public function printSupport()
    {
        $model = new InventoryModel();
        $data['inventory'] = $model->getAllInventory();

        $dompdf = new \Dompdf\Dompdf();
        $html = view('inventory/v_print_inventory_support', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('data_inventory_support_device.pdf', array('Attachment' => 0));
    }

    public function excel()
    {
        $model = new InventoryModel();
        $inventory = $model->getAllInventory();
        if (empty($inventory)) {
            return redirect()->to(site_url('inventory'))->with('error', 'Tidak ada data untuk diekspor');
        }

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data_inventory.csv"');

        $output = fopen('php://output', 'w');

        // Write CSV header
        fputcsv($output, [
            'Nama Karyawan',
            'Departemen',
            'Manufaktur',
            'Jenis',
            'CPU',
            'RAM',
            'OS',
            'Lisensi Windows',
            'Storage',
            'Office',
            'Lisensi Office',
            'IP Address',
            'Hostname',
            'Credential',
            'Monitor',
            'Keyboard',
            'Mouse',
            'USB Converter',
            'External Storage',
            'Printer',
            'Scanner'
        ]);

        // Write data rows
        foreach ($inventory as $item) {
            fputcsv($output, [
                $item->nama_karyawan ?: '-',
                $item->departemen_karyawan ?: '-',
                $item->manufaktur ?: '-',
                $item->jenis ?: '-',
                $item->cpu ?: '-',
                $item->ram ?: '-',
                $item->os ?: '-',
                $item->lisensi_windows ?: '-',
                $item->storage ?: '-',
                $item->office ?: '-',
                $item->lisensi_office ?: '-',
                $item->ipaddress ?: '-',
                $item->hostname ?: '-',
                $item->credential ?: '-',
                $item->monitor ?: '-',
                $item->keyboard ?: '-',
                $item->mouse ?: '-',
                $item->usb_converter ?: '-',
                $item->external_storage ?: '-',
                $item->printer ?: '-',
                $item->scanner ?: '-'
            ]);
        }

        fclose($output);
        exit;
    }

    public function log()
    {
        $data['logs'] = $this->db->table('log')
            ->select('log.*, users.nama_users')
            ->join('users', 'log.users_id = users.id_users')
            ->orderBy('log.log_id', 'DESC')
            ->get()
            ->getResultArray();
        return view('inventory/v_log', $data);
    }
}
