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
                Tambah Calon Usulan
            </h4>
            <div class="flex bg-yellow-400 items-center justify-center rounded-md">
                <svg class="lg:ml-0 ml-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <h3 class="block text-sm font-semibold p-2 text-black">
                    Silahkan pilih kategori penghargaan sesuai dengan calon yang Anda Usulkan
                </h3>
            </div>

            <div class="lg:my-12 md:my-8 my-4">
                <div id="texttentangkalpataru" class="w-full relative flex items-center justify-center">
                    <h2 class="text-2xl font-semibold text-black mb-2 text-center">Kategori Penghargaan Kalpataru</h2>
                </div>
                <hr class="border-[1.5px] border-primary max-w-40 mx-auto" />
            </div>

            <!-- Form untuk Kategori -->
            <form id="kategoriForm" method="POST" action="/pengusul/tambahcalon">
                <input type="hidden" name="id_pengusul" value="<?= $id_pengusul ?>">
                <input type="hidden" id="kategoriInput" name="kategori" value="">

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <img src="/images/kategoria.jpg" alt="perintis" class="w-full h-auto rounded-2xl cursor-pointer transition-transform transform duration-200 ease-in-out" onclick="selectImage(this, 'Perintis Lingkungan')">
                    <img src="/images/kategorib.jpg" alt="pengabdi" class="w-full h-auto rounded-2xl cursor-pointer transition-transform transform duration-200 ease-in-out" onclick="selectImage(this, 'Pengabdi Lingkungan')">
                    <img src="/images/kategoric.jpg" alt="penyelamat" class="w-full h-auto rounded-2xl cursor-pointer transition-transform transform duration-200 ease-in-out" onclick="selectImage(this, 'Penyelamat Lingkungan')">
                    <img src="/images/kategorid.jpg" alt="pembina" class="w-full h-auto rounded-2xl cursor-pointer transition-transform transform duration-200 ease-in-out" onclick="selectImage(this, 'Pembina Lingkungan')">
                </div>

                <div class="flex justify-between mt-4 items-center">
                    <div class="mt-4">
                        <a href="/pengusul/usulansaya"
                            class="text-sm font-bold text-gray-600 no-underline focus:outline-none">
                            <span class="font-bold text-lg items-center">←</span> Kembali
                        </a>
                    </div>
                    <!-- <p id="validationMessage" class="text-sm text-red-500 mr-4 hidden">Silahkan pilih kategori terlebih dahulu</p> -->
                    <button id="selanjutnyaBtn" class="mt-4 w-32 rounded-md py-2 px-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:bg-gray-400 disabled:shadow-none" type="submit" disabled onclick="checkSelection()">Selanjutnya</button>
                </div>

            </form>

        </div>

    </div>

    <script>
        let selectedImage = null;

        function selectImage(imageElement, kategori) {
            // Hapus tanda dari gambar sebelumnya jika ada
            if (selectedImage) {
                selectedImage.classList.remove('border-4', 'border-accepted', 'shadow-lg', 'scale-110');
            }

            // Tambahkan tanda ke gambar yang dipilih dan perbesar gambar
            imageElement.classList.add('border-4', 'border-accepted', 'shadow-lg', 'scale-110');

            // Set gambar yang dipilih menjadi elemen baru yang dipilih
            selectedImage = imageElement;

            // Set kategori yang dipilih di input tersembunyi
            document.getElementById('kategoriInput').value = kategori;

            // Aktifkan tombol "Selanjutnya"
            document.getElementById('selanjutnyaBtn').disabled = false;

            // Sembunyikan pesan validasi
            document.getElementById('validationMessage').classList.add('hidden');
        }

        // Tambahkan event listener untuk submit form
        document.getElementById('kategoriForm').addEventListener('submit', function(event) {
            if (!selectedImage) {
                // Jika kategori belum dipilih, tampilkan pesan validasi dan hentikan pengiriman form
                event.preventDefault();
                document.getElementById('validationMessage').classList.remove('hidden');
            }
        });
    </script>


    <?= $this->endSection() ?>

</body>

</html>