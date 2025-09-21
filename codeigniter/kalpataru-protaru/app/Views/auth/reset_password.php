<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title><?= $title; ?></title>
    <style>
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

        /* Responsive style */
        @media (max-width: 640px) {
            .max-w-md {
                max-width: 90%;
            }
        }

        .error {
            border-color: red;
        }

        .error-message {
            color: red;
            display: none;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        .toastshow {
            display: block;
        }
        #successPopup {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="flex h-screen">
        <div class="flex-1 relative hidden sm:block">
            <img id="backgroundImage" src="/images/loginregist1.jpeg" alt="loginregist1"
                class="w-full h-full object-cover fade-in-right">
        </div>

        <div class="flex-1 flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-6 fade-in-left">

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Atur Ulang Kata Sandi</h2>
                <form id="resetPasswordForm" action="/auth/reset-password" method="POST" class="flex flex-col">
                    <input type="hidden" name="token" value="<?= $token; ?>">
                    <label for="kata_sandi" class="text-xs">Kata Sandi Baru:</label>
                    <div class="relative">
                        <input type="password" id="kata_sandi" name="kata_sandi" required class="w-full border-2 border-gray-300 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Masukkan Kata Sandi Baru" />
                        <span id="togglePassword" class="password-icon absolute inset-y-0 right-2 flex items-center">
                            <img src="/images/hide.svg" alt="hide" class="w-4 h-4">
                        </span>
                    </div>
                    <div id="passwordError" class="error-message"></div>

                    <label for="passwordcheck" class="text-xs mt-4">Konfirmasi Kata Sandi:</label>
                    <div class="relative">
                        <input type="password" id="passwordcheck" name="passwordcheck" required class="w-full border-2 border-gray-300 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none" placeholder="Konfirmasi Kata Sandi" />
                        <span id="togglePasswordCheck" class="password-icon">
                            <img src="/images/hide.svg" alt="hide" class="w-4 h-4">
                        </span>
                    </div>
                    <div id="passwordCheckError" class="error-message">Konfirmasi kata sandi tidak cocok.</div>

                    <button type="submit" class="bg-secondary text-primary font-bold py-2 px-4 rounded-md mt-4 hover:bg-primary hover:text-white transition ease-in-out duration-150">Atur Ulang Kata Sandi</button>
                </form>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('invalid_token')) : ?>
        <div class="toast show-toast">
            Token tidak valid.
        </div>
    <?php endif; ?>

    <script>
        const passwordInput = document.getElementById('kata_sandi');
        const togglePassword = document.getElementById('togglePassword');
        const passwordCheckInput = document.getElementById('passwordcheck');
        const togglePasswordCheck = document.getElementById('togglePasswordCheck');
        const passwordError = document.getElementById('passwordError');
        const passwordCheckError = document.getElementById('passwordCheckError');

        let isPasswordVisible = false;
        let isPasswordCheckVisible = false;

        togglePassword.addEventListener('click', () => {
            isPasswordVisible = !isPasswordVisible;
            passwordInput.type = isPasswordVisible ? 'text' : 'password';
            togglePassword.innerHTML = isPasswordVisible ?
                `<img src="/images/show.svg" alt="show" class="w-4 h-4">` :
                `<img src="/images/hide.svg" alt="hide" class="w-4 h-4">`;
        });

        togglePasswordCheck.addEventListener('click', () => {
            isPasswordCheckVisible = !isPasswordCheckVisible;
            passwordCheckInput.type = isPasswordCheckVisible ? 'text' : 'password';
            togglePasswordCheck.innerHTML = isPasswordCheckVisible ?
                `<img src="/images/show.svg" alt="show" class="w-4 h-4">` :
                `<img src="/images/hide.svg" alt="hide" class="w-4 h-4">`;
        });

        passwordInput.addEventListener('input', () => {
            validatePassword();
        });

        passwordCheckInput.addEventListener('input', () => {
            validatePasswordCheck();
        });

        function validatePassword() {
            const kata_sandi = passwordInput.value;
            let passwordErrors = [];

            if (kata_sandi.length < 8) {
                passwordErrors.push('Kata sandi harus minimal 8 karakter.');
            }

            if (!/[a-z]/.test(kata_sandi)) {
                passwordErrors.push('Kata sandi harus mengandung setidaknya satu huruf kecil.');
            }

            if (!/[A-Z]/.test(kata_sandi)) {
                passwordErrors.push('Kata sandi harus mengandung setidaknya satu huruf besar.');
            }

            const specialCharacters = /[!@#$%^&*_-]/;
            if (!specialCharacters.test(kata_sandi)) {
                passwordErrors.push('Kata sandi harus mengandung setidaknya satu simbol (!@#$%^&*_-).');
            }

            if (passwordErrors.length > 0) {
                passwordError.innerHTML = passwordErrors.join('<br>');
                passwordError.style.display = 'block';
                passwordInput.classList.add('error');
            } else {
                passwordError.style.display = 'none';
                passwordInput.classList.remove('error');
            }
        }

        function validatePasswordCheck() {
            if (passwordInput.value === passwordCheckInput.value) {
                passwordCheckError.style.display = 'none';
                passwordCheckInput.classList.remove('error');
            } else {
                passwordCheckError.style.display = 'block';
                passwordCheckInput.classList.add('error');
            }
        }

        document.getElementById('resetPasswordForm').addEventListener('submit', (event) => {
            event.preventDefault();

            const isPasswordValid = passwordError.style.display === 'none';
            const isPasswordCheckValid = passwordCheckError.style.display === 'none';

            if (isPasswordValid && isPasswordCheckValid) {
                event.target.submit();
            }
        });

    </script>

</body>

</html>