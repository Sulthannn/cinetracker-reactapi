<nav aria-label="Page navigation">
    <ul class="inline-flex items-center">
        <!-- Tombol untuk halaman sebelumnya -->
        <?php if ($pager->getPreviousPageNumber() !== null) : ?>
            <li>
                <button onclick="window.location.href='<?= $pager->getPreviousPage() ?>'" class="rounded-md rounded-r-none border border-r-0 border-slate-300 py-[0.63rem] px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </li>
        <?php endif ?>

        <!-- Tombol untuk halaman aktif dan sekitarnya -->
        <?php 
        $links = $pager->links(); 
        $totalPages = count($links);
        foreach ($links as $index => $link) : 
            $pageNumber = $link['title'];
            $isActive = $link['active'];
            if (
                $isActive ||
                (isset($links[$index - 2]) && $links[$index - 2]['active']) || 
                (isset($links[$index - 1]) && $links[$index - 1]['active']) || 
                (isset($links[$index + 1]) && $links[$index + 1]['active']) || 
                (isset($links[$index + 2]) && $links[$index + 2]['active'])    
            ) :
        ?>
            <li>
                <button onclick="window.location.href='<?= $link['uri'] ?>'" class="rounded-md rounded-r-none rounded-l-none border border-r-0 border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg <?= $isActive ? 'bg-primary text-white' : 'text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary' ?> active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    <?= $pageNumber ?>
                </button>
            </li>
        <?php 
            endif;
        endforeach; 
        ?>

        <!-- Tombol untuk halaman berikutnya -->
        <?php if ($pager->getNextPageNumber() !== null) : ?>
            <li>
                <button onclick="window.location.href='<?= $pager->getNextPage() ?>'" class="rounded-md rounded-l-none border border-slate-300 py-[0.63rem] px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </li>
        <?php endif ?>
    </ul>
</nav>