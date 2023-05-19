<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_users' => 'Nirvana',
            'email_users' => 'kharismanirvana@gmail.com',
            'password_users' => password_hash('niervana', PASSWORD_BCRYPT),
            'id_karyawan' => '2166',
            'createdat_users' => date("Y-m-d H:i:s"),
        ];
        $this->db->table('users')->insert($data);
    }
}
