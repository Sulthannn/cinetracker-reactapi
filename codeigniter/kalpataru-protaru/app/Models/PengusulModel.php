<?php

namespace App\Models;

use CodeIgniter\Model;

class PengusulModel extends Model
{
    protected $table = 'pengusul'; // Nama tabel
    protected $primaryKey = 'id_pengusul'; // Nama kolom primary key
    protected $allowedFields = [
        'id_admin',
        'role_akun',
        'jenis_instansi',
        'nama_instansi_pribadi',
        'instansi',
        'telepon',
        'email',
        'kata_sandi',
        'reset_token',
        'jabatan_pekerjaan',
        'jenis_kelamin',
        'status_akun',
        'jalan',
        'rt_rw',
        'desa',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'kode_pos',
        'surat_pengantar',
        'tambah_usulan'
    ];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function createPengusul($data)
    {
        return $this->insert($data);
    }

    public function getDetailById($id_pengusul)
    {
        return $this->where('id_pengusul', $id_pengusul)->first();
    }
}
