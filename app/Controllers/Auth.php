<?php

namespace App\Controllers;


class Auth extends BaseController
{

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
    // public function loginProcess()
    // {
    //     $post = $this->request->getPost();
    //     $query = $this->db->table('users')->getWhere(['email_users' => $post['email']]);
    //     $user = $query->getRow();
    //     if ($user) {
    //         if (password_verify($post['password'], $user->password_users)) {
    //             $params = ['id_users' => $user->id_users];
    //             session()->set($params);
    //             $user = $query;
    //             return redirect()->to(site_url('Home'));
    //         } else {
    //             session()->setFlashdata('email_users', $post['email']);
    //             return redirect()->back()->withInput()->with('error', 'password incorrect');
    //         }
    //     } else {
    //         return redirect()->back()->withInput()->with('error', 'kamu ga diajak :(');
    //     }
    // }
    // public function loginProcess()
    // {
    //     $post = $this->request->getPost();
    //     $query = $this->db->table('users')->getWhere(['email_users' => $post['email']]);
    //     $user = $query->getRow();
    //     if ($user) {
    //         if (password_verify($post['password'], $user->password_users)) {
    //             $params = ['id_users' => $user->id_users];
    //             session()->set($params);
    //             return redirect()->to(site_url('Home'));
    //         } else {
    //             session()->setFlashdata('email_users', $post['email']);
    //             session()->setFlashdata(
    //                 'error',
    //                 'Incorrect password'
    //             );
    //             return redirect()->back()->withInput();
    //         }
    //     } else {
    //         session()->setFlashdata('error', 'Incorrect email');
    //         return redirect()->back()->withInput();
    //     }
    // }
    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('users')->getWhere(['email_users' => $post['email']]);
        $user = $query->getRow();

        if ($user) {
            if ($user->role == 1) {
                if (password_verify($post['password'], $user->password_users)) {
                    $params = ['id_users' => $user->id_users];
                    session()->set($params);
                    return redirect()->to(site_url('Home'));
                } else {
                    session()->setFlashdata('email_users', $post['email']);
                    session()->setFlashdata('error', 'Password salah');
                    return redirect()->back()->withInput();
                }
            } else {
                if ($post['password'] === $user->password_users) {
                    $params = ['id_users' => $user->id_users];
                    session()->set($params);
                    return redirect()->to(site_url('Home'));
                } else {
                    session()->setFlashdata('email_users', $post['email']);
                    session()->setFlashdata('error', 'Password salah');
                    return redirect()->back()->withInput();
                }
            }
        } else {
            session()->setFlashdata('error', 'Email salah');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->remove('id_users');
        return redirect()->to(site_url('login'));
    }
    public function forgot()
    {
        return view('auth/forgot');
    }
    public function register()
    {
        return view('auth/register');
    }
    public function verifikasi()
    {
        return view('auth/keterangan');
    }
    public function insertdata()
    {
        $data = $this->request->getPost();
        $this->db->table('users2')->insert($data);
        if ($this->db->affectedRows() > 0) {
            return redirect()->to(site_url('auth/verifikasi'));
        }
    }
}
