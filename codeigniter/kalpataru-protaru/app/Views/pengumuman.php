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
    <section id="pengumuman" class="w-full h-[25rem] relative">
        <img src="/images/hero.png" alt="pengumuman" class="w-full h-full object-cover object-center md:object-center">

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Pengumuman</h1>
            <p class="text-sm sm:text-base md:text-lg mt-2 sm:mt-4">Dapatkan informasi penting terkait pendaftaran dan partisipasi Penghargaan Kalpataru</p>
        </div>
    </section>

    <section id="pengumumancontent">
        <div class="container mx-auto max-w-screen-lg">
            <!-- Search Bar -->
            <div class="flex justify-between items-center my-6">
                <h1 class="text-xs:lg:text-md ml-4 lg:ml-0 font-semibold">
                    Hasil: <?= esc($countTerbit) ?> Pengumuman
                </h1>
                <div class="relative mr-4 lg:mr-0">
                    <form method="get">
                        <input
                            placeholder="Masukan kata kunci"
                            class="input shadow-lg focus:border-2 border-2 border-primary 0 px-5 py-3 rounded-xl w-56 transition-all focus:w-64 outline-none"
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
                <?php if (!empty($pengumumans) && is_array($pengumumans)): ?>
                    <?php foreach ($pengumumans as $item): ?>
                        <div class="bg-white rounded-lg shadow-md flex flex-col md:flex-row overflow-hidden">
                            <img src="/public/<?= esc($item['foto']); ?>" alt="<?= esc($item['judul']); ?>" class="w-full md:w-48 h-32 md:h-auto object-cover">
                            <div class="p-4">
                                <h2 class="text-lg md:text-xl font-semibold mb-2"><?= esc($item['judul']) ?></h2>
                                <p class="text-gray-600 text-sm md:text-base mb-4"><?= word_limiter(esc($item['konten']), 30); ?></p>
                                <a href="/pengumuman/<?= esc($item['slug']); ?>" class="text-black font-medium flex justify-end items-center">
                                    Baca Selengkapnya
                                    <img src="/images/arrowkanan.svg" alt="arrowkanan" class="w-6 h-6 md:w-8 md:h-8 ml-2">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada pengumuman saat ini</p>
                <?php endif; ?>
            </div>
            <div class="row flex lg:justify-end justify-center my-6">
                <div class="pagination">
                    <?php if ($pager): ?>
                        <?= $pager->only(['search'])->links('pengumumans', 'template_pagination') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?= $this->endSection() ?>
</body>

</html>