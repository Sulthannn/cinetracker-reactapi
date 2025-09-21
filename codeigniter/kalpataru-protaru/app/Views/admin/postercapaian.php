<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
</head>

<body class="flex flex-col lg:flex-row">

  <!-- Sidebar -->
  <div class="w-64">
    <?= $this->include('template/sidebaradmin') ?>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-4 lg:p-6">
    <div class="min-h-screen flex flex-col">

      <!-- Header -->
      <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
          <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Poster Capaian</h1>
          <div class="flex items-center">
            <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
            <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
          </div>
        </div>
      </header>

      <!-- Table Section -->
      <div class="flex justify-center">
        <div class="bg-white shadow-md rounded-lg overflow-x-auto mt-8 w-full">
          <form id="capaianForm" action="/admin/editcapaian" method="post" enctype="multipart/form-data">
              <?= csrf_field() ?>
              <input type="hidden" name="id_capaian" value="<?= esc($capaian['id_capaian'] ?? '') ?>">
              <input type="hidden" name="gambar_lama" value="<?= esc($capaian['gambar'] ?? '') ?>">
              <table class="w-full text-left min-w-max">
                <thead>
                  <tr>
                    <th class="p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center text-sm font-bold text-gray-800">Upload Capaian</th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center text-sm font-bold text-gray-800">Status</th>
                    <th class="p-4 border-b border-slate-300 bg-slate-50 hover:bg-slate-100 text-center text-sm font-bold text-gray-800">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="hover:bg-gray-50">
                  <td class="p-4 border-b border-gray-200 text-center">
                    <label class="block mb-2 text-sm text-black">Capaian : <?php if (!empty($capaian['gambar'] ?? '')): ?>
                        <?= esc($capaian['gambar']) ?>
                    <?php endif; ?><span class="text-primary">(.jpg/jpeg)</span></label>
                    <input type="file" name="gambar" accept="image/jpeg, image/jpg" class="border-2 border-primary text-primary rounded-md shadow-sm text-xs p-1">
                </td>
                <td class="p-4 border-b border-gray-200 text-center">
                    <select name="status" class="status-dropdown ml-2 border-2 border-primary text-primary rounded-md shadow-sm text-xs">
                        <option value="Nonaktif" <?= isset($capaian['status']) && $capaian['status'] === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        <option value="Aktif" <?= isset($capaian['status']) && $capaian['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                    </select>
                </td>
                    <td class="p-4 border-b border-gray-200 text-center">
                      <button type="button" class="bg-primary text-white px-4 py-2 rounded-lg" onclick="showModal(event)">Simpan</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
        </div>
      </div>

      <button onclick="window.location.href='/admin/dashboard'" class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start w-1/12 mt-8">
        <span class="font-bold text-lg items-center">←</span> Kembali
      </button>
    </div>
  </div>

  <!-- Modal Popup -->
  <div id="modalPopup" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
      <img src="/images/question.png" alt="Question Icon" class="w-16 h-16 mb-4">
      <p class="text-center text-lg font-bold text-gray-700 mb-4">Apakah anda yakin ingin menyimpan data Capaian?</p>
      <div class="flex justify-end space-x-4">
        <button id="cancelButton" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 hover:text-white rounded-md" onclick="closeModal()">Periksa Kembali</button>
        <button id="confirmButton" class="px-4 py-2 bg-primary hover:bg-primaryhover text-white rounded-md" onclick="confirmSubmit()">Ya, Kirim Data</button>
      </div>
    </div>
  </div>


  <script>
    function showModal(event) {
      event.preventDefault();
      document.getElementById("modalPopup").classList.remove("hidden");
    }

    function closeModal() {
      document.getElementById("modalPopup").classList.add("hidden");
    }

    function confirmSubmit() {
      closeModal();
      document.getElementById("capaianForm").submit();
    }
  </script>

</body>

</html>