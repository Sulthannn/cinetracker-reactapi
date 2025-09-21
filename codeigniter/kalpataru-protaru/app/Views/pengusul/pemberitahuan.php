<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>

    <?= $this->extend('template/navbarfooter') ?>

    <?= $this->section('content') ?>

    <div class="flex flex-col lg:flex-row justify-center m-4">
        <?= $this->include('template/sidebarpengusul') ?>

        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <h4 class="block text-xl font-bold text-slate-800 mb-2">
                Pemberitahuan
            </h4>
            <div class="relative flex flex-col w-full h-[28rem] bg-white overflow-y-auto text-gray-700 shadow-md rounded-lg mt-4">
                <table class="w-full text-left table-auto min-w-max h-screen">
                    <tbody>
                        <?php if (!empty($pendaftaran)): ?>
                            <?php foreach ($pendaftaran as $item): ?>
                                <?php
                                    $message = '';
                                    if (in_array($item['status_pendaftaran'], ['Sesuai', 'Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'])) {
                                        switch ($item['status_pendaftaran']) {
                                            case 'Sesuai':
                                                $message = "Selamat, ada usulan calon baru bernama <b>{$item['nama']}</b> telah Sesuai!";
                                                break;
                                            case 'Verifikasi Administrasi':
                                                $message = "Usulan <b>{$item['nama']}</b> sedang dalam tahap Verifikasi Administrasi.";
                                                break;
                                            case 'Lolos Administrasi':
                                                $message = "Selamat! Usulan <b>{$item['nama']}</b> telah Lolos Administrasi.";
                                                break;
                                            case 'Tidak Lolos Administrasi':
                                                $message = "Mohon maaf, usulan <b>{$item['nama']}</b> tidak Lolos Administrasi.";
                                                break;
                                        }
                                    }
                                ?>
                                <?php if ($message): ?>
                                    <tr class="hover:bg-slate-100">
                                        <td class="p-4 border-b border-slate-200">
                                            <img src="/images/penghargaankalpatarucircle.png" alt="penghargaankalpatarucircle" class="w-8 h-8 rounded-full ms-8">
                                        </td>
                                        <td class="p-4 border-b border-slate-200">
                                            <p class="text-sm text-slate-800 text-start"><?= $message ?></p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="p-4 border-b border-slate-200 text-center">
                                    <p class="text-sm text-slate-800">Tidak ada pemberitahuan</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>