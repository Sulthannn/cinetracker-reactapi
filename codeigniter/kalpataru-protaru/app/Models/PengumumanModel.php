<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman'; // Nama tabel
    protected $primaryKey = 'id_pengumuman'; // Nama kolom primary key
    protected $allowedFields = [
        'id_pengumuman',
        'id_admin',
        'judul',
        'konten',
        'foto',
        'status',
        'tanggal',
        'slug'
    ];

    public function getAllPengumuman($keyword = null)
    {
        $builder = $this->db->table('pengumuman')
            ->select('pengumuman.id_pengumuman, pengumuman.judul, pengumuman.slug, pengumuman.status, pengumuman.tanggal, 
                  COALESCE(admin.nama) as penulis')
            ->join('admin', 'admin.id_admin = pengumuman.id_admin', 'left')
            ->orderBy('pengumuman.tanggal', 'DESC');

        if ($keyword) {
            $builder->groupStart()
                ->like('pengumuman.judul', $keyword)
                ->orLike('admin.nama', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function getDetailPengumumanBySlug($slug)
    {
        return $this->select('pengumuman.*, COALESCE(admin.nama) as penulis')
            ->join('admin', 'admin.id_admin = pengumuman.id_admin', 'left')
            ->where('pengumuman.slug', $slug)
            ->first();
    }

    public function getPengumumanTerbit()
    {
        return $this->where('status', 'Terbit')
        ->orderBy('tanggal', 'DESC')
        ->findAll();
    }

    public function countPengumumanTerbit()
    {
        return $this->where('status', 'Terbit')->countAllResults();
    }

    public function searchPengumumanTerbit($keyword)
    {
        return $this->like('judul', $keyword)
        ->where('status', 'Terbit')
        ->orderBy('tanggal', 'DESC')
        ->findAll();
    }

    public function getDetailById($id)
    {
        return $this->where('id_pengumuman', $id)->first();
    }

    public function getDetailBySlug($slug)
    {
        return $this->where('slug', $slug)->first(); // Misalkan Anda memiliki kolom slug dalam tabel pengumuman
    }
}
