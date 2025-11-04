<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class beritaacara extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'beritaacara_id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'karyawan_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'inventory_id'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jenis_kegiatan'   => ['type' => 'VARCHAR', 'constraint' => 150],
            'tanggal'          => ['type' => 'DATETIME'],
            'keterangan'       => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('beritaacara_id', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'karyawan_id');
        $this->forge->addForeignKey('inventory_id', 'inventory', 'inventory_id');
        $this->forge->createTable('berita_acara');
    }

    public function down()
    {
        $this->forge->dropTable('berita_acara');
    }
}
