<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body class="lg:flex">

    <!-- Sidebar -->
    <?= $this->include('template/sidebardppk') ?>

    <div class="lg:flex-1 p-6">
        <div class="min-h-screen flex flex-col">

            <!-- Header -->
            <header class="bg-white shadow">
                <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
                    <h1 class="text-xl font-bold text-slate-800 mb-2">Data Calon Usulan</h1>
                </div>
            </header>

            <!-- Main Content -->
            <div class="flex-1 container mx-auto">
                <div class="flex flex-col md:flex-row items-start space-x-0 md:space-x-4 space-y-4 md:space-y-0 mt-8">
                    <!-- Left side: Buttons -->
                    <div class="flex flex-col w-full md:w-auto">
                        <button id="identitasButton" class="w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button"
                            data-target="identitas-calon">Identitas Calon</button>
                        <button id="kegiatanButton" class="mt-2 w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button"
                            data-target="kegiatan-calon">Kegiatan Calon</button>
                        <button id="dampakButton" class="mt-2 w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button"
                            data-target="dampak">Dampak</button>
                        <button id="pmikButton" class="mt-2 w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button"
                            data-target="pmik">PMIK</button>
                        <button id="keswadayaanButton" class="mt-2 w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button"
                            data-target="keswadayaan">Keswadayaan dan Kebudayaan</button>
                        <button id="keistimewaanButton" class="mt-2 w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button" data-target="keistimewaan">Keistimewaan</button>

                        <!-- Button Kembali ke Data Calon Usulan Saya -->
                        <button onclick="window.history.back()"
                            class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
                            <span class="font-bold text-lg items-center">←</span> Kembali
                        </button>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <?php
                    $selectedCategory = 'a';
                    ?>
                    <?php if ($selectedCategory === 'c'): ?>
                        <div id="identitas-calon" class="form-section flex flex-col w-full rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                            <form id="identitasabd" class="mb-2 w-full">
                                <p class="font-semibold mb-2 text-md text-primary underline">Data Kelompok/ Komunitas</p>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Nama Kelompok</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Tahun Berdiri Kelompok</label>
                                    <input disabled type="date" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Jumlah Anggota</label>
                                    <input disabled type="number" min="1" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Alamat</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">RT/RW</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Desa/Kelurahan</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Kecamatan</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Kab/Kota</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Provinsi</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Kode Pos</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Media Sosial</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Unggah Surat Legalitas Kelompok <span class="text-primary">(.pdf)</span></label>
                                    <input disabled id="suratpengantar" type="file" accept="application/pdf"
                                        class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                </div>
                                <p class="mt-8 font-semibold mb-2 text-md text-primary underline">Data Ketua Kelompok/ Komunitas</p>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Nama Ketua</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">NIK</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Tempat Lahir</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Tanggal Lahir</label>
                                    <input disabled type="date" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Usia</label>
                                    <input disabled type="number" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full">
                                    <label class="block mb-2 text-sm text-black">Jenis Kelamin</label>
                                    <div class="lg:flex gap-6">
                                        <div class="flex items-center py-2 ">
                                            <input disabled name="jenis_kelamin" type="radio" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="perempuan">
                                            <label class="ml-2 text-black cursor-pointer text-sm" for="perempuan">Perempuan</label>
                                        </div>
                                        <div class="flex items-center py-2 ">
                                            <input disabled name="jenis_kelamin" type="radio" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="laki-laki">
                                            <label class="ml-2 text-black cursor-pointer text-sm" for="laki-laki">Laki-Laki</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Pekerjaan</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Nomor Telepon</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Email</label>
                                    <input disabled type="email" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Pendidikan Terakhir</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>

                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Unggah KTP <span class="text-primary">(.jpg/jpeg)</span></label>
                                    <input disabled id="ktp" type="file" accept="application/jpg,application/jpeg"
                                        class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Unggah SKCK <span class="text-primary">(.pdf)</span></label>
                                    <input disabled id="skck" type="file" accept="application/pdf"
                                        class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                </div>


                            </form>
                        </div>

                    <?php else: ?>
                        <div id="identitas-calon" class="form-section flex flex-col w-full rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                            <form id="identitasabd" class="mb-2 w-full">
                                <div class="w-full mb-2">
                                    <label class="mb-2 text-sm text-slate-600">Nama Lengkap</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-primary text-slate-700 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="mb-2 text-sm text-slate-600">NIK</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-primary text-slate-700 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="mb-2 text-sm text-slate-600">Tempat Lahir</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-primary text-slate-700 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="mb-2 text-sm text-slate-600">Tanggal Lahir</label>
                                    <input disabled type="date" class="w-full bg-transparent placeholder:text-primary text-slate-700 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="mb-2 text-sm text-slate-600">Usia</label>
                                    <input disabled type="number" class="w-full bg-transparent placeholder:text-primary text-slate-700 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Jenis Kelamin</label>
                                    <div class="lg:flex gap-6">
                                        <div class="flex items-center py-2 ">
                                            <input disabled name="jenis_kelamin" type="radio" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="perempuan">
                                            <label class="ml-2 text-black cursor-pointer text-sm" for="perempuan">Perempuan</label>
                                        </div>
                                        <div class="flex items-center py-2 ">
                                            <input disabled name="jenis_kelamin" type="radio" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary checked:bg-primary transition-all" id="laki-laki">
                                            <label class="ml-2 text-black cursor-pointer text-sm" for="laki-laki">Laki-Laki</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Pekerjaan</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Nomor Telepon</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Email</label>
                                    <input disabled type="email" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Pendidikan Terakhir</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Alamat</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">RT/RW</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Desa/Kelurahan</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Kecamatan</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Kab/Kota</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Provinsi</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Kode Pos</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">Media Sosial</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">KTP <span class="text-primary">(.jpg/jpeg)</span></label>
                                    <input disabled id="ktp" type="file" accept="application/jpg,application/jpeg"
                                        class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                </div>
                                <div class="w-full mb-2">
                                    <label class="block mb-2 text-sm text-black">SKCK <span class="text-primary">(.pdf)</span></label>
                                    <input disabled id="skck" type="file" accept="application/pdf"
                                        class="w-full border-2 border-slate-200 text-primary text-xs rounded-lg p-2 transition ease-in-out duration-150 focus:border-primary hover:border-primary focus:outline-none">
                                </div>


                            </form>
                        </div>
                    <?php endif; ?>

                    <!-- Right side: Form inside a card -->
                    <div id="kegiatan-calon" class="form-section hidden flex flex-col w-full rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="kegiatanForm" class="mb-2 w-full">

                            <div class="grid grid-cols-1 gap-4" id="formContainer">

                                <!-- Kolom kiri -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Tema Kegiatan</label>
                                        <select disabled id="tema-kegiatan" class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease">
                                            <option value="" disabled selected>Pilih Tema Kegiatan</option>
                                            <option value="keanekaragaman-hayati">Keanekaragaman Hayati</option>
                                            <option value="perubahan-iklim">Perubahan Iklim</option>
                                            <option value="pencemaran-dan-kerusakan-lingkungan">Pencemaran dan Kerusakan Lingkungan</option>
                                            <option value="hukum-dan-budaya">Hukum dan Budaya</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Sub Tema Kegiatan</label>
                                        <select disabled id="sub-tema-kegiatan" disabled class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease">
                                            <option value="" disabled selected>Pilih Sub Tema Kegiatan</option>
                                            <option value="pelestarian-keanekaragaman-hayati-kawasan-dilindungi-yang-meliputi-pelestarian-sumber-daya-genetik-jenis-dan-ekosistem">Pelestarian keanekaragaman hayati dan kawasan dilindungi yang meliputi pelestarian sumber daya genetik, jenis, dan ekosistem</option>
                                            <option value="pemanfaatan-keanekaragaman-hayati-berkelanjutan">Pemanfaatan keanekaragaman hayati secara berkelanjutan</option>
                                            <option value="jasa-lingkungan">Jasa lingkungan</option>
                                            <!-- Batas Keanekaragaman Hayati -->
                                            <option value="adaptasi-perubahan-iklim">Adaptasi perubahan iklim</option>
                                            <option value="mitigasi-perubahan-iklim">Mitigasi perubahan iklim</option>
                                            <option value="penerapan-ekonomi-hijau-biru">Penerapan ekonomi hijau dan ekonomi biru</option>
                                            <!-- Batas Perubahan Iklim -->
                                            <option value="penanganan-pencemaran-air-tanah-udara-yang-meliputi-industri-pertanian-domestik-terutama-plastik">Penanganan pencemaran air, tanah, udara dari industri, pertanian, domestik terutama plastik</option>
                                            <option value="pencegahan-dan-penanggulangan-kerusakan-lingkungan">Pencegahan dan penanggulangan kerusakan lingkungan</option>
                                            <option value="ekonomi-sirkular">Ekonomi sirkular</option>
                                            <!-- Batas Pencemaran dan Kerusakan Lingkungan -->
                                            <option value="keadilan-pemanfaatan-sumber-daya-alam-dan-lingkungan">Keadilan terhadap pemanfaatan sumber daya alam dan lingkungan</option>
                                            <option value="kearifan-tradisional-dalam-pengelolaan-sumber-daya-alam">Kearifan tradisional dalam pengelolaan sumber daya alam</option>
                                            <option value="komunikasi-pendidikan-lingkungan-hidup">Komunikasi dan pendidikan lingkungan hidup</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Bentuk Kegiatan</label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" />
                                        <!-- <select disabled id="jenisKegiatan" class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" onchange="toggleJenisLainnya()">
                                <option value="" disabled selected>Pilih Jenis Kegiatan</option>
                                <option value="konservasi-hutan">Konservasi Hutan</option>
                                <option value="konservasi-karst">Konservasi Karst</option>
                                <option value="mangrove">Mangrove</option>
                                <option value="konservasi-terumbu-karang">Konservasi Terumbu Karang</option>
                                <option value="konservasi-mata-air">Konservasi Mata Air</option>
                                <option value="konservasi-das">Konservasi DAS</option>
                                <option value="konservasi-kawasan-perairan">Konservasi Kawasan Perairan</option>
                                <option value="konservasi-satwa">Konservasi Satwa</option>
                                <option value="konservasi-tanaman">Konservasi Tanaman</option>
                                <option value="tanaman-obat">Tanaman Obat</option>
                                <option value="penanaman-tanaman-budidaya">Penanaman Tanaman Budidaya</option>
                                <option value="pengelolaan-hutan">Pengelolaan Hutan</option>
                                <option value="pengelolaan-budidaya-perairan">Pengelolaan Budidaya Perairan</option>
                                <option value="ekowisata">Ekowisata</option>
                                <option value="penyediaan-air-bersih">Penyediaan Air Bersih</option>
                                <option value="energi-terbarukan">Energi Terbarukan</option>
                                <option value="pemanfaatan-teknologi-ramah-lingkungan">Pemanfaatan Teknologi Ramah Lingkungan</option>
                                <option value="penghijauan">Penghijauan</option>
                                <option value="rehabilitasi-lahan-kritis">Rehabilitasi Lahan Kritis</option>
                                <option value="ruang-terbuka-hijau">Ruang Terbuka Hijau</option>
                                <option value="pertanian-ramah-lingkungan">Pertanian Ramah Lingkungan</option>
                                <option value="urban-farming">Urban Farming</option>
                                <option value="kawasan-peduli-lingkungan">Kawasan Peduli Lingkungan</option>
                                <option value="ketahanan-pangan">Ketahanan Pangan</option>
                                <option value="pemulihan-area-rusak-tercemar">Pemulihan Area Rusak dan Tercemar</option>
                                <option value="penanganan-bencana">Penanganan Bencana</option>
                                <option value="pengelolaan-sampah-limbah">Pengelolaan Sampah dan Limbah</option>
                                <option value="hutan-adat">Hutan Adat</option>
                                <option value="kearifan-lokal">Kearifan Lokal</option>
                                <option value="advokasi-lingkungan">Advokasi Lingkungan</option>
                                <option value="edukasi-lingkungan">Edukasi Lingkungan</option>
                                <option value="gerakan-aksi-lingkungan">Gerakan Aksi Lingkungan</option>
                                <option value="jenis-kegiatan-lainnya">Jenis Kegiatan Lainnya</option>
                            </select> -->
                                    </div>
                                    <!-- <div id="jenisLainnya" class="hidden">
                            <label class="block mb-2 text-sm text-black">Bentuk Kegiatan Lainnya</label>
                            <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" />
                        </div> -->
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Tahun Mulai Kegiatan</label>
                                        <input disabled type="date" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Penjelasan Kegiatan</label>
                                        <textarea disabled id="penjelasan" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                            oninput="updateWordCount(this, 'penjelasanCount', 1000)"></textarea>
                                        <p id="penjelasanCount" class="text-xs text-slate-400 flex justify-end ">0/1000 Kata</p>
                                    </div>
                                </div>

                                <!-- Kolom kanan -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Lokasi Kegiatan</label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Koordinat Lokasi Kegiatan</label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Para Pihak dan Perannya</label>
                                        <textarea disabled id="pihakPeran" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                            oninput="updateWordCount(this, 'pihakPeranCount', 1000)"></textarea>
                                        <p id="pihakPeranCount" class="text-xs text-slate-400 flex justify-end ">0/1000 Kata</p>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black">Keberhasilan yang Dicapai</label>
                                        <textarea disabled id="keberhasilan" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                            oninput="updateWordCount(this, 'keberhasilanCount', 1000)"></textarea>
                                        <p id="keberhasilanCount" class="text-xs text-slate-400 flex justify-end ">0/1000 kata</p>
                                    </div>

                                </div>
                            </div>


                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="dampak" class="form-section hidden flex flex-col w-full rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="dampakForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black">Dampak kegiatan terhadap lingkungan</label>
                                    <textarea disabled id="dampakLingkungan" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'dampakLingkunganCount', 1000)"></textarea>
                                    <p id="dampakLingkunganCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Dampak Ekonomi</label>
                                    <textarea disabled id="dampakEkonomi" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'dampakEkonomiCount', 1000)"></textarea>
                                    <p id="dampakEkonomiCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Dampak Sosial dan Budaya</label>
                                    <textarea disabled id="dampakSosial" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'dampakSosialCount', 1000)"></textarea>
                                    <p id="dampakSosialCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                            </div>


                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="pmik" class="form-section hidden flex flex-col w-full rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="pmikForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black">Prakarsa</label>
                                    <textarea disabled id="prakarsa" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'prakarsaCount', 1000)"></textarea>
                                    <p id="prakarsaCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Motivasi</label>
                                    <textarea disabled id="motivasi" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'motivasiCount', 1000)"></textarea>
                                    <p id="motivasiCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Inovasi</label>
                                    <textarea disabled id="inovasi" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'inovasiCount', 1000)"></textarea>
                                    <p id="inovasiCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Kreativitas</label>
                                    <textarea disabled id="kreativitas" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'kreativitasCount', 1000)"></textarea>
                                    <p id="kreativitasCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                            </div>


                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="keswadayaan" class="form-section hidden flex flex-col w-full rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="keswadayaanForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black">Sumber Pembiayaan Kegiatan</label>
                                    <textarea disabled id="sumber" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'sumberCount', 1000)"></textarea>
                                    <p id="sumberCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Teknologi/Alat/Fasilitas yang digunakan</label>
                                    <textarea disabled id="teknologi" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'teknologiCount', 1000)"></textarea>
                                    <p id="teknologiCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Status Lahan/Areal Kegiatan</label>
                                    <textarea disabled id="statusLahan" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'statusLahanCount', 1000)"></textarea>
                                    <p id="statusLahanCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Kelompok/Perorangan yang meniru</label>
                                    <textarea disabled id="kelompokPeroranganMeniru" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'kelompokPeroranganMeniruCount', 1000)"></textarea>
                                    <p id="kelompokPeroranganMeniruCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                            </div>


                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="keistimewaan" class="form-section hidden flex flex-col w-full rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="keistimewaanForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black">Keistimewaan Calon</label>
                                    <textarea disabled id="keistimewaanCalon" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'keistimewaanCalonCount', 1000)"></textarea>
                                    <p id="keistimewaanCalonCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Penghargaan relevan yang pernah diterima</label>
                                    <textarea disabled id="penghargaanRelevan" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'penghargaanRelevanCount', 1000)"></textarea>
                                    <p id="penghargaanRelevanCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black">Tautan Dokumen Pendukung (Google Drive)</label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Kolom 1 - Unggah Foto Kegiatan -->
                                    <div id="fotoContainer">
                                        <label class="block mb-2 text-sm text-black">Foto Kegiatan <span class="text-primary"> (.jpg/jpeg)</span></label>
                                        <div class="mb-4">
                                            <input disabled type="file" accept=".jpg, .jpeg" class="mb-2 w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                            <input disabled type="text" placeholder="Keterangan Foto" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                        </div>


                                    </div>

                                    <!-- Kolom 2 - Tautan Video -->
                                    <div id="videoContainer">
                                        <label class="block mb-2 text-sm text-black">Tautan Video</label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow mb-3" placeholder="Tautan Video" />
                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        // Right Side sesuai dengan yang di klik di left side
        // Ambil semua tombol di left side
        const buttons = document.querySelectorAll('.btn-section');
        // Ambil semua form section di right side
        const sections = document.querySelectorAll('.form-section');

        // Tambahkan event listener ke setiap tombol
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Sembunyikan semua form section
                sections.forEach(section => {
                    section.classList.add('hidden');
                });

                // Tampilkan form yang sesuai dengan tombol yang di klik
                const target = button.getAttribute('data-target');
                document.getElementById(target).classList.remove('hidden');
            });
        });


        // Jenis Kegiatan Lainnya
        /* function toggleJenisLainnya() {
            const jenisKegiatan = document.getElementById('jenisKegiatan');
            const jenisLainnya = document.getElementById('jenisLainnya');
            if (jenisKegiatan.value === 'jenis-kegiatan-lainnya') {
                jenisLainnya.classList.remove('hidden');
            } else {
                jenisLainnya.classList.add('hidden');
            }
        } */

        // Tema Sub Tema Kegiatan
        const subTemaOptions = {
            "keanekaragaman-hayati": [{
                    value: "pelestarian-keanekaragaman-hayati-kawasan-dilindungi-yang-meliputi-pelestarian-sumber-daya-genetik-jenis-dan-ekosistem",
                    text: "Pelestarian keanekaragaman hayati dan kawasan dilindungi yang meliputi pelestarian sumber daya genetik, jenis, dan ekosistem"
                },
                {
                    value: "pemanfaatan-keanekaragaman-hayati-berkelanjutan",
                    text: "Pemanfaatan keanekaragaman hayati secara berkelanjutan"
                },
                {
                    value: "jasa-lingkungan",
                    text: "Jasa lingkungan"
                }
            ],
            "perubahan-iklim": [{
                    value: "adaptasi-perubahan-iklim",
                    text: "Adaptasi perubahan iklim"
                },
                {
                    value: "mitigasi-perubahan-iklim",
                    text: "Mitigasi perubahan iklim"
                },
                {
                    value: "penerapan-ekonomi-hijau-biru",
                    text: "Penerapan ekonomi hijau dan ekonomi biru"
                }
            ],
            "pencemaran-dan-kerusakan-lingkungan": [{
                    value: "penanganan-pencemaran-air-tanah-udara-yang-meliputi-industri-pertanian-domestik-terutama-plastik",
                    text: "Penanganan pencemaran air, tanah, udara dari industri, pertanian, domestik terutama plastik"
                },
                {
                    value: "pencegahan-dan-penanggulangan-kerusakan-lingkungan",
                    text: "Pencegahan dan penanggulangan kerusakan lingkungan"
                },
                {
                    value: "ekonomi-sirkular",
                    text: "Ekonomi sirkular"
                }
            ],
            "hukum-dan-budaya": [{
                    value: "keadilan-pemanfaatan-sumber-daya-alam-dan-lingkungan",
                    text: "Keadilan terhadap pemanfaatan sumber daya alam dan lingkungan"
                },
                {
                    value: "kearifan-tradisional-dalam-pengelolaan-sumber-daya-alam",
                    text: "Kearifan tradisional dalam pengelolaan sumber daya alam"
                },
                {
                    value: "komunikasi-pendidikan-lingkungan-hidup",
                    text: "Komunikasi dan pendidikan lingkungan hidup"
                }
            ]
        };

        const temaKegiatanSelect = document.getElementById('tema-kegiatan');
        const subTemaKegiatanSelect = document.getElementById('sub-tema-kegiatan');

        temaKegiatanSelect.addEventListener('change', function() {
            const selectedTema = this.value;
            const subTemaList = subTemaOptions[selectedTema];

            // Reset sub-tema options
            subTemaKegiatanSelect.innerHTML = '<option value="" disabled selected>Pilih Sub Tema Kegiatan</option>';

            if (subTemaList) {
                // Aktifkan select sub-tema jika ada tema yang dipilih
                subTemaKegiatanSelect.disabled = false;

                // Tambahkan opsi sub-tema yang sesuai
                subTemaList.forEach(subTema => {
                    const option = document.createElement('option');
                    option.value = subTema.value;
                    option.text = subTema.text;
                    subTemaKegiatanSelect.appendChild(option);
                });
            } else {
                // Nonaktifkan select sub-tema jika tema tidak valid
                subTemaKegiatanSelect.disabled = true;
            }
        });

        function setTemaSubTemaEvent(temaSelect, subTemaSelect) {
            temaSelect.addEventListener('change', function() {
                const selectedTema = this.value;
                const subTemaList = subTemaOptions[selectedTema];

                // Reset sub-tema options
                subTemaSelect.innerHTML = '<option value="" disabled selected>Pilih Sub Tema Kegiatan</option>';

                if (subTemaList) {
                    // Aktifkan select sub-tema jika ada tema yang dipilih
                    subTemaSelect.disabled = false;

                    // Tambahkan opsi sub-tema yang sesuai
                    subTemaList.forEach(subTema => {
                        const option = document.createElement('option');
                        option.value = subTema.value;
                        option.text = subTema.text;
                        subTemaSelect.appendChild(option);
                    });
                } else {
                    // Nonaktifkan select sub-tema jika tema tidak valid
                    subTemaSelect.disabled = true;
                }
            });
        }

        // Batasan Kata
        function updateWordCount(textarea, countId, maxWords) {
            const countElement = document.getElementById(countId);

            // Tambahkan event listener untuk mendeteksi perubahan input
            textarea.addEventListener('input', function() {
                let words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0); // Pisahkan kata berdasarkan spasi
                let currentLength = words.length;

                // Jika kata lebih dari 1000, potong ke 1000 kata
                if (currentLength > maxWords) {
                    words = words.slice(0, maxWords);
                    textarea.value = words.join(" ");
                    currentLength = maxWords; // Set currentLength ke batas maksimal
                }

                // Update jumlah kata di elemen counter
                countElement.textContent = `${currentLength}/${maxWords} kata`;
            });

            // Event keydown untuk mencegah input baru jika kata sudah mencapai 1000
            textarea.addEventListener('keydown', function(event) {
                let words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
                let currentLength = words.length;

                const isControlKey = event.key === "Backspace" || event.key === "Delete" || event.key.startsWith("Arrow");

                // Jika sudah 1000 kata, cegah input baru kecuali tombol penghapusan atau navigasi
                if (currentLength >= maxWords && !isControlKey) {
                    event.preventDefault(); // Cegah penambahan input baru jika mencapai batas maksimal kata
                }
            });
        }

        // Jalankan fungsi ketika halaman di-load
        updateWordCount(document.getElementById('pihakPeran'), 'pihakPeranCount', 1000);
        updateWordCount(document.getElementById('penjelasan'), 'penjelasanCount', 1000);
        updateWordCount(document.getElementById('keberhasilan'), 'keberhasilanCount', 1000);

        updateWordCount(document.getElementById('dampakLingkungan'), 'dampakLingkunganCount', 1000);
        updateWordCount(document.getElementById('dampakEkonomi'), 'dampakEkonomiCount', 1000);
        updateWordCount(document.getElementById('dampakSosial'), 'dampakSosialCount', 1000);

        updateWordCount(document.getElementById('prakarsa'), 'prakarsaCount', 1000);
        updateWordCount(document.getElementById('motivasi'), 'motivasiCount', 1000);
        updateWordCount(document.getElementById('inovasi'), 'inovasiCount', 1000);
        updateWordCount(document.getElementById('kreativitas'), 'kreativitasCount', 1000);

        updateWordCount(document.getElementById('sumber'), 'sumberCount', 1000);
        updateWordCount(document.getElementById('teknologi'), 'teknologiCount', 1000);
        updateWordCount(document.getElementById('statusLahan'), 'statusLahanCount', 1000);
        updateWordCount(document.getElementById('kelompokPeroranganMeniru'), 'kelompokPeroranganMeniruCount', 1000);

        updateWordCount(document.getElementById('keistimewaanCalon'), 'keistimewaanCalonCount', 1000);
        updateWordCount(document.getElementById('penghargaanRelevan'), 'penghargaanRelevanCount', 1000);

        // Tambah Form Kegiatan
        document.addEventListener('DOMContentLoaded', function() {
            const formContainer = document.getElementById('formContainer');

            // Delegasikan event untuk jenis kegiatan lainnya
            formContainer.addEventListener('change', function(event) {
                if (event.target && event.target.matches('select[id^="jenisKegiatan"]')) {
                    const jenisLainnya = event.target.closest('.grid').querySelector('#jenisLainnya');
                    if (event.target.value === 'jenis-kegiatan-lainnya') {
                        jenisLainnya.classList.remove('hidden');
                    } else {
                        jenisLainnya.classList.add('hidden');
                    }
                }
            });
        });

        let kegiatanCount = 1; // Awal dari 1 karena sudah ada 1 form
        const maxKegiatan = 4; // Batas maksimal form kegiatan

        function tambahKegiatan() {
            if (kegiatanCount < maxKegiatan) {
                kegiatanCount++;
                const formContainer = document.getElementById('formContainer');

                // Salin form yang ada
                const newForm = `
            <div class="grid grid-cols-1 gap-4 mt-4">
                <!-- Kolom kiri -->
                <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm text-black">Tema Kegiatan</label>
                            <select disabled id="tema-kegiatan-${kegiatanCount}" class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease">
                                <option value="" disabled selected>Pilih Tema Kegiatan</option>
                                <option value="keanekaragaman-hayati">Keanekaragaman Hayati</option>
                                <option value="perubahan-iklim">Perubahan Iklim</option>
                                <option value="pencemaran-dan-kerusakan-lingkungan">Pencemaran dan Kerusakan Lingkungan</option>
                                <option value="hukum-dan-budaya">Hukum dan Budaya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm text-black">Sub Tema Kegiatan</label>
                            <select disabled id="sub-tema-kegiatan-${kegiatanCount}" disabled class="w-full bg-transparent text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease">
                                <option value="" disabled selected>Pilih Sub Tema Kegiatan</option>
                                <option value="pelestarian-keanekaragaman-hayati-kawasan-dilindungi-yang-meliputi-pelestarian-sumber-daya-genetik-jenis-dan-ekosistem">Pelestarian keanekaragaman hayati dan kawasan dilindungi yang meliputi pelestarian sumber daya genetik, jenis, dan ekosistem</option>
                                <option value="pemanfaatan-keanekaragaman-hayati-berkelanjutan">Pemanfaatan keanekaragaman hayati secara berkelanjutan</option>
                                <option value="jasa-lingkungan">Jasa lingkungan</option>
                                <!-- Batas Keanekaragaman Hayati -->
                                <option value="adaptasi-perubahan-iklim">Adaptasi perubahan iklim</option>
                                <option value="mitigasi-perubahan-iklim">Mitigasi perubahan iklim</option>
                                <option value="penerapan-ekonomi-hijau-biru">Penerapan ekonomi hijau dan ekonomi biru</option>
                                <!-- Batas Perubahan Iklim -->
                                <option value="penanganan-pencemaran-air-tanah-udara-yang-meliputi-industri-pertanian-domestik-terutama-plastik">Penanganan pencemaran air, tanah, udara dari industri, pertanian, domestik terutama plastik</option>
                                <option value="pencegahan-dan-penanggulangan-kerusakan-lingkungan">Pencegahan dan penanggulangan kerusakan lingkungan</option>
                                <option value="ekonomi-sirkular">Ekonomi sirkular</option>
                                <!-- Batas Pencemaran dan Kerusakan Lingkungan -->
                                <option value="keadilan-pemanfaatan-sumber-daya-alam-dan-lingkungan">Keadilan terhadap pemanfaatan sumber daya alam dan lingkungan</option>
                                <option value="kearifan-tradisional-dalam-pengelolaan-sumber-daya-alam">Kearifan tradisional dalam pengelolaan sumber daya alam</option>
                                <option value="komunikasi-pendidikan-lingkungan-hidup">Komunikasi dan pendidikan lingkungan hidup</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm text-black">Bentuk Kegiatan</label>
                            <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm text-black">Tahun Mulai Kegiatan</label>
                            <input disabled type="date" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                        </div>
                        <div>
                    <label class="block mb-2 text-sm text-black">Penjelasan Kegiatan</label>
                    <textarea disabled id="penjelasan${kegiatanCount}" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                        oninput="updateWordCount(this, 'penjelasanCount${kegiatanCount}', 1000)"></textarea>
                    <p id="penjelasanCount${kegiatanCount}" class="text-xs text-slate-400 flex justify-end ">0/1000 Kata</p>
                </div>
                    </div>

                <!-- Kolom kanan -->
                <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm text-black">Lokasi Kegiatan</label>
                            <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm text-black">Koordinat Lokasi Kegiatan</label>
                            <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                        </div>
                        <div>
                    <label class="block mb-2 text-sm text-black">Para Pihak dan Perannya</label>
                    <textarea disabled id="pihakPeran${kegiatanCount}" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                        oninput="updateWordCount(this, 'pihakPeranCount${kegiatanCount}', 1000)"></textarea>
                    <p id="pihakPeranCount${kegiatanCount}" class="text-xs text-slate-400 flex justify-end ">0/1000 Kata</p>
                </div>
                        <div>
                    <label class="block mb-2 text-sm text-black">Keberhasilan yang Dicapai</label>
                    <textarea disabled id="keberhasilan${kegiatanCount}" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4"
                        oninput="updateWordCount(this, 'keberhasilanCount${kegiatanCount}', 1000)"></textarea>
                    <p id="keberhasilanCount${kegiatanCount}" class="text-xs text-slate-400 flex justify-end ">0/1000 Kata</p>
                </div>

                    </div>
                </div>
            </div>`;

                // Tambahkan form baru di bawah form yang sudah ada
                formContainer.insertAdjacentHTML('beforeend', newForm);

                // Ambil elemen select tema dan sub-tema untuk form yang baru ditambahkan
                const temaSelect = document.getElementById(`tema-kegiatan-${kegiatanCount}`);
                const subTemaSelect = document.getElementById(`sub-tema-kegiatan-${kegiatanCount}`);

                // Apply event listener untuk Tema dan Sub Tema
                setTemaSubTemaEvent(temaSelect, subTemaSelect);

                // Panggil fungsi updateWordCount untuk tiap textarea yang baru ditambahkan
                updateWordCount(document.getElementById(`penjelasan${kegiatanCount}`), `penjelasanCount${kegiatanCount}`, 1000);
                updateWordCount(document.getElementById(`pihakPeran${kegiatanCount}`), `pihakPeranCount${kegiatanCount}`, 1000);
                updateWordCount(document.getElementById(`keberhasilan${kegiatanCount}`), `keberhasilanCount${kegiatanCount}`, 1000);

                // Jika sudah mencapai batas, sembunyikan tombol tambah
                if (kegiatanCount === maxKegiatan) {
                    document.getElementById('tambahKegiatanBtn').style.display = 'none';
                }
            }
        }


        // Tambah Foto Kegiatan dan Tambah Tautan Video
        // Maksimal input yang diperbolehkan
        const maxFotoInput = 5;
        const maxVideoInput = 5;

        // Container foto dan video
        const fotoContainer = document.getElementById('fotoContainer');
        const videoContainer = document.getElementById('videoContainer');

        // Tombol tambah foto dan video
        const tambahFotoButton = document.getElementById('tambahFotoButton');
        const tambahVideoButton = document.getElementById('tambahVideoButton');

        // Counter untuk input
        let fotoInputCount = 1;
        let videoInputCount = 1;

        // Fungsi untuk menambah input foto kegiatan
        tambahFotoButton.addEventListener('click', function() {
            if (fotoInputCount < maxFotoInput) {
                const newFotoDiv = document.createElement('div');
                newFotoDiv.classList.add('mb-4');
                newFotoDiv.innerHTML = `
                    <input disabled type="file" accept=".jpg, .jpeg" class="mb-2 w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                    <input disabled type="text" placeholder="Keterangan Foto" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                `;
                fotoContainer.insertBefore(newFotoDiv, tambahFotoButton);
                fotoInputCount++;

                // Jika sudah mencapai maksimal, sembunyikan tombol tambah foto
                if (fotoInputCount === maxFotoInput) {
                    tambahFotoButton.style.display = 'none';
                }
            }
        });

        // Fungsi untuk menambah input tautan video
        tambahVideoButton.addEventListener('click', function() {
            if (videoInputCount < maxVideoInput) {
                const newVideoDiv = document.createElement('div');
                newVideoDiv.classList.add('mb-4');
                newVideoDiv.innerHTML = `
                    <input disabled type="text" placeholder="Tautan Video" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                `;
                videoContainer.insertBefore(newVideoDiv, tambahVideoButton);
                videoInputCount++;

                // Jika sudah mencapai maksimal, sembunyikan tombol tambah video
                if (videoInputCount === maxVideoInput) {
                    tambahVideoButton.style.display = 'none';
                }
            }
        });
    </script>

</body>

</html>