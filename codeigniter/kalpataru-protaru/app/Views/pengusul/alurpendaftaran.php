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

        <!-- Konten utama -->
        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <h4 class="block text-xl font-bold text-slate-800 mb-2">
                Alur Pendaftaran Penghargaan Kalpataru
            </h4>

            <div class="relative flex flex-col w-full h-full bg-white text-gray-700 shadow-md rounded-lg bg-clip-border mt-4">
                <img src="/images/alurpendaftaran.png">
            </div>
        </div>


    </div>

    <?= $this->endSection() ?>
</body>

</html>