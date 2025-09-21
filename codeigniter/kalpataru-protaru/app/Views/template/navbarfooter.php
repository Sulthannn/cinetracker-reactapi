<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title><?= $title; ?></title>
    <meta name="description" content="Website resmi Kalpataru, penghargaan bagi pelestari lingkungan di Indonesia. Temukan informasi, berita, dan program pelestarian alam terbaru.">
    <style>
        /* scrollbar */
        ::-webkit-scrollbar {
            width: 20px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, rgb(230, 156, 59), rgba(217, 237, 191, 1));
            border-radius: 10px;
            border: 3px solid #f1f1f1;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, rgb(207, 140, 53), rgba(195, 213, 172, 1));
            opacity: 30%;
            border-radius: 10px;
            border: 3px solid #f1f1f1;
        }

        /* cursor */
        /* .custom-cursor {
            cursor: none;
            position: fixed;
            width: 30px;
            height: 30px;
            background-color: rgba(217, 237, 191, 0.8);
            border: 3px solid #fff;
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 9999;
            transition: transform 0.1s ease-out, background-color 0.3s;
            animation: moveAnimation 0.2s ease-in-out;
            box-shadow: 0 0 10px rgba(217, 237, 191, 0.8), 
                0 0 20px rgba(217, 237, 191, 0.6), 
                0 0 30px rgba(217, 237, 191, 0.4);
        }

        @keyframes moveAnimation {
            0% {
                transform: translate(-50%, -50%) scale(1);
            }

            50% {
                transform: translate(-50%, -50%) scale(1.2);
            }

            100% {
                transform: translate(-50%, -50%) scale(1);
            }
        }

        * :hover~.custom-cursor {
            background-color: rgba(217, 237, 191, 1);
            transform: scale(1.5);
            box-shadow: 0 0 20px rgba(217, 237, 191, 1), 
                0 0 40px rgba(217, 237, 191, 0.8), 
                0 0 60px rgba(217, 237, 191, 0.6);
        } */

        /* selection */
        ::selection {
            background-color: #2C7865;
            color: white;
        }

        #map {
            height: 600px;
            border-radius: 10px;
        }

        .leaflet-control-attribution {
            display: none !important;
        }

        .info.legend {
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
        }

        .info.legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 1;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- scroll up -->
    <button id="scroll" class="z-10 fixed lg:bottom-14 lg:right-14 right-1/2 translate-x-1/2 bottom-1 text-white p-2 rounded-full hidden lg:opacity-100 opacity-50 transition-opacity duration-300">
        <img class="lg:w-14 lg:h-14 w-10 h-10" src="/images/scroll.svg" alt="Scroll Up">
    </button>
    <div class="custom-cursor" id="customCursor"></div>

    <!-- Navbar -->
    <nav class="my-5 block rounded-lg w-full max-w-screen-lg px-4 py-4 mx-auto bg-white bg-opacity-90 sticky top-3 shadow-lg lg:px-8 lg:py-3 backdrop-blur-lg backdrop-saturate-150 z-[888]">
        <div class="container flex flex-wrap items-center justify-between mx-auto text-slate-800">
            <a href="/" class="mr-4 block cursor-pointer py-1.5 text-base text-slate-800 font-semibold">
                <img src="/images/logo.png" alt="Logo" width="200">
            </a>
            <div class="hidden lg:block" id="desktop-menu">
                <ul class="flex flex-col gap-2 mt-2 mb-4 lg:mb-0 lg:mt-0 lg:flex-row lg:items-center lg:gap-6">
                    <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                        <a href="<?= base_url('/') ?>" class="flex items-center">Beranda</a>
                    </li>
                    <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                        <a href="<?= base_url('profil') ?>" class="flex items-center">Profil</a>
                    </li>
                    <li class="relative flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover group">
                        <button class="flex items-center">Informasi</button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                        <ul class="absolute left-0 top-full opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-all duration-300 transform bg-white shadow-lg border-opacity-5 border-2 mt-1 py-2 rounded-lg z-50">
                            <li><a href="<?= base_url('informasi/pengumuman') ?>" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Pengumuman</a></li>
                            <li><a href="<?= base_url('informasi/peraturan-kebijakan') ?>" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Peraturan dan Kebijakan</a></li>
                            <li><a href="<?= base_url('informasi/datastatistik') ?>" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Data dan Statistik</a></li>
                        </ul>
                    </li>
                    <li class="relative flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover group">
                        <button class="flex items-center">Publikasi</button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                        <ul class="absolute left-0 top-full opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-all duration-300 transform bg-white shadow-lg border-opacity-5 border-2 mt-1 py-2 rounded-lg z-50">
                            <li><a href="<?= base_url('publikasi/berita') ?>" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Berita</a></li>
                            <li><a href="<?= base_url('publikasi/artikel') ?>" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Artikel</a></li>
                            <li><a href="<?= base_url('publikasi/video') ?>" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Video</a></li>
                            <li><a href="<?= base_url('publikasi/buku') ?>" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Buku</a></li>
                        </ul>
                    </li>
                    <li class="relative flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover group">
                        <a href="#" class="flex items-center">SIHARU</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                        <ul class="absolute left-0 top-full opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-all duration-300 transform bg-white shadow-lg border-opacity-5 border-2 mt-1 py-2 rounded-lg z-50">
                            <li><a href="http://pskl.menlhk.go.id/" target="_blank" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">SI PSKL</a></li>
                            <li><a href="https://gokups.menlhk.go.id/" target="_blank" class="block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">goKUPS</a></li>
                        </ul>
                    </li>
                    <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                        <a href="<?= base_url('kontak') ?>" class="flex items-center">Kontak</a>
                    </li>
                    <?php if (session()->has('logged_in') && (session()->get('role_akun') === 'Pengusul' || session()->get('role_akun') === 'DLHK')): ?>
                        <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                            <a href="/pengusul/profil">
                                <button class="rounded-md bg-primary py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </a>
                        </li>
                    <?php elseif (session()->has('logged_in') && (session()->get('role') === 'admin')): ?>
                        <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                            <a href="/admin/dashboard">
                                <button class="rounded-md bg-primary py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </a>
                        </li>
                    <?php elseif (session()->has('logged_in') && (session()->get('role') === 'Tim Teknis')): ?>
                        <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                            <a href="/timteknis/datacalonusulan">
                                <button class="rounded-md bg-primary py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </a>
                        </li>
                    <?php elseif (session()->has('logged_in') && (session()->get('role') === 'Penerima')): ?>
                        <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                            <a href="/penerima/dashboard">
                                <button class="rounded-md bg-primary py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </a>
                        </li>
                    <?php elseif (session()->has('logged_in') && (session()->get('role') === 'DPPK')): ?>
                        <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                            <a href="/dppk/datacalonusulan">
                                <button class="rounded-md bg-primary py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Jika user belum login -->
                        <li class="flex items-center p-1 text-sm gap-x-2 text-primary hover:text-primaryhover">
                            <a href="<?= base_url('auth/login') ?>">
                                <button class="rounded-md bg-primary py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                    Masuk
                                </button>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <button class="relative ml-auto h-6 w-6 select-none rounded-lg lg:hidden" type="button" id="hamburger">
                <span class="block w-full h-0.5 bg-slate-800 transition-all duration-300 ease-in-out origin-center" id="line-1"></span>
                <span class="block w-full h-0.5 bg-slate-800 mt-1.5 transition-all duration-300 ease-in-out origin-center" id="line-2"></span>
                <span class="block w-full h-0.5 bg-slate-800 mt-1.5 transition-all duration-300 ease-in-out origin-center" id="line-3"></span>
            </button>
        </div>

        <!-- Mobile -->
        <div id="mobile-menu" class="lg:hidden hidden">
            <ul class="flex flex-col text-center text-primary hover:text-primaryhover rounded-lg">
                <li><a href="<?= base_url('/') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Beranda</a></li>
                <li><a href="<?= base_url('profil') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Profil</a></li>
                <li class="relative">
                    <button class="flex items-center w-full text-left px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary" onclick="toggleDropdown('dropdown-informasi')">Informasi
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="flex"></div>
                    <ul id="dropdown-informasi" class="hidden space-y-2 bg-white shadow-lg rounded-lg p-2">
                        <li><a href="<?= base_url('informasi/pengumuman') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Pengumuman</a></li>
                        <li><a href="<?= base_url('informasi/peraturan-kebijakan') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Peraturan dan Kebijakan</a></li>
                        <li><a href="<?= base_url('informasi/datastatistik') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Data dan Statistik</a></li>
                    </ul>
                </li>
                <li class="relative">
                    <button class="flex items-center w-full text-left px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary" onclick="toggleDropdown('dropdown-publikasi')">Publikasi
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul id="dropdown-publikasi" class="hidden space-y-2 bg-white shadow-lg rounded-lg p-2">
                        <li><a href="<?= base_url('publikasi/berita') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Berita</a></li>
                        <li><a href="<?= base_url('publikasi/artikel') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Artikel</a></li>
                        <li><a href="<?= base_url('publikasi/video') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Video</a></li>
                        <li><a href="<?= base_url('publikasi/buku') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Buku</a></li>
                    </ul>
                </li>
                <li class="relative">
                    <button class="flex items-center w-full text-left px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary" onclick="toggleDropdown('dropdown-siharu')">SIHARU
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul id="dropdown-siharu" class="hidden space-y-2 bg-white shadow-lg rounded-lg p-2">
                        <li><a href="http://pskl.menlhk.go.id/" target="_blank" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">SI PSKL</a></li>
                        <li><a href="https://gokups.menlhk.go.id/" target="_blank" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">goKUPS</a></li>
                    </ul>
                </li>
                <li><a href="<?= base_url('kontak') ?>" class="text-left block px-4 py-2 text-primary hover:text-primaryhover hover:bg-secondary">Kontak</a></li>
                <?php if (session()->has('logged_in')): ?>
                    <li class="flex justify-end">
                        <a href="/pengusul/profil">
                            <button class="rounded-md bg-primary py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="flex justify-end">
                        <a href="<?= base_url('auth/login') ?>">
                            <button class="text-left block px-4 py-2 rounded-md bg-primary border border-transparent text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-primaryhover focus:shadow-none active:bg-primaryhover hover:bg-primaryhover active:shadow-none">
                                Masuk
                            </button>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="bg-footer text-white text-center py-2">
        <div class="container mx-auto">
            <div class="my-2">
                <img src="/images/logofooter.png" alt="logofooter" class="w-10 mx-auto" />
            </div>
            <h6 class="text-xs">
                Direktorat Jenderal Perhutanan Sosial dan Kemitraan Lingkungan
            </h6>
            <h1 class="font-semibold mb-2 text-xs">
                Direktorat Kemitraan Lingkungan
            </h1>
            <p class="text-xs mb-6">
                Gedung Manggala Wanabakti Blok IV, Lantai 6, Wings B <br /> Jl. Gatot Subroto, Senayan, Jakarta Pusat 10270 <br /> Indonesia
            </p>
            <hr class="border-1 border-white" />
            <div class="flex justify-center space-x-6 my-4">
                <a href="https://www.instagram.com/direktoratkemitraanlingkungan" class="hover:text-gray-300 text-xl">
                    <img src="/images/instagram.svg" alt="instagram" width="25">
                </a>
                <a href="https://www.facebook.com/KementerianLHK" class="hover:text-gray-300 text-xl">
                    <img src="/images/facebook.svg" alt="facebook" width="25">
                </a>
                <a href="https://www.youtube.com/@PPIDKemenLHK" class="hover:text-gray-300 text-xl">
                    <img src="/images/youtube.svg" alt="youtube" width="25">
                </a>
            </div>
            <p class="text-xs">
                Copyright © 2024 Direktorat Kemitraan Lingkungan
            </p>
        </div>
    </footer>


    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        /* scroll */
        document.addEventListener('DOMContentLoaded', () => {
            const scroll = document.getElementById('scroll');

            const handleScroll = () => {
                if (window.scrollY > 300) {
                    scroll.classList.remove('hidden');
                } else {
                    scroll.classList.add('hidden');
                }
            };

            const scrollToTop = () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            };

            scroll.addEventListener('click', scrollToTop);
            window.addEventListener('scroll', handleScroll);
        });

        /* cursor */
        /* document.addEventListener('mousemove', function(e) {
            const cursor = document.getElementById('customCursor');
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        }); */

        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        const line1 = document.getElementById('line-1');
        const line2 = document.getElementById('line-2');
        const line3 = document.getElementById('line-3');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('block');

            if (mobileMenu.classList.contains('block')) {
                line1.style.transform = 'rotate(45deg)';
                line1.style.position = 'absolute';
                line1.style.top = '50%';
                line1.style.transformOrigin = 'center';
                line2.style.opacity = '0';
                line3.style.transform = 'rotate(-45deg)';
                line3.style.position = 'absolute';
                line3.style.top = '25%';
                line3.style.transformOrigin = 'center';
            } else {
                line1.style.transform = 'rotate(0deg)';
                line1.style.position = 'relative';
                line1.style.top = '0';
                line2.style.opacity = '1';
                line3.style.transform = 'rotate(0deg)';
                line3.style.position = 'relative';
                line3.style.top = '0';
            }
        });

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('block');
        };
    </script>
</body>
<script>
    var urlProvinsi = "/provinsi/provinsi.json";
    var urlKabupaten = "/kabupaten_kota/";
    var urlKecamatan = "/kecamatan/";
    var urlKelurahan = "/kelurahan_desa/";


    // Muat data provinsi pada saat halaman dimuat
    window.onload = function() {
        loadProvinsi();
    };


    // Fungsi untuk Memuat Data Provinsi dan Menandai Provinsi Terpilih
    function loadProvinsi() {
        fetch('/provinsi/provinsi.json')
            .then(response => response.json())
            .then(data => {
                const provinsiSelect = document.getElementById('provinsi');

                // Tambahkan pilihan lain dari JSON
                for (const [kode, nama] of Object.entries(data)) {
                    provinsiSelect.innerHTML += `<option value="${kode}">${nama}</option>`;
                }
            })
            .catch(error => console.error('Gagal memuat data provinsi:', error));
    }

    // Memuat data Kabupaten/Kota berdasarkan kode provinsi yang dipilih
    function loadKabupaten() {
        const kodeProvinsi = document.getElementById('provinsi').value;
        const kabupatenSelect = document.getElementById('kabupaten');
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        document.getElementById('kecamatan').innerHTML = '<option value="">Pilih Kecamatan</option>';
        document.getElementById('kelurahan').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        document.getElementById('kecamatan').disabled = true;
        document.getElementById('kelurahan').disabled = true;

        if (kodeProvinsi) {
            fetch(`/kabupaten_kota/kab-${kodeProvinsi}.json`)
                .then(response => response.json())
                .then(data => {
                    for (const [kode, nama] of Object.entries(data)) {
                        kabupatenSelect.innerHTML += `<option value="${kode}">${nama}</option>`;
                    }
                    kabupatenSelect.disabled = false;
                })
                .catch(error => console.error('Gagal memuat data kabupaten:', error));
        } else {
            kabupatenSelect.disabled = true;
        }
    }

    // Memuat data Kecamatan berdasarkan kode provinsi dan kabupaten yang dipilih
    function loadKecamatan() {
        const kodeProvinsi = document.getElementById('provinsi').value;
        const kodeKabupaten = document.getElementById('kabupaten').value;
        const kecamatanSelect = document.getElementById('kecamatan');
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        document.getElementById('kelurahan').innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        document.getElementById('kelurahan').disabled = true;

        if (kodeProvinsi && kodeKabupaten) {
            fetch(`/kecamatan/kec-${kodeProvinsi}-${kodeKabupaten}.json`)
                .then(response => response.json())
                .then(data => {
                    for (const [kode, nama] of Object.entries(data)) {
                        kecamatanSelect.innerHTML += `<option value="${kode}">${nama}</option>`;
                    }
                    kecamatanSelect.disabled = false;
                })
                .catch(error => console.error('Gagal memuat data kecamatan:', error));
        } else {
            kecamatanSelect.disabled = true;
        }
    }

    // Memuat data Kelurahan/Desa berdasarkan kode provinsi, kabupaten, dan kecamatan yang dipilih
    function loadKelurahan() {
        const kodeProvinsi = document.getElementById('provinsi').value;
        const kodeKabupaten = document.getElementById('kabupaten').value;
        const kodeKecamatan = document.getElementById('kecamatan').value;
        const kelurahanSelect = document.getElementById('kelurahan');
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

        if (kodeProvinsi && kodeKabupaten && kodeKecamatan) {
            fetch(`/kelurahan_desa/keldesa-${kodeProvinsi}-${kodeKabupaten}-${kodeKecamatan}.json`)
                .then(response => response.json())
                .then(data => {
                    for (const [kode, nama] of Object.entries(data)) {
                        kelurahanSelect.innerHTML += `<option value="${kode}">${nama}</option>`;
                    }
                    kelurahanSelect.disabled = false;
                })
                .catch(error => console.error('Gagal memuat data kelurahan:', error));
        } else {
            kelurahanSelect.disabled = true;
        }
    }

    // Fungsi untuk mengisi nama provinsi ke dalam hidden input
    function setNamaProvinsi() {
        const provinsiSelect = document.getElementById("provinsi");
        const namaProvinsi = provinsiSelect.options[provinsiSelect.selectedIndex].text;
        document.getElementById("nama_provinsi").value = namaProvinsi;
    }

    // Fungsi untuk mengisi nama kabupaten ke dalam hidden input
    function setNamaKabupaten() {
        const kabupatenSelect = document.getElementById("kabupaten");
        const namaKabupaten = kabupatenSelect.options[kabupatenSelect.selectedIndex].text;
        document.getElementById("nama_kabupaten").value = namaKabupaten;
    }

    // Fungsi untuk mengisi nama kecamatan ke dalam hidden input
    function setNamaKecamatan() {
        const kecamatanSelect = document.getElementById("kecamatan");
        const namaKecamatan = kecamatanSelect.options[kecamatanSelect.selectedIndex].text;
        document.getElementById("nama_kecamatan").value = namaKecamatan;
    }

    // Fungsi untuk mengisi nama kelurahan ke dalam hidden input
    function setNamaKelurahan() {
        const kelurahanSelect = document.getElementById("kelurahan");
        const namaKelurahan = kelurahanSelect.options[kelurahanSelect.selectedIndex].text;
        document.getElementById("nama_kelurahan").value = namaKelurahan;
    }

    // Fungsi untuk menonaktifkan dropdown jika belum ada pilihan di level sebelumnya
    function disableSelect(selectId) {
        const selectElement = document.getElementById(selectId);
        selectElement.innerHTML = `<option value="">Pilih ${selectElement.getAttribute("data-placeholder")}</option>`;
        selectElement.disabled = true;
    }
</script>

</html>