<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
</head>

<body>

    <?= $this->extend('template/navbarfooter') ?>

    <?= $this->section('content') ?>

    <div class="flex flex-col lg:flex-row justify-center m-4">
        <?= $this->include('template/sidebarpengusul') ?>

        <!-- Konten utama -->
        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">

            <div class="w-full pt-1 px-4 lg:mb-8">
                <div class="relative flex items-center justify-between w-full flex-wrap gap-4 sm:gap-8">
                    <div class="absolute left-0 top-2/4 h-0.5 w-full -translate-y-2/4 bg-accent2 transition-all duration-500"></div>

                    <!-- Step Indicators -->
                    <!-- Step 1 -->
                    <div class="relative z-10 grid w-8 h-8 sm:w-10 sm:h-10 font-bold text-white transition-all duration-300 bg-accent2 border-2 border-accent2 rounded-full place-items-center">
                        <div class="absolute -bottom-8 w-max text-center">
                            <p class="lg:block hidden font-sans text-xs lg:text-md antialiased font-semibold leading-relaxed tracking-normal text-gray-700 w-28 h-8">
                                Identitas Calon
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative z-10 grid w-8 h-8 sm:w-10 sm:h-10 font-bold text-white transition-all duration-300 bg-accent2 border-2 border-accent2 rounded-full place-items-center">
                        <div class="absolute -bottom-8 w-max text-center">
                            <p class="lg:block hidden font-sans text-xs lg:text-md antialiased font-semibold leading-relaxed tracking-normal text-gray-700 w-28 h-8">
                                Kegiatan Calon
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative z-10 grid w-8 h-8 sm:w-10 sm:h-10 font-bold text-accent1 transition-all duration-300 bg-accent2 border-2 border-accent2 rounded-full place-items-center">
                        <div class="absolute -bottom-8 w-max text-center">
                            <p class="lg:block hidden font-sans text-xs lg:text-md antialiased font-semibold leading-relaxed tracking-normal text-gray-700 w-28 h-8">
                                Dampak
                            </p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative z-10 grid w-8 h-8 sm:w-10 sm:h-10 font-bold text-white transition-all duration-300 bg-accent2 border-2 border-accent2  rounded-full place-items-center">
                        <div class="absolute -bottom-8 w-max text-center">
                            <p class="lg:block hidden font-sans text-xs lg:text-md antialiased font-semibold leading-relaxed tracking-normal text-gray-700 w-28 h-8">
                                PMIK
                            </p>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative z-10 grid w-8 h-8 sm:w-10 sm:h-10 font-bold text-white transition-all duration-300 bg-accent2 border-2 border-accent2 rounded-full place-items-center">
                        <div class="absolute -bottom-8 w-max text-center">
                            <p class="lg:block hidden font-sans text-xs lg:text-md antialiased font-semibold leading-relaxed tracking-normal text-gray-700 w-28 h-8">
                                Keswadayaan dan Keberlanjutan
                            </p>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="relative z-10 grid w-8 h-8 sm:w-10 sm:h-10 font-bold text-accent1 transition-all duration-300 bg-accent2 border-2 border-accent2 rounded-full place-items-center">
                        <div class="absolute -bottom-8 w-max text-center">
                            <p class="lg:block hidden font-sans text-xs lg:text-md antialiased font-semibold leading-relaxed tracking-normal text-gray-700 w-28 h-8">
                                Keistimewaan
                            </p>
                        </div>
                    </div>

                    <!-- Step ke-6 "Keistimewaan" -->
                    <div class="relative z-10 grid w-8 h-8 sm:w-10 sm:h-10 font-bold text-accent1 transition-all duration-300 bg-accent2 border-2 border-accent2 rounded-full place-items-center">
                        <div class="absolute -bottom-8 w-max text-center">
                            <p class="lg:block hidden font-sans text-xs lg:text-md antialiased font-semibold leading-relaxed tracking-normal text-gray-700 w-28 h-8">
                                Keistimewaan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update action untuk form, dan ubah method POST -->
            <form action="<?= base_url('pengusul/simpancalonkeistimewaan'); ?>" method="post" enctype="multipart/form-data" class="mt-4 mb-2 w-full">
                <?= csrf_field(); ?>
                <div class="grid grid-cols-1 gap-4" id="formContainer">
                    <div>
                        <label for="keistimewaan" class="block mb-2 text-sm text-black">Keistimewaan Calon</label>
                        <textarea name="keistimewaan" id="keistimewaan" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4" oninput="updateWordCount(this, 'keistimewaanCalonCount', 1000)"></textarea>
                        <p id="keistimewaanCalonCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                    </div>
                    <div>
                        <label for="penghargaan" class="block mb-2 text-sm text-black">Penghargaan relevan yang pernah diterima</label>
                        <textarea name="penghargaan" id="penghargaan" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 focus:outline-none focus:border-primary hover:border-primary transition duration-300 ease" rows="4" oninput="updateWordCount(this, 'penghargaanCount', 1000)"></textarea>
                        <p id="penghargaanCount" class="text-xs text-slate-400 flex justify-end">0/1000 Kata</p>
                    </div>
                    <div>
                        <label for="tautan_dokumen_pendukung" class="block mb-2 text-sm text-black">Tautan Dokumen Pendukung (Google Drive)</label>
                        <input name="tautan_dokumen_pendukung" id="tautan_dokumen_pendukung" type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Kolom 1 - Unggah Foto Kegiatan -->
                        <div id="fotoContainer">
                            <label for="foto_kegiatan1" class="block mb-2 text-sm text-black">Unggah Foto Kegiatan <span class="text-primary"> (.jpg/jpeg)</span></label>
                            <div class="mb-4">
                                <!-- Input Foto Kegiatan 1 -->
                                <input name="foto_kegiatan1" type="file" accept=".jpg, .jpeg" class="mb-2 w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                                <input name="deskripsi_foto_kegiatan1" type="text" placeholder="Keterangan Foto" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                            </div>

                            <!-- Tombol Tambah Foto Kegiatan -->
                            <button type="button" id="tambahFotoButton" class="mt-4 w-full flex items-center justify-center rounded-md py-2 text-center text-sm text-primary transition-all shadow-md hover:shadow-lg bg-secondary active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <span class="mr-2">&#10010</span> Tambah Foto Kegiatan
                            </button>
                        </div>

                        <!-- Kolom 2 - Tautan Video -->
                        <div id="videoContainer">
                            <label class="block mb-2 text-sm text-black">Tautan Video</label>
                            <input name="tautan_video" type="text" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow mb-3" placeholder="Tautan Video" />

                            <!-- Tombol Tambah Video -->
                            <button type="button" id="tambahVideoButton" class="w-full flex items-center justify-center rounded-md py-2 text-center text-sm text-primary transition-all shadow-md hover:shadow-lg bg-secondary active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <span class="mr-2">&#10010</span> Tambah Tautan Video
                            </button>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end mt-4">
                    <button class="w-40 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none" type="submit">Selesai</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        // Batasan Kata
        function updateWordCount(textarea, countId, maxWords) {
            const countElement = document.getElementById(countId);
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            const currentLength = words.length;

            countElement.textContent = `${currentLength}/${maxWords} kata`;

            if (currentLength > maxWords) {
                countElement.classList.add('text-rejected');
            } else {
                countElement.classList.remove('text-rejected');
            }
        }

        // Tambah Foto Kegiatan dan Tambah Tautan Video
        const maxFotoInput = 5;
        const maxVideoInput = 5;

        const fotoContainer = document.getElementById('fotoContainer');
        const videoContainer = document.getElementById('videoContainer');

        const tambahFotoButton = document.getElementById('tambahFotoButton');
        const tambahVideoButton = document.getElementById('tambahVideoButton');

        let fotoInputCount = 1;
        let videoInputCount = 1;

        tambahFotoButton.addEventListener('click', function() {
            if (fotoInputCount < maxFotoInput) {
                const newFotoDiv = document.createElement('div');
                newFotoDiv.classList.add('mb-4');
                newFotoDiv.innerHTML = `
                    <input name="foto_kegiatan${fotoInputCount + 1}" type="file" accept=".jpg, .jpeg" class="mb-2 w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                    <input name="deskripsi_foto_kegiatan${fotoInputCount + 1}" type="text" placeholder="Keterangan Foto" class="w-full bg-transparent placeholder:text-slate-400 text-primary text-sm border-2 border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-primary hover:border-primary focus:shadow" />
                `;
                fotoContainer.insertBefore(newFotoDiv, tambahFotoButton);
                fotoInputCount++;
            }
        });

        tambahVideoButton.addEventListener('click', function() {
            if (videoInputCount < maxVideoInput) {
                const newVideoInput = document.createElement('input');
                newVideoInput.name = `tautan_video${videoInputCount + 1}`;
                newVideoInput.type = 'text';
                newVideoInput.classList.add('w-full', 'bg-transparent', 'placeholder:text-slate-400', 'text-primary', 'text-sm', 'border-2', 'border-slate-200', 'rounded-md', 'px-3', 'py-2', 'transition', 'duration-300', 'ease', 'focus:outline-none', 'focus:border-primary', 'hover:border-primary', 'focus:shadow', 'mb-3');
                newVideoInput.placeholder = 'Tautan Video';
                videoContainer.insertBefore(newVideoInput, tambahVideoButton);
                videoInputCount++;
            }
        });
    </script>

    <?= $this->endSection() ?>
</body>

</html>