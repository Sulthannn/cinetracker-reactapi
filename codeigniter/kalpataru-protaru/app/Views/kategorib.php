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
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-medium text-black">Pengabdi Lingkungan</h2>
            <hr class="border-2 border-primary w-48 mx-auto mt-2">

            <p class="text-lg mt-12 lg:mx-32 mx-0 text-justify">
                Pengabdi Lingkungan adalah individu baik petugas lapangan dan/atau pegawai negeri atau Aparatur Sipil Negara yang mendedikasikan hidupnya dalam upaya perlindungan dan pengelolaan lingkungan hidup dan kehutanan yang melampaui kewajiban dan tugas pokok profesi dalam jangka waktu lama secara berurutan paling sedikit 5 (lima) tahun.
            </p>

            <p class="text-lg mt-12 lg:mx-32 mx-0 text-justify">
                <strong>Kriteria Kategori Pengabdi Lingkungan:</strong>
            </p>
            <ul class="list-disc lg:mx-32 mx-0 mt-4 text-lg text-justify space-y-2">
                <li>Individu,baik petugas lapangan dan/atau pegawai negeri atau aparatur sipil negara</li>
                <li>Mendedikasikan hidupnya melampaui kewajiban dan tugas pokok profesi dalam mengembangkan upaya PPLHK</li>
                <li>Kegiatan pengabdian terhadap upaya PPLHK telah memberikan dampak positif terhadap pelestarian lingkungan hidup dan kehutanan, peningkatan aspek sosial dan aspek ekonomi bagi masyarakat sekitarnya.</li>
                <li>Kegiatan yang dipelopori telah memberikan dampak positif terhadap upaya pengembangan, pelestarian, dan pengelolaan lingkungan hidup dan kehutanan bagi masyarakat sekitarnya;</li>
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