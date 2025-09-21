<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku_kalpataru'; // Nama tabel
    protected $primaryKey = 'id_buku'; // Nama kolom primary key
    protected $allowedFields = [
        'id_buku',
        'id_admin',
        'judul',
        'cover',
        'file',
        'tanggal',
        'status'
    ];

    public function getAllBuku($keyword = null)
    {
        $builder = $this->db->table('buku_kalpataru')
            ->select('buku_kalpataru.id_buku, buku_kalpataru.judul, buku_kalpataru.cover, buku_kalpataru.file, buku_kalpataru.tanggal, buku_kalpataru.status, 
                  COALESCE(admin.nama) as penulis')
            ->join('admin', 'admin.id_admin = buku_kalpataru.id_admin', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('buku_kalpataru.judul', $keyword)
                ->orLike('admin.nama', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function getBukuTerbit()
    {
        return $this->where('status', 'Terbit')->findAll();
    }

    public function countBukuTerbit()
    {
        return $this->where('status', 'Terbit')->countAllResults();
    }

    public function searchBukuTerbit($keyword)
    {
        return $this->like('judul', $keyword)
            ->where('status', 'Terbit')
            ->findAll();
    }

    public function getDetailById($id)
    {
        return $this->where('id_buku', $id)->first();
    }
}
