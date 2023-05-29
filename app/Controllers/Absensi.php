<?php

namespace App\Controllers;

use App\Libraries\zklibrary;

class Absensi extends BaseController
{
    public function datauser()
    {
        $zk = new ZKLibrary('192.168.1.11', 4370);
        $zk->connect();
        $zk->disableDevice();
        $data['users'] = $zk->getUser();
        // $data['total'] = $zk->getsizeUser()
        return view('absensi/v_userfp', $data);
        $zk->enableDevice();
        $zk->disconnect();
    }
    public function indexstaff()
    {
        $builder = $this->db->table('attendance');
        $query   = $builder->get()->getResult();
        $zk = new ZKLibrary('192.168.1.11', 4370);
        $zk->connect();
        $zk->disableDevice();
        $data['absen'] = $zk->getAttendance();
        // foreach ($data as $row) {
        //     $id_log = $row['id_log'];
        //     $uid = $row['uid'];
        //     $status_kehadiran = $row['status_kehadiran'];
        //     $time = $row['time'];
        //     $query = $db->table('attendance')->insert([
        //         'id_log', 'uid', 'status_kehadiran', 'time'
        //     ]);
        // }
        return view('absensi/v_absensi_staff', $data);
        $zk->enableDevice();
        $zk->disconnect();
    }
    public function indexoperator()
    {
        return view('absensi/v_absensi_operator');
    }
}
