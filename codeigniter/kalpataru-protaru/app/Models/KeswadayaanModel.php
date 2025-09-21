<?php

namespace App\Models;

use CodeIgniter\Model;

class KeswadayaanModel extends Model
{
    protected $table = 'keswadayaan';
    protected $primaryKey = 'id_keswadayaan';
    protected $allowedFields = [
        'id_pendaftaran',
        'sumber_biaya',
        'teknologi_kegiatan',
        'status_lahan_kegiatan',
        'jumlah_kelompok_serupa'
    ];
}
