<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Log extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'log_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'inventory_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // ubah: harus boleh NULL
            ],
            'action_type' => [
                'type'       => 'ENUM',
                'constraint' => ['INSERT', 'UPDATE', 'DELETE'],
                'null'       => false,
            ],
            'before_change' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'after_change' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'users_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // ubah juga ke null untuk keamanan
            ],
            'action_date' => [
                'type'    => 'DATETIME',
                'null'    => false,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('log_id', true);
        // ubah CASCADE ke SET NULL agar log tidak ikut terhapus
        $this->forge->addForeignKey('inventory_id', 'inventory', 'inventory_id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('users_id', 'users', 'id_users', 'SET NULL', 'CASCADE');
        $this->forge->createTable('log');
    }

    public function down()
    {
        $this->forge->dropTable('log');
    }
    //OLD VERSION
    // public function up()
    // {
    //     $this->forge->addField([
    //         'log_id' => [
    //             'type'           => 'INT',
    //             'constraint'     => 11,
    //             'unsigned'       => true,
    //             'auto_increment' => true,
    //         ],
    //         'inventory_id' => [
    //             'type'       => 'INT',
    //             'constraint' => 11,
    //             'unsigned'   => true,
    //             'null'       => false,
    //         ],
    //         'action_type' => [
    //             'type'       => 'ENUM',
    //             'constraint' => ['INSERT', 'UPDATE', 'DELETE'],
    //             'null'       => false,
    //         ],
    //         'before_change' => [
    //             'type' => 'JSON',
    //             'null' => true,
    //         ],
    //         'after_change' => [
    //             'type' => 'JSON',
    //             'null' => true,
    //         ],
    //         'users_id' => [
    //             'type'       => 'INT',
    //             'constraint' => 11,
    //             'unsigned'   => true,
    //             'null'       => false,
    //         ],
    //         'action_date' => [
    //             'type'    => 'DATETIME',
    //             'null'    => false,
    //         'ip_address' => [
    //             'type'       => 'VARCHAR',
    //             'constraint' => 45,
    //             'null'       => true,
    //         ],
    //         'description' => [
    //             'type' => 'TEXT',
    //             'null' => true,
    //         ],
    //     ]);

    //     $this->forge->addKey('log_id', true);
    //     $this->forge->addForeignKey('inventory_id', 'inventory', 'inventory_id', 'CASCADE', 'CASCADE');
    //     $this->forge->addForeignKey('users_id', 'users', 'id_users', 'CASCADE', 'CASCADE');
    //     $this->forge->createTable('log');
    // }

    // public function down()
    // {
    //     $this->forge->dropTable('log');
    // }
}
