<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="lg:flex">



    <!-- Sidebar -->
    <div class="w-64 bg-white text-white">
        <?= $this->include('template/sidebaradmin') ?>
    </div>

    <div class="lg:flex-1 p-6">
        <div class="min-h-screen flex flex-col">

            <header class="bg-white shadow">
                <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Arsip Penerima</h1>
                    <div class="flex items-center">
                        <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
                        <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
                    </div>
                </div>
            </header>
            <div>
                <a href="/admin/tambaharsippenerima">
                    <button id="tambahCalon" class="mt-4 w-48 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button"> <span>&#10010</span> Tambah Arsip Penerima</button>
                </a>
            </div>

            <div class="lg:flex lg:justify-between">
                <!-- Dropdown Filter -->
                <form id="filterForm" action="" method="get" class="flex items-center my-4 ms-4">
                    <label for="kategori" class="text-sm font-bold text-primary">Filter Kategori:</label>
                    <select name="kategori" id="kategori" class="ml-2 border-2 border-primary text-primary rounded-md shadow-sm" onchange="document.getElementById('filterForm').submit();">
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

            <h4 class="text-sm font-semibold text-primary ms-4">
                Hasil: <?= esc($countAllArsip) ?> Arsip Penerima
            </h4>

            <div class="overflow-auto bg-white shadow-md rounded-lg">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr>
                            <th class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p class="flex items-center justify-center gap-2 text-sm font-bold leading-none text-slate-800">
                                    No
                                </p>
                            </th>
                            <th class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p class="flex items-center justify-center gap-2 text-sm font-bold leading-none text-slate-800">
                                    Nama
                                </p>
                            </th>
                            <th class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p class="flex items-center justify-center gap-2 text-sm font-bold leading-none text-slate-800">
                                    Kategori
                                </p>
                            </th>
                            <th class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p class="flex items-center justify-center gap-2 text-sm font-bold leading-none text-slate-800">
                                    Provinsi
                                </p>
                            </th>
                            <th class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p class="flex items-center justify-center gap-2 text-sm font-bold leading-none text-slate-800">
                                    Tahun
                                    <!-- Tombol Sort -->
                                    <a href="<?= current_url() ?>?<?= http_build_query(['sort' => $sort === 'asc' ? 'desc' : 'asc']) ?>" class="inline-block">
                                        <?php if ($sort === 'asc'): ?>
                                            ▲
                                        <?php else: ?>
                                            ▼
                                        <?php endif; ?>
                                    </a>
                                </p>
                            </th>
                            <th class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p class="flex items-center justify-center gap-2 text-sm font-bold leading-none text-slate-800">
                                    Edit
                                </p>
                            </th>
                            <th class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p class="flex items-center justify-center gap-2 text-sm font-bold leading-none text-slate-800">
                                    Hapus
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($arsip) > 0): ?>
                            <?php
                            $no = 0;
                            foreach ($arsip as $index => $a):
                                $no++;
                            ?>
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800 text-center">
                                            <?= $no ?>
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800 text-center">
                                            <?= strlen(esc($a['nama'])) > 0 ? implode(' ', array_slice(explode(' ', esc($a['nama'])), 0, 5)) . (count(explode(' ', esc($a['nama']))) > 5 ? '...' : '') : '' ?>
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800 text-center">
                                            <?= esc($a['kategori']); ?> </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800 text-center">
                                            <?= esc($a['provinsi']); ?> </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800 text-center">
                                            <?= esc($a['tahun_penerimaan']); ?> </p>
                                    </td>
                                    <td class="p-2 border-b">
                                        <a href="/admin/arsip/edit/<?= $a['id_arsip_penerima']; ?>" class="w-full inline-block py-1 px-2 bg-primary hover:bg-primaryhover text-white rounded-md text-sm text-center">Selengkapnya</a>
                                    </td>
                                    <td class="p-4 border-b border-slate-200 text-center">
                                        <form action="/admin/arsip/hapus/<?= esc($a['id_arsip_penerima']); ?>" method="POST">
                                            <button type="submit" class="text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="p-4 text-center text-slate-800">Belum ada arsip</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="row flex lg:justify-end justify-center my-6 lg:me-2 me-0">
                    <div class="pagination">
                        <?= $pager->links('arsip', 'template_pagination') ?>
                    </div>
                </div>
            </div>

            <button id="exportButton"
                class="w-full mt-8 rounded-md py-2 px-2 text-center font-semibold text-xs text-primary bg-secondary hover:shadow-md flex items-center justify-center gap-4" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                </svg>
                Export Arsip Penerima
            </button>
        </div>

    </div>
    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col max-w-md">
            <h2 class="text-left text-lg font-bold text-red-600 mb-2">Konfirmasi Hapus Arsip Penerima</h2>
            <p class="text-justify text-sm text-slate-600 mb-4">Apakah Anda yakin ingin menghapus arsip ini? Arsip yang sudah dihapus tidak dapat dipulihkan kembali!</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDeleteButton" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 hover:text-white rounded-md">Batal</button>
                <button id="confirmDeleteButton" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">Ya, Hapus Arsip</button>
            </div>
        </div>
    </div>
    <script>
        // POPUP MODAL HAPUS
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        const cancelDeleteButton = document.getElementById('cancelDeleteButton');
        let deleteForm = null; // Menyimpan form hapus

        // Event listener untuk tombol hapus
        document.querySelectorAll('form[action^="/admin/arsip/hapus/"] button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit form langsung
                deleteForm = this.closest('form'); // Ambil form yang akan dihapus
                deleteModal.classList.remove('hidden'); // Tampilkan modal
            });
        });

        // Ketika tombol "Ya, Hapus akun" ditekan
        confirmDeleteButton.addEventListener('click', function() {
            if (deleteForm) {
                deleteForm.submit(); // Submit form hapus akun
            }
        });

        // Ketika tombol "Batal" ditekan, sembunyikan modal
        cancelDeleteButton.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });

        // Script button export ke excel
        document.getElementById("exportButton").addEventListener("click", function() {
            // Ambil nilai filter dari URL query string
            const urlParams = new URLSearchParams(window.location.search);
            const kategori = urlParams.get('kategori') || '';
            const search = urlParams.get('search') || '';
            const sort = urlParams.get('sort') || 'asc';

            // Buat URL ekspor dengan parameter filter
            const exportUrl = `/admin/exportarsip?kategori=${encodeURIComponent(kategori)}&search=${encodeURIComponent(search)}&sort=${encodeURIComponent(sort)}`;

            // Redirect ke URL ekspor
            window.location.href = exportUrl;
        });
    </script>
</body>

</html>