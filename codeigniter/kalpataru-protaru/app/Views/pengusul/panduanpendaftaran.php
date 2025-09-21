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
                Panduan Pendaftaran
            </h4>

            <div class="relative w-full overflow-hidden pt-[50%] rounded-lg flex flex-col h-full bg-white text-gray-700 shadow-md mt-4">
                <iframe class="absolute top-0 left-0 w-full h-full"
                    src="<?= base_url('file/panduanpendaftaran2024.pdf') ?>"
                    frameborder="0"></iframe>
            </div>

        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>