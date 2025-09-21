<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel'; // Nama tabel
    protected $primaryKey = 'id_artikel'; // Nama kolom primary key
    protected $allowedFields = [
        'id_artikel',
        'id_admin',
        'id_penerima',
        'id_pengusul',
        'judul',
        'konten',
        'foto',
        'status',
        'tanggal',
        'slug',
        'catatan',
    ];

    public function getAllArtikel($keyword = null)
    {
        $builder = $this->db->table('artikel')
            ->select('artikel.id_artikel, artikel.judul, artikel.slug, artikel.status, artikel.tanggal, 
                  COALESCE(admin.nama, pengusul.nama_instansi_pribadi, penerima.nama) as penulis')
            ->join('admin', 'admin.id_admin = artikel.id_admin', 'left')
            ->join('pengusul', 'pengusul.id_pengusul = artikel.id_pengusul', 'left')
            ->join('penerima', 'penerima.id_penerima = artikel.id_penerima', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('artikel.judul', $keyword)
                ->orLike('admin.nama', $keyword)
                ->orLike('pengusul.nama_instansi_pribadi', $keyword)
                ->orLike('penerima.nama', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function getDetailArtikelBySlug($slug)
    {
        return $this->select('artikel.*, COALESCE(admin.nama, pengusul.nama_instansi_pribadi, penerima.nama) as penulis')
            ->join('admin', 'admin.id_admin = artikel.id_admin', 'left')
            ->join('pengusul', 'pengusul.id_pengusul = artikel.id_pengusul', 'left')
            ->join('penerima', 'penerima.id_penerima = artikel.id_penerima', 'left')
            ->where('artikel.slug', $slug)
            ->first();
    }

    public function getArtikelTerbit()
    {
        return $this->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function countArtikelTerbit()
    {
        return $this->where('status', 'Terbit')->countAllResults();
    }

    public function searchArtikelTerbit($keyword)
    {
        return $this->like('judul', $keyword)
            ->where('status', 'Terbit')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function getDetailById($id)
    {
        return $this->where('id_artikel', $id)->first();
    }

    public function getDetailBySlug($slug)
    {
        return $this->where('slug', $slug)->first(); // Misalkan Anda memiliki kolom slug dalam tabel artikel
    }
}
