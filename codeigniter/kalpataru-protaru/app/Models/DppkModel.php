<?php

namespace App\Models;

use CodeIgniter\Model;

class DppkModel extends Model
{
    protected $table = 'dppk';
    protected $primaryKey = 'id_dppk';
    protected $allowedFields = [
        'nama',
        'nip',
        'no_sk',
        'email',
        'kata_sandi',
        'status_akun'
    ];
}
