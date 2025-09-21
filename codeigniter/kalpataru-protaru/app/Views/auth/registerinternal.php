<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title><?= $title; ?></title>
    <style>
        body {
            overflow-y: auto;
        }

        .flex-1 {
            height: 100vh;
        }

        /* toast error */
        .toast {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #800000;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }

        .show-toast {
            display: block;
        }

        /* Show/hide password */
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

        /* Responsive style */
        @media (max-width: 640px) {
            .max-w-md {
                max-width: 90%;
            }

            .flex-1 {
                height: 120vh;
            }
        }

        /* toast hidden */
        .toasthidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="flex h-screen">
        <div class="flex-1 relative hidden sm:block">
            <img id="backgroundImage" src="/images/loginregist2.jpeg" alt="loginregist2"
                class="w-full h-full object-cover fade-in-right">
        </div>

        <div class="flex-1 flex items-center justify-center bg-white h-screen sm:h-auto">
            <div class="w-full max-w-md p-6 fade-in-left">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Daftar</h2>
                <form id="registerForm" action="/auth/registerinternal" method="post" onsubmit="validateForm(event)" class="flex flex-col">
                    <?= csrf_field() ?>

                    <label for="nip" class="text-xs">NIP</label>
                    <input id="nip" name="nip" type="number" class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan NIP">

                    <label for="nama" class="text-xs">Nama</label>
                    <input id="nama" name="nama" type="text" class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan Nama Lengkap">

                    <label for="no_sk" class="text-xs">No. SK</label>
                    <input id="no_sk" name="no_sk" type="text" class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan Nomor SK">

                    <label for="email" class="text-xs">Email <span class="text-primary">(Pastikan Email Aktif)</span></label>
                    <input id="email" name="email" type="email" class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan Email Aktif">

                    <label for="kata_sandi" class="text-xs">Kata Sandi</label>
                    <div class="relative">
                        <input id="kata_sandi" name="kata_sandi" type="password" class="block w-full border-2 border-gray-300 text-primary text-xs rounded-lg p-2 pr-10 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan Kata Sandi">
                        <span id="togglePassword" class="password-icon">
                            <img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">
                        </span>
                    </div>
                    <small id="passwordError" class="error-message">Kata sandi harus minimal 8 karakter, termasuk huruf kecil, huruf besar, dan simbol.</small>

                    <label for="passwordcheck" class="text-xs">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input id="passwordcheck" name="passwordcheck" type="password" class="block w-full border-2 border-gray-300 text-primary text-xs rounded-lg p-2 pr-10 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan Konfirmasi Kata Sandi">
                        <span id="togglePasswordCheck" class="password-icon">
                            <img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">
                        </span>
                    </div>
                    <small id="passwordCheckError" class="error-message">Konfirmasi kata sandi tidak cocok.</small>

                    <div class="flex items-center justify-between flex-wrap">
                        <p class="text-gray-900 text-xs">
                            Sudah punya akun? <a href="./logininternal" class="text-primary hover:underline font-bold">Masuk Sekarang</a>
                        </p>
                    </div>

                    <button type="submit" class="bg-secondary text-primary font-bold py-2 px-4 rounded-md mt-4 hover:bg-primary hover:text-white transition ease-in-out duration-150">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="toast" class="toast"></div>
    <script>
        // Toggle password visibility
        const passwordInput = document.getElementById('kata_sandi');
        const togglePassword = document.getElementById('togglePassword');
        const passwordCheckInput = document.getElementById('passwordcheck');
        const togglePasswordCheck = document.getElementById('togglePasswordCheck');
        const passwordError = document.getElementById('passwordError');
        const passwordCheckError = document.getElementById('passwordCheckError');

        let isPasswordVisible = false;
        let isPasswordCheckVisible = false;

        // Toggle password visibility
        togglePassword.addEventListener('click', () => {
            isPasswordVisible = !isPasswordVisible;
            passwordInput.type = isPasswordVisible ? 'text' : 'password';
            togglePassword.innerHTML = isPasswordVisible ?
                `<img src="/images/show.svg" alt="show" class="w-4 h-4 mb-4">` :
                `<img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">`;
        });

        // Toggle password visibility for password confirmation
        togglePasswordCheck.addEventListener('click', () => {
            isPasswordCheckVisible = !isPasswordCheckVisible;
            passwordCheckInput.type = isPasswordCheckVisible ? 'text' : 'password';
            togglePasswordCheck.innerHTML = isPasswordCheckVisible ?
                `<img src="/images/show.svg" alt="show" class="w-4 h-4 mb-4">` :
                `<img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">`;
        });

        // Form validation
        function validateForm(event) {
            event.preventDefault();

            const nip = document.getElementById('nip').value;
            const nama = document.getElementById('nama').value;
            const sk = document.getElementById('no_sk').value;
            const email = document.getElementById('email').value;
            const kata_sandi = document.getElementById('kata_sandi').value;
            const passwordCheck = document.getElementById('passwordcheck').value;

            let isValid = true;
            let passwordErrors = [];

            if (isValid) {
                const form = document.getElementById('registerForm');
                const formData = new FormData(form);

                fetch(form.action, {
                        method: form.method,
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast('Pendaftaran berhasil!');
                            setTimeout(() => {
                                window.location.href = '/';
                            }, 3000);
                        } else {
                            let errorMessage = '';
                            for (const [key, value] of Object.entries(data.errors)) {
                                errorMessage += `${value}\n`; // Menggabungkan pesan kesalahan
                            }
                            showToast(errorMessage); // Menampilkan semua kesalahan
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    });

            }
        }

        // Realtime validation for password
        passwordInput.addEventListener('input', () => {
            const kata_sandi = passwordInput.value;
            let passwordErrors = [];

            // Check for length
            if (kata_sandi.length < 8) {
                passwordErrors.push('Kata sandi harus minimal 8 karakter.');
            }

            // Check for lowercase letters
            if (!/[a-z]/.test(kata_sandi)) {
                passwordErrors.push('Kata sandi harus mengandung setidaknya satu huruf kecil.');
            }

            // Check for uppercase letters
            if (!/[A-Z]/.test(kata_sandi)) {
                passwordErrors.push('Kata sandi harus mengandung setidaknya satu huruf besar.');
            }

            // Check for special characters
            const specialCharacters = /[!@#$%^&*_-]/;
            if (!specialCharacters.test(kata_sandi)) {
                passwordErrors.push('Kata sandi harus mengandung setidaknya satu simbol (!@#$%^&*_-).');
            }

            if (passwordErrors.length > 0) {
                passwordError.innerHTML = passwordErrors.join('<br>');
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }
        });

        // Realtime validation for password confirmation
        passwordCheckInput.addEventListener('input', () => {
            if (passwordInput.value === passwordCheckInput.value) {
                passwordCheckError.style.display = 'none';
            } else {
                passwordCheckError.style.display = 'block';
            }
        });

        // Fungsi untuk menampilkan toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show-toast');
            setTimeout(() => {
                toast.classList.remove('show-toast');
            }, 3000);
        }

        // Fungsi untuk menampilkan popup sukses
        function showPopup() {
            const successPopup = document.getElementById('successPopup');
            successPopup.classList.remove('toasthidden');
        }
    </script>

</body>

</html>