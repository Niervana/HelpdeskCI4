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

    public function print()
    {
        $cctv = $this->cctvModel->findAll();

        if (empty($cctv)) {
            return redirect()->to(site_url('cctv'))->with('error', 'Tidak ada data untuk dicetak');
        }

        $data['cctv'] = $cctv;

        // Load dompdf
        $dompdf = new \Dompdf\Dompdf();
        $html = view('cctv/v_print_cctv', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $filename = 'data_cctv_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, array('Attachment' => 0));
    }

    public function excel()
    {
        $cctv = $this->cctvModel->findAll();

        if (empty($cctv)) {
            return redirect()->to(site_url('cctv'))->with('error', 'Tidak ada data untuk diekspor');
        }

        $filename = 'data_cctv_' . date('Ymd') . '.csv';

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Write CSV header
        fputcsv($output, ['No', 'Lokasi', 'Tipe Kamera', 'Merk', 'Model', 'Serial Number', 'IP Address', 'Status', 'Keterangan']);

        // Write data rows
        $no = 1;
        foreach ($cctv as $item) {
            fputcsv($output, [
                $no++,
                $item['lokasi'],
                $item['tipe_kamera'],
                $item['merk'],
                $item['model'],
                $item['serial_number'],
                $item['ip_address'],
                $item['status'],
                $item['keterangan'] ?? ''
            ]);
        }

        fclose($output);
        exit;
    }
}
