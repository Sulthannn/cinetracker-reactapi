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

    <!-- Pencapaian Section -->
    <section id="pencapaian" class="lg:my-12 md:my-8 my-4 px-4 sm:px-10 md:px-16 lg:px-20">

        <!-- Tampilkan Gambar yang Dipilih -->
        <div class="flex justify-center">
            <?php if (isset($selectedImage)): ?>
                <img src="<?= base_url('capaian/' . rawurlencode(esc($selectedImage))) ?>" alt="Selected Achievement" class="w-full max-w-md object-cover">
            <?php else: ?>
                <p>Gambar tidak ditemukan.</p>
            <?php endif; ?>
        </div>

        <button onclick="window.location.href='/#pencapaian'"
            class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
            <span class="font-bold text-lg items-center">←</span> Kembali
        </button>

    </section>

    <?= $this->endSection() ?>

</body>

</html>