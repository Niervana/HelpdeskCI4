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
        // $this->model = new KontrakModel();
    }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $builder = $this->db->table('karyawan');
        $query   = $builder->get()->getResult();
        $data['karyawan'] = $query;
        // inimah buat ngitung total datakaryawan
        // $model = new KaryawanModel();
        // $data['total_rows'] = $model->total_rows();
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
        // $salary = str_replace(',', '', $data['salary']);
        // $status_karyawan = $data['status_karyawan'];
        $this->db->table('karyawan')->insert($data);
        // if ($status_karyawan === 'Kontrak') {
        //     $last_id = $this->db->insertID('');
        //     $dataKontrak = [
        //         'id_tetap' => $last_id,
        //     ];
        //     $this->db->table('karyawankontrak')->insert($dataKontrak);
        // }
        // if ($this->db->affectedRows() > 0) {
        //     return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Dibuat');
        // } else {
        //     return redirect()->back()->withInput()->with('error', 'Data gagal disimpan.');
        // }
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

    public function update($id)
    {
        $data = $this->request->getPost();
        unset($data['_method']);

        $query = $this->db->table('karyawan')->where(['id_tetap' => $id]);

        // Dapatkan data karyawan sebelum diupdate
        $karyawan_before_update = $this->db->table('karyawan')->where(['id_tetap' => $id])->get()->getRowArray();
        if (!$karyawan_before_update) {
            return redirect()->back()->withInput()->with('error', 'Data karyawan tidak ditemukan');
        }

        // Ambil status karyawan sebelumnya dan saat ini
        $status_karyawan_before = $karyawan_before_update['status_karyawan'];
        $status_karyawan_current = filter_var($data['status_karyawan'] ?? '', FILTER_SANITIZE_STRING);

        // Validasi jika status karyawan berubah
        if ($status_karyawan_before !== $status_karyawan_current) {
            if (empty($status_karyawan_current)) {
                return redirect()->back()->withInput()->with('error', 'Data yang dimasukkan tidak valid');
            }

            try {
                $this->db->transStart();

                if (!$query->update($data)) {
                    throw new \Exception('Gagal memperbarui data');
                }

                if ($status_karyawan_current === 'Tetap') {
                    // Hapus data dari tabel karyawankontrak
                    $this->db->table('karyawankontrak')->where('id_tetap', $id)->delete();
                } else { // Jika status_karyawan berubah dari 'Tetap' menjadi 'Kontrak'
                    $karyawankontrak = $this->db->table('karyawankontrak')->where('id_tetap', $id)->get()->getRowArray();

                    if ($karyawankontrak) { // Jika data kontrak sebelumnya ada
                        unset($karyawankontrak['id_kontrak']);
                        $karyawankontrak['id_tetap'] = $id;
                        $this->db->table('karyawankontrak')->insert($karyawankontrak); // Tambahkan data baru ke tabel karyawankontrak
                    } else { // Jika data kontrak sebelumnya tidak ada, buat data baru
                        $karyawankontrak = [
                            'id_tetap' => $id,
                            'nama_kontrak' => $data['nama'],
                            'tanggal_mulai' => $data['tanggal_masuk'],
                            'tanggal_selesai' => $data['tanggal_keluar']
                        ];
                        $this->db->table('karyawankontrak')->insert($karyawankontrak);
                    }
                }

                $this->db->transCommit();

                return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Diperbarui');
            } catch (\Exception $e) {
                $this->db->transRollback();

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
        } else { // Jika status karyawan tidak berubah
            unset($data['status_karyawan']);
            try {
                if (!$query->update($data)) {
                    throw new \Exception('Gagal memperbarui data');
                }

                return redirect()->to(site_url('karyawan'))->with('success', 'Data Berhasil Diperbarui');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
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
