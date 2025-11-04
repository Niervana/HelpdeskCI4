<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class karyawan extends Migration
{
    public function up()
    {
        if (!$this->db->tableExists('karyawan')) {
            $this->forge->addField([
                'karyawan_id'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'nama_karyawan'        => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                ],
                'departemen_karyawan'  => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                ],
            ]);
            $this->forge->addKey('karyawan_id', true);
            $this->forge->createTable('karyawan');
        }
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
