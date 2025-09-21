<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?= $this->extend('template/navbarfooter') ?>

    <?= $this->section('content') ?>

    <div class="flex flex-col lg:flex-row justify-center m-4">
        <?= $this->include('template/sidebarpengusul') ?>
        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <h4 class="block text-xl font-bold text-slate-800 mb-2">
                Detail Artikel Saya
            </h4>

            <div class="relative flex items-center justify-center h-full overflow-hidden text-white rounded-md">
                <img src="/public/<?= esc($artikel['foto']); ?>" class="object-contain w-full h-full">
            </div>

            <div>
                <div class="my-4">
                    <h2 class="text-slate-800 text-md font-semibold text-xl">
                        <?= $artikel['judul']; ?>
                    </h2>
                    <h3 class="text-sm">
                        Tanggal Artikel: <?= esc($artikel['tanggal']); ?>
                    </h3>
                </div>
                <p class="text-slate-600 leading-normal font-light text-justify mt-4">
                    <?= nl2br(htmlspecialchars($artikel['konten'])); ?><br><br>
                </p>
            </div>

            <button onclick="window.history.back()"
                class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start w-1/12">
                <span class="font-bold text-lg items-center">←</span> Kembali
            </button>
        </div>

    </div>

    <?= $this->endSection() ?>
</body>

</html>