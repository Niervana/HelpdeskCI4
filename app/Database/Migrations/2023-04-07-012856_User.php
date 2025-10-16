<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_users' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_users' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email_users' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password_users' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'createdat_users' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_users', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
