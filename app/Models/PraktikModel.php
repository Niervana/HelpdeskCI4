<?php

namespace App\Models;

use CodeIgniter\Model;

class PraktikModel extends Model
{
    protected $table      = 'pkl';
    protected $primaryKey = 'id_pkl';

    // ...
    public function total_rows()
    {
        return $this->db->table('pkl')->countAll();
    }
}
