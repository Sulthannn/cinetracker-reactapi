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

        <!-- Konten utama -->
        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <h4 class="block text-xl font-bold text-slate-800 mb-2">
                Tambah Artikel
            </h4>
            <form id="isiArtikelForm" class="mt-4 mb-2 w-full" action="/pengusul/tambah-artikel" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-4" id="formContainer">
                    <div>
                        <label class="block mb-2 text-sm text-black">Judul Artikel</label>
                        <input required id="judul" type="text" name="judul" class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2">
                        <div class="text-red-500" id="judulError"></div> <!-- Menampilkan pesan kesalahan judul -->
                    </div>
                    <div>
                        <label class="block mb-2 text-sm text-black">Isi Artikel</label>
                        <textarea required id="konten" name="konten" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                            oninput="updateWordCount(this, 'artikelCount', 1000)"></textarea>
                        <p id="artikelCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                        <div class="text-red-500" id="kontenError"></div> <!-- Menampilkan pesan kesalahan -->
                    </div>
                    <div>
                        <label class="block mb-2 text-sm text-black">Unggah Foto Artikel (.jpg/jpeg/png)</label>
                        <input id="foto" name="foto" type="file" accept="image/*" class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2">
                        <div class="text-red-500" id="fotoError"></div> <!-- Menampilkan pesan kesalahan foto -->
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="w-40 rounded-md py-2 text-center text-sm text-white bg-primary hover:bg-primaryhover">Unggah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
            <img src="/images/sukses.png" alt="Success Icon" class="w-16 h-16 mb-4">
            <h2 class="text-center text-lg font-bold text-primary mb-2">Terima kasih telah mengunggah artikel!</h2>
            <p class="text-center text-sm text-slate-600 mb-4">Artikel anda sedang dalam proses validasi. Anda dapat mengecek status artikel anda pada menu “Artikel Saya”.</p>
            <button id="successBtn" class="bg-primary text-white py-2 px-4 rounded-lg">Lihat Status</button>
        </div>
    </div>

    <script>
        // Batasan Kata
        function updateWordCount(textarea, countId, maxWords) {
            const countElement = document.getElementById(countId);
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            const currentLength = words.length;

            countElement.textContent = `${currentLength}/${maxWords} kata`;

            if (currentLength > maxWords) {
                countElement.classList.add('text-rejected');
            } else {
                countElement.classList.remove('text-rejected');
            }
        }

        // Modal functionality
        const successModal = document.getElementById('successModal');
        const successBtn = document.getElementById('successBtn');

        // Fungsi validasi form
        function validateForm(event) {
            event.preventDefault();

            // Mengambil elemen form dan membuat FormData
            const form = document.getElementById('isiArtikelForm');
            const formData = new FormData(form);

            // Membersihkan error sebelumnya
            document.getElementById('judulError').textContent = '';
            document.getElementById('kontenError').textContent = '';
            document.getElementById('fotoError').textContent = '';

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

                        // Arahkan ke halaman artikel admin ketika tombol "Oke" diklik
                        document.getElementById('successBtn').addEventListener('click', function() {
                            window.location.href = '/pengusul/artikel-saya'; // Ganti dengan URL yang sesuai
                        });
                    } else {
                        // Jika gagal, tampilkan pesan error dari controller
                        if (data.messages.judul) {
                            document.getElementById('judulError').textContent = data.messages.judul;
                        }
                        if (data.messages.konten) {
                            document.getElementById('kontenError').textContent = data.messages.konten;
                        }
                        if (data.messages.foto) {
                            document.getElementById('fotoError').textContent = data.messages.foto;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
        }

        // Attach event listener ke form submit
        document.getElementById('isiArtikelForm').addEventListener('submit', validateForm);


        // Attach event listener ke form submit
        document.getElementById('isiArtikelForm').addEventListener('submit', validateForm);


        // Attach event listener ke form submit
        document.getElementById('isiArtikelForm').addEventListener('submit', validateForm);

        successBtn.addEventListener('click', () => {
            successModal.classList.add('hidden');
        });
    </script>

    <?= $this->endSection() ?>
</body>

</html>