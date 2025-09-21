<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use App\Models\ArtikelModel;
use App\Models\BeritaModel;
use App\Models\BukuModel;
use App\Models\DppkModel;
use App\Models\PenerimaModel;
use App\Models\PengumumanModel;
use App\Models\PengusulModel;
use App\Models\PeraturanModel;
use App\Models\TimteknisModel;
use App\Models\VideoModel;
use App\Models\PendaftaranModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\PamfletModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\CapaianModel;

$pager = \Config\Services::pager();


class AdminController extends BaseController
{
    protected $pendaftaranModel;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranModel();
    }

    public function dashboard()
    {
        $Model = new PendaftaranModel();
        $model = new PamfletModel();
        $ArsipModel = new ArsipModel();

        $perPage = 5;
        $currentPage = $this->request->getVar('page_calon') ? $this->request->getVar('page_calon') : 1;

        $validStatuses = ['Terkirim', 'Perlu Perbaikan', 'Sesuai', 'Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
        $Model->whereIn('status_pendaftaran', $validStatuses);

        $keyword = $this->request->getGet('search');

        if ($keyword) {
            $calon = $Model->like('nama', $keyword)
                ->orLike('kode_registrasi', $keyword)
                ->orLike('kategori', $keyword)
                ->orLike('provinsi', $keyword)
                ->paginate($perPage, 'calon');
        } else {
            $calon = $Model->paginate($perPage, 'calon');
        }

        $data['calon'] = $calon;
        $data['pager'] = $Model->pager;
        $data['title'] = "Dashboard Admin";
        $data['keyword'] = $keyword;
        $data['pamflet'] = $model->first();
        $data['kategoriData'] = $ArsipModel->dataKategori();

        return view('admin/dashboard', $data);
    }

    public function artikeladmin()
    {
        $model = new ArtikelModel();
        $perPage = 5;

        // Ambil parameter search dan status dari query string
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        // Query dasar untuk menampilkan artikel
        $query = $model->select('*');

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Pencarian berdasarkan keyword pada judul
        if ($keyword) {
            $query->like('judul', $keyword);
        }

        // Dapatkan data artikel dengan pagination
        $artikels = $query->orderBy('tanggal', 'DESC')
            ->paginate($perPage, 'artikels');

        // Data yang akan dikirimkan ke view
        $data = [
            'artikels' => $artikels,
            'title' => "Artikel Admin",
            'pager' => $model->pager,
            'keyword' => $keyword,
            'status' => $status,
        ];

        return view('admin/artikeladmin', $data);
    }




    public function tambahartikeladmin()
    {
        $data['title'] = "Tambah Artikel Admin";
        return view('admin/tambahartikeladmin', $data);
    }

    public function tambahArtikelAction()
    {
        $model = new ArtikelModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', TRUE);
        $konten = $this->request->getPost('konten');

        // Memproses foto yang diupload
        $foto = $this->request->getFile('foto');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[buku_kalpataru.judul]' // Judul harus unik dan panjang antara 5 dan 125 karakter
            ],
            'konten' => [
                'label' => 'Konten',
                'rules' => 'required|min_length[20]' // Konten harus ada dan panjang minimum 20 karakter
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,1024]'
            ]
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menghasilkan slug yang unik
        $slugExist = $model->where('slug', $slug)->first(); // Cek apakah slug sudah ada
        if ($slugExist) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => [
                    'judul' => 'Tautan dengan judul ini sudah tersedia. Silakan gunakan judul yang berbeda.'
                ]
            ]);
        }

        // Menangani upload file foto
        $fotoPath = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fotoName = $foto->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($foto->move('public/images/artikel', $fotoName)) {
                // Jika berhasil, simpan path foto ke database
                $fotoPath = 'images/artikel/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file foto.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => 'File tidak valid atau belum diupload.']);
        }

        // Menghasilkan slug yang unik
        $slugExist = $model->where('slug', $slug)->first(); // Cek apakah slug sudah ada
        if ($slugExist) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => [
                    'judul' => 'Tautan dengan judul ini sudah tersedia. Silakan gunakan judul yang berbeda.'
                ]
            ]);
        }

        // Simpan data artikel ke dalam database
        $dataArtikel = [
            'id_admin' => session()->get('id_admin'),
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'slug' => $slug,
            'konten' => htmlspecialchars($konten, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'foto' => $fotoPath,
            'tanggal' => date('Y-m-d'),
        ];

        // Simpan artikel
        if ($model->insert($dataArtikel)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil ditambahkan.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel.']);
        }
    }

    public function updateStatus()
    {
        // Inisialisasi model
        $model = new ArtikelModel();

        // Ambil data dari POST request
        $id_artikel = $this->request->getPost('id_artikel');
        $status = $this->request->getPost('status');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_artikel && $status) {
            $tanggal = date('Y-m-d');

            $model->update($id_artikel, [
                'status' => $status,
                'tanggal' => $tanggal // Update tanggal saat status diubah
            ]);
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function detailartikel($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->getDetailArtikelBySlug($slug);

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        $data = [
            'title' => $artikel['judul'],
            'artikel' => $artikel,
        ];
        return view('admin/detailartikel', $data);
    }

    public function editArtikel($id_artikel)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id_artikel); // Mengambil artikel berdasarkan id_artikel

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Artikel - ' . $artikel['judul'],
            'artikel' => $artikel,
        ];
        return view('admin/editartikel', $data);
    }


    public function updateArtikelAction($id)
    {
        $model = new ArtikelModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', TRUE);
        $konten = $this->request->getPost('konten');

        // Memproses foto yang diupload
        $foto = $this->request->getFile('foto');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[artikel.judul,id_artikel,' . $id . ']' // Judul harus unik kecuali untuk artikel yang sedang diedit
            ],
            'konten' => [
                'label' => 'Konten',
                'rules' => 'required|min_length[20]' // Konten harus ada dan panjang minimum 20 karakter
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]'
            ]
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        $slugExists = $model->where('slug', $slug)
            ->where('id_artikel !=', $id) // Abaikan artikel yang sedang diedit
            ->first();

        if ($slugExists) {
            // Jika slug sudah ada pada artikel lain, kirim pesan kesalahan ke view
            return $this->response->setJSON([
                'success' => false,
                'messages' => [
                    'judul' => 'Judul artikel ini sudah digunakan. Silakan gunakan judul yang berbeda.'
                ]
            ]);
        }

        // Menangani upload file foto
        $fotoPath = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fotoName = $foto->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($foto->move('public/images/artikel', $fotoName)) {
                // Jika berhasil, simpan path foto
                $fotoPath = 'images/artikel/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file foto.']);
            }
        }



        // Siapkan data untuk diupdate
        $dataArtikel = [
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'slug' => $slug,
            'konten' => htmlspecialchars($konten, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
        ];

        // Jika ada foto baru yang diupload, masukkan ke dalam data
        if (!empty($fotoPath)) {
            $dataArtikel['foto'] = $fotoPath;
        }

        // Simpan artikel yang sudah diperbarui
        if ($model->update($id, $dataArtikel)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil diperbarui.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui artikel.']);
        }
    }

    public function updateStatusArtikel()
    {
        // Inisialisasi model
        $ArtikelModel = new ArtikelModel();

        // Ambil data dari POST request
        $id_Artikel = $this->request->getPost('id_artikel');
        $status_Artikel = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan'); // Ambil catatan verifikasi

        // Validasi data
        if ($id_Artikel && $status_Artikel) {
            // Siapkan data untuk update
            $updateData = [
                'status' => $status_Artikel,
            ];

            // Jika ada catatan, tambahkan ke data yang akan di-update
            if ($status_Artikel == 'Ditolak' && $catatan) {
                $updateData['catatan'] = $catatan;
            }

            // Update status dan catatan di database
            $ArtikelModel->update($id_Artikel, $updateData);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons gagal
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function hapusArtikel($id_artikel)
    {
        $model = new ArtikelModel();

        // Cari artikel berdasarkan ID
        $artikel = $model->find($id_artikel);

        if ($artikel) {
            // Jika artikel ditemukan, hapus file terkait jika ada
            if (!empty($artikel['foto'])) { // Kolom 'foto' menyimpan path file
                $filePath = FCPATH . 'public/' . $artikel['foto']; // Mendapatkan path lengkap file
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file dari server
                }
            }

            // Hapus artikel dari database
            if ($model->delete($id_artikel)) {
                session()->setFlashdata('success', 'Artikel dan file terkait berhasil dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus artikel dari database.');
            }
        } else {
            session()->setFlashdata('error', 'Artikel tidak ditemukan.');
        }

        return redirect()->to('/admin/artikel'); // Sesuaikan dengan URL yang diinginkan
    }



    public function akundlhk()
    {
        $model = new PengusulModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil statusAkun dari filter
        $statusAkun = $this->request->getVar('statusAkun');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Ambil pengusul dengan role_akun 'Pengusul'
        $builder = $model->where('role_akun', 'DLHK');

        // Jika statusAkun dipilih, tambahkan filter statusAkun
        if ($statusAkun) {
            $builder->where('status_akun', $statusAkun);
        }

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama_instansi_pribadi
        if ($keyword) {
            $builder->like('instansi', $keyword);
        }

        // Hitung total pengusul yang sesuai dengan filter dan pencarian
        $totalFilteredPengusul = $builder->countAllResults(false); // False untuk tidak reset query builder

        // Dapatkan data dengan pagination setelah semua filter
        $pengusul = $builder->paginate($perPage, 'pengusul');

        // Data untuk view
        $data['pengusul'] = $pengusul;
        $data['countAllPengusul'] = $totalFilteredPengusul; // Total pengusul setelah filter dan pencarian
        $data['title'] = "Akun DLHK Provinsi";
        $data['pager'] = $model->pager;
        $data['keyword'] = $keyword;
        $data['statusAkun'] = $statusAkun;

        return view('admin/akundlhk', $data);
    }

    public function akunpengusul()
    {
        $model = new PengusulModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil statusAkun dari filter
        $statusAkun = $this->request->getVar('statusAkun');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Ambil pengusul dengan role_akun 'Pengusul'
        $builder = $model->where('role_akun', 'Pengusul');

        // Jika statusAkun dipilih, tambahkan filter statusAkun
        if ($statusAkun) {
            $builder->where('status_akun', $statusAkun);
        }

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama_instansi_pribadi
        if ($keyword) {
            $builder->like('nama_instansi_pribadi', $keyword);
        }

        // Hitung total pengusul yang sesuai dengan filter dan pencarian
        $totalFilteredPengusul = $builder->countAllResults(false); // False untuk tidak reset query builder

        // Dapatkan data dengan pagination setelah semua filter
        $pengusul = $builder->paginate($perPage, 'pengusul');

        // Data untuk view
        $data['pengusul'] = $pengusul;
        $data['countAllPengusul'] = $totalFilteredPengusul; // Total pengusul setelah filter dan pencarian
        $data['title'] = "Akun Pengusul";
        $data['pager'] = $model->pager;
        $data['keyword'] = $keyword;
        $data['statusAkun'] = $statusAkun;

        return view('admin/akunpengusul', $data);
    }

    public function updatePengusul()
    {
        // Inisialisasi model
        $model = new PengusulModel();

        // Ambil data dari POST request
        $id_pengusul = $this->request->getPost('id_pengusul');
        $status_akun = $this->request->getPost('status_akun');
        $id_admin = session()->get('id_admin');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_pengusul && $status_akun && $id_admin) {
            // Update status dan id_admin di database
            $model->update($id_pengusul, [
                'status_akun' => $status_akun,
                'id_admin' => $id_admin
            ]);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Status Pengusul berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman jika ada kesalahan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status pengusul']);
        }
    }

    public function hapusPengusul($id_pengusul)
    {
        $model = new PengusulModel();

        // Hapus artikel berdasarkan ID
        if ($model->delete($id_pengusul)) {
            // Set flash message atau lakukan redirect setelah menghapus
            session()->setFlashdata('success', 'Pengusul berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus pengusul.');
        }

        return redirect()->to('/admin/pengusul'); // Sesuaikan dengan URL yang diinginkan
    }

    public function detailPengusul($id_pengusul)
    {
        $model = new PengusulModel();
        $pengusul = $model->getDetailById($id_pengusul);

        if (!$pengusul) {
            return redirect()->to('/admin/pengusul')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Akun Pengusul',
            'pengusul' => $pengusul,
        ];

        return view('admin/detailpengusul', $data);
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

    public function akundppk()
    {
        $model = new DppkModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil statusAkun dari filter
        $statusAkun = $this->request->getVar('statusAkun');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Mulai query builder dari model
        $builder = $model->table('dppk');

        // Jika statusAkun dipilih, tambahkan filter statusAkun
        if ($statusAkun) {
            $builder->where('status_akun', $statusAkun);
        }

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $builder->like('nama', $keyword);
        }

        // Hitung total dppk yang sesuai dengan filter dan pencarian
        $totalFilteredDppk = $builder->countAllResults(false); // False untuk tidak reset query builder

        // Dapatkan data dengan pagination setelah semua filter
        $dppk = $builder->paginate($perPage, 'dppk');

        $data['dppk'] = $dppk;
        $data['countAllDppk'] = $totalFilteredDppk; // Total dppk setelah filter dan pencarian
        $data['title'] = "Akun DPPK";
        $data['pager'] = $model->pager;
        $data['keyword'] = $keyword;
        $data['statusAkun'] = $statusAkun;

        return view('admin/akundppk', $data);
    }


    public function updateDppk()
    {
        // Inisialisasi model
        $model = new DppkModel();

        // Ambil data dari POST request
        $id_dppk = $this->request->getPost('id_dppk');
        $status_akun = $this->request->getPost('status_akun');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_dppk && $status_akun) {
            // Update status di database
            $model->update($id_dppk, ['status_akun' => $status_akun]);
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Status DPPK berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status DPPK']);
        }
    }

    public function hapusDppk($id_dppk)
    {
        $model = new DppkModel();

        if ($model->delete($id_dppk)) {
            // Set flash message atau lakukan redirect setelah menghapus
            session()->setFlashdata('success', 'DPPK berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus DPPK.');
        }

        return redirect()->to('/admin/akundppk'); // Sesuaikan dengan URL yang diinginkan
    }

    public function arsippenerima()
    {
        $model = new ArsipModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        $kategori = $this->request->getVar('kategori');
        $keyword = $this->request->getGet('search');
        $sort = $this->request->getGet('sort'); // Menangkap sort parameter
        $order = $sort === 'desc' ? 'DESC' : 'ASC'; // Menentukan urutan

        $builder = $model->table('arsip_penerima');

        if ($kategori) {
            $builder->where('kategori', $kategori);
        }

        if ($keyword) {
            $builder->like('nama', $keyword);
        }

        // Tambahkan urutan berdasarkan kolom tahun
        $builder->orderBy('tahun_penerimaan', $order);

        $totalFilter = $builder->countAllResults(false);

        $arsip = $builder->paginate($perPage, 'arsip');

        $data = [
            'title' => 'Arsip Penerima',
            'arsip' => $arsip,
            'countAllArsip' => $totalFilter,
            'pager' => $model->pager,
            'keyword' => $keyword,
            'kategori' => $kategori,
            'sort' => $sort, // Simpan sort di data view
        ];

        return view('admin/arsippenerima', $data);
    }


    public function tambaharsip()
    {
        $provinsi_list = [
            'Aceh',
            'Bali',
            'Bangka Belitung',
            'Banten',
            'Bengkulu',
            'DI Yogyakarta',
            'DKI Jakarta',
            'Gorontalo',
            'Jambi',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Kalimantan Barat',
            'Kalimantan Selatan',
            'Kalimantan Tengah',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Kepulauan Bangka Belitung',
            'Kepulauan Riau',
            'Lampung',
            'Maluku',
            'Maluku Utara',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Papua',
            'Papua Barat',
            'Papua Barat Daya',
            'Papua Pegunungan',
            'Papua Selatan',
            'Papua Tengah',
            'Riau',
            'Sulawesi Barat',
            'Sulawesi Selatan',
            'Sulawesi Tengah',
            'Sulawesi Tenggara',
            'Sulawesi Utara',
            'Sumatera Barat',
            'Sumatera Selatan',
            'Sumatera Utara'
        ];

        $data = [
            'title' => 'Arsip Penerima',
            'provinsi_list' => $provinsi_list,
        ];
        return view('admin/tambaharsip', $data);
    }

    public function tambahArsipAction()
    {
        // Inisialisasi model penerima
        $penerimaModel = new ArsipModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required',
            'telepon' => 'required|numeric',
            'email' => 'required|valid_email',
            'tahun_penerimaan' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'profil' => 'required',
            'nama_pengusul' => 'required',
            'instansi_pengusul' => 'required',
            'email_pengusul' => 'required|valid_email',
            'jabatan_pengusul' => 'required',
            'telepon_pengusul' => 'required|numeric',
            'slogan' => 'required',
            'kategori' => 'required',
            'tema' => 'required',
            'subtema' => 'required',
            'bentuk_kegiatan' => 'required',
            'link_dokumentasi' => 'required',
            'status' => 'required',
            'foto_profil' => 'is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg]|max_size[foto_profil,5120]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Proses upload foto
        $foto = $this->request->getFile('foto_profil');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('images/penerima', $fotoName);
        } else {
            $fotoName = 'default-profile.jpg'; // Gunakan foto default
        }

        // Menyimpan data ke database
        $data = [
            'id_admin' => session()->get('id_admin'),
            'nama' => $this->request->getPost('nama'),
            'usia' => $this->request->getPost('usia'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'tahun_penerimaan' => $this->request->getPost('tahun_penerimaan'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'desa' => $this->request->getPost('desa'),
            'profil' => $this->request->getPost('profil'),
            'nama_pengusul' => $this->request->getPost('nama_pengusul'),
            'instansi_pengusul' => $this->request->getPost('instansi_pengusul'),
            'email_pengusul' => $this->request->getPost('email_pengusul'),
            'jabatan_pengusul' => $this->request->getPost('jabatan_pengusul'),
            'telepon_pengusul' => $this->request->getPost('telepon_pengusul'),
            'slogan' => $this->request->getPost('slogan'),
            'kategori' => $this->request->getPost('kategori'),
            'tema' => $this->request->getPost('tema'),
            'sub_tema' => $this->request->getPost('subtema'),
            'link_dokumentasi' => $this->request->getPost('link_dokumentasi'),
            'bentuk_kegiatan' => $this->request->getPost('bentuk_kegiatan'),
            'status' => $this->request->getPost('status'),
            'foto_profil' => $fotoName
        ];

        if ($penerimaModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Aarsip berhasil ditambahkan.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan arsip.']);
        }
    }

    public function hapusArsip($id)
    {
        $model = new ArsipModel();

        if ($model->delete($id)) {
            // Set flash message atau lakukan redirect setelah menghapus
            session()->setFlashdata('success', 'Arsip berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus arsip.');
        }

        return redirect()->to('/admin/arsippenerima'); // Sesuaikan dengan URL yang diinginkan
    }

    public function editArsip($id)
    {
        $model = new ArsipModel();
        $arsip = $model->find($id);

        $provinsi_list = [
            'Aceh',
            'Bali',
            'Bangka Belitung',
            'Banten',
            'Bengkulu',
            'DI Yogyakarta',
            'DKI Jakarta',
            'Gorontalo',
            'Jambi',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Kalimantan Barat',
            'Kalimantan Selatan',
            'Kalimantan Tengah',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Kepulauan Bangka Belitung',
            'Kepulauan Riau',
            'Lampung',
            'Maluku',
            'Maluku Utara',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Papua',
            'Papua Barat',
            'Papua Barat Daya',
            'Papua Pegunungan',
            'Papua Selatan',
            'Papua Tengah',
            'Riau',
            'Sulawesi Barat',
            'Sulawesi Selatan',
            'Sulawesi Tengah',
            'Sulawesi Tenggara',
            'Sulawesi Utara',
            'Sumatera Barat',
            'Sumatera Selatan',
            'Sumatera Utara'
        ];

        if (!$arsip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $id_admin = session()->get('id_admin');

        if (!$id_admin) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Arsip - ' . $arsip['nama'],
            'arsip' => $arsip,
            'provinsi_list' => $provinsi_list,
        ];
        return view('admin/editarsip', $data);
    }

    public function editArsipAction($id)
    {
        $model = new ArsipModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required',
            'telepon' => 'required|numeric',
            'email' => 'required|valid_email',
            'tahun_penerimaan' => 'required|valid_date',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'profil' => 'required',
            'nama_pengusul' => 'required',
            'instansi_pengusul' => 'required',
            'email_pengusul' => 'required|valid_email',
            'jabatan_pengusul' => 'required',
            'telepon_pengusul' => 'required|numeric',
            'slogan' => 'required',
            'kategori' => 'required',
            'tema' => 'required',
            'subtema' => 'required',
            'bentuk_kegiatan' => 'required',
            'link_dokumentasi' => 'required',
            'status' => 'required',
            'foto_profil' => 'permit_empty|uploaded[foto_profil]|max_size[foto_profil,2048]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        // Ambil data dari request
        $data = [
            'nama' => $this->request->getPost('nama'),
            'usia' => $this->request->getPost('usia'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'tahun_penerimaan' => $this->request->getPost('tahun_penerimaan'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'desa' => $this->request->getPost('desa'),
            'profil' => $this->request->getPost('profil'),
            'nama_pengusul' => $this->request->getPost('nama_pengusul'),
            'instansi_pengusul' => $this->request->getPost('instansi_pengusul'),
            'email_pengusul' => $this->request->getPost('email_pengusul'),
            'jabatan_pengusul' => $this->request->getPost('jabatan_pengusul'),
            'telepon_pengusul' => $this->request->getPost('telepon_pengusul'),
            'slogan' => $this->request->getPost('slogan'),
            'kategori' => $this->request->getPost('kategori'),
            'tema' => $this->request->getPost('tema'),
            'sub_tema' => $this->request->getPost('subtema'),
            'link_dokumentasi' => $this->request->getPost('link_dokumentasi'),
            'bentuk_kegiatan' => $this->request->getPost('bentuk_kegiatan'),
            'status' => $this->request->getPost('status')

        ];

        // Cek dan proses foto profil baru jika ada
        $fotoProfil = $this->request->getFile('foto_profil');
        if ($fotoProfil && $fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            // Hapus foto lama jika ada
            $arsip = $model->find($id);
            if ($arsip && file_exists('images/penerima/' . $arsip['foto_profil'])) {
                unlink('images/penerima/' . $arsip['foto_profil']);
            }

            // Simpan foto baru
            $newName = $fotoProfil->getRandomName();
            $fotoProfil->move('images/penerima', $newName);
            $data['foto_profil'] = $newName;
        }

        // Update data arsip dalam database
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Aarsip berhasil ditambahkan.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan arsip.']);
        }
    }


    public function dataCalon()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data dengan pagination, limit 8 per halaman
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
        $validStatuses = ['Terkirim', 'Perlu Perbaikan', 'Sesuai', 'Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
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

        return view('admin/datacalon', $data);
    }



    public function updateStatusPendaftaran()
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
            if ($status_pendaftaran == 'Perlu Perbaikan' && $catatan_verifikasi) {
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

    public function detailDataCalon($id)
    {
        $model = new PendaftaranModel();
        $userModel = new PengusulModel();  // Asumsikan Anda memiliki model Pengusul untuk mengambil data profil

        // Ambil detail pendaftaran berdasarkan ID
        $pendaftaran = $model->getDetailById($id);

        // Validasi jika data ditemukan atau tidak
        if (!$pendaftaran) {
            return redirect()->to('admin/datacalon')->with('error', 'Data tidak ditemukan.');
        }

        // Ambil data kegiatan utama dan kegiatan tambahan
        $kegiatan_utama = $model->getKegiatanByTipe($id, 'kegiatan_utama');
        $kegiatan_tambahan = $model->getKegiatanByTipe($id, 'kegiatan_tambahan');

        // Cek status pendaftaran, jika "Draft" redirect dengan pesan error
        if ($pendaftaran['status_pendaftaran'] === 'Draft') {
            return redirect()->to('admin/datacalon')->with('error', 'Data ini masih berstatus Draft dan tidak dapat diakses.');
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

        return view('admin/detaildatacalon', $data);
    }




    public function sidang1()
    {
        $data['title'] = "Sidang 1";
        return view('admin/sidang1', ['title' => 'Sidang 1']);
    }

    public function editpamflet($id_pamflet)
    {
        $model = new PamfletModel();
        $pamflet = $model->find($id_pamflet);
        if (!$pamflet) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $id_admin = session()->get('id_admin');

        if (!$id_admin) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Pamflet',
            'pamflet' => $pamflet,
        ];
        return view('admin/editpamflet', $data);
    }

    public function editpamfletAction($id)
    {
        $model = new PamfletModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'foto' => 'is_image[foto]',
            'status' => 'required|in_list[Nonaktif,Aktif]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $fotoFile = $this->request->getFile('foto');
        $data = [
            'status' => $this->request->getPost('status'),
        ];

        if ($fotoFile && $fotoFile->isValid()) {
            $data['foto'] = $fotoFile->getName();
            $fotoFile->move(WRITEPATH . 'uploads/pamflet');
        } else {
            $data['foto'] = $this->request->getPost('foto_lama');
        }

        if ($model->update($id, $data)) {
            return redirect()->to("/admin/editpamflet/$id")->with('message', 'Pamflet berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui pamflet.');
        }
    }

    public function showPamflet($filename)
    {
        $filePathJpg = WRITEPATH . 'uploads/pamflet/' . $filename;
        if (file_exists($filePathJpg)) {
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody(file_get_contents($filePathJpg));
        }

        $filePathJpeg = WRITEPATH . 'uploads/pamflet/' . $filename;
        if (file_exists($filePathJpeg)) {
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody(file_get_contents($filePathJpeg));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
    }

    public function sidang2()
    {
        $data['title'] = "Sidang 2";
        return view('admin/sidang2', ['title' => 'Sidang 2']);
    }

    public function arsipselengkapnya()
    {
        $data['title'] = "Arsip Selengkapnya";
        return view('admin/arsipselengkapnya', ['title' => 'Arsip Selengkapnya']);
    }

    public function nominasi()
    {
        $data['title'] = "Nominasi";
        return view('admin/nominasi', ['title' => 'Nominasi']);
    }

    public function akuntimteknis()
    {
        $model = new TimteknisModel();
        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil statusAkun dari filter
        $statusAkun = $this->request->getVar('statusAkun');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Mulai query builder dari tabel tim_teknis
        $builder = $model->table('tim_teknis');

        // Jika statusAkun dipilih, tambahkan filter statusAkun
        if ($statusAkun) {
            $builder->where('status_akun', $statusAkun);
        }

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $builder->like('nama', $keyword);
        }

        // Hitung total tim teknis yang sesuai dengan filter dan pencarian
        $totalFilteredTimTeknis = $builder->countAllResults(false); // False untuk tidak reset query builder

        // Dapatkan data dengan pagination setelah semua filter
        $timTeknis = $builder->paginate($perPage, 'tim_teknis');

        $data['timTeknis'] = $timTeknis;
        $data['countAllTimTeknis'] = $totalFilteredTimTeknis; // Total tim teknis setelah filter dan pencarian
        $data['title'] = "Akun Tim Teknis";
        $data['pager'] = $model->pager;
        $data['keyword'] = $keyword;
        $data['statusAkun'] = $statusAkun;

        return view('admin/akuntimteknis', $data);
    }

    public function updateTimTeknis()
    {
        // Inisialisasi model
        $model = new TimteknisModel();

        // Ambil data dari POST request
        $id_tim_teknis = $this->request->getPost('id_tim_teknis');
        $status_akun = $this->request->getPost('status_akun');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_tim_teknis && $status_akun) {
            // Update status di database
            $model->update($id_tim_teknis, ['status_akun' => $status_akun]);
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Status DPPK berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status DPPK']);
        }
    }

    public function hapusTimTeknis($id_tim_teknis)
    {
        $model = new TimteknisModel();

        if ($model->delete($id_tim_teknis)) {
            // Set flash message atau lakukan redirect setelah menghapus
            session()->setFlashdata('success', 'Tim Teknis berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus Tim Teknis.');
        }

        return redirect()->to('/admin/akuntimteknis'); // Sesuaikan dengan URL yang diinginkan
    }

    public function akunpenerima()
    {
        $model = new PenerimaModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil statusAkun dari filter
        $statusAkun = $this->request->getVar('statusAkun');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Mulai query builder dari model
        $builder = $model->table('penerima');

        // Jika statusAkun dipilih, tambahkan filter statusAkun
        if ($statusAkun) {
            $builder->where('status_akun', $statusAkun);
        }

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $builder->like('nama', $keyword);
        }

        // Hitung total penerima yang sesuai dengan filter dan pencarian
        $totalFilteredPenerima = $builder->countAllResults(false); // False untuk tidak reset query builder

        // Dapatkan data dengan pagination setelah semua filter
        $penerima = $builder->paginate($perPage, 'penerima');

        $data['penerima'] = $penerima;
        $data['countAllPenerima'] = $totalFilteredPenerima; // Total penerima setelah filter dan pencarian
        $data['title'] = "Akun Penerima";
        $data['pager'] = $model->pager;
        $data['keyword'] = $keyword;
        $data['statusAkun'] = $statusAkun;

        return view('admin/akunpengguna', $data);
    }

    public function updatePenerima()
    {
        // Inisialisasi model
        $model = new PenerimaModel();

        // Ambil data dari POST request
        $id_penerima = $this->request->getPost('id_penerima');
        $status_akun = $this->request->getPost('status_akun');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_penerima && $status_akun) {
            // Update status di database
            $model->update($id_penerima, ['status_akun' => $status_akun]);
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status']);
        }
    }

    public function hapusPenerima($id_penerima)
    {
        $model = new PenerimaModel();

        if ($model->delete($id_penerima)) {
            // Set flash message atau lakukan redirect setelah menghapus
            session()->setFlashdata('success', 'Akun berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus Akun.');
        }

        return redirect()->to('/admin/akunpenerima'); // Sesuaikan dengan URL yang diinginkan
    }

    public function beritaAdmin()
    {
        $model = new BeritaModel();
        $perPage = 5;

        // Ambil parameter search dan status dari query string
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        // Query dasar untuk menampilkan berita
        $query = $model->select('*');

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Pencarian berdasarkan keyword pada judul
        if ($keyword) {
            $query->like('judul', $keyword);
        }

        // Dapatkan data berita dengan pagination
        $beritas = $query->orderBy('tanggal', 'DESC')
            ->paginate($perPage, 'beritas');

        // Data yang akan dikirimkan ke view
        $data = [
            'beritas' => $beritas,
            'title' => "Berita Admin",
            'pager' => $model->pager,
            'keyword' => $keyword,
            'status' => $status,
        ];

        return view('admin/berita', $data);
    }

    public function tambahberitaadmin()
    {
        $data['title'] = "Tambah Berita Admin";
        return view('admin/tambahberitaadmin', $data);
    }

    public function tambahBeritaAction()
    {
        $model = new BeritaModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', TRUE);
        $konten = $this->request->getPost('konten');

        // Memproses foto yang diupload
        $foto = $this->request->getFile('foto');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[berita.judul]' // Judul harus unik dan panjang antara 5 dan 125 karakter
            ],
            'konten' => [
                'label' => 'Konten',
                'rules' => 'required|min_length[20]' // Konten harus ada dan panjang minimum 20 karakter
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,1024]'
            ]
        ]);


        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menghasilkan slug yang unik
        $slugExist = $model->where('slug', $slug)->first(); // Cek apakah slug sudah ada
        if ($slugExist) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => [
                    'judul' => 'Tautan dengan judul ini sudah tersedia. Silakan gunakan judul yang berbeda.'
                ]
            ]);
        }

        // Menangani upload file foto
        $fotoPath = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fotoName = $foto->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($foto->move('public/images/berita', $fotoName)) {
                // Jika berhasil, simpan path foto ke database
                $fotoPath = 'images/berita/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan file foto.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid atau belum diupload.']);
        }

        // Simpan data artikel ke dalam database
        $data = [
            'id_admin' => session()->get('id_admin'),
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'slug' => $slug,
            'konten' => htmlspecialchars($konten, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'foto' => $fotoPath,
            'tanggal' => date('Y-m-d'),
        ];

        // Simpan artikel
        if ($model->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil ditambahkan.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel.']);
        }
    }

    public function detailberita($slug)
    {
        $model = new BeritaModel();
        $berita = $model->getDetailBeritaBySlug($slug);

        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        $data = [
            'title' => $berita['judul'],
            'berita' => $berita,
        ];
        return view('admin/detailberita', $data);
    }

    public function editBerita($id_berita)
    {
        $model = new BeritaModel();
        $berita = $model->find($id_berita); // Mengambil berita berdasarkan id_berita

        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Berita - ' . $berita['judul'],
            'berita' => $berita,
        ];
        return view('admin/editberita', $data);
    }

    public function updateBeritaAction($id)
    {
        $model = new BeritaModel();
        $berita = $model->find($id);

        if (!$berita) {
            return $this->response->setJSON(['success' => false, 'message' => 'berita tidak ditemukan.']);
        }

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', TRUE);
        $konten = $this->request->getPost('konten');

        // Memproses foto yang diupload
        $foto = $this->request->getFile('foto');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[berita.judul,id_berita,' . $id . ']' // Judul harus unik kecuali untuk berita yang sedang diedit
            ],
            'konten' => [
                'label' => 'Konten',
                'rules' => 'required|min_length[20]' // Konten harus ada dan panjang minimum 20 karakter
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]'
            ]
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menangani upload file foto
        $fotoPath = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fotoName = $foto->getRandomName();

            // Memindahkan file ke folder public/images/berita
            if ($foto->move('public/images/berita', $fotoName)) {
                // Jika berhasil, simpan path foto
                $fotoPath = 'images/berita/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file foto.']);
            }
        }

        // Cek apakah slug sudah digunakan oleh berita lain (selain berita ini)
        $slugExists = $model->where('slug', $slug)
            ->where('id_berita !=', $id) // Abaikan berita yang sedang diedit
            ->first();

        if ($slugExists) {
            // Jika slug sudah ada pada berita lain, kirim pesan kesalahan ke view
            return $this->response->setJSON([
                'success' => false,
                'messages' => [
                    'judul' => 'Judul berita ini sudah digunakan. Silakan gunakan judul yang berbeda.'
                ]
            ]);
        }

        // Menangani upload file foto
        $fotoPath = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fotoName = $foto->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($foto->move('public/images/berita', $fotoName)) {
                // Jika berhasil, simpan path foto
                $fotoPath = 'images/berita/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file foto.']);
            }
        }

        // Siapkan data untuk diupdate
        $data = [
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'slug' => $slug,
            'konten' => htmlspecialchars($konten, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
        ];

        // Jika ada foto baru yang diupload, masukkan ke dalam data
        if (!empty($fotoPath)) {
            $data['foto'] = $fotoPath;
        }

        // Simpan berita yang sudah diperbarui
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Berita berhasil diperbarui.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui berita.']);
        }
    }

    public function updateStatusBerita()
    {
        // Inisialisasi model
        $model = new BeritaModel();

        // Ambil data dari POST request
        $id_berita = $this->request->getPost('id_berita');
        $status = $this->request->getPost('status');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_berita && $status) {
            // Dapatkan tanggal dan waktu saat ini
            $tanggal = date('Y-m-d');

            // Update status dan tanggal diubah di database
            $model->update($id_berita, [
                'status' => $status,
                'tanggal' => $tanggal // Update tanggal saat status diubah
            ]);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function hapusBerita($id_berita)
    {
        $model = new BeritaModel();

        // Cari berita berdasarkan ID
        $berita = $model->find($id_berita);

        if ($berita) {
            // Jika berita ditemukan, hapus file terkait jika ada
            if (!empty($berita['foto'])) { // Kolom 'foto' menyimpan path file
                $filePath = FCPATH . 'public/' . $berita['foto']; // Mendapatkan path lengkap file
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file dari server
                }
            }

            // Hapus berita dari database
            if ($model->delete($id_berita)) {
                session()->setFlashdata('success', 'Berita dan file terkait berhasil dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus berita dari database.');
            }
        } else {
            session()->setFlashdata('error', 'Berita tidak ditemukan.');
        }

        return redirect()->to('/admin/berita'); // Sesuaikan dengan URL yang diinginkan
    }


    public function pengumumanadmin()
    {
        $model = new PengumumanModel();
        $perPage = 5;

        // Ambil parameter search dan status dari query string
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        // Query dasar untuk menampilkan pengumuman
        $query = $model->select('*');

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Pencarian berdasarkan keyword pada judul
        if ($keyword) {
            $query->like('judul', $keyword);
        }

        // Dapatkan data pengumuman dengan pagination
        $pengumumans = $query->orderBy('tanggal', 'DESC')
            ->paginate($perPage, 'pengumumans');

        // Data yang akan dikirimkan ke view
        $data = [
            'pengumumans' => $pengumumans,
            'title' => "Pengumuman Admin",
            'pager' => $model->pager,
            'keyword' => $keyword,
            'status' => $status,
        ];

        return view('admin/pengumuman', $data);
    }

    public function tambahpengumuman()
    {
        $data['title'] = "Tambah Pengumuman";
        return view('admin/tambahpengumumanadmin', $data);
    }

    public function tambahPengumumanAction()
    {
        $model = new PengumumanModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', TRUE);
        $konten = $this->request->getPost('konten');

        // Memproses foto yang diupload
        $foto = $this->request->getFile('foto');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[150]|is_unique[pengumuman.judul]' // Judul harus unik dan panjang antara 5 dan 125 karakter
            ],
            'konten' => [
                'label' => 'Konten',
                'rules' => 'required|min_length[20]' // Konten harus ada dan panjang minimum 20 karakter
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]'
            ]
        ]);


        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menghasilkan slug yang unik
        $slugExist = $model->where('slug', $slug)->first(); // Cek apakah slug sudah ada
        if ($slugExist) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => [
                    'judul' => 'Tautan dengan judul ini sudah tersedia. Silakan gunakan judul yang berbeda.'
                ]
            ]);
        }

        // Menangani upload file foto
        $fotoPath = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fotoName = $foto->getRandomName();

            // Memindahkan file ke folder public/images/pengumuman
            if ($foto->move('public/images/pengumuman', $fotoName)) {
                // Jika berhasil, simpan path foto ke database
                $fotoPath = 'images/pengumuman/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'messages' => 'Gagal menyimpan file foto.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'messages' => 'File tidak valid atau belum diupload.']);
        }

        // Simpan data pengumuman ke dalam database
        $data = [
            'id_admin' => session()->get('id_admin'),
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'slug' => $slug,
            'konten' => htmlspecialchars($konten, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'foto' => $fotoPath,
            'tanggal' => date('Y-m-d'),
        ];

        // Simpan pengumuman
        if ($model->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil ditambahkan.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel.']);
        }
    }

    public function detailpengumuman($slug)
    {
        $model = new PengumumanModel();
        $pengumuman = $model->getDetailPengumumanBySlug($slug);

        if (!$pengumuman) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        $data = [
            'title' => $pengumuman['judul'],
            'pengumuman' => $pengumuman,
        ];
        return view('admin/detailpengumuman', $data);
    }

    public function editPengumuman($id_pengumuman)
    {
        $model = new PengumumanModel();
        $pengumuman = $model->find($id_pengumuman); // Mengambil pengumuman berdasarkan id_pengumuman

        if (!$pengumuman) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Pengumuman - ' . $pengumuman['judul'],
            'pengumuman' => $pengumuman,
        ];
        return view('admin/editpengumuman', $data);
    }

    public function updatePengumumanAction($id)
    {
        $model = new PengumumanModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', TRUE);
        $konten = $this->request->getPost('konten');

        // Memproses foto yang diupload
        $foto = $this->request->getFile('foto');



        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[150]|is_unique[pengumuman.judul,id_pengumuman,' . $id . ']' // Judul harus unik kecuali untuk artikel yang sedang diedit
            ],
            'konten' => [
                'label' => 'Konten',
                'rules' => 'required|min_length[20]' // Konten harus ada dan panjang minimum 20 karakter
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => 'permit_empty|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,1024]'
            ]
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Cek apakah slug sudah digunakan oleh artikel lain (selain artikel ini)
        $slugExists = $model->where('slug', $slug)
            ->where('id_pengumuman !=', $id) // Abaikan artikel yang sedang diedit
            ->first();

        if ($slugExists) {
            // Jika slug sudah ada pada artikel lain, kirim pesan kesalahan ke view
            return $this->response->setJSON([
                'success' => false,
                'messages' => [
                    'judul' => 'Judul artikel ini sudah digunakan. Silakan gunakan judul yang berbeda.'
                ]
            ]);
        }

        // Menangani upload file foto
        $fotoPath = '';
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fotoName = $foto->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($foto->move('public/images/pengumuman', $fotoName)) {
                // Jika berhasil, simpan path foto
                $fotoPath = 'images/pengumuman/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file foto.']);
            }
        }

        // Siapkan data untuk diupdate
        $data = [
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'slug' => $slug,
            'konten' => htmlspecialchars($konten, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
        ];

        // Jika ada foto baru yang diupload, masukkan ke dalam data
        if (!empty($fotoPath)) {
            $data['foto'] = $fotoPath;
        }

        // Simpan artikel yang sudah diperbarui
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Pengumuman berhasil diperbarui.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui pengumuman.']);
        }
    }

    public function updateStatusPengumuman()
    {
        // Inisialisasi model
        $model = new PengumumanModel();

        // Ambil data dari POST request
        $id_pengumuman = $this->request->getPost('id_pengumuman');
        $status = $this->request->getPost('status');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_pengumuman && $status) {
            // Dapatkan tanggal dan waktu saat ini
            $tanggal = date('Y-m-d');

            // Update status dan tanggal diubah di database
            $model->update($id_pengumuman, [
                'status' => $status,
                'tanggal' => $tanggal // Update tanggal saat status diubah
            ]);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function hapusPengumuman($id_pengumuman)
    {
        $model = new PengumumanModel();

        // Ambil data pengumuman berdasarkan ID untuk mendapatkan path file gambar
        $pengumuman = $model->find($id_pengumuman);

        if ($pengumuman) {
            // Jika pengumuman ditemukan, hapus file terkait jika ada
            if (!empty($pengumuman['foto'])) { // Kolom 'foto' menyimpan path file
                $filePath = FCPATH . 'public/' . $pengumuman['foto']; // Mendapatkan path lengkap file
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file dari server
                }
            }

            // Hapus data pengumuman dari database
            if ($model->delete($id_pengumuman)) {
                session()->setFlashdata('success', 'Pengumuman berhasil dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus pengumuman di database.');
            }
        } else {
            session()->setFlashdata('error', 'Data pengumuman tidak ditemukan.');
        }

        return redirect()->to('/admin/pengumuman'); // Sesuaikan dengan URL yang diinginkan
    }


    public function peraturanadmin()
    {
        $model = new PeraturanModel();
        $perPage = 5;

        // Ambil parameter search dan status dari query string
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        // Query dasar untuk menampilkan peraturan
        $query = $model->select('*');

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Pencarian berdasarkan keyword pada judul
        if ($keyword) {
            $query->like('judul', $keyword);
        }

        // Dapatkan data peraturan dengan pagination
        $peraturans = $query->orderBy('tanggal', 'DESC')
            ->paginate($perPage, 'peraturans');

        // Data yang akan dikirimkan ke view
        $data = [
            'peraturans' => $peraturans,
            'title' => "Peraturan dan Kebijakan",
            'pager' => $model->pager,
            'keyword' => $keyword,
            'status' => $status,
        ];

        return view('admin/peraturan', $data);
    }

    public function tambahperaturan()
    {
        $data['title'] = "Tambah Peraturan / Kebijakan";
        return view('admin/tambahperaturan', $data);
    }

    public function tambahPeraturanAction()
    {
        $model = new PeraturanModel();

        // Ambil input dari formulir
        $judulPeraturan = $this->request->getPost('judul');
        $tentang = $this->request->getPost('tentang');
        $jenis = $this->request->getPost('jenis');

        // Memproses file yang diupload
        $file = $this->request->getFile('file');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]' // Judul harus minimal 5 karakter
            ],
            'tentang' => [
                'label' => 'Tentang',
                'rules' => 'required|min_length[10]' // Tentang harus minimal 10 karakter
            ],
            'jenis' => [
                'label' => 'Jenis',
                'rules' => 'required' // Jenis harus diisi
            ],
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|mime_in[file,application/pdf]'
            ]
        ]);

        // Validasi
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menangani upload file
        $filePath = '';
        if ($file->isValid() && !$file->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fileName = $file->getRandomName();

            // Memindahkan file ke folder public/doc/peraturan
            if ($file->move('doc/peraturan', $fileName)) {
                // Jika berhasil, simpan path file ke database
                $filePath = 'doc/peraturan/' . $fileName;
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan file.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid atau belum diupload.']);
        }

        // Simpan data peraturan ke dalam database
        $data = [
            'id_admin' => session()->get('id_admin'),
            'judul' => htmlspecialchars($judulPeraturan, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'tentang' => htmlspecialchars($tentang, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'jenis' => htmlspecialchars($jenis, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'file' => $filePath,
            'tanggal' => date('Y-m-d'),
        ];

        // Simpan peraturan
        if ($model->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Peraturan berhasil ditambahkan.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan peraturan.']);
        }
    }


    public function detailperaturan($id_peraturan)
    {
        $model = new PeraturanModel();
        $peraturan = $model->find($id_peraturan);

        if (!$peraturan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $peraturan['judul'],
            'peraturan' => $peraturan,
        ];
        return view('admin/detailperaturan', $data);
    }

    public function editPeraturan($id_peraturan)
    {
        $model = new PeraturanModel();
        $peraturan = $model->find($id_peraturan); // Mengambil artikel berdasarkan id_artikel

        if (!$peraturan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Peraturan tidak ditemukan");
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit peraturan - ' . $peraturan['judul'],
            'peraturan' => $peraturan,
        ];
        return view('admin/editperaturan', $data);
    }

    public function updatePeraturanAction($id)
    {
        $model = new PeraturanModel();

        // Ambil input dari formulir
        $judulPeraturan = $this->request->getPost('judul');
        $tentang = $this->request->getPost('tentang');
        $jenis = $this->request->getPost('jenis');

        // Memproses foto yang diupload
        $file = $this->request->getFile('file');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]' // Judul harus unik dan panjang antara 5 dan 125 karakter
            ],
            'tentang' => [
                'label' => 'Tentang',
                'rules' => 'required|min_length[10]' // Konten harus ada dan panjang minimum 20 karakter
            ],
            'jenis' => [
                'label' => 'Jenis',
                'rules' => 'required'
            ],
            'file' => [
                'label' => 'File',
                'rules' => 'permit_empty|uploaded[file]|mime_in[file,application/pdf]|max_size[file,1024]'
            ]
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menangani upload file file
        $filePath = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fileName = $file->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($file->move('doc/peraturan', $fileName)) {
                // Jika berhasil, simpan path file
                $filePath = 'doc/peraturan/' . $fileName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file file.']);
            }
        }

        // Siapkan data untuk diupdate
        $data = [
            'judul' => htmlspecialchars($judulPeraturan, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'tentang' => htmlspecialchars($tentang, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'jenis' => htmlspecialchars($jenis, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
        ];

        // Jika ada file baru yang diupload, masukkan ke dalam data
        if (!empty($filePath)) {
            $data['file'] = $filePath;
        }

        // Simpan artikel yang sudah diperbarui
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Peraturan / Kebijakan berhasil diperbarui.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui peraturan / kebijakan.']);
        }
    }

    public function updatestatusperaturan()
    {
        // Inisialisasi model
        $model = new PeraturanModel();

        // Ambil data dari POST request
        $id_peraturan = $this->request->getPost('id_peraturan');
        $status = $this->request->getPost('status');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_peraturan && $status) {

            $model->update($id_peraturan, [
                'status' => $status,
            ]);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function hapusPeraturan($id_peraturan)
    {
        $model = new PeraturanModel();

        // Cari peraturan berdasarkan ID
        $peraturan = $model->find($id_peraturan);

        if ($peraturan) {
            // Jika peraturan ditemukan, hapus file terkait jika ada
            if (!empty($peraturan['file'])) { // Kolom 'file' menyimpan path file dokumen
                // Memastikan path benar tanpa duplikasi
                $fileDokumenPath = FCPATH . $peraturan['file']; // Path lengkap file dokumen

                // Cek apakah file ada sebelum menghapus
                if (file_exists($fileDokumenPath)) {
                    // Log untuk memastikan path
                    log_message('debug', 'Hapus file: ' . $fileDokumenPath);

                    // Hapus file dokumen dari server
                    unlink($fileDokumenPath);
                } else {
                    // Log jika file tidak ditemukan
                    log_message('error', 'File tidak ditemukan: ' . $fileDokumenPath);
                }
            }

            // Hapus peraturan dari database
            if ($model->delete($id_peraturan)) {
                session()->setFlashdata('success', 'peraturan dan file terkait berhasil dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus peraturan dari database.');
            }
        } else {
            session()->setFlashdata('error', 'peraturan tidak ditemukan.');
        }

        return redirect()->to('/admin/peraturan-kebijakan'); // Sesuaikan dengan URL yang diinginkan
    }

    public function videoAdmin()
    {
        $model = new VideoModel();

        $perPage = 5;

        // Ambil parameter search dan status dari query string
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        // Query dasar untuk menampilkan video
        $query = $model->select('*');

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Pencarian berdasarkan keyword pada judul
        if ($keyword) {
            $query->like('judul_video', $keyword);
        }

        // Dapatkan data video dengan pagination
        $videos = $query->orderBy('tanggal', 'DESC')
            ->paginate($perPage, 'videos');

        // Data yang akan dikirimkan ke view
        $data = [
            'videos' => $videos,
            'title' => "Video Kalpataru",
            'pager' => $model->pager,
            'keyword' => $keyword,
            'status' => $status,
        ];

        return view('admin/video', $data);
    }

    public function tambahvideo()
    {
        $data['title'] = "Tambah Video";
        return view('admin/tambahvideo', $data);
    }

    public function tambahVideoAction()
    {
        $model = new VideoModel();

        // Ambil input dari formulir
        $judulVideo = $this->request->getPost('judul');
        $link = $this->request->getPost('link');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[video.judul_video]'
            ],
            'link' => [
                'label' => 'Link',
                'rules' => 'required'
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Simpan data artikel ke dalam database
        $data = [
            'judul_video' => htmlspecialchars($judulVideo, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'link_video' => htmlspecialchars($link, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'tanggal' => date('Y-m-d'),
        ];

        // Simpan artikel
        if ($model->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil ditambahkan.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel.']);
        }
    }

    public function detailvideo($id_video)
    {
        $model = new VideoModel();
        $video = $model->find($id_video);

        if (!$video) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $video['judul_video'],
            'video' => $video,
        ];
        return view('admin/detailvideo', $data);
    }

    public function editVideo($id_video)
    {
        $model = new VideoModel();
        $video = $model->find($id_video); // Mengambil artikel berdasarkan id_artikel

        if (!$video) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Video - ' . $video['judul_video'],
            'video' => $video,
        ];
        return view('admin/editvideo', $data);
    }

    public function updateVideoAction($id)
    {
        $model = new VideoModel();

        // Ambil input dari formulir
        $judulVideo = $this->request->getPost('judul');
        $link = $this->request->getPost('link');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[video.judul_video,id_video,' . $id . ']'
            ],
            'link' => [
                'label' => 'Link',
                'rules' => 'required'
            ],
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Simpan data artikel ke dalam database
        $data = [
            'judul_video' => htmlspecialchars($judulVideo, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'link_video' => htmlspecialchars($link, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
        ];

        // Simpan artikel yang sudah diperbarui
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Video berhasil diperbarui']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui video']);
        }
    }

    public function updateStatusVideo()
    {
        // Inisialisasi model
        $model = new VideoModel();

        // Ambil data dari POST request
        $id_video = $this->request->getPost('id_video');
        $status = $this->request->getPost('status');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_video && $status) {
            // Dapatkan tanggal dan waktu saat ini
            $tanggal = date('Y-m-d');

            $model->update($id_video, [
                'status' => $status,
                'tanggal' => $tanggal // Update tanggal saat status diubah
            ]);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function hapusVideo($id_video)
    {
        $model = new VideoModel();

        // Hapus artikel berdasarkan ID
        if ($model->delete($id_video)) {
            // Set flash message atau lakukan redirect setelah menghapus
            session()->setFlashdata('success', 'Video berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus video');
        }

        return redirect()->to('/admin/video'); // Sesuaikan dengan URL yang diinginkan
    }

    public function bukuAdmin()
    {
        $model = new BukuModel();
        $perPage = 5;

        // Ambil parameter search dan status dari query string
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        // Query dasar untuk menampilkan buku
        $query = $model->select('*');

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Pencarian berdasarkan keyword pada judul
        if ($keyword) {
            $query->like('judul', $keyword);
        }

        // Dapatkan data buku dengan pagination
        $bukus = $query->orderBy('tanggal', 'DESC')
            ->paginate($perPage, 'bukus');

        // Data yang akan dikirimkan ke view
        $data = [
            'bukus' => $bukus,
            'title' => "Buku Penghargaan Kalpataru",
            'pager' => $model->pager,
            'keyword' => $keyword,
            'status' => $status,
        ];

        return view('admin/buku', $data);
    }

    public function tambahbuku()
    {
        $data['title'] = "Tambah Buku";
        return view('admin/tambahbuku', $data);
    }

    public function tambahBukuAction()
    {
        $model = new BukuModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $file = $this->request->getFile('file');
        $cover = $this->request->getFile('cover');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[buku_kalpataru.judul]' // Judul harus unik dan panjang antara 5 dan 125 karakter
            ],
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|mime_in[file,application/pdf]'
            ],
            'cover' => [
                'label' => 'Cover',
                'rules' => 'uploaded[cover]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]'
            ]
        ]);


        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menangani upload file foto
        $coverPath = '';
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $coverName = $cover->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($cover->move('public/images/buku', $coverName)) {
                // Jika berhasil, simpan path cover ke database
                $coverPath = 'images/buku/' . $coverName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file cover.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => 'File tidak valid atau belum diupload.']);
        }

        // Menangani upload file
        $filePath = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fileName = $file->getRandomName();

            // Memindahkan file ke folder public/doc/peraturan
            if ($file->move('doc/buku', $fileName)) {
                // Jika berhasil, simpan path file ke database
                $filePath = 'doc/buku/' . $fileName;
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan file.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid atau belum diupload.']);
        }

        // Simpan data artikel ke dalam database
        $data = [
            'id_admin' => session()->get('id_admin'),
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'cover' => $coverPath,
            'file' => $filePath,
            'tanggal' => date('Y-m-d'),
        ];

        // Simpan artikel
        if ($model->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil ditambahkan.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel.']);
        }
    }

    public function detailBuku($id_buku)
    {
        $model = new BukuModel();
        $buku = $model->find($id_buku);

        if (!$buku) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $buku['judul'],
            'buku' => $buku,
        ];
        return view('admin/detailbuku', $data);
    }

    public function editBuku($id_buku)
    {
        $model = new BukuModel();
        $buku = $model->find($id_buku); // Mengambil buku berdasarkan id_buku

        if (!$buku) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID admin yang sedang login
        $id_admin = session()->get('id_admin');

        // Cek apakah yang mengakses adalah admin
        if (!$id_admin) {
            // Jika bukan admin, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Buku - ' . $buku['judul'],
            'buku' => $buku,
        ];
        return view('admin/editbuku', $data);
    }

    public function updateBukuAction($id)
    {
        $model = new BukuModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $file = $this->request->getFile('file');
        $cover = $this->request->getFile('cover');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[buku_kalpataru.judul,id_buku,' . $id . ']' // Judul harus unik dan panjang antara 5 dan 125 karakter
            ],
            'file' => [
                'label' => 'File',
                'rules' => 'permit_empty|uploaded[file]|mime_in[file,application/pdf]'
            ],
            'cover' => [
                'label' => 'Cover',
                'rules' => 'permit_empty|uploaded[cover]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]|max_size[cover,1024]'
            ]
        ]);


        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Menangani upload file foto
        $coverPath = '';
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $coverName = $cover->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($cover->move('public/images/buku', $coverName)) {
                // Jika berhasil, simpan path cover
                $coverPath = 'images/buku/' . $coverName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan cover.']);
            }
        }

        // Menangani upload file
        $filePath = '';
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Memastikan tipe file dan membuat nama file acak
            $fileName = $file->getRandomName();

            // Memindahkan file ke folder public/images/artikel
            if ($file->move('doc/buku', $fileName)) {
                // Jika berhasil, simpan path file
                $filePath = 'doc/buku/' . $fileName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file.']);
            }
        }

        // Simpan data artikel ke dalam database
        $data = [
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
        ];

        if (!empty($coverPath)) {
            $data['cover'] = $coverPath;
        }

        if (!empty($filePath)) {
            $data['file'] = $filePath;
        }

        // Simpan artikel yang sudah diperbarui
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Buku berhasil diperbarui.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui buku.']);
        }
    }

    public function updateStatusBuku()
    {
        // Inisialisasi model
        $model = new BukuModel();

        // Ambil data dari POST request
        $id_buku = $this->request->getPost('id_buku');
        $status = $this->request->getPost('status');

        // Validasi data (opsional, misalnya cek apakah ID dan status valid)
        if ($id_buku && $status) {

            $model->update($id_buku, [
                'status' => $status,
            ]);

            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            // Mengembalikan respons untuk merefresh halaman
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
        }
    }

    public function hapusBuku($id_buku)
    {
        $model = new BukuModel();

        // Cari buku berdasarkan ID
        $buku = $model->find($id_buku);

        if ($buku) {
            // Jika buku ditemukan, hapus file terkait jika ada
            if (!empty($buku['file'])) { // Kolom 'file' menyimpan path file dokumen
                // Memastikan path benar tanpa duplikasi
                $fileDokumenPath = FCPATH . $buku['file']; // Path lengkap file dokumen

                // Cek apakah file ada sebelum menghapus
                if (file_exists($fileDokumenPath)) {
                    // Log untuk memastikan path
                    log_message('debug', 'Hapus file: ' . $fileDokumenPath);

                    // Hapus file dokumen dari server
                    unlink($fileDokumenPath);
                } else {
                    // Log jika file tidak ditemukan
                    log_message('error', 'File tidak ditemukan: ' . $fileDokumenPath);
                }
            }

            // Hapus cover buku jika ada
            if (!empty($buku['cover'])) { // Kolom 'cover' menyimpan path file cover
                $coverPath = FCPATH . 'public/' . $buku['cover']; // Path lengkap cover

                // Cek apakah cover ada sebelum menghapus
                if (file_exists($coverPath)) {
                    unlink($coverPath); // Hapus file cover dari server
                }
            }

            // Hapus buku dari database
            if ($model->delete($id_buku)) {
                session()->setFlashdata('success', 'Buku dan file terkait berhasil dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus buku dari database.');
            }
        } else {
            session()->setFlashdata('error', 'Buku tidak ditemukan.');
        }

        return redirect()->to('/admin/buku-kalpataru'); // Sesuaikan dengan URL yang diinginkan
    }

    public function exportPDF($kode_registrasi)
    {
        $id_admin = session()->get('id_admin');

        if (!$id_admin) {
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

        $html = view('admin/pdf', $data);

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

    public function exportToExcel()
    {
        $db = \Config\Database::connect();

        $query = $db->query("
        SELECT 
            p.kategori, p.nama, p.nik, p.tempat_lahir, p.tanggal_lahir, p.usia, p.jenis_kelamin, p.jalan, 
            p.rt_rw, p.desa, p.kecamatan, p.kab_kota, p.provinsi, p.kode_pos, p.pekerjaan, p.telepon, 
            p.email, p.sosial_media, p.pendidikan, p.nama_kelompok, p.jumlah_anggota, p.tahun_pembentukan,
            k.tema, k.sub_tema, k.bentuk_kegiatan, k.tahun_mulai, k.deskripsi_kegiatan, k.lokasi_kegiatan, 
            k.koordinat, k.pihak_dan_peran, k.keberhasilan,
            d.dampak_lingkungan, d.dampak_ekonomi, d.dampak_sosial_budaya,
            pm.prakarsa, pm.motivasi, pm.inovasi, pm.kreativitas,
            ks.sumber_biaya, ks.teknologi_kegiatan, ks.status_lahan_kegiatan, ks.jumlah_kelompok_serupa,
            ke.keistimewaan, ke.penghargaan
        FROM pendaftaran p
        LEFT JOIN kegiatan k ON p.id_pendaftaran = k.id_pendaftaran
        LEFT JOIN dampak d ON p.id_pendaftaran = d.id_pendaftaran
        LEFT JOIN pmik pm ON p.id_pendaftaran = pm.id_pendaftaran
        LEFT JOIN keswadayaan ks ON p.id_pendaftaran = ks.id_pendaftaran
        LEFT JOIN keistimewaan ke ON p.id_pendaftaran = ke.id_pendaftaran
    ");

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Data Pendaftaran");

        $data = $query->getResultArray();

        // Header Kolom Kustom
        $headers = [
            'Kategori',
            'Nama',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Usia',
            'Jenis Kelamin',
            'Alamat Jalan',
            'RT/RW',
            'Desa/Kelurahan',
            'Kecamatan',
            'Kabupaten/Kota',
            'Provinsi',
            'Kode Pos',
            'Pekerjaan',
            'Telepon',
            'Email',
            'Sosial Media',
            'Pendidikan',
            'Nama Kelompok',
            'Jumlah Anggota',
            'Tahun Pembentukan',
            'Tema Kegiatan',
            'Sub Tema',
            'Bentuk Kegiatan',
            'Tahun Mulai',
            'Deskripsi Kegiatan',
            'Lokasi Kegiatan',
            'Koordinat Lokasi',
            'Pihak dan Peran',
            'Keberhasilan',
            'Dampak Lingkungan',
            'Dampak Ekonomi',
            'Dampak Sosial Budaya',
            'Prakarsa',
            'Motivasi',
            'Inovasi',
            'Kreativitas',
            'Sumber Biaya',
            'Teknologi Kegiatan',
            'Status Lahan Kegiatan',
            'Jumlah Kelompok Serupa',
            'Keistimewaan',
            'Penghargaan'
        ];

        // Mengisi Header
        $columnCount = count($headers); // Menghitung jumlah kolom
        $columnLetter = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '1', $header);
            $columnLetter++;
        }

        // Isi Data
        $rowIndex = 2;
        foreach ($data as $row) {
            $columnLetter = 'A';
            foreach ($row as $cellData) {
                $sheet->setCellValue($columnLetter . $rowIndex, $cellData);
                $columnLetter++;
            }
            $rowIndex++;
        }

        // Mengatur lebar kolom otomatis
        for ($col = 0; $col < $columnCount; $col++) {
            $sheet->getColumnDimensionByColumn($col + 1)->setAutoSize(true); // +1 karena setColumnDimensionByColumn menggunakan indeks 1
        }

        // Unduh file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data_Pendaftaran_Ekspor.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportArsipToExcel()
    {
        $db = \Config\Database::connect();

        // Ambil parameter dari URL
        $kategori = $this->request->getGet('kategori');
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort') ?? 'asc'; // Default sort adalah 'asc'

        // Siapkan builder untuk query
        $builder = $db->table('arsip_penerima');

        // Filter berdasarkan kategori, jika ada
        if ($kategori) {
            $builder->where('kategori', $kategori);
        }

        // Filter berdasarkan pencarian, jika ada
        if ($search) {
            $builder->like('nama', $search);
        }

        // Tentukan urutan berdasarkan kolom tahun_penerimaan
        $builder->orderBy('tahun_penerimaan', $sort);

        // Pilih kolom yang diinginkan
        $builder->select([
            'nama',
            'usia',
            'jenis_kelamin',
            'telepon',
            'email',
            'kategori',
            'tema',
            'sub_tema',
            'bentuk_kegiatan',
            'tahun_penerimaan',
            'status',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'desa',
            'nama_pengusul',
            'instansi_pengusul',
            'email_pengusul',
            'jabatan_pengusul',
            'telepon_pengusul'
        ]);

        // Eksekusi query untuk mendapatkan data
        $data = $builder->get()->getResultArray();

        // Membuat file Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Data Arsip Penerima");

        // Header Kolom
        $headers = [
            'Nama',
            'Usia',
            'Jenis Kelamin',
            'Telepon',
            'Email',
            'Kategori',
            'Tema',
            'Sub Tema',
            'Bentuk Kegiatan',
            'Tahun Penerimaan',
            'Status',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Desa',
            'Nama Pengusul',
            'Instansi Pengusul',
            'Email Pengusul',
            'Jabatan Pengusul',
            'Telepon Pengusul'
        ];

        // Mengisi Header
        $columnLetter = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '1', $header);
            $columnLetter++;
        }

        // Isi Data
        $rowIndex = 2;
        foreach ($data as $row) {
            $columnLetter = 'A';
            foreach ($row as $cellData) {
                $sheet->setCellValue($columnLetter . $rowIndex, $cellData);
                $columnLetter++;
            }
            $rowIndex++;
        }

        // Mengatur lebar kolom otomatis
        $columnCount = count($headers);
        for ($col = 0; $col < $columnCount; $col++) {
            $sheet->getColumnDimensionByColumn($col + 1)->setAutoSize(true);
        }

        // Unduh file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data_Arsip_Penerima.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    public function postercapaian()
    {
        $data['title'] = "Poster Capaian";
        $model = new CapaianModel();
        $data['capaian'] = $model->first();

        return view('admin/postercapaian', $data);
    }

    public function editcapaian()
    {
        $id_capaian = $this->request->getPost('id_capaian');
        $status = $this->request->getPost('status');
        $file = $this->request->getFile('gambar');

        $model = new CapaianModel();
        $data = ['status' => $status];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $originalName = $file->getClientName();
            $file->move(WRITEPATH . 'uploads/capaian', $originalName);
            $data['gambar'] = $originalName;
        } else {
            $data['gambar'] = $this->request->getPost('gambar_lama');
        }

        $existingRecord = $model->first();

        if ($existingRecord) {
            $model->update($existingRecord['id_capaian'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('/admin/postercapaian')->with('success', 'Data updated successfully');
    }
}
