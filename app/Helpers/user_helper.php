<?php


function userLogin()
{
    $db = \Config\Database::connect();
    $user = $db->table('users')->where('id_users', session('id_users'))->get()->getRow();
    return $user ?: null;
}
