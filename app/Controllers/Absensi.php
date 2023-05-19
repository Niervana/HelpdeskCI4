<?php

namespace App\Controllers;

class Absensi extends BaseController
{
    public function indexstaff()
    {
        return view('absensi/v_absensi_staff');
    }
    public function indexoperator()
    {
        return view('absensi/v_absensi_operator');
    }
}
