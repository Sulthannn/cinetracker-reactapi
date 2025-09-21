<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\PengusulModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class TimteknisController extends BaseController
{
    public function datacalonusulan()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil kategori dari filter
        $kategori = $this->request->getVar('kategori');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        $role = session()->get('role');

        // Jika role adalah pengusul, filter data berdasarkan id_pengusul
        if ($role === 'pengusul') {
            $id_pengusul = session()->get('id_pengusul');
            $pendaftaranModel->where('id_pengusul', $id_pengusul);
        }

        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika kategori dipilih, tambahkan filter kategori
        if ($kategori) {
            $pendaftaranModel->where('kategori', $kategori);
        }

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $usulan = $pendaftaranModel->paginate($perPage, 'usulan');

        // Siapkan data untuk view
        $data = [
            'usulan' => $usulan,
            'pager' => $pendaftaranModel->pager,
            'kategori' => $kategori,
            'keyword' => $keyword,
            'title' => "Data Calon Usulan"
        ];

        return view('timteknis/datacalonusulan', $data);
    }

    public function detaildatacalonusulan($id)
    {
        $model = new PendaftaranModel();
        $userModel = new PengusulModel();  // Asumsikan Anda memiliki model Pengusul untuk mengambil data profil
        $pendaftaran = $model->getDetailById($id);

        // Validasi jika data ditemukan atau tidak
        if (!$pendaftaran) {
            return redirect()->to('timteknis/datacalonusulan')->with('error', 'Data tidak ditemukan.');
        }

        // Ambil data kegiatan utama dan kegiatan tambahan
        $kegiatan_utama = $model->getKegiatanByTipe($id, 'kegiatan_utama');
        $kegiatan_tambahan = $model->getKegiatanByTipe($id, 'kegiatan_tambahan');

        // Cek status pendaftaran, jika "Draft" redirect dengan pesan error
        if ($pendaftaran['status_pendaftaran'] === 'Draft') {
            return redirect()->to('timteknis/datacalonusulan')->with('error', 'Data ini masih berstatus Draft dan tidak dapat diakses.');
        }

        // Ambil data profil pengusul berdasarkan id_pengusul dari pendaftaran
        $pengusul = $userModel->find($pendaftaran['id_pengusul']);  // Mengambil data pengusul berdasarkan ID

        // Validasi jika data pengusul ditemukan atau tidak
        if (!$pengusul) {
            return redirect()->to('admin/datacalon')->with('error', 'Data pengusul tidak ditemukan.');
        }

        // Ambil data dari semua tabel terkait menggunakan join
        $data = [
            'title' => 'Detail Usulan',
            'pendaftaran' => $pendaftaran,
            'pengusul' => $pengusul,  // Tambahkan data pengusul
            'kegiatan_utama' => $kegiatan_utama,
            'kegiatan_tambahan' => $kegiatan_tambahan,
        ];

        return view('timteknis/detaildatacalonusulan', $data);
    }

    public function verifadminkategoria()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }

        // Tentukan kategori secara otomatis ke 'Perintis Lingkungan'
        $kategori = 'Perintis Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Perintis Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['title'] = "Verifikasi Administrasi Kategori Perintis Lingkungan";

        return view('timteknis/verifadminkategoria', $data);
    }

    public function verifadminkategorib()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }

        // Tentukan kategori secara otomatis ke 'Pengabdi Lingkungan'
        $kategori = 'Pengabdi Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Pengabdi Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['title'] = "Verifikasi Administrasi Pengabdi Lingkungan";

        return view('timteknis/verifadminkategorib', $data);
    }

    public function verifadminkategoric()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }

        // Tentukan kategori secara otomatis ke 'Penyelamat Lingkungan'
        $kategori = 'Penyelamat Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Penyelamat Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['title'] = "Verifikasi Administrasi Kategori Penyelamat Lingkungan";

        return view('timteknis/verifadminkategoric', $data);
    }

    public function verifadminkategorid()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }

        // Tentukan kategori secara otomatis ke 'Pembina Lingkungan'
        $kategori = 'Pembina Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Pembina Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['title'] = "Verifikasi Administrasi Kategori Pembina Lingkungan";

        return view('timteknis/verifadminkategorid', $data);
    }

    public function updateStatus()
    {
        // Inisialisasi model
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dari POST request
        $id_pendaftaran = $this->request->getPost('id_pendaftaran');
        $status_pendaftaran = $this->request->getPost('status_pendaftaran');
        $catatan_verifikasi = $this->request->getPost('catatan_verifikasi'); // Ambil catatan verifikasi

        // Validasi data
        if ($id_pendaftaran && $status_pendaftaran) {
            // Siapkan data untuk update
            $updateData = [
                'status_pendaftaran' => $status_pendaftaran,
            ];

            // Jika ada catatan, tambahkan ke data yang akan di-update
            if ($status_pendaftaran == 'Tidak Lolos Administrasi' && $catatan_verifikasi) {
                $updateData['catatan_verifikasi'] = $catatan_verifikasi;
            }

            // Update status dan catatan di database
            $pendaftaranModel->update($id_pendaftaran, $updateData);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons gagal
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function bahansidang1kategoria()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Tentukan kategori secara otomatis ke 'Perintis Lingkungan'
        $kategori = 'Perintis Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Perintis Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }


        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;

        // Set the page title
        $data['title'] = "Bahan Sidang 1 Kategori A";

        // Pass the $data array to the view
        return view('timteknis/bahansidang1/kategoria', $data);
    }


    public function bahansidang1kategorib()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Tentukan kategori secara otomatis ke 'Pengabdi Lingkungan'
        $kategori = 'Pengabdi Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Pengabdi Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }


        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;

        // Set the page title
        $data['title'] = "Bahan Sidang 1 Kategori B";

        // Pass the $data array to the view
        return view('timteknis/bahansidang1/kategorib', $data);
    }

    public function bahansidang1kategoric()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Tentukan kategori secara otomatis ke 'Penyelamat Lingkungan'
        $kategori = 'Penyelamat Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Penyelamat Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }


        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;

        // Set the page title
        $data['title'] = "Bahan Sidang 1 Kategori C";

        // Pass the $data array to the view
        return view('timteknis/bahansidang1/kategoric', $data);
    }

    public function bahansidang1kategorid()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Tentukan kategori secara otomatis ke 'Pembina Lingkungan'
        $kategori = 'Pembina Lingkungan';

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Filter data berdasarkan kategori 'Pembina Lingkungan'
        $pendaftaranModel->where('kategori', $kategori);

        // Ambil status dari filter
        $status_pendaftaran = $this->request->getVar('status_pendaftaran');

        // Jika status dipilih, tambahkan filter status
        if ($status_pendaftaran) {
            $pendaftaranModel->where('status_pendaftaran', $status_pendaftaran);
        }


        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Lolos Administrasi'];
        $pendaftaranModel->whereIn('status_pendaftaran', $validStatuses);

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $pendaftaranModel->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $data['kategori'] = $kategori;
        $data['status_pendaftaran'] = $status_pendaftaran;
        $data['keyword'] = $keyword;
        $data['usulan'] = $pendaftaranModel->paginate($perPage, 'usulan');
        $data['pager'] = $pendaftaranModel->pager;
        $data['kategori'] = $kategori;

        // Set the page title
        $data['title'] = "Bahan Sidang 1 Kategori D";

        // Pass the $data array to the view
        return view('timteknis/bahansidang1/kategorid', $data);
    }

    public function exportPDF($kode_registrasi)
    {
        $id_tim_teknis = session()->get('id_tim_teknis');
    
        if (!$id_tim_teknis) {
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
    
        $html = view('timteknis/pdf', $data);
    
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

    public function downloadSuratPengantar($filename)
    {
        $path = WRITEPATH . 'uploads/suratpengantar/' . $filename;

        if (!file_exists($path)) {
            // File tidak ditemukan, Anda bisa mengarahkan ke halaman error atau menampilkan pesan
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
        }

        // Menyajikan file dengan header download
        return $this->response->download($path, null);
    }

    public function bahansidang2kategoria()
    {
        $data['title'] = 'Bahan Sidang 2 Kategori A';
        return view('timteknis/bahansidang2/kategoria', $data);
    }

    public function bahansidang2kategorib()
    {
        $data['title'] = 'Bahan Sidang 2 Kategori B';
        return view('timteknis/bahansidang2/kategorib', $data);
    }

    public function bahansidang2kategoric()
    {
        $data['title'] = 'Bahan Sidang 2 Kategori C';
        return view('timteknis/bahansidang2/kategoric', $data);
    }

    public function bahansidang2kategorid()
    {
        $data['title'] = 'Bahan Sidang 2 Kategori D';
        return view('timteknis/bahansidang2/kategorid', $data);
    }
}
