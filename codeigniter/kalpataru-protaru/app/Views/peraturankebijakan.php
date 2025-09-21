<!DOCTYPE html>
<html lang="en">

<title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    </head>

    <body>
        <?= $this->extend('template/navbarfooter') ?>

        <?= $this->section('content') ?>
        <section id="peraturankebijakan" class="w-full h-[25rem] relative">
            <img src="/images/hero.png" alt="peraturankebijakan" class="w-full h-full object-cover object-center md:object-center">

            <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold">Peraturan & Kebijakan</h1>
                <p class="text-sm sm:text-base md:text-lg mt-2 sm:mt-4">Peraturan & Kebijakan tentang Kalpataru</p>
            </div>
        </section>

        <section id="pengumumancontent">
            <div class="container mx-auto max-w-screen-lg">
                <!-- Search Bar -->
                <div class="flex justify-between items-center my-6">
                    <h1 class="text-xs:lg:text-md ml-4 lg:ml-0 font-semibold">
                        Hasil: <?= esc($countTerbit) ?> Peraturan dan Kebijakan
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

                <div class="lg:w-full w-64 mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
                        <?php if (!empty($peraturans) && is_array($peraturans)): ?>
                            <?php foreach ($peraturans as $item): ?>
                                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                    <div class="p-4">
                                        <p class="text-xs font-normal text-gray-600 truncate mb-2"><?= esc($item['tentang']); ?></p>
                                        <h2 class="text-xs font-semibold truncate"><?= esc($item['judul']); ?></h2>
                                        <p class="text-xs font-semibold text-accent2 truncate mt-2">
                                            <?= esc($item['jenis']); ?>
                                        </p>
                                    </div>
                                    <div class="p-4 text-start text-xs">
                                        <a href="<?= base_url($item['file']); ?>" class="bg-primary text-white py-2 px-2 rounded hover:bg-primaryhover" download>
                                            Unduh
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Tidak ada Peraturan & Kebijakan saat ini</p>
                        <?php endif; ?>
                    </div>
                    <div class="row flex lg:justify-end justify-center my-6">
                        <div class="pagination">
                            <?php if ($pager): ?>
                                <?= $pager->only(['search'])->links('peraturans', 'template_pagination') ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        </section>

        <?= $this->endSection() ?>
    </body>

</html>