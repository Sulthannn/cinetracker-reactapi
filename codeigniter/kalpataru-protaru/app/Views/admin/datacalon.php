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
    <div class="max-h-screen flex flex-col">

      <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
          <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Data Calon</h1>
          <div class="flex items-center">
            <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
            <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
          </div>
        </div>
      </header>

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

      <div class="overflow-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left table-auto min-w-max">
          <thead>
            <tr>
              <th class="p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">No</p>
              </th>
              <th class=" p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">Kode Registrasi</p>
              </th>
              <th class=" p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">Nama</p>
              </th>
              <th class=" p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">Kategori</p>
              </th>
              <th class=" p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">Provinsi</p>
              </th>
              <th class=" p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">Status</p>
              </th>
              <th class=" p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">Detail</p>
              </th>
              <th class=" p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center">
                <p class="block text-xs md:text-sm font-bold leading-none text-slate-800">Unduh</p>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($usulan)): ?>
              <tr>
                <td colspan=" 8" class="p-4 text-center text-sm text-red-600">
                  Tidak ditemukan data berdasarkan kategori "<?= $kategori ?: 'Semua Kategori'; ?>"
                </td>
              </tr>
            <?php else: ?>
              <?php $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?>
              <?php foreach ($usulan as $item): ?>
                <tr class="hover:bg-slate-100">
                  <td class="p-4 border-b border-slate-200 text-center">
                    <p class="block text-xs text-slate-800"><?= $no++ ?></p>
                  </td>
                  <td class="p-4 border-b border-slate-200 text-center">
                    <p class="block text-xs text-slate-800"><?= $item['kode_registrasi'] ?></p>
                  </td>
                  <td class="p-4 border-b border-slate-200 text-center">
                    <p class="block text-xs text-slate-800"><?= $item['nama'] ?></p>
                  </td>
                  <td class="p-4 border-b border-slate-200 text-center">
                    <p class="block text-xs text-slate-800"><?= $item['kategori'] ?></p>
                  </td>
                  <td class="p-4 border-b border-slate-200 text-center">
                    <p class="block text-xs text-slate-800"><?= $item['provinsi'] ?></p>
                  </td>
                  <td class="p-4 border-b border-slate-200 text-center">
                    <?php if (in_array($item['status_pendaftaran'], ['Verifikasi Administrasi', 'Lolos Administrasi', 'Tidak Lolos Administrasi'])): ?>
                      <p class="block text-xs font-bold 
        <?= $item['status_pendaftaran'] == 'Verifikasi Administrasi' ? 'text-green-900' : ''; ?>
        <?= $item['status_pendaftaran'] == 'Lolos Administrasi' ? 'text-accepted' : ''; ?>
        <?= $item['status_pendaftaran'] == 'Tidak Lolos Administrasi' ? 'text-rejected' : ''; ?>">
                        <?= $item['status_pendaftaran']; ?>
                      </p>
                    <?php else: ?>
                      <form method="POST" action="<?= base_url('admin/updatestatuspendaftaran') ?>" id="statusForm-<?= $item['id_pendaftaran'] ?>">
                        <input type="hidden" name="id_pendaftaran" value="<?= $item['id_pendaftaran'] ?>">
                        <input type="hidden" name="catatan_verifikasi" id="catatanVerifikasi-<?= $item['id_pendaftaran'] ?>"> <!-- Input hidden untuk catatan -->
                        <select name="status_pendaftaran" class="status-dropdown ml-2 border-2 border-primary text-primary rounded-md shadow-sm text-xs" data-id="<?= $item['id_pendaftaran'] ?>">
                          <?php
                          $statuses = ['Terkirim', 'Perlu Perbaikan', 'Sesuai', 'Verifikasi Administrasi'];
                          foreach ($statuses as $status) {
                            $selected = ($status == $item['status_pendaftaran']) ? 'selected' : '';
                            $disabled = ($status == 'Terkirim') ? 'disabled' : '';
                            echo "<option value='$status' $selected $disabled>$status</option>";
                          }
                          ?>
                        </select>
                      </form>
                    <?php endif; ?>
                  </td>
                  <td class="p-4 border-b border-slate-200 text-center">
                    <a href="<?= base_url('admin/detaildatacalon/' . $item['id_pendaftaran']); ?>" class="mt-4 w-full rounded-md py-2 mb-2 px-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover">Selengkapnya</a>
                  </td>
                  <td class="p-4 border-b border-slate-200 text-center">
                    <div class="flex justify-center">
                      <a href="./pdf/<?= $item['kode_registrasi']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
        <div class="row flex lg:justify-end justify-center my-6 lg:me-2 me-0">
          <div class="pagination">
            <?= $pager->links('usulan', 'template_pagination') ?>
          </div>
        </div>
      </div>
    </div>

    <button
      id="exportButton"
      class="w-full mt-8 rounded-md py-2 px-2 text-center font-semibold text-xs text-primary bg-secondary hover:shadow-md flex items-center justify-center gap-4"
      type="button">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504-1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
      </svg>
      Export Data Calon
    </button>

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

    <div id="popupModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Tambah Catatan</h2>
        <textarea id="catatanPerbaikan" rows="4" class="w-full p-2 border border-slate-300 rounded-md" placeholder="Masukan catatan verifikasi..."></textarea>
        <div class="flex justify-end mt-4">
          <button id="kirimCatatanBtn" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-600 transition">Kirim Catatan</button>
          <button id="batalBtn" class="ml-2 px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400 transition">Batal</button>
        </div>
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

        if (this.value === "Perlu Perbaikan") {
          // Jika pilih "Tidak Lolos Administrasi", tampilkan modal catatan terlebih dahulu
          popupModal.classList.remove('hidden'); // Tampilkan modal catatan

          kirimCatatanBtn.onclick = function() {
            const catatan = document.getElementById('catatanPerbaikan').value;
            const catatanInput = document.getElementById(`catatanVerifikasi-${selectedDropdown.dataset.id}`);

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
        } else if (this.value !== "Perlu Perbaikan") {
          // Jika pilih selain "Perlu Perbaikan", langsung tampilkan modal konfirmasi
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

        statusModal.classList.add('hidden'); // Sembunyikan modal setelah perubahan
      }
    });

    // Ketika tombol "Batal" pada modal konfirmasi ditekan
    cancelStatusButton.addEventListener('click', function() {
      if (selectedDropdown) {
        selectedDropdown.value = initialValue; // Kembalikan ke nilai awal
      }
      statusModal.classList.add('hidden'); // Sembunyikan modal
      location.reload(); // Refresh halaman
    });

    // Tutup modal konfirmasi jika klik di luar modal
    window.addEventListener('click', function(event) {
      if (event.target === statusModal) {
        statusModal.classList.add('hidden');
        if (selectedDropdown) {
          selectedDropdown.value = initialValue; // Kembalikan ke nilai awal jika modal ditutup
        }
      }
    });

    // Script button export ke excel
    document.getElementById("exportButton").addEventListener("click", function() {
      window.location.href = '/admin/exportexcel';
    });
  </script>

</body>

</html>