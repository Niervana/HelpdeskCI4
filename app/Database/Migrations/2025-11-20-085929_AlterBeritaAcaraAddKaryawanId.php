<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterBeritaAcaraAddKaryawanId extends Migration
{
    public function up()
    {
        $this->forge->addColumn('berita_acara', [
            'karyawan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'beritaacara_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('berita_acara', 'karyawan_id');
    }
}
