<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\PraktikModel;

class Home extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->karyawan = new KaryawanModel();
        $this->praktik = new PraktikModel();
    }

    public function index()
    {
        $karyawan = new KaryawanModel();
        $praktik = new PraktikModel();
        $total_karyawan = $karyawan->countAll();
        $total_karyawan_tetap = $karyawan->where('status_karyawan', 'Tetap')->countAllResults();
        $total_karyawan_kontrak = $karyawan->where('status_karyawan', 'Kontrak')->countAllResults();
        $total_pkl = $praktik->countAll();
        $departemen = $karyawan->groupBy('devisi_karyawan')->select('devisi_karyawan, COUNT(*) as jumlah')->findAll();
        $badanusaha = $karyawan->groupBy('badan_usaha')->select('badan_usaha, COUNT(*) as jumlah')->findAll();
        $data = [
            'total_karyawan' => $total_karyawan,
            'total_karyawan_tetap' => $total_karyawan_tetap,
            'total_karyawan_kontrak' => $total_karyawan_kontrak,
            'total_pkl' => $total_pkl,
            'departemen' => $departemen,
            'badanusaha' => $badanusaha

        ];

        return view('v_home', $data);
    }
}
