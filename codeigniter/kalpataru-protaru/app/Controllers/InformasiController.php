<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use App\Models\InformasiModel;
use App\Models\PengumumanModel;
use App\Models\PeraturanModel;

helper('text');

class InformasiController extends BaseController
{
    // public function pengumuman(): string
    // {
    //     $InformasiModel = new InformasiModel();
    //     $pengumumanData = $InformasiModel->TampilPengumuman();

    //     $data['pengumuman'] = $pengumumanData['data_pengumuman'];
    //     $data['total_pengumuman'] = $pengumumanData['total_pengumuman'];

    //     $data['title'] = 'Pengumuman';
    //     return view('pengumuman', $data, ['title' => 'Pengumuman']);
    // }

    public function pengumuman()
    {
        $model = new PengumumanModel();

        // Set jumlah item per halaman
        $perPage = 5;

        // Ambil keyword dari query string (input search)
        $keyword = $this->request->getGet('search');

        // Jika ada pencarian, filter berdasarkan judul dan status "Terbit"
        if ($keyword) {
            $pengumumansQuery = $model->where('status', 'Terbit')
                ->like('judul', $keyword);

            // Dapatkan hasil pencarian dengan pagination
            $data['pengumumans'] = $pengumumansQuery
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'pengumumans');

            // Reset query sebelum menghitung total hasil pencarian
            $countTerbit = $pengumumansQuery
                ->resetQuery()
                ->where('status', 'Terbit')
                ->like('judul', $keyword)
                ->countAllResults();

            $data['pager'] = $model->pager;
        } else {
            // Jika tidak ada pencarian, ambil semua pengumuman yang statusnya "Terbit" dengan pagination
            $data['pengumumans'] = $model->where('status', 'Terbit')
                ->orderBy('tanggal', 'DESC')
                ->paginate($perPage, 'pengumumans');

            // Hitung total pengumuman yang statusnya "Terbit"
            $countTerbit = $model->where('status', 'Terbit')
                ->countAllResults();

            $data['pager'] = $model->pager;
        }

        // Siapkan data untuk dikirim ke view
        $data['keyword'] = $keyword;
        $data['countTerbit'] = $countTerbit;
        $data['title'] = 'Pengumuman';

        // Render view pengumuman
        return view('pengumuman', $data);
    }

    public function detailpengumuman($slug)
    {
        $model = new PengumumanModel();
        $pengumuman = $model->getDetailPengumumanBySlug($slug);


        if (!$pengumuman) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pengumuman tidak ditemukan');
        }

        // Jika artikel masih ditangguhkan
        if ($pengumuman['status'] !== 'Terbit') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pengumuman tidak ditemukan');
        }

        $data = [
            'title' => $pengumuman['judul'],
            'pengumuman' => $pengumuman,
        ];
        return view('detailpengumuman', $data);
    }

    public function peraturan()
    {
        $model = new PeraturanModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil keyword dari input search
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            // Jika ada pencarian, ambil peraturan yang sesuai dengan judul, tentang, atau jenis dan statusnya "Terbit" dengan pagination
            $data['peraturans'] = $model->where('status', 'Terbit')
                ->groupStart() // Mulai grup kondisi pencarian
                ->like('judul', $keyword) // Cari berdasarkan judul
                ->orLike('tentang', $keyword) // Cari berdasarkan tentang
                ->orLike('jenis', $keyword) // Cari berdasarkan jenis
                ->groupEnd() // Akhiri grup kondisi pencarian
                ->paginate($perPage, 'peraturans'); // Paginate hasil pencarian

            $countTerbit = $model->where('status', 'Terbit')
                ->groupStart() // Grup pencarian yang sama untuk menghitung jumlah hasil
                ->like('judul', $keyword)
                ->orLike('tentang', $keyword)
                ->orLike('jenis', $keyword)
                ->groupEnd()
                ->countAllResults(); // Hitung jumlah peraturan hasil pencarian

            $data['pager'] = $model->pager; // Tidak ada pagination jika ada pencarian
        } else {
            // Jika tidak ada pencarian, ambil peraturan yang statusnya "Terbit" dengan pagination
            $data['peraturans'] = $model->where('status', 'Terbit')
                ->paginate($perPage, 'peraturans');
            $countTerbit = $model->where('status', 'Terbit')->countAllResults(); // Hanya hitung peraturan yang berstatus "Terbit"
            $data['pager'] = $model->pager; // Hanya tetapkan pager jika menggunakan paginate
        }

        // Siapkan data untuk dikirim ke view
        $data['keyword'] = $keyword;
        $data['countTerbit'] = $countTerbit;

        $data['title'] = "Peraturan dan Kebijakan";
        return view('peraturankebijakan', $data);
    }

    public function peraturankebijakan()
    {
        $InformasiModel = new InformasiModel();
        $peraturankebijakanData = $InformasiModel->TampilPeraturanKebijakan();

        $data['peraturankebijakan'] = $peraturankebijakanData['data_peraturankebijakan'];
        $data['total_peraturankebijakan'] = $peraturankebijakanData['total_peraturankebijakan'];

        $data['title'] = 'Peraturan dan Kebijakan';
        return view('peraturankebijakan', $data, ['title' => 'Peraturan dan Kebijakan']);
    }

    public function dataStatistik()
    {
        $model = new ArsipModel();

        // Ambil data filter dari request
        $sortBy = $this->request->getVar('sortBy') ?? 'provinsi'; // Default sort: 'provinsi'
        $order = $this->request->getVar('order') ?? 'asc';        // Default order: 'asc'

        // Validasi nilai sortBy dan order
        $validColumns = ['provinsi', 'perintis', 'pengabdi', 'penyelamat', 'pembina', 'total'];
        if (!in_array($sortBy, $validColumns)) {
            $sortBy = 'provinsi';
        }
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        // Fetch data
        $data['provinsiData'] = $model->dataProvinsi($sortBy, $order);
        $totalPerempuan = $model->genderPerempuan();
        $totalLakiLaki = $model->genderLakiLaki();
        $total = $totalPerempuan + $totalLakiLaki;

        // Hitung persentase
        $persentaseLakiLaki = ($total > 0) ? ($totalLakiLaki / $total) * 100 : 0;

        // Data untuk view
        $data['kategoriData'] = $model->dataKategori();
        $data['total'] = $total;
        $data['totalPerempuan'] = $totalPerempuan;
        $data['totalLakiLaki'] = $totalLakiLaki;
        $data['persentaseLakiLaki'] = $persentaseLakiLaki;
        $data['title'] = 'Data dan Statistik';
        $data['sortBy'] = $sortBy;
        $data['order'] = $order;

        return view('datastatistik', $data);
    }

    public function arsipByProvinsi($provinsi)
    {
        $arsipModel = new ArsipModel();

        $perPage = 5;

        $kategori = $this->request->getVar('kategori');
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        $builder = $arsipModel->table('arsip_penerima');

        if ($kategori) {
            $builder->where('kategori', $kategori);
        }

        if ($keyword) {
            $builder->like('nama', $keyword);
        }

        if ($status) {
            if ($status == 'Lainnya') {
                $builder->whereNotIn('status', ['Aktif', 'Tidak Aktif', 'Meninggal']);
            } else {
                $builder->where('status', $status);
            }
        }

        // Ambil data arsip berdasarkan provinsi
        $arsip = $builder->where('provinsi', $provinsi)->paginate($perPage, 'arsip');
        $data = [
            'provinsi' => rawurldecode($provinsi),
            'pager' => $arsipModel->pager,
            'keyword' => $keyword,
            'kategori' => $kategori,
            'arsipPenerima' => $arsip,
            'status' => $status,
            'title' => 'Data Usulan Provinsi',
        ];
        return view('datausulanprovinsi', $data);
    }

    public function profilPenerima($id_arsip_penerima)
    {
        $arsipModel = new ArsipModel();

        $arsip = $arsipModel->find($id_arsip_penerima);

        if (!$arsip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data penerima tidak ditemukan');
        }

        $data = [
            'title' => $arsip['nama'],
            'arsip' => $arsip,
        ];

        return view('profilpenerima', $data);
    }

    public function detaildataprovinsi()
    {
        $data['title'] = "Detail Data Provinsi";

        return view('detaildataprovinsi', $data);
    }

    public function arsipPerintis()
    {
        $model = new ArsipModel();

        $perPage = 5;

        $keyword = $this->request->getGet('search');
        $builder = $model->where('kategori', 'Perintis Lingkungan');

        if (!empty($keyword)) {
            $builder->like('nama', $keyword);
        }

        $dataPenerima = $builder->paginate($perPage, 'arsip');

        $data = [
            'title' => 'Arsip Penerima Penghargaan Kalpataru Kategori Perintis Lingkungan',
            'keyword' => $keyword,
            'pager' => $model->pager,
            'dataPenerima' => $dataPenerima,
        ];

        return view('arsip-perintis', $data);
    }

    public function arsipPengabdi()
    {
        $model = new ArsipModel();

        $perPage = 5;

        $keyword = $this->request->getGet('search');
        $builder = $model->where('kategori', 'Pengabdi Lingkungan');

        if (!empty($keyword)) {
            $builder->like('nama', $keyword);
        }

        $dataPenerima = $builder->paginate($perPage, 'arsip');

        $data = [
            'title' => 'Arsip Penerima Penghargaan Kalpataru Kategori Pengabdi Lingkungan',
            'keyword' => $keyword,
            'pager' => $model->pager,
            'dataPenerima' => $dataPenerima,
        ];

        return view('arsip-pengabdi', $data);
    }

    public function arsipPenyelamat()
    {
        $model = new ArsipModel();

        $perPage = 5;

        $keyword = $this->request->getGet('search');
        $builder = $model->where('kategori', 'Penyelamat Lingkungan');

        if (!empty($keyword)) {
            $builder->like('nama', $keyword);
        }

        $dataPenerima = $builder->paginate($perPage, 'arsip');

        $data = [
            'title' => 'Arsip Penerima Penghargaan Kalpataru Kategori Penyelamat Lingkungan',
            'keyword' => $keyword,
            'pager' => $model->pager,
            'dataPenerima' => $dataPenerima,
        ];

        return view('arsip-penyelamat', $data);
    }

    public function arsipPembina()
    {
        $model = new ArsipModel();

        $perPage = 5;

        $keyword = $this->request->getGet('search');
        $builder = $model->where('kategori', 'Pembina Lingkungan');

        if (!empty($keyword)) {
            $builder->like('nama', $keyword);
        }

        $dataPenerima = $builder->paginate($perPage, 'arsip');

        $data = [
            'title' => 'Arsip Penerima Penghargaan Kalpataru Kategori Pembina Lingkungan',
            'keyword' => $keyword,
            'pager' => $model->pager,
            'dataPenerima' => $dataPenerima,
        ];

        return view('arsip-pembina', $data);
    }

    public function arsipPenerima()
    {
        $model = new ArsipModel();

        $perPage = 5;

        $keyword = $this->request->getGet('search');
        $builder = $model;

        if (!empty($keyword)) {
            $builder->like('nama', $keyword);
        }

        $dataPenerima = $builder->paginate($perPage, 'arsip');

        $data = [
            'title' => 'Semua Arsip Penerima Penghargaan Kalpataru',
            'keyword' => $keyword,
            'pager' => $model->pager,
            'dataPenerima' => $dataPenerima,
        ];

        return view('arsip-penerima', $data);
    }
}
