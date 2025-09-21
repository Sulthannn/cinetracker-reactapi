<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-gray-100">
    <div id="sidebar" class="lg:w-[15rem] lg:h-3/4 lg:rounded-lg text-white mb-6 relative lg:mr-6 lg:z-0 z-50">
        <!-- Profil section -->
        <div class="border-t-2 border-l-2 border-r-2 rounded-t-lg border-primaryhover px-4 py-2 flex items-start bg-primary hidden lg:flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

            <div>
                <h2 class="text-md font-bold"><?= session()->get('nama') ?></h2>
                <p class="text-sm text-secondary font-semibold"><?= session()->get('status') ?></p>
                <p class="text-sm text-secondary font-semibold"><?= session()->get('email') ?></p>
            </div>
        </div>


        <!-- Menu -->
        <ul class="border-l-2 border-r-2 border-b-2 rounded-b-lg border-primaryhover lg:px-4 lg:py-2 lg:bg-primary bg-primary flex justify-between fixed bottom-0 left-0 right-0 shadow-md lg:block lg:relative lg:shadow-none overflow-x-auto scroll-smooth overscroll-x-contain">
            <li class="flex items-center justify-center lg:justify-start">
                <a href="/auth/logout" class="flex items-center block text-md rounded-lg hover:bg-secondary hover:text-primaryhover p-2 w-full">
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