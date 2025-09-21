<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita'; // Nama tabel
    protected $primaryKey = 'id_berita'; // Nama kolom primary key
    protected $allowedFields = [
        'id_berita',
        'id_admin',
        'judul',
        'konten',
        'foto',
        'status',
        'tanggal',
        'slug'
    ];

    public function getAllBerita($keyword = null)
    {
        $builder = $this->db->table('berita')
            ->select('berita.id_berita, berita.judul, berita.slug, berita.status, berita.tanggal, 
                  COALESCE(admin.nama) as penulis')
            ->join('admin', 'admin.id_admin = berita.id_admin', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('berita.judul', $keyword)
                ->orLike('admin.nama', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function getDetailBeritaBySlug($slug)
    {
        return $this->select('berita.*, COALESCE(admin.nama) as penulis')
            ->join('admin', 'admin.id_admin = berita.id_admin', 'left')
            ->where('berita.slug', $slug)
            ->first();
    }

    public function getBeritaTerbit()
    {
        return $this->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function countBeritaTerbit()
    {
        return $this->where('status', 'Terbit')->countAllResults();
    }

    public function searchBeritaTerbit($keyword)
    {
        return $this->like('judul', $keyword)
            ->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function getDetailById($id)
    {
        return $this->where('id_berita', $id)->first();
    }

    public function getDetailBySlug($slug)
    {
        return $this->where('slug', $slug)->first(); // Misalkan Anda memiliki kolom slug dalam tabel berita
    }
}
