<?php

namespace App\Controllers;

class Tiket extends BaseController
{
    public function index()
    {
        // ini buat nampilin semua data di table 
        $builder = $this->db->table('tiket');
        $query   = $builder->get()->getResult();
        $data['tiket'] = $query;
        return view('ticketing/v_request', $data);
    }
    public function reply()
    {
        return view('ticketing/v_read');
    }
    public function insert()
    {
        $data = $this->request->getPost();
        $this->db->table('tiket')->insert($data);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('tikets'))->with('success', 'Data Berhasil Dibuat');
        }
    }
}
