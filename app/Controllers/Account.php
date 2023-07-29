<?php

namespace App\Controllers;



class Account extends BaseController
{

    public function index()
    {
        $builder = $this->db->table('users');
        $builder2 = $this->db->table('users2');
        $query = $builder->get()->getResult();
        $query2 = $builder2->get()->getResult();
        $data['users'] = $query;
        $data['users2'] = $query2;
        return view('account/v_getaccount', $data);
    }
    public function add()
    {
        return view('auth/register');
    }

    public function delete($id)
    {
        $this->db->table('users2')->where(['id_users2' => $id])->delete();
        if ($user['is_superadmin']) {
            // Tampilkan pesan kesalahan bahwa penghapusan superadmin tidak diizinkan
            echo "Superadmin cannot be deleted.";
        } else {
            // Lanjutkan dengan operasi penghapusan pengguna
            $this->user_model->delete_user($user_id);
            echo "User deleted successfully.";
        }
        return redirect()->to(site_url('account'))->with('success', 'Data Berhasil Dihapus');
    }
    public function move($id)
    {
        $data = $this->db->table('users2')->select('*')->where(['id_users2' => $id])->get()->getRowArray();
        if ($data) {
            unset($data['id_users']); // Exclude id_users column
            unset($data['id_users2']); // Exclude id_users2 column
            // Insert the data into table 2
            $this->db->table('users')->insert($data);
            // Delete the data from table 1
            $this->db->table('users2')->where(['id_users2' => $id])->delete();
            return redirect()->to(site_url('account'))->with('success', 'Data Berhasil Dipindahkan');
        } else {
            return redirect()->to(site_url('account'))->with('failed', 'Data Gagal Dipindahkan');
        }
    }
}
