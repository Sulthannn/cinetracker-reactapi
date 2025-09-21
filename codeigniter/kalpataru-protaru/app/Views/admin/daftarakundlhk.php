<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <title>Registrasi Akun DLHK</title>
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
            <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
                <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Daftar Akun DLHK</h1>
                <div class="flex items-center">
                    <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
                    <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="relative flex flex-col w-full lg:max-w-5xl mb-4 rounded-xl border-2 border-primary mt-4 bg-white shadow-md lg:p-8 p-4">

                <form action="/admin/daftarakundlhk" class="mt-4 mb-2 w-full" method="post" id="profil-form" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Kolom kiri -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">Nama Instansi</label>
                                <input type="text" name="instansi" id="instansi" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Email Instansi</label>
                                <input type="email" name="email" id="email" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" required />
                                <p id="email-hint" class="text-red-500 text-xs hidden">Email harus menggunakan @gmail.com</p>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kata Sandi</label>
                                <div class="relative">
                                    <input type="password" name="kata_sandi" id="password" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" required />
                                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <img id="passwordIcon" src="/images/hide.svg" class="h-5 w-5 text-gray-500" alt="Password Icon">
                                    </button>
                                </div>
                                <p id="password-hint" class="text-red-500 text-xs hidden">Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan karakter spesial.</p>
                            </div>


                        </div>

                        <!-- Kolom kanan -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">No HP</label>
                                <input type="number" name="telepon" id="telepon" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" required />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm text-black">Pilih Provinsi</label>

                                <select name="provinsi" id="provinsi" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" required>
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    <?php foreach ($provinsi_list as $provinsi) { ?>
                                        <option value="<?php echo $provinsi; ?>"><?php echo $provinsi; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="grid gap-1 mb-2">
                                <label for="surat_pengantar" class="text-xs">Surat Pengantar <span class="text-primary">(.pdf)</span></label>

                                <div class="flex items-center">
                                </div>
                                <input id="surat_pengantar" type="file" accept="application/pdf" name="surat_pengantar"
                                    class="border-2 border-gray-300 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                            </div>

                        </div>

                        <!-- Tombol Paling Bawah di Mobile -->
                        <div class="md:col-span-2 flex justify-between items-center">
                            <!-- Tombol Kembali -->
                            <a href="/admin/akundlhk"
                                class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start">
                                <span class="font-bold text-lg items-center">←</span> Kembali
                            </a>

                            <!-- Tombol Daftarkan Akun -->
                            <button id="uploadBtn" class="mt-4 w-full md:w-32 rounded-md py-2 px-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit" disabled>
                                Daftarkan Akun
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div id="uploadModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
                    <img src="/images/sukses.png" alt="Success Icon" class="w-16 h-16 mb-4">
                    <h2 class="text-center text-lg font-bold text-primary mb-2">Akun Berhasil Didaftaran</h2>
                    <a href="/admin/akundlhk">
                        <button id="closeModalBtn" class="bg-primary text-white py-2 px-4 rounded-lg">OK</button>
                    </a>
                </div>
            </div>


            <script>
                // Modal and functionality
                const uploadBtn = document.getElementById('uploadBtn');
                const uploadModal = document.getElementById('uploadModal');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const form = document.getElementById('profil-form');

                // Handle form submission with fetch (AJAX)
                form.addEventListener('submit', async (event) => {
                    event.preventDefault(); // Prevent immediate form submission

                    // Show modal when form is valid and button is clicked
                    uploadModal.classList.remove('hidden');

                    // Prepare form data to be sent
                    const formData = new FormData(form);

                    try {
                        // Send form data using fetch (AJAX)
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData
                        });

                        // Check if the response is OK
                        if (response.ok) {
                            // Show success modal
                            uploadModal.classList.remove('hidden');
                        } else {
                            const errorText = await response.text();
                            alert('Error: ' + errorText); // Show error in case of failure
                        }
                    } catch (error) {
                        alert('Error occurred: ' + error.message);
                    }
                });

                // Close modal button functionality
                closeModalBtn.addEventListener('click', () => {
                    uploadModal.classList.add('hidden');
                    // You can optionally reset the form or do something else here
                });

                // Check if all inputs are filled
                const inputs = document.querySelectorAll('input');

                inputs.forEach(input => {
                    input.addEventListener('input', checkFormValidity);
                });

                function checkFormValidity() {
                    const isValid = [...inputs].every(input => input.value.trim() !== '') &&
                        validateEmail(document.getElementById('email').value) &&
                        validatePassword(document.getElementById('password').value);
                    uploadBtn.disabled = !isValid;
                }

                function validateEmail(email) {
                    const emailHint = document.getElementById('email-hint');
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    const isGmail = email.toLowerCase().endsWith('@gmail.com');
                    const isValid = re.test(email) && isGmail;

                    if (!isValid) {
                        emailHint.classList.remove('hidden');
                    } else {
                        emailHint.classList.add('hidden');
                    }

                    return isValid;
                }

                function validatePassword(password) {
                    const passwordHint = document.getElementById('password-hint');
                    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&./\-_])[A-Za-z\d@$!%*?&.,/\-_]{8,}$/;
                    const isValid = re.test(password);

                    if (!isValid) {
                        passwordHint.classList.remove('hidden');
                    } else {
                        passwordHint.classList.add('hidden');
                    }

                    return isValid;
                }

                // Show/Hide Password functionality
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('password');
                const passwordIcon = document.getElementById('passwordIcon');

                togglePassword.addEventListener('click', () => {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    passwordIcon.src = type === 'password' ? '/images/hide.svg' : '/images/show.svg';
                });
            </script>
        </div>
    </div>
</body>

</html>