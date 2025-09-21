<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Arsip Penerima</title>
</head>

<body class="lg:flex">

    <!-- Sidebar -->
    <div class="w-64 bg-white text-white">
        <?= $this->include('template/sidebaradmin') ?>
    </div>

    <!-- Main Content -->
    <div class="lg:flex-1 p-6">
        <div class="min-h-screen flex flex-col">

            <header class="bg-white shadow">
                <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Arsip Penerima</h1>
                    <div class="flex items-center">
                        <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
                        <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <div class="relative flex flex-col w-full lg:max-w-5xl mb-4 rounded-xl border-2 border-primary mt-4 bg-white shadow-md lg:p-8 p-4">

                <form action="/admin/tambaharsippenerima" class="mt-4 mb-2 w-full" method="post" id="ArsipForm" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Kolom kiri -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">Nama Penerima</label>
                                <input required type="text" name="nama" id="nama" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="namaError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Usia</label>
                                <input required type="number" name="usia" id="usia" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="usiaError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Jenis Kelamin</label>
                                <select required name="jenis_kelamin" id="jenisKelamin" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow">
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                <div class="text-red-500" id="jenisKelaminError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">No HP Penerima</label>
                                <input required type="number" name="telepon" id="telepon" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="teleponError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Email Penerima</label>
                                <input required type="text" name="email" id="email" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="emailError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Tahun Penerimaan</label>
                                <input required type="date" name="tahun_penerimaan" id="tahun" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="tahunError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" required>
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    <?php foreach ($provinsi_list as $provinsi) { ?>
                                        <option value="<?php echo $provinsi; ?>"><?php echo $provinsi; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-red-500" id="provinsiError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kab/Kota (saat menerima)</label>
                                <input required type="text" name="kabupaten" id="kabupaten" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="kabupatenError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kecamatan (saat menerima)</label>
                                <input required type="text" name="kecamatan" id="kecamatan" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="kecamatanError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Desa (saat menerima)</label>
                                <input required type="text" name="desa" id="desa" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="desaError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 mt-2 text-sm text-black">Profil Singkat (Penerima dan Kegiatan)</label>
                                <textarea name="profil" id="profil" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" rows="10"></textarea>
                                <div class="text-red-500" id="profilError"></div>
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">Nama Pengusul/DLH Terkait</label>
                                <input required type="text" name="nama_pengusul" id="namaPengusul" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="namaPengusulError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Instansi Pengusul/DLH Terkait</label>
                                <input required type="text" name="instansi_pengusul" id="instansiPengusul" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="instansiPengusulError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Email Pengusul/DLH Terkait</label>
                                <input required type="text" name="email_pengusul" id="emailPengusul" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="emailPengusulError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Jabatan Pengusul/DLH Terkait</label>
                                <input required type="text" name="jabatan_pengusul" id="jabatanPengusul" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="jabatanPengusulError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">No HP Pengusul/DLH Terkait</label>
                                <input required type="number" name="telepon_pengusul" id="teleponPengusul" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="teleponPengusullError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Slogan</label>
                                <input required type="text" name="slogan" id="slogan" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="sloganError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kategori</label>
                                <select required name="kategori" id="kategori" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Perintis Lingkungan">Perintis Lingkungan</option>
                                    <option value="Pengabdi Lingkungan">Pengabdi Lingkungan</option>
                                    <option value="Penyelamat Lingkungan">Penyelamat Lingkungan</option>
                                    <option value="Pembina Lingkungan">Pembina Lingkungan</option>
                                </select>
                                <div class="text-red-500" id="kategoriError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Tema</label>
                                <select required name="tema" id="tema" class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease">
                                    <option value="" disabled selected>Pilih Tema</option>
                                    <option value="keanekaragaman_hayati">Keanekaragaman Hayati</option>
                                    <option value="perubahan_iklim">Perubahan Iklim</option>
                                    <option value="pencemaran_kerusakan_lingkungan">Pencemaran dan Kerusakan Lingkungan</option>
                                    <option value="hukum_budaya">Hukum dan Budaya</option>
                                </select>
                                <div class="text-red-500" id="temaError"></div>
                            </div>

                            <div class="mt-2">
                                <label class="block mb-2 text-sm text-black">Sub Tema</label>
                                <select required name="subtema" id="subtema" class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" disabled>
                                    <option value="" disabled selected>Pilih Subtema</option>
                                </select>
                                <div class="text-red-500" id="subtemaError"></div>
                            </div>


                            <div>
                                <label class="block mb-2 text-sm text-black">Dokumentasi (link gdrive)</label>
                                <input required type="text" name="link_dokumentasi" id="link_dokumentasi" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <div class="text-red-500" id="linkError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Bentuk Kegiatan</label>
                                <input required type="text" name="bentuk_kegiatan" id="bentuk_kegiatan" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2  transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" rows="4"></i>
                                <div class="text-red-500" id="kegiatanError"></div>
                            </div>
                            <div class="mt-2">
                                <label class="block mb-2 text-sm text-black">Status</label>
                                <select required name="status" id="status" class="w-full placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                                <div class="text-red-500" id="statusError"></div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Unggah Foto Penerima (.jpg/jpeg)</label>
                                <input id="foto" name="foto_profil" type="file" accept="image/jpeg, image/jpg" class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2">
                                <div class="text-red-500" id="fotoError"></div>
                            </div>
                        </div>

                        <!-- Tombol Paling Bawah di Mobile -->
                        <div class="md:col-span-2 flex justify-between items-center">
                            <!-- Tombol Kembali -->
                            <a href="/admin/arsippenerima"
                                class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start">
                                <span class="font-bold text-lg items-center">←</span> Kembali
                            </a>

                            <!-- Tombol Daftarkan Akun -->
                            <button class="mt-4 w-full md:w-32 rounded-md py-2 px-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
                                Tambahkan Arsip
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
            <img src="/images/sukses.png" alt="Success Icon" class="w-16 h-16 mb-4">
            <h2 class="text-center text-lg font-bold text-primary mb-2">Arsip penerima berhasil ditambahkan!</h2>
            <button id="successBtn" class="bg-primary text-white py-2 px-4 rounded-lg">Oke</button>
        </div>
    </div>
    <script>
        // Modal functionality
        const successModal = document.getElementById('successModal');
        const successBtn = document.getElementById('successBtn');
        const form = document.getElementById('ArsipForm');

        // Sub tema options for each tema
        const subTemaOptions = {
            keanekaragaman_hayati: [
                'Pelestarian Keanekaragaman Hayati dan Kawasan Dilindungi yang Meliputi Pelestarian Sumber Daya Genetik, Jenis, dan Ekosistem',
                'Pemanfaatan Keanekaragaman Hayati Secara Berkelanjutan',
                'Jasa Lingkungan',
            ],
            perubahan_iklim: [
                'Adaptasi Perubahan Iklim',
                'Mitigasi Perubahan Iklim',
                'Penerapan Ekonomi Hijau dan Ekonomi Biru',
            ],
            pencemaran_kerusakan_lingkungan: [
                'Penanganan Pencemaran Air, Tanah, Udara Dari Industri, Pertanian, Domestik Terutama Plastik',
                'Pencegahan dan Penanggulangan Kerusakan Lingkungan',
                'Ekonomi Sirkular ',
            ],
            hukum_budaya: [
                'Keadilan Terhadap Pemanfaatan Sumber Daya Alam dan Lingkungan',
                'Kearifan Tradisional Dalam Pengelolaan Sumber Daya Alam',
                'Komunikasi dan Pendidikan Lingkungan Hidup',
            ],
        };

        // Update sub tema options based on selected tema
        document.getElementById('tema').addEventListener('change', function() {
            const selectedTema = this.value;
            const subtemaSelect = document.getElementById('subtema');
            subtemaSelect.innerHTML = '<option value="" disabled selected>Pilih Subtema</option>';
            if (subTemaOptions[selectedTema]) {
                subTemaOptions[selectedTema].forEach(subTema => {
                    const option = document.createElement('option');
                    option.value = subTema.toLowerCase().replace(/\s+/g, '_');
                    option.textContent = subTema;
                    subtemaSelect.appendChild(option);
                });
                subtemaSelect.disabled = false;
            } else {
                subtemaSelect.disabled = true;
            }
        });

        // Fungsi validasi form
        function validateForm(event) {
            event.preventDefault();
            const formData = new FormData(form);

            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            // Mengirim request POST menggunakan Fetch API
            fetch(form.action, {
                    method: form.method,
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        successModal.classList.remove('hidden');
                        document.getElementById('successBtn').addEventListener('click', () => {
                            window.location.href = '/admin/arsippenerima'; // Ganti dengan URL yang sesuai
                        });
                    } else if (data.messages) {
                        // Tampilkan pesan error untuk setiap field yang ada di data.messages
                        for (const [field, message] of Object.entries(data.messages)) {
                            const errorElement = document.getElementById(`${field}Error`);
                            if (errorElement) {
                                errorElement.textContent = message;
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menyimpan data, silahkan coba lagi.');
                });
        }

        // Attach event listener ke form submit
        form.addEventListener('submit', validateForm);

        successBtn.addEventListener('click', () => {
            successModal.classList.add('hidden');
        });
    </script>

</body>

</html>