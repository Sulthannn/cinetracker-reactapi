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

    <div class="flex flex-col lg:flex-row justify-center m-4">
        <?= $this->include('template/sidebarpengusul') ?>

        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <h4 class="block text-xl font-bold text-slate-800 mb-2">
                Usulan: Provinsi <?= session()->get('provinsi'); ?>
            </h4>

            <div class="lg:flex justify-between items-center my-2">
                <!-- Dropdown Filter -->
                <form id="filterForm" action="" method="get" class="flex items-center">
                    <label for="kategori" class="text-sm font-bold text-primary">Filter Kategori:</label>
                    <select name="kategori" id="kategori" class="ml-2 py-1 border-2 border-primary text-primary rounded-md shadow-sm" onchange="document.getElementById('filterForm').submit();">
                        <option value="">Semua Kategori</option>
                        <option value="Perintis Lingkungan" <?= ($kategori == 'Perintis Lingkungan') ? 'selected' : '' ?>>Perintis Lingkungan</option>
                        <option value="Pengabdi Lingkungan" <?= ($kategori == 'Pengabdi Lingkungan') ? 'selected' : '' ?>>Pengabdi Lingkungan</option>
                        <option value="Penyelamat Lingkungan" <?= ($kategori == 'Penyelamat Lingkungan') ? 'selected' : '' ?>>Penyelamat Lingkungan</option>
                        <option value="Pembina Lingkungan" <?= ($kategori == 'Pembina Lingkungan') ? 'selected' : '' ?>>Pembina Lingkungan</option>
                    </select>
                </form>
                <form method="get" class="flex items-center justify-end my-4">
                    <div class="relative lg:w-56 w-80 transition-all focus-within:w-64 lg:mt-0 mt-4">
                        <input
                            placeholder="Masukan kata kunci"
                            class="input shadow-lg focus:border-2 border-2 text-primary border-primary px-5 py-1 pr-10 rounded-md w-full outline-none"
                            name="search"
                            value="<?= esc($keyword) ?>" />
                        <svg
                            class="w-6 h-6 absolute top-1/2 right-3 transform -translate-y-1/2 text-primary"
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
                    </div>
                </form>
            </div>

            <div class="relative flex flex-col w-full h-full overflow-hidden text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                <div class="overflow-x-auto">
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        No
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Nama
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Kategori
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Provinsi
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Status
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Unduh
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($usulan)): ?>
                                <?php foreach ($usulan as $index => $item): ?>
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-4 border-b border-slate-200 text-center">
                                            <p class="block text-xs text-slate-800">
                                                <?= $index + 1; ?>
                                            </p>
                                        </td>
                                        <td class="p-4 border-b border-slate-200 text-center">
                                            <p class="block text-xs text-slate-800">
                                                <?= $item['nama']; ?>
                                            </p>
                                        </td>
                                        <td class="p-4 border-b border-slate-200 text-center">
                                            <p class="block text-xs text-slate-800">
                                                <?= $item['kategori']; ?>
                                            </p>
                                        </td>
                                        <td class="p-4 border-b border-slate-200 text-center">
                                            <p class="block text-xs text-slate-800">
                                                <?= $item['provinsi']; ?>
                                            </p>
                                        </td>
                                        <td class="p-4 border-b border-slate-200 text-center">
                                            <?php
                                            // Inisialisasi kelas status berdasarkan nilai status_pendaftaran
                                            $statusClass = '';
                                            if ($item['status_pendaftaran'] === 'Sesuai' || $item['status_pendaftaran'] === 'Lolos Administrasi') {
                                                $statusClass = 'text-accepted';
                                            } elseif ($item['status_pendaftaran'] === 'Tidak Lolos Administrasi') {
                                                $statusClass = 'text-rejected';
                                            } elseif ($item['status_pendaftaran'] === 'Verifikasi Administrasi') {
                                                $statusClass = 'text-primary';
                                            }
                                            ?>
                                            <p id="<?= $item['status_pendaftaran']; ?>" class="block text-xs font-bold <?= $statusClass; ?>">
                                                <?= $item['status_pendaftaran']; ?>
                                            </p>
                                        </td>
                                        <td class="border-b border-slate-200 text-center">
                                            <button
                                                onclick="window.location.href='pdf/<?= $item['kode_registrasi']; ?>'"
                                                class="size-6"
                                                style="background: none; border: none; cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="p-4 border-b border-slate-200 text-center">
                                        <p class="block text-xs text-slate-800">
                                            Tidak ada data usulan
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row flex lg:justify-end justify-center my-6 lg:me-2 me-0">
                    <div class="pagination">
                        <?= $pager->links('usulan', 'template_pagination') ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?= $this->endSection() ?>
</body>