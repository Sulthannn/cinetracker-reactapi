<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'video'; // Nama tabel
    protected $primaryKey = 'id_video'; // Nama kolom primary key
    protected $allowedFields = [
        'id_video',
        'link_video',
        'judul_video',
        'status',
        'tanggal',
    ];

    public function getVideoTerbit()
    {
        return $this->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function countVideoTerbit()
    {
        return $this->where('status', 'Terbit')->countAllResults();
    }

    public function searchVideoTerbit($keyword)
    {
        return $this->like('judul', $keyword)
            ->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }
}
