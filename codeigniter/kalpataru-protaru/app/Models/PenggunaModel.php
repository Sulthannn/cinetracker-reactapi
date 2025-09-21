<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $allowedFields = ['nama', 'email', 'password', 'verifikasi_kode', 'status', 'reset_token'];

    // Method untuk membuat pengguna baru
    public function createUser($data)
    {
        return $this->insert($data);
    }

    // Method untuk mencari pengguna berdasarkan email
    public function findUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function verifyUser($email, $kode_verifikasi)
    {
        // Cek apakah email dan kode verifikasi cocok di database
        return $this->where('email', $email)
            ->where('verifikasi_kode', $kode_verifikasi)
            ->where('status', 'pending')
            ->first() !== null; // Mengembalikan true jika ada pengguna yang cocok
    }

    public function updateStatus($email, $status)
    {
        return $this->where('email', $email)
            ->set(['status' => $status])
            ->update();
    }
}
