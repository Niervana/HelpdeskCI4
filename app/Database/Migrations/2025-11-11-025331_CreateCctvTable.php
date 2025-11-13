<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCctvTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tipe_kamera' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'merk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'model' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'serial_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive', 'Maintenance'],
                'default' => 'Active',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('cctvs');
    }

    public function down()
    {
        $this->forge->dropTable('cctvs');
    }
}
