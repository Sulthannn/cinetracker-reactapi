<?php

namespace App\Models;

use CodeIgniter\Model;

class PublikasiModel extends Model
{
    protected $BeritaTable = 'berita';
    protected $BeritaPrimaryKey = 'id_berita';
    protected $BeritaAllowedFields = ['id_admin', 'judul', 'konten', 'foto', 'tanggal', 'status'];

    public function TampilBerita()
    {
        $berita = $this->db->table($this->BeritaTable)->get()->getResult();
        $total_berita = $this->db->table($this->BeritaTable)->countAllResults();
        return [
            'data_berita' => $berita,
            'total_berita' => $total_berita
        ];
    }

    protected $ArtikelTable = 'artikel';
    protected $ArtikelPrimaryKey = 'id_artikel';
    protected $ArtikelAllowedFields = ['id_penerima', 'judul', 'konten', 'foto', 'tanggal', 'status'];

    public function TampilArtikel()
    {
        $artikel = $this->db->table($this->ArtikelTable)->get()->getResult();
        $total_atikel = $this->db->table($this->ArtikelTable)->countAllResults();
        return [
            'data_artikel' => $artikel,
            'total_artikel' => $total_atikel
        ];
    }

    protected $VideoTable = 'video';
    protected $VideoPrimaryKey = 'id_video';
    protected $VideoAllowedFields = ['link_video', 'judul_video'];

    public function TampilVideo()
    {
        $video = $this->db->table($this->VideoTable)->get()->getResult();
        $total_video = $this->db->table($this->VideoTable)->countAllResults();
        return [
            'data_video' => $video,
            'total_video' => $total_video
        ];
    }

    protected $BukuTable = 'buku_kalpataru';
    protected $BukuPrimaryKey = 'id_buku_kalpataru';
    protected $BukuAllowedFields = ['judul_buku', 'cover_buku', 'tahun_terbit', 'file_buku'];

    public function TampilBuku()
    {
        $buku = $this->db->table($this->BukuTable)->get()->getResult();
        $total_buku = $this->db->table($this->BukuTable)->countAllResults();
        return [
            'data_buku' => $buku,
            'total_buku' => $total_buku
        ];
    }

    public function tampilPetaPenerima()
    {
        $query = $this->db->table('arsip_penerima')
                            ->select('provinsi, COUNT(*) as total')
                            ->groupBy('provinsi')
                            ->get();
        return $query->getResult();
    }
}
