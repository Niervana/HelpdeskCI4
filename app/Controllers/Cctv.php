<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CctvModel;

class Cctv extends BaseController
{
    protected $cctvModel;

    public function __construct()
    {
        $this->cctvModel = new CctvModel();
    }

    public function index()
    {
        $data = [
            'title' => 'CCTV Inventory',
            'cctv' => $this->cctvModel->findAll(),
            'total' => $this->cctvModel->countAll(),
        ];

        return view('cctv/v_cctv', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add CCTV',
        ];

        return view('cctv/v_addcctv', $data);
    }

    public function insert()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'lokasi' => 'required',
            'tipe_kamera' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'serial_number' => 'required',
            'ip_address' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'lokasi' => $this->request->getPost('lokasi'),
            'tipe_kamera' => $this->request->getPost('tipe_kamera'),
            'merk' => $this->request->getPost('merk'),
            'model' => $this->request->getPost('model'),
            'serial_number' => $this->request->getPost('serial_number'),
            'ip_address' => $this->request->getPost('ip_address'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $this->cctvModel->insert($data);

        return redirect()->to('/cctv')->with('success', 'CCTV berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit CCTV',
            'cctv' => $this->cctvModel->find($id),
        ];

        return view('cctv/v_editcctv', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'lokasi' => 'required',
            'tipe_kamera' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'serial_number' => 'required',
            'ip_address' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'lokasi' => $this->request->getPost('lokasi'),
            'tipe_kamera' => $this->request->getPost('tipe_kamera'),
            'merk' => $this->request->getPost('merk'),
            'model' => $this->request->getPost('model'),
            'serial_number' => $this->request->getPost('serial_number'),
            'ip_address' => $this->request->getPost('ip_address'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $this->cctvModel->update($id, $data);

        return redirect()->to('/cctv')->with('success', 'CCTV berhasil diupdate');
    }

    public function delete($id)
    {
        $this->cctvModel->delete($id);

        return redirect()->to('/cctv')->with('success', 'CCTV berhasil dihapus');
    }

    public function show_detail($id)
    {
        $data = [
            'title' => 'Detail CCTV',
            'cctv' => $this->cctvModel->find($id),
        ];

        return view('cctv/v_detailcctv', $data);
    }
}
