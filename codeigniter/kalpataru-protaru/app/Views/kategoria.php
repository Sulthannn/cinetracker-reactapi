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

    <!-- Kategori Section -->
    <section id="kategori" class="py-8 lg:mx-14 mx-0">
        <div class="text-center mb-4 px-4">
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-medium text-black">Perintis Lingkungan</h2>
            <hr class="border-2 border-primary w-48 mx-auto mt-2">

            <p class="text-lg mt-12 lg:mx-32 mx-0 text-justify">
                Perintis Lingkungan adalah individu bukan pegawai negeri atau bukan pejabat negara yang mempelopori upaya luar biasa bagi
                perlindungan dan pengelolaan lingkungan hidup dan kehutanan, dan merupakan kegiatan baru di wilayah/kawasan tertentu
                dan/atau berhasil mengembangkan teknologi lokal yang ramah lingkungan. Lebih lanjut, mereka berperan penting
                dalam menginspirasi masyarakat sekitar untuk melakukan kegiatan yang mendukung pelestarian lingkungan secara terus menerus.
            </p>

            <p class="text-lg mt-12 lg:mx-32 mx-0 text-justify">
                <strong>Kriteria Kategori Perintis Lingkungan:</strong>
            </p>
            <ul class="list-disc lg:mx-32 mx-0 mt-4 text-lg text-justify space-y-2">
                <li>Individu, bukan PNS/ASN/Pejabat Negara</li>
                <li>Mempelopori kegiatan luar biasa dalam PPLHK</li>
                <li>Kegiatan relatif baru di wilayah/kawasan tertentu dan/atau berhasil mengembangkan teknologi lokal yang ramah lingkungan</li>
                <li>Kegiatan yang dipelopori telah memberikan dampak positif terhadap upaya pengembangan, pelestarian, dan pengelolaan lingkungan hidup dan kehutanan bagi masyarakat sekitarnya</li>
                <li>Jangka waktu lama secara berurutan paling sedikit 5 (lima) tahun.</li>
            </ul>

            <button class="bg-primary text-white px-4 py-2 mt-8 mb-6 lg:mb-0 rounded-md hover:bg-primaryhover">
                Lihat Daftar Penerima
            </button>
        </div>

    </section>


    <?= $this->endSection() ?>

</body>

</html>