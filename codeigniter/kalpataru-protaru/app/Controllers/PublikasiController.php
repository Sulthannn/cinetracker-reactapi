<?php

namespace App\Controllers;

use App\Models\PublikasiModel;
use App\Models\ArtikelModel;
use App\Models\BeritaModel;
use App\Models\BukuModel;
use App\Models\VideoModel;

helper('text');

class PublikasiController extends BaseController
{
    public function berita()
    {
        $model = new BeritaModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        $keyword = $this->request->getGet('search');

        if ($keyword) {
            // Jika ada pencarian, ambil berita yang sesuai dengan judul dan statusnya "Terbit" dengan pagination
            $data['beritas'] = $model->where('status', 'Terbit')
                ->like('judul', $keyword) // Cari berdasarkan judul
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'beritas'); // Paginate hasil pencarian
            $countTerbit = $model->where('status', 'Terbit')
                ->like('judul', $keyword) // Hitung hanya yang cocok dengan pencarian
                ->countAllResults(); // Hitung jumlah berita hasil pencarian
            $data['pager'] = $model->pager; // Tidak ada pagination jika ada pencarian
        } else {
            // Jika tidak ada pencarian, ambil berita yang statusnya "Terbit" dengan pagination
            $data['beritas'] = $model->where('status', 'Terbit')
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'beritas');
            $countTerbit = $model->where('status', 'Terbit')->countAllResults(); // Hanya hitung artikel yang berstatus "Terbit"
            $data['pager'] = $model->pager; // Hanya tetapkan pager jika menggunakan paginate
        }

        // Siapkan data untuk dikirim ke view
        $data['keyword'] = $keyword;
        $data['countTerbit'] = $countTerbit;
        $data['title'] = "Berita – Kalpataru | Penghargaan Lingkungan Hidup Indonesia";

        return view('berita', $data);
    }

    public function detailberita($slug)
    {
        $model = new BeritaModel();
        $berita = $model->getDetailBeritaBySlug($slug);


        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }

        if ($berita['status'] !== 'Terbit') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }

        $data = [
            'title' => $berita['judul'],
            'berita' => $berita,
        ];
        return view('detailberita', $data);
        return view('berita', $data);
    }

    public function artikel()
    {
        $model = new ArtikelModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil keyword dari input search
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            // Jika ada pencarian, ambil artikel yang sesuai dengan judul dan statusnya "Terbit" dengan pagination
            $data['artikels'] = $model->where('status', 'Terbit')
                ->like('judul', $keyword) // Cari berdasarkan judul
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'artikels'); // Paginate hasil pencarian
            $countTerbit = $model->where('status', 'Terbit')
                ->like('judul', $keyword) // Hitung hanya yang cocok dengan pencarian
                ->countAllResults(); // Hitung jumlah artikel hasil pencarian
            $data['pager'] = $model->pager; // Tidak ada pagination jika ada pencarian
        } else {
            // Jika tidak ada pencarian, ambil artikel yang statusnya "Terbit" dengan pagination
            $data['artikels'] = $model->where('status', 'Terbit')
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'artikels');
            $countTerbit = $model->where('status', 'Terbit')->countAllResults(); // Hanya hitung artikel yang berstatus "Terbit"
            $data['pager'] = $model->pager; // Hanya tetapkan pager jika menggunakan paginate
        }

        // Siapkan data untuk dikirim ke view
        $data['keyword'] = $keyword;
        $data['countTerbit'] = $countTerbit;
        $data['title'] = "Artikel – Kalpataru | Penghargaan Lingkungan Hidup Indonesia";

        return view('artikel', $data);
    }

    public function detailartikel($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->getDetailArtikelBySlug($slug);


        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Artikel tidak ditemukan');
        }

        // Jika artikel masih ditangguhkan
        if ($artikel['status'] !== 'Terbit') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Artikel tidak ditemukan');
        }

        $data = [
            'title' => $artikel['judul'],
            'artikel' => $artikel,
        ];
        return view('detailartikel', $data);
    }

    public function video()
    {
        $model = new VideoModel();
        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 6;

        // Ambil keyword dari input search
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            // Jika ada pencarian, ambil video yang sesuai dengan judul_video dan statusnya "Terbit" dengan pagination
            $data['videos'] = $model->where('status', 'Terbit')
                ->like('judul_video', $keyword) // Cari berdasarkan judul_video
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'videos'); // Paginate hasil pencarian
            $countTerbit = $model->where('status', 'Terbit')
                ->like('judul_video', $keyword) // Hitung hanya yang cocok dengan pencarian
                ->countAllResults(); // Hitung jumlah video hasil pencarian
            $data['pager'] = $model->pager; // Tidak ada pagination jika ada pencarian
        } else {
            // Jika tidak ada pencarian, ambil video yang statusnya "Terbit" dengan pagination
            $data['videos'] = $model->where('status', 'Terbit')
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'videos');
            $countTerbit = $model->where('status', 'Terbit')->countAllResults(); // Hanya hitung video yang berstatus "Terbit"
            $data['pager'] = $model->pager; // Hanya tetapkan pager jika menggunakan paginate
        }

        // Siapkan data untuk dikirim ke view
        $data['keyword'] = $keyword;
        $data['countTerbit'] = $countTerbit;
        $data['title'] = "Video Admin";

        return view('video', $data);
    }

    public function buku()
    {
        $model = new BukuModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 8;

        // Ambil keyword dari input search
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            // Jika ada pencarian, ambil buku yang sesuai dengan judul dan statusnya "Terbit" dengan pagination
            $data['bukus'] = $model->where('status', 'Terbit')
                ->like('judul', $keyword) // Cari berdasarkan judul
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'bukus'); // Paginate hasil pencarian
            $countTerbit = $model->where('status', 'Terbit')
                ->like('judul', $keyword) // Hitung hanya yang cocok dengan pencarian
                ->countAllResults(); // Hitung jumlah buku hasil pencarian
            $data['pager'] = $model->pager; // Tidak ada pagination jika ada pencarian
        } else {
            // Jika tidak ada pencarian, ambil buku yang statusnya "Terbit" dengan pagination
            $data['bukus'] = $model->where('status', 'Terbit')
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'bukus');
            $countTerbit = $model->where('status', 'Terbit')->countAllResults(); // Hanya hitung artikel yang berstatus "Terbit"
            $data['pager'] = $model->pager; // Hanya tetapkan pager jika menggunakan paginate
        }

        // Siapkan data untuk dikirim ke view
        $data['keyword'] = $keyword;
        $data['countTerbit'] = $countTerbit;
        $data['title'] = "Buku";
        return view('buku', $data);
    }

    public function detailBuku($id_buku)
    {
        $model = new BukuModel();
        $buku = $model->find($id_buku);

        if (!$buku) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('buku tidak ditemukan');
        }

        if ($buku['status'] !== 'Terbit') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('buku tidak ditemukan');
        }

        $data = [
            'title' => $buku['judul'],
            'buku' => $buku,
        ];
        return view('detail-buku', $data);
    }

    public function da()
    {
        $PublikasiModel = new PublikasiModel();
        $BukuData = $PublikasiModel->TampilBuku();

        $data['buku'] = $BukuData['data_buku'];
        $data['total_buku'] = $BukuData['total_buku'];

        $data['title'] = "Buku";
        return view('buku', $data, ['title' => 'Buku']);
    }
}
