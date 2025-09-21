<?php

namespace App\Models;

use CodeIgniter\Model;

class TimteknisModel extends Model
{
    protected $table = 'tim_teknis';
    protected $primaryKey = 'id_tim_teknis';
    protected $allowedFields = [
        'nama',
        'nip',
        'no_sk',
        'email',
        'kata_sandi',
        'status_akun'
    ];
}
