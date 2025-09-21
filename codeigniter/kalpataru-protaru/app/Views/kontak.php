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
    <div class="max-w-5xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="border-2 border-footer">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Left Section (Contact Information) -->
                <div class="bg-footer p-8 text-white">
                    <h2 class="text-2xl font-bold mb-2 flex justify-center">Kontak Kami</h2>
                    <hr class="border-2 border-white w-1/4 mx-auto">
                    <div class="grid  grid-rows-3 gap-x-2">
                        <!-- TELEPON -->
                        <div class="flex items-center">
                            <img src="/images/phone.svg" alt="phone" class="h-6 w-6 mr-2">
                            <div class="ml-4">
                                <span class="font-semibold">TELEPON</span>
                                <p class="text-sm">021-5701109</p>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="flex items-center">
                            <img src="/images/mail.svg" alt="mail" class="h-6 w-6 mr-2">
                            <div class="ml-4">
                                <span class="font-semibold">EMAIL</span>
                                <p class="underline text-sm">kalpataru@menlhk.go.id</p>
                            </div>
                        </div>

                        <!-- LOKASI -->
                        <div class="flex items-center">
                            <img src="/images/location.svg" alt="location" class="h-6 w-6 mr-2">
                            <div class="ml-4">
                                <span class="font-semibold">LOKASI</span>
                                <p class="text-sm">Gedung Manggala Wanabakti Blok IV, Lantai 6, Wings B, Jl. Gatot Subroto, Senayan, Jakarta Pusat, 10270, Indonesia</p>
                            </div>
                        </div>
                        <div class="ml-12 mt-2">
                            <iframe class="w-full h-40 md:w-96 md:h-48"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4354811880426!2d106.79589797499023!3d-6.2061464937816915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f15686ca29a1%3A0xed7fb816ccc5dbf5!2sManggala%20Wanabakti!5e0!3m2!1sen!2sid!4v1727858044898!5m2!1sen!2sid"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                    </div>
                </div>


                <!-- Right Section (Contact Form) -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-2 flex justify-center">Kontak Kami</h2>
                    <hr class="border-2 border-footer w-1/4 mx-auto">
                    <form id="contactForm" class="mt-4" method="POST" onsubmit="return validateForm(event)">
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Instansi / Nama Pribadi</label>
                            <input type="text" name="nama" id="nama" placeholder="contoh: Kemitraan Lingkungan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" placeholder="contoh: johndoe@example.com" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="number" name="telepon" id="telepon" placeholder="contoh: 08xxxxxxxx" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan dan Saran</label>
                            <textarea name="pesan" id="pesan" rows="4" placeholder="Isi pesan dan saran Anda" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primaryhover text-white font-semibold py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">KIRIM</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Spinner (initially hidden) -->
    <div id="loadingSpinner" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="loader border-t-4 border-primary rounded-full w-16 h-16 animate-spin"></div>
    </div>

    <style>
        /* Loader Style */
        .loader {
            border-top-color: #3490dc;
            border-radius: 50%;
            width: 4rem;
            height: 4rem;
            border-width: 6px;
            border-style: solid;
            border-color: #f3f3f3 #f3f3f3 #f3f3f3 #3490dc;
            animation: spin 1s linear infinite;
        }

        /* Keyframe for spinning */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>


    <script>
        // Fungsi validasi form dan pengiriman data
        function validateForm(event) {
            event.preventDefault(); // Mencegah form submit langsung

            let nama = document.getElementById('nama').value.trim();
            let email = document.getElementById('email').value.trim();
            let telepon = document.getElementById('telepon').value.trim();
            let pesan = document.getElementById('pesan').value.trim();

            if (!nama) {
                showToast('Silahkan lengkapi nama instansi / nama pribadi', 'error');
                return false;
            }

            if (!email) {
                showToast('Silahkan lengkapi email Anda', 'error');
                return false;
            }

            let emailPattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
            if (!emailPattern.test(email)) {
                showToast('Format email tidak valid', 'error');
                return false;
            }

            if (!telepon) {
                showToast('Silahkan lengkapi nomor telepon Anda', 'error');
                return false;
            }

            if (!pesan) {
                showToast('Silahkan isi pesan dan saran Anda', 'error');
                return false;
            }

            // Tampilkan popup konfirmasi sebelum mengirim
            showConfirmationPopup(nama, email, telepon, pesan);
        }

        // Fungsi untuk menampilkan popup konfirmasi
        function showConfirmationPopup(nama, email, telepon, pesan) {
            let confirmationDialog = document.createElement('div');
            confirmationDialog.className = 'fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50';

            confirmationDialog.innerHTML = `
        <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
        <img src="/images/question.png" alt="Question Icon" class="w-16 h-16 mb-4">
            <p class="text-center text-lg font-bold text-gray-700 mb-4">Apakah Anda yakin ingin mengirimkan pesan ini?</p>
            <div class="flex justify-end space-x-4">
                <button class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 hover:text-white rounded-md" id="cancelButton">Batal</button>
                <button class="px-4 py-2 bg-primary hover:bg-primaryhover text-white rounded-md" id="confirmButton">Ya Kirim</button>
            </div>
        </div>
    `;

            document.body.appendChild(confirmationDialog);

            // Jika tombol "Batal" ditekan, hapus popup dan batalkan pengiriman
            document.getElementById('cancelButton').addEventListener('click', function() {
                confirmationDialog.remove();
            });

            // Jika tombol "Ya Kirim" ditekan, kirim email dan tutup popup
            document.getElementById('confirmButton').addEventListener('click', function() {
                confirmationDialog.remove();
                sendEmail(nama, email, telepon, pesan); // Kirim email
            });
        }

        // Show loading spinner
        function showLoading() {
            document.getElementById('loadingSpinner').classList.remove('hidden');
        }

        // Hide loading spinner
        function hideLoading() {
            document.getElementById('loadingSpinner').classList.add('hidden');
        }

        // Modified sendEmail function with loading spinner
        function sendEmail(nama, email, telepon, pesan) {
            showLoading(); // Show loading spinner

            fetch('/kontak/sendEmail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        nama: nama,
                        email: email,
                        telepon: telepon,
                        pesan: pesan
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    hideLoading(); // Hide loading spinner

                    if (data.success) {
                        showToast('Terima kasih, pesan Anda telah terkirim!', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        showToast('Pesan gagal dikirim: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideLoading(); // Hide loading spinner
                    showToast('Gagal mengirim pesan.', 'error');
                });
        }

        // Fungsi untuk menampilkan toast
        function showToast(message, type) {
            let toast = document.createElement('div');
            toast.className = `
        fixed top-32 right-4 px-4 py-2 rounded-md shadow-lg text-white
        ${type === 'success' ? 'bg-primary' : 'bg-rejected'}
    `;
            toast.innerText = message;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>

    <?= $this->endSection() ?>


</body>

</html>