<?php

namespace App\Controllers;


class Auth extends BaseController
{

    public function index()
    {
        return redirect()->to(site_url('login'));
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
        $query = $this->db->table('users')->getWhere(['email_users' => $post['email']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($post['password'], $user->password_users)) {
                $params = ['id_users' => $user->id_users];
                session()->set($params);
                $user = $query;
                return redirect()->to(site_url('Home'));
            } else {
                session()->setFlashdata('email_users', $post['email']);
                return redirect()->back()->withInput()->with('error', 'password incorrect');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'kamu ga diajak :(');
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
    public function prank()
    {
        return view('auth/prank');
    }
}
