<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Animasi untuk fade-in dan slide-in */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body>
    <div class="flex-1 container mx-auto">

        <div class="relative flex flex-col items-center justify-center text-center mt-8">
            <!-- Gambar dengan animasi bounce dan efek hover -->
            <img src="/images/logomaintenance.png" alt="logomaintenance" class="w-2/3 mx-auto lg:w-1/4 hover:scale-105 transition-transform duration-300 bounce">

            <!-- Teks dengan animasi fade-in -->
            <p class="text-md lg:text-xl text-gray-700 font-semibold lg:w-1/2 w-full lg:mx-0 mx-4 fade-in relative">
                Mohon maaf, halaman ini belum dapat tersedia karena sedang dalam proses penyempurnaan. Kami menghargai kesabaran Anda selama proses ini. Terima kasih atas pengertiannya.
            </p>
        </div>
    </div>
</body>

</html>