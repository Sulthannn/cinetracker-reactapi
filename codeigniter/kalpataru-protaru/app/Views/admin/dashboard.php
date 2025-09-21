<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/app.css">
  <title><?= $title; ?></title>
</head>

<body class="lg:flex">

  <div class="w-64 bg-white text-white">
    <?= $this->include('template/sidebaradmin') ?>
  </div>

  <div class="lg:flex-1 p-6">
    <div class="min-h-screen flex flex-col">

      <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
          <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Dashboard</h1>
          <div class="flex items-center">
            <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
            <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
          </div>
        </div>
      </header>

      <!-- Main Content -->
      <div class="flex-1 p-4 md:p-6 container mx-auto">
        <!-- Cards Summary -->
        <div class="grid gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-4">
          <a href="/admin/arsippenerima">
            <div class="flex items-center p-4 bg-white shadow rounded-lg">
              <img src="/images/kategoria.jpg" class="w-1/4 mr-4">
              <div>
                <p class="mb-1 md:mb-2 text-sm font-medium text-gray-600">Perintis Lingkungan</p>
                <p class="text-lg font-semibold text-gray-700"><?= $kategoriData->total_perintis; ?></p>
              </div>
            </div>
          </a>
          <a href="/admin/arsippenerima">
            <div class="flex items-center p-4 bg-white shadow rounded-lg">
              <img src="/images/kategorib.jpg" class="w-1/4 mr-4">
              <div>
                <p class="mb-1 md:mb-2 text-sm font-medium text-gray-600">Pengabdi Lingkungan</p>
                <p class="text-lg font-semibold text-gray-700"><?= $kategoriData->total_pengabdi; ?></p>
              </div>
            </div>
          </a>
          <a href="/admin/arsippenerima">
            <div class="flex items-center p-4 bg-white shadow rounded-lg">
              <img src="/images/kategoric.jpg" class="w-1/4 mr-4">
              <div>
                <p class="mb-1 md:mb-2 text-sm font-medium text-gray-600">Penyelamat Lingkungan</p>
                <p class="text-lg font-semibold text-gray-700"><?= $kategoriData->total_penyelamat; ?></p>
              </div>
            </div>
          </a>
          <a href="/admin/arsippenerima">
            <div class="flex items-center p-4 bg-white shadow rounded-lg">
              <img src="/images/kategorid.jpg" class="w-1/4 mr-4">
              <div>
                <p class="mb-1 md:mb-2 text-sm font-medium text-gray-600">Pembina Lingkungan</p>
                <p class="text-lg font-semibold text-gray-700"><?= $kategoriData->total_pembina; ?></p>
              </div>
            </div>
          </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-1 bg-white shadow rounded-lg p-4 md:p-6">
            <h2 class="text-lg md:text-xl font-semibold mb-4">Pamflet</h2>
            <div>
                <div class="w-full h-full md:h-64 flex items-center justify-center relative text-gray-500">
                  <?php if (!empty($pamflet)): ?>
                      <img class="h-full" src="<?= base_url('admin/preview/pamflet/' . rawurlencode(esc($pamflet['foto']))) ?>">

                      <?php if ($pamflet['status'] === 'Nonaktif'): ?>
                          <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white">
                              <span class="text-lg font-semibold">Pamflet Nonaktif</span>
                          </div>
                  <?php endif; ?>
              </div>
            </div>
            <div class="relative my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full ">
              <div class="p-4">
                <h5 class="mb-2 flex flex-col text-slate-800 text-xl items-center font-semibold">
                  Edit Pamflet
                </h5>
                  <a href="/admin/editpamflet/<?= ($pamflet['id_flayer']) ?>">
                    <button class="rounded-md bg-primary py-2 px-4 mt-6 border border-transparent text-center text-sm text-white w-full transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                      Edit
                    </button>
                  </a>
                <?php else: ?>
                  <p>Data pamflet tidak tersedia.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="lg:col-span-2 bg-white shadow rounded-lg p-4 md:p-6">
            <h2 class="text-lg md:text-xl font-semibold mb-4">Data Calon</h2>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead>
                  <tr class="text-gray-500 text-xs md:text-sm">
                    <th class="px-2 md:px-4 py-2 text-left">Kode Registrasi</th>
                    <th class="px-2 md:px-4 py-2 text-left">Nama</th>
                    <th class="px-2 md:px-4 py-2 text-left">Kategori</th>
                    <th class="px-2 md:px-4 py-2 text-left">Provinsi</th>
                    <th class="px-2 md:px-4 py-2 text-left">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($calon)): ?>
                    <?php foreach ($calon as $index => $item): ?>
                      <tr class="<?= $index % 2 == 0 ? 'bg-gray-50' : '' ?> text-xs md:text-sm">
                        <td class="px-2 md:px-4 py-2"><?= esc($item['kode_registrasi']) ?></td>
                        <td class="px-2 md:px-4 py-2"><?= esc($item['nama']) ?></td>
                        <td class="px-2 md:px-4 py-2"><?= esc($item['kategori']) ?></td>
                        <td class="px-2 md:px-4 py-2"><?= esc($item['provinsi']) ?></td>
                        <td class="px-2 md:px-4 py-2"><?= esc($item['status_pendaftaran']) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5" class="px-2 md:px-4 py-2 text-center">Tidak ada data calon.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <div class="row flex lg:justify-end justify-center my-6 lg:me-2 me-0">
              <div class="pagination">
                <?= $pager->links('calon', 'template_pagination') ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>

</body>

</html>