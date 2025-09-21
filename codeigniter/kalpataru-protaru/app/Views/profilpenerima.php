<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <?= $this->extend('template/navbarfooter') ?>

    <?= $this->section('content') ?>

    <div class="flex items-center justify-center w-full"> <!-- Ensure the container takes full width -->
        <div class="max-w-5xl w-full mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Gambar -->
                <div class="flex justify-center w-full lg:w-1/2 mb-4 lg:mb-0">
                    <div class="w-full bg-gray-100 rounded-md flex items-center justify-center aspect-w-1 aspect-h-1">
                        <!-- Placeholder jika gambar tidak ada -->
                        <?php if (!empty($arsip['foto_profil'])): ?>
                            <img src="<?= base_url('images/penerima/' . $arsip['foto_profil']) ?>"
                                alt="<?= esc($arsip['nama']) ?>"
                                class="object-cover w-full h-full">
                        <?php else: ?>
                            <p class="text-gray-400 text-center text-sm flex items-center justify-center">
                                Gambar tidak tersedia
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
    
                <form id="profil-pengusulForm" class="w-full lg:w-1/2 mb-2 lg:ml-8">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="space-y-4">
                            <div class="w-full mb-4">
                                <div class="w-full text-slate-800 text-xl font-bold border-slate-200 rounded-md px-3 py-2">
                                    <?= esc($arsip['nama']) ?>
                                </div>
                            </div>
                            <div class="w-full mb-4">
                                <input readonly type="text"
                                    value="Penerima Penghargaan Kalpataru Tahun <?= esc(substr($arsip['tahun_penerimaan'], 0, 4)) ?>"
                                    class="w-full bg-transparent placeholder:text-slate-800 text-slate-800 text-xl border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none" />
                            </div>
                            <div class="w-full mb-4">
                                <input readonly type="text" value="<?= esc($arsip['kategori']) ?>"
                                    class="w-full bg-transparent placeholder:text-slate-800 text-slate-800 text-xl border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none" />
                            </div>
                            <div class="w-full mb-4">
                                <input readonly type="text" value="<?= esc($arsip['provinsi']) ?>"
                                    class="w-full bg-transparent placeholder:text-slate-800 text-slate-800 text-xl border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none" />
                            </div>
    
                            <blockquote class="border-l-4 border-primary pl-4 italic text-black text-2xl">
                                " <?= esc($arsip['slogan']) ?>"
                            </blockquote>
                        </div>
                    </div>
                </form>
            </div>
    
            <!-- Profil -->
            <div class="flex flex-col items-center mt-4 text-justify">
                <div class="w-full max-w-3xl"> <!-- Batasan lebar pada konten profil -->
                    <h3><?= nl2br(htmlspecialchars($arsip['profil'])); ?></h3>
                </div>
            </div>
    
            <!-- Tombol Kembali -->
            <button onclick="window.history.back()"
                class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
                <span class="font-bold text-lg items-center">←</span> Kembali
            </button>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>