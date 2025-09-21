<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>
    <?= $this->extend('template/navbarfooter') ?>

    <?= $this->section('content') ?>

    <div class="flex flex-col lg:flex-row justify-center m-4">
        <?= $this->include('template/sidebarpengusul') ?>

        <div class="relative flex flex-col w-full max-w-5xl mb-4 rounded-xl border-2 border-primary bg-white shadow-md lg:p-8 p-4">
            <h4 class="block text-xl font-bold text-slate-800 mb-2">
                Artikel Saya
            </h4>
            <div class="lg:flex justify-between items-center my-2">
                <a href="/pengusul/tambah-artikel">
                    <button id="tambahartikel" class="w-48 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button"> <span>&#10010</span> Tambah Artikel Baru</button>
                </a>

                <form method="get">
                    <div class="relative w-56 transition-all focus-within:w-64 lg:mt-0 mt-4">
                        <input
                            placeholder="Masukan kata kunci"
                            class="input shadow-lg focus:border-2 border-2 text-primary border-primary px-5 py-1 pr-10 rounded-md w-full outline-none"
                            name="search"
                            value="<?= esc($keyword) ?>" />
                        <svg
                            class="w-6 h-6 absolute top-1/2 right-3 transform -translate-y-1/2 text-primary"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                stroke-linejoin="round"
                                stroke-linecap="round"></path>
                        </svg>
                    </div>
                </form>
            </div>
            <div class="relative flex flex-col w-full h-full overflow-hidden text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                <div class="overflow-x-auto">
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        No </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Judul Artikel
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Status
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Catatan
                                    </p>
                                </th>
                                <th class="p-4 border-b border-accent2 bg-accent1 text-center">
                                    <p class="block text-xs md:text-sm font-bold leading-none text-accent2">
                                        Aksi
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($artikels)): ?>
                                <tr>
                                    <td colspan="5" class="p-4 border-b border-slate-200 text-center">
                                        <p class="block text-xs text-slate-800">
                                            Belum ada data artikel
                                        </p>
                                    </td>
                                </tr>
                                <?php else:
                                $no = 0;
                                foreach ($artikels as $index => $artikel):
                                    $no++;
                                ?>
                                    <tr class="hover:bg-slate-50">
                                        <td class="p-4 border-b border-slate-200 text-xs text-slate-800 text-center"><?= $no ?></td>
                                        <td class="p-4 border-b border-slate-200 text-xs text-slate-800 text-center">
                                            <?= strlen(esc($artikel['judul'])) > 0 ? implode(' ', array_slice(explode(' ', esc($artikel['judul'])), 0, 5)) . (count(explode(' ', esc($artikel['judul']))) > 5 ? '...' : '') : '' ?>
                                        </td>
                                        <td class="p-4 border-b border-slate-200 text-xs text-slate-800 text-center"><?= esc($artikel['status']) ?></td>

                                        <td class="p-4 border-b border-slate-200 text-center">
                                            <?php if ($artikel['status'] == 'Ditolak'): ?>
                                                <button class="lihatButton w-20 rounded-md py-2 px-2 text-center font-semibold text-xs text-primary bg-secondary"
                                                    type="button"
                                                    onclick="showCatatanModal('catatanModal<?= $no; ?>')">Lihat</button>

                                                <!-- Modal Catatan -->
                                                <div id="catatanModal<?= $no; ?>" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                                    <div class="bg-white rounded-lg p-8 flex flex-col max-w-md">
                                                        <h2 class="text-left text-lg font-bold text-primary mb-2">Catatan:</h2>
                                                        <p class="text-justify text-sm text-slate-600 mb-4"><?= esc($artikel['catatan']); ?></p>
                                                        <button onclick="closeModal('catatanModal<?= $no; ?>')" class="text-left text-sm font-bold text-gray-600 no-underline focus:outline-none">
                                                            <span class="font-bold text-lg items-center">←</span> Kembali
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400">Tidak ada catatan</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="p-4 border-b border-slate-200 text-xs text-slate-800 text-center">
                                            <button class="lihatButton w-full rounded-md py-2 px-2 text-center font-semibold text-xs text-white bg-primary hover:bg-primaryhover"
                                                type="button"
                                                onclick="window.location.href='/pengusul/artikel/<?= esc($artikel['slug']); ?>'">Selengkapnya</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row flex lg:justify-end justify-center my-6 lg:me-2 me-0">
                    <div class="pagination">
                        <?= $pager->links('artikel', 'template_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalPopup" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-8 flex flex-col items-center max-w-md">
            <img src="/images/question.png" alt="Question Icon" class="w-16 h-16 mb-4">
            <p class="text-center text-lg font-bold text-gray-700 mb-4">Apakah anda yakin ingin mengirimkan seluruh data pada admin?</p>
            <p class="text-center text-sm text-slate-600 mb-4">Data yang dikirimkan adalah Seluruh Data pada Identitas Calon, Kegiatan Calon, Dampak, PMIK, Keswadayaan dan Kebudayaan, dan Keistimewaan. <span class="font-bold"> Data yang telah dikirimkan tidak dapat diubah kembali, mohon perhatikan dengan seksama!</span></p>
            <div class="flex justify-end space-x-4">
                <button id="cancelButton" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 hover:text-white rounded-md">Periksa Kembali</button>
                <button id="confirmButton" class="px-4 py-2 bg-primary hover:bg-primaryhover text-white rounded-md">Ya, Kirim Data</button>
            </div>
        </div>
    </div>
    <script>
        // POPUP MODAL CATATAN
        // Function to show the specific catatan modal
        function showCatatanModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Function to close the specific modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const closeModal = document.getElementById('closeModal');
            const closeModalButton = document.getElementById('closeModalButton');
            const errorModal = document.getElementById('errorModal');

            if (closeModal) {
                closeModal.addEventListener('click', function() {
                    errorModal.style.display = 'none';
                });
            }

            if (closeModalButton) {
                closeModalButton.addEventListener('click', function() {
                    errorModal.style.display = 'none';
                });
            }

            // Optional: Close the modal if the user clicks outside of it
            window.addEventListener('click', function(event) {
                if (event.target === errorModal) {
                    errorModal.style.display = 'none';
                }
            });
        });
    </script>

    <?= $this->endSection() ?>
</body>