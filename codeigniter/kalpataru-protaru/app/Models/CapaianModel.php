<?php

namespace App\Models;

use CodeIgniter\Model;

class CapaianModel extends Model
{
    protected $table = 'capaian';
    protected $primaryKey = 'id_capaian';
    protected $allowedFields = ['gambar', 'status'];
}
