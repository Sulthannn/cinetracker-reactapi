<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PengusulModel;
use App\Models\TimteknisModel;
use App\Models\DppkModel;
use App\Models\PenerimaModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, arahkan ke halaman utama
            return redirect()->to('/');
        }

        $data['title'] = "Masuk Akun";
        return view('auth/login', $data);
    }

    public function loginAction()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form login
        $validation->setRules([
            'email' => 'required|valid_email',
            'kata_sandi' => 'required',
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $model = new PengusulModel();

        // Ambil input dari formulir
        $email = $this->request->getPost('email');
        $kata_sandi = $this->request->getPost('kata_sandi');

        // Cari pengguna berdasarkan email
        $user = $model->where('email', $email)->first();

        // Periksa apakah pengguna ditemukan
        if ($user) {
            // Verifikasi kata sandi
            if (password_verify($kata_sandi, $user['kata_sandi'])) {
                // Cek status akun
                if ($user['status_akun'] === 'Aktif') {
                    $sessionData = [
                        'id_pengusul' => $user['id_pengusul'],
                        'role_akun' => $user['role_akun'],
                        'nama' => $user['nama_instansi_pribadi'],
                        'instansi' => $user['instansi'],
                        'provinsi' => $user['provinsi'],
                        'logged_in' => true,
                    ];
                    session()->set($sessionData);

                    // Kembalikan URL untuk redirect sesuai role_akun
                    return $this->response->setJSON(['success' => true, 'redirectUrl' => '/pengusul/profil']);
                } else {
                    return $this->response->setJSON(['success' => false, 'message' => 'Akun Anda belum aktif.']);
                }
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Kata sandi salah.']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
        }
    }

    public function forgotPassword()
    {
        $data['title'] = "Lupa Kata Sandi";
        return view('auth/forgot_password', $data);
    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        $model = new PengusulModel();
        $user = $model->getUserByEmail($email);

        if ($user) {
            $token = bin2hex(random_bytes(15));
            $resetLink = base_url("auth/reset-password/$token");

            $model->update($user['id_pengusul'], ['reset_token' => $token]);

            $emailService = \Config\Services::email();
            $emailService->setTo($email);
            $emailService->setSubject('Ubah Kata Sandi Akun Kalpataru');
            $emailService->setMessage("Klik url berikut untuk mengatur ulang kata sandi Anda: $resetLink");
            $emailService->send();

            session()->setFlashdata('reset_link_sent', true);

            return redirect()->to('/auth/forgot-password');
        } else {
            session()->setFlashdata('email_not_found', true);

            return redirect()->to('/auth/forgot-password');
        }
    }

    public function resetPassword($token)
    {
        $model = new PengusulModel();
        $user = $model->where('reset_token', $token)->first();

        if ($user) {
            $data['title'] = "Atur Ulang Kata Sandi";
            $data['token'] = $token;
            return view('auth/reset_password', $data);
        } else {
            return redirect()->to('/auth/forgot-password')->with('error', 'Token tidak valid.');
        }
    }

    public function processResetPassword()
    {
        $token = $this->request->getPost('token');
        $newPassword = $this->request->getPost('kata_sandi');
        $model = new PengusulModel();
        $user = $model->where('reset_token', $token)->first();

        if ($user) {
            $model->update($user['id_pengusul'], [
                'kata_sandi' => password_hash($newPassword, PASSWORD_DEFAULT),
                'reset_token' => null
            ]);
            return redirect()->to('/auth/login');
        } else {
            session()->setFlashdata('invalid_token', true);
            return redirect()->to('/auth/reset-password/' . $token);
        }
    }

    public function logoutAction()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function logoutInternal()
    {
        session()->destroy();
        return redirect()->to('/auth/logininternal');
    }

    public function register()
    {
        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, arahkan ke halaman utama
            return redirect()->to('/');
        }

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

        $data['title'] = 'Daftar Akun';
        $data['provinsi_list'] = $provinsi_list;

        return view('auth/register', $data);
    }

    public function createRegister()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form pendaftaran pengusul
        $validation->setRules([
            'jenis_instansi' => [
                'label' => 'Jenis Instansi',
                'rules' => 'required|alpha_space'
            ],
            'nama_instansi_pribadi' => [
                'label' => 'Nama Instansi atau Pribadi',
                'rules' => 'required|alpha_space'
            ],
            'provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required|alpha_space'
            ],
            'telepon' => [
                'label' => 'Telepon',
                'rules' => 'required|numeric|min_length[10]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[pengusul.email]'
            ],
            'kata_sandi' => [
                'label' => 'Kata Sandi',
                'rules' => 'required|min_length[8]|regex_match[/[a-z]/]|regex_match[/[A-Z]/]|regex_match[/[!@#$%^&*_-]/]'
            ],
            'surat_pengantar' => [
                'label' => 'Surat Pengantar',
                'rules' => 'uploaded[surat_pengantar]|max_size[surat_pengantar,1024]|mime_in[surat_pengantar,application/pdf]'
            ]
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data input dari form
        $email = $this->request->getPost('email');
        $file = $this->request->getFile('surat_pengantar');
        $filePath = '';

        // Proses file surat pengantar
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filePath = $file->store('suratpengantar', $file->getRandomName());
        }

        // Data yang akan dimasukkan ke database
        $data = [
            'jenis_instansi' => $this->request->getPost('jenis_instansi'),
            'nama_instansi_pribadi' => $this->request->getPost('nama_instansi_pribadi'),
            'provinsi' => $this->request->getPost('provinsi'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $email,
            'kata_sandi' => password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT),
            'role_akun' => 'Pengusul',
            'status_akun' => 'Pending',
            'surat_pengantar' => $filePath
        ];

        // Simpan data ke database menggunakan model
        $model = new PengusulModel();

        if ($model->insert($data)) {
            // Jika pendaftaran berhasil
            return $this->response->setJSON(['success' => true]);
        } else {
            // Jika ada kesalahan saat menyimpan ke database
            log_message('error', 'Pendaftaran pengusul gagal: ' . json_encode($model->errors()));
            return $this->response->setJSON([
                'success' => false,
                'errors' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'
            ]);
        }
    }

    public function registerDLHK()
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

        $data['title'] = 'Daftar Akun DLHK';
        $data['provinsi_list'] = $provinsi_list;

        return view('admin/daftarakundlhk', $data);
    }

    public function createRegisterDLHK()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form pendaftaran pengusul
        $validation->setRules([
            'instansi' => [
                'label' => 'Nama Instansi atau Pribadi',
                'rules' => 'required|alpha_space'
            ],
            'provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required|alpha_space'
            ],
            'telepon' => [
                'label' => 'Telepon',
                'rules' => 'required|numeric|min_length[10]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[pengusul.email]'
            ],
            'kata_sandi' => [
                'label' => 'Kata Sandi',
                'rules' => 'required|min_length[8]|regex_match[/[a-z]/]|regex_match[/[A-Z]/]|regex_match[/[!@#$%^&*_-]/]'
            ],
            'surat_pengantar' => [
                'label' => 'Surat Pengantar',
                'rules' => 'uploaded[surat_pengantar]|max_size[surat_pengantar,1024]|mime_in[surat_pengantar,application/pdf]'
            ]
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data input dari form
        $email = $this->request->getPost('email');
        $file = $this->request->getFile('surat_pengantar');
        $filePath = '';

        // Proses file surat pengantar
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filePath = $file->store('suratpengantar', $file->getRandomName());
        }

        // Data yang akan dimasukkan ke database
        $data = [
            'id_admin' => session()->get('id_admin'),
            'jenis_instansi' => 'Pemerintah',
            'instansi' => $this->request->getPost('instansi'),
            'provinsi' => $this->request->getPost('provinsi'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $email,
            'kata_sandi' => password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT),
            'role_akun' => 'DLHK',
            'status_akun' => 'Pending',
            'surat_pengantar' => $filePath
        ];

        // Simpan data ke database menggunakan model
        $model = new PengusulModel();

        if ($model->insert($data)) {
            // Jika pendaftaran berhasil
            return $this->response->setJSON(['success' => true]);
        } else {
            // Jika ada kesalahan saat menyimpan ke database
            log_message('error', 'Pendaftaran pengusul gagal: ' . json_encode($model->errors()));
            return $this->response->setJSON([
                'success' => false,
                'errors' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'
            ]);
        }
    }

    public function downloadSuratPengantar($filename)
    {
        $filePath = WRITEPATH . 'uploads/suratpengantar/' . $filename;

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName($filename);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => 'File not found.']);
        }
    }


    // BAGIAN AUTH ADMIN DPPK SEKRE
    public function logininternal()
    {
        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, arahkan ke halaman utama
            return redirect()->to('/');
        }

        $data['title'] = "Masuk Akun Internal";
        return view('auth/logininternal', $data);
    }

    public function logininternalAction()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form login
        $validation->setRules([
            'email' => 'required|valid_email',
            'kata_sandi' => 'required',
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data dari form
        $email = $this->request->getPost('email');
        $kata_sandi = $this->request->getPost('kata_sandi');

        // Load model
        $model = new AdminModel();

        // Cek apakah email ada di database
        $admin = $model->where('email', $email)->first();

        // Jika admin tidak ditemukan
        if (!$admin) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'Pengguna tidak ditemukan.']
            ]);
        }

        // Jika kata sandi tidak sesuai
        if (!password_verify($kata_sandi, $admin['kata_sandi'])) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['kata_sandi' => 'Kata sandi salah.']
            ]);
        }

        // Simpan data admin ke session
        session()->set('id_admin', $admin['id_admin']);
        session()->set('email', $admin['email']);
        session()->set('nama', $admin['nama']);
        session()->set('role', 'admin');
        session()->set('logged_in', true);


        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login berhasil!'
        ]);
    }

    public function registerinternal()
    {
        $data['title'] = "Daftar Akun Internal";
        return view('auth/registerinternal', $data);
    }

    public function createRegisterInternal()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form pendaftaran admin
        $validation->setRules([
            'nip' => [
                'label' => 'NIP',
                'rules' => 'required|numeric|min_length[8]|is_unique[admin.nip]'
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|alpha_space'
            ],
            'no_sk' => [
                'label' => 'Nomor SK',
                'rules' => 'required'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[admin.email]'
            ],
            'kata_sandi' => [
                'label' => 'Kata Sandi',
                'rules' => 'required|min_length[8]|regex_match[/[a-z]/]|regex_match[/[A-Z]/]|regex_match[/[!@#$%^&*_-]/]'
            ],
            'passwordcheck' => [
                'label' => 'Konfirmasi Kata Sandi',
                'rules' => 'required|matches[kata_sandi]'
            ]
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data input dari form
        $email = $this->request->getPost('email');
        $nip = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama');
        $no_sk = $this->request->getPost('no_sk');
        $kata_sandi = password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT);

        // Data yang akan dimasukkan ke database
        $data = [
            'nip' => $nip,
            'nama' => $nama,
            'no_sk' => $no_sk,
            'email' => $email,
            'kata_sandi' => $kata_sandi
        ];

        // Simpan data ke database menggunakan AdminModel
        $model = new AdminModel();

        if ($model->insert($data)) {
            // Jika pendaftaran berhasil
            return $this->response->setJSON(['success' => true]);
        } else {
            // Jika ada kesalahan saat menyimpan ke database
            log_message('error', 'Pendaftaran admin gagal: ' . json_encode($model->errors()));
            return $this->response->setJSON([
                'success' => false,
                'errors' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'
            ]);
        }
    }
    public function loginadmin()
    {
        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, arahkan ke halaman utama
            return redirect()->to('/');
        }

        $data['title'] = "Login Admin";
        return view('auth/loginadmin', $data);
    }

    public function logintimteknis()
    {

        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, arahkan ke halaman utama
            return redirect()->to('/');
        }

        $data['title'] = "Login Tim Teknis";
        return view('auth/logintimteknis', $data);
    }

    public function logintimteknisAction()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form login
        $validation->setRules([
            'email' => 'required|valid_email',
            'kata_sandi' => 'required',
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data dari form
        $email = $this->request->getPost('email');
        $kata_sandi = $this->request->getPost('kata_sandi');

        // Load model
        $model = new TimteknisModel();

        // Cek apakah email ada di database
        $timteknis = $model->where('email', $email)->first();

        // Jika timteknis tidak ditemukan
        if (!$timteknis) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'Pengguna tidak ditemukan.']
            ]);
        }

        // Jika kata sandi tidak sesuai
        if (!password_verify($kata_sandi, $timteknis['kata_sandi'])) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['kata_sandi' => 'Kata sandi salah.']
            ]);
        }


        // Jika admin tidak ditemukan
        if ($timteknis['status_akun'] === 'Pending') {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'Akun Anda belum aktif']
            ]);
        }

        // Simpan data timteknis ke session
        session()->set('id_tim_teknis', $timteknis['id_tim_teknis']);
        session()->set('email', $timteknis['email']);
        session()->set('nama', $timteknis['nama']);
        session()->set('role', 'Tim Teknis');
        session()->set('logged_in', true);


        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login berhasil!'
        ]);
    }

    public function logindppk()
    {
        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, arahkan ke halaman utama
            return redirect()->to('/');
        }

        $data['title'] = "Login DPPK";
        return view('auth/logindppk', $data);
    }

    public function logindppkAction()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form login
        $validation->setRules([
            'email' => 'required|valid_email',
            'kata_sandi' => 'required',
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data dari form
        $email = $this->request->getPost('email');
        $kata_sandi = $this->request->getPost('kata_sandi');

        // Load model
        $model = new DppkModel();

        // Cek apakah email ada di database
        $dppk = $model->where('email', $email)->first();

        // Jika dppk tidak ditemukan
        if (!$dppk) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'Pengguna tidak ditemukan.']
            ]);
        }

        // Jika kata sandi tidak sesuai
        if (!password_verify($kata_sandi, $dppk['kata_sandi'])) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['kata_sandi' => 'Kata sandi salah.']
            ]);
        }

        // Jika admin tidak ditemukan
        if ($dppk['status_akun'] === 'Pending') {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'Akun Anda belum aktif']
            ]);
        }

        // Simpan data dppk ke session
        session()->set('id_dppk', $dppk['id_dppk']);
        session()->set('email', $dppk['email']);
        session()->set('nama', $dppk['nama']);
        session()->set('role', 'DPPK');
        session()->set('logged_in', true);


        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login berhasil!'
        ]);
    }

    public function loginPenerima()
    {
        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, arahkan ke halaman utama
            return redirect()->to('/');
        }

        $data['title'] = "Login Penerima Penghargaan Kalpataru";
        return view('auth/loginpenerima', $data);
    }

    public function loginPenerimaAction()
    {
        // Load validation service
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form login
        $validation->setRules([
            'email' => 'required|valid_email',
            'kata_sandi' => 'required',
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        // Ambil data dari form
        $email = $this->request->getPost('email');
        $kata_sandi = $this->request->getPost('kata_sandi');

        // Load model
        $model = new PenerimaModel();

        // Cek apakah email ada di database
        $penerima = $model->where('email', $email)->first();

        // Jika penerima tidak ditemukan
        if (!$penerima) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'Pengguna tidak ditemukan.']
            ]);
        }

        // Jika kata sandi tidak sesuai
        if (!password_verify($kata_sandi, $penerima['kata_sandi'])) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['kata_sandi' => 'Kata sandi salah.']
            ]);
        }

        // Jika admin tidak ditemukan
        if ($penerima['status_akun'] === 'Pending') {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['email' => 'Akun Anda belum aktif']
            ]);
        }

        // Simpan data penerima ke session
        session()->set('id_penerima', $penerima['id_penerima']);
        session()->set('email', $penerima['email']);
        session()->set('nama', $penerima['nama']);
        session()->set('kategori', $penerima['kategori']);
        session()->set('role', 'Penerima');
        session()->set('logged_in', true);


        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login berhasil!'
        ]);
    }

    public function registerTimTeknis()
    {
        $data['title'] = "Daftar Akun Tim Teknis";
        return view('admin/daftartimteknis', $data);
    }

    public function createRegisterTimTeknis()
    {
        $model = new TimTeknisModel();

        $data = [
            'id_admin' => session()->get('id_admin'),
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'no_sk' => $this->request->getPost('no_sk'),
            'email' => $this->request->getPost('email'),
            'kata_sandi' => password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT),
            'status_akun'  => 'Pending',
        ];

        if ($model->insert($data)) {
            return;
        } else {
            log_message('error', 'Registration failed: ' . json_encode($model->errors()));
            return $this->response->setJSON(['success' => false, 'errors' => $model->errors()]);
        }
    }

    public function registerDPPK()
    {
        $data['title'] = "Register DPPK";
        return view('admin/daftardppk', $data);
    }

    public function createRegisterDPPK()
    {
        $model = new DppkModel();

        $data = [
            'id_admin' => session()->get('id_admin'),
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'no_sk' => $this->request->getPost('no_sk'),
            'email' => $this->request->getPost('email'),
            'kata_sandi' => password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT),
            'status_akun'  => 'Pending',
        ];

        if ($model->insert($data)) {
            return;
        } else {
            log_message('error', 'Registration failed: ' . json_encode($model->errors()));
            return $this->response->setJSON(['success' => false, 'errors' => $model->errors()]);
        }
    }

    public function registerPenerima()
    {
        $data['title'] = "Daftar Akun Penerima";
        return view('admin/daftarakunpengguna', $data);
    }

    public function createRegisterPenerima()
    {
        $model = new PenerimaModel();

        $kategoriValue = $this->request->getPost('kategori');

        switch ($kategoriValue) {
            case 'A':
                $kategori = 'Perintis Lingkungan';
                break;
            case 'B':
                $kategori = 'Pengabdi Lingkungan';
                break;
            case 'C':
                $kategori = 'Penyelamat Lingkungan';
                break;
            case 'D':
                $kategori = 'Pembina Lingkungan';
                break;
            default:
                $kategori = 'Unknown';
        }

        $data = [
            'id_admin' => session()->get('id_admin'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'kategori' => $kategori,
            'tahun' => $this->request->getPost('tahun'),
            'kata_sandi' => password_hash($this->request->getPost('kata_sandi'), PASSWORD_DEFAULT),
            'status_akun'  => 'Pending',
        ];

        if ($model->insert($data)) {
            return;
        } else {
            log_message('error', 'Registration failed: ' . json_encode($model->errors()));
            return $this->response->setJSON(['success' => false, 'errors' => $model->errors()]);
        }
    }
}
