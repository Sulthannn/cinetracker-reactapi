<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        /* Responsive style */
        @media (max-width: 640px) {
            .max-w-md {
                max-width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="flex h-screen">
        <div class="flex-1 relative hidden sm:block">
            <img id="backgroundImage" src="/images/loginregist1.jpeg" alt="loginregist1" class="w-full h-full object-cover">
        </div>

        <div class="flex-1 flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-6">

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Verifikasi Akun Anda</h2>
                <form class="flex flex-col" id="verifyForm" action="/verify" method="POST">
                    <label for="email" class="text-xs">Email</label>
                    <input id="email" type="text" name="email" required class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan Email">
                    <div id="emailError" class="text-red-500 text-xs mb-2"></div> <!-- Elemen untuk pesan error -->

                    <label for="kode_verifikasi" class="text-xs">Kode Verifikasi</label>
                    <input id="kode_verifikasi" type="text" name="kode_verifikasi" required class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan kode verifikasi">
                    <div id="kodeError" class="text-red-500 text-xs mb-2"></div> <!-- Elemen untuk pesan error -->

                    <button type="submit" class="bg-secondary text-primary font-bold py-2 px-4 rounded-md mt-4 hover:bg-primary hover:text-white transition ease-in-out duration-150">
                        Verifikasi
                    </button>
                </form>

                <div class="mt-4 flex items-center justify-between">
                    <button onclick="window.history.back()"
                        class="text-sm font-bold text-gray-400 no-underline focus:outline-none">
                        <span class="font-bold text-lg items-center">←</span> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="successPopup" class="toasthidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-green-700 text-center text-white p-6 rounded-lg max-w-md w-full">
            <h3 class="text-xl font-bold mb-4">Verifikasi Berhasil!</h3>
            <p class="text-sm">Akun Anda telah berhasil di verifikasi, silahkan login menggunakan email dan kata sandi yang terdaftar</p>
            <button id="successBtn" class="mt-4 px-4 py-2 bg-green-300 text-green-900 rounded-md hover:bg-green-400 transition">Oke</button>
        </div>
    </div>

    <script>
        document.getElementById('verifyForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form secara default

            // Kosongkan pesan error sebelumnya
            document.getElementById('emailError').textContent = '';
            document.getElementById('kodeError').textContent = '';

            const form = event.target;
            const formData = new FormData(form); // Buat FormData dari form yang disubmit

            fetch(form.action, {
                    method: form.method,
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tampilkan pesan berhasil
                        document.getElementById('successPopup').classList.remove('hidden');
                        document.getElementById('successBtn').addEventListener('click', function() {
                            window.location.href = '/login';
                        });
                    } else {
                        // Tampilkan pesan error
                        if (data.message.includes('Email')) {
                            document.getElementById('emailError').textContent = data.message;
                        } else {
                            document.getElementById('kodeError').textContent = data.message;
                        }
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat menghubungi server.');
                });
        });
    </script>
</body>

</html>