<?php

namespace App\Controllers;

use App\Models\InventoryModel;

class Home extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->inventory = new InventoryModel();
    }

    public function index()
    {
        $user = userLogin();
        if ($user && $user->role == 1) {
            return view('v_home');
        } elseif ($user && $user->role == 2) {
            // User dashboard with ticket statistics and device information
            $tiketModel = new \App\Models\TiketModel();
            $karyawanModel = new \App\Models\KaryawanModel();
            $inventoryModel = new \App\Models\InventoryModel();

            // Get karyawan_id for current user
            $karyawan = $karyawanModel->where('nama_karyawan', $user->nama_users)->first();
            if ($karyawan) {
                $karyawanId = $karyawan['karyawan_id'];

                // Count tickets for today
                $todayCount = $tiketModel->where('karyawan_id', $karyawanId)
                    ->where('DATE(create_date)', date('Y-m-d'))
                    ->countAllResults();

                // Count tickets for this week
                $weekCount = $tiketModel->where('karyawan_id', $karyawanId)
                    ->where('YEARWEEK(create_date, 1)', date('YW', strtotime('this week')))
                    ->countAllResults();

                // Count tickets for this month
                $monthCount = $tiketModel->where('karyawan_id', $karyawanId)
                    ->where('YEAR(create_date)', date('Y'))
                    ->where('MONTH(create_date)', date('m'))
                    ->countAllResults();

                // Count total tickets
                $totalCount = $tiketModel->where('karyawan_id', $karyawanId)->countAllResults();

                // Get user's device information
                $userDevices = $inventoryModel->db->table('inventory')
                    ->select('inventory.*, maindevice.*, supportdevice.*')
                    ->join('maindevice', 'maindevice.main_id = inventory.main_id', 'left')
                    ->join('supportdevice', 'supportdevice.support_id = inventory.support_id', 'left')
                    ->where('inventory.karyawan_id', $karyawanId)
                    ->get()
                    ->getResult();

                $data = [
                    'today_count' => $todayCount,
                    'week_count' => $weekCount,
                    'month_count' => $monthCount,
                    'total_count' => $totalCount,
                    'user_devices' => $userDevices
                ];
            } else {
                $data = [
                    'today_count' => 0,
                    'week_count' => 0,
                    'month_count' => 0,
                    'total_count' => 0,
                    'user_devices' => []
                ];
            }

            return view('v_user_dashboard', $data);
        } else {
            return redirect()->to(site_url('auth/login'));
        }
    }
}
