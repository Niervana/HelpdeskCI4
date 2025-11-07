<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaKaryawanToLog extends Migration
{
    public function up()
    {
        $this->forge->addColumn('log', [
            'nama_karyawan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'inventory_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('log', 'nama_karyawan');
    }
}
