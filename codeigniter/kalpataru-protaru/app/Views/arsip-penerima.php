<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?= $this->extend('template/navbarfooter') ?>
    <?= $this->section('content'); ?>

    <section id="dataPenerima" class="w-full h-[25rem] relative">
        <img src="/images/hero.png" alt="Arsip Penerima Penghargaan Kalpataru Kategori Perintis Lingkungan" class="w-full h-full object-cover object-center md:object-center">

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Arsip Penerima Penghargaan Kalpataru</h1>
            <p class="text-sm sm:text-base md:text-lg mt-2 sm:mt-4">Berikut adalah daftar penerima Penghagaan Kalpataru dari tahun 1980 hingga sekarang</p>
        </div>
    </section>

    <section id="beritacontent">
        <div class="container mx-auto max-w-screen-lg">
            <div class="flex flex-col lg:flex-row justify-end items-center my-6 space-y-4 lg:space-y-0">
                <div class="relative mr-4 lg:mr-0">
                    <form method="get">
                        <input
                            placeholder="Masukan kata kunci"
                            class="input shadow-lg focus:border-2 border-2 border-primary px-5 py-3 rounded-xl w-full sm:w-56 lg:w-56 transition-all focus:w-64 outline-none"
                            name="search" />
                        <svg
                            class="size-6 absolute top-3 right-3 text-primary"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                stroke-linejoin="round"
                                stroke-linecap="round"></path>
                        </svg>
                    </form>
                </div>
            </div>


            <!-- Cards Section -->
            <div class="grid gap-4 px-4 lg:px-0">
                <?php if (!empty($dataPenerima) && is_array($dataPenerima)): ?>
                    <?php foreach ($dataPenerima as $arsip): ?>
                        <div class="container mx-auto bg-white rounded-lg shadow-md flex flex-col lg:flex-row overflow-hidden">
                            <img src="<?= base_url('images/penerima/' . $arsip['foto_profil']) ?>"
                                alt="<?= esc($arsip['nama']) ?>"
                                class="w-full lg:w-56 h-56 md:h-auto object-cover rounded-lg lg:mr-6 mx-auto lg:mx-0">
                            <div class="p-4 text-center lg:text-left">
                                <h3 class="text-xl font-medium mb-2"><?= esc($arsip['nama']) ?></h3>
                                <hr class="border-2 border-primary w-40 mt-1 mb-4 mx-auto lg:mx-0">
                                <p>Provinsi: <b><?= esc($arsip['provinsi']) ?></b></p>
                                <p>Kategori: <b><?= esc($arsip['kategori']) ?></b></p>
                                <p>Tahun: <b><?= esc($arsip['tahun_penerimaan']) ?></b></p>
                                <p class="text-sm leading-relaxed text-justify mt-4 mb-4">
                                    <?= word_limiter(esc($arsip['profil']), 60); ?>
                                </p>
                                <a href="<?= base_url('informasi/profil-penerima/' . $arsip['id_arsip_penerima']); ?>">
                                    <button class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primaryhover">
                                        Selengkapnya
                                    </button>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada arsip yang ditemukan</p>
                <?php endif; ?>
            </div>
            <div class="row flex lg:justify-end justify-center my-6">
                <div class="pagination">
                    <?php if ($pager): ?>
                        <?= $pager->only(['search'])->links('arsip', 'template_pagination') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?= $this->endSection() ?>
</body>

</html>