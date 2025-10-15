<?php

namespace App\Controllers;

use App\Libraries\zklibrary;

class Absensi extends BaseController
{
    public function index()
    {
        return view('absensi/v_forgetuserfp');
    }
    // public function datauser()
    // {
    //     $zk = new ZKLibrary('192.168.1.13', 4370);
    //     $zk->connect();
    //     $zk->disableDevice();
    //     $users = $zk->getUser();
    //     $batchData = [];
    //     foreach ($users as $user) {
    //         $batchData[] = [
    //             'ID' => $user[0],
    //             'Name' => $user[1],
    //             'Role' => $user[2],
    //             'Password' => $user[3]
    //         ];
    //     }
    //     $this->db->table('usersfp')->emptyTable();
    //     $this->db->table('usersfp')->insertBatch($batchData);
    //     $zk->enableDevice();
    //     $zk->disconnect();
    //     return view(
    //         'absensi/v_userfp',
    //         ['users' => $users]
    //     );
    // }
    public function datauser()
    {
        try {
            $zk = new ZKLibrary('192.168.1.13', 4370);
            $zk->connect();
            $zk->disableDevice();
            $users = $zk->getUser();

            if (!$users) {
                throw new \Exception('Tidak dapat mengambil data pengguna dari perangkat.');
            }

            $batchData = [];
            foreach ($users as $user) {
                $batchData[] = [
                    'ID' => $user[0],
                    'Name' => $user[1],
                    'Role' => $user[2],
                    'Password' => $user[3]
                ];
            }

            if (empty($batchData)) {
                throw new \Exception('Tidak ada data pengguna yang ditemukan.');
            }

            $this->db->table('usersfp')->emptyTable();
            $this->db->table('usersfp')->insertBatch($batchData);

            $zk->enableDevice();
            $zk->disconnect();

            return view('absensi/v_userfp', ['users' => $users]);
        } catch (\Exception $e) {
            return view('exception/406');
        }
    }

    // public function datauser()
    // {
    //     $zk = new ZKLibrary('192.168.1.13', 4370);
    //     try {
    //         $zk->connect();
    //         $zk->disableDevice();
    //         // Check if the connection was successful
    //         if (method_exists($zk, 'isConnected') && $zk->isConnected()) {
    //             $users = $zk->getUser();
    //             $batchData = [];

    //             foreach ($users as $user) {
    //                 $batchData[] = [
    //                     'ID' => $user[0],
    //                     'Name' => $user[1],
    //                     'Role' => $user[2],
    //                     'Password' => $user[3]
    //                 ];
    //             }
    //             if ($this->db->tableExists('usersfp')) {
    //                 $this->db->table('usersfp')->emptyTable();
    //                 try {
    //                     $this->db->table('usersfp')->insertBatch($batchData);
    //                 } catch (Exception $e) {
    //                     return view('exception/406');
    //                     exit;
    //                 }
    //             }
    //             $zk->enableDevice();
    //             $zk->disconnect();
    //             return view(
    //                 'absensi/v_userfp',
    //                 ['users' => $users]
    //             );
    //         } else {
    //             return view('exception/503');
    //         }
    //     } catch (Exception $e) {
    //         return view('exception/406');
    //         exit;
    //     }
    // }
    // public function attendance()
    // {
    //     $zk = new ZKLibrary('192.168.1.13', 4370);
    //     try {
    //         $zk->connect();
    //         $zk->disableDevice();
    //         // Check if the connection was successful
    //         if (method_exists($zk, 'isConnected') && $zk->isConnected()) {
    //             $data['absen'] = $zk->getAttendance();
    //             // Prepare batch data for insertion
    //             $batchData = [];
    //             foreach ($data['absen'] as $absen) {
    //                 $batchData[] = [
    //                     'UserID' => $absen['UserID'],
    //                     'CheckTime' => $absen['CheckTime'],
    //                     'CheckType' => $absen['CheckType']
    //                 ];
    //             }
    //             // Handle any exceptions during insertion
    //             try {
    //                 $this->db->table('attendancefp')->insertBatch($batchData);
    //             } catch (Exception $e) {
    //                 // Redirect to the problem page
    //                 return view('exception/406');
    //                 exit;
    //             }
    //             $zk->enableDevice();
    //             $zk->disconnect();
    //             return view('absensi/v_absensi_staff', $data);
    //         } else {
    //             // Handle connection error
    //             return view('exception/503');
    //         }
    //     } catch (Exception $e) {
    //         // Redirect to the problem page
    //         return view('exception/406');
    //         exit;
    //     }
    // }

    // public function attendance()
    // {
    //     $zk = new ZKLibrary('192.168.1.13', 4370);
    //     try {
    //         $zk->connect();
    //         $zk->disableDevice();

    //         // Check if the connection was successful
    //         if (method_exists($zk, 'isConnected') && $zk->isConnected()) {
    //             $data['absen'] = $zk->getAttendance();

    //             // Check if the table exists before emptying it
    //             if ($this->db->tableExists('attendancefp')) {
    //                 $this->db->table('attendancefp')->emptyTable();

    //                 // Prepare batch data for insertion
    //                 $batchData = [];
    //                 foreach ($data['absen'] as $absen) {
    //                     $batchData[] = [
    //                         'UserID' => $absen['UserID'],
    //                         'CheckTime' => $absen['CheckTime'],
    //                         'CheckType' => $absen['CheckType']
    //                     ];
    //                 }

    //                 // Handle any exceptions during insertion
    //                 try {
    //                     $this->db->table('attendancefp')->insertBatch($batchData);
    //                 } catch (Exception $e) {
    //                     // Redirect to the problem page
    //                     return view('exception/406');
    //                     exit;
    //                 }
    //             }
    //             $zk->enableDevice();
    //             $zk->disconnect();

    //             return view('absensi/v_absensi_staff', $data);
    //         } else {
    //             // Handle connection error
    //             return view('exception/503');
    //         }
    //     } catch (Exception $e) {
    //         // Redirect to the problem page
    //         return view('exception/406');
    //         exit;
    //     }
    // }


    public function attendance()
    {
        $builder = $this->db->table('attendancefp');
        $query   = $builder->get()->getResult();
        $zk = new ZKLibrary('192.168.1.13', 4370);
        $zk->connect();
        $zk->disableDevice();
        $data['absen'] = $zk->getAttendance();
        return view('absensi/v_absensi_staff', $data);
        $zk->enableDevice();
        $zk->disconnect();
    }
}
