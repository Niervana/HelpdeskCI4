<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\KontrakModel;

class Kontrak extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = new KontrakModel();
        $this->model = new KaryawanModel();
    }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $builder = $this->db->table('karyawankontrak');
        $builder->select('*');
        $builder->join('karyawan', 'karyawan.id_tetap = karyawankontrak.id_tetap');
        $query   = $builder->get()->getResult();
        $data['karyawankontrak'] = $query;
        // inimah buat ngitung total datakaryawan
        $model = new KontrakModel();
        $data['total_rows'] = $model->total_rows();
        return view('kontrak/v_get_kontrak', $data);
    }

    // ini fungsi untuk nge route ke view editkaryawan
    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->db->table('karyawankontrak')->getWhere(['id_kontrak' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['karyawankontrak'] = $query->getRow();
                return view('kontrak/v_edit_kontrak', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    // ini fungsi untuk edit data dari view edit karyawan
    //versi 1
    public function updatekontrak($id)
    {
        $data = [
            // 'id_kontrak' => $this->request->getVar('id_kontrak'),
            // // 'id_tetap' => $this->request->getVar('id_tetap'),
            'kontrak_awal' => $this->request->getVar('kontrak_awal'),
            'kontrak_akhir' => $this->request->getVar('kontrak_akhir'),
            'status' => $this->request->getVar('status'),
            'renew' => $this->request->getVar('renew')

        ];

        $this->db->table('karyawankontrak')->where('id_kontrak', $id)->update($data);
        return redirect()->to(site_url('kontrak'))->with('success', 'Data Berhasil Update');
    }
    //versi2
    // public function update($id)
    // {
    //     $data = $this->request->getPost();

    //     if (!empty($data)) {
    //         unset($data['_method']);

    //         $status_karyawan = (isset($data['status_karyawan'])) ? $data['status_karyawan'] : null;

    //         if (!is_null($status_karyawan)) {
    //             $this->db->table('karyawankontrak')
    //                 ->set($data)
    //                 ->where(['id_kontrak' => $id])
    //                 ->update();

    //             return redirect()->to(site_url('kontrak'))->with('success', 'Data Berhasil Update');
    //         } else {
    //             // handle the case where status_karyawan is missing or invalid
    //         }
    //     } else {
    //         // handle the case where POST data is empty
    //     }
    // }
    //versi3
    // function updatekontrak($id)
    // {
    //     // Ambil data dari permintaan POST dan hapus kunci yang tidak diperlukan
    //     $data = $this->request->getPost();
    //     unset($data['_method']);

    //     // Bersihkan nilai-nilai yang akan disimpan pada database
    //     $awal_kontrak = filter_var($data['kontrak_awal'], FILTER_SANITIZE_STRING);
    //     $akhir_kontrak = filter_var($data['kontrak_akhir'], FILTER_SANITIZE_STRING);
    //     // $renew = filter_var($data['renew'], FILTER_SANITIZE_NUMBER_INT);
    //     // $status = filter_var($data['status'], FILTER_SANITIZE_STRING);

    //     // Periksa apakah value kontrak awal dan kontrak akhir kosong
    //     if (empty($awal_kontrak) || empty($akhir_kontrak)) {
    //         redirect_back_with_error("Tanggal kontrak awal dan akhir harus diisi.");
    //     }

    //     // Inisialisasi objek koneksi database atau ambil dari instance yang ada
    //     $query = $this->db->table('karyawankontrak');

    //     // Simpan nilai-nilai yang telah dibersihkan ke dalam database
    //     $result = $query->where('id', $id)->update([
    //         'awal_kontrak' => $awal_kontrak,
    //         'akhir_kontrak' => $akhir_kontrak,
    //         //     'renew' => $renew,
    //         //     'status' => $status
    //     ]);

    //     // Lakukan penanganan kesalahan jika proses update gagal
    //     if (!$result) {
    //         redirect_back_with_error("Gagal melakukan update data.");
    //     }

    //     // Redirect ke halaman sebelumnya dengan pesan sukses jika update berhasil
    //     redirect_back_with_success("Data kontrak berhasil diperbarui.");
    // }


    // public function delete($id)
    // {
    //     $this->db->table('karyawan')->where(['id_tetap' => $id])->delete();
    //     return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Dihapus');
    // }
}
