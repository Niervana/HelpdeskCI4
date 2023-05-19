<?php

namespace App\Controllers;

use App\Models\KontrakModel;

class Kontrak extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = new KontrakModel();
    }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $builder = $this->db->table('karyawankontrak');
        $query   = $builder->get()->getResult();
        $data['karyawankontrak'] = $query;
        // inimah buat ngitung total datakaryawan
        $model = new KontrakModel();
        $data['total_rows'] = $model->total_rows();
        return view('kontrak/v_get_kontrak', $data);
    }
    // ini fungsi untuk nge route ke view addkaryawan
    // public function add()
    // {
    //     return view('karyawan/v_addkaryawan');
    // }
    // ini fungsi untuk nambah data dari view add karyawan
    // public function insert()
    // {
    //     $data = $this->request->getPost();
    //     $this->db->table('karyawan')->insert($data);

    //     if ($this->db->affectedRows() > 0) {
    //         return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Dibuat');
    //     }
    // }
    // ini fungsi untuk nge route ke view editkaryawan
    // public function edit($id = null)
    // {
    //     if ($id != null) {
    //         $query = $this->db->table('karyawan')->getWhere(['id_tetap' => $id]);
    //         if ($query->resultID->num_rows > 0) {
    //             $data['karyawan'] = $query->getRow();
    //             return view('karyawan/v_editkaryawan', $data);
    //         } else {
    //             throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //         }
    //     } else {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //     }
    // }
    // ini fungsi untuk edit data dari view edit karyawan
    // public function update($id)
    // {
    //     // $data = $this->request->getPost();
    //     // unset($data['_method']);
    //     $data = [
    //         'id_karyawan' => $this->request->getVar('id_karyawan'),
    //         'nik_karyawan' => $this->request->getVar('nik_karyawan'),
    //         'nama_karyawan' => $this->request->getVar('nama_karyawan'),
    //         'gender_karyawan' => $this->request->getVar('gender_karyawan'),
    //         'tgl_lahir' => $this->request->getVar('tgl_lahir'),
    //         'tmpt_lahir' => $this->request->getVar('tmpt_lahir'),
    //         'alamat_karyawan' => $this->request->getVar('alamat_karyawan'),
    //         'email_karyawan' => $this->request->getVar('email_karyawan'),
    //         'pendidikan_karyawan' => $this->request->getVar('pendidikan_karyawan'),
    //         'jurusan_pendidikan' => $this->request->getVar('jurusan_pendidikan'),
    //         'jabatan_karyawan' => $this->request->getVar('jabatan_karyawan'),
    //         'devisi_karyawan' => $this->request->getVar('devisi_karyawan'),
    //         'status_karyawan' => $this->request->getVar('status_karyawan'),
    //         'nomor_telp' => $this->request->getVar('nomor_telp'),
    //         'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
    //         'badan_usaha' => $this->request->getVar('badan_usaha'),
    //     ];
    //     $this->db->table('karyawan')->where(['id_tetap' => $id])->update($data);
    //     return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Update');
    // }

    // public function delete($id)
    // {
    //     $this->db->table('karyawan')->where(['id_tetap' => $id])->delete();
    //     return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Dihapus');
    // }
}
