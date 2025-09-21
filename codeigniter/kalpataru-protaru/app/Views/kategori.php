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
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-medium text-black">Kategori Penghargaan</h2>
            <hr class="border-2 border-primary w-48 mx-auto mt-2">
            <p class="text-sm mt-12 lg:mx-32 mx-0">Dalam pelaksanaannya penghargaan Kalpataru tergabi menjadi 4 kategori utama. Di
                mana setiap kategori memiliki definisi masing-masing dalam menjaga serta melertarikan lingkungan dan kehutanan di Indonesia</p>
        </div>

        <!-- Perintis Lingkungan -->
        <div id="kategoria" class="flex flex-col lg:flex-row items-center lg:items-start px-4 lg:px-24 my-12">
            <img src="/images/kategoria.jpg" alt="Perintis Lingkungan" class="w-40 lg:w-56 h-auto rounded-lg mb-4 lg:mb-0 lg:mr-6 mx-auto lg:mx-0">
            <div class="text-center lg:text-left">
                <h3 class="text-xl font-medium mb-2"><b>Perintis</b> Lingkungan</h3>
                <hr class="border-2 border-primary w-40 mt-1 mb-4 mx-auto lg:mx-0">
                <p class="text-sm leading-relaxed text-justify mb-4">Perintis Lingkungan adalah individu bukan pegawai negeri atau bukan pejabat negara yang
                    mempelopori upaya luar biasa bagi
                    perlindungan dan pengelolaan lingkungan hidup dan
                    kehutanan, dan merupakan kegiatan baru di wilayah/kawasan tertentu
                    dan/atau berhasil
                    mengembangkan teknologi lokal yang ramah lingkungan. Lebih lanjut, mereka berperan penting
                    dalam
                    menginspirasi masyarakat sekitar untuk melakukan kegiatan yang mendukung pelestarian
                    lingkungan secara terus menerus.
                </p>
                <a href="/informasi/arsip-perintis" class="bg-primary text-white px-4 py-2 mb-6 lg:mb-0 rounded-md hover:bg-primaryhover">Lihat Daftar Penerima</a href="">
            </div>
        </div>

        <!-- Pengabdi Lingkungan (Reversed) -->
        <div id="kategorib" class="flex flex-col lg:flex-row-reverse items-center lg:items-start px-4 lg:px-24 my-12">
            <img src="/images/kategorib.jpg" alt="Pengabdi Lingkungan" class="w-40 lg:w-56 h-auto rounded-lg mb-4 lg:mb-0 lg:ml-6 mx-auto lg:mx-0">
            <div class="text-center lg:text-left">
                <h3 class="text-xl font-medium mb-2"><b>Pengabdi</b> Lingkungan</h3>
                <hr class="border-2 border-primary w-40 mt-1 mb-4 mx-auto lg:mx-0">
                <p class="text-sm leading-relaxed text-justify mb-4"> Pengabdi Lingkungan adalah individu baik petugas lapangan dan/atau pegawai negeri atau
                    Aparatur Sipil Negara yang mendedikasikan hidupnya dalam upaya perlindungan dan
                    pengelolaan lingkungan hidup dan kehutanan yang melampaui kewajiban dan tugas pokok
                    profesi dalam jangka waktu lama secara berurutan paling sedikit 5 (lima) tahun.</p>
                <a href="/informasi/arsip-pengabdi" class="bg-primary text-white px-4 py-2 mb-6 lg:mb-0 rounded-md hover:bg-primaryhover">Lihat Daftar Penerima</a>
            </div>
        </div>

        <!-- Penyelamat Lingkungan -->
        <div id="kategoric" class="flex flex-col lg:flex-row items-center lg:items-start px-4 lg:px-24 my-12">
            <img src="/images/kategoric.jpg" alt="Penyelamat Lingkungan" class="w-40 lg:w-56 h-auto rounded-lg mb-4 lg:mb-0 lg:mr-6 mx-auto lg:mx-0">
            <div class="text-center lg:text-left">
                <h3 class="text-xl font-medium mb-2"><b>Penyelamat</b> Lingkungan</h3>
                <hr class="border-2 border-primary w-40 mt-1 mb-4 mx-auto lg:mx-0">
                <p class="text-sm leading-relaxed text-justify mb-4"> Penyelamat Lingkungan adalah kelompok orang dan/atau lembaga yang menjaga dan/atau
                    memperbaiki penyelamatan fungsi dan tatanan lingkungan hidup atas dasar prakarsa
                    kelompok.</p>
                <a href="/informasi/arsip-penyelamat" class="bg-primary text-white px-4 py-2 mb-6 lg:mb-0 rounded-md hover:bg-primaryhover">Lihat Daftar Penerima</a>
            </div>
        </div>

        <!-- Pembina Lingkungan (Reversed) -->
        <div id="kategorid" class="flex flex-col lg:flex-row-reverse items-center lg:items-start px-4 lg:px-24 my-12">
            <img src="/images/kategorid.jpg" alt="Pembina Lingkungan" class="w-40 lg:w-56 h-auto rounded-lg mb-4 lg:mb-0 lg:ml-6 mx-auto lg:mx-0">
            <div class="text-center lg:text-left">
                <h3 class="text-xl font-medium mb-2"><b>Pembina</b> Lingkungan</h3>
                <hr class="border-2 border-primary w-40 mt-1 mb-4 mx-auto lg:mx-0">
                <p class="text-sm leading-relaxed text-justify mb-4"> Pembina Lingkungan adalah individu/tokoh masyarakat bukan pejabat pemerintah yang
                    melakukan pembinaan untuk membangkitkan kesadaran, prakarsa, dan peran masyarakat
                    guna melestarikan fungsi dan tatanan lingkungan hidup dan/atau berhasil
                    mengimplementasikan temuan teknologi baru yang ramah lingkungan.</p>
                <a href="/informasi/arsip-pembina" class="bg-primary text-white px-4 py-2 mb-6 lg:mb-0 rounded-md hover:bg-primaryhover">Lihat Daftar Penerima</a>
            </div>
        </div>

    </section>


    <?= $this->endSection() ?>

</body>

</html>