<?php

namespace App\Models;

use CodeIgniter\Model;

class DampakModel extends Model
{
    protected $table = 'dampak';
    protected $primaryKey = 'id_dampak';
    protected $allowedFields = [
        'id_pendaftaran',
        'dampak_lingkungan',
        'dampak_ekonomi',
        'dampak_sosial_budaya'
    ];
}
