<?php

namespace App\Models;

use CodeIgniter\Model;

class PamfletModel extends Model
{
    protected $table = 'flayer';
    protected $primaryKey = 'id_flayer';
    protected $allowedFields = [
        'foto',
        'status',
    ];  
}