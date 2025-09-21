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
    <?= $this->include('template/sidebarpenerima') ?>

    <!-- Konten utama -->
    <div class="relative flex flex-col w-full lg:max-w-5xl mb-4 gap-4">
      <div class="border-2 border-primary bg-white rounded-xl shadow-md p-4">
        <h4 class="block text-xl font-bold text-slate-800 mb-2">
          Profil
        </h4>
        <div class="flex gap-4">
          <!-- Nama Individu -->
          <div class="w-full">
            <label class="block mb-2 text-sm text-black">Nama Individu</label>
            <input type="text" value="<?= session()->get('nama') ?>" disabled class="w-full border-2 border-slate-200 text-slate-800 text-xs rounded-lg p-2" />
          </div>

          <!-- Email -->
          <div class="w-full">
            <label class="block mb-2 text-sm text-black">Email</label>
            <input type="text" value="<?= session()->get('email') ?>" disabled class="w-full border-2 border-slate-200 text-slate-800 text-xs rounded-lg p-2" />
          </div>
        </div>
      </div>

      <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
      </div>
    </div>

  </div>

  <?= $this->endSection() ?>
</body>

</html>