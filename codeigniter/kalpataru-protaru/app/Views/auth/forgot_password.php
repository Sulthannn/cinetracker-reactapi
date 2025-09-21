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

        /* Responsive style */
        @media (max-width: 640px) {
            .max-w-md {
                max-width: 90%;
            }
        }

        .toasthidden {
            display: none;
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

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Lupa Kata Sandi</h2>
                <form action="/auth/forgot-password" method="POST" class="flex flex-col">
                    <label for="email" class="text-xs">Email:</label>
                    <input type="email" id="email" name="email" required class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none"
                        placeholder="Masukkan Email">
                    <button type="submit" class="bg-secondary text-primary font-bold py-2 px-4 rounded-md mt-4 hover:bg-primary hover:text-white transition ease-in-out duration-150">Kirim Link Reset</button>
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

    <?php if (session()->getFlashdata('reset_link_sent')) : ?>
        <div id="successPopup" class="toastshow fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="bg-green-700 text-center text-white p-6 rounded-lg max-w-md w-full">
                <h3 class="text-xl font-bold mb-4">Link Reset Password Terkirim!</h3>
                <p class="text-sm">Silakan cek email atau spam email Anda untuk melakukan reset kata sandi</p>
                <button onclick="window.location.href='/'" class="mt-4 px-4 py-2 bg-green-300 text-green-900 rounded-md hover:bg-green-400 transition">
                    OK
                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('email_not_found')) : ?>
        <div class="toast show-toast">
            Email tidak ditemukan.
        </div>
    <?php endif; ?>


</body>

</html>