<?php

namespace App\Models;

use CodeIgniter\Model;

class KeistimewaanModel extends Model
{
    protected $table = 'keistimewaan'; // Nama tabel
    protected $primaryKey = 'id_keistimewaan'; // Nama kolom primary key
    protected $allowedFields = [
        'id_pendaftaran',
        'keistimewaan', // Periksa jika ini adalah penulisan yang benar
        'penghargaan',
        'foto_kegiatan1',
        'foto_kegiatan2',
        'foto_kegiatan3',
        'foto_kegiatan4',
        'foto_kegiatan5',
        'deskripsi_foto_kegiatan1',
        'deskripsi_foto_kegiatan2',
        'deskripsi_foto_kegiatan3',
        'deskripsi_foto_kegiatan4',
        'deskripsi_foto_kegiatan5',
        'tautan_video',
        'tautan_dokumen_pendukung'
    ];

    // Method untuk mengambil data keistimewaan berdasarkan id_pendaftaran
    public function findByPendaftaranId($id_pendaftaran)
    {
        return $this->where('id_pendaftaran', $id_pendaftaran)->first();
    }
}
