<?php

namespace App\Controllers;

use App\Models\PraktikModel;
use Dompdf\Dompdf;

class PKL extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model = new PraktikModel();
    }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $builder = $this->db->table('pkl');
        $query   = $builder->get()->getResult();
        $data['pkl'] = $query;
        // inimah buat ngitung total datakaryawan
        $model = new PraktikModel();
        $data['total_rows'] = $model->total_rows();
        return view('PKL/v_get_pkl', $data);
    }
    // ini fungsi untuk nge route ke view addpkl
    public function add()
    {
        return view('PKL/v_addpkl');
    }
    // ini fungsi untuk nambah data dari view add pkl
    public function insert()
    {
        $data = $this->request->getPost();
        $this->db->table('pkl')->insert($data);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('pkl'))->with('success', 'Data Berhasil Dibuat');
        }
    }
    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->db->table('pkl')->getWhere(['id_pkl' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['pkl'] = $query->getRow();
                return view('pkl/v_editpkl', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function update($id)
    {
        $data = [
            'nisnim' => $this->request->getVar('nisnim'),
            'nama' => $this->request->getVar('nama'),
            'tl' => $this->request->getVar('tl'),
            'tgl' => $this->request->getVar('tgl'),
            'sekolah' => $this->request->getVar('sekolah'),
            'jurusan' => $this->request->getVar('jurusan'),
            'departemen' => $this->request->getVar('departemen'),
            'mulai' => $this->request->getVar('mulai'),
            'berakhir' => $this->request->getVar('berakhir'),
            'sertifikat' => $this->request->getVar('sertifikat')
        ];
        $this->db->table('pkl')->where('id_pkl', $id)->update($data);
        return redirect()->to(site_url('pkl'))->with('success', 'Data Berhasil Update');
    }
    public function delete($id)
    {
        $this->db->table('pkl')->where(['id_pkl' => $id])->delete();
        return redirect()->to(site_url('pkl'))->with('success', 'Data Berhasil Dihapus');
    }
    public function import_csv()
    {
        $file = $this->request->getFile('csv_file');

        if ($file && $file->isValid() && $file->getExtension() === 'csv') {
            $csvData = array_map('str_getcsv', file($file->getTempName()));

            // Hapus header kolom
            $header = array_shift($csvData);

            // Import data ke database
            foreach ($csvData as $row) {
                $data = array_combine($header, $row);
                // Lakukan pemrosesan dan simpan data ke database
                // Contoh:
                $this->Model->insert($data);
            }

            // Redirect atau tampilkan pesan sukses
            return redirect()->to('halaman_sukses');
        } else {
            // Tampilkan pesan error jika format file tidak sesuai
            return redirect()->back()->with('error', 'Format file tidak valid. Mohon unggah file CSV.');
        }
    }
    public function sertifikat($id)
    {
        if ($id != null) {
            $query = $this->db->table('pkl')->getWhere(['id_pkl' => $id]);
            if ($query->resultID->num_rows > 0) {
                $data['pkl'] = $query->getRow();
                $html = view('pkl/pdf', $data);
                $dompdf = new \Dompdf\Dompdf();
                $dompdf->set_option('isRemoteEnabled', TRUE);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'landscape');
                $dompdf->render();
                $dompdf->stream("sertifikat.pdf", array("Attachment" => false));
                exit();
                // return view('pkl/pdf', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
