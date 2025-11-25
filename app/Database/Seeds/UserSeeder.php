<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_users'     => 'Nirvana',
                'email_users'    => 'kharismanirvana@gmail.com',
                'password_users' => password_hash('niervana', PASSWORD_BCRYPT),
                'createdat_users' => date("Y-m-d H:i:s"),
                'role'           => 1,
            ],
            [
                'nama_users'     => 'Juki',
                'email_users'    => 'it@willbes.com',
                'password_users' => password_hash('willbesit', PASSWORD_BCRYPT),
                'createdat_users' => date("Y-m-d H:i:s"),
                'role'           => 1,
            ],
            [
                'nama_users'     => 'Guest User',
                'email_users'    => 'guest@nirvana.co.id',
                'password_users' => password_hash('willbesit', PASSWORD_BCRYPT),
                'createdat_users' => date("Y-m-d H:i:s"),
                'role'           => 1,
            ],
            [
                'nama_users'     => 'Test User',
                'email_users'    => 'test@mail.com',
                'password_users' => password_hash('testpass', PASSWORD_BCRYPT),
                'createdat_users' => date("Y-m-d H:i:s"),
                'role'           => 2,
            ],
        ];

        foreach ($data as $user) {
            $this->db->table('users')->insert($user);
        }
    }
}
