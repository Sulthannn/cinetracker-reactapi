<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index()
    {
        $data['title'] = "Penghargaan Kalpataru";
        return view('landingpage', $data);
    }

    public function profil()
    {
        $data['title'] = "Profil";
        return view('profil', $data);
    }
    public function kategori()
    {
        $data['title'] = "Kategori";
        return view('kategori', $data);
    }
    public function kategoria()
    {
        $data['title'] = "Kategori Perintis Lingkungan";
        return view('kategoria', $data);
    }

    public function kategorib()
    {
        $data['title'] = "Kategori Pengabdi Lingkungan";
        return view('kategorib', $data);
    }

    public function kategoric()
    {
        $data['title'] = "Kategori Penyelamat Lingkungan";
        return view('kategoric', $data);
    }

    public function kategorid()
    {
        $data['title'] = "Kategori Pembina Lingkungan";
        return view('kategorid', $data);
    }

    public function kontak()
    {
        $data['title'] = "Kontak";
        return view('kontak', ['title' => 'Kontak']);
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

    public function showCapaian($filename)
    {
        $filePathJpg = WRITEPATH . 'uploads/capaian/' . $filename;
        if (file_exists($filePathJpg)) {
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody(file_get_contents($filePathJpg));
        }

        $filePathJpeg = WRITEPATH . 'uploads/capaian/' . $filename;
        if (file_exists($filePathJpeg)) {
            return $this->response
                ->setHeader('Content-Type', 'image/jpeg')
                ->setBody(file_get_contents($filePathJpeg));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan.');
    }

    public function protaru()
    {
        $data['title'] = "Protaru";
        return view('protaru', $data);
    }
}
