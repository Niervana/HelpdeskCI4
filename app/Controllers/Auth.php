<?php

namespace App\Controllers;


class Auth extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return redirect()->to(site_url('auth/login'));
    }
    public function login()
    {
        if (session('id_users')) {
            return redirect()->to(site_url('Home'));
        }
        return view('auth/login');
    }
    public function loginProcess()
    {
        $post = $this->request->getPost();

        // Ambil user berdasarkan email
        $query = $this->db->table('users')->getWhere(['email_users' => $post['email']]);
        $user = $query->getRow();

        if ($user) {
            // Verifikasi password: hash untuk admin (role=1), plain untuk user (role=2)
            $passwordValid = false;
            if ($user->role == 1) {
                $passwordValid = password_verify($post['password'], $user->password_users);
            } elseif ($user->role == 2) {
                $passwordValid = ($post['password'] === $user->password_users);
            }

            if ($passwordValid) {
                $params = ['id_users' => $user->id_users, 'role' => $user->role];
                session()->set($params);
                return redirect()->to(site_url('Home'));
            } else {
                session()->setFlashdata('email_users', $post['email']);
                session()->setFlashdata('error', 'Password salah');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Email tidak ditemukan');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->remove('id_users');
        return redirect()->to(site_url('login'));
    }

    public function register()
    {
        return view('auth/register');
    }

    public function forgot()
    {
        return view('auth/forgot');
    }
    public function insertdata()
    {
        $data = $this->request->getPost();

        // Insert ke users: nama_users, email_users, password_users (plain for role=2), createdat_users, role
        $userData = [
            'nama_users' => $data['nama'],
            'email_users' => $data['email_users'],
            'password_users' => $data['password_users'], // plain text for users
            'createdat_users' => $data['createdat_users'],
            'role' => $data['role'],
        ];
        $this->db->table('users')->insert($userData);
        $userId = $this->db->insertID();

        // Insert ke karyawan: nama_karyawan, departemen_karyawan
        $karyawanData = [
            'nama_karyawan' => $data['nama'],
            'departemen_karyawan' => $data['departemen_karyawan'],
        ];
        $this->db->table('karyawan')->insert($karyawanData);
        $karyawanId = $this->db->insertID();

        // Insert ke inventory: karyawan_id (dengan main_id dan support_id null)
        $inventoryData = [
            'karyawan_id' => $karyawanId,
            'main_id' => null,
            'support_id' => null,
        ];
        $this->db->table('inventory')->insert($inventoryData);

        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('login'));
        }
    }
}
