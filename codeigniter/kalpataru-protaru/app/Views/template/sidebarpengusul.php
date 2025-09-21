<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100">
    <div id="sidebar" class="lg:w-[15rem] lg:h-3/4 lg:rounded-lg text-white mb-6 relative lg:mr-6 lg:z-0 z-50">
        <!-- Profil section -->
        <div class="mb-4 border-2 border-primaryhover rounded-lg px-4 py-2 flex items-start bg-primary hidden lg:flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

            <div>
                <h2 class="text-md font-bold">
                    <?php if (session()->get('role_akun') === 'Pengusul'): ?>
                        <?= session()->get('nama'); ?>
                    <?php elseif (session()->get('role_akun') === 'DLHK'): ?>
                        <?= session()->get('instansi'); ?>
                    <?php endif; ?>
                </h2>
                <p class="text-sm text-secondary font-semibold">Pengusul</p>
                <p class="text-sm text-secondary font-semibold"><?= session()->get('provinsi'); ?></p>
            </div>
        </div>

        <?php
        $isDLHK = true;
        ?>
        <!-- Menu -->
        <ul class="lg:border-2 border-t-2 border-primaryhover lg:rounded-lg lg:px-4 lg:py-4 lg:bg-primary bg-primary flex justify-between fixed bottom-0 left-0 right-0 shadow-md lg:block lg:relative lg:shadow-none overflow-x-auto scroll-smooth overscroll-x-contain">
            <li class="flex items-center justify-center lg:justify-start">
                <a href="/pengusul/profil" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="ml-2 text-sm hidden lg:inline">Profil</span>
                </a>
            </li>
            <?php if (session()->get('role_akun') === 'DLHK'): ?>
                <li class="flex items-center justify-center lg:justify-start">
                    <a href="/pengusul/pemberitahuan" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <span class="ml-2 text-sm hidden lg:inline">Pemberitahuan</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="flex items-center justify-center lg:justify-start">
                <a href="/pengusul/alurpendaftaran" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    <span class="ml-2 text-sm hidden lg:inline">Alur Pendaftaran</span>
                </a>
            </li>
            <!-- <li class="flex items-center justify-center lg:justify-start">
                <a href="/pengusul/tambahcalon" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    <span class="ml-2 text-sm hidden lg:inline">Tambah Calon Usulan</span>
                </a>
            </li> -->
            <li class="flex items-center justify-center lg:justify-start">
                <a href="/pengusul/usulansaya" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                    </svg>
                    <span class="ml-2 text-sm hidden lg:inline">Usulan Saya</span>
                </a>
            </li>
            <?php if (session()->get('role_akun') === 'DLHK'): ?>
                <li class="flex items-center justify-center lg:justify-start">
                    <a href="/pengusul/usulandlhk" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="ml-2 text-sm hidden lg:inline">Usulan: <strong>Provinsi <?= session()->get('provinsi'); ?></strong></span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="flex items-center justify-center lg:justify-start">
                <a href="/pengusul/panduanpendaftaran" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span class="ml-2 text-sm hidden lg:inline">Panduan Pendaftaran</span>
                </a>
            </li>
            <li class="flex items-center justify-center lg:justify-start">
                <a href="/pengusul/videopanduan" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class="ml-2 text-sm hidden lg:inline">Video Panduan</span>
                </a>
            </li>
            <?php if (session()->get('role_akun') === 'DLHK'): ?>
                <!-- <li class="flex items-center justify-center lg:justify-start">
                    <a href="/pengusul/tambahartikel" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span class="ml-2 text-sm hidden lg:inline">Tambah Artikel</span>
                    </a>
                </li> -->
                <li class="flex items-center justify-center lg:justify-start">
                    <a href="/pengusul/artikel-saya" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                        <span class="ml-2 text-sm hidden lg:inline">Artikel Saya</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="flex items-center justify-center lg:justify-start">
                <a href="/auth/logout" class="flex items-center block text-md hover:bg-secondary hover:text-primaryhover p-2 w-full rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    <span class="ml-2 text-sm hidden lg:inline">Keluar</span>
                </a>
            </li>

        </ul>
    </div>
</body>

</html>