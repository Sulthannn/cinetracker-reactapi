<?php

namespace App\Controllers;

use App\Models\PengusulModel;
use App\Models\PendaftaranModel;
use App\Models\ArtikelModel;
use App\Models\KegiatanModel;
use App\Models\DampakModel;
use App\Models\PmikModel;
use App\Models\KeswadayaanModel;
use App\Models\KeistimewaanModel;
use Dompdf\Dompdf;
use Dompdf\Options;
// use CodeIgniter\Controller;

class PengusulController extends BaseController
{
    protected $PendaftaranModel;
    protected $pengusulModel;

    public function __construct()
    {
        $this->PendaftaranModel = new PendaftaranModel();
        $this->pengusulModel = new PengusulModel();
    }

    public function index(): string
    {
        $pengusulModel = new PengusulModel();
        $data['pengusul'] = $pengusulModel->where('id_pengusul', session()->get('id_pengusul'))->first();
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('authMessage', 'Harap login terlebih dahulu');
        }

        $data['title'] = 'Profil Pengusul';
        return view('pengusul/profil', $data);
    }

    public function updateProfil()
    {
        $pengusulModel = new PengusulModel();

        $id_pengusul = session()->get('id_pengusul');

        $currentSuratPengantar = session()->get('surat_pengantar');

        $file = $this->request->getFile('surat_pengantar');
        $filePath = $currentSuratPengantar;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($file->getClientMimeType() == 'application/pdf') {
                $filePath = $file->store('suratpengantar', $file->getRandomName());
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Invalid file type. Only PDF files are allowed']);
            }
        }

        $data = [
            'nama_instansi_pribadi' => $this->request->getPost('nama_instansi_pribadi'),
            'instansi' => $this->request->getPost('instansi'),
            'jabatan_pekerjaan' => $this->request->getPost('jabatan_pekerjaan'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'jalan' => $this->request->getPost('jalan'),
            'rt_rw' => $this->request->getPost('rt_rw'),
            'desa' => $this->request->getPost('desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kab_kota' => $this->request->getPost('kab_kota'),
            'kode_pos' => $this->request->getPost('kode_pos'),
        ];

        if (!empty($filePath)) {
            $data['surat_pengantar'] = $filePath;
        }

        if ($pengusulModel->update($id_pengusul, $data)) {
            session()->set($data);

            return $this->response->setJSON(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui profil.']);
        }
    }

    public function tambahcalon()
    {
        $id_pengusul = session()->get('id_pengusul');

        $data = [
            'title' => 'Alur Pendaftaran',
            'id_pengusul' => $id_pengusul
        ];

        if (!$id_pengusul) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Calon Usulan',
            'id_pengusul' => $id_pengusul,
        ];
        return view('pengusul/tambahcalon', $data);
    }

    public function inputKategori()
    {
        $Model = new PendaftaranModel();
        $id_pengusul = $this->request->getPost('id_pengusul');
        $kategori = $this->request->getPost('kategori');

        $data = [
            'id_pengusul' => $id_pengusul,
            'kategori' => $kategori,
            'tanggal_pendaftaran' => date('Y-m-d H:i:s'),
            'title' => 'Input Kategori'
        ];

        session()->set('pendaftaran_data', $data);

        return redirect()->to('pengusul/tambahcalonidentitas')->with('success', 'Kategori berhasil dipilih, lanjutkan mengisi identitas.');
    }

    public function updateStatus()
    {
        // Validasi ID pendaftaran
        $id_pendaftaran = $this->request->getPost('id_pendaftaran');

        if (!$id_pendaftaran) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID pendaftaran tidak ditemukan']);
        }

        // Ambil model
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data pendaftaran berdasarkan ID untuk mendapatkan kategori
        $pendaftaran = $pendaftaranModel->find($id_pendaftaran);
        if (!$pendaftaran) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan']);
        }

        // Tentukan prefix berdasarkan kategori
        $kategori = $pendaftaran['kategori'];
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

        // Gunakan transaksi untuk menghindari duplikasi kode registrasi
        $db = \Config\Database::connect();
        $db->transStart();

        // Hitung total kategori yang ada dengan prefix tersebut
        $totalKategori = $pendaftaranModel->where('kategori', $kategori)->countAllResults();

        // Buat kode registrasi yang unik
        $kode_registrasi = $prefix . str_pad($totalKategori + 1, 2, '0', STR_PAD_LEFT);

        // Perbarui data dengan kode_registrasi baru dan status yang telah diubah
        $data = [
            'kode_registrasi' => $kode_registrasi,
            'status_pendaftaran' => 'Terkirim',
            'edit' => 'Off',
        ];

        // Update data pendaftaran
        $updated = $pendaftaranModel->update($id_pendaftaran, $data);

        // Selesaikan transaksi
        $db->transComplete();

        if ($db->transStatus() === false || !$updated) {
            // Jika ada kesalahan, rollback transaksi dan kirim respons gagal
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status dan kode registrasi']);
        }

        // Kirim respons berhasil
        return $this->response->setJSON(['success' => true]);
    }


    public function tambahCalonIdentitas()
    {
        $pendaftaranData = session()->get('pendaftaran_data');

        if (!$pendaftaranData || !isset($pendaftaranData['kategori'])) {
            return redirect()->back()->with('error', 'Data kategori atau pendaftaran tidak ditemukan.');
        }


        $data = [
            'title' => 'Tambah Identitas Calon Usulan',
            'id_pengusul' => $pendaftaranData['id_pengusul'],
            'kategori' => $pendaftaranData['kategori'],
        ];

        return view('pengusul/tambahcalonidentitas', $data);
    }

    public function simpanCalonIdentitas()
    {
        $Model = new PendaftaranModel();

        // Ambil data pendaftaran dari session
        $pendaftaranData = session()->get('pendaftaran_data');

        if (!$pendaftaranData || !isset($pendaftaranData['kategori'])) {
            return redirect()->back()->with('error', 'Data kategori atau pendaftaran tidak ditemukan.');
        }

        $validation = \Config\Services::validation();

        // Aturan validasi
        $rules = [
            'nama'              => 'required|min_length[3]|max_length[100]',
            'nik'               => 'required|exact_length[16]|numeric|is_unique[pendaftaran.nik]',
            'tempat_lahir'      => 'required|min_length[2]|max_length[50]',
            'tanggal_lahir'     => 'required|valid_date',
            'usia'              => 'required|numeric|min_length[1]|max_length[3]',
            'jenis_kelamin'     => 'required',
            'pekerjaan'         => 'required|min_length[3]|max_length[100]',
            'telepon'           => 'required|numeric|min_length[10]|max_length[15]',
            'email'             => 'required|valid_email|is_unique[pendaftaran.email]',
            'pendidikan'        => 'required|min_length[2]|max_length[50]',
            'jalan'             => 'required|min_length[3]|max_length[255]',
            'rt_rw'             => 'required|max_length[10]',
            'provinsi'          => 'required',
            'kab_kota'          => 'required',
            'kecamatan'         => 'required',
            'desa'              => 'required',
            'kode_pos'          => 'required|numeric|exact_length[5]',
            'media_sosial'      => 'permit_empty',
            'ktp'               => 'uploaded[ktp]|mime_in[ktp,image/jpg,image/jpeg]|max_size[ktp,1024]',
        ];

        if ($pendaftaranData['kategori'] == 'Penyelamat Lingkungan') {
            $rules['tahun_pembentukan'] = 'required|valid_date';
            $rules['jumlah_anggota'] = 'required|numeric|min_length[1]|max_length[5]';
            $rules['nama_kelompok'] = 'required|min_length[3]|max_length[100]';
            $rules['legalitas'] = 'uploaded[legalitas]|mime_in[legalitas,application/pdf]|max_size[legalitas,1024]';
            $rules['tanggal_legalitas'] = 'required|valid_date';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Pengelolaan file KTP, SKCK, dan legalitas
        $ktpFile = $this->request->getFile('ktp');
        $legalitasFile = $this->request->getFile('legalitas');

        // Proses file KTP
        $ktpFileName = $this->handleFileUpload($ktpFile, ['jpg', 'jpeg'], 'ktp');

        // Proses file legalitas (opsional)
        $legalitasFileName = null;
        if ($legalitasFile && $legalitasFile->isValid()) {
            $legalitasFileName = $this->handleFileUpload($legalitasFile, ['pdf'], 'legalitas');
        }

        // Simpan data lainnya tergantung kategori
        if ($pendaftaranData['kategori'] == 'Penyelamat Lingkungan') {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'tahun_pembentukan' => $this->request->getPost('tahun_pembentukan'),
                'jumlah_anggota' => $this->request->getPost('jumlah_anggota'),
                'jalan' => $this->request->getPost('jalan'),
                'rt_rw' => $this->request->getPost('rt_rw'),
                'provinsi' => $this->request->getPost('nama_provinsi'),
                'kab_kota' => $this->request->getPost('nama_kabupaten'),
                'kecamatan' => $this->request->getPost('nama_kecamatan'),
                'desa' => $this->request->getPost('nama_kelurahan'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'sosial_media' => $this->request->getPost('media_sosial'),
                'nama_kelompok' => $this->request->getPost('nama_kelompok'),
                'nik' => $this->request->getPost('nik'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'usia' => $this->request->getPost('usia'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'tanggal_legalitas' => $this->request->getPost('tanggal_legalitas'),
                'legalitas' => $legalitasFileName,
                'ktp' => $ktpFileName
            ];
        } else {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'nik' => $this->request->getPost('nik'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'usia' => $this->request->getPost('usia'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'jalan' => $this->request->getPost('jalan'),
                'rt_rw' => $this->request->getPost('rt_rw'),
                'provinsi' => $this->request->getPost('nama_provinsi'),
                'kab_kota' => $this->request->getPost('nama_kabupaten'),
                'kecamatan' => $this->request->getPost('nama_kecamatan'),
                'desa' => $this->request->getPost('nama_kelurahan'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'sosial_media' => $this->request->getPost('media_sosial'),
                'ktp' => $ktpFileName
            ];
        }


        // Gabungkan data identitas dengan data pendaftaran sebelumnya dari session
        $finalData = array_merge($pendaftaranData, $data);

        // Simpan data ke database
        if ($Model->insert($finalData)) {
            // Hapus session setelah data disimpan
            session()->remove('pendaftaran_data');

            return redirect()->to('pengusul/usulansaya')->with('success', 'Identitas berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Fungsi untuk menangani upload file.
     * 
     * @param \CodeIgniter\HTTP\Files\UploadedFile $file
     * @param array $allowedExtensions
     * @param string $directory
     * @return string|null Nama file yang telah diunggah atau null
     */
    private function handleFileUpload($file, $allowedExtensions, $directory)
    {
        if ($file instanceof \CodeIgniter\HTTP\Files\UploadedFile && $file->isValid() && !$file->hasMoved()) {
            if (in_array($file->getExtension(), $allowedExtensions) && $file->getSize() <= 1024 * 1024) {
                $originalName = pathinfo($file->getClientName(), PATHINFO_FILENAME);
                $extension = $file->getExtension();
                $fileName = $originalName . '_' . bin2hex(random_bytes(5)) . '.' . $extension;
                $file->move(WRITEPATH . 'uploads/' . $directory, $fileName);
                return $fileName;
            }
        }
        return null;
    }

    public function showKTP($filename)
    {
        // Cek dengan ekstensi .jpg
        $filePathJpg = WRITEPATH . 'uploads/ktp/' . $filename;
        if (file_exists($filePathJpg)) {
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody(file_get_contents($filePathJpg));
        }

        // Cek dengan ekstensi .jpeg
        $filePathJpeg = WRITEPATH . 'uploads/ktp/' . $filename;
        if (file_exists($filePathJpeg)) {
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody(file_get_contents($filePathJpeg));
        }

        // Jika tidak ada file yang ditemukan, lempar pengecualian
        throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
    }

    public function showFotoKegiatan($folder, $filename)
    {
        $filePath = WRITEPATH . "uploads/foto_kegiatan$folder/" . $filename;
        if (file_exists($filePath)) {
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody(file_get_contents($filePath));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
    }

    public function downloadFotoKegiatan($folder, $filename)
    {
        $filePath = WRITEPATH . "uploads/foto_kegiatan$folder/" . $filename;
        if (file_exists($filePath)) {
            return $this->response
                ->setHeader('Content-Type', 'application/octet-stream')
                ->setHeader('Content-Disposition', 'attachment; filename="' . basename($filePath) . '"')
                ->setBody(file_get_contents($filePath));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
    }


    public function downloadSKCK($filename)
    {
        $path = WRITEPATH . 'uploads/skck/' . $filename;

        if (!file_exists($path)) {
            // File tidak ditemukan, Anda bisa mengarahkan ke halaman error atau menampilkan pesan
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
        }

        // Menyajikan file dengan header download
        return $this->response->download($path, null);
    }

    public function downloadKTP($filename)
    {
        $path = WRITEPATH . 'uploads/ktp/' . $filename;

        if (!file_exists($path)) {
            // File tidak ditemukan, Anda bisa mengarahkan ke halaman error atau menampilkan pesan
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
        }

        // Menyajikan file dengan header download
        return $this->response->download($path, null);
    }

    public function downloadLegalitas($filename)
    {
        $path = WRITEPATH . 'uploads/legalitas/' . $filename;

        if (!file_exists($path)) {
            // File tidak ditemukan, Anda bisa mengarahkan ke halaman error atau menampilkan pesan
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
        }

        // Menyajikan file dengan header download
        return $this->response->download($path, null);
    }



    // ---------------DETAIL USULAN SAYA EDIT----------------------------------------------------------------------------------------------------

    public function simpanForm($formType)
    {
        $model = new PendaftaranModel();
        $id_pendaftaran = session()->get('id_pendaftaran');

        if (!$id_pendaftaran) {
            die('ID pendaftaran tidak ditemukan di session.');
        }

        switch ($formType) {
            case 'identitasc':
                $identitas = $model->getIdentitasByIdPendaftaran($id_pendaftaran);

                $skckFile = $this->request->getFile('skck');
                $skckFileName = $identitas['skck'];

                if ($skckFile && $skckFile->isValid() && !$skckFile->hasMoved()) {
                    $skckFileName = $this->handleFileUpload($skckFile, ['pdf'], 'skck');
                }

                $data = [
                    'nama' => $this->request->getPost('nama_ketua'),
                    'tahun_pembentukan' => $this->request->getPost('tahun_pembentukan'),
                    'jumlah_anggota' => $this->request->getPost('jumlah_anggota'),
                    'jalan' => $this->request->getPost('jalan'),
                    'rt_rw' => $this->request->getPost('rt_rw'),
                    'provinsi' => $this->request->getPost('nama_provinsi'),
                    'kab_kota' => $this->request->getPost('nama_kabupaten'),
                    'kecamatan' => $this->request->getPost('nama_kecamatan'),
                    'desa' => $this->request->getPost('nama_kelurahan'),
                    'kode_pos' => $this->request->getPost('kode_pos'),
                    'sosial_media' => $this->request->getPost('sosial_media'),
                    'nama_kelompok' => $this->request->getPost('nama_kelompok'),
                    'nik' => $this->request->getPost('nik'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                    'usia' => $this->request->getPost('usia'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'pekerjaan' => $this->request->getPost('pekerjaan'),
                    'telepon' => $this->request->getPost('telepon'),
                    'email' => $this->request->getPost('email'),
                    'pendidikan' => $this->request->getPost('pendidikan'),
                    'tanggal_skck' => $this->request->getPost('tanggal_skck'),
                    'skck' => $skckFileName
                ];

                $validationRules = [
                    'tahun_pembentukan' => ($identitas && !empty($data['tahun_pembentukan'])) ? 'permit_empty|min_length[2]|max_length[50]' : 'required|min_length[2]|max_length[50]',
                    'jumlah_anggota'    => ($identitas && !empty($data['jumlah_anggota'])) ? 'permit_empty|numeric|min_length[1]|max_length[3]' : 'required|numeric|min_length[1]|max_length[3]',
                    'nama_kelompok'     => ($identitas && !empty($data['nama_kelompok'])) ? 'permit_empty|min_length[3]|max_length[100]' : 'required|min_length[3]|max_length[100]',
                    'tanggal_legalitas' => ($identitas && !empty($data['tanggal_legalitas'])) ? 'permit_empty|min_length[2]|max_length[50]' : 'required|min_length[2]|max_length[50]',
                    'nama'              => ($identitas && !empty($data['nama'])) ? 'permit_empty|min_length[3]|max_length[100]' : 'required|min_length[3]|max_length[100]',
                    'nik'               => 'required|exact_length[16]|numeric|is_unique[pendaftaran.nik,id_pendaftaran,' . $id_pendaftaran . ']',
                    'tempat_lahir'      => ($identitas && !empty($data['tempat_lahir'])) ? 'permit_empty|min_length[2]|max_length[50]' : 'required|min_length[2]|max_length[50]',
                    'tanggal_lahir'     => ($identitas && !empty($data['tanggal_lahir'])) ? 'permit_empty|valid_date' : 'required|valid_date',
                    'usia'              => ($identitas && !empty($data['usia'])) ? 'permit_empty|numeric|min_length[1]|max_length[3]' : 'required|numeric|min_length[1]|max_length[3]',
                    'jenis_kelamin'     => ($identitas && !empty($data['jenis_kelamin'])) ? 'permit_empty' : 'required',
                    'pekerjaan'         => ($identitas && !empty($data['pekerjaan'])) ? 'permit_empty|min_length[3]|max_length[100]' : 'required|min_length[3]|max_length[100]',
                    'telepon'           => ($identitas && !empty($data['telepon'])) ? 'permit_empty|numeric|min_length[10]|max_length[15]' : 'required|numeric|min_length[10]|max_length[15]',
                    'email'             => 'required|valid_email|is_unique[pendaftaran.email,id_pendaftaran,' . $id_pendaftaran . ']',
                    'pendidikan'        => ($identitas && !empty($data['pendidikan'])) ? 'permit_empty|min_length[2]|max_length[50]' : 'required|min_length[2]|max_length[50]',
                    'jalan'             => ($identitas && !empty($data['jalan'])) ? 'permit_empty|min_length[3]|max_length[255]' : 'required|min_length[3]|max_length[255]',
                    'rt_rw'             => ($identitas && !empty($data['rt_rw'])) ? 'permit_empty|max_length[10]' : 'required|max_length[10]',
                    'desa'              => ($identitas && !empty($data['desa'])) ? 'permit_empty' : 'required',
                    'kecamatan'         => ($identitas && !empty($data['kecamatan'])) ? 'permit_empty' : 'required',
                    'kab_kota'          => ($identitas && !empty($data['kab_kota'])) ? 'permit_empty' : 'required',
                    'provinsi'          => ($identitas && !empty($data['provinsi'])) ? 'permit_empty' : 'required',
                    'kode_pos'          => ($identitas && !empty($data['kode_pos'])) ? 'permit_empty|numeric|exact_length[5]' : 'required|numeric|exact_length[5]',
                    'sosial_media'      => ($identitas && !empty($data['sosial_media'])) ? 'permit_empty' : 'permit_empty',
                    'tanggal_skck'      => ($identitas && !empty($data['tanggal_skck'])) ? 'permit_empty|valid_date' : 'required|valid_date',
                    'skck'              => ($identitas && !empty($data['skck'])) ? 'permit_empty|mime_in[skck,application/pdf]|max_size[skck,1024]' : 'required|uploaded[skck]|mime_in[skck,application/pdf]|max_size[skck,1024]',
                ];

                // Validasi input
                if (!$this->validate($validationRules)) {
                    // Jika validasi gagal
                    return redirect()->back()
                        ->withInput()
                        ->with('errors', $this->validator->getErrors())
                        ->with('status', 'error');
                }

                // Logika untuk upload file SKCK
                $legalitasFile = $this->request->getFile('legalitas');
                if ($legalitasFile && $legalitasFile->isValid() && !$legalitasFile->hasMoved()) {
                    // Validasi file legalitas (PDF)
                    if ($legalitasFile->isValid() && $legalitasFile->getMimeType() === 'application/pdf' && $legalitasFile->getSize() <= 1024 * 1024) {
                        $legalitasFileName = $legalitasFile->getRandomName();
                        $legalitasFile->store('legalitas', $legalitasFileName);
                        $data['legalitas'] = $legalitasFileName;
                    }
                }


                // Logika untuk upload file KTP
                $ktpFile = $this->request->getFile('ktp');
                if ($ktpFile && $ktpFile->isValid() && !$ktpFile->hasMoved()) {
                    // Validasi file KTP (JPG/JPEG)
                    if ($ktpFile->isValid() && $ktpFile->getMimeType() === 'image/jpeg' && $ktpFile->getSize() <= 1024 * 1024) {
                        $ktpFileName = $ktpFile->getRandomName();
                        $ktpFile->store('ktp', $ktpFileName);
                        $data['ktp'] = $ktpFileName;
                    }
                }

                // Logika untuk upload file SKCK
                $skckFile = $this->request->getFile('skck');
                if ($skckFile && $skckFile->isValid() && !$skckFile->hasMoved()) {
                    // Validasi file SKCK (PDF)
                    if ($skckFile->isValid() && $skckFile->getMimeType() === 'application/pdf' && $skckFile->getSize() <= 1024 * 1024) {
                        $skckFileName = $skckFile->getRandomName();
                        $skckFile->store('skck', $skckFileName);
                        $data['skck'] = $skckFileName;
                    }
                }

                // Logika untuk memeriksa apakah ada perubahan
                $existingData = $model->getIdentitasByIdPendaftaran($id_pendaftaran);
                if ($existingData == $data) {
                    // Jika tidak ada perubahan
                    return redirect()->back()
                        ->withInput()
                        ->with('no_change', true); // Kirimkan pesan jika tidak ada perubahan
                }

                if ($identitas) {
                    $model->updateIdentitas($data, ['id_pendaftaran' => $id_pendaftaran]);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                } else {
                    $model->insertIdentitas($data);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                }
                break;

            case 'identitasabd':
                $identitas = $model->getIdentitasByIdPendaftaran($id_pendaftaran);

                $skckFile = $this->request->getFile('skck');
                $skckFileName = $identitas['skck'];

                if ($skckFile && $skckFile->isValid() && !$skckFile->hasMoved()) {
                    $skckFileName = $this->handleFileUpload($skckFile, ['pdf'], 'skck');
                }

                $data = [
                    'nama' => $this->request->getPost('nama_individu'),
                    'nik' => $this->request->getPost('nik'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                    'usia' => $this->request->getPost('usia'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'pekerjaan' => $this->request->getPost('pekerjaan'),
                    'telepon' => $this->request->getPost('telepon'),
                    'email' => $this->request->getPost('email'),
                    'pendidikan' => $this->request->getPost('pendidikan'),
                    'jalan' => $this->request->getPost('jalan'),
                    'rt_rw' => $this->request->getPost('rt_rw'),
                    'provinsi' => $this->request->getPost('nama_provinsi'),
                    'kab_kota' => $this->request->getPost('nama_kabupaten'),
                    'kecamatan' => $this->request->getPost('nama_kecamatan'),
                    'desa' => $this->request->getPost('nama_kelurahan'),
                    'kode_pos' => $this->request->getPost('kode_pos'),
                    'sosial_media' => $this->request->getPost('sosial_media'),
                    'tanggal_skck' => $this->request->getPost('tanggal_skck'),
                    'skck' => $skckFileName
                ];

                $validationRules = [
                    'nama'              => ($identitas && !empty($data['nama'])) ? 'permit_empty|min_length[3]|max_length[100]' : 'required|min_length[3]|max_length[100]',
                    'nik'               => 'required|exact_length[16]|numeric|is_unique[pendaftaran.nik,id_pendaftaran,' . $id_pendaftaran . ']',
                    'tempat_lahir'      => ($identitas && !empty($data['tempat_lahir'])) ? 'permit_empty|min_length[2]|max_length[50]' : 'required|min_length[2]|max_length[50]',
                    'tanggal_lahir'     => ($identitas && !empty($data['tanggal_lahir'])) ? 'permit_empty|valid_date' : 'required|valid_date',
                    'usia'              => ($identitas && !empty($data['usia'])) ? 'permit_empty|numeric|min_length[1]|max_length[3]' : 'required|numeric|min_length[1]|max_length[3]',
                    'jenis_kelamin'     => ($identitas && !empty($data['jenis_kelamin'])) ? 'permit_empty' : 'required',
                    'pekerjaan'         => ($identitas && !empty($data['pekerjaan'])) ? 'permit_empty|min_length[3]|max_length[100]' : 'required|min_length[3]|max_length[100]',
                    'telepon'           => ($identitas && !empty($data['telepon'])) ? 'permit_empty|numeric|min_length[10]|max_length[15]' : 'required|numeric|min_length[10]|max_length[15]',
                    'email'             => 'required|valid_email|is_unique[pendaftaran.email,id_pendaftaran,' . $id_pendaftaran . ']',
                    'pendidikan'        => ($identitas && !empty($data['pendidikan'])) ? 'permit_empty|min_length[2]|max_length[50]' : 'required|min_length[2]|max_length[50]',
                    'jalan'             => ($identitas && !empty($data['jalan'])) ? 'permit_empty|min_length[3]|max_length[255]' : 'required|min_length[3]|max_length[255]',
                    'rt_rw'             => ($identitas && !empty($data['rt_rw'])) ? 'permit_empty|max_length[10]' : 'required|max_length[10]',
                    'desa'              => ($identitas && !empty($data['desa'])) ? 'permit_empty' : 'required',
                    'kecamatan'         => ($identitas && !empty($data['kecamatan'])) ? 'permit_empty' : 'required',
                    'kab_kota'          => ($identitas && !empty($data['kab_kota'])) ? 'permit_empty' : 'required',
                    'provinsi'          => ($identitas && !empty($data['provinsi'])) ? 'permit_empty' : 'required',
                    'kode_pos'          => ($identitas && !empty($data['kode_pos'])) ? 'permit_empty|numeric|exact_length[5]' : 'required|numeric|exact_length[5]',
                    'sosial_media'      => ($identitas && !empty($data['sosial_media'])) ? 'permit_empty' : 'permit_empty',
                    'tanggal_skck'      => ($identitas && !empty($data['tanggal_skck'])) ? 'permit_empty|valid_date' : 'required|valid_date',
                    'skck'              => ($identitas && !empty($data['skck'])) ? 'permit_empty|mime_in[skck,application/pdf]|max_size[skck,1024]' : 'required|uploaded[skck]|mime_in[skck,application/pdf]|max_size[skck,1024]',
                ];

                // Validasi input
                if (!$this->validate($validationRules)) {
                    // Jika validasi gagal
                    return redirect()->back()
                        ->withInput()
                        ->with('errors', $this->validator->getErrors())
                        ->with('status', 'error');
                }

                // Logika untuk upload file KTP dan SKCK
                $ktpFile = $this->request->getFile('ktp');
                if ($ktpFile && $ktpFile->isValid() && !$ktpFile->hasMoved()) {
                    if ($ktpFile->getMimeType() === 'image/jpeg' && $ktpFile->getSize() <= 1024 * 1024) {
                        $ktpFileName = $ktpFile->getRandomName();
                        $ktpFile->store('ktp', $ktpFileName);
                        $data['ktp'] = $ktpFileName;
                    }
                }

                $skckFile = $this->request->getFile('skck');
                if ($skckFile && $skckFile->isValid() && !$skckFile->hasMoved()) {
                    if ($skckFile->getMimeType() === 'application/pdf' && $skckFile->getSize() <= 1024 * 1024) {
                        $skckFileName = $skckFile->getRandomName();
                        $skckFile->store('skck', $skckFileName);
                        $data['skck'] = $skckFileName;
                    }
                }

                // Logika untuk memeriksa apakah ada perubahan
                $existingData = $model->getIdentitasByIdPendaftaran($id_pendaftaran);
                if ($existingData == $data) {
                    // Jika tidak ada perubahan
                    return redirect()->back()
                        ->withInput()
                        ->with('no_change', true); // Kirimkan pesan jika tidak ada perubahan
                }

                // Logika untuk menyimpan data
                if ($identitas) {
                    $model->updateIdentitas($data, ['id_pendaftaran' => $id_pendaftaran]);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                } else {
                    $model->insertIdentitas($data);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                }

                break;

            case 'kegiatan':
                // Ambil data dari request untuk kegiatan utama
                $data = [
                    'id_pendaftaran' => $id_pendaftaran,
                    'tema' => $this->request->getPost('tema'),
                    'sub_tema' => $this->request->getPost('sub_tema'),
                    'bentuk_kegiatan' => $this->request->getPost('bentuk_kegiatan'),
                    'tahun_mulai' => $this->request->getPost('tahun_mulai') ?: null,
                    'deskripsi_kegiatan' => $this->request->getPost('deskripsi_kegiatan'),
                    'lokasi_kegiatan' => $this->request->getPost('lokasi_kegiatan'),
                    'koordinat' => $this->request->getPost('koordinat'),
                    'pihak_dan_peran' => $this->request->getPost('pihak_dan_peran'),
                    'keberhasilan' => $this->request->getPost('keberhasilan'),
                    'tipe_kegiatan' => 'kegiatan_utama',
                ];

                // Cek apakah kegiatan utama sudah ada
                $existingKegiatan = $model->getKegiatanByPendaftaranId($id_pendaftaran);
                if (!empty($existingKegiatan)) {
                    // Update kegiatan utama
                    $model->updateKegiatan($data, ['id_kegiatan' => $existingKegiatan[0]['id_kegiatan']]);
                } else {
                    // Insert kegiatan utama sebagai entri baru
                    $model->insertKegiatan($data);
                }

                // Cek apakah ada kegiatan tambahan yang akan ditambahkan atau diperbarui
                $kegiatanLainnya = $this->request->getPost('kegiatan_lainnya');
                if (!empty($kegiatanLainnya)) {
                    foreach ($kegiatanLainnya as $kegiatan) {
                        // Persiapkan data untuk kegiatan tambahan
                        $dataLain = [
                            'id_pendaftaran' => $id_pendaftaran,
                            'tema' => $kegiatan['tema'] ?? '',
                            'sub_tema' => $kegiatan['sub_tema'] ?? '',
                            'bentuk_kegiatan' => $kegiatan['bentuk_kegiatan'] ?? '',
                            'tahun_mulai' => !empty($kegiatan['tahun_mulai']) ? $kegiatan['tahun_mulai'] : null,
                            'deskripsi_kegiatan' => $kegiatan['deskripsi_kegiatan'] ?? '',
                            'lokasi_kegiatan' => $kegiatan['lokasi_kegiatan'] ?? '',
                            'koordinat' => $kegiatan['koordinat'] ?? '',
                            'pihak_dan_peran' => $kegiatan['pihak_dan_peran'] ?? '',
                            'keberhasilan' => $kegiatan['keberhasilan'] ?? '',
                            'tipe_kegiatan' => 'kegiatan_tambahan',
                        ];

                        // Validasi: Cek apakah deskripsi_kegiatan atau tema terisi
                        if (!empty($dataLain['deskripsi_kegiatan']) || !empty($dataLain['tema'])) {
                            // Cek ID dari kegiatan tambahan jika ada
                            if (isset($kegiatan['id_kegiatan']) && !empty($kegiatan['id_kegiatan'])) {
                                // Jika ID ada, update kegiatan tambahan
                                $model->updateKegiatan($dataLain, ['id_kegiatan' => $kegiatan['id_kegiatan']]);
                            } else {
                                // Insert kegiatan tambahan sebagai entri baru
                                $model->insertKegiatan($dataLain);
                            }
                        }
                    }
                }

                return redirect()->back()
                    ->withInput()
                    ->with('status', 'success')
                    ->with('message', 'Data berhasil disimpan.');

                break;

            case 'dampak':
                $dampak = $model->getDampakByIdPendaftaran($id_pendaftaran);
                $data = [
                    'id_pendaftaran' => $id_pendaftaran,
                    'dampak_lingkungan' => $this->request->getPost('dampak_lingkungan'),
                    'dampak_ekonomi' => $this->request->getPost('dampak_ekonomi'),
                    'dampak_sosial_budaya' => $this->request->getPost('dampak_sosial_budaya'),
                ];

                // Logika untuk menyimpan data
                if ($dampak) {
                    $model->updateDampak($data, ['id_pendaftaran' => $id_pendaftaran]);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                } else {
                    $model->insertDampak($data);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                }
                break;

            case 'pmik':
                $pmik = $model->getPMIKByIdPendaftaran($id_pendaftaran);
                $data = [
                    'id_pendaftaran' => $id_pendaftaran,
                    'prakarsa' => $this->request->getPost('prakarsa'),
                    'motivasi' => $this->request->getPost('motivasi'),
                    'inovasi' => $this->request->getPost('inovasi'),
                    'kreativitas' => $this->request->getPost('kreativitas'),
                ];
                if ($pmik) {
                    $model->updatePMIK($data, ['id_pendaftaran' => $id_pendaftaran]);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                } else {
                    $model->insertPMIK($data);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                }
                break;

            case 'keswadayaan':
                $keswadayaan = $model->getKeswadayaanByIdPendaftaran($id_pendaftaran);
                $data = [
                    'id_pendaftaran' => $id_pendaftaran,
                    'sumber_biaya' => $this->request->getPost('sumber_biaya'),
                    'teknologi_kegiatan' => $this->request->getPost('teknologi_kegiatan'),
                    'status_lahan_kegiatan' => $this->request->getPost('status_lahan_kegiatan'),
                    'jumlah_kelompok_serupa' => $this->request->getPost('jumlah_kelompok_serupa'),
                ];
                if ($keswadayaan) {
                    $model->updateKeswadayaan($data, ['id_pendaftaran' => $id_pendaftaran]);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                } else {
                    $model->insertKeswadayaan($data);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                }
                break;

            case 'keistimewaan':
                $keistimewaan = $model->getKeistimewaanByIdPendaftaran($id_pendaftaran);
                $data = [
                    'id_pendaftaran' => $id_pendaftaran,
                    'keistimewaan' => $this->request->getPost('keistimewaan'),
                    'penghargaan' => $this->request->getPost('penghargaan'),
                    'tautan_video' => $this->request->getPost('tautan_video'),
                    'tautan_dokumen_pendukung' => $this->request->getPost('tautan_dokumen_pendukung'),
                ];

                for ($i = 1; $i <= 5; $i++) {
                    $fotoField = 'foto_kegiatan' . $i;
                    $deskripsiField = 'deskripsi_foto_kegiatan' . $i;
                    $fotoFile = $this->request->getFile($fotoField);

                    if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
                        if ($fotoFile->getMimeType() === 'image/jpeg' && $fotoFile->getSize() <= 1024 * 1024) {
                            $originalName = pathinfo($fotoFile->getClientName(), PATHINFO_FILENAME);
                            $extension = $fotoFile->getExtension();
                            $randomNamePart = bin2hex(random_bytes(4));
                            $fotoFileName = $originalName . '_' . $randomNamePart . '.' . $extension;
                            $fotoFile->move(WRITEPATH . 'uploads/foto_kegiatan' . $i, $fotoFileName);
                            $data[$fotoField] = $fotoFileName;
                        }
                    }

                    $deskripsiFoto = $this->request->getPost($deskripsiField);
                    if (!empty($deskripsiFoto)) {
                        $data[$deskripsiField] = $deskripsiFoto;
                    }
                }

                if ($keistimewaan) {
                    $model->updateKeistimewaan($data, ['id_pendaftaran' => $id_pendaftaran]);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                } else {
                    $model->insertKeistimewaan($data);
                    return redirect()->back()
                        ->withInput()
                        ->with('status', 'success')
                        ->with('message', 'Data berhasil disimpan.');
                }
                break;

            default:
                return redirect()->back()->with('error', 'Form tidak ditemukan.');
        }

        // Tentukan target section berikutnya berdasarkan form yang disimpan
        $nextFormTarget = '';
        switch ($formType) {
            case 'identitasc':
                $nextFormTarget = 'identitasc';
                break;
            case 'identitasabd':
                $nextFormTarget = 'identitasabd';
                break;
            case 'kegiatan':
                $nextFormTarget = 'kegiatan';
                break;
            case 'dampak':
                $nextFormTarget = 'dampak';
                break;
            case 'pmik':
                $nextFormTarget = 'pmik';
                break;
            case 'keswadayaan':
                $nextFormTarget = 'keswadayaan';
                break;
            case 'keistimewaan':
                $nextFormTarget = 'keistimewaan';
            default:
                $nextFormTarget = 'identitas-calon';
        }

        return redirect()->to('pengusul/detailusulansayaedit/' . $id_pendaftaran . '?section=' . $nextFormTarget)
            ->with('success', ucfirst($formType) . ' berhasil disimpan.');
    }

    public function detailUsulanSayaEdit($id_pendaftaran)
    {
        $model = new PendaftaranModel();
        $pendaftaran = $model->getPendaftaranById($id_pendaftaran);

        if (!$pendaftaran) {
            return redirect()->to('pengusul/usulansaya')->with('error', 'Data tidak ditemukan.');
        }

        // Cek status_pendaftaran, jika tidak "Draft" atau "Perlu Perbaikan", arahkan ke usulansaya
        if ($pendaftaran['status_pendaftaran'] !== 'Draft' && $pendaftaran['status_pendaftaran'] !== 'Perlu Perbaikan') {
            return redirect()->to('pengusul/usulansaya')->with('error', 'Data calon usulan sudah tidak bisa diedit.');
        }

        $identitas = $model->getIdentitasByIdPendaftaran($id_pendaftaran);
        $kegiatan = $model->getKegiatanByPendaftaranId($id_pendaftaran);
        $dampak = $model->getDampakByIdPendaftaran($id_pendaftaran);
        $pmik = $model->getPMIKByIdPendaftaran($id_pendaftaran);
        $keswadayaan = $model->getKeswadayaanByIdPendaftaran($id_pendaftaran);
        $keistimewaan = $model->getKeistimewaanByIdPendaftaran($id_pendaftaran);
        $kegiatanUtama = isset($kegiatan[0]) ? $kegiatan[0] : null;
        $kegiatanLainnya = array_slice($kegiatan, 1);


        // Ambil ID pengusul yang sedang login dari session
        $id_pengusul_session = session()->get('id_pengusul'); // Asumsikan id_pengusul disimpan dalam session

        if (!$pendaftaran) {
            return redirect()->to('pengusul/usulansaya')->with('error', 'Data tidak ditemukan.');
        }

        // Cek apakah pengusul yang sedang login adalah pemilik pendaftaran
        if ($pendaftaran['id_pengusul'] != $id_pengusul_session) {
            return redirect()->to('/pengusul/usulansaya')->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        $title = "Edit Calon Usulan";

        session()->set('id_pendaftaran', $id_pendaftaran);


        $data = [
            'title' => 'Edit Detail Usulan Saya - Pengusul',
            'pendaftaran' => $pendaftaran,
            'identitasc' => $identitas,
            'identitasabd' => $identitas,
            'kegiatan' => $kegiatan,
            'dampak' => $dampak,
            'pmik' => $pmik,
            'keswadayaan' => $keswadayaan,
            'keistimewaan' => $keistimewaan,
            'kegiatanUtama' => $kegiatanUtama,
            'kegiatanLainnya' => $kegiatanLainnya,
            'title' => $title,
            'provinsiTerpilih' => $pendaftaran['provinsi'],
            'kab_kotaTerpilih' => $pendaftaran['kab_kota'],
            'kecamatanTerpilih' => $pendaftaran['kecamatan'],
            'desaTerpilih' => $pendaftaran['desa'],
        ];

        return view('pengusul/detailusulansayaedit', $data);
    }


    // -------------------------------------------------------------------------------------------------------------------


    public function usulansaya()
    {
        $Model = new PendaftaranModel();
        $PengusulModel = new PengusulModel();
        $KegiatanModel = new KegiatanModel();
        $KeistimewaanModel = new KeistimewaanModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil ID pengusul dari session
        $id_pengusul = session()->get('id_pengusul');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Jika ada keyword, tambahkan kondisi pencarian
        if ($keyword) {
            $usulan = $Model->where('id_pengusul', $id_pengusul)
                ->like('nama', $keyword)
                ->paginate($perPage, 'usulan');
        } else {
            $usulan = $Model->where('id_pengusul', $id_pengusul)
                ->paginate($perPage, 'usulan');
        }

        // Ambil data pengusul
        $pengusul = $PengusulModel->where('id_pengusul', $id_pengusul)->first();

        // Cek kelengkapan data pengusul
        $isComplete = !empty($pengusul['nama_instansi_pribadi']) && !empty($pengusul['instansi']) &&
            !empty($pengusul['jabatan_pekerjaan']) && !empty($pengusul['jenis_kelamin']) &&
            !empty($pengusul['jalan']) && !empty($pengusul['rt_rw']) && !empty($pengusul['desa']) &&
            !empty($pengusul['kecamatan']) && !empty($pengusul['kab_kota']) &&
            !empty($pengusul['kode_pos']) && !empty($pengusul['surat_pengantar']);

        // Variabel untuk menampung status kelengkapan
        $isCompleteKegiatanKeistimewaan = []; // Ubah menjadi array

        foreach ($usulan as $u) {
            $id_pendaftaran = $u['id_pendaftaran'];

            // Periksa kelengkapan kegiatan dan keistimewaan
            $skck = $Model->where('id_pendaftaran', $id_pendaftaran)->first();
            $kegiatanUtama = $KegiatanModel->where(['tipe_kegiatan' => 'kegiatan_utama', 'id_pendaftaran' => $id_pendaftaran])->first();
            $keistimewaan = $KeistimewaanModel->where('id_pendaftaran', $id_pendaftaran)->first();

            $isSkckComplete = !empty($skck['skck']);

            $isKegiatanComplete = !empty($kegiatanUtama['tema']) && !empty($kegiatanUtama['sub_tema']) &&
                !empty($kegiatanUtama['bentuk_kegiatan']) && !empty($kegiatanUtama['tahun_mulai']) &&
                !empty($kegiatanUtama['deskripsi_kegiatan']) && !empty($kegiatanUtama['lokasi_kegiatan']) &&
                !empty($kegiatanUtama['koordinat']) && !empty($kegiatanUtama['pihak_dan_peran']) &&
                !empty($kegiatanUtama['keberhasilan']);

            $isKeistimewaanComplete = !empty($keistimewaan['foto_kegiatan1']) && !empty($keistimewaan['deskripsi_foto_kegiatan1']);

            // Simpan kelengkapan untuk setiap ID
            $isCompleteKegiatanKeistimewaan[$id_pendaftaran] = $isKegiatanComplete && $isKeistimewaanComplete && $isSkckComplete;
        }

        $data = [
            'usulan' => $usulan,
            'pager' => $Model->pager,
            'title' => "Usulan Saya",
            'keyword' => $keyword,
            'isComplete' => $isComplete,
            'isCompleteKegiatanKeistimewaan' => $isCompleteKegiatanKeistimewaan,
        ];

        return view('pengusul/usulansaya', $data);
    }

    public function hapusUsulan($id_pendaftaran)
    {
        $modelPendaftaran = new PendaftaranModel();
        $modelKegiatan = new KegiatanModel();
        $modelDampak = new DampakModel();
        $modelPmik = new PmikModel();
        $modelKeswadayaan = new KeswadayaanModel();
        $modelKeistimewaan = new KeistimewaanModel();

        // Ambil data pendaftaran dan keistimewaan berdasarkan id_pendaftaran
        $pendaftaran = $modelPendaftaran->find($id_pendaftaran);
        $keistimewaan = $modelKeistimewaan->where('id_pendaftaran', $id_pendaftaran)->findAll();

        // Menghapus file terkait pada tabel pendaftaran (KTP, SKCK, Legalitas)
        $this->hapusFileJikaAda($pendaftaran['ktp'], 'uploads/ktp');
        $this->hapusFileJikaAda($pendaftaran['skck'], 'uploads/skck');
        $this->hapusFileJikaAda($pendaftaran['legalitas'], 'uploads/legalitas');

        // Menghapus file terkait pada tabel keistimewaan (Foto Kegiatan)
        foreach ($keistimewaan as $keistimewaanItem) {
            $this->hapusFileJikaAda($keistimewaanItem['foto_kegiatan1'], 'uploads/foto_kegiatan1');
            $this->hapusFileJikaAda($keistimewaanItem['foto_kegiatan2'], 'uploads/foto_kegiatan2');
            $this->hapusFileJikaAda($keistimewaanItem['foto_kegiatan3'], 'uploads/foto_kegiatan3');
            $this->hapusFileJikaAda($keistimewaanItem['foto_kegiatan4'], 'uploads/foto_kegiatan4');
            $this->hapusFileJikaAda($keistimewaanItem['foto_kegiatan5'], 'uploads/foto_kegiatan5');
        }

        // Hapus data di tabel kegiatan yang memiliki id_pendaftaran terkait
        $modelKegiatan->where('id_pendaftaran', $id_pendaftaran)->delete();

        // Hapus data di tabel dampak yang memiliki id_pendaftaran terkait
        $modelDampak->where('id_pendaftaran', $id_pendaftaran)->delete();

        // Hapus data di tabel pmik yang memiliki id_pendaftaran terkait
        $modelPmik->where('id_pendaftaran', $id_pendaftaran)->delete();

        // Hapus data di tabel keswadayaan yang memiliki id_pendaftaran terkait
        $modelKeswadayaan->where('id_pendaftaran', $id_pendaftaran)->delete();

        // Hapus data di tabel keistimewaan yang memiliki id_pendaftaran terkait
        $modelKeistimewaan->where('id_pendaftaran', $id_pendaftaran)->delete();

        // Lalu hapus data di tabel pendaftaran
        if ($modelPendaftaran->deletePendaftaran($id_pendaftaran)) {
            session()->setFlashdata('success', 'Data Usulan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data usulan.');
        }

        return redirect()->to('/pengusul/usulansaya'); // Sesuaikan dengan URL yang diinginkan
    }

    // Fungsi untuk menghapus file jika ada (menangani hanya file, bukan folder)
    private function hapusFileJikaAda($fileName, $folder)
    {
        // Pastikan nama file tidak kosong
        if (!empty($fileName)) {
            $filePath = WRITEPATH . $folder . '/' . $fileName; // WRITEPATH mengarah ke folder writable

            // Cek apakah file ada dan bukan direktori
            if (file_exists($filePath) && !is_dir($filePath)) {
                log_message('info', 'Menghapus file: ' . $filePath);
                // Menghapus file jika ada
                unlink($filePath);
            } else {
                // Jika file tidak ada atau itu adalah folder
                log_message('info', "File tidak ditemukan atau itu adalah folder: $filePath");
            }
        }
    }



    public function usulandlhk()
    {
        $model = new PendaftaranModel();

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil kategori dari filter
        $kategori = $this->request->getVar('kategori');

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Ambil ID pengusul dan provinsi dari session
        $provinsi = session()->get('provinsi');

        // Filter query berdasarkan provinsi
        if ($provinsi) {
            $model->where('provinsi', $provinsi);
        }

        // Tambahkan filter untuk status pendaftaran
        $validStatuses = ['Sesuai', 'Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'];
        $model->whereIn('status_pendaftaran', $validStatuses);

        // Jika kategori dipilih, tambahkan filter kategori
        if ($kategori) {
            $model->where('kategori', $kategori);
        }

        // Jika ada kata kunci, tambahkan kondisi pencarian berdasarkan nama
        if ($keyword) {
            $model->like('nama', $keyword);
        }

        // Dapatkan data dengan pagination
        $usulan = $model->paginate($perPage, 'usulan');

        // Ambil pager untuk pagination
        $pager = $model->pager;

        // Persiapkan data untuk dikirim ke view
        $data = [
            'title' => 'Usulan DLHK',
            'usulan' => $usulan,
            'pager' => $pager,
            'kategori' => $kategori,
            'keyword' => $keyword,
        ];

        return view('pengusul/usulandlhk', $data);
    }

    public function detailusulansaya($id)
    {
        $model = new PendaftaranModel();
        $pendaftaran = $model->getDetailById($id);

        $kegiatan = $model->getKegiatanByPendaftaranId($pendaftaran['id_pendaftaran']);
        $pendaftaran['kegiatan'] = $kegiatan;

        // Ambil ID pengusul yang sedang login dari session
        $id_pengusul_session = session()->get('id_pengusul'); // Asumsikan id_pengusul disimpan dalam session

        // Validasi jika data ditemukan atau tidak
        if (!$pendaftaran) {
            return redirect()->to('/pengusul/usulansaya')->with('error', 'Data tidak ditemukan.');
        }

        // Cek apakah pengusul yang sedang login adalah pemilik pendaftaran
        if ($pendaftaran['id_pengusul'] != $id_pengusul_session) {
            return redirect()->to('/pengusul/usulansaya')->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        // Ambil data kegiatan utama dan kegiatan tambahan
        $kegiatan_utama = $model->getKegiatanByTipe($id, 'kegiatan_utama');
        $kegiatan_tambahan = $model->getKegiatanByTipe($id, 'kegiatan_tambahan');

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Usulan Saya',
            'pendaftaran' => $pendaftaran,
            'kegiatan_utama' => $kegiatan_utama,
            'kegiatan_tambahan' => $kegiatan_tambahan,
        ];

        return view('pengusul/detailusulansaya', $data);
    }


    public function editUsulan($id)
    {
        $Model = new PendaftaranModel();
        $pendaftaran = $Model->getDetailById($id);

        // Validasi jika data ditemukan atau tidak
        if (!$pendaftaran) {
            return redirect()->to('/pengusul/usulansaya')->with('error', 'Data tidak ditemukan.');
        }

        session()->set('id_pendaftaran', $pendaftaran['id_pendaftaran']); // Menyimpan id_pendaftaran ke session

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

        $tema = [
            'Keanekaragaman Hayati',
            'Perubahan Iklim',
            'Pencemaran dan Kerusakan Lingkungan',
            'Hukum dan Budaya'
        ];

        $subtema = [
            'Pelestarian keanekaragaman hayati dan kawasan dilindungi yang meliputi pelestarian sumber daya genetik, jenis, dan ekosistem',
            'Pemanfaatan keanekaragaman hayati secara berkelanjutan',
            'Jasa lingkungan',
            'Adaptasi perubahan iklim',
            'Mitigasi Perubahan Iklim',
            'Penerapan ekonomi hijau dan ekonomi biru',
            'Penanganan pencemaran air, tanah, udara dari industri, pertanian, domestic terutama plastik',
            'Pencegahan dan penanggulangan kerusakan lingkungan',
            'Ekonomi Sirkular',
            'Keadilan terhadap pemanfaatan sumber daya alam dan lingkungan',
            'Kearifan tradisional dalam pengelolaan sumber daya alam',
            'Komunikasi dan pendidikan lingkungan hidup'
        ];

        // Ambil data dari semua tabel terkait menggunakan join
        $data = [
            'title' => 'Edit Usulan Saya',
            'pendaftaran' => $pendaftaran,
            'tema' => $tema,
            'sub_tema' => $subtema,
            'provinsi_list' => $provinsi_list
        ];
        return view('pengusul/detailusulansayaedit', $data);
    }



    public function detailusulandlhk()
    {
        $data['title'] = 'Detail Usulan DLHK';
        return view('pengusul/detailusulandlhk', $data);
    }

    public function tambahartikel()
    {
        // Mengambil ID pengusul dari session
        $data = [
            'title' => 'Tambah Artikel',
            'id_pengusul' => session()->get('id_pengusul'),
        ];

        return view('pengusul/tambahartikel', $data);
    }

    public function tambahArtikelAction()
    {
        if (!session()->has('id_pengusul')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Session id_pengusul tidak ditemukan. Silakan login kembali.'
            ]);
        }

        $model = new ArtikelModel();

        // Ambil input dari formulir
        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', TRUE);
        $konten = $this->request->getPost('konten');
        $foto = $this->request->getFile('foto');

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[artikel.judul]'
            ],
            'konten' => [
                'label' => 'Konten',
                'rules' => 'required|min_length[20]'
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

            // Memindahkan file ke folder public/images/artikel
            if ($foto->move('public/images/artikel', $fotoName)) {
                // Jika berhasil, simpan path foto ke database
                $fotoPath = 'images/artikel/' . $fotoName;
            } else {
                return $this->response->setJSON(['success' => false, 'errors' => 'Gagal menyimpan file foto.']);
            }
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
            'id_pengusul' => session()->get('id_pengusul'),
            'judul' => htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'slug' => $slug,
            'konten' => htmlspecialchars($konten, ENT_QUOTES, 'UTF-8'), // Sanitasi untuk menghindari XSS
            'tanggal' => date('Y-m-d H:i:s'),
        ];

        if (isset($fotoPath)) {
            $dataArtikel['foto'] = $fotoPath;
        }

        // Simpan artikel
        if ($model->insert($dataArtikel)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil ditambahkan.']);
        } else {
            // Tampilkan pesan umum untuk kesalahan penyimpanan
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel.']);
        }
    }



    public function artikelsaya()
    {
        $model = new ArtikelModel();
        $id_pengusul = session()->get('id_pengusul'); // Mengambil id_pengusul dari session

        // Ambil data dengan pagination, limit 5 per halaman
        $perPage = 5;

        // Ambil kata kunci dari request untuk pencarian
        $keyword = $this->request->getGet('search');

        // Jika ada keyword, tambahkan kondisi pencarian
        if ($keyword) {
            $artikels = $model->where('id_pengusul', $id_pengusul)
                ->like('judul', $keyword)
                ->paginate($perPage, 'artikel');
        } else {
            $artikels = $model->where('id_pengusul', $id_pengusul)
                ->paginate($perPage, 'artikel');
        }

        // Menyiapkan data untuk view
        $data['title'] = 'Artikel Saya';
        $data['artikels'] = $artikels;
        $data['pager'] = $model->pager;
        $data['keyword'] = $keyword;

        // Menampilkan view dengan data artikel
        return view('pengusul/artikelsaya', $data);
    }

    public function detailartikel($slug)
    {
        $Model = new ArtikelModel();
        $artikel = $Model->where('slug', $slug)->first(); // Ambil artikel berdasarkan slug

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil ID pengguna yang sedang login (baik admin maupun pengusul)
        $id_pengusul = session()->get('id_pengusul');
        $id_admin = session()->get('id_admin');

        // Jika artikel masih ditangguhkan
        if ($artikel['status'] == 'Ditangguhkan') {
            // Cek apakah yang mengakses adalah admin atau pembuat artikel
            if (!$id_admin && $artikel['id_pengusul'] != $id_pengusul) {
                // Jika bukan admin atau pembuat artikel, tampilkan 404
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        $data = [
            'title' => 'Detail Artikel Saya',
            'artikel' => $artikel,
        ];
        return view('pengusul/detailartikelsaya', $data);
    }

    public function pemberitahuan()
    {
        $pendaftaranModel = new PendaftaranModel();
        $pengusulModel = new PengusulModel();

        $id_pengusul = session()->get('id_pengusul');
        $pengusul = $pengusulModel->find($id_pengusul);

        $pendaftaran = [];

        if ($pengusul) {
            if ($pengusul['role_akun'] == 'DLHK') {
                $provinsi = session()->get('provinsi');
                $pendaftaran = $pendaftaranModel->where('provinsi', $provinsi)->findAll();
            } else if ($pengusul['role_akun'] == 'Pengusul') {
                $pendaftaran = $pendaftaranModel->where('id_pengusul', $id_pengusul)->findAll();
            }
        }

        $data = [
            'title' => 'Pemberitahuan',
            'pendaftaran' => $pendaftaran,
            'pengusul' => $pengusul
        ];

        return view('pengusul/pemberitahuan', $data);
    }

    public function alurpendaftaran()
    {
        $data = [
            'title' => 'Alur Pendaftaran',
        ];

        return view('pengusul/alurpendaftaran', $data);
    }
    public function videopanduan()
    {
        $data = [
            'title' => 'Video Panduan',
        ];

        return view('pengusul/videopanduan', $data);
    }
    public function panduanpendaftaran()
    {
        $data = [
            'title' => 'Panduan Pendaftaran',
        ];
        return view('pengusul/panduanpendaftaran', $data);
    }

    public function halamanLainnya()
    {
        $pengusulModel = new PengusulModel();
        $pengusul = $pengusulModel->where('id_pengusul', session()->get('id_pengusul'))->first();

        // Cek apakah semua field sudah diisi
        if (empty($pengusul['nama_instansi_pribadi']) || empty($pengusul['telepon']) || empty($pengusul['email'])) {
            return redirect()->to(base_url('pengusul/profil'))->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        // Jika profil sudah lengkap, lanjutkan ke halaman lainnya
        return view('pengusul/halaman_lainnya');
    }

    public function generatePDF($kode_registrasi)
    {
        $id_pengusul = session()->get('id_pengusul');
        $role_akun = session()->get('role_akun');
        $provinsi = session()->get('provinsi');

        if (!$id_pengusul) {
            return redirect()->back()->with('error', '');
        }

        $pendaftaranModel = new PendaftaranModel();
        $pengusulModel = new PengusulModel();

        $pendaftaranData = $pendaftaranModel->where('kode_registrasi', $kode_registrasi)->first();

        if (!$pendaftaranData || ($pendaftaranData['id_pengusul'] != $id_pengusul && !($role_akun == 'DLHK' && $pendaftaranData['provinsi'] == $provinsi))) {
            return redirect()->back()->with('error', 'Error');
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

        $html = view('pengusul/pdf', $data);

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

        $dompdf->stream('laporan_calon_usulan.pdf', ['Attachment' => true]);
    }
}
