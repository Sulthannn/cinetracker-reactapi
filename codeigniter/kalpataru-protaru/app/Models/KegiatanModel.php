<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table = 'kegiatan'; // Nama tabel
    protected $primaryKey = 'id_kegiatan'; // Nama kolom primary key
    protected $allowedFields = [
        'id_pendaftaran',
        'tema',
        'sub_tema',
        'bentuk_kegiatan',
        'tahun_mulai',
        'deskripsi_kegiatan',
        'lokasi_kegiatan',
        'koordinat',
        'pihak_dan_peran',
        'keberhasilan',
        'tipe_kegiatan'
    ];

    public function findByPendaftaranId($id_pendaftaran) 
    {
        return $this->where('id_pendaftaran', $id_pendaftaran)->first();
    }
    

}
