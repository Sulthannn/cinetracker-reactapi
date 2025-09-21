<?php

namespace App\Models;

use CodeIgniter\Model;

class PeraturanModel extends Model
{
    protected $table = 'panduan_kebijakan'; // Nama tabel
    protected $primaryKey = 'id_peraturan'; // Nama kolom primary key
    protected $allowedFields = [
        'id_peraturan',
        'id_admin',
        'tentang',
        'file',
        'judul',
        'jenis',
        'tanggal',
        'status'
    ];

    public function getAllPeraturan($keyword = null)
    {
        $builder = $this->db->table('panduan_kebijakan')
            ->select('panduan_kebijakan.id_peraturan, panduan_kebijakan.judul, panduan_kebijakan.tentang, panduan_kebijakan.status, panduan_kebijakan.file, panduan_kebijakan.jenis, panduan_kebijakan.tanggal, 
                  COALESCE(admin.nama) as penulis')
            ->join('admin', 'admin.id_admin = panduan_kebijakan.id_admin', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('panduan_kebijakan.judul', $keyword)
                ->orLike('admin.nama', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function getPeraturanTerbit()
    {
        return $this->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function countPeraturanTerbit()
    {
        return $this->where('status', 'Terbit')->countAllResults();
    }

    public function searchPeraturanTerbit($keyword)
    {
        return $this->like('judul', $keyword)
            ->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function getDetailById($id)
    {
        return $this->where('id_peraturan', $id)->first();
    }
}
