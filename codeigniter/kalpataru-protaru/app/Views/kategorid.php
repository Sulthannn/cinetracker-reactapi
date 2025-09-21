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
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-medium text-black">Pembina Lingkungan</h2>
            <hr class="border-2 border-primary w-48 mx-auto mt-2">

            <p class="text-lg mt-12 lg:mx-32 mx-0 text-justify">
                Pembina Lingkungan adalah individu/tokoh masyarakat bukan pejabat pemerintah yang
                melakukan pembinaan untuk membangkitkan kesadaran, prakarsa, dan peran masyarakat
                guna melestarikan fungsi dan tatanan lingkungan hidup dan/atau berhasil
                mengimplementasikan temuan teknologi baru yang ramah lingkungan
            </p>

            <p class="text-lg mt-12 lg:mx-32 mx-0 text-justify">
                <strong>Kriteria Kategori Pembina Lingkungan:</strong>
            </p>
            <ul class="list-disc lg:mx-32 mx-0 mt-4 text-lg text-justify space-y-2">
                <li>Individu/tokoh masyarakat, bukan pejabat pemerintah</li>
                <li>Berhasil membangkitkan kesadaran, prakarsa dan peran
                    masyarakat guna melestarikan fungsi dan tatanan
                    lingkungan hidup</li>
                <li>Berhasil membina untuk melestarikan fungsi dan tatanan
                    lingkungan hidup dan kehutanan melalui upaya
                    pencegahan pencemaran tanah, air, dan udara dan/atau
                    pencegahan terhadao kerusakan ekosistem dan/atau
                    berhasil melakukan upaya pelestarian keanekaragaman
                    hayati yang berdampak positif terhadap PPLHK, sosial
                    dan ekonomi bagi masyarakat sekitarnya, dan/atau
                    berhasil mengimplementasikan temuan teknologi baru
                    yang ramah lingkungan.</li>
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