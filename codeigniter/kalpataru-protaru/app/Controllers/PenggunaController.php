<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class PenggunaController extends BaseController
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    public function registerpage()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $data['title'] = "Daftar Akun";
        return view('auth/registerpengguna', $data);
    }

    // Method untuk pendaftaran pengguna
    public function register()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form pendaftaran pengusul
        $validation->setRules([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|alpha_space'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[pengguna.email]'
            ],
            'password' => [
                'label' => 'Kata Sandi',
                'rules' => 'required|min_length[8]|regex_match[/[a-z]/]|regex_match[/[A-Z]/]|regex_match[/[!@#$%^&*_-]/]'
            ]
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'messages' => $validation->getErrors(),
            ]);
        }

        // Mendapatkan input dari form
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $verifikasi_kode = rand(100000, 999999); // Generate kode verifikasi random

        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'verifikasi_kode' => $verifikasi_kode,
            'verifikasi_status' => 'pending'
        ];

        // Simpan pengguna baru
        if ($this->penggunaModel->createUser($data)) {
            // Kirim email verifikasi
            $this->sendVerificationEmail($email, $verifikasi_kode);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pendaftaran berhasil! Silakan periksa email Anda untuk kode verifikasi.'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Pendaftaran gagal!'
        ]);
    }

    private function sendVerificationEmail($recipientEmail, $verifikasi_kode)
    {
        // Load email library
        $email = \Config\Services::email();

        // Set email configuration
        $email->setFrom('kalpataru.klhk@gmail.com', 'kalpataru');
        $email->setTo($recipientEmail);

        // Set email subject and message
        $email->setSubject('Verifikasi Akun Anda');
        $email->setMessage('
    <h1>Selamat Datang!</h1>
    <p>Terima kasih telah mendaftar di Website Kalpataru.</p>
    <p>Untuk memverifikasi akun Anda, silakan masukkan kode verifikasi berikut:</p>
    <h2>' . $verifikasi_kode . '</h2>
    <p>Silahkan masukan kode verifikasi ke dalam link berikut <a href="https://localhost:8080/verify">Halaman Verifikasi</a></p>
    <p>Jika Anda tidak mendaftar, silakan abaikan email ini.</p>
    ');

        // Menggunakan HTML email
        $email->setMailType('html');

        // Kirim email
        if ($email->send()) {
            return true;
        } else {
            // Jika gagal mengirim, tampilkan kesalahan
            $data = $email->printDebugger(['headers']);
            log_message('error', 'Email tidak dapat dikirim: ' . $data);
            return false;
        }
    }

    public function verifypage()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }
        $data['title'] = "Verifikasi Akun";
        return view('auth/verifikasipengguna', $data);
    }

    public function verify()
    {
        $email = $this->request->getPost('email');
        $kode_verifikasi = $this->request->getPost('kode_verifikasi');

        // Cek apakah kode verifikasi valid dan ada di database
        $isValid = $this->penggunaModel->verifyUser($email, $kode_verifikasi);

        if ($isValid) {
            // Jika berhasil, update status pengguna
            $this->penggunaModel->updateStatus($email, 'verified'); // Pastikan metode ini ada di model

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Akun berhasil diaktivasi, silakan login.'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Aktivasi gagal! Kode verifikasi tidak valid atau email tidak terdaftar.'
        ]);
    }

    public function loginpage()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $data['title'] = "Masuk Akun";
        return view('auth/loginpengguna', $data);
    }

    public function login()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi untuk form login
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);

        // Lakukan validasi input
        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Mencari pengguna berdasarkan email
        $user = $this->penggunaModel->findUserByEmail($email);

        if ($user) {
            // Verifikasi kata sandi
            if (password_verify($password, $user['password'])) {
                // Cek status akun
                if ($user['status'] === 'verified') {
                    $sessionData = [
                        'id_pengguna' => $user['id_pengguna'],
                        'nama' => $user['nama'],
                        'status' => 'Terverifikasi',
                        'email' => $user['email'],
                        'role' => 'Pengguna',
                        'logged_in' => true,
                    ];
                    session()->set($sessionData);

                    // Kembalikan URL untuk redirect sesuai role_akun
                    return $this->response->setJSON(['success' => true, 'redirectUrl' => '/dashboard']);
                } else {
                    return $this->response->setJSON(['success' => false, 'message' => 'Akun Anda belum aktif']);
                }
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Kata sandi salah']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengguna tidak ditemukan']);
        }
    }

    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('authMessage', 'Harap login terlebih dahulu');
        }
        $data['title'] = "Dashboard Pengguna";
        return view('pengguna/dashboard', $data);
    }
}
