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
            // Admin dashboard - get ticket statistics
            $tiketModel = new \App\Models\TiketModel();

            // Get total tickets
            $totalTickets = $tiketModel->countAllResults();

            // Get ongoing tickets
            $ongoingCount = $tiketModel->where('status', 'ongoing')->countAllResults();

            // Get solved tickets
            $solvedCount = $tiketModel->where('status', 'solved')->countAllResults();

            // Get today's tickets
            $todayCount = $tiketModel->where('DATE(create_date)', date('Y-m-d'))->countAllResults();

            // Get ticket statistics by type for chart
            $ticketStatsByType = $tiketModel->getTicketStatsByType();

            // Get ticket statistics by month for line chart
            $ticketStatsByMonth = $tiketModel->getTicketStatsByMonth();

            // Get ticket statistics by status for bar chart
            $ticketStatsByStatus = $tiketModel->getTicketStatsByStatus();

            // Get recent berita acara
            $beritaAcaraModel = new \App\Models\BeritaAcaraModel();
            $berita_acara = $beritaAcaraModel->getWithDetails(10); // Get 10 latest

            $data = [
                'total_tickets' => $totalTickets,
                'ongoing_count' => $ongoingCount,
                'solved_count' => $solvedCount,
                'today_count' => $todayCount,
                'ticket_stats_by_type' => $ticketStatsByType,
                'ticket_stats_by_month' => $ticketStatsByMonth,
                'ticket_stats_by_status' => $ticketStatsByStatus,
                'berita_acara' => $berita_acara
            ];

            return view('v_home', $data);
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

                // Get berita acara data (all, like admin dashboard)
                $beritaAcaraModel = new \App\Models\BeritaAcaraModel();
                $berita_acara = $beritaAcaraModel->getWithDetails(10); // Get 10 latest

                $data = [
                    'today_count' => $todayCount,
                    'week_count' => $weekCount,
                    'month_count' => $monthCount,
                    'total_count' => $totalCount,
                    'user_devices' => $userDevices,
                    'berita_acara' => $berita_acara
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

    public function download_script()
    {
        $user = userLogin();
        if (!$user) {
            return redirect()->to(site_url('auth/login'));
        }
        return view('v_download_script');
    }
}
