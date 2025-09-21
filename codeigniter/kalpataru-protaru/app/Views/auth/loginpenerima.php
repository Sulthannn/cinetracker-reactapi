<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title><?= $title; ?></title>
    <style>
        /* images */
        /*  @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-in-right {
            animation: fadeInRight 0.5s forwards;
        }

        .fade-in-left {
            animation: fadeInLeft 0.5s forwards;
        } */

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

        .toasthidden {
            display: none;
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

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Masuk</h2>
                <form class="flex flex-col" onsubmit="validateForm(event)" action="/auth/loginpenerima" method="POST">
                    <label for="email" class="text-xs">Email</label>
                    <input id="email" type="text" name="email" required
                        class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none"
                        placeholder="Masukkan Email">

                    <label for="password" class="text-xs">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" type="password" name="kata_sandi" required
                            class="block w-full border-2 border-gray-300 text-primary text-xs rounded-lg p-2 pr-10 mb-4 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none"
                            placeholder="Masukkan Kata Sandi">
                        <span id="togglePassword" class="password-icon absolute inset-y-0 right-2 flex items-center">
                            <img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">
                        </span>
                    </div>

                    <div class="flex items-center justify-between flex-wrap">
                        <p class="text-gray-900 text-xs">
                            <a href="./forgot-password" class="text-primary hover:underline font-bold">Lupa Kata Sandi?</a>
                        </p>
                    </div>

                    <button type="submit"
                        class="bg-secondary text-primary font-bold py-2 px-4 rounded-md mt-4 hover:bg-primary hover:text-white transition ease-in-out duration-150">
                        Masuk
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

    <div id="toast" class="toast">Email atau password salah!</div>

    <script>
        // Toggle password visibility
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        let isPasswordVisible = false;

        togglePassword.addEventListener('click', () => {
            isPasswordVisible = !isPasswordVisible;
            const type = isPasswordVisible ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Update the icon
            togglePassword.innerHTML = isPasswordVisible ?
                `<img src="/images/show.svg" alt="show" class="w-4 h-4 mb-4">` :
                `<img src="/images/hide.svg" alt="hide" class="w-4 h-4 mb-4">`;
        });

        function validateForm(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: form.method,
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect ke halaman yang diinginkan
                        window.location.href = '/penerima/dashboard'; // Sesuaikan dengan URL tujuan setelah login
                    } else {
                        showToast(data.errors.email || data.errors.kata_sandi || 'Login gagal.'); // Tampilkan pesan kesalahan
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan. Silakan coba lagi');
                });
        }




        // Show toast with custom message
        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show-toast');
            setTimeout(() => {
                toast.classList.remove('show-toast');
            }, 3000);
        }
    </script>
</body>

</html>