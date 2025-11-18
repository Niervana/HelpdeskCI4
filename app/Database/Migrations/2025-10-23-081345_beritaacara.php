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
            'jenis_kegiatan'   => ['type' => 'VARCHAR', 'constraint' => 150],
            'tanggal'          => ['type' => 'DATETIME'],
            'lokasi'           => ['type' => 'VARCHAR', 'constraint' => 100],
            'pelaksana'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'keterangan'       => ['type' => 'TEXT'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('beritaacara_id', true);
        $this->forge->createTable('berita_acara');
    }

    public function down()
    {
        $this->forge->dropTable('berita_acara');
    }
}
