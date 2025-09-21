<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\PengusulModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class DppkController extends BaseController
{
    public function datacalonusulan()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil kategori dari filter
        $kategori = $this->request->getVar('kategori');

        if ($kategori) {
            // Filter data berdasarkan kategori
            $pendaftaranModel->where('kategori', $kategori);
        }

        // Dapatkan data dengan pagination
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;
        $data['title'] = "Data Calon Usulan";

        return view('dppk/datacalonusulan', $data);
    }

    public function detaildatacalonusulan()
    {

        $data['title'] = "Detail Data Calon Usulan";
        return view('dppk/detaildatacalonusulan', ['title' => 'Detail Data Calon Usulan']);
    }

    public function bahansidang1()
    {
        $data['title'] = "Bahan Sidang 1";
        return view('dppk/bahansidang1', ['title' => 'Bahan Sidang 1']);
    }

    public function bahansidang2()
    {
        $data['title'] = "Bahan Sidang 2";
        return view('dppk/bahansidang2', ['title' => 'Bahan Sidang 2']);
    }

    public function exportPDF($kode_registrasi)
    {
        $id_dppk = session()->get('id_dppk');
    
        if (!$id_dppk) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }
    
        $pendaftaranModel = new PendaftaranModel();
        $pengusulModel = new PengusulModel();
    
        $pendaftaranData = $pendaftaranModel->where('kode_registrasi', $kode_registrasi)->first();
    
        if (!$pendaftaranData) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    
        $pengusulData = $pengusulModel->where('id_pengusul', $pendaftaranData['id_pengusul'])->first();
    
        $kegiatan = $pendaftaranModel->getKegiatanByPendaftaranId($pendaftaranData['id_pendaftaran']);
        $pendaftaranData['kegiatan'] = $kegiatan;
    
        $dampak = $pendaftaranModel->db->table('dampak')->where('id_pendaftaran', $pendaftaranData['id_pendaftaran'])->get()->getRowArray();
        $pmik = $pendaftaranModel->db->table('pmik')->where('id_pendaftaran', $pendaftaranData['id_pendaftaran'])->get()->getRowArray();
        $keswadayaan = $pendaftaranModel->db->table('keswadayaan')->where('id_pendaftaran', $pendaftaranData['id_pendaftaran'])->get()->getRowArray();
        $keistimewaan = $pendaftaranModel->db->table('keistimewaan')->where('id_pendaftaran', $pendaftaranData['id_pendaftaran'])->get()->getRowArray();
    
        $data = [
            'pendaftaran' => $pendaftaranData,
            'pengusul' => $pengusulData,
            'kegiatan' => $kegiatan,
            'dampak' => $dampak,
            'pmik' => $pmik,
            'keswadayaan' => $keswadayaan,
            'keistimewaan' => $keistimewaan
        ];
    
        $kategori = $pendaftaranData['kategori'];
        switch ($kategori) {
            case 'Perintis Lingkungan':
                $prefix = 'A';
                break;
            case 'Pengabdi Lingkungan':
                $prefix = 'B';
                break;
            case 'Penyelamat Lingkungan':
                $prefix = 'C';
                break;
            case 'Pembina Lingkungan':
                $prefix = 'D';
                break;
            default:
                $prefix = 'X';
        }
    
        session()->set('prefix', $prefix);
    
        $html = view('dppk/pdf', $data);
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultPaperSize', 'A4');
        $options->set('defaultPaperOrientation', 'portrait');
        $options->set('dpi', 150);
        $options->set('enable_php', false);
        $options->set('enable_javascript', true);
        $options->set('enable_html5_parser', true);
    
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        $namaFile = 'Formulir_' . esc($pendaftaranData['nama']) . '_' . esc($pendaftaranData['kategori']) . '.pdf';
    
        $dompdf->stream($namaFile, ['Attachment' => true]);
    }
}
