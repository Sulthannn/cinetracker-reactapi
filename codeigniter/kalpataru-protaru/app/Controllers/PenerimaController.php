<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\PenerimaModel;
use CodeIgniter\Controller;

class PenerimaController extends BaseController
{
    public function dashboard()
    {
        // $model = new PenerimaModel();
        $ArtikelModel = new ArtikelModel();

        $id_penerima = session()->get('id_penerima');

        // $penerima = $model->where('id_penerima', $id_penerima)->first();

        $perPage = 5;
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            $artikels = $ArtikelModel->where('id_penerima', $id_penerima)
                ->like('judul', $keyword)
                ->paginate($perPage, 'artikel');
        } else {
            $artikels = $ArtikelModel->where('id_penerima', $id_penerima)
                ->paginate($perPage, 'artikel');
        }
        $data = [
            'title' => 'Dashboard Penerima',
            'artikels' => $artikels,
            'pager' => $ArtikelModel->pager,
            'keyword' => $keyword,
        ];

        return view('penerima/dashboard', $data);
    }

    public function tambahartikel()
    {
        $data = [
            'title' => 'Tambah Artikel',
            'id_penerima' => session()->get('id_penerima'),
        ];

        return view('penerima/tambahartikel', $data);
    }

    public function tambahArtikelAction()
    {
        if (!session()->has('id_penerima')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Session id penerima tidak ditemukan. Silakan login kembali.'
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
                'rules' => 'required|min_length[5]|max_length[125]|is_unique[artikel.judul]' // Judul harus unik dan panjang antara 5 dan 125 karakter
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
            'id_penerima' => session()->get('id_penerima'),
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

    public function detailartikel($slug)
    {
        $Model = new ArtikelModel();
        $artikel = $Model->where('slug', $slug)->first(); // Ambil artikel berdasarkan slug

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $id_penerima = session()->get('id_penerima');
        $id_admin = session()->get('id_admin');

        // Jika artikel masih ditangguhkan
        if ($artikel['status'] == 'Ditangguhkan') {
            // Cek apakah yang mengakses adalah admin atau pembuat artikel
            if (!$id_admin && $artikel['id_penerima'] != $id_penerima) {
                // Jika bukan admin atau pembuat artikel, tampilkan 404
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        $data = [
            'title' => 'Detail Artikel Saya',
            'artikel' => $artikel,
        ];
        return view('penerima/detailartikelsaya', $data);
    }

    public function detailartikelsaya()
    {
        $data['title'] = 'Detail Artikel Saya';
        return view('penerima/detailartikelsaya', ['title' => 'Detail Artikel Saya']);
    }
}
