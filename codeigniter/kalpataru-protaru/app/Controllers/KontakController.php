<?php

namespace App\Controllers;

use Config\Services;

class KontakController extends BaseController
{
    public function sendEmail()
    {
        $data = $this->request->getJSON();

        $nama = $data->nama;
        $email = $data->email;
        $telepon = $data->telepon;
        $pesan = $data->pesan;

        if (!$nama || !$email || !$telepon || !$pesan) {
            return $this->response->setJSON(['success' => false, 'message' => 'Semua field harus diisi!']);
        }

        $emailService = Services::email();

        $emailService->setFrom($email, $nama);
        $emailService->setTo('kalpataru.klhk@gmail.com');
        $emailService->setReplyTo($email, $nama);

        $emailService->setSubject('Pesan dari Form Kontak Website Sistem Informasi Penghargaan Kalpataru');
        $emailService->setMessage("
            <h2>Pesan dari Form Kontak Website Sistem Informasi Penghargaan Kalpataru</h2>
            <p><strong>Nama:</strong> $nama</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Telepon:</strong> $telepon</p>
            <p><strong>Pesan:</strong> $pesan</p>
        ");
        $emailService->setAltMessage("Nama: $nama\nEmail: $email\nTelepon: $telepon\nPesan: $pesan");

        $emailService->send();

        $emailService->clear();
        $emailService->setFrom('kalpataru.klhk@gmail.com', 'kalpataru');
        $emailService->setTo($email);
        $emailService->setSubject('Terima kasih telah mengirim kontak kami');
        $emailService->setMessage("
            <h2>Terima kasih telah menghubungi kami pada Website Sistem Informasi Penghargaan Kalpataru</h2>
            <p>Halo $nama,</p>
            <p>Terima kasih telah menghubungi kami. Berikut adalah salinan pesan yang Anda kirimkan:</p>
            <p><strong>Nama:</strong> $nama</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Telepon:</strong> $telepon</p>
            <p><strong>Pesan:</strong> $pesan</p>
            <p>Kami akan segera menanggapi pesan Anda.</p>
        ");
        $emailService->setAltMessage("Halo $nama,\n\nTerima kasih telah menghubungi kami. Berikut adalah salinan pesan yang Anda kirimkan:\n\nNama: $nama\nEmail: $email\nTelepon: $telepon\nPesan: $pesan\n\nKami akan segera menanggapi pesan Anda.");

        if ($emailService->send()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Pesan berhasil dikirim!']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Pesan gagal dikirim.']);
        }
    }
}