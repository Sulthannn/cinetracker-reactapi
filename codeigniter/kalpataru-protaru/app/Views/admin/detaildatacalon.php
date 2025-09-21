<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body class="lg:flex">

    <!-- Sidebar -->
    <div class="w-64 bg-white text-white">
        <?= $this->include('template/sidebaradmin') ?>
    </div>

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
                        <button id="profil-pengusulButton" class="mt-2 w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button"
                            data-target="profil-pengusul">Profil Pengusul</button>
                        <button id="identitasButton" class="mt-2 w-full btn-section md:w-40 rounded-md py-2 px-4 text-center text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none text-sm" type="button"
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
                    <div id="profil-pengusul" class="form-section flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="profil-pengusulForm" class="mb-2 w-full">
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Kolom kiri -->
                                <div class="space-y-4">
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Jenis Instansi</label>
                                        <input disabled type="text" value="<?= $pengusul['jenis_instansi']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none" />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Nama Instansi / Pribadi</label>
                                        <input disabled type="text" value="<?= $pengusul['nama_instansi_pribadi']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Provinsi</label>
                                        <input disabled type="text" value="<?= $pengusul['provinsi']; ?>" min="1" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Nomor Telepon</label>
                                        <input disabled type="text" value="<?= $pengusul['telepon']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Email</label>
                                        <input disabled type="text" value="<?= $pengusul['email']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Jabatan/Pekerjaan</label>
                                        <input disabled type="text" value="<?= $pengusul['jabatan_pekerjaan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Jenis Kelamin</label>
                                        <input disabled type="text" value="<?= $pengusul['jenis_kelamin'] ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                </div>

                                <!-- Kolom kanan -->
                                <div class="space-y-4">
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Alamat</label>
                                        <input disabled type="text" value="<?= $pendaftaran['jalan'] ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">RT/RW</label>
                                        <input disabled type="text" value="<?= $pendaftaran['rt_rw'] ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Desa/Kelurahan</label>
                                        <input disabled type="text" value="<?= $pendaftaran['desa'] ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Kecamatan</label>
                                        <input disabled type="text" value="<?= $pendaftaran['kecamatan'] ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Kab/Kota</label>
                                        <input disabled type="text" value="<?= $pendaftaran['kab_kota'] ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Kode Pos</label>
                                        <input disabled type="text" value="<?= $pendaftaran['kode_pos'] ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                    </div>
                                    <div class="w-full mb-4">
                                        <label class="block mb-2 text-sm text-black">Surat Pengantar</label>
                                        <p class="text-sm text-slate-400 mb-4">
                                            <?= $pengusul['surat_pengantar']; ?> <!-- Tampilkan nama file surat pengantar -->
                                        </p>
                                        <button onclick="window.location.href='<?= base_url('/admin/download/' . esc($pengusul['surat_pengantar'])) ?>'"
                                            class="w-full rounded-md py-2 px-2 text-center font-semibold text-xs text-primary bg-secondary hover:shadow-md flex items-center justify-center gap-4" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                            Unduh Surat Pengantar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if ($pendaftaran['kategori'] === 'Penyelamat Lingkungan'): ?>
                        <div id="identitas-calon" class="form-section hidden flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                            <form id="identitasabd" class="mb-2 w-full">
                                <p class="font-semibold mb-2 text-md text-primary underline">Data Kelompok/ Komunitas</p>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Nama Kelompok</label>
                                    <input disabled type="text" value="<?= $pendaftaran['nama_kelompok']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Tahun Berdiri Kelompok</label>
                                    <input disabled type="date" value="<?= $pendaftaran['tahun_pembentukan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Jumlah Anggota</label>
                                    <input disabled type="number" value="<?= $pendaftaran['jumlah_anggota']; ?>" min="1" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Alamat</label>
                                    <input disabled type="text" value="<?= $pendaftaran['jalan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">RT/RW</label>
                                    <input disabled type="text" value="<?= $pendaftaran['rt_rw']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Desa/Kelurahan</label>
                                    <input disabled type="text" value="<?= $pendaftaran['desa']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Kecamatan</label>
                                    <input disabled type="text" value="<?= $pendaftaran['kecamatan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Kab/Kota</label>
                                    <input disabled type="text" value="<?= $pendaftaran['kab_kota']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Provinsi</label>
                                    <input disabled type="text" value="<?= $pendaftaran['provinsi']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Kode Pos</label>
                                    <input disabled type="text" value="<?= $pendaftaran['kode_pos']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Media Sosial</label>
                                    <input disabled type="text" value="<?= $pendaftaran['sosial_media']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Surat Legalitas Kelompok : <?php if (!empty($pendaftaran['legalitas'])): ?>
                                            <a href="<?= base_url('admin/download/legalitas/' . rawurlencode(esc($pendaftaran['legalitas']))) ?>" class="text-green-900 underline">
                                                <?= esc($pendaftaran['legalitas']) ?>
                                            </a>
                                        <?php endif; ?><span class="text-slate-400">(.pdf)</span></label>
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Tanggal Legalitas</label>
                                    <input disabled type="date" value="<?= $pendaftaran['tanggal_legalitas']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <p class="mt-8 font-semibold mb-2 text-md text-primary underline">Data Ketua / Anggota Kelompok</p>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Nama Ketua / Anggota Kelompok</label>
                                    <input disabled type="text" value="<?= $pendaftaran['nama']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">NIK</label>
                                    <input disabled type="text" value="<?= $pendaftaran['nik']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Tempat Lahir</label>
                                    <input disabled type="text" value="<?= $pendaftaran['tempat_lahir']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Tanggal Lahir</label>
                                    <input disabled type="date" value="<?= $pendaftaran['tanggal_lahir']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Usia</label>
                                    <input disabled type="number" value="<?= $pendaftaran['usia']; ?>" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Jenis Kelamin</label>
                                    <input disabled type="text" value="<?= $pendaftaran['jenis_kelamin'] ?>" name="jenis_kelamin" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Pekerjaan</label>
                                    <input disabled type="text" value="<?= $pendaftaran['pekerjaan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Nomor Telepon</label>
                                    <input disabled type="text" value="<?= $pendaftaran['telepon']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Email</label>
                                    <input disabled type="email" value="<?= $pendaftaran['email']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Pendidikan Terakhir</label>
                                    <input disabled type="text" value="<?= $pendaftaran['pendidikan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">KTP : <?php if (!empty($pendaftaran['ktp'])): ?>
                                            <a href="<?= base_url('admin/download/ktp/' . rawurlencode(esc($pendaftaran['ktp']))) ?>" class="text-green-900 underline">
                                                <?= esc($pendaftaran['ktp']) ?>
                                            </a>
                                        <?php endif; ?><span class="text-slate-400">(.jpg/jpeg)</span>
                                    </label>
                                    <?php if (!empty($pendaftaran['ktp'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= base_url('admin/preview/ktp/' . esc($pendaftaran['ktp'])) ?>" class="w-1/2">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">SKCK : <?php if (!empty($pendaftaran['skck'])): ?>
                                            <a href="<?= base_url('admin/download/skck/' . rawurlencode(esc($pendaftaran['skck']))) ?>" class="text-green-900 underline">
                                                <?= esc($pendaftaran['skck']) ?>
                                            </a>
                                        <?php endif; ?><span class="text-slate-400">(.pdf)</span></label>
                                </div>
                                <div class="w-full mb-4">
                                    <label class="mb-2 text-sm text-slate-600">Tanggal SKCK</label>
                                    <input disabled type="date" value="<?= $pendaftaran['tanggal_skck']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none  shadow-sm focus:shadow" />
                                </div>
                            </form>
                        </div>

                    <?php else: ?>
                        <div id="identitas-calon" class="form-section hidden flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                            <form id="identitasabd" class="mb-2 w-full">
                                <div class="w-full mb-4">
                                    <label class="mb-2 text-sm text-slate-600">Nama Lengkap</label>
                                    <input disabled type="text" value="<?= $pendaftaran['nama']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none  shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="mb-2 text-sm text-slate-600">NIK</label>
                                    <input disabled type="text" value="<?= $pendaftaran['nik']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none  shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="mb-2 text-sm text-slate-600">Tempat Lahir</label>
                                    <input disabled type="text" value="<?= $pendaftaran['tempat_lahir']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none  shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="mb-2 text-sm text-slate-600">Tanggal Lahir</label>
                                    <input disabled type="date" value="<?= $pendaftaran['tanggal_lahir']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none  shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="mb-2 text-sm text-slate-600">Usia</label>
                                    <input disabled type="number" value="<?= $pendaftaran['usia']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none  shadow-sm focus:shadow" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Jenis Kelamin</label>
                                    <input disabled type="text" value="<?= $pendaftaran['jenis_kelamin'] ?>" name="jenis_kelamin" min="0" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Pekerjaan</label>
                                    <input disabled type="text" value="<?= $pendaftaran['pekerjaan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Nomor Telepon</label>
                                    <input disabled type="text" value="<?= $pendaftaran['telepon']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Email</label>
                                    <input disabled type="email" value="<?= $pendaftaran['email']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Pendidikan Terakhir</label>
                                    <input disabled type="text" value="<?= $pendaftaran['pendidikan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Alamat</label>
                                    <input disabled type="text" value="<?= $pendaftaran['jalan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">RT/RW</label>
                                    <input disabled type="text" value="<?= $pendaftaran['rt_rw']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Desa/Kelurahan</label>
                                    <input disabled type="text" value="<?= $pendaftaran['desa']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Kecamatan</label>
                                    <input disabled type="text" value="<?= $pendaftaran['kecamatan']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Kab/Kota</label>
                                    <input disabled type="text" value="<?= $pendaftaran['kab_kota']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Provinsi</label>
                                    <input disabled type="text" value="<?= $pendaftaran['provinsi']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Kode Pos</label>
                                    <input disabled type="text" value="<?= $pendaftaran['kode_pos']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Media Sosial</label>
                                    <input disabled type="text" value="<?= $pendaftaran['sosial_media']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">KTP : <?php if (!empty($pendaftaran['ktp'])): ?>
                                            <a href="<?= base_url('admin/download/ktp/' . rawurlencode(esc($pendaftaran['ktp']))) ?>" class="text-green-900 underline">
                                                <?= esc($pendaftaran['ktp']) ?>
                                            </a>
                                        <?php endif; ?><span class="text-slate-400">(.jpg/jpeg)</span>
                                    </label>
                                    <?php if (!empty($pendaftaran['ktp'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= base_url('admin/preview/ktp/' . esc($pendaftaran['ktp'])) ?>" class="w-1/2">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">SKCK : <?php if (!empty($pendaftaran['skck'])): ?>
                                            <a href="<?= base_url('admin/download/skck/' . rawurlencode(esc($pendaftaran['skck']))) ?>" class="text-green-900 underline">
                                                <?= esc($pendaftaran['skck']) ?>
                                            </a>
                                        <?php endif; ?><span class="text-slate-400">(.pdf)</span></label>
                                </div>
                                <div class="w-full mb-4">
                                    <label class="block mb-2 text-sm text-black">Tanggal SKCK</label>
                                    <input disabled type="date" value="<?= $pendaftaran['tanggal_skck']; ?>" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>

                    <!-- Right side: Form inside a card -->
                    <div id="kegiatan-calon" class="form-section hidden flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="kegiatanForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4" id="formContainer">
                                <div class="space-y-4">
                                    <p class="font-semibold mb-2 text-md text-primary underline">Kegiatan Utama</p>
                                    <?php if (!empty($kegiatan_utama)): ?>
                                        <?php foreach ($kegiatan_utama as $kegiatan): ?>
                                            <div>
                                                <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                    <span>Tema Kegiatan</span>
                                                    <?php if (empty($kegiatan['tema'])): ?>
                                                        <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                    <?php endif; ?>
                                                </label>
                                                <input id="temaKegiatan" type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none"
                                                    value="<?= esc($kegiatan['tema'] ?? '') ?>" disabled>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                    <span>Sub Tema Kegiatan</span>
                                                    <?php if (empty($kegiatan['sub_tema'])): ?>
                                                        <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                    <?php endif; ?>
                                                </label>
                                                <input id="subTemaKegiatan" type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none"
                                                    value="<?= esc($kegiatan['sub_tema'] ?? '') ?>" disabled>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                    <span>Bentuk Kegiatan</span>
                                                    <?php if (empty($kegiatan['bentuk_kegiatan'])): ?>
                                                        <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                    <?php endif; ?>
                                                </label>
                                                <input type="text"
                                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease"
                                                    value="<?= esc($kegiatan['bentuk_kegiatan'] ?? '') ?>" disabled />
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                    <span>Penjelasan Kegiatan</span>
                                                    <?php if (empty($kegiatan['deskripsi_kegiatan'])): ?>
                                                        <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                    <?php endif; ?>
                                                </label>
                                                <textarea disabled id="penjelasan"
                                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease"
                                                    rows="4"
                                                    oninput="updateWordCount(this, 'penjelasanCount', 1000)"><?= esc($kegiatan['deskripsi_kegiatan'] ?? '') ?></textarea>
                                                <p id="penjelasanCount" class="text-xs text-slate-400 flex justify-end">
                                                    <?= (isset($kegiatan['deskripsi_kegiatan']) && strlen(trim($kegiatan['deskripsi_kegiatan'])) > 0) ? str_word_count($kegiatan['deskripsi_kegiatan']) : 0 ?>/1000 Kata
                                                </p>
                                            </div>
                                </div>

                                <!-- Kolom kanan -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Lokasi Kegiatan</span>
                                            <?php if (empty($kegiatan['lokasi_kegiatan'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <input type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                            value="<?= esc($kegiatan['lokasi_kegiatan'] ?? '') ?>" disabled>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Koordinat Lokasi Kegiatan</span>
                                            <?php if (empty($kegiatan['koordinat'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <input type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                            value="<?= esc($kegiatan['koordinat'] ?? '') ?>" disabled>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Para Pihak dan Perannya</span>
                                            <?php if (empty($kegiatan['pihak_dan_peran'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <textarea disabled id="pihakPeran" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                            oninput="updateWordCount(this, 'pihakPeranCount', 1000)"><?= esc($kegiatan['pihak_dan_peran'] ?? '') ?></textarea>
                                        <p id="pihakPeranCount" class="text-xs text-slate-400 flex justify-end ">
                                            <?= (isset($kegiatan['pihak_dan_peran']) && strlen(trim($kegiatan['pihak_dan_peran'])) > 0) ? str_word_count($kegiatan['pihak_dan_peran']) : 0 ?>/1000 Kata
                                        </p>

                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Keberhasilan yang Dicapai</span>
                                            <?php if (empty($kegiatan['keberhasilan'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <textarea disabled id="keberhasilan" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                            oninput="updateWordCount(this, 'keberhasilanCount', 1000)"><?= esc($kegiatan['keberhasilan'] ?? '') ?></textarea>
                                        <p id="keberhasilanCount" class="text-xs text-slate-400 flex justify-end ">
                                            <?= (isset($kegiatan['keberhasilan']) && strlen(trim($kegiatan['keberhasilan'])) > 0) ? str_word_count($kegiatan['keberhasilan']) : 0 ?>/1000 Kata
                                        </p>

                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Kolom kiri -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Tema Kegiatan</span>
                                            <?php if (empty($pendaftaran['tema'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?></label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                            value="<?= esc($pendaftaran['tema'] ?? '') ?>" disabled>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Sub Tema Kegiatan</span>
                                            <?php if (empty($pendaftaran['sub_tema'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                            value="<?= esc($pendaftaran['sub_tema'] ?? '') ?>" disabled>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Bentuk Kegiatan</span>
                                            <?php if (empty($pendaftaran['bentuk_kegiatan'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <input type="text"
                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease"
                                            value="<?= esc($pendaftaran['bentuk_kegiatan'] ?? '') ?>" disabled />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Penjelasan Kegiatan</span>
                                            <?php if (empty($pendaftaran['deskripsi_kegiatan'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <textarea disabled id="penjelasan"
                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease"
                                            rows="4"
                                            oninput="updateWordCount(this, 'penjelasanCount', 1000)"><?= esc($pendaftaran['deskripsi_kegiatan'] ?? '') ?></textarea>
                                        <p id="penjelasanCount" class="text-xs text-slate-400 flex justify-end">
                                            <?= (isset($pendaftaran['deskripsi_kegiatan']) && strlen(trim($pendaftaran['deskripsi_kegiatan'])) > 0) ? str_word_count($pendaftaran['deskripsi_kegiatan']) : 0 ?>/1000 Kata
                                        </p>
                                    </div>

                                </div>

                                <!-- Kolom kanan -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Lokasi Kegiatan</span>
                                            <?php if (empty($pendaftaran['lokasi_kegiatan'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                            value="<?= esc($pendaftaran['lokasi_kegiatan'] ?? '') ?>" disabled>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Koordinat Lokasi Kegiatan</span>
                                            <?php if (empty($pendaftaran['koordinat'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                            value="<?= esc($pendaftaran['koordinat'] ?? '') ?>" disabled>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Para Pihak dan Perannya</span>
                                            <?php if (empty($pendaftaran['pihak_dan_peran'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <textarea disabled id="pihakPeran" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                            oninput="updateWordCount(this, 'pihakPeranCount', 1000)"><?= esc($pendaftaran['pihak_dan_peran'] ?? '') ?></textarea>
                                        <p id="pihakPeranCount" class="text-xs text-slate-400 flex justify-end ">
                                            <?= (isset($pendaftaran['pihak_dan_peran']) && strlen(trim($pendaftaran['pihak_dan_peran'])) > 0) ? str_word_count($pendaftaran['pihak_dan_peran']) : 0 ?>/1000 Kata
                                        </p>

                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                            <span>Keberhasilan yang Dicapai</span>
                                            <?php if (empty($pendaftaran['keberhasilan'])): ?>
                                                <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                            <?php endif; ?>
                                        </label>
                                        <textarea disabled id="keberhasilan" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                            oninput="updateWordCount(this, 'keberhasilanCount', 1000)"><?= esc($pendaftaran['keberhasilan'] ?? '') ?></textarea>
                                        <p id="keberhasilanCount" class="text-xs text-slate-400 flex justify-end ">
                                            <?= (isset($pendaftaran['keberhasilan']) && strlen(trim($pendaftaran['keberhasilan'])) > 0) ? str_word_count($pendaftaran['keberhasilan']) : 0 ?>/1000 Kata
                                        </p>

                                    </div>
                                </div>
                            <?php endif; ?>
                                </div>

                                <!-- Kegiatan Tambahan -->
                                <?php if (!empty($kegiatan_tambahan)): ?>
                                    <?php foreach ($kegiatan_tambahan as $index => $kegiatan_lain): ?>
                                        <div class="grid grid-cols-1 gap-4">
                                            <div class="space-y-4">
                                                <p class="mt-8 font-semibold mb-2 text-md text-primary underline">Kegiatan Lain (<?= $index + 1 ?>)</p>
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Tema Kegiatan</span>
                                                        <?php if (empty($kegiatan_lain['tema'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input id="temaKegiatan_<?= $index ?>" type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none"
                                                        value="<?= esc($kegiatan_lain['tema'] ?? '') ?>" disabled>
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Sub Tema Kegiatan</span>
                                                        <?php if (empty($kegiatan_lain['sub_tema'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input id="subTemaKegiatan_<?= $index ?>" type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none"
                                                        value="<?= esc($kegiatan_lain['sub_tema'] ?? '') ?>" disabled>
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Bentuk Kegiatan</span>
                                                        <?php if (empty($kegiatan_lain['bentuk_kegiatan'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease"
                                                        value="<?= esc($kegiatan_lain['bentuk_kegiatan'] ?? '') ?>" disabled />
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Penjelasan Kegiatan</span>
                                                        <?php if (empty($kegiatan_lain['deskripsi_kegiatan'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <textarea disabled id="penjelasan"
                                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease"
                                                        rows="4"
                                                        oninput="updateWordCount(this, 'penjelasanCount', 1000)"><?= esc($kegiatan_lain['deskripsi_kegiatan'] ?? '') ?></textarea>
                                                    <p id="penjelasanCount" class="text-xs text-slate-400 flex justify-end">
                                                        <?= (isset($kegiatan_lain['deskripsi_kegiatan']) && strlen(trim($kegiatan_lain['deskripsi_kegiatan'])) > 0) ? str_word_count($kegiatan_lain['deskripsi_kegiatan']) : 0 ?>/1000 Kata
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Lokasi Kegiatan</span>
                                                        <?php if (empty($kegiatan_lain['lokasi_kegiatan'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                                        value="<?= esc($kegiatan_lain['lokasi_kegiatan'] ?? '') ?>" disabled>
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Koordinat Lokasi Kegiatan</span>
                                                        <?php if (empty($kegiatan_lain['koordinat'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                                        value="<?= esc($kegiatan_lain['koordinat'] ?? '') ?>" disabled>
                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Para Pihak dan Perannya</span>
                                                        <?php if (empty($kegiatan_lain['pihak_dan_peran'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <textarea disabled id="pihakPeran" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                                        oninput="updateWordCount(this, 'pihakPeranCount', 1000)"><?= esc($kegiatan_lain['pihak_dan_peran'] ?? '') ?></textarea>
                                                    <p id="pihakPeranCount" class="text-xs text-slate-400 flex justify-end ">
                                                        <?= (isset($kegiatan_lain['pihak_dan_peran']) && strlen(trim($kegiatan_lain['pihak_dan_peran'])) > 0) ? str_word_count($kegiatan_lain['pihak_dan_peran']) : 0 ?>/1000 Kata
                                                    </p>

                                                </div>
                                                <div>
                                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                                        <span>Keberhasilan yang Dicapai</span>
                                                        <?php if (empty($kegiatan_lain['keberhasilan'])): ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <textarea disabled id="keberhasilan" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                                        oninput="updateWordCount(this, 'keberhasilanCount', 1000)"><?= esc($kegiatan_lain['keberhasilan'] ?? '') ?></textarea>
                                                    <p id="keberhasilanCount" class="text-xs text-slate-400 flex justify-end ">
                                                        <?= (isset($kegiatan_lain['keberhasilan']) && strlen(trim($kegiatan_lain['keberhasilan'])) > 0) ? str_word_count($kegiatan_lain['keberhasilan']) : 0 ?>/1000 Kata
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="dampak" class="form-section hidden flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="dampakForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Dampak kegiatan terhadap lingkungan</span>
                                        <?php if (empty($pendaftaran['dampak_lingkungan'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="dampakLingkungan" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'dampakLingkunganCount', 1000)"><?= esc($pendaftaran['dampak_lingkungan'] ?? '') ?></textarea>
                                    <p id="dampakLingkunganCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['dampak_lingkungan']) && strlen(trim($pendaftaran['dampak_lingkungan'])) > 0) ? str_word_count($pendaftaran['dampak_lingkungan']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Dampak Ekonomi</span>
                                        <?php if (empty($pendaftaran['dampak_ekonomi'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="dampakEkonomi" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'dampakEkonomiCount', 1000)"><?= esc($pendaftaran['dampak_ekonomi'] ?? '') ?></textarea>
                                    <p id="dampakEkonomiCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['dampak_ekonomi']) && strlen(trim($pendaftaran['dampak_ekonomi'])) > 0) ? str_word_count($pendaftaran['dampak_ekonomi']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Dampak Sosial dan Budaya</span>
                                        <?php if (empty($pendaftaran['dampak_sosial_budaya'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="dampakSosial" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'dampakSosialCount', 1000)"><?= esc($pendaftaran['dampak_sosial_budaya'] ?? '') ?></textarea>
                                    <p id="dampakSosialCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['dampak_sosial_budaya']) && strlen(trim($pendaftaran['dampak_sosial_budaya'])) > 0) ? str_word_count($pendaftaran['dampak_sosial_budaya']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                            </div>


                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="pmik" class="form-section hidden flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="pmikForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Prakarsa</span>
                                        <?php if (empty($pendaftaran['prakarsa'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="prakarsa" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'prakarsaCount', 1000)"><?= esc($pendaftaran['prakarsa'] ?? '') ?></textarea>
                                    <p id="prakarsaCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['prakarsa']) && strlen(trim($pendaftaran['prakarsa'])) > 0) ? str_word_count($pendaftaran['prakarsa']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Motivasi</span>
                                        <?php if (empty($pendaftaran['motivasi'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="motivasi" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'motivasiCount', 1000)"><?= esc($pendaftaran['motivasi'] ?? '') ?></textarea>
                                    <p id="motivasiCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['motivasi']) && strlen(trim($pendaftaran['motivasi'])) > 0) ? str_word_count($pendaftaran['motivasi']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Inovasi</span>
                                        <?php if (empty($pendaftaran['inovasi'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="inovasi" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'inovasiCount', 1000)"><?= esc($pendaftaran['inovasi'] ?? '') ?></textarea>
                                    <p id="inovasiCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['inovasi']) && strlen(trim($pendaftaran['inovasi'])) > 0) ? str_word_count($pendaftaran['inovasi']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Kreativitas</span>
                                        <?php if (empty($pendaftaran['kreativitas'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="kreativitas" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'kreativitasCount', 1000)"><?= esc($pendaftaran['kreativitas'] ?? '') ?></textarea>
                                    <p id="kreativitasCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['kreativitas']) && strlen(trim($pendaftaran['kreativitas'])) > 0) ? str_word_count($pendaftaran['kreativitas']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                            </div>


                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="keswadayaan" class="form-section hidden flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="keswadayaanForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Sumber Pembiayaan Kegiatan</span>
                                        <?php if (empty($pendaftaran['sumber_biaya'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="sumber" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'sumberCount', 1000)"><?= esc($pendaftaran['sumber_biaya'] ?? '') ?></textarea>
                                    <p id="sumberCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['sumber_biaya']) && strlen(trim($pendaftaran['sumber_biaya'])) > 0) ? str_word_count($pendaftaran['sumber_biaya']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Teknologi/Alat/Fasilitas yang digunakan</span>
                                        <?php if (empty($pendaftaran['teknologi_kegiatan'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="teknologi" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'teknologiCount', 1000)"><?= esc($pendaftaran['teknologi_kegiatan'] ?? '') ?></textarea>
                                    <p id="teknologiCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['teknologi_kegiatan']) && strlen(trim($pendaftaran['teknologi_kegiatan'])) > 0) ? str_word_count($pendaftaran['teknologi_kegiatan']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Status Lahan/Areal Kegiatan</span>
                                        <?php if (empty($pendaftaran['status_lahan_kegiatan'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="statusLahan" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'statusLahanCount', 1000)"><?= esc($pendaftaran['status_lahan_kegiatan'] ?? '') ?></textarea>
                                    <p id="statusLahanCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['status_lahan_kegiatan']) && strlen(trim($pendaftaran['status_lahan_kegiatan'])) > 0) ? str_word_count($pendaftaran['status_lahan_kegiatan']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Kelompok/Perorangan yang meniru</span>
                                        <?php if (empty($pendaftaran['jumlah_kelompok_serupa'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <input disabled type="number" name="jumlah_kelompok_serupa" id="kelompokPeroranganMeniru" class="w-full bg-transparent text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none transition duration-300 ease" value="<?= $pendaftaran['jumlah_kelompok_serupa'] ?>"></input>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Right side: Form inside a card -->
                    <div id="keistimewaan" class="form-section hidden flex flex-col w-full md:w-3/4 rounded-lg border-2 border-gray-300 bg-white shadow-lg p-6">
                        <form id="keistimewaanForm" class="mb-2 w-full">
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Keistimewaan Calon</span>
                                        <?php if (empty($pendaftaran['keistimewaan'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="keistimewaanCalon" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'keistimewaanCalonCount', 1000)"><?= esc($pendaftaran['keistimewaan'] ?? '') ?></textarea>
                                    <p id="keistimewaanCalonCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['keistimewaan']) && strlen(trim($pendaftaran['keistimewaan'])) > 0) ? str_word_count($pendaftaran['keistimewaan']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Penghargaan relevan yang pernah diterima</span>
                                        <?php if (empty($pendaftaran['penghargaan'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea disabled id="penghargaanRelevan" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                                        oninput="updateWordCount(this, 'penghargaanRelevanCount', 1000)"><?= esc($pendaftaran['penghargaan'] ?? '') ?></textarea>
                                    <p id="penghargaanRelevanCount" class="text-xs text-slate-400 flex justify-end">
                                        <?= (isset($pendaftaran['penghargaan']) && strlen(trim($pendaftaran['penghargaan'])) > 0) ? str_word_count($pendaftaran['penghargaan']) : 0 ?>/1000 Kata
                                    </p>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Tautan Dokumen Pendukung (Google Drive)</span>
                                        <?php if (empty($pendaftaran['tautan_dokumen_pendukung'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                        value="<?= esc($pendaftaran['tautan_dokumen_pendukung'] ?? '') ?>">
                                </div>

                                <div class="grid grid-cols-1 gap-4">
                                    <!-- Kolom 1 - Unggah Foto Kegiatan -->
                                    <div id="fotoContainer">
                                        <?php
                                        $dataTerisi = false;
                                        for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if (!empty($pendaftaran["foto_kegiatan$i"]) || !empty($pendaftaran["deskripsi_foto_kegiatan$i"])):
                                                $dataTerisi = true;
                                            ?>
                                                <div class="w-full mb-4">
                                                    <label class="block mb-2 text-sm text-black">Foto Kegiatan <?= $i ?> :
                                                        <?php if (!empty($pendaftaran["foto_kegiatan$i"])): ?>
                                                            <a href="<?= base_url('admin/download/fotokegiatan/' . $i . '/' . rawurlencode(esc($pendaftaran["foto_kegiatan$i"]))) ?>" class="text-green-900 underline">
                                                                <?= esc($pendaftaran["foto_kegiatan$i"]) ?>
                                                            </a>
                                                        <?php else: ?>
                                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                        <?php endif; ?>
                                                        <span class="text-slate-400">(.jpg/jpeg)</span>
                                                    </label>
                                                    <?php if (!empty($pendaftaran["foto_kegiatan$i"])): ?>
                                                        <img src="<?= base_url('admin/preview/fotokegiatan/' . $i . '/' . esc($pendaftaran["foto_kegiatan$i"])) ?>" alt="Foto Kegiatan <?= $i ?>" class="w-full">
                                                    <?php endif; ?>
                                                    <label class="block mb-2 text-sm text-black mt-2">Deskripsi Foto <?= $i ?> </label>
                                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none "
                                                        value="<?= esc($pendaftaran["deskripsi_foto_kegiatan$i"] ?? '') ?>">
                                                </div>
                                            <?php endif; ?>
                                        <?php endfor; ?>

                                        <?php if (!$dataTerisi): ?>
                                            <div class="w-full mb-4">
                                                <label class="block mb-2 text-sm text-black flex justify-between items-center mt-4">
                                                    <span>Foto Kegiatan</span>
                                                    <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Kolom 2 - Tautan Video -->
                                <div id="videoContainer">
                                    <label class="block mb-2 text-sm text-black flex justify-between items-center">
                                        <span>Tautan Video</span>
                                        <?php if (empty($pendaftaran['tautan_video'])): ?>
                                            <span class="text-red-500 text-sm ml-2">Data belum ditambahkan oleh Pengusul.</span>
                                        <?php endif; ?>
                                    </label>
                                    <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none  mb-3"
                                        value="<?= esc($pendaftaran['tautan_video'] ?? '') ?>">
                                </div>

                            </div>

                    </div>


                    </form>
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

        /* Tampilan Form Kegiatan */
        document.addEventListener('DOMContentLoaded', (event) => {
            const kegiatanLain = <?= json_encode(array_slice($kegiatan_utama, 1)) ?>;

            kegiatanLain.forEach((kegiatan, index) => {
                const tema = kegiatan['tema'] ?? '';
                const subTema = kegiatan['sub_tema'] ?? '';

                if (subTemaOptions[tema]) {
                    document.getElementById(`temaKegiatan_${index}`).value = subTemaOptions[tema].text;
                    const subTemaText = subTemaOptions[tema].options.find(option => option.value === subTema)?.text || subTema;
                    document.getElementById(`subTemaKegiatan_${index}`).value = subTemaText;
                } else {
                    document.getElementById(`temaKegiatan_${index}`).value = tema;
                    document.getElementById(`subTemaKegiatan_${index}`).value = subTema;
                }
            });

            const tema = "<?= esc($kegiatan['tema'] ?? '') ?>";
            const subTema = "<?= esc($kegiatan['sub_tema'] ?? '') ?>";

            if (subTemaOptions[tema]) {
                document.getElementById('temaKegiatan').value = subTemaOptions[tema].text;
                const subTemaText = subTemaOptions[tema].options.find(option => option.value === subTema)?.text || subTema;
                document.getElementById('subTemaKegiatan').value = subTemaText;
            } else {
                document.getElementById('temaKegiatan').value = tema;
                document.getElementById('subTemaKegiatan').value = subTema;
            }
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            const kegiatanLain = <?= json_encode($kegiatan_tambahan) ?>;

            kegiatanLain.forEach((kegiatan, index) => {
                const tema = kegiatan['tema'] ?? '';
                const subTema = kegiatan['sub_tema'] ?? '';

                if (subTemaOptions[tema]) {
                    document.getElementById(`temaKegiatan_${index}`).value = subTemaOptions[tema].text;
                    const subTemaText = subTemaOptions[tema].options.find(option => option.value === subTema)?.text || subTema;
                    document.getElementById(`subTemaKegiatan_${index}`).value = subTemaText;
                } else {
                    document.getElementById(`temaKegiatan_${index}`).value = tema;
                    document.getElementById(`subTemaKegiatan_${index}`).value = subTema;
                }
            });

            const tema = "<?= esc($kegiatan_lain['tema'] ?? '') ?>";
            const subTema = "<?= esc($kegiatan_lain['sub_tema'] ?? '') ?>";

            if (subTemaOptions[tema]) {
                document.getElementById('temaKegiatan').value = subTemaOptions[tema].text;
                const subTemaText = subTemaOptions[tema].options.find(option => option.value === subTema)?.text || subTema;
                document.getElementById('subTemaKegiatan').value = subTemaText;
            } else {
                document.getElementById('temaKegiatan').value = tema;
                document.getElementById('subTemaKegiatan').value = subTema;
            }
        });

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
                            <select disabled id="tema-kegiatan-${kegiatanCount}" class="w-full bg-transparent text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease">
                                <option value="" disabled selected>Pilih Tema Kegiatan</option>
                                <option value="keanekaragaman-hayati">Keanekaragaman Hayati</option>
                                <option value="perubahan-iklim">Perubahan Iklim</option>
                                <option value="pencemaran-dan-kerusakan-lingkungan">Pencemaran dan Kerusakan Lingkungan</option>
                                <option value="hukum-dan-budaya">Hukum dan Budaya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm text-black">Sub Tema Kegiatan</label>
                            <select disabled id="sub-tema-kegiatan-${kegiatanCount}" disabled class="w-full bg-transparent text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease">
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
                            <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm text-black">Tahun Mulai Kegiatan</label>
                            <input disabled type="date" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                        </div>
                        <div>
                    <label class="block mb-2 text-sm text-black">Penjelasan Kegiatan</label>
                    <textarea disabled id="penjelasan${kegiatanCount}" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                        oninput="updateWordCount(this, 'penjelasanCount${kegiatanCount}', 1000)"></textarea>
                    <p id="penjelasanCount${kegiatanCount}" class="text-xs text-slate-400 flex justify-end ">
                    <?= (isset($pendaftaran['keberhasilan']) && strlen(trim($pendaftaran['pihak_dan_peran'])) > 0) ? str_word_count($pendaftaran['deskripsi_kegiatan']) : 0 ?>/1000 Kata</p>
                </div>
                    </div>

                <!-- Kolom kanan -->
                <div class="space-y-4">
                        <div>
                            <label class="block mb-2 text-sm text-black">Lokasi Kegiatan</label>
                            <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm text-black">Koordinat Lokasi Kegiatan</label>
                            <input disabled type="text" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none " />
                        </div>
                        <div>
                    <label class="block mb-2 text-sm text-black">Para Pihak dan Perannya</label>
                    <textarea disabled id="pihakPeran${kegiatanCount}" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
                        oninput="updateWordCount(this, 'pihakPeranCount${kegiatanCount}', 1000)"></textarea>
                    <p id="pihakPeranCount${kegiatanCount}" class="text-xs text-slate-400 flex justify-end ">0/1000 Kata</p>
                </div>
                        <div>
                    <label class="block mb-2 text-sm text-black">Keberhasilan yang Dicapai</label>
                    <textarea disabled id="keberhasilan${kegiatanCount}" class="w-full bg-transparent placeholder:text-slate-400 text-slate-400 text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none  transition duration-300 ease" rows="4"
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
    </script>

</body>

</html>