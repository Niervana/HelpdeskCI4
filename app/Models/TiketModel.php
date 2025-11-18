<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'tiket_id';
    protected $allowedFields = ['karyawan_id', 'jenis_tiket', 'desk_tiket', 'status', 'create_date'];
    protected $useTimestamps = false;

    public function getWithUserInfo($limit = 50)
    {
        return $this->select('tiket.*, nama_karyawan, departemen_karyawan')
            ->join('karyawan', 'karyawan.karyawan_id = tiket.karyawan_id')
            ->orderBy('tiket.create_date', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getTicketStatsByType()
    {
        return $this->select('jenis_tiket, COUNT(*) as total')
            ->groupBy('jenis_tiket')
            ->orderBy('total', 'DESC')
            ->findAll();
    }

    public function getTicketStatsByMonth()
    {
        return $this->select('MONTH(create_date) as month, YEAR(create_date) as year, COUNT(*) as total')
            ->where('YEAR(create_date)', date('Y'))
            ->groupBy('YEAR(create_date), MONTH(create_date)')
            ->orderBy('YEAR(create_date), MONTH(create_date)')
            ->findAll();
    }

    public function getTicketStatsByStatus()
    {
        return $this->select('status, COUNT(*) as total')
            ->groupBy('status')
            ->findAll();
    }
}
