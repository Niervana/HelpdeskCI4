<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaAcaraModel extends Model
{
    protected $table = 'berita_acara';
    protected $primaryKey = 'beritaacara_id';
    protected $allowedFields = [
        'jenis_kegiatan',
        'tanggal',
        'lokasi',
        'pelaksana',
        'keterangan'
    ];
    protected $useTimestamps = true;

    public function getWithDetails($limit = null)
    {
        return $this->orderBy('tanggal', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getByKaryawan($karyawanId)
    {
        return $this->where('karyawan_id', $karyawanId)
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function getByMonth($year = null, $month = null)
    {
        $query = $this->select('MONTH(tanggal) as month, YEAR(tanggal) as year, COUNT(*) as total')
            ->groupBy('YEAR(tanggal), MONTH(tanggal)')
            ->orderBy('YEAR(tanggal), MONTH(tanggal)');

        if ($year) {
            $query->where('YEAR(tanggal)', $year);
        }

        if ($month) {
            $query->where('MONTH(tanggal)', $month);
        }

        return $query->findAll();
    }

    public function getStatsByActivityType()
    {
        return $this->select('jenis_kegiatan, COUNT(*) as total')
            ->groupBy('jenis_kegiatan')
            ->orderBy('total', 'DESC')
            ->findAll();
    }
}
