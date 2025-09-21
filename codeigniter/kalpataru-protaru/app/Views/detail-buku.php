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
        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <button onclick="window.history.back()"
                class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
                <span class="font-bold text-lg items-center">←</span> Kembali
            </button>
            <div class="relative w-full overflow-hidden pt-[50%] rounded-lg flex flex-col h-full bg-white text-gray-700 shadow-md mt-4">
                <iframe class="absolute top-0 left-0 w-full h-full"
                    src="<?= base_url(esc($buku['file'])) ?>"
                    frameborder="0">
                </iframe>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>