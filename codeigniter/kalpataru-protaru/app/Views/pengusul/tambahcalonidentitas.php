<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?= $this->extend('template/navbarfooter') ?>
    <?= $this->section('content') ?>

    <div class="flex flex-col lg:flex-row justify-center m-4">
        <?= $this->include('template/sidebarpengusul') ?>
        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <h4 class="block text-xl font-bold text-slate-800 mb-2">
                Formulir Identitas Calon Usulan
            </h4>

            <?php if ($kategori == 'Penyelamat Lingkungan'): ?>
                <form id="identitasc" action="simpancalonidentitas" method="post" class="mt-4 mb-2 w-full" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <p class="font-semibold mb-2 text-md text-primary underline">Data Kelompok/ Komunitas</p>
                            <div>
                                <label class="block mb-2 text-sm text-black">Nama Kelompok</label>
                                <input type="text" name="nama_kelompok" value="<?= old('nama_kelompok') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.nama_kelompok')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.nama_kelompok') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="tahun_pembentukan" class="block mb-2 text-sm text-black">Tahun Berdiri Kelompok</label>
                                <input type="date" name="tahun_pembentukan" value="<?= old('tahun_pembentukan') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.tahun_pembentukan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.tahun_pembentukan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Jumlah Anggota</label>
                                <input type="number" name="jumlah_anggota" value="<?= old('jumlah_anggota') ?>" min="1" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.jumlah_anggota')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.jumlah_anggota') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Alamat</label>
                                <input type="text" name="jalan" value="<?= old('jalan') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.jalan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.jalan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">RT/RW</label>
                                <input type="text" name="rt_rw" value="<?= old('rt_rw') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.rt_rw')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.rt_rw') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Provinsi</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="provinsi" onchange="loadKabupaten(); setNamaProvinsi()" name="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <input type="hidden" id="nama_provinsi" name="nama_provinsi">
                                <?php if (session('errors.provinsi')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.provinsi') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kab/Kota</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="kabupaten" onchange="loadKecamatan(); setNamaKabupaten()" disabled name="kab_kota">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                                <input type="hidden" id="nama_kabupaten" name="nama_kabupaten">
                                <?php if (session('errors.kab_kota')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.kab_kota') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kecamatan</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="kecamatan" onchange="loadKelurahan(); setNamaKecamatan()" disabled name="kecamatan">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <input type="hidden" id="nama_kecamatan" name="nama_kecamatan">
                                <?php if (session('errors.kecamatan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.kecamatan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kelurahan/Desa</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="kelurahan" onchange="setNamaKelurahan()" disabled name="desa">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                                <input type="hidden" id="nama_kelurahan" name="nama_kelurahan">
                                <?php if (session('errors.desa')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.desa') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kode Pos</label>
                                <input type="text" name="kode_pos" value="<?= old('kode_pos') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.kode_pos')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.kode_pos') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Media Sosial (Opsional)</label>
                                <input type="text" name="media_sosial" value="<?= old('media_sosial') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.media_sosial')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.media_sosial') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Unggah Surat Legalitas Kelompok <span class="text-primary">(PDF, max 1MB)</span></label>
                                <input id="suratpengantar" name="legalitas" type="file" accept="application/pdf"
                                    class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                <?php if (session('errors.legalitas')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.legalitas') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black" for="tanggal_legalitas">Tanggal Surat Legalitas Kelompok</label>
                                <input type="date" name="tanggal_legalitas" value="<?= old('tanggal_legalitas') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.tanggal_legalitas')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.tanggal_legalitas') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div class="space-y-4">
                            <p class="font-semibold mb-2 text-md text-primary underline">Data Ketua / Anggota Kelompok</p>
                            <div>
                                <label class="block mb-2 text-sm text-black">Nama Lengkap Ketua/ Anggota Kelompok</label>
                                <input type="text" name="nama" value="<?= old('nama') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.nama')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.nama') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">NIK</label>
                                <input type="number" name="nik" value="<?= old('nik') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.nik')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.nik') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.tempat_lahir')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.tempat_lahir') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.tanggal_lahir')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.tanggal_lahir') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Usia</label>
                                <input type="number" name="usia" value="<?= old('usia') ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.usia')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.usia') ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm text-black" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="lg:flex gap-6">
                                    <div class="flex items-center py-2">
                                        <input name="jenis_kelamin" type="radio" value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' ?> class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="perempuan">
                                        <label class="ml-2 text-black cursor-pointer text-sm" for="perempuan">Perempuan</label>
                                    </div>
                                    <div class="flex items-center py-2">
                                        <input name="jenis_kelamin" type="radio" value="Laki-Laki" <?= old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' ?> class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="laki-laki">
                                        <label class="ml-2 text-black cursor-pointer text-sm" for="laki-laki">Laki-Laki</label>
                                    </div>
                                </div>
                                <?php if (session('errors.jenis_kelamin')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.jenis_kelamin') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Pekerjaan</label>
                                <input type="text" name="pekerjaan" value="<?= old('pekerjaan') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.pekerjaan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.pekerjaan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Nomor Telepon</label>
                                <input type="number" name="telepon" value="<?= old('telepon') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.telepon')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.telepon') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Email</label>
                                <input type="email" name="email" value="<?= old('email') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.email')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.email') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan" value="<?= old('pendidikan') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.pendidikan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.pendidikan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="ktp" class="block mb-2 text-sm text-black">Unggah KTP <span class="text-primary">(JPG/JPEG, max 1MB)</span></label>
                                <input type="file" name="ktp" id="ktp" accept=".jpg,.jpeg" class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                <?php if (session('errors.ktp')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.ktp') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="/pengusul/tambahcalon"
                            class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
                            <span class="font-bold text-lg items-center">←</span> Kembali
                        </a>
                        <button id="saveButton" class="mt-4 w-32 rounded-md py-2 px-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">Simpan</button>
                    </div>
                </form>

            <?php else: ?>
                <form id="identitasabd" class="mt-4 mb-2 w-full" action="simpancalonidentitas" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Kolom kiri -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">Nama Lengkap</label>
                                <input type="text" name="nama" value="<?= old('nama') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.nama')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.nama') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">NIK</label>
                                <input type="text" name="nik" value="<?= old('nik') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.nik')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.nik') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.tempat_lahir')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.tempat_lahir') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.tanggal_lahir')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.tanggal_lahir') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Usia</label>
                                <input type="number" name="usia" value="<?= old('usia') ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.usia')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.usia') ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm text-black" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="lg:flex gap-6">
                                    <div class="flex items-center py-2">
                                        <input name="jenis_kelamin" type="radio" value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' ?> class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="perempuan">
                                        <label class="ml-2 text-black cursor-pointer text-sm" for="perempuan">Perempuan</label>
                                    </div>
                                    <div class="flex items-center py-2">
                                        <input name="jenis_kelamin" type="radio" value="Laki-Laki" <?= old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' ?> class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="laki-laki">
                                        <label class="ml-2 text-black cursor-pointer text-sm" for="laki-laki">Laki-Laki</label>
                                    </div>
                                </div>
                                <?php if (session('errors.jenis_kelamin')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.jenis_kelamin') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Pekerjaan</label>
                                <input type="text" name="pekerjaan" value="<?= old('pekerjaan') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.pekerjaan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.pekerjaan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Nomor Telepon</label>
                                <input type="number" name="telepon" value="<?= old('telepon') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.telepon')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.telepon') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Email</label>
                                <input type="email" name="email" value="<?= old('email') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.email')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.email') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan" value="<?= old('pendidikan') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.pendidikan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.pendidikan') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Kolom kanan -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-black">Alamat</label>
                                <input type="text" name="jalan" value="<?= old('jalan') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.jalan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.jalan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">RT/RW</label>
                                <input type="text" name="rt_rw" value="<?= old('rt_rw') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.rt_rw')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.rt_rw') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Provinsi</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="provinsi" onchange="loadKabupaten(); setNamaProvinsi()" name="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <input type="hidden" id="nama_provinsi" name="nama_provinsi">
                                <?php if (session('errors.provinsi')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.provinsi') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kab/Kota</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="kabupaten" onchange="loadKecamatan(); setNamaKabupaten()" disabled name="kab_kota">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                                <input type="hidden" id="nama_kabupaten" name="nama_kabupaten">
                                <?php if (session('errors.kab_kota')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.kab_kota') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kecamatan</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="kecamatan" onchange="loadKelurahan(); setNamaKecamatan()" disabled name="kecamatan">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <input type="hidden" id="nama_kecamatan" name="nama_kecamatan">
                                <?php if (session('errors.kecamatan')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.kecamatan') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kelurahan/Desa</label>
                                <select class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow"
                                    id="kelurahan" onchange="setNamaKelurahan()" disabled name="desa">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                                <input type="hidden" id="nama_kelurahan" name="nama_kelurahan">
                                <?php if (session('errors.desa')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.desa') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Kode Pos</label>
                                <input type="text" name="kode_pos" value="<?= old('kode_pos') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.kode_pos')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.kode_pos') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm text-black">Media Sosial (Opsional)</label>
                                <input type="text" name="media_sosial" value="<?= old('media_sosial') ?>" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <?php if (session('errors.media_sosial')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.media_sosial') ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="ktp" class="block mb-2 text-sm text-black">Unggah KTP <span class="text-primary">(JPG/JPEG, max 1MB)</span></label>
                                <input type="file" name="ktp" id="ktp" accept=".jpg,.jpeg" class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                <?php if (session('errors.ktp')): ?>
                                    <p class="text-red-500 text-sm mt-2"><?= session('errors.ktp') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="/pengusul/tambahcalon"
                            class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
                            <span class="font-bold text-lg items-center">←</span> Kembali
                        </a>
                        <!-- <button class="mt-4 w-32 rounded-md py-2 px-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">Simpan</button> -->
                        <button id="saveButton" class="mt-4 w-32 rounded-md py-2 px-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">Simpan</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalPopup" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
            <img src="/images/question.png" alt="Question Icon" class="w-16 h-16 mb-4">
            <p class="text-center text-lg font-bold text-gray-700 mb-4">Apakah anda yakin ingin menyimpan data kategori dan identitas calon?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelButton" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 hover:text-white rounded-md">Periksa Kembali</button>
                <button id="confirmButton" class="px-4 py-2 bg-primary hover:bg-primaryhover text-white rounded-md">Ya, Simpan</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const saveButton = document.getElementById('saveButton');
            const modalPopup = document.getElementById('modalPopup');
            const cancelButton = document.getElementById('cancelButton');
            const confirmButton = document.getElementById('confirmButton');
            const formc = document.getElementById('identitasc');
            const formabd = document.getElementById('identitasabd');

            saveButton.addEventListener('click', () => {
                modalPopup.classList.remove('hidden');
            });

            cancelButton.addEventListener('click', () => {
                modalPopup.classList.add('hidden');
            });

            confirmButton.addEventListener('click', () => {
                modalPopup.classList.add('hidden');
                formc.submit();
            });
            confirmButton.addEventListener('click', () => {
                modalPopup.classList.add('hidden');
                formabd.submit();
            });
        });
    </script>

    <?= $this->endSection() ?>
</body>

</html>