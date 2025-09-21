<?php 
$prefix = session()->get('prefix'); 
$kegiatan = $kegiatan ?? [];
$dampak['dampak_lingkungan'] = $dampak['dampak_lingkungan'] ?? '';
$dampak['dampak_ekonomi'] = $dampak['dampak_ekonomi'] ?? '';
$dampak['dampak_sosial_budaya'] = $dampak['dampak_sosial_budaya'] ?? '';
$pmik['prakarsa'] = $pmik['prakarsa'] ?? '';
$pmik['motivasi'] = $pmik['motivasi'] ?? '';
$pmik['inovasi'] = $pmik['inovasi'] ?? '';
$pmik['kreativitas'] = $pmik['kreativitas'] ?? '';
$keswadayaan['sumber_biaya'] = $keswadayaan['sumber_biaya'] ?? '';
$keswadayaan['teknologi_kegiatan'] = $keswadayaan['teknologi_kegiatan'] ?? '';
$keswadayaan['status_lahan_kegiatan'] = $keswadayaan['status_lahan_kegiatan'] ?? '';
$keswadayaan['jumlah_kelompok_serupa'] = $keswadayaan['jumlah_kelompok_serupa'] ?? '';
$keistimewaan['keistimewaan'] = $keistimewaan['keistimewaan'] ?? '';
$keistimewaan['penghargaan'] = $keistimewaan['penghargaan'] ?? '';

$temaMapping = [
    'keanekaragaman-hayati' => 'Keanekaragaman Hayati',
    'perubahan-iklim' => 'Perubahan Iklim',
    'pencemaran-dan-kerusakan-lingkungan' => 'Pencemaran dan Kerusakan Lingkungan',
    'hukum-dan-budaya' => 'Hukum dan Budaya'
];

$subTemaMapping = [
    'pelestarian-keanekaragaman-hayati-kawasan-dilindungi-yang-meliputi-pelestarian-sumber-daya-genetik-jenis-dan-ekosistem' => 'Pelestarian keanekaragaman hayati dan kawasan dilindungi yang meliputi pelestarian sumber daya genetik, jenis, dan ekosistem',
    'pemanfaatan-keanekaragaman-hayati-berkelanjutan' => 'Pemanfaatan keanekaragaman hayati secara berkelanjutan',
    'jasa-lingkungan' => 'Jasa lingkungan',
    'adaptasi-perubahan-iklim' => 'Adaptasi perubahan iklim',
    'mitigasi-perubahan-iklim' => 'Mitigasi perubahan iklim',
    'penerapan-ekonomi-hijau-biru' => 'Penerapan ekonomi hijau dan ekonomi biru',
    'penanganan-pencemaran-air-tanah-udara-yang-meliputi-industri-pertanian-domestik-terutama-plastik' => 'Penanganan pencemaran air, tanah, udara dari industri, pertanian, domestik terutama plastik',
    'pencegahan-dan-penanggulangan-kerusakan-lingkungan' => 'Pencegahan dan penanggulangan kerusakan lingkungan',
    'ekonomi-sirkular' => 'Ekonomi sirkular',
    'keadilan-pemanfaatan-sumber-daya-alam-dan-lingkungan' => 'Keadilan terhadap pemanfaatan sumber daya alam dan lingkungan',
    'kearifan-tradisional-dalam-pengelolaan-sumber-daya-alam' => 'Kearifan tradisional dalam pengelolaan sumber daya alam',
    'komunikasi-pendidikan-lingkungan-hidup' => 'Komunikasi dan pendidikan lingkungan hidup'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Usulan Calon</title>
    <link href="https://fonts.googleapis.com/css2?family=Carlito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Carlito', sans-serif;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            padding-left: 25px;
        }
        td {
            padding: 8px;
            border: 1px solid black;
            vertical-align: top;
        }
        .heading {
            font-size: 24px;
            font-weight:bold;
        }
        .label {
            width: 35%;
        }
        .separator {
            width: 5%;
            text-align: center;
        }
        .input {
            width: 60%;
        }
        .indented {
            padding-left: 50px;
        }
    </style>
</head>
<body>
    <p style="font-size: 28px; font-weight:bold; text-align:center; margin-left:75px;">FORMULIR USULAN PENGHARGAAN KALPATARU TAHUN 2025</p>

    <p class="heading">A. IDENTITAS PENGUSUL</p>
    <table>
    <tr><td class="label">Nama Lengkap</td><td class="separator">:</td><td class="input"><?= $pengusul['nama_instansi_pribadi']; ?></td></tr>
        <tr><td class="label">Jenis Kelamin</td><td class="separator">:</td><td class="input"><?= $pengusul['jenis_kelamin']; ?></td></tr>
        <tr><td class="label">Instansi/Lembaga/Organisasi/Individu</td><td class="separator">:</td><td class="input"><?= $pengusul['jenis_instansi']; ?></td></tr>
        <tr><td class="label">Jabatan/Pekerjaan</td><td class="separator">:</td><td class="input"><?= $pengusul['jabatan_pekerjaan']; ?></td></tr>
        <tr><td class="label" style="border-right:none;">Alamat :</td><td class="separator" style="border-left: none; border-right:none;"></td><td class="input" style="border-left: none;"></td></tr>
        <tr><td class="label indented">Jalan</td><td class="separator">:</td><td class="input"><?= $pengusul['jalan']; ?></td></tr>
        <tr><td class="label indented">RT/RW</td><td class="separator">:</td><td class="input"><?= $pengusul['rt_rw']; ?></td></tr>
        <tr><td class="label indented">Desa/Kelurahan</td><td class="separator">:</td><td class="input"><?= $pengusul['desa']; ?></td></tr>
        <tr><td class="label indented">Kecamatan</td><td class="separator">:</td><td class="input"><?= $pengusul['kecamatan']; ?></td></tr>
        <tr><td class="label indented">Kabupaten/Kota</td><td class="separator">:</td><td class="input"><?= $pengusul['kab_kota']; ?></td></tr>
        <tr><td class="label indented">Provinsi</td><td class="separator">:</td><td class="input"><?= $pengusul['provinsi']; ?></td></tr>
        <tr><td class="label indented">Kode Pos</td><td class="separator">:</td><td class="input"><?= $pengusul['kode_pos']; ?></td></tr>
        <tr><td class="label">Nomor HP/Telepon</td><td class="separator">:</td><td class="input"><?= $pengusul['telepon']; ?></td></tr>
        <tr><td class="label">Email Aktif</td><td class="separator">:</td><td class="input"><?= $pengusul['email']; ?></td></tr>
        <tr><td class="label">Nama Calon yang diusulkan</td><td class="separator">:</td><td class="input"><?= $pendaftaran['nama']; ?><</td></tr>
    </table>

    <p class="heading">B. IDENTITAS CALON</p>
    <table>
        <?php if ($prefix === 'C'): ?>
        <tr><td class="label">Nama Kelompok/Komunitas</td><td class="separator">:</td><td class="input"><?= $pendaftaran['nama_kelompok']; ?><</td></tr>
        <tr><td class="label">Tahun Berdirinya Kelompok/Komunitas</td><td class="separator">:</td><td class="input"><?= $pendaftaran['tahun_pembentukan']; ?></td></tr>
        <tr><td class="label">Jumlah Anggota</td><td class="separator">:</td><td class="input"><?= $pendaftaran['jumlah_anggota']; ?></td></tr>
        <tr><td class="label">Nama Ketua</td><td class="separator">:</td><td class="input"><?= $pendaftaran['nama']; ?></td></tr>
        <tr><td class="label">Nomor Identitas Kependudukan (NIK) Ketua</td><td class="separator">:</td><td class="input"><?= $pendaftaran['nik']; ?></td></tr>
        <tr><td class="label">Tempat Lahir Ketua</td><td class="separator">:</td><td class="input"><?= $pendaftaran['tempat_lahir']; ?></td></tr>
        <tr><td class="label">Tanggal Lahir Ketua</td><td class="separator">:</td><td class="input"><?= $pendaftaran['tanggal_lahir']; ?></td></tr>
        <tr><td class="label">Usia</td><td class="separator">:</td><td class="input"><?= $pendaftaran['usia']; ?></td></tr>
        <tr><td class="label">Jenis Kelamin Ketua</td><td class="separator">:</td><td class="input"><?= $pendaftaran['jenis_kelamin']; ?></td></tr>
        <?php endif; ?>

        <?php if ($prefix !== 'C'): ?>
        <tr><td class="label">Nama Lengkap</td><td class="separator">:</td><td class="input"><?= $pendaftaran['nama']; ?></td></tr>
        <tr><td class="label">Nomor Identitas Kependudukan (NIK)</td><td class="separator">:</td><td class="input"><?= $pendaftaran['nik']; ?></td></tr>
        <tr><td class="label">Tempat Lahir</td><td class="separator">:</td><td class="input"><?= $pendaftaran['tempat_lahir']; ?></td></tr>
        <tr><td class="label">Tanggal Lahir</td><td class="separator">:</td><td class="input"><?= $pendaftaran['tanggal_lahir']; ?></td></tr>
        <tr><td class="label">Usia</td><td class="separator">:</td><td class="input"><?= $pendaftaran['usia']; ?></td></tr>
        <tr><td class="label">Jenis Kelamin</td><td class="separator">:</td><td class="input"><?= $pendaftaran['jenis_kelamin']; ?></td></tr>
        <?php endif; ?>

        <tr><td class="label" style="border-right:none;">Alamat :</td><td class="separator" style="border-left: none; border-right:none;"></td><td class="input" style="border-left: none;"></td></tr>
        <tr><td class="label indented">Jalan</td><td class="separator">:</td><td class="input"><?= $pendaftaran['jalan']; ?></td></tr>
        <tr><td class="label indented">RT/RW</td><td class="separator">:</td><td class="input"><?= $pendaftaran['rt_rw']; ?></td></tr>
        <tr><td class="label indented">Desa/Kelurahan</td><td class="separator">:</td><td class="input"><?= $pendaftaran['desa']; ?></td></tr>
        <tr><td class="label indented">Kecamatan</td><td class="separator">:</td><td class="input"><?= $pendaftaran['kecamatan']; ?></td></tr>
        <tr><td class="label indented">Kabupaten/Kota</td><td class="separator">:</td><td class="input"><?= $pendaftaran['kab_kota']; ?></td></tr>
        <tr><td class="label indented">Provinsi</td><td class="separator">:</td><td class="input"><?= $pendaftaran['provinsi']; ?></td></tr>
        <tr><td class="label indented">Kode Pos</td><td class="separator">:</td><td class="input"><?= $pendaftaran['kode_pos']; ?></td></tr>
        <tr><td class="label">Pekerjaan</td><td class="separator">:</td><td class="input"><?= $pendaftaran['pekerjaan']; ?></td></tr>
        <tr><td class="label">Nomor HP/Telepon</td><td class="separator">:</td><td class="input"><?= $pendaftaran['telepon']; ?></td></tr>
        <tr><td class="label">Email Aktif</td><td class="separator">:</td><td class="input"><?= $pendaftaran['email']; ?></td></tr>
        <tr><td class="label">Media sosial (Instagram, Facebook, Blog, website dll), Liputan Media, Publikasi</td><td class="separator">:</td><td class="input"><?= $pendaftaran['sosial_media']; ?></td></tr>

        <?php if ($prefix !== 'C'): ?>
        <tr><td class="label">Pendidikan Terakhir yang ditempuh oleh Calon</td><td class="separator">:</td><td class="input"><?= $pendaftaran['pendidikan']; ?></td></tr>
        <?php endif; ?>

        <?php if ($prefix === 'C'): ?>
        <tr><td class="label">Pendidikan Terakhir yang ditempuh oleh Calon (Ketua)</td><td class="separator">:</td><td class="input"><?= $pendaftaran['pendidikan']; ?></td></tr>
        <?php endif; ?>

    </table>

    <p class="heading" style="margin-bottom: 0px;">C. KEGIATAN CALON</p>
    <?php if (!empty($kegiatan)): ?>
        <p class="heading" style="margin: 0px; padding-left: 25px;">1. Kegiatan Utama yang dilakukan oleh calon</p>
        <table style="margin: 0px;">
            <tr><td class="label">Tema Kegiatan</td><td class="separator">:</td><td class="input"><?= $temaMapping[$kegiatan[0]['tema']] ?? $kegiatan[0]['tema']; ?></td></tr>
            <tr><td class="label">Sub Tema Kegiatan</td><td class="separator">:</td><td class="input"><?= $subTemaMapping[$kegiatan[0]['sub_tema']] ?? $kegiatan[0]['sub_tema']; ?></td></tr>
            <tr><td class="label">Jenis Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan[0]['bentuk_kegiatan']; ?></td></tr>
            <tr><td class="label">Tahun Mulai Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan[0]['tahun_mulai']; ?></td></tr>
            <tr><td class="label">Penjelasan Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan[0]['deskripsi_kegiatan']; ?></td></tr>
            <tr><td class="label">Lokasi Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan[0]['lokasi_kegiatan']; ?></td></tr>
            <tr><td class="label">Koordinat</td><td class="separator">:</td><td class="input"><?= $kegiatan[0]['koordinat']; ?></td></tr>
            <tr><td class="label">Para Pihak dan Perannya</td><td class="separator">:</td><td class="input"><?= $kegiatan[0]['pihak_dan_peran']; ?></td></tr>
            <tr><td class="label">Keberhasilan yang telah dicapai</td><td class="separator">:</td><td class="input"><?= $kegiatan[0]['keberhasilan']; ?></td></tr>
        </table>

        <?php if (count($kegiatan) > 1): ?>
            <p class="heading" style="margin-bottom: 0px; padding-left: 25px;">2. Kegiatan Lainnya yang dilakukan oleh calon</p>
            <?php foreach (array_slice($kegiatan, 1) as $index => $kegiatan_lain): ?>
                <p class="heading" style="margin: 0px; padding-left: 50px;">a. Kegiatan Lain (<?= $index + 1; ?>)</p>
                <table style="margin: 0px;">
                    <tr><td class="label">Tema Kegiatan</td><td class="separator">:</td><td class="input"><?= $temaMapping[$kegiatan_lain['tema']] ?? $kegiatan_lain['tema']; ?></td></tr>
                    <tr><td class="label">Sub Tema Kegiatan</td><td class="separator">:</td><td class="input"><?= $subTemaMapping[$kegiatan_lain['sub_tema']] ?? $kegiatan_lain['sub_tema']; ?></td></tr>
                    <tr><td class="label">Jenis Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan_lain['bentuk_kegiatan']; ?></td></tr>
                    <tr><td class="label">Tahun Mulai Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan_lain['tahun_mulai']; ?></td></tr>
                    <tr><td class="label">Penjelasan Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan_lain['deskripsi_kegiatan']; ?></td></tr>
                    <tr><td class="label">Lokasi Kegiatan</td><td class="separator">:</td><td class="input"><?= $kegiatan_lain['lokasi_kegiatan']; ?></td></tr>
                    <tr><td class="label">Koordinat</td><td class="separator">:</td><td class="input"><?= $kegiatan_lain['koordinat']; ?></td></tr>
                    <tr><td class="label">Para Pihak dan Perannya</td><td class="separator">:</td><td class="input"><?= $kegiatan_lain['pihak_dan_peran']; ?></td></tr>
                    <tr><td class="label">Keberhasilan yang telah dicapai</td><td class="separator">:</td><td class="input"><?= $kegiatan_lain['keberhasilan']; ?></td></tr>
                </table>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>

    <p class="heading">D. DAMPAK KEGIATAN</p>
    <table>
        <tr><td class="label">Dampak kegiatan terhadap lingkungan</td><td class="separator">:</td><td class="input"><?=$dampak['dampak_lingkungan']; ?></td></tr>
        <tr><td class="label">Dampak Ekonomi</td><td class="separator">:</td><td class="input"><?=$dampak['dampak_ekonomi']; ?></td></tr>
        <tr><td class="label">Dampak Sosial dan Budaya</td><td class="separator">:</td><td class="input"><?=$dampak['dampak_sosial_budaya']; ?></td></tr>
    </table>

    <p class="heading">E. PRAKARSA, MOTIVASI, INOVASI DAN KREATIFITAS (PMIK)</p>
    <table>
        <tr><td class="label">Prakarsa</td><td class="separator">:</td><td class="input"><?= $pmik['prakarsa']; ?></td></tr>
        <tr><td class="label">Motivasi</td><td class="separator">:</td><td class="input"><?= $pmik['motivasi']; ?></td></tr>
        <tr><td class="label">Inovasi</td><td class="separator">:</td><td class="input"><?= $pmik['inovasi']; ?></td></tr>
        <tr><td class="label">Kreatifitas</td><td class="separator">:</td><td class="input"><?= $pmik['kreativitas']; ?></td></tr>
    </table>

    <p class="heading">F. KESWADAYAAN DAN KEBERLANJUTAN</p>
    <table>
        <tr><td class="label">Sumber Pembiayaan Kegiatan</td><td class="separator">:</td><td class="input"><?= $keswadayaan['sumber_biaya']; ?></td></tr>
        <tr><td class="label">Teknologi/Alat/Fasilitas yang digunakan</td><td class="separator">:</td><td class="input"><?= $keswadayaan['teknologi_kegiatan']; ?></td></tr>
        <tr><td class="label">Status Lahan/Areal Kegiatan</td><td class="separator">:</td><td class="input"><?= $keswadayaan['status_lahan_kegiatan']; ?></td></tr>
        <tr><td class="label">Kelompok/Perorangan yang meniru</td><td class="separator">:</td><td class="input"><?= $keswadayaan['jumlah_kelompok_serupa']; ?></td></tr>
    </table>

    <p class="heading">G. KEISTIMEWAAN CALON</p>
    <table>
        <tr><td class="label">Keistimewaan Calon</td><td class="separator">:</td><td class="input"><?= $keistimewaan['keistimewaan']; ?></td></tr>
        <tr><td class="label">Penghargaan Relevan yang diterima Calon</td><td class="separator">:</td><td class="input"><?= $keistimewaan['penghargaan']; ?></td></tr>
    </table>

</body>
</html>