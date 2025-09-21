<?php

namespace App\Models;

use CodeIgniter\Model;

class PmikModel extends Model
{
    protected $table = 'pmik';
    protected $primaryKey = 'id_pmik';
    protected $allowedFields = [
        'id_pendaftaran',
        'prakarsa',
        'motivasi',
        'inovasi',
        'kreativitas'
    ];
}
