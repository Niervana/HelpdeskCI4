<?php

namespace App\Controllers;

use App\Models\InventoryModel;

class Inventory extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = new InventoryModel();
    }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $model = new InventoryModel();
        $data['inventory'] = $model->getAllInventory();
        // inimah buat ngitung total datainventory
        $data['total_rows'] = $model->total_rows();
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
            'lisensi' => $data['lisensi'],
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
            'external_storage' => $data['external_storage']
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


        return redirect()->to(site_url('inventory'))->with('success', 'Data Berhasil Ditambahkan');
    }

    // ini fungsi untuk nge route ke view editinventory
    public function edit($id = null)
    {
        if ($id != null) {
            $model = new InventoryModel();
            $data['inventory'] = $model->getInventoryWithDetails($id);
            if ($data['inventory']) {
                return view('inventory/v_editinventory', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    // public function update($id)
    // {
    //     $data = $this->request->getPost();
    //     unset($data['_method']);

    //     $query = $this->db->table('karyawan')->where(['id_tetap' => $id]);

    //     // Dapatkan data karyawan sebelum diupdate
    //     $karyawan_before_update = $this->db->table('karyawan')->where(['id_tetap' => $id])->get()->getRowArray();
    //     if (!$karyawan_before_update) {
    //         return redirect()->back()->withInput()->with('error', 'Data karyawan tidak ditemukan');
    //     }

    //     // Ambil status karyawan sebelumnya dan saat ini
    //     $status_karyawan_before = $karyawan_before_update['status_karyawan'];
    //     $status_karyawan_current = filter_var($data['status_karyawan'] ?? '', FILTER_SANITIZE_STRING);

    //     // Validasi jika status karyawan berubah
    //     if ($status_karyawan_before !== $status_karyawan_current) {
    //         if (empty($status_karyawan_current)) {
    //             return redirect()->back()->withInput()->with('error', 'Data yang dimasukkan tidak valid');
    //         }

    //         try {
    //             $this->db->transStart();

    //             if (!$query->update($data)) {
    //                 throw new \Exception('Gagal memperbarui data');
    //             }

    //             if ($status_karyawan_current === 'Tetap') {
    //                 // Hapus data dari tabel karyawankontrak
    //                 $this->db->table('karyawankontrak')->where('id_tetap', $id)->delete();
    //             } else { // Jika status_karyawan berubah dari 'Tetap' menjadi 'Kontrak'
    //                 $karyawankontrak = $this->db->table('karyawankontrak')->where('id_tetap', $id)->get()->getRowArray();

    //                 if ($karyawankontrak) { // Jika data kontrak sebelumnya ada
    //                     unset($karyawankontrak['id_kontrak']);
    //                     $karyawankontrak['id_tetap'] = $id;
    //                     $this->db->table('karyawankontrak')->insert($karyawankontrak); // Tambahkan data baru ke tabel karyawankontrak
    //                 } else { // Jika data kontrak sebelumnya tidak ada, buat data baru
    //                     $karyawankontrak = [
    //                         'id_tetap' => $id,
    //                         'nama_kontrak' => $data['nama'],
    //                         'tanggal_mulai' => $data['tanggal_masuk'],
    //                         'tanggal_selesai' => $data['tanggal_keluar']
    //                     ];
    //                     $this->db->table('karyawankontrak')->insert($karyawankontrak);
    //                 }
    //             }

    //             $this->db->transCommit();

    //             return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Diperbarui');
    //         } catch (\Exception $e) {
    //             $this->db->transRollback();

    //             return redirect()->back()->withInput()->with('error', $e->getMessage());
    //         }
    //     } else { // Jika status karyawan tidak berubah
    //         unset($data['status_karyawan']);
    //         try {
    //             if (!$query->update($data)) {
    //                 throw new \Exception('Gagal memperbarui data');
    //             }

    //             return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Diperbarui');
    //         } catch (\Exception $e) {
    //             return redirect()->back()->withInput()->with('error', $e->getMessage());
    //         }
    //     }
    // }
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
            'manufaktur' => $current->manufaktur,
            'jenis' => $current->jenis,
            'cpu' => $current->cpu,
            'ram' => $current->ram,
            'os' => $current->os,
            'lisensi' => $current->lisensi,
            'ipaddress' => $current->ipaddress,
            'hostname' => $current->hostname,
            'credential' => $current->credential,
            'monitor' => $current->monitor,
            'keyboard' => $current->keyboard,
            'mouse' => $current->mouse,
            'usb_converter' => $current->usb_converter,
            'external_storage' => $current->external_storage
        ];

        // Update karyawan table
        $karyawanData = [
            'nama_karyawan' => $data['nama_karyawan'],
            'departemen_karyawan' => $data['departemen_karyawan']
        ];
        $this->db->table('karyawan')->where('karyawan_id', $current->karyawan_id)->update($karyawanData);

        // Update maindevice table
        $mainDeviceData = [
            'manufaktur' => $data['manufaktur'],
            'jenis' => $data['jenis'],
            'cpu' => $data['cpu'],
            'ram' => $data['ram'],
            'os' => $data['os'],
            'lisensi' => $data['lisensi'],
            'ipaddress' => $data['ipaddress'],
            'hostname' => $data['hostname'],
            'credential' => $data['credential']
        ];
        $this->db->table('maindevice')->where('main_id', $current->main_id)->update($mainDeviceData);

        // Update supportdevice table
        $supportDeviceData = [
            'monitor' => $data['monitor'],
            'keyboard' => $data['keyboard'],
            'mouse' => $data['mouse'],
            'usb_converter' => $data['usb_converter'],
            'external_storage' => $data['external_storage']
        ];
        $this->db->table('supportdevice')->where('support_id', $current->support_id)->update($supportDeviceData);


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
                'manufaktur' => $current->manufaktur,
                'jenis' => $current->jenis,
                'cpu' => $current->cpu,
                'ram' => $current->ram,
                'os' => $current->os,
                'lisensi' => $current->lisensi,
                'ipaddress' => $current->ipaddress,
                'hostname' => $current->hostname,
                'credential' => $current->credential,
                'monitor' => $current->monitor,
                'keyboard' => $current->keyboard,
                'mouse' => $current->mouse,
                'usb_converter' => $current->usb_converter,
                'external_storage' => $current->external_storage
            ];

            try {
                $this->db->transStart();
                // Delete from inventory table
                $this->db->table('inventory')->where('inventory_id', $id)->delete();
                // Delete from related tables
                $this->db->table('karyawan')->where('karyawan_id', $current->karyawan_id)->delete();
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

    public function print()
    {
        $model = new InventoryModel();
        $data['inventory'] = $model->getAllInventory();
        if (empty($data['inventory'])) {
            return redirect()->to(site_url('inventory'))->with('error', 'Tidak ada data untuk dicetak');
        }

        // Load dompdf
        $dompdf = new \Dompdf\Dompdf();
        $html = view('inventory/v_print_inventory', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('data_inventory.pdf', array('Attachment' => 0));
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
        fputcsv($output, ['Nama Karyawan', 'Departemen', 'Main Device', 'Support Device']);

        // Write data rows
        foreach ($inventory as $item) {
            $mainDevice = $item->manufaktur ? $item->manufaktur . ' ' . $item->jenis . ' (' . $item->cpu . ', ' . $item->ram . ', ' . $item->os . ')' : '-';
            $support = [];
            if ($item->monitor) $support[] = 'Monitor';
            if ($item->keyboard) $support[] = 'Keyboard';
            if ($item->mouse) $support[] = 'Mouse';
            $supportDevice = implode(', ', $support) ?: '-';

            fputcsv($output, [
                $item->nama_karyawan,
                $item->departemen_karyawan,
                $mainDevice,
                $supportDevice
            ]);
        }

        fclose($output);
        exit;
    }
}
