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

  <!-- Main Content -->
  <div class="lg:flex-1 p-6">
    <div class="min-h-screen flex flex-col">

      <!-- Header -->
      <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
          <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Tambah Video</h1>
          <div class="flex items-center">
            <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
            <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
          </div>
        </div>
      </header>

      <!-- Main Content -->
      <div class="mt-4 relative flex flex-col w-full  mx-auto mb-4 border-2 border-primary bg-white shadow-md lg:p-8">
        <!-- Cards Summary -->
        <form id="isiVideoForm" action="/admin/tambah-video" method="POST" class="mt-4 mb-2 w-full">
          <div class="grid grid-cols-1 gap-4" id="formContainer">
            <div>
              <label class="block mb-2 text-sm text-black">Judul Video</label>
              <input type="text" name="judul" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
              <div class="text-red-500" id="judulError"></div> <!-- Menampilkan pesan kesalahan judul -->
            </div>
            <div>
              <label class="block mb-2 text-sm text-black">Tautan</label>
              <input type="text" name="link" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
              <div class="text-red-500" id="linkError"></div> <!-- Menampilkan pesan kesalahan tautan -->
            </div>

          </div>

          <div class="flex justify-between mt-4">
            <a href="/admin/video"
              class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start">
              <span class="font-bold text-lg items-center">←</span> Kembali
            </a>
            <button id="uploadBtn" class="w-40 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none" type="submit">Unggah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
      <img src="/images/sukses.png" alt="Success Icon" class="w-16 h-16 mb-4">
      <h2 class="text-center text-lg font-bold text-primary mb-2">Video berhasil ditambahkan!</h2>
      <p class="text-center text-sm text-slate-600 mb-4">Status video Anda masih ditangguhkan, silahkan ubah status ke Terbit agar video bisa muncul di website.</p>
      <button id="successBtn" class="bg-primary text-white py-2 px-4 rounded-lg">Lihat Status</button>
    </div>
  </div>

  <script>
    // Modal functionality
    const successModal = document.getElementById('successModal');
    const successBtn = document.getElementById('successBtn');

    // Fungsi validasi form
    function validateForm(event) {
      event.preventDefault();

      // Mengambil elemen form dan membuat FormData
      const form = document.getElementById('isiVideoForm');
      const formData = new FormData(form);

      // Membersihkan error sebelumnya
      document.getElementById('judulError').textContent = '';
      document.getElementById('linkError').textContent = '';

      // Mengirim request POST menggunakan Fetch API
      fetch(form.action, {
          method: form.method,
          body: formData,
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Jika berhasil, tampilkan modal sukses
            const successModal = document.getElementById('successModal');
            successModal.classList.remove('hidden');

            // Arahkan ke halaman berita admin ketika tombol "Oke" diklik
            document.getElementById('successBtn').addEventListener('click', function() {
              window.location.href = '/admin/video'; // Ganti dengan URL yang sesuai
            });
          } else {
            // Jika gagal, tampilkan pesan error dari controller
            if (data.messages.judul) {
              document.getElementById('judulError').textContent = data.messages.judul;
            }
            if (data.messages.konten) {
              document.getElementById('linkError').textContent = data.messages.konten;
            }
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }

    // Attach event listener ke form submit
    document.getElementById('isiVideoForm').addEventListener('submit', validateForm);

    successBtn.addEventListener('click', () => {
      successModal.classList.add('hidden');
    });
  </script>

</body>

</html>