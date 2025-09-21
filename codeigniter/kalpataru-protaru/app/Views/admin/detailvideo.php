<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title><?= $title; ?></title>
</head>

<body class="lg:flex">



    <!-- Sidebar -->
    <div class="w-64 bg-white text-white">
    <?= $this->include('template/sidebaradmin') ?>
  </div>
    <div class="lg:flex-1 p-6">
        <header class="bg-white shadow">
            <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
                <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Detail Video</h1>
                <div class="flex items-center">
                    <p class="text-gray-500 mr-2 md:mr-4">Hello, <?= session()->get('nama'); ?></p>
                    <a href="/auth/logoutinternal" class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg inline-block">Keluar</a>
                </div>
            </div>
        </header>

        <div class="mt-4 relative flex flex-col w-full  mx-auto mb-4 border-2 border-primary bg-white shadow-md lg:p-8">


            <div class="relative flex items-center justify-center h-full overflow-hidden text-white rounded-md">
                <?php
                preg_match("/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/", $video['link_video'], $matches);
                $youtube_id = $matches[1];
                ?>
                <iframe class="w-full" height="500" src="https://www.youtube.com/embed/<?= $youtube_id; ?>"
                    title="<?= esc($video['judul_video']); ?>" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div>
                <div class="my-4">
                    <h1 class="text-slate-800 text-md font-semibold text-xl">
                        <?= esc($video['judul_video']); ?>
                    </h1>
                    <h3 class="text-sm">
                        Tanggal Video: <?= esc($video['tanggal']); ?>
                    </h3>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between mt-8 gap-4">
                <button onclick="window.history.back()"
                    class="text-sm font-bold text-gray-600 no-underline focus:outline-none text-start mt-6">
                    <span class="font-bold text-lg items-center">←</span> Kembali
                </button>
                <a href="/admin/video/edit/<?= esc($video['id_video']); ?>">
                    <div class="mt-4">
                        <button id="editVideo" class="w-full md:w-48 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                            <i class="fas fa-edit"></i> Edit Video
                        </button>
                    </div>
                </a>
            </div>
        </div>
</body>

</html>