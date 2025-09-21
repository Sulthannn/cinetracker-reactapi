<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title><?= $title; ?></title>
</head>

<body>
    <div class="flex h-screen">
        <div class="flex-1 relative hidden sm:block">
            <img id="backgroundImage" src="/images/loginregist2.jpeg" alt="loginregist2"
                class="w-full h-full object-cover fade-in-right">
        </div>

        <div class="flex-1 flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-6 fade-in-left">

                <h2 class="text-2xl font-bold text-gray-900 mb-4">Masuk</h2>
                <form class="lg:flex gap-6 justify-center" onsubmit="validateForm(event)" action="/auth/logininternal" method="POST">

                    <a href="/auth/loginadmin">
                        <div class="group relative overflow-hidden hover:scale-105 transition-transform duration-500 shadow-lg hover:shadow-xl rounded-xl bg-secondary outline outline-primary -outline-offset-4 hover:outline-primaryhover hover:outline-4">
                            <div class="absolute inset-0 before:absolute before:w-16 before:h-16 before:rounded-full before:top-6 before:right-6 before:opacity-75"></div>
                            <div class="relative z-10 flex flex-col items-center gap-2 p-4">
                                <span class="text-primary text-xl font-bold">ADMIN</span>
                            </div>
                        </div>
                    </a>

                    <a href="/auth/logintimteknis">
                        <div class="group relative overflow-hidden hover:scale-105 transition-transform duration-500 shadow-lg hover:shadow-xl rounded-xl bg-secondary outline outline-primary -outline-offset-4 hover:outline-primaryhover hover:outline-4">
                            <div class="absolute inset-0 before:absolute before:w-16 before:h-16 before:rounded-full before:top-6 before:right-6 before:opacity-75"></div>
                            <div class="relative z-10 flex flex-col items-center gap-2 p-4">
                                <span class="text-primary text-xl font-bold">TIM TEKNIS</span>
                            </div>
                        </div>
                    </a>

                    <a href="/auth/logindppk">
                        <div class="group relative overflow-hidden hover:scale-105 transition-transform duration-500 shadow-lg hover:shadow-xl rounded-xl bg-secondary outline outline-primary -outline-offset-4 hover:outline-primaryhover hover:outline-4">
                            <div class="absolute inset-0 before:absolute before:w-16 before:h-16 before:rounded-full before:top-6 before:right-6 before:opacity-75"></div>
                            <div class="relative z-10 flex flex-col items-center gap-2 p-4">
                                <span class="text-primary text-xl font-bold">DPPK</span>
                            </div>
                        </div>
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>