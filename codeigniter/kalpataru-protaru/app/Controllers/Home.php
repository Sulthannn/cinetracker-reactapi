<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use App\Models\PublikasiModel;
use App\Models\BeritaModel;
use App\Models\VideoModel;
use App\Models\PamfletModel;
use App\Models\VisitorModel;
use App\Models\CapaianModel;

helper('text');

class Home extends BaseController
{
    public function index(): string
    {
        $publikasiModel = new PublikasiModel();
        $BeritaModel = new BeritaModel();
        $VideoModel = new VideoModel();
        $pamfletModel = new PamfletModel();
        $VisitorModel = new VisitorModel();
        $capaianModel = new CapaianModel();
        $arsipModel = new ArsipModel();

        $totalPerempuan = $arsipModel->genderPerempuan();
        $totalLakiLaki = $arsipModel->genderLakiLaki();
        $total = $totalPerempuan + $totalLakiLaki;

        // Ambil data pengunjung hari ini
        $today = date('Y-m-d');
        $visitorToday = $VisitorModel->where('visit_date', $today)->get()->getRow();
        $visitorCountToday = $visitorToday ? $visitorToday->count : 0;

        // Ambil data pengunjung dalam 7 hari terakhir
        $oneWeekAgo = date('Y-m-d', strtotime('-7 days'));
        $visitorCountWeekly = $VisitorModel
            ->selectSum('count', 'weekly_total')
            ->where('visit_date >=', $oneWeekAgo)
            ->where('visit_date <=', $today)
            ->get()
            ->getRow()
            ->weekly_total;

        // Ambil data pengunjung dalam 30 hari terakhir (bulanan)
        $oneMonthAgo = date('Y-m-d', strtotime('-30 days'));
        $visitorCountMonthly = $VisitorModel
            ->selectSum('count', 'monthly_total')
            ->where('visit_date >=', $oneMonthAgo)
            ->where('visit_date <=', $today)
            ->get()
            ->getRow()
            ->monthly_total;

        $data = [
            'visitorCountToday' => $visitorCountToday,
            'visitorCountWeekly' => $visitorCountWeekly,
            'visitorCountMonthly' => $visitorCountMonthly,
        ];

        // Mendapatkan berita dengan status "terbit"
        $berita = $BeritaModel->where('status', 'Terbit')->findAll();
        $video = $VideoModel->where('status', 'Terbit')->findAll();
        $pamflet = $pamfletModel->where('status', 'Aktif')->first();
        $capaian = $capaianModel->where('status', 'Aktif')->first();
        // $data['capaian'] = $capaianModel->where('status', 'Aktif')->findAll();

        $data['video'] = $video;
        $data['berita'] = $berita;
        $data['pamflet'] = $pamflet;
        $data['capaian'] = $capaian;
        $data['peta'] = $publikasiModel->tampilPetaPenerima();
        $data['kategoriData'] = $arsipModel->dataKategori();
        $data['totalPerempuan'] = $totalPerempuan;
        $data['totalLakiLaki'] = $totalLakiLaki;
        $data['temaData'] = $arsipModel->dataByTema();
        $data['total'] = $total;
        $data['title'] = "Kalpataru – Penghargaan Lingkungan Hidup Indonesia";

        return view('landingpage', $data);
    }
}
