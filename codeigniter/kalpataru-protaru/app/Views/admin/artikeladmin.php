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

    <!-- Konten utama -->
    <div class="lg:flex-1 p-4 md:p-6">
        <div class="min-h-screen flex flex-col">

            <!-- Header -->
            <header class="bg-white shadow">
                <div class="container mx-auto flex flex-wrap items-center justify-between p-4 md:p-6">
                    <h1 class="text-lg md:text-2xl font-semibold text-gray-700">Artikel</h1>
                    <div class="flex items-center">
                        <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
                        <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg">Keluar</a>
                    </div>
                </div>
            </header>

            <!-- Tombol Tambah Artikel dan hasil -->
            <div class="my-4 flex flex-col md:flex-row justify-between md:items-center gap-4">
                <a href="/admin/tambah-artikel" class="w-full md:w-auto">
                    <button id="tambahArtikel" class="w-full md:w-48 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover">
                        <span>&#10010</span> Tambah Artikel
                    </button>
                </a>
            </div>

            <div class="lg:flex lg:justify-between">
                <!-- Dropdown Filter -->
                <form id="filterForm" action="" method="get" class="flex items-center my-4 ms-4">
                    <label for="status" class="text-sm font-bold text-primary">Filter Status Artikel:</label>
                    <select name="status" id="status" class="ml-2 border-2 border-primary text-primary rounded-md shadow-sm" onchange="document.getElementById('filterForm').submit();">
                        <option value="">Semua Status Artikel</option>
                        <option value="Ditangguhkan" <?= ($status == 'Ditangguhkan') ? 'selected' : '' ?>>Ditangguhkan</option>
                        <option value="Terbit" <?= ($status == 'Terbit') ? 'selected' : '' ?>>Terbit</option>
                        <option value="Ditolak" <?= ($status == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
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

            <!-- Tabel artikel -->
            <div class="overflow-auto bg-white shadow-md rounded-lg">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr class="text-sm font-semibold text-slate-700">
                            <th class="p-2 border-b bg-slate-50 hover:bg-slate-100 text-center">No</th>
                            <th class="p-2 border-b bg-slate-50 hover:bg-slate-100">Judul</th>
                            <th class="p-2 border-b bg-slate-50 hover:bg-slate-100 text-center">Tanggal</th>
                            <th class="p-2 border-b bg-slate-50 hover:bg-slate-100 text-center">Status</th>
                            <th class="p-2 border-b bg-slate-50 hover:bg-slate-100 text-center">Detail</th>
                            <th class="p-2 border-b bg-slate-50 hover:bg-slate-100 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($artikels) > 0): ?>
                            <?php
                            $no = 0;
                            foreach ($artikels as $index => $artikel):
                                $no++;
                            ?>
                                <tr class="hover:bg-slate-50 text-sm text-slate-800">
                                    <td class="p-2 border-b text-center"><?= $no ?></td>
                                    <td class="p-2 border-b">
                                        <?= strlen(esc($artikel['judul'])) > 0 ? implode(' ', array_slice(explode(' ', esc($artikel['judul'])), 0, 5)) . (count(explode(' ', esc($artikel['judul']))) > 5 ? '...' : '') : '' ?>
                                    </td>
                                    <td class="p-2 border-b text-center"><?= esc($artikel['tanggal']) ?></td>
                                    <td class="p-2 border-b text-center">
                                        <form method="POST" action="/admin/updatestatusartikel">
                                            <input type="hidden" name="id_artikel" value="<?= $artikel['id_artikel'] ?>">
                                            <input type="hidden" name="catatan" id="catatanArtikel-<?= $artikel['id_artikel'] ?>"> <!-- Input hidden untuk catatan -->
                                            <select name="status" class="status-dropdown border-2 border-primary text-primary rounded-md shadow-sm text-xs" data-id="<?= $artikel['id_artikel'] ?>">
                                                <?php
                                                $statuses = ['Ditangguhkan', 'Terbit', 'Ditolak'];
                                                foreach ($statuses as $status) {
                                                    $selected = ($status == $artikel['status']) ? 'selected' : '';
                                                    echo "<option value='$status' $selected>$status</option>";
                                                }
                                                ?>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="p-2 border-b">
                                        <a href="/admin/artikel/<?= $artikel['slug']; ?>" class="w-full inline-block py-1 px-2 bg-primary hover:bg-primaryhover text-white rounded-md text-sm text-center">Selengkapnya</a>
                                    </td>
                                    <td class="p-2 border-b text-center">
                                        <form action="/admin/artikel/hapus/<?= $artikel['id_artikel'] ?>" method="POST">
                                            <button type="submit" class="text-rejected">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9L14.4 18m-4.8 0L9.26 9M18.23 6.83c.34.05.68.11 1.02.16m-1.02-.16L18.16 19.67a2.25 2.25 0 01-2.24 2.08H8.08a2.25 2.25 0 01-2.24-2.08L4.77 5.79m14.46 0a48.11 48.11 0 00-3.48-.4m-12 .56c.34-.06.68-.11 1.02-.16m0 0a48.11 48.11 0 013.48-.4m7.5 0v-.92c0-1.18-.91-2.16-2.09-2.2a51.96 51.96 0 00-3.32 0c-1.18.04-2.09 1.02-2.09 2.2v.92m7.5 0a48.67 48.67 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="p-4 text-center">Tidak ada artikel yang ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="row flex lg:justify-end justify-center my-6 lg:me-2 me-0">
                    <div class="pagination">
                        <?= $pager->links('artikels', 'template_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col max-w-md">
            <h2 class="text-lg font-bold text-rejected mb-2">Konfirmasi Hapus Artikel</h2>
            <p class="text-justify text-slate-600 mb-4">Apakah Anda yakin ingin menghapus artikel ini?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDeleteButton" class="px-4 py-2 bg-gray-300 rounded-md">Batal</button>
                <button id="confirmDeleteButton" class="px-4 py-2 bg-rejected rounded-md text-white">Ya, Hapus Artikel</button>
            </div>
        </div>
    </div>

    <!-- Modal Status -->
    <div id="statusModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col max-w-md">
            <h2 class="text-left text-lg font-bold text-primary mb-2">Konfirmasi Perubahan Status</h2>
            <p class="text-justify text-sm text-slate-600 mb-4">Apakah Anda yakin ingin mengubah status?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelStatusButton" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 hover:text-white rounded-md">Batal</button>
                <button id="confirmStatusButton" class="px-4 py-2 bg-primary hover:bg-primaryhover text-white rounded-md">Ya, Ubah Status</button>
            </div>
        </div>
    </div>

    <!-- Modal Catatan Artikel -->
    <div id="popupModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Tambah Catatan</h2>
            <textarea id="catatanArtikel" rows="4" class="w-full p-2 border border-slate-300 rounded-md" placeholder="Masukan catatan artikel..."></textarea>
            <div class="flex justify-end mt-4">
                <button id="kirimCatatanBtn" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primaryhover transition">Kirim Catatan</button>
                <button id="batalBtn" class="ml-2 px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400 transition">Batal</button>
            </div>
        </div>
    </div>

    <script>
        // POPUP MODAL STATUS
        const statusModal = document.getElementById('statusModal');
        const confirmStatusButton = document.getElementById('confirmStatusButton');
        const cancelStatusButton = document.getElementById('cancelStatusButton');

        const popupModal = document.getElementById('popupModal');
        const kirimCatatanBtn = document.getElementById('kirimCatatanBtn');
        const batalBtn = document.getElementById('batalBtn');

        let selectedDropdown = null;
        let initialValue = ''; // Menyimpan nilai awal dropdown

        // Event listener untuk setiap dropdown status
        document.querySelectorAll('.status-dropdown').forEach(dropdown => {
            dropdown.addEventListener('change', function() {
                selectedDropdown = this;
                initialValue = this.value; // Simpan nilai awal

                if (this.value === "Ditolak") {
                    popupModal.classList.remove('hidden'); // Tampilkan modal catatan

                    kirimCatatanBtn.onclick = function() {
                        const catatan = document.getElementById('catatanArtikel').value;
                        const catatanInput = document.getElementById(`catatanArtikel-${selectedDropdown.dataset.id}`);

                        // Set nilai catatan ke input hidden
                        catatanInput.value = catatan;

                        // Sembunyikan modal catatan dan tampilkan modal konfirmasi setelah catatan diisi
                        popupModal.classList.add('hidden');
                        statusModal.classList.remove('hidden'); // Tampilkan modal konfirmasi
                    };
                    // Jika tombol batal pada modal catatan ditekan
                    batalBtn.onclick = function() {
                        popupModal.classList.add('hidden'); // Sembunyikan modal catatan
                        location.reload();
                    };
                } else if (this.value !== "Ditolak") {
                    // Jika pilih selain "Ditolak", langsung tampilkan modal konfirmasi
                    statusModal.classList.remove('hidden'); // Tampilkan modal konfirmasi
                }
            });
        });

        // Ketika tombol "Ya, Ubah Status" ditekan
        confirmStatusButton.addEventListener('click', function() {
            if (selectedDropdown) {
                // Ambil data dari dropdown
                const formData = new FormData(selectedDropdown.form);

                // Kirim request ke server
                fetch(selectedDropdown.form.action, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Refresh halaman jika berhasil
                        } else {
                            alert(data.message); // Menampilkan pesan gagal
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan, silakan coba lagi.');
                    });

                statusModal.classList.add('hidden'); // Sembunyikan modal
            }
        });

        // Ketika tombol "Batal" ditekan
        cancelStatusButton.addEventListener('click', function() {
            if (selectedDropdown) {
                selectedDropdown.value = initialValue; // Kembalikan ke nilai awal
            }
            statusModal.classList.add('hidden'); // Sembunyikan modal
            location.reload(); // Refresh halaman
        });

        // Tutup modal jika klik di luar modal
        window.addEventListener('click', function(event) {
            if (event.target === statusModal) {
                statusModal.classList.add('hidden');
                if (selectedDropdown) {
                    selectedDropdown.value = initialValue; // Kembalikan ke nilai awal jika modal ditutup
                }
            }
        });


        // POPUP MODAL HAPUS
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        const cancelDeleteButton = document.getElementById('cancelDeleteButton');
        let deleteForm = null; // Menyimpan form hapus

        // Event listener untuk tombol hapus
        document.querySelectorAll('form[action^="/admin/artikel/hapus/"] button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit form langsung
                deleteForm = this.closest('form'); // Ambil form yang akan dihapus
                deleteModal.classList.remove('hidden'); // Tampilkan modal
            });
        });

        // Ketika tombol "Ya, Hapus Artikel" ditekan
        confirmDeleteButton.addEventListener('click', function() {
            if (deleteForm) {
                deleteForm.submit(); // Submit form hapus artikel
            }
        });

        // Ketika tombol "Batal" ditekan, sembunyikan modal
        cancelDeleteButton.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
    </script>

</body>

</html>