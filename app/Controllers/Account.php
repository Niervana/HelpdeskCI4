<?php

namespace App\Controllers;



class Account extends BaseController
{
    // public function __construct()
    // {
    //     helper('form');
    //     $this->model = new PraktikModel();
    // }
    public function index()
    {
        // ini buat nampilin semua data di table 
        $builder = $this->db->table('users');
        $query   = $builder->get()->getResult();
        $data['users'] = $query;
        // inimah buat ngitung total datakaryawan
        // $model = new PraktikModel();
        // $data['total_rows'] = $model->total_rows();
        return view('account/v_getaccount', $data);
    }
}
