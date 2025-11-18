<?php

namespace App\Controllers;

use App\Models\BeritaAcaraModel;
use App\Models\KaryawanModel;
use App\Models\InventoryModel;

class BeritaAcara extends BaseController
{
    protected $beritaAcaraModel;
    protected $karyawanModel;
    protected $inventoryModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->beritaAcaraModel = new BeritaAcaraModel();
        $this->karyawanModel = new KaryawanModel();
        $this->inventoryModel = new InventoryModel();
    }

    public function index()
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $data = [
            'title' => 'Berita Acara',
            'berita_acara' => $this->beritaAcaraModel->getWithDetails()
        ];

        return view('berita_acara/v_berita_acara', $data);
    }

    public function add()
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $data = [
            'title' => 'Tambah Berita Acara'
        ];

        return view('berita_acara/v_add_berita_acara', $data);
    }

    public function store()
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $rules = [
            'jenis_kegiatan' => 'required|min_length[3]|max_length[150]',
            'tanggal' => 'required',
            'lokasi' => 'required|min_length[3]|max_length[100]',
            'pelaksana' => 'required|min_length[3]|max_length[100]',
            'keterangan' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'jenis_kegiatan' => $this->request->getPost('jenis_kegiatan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'lokasi' => $this->request->getPost('lokasi'),
            'pelaksana' => $this->request->getPost('pelaksana'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        if ($this->beritaAcaraModel->insert($data)) {
            session()->setFlashdata('success', 'Berita Acara berhasil ditambahkan');
            return redirect()->to(site_url('berita-acara'));
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan Berita Acara');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $beritaAcara = $this->beritaAcaraModel->find($id);
        if (!$beritaAcara) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Berita Acara',
            'berita_acara' => $beritaAcara
        ];

        return view('berita_acara/v_edit_berita_acara', $data);
    }

    public function update($id)
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $rules = [
            'jenis_kegiatan' => 'required|min_length[3]|max_length[150]',
            'tanggal' => 'required',
            'lokasi' => 'required|min_length[3]|max_length[100]',
            'pelaksana' => 'required|min_length[3]|max_length[100]',
            'keterangan' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'jenis_kegiatan' => $this->request->getPost('jenis_kegiatan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'lokasi' => $this->request->getPost('lokasi'),
            'pelaksana' => $this->request->getPost('pelaksana'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        if ($this->beritaAcaraModel->update($id, $data)) {
            session()->setFlashdata('success', 'Berita Acara berhasil diupdate');
            return redirect()->to(site_url('berita-acara'));
        } else {
            session()->setFlashdata('error', 'Gagal mengupdate Berita Acara');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        if ($this->beritaAcaraModel->delete($id)) {
            session()->setFlashdata('success', 'Berita Acara berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus Berita Acara');
        }

        return redirect()->to(site_url('berita-acara'));
    }

    public function detail($id)
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $beritaAcara = $this->beritaAcaraModel->getWithDetails();
        $detail = array_filter($beritaAcara, function ($item) use ($id) {
            return $item['beritaacara_id'] == $id;
        });

        if (empty($detail)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Detail Berita Acara',
            'berita_acara' => reset($detail)
        ];

        return view('berita_acara/v_detail_berita_acara', $data);
    }

    public function print($id)
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }

        $beritaAcara = $this->beritaAcaraModel->getWithDetails();
        $detail = array_filter($beritaAcara, function ($item) use ($id) {
            return $item['beritaacara_id'] == $id;
        });

        if (empty($detail)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'berita_acara' => reset($detail)
        ];

        return view('berita_acara/v_print_berita_acara', $data);
    }
}
