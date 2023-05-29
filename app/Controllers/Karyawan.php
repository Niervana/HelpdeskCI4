<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\KontrakModel;

class Karyawan extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = new KaryawanModel();
        $this->model = new KontrakModel();
    }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $builder = $this->db->table('karyawan');
        $query   = $builder->get()->getResult();
        $data['karyawan'] = $query;
        // inimah buat ngitung total datakaryawan
        $model = new KaryawanModel();
        $data['total_rows'] = $model->total_rows();
        return view('karyawan/v_karyawan', $data);
    }
    // ini fungsi untuk nge route ke view addkaryawan
    public function add()
    {
        return view('karyawan/v_addkaryawan');
    }
    // ini fungsi untuk nambah data dari view add karyawan
    public function insert()
    {
        $data = $this->request->getPost();
        $status_karyawan = $data['status_karyawan'];
        $this->db->table('karyawan')->insert($data);
        if ($status_karyawan === 'Kontrak') {
            $last_id = $this->db->insertID('');
            $dataKontrak = [
                'id_tetap' => $last_id,
            ];
            $this->db->table('karyawankontrak')->insert($dataKontrak);
        }
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Dibuat');
        }
    }
    // ini fungsi untuk nge route ke view editkaryawan
    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->db->table('karyawan')->getWhere(['id_tetap' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['karyawan'] = $query->getRow();
                return view('karyawan/v_editkaryawan', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    //versi 1
    // ini fungsi untuk edit data dari view edit karyawan
    // public function update($id)
    // {
    //     $data = $this->request->getPost();
    //     unset($data['_method']);
    //     $status_karyawan = $data['status_karyawan'];
    //     $this->db->table('karyawan')->where(['id_tetap' => $id])->update($data);
    //     if ($status_karyawan === 'Tetap') {
    //         $this->db->table('karyawankontrak')->where('id_tetap', $id)->delete();
    //     }
    //     if ($this->db->affectedRows() > 0) {
    //         return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Diperbarui');
    //     }
    // }
    // versi 2
    // public function update($id)
    // {
    //     $data = $this->request->getPost();
    //     unset($data['_method']);
    //     // Periksa apakah data yang diperlukan ada
    //     if (!isset($data['status_karyawan'])) {
    //         return redirect()->back()->withInput()->with('error', 'Status Karyawan dibutuhkan');
    //     }
    //     // Membersihkan dan memvalidasi data masukan
    //     $status_karyawan = filter_var($data['status_karyawan'], FILTER_SANITIZE_STRING);
    //     if (empty($status_karyawan)) {
    //         return redirect()->back()->withInput()->with('error', 'Data yang dimasukkan tidak valid');
    //     }
    //     // Persiapkan kueri pembaruan
    //     $query = $this->db->table('karyawan')->where(['id_tetap' => $id]);
    //     // Bind data ke kueri
    //     foreach ($data as $key => $value) {
    //         if ($key !== 'status_karyawan') { // Hindari mengikat status_karyawan lagi
    //             $query->set($key, $value);
    //         }
    //     }
    //     // Jalankan kueri pembaruan
    //     $result = $query->update();
    //     if ($status_karyawan === 'Tetap') {
    //         // Hapus data dari tabel karyawankontrak
    //         $this->db->table('karyawankontrak')->where('id_tetap', $id)->delete();
    //     }
    //     if ($result) { // Periksa jika baris terkena dampak
    //         return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Diperbarui');
    //     } else {
    //         return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data');
    //     }
    // }
    //versi 3
    public function update($id)
    {
        $data = $this->request->getPost();
        unset($data['_method']);
        if (!isset($data['status_karyawan'])) {
            return redirect()->back()->withInput()->with('error', 'Status Karyawan dibutuhkan');
        }
        $status_karyawan = filter_var($data['status_karyawan'], FILTER_SANITIZE_STRING);
        if (empty($status_karyawan)) {
            return redirect()->back()->withInput()->with('error', 'Data yang dimasukkan tidak valid');
        }
        $query = $this->db->table('karyawan')->where(['id_tetap' => $id])->set($data); // Mengikat semua data termasuk status_karyawan
        $result = $query->update();
        if ($result) {
            if ($status_karyawan === 'Tetap') {
                // Hapus data dari tabel karyawankontrak
                $this->db->table('karyawankontrak')->where('id_tetap', $id)->delete();
            } else { // Jika status_karyawan berubah dari 'Tetap' menjadi 'Kontrak'
                $karyawankontrak = $this->db->table('karyawankontrak')->where('id_tetap', $id)->get()->getRowArray();
                if ($karyawankontrak) { // Jika data kontrak sebelumnya ada
                    unset($karyawankontrak['id_kontrak']);
                    $karyawankontrak['id_tetap'] = $id;
                    $this->db->table('karyawankontrak')->insert($karyawankontrak); // Tambahkan data baru ke tabel karyawankontrak
                }
            }
            return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data');
        }
    }


    public function delete($id)
    {
        $this->db->table('karyawan')->where(['id_tetap' => $id])->delete();
        return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Dihapus');
    }
    public function show_detail($id)
    {
        if (
            $id != null
        ) {
            $query = $this->db->table('karyawan')->getWhere(['id_tetap' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['karyawan'] = $query->getRow();
                return view('karyawan/v_detailkaryawan', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
