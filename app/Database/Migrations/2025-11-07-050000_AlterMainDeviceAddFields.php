<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterMainDeviceAddFields extends Migration
{
    public function up()
    {
        // Rename 'lisensi' to 'lisensi_windows'
        $this->forge->modifyColumn('maindevice', [
            'lisensi' => [
                'name' => 'lisensi_windows',
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
        ]);

        // Add new fields
        $this->forge->addColumn('maindevice', [
            'storage' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => true,
            ],
            'office' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => true,
            ],
            'lisensi_office' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // Remove new fields
        $this->forge->dropColumn('maindevice', ['storage', 'office', 'lisensi_office']);

        // Rename back 'lisensi_windows' to 'lisensi'
        $this->forge->modifyColumn('maindevice', [
            'lisensi_windows' => [
                'name' => 'lisensi',
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
        ]);
    }
}
