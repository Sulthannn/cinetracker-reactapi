<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/* Public */
$routes->get('/', 'Home::index', ['filter' => 'visitorcounter']);
$routes->get('/beranda', 'MainController::beranda');
$routes->get('profil', 'MainController::profil');
$routes->get('kategori', 'MainController::kategori');
$routes->get('kategoria', 'MainController::kategoria');
$routes->get('kategorib', 'MainController::kategorib');
$routes->get('kategoric', 'MainController::kategoric');
$routes->get('kategorid', 'MainController::kategorid');
$routes->get('kontak', 'MainController::kontak');
$routes->post('kontak/sendEmail', 'KontakController::sendEmail');
$routes->get('pamflet/(:any)', 'MainController::showPamflet/$1');
$routes->get('capaian/(:any)', 'MainController::showCapaian/$1');
$routes->get('calendar/events', 'CalendarController::events');
// $routes->get('pencapaian', 'MainController::pencapaian');


/* Protaru */
$routes->get('protaru', 'MainController::protaru');



/* Informasi */
$routes->get('informasi/pengumuman', 'InformasiController::pengumuman');
$routes->get('informasi/peraturan-kebijakan', 'InformasiController::peraturan');
$routes->get('informasi/datastatistik', 'InformasiController::datastatistik');
$routes->get('informasi/penerima/(:segment)', 'InformasiController::arsipByProvinsi/$1');
$routes->get('informasi/arsip-penerima', 'InformasiController::arsipPenerima');
$routes->get('informasi/arsip-perintis', 'InformasiController::arsipPerintis');
$routes->get('informasi/arsip-pengabdi', 'InformasiController::arsipPengabdi');
$routes->get('informasi/arsip-penyelamat', 'InformasiController::arsipPenyelamat');
$routes->get('informasi/arsip-pembina', 'InformasiController::arsipPembina');
$routes->get('pengumuman/(:any)', 'InformasiController::detailpengumuman/$1');
$routes->get('informasi/datausulanprovinsi', 'InformasiController::datausulanprovinsi');
$routes->get('informasi/profilpenerima', 'InformasiController::profilpenerima');
$routes->get('informasi/detaildataprovinsi', 'InformasiController::detaildataprovinsi');
$routes->get('informasi/profil-penerima/(:num)', 'InformasiController::profilPenerima/$1');



/* Publikasi */
$routes->get('publikasi/berita', 'PublikasiController::berita');
$routes->get('berita/(:any)', 'PublikasiController::detailberita/$1');
$routes->get('publikasi/artikel', 'PublikasiController::artikel');
$routes->get('artikel/(:any)', 'PublikasiController::detailartikel/$1');
$routes->get('publikasi/video', 'PublikasiController::video');
$routes->get('publikasi/buku', 'PublikasiController::buku');
$routes->get('buku/detail/(:num)', 'PublikasiController::detailBuku/$1');

/* Auth Pengguna */
$routes->get('/login', 'PenggunaController::loginpage');
$routes->post('/login', 'PenggunaController::login');
$routes->get('/register', 'PenggunaController::registerpage');
$routes->post('/register', 'PenggunaController::register');
$routes->get('/verify', 'PenggunaController::verifypage');
$routes->post('/verify', 'PenggunaController::verify');


/* Auth Penerima */
$routes->get('auth/loginpenerima', 'AuthController::loginPenerima');
$routes->post('auth/loginpenerima', 'AuthController::loginPenerimaAction');

/* Auth Pengusul */
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/login', 'AuthController::loginAction');
$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/register', 'AuthController::createRegister');
$routes->get('auth/logout', 'AuthController::logoutAction');
$routes->get('auth/logoutinternal', 'AuthController::logoutInternal');


/* Auth Internal */
$routes->get('auth/logininternal', 'AuthController::logininternal');
$routes->post('auth/logininternal', 'AuthController::logininternalAction');
$routes->get('auth/registerinternal', 'AuthController::registerinternal');
$routes->post('auth/registerinternal', 'AuthController::createRegisterinternal');
$routes->get('auth/loginadmin', 'AuthController::loginadmin');
$routes->get('auth/logintimteknis', 'AuthController::logintimteknis');
$routes->post('auth/logintimteknis', 'AuthController::logintimteknisAction');
$routes->get('auth/logindppk', 'AuthController::logindppk');
$routes->post('auth/logindppk', 'AuthController::logindppkAction');

$routes->get('auth/forgot-password', 'AuthController::forgotPassword');
$routes->post('auth/forgot-password', 'AuthController::sendResetLink');
$routes->get('auth/reset-password/(:any)', 'AuthController::resetPassword/$1');
$routes->post('auth/reset-password', 'AuthController::processResetPassword');

/* Pengusul */
$routes->group('pengusul', ['filter' => 'auth'], function ($routes) {
    $routes->get('profil', 'PengusulController::index');
    $routes->post('profil', 'PengusulController::updateProfil');

    // Route for "Tambah Calon" step 1 (Category selection)
    $routes->get('tambahcalon', 'PengusulController::tambahcalon');
    $routes->post('tambahcalon', 'PengusulController::inputKategori'); // Handle category selection form submission

    // Route for "Tambah Calon" step 2 (Identitas)
    $routes->get('tambahcalonidentitas', 'PengusulController::tambahCalonIdentitas');
    $routes->post('simpancalonidentitas', 'PengusulController::simpanCalonIdentitas'); // Handle the form submission

    $routes->post('simpanForm/(:any)', 'PengusulController::simpanForm/$1');
    $routes->get('detailusulansayaedit/(:num)', 'PengusulController::detailUsulanSayaEdit/$1');
    $routes->post('hapususulan/(:num)', 'PengusulController::hapusUsulan/$1');

    // --------------------------

    // Routes usulan saya
    $routes->get('usulansaya', 'PengusulController::usulansaya');
    $routes->get('usulandlhk', 'PengusulController::usulandlhk');
    $routes->get('detailusulansaya/(:num)', 'PengusulController::detailusulansaya/$1');
    $routes->get('detailusulandlhk', 'PengusulController::detailusulandlhk');

    // Routes update status
    $routes->post('usulansaya', 'PengusulController::updateStatus');

    // Routes artikel
    $routes->get('artikel-saya', 'PengusulController::artikelsaya');
    $routes->get('tambah-artikel', 'PengusulController::tambahartikel');
    $routes->post('tambah-artikel', 'PengusulController::tambahArtikelAction');
    $routes->get('artikel/(:any)', 'PengusulController::detailartikel/$1');

    $routes->get('pemberitahuan', 'PengusulController::pemberitahuan');
    $routes->get('alurpendaftaran', 'PengusulController::alurpendaftaran');
    $routes->get('videopanduan', 'PengusulController::videopanduan');
    $routes->get('panduanpendaftaran', 'PengusulController::panduanpendaftaran');
    $routes->get('downloadSuratPengantar/(:any)', 'AuthController::downloadSuratPengantar/$1');

    $routes->get('pdf/(:any)', 'PengusulController::generatePDF/$1');
    $routes->get('preview/ktp/(:any)', 'PengusulController::showKTP/$1');
    $routes->get('preview/fotokegiatan/(:num)/(:any)', 'PengusulController::showFotoKegiatan/$1/$2');
    $routes->get('download/fotokegiatan/(:num)/(:any)', 'PengusulController::downloadFotoKegiatan/$1/$2');
    $routes->get('download/skck/(:any)', 'PengusulController::downloadSKCK/$1');
    $routes->get('download/ktp/(:any)', 'PengusulController::downloadKTP/$1');
    $routes->get('download/legalitas/(:any)', 'PengusulController::downloadLegalitas/$1');
});


/* Penerima */
$routes->group('penerima', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'PenerimaController::dashboard');
    $routes->get('tambah-artikel', 'PenerimaController::tambahartikel');
    $routes->post('tambah-artikel', 'PenerimaController::tambahArtikelAction');
    $routes->get('artikel/(:any)', 'PenerimaController::detailartikel/$1');
});

/* Admin */
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('datacalon', 'AdminController::datacalon');
    $routes->get('exportexcel', 'AdminController::exportToExcel');
    $routes->post('updatestatuspendaftaran', 'AdminController::updateStatusPendaftaran');
    $routes->get('detaildatacalon/(:num)', 'AdminController::detailDataCalon/$1');
    $routes->get('preview/ktp/(:any)', 'PengusulController::showKTP/$1');
    $routes->get('preview/fotokegiatan/(:num)/(:any)', 'PengusulController::showFotoKegiatan/$1/$2');
    $routes->get('nominasi', 'AdminController::nominasi');
    $routes->get('sidang1', 'AdminController::sidang1');
    $routes->get('sidang2', 'AdminController::sidang2');
    $routes->get('editpamflet/(:num)', 'AdminController::editpamflet/$1');
    $routes->post('editpamflet/(:num)', 'AdminController::editpamfletAction/$1');
    $routes->get('preview/pamflet/(:any)', 'AdminController::showPamflet/$1');
    $routes->get('postercapaian', 'AdminController::postercapaian');
    $routes->post('editcapaian', 'AdminController::editcapaian');

    // Manajemen Akun Penerima Penghargaan Kalpataru
    $routes->get('akunpenerima', 'AdminController::akunpenerima');
    $routes->post('akunpenerima/hapus/(:num)', 'AdminController::hapusPenerima/$1');
    $routes->post('updatepenerima', 'AdminController::updatePenerima');
    $routes->get('daftarpenerima', 'AuthController::registerPenerima');
    $routes->post('daftarpenerima', 'AuthController::createregisterPenerima');

    // Manajemen Akun Tim Teknis
    $routes->get('akuntimteknis', 'AdminController::akuntimteknis');
    $routes->post('akuntimteknis/hapus/(:num)', 'AdminController::hapusTimTeknis/$1');
    $routes->post('updatetimteknis', 'AdminController::updateTimTeknis');
    $routes->get('daftartimteknis', 'AuthController::registerTimTeknis');
    $routes->post('daftartimteknis', 'AuthController::createRegisterTimTeknis');

    // Manajemen Akun DPPK
    $routes->get('akundppk', 'AdminController::akundppk');
    $routes->post('akundppk/hapus/(:num)', 'AdminController::hapusDppk/$1');
    $routes->post('updatedppk', 'AdminController::updateDppk');
    $routes->get('daftardppk', 'AuthController::registerDPPK');
    $routes->post('daftardppk', 'AuthController::createRegisterDPPK');

    // Manajemen Akun DLHK
    $routes->get('akundlhk', 'AdminController::akundlhk');
    $routes->get('daftarakundlhk', 'AuthController::registerDLHK');
    $routes->post('daftarakundlhk', 'AuthController::createRegisterDLHK');

    // Manajemen Akun Pengusul
    $routes->get('pengusul', 'AdminController::akunpengusul');
    $routes->post('pengusul/hapus/(:num)', 'AdminController::hapusPengusul/$1');
    $routes->post('updatepengusul', 'AdminController::updatePengusul');
    $routes->get('pengusul/detail/(:any)', 'AdminController::detailPengusul/$1');
    $routes->get('download/suratpengantar/(:segment)', 'AdminController::downloadSuratPengantar/$1');

    // Manajemen Arsip Penerima
    $routes->get('arsippenerima', 'AdminController::arsippenerima');
    $routes->post('arsip/hapus/(:num)', 'AdminController::hapusArsip/$1');
    $routes->get('tambaharsippenerima', 'AdminController::tambaharsip');
    $routes->post('tambaharsippenerima', 'AdminController::tambahArsipAction');
    $routes->get('arsip/edit/(:any)', 'AdminController::editArsip/$1');
    $routes->post('arsip/edit/(:any)', 'AdminController::editArsipAction/$1');
    $routes->get('exportarsip', 'AdminController::exportArsipToExcel');

    // Manajemen Artikel
    $routes->get('artikel', 'AdminController::artikeladmin');
    $routes->get('tambah-artikel', 'AdminController::tambahartikeladmin');
    $routes->post('tambah-artikel', 'AdminController::tambahArtikelAction');
    $routes->get('artikel/edit/(:any)', 'AdminController::editArtikel/$1');
    $routes->post('artikel/edit/(:any)', 'AdminController::updateArtikelAction/$1');
    $routes->get('artikel/(:any)', 'AdminController::detailartikel/$1');
    $routes->post('artikel/hapus/(:num)', 'AdminController::hapusArtikel/$1');
    // $routes->post('updatestatus', 'AdminController::updateStatus');
    $routes->post('updatestatusartikel', 'AdminController::updateStatusArtikel');


    // Manajemen Berita
    $routes->get('berita', 'AdminController::beritaAdmin');
    $routes->get('tambah-berita', 'AdminController::tambahberitaadmin');
    $routes->post('tambah-berita', 'AdminController::tambahBeritaAction');
    $routes->get('berita/edit/(:any)', 'AdminController::editBerita/$1');
    $routes->post('berita/edit/(:any)', 'AdminController::updateBeritaAction/$1');
    $routes->get('berita/(:any)', 'AdminController::detailberita/$1');
    $routes->post('berita/hapus/(:num)', 'AdminController::hapusBerita/$1');
    $routes->post('updatestatusberita', 'AdminController::updateStatusBerita');

    // Manajemen Pengumuman
    $routes->get('pengumuman', 'AdminController::pengumumanadmin');
    $routes->get('tambah-pengumuman', 'AdminController::tambahpengumuman');
    $routes->post('tambah-pengumuman', 'AdminController::tambahPengumumanAction');
    $routes->get('pengumuman/edit/(:any)', 'AdminController::editPengumuman/$1');
    $routes->post('pengumuman/edit/(:any)', 'AdminController::updatePengumumanAction/$1');
    $routes->get('pengumuman/(:any)', 'AdminController::detailpengumuman/$1');
    $routes->post('pengumuman/hapus/(:num)', 'AdminController::hapusPengumuman/$1');
    $routes->post('updatestatuspengumuman', 'AdminController::updateStatusPengumuman');

    // Manajemen Video
    $routes->get('video', 'AdminController::videoAdmin');
    $routes->get('tambah-video', 'AdminController::tambahvideo');
    $routes->post('tambah-video', 'AdminController::tambahVideoAction');
    $routes->get('video/edit/(:any)', 'AdminController::editVideo/$1');
    $routes->post('video/edit/(:any)', 'AdminController::updateVideoAction/$1');
    $routes->get('video/(:any)', 'AdminController::detailvideo/$1');
    $routes->post('video/hapus/(:num)', 'AdminController::hapusVideo/$1');
    $routes->post('updatestatusvideo', 'AdminController::updateStatusVideo');

    // Manajemen Buku Kalpataru
    $routes->get('buku-kalpataru', 'AdminController::bukuAdmin');
    $routes->get('tambah-buku', 'AdminController::tambahbuku');
    $routes->post('tambah-buku', 'AdminController::tambahBukuAction');
    $routes->get('buku-kalpataru/edit/(:any)', 'AdminController::editBuku/$1');
    $routes->post('buku-kalpataru/edit/(:any)', 'AdminController::updateBukuAction/$1');
    $routes->get('buku-kalpataru/(:any)', 'AdminController::detailBuku/$1');
    $routes->post('buku-kalpataru/hapus/(:num)', 'AdminController::hapusBuku/$1');
    $routes->post('updatestatusbuku', 'AdminController::updateStatusBuku');

    // Manajemen Peraturan dan Kebijakan
    $routes->get('peraturan-kebijakan', 'AdminController::peraturanadmin');
    $routes->get('peraturan-kebijakan/tambah', 'AdminController::tambahperaturan');
    $routes->post('peraturan-kebijakan/tambah', 'AdminController::tambahPeraturanAction');
    $routes->get('peraturan-kebijakan/edit/(:any)', 'AdminController::editPeraturan/$1');
    $routes->post('peraturan-kebijakan/edit/(:any)', 'AdminController::updatePeraturanAction/$1');
    $routes->get('peraturan-kebijakan/(:any)', 'AdminController::detailperaturan/$1');
    $routes->post('peraturan-kebijakan/hapus/(:num)', 'AdminController::hapusPeraturan/$1');
    $routes->post('updatestatusperaturan', 'AdminController::updateStatusPeraturan');

    $routes->get('pdf/(:any)', 'AdminController::exportPDF/$1');
    $routes->get('download/ktp/(:any)', 'PengusulController::downloadKTP/$1');
    $routes->get('download/skck/(:any)', 'PengusulController::downloadSKCK/$1');
    $routes->get('download/legalitas/(:any)', 'PengusulController::downloadLegalitas/$1');
    $routes->get('download/fotokegiatan/(:num)/(:any)', 'PengusulController::downloadFotoKegiatan/$1/$2');
});

/* Tim Teknis */
$routes->group('timteknis', ['filter' => 'auth'], function ($routes) {
    $routes->get('datacalonusulan', 'TimteknisController::datacalonusulan');
    $routes->get('detaildatacalonusulan/(:num)', 'TimteknisController::detaildatacalonusulan/$1');
    $routes->get('preview/ktp/(:any)', 'PengusulController::showKTP/$1');
    $routes->get('preview/fotokegiatan/(:num)/(:any)', 'PengusulController::showFotoKegiatan/$1/$2');
    $routes->get('pdf/(:any)', 'TimteknisController::exportPDF/$1');
    $routes->get('download/suratpengantar/(:segment)', 'TimteknisController::downloadSuratPengantar/$1');

    $routes->get('verifadminkategoria', 'TimteknisController::verifadminkategoria');
    $routes->get('verifadminkategorib', 'TimteknisController::verifadminkategorib');
    $routes->get('verifadminkategoric', 'TimteknisController::verifadminkategoric');
    $routes->get('verifadminkategorid', 'TimteknisController::verifadminkategorid');
    $routes->post('updatestatus', 'TimteknisController::updateStatus');


    $routes->get('bahansidang1/kategoria', 'TimteknisController::bahansidang1kategoria');
    $routes->get('bahansidang1/kategorib', 'TimteknisController::bahansidang1kategorib');
    $routes->get('bahansidang1/kategoric', 'TimteknisController::bahansidang1kategoric');
    $routes->get('bahansidang1/kategorid', 'TimteknisController::bahansidang1kategorid');

    $routes->get('bahansidang2/kategoria', 'TimteknisController::bahansidang2kategoria');
    $routes->get('bahansidang2/kategorib', 'TimteknisController::bahansidang2kategorib');
    $routes->get('bahansidang2/kategoric', 'TimteknisController::bahansidang2kategoric');
    $routes->get('bahansidang2/kategorid', 'TimteknisController::bahansidang2kategorid');

    $routes->get('download/ktp/(:any)', 'PengusulController::downloadKTP/$1');
    $routes->get('download/skck/(:any)', 'PengusulController::downloadSKCK/$1');
    $routes->get('download/legalitas/(:any)', 'PengusulController::downloadLegalitas/$1');
    $routes->get('download/fotokegiatan/(:num)/(:any)', 'PengusulController::downloadFotoKegiatan/$1/$2');
});

/* DPPK */
$routes->group('dppk', ['filter' => 'auth'], function ($routes) {
    $routes->get('datacalonusulan', 'DppkController::datacalonusulan');
    $routes->get('detaildatacalonusulan', 'DppkController::detaildatacalonusulan');

    $routes->get('bahansidang1', 'DppkController::bahansidang1');
    $routes->get('bahansidang2', 'DppkController::bahansidang2');

    $routes->get('pdf/(:any)', 'DppkController::exportPDF/$1');
});

/* Pengguna */
$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PenggunaController::dashboard');
});
