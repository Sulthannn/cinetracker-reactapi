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

    <div class="lg:flex-1 p-4 md:p-6">
        <div class="min-h-screen flex flex-col">

            <!-- Header -->
            <header class="bg-white shadow">
                <div class="container mx-auto flex flex-wrap items-center justify-between p-4 md:p-6">
                    <h1 class="text-lg md:text-2xl font-semibold text-gray-700">Pengumuman</h1>
                    <div class="flex items-center">
                        <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
                        <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg">Keluar</a>
                    </div>
                </div>
            </header>

            <!-- Tombol Tambah Pengumuman dan hasil -->
            <div class="my-4 flex flex-col md:flex-row justify-between md:items-center gap-4">
                <a href="/admin/tambah-pengumuman" class="w-full md:w-auto">
                    <button id="tambahPengumuman" class="w-full md:w-48 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover">
                        <span>&#10010</span> Tambah Pengumuman
                    </button>
                </a>
            </div>

            <div class="lg:flex lg:justify-between">
                <!-- Dropdown Filter -->
                <form id="filterForm" action="" method="get" class="flex items-center my-4 ms-4">
                    <label for="status" class="text-sm font-bold text-primary">Filter Status Pengumuman:</label>
                    <select name="status" id="status" class="ml-2 border-2 border-primary text-primary rounded-md shadow-sm" onchange="document.getElementById('filterForm').submit();">
                        <option value="">Semua Status Pengumuman</option>
                        <option value="Ditangguhkan" <?= ($status == 'Ditangguhkan') ? 'selected' : '' ?>>Ditangguhkan</option>
                        <option value="Terbit" <?= ($status == 'Terbit') ? 'selected' : '' ?>>Terbit</option>
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
                        <?php if (count($pengumumans) > 0): ?>
                            <?php
                            $no = 0;
                            foreach ($pengumumans as $index => $pengumuman):
                                $no++;
                            ?>
                                <tr class="hover:bg-slate-50 text-sm text-slate-800">
                                    <td class="p-2 border-b text-center"><?= $no ?>
                                    </td>
                                    <td class="p-2 border-b">
                                        <?= strlen(esc($pengumuman['judul'])) > 0 ? implode(' ', array_slice(explode(' ', esc($pengumuman['judul'])), 0, 5)) . (count(explode(' ', esc($pengumuman['judul']))) > 5 ? '...' : '') : '' ?>
                                    </td>
                                    <td class="p-4 border-b border-slate-200 text-center"><?= esc($pengumuman['tanggal']) ?>
                                    </td>
                                    <td class="p-2 border-b text-center">
                                        <form method="POST" action="/admin/updatestatuspengumuman">
                                            <input type="hidden" name="id_pengumuman" value="<?= $pengumuman['id_pengumuman'] ?>">
                                            <select name="status" class="status-dropdown border-2 border-primary text-primary rounded-md shadow-sm text-xs" data-id="<?= $pengumuman['id_pengumuman'] ?>">
                                                <?php
                                                $statuses = ['Ditangguhkan', 'Terbit'];
                                                foreach ($statuses as $status) {
                                                    $selected = ($status == $pengumuman['status']) ? 'selected' : '';
                                                    echo "<option value='$status' $selected>$status</option>";
                                                }
                                                ?>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="p-4 border-b">
                                        <div>
                                            <a href="/admin/pengumuman/<?= $pengumuman['slug']; ?>" class="w-full inline-block py-1 px-2 bg-primary hover:bg-primaryhover text-white rounded-md text-sm text-center">Selengkapnya</a>
                                        </div>
                                    </td>
                                    <td class="p-4 border-b text-center">
                                        <form action="/admin/pengumuman/hapus/<?= $pengumuman['id_pengumuman'] ?>" method="POST">
                                            <button type="submit" class="text-rejected">
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
                                <td colspan="6" class="p-4 text-center text-slate-800">Tidak ada pengumuman yang ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="row flex lg:justify-end justify-center my-6 lg:me-2 me-0">
                    <div class="pagination">
                        <?= $pager->links('pengumumans', 'template_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col max-w-md">
            <h2 class="text-lg font-bold text-rejected mb-2">Konfirmasi Hapus Pengumuman</h2>
            <p class="text-justify text-sm text-slate-600 mb-4">Apakah Anda yakin ingin menghapus pengumuman ini? Pengumuman yang sudah dihapus tidak dapat dipulihkan kembali.</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDeleteButton" class="px-4 py-2 bg-gray-300 rounded-md">Batal</button>
                <button id="confirmDeleteButton" class="px-4 py-2 bg-rejected rounded-md text-white">Ya, Hapus Pengumuman</button>
            </div>
        </div>
    </div>

    <!-- Modal Status -->
    <div id="statusModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col max-w-md">
            <h2 class="text-left text-lg font-bold text-primary mb-2">Konfirmasi Perubahan Status</h2>
            <p class="text-justify text-sm text-slate-600 mb-4">Apakah Anda yakin ingin mengubah status pengumuman?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelStatusButton" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 hover:text-white rounded-md">Batal</button>
                <button id="confirmStatusButton" class="px-4 py-2 bg-primary hover:bg-primaryhover text-white rounded-md">Ya, Ubah Status</button>
            </div>
        </div>
    </div>

    <script>
        // POPUP MODAL STATUS
        const statusModal = document.getElementById('statusModal');
        const confirmStatusButton = document.getElementById('confirmStatusButton');
        const cancelStatusButton = document.getElementById('cancelStatusButton');
        let selectedDropdown = null;
        let initialValue = ''; // Menyimpan nilai awal dropdown

        // Event listener untuk setiap dropdown status
        document.querySelectorAll('.status-dropdown').forEach(dropdown => {
            dropdown.addEventListener('change', function() {
                selectedDropdown = this;
                initialValue = this.value; // Simpan nilai awal
                statusModal.classList.remove('hidden'); // Tampilkan modal
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
        document.querySelectorAll('form[action^="/admin/pengumuman/hapus/"] button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit form langsung
                deleteForm = this.closest('form'); // Ambil form yang akan dihapus
                deleteModal.classList.remove('hidden'); // Tampilkan modal
            });
        });

        // Ketika tombol "Ya, Hapus Pengumuman" ditekan
        confirmDeleteButton.addEventListener('click', function() {
            if (deleteForm) {
                deleteForm.submit(); // Submit form hapus Pengumuman
            }
        });

        // Ketika tombol "Batal" ditekan, sembunyikan modal
        cancelDeleteButton.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
    </script>
</body>

</html>