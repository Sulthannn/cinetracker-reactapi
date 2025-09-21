<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiModel extends Model
{
    protected $PengumumanTable = 'pengumuman';
    protected $PengumumanPrimaryKey = 'id_pengumuman';
    protected $PengumumanAllowedFields = ['judul', 'konten', 'foto', 'tanggal', 'status'];

    public function TampilPengumuman()
    {
        $pengumuman = $this->db->table($this->PengumumanTable)->get()->getResult();
        $total_pengumuman = $this->db->table($this->PengumumanTable)->countAllResults();
        return [
            'data_pengumuman' => $pengumuman,
            'total_pengumuman' => $total_pengumuman
        ];
    }

    protected $PeraturanKebijakanTable = 'panduan_kebijakan';
    protected $PeraturanKebijakanPrimaryKey = 'id_panduan_kebijakan';
    protected $PeraturanKebijakanAllowedFields = ['tentang', 'judul', 'nama_file'];

    public function TampilPeraturanKebijakan()
    {
        $peraturankebijakan = $this->db->table($this->PeraturanKebijakanTable)->get()->getResult();
        $total_peraturankebijakan = $this->db->table($this->PeraturanKebijakanTable)->countAllResults();
        return [
            'data_peraturankebijakan' => $peraturankebijakan,
            'total_peraturankebijakan' => $total_peraturankebijakan
        ];
    }
}
