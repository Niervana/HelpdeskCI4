<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table      = 'karyawan';
    protected $primaryKey = 'id_tetap';

    // ...
    public function total_rows()
    {
        return $this->db->table('karyawan')->countAll();
    }
}
