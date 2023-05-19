<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Absensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'karyawan_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_karyawan' => [
                'type'       => 'VARCHAR',
                'constraint' => '',
            ],
            'alamat_karyawan' => [
                'type' => 'VARCHAR',
                'constraint' => '',
            ],
        ]);
        $this->forge->addKey('karyawan_id', true);
        $this->forge->createTable('absensi');
    }


    public function down()
    {
        $this->forge->dropTable('absensi');
    }
}
