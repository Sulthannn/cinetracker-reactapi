<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title><?= $title; ?></title>
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

        /* selection */
        ::selection {
            background-color: #2C7865;
            color: white;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Tombol Hamburger untuk Mobile -->
    <button id="hamburgerBtn" class="absolute top-4 left-4 z-50 block md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed top-0 left-0 lg:mt-0 mt-4 h-full w-64 -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col rounded-xl bg-white bg-clip-border px-4 py-8 text-gray-700 shadow-xl shadow-blue-gray-900/5 md:relative md:w-1/5">

        <img src="/images/logo.png">
        <hr class="border-primary border-2">
        <div class="p-4 mb-2">
            <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-primary">
                Tim Teknis
            </h5>
        </div>
        <div class="relative block w-full">
            <div role="button"
                class="flex items-center w-full p-0 leading-tight transition-all rounded-lg outline-none bg-blue-gray-50/50 text-start text-blue-gray-700 hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary">
                <button id="dropdownBtn1" type="button" onclick="window.location.href='/timteknis/datacalonusulan'"
                    class="flex items-center justify-between w-full p-3 font-sans text-xl antialiased font-semibold leading-snug text-left transition-colors border-b-0 select-none border-b-blue-gray-100 text-primary hover:text-primaryhover">
                    <div class="grid mr-4 place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>
                    </div>
                    <p class="block mr-auto font-sans text-base antialiased font-normal leading-relaxed text-primary">
                        Data Calon Usulan
                    </p>
                </button>
            </div>
        </div>
        <!-- Dropdown: Verifikasi Administrasi -->
        <div class="relative block w-full mt-2">
            <button id="verifikasiDropdown" class="flex items-center justify-between w-full p-3 font-semibold text-xl leading-snug hover:text-primaryhover transition-all rounded-lg outline-none bg-blue-gray-50/50 text-start  hover:bg-blue-gray-50 hover:bg-opacity-80  focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary">
                <div class="grid mr-4 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </div>
                <p class="block mr-auto font-sans text-base antialiased font-normal leading-relaxed text-primary">Verifikasi Administrasi</p>
                <span class="ml-4">
                    <svg id="dropdownIconVerifikasi" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </button>
            <div id="dropdownMenuVerifikasi" class="hidden">
                <div class="py-1 text-gray-700 text-sm">
                    <nav class="flex flex-col gap-1">
                        <button onclick="window.location.href='/timteknis/verifadminkategoria'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Perintis Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/verifadminkategorib'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Pengabdi Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/verifadminkategoric'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Penyelamat Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/verifadminkategorid'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Pembina Lingkungan</button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Dropdown: Sidang 1-->
        <div class="relative block w-full mt-2">
            <button id="sidang1Dropdown" class="flex items-center justify-between w-full p-3 font-semibold text-xl leading-snug hover:text-primaryhover transition-all rounded-lg outline-none bg-blue-gray-50/50 text-start  hover:bg-blue-gray-50 hover:bg-opacity-80  focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary">
                <div class="grid mr-4 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                    </svg>
                </div>
                <p class="block mr-auto font-sans text-base antialiased font-normal leading-relaxed text-primary">Sidang 1</p>
                <span class="ml-4">
                    <svg id="dropdownIconSidang1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </button>
            <div id="dropdownMenuSidang1" class="hidden">
                <div class="py-1 text-gray-700 text-sm">
                    <nav class="flex flex-col gap-1">
                        <button onclick="window.location.href='/timteknis/bahansidang1/kategoria'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Perintis Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/bahansidang1/kategorib'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Pengabdi Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/bahansidang1/kategoric'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Penyelamat Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/bahansidang1/kategorid'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Pembina Lingkungan</button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Dropdown: Sidang 2-->
        <div class="relative block w-full mt-2">
            <button id="sidang2Dropdown" class="flex items-center justify-between w-full p-3 font-semibold text-xl leading-snug hover:text-primaryhover transition-all rounded-lg outline-none bg-blue-gray-50/50 text-start  hover:bg-blue-gray-50 hover:bg-opacity-80  focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary">
                <div class="grid mr-4 place-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                    </svg>
                </div>
                <p class="block mr-auto font-sans text-base antialiased font-normal leading-relaxed text-primary">Sidang 2</p>
                <span class="ml-4">
                    <svg id="dropdownIconSidang2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </button>
            <div id="dropdownMenuSidang2" class="hidden">
                <div class="py-1 text-gray-700 text-sm">
                    <nav class="flex flex-col gap-1">
                        <button onclick="window.location.href='/timteknis/bahansidang2/kategoria'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Perintis Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/bahansidang2/kategorib'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Pengabdi Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/bahansidang2/kategoric'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Penyelamat Lingkungan</button>
                        <button onclick="window.location.href='/timteknis/bahansidang2/kategorid'" class="w-full p-3 flex items-center leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-primaryhover focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-primary active:bg-blue-gray-50 active:bg-opacity-80 active:text-primary text-base font-normal">Pembina Lingkungan</button>
                    </nav>
                </div>
            </div>
        </div>

        <div class="relative block w-full">
            <div role="button"
                class="flex items-center mt-2 w-full p-0 leading-tight transition-all rounded-lg outline-none bg-red-50/50 text-start text-rejected hover:bg-red-100 hover:bg-opacity-80 hover:text-primaryhover focus:bg-red-100 focus:bg-opacity-80 focus:text-primary active:bg-red-100 active:bg-opacity-80 active:text-primary">
                <button id="dropdownBtn1" type="button" onclick="window.location.href='/auth/logoutinternal'"
                    class="flex items-center justify-between w-full p-3 font-sans text-xl antialiased font-semibold leading-snug text-left transition-colors border-b-0 select-none border-b-blue-gray-100 text-rejected hover:font-semibold">
                    <div class="grid mr-4 place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                    </div>
                    <p class="block mr-auto font-sans text-base antialiased font-normal leading-relaxed text-rejected">
                        Keluar
                    </p>
                </button>
            </div>
        </div>
    </div>

    <script>
        const verifikasiDropdown = document.getElementById("verifikasiDropdown");
        const dropdownMenuVerifikasi = document.getElementById("dropdownMenuVerifikasi");
        const dropdownIconVerifikasi = document.getElementById("dropdownIconVerifikasi");

        const sidang1Dropdown = document.getElementById("sidang1Dropdown");
        const dropdownMenuSidang1 = document.getElementById("dropdownMenuSidang1");
        const dropdownIconSidang1 = document.getElementById("dropdownIconSidang1");

        const sidang2Dropdown = document.getElementById("sidang2Dropdown");
        const dropdownMenuSidang2 = document.getElementById("dropdownMenuSidang2");
        const dropdownIconSidang2 = document.getElementById("dropdownIconSidang2");

        // Toggle Verifikasi Administrasi dropdown
        verifikasiDropdown.addEventListener("click", () => {
            dropdownMenuVerifikasi.classList.toggle("hidden");
            dropdownIconVerifikasi.classList.toggle("rotate-180");
        });

        // Toggle Sidang 1 dropdown
        sidang1Dropdown.addEventListener("click", () => {
            dropdownMenuSidang1.classList.toggle("hidden");
            dropdownIconSidang1.classList.toggle("rotate-180");
        });

        // Toggle Sidang 2 dropdown
        sidang2Dropdown.addEventListener("click", () => {
            dropdownMenuSidang2.classList.toggle("hidden");
            dropdownIconSidang2.classList.toggle("rotate-180");
        });

        const hamburgerBtn = document.getElementById("hamburgerBtn");
        const sidebar = document.getElementById("sidebar");

        hamburgerBtn.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
        });
    </script>
</body>

</html>