<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class tiket extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tiket_id'      => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'karyawan_id'   => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jenis_tiket'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'desk_tiket'    => ['type' => 'TEXT'],
            'status'        => ['type' => 'ENUM', 'constraint' => ['ongoing', 'solved'], 'default' => 'ongoing'],
            'create_date'   => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('tiket_id', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'karyawan_id');
        $this->forge->createTable('tiket');
    }

    public function down()
    {
        $this->forge->dropTable('tiket');
    }
}
