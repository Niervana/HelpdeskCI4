<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id_users";
    protected $allowedFields = ["nama_users", "email_users", "password_users", "createdat_users", "role"];
    protected $useTimestamps = true;
    //protected $createdField = "createdat";
}
