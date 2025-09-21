<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Nama tabel
    protected $primaryKey = 'id_admin'; // Nama kolom primary key
    protected $allowedFields = [
        'id_admin',
        'nip',
        'nama',
        'no_sk',
        'email',
        'kata_sandi'
    ];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function createPengusul($data)
    {
        return $this->insert($data);
    }
}
