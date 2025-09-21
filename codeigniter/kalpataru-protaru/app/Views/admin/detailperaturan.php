<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <title><?= $title; ?></title>
</head>

<body class="lg:flex">

    <!-- Sidebar -->
    <div class="w-64 bg-white text-white">
        <?= $this->include('template/sidebaradmin') ?>
    </div>

    <div class="lg:flex-1 p-4 sm:p-6"> <!-- Menambah padding lebih kecil di HP -->
        <div class="min-h-screen flex flex-col">

            <header class="bg-white shadow">
                <div class="container mx-auto flex flex-col md:flex-row items-center justify-between p-4 md:p-6"> <!-- Flex kolom saat di layar kecil -->
                    <h1 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-700">Detail Peraturan / Kebijakan</h1>
                    <div class="flex items-center mt-2 md:mt-0"> <!-- Margin atas di layar kecil -->
                        <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
                        <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
                    </div>
                </div>
            </header>

            <div class="mt-4 relative flex flex-col w-full mx-auto mb-4 border-2 border-primary bg-white shadow-md p-4 sm:p-6 lg:p-8"> <!-- Padding disesuaikan -->
                <div class="mt-4 mb-2 w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> <!-- Kolom jadi 1 pada layar kecil, 2 pada layar lebih besar -->

                        <!-- Kolom kiri -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">Judul</label>
                                <p class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2">
                                    <?= esc($peraturan['judul']); ?>
                                </p>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Tentang</label>
                                <p class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2">
                                    <?= esc($peraturan['tentang']); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">Jenis</label>
                                <p class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2">
                                    <?= esc($peraturan['jenis']); ?>
                                </p>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Dokumen</label>
                                <button onclick="window.location.href='<?= base_url($peraturan['file']); ?>';"
                                    class="w-full rounded-md py-2 px-2 text-center font-semibold text-xs text-primary bg-secondary hover:shadow-md flex items-center justify-center gap-4" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                    Unduh Dokumen Peraturan / Kebijakan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between mt-8 gap-4">
                        <button onclick="window.history.back()"
                            class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
                            <span class="font-bold text-lg items-center">←</span> Kembali
                        </button>
                        <a href="/admin/peraturan-kebijakan/edit/<?= esc($peraturan['id_peraturan']); ?>">
                            <div class="mt-4">
                                <button id="editperaturan" class="w-full md:w-48 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                                    <i class="fas fa-edit"></i> Edit Peraturan
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>