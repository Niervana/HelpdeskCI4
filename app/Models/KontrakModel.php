<?php

namespace App\Models;

use CodeIgniter\Model;

class KontrakModel extends Model
{
    protected $table      = 'karyawankontrak';
    protected $primaryKey = 'id_kontrak';

    // ...
    public function total_rows()
    {
        return $this->db->table('karyawankontrak')->countAll();
    }
}
