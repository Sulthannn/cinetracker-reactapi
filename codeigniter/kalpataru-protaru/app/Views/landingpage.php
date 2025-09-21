<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        .province-label {
            font-size: 16px;
            font-weight: bold;
            background: none;
            border: none;
            box-shadow: none;
            color: black;
            text-align: center;
            line-height: 1.5;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <?= $this->extend('template/navbarfooter') ?>

    <?= $this->section('content') ?>

    <?php if (!empty($pamflet)): ?>
        <div id="popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
            <div class="relative mt-12 w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-2xl rounded-lg flex items-start">
                <img src="<?= base_url('pamflet/' . rawurlencode(esc($pamflet['foto']))) ?>" alt="Popup Image" class="w-full rounded-md">
                <button id="close-btn" class="lg:text-5xl text-xl top-0 right-0 font-bold text-white ms-2">X</button>

            </div>
        </div>
    <?php endif; ?>

    <section id="herosection" class="w-full h-[20rem] sm:h-[30rem] md:h-[34rem] lg:h-[36rem] relative overflow-hidden">
        <!-- Carousel Wrapper -->
        <div class="carousel-wrapper w-full h-full flex transition-transform duration-500" style="transform: translateX(0%);">
            <!-- Carousel 1 -->
            <div class="carousel-item w-full flex-shrink-0 relative">
                <img src="/images/herosection1.png" alt="herosection 1" class="w-full h-full object-cover object-right md:object-center">
                <div class="absolute top-2/4 left-1/2 transform -translate-x-1/2 -translate-y-2/4 w-[90%] sm:w-[70%] md:w-[60%] lg:left-[28%] lg:w-[36%] text-white text-left">
                    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Menyelamatkan Alam, Mewarisi Kehidupan</h1>
                    <p class="text-sm sm:text-base md:text-lg mt-2 sm:mt-4">Penghargaan nasional untuk individu dan kelompok yang berkontribusi dalam pelestarian lingkungan hidup</p>
                </div>
                <a href="auth/register">
                    <button class="absolute bottom-[18%] left-[20%] sm:left-[20%] lg:left-[17%] transform -translate-x-1/2 rounded-md bg-white py-2 px-4 sm:py-3 sm:px-6 text-center text-xs sm:text-sm md:text-base lg:text-base text-black transition-all shadow-md hover:font-bold hover:shadow-lg focus:bg-site focus:shadow-none active:bg-site hover:bg-site active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Daftar Sekarang
                    </button>
                </a>
            </div>
            <!-- Carousel 2 -->
            <div class="carousel-item w-full flex-shrink-0 relative flex items-center justify-center">
                <img src="/images/herosection2.png" alt="herosection 2" class="w-full h-full object-cover object-right md:object-center">

                <!-- Overlay untuk meningkatkan kontras teks -->
                <div class="absolute inset-0 bg-black opacity-40"></div>

                <div class="absolute flex items-center justify-center inset-0 text-white text-center">
                    <div class="w-full sm:w-[70%] md:w-[60%]">
                        <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Kontribusi Lestari untuk Generasi Mendatang</h1>
                        <p class="text-sm sm:text-base md:text-lg mt-2 sm:mt-4">Menghargai mereka yang menjaga keanekaragaman hayati dan kekayaan alam Indonesia</p>
                    </div>
                </div>
            </div>
            <!-- Carousel 3 -->
            <div class="carousel-item w-full flex-shrink-0 relative flex items-center justify-center">
                <img src="/images/herosection3.png" alt="herosection 3" class="w-full h-full object-cover object-right md:object-center">
                <div class="absolute flex items-center justify-center inset-0 text-white text-center">
                    <div class="w-full sm:w-[70%] md:w-[60%]">
                        <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Bersama Membangun Lingkungan Lebih Baik</h1>
                        <p class="text-sm sm:text-base md:text-lg mt-2 sm:mt-4">Dedikasi untuk perubahan positif bagi lingkungan sekitar kita</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Navigation Dots -->
        <div class="absolute inset-x-0 bottom-8 flex justify-center space-x-3">
            <button onclick="moveCarousel(0)" class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100"></button>
            <button onclick="moveCarousel(-100)" class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100"></button>
            <button onclick="moveCarousel(-200)" class="w-3 h-3 rounded-full bg-white opacity-50 hover:opacity-100"></button>
        </div>

        <!-- Carousel Navigation Arrows -->
        <button onclick="moveSlide(-1)" class="hidden lg:block absolute top-1/2 left-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:shadow-lg focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button onclick="moveSlide(1)" class="hidden lg:block absolute top-1/2 right-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:shadow-lg focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </section>

    <section id="tentangkalpataru">
        <div class="lg:my-12 md:my-8 my-4">
            <div id="texttentangkalpataru" class="w-full h-[4rem] sm:h-[5rem] relative flex items-center justify-center">
                <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-bold text-black">Tentang Kalpataru</h2>
            </div>
            <hr class="hrcenter border-2 border-primary max-w-40 mx-auto mt-0" />
        </div>

        <div class="w-full flex flex-col lg:flex-row items-center justify-between px-6 sm:px-10 md:px-16 lg:px-20 py-12">
            <div class="w-full lg:w-1/2 lg:pr-10">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-medium text-black">Penghargaan Tertinggi untuk Pelestari Lingkungan</h3>
                <br />
                <p class="text-sm sm:text-base md:text-lg text-justify">
                    Kalpataru adalah penghargaan yang diberikan kepada perorangan atau kelompok atas jasanya dalam melestarikan lingkungan hidup di Indonesia. Kalpataru sendiri adalah bahasa Sanskerta yang berarti pohon kehidupan (Kalpavriksha)
                    <br /><br />
                    Penghargaan Kalpataru merupakan penghargaan tertinggi dari pemerintah Indonesia yang diberikan kepada individu, kelompok, dan lembaga yang telah menunjukkan dedikasi dan prakarsa dalam menjaga dan melestarikan lingkungan hidup.
                </p>
            </div>

            <figure class="w-full lg:w-1/2 lg:pl-10 mt-8 lg:mt-0">
                <img src="/images/tentangkalpataru.png" alt="tentangkalpataru" class="w-full h-auto rounded-md shadow-lg">
                <figcaption class="text-sm italic text-center">Prof. H. Emil Salim, S.E., M.A., Ph.D.</figcaption>
            </figure>
        </div>
    </section>

    <section id="kategoripenghargaan">
        <div class="lg:my-12 md:my-8 my-4 lg:mx-20 md:mx-10 mx-7">
            <div id="textkategoripenghargaan" class="w-full h-[4rem] sm:h-[5rem] relative flex items-center justify-start">
                <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-medium text-black">Kategori Penghargaan <b>Kalpataru</b></h2>
            </div>
            <hr class="hrleft border-2 border-primary max-w-[45%] mt-0" />
        </div>

        <div class="relative w-full px-6 sm:px-10 md:px-16 lg:px-20 py-12">
            <!-- arrow kiri -->
            <button id="categoryScrollLeft" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-footer text-white p-2 rounded-full shadow-md z-10 focus:outline-none sm:block md:hidden">
                &#9664;
            </button>

            <!-- Kontainer gambar kategori dengan properti flex untuk memusatkan gambar -->
            <div id="categoryContainer" class="flex gap-16 lg:justify-center lg:items-center overflow-x-auto sm:overflow-x-auto md:overflow-x-hidden scrollbar-show snap-x snap-mandatory scroll-smooth">
                <a href="/kategori" class="block flex-shrink-0 snap-center">
                    <img src="/images/kategoria.jpg" alt="kategoria" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
                <a href="/kategori" class="block flex-shrink-0 snap-center">
                    <img src="/images/kategorib.jpg" alt="kategorib" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
                <a href="/kategori" class="block flex-shrink-0 snap-center">
                    <img src="/images/kategoric.jpg" alt="kategoric" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
                <a href="/kategori" class="block flex-shrink-0 snap-center">
                    <img src="/images/kategorid.jpg" alt="kategorid" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
            </div>

            <!-- backup permintaan gambar jadi text -->
            <!-- <div id="categoryContainer" class="flex gap-16 lg:justify-center lg:items-center overflow-x-auto sm:overflow-x-auto md:overflow-x-hidden scrollbar-show snap-x snap-mandatory scroll-smooth">
                <a href="/kategoria" class="block flex-shrink-0 snap-center">
                    <img src="/images/perintis.jpg" alt="perintis" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
                <a href="/kategorib" class="block flex-shrink-0 snap-center">
                    <img src="/images/pengabdi.jpg" alt="pengabdi" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
                <a href="/kategorib" class="block flex-shrink-0 snap-center">
                    <img src="/images/penyelamat.jpg" alt="penyelamat" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
                <a href="/kategorid" class="block flex-shrink-0 snap-center">
                    <img src="/images/pembina.jpg" alt="pembina" class="w-56 h-auto rounded-2xl shadow-lg mx-auto">
                </a>
            </div> -->

            <!-- arrow kanan -->
            <button id="categoryScrollRight" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-footer text-white p-2 rounded-full shadow-md z-10 focus:outline-none sm:block md:hidden">
                &#9654;
            </button>
        </div>
    </section>

    <section id="tujuankalpataru" class="bg-primary">
        <div class="lg:my-12 md:my-8 my-4 pt-10 text-center">
            <div id="texttujuankalpataru" class="w-full h-[4rem] sm:h-[5rem] relative flex items-center justify-center">
                <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-bold text-white">Tujuan Kalpataru</h2>
            </div>
            <hr class="hrcenter border-2 border-white max-w-40 mx-auto mt-0" />
        </div>

        <div class="px-4 sm:px-10 md:px-16 lg:px-20 text-center">
            <p class="text-sm sm:text-base md:text-lg text-white mx-auto max-w-5xl">
                Meningkatkan kesadaran, membuka peluang bagi berkembangnya inovasi dan kreativitas, serta mendorong prakarsa masyarakat, sebagai bentuk apresiasi dan motivasi kepada individu dan kelompok masyarakat dalam melakukan perlindungan dan pengelolaan lingkungan hidup dan kehutanan secara berkelanjutan
            </p>

            <div class="grid gap-4 grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 mt-6 py-10 justify-center">
                <!-- Card 1 -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-lg w-4/5 mx-auto">
                    <div class="p-4">
                        <img src="/images/tujuan1.png" alt="tujuan1" class="w-10 mx-auto pb-2">
                        <h5 class="mb-2 text-slate-800 text-xl font-semibold">Mendorong Prakarsa Masyarakat</h5>
                        <p class="text-slate-600 leading-normal font-light">
                            Memberikan penghargaan kepada mereka yang telah mengambil langkah nyata dalam pelestarian lingkungan, baik melalui aksi individual maupun kolektif.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-lg w-4/5 mx-auto">
                    <div class="p-4">
                        <img src="/images/tujuan2.png" alt="tujuan2" class="w-10 mx-auto pb-2">
                        <h5 class="mb-2 text-slate-800 text-xl font-semibold">Meningkatkan Kesadaran Masyarakat</h5>
                        <p class="text-slate-600 leading-normal font-light">
                            Mendorong kesadaran publik akan pentingnya menjaga keseimbangan ekosistem dan memanfaatkan sumber daya alam secara berkelanjutan.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-lg w-4/5 mx-auto">
                    <div class="p-4">
                        <img src="/images/tujuan3.png" alt="tujuan3" class="w-10 mx-auto pb-2">
                        <h5 class="mb-2 text-slate-800 text-xl font-semibold">Menginspirasi Perubahan Positif</h5>
                        <p class="text-slate-600 leading-normal font-light">
                            Menjadikan para penerima penghargaan sebagai panutan bagi masyarakat luas dalam upaya pelestarian lingkungan, baik di tingkat lokal maupun nasional.
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-lg w-4/5 mx-auto">
                    <div class="p-4">
                        <img src="/images/tujuan4.png" alt="tujuan4" class="w-10 mx-auto pb-2">
                        <h5 class="mb-2 text-slate-800 text-xl font-semibold">Mendorong Partisipasi Aktif</h5>
                        <p class="text-slate-600 leading-normal font-light">
                            Mengundang banyak individu, kelompok, dan organisasi untuk berperan aktif dalam upaya konservasi dan pemulihan lingkungan melalui prakarsa baru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="statistikpeta">
        <div class="my-4 pt-10 text-center">
            <div id="textstatistikpenyebaran" class="w-full h-[4rem] sm:h-[5rem] relative flex items-center justify-center">
                <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-medium text-black">Statistik Penyebaran Penghargaan Kalpataru</h2>
            </div>
            <hr class="hrcenter border-2 border-primary max-w-64 mx-auto mt-0" />
        </div>

        <div class="relative w-full px-6 sm:px-10 md:px-16 lg:px-20 py-10">
            <div id="map"></div>
        </div>
    </section>

    <section id="statistikcard" class="bg-primary">
        <div class="px-4 sm:px-10 md:px-16 lg:px-20 py-10 text-center">
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 mt-6 py-10 justify-center">
                <!-- Card 1 -->
                <a href="/informasi/arsip-penerima" class="bg-white shadow-sm border border-slate-200 rounded-lg w-11/12 sm:w-4/5 mx-auto flex flex-col sm:flex-row gap-4 items-center px-4 py-6 sm:py-4">
                    <img src="/images/statistikcard1.png" alt="statistikcard1" class="w-20 h-20 sm:w-32 sm:h-32">
                    <div>
                        <h2 class="text-3xl sm:text-5xl font-bold text-gray-800 text-center sm:text-start mb-4"><?= $total; ?></h2>
                        <p class="text-gray-600 text-center sm:text-justify text-sm sm:text-base">Penerima Penghargaan Kalpataru sejak program ini dimulai pada tahun 1980</p>
                    </div>
                </a>

                <!-- Card 2 -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-lg w-11/12 sm:w-4/5 mx-auto flex items-center justify-center p-4">
                    <div class="space-y-4 w-96">

                        <!-- Keanekaragaman Hayati -->
                        <div class="flex items-center">
                            <img src="/images/statistikkeanekaragamanhayati.png" alt="statistikkeanekaragamanhayati" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Keanekaragaman Hayati</span>
                                    <span class="text-black font-bold"><?= $temaData->total_kahati; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card2progress2" class="bg-green-500 h-2.5 rounded-full" style="width: 0;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Perubahan Iklim -->
                        <div class="flex items-center">
                            <img src="/images/statistikperubahaniklim.png" alt="statistikperubahaniklim" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Perubahan Iklim</span>
                                    <span class="text-black font-bold"><?= $temaData->total_iklim; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card2progress4" class="bg-blue-500 h-2.5 rounded-full" style="width: 0;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pencemaran dan Kerusakan Lingkungan -->
                        <div class="flex items-center">
                            <img src="/images/statistikpencemarandankerusakanlingkungan.png" alt="statistikpencemarandankerusakanlingkungan" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Pencemaran dan Kerusakan Lingkungan</span>
                                    <span class="text-black font-bold"><?= $temaData->total_kerusakan_lingkungan; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card2progress3" class="bg-yellow-500 h-2.5 rounded-full" style="width: 0;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Hukum dan Budaya -->
                        <div class="flex items-center">
                            <img src="/images/statistikhukumdanbudaya.png" alt="statistikhukumdanbudaya" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Hukum dan Budaya</span>
                                    <span class="text-black font-bold"><?= $temaData->total_hukum; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card2progress1" class="bg-red-500 h-2.5 rounded-full" style="width: 0;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-lg w-11/12 sm:w-4/5 mx-auto flex items-center justify-center p-4">
                    <div class="space-y-4 w-80">
                        <div class="flex items-center">
                            <img src="/images/statistikperintislingkungan.png" alt="statistikperintislingkungan" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Perintis Lingkungan</span>
                                    <span class="text-black font-bold"><?= $kategoriData->total_perintis; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card3progress1" class="bg-red-500 h-2.5 rounded-full" style="width: 70%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pengabdi Lingkungan -->
                        <div class="flex items-center">
                            <img src="/images/statistikpengabdilingkungan.png" alt="statistikpengabdilingkungan" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Pengabdi Lingkungan</span>
                                    <span class="text-black font-bold"><?= $kategoriData->total_pengabdi; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card3progress2" class="bg-green-500 h-2.5 rounded-full" style="width: 80%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Penyelamat Lingkungan -->
                        <div class="flex items-center">
                            <img src="/images/statistikpenyelamatlingkungan.png" alt="statistikpenyelamatlingkungan" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Penyelamat Lingkungan</span>
                                    <span class="text-black font-bold"><?= $kategoriData->total_penyelamat; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card3progress3" class="bg-yellow-500 h-2.5 rounded-full" style="width: 90%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Pembina Lingkungan -->
                        <div class="flex items-center">
                            <img src="/images/statistikpembinalingkungan.png" alt="statistikpembinalingkungan" class="w-10 h-10 mr-3">
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Pembina Lingkungan</span>
                                    <span class="text-black font-bold"><?= $kategoriData->total_pembina; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div id="card3progress4" class="bg-blue-500 h-2.5 rounded-full" style="width: 50%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white shadow-sm border border-slate-200 rounded-lg w-11/12 sm:w-4/5 mx-auto p-4 flex flex-col sm:flex-row items-center gap-4 justify-center">
                    <div>
                        <canvas id="genderChart" width="150" height="150"></canvas>
                    </div>
                    <div>
                    <div class="flex items-center mb-4">
                        <!-- <span class="block w-10 h-4 bg-blue-500"></span> -->
                        <img src="images/logopria.png" alt="Pria" class="w-2/4 h-10 ml-2">
                        <span class="ml-2 text-sm sm:text-base">=</span>
                        <span class="text-black font-bold ml-4">(<?= $totalLakiLaki; ?>)</span>
                    </div>
                        <div class="flex items-center">
                         <!--   <span class="block w-10 h-4 bg-green-500 mr-2"></span> -->
                            <img src="images/logocewe.png" alt="Perempuan" class="w-2/4 h-12 ml-2">
                            <span class="ml-2 text-sm sm:text-base">=</span>
                            <span class="text-black font-bold ml-4">(<?= $totalPerempuan; ?>)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($capaian) && isset($capaian['gambar'])): ?>
        <section id="pencapaian">
            <div class="lg:my-12 md:my-8 my-4">
                <div id="textpencapaian" class="w-full h-[4rem] sm:h-[5rem] relative flex items-center justify-center">
                    <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-bold text-black">Pencapaian</h2>
                </div>
                <hr class="hrcenter border-2 border-primary max-w-40 mx-auto mt-0" />
            </div>
            <div class="aspect-w-16 aspect-h-9 my-4">
                <img src="<?= base_url('capaian/' . rawurlencode(esc($capaian['gambar']))) ?>"
                    alt="pencapaian"
                    class="object-cover w-3/4 h-full mx-auto rounded-lg overflow-hidden pb-12">
            </div>
        </section>
    <?php endif; ?>

    <section id="ajakan" class="relative">
        <img src="/images/ajakan.png" alt="ajakan" class="w-full h-auto max-h-[300px] object-cover">

        <div class="absolute inset-0 grid grid-cols-2 p-4 sm:p-6 lg:p-8 lg:mt-7 lg:mx-28 text-white">

            <div class="text-left">
                <p class="text-xs sm:text-sm md:text-base lg:text-3xl font-medium">
                    Jadilah bagian dari <br /> perubahan
                </p>
            </div>

            <div class="lg:ms-16 text-left space-y-2">
                <p class="text-xs sm:text-xs md:text-base lg:text-lg">
                    Tunjukan dukungan Anda untuk upaya pelestarian lingkungan. Bergabunglah dengan kami dan buat perubahan nyata!
                </p>
                <a href="auth/register">
                    <button class="rounded-md bg-white lg:mt-2 py-2 px-4 sm:px-3 text-xs sm:text-sm md:text-base lg:text-base text-black transition-all shadow-md hover:font-bold hover:shadow-lg focus:bg-site focus:shadow-none active:bg-site hover:bg-site active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Daftar Sekarang
                    </button>
                </a>
            </div>
        </div>
    </section>

    <section id="berita">
        <div class="lg:mx-28 p-5">
            <div id="textberita" class="flex justify-between items-center lg:mt-10 mb-2">
                <h2 class="text-lg font-bold">Berita</h2>
                <a href="<?= base_url('publikasi/berita') ?>" class="flex items-center text-primary">
                    Selengkapnya
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <hr class="hrleft border-2 border-primary w-full mt-0 mb-10" />

            <div class="relative flex overflow-x-auto space-x-4 scrollbar-hide">
                <!-- arrow kiri -->
                <button id="beritaScrollLeft" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-footer text-white p-2 rounded-full shadow-md z-10 focus:outline-none sm:block md:hidden">
                    &#9664;
                </button>
                <div id="beritaContainer" class="flex overflow-x-auto space-x-4 scrollbar-hide">
                    <?php if (!empty($berita) && is_array($berita)): ?>
                        <?php foreach ($berita as $item): ?>
                            <div class="flex-none w-64 bg-white rounded-lg shadow-md my-2">
                                <img src="/public/<?= esc($item['foto']); ?>" alt="<?= esc($item['judul']); ?>" class="w-full h-40 object-cover rounded-t-lg">
                                <div class="p-4">
                                    <h3 class="font-bold text-md mb-2"><?= word_limiter(esc($item['judul']), 4); ?></h3>
                                    <a href="/berita/<?= esc($item['slug']); ?>" class="text-primary flex items-center text-sm">
                                        Baca Selengkapnya
                                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada berita yang terbit saat ini</p>
                    <?php endif; ?>
                </div>

                <!-- arrow kanan -->
                <button id="beritaScrollRight" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-footer text-white p-2 rounded-full shadow-md z-10 focus:outline-none sm:block md:hidden">
                    &#9654;
                </button>
            </div>
        </div>
    </section>

    <section id="video" class="mb-6">
        <div class="lg:mx-28 p-5">
            <div id="textvideo" class="flex justify-between items-center lg:mt-10 mb-2">
                <h2 class="text-lg font-bold">Video</h2>
                <a href="<?= base_url('publikasi/video') ?>" class="flex items-center text-primary">
                    Selengkapnya
                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <hr class="hrleft border-2 border-primary w-full mt-0 mb-10" />

            <div class="relative flex overflow-x-auto space-x-4 scrollbar-hide">
                <!-- arrow kiri -->
                <button id="videoScrollLeft" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-footer text-white p-2 rounded-full shadow-md z-10 focus:outline-none sm:block md:hidden">
                    &#9664;
                </button>
                <div id="videoContainer" class="flex overflow-x-auto space-x-4 scrollbar-hide">
                    <?php if (!empty($video) && is_array($video)): ?>
                        <?php foreach ($video as $item): ?>
                            <div class="flex-none bg-white rounded-lg shadow-md my-2">
                                <?php
                                preg_match("/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/", $item['link_video'], $matches);
                                $youtube_id = $matches[1];
                                ?>
                                <iframe class="w-full object-cover rounded-t-lg" height="200" src="https://www.youtube.com/embed/<?= $youtube_id; ?>"
                                    title="<?= esc($item['judul_video']); ?>" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                <div class="p-2">
                                    <h5 class="font-bold text-sm mb-2"><?= word_limiter(esc($item['judul_video']), 6); ?></h5>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada video saat ini</p>
                    <?php endif; ?>
                </div>

                <!-- arrow kanan -->
                <button id="videoScrollRight" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-footer text-white p-2 rounded-full shadow-md z-10 focus:outline-none sm:block md:hidden">
                    &#9654;
                </button>
            </div>
        </div>
    </section>

    <section class="bg-primary">
        <div id="mainContent" class="container mx-auto px-4 py-12">
            <div class="flex flex-col md:flex-row space-y-8 md:space-y-0 md:space-x-8 justify-center">
                <!-- Media Sosial Section (1/3 width) -->
                <div id="bagianmediasosial" class="w-full md:w-1/3 flex flex-col">
                    <div class="bg-white p-6 shadow-lg rounded-lg flex-grow">
                        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-4">Media Sosial</h1>
                        <div class="social-tabs">
                            <!-- Tabs Navigation -->
                            <nav class="flex space-x-4 justify-center mb-4">
                                <button class="flex-1 bg-gray-200 rounded-t-lg font-semibold focus:outline-none"
                                    id="socialTabLink1" data-target="#socialTab1">
                                    <span class="inline-block text-primary">Instagram</span>
                                    <span class="inline-block"><i class="fab fa-instagram"></i></span>
                                </button>
                                <button class="flex-1 py-2 px-4 bg-gray-200 rounded-t-lg font-semibold focus:outline-none"
                                    id="socialTabLink2" data-target="#socialTab2">
                                    <span class="inline-block text-primary">Twitter</span>
                                    <span class="inline-block"><i class="fab fa-twitter"></i></span>
                                </button>
                                <button class="flex-1 py-2 px-4 bg-gray-200 rounded-t-lg font-semibold focus:outline-none"
                                    id="socialTabLink3" data-target="#socialTab3">
                                    <span class="inline-block text-primary">Facebook</span>
                                    <span class="inline-block"><i class="fab fa-facebook"></i></span>
                                </button>
                            </nav>

                            <!-- Tabs Content -->
                            <div class="tab-content">
                                <!-- Instagram Tab -->
                                <div class="tab-pane active show max-h-[580px] overflow-auto flex justify-center items-center" id="socialTab1" role="tabpanel">
                                    <div class="relative max-h-[580px] overflow-hidden w-full">
                                        <iframe class="h-[580px] rounded-lg border border-gray-300"
                                            src="https://www.instagram.com/direktoratkemitraanlingkungan/embed"
                                            width="100%" height="580" frameborder="0" scrolling="no" allowtransparency="true">
                                        </iframe>
                                    </div>
                                </div>

                                <!-- Twitter Tab -->
                                <div class="tab-pane hidden max-h-[580px] overflow-auto flex justify-center items-center" id="socialTab2" role="tabpanel">
                                    <div class="relative max-h-[580px] overflow-auto rounded-lg w-full">
                                        <a class="twitter-timeline" href="https://twitter.com/KementerianLHK?ref_src=twsrc%5Etfw"></a>
                                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                    </div>
                                </div>

                                <!-- Facebook Tab -->
                                <div class="tab-pane hidden max-h-[580px] overflow-auto flex justify-center items-center" id="socialTab3" role="tabpanel">
                                    <div class="relative max-h-[580px] overflow-hidden w-full">
                                        <iframe class="h-[580px] rounded-lg border border-gray-300"
                                            src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FKementerianLHK&tabs=timeline&width=420&height=580&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=52156208006"
                                            width="420" height="580" scrolling="yes" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-8">
                    <!-- Kalender Section -->
                    <div id="bagiankalender" class="flex flex-col">
                        <div class="bg-white p-6 shadow-lg rounded-lg flex-grow">
                            <h1 class="text-3xl font-semibold text-center text-gray-800 mb-4">Kalender</h1>
                            <div class="flex justify-center my-4">
                                <div id="calendar" class="w-full h-[480px] text-sm"></div>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-center">
                                <div class="flex items-center mr-8 ">
                                    <div class="w-4 h-4 bg-blue-600 rounded-full mr-2"></div>
                                    <span class="text-gray-700">Hari Nasional</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-green-600 rounded-full mr-2"></div>
                                    <span class="text-gray-700">Hari Lingkungan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Pengunjung (1 baris, 3 kolom) -->
                    <div id="jumlahPengunjungWrapper" class="overflow-auto">
                        <div id="jumlahPengunjung" class="flex flex-row justify-between space-x-4 flex-nowrap">
                            <div class="bg-white text-primary p-4 rounded-md flex-1 min-w-[250px] lg:mb-0 mb-2">
                                <h1 class="text-sm font-bold">Jumlah Pengunjung Hari Ini</h1>
                                <p class="text-2xl"><?= $visitorCountToday ?></p>
                            </div>

                            <div class="bg-white text-primary p-4 rounded-md flex-1 min-w-[250px] lg:mb-0 mb-2">
                                <h1 class="text-sm font-bold">Jumlah Pengunjung Minggu Ini</h1>
                                <p class="text-2xl"><?= $visitorCountWeekly ?></p>
                            </div>

                            <div class="bg-white text-primary p-4 rounded-md flex-1 min-w-[250px] lg:mb-0 mb-2">
                                <h1 class="text-sm font-bold">Jumlah Pengunjung Bulan Ini</h1>
                                <p class="text-2xl"><?= $visitorCountMonthly ?></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section id="faq">
        <div class="max-w-7xl mx-auto px-6 pt-6 pb-14">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- FAQ Section (left side) -->
                <div class="space-y-6">
                    <h1 id="textfaq" class="text-2xl font-medium text-center mb-2">Pertanyaan <b>Umum</b></h1>
                    <hr class="hrcenter border-2 border-primary w-32 mx-auto mt-0" />
                    <p class="text-center text-gray-600 mt-2">Temukan jawaban atas pertanyaan Anda seputar Penghargaan Kalpataru dan pelestarian lingkungan</p>

                    <div class="mt-8 space-y-4">
                        <!-- Question 1 -->
                        <div class="border rounded-lg p-4 shadow-md bg-white" id="card-1">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswer(1)">
                                <p class="font-semibold">Kapan batas waktu penyerahan dokumen usulan?</p>
                                <button class="text-gray-600" id="button-1">
                                    <div class="flex items-center justify-center w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path id="icon-1" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <p id="answer-1" class="text-gray-600 mt-2 hidden">Batas waktu penyerahan dokumen adalah tanggal 20 Februari 2024 dan diunggah secara daring</p>
                        </div>

                        <div class="border rounded-lg p-4 shadow-md bg-white" id="card-2">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswer(2)">
                                <p class="font-semibold">Dimanakah pengusul dapat mengakses contoh dokumen pengusulan dan tata cara pengisian formulir?</p>
                                <button class="text-gray-600" id="button-2">
                                    <div class="flex items-center justify-center w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path id="icon-2" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <p id="answer-2" class="text-gray-600 mt-2 hidden">Format dokumen, contoh, dan tata cara pengisian formulir dapat diakses melalui tautan: <b>bit.ly/kalpataru2024</b></p>
                        </div>
                        <div class="border rounded-lg p-4 shadow-md bg-white" id="card-3">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswer(3)">
                                <p class="font-semibold">Apakah calon yang pernah diusulkan dapat mengusulkan kembali?</p>
                                <button class="text-gray-600" id="button-3">
                                    <div class="flex items-center justify-center w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path id="icon-3" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <p id="answer-3" class="text-gray-600 mt-2 hidden">Calon yang pernah diusulkan dan belum pernah meraih Penghargaan Kalpataru boleh untuk diusulkan kembali</p>
                        </div>
                        <div class="border rounded-lg p-4 shadow-md bg-white" id="card-4">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswer(4)">
                                <p class="font-semibold">Mengapa disyaratkan kegiatan telah berlangsung minimal selama 5 tahun?</p>
                                <button class="text-gray-600" id="button-4">
                                    <div class="flex items-center justify-center w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path id="icon-4" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <p id="answer-4" class="text-gray-600 mt-2 hidden">Acuan 5 tahun digunakan untuk melihat dampak, indikator keberhasilan, dan keberlanjutan kegiatan yang dilakukan calon</p>
                        </div>
                        <div class="border rounded-lg p-4 shadow-md bg-white" id="card-5">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswer(5)">
                                <p class="font-semibold">Bagaimana jika kelompok belum memiliki Akta Notaris (legalitas), namun telah lama melakukan kegiatan pelestarian lingkungan?</p>
                                <button class="text-gray-600" id="button-5">
                                    <div class="flex items-center justify-center w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path id="icon-5" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <p id="answer-5" class="text-gray-600 mt-2 hidden">Bukti pembentukkan kelompok harus ada, jika tidak memungkinkan membuat akta notaris, bisa membuat surat keterangan pembentukkan kelompok dari desa. <br /> Yang menjadi acuan adalah sejak kapan melakukan kegiatan, dengan melampirkan bukti dukung berupa dokumentasi kegiatan.</p>
                        </div>
                        <div class="border rounded-lg p-4 shadow-md bg-white" id="card-6">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswer(6)">
                                <p class="font-semibold">Apakah satker di luar Dinas LHK dapat mengirimkan usulan penerima Kalpataru secara langsung ke Sekretariat Kalpataru Nasional?</p>
                                <button class="text-gray-600" id="button-6">
                                    <div class="flex items-center justify-center w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path id="icon-6" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <p id="answer-6" class="text-gray-600 mt-2 hidden">Pengusul dapat mengirimkan surat pengusulan langsung melalui email Sekretariat Kalpataru, dengan mencantumkan tembusan kepada DLHK Provinsi masing-masing, sebagai bentuk koordinasi.</p>
                        </div>
                        <div class="border rounded-lg p-4 shadow-md bg-white" id="card-7">
                            <div class="flex justify-between items-center cursor-pointer" onclick="toggleAnswer(7)">
                                <p class="font-semibold">Bagaimana melampirkan dokumentasi video jika kapasitasnya besar?</p>
                                <button class="text-gray-600" id="button-7">
                                    <div class="flex items-center justify-center w-8 h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path id="icon-7" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <p id="answer-7" class="text-gray-600 mt-2 hidden">Video kegiatan calon diunggah dalam bentuk link Google Drive atau link media sosial</p>
                        </div>

                    </div>

                </div>

                <!-- Disqus Section (right side) -->
                <div class="w-full border border-gray-300 rounded-lg shadow-lg p-4 bg-white">
                    <div class="relative">
                        <!-- Make sure the Disqus iframe is inside a div with set height -->
                        <div class="relative max-h-[580px] overflow-auto rounded-lg w-full">
                            <div id="disqus_thread"></div>
                        </div>

                        <script>
                            (function() {
                                var d = document,
                                    s = d.createElement('script');
                                s.src = 'https://kalpataru.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>

                        <noscript>
                            Please enable JavaScript to view the
                            <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
                        </noscript>
                    </div>
                    <script id="dsq-count-scr" src="//kalpataru.disqus.com/count.js" async></script>
                </div>
            </div>
        </div>
    </section>

    <!-- Popup Modal Calendar -->
    <div id="popupModalCalendar" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-10">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
            <h2 id="modalTitle" class="text-2xl font-bold mb-4"></h2>
            <p id="modalDescription" class="text-gray-700"></p>
            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-primary text-white rounded hover:bg-primaryhover">tutup</button>
        </div>
    </div>

    <script defer>
        // popup
        document.addEventListener('DOMContentLoaded', function() {
            // Set delay for 2 seconds (2000 milliseconds)
            setTimeout(function() {
                document.getElementById('popup').classList.remove('hidden');
            }, 2000); // 2 seconds delay

            // Close popup on clicking X button
            document.getElementById('close-btn').addEventListener('click', function() {
                document.getElementById('popup').classList.add('hidden');
            });
        });
    </script>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map', {
                center: [-1.062209, 113.885034],
                zoom: 5,
                minZoom: 4,
                maxZoom: 14,
                maxBounds: [
                    [-37.972342, 29.516035],
                    [32.873401, 178.643460]
                ]
            });

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_nolabels/{z}/{x}/{y}{r}.png', {
                attribution: ''
            }).addTo(map);

            var penerimaData = <?= json_encode($peta); ?>;

            var geojsonUrls = {
                'DKI Jakarta': 'https://kalpatarujson.vercel.app/json/dkijakarta.json',
                'Jawa Barat': 'https://kalpatarujson.vercel.app/json/jawabarat.json',
                'Jawa Tengah': 'https://kalpatarujson.vercel.app/json/jawatengah.json',
                'Jawa Timur': 'https://kalpatarujson.vercel.app/json/jawatimur.json',
                'Banten': 'https://kalpatarujson.vercel.app/json/banten.json',
                'DI Yogyakarta': 'https://kalpatarujson.vercel.app/json/diy.json',
                'Bali': 'https://kalpatarujson.vercel.app/json/bali.json',
                'Aceh': 'https://kalpatarujson.vercel.app/json/aceh.json',
                'Papua Barat Daya': 'https://kalpatarujson.vercel.app/json/papuabaratdaya.json',
                'Papua Barat': 'https://kalpatarujson.vercel.app/json/papuabarat.json',
                'Papua Tengah': 'https://kalpatarujson.vercel.app/json/papuatengah.json',
                'Papua Selatan': 'https://kalpatarujson.vercel.app/json/papuaselatan.json',
                'Papua Pegunungan': 'https://kalpatarujson.vercel.app/json/papuapegunungan.json',
                'Papua': 'https://kalpatarujson.vercel.app/json/papua.json',
                'Maluku Utara': 'https://kalpatarujson.vercel.app/json/malukuutara.json',
                'Maluku': 'https://kalpatarujson.vercel.app/json/maluku.json',
                'Sulawesi Barat': 'https://kalpatarujson.vercel.app/json/sulawesibarat.json',
                'Gorontalo': 'https://kalpatarujson.vercel.app/json/gorontalo.json',
                'Sulawesi Tenggara': 'https://kalpatarujson.vercel.app/json/sulawesitenggara.json',
                'Sulawesi Selatan': 'https://kalpatarujson.vercel.app/json/sulawesiselatan.json',
                'Sulawesi Tengah': 'https://kalpatarujson.vercel.app/json/sulawesitengah.json',
                'Sulawesi Utara': 'https://kalpatarujson.vercel.app/json/sulawesiutara.json',
                'Kalimantan Utara': 'https://kalpatarujson.vercel.app/json/kalimantanutara.json',
                'Kalimantan Timur': 'https://kalpatarujson.vercel.app/json/kalimantantimur.json',
                'Kalimantan Selatan': 'https://kalpatarujson.vercel.app/json/kalimantanselatan.json',
                'Kalimantan Tengah': 'https://kalpatarujson.vercel.app/json/kalimantantengah.json',
                'Kalimantan Barat': 'https://kalpatarujson.vercel.app/json/kalimantanbarat.json',
                'Nusa Tenggara Timur': 'https://kalpatarujson.vercel.app/json/nusatenggaratimur.json',
                'Nusa Tenggara Barat': 'https://kalpatarujson.vercel.app/json/nusatenggarabarat.json',
                'Kepulauan Riau': 'https://kalpatarujson.vercel.app/json/kepulauanriau.json',
                'Kepulauan Bangka Belitung': 'https://kalpatarujson.vercel.app/json/kepulauanbangkabelitung.json',
                'Lampung': 'https://kalpatarujson.vercel.app/json/lampung.json',
                'Bengkulu': 'https://kalpatarujson.vercel.app/json/bengkulu.json',
                'Sumatera Selatan': 'https://kalpatarujson.vercel.app/json/sumateraselatan.json',
                'Sumatera Barat': 'https://kalpatarujson.vercel.app/json/sumaterabarat.json',
                'Sumatera Utara': 'https://kalpatarujson.vercel.app/json/sumaterautara.json',
                'Jambi': 'https://kalpatarujson.vercel.app/json/jambi.json',
                'Riau': 'https://kalpatarujson.vercel.app/json/riau.json',
            };

            var colorRanges = [{
                    min: 1,
                    max: 10,
                    color: '#5EFFD7'
                },
                {
                    min: 11,
                    max: 20,
                    color: '#52D5B4'
                },
                {
                    min: 21,
                    max: 30,
                    color: '#43B095'
                },
                {
                    min: 31,
                    max: 40,
                    color: '#348C76'
                },
                {
                    min: 41,
                    max: Infinity,
                    color: '#2B6556'
                }
            ];

            function getColorByTotal(total) {
                for (var i = 0; i < colorRanges.length; i++) {
                    if (total >= colorRanges[i].min && total <= colorRanges[i].max) {
                        return colorRanges[i].color;
                    }
                }
                return '#D3D3D3';
            }

            for (let provinsi in geojsonUrls) {
                fetch(geojsonUrls[provinsi])
                    .then(response => response.json())
                    .then(data => {
                        var penerimaDiProvinsi = penerimaData.find(function(penerima) {
                            return penerima.provinsi === provinsi;
                        });

                        var geojsonLayer = L.geoJSON(data, {
                            style: function() {
                                var fillColor = penerimaDiProvinsi && penerimaDiProvinsi.total > 0 ?
                                    getColorByTotal(penerimaDiProvinsi.total) :
                                    'none';
                                return {
                                    color: 'none',
                                    fillColor: fillColor,
                                    fillOpacity: 1,
                                    weight: 0
                                };
                            },
                            onEachFeature: function(feature, layer) {
                                var center = layer.getBounds().getCenter();
                                var label = L.marker(center, {
                                    icon: L.divIcon({
                                        className: 'province-label',
                                        html: '<div style="font-weight: bold; cursor: pointer;">' + provinsi + '</div>',
                                        iconSize: [100, 40],
                                        iconAnchor: [50, 20]
                                    })
                                }).addTo(map);

                                var popupContent = '<div style="font-family: Arial, sans-serif; text-align: center;">' +
                                    '<strong style="font-size: 16px; color: #333;">' + provinsi + '</strong>';
                                if (penerimaDiProvinsi && penerimaDiProvinsi.total > 0) {
                                    popupContent += '<br><span style="font-size: 14px; color: #555;">Jumlah Penerima: </span>' +
                                        '<span style="font-size: 14px; font-weight: bold; color: #000;">' + penerimaDiProvinsi.total + '</span>';
                                    popupContent += '<br><br><a href="/informasi/penerima/' + encodeURIComponent(provinsi) + '" style="font-size: 14px; color: #2C7865; text-decoration: underline; cursor: pointer;">Lihat Arsip</a>';
                                } else {
                                    popupContent += '<br><span style="font-size: 14px; color: #555;">Tidak ada penerima</span>';
                                }
                                popupContent += '</div>';

                                label.on('click', function() {
                                    var popup = L.popup()
                                        .setLatLng(center)
                                        .setContent(popupContent)
                                        .openOn(map);
                                });
                            }
                        }).addTo(map);
                    })
                    .catch(error => console.error('Error loading GeoJSON for ' + provinsi + ':', error));
            }

            var legend = L.control({
                position: 'bottomright'
            });

            legend.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'info legend');
                var labels = ['<strong>Keterangan</strong>'];
                var colors = colorRanges.map(range => range.color);

                for (var i = 0; i < colors.length; i++) {
                    var rangeText = (colorRanges[i].max === Infinity) ? '≥ ' + colorRanges[i].min : colorRanges[i].min + '-' + colorRanges[i].max;
                    labels.push(
                        '<i style="background:' + colors[i] + '"></i> ' + rangeText + ' Penerima'
                    );
                }

                div.innerHTML = labels.join('<br>');
                return div;
            };

            legend.addTo(map);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/id.js'></script>

    <script>
        /* KUMPULAN ANIMASI (BATAS AWAL) */
        gsap.registerPlugin(ScrollTrigger);

        gsap.from("#texttentangkalpataru", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#texttentangkalpataru",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.from("#textkategoripenghargaan", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#textkategoripenghargaan",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.from("#textstatistikpenyebaran", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#textstatistikpenyebaran",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.from("#texttujuankalpataru", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#texttujuankalpataru",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.from("#textpencapaian", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#textpencapaian",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.from("#textberita", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#textberita",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.from("#textvideo", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#textvideo",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.from("#textfaq", {
            opacity: 0,
            y: -50,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
                trigger: "#textfaq",
                start: "top 90%",
                toggleActions: "play none none reverse"
            }
        });

        gsap.utils.toArray(".hrcenter").forEach((hr) => {
            gsap.from(hr, {
                opacity: 0,
                scaleX: 0,
                duration: 1,
                delay: 0.3,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: hr,
                    start: "top 90%",
                    toggleActions: "play none none reverse"
                }
            });
        });

        gsap.utils.toArray(".hrleft").forEach((hr) => {
            gsap.from(hr, {
                opacity: 0,
                x: -100,
                duration: 1,
                delay: 0.5,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: hr,
                    start: "top 90%",
                    toggleActions: "play none none reverse"
                }
            });
        });

        gsap.utils.toArray("#categoryContainer a").forEach((image) => {
            gsap.from(image, {
                opacity: 0,
                scale: 0.8,
                rotate: 10,
                duration: 1.2,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: image,
                    start: "top 90%",
                    toggleActions: "play none none reverse"
                }
            });
        });

        document.querySelectorAll("#categoryContainer a img").forEach((img) => {
            img.addEventListener("mouseenter", () => {
                gsap.to(img, {
                    filter: "brightness(1.2)",
                    boxShadow: "0px 10px 20px rgba(0, 150, 136, 0.3)",
                    duration: 0.3,
                    ease: "power2.out"
                });
            });

            img.addEventListener("mouseleave", () => {
                gsap.to(img, {
                    filter: "brightness(1)",
                    boxShadow: "0px 5px 10px rgba(0, 0, 0, 0.15)",
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        });

        function addHoverEffect(cardId) {
            const card = document.getElementById(cardId);

            card.addEventListener("mouseenter", () => {
                gsap.to(card, {
                    scale: 1.05,
                    boxShadow: "0px 4px 20px rgba(255, 255, 255, 0.6)",
                    duration: 0.4,
                    ease: "power2.out"
                });
            });

            card.addEventListener("mouseleave", () => {
                gsap.to(card, {
                    scale: 1,
                    boxShadow: "0px 0px 0px rgba(0, 0, 0, 0)",
                    duration: 0.4,
                    ease: "power2.out"
                });
            });
        }

        /* KUMPULAN ANIMASI (BATAS AKHIR) */

        /* Hero Section Carousel */
        let currentIndex = 0;
        const totalSlides = 3;

        function moveSlide(direction) {
            currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
            moveCarousel(currentIndex * -100);
        }

        function moveCarousel(translateValue) {
            document.querySelector('.carousel-wrapper').style.transform = `translateX(${translateValue}%)`;
        }

        // Deteksi Gesture Swipe
        let startX = 0;

        document.querySelector('.carousel-wrapper').addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        document.querySelector('.carousel-wrapper').addEventListener('touchend', (e) => {
            const endX = e.changedTouches[0].clientX;
            const diffX = endX - startX;

            // Geser ke kanan jika swipe ke kiri
            if (diffX < -50) {
                moveSlide(1);
            }
            // Geser ke kiri jika swipe ke kanan
            else if (diffX > 50) {
                moveSlide(-1);
            }
        });

        //  scroll kategori
        const categoryContainer = document.getElementById('categoryContainer');
        const categoryScrollLeft = document.getElementById('categoryScrollLeft');
        const categoryScrollRight = document.getElementById('categoryScrollRight');

        categoryScrollLeft.addEventListener('click', () => {
            categoryContainer.scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });

        categoryScrollRight.addEventListener('click', () => {
            categoryContainer.scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });

        // scroll berita
        const cardContainer = document.getElementById('beritaContainer');
        const beritaScrollLeft = document.getElementById('beritaScrollLeft');
        const beritaScrollRight = document.getElementById('beritaScrollRight');

        beritaScrollLeft.addEventListener('click', () => {
            cardContainer.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        });

        beritaScrollRight.addEventListener('click', () => {
            cardContainer.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        });


        /* CARD DATA DAN STATISTIK */
        // CARD 2
        const progressDataCard2 = [{
                id: 'card2progress1',
                value: <?= $temaData->total_hukum; ?>
            },
            {
                id: 'card2progress2',
                value: <?= $temaData->total_kahati; ?>
            },
            {
                id: 'card2progress3',
                value: <?= $temaData->total_kerusakan_lingkungan; ?>
            },
            {
                id: 'card2progress4',
                value: <?= $temaData->total_iklim; ?>
            },
        ];

        // Update progress bars based on data
        const totalMax = progressDataCard2.reduce((sum, item) => sum + item.value, 0);

        function updateProgressBars(data, max) {
            data.forEach(item => {
                const progressBar = document.getElementById(item.id);
                if (progressBar) {
                    const percentage = (item.value / max) * 100;
                    progressBar.style.width = `${percentage}%`;
                }
            });
        }

        // Panggil fungsi dengan totalMax sebagai max
        updateProgressBars(progressDataCard2, totalMax);

        // CARD 3
        const progressDataCard3 = [{
                id: 'card3progress1',
                value: <?= $kategoriData->total_perintis; ?>
            },
            {
                id: 'card3progress2',
                value: <?= $kategoriData->total_pengabdi; ?>
            },
            {
                id: 'card3progress3',
                value: <?= $kategoriData->total_penyelamat; ?>
            },
            {
                id: 'card3progress4',
                value: <?= $kategoriData->total_pembina; ?>
            },
        ];

        // Update progress bars based on data
        const totalMaxKategori = progressDataCard3.reduce((sum, item) => sum + item.value, 0);

        function updateProgressBars(data, max) {
            data.forEach(item => {
                const progressBar = document.getElementById(item.id);
                if (progressBar) {
                    const percentage = (item.value / max) * 100;
                    progressBar.style.width = `${percentage}%`;
                }
            });
        }

        // Panggil fungsi dengan totalMax sebagai max
        updateProgressBars(progressDataCard3, totalMaxKategori);

        // CARD 4
        const ctx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Laki-Laki', 'Perempuan'],
                datasets: [{
                    label: 'Jumlah',
                    data: [<?= $totalLakiLaki; ?>, <?= $totalPerempuan; ?>],
                    backgroundColor: ['#71C7FF', '#FF71AD'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Hide default legend
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });


        // Zoom level to track the current scale of the image
        let zoomLevel = 1;
        let isDragging = false;
        let startXX, startY, offsetX = 0,
            offsetY = 0;

        function zoomIn() {
            zoomLevel += 0.2;
            applyTransform();
        }

        function zoomOut() {
            zoomLevel = Math.max(1, zoomLevel - 0.2); // Ensure zoom level does not go below 1
            applyTransform();
        }

        function resetZoom() {
            zoomLevel = 1;
            offsetX = 0;
            offsetY = 0;
            applyTransform();
        }

        // scroll video
        const videoContainer = document.getElementById('videoContainer');
        const videoScrollLeft = document.getElementById('videoScrollLeft');
        const videoScrollRight = document.getElementById('videoScrollRight');

        videoScrollLeft.addEventListener('click', () => {
            videoContainer.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        });

        videoScrollRight.addEventListener('click', () => {
            videoContainer.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        });

        // media sosial
        document.querySelectorAll("button[data-target]").forEach(button => {
            button.addEventListener('click', () => {
                // Get the target tab pane
                const target = button.getAttribute("data-target");

                // Hide all tab panes
                document.querySelectorAll(".tab-pane").forEach(tabPane => tabPane.classList.add("hidden"));

                // Remove active class from all tab buttons
                document.querySelectorAll("button[data-target]").forEach(btn => btn.classList.remove("bg-blue-600", "text-white"));

                // Show the selected tab pane and add active class to the selected tab button
                document.querySelector(target).classList.remove("hidden");
                button.classList.add("bg-blue-600", "text-white");
            });
        });
        // calendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                buttonText: {
                    today: 'Hari Ini'
                },
                events: '<?= base_url('calendar/events') ?>',
                eventDidMount: function(info) {
                    info.el.style.cursor = 'pointer';

                    // Membuat elemen tooltip untuk menampilkan title saja
                    var tooltip = document.createElement('div');
                    tooltip.innerText = info.event.title;
                    tooltip.className = 'bg-slate-400 text-white text-sm p-2 rounded-lg shadow-lg transition-opacity duration-200 opacity-0';
                    tooltip.style.position = 'absolute';
                    tooltip.style.zIndex = '10';
                    tooltip.style.display = 'none';

                    // Tambahkan tooltip ke body
                    document.body.appendChild(tooltip);

                    // Event untuk menampilkan tooltip saat mouse hover
                    info.el.addEventListener('mouseenter', function() {
                        tooltip.style.display = 'block';
                        tooltip.style.opacity = '1'; // Set opacity to 1 for fade-in effect
                        var rect = info.el.getBoundingClientRect();
                        tooltip.style.top = rect.top + window.scrollY - tooltip.offsetHeight - 8 + 'px';
                        tooltip.style.left = rect.left + window.scrollX + (rect.width - tooltip.offsetWidth) / 2 + 'px';
                    });

                    // Event untuk menyembunyikan tooltip saat mouse keluar
                    info.el.addEventListener('mouseleave', function() {
                        tooltip.style.opacity = '0'; // Fade out effect
                        setTimeout(() => {
                            tooltip.style.display = 'none';
                        }, 200); // Durasi animasi fade-out
                    });

                    // Event untuk membuka modal saat title diklik
                    info.el.addEventListener('click', function() {
                        openModal(info.event.title, info.event.extendedProps.description);
                    });
                }
            });
            calendar.render();
        });

        // Fungsi untuk membuka modal dengan title dan description
        function openModal(title, description) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('popupModalCalendar').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('popupModalCalendar').classList.add('hidden');
        }

        // faq
        function toggleAnswer(index) {
            const answer = document.getElementById(`answer-${index}`);
            const icon = document.getElementById(`icon-${index}`);
            const button = document.getElementById(`button-${index}`);
            const card = document.getElementById(`card-${index}`);

            answer.classList.toggle('hidden');

            if (answer.classList.contains('hidden')) {
                button.classList.remove('text-primary');
                button.classList.add('text-gray-600');
                icon.setAttribute('d', 'M9 5l7 7-7 7');
                icon.classList.remove('text-white');
                button.querySelector('.flex').classList.remove('bg-primary', 'rounded-full');
                card.classList.remove('border-primary');
            } else {
                button.classList.remove('text-gray-600');
                button.classList.add('text-primary');
                icon.setAttribute('d', 'M19 9l-7 7-7-7');
                icon.classList.add('text-white');
                button.querySelector('.flex').classList.add('bg-primary', 'rounded-full');
                card.classList.add('border-primary');
            }
        }
    </script>

    <?= $this->endSection() ?>
</body>

</html>