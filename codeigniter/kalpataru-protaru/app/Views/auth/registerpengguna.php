<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        body {
            overflow-y: auto;
        }

        .flex-1 {
            height: 130vh;
        }

        .password-icon {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .error-message {
            color: red;
            font-size: 0.8rem;
            margin-top: -12px;
            margin-bottom: 12px;
            display: none;
        }

        .success-message {
            color: green;
            font-size: 0.8rem;
            margin-top: 12px;
            margin-bottom: 12px;
        }

        @media (max-width: 640px) {
            .max-w-md {
                max-width: 90%;
            }

            .flex-1 {
                height: 120vh;
            }
        }

        .captcha-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .captcha-image {
            font-weight: bold;
            font-size: 1.2rem;
            background-color: #f3f3f3;
            padding: 5px 10px;
            border-radius: 5px;
            letter-spacing: 3px;
        }
    </style>
</head>

<body>
    <div class="flex h-screen">
        <div class="flex-1 relative hidden sm:block">
            <img id="backgroundImage" src="/images/loginregist1.jpeg" alt="loginregist1"
                class="w-full h-full object-cover fade-in-right">
        </div>

        <div class="flex-1 flex items-center justify-center bg-white h-screen sm:h-auto">
            <div class="w-full max-w-md p-6 fade-in-left">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Daftar</h2>
                <form action="/register" id="registerForm" method="post" class="flex flex-col">
                    <?= csrf_field() ?>
                    <label for="nama" class="text-xs">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text"
                        class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none"
                        placeholder="Masukan nama lengkap" required>
                    <div class="text-red-500" id="namaError"></div>
                    <label for="email" class="text-xs">Email <span class="text-primary">(Pastikan Email Aktif)</span></label>
                    <input id="email" name="email" type="email"
                        class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none"
                        placeholder="Masukkan Email Aktif" required>
                    <div class="text-red-500" id="emailError"></div>
                    <label for="password" class="text-xs">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" name="password" type="password"
                            class="block w-full border-2 border-gray-300 text-primary text-xs rounded-lg p-2 pr-10 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none"
                            placeholder="Masukkan Kata Sandi" required>
                        <span id="togglePassword" class="password-icon">
                            <img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">
                        </span>
                    </div>
                    <div class="text-red-500" id="passwordRealtimeError"></div>

                    <div class="flex items-center justify-between flex-wrap">
                        <p class="text-gray-900 text-xs">
                            Sudah punya akun? <a href="./login" class="text-primary hover:underline font-bold">Masuk Sekarang</a>
                        </p>
                    </div>

                    <button type="submit"
                        class="bg-secondary text-primary font-bold py-2 px-4 rounded-md mt-4 hover:bg-primary hover:text-white transition ease-in-out duration-150">
                        Daftar
                    </button>
                </form>

                <div class="mt-4">
                    <button onclick="window.history.back()"
                        class="text-sm font-bold text-gray-400 no-underline focus:outline-none">
                        <span class="font-bold text-lg items-center">←</span> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
            <img src="/images/sukses.png" alt="Success Icon" class="w-16 h-16 mb-4">
            <h2 class="text-center text-lg font-bold text-primary mb-2">Verifikasi Akun!</h2>
            <p class="text-center text-sm text-slate-600 mb-4">Kami sudah mengirimkan kode verifikasi ke alamat email Anda, silakan cek kotak masuk dan folder spam atau sampah.</p>
            <button id="successBtn" class="bg-primary text-white py-2 px-4 rounded-lg">Oke</button>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const passwordRealtimeError = document.getElementById('passwordRealtimeError');
        let isPasswordVisible = false;

        togglePassword.addEventListener('click', () => {
            isPasswordVisible = !isPasswordVisible;
            passwordInput.type = isPasswordVisible ? 'text' : 'password';
            togglePassword.innerHTML = isPasswordVisible ?
                `<img src="/images/show.svg" alt="show" class="w-4 h-4 mb-4">` :
                `<img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">`;
        });

        function validatePasswordRealtime() {
            const password = passwordInput.value;
            let errorMessage = '';

            if (password.length < 8) {
                errorMessage = 'Kata sandi harus minimal 8 karakter.';
            } else if (!/[A-Z]/.test(password)) {
                errorMessage = 'Kata sandi harus mengandung minimal satu huruf besar.';
            } else if (!/[a-z]/.test(password)) {
                errorMessage = 'Kata sandi harus mengandung minimal satu huruf kecil.';
            } else if (!/[!@#$%^&*_-]/.test(password)) {
                errorMessage = 'Kata sandi harus mengandung minimal satu karakter khusus (!@#$%^&*_-).';
            }
            passwordRealtimeError.textContent = errorMessage;
        }
        passwordInput.addEventListener('input', validatePasswordRealtime);

        function validateForm(event) {
            event.preventDefault();
            const form = document.getElementById('registerForm');
            const formData = new FormData(form);

            document.getElementById('namaError').textContent = '';
            document.getElementById('emailError').textContent = '';
            passwordRealtimeError.textContent = '';

            fetch(form.action, {
                    method: form.method,
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('successModal').classList.remove('hidden');
                        document.getElementById('successBtn').addEventListener('click', function() {
                            window.location.href = '/login';
                        });
                    } else {
                        if (data.messages.nama) {
                            document.getElementById('namaError').textContent = data.messages.nama;
                        }
                        if (data.messages.email) {
                            document.getElementById('emailError').textContent = data.messages.email;
                        }
                        if (data.messages.password) {
                            passwordRealtimeError.textContent = data.messages.password;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menyimpan data. Silakan coba lagi nanti.');
                });
        }
        document.getElementById('registerForm').addEventListener('submit', validateForm);
    </script>
</body>

</html>