<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/app.css">
  <title><?= $title; ?></title>
</head>

<body class="lg:flex">



  <!-- Sidebar -->
  <div class="w-64 bg-white text-white">
    <?= $this->include('template/sidebaradmin') ?>
  </div>

  <div class="lg:flex-1 p-6">
    <div class="min-h-screen flex flex-col">

  <div class="container mx-auto flex items-center justify-between p-4 md:p-6">
          <h1 class="text-xl md:text-2xl font-semibold text-gray-700">Kebijakan</h1>
          <div class="flex items-center">
            <p class="text-gray-500 mr-2 md:mr-4">Hello, Admin</p>
            <button class="bg-rejected text-white px-3 py-2 md:px-4 md:py-2 rounded-lg">Keluar</button>
          </div>
        </div>
        <a href="">
        <div>
                    <button id="tambahkebijakan" class="w-48 rounded-md py-2 text-center text-sm text-white transition-all shadow-md hover:shadow-lg bg-primary hover:bg-primaryhover active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button"> <span>&#10010</span> Tambah Kebijakan</button>
            </div>
        </a>    

            <div class="relative  flex flex-col w-full h-full bg-white shadow-md rounded-lg bg-clip-border my-6">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr>
                            <th
                                class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p
                                    class="flex items-center justify-between gap-2 text-sm font-bold leading-none text-slate-800">
                                    No
                                </p>
                            </th>

                            <th
                                class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p
                                    class="flex items-center justify-between gap-2 text-sm font-bold leading-none text-slate-800">
                                   Nama File
                                </p>
                            </th>

                            <th
                                class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p
                                    class="flex items-center justify-between gap-2 text-sm font-bold leading-none text-slate-800">
                                    Tentang
                                </p>
                            </th>
                            <th
                                class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p
                                    class="flex items-center ml-8 gap-2 text-sm font-bold leading-none text-slate-800">
                                    Jenis
                                </p>
                            </th>
                            <th
                                class="p-4 transition-colors cursor-pointer border-b border-slate-300 bg-slate-50 hover:bg-slate-100">
                                <p
                                    class="flex items-left justify-left gap-2 text-sm font-bold leading-none text-slate-800">
                                   Hapus
                                </p>
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    01
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Peraturan
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Kebijakan Kalpataru
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                            <p>
                                UUD
                            </p>
                            </td>
                           
                            <td class="p-4 border-b border-slate-200">
                                <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    02
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Peraturan 
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Program Kalpataru
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                            <p>
                                Peraturan Menteri
                            </p>
                            </td>
                           
                            <td class="p-4 border-b border-slate-200">
                                <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    03
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Peraturan
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Program Kalpataru
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                            <a>
                                Peraturan Menteri
                            </a>
                            </td>
                            
                            <td class="p-4 border-b border-slate-200">
                                <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    04
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Peraturan
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Pembukaan Kapataru
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                           <p>
                            Peraturan Kalpataru 
                           </p>
                            </td>
                            
                            <td class="p-4 border-b border-slate-200">
                                <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    05
                                </p>
                            </td>

                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Peraturan
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    Peraturan Kalpataru
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                            <p>
                                Peraturan Menteri
                            </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row flex lg:justify-end justify-center my-6 lg:mr-4">
                    <button class="rounded-md rounded-r-none border border-r-0 border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="rounded-md rounded-r-none rounded-l-none border border-r-0 border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        1
                    </button>
                    <button class="rounded-md rounded-r-none rounded-l-none border border-r-0 border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        2
                    </button>
                    <button class="rounded-md rounded-r-none rounded-l-none border border-r-0 border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        3
                    </button>
                    <button class="rounded-md rounded-r-none rounded-l-none border border-r-0 border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        4
                    </button>
                    <button class="rounded-md rounded-r-none rounded-l-none border border-r-0 border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        5
                    </button>
                    <button class="rounded-md rounded-l-none border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-primary hover:border-primary focus:text-white focus:bg-primary focus:border-primary active:border-primary active:text-white active:bg-primary disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
</div>
</div>
</body>

<script>
  // Function to toggle the button text
  function toggleButtonText(button) {
    const activeText = button.getAttribute("data-active");
    const inactiveText = button.getAttribute("data-inactive");

    if (button.innerText === inactiveText) {
      button.innerText = activeText;
    } else {
      button.innerText = inactiveText;
    }
  }

  // Select all buttons with the class 'toggleBtn'
  const buttons = document.querySelectorAll(".toggleBtn");

  // Attach the toggle function to each button's click event
  buttons.forEach(button => {
    button.addEventListener("click", () => toggleButtonText(button));
  });
</script>

</html>
