<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>INNDESA Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            overflow-y: scroll;
        }
    </style>
</head>

<body class="bg-white">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-32 w-full">
                <a href="index" class="flex items-center -ml-44 space-x-4">
                    <div class="w-28 h-28 rounded-full overflow-hidden flex-shrink-0">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo INNDESA" class="object-cover w-full h-full" />
                    </div>
                    <div>
                        <h1 class="font-extrabold text-3xl leading-tight text-gray-900 select-none">INNDESA</h1>
                        <p class="text-base leading-snug text-gray-600 select-none">Inovasi Nusantara Desa Integratif Pangan</p>
                    </div>
                </a>

                <div class="hidden md:flex flex-col font-semibold select-none ml-32">
                    <div class="flex space-x-8 text-gray-800 mb-1 items-center">
                        <a href="{{ route('Admin_Kelompok.beranda') }}" class="menu-item flex items-center gap-1 hover:text-sky-600 transition-colors duration-150" data-menu="beranda">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 9.75L12 3l9 6.75v11.25a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75V9.75z" />
                            </svg>
                            <span>Beranda</span>
                        </a>

                        <div class="relative group">
                            <button onclick="toggleDropdown('perusahaanDropdown')" class="menu-item flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors duration-150 focus:outline-none" data-menu="pt">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 22V2h16v20H4zm2-2h2v-2H6v2zm0-4h2v-2H6v2zm0-4h2V8H6v4zm4 8h2v-2h-2v2zm0-4h2v-2h-2v2zm0-4h2V8h-2v4zm4 8h2v-2h-2v2zm0-4h2v-2h-2v2zm0-4h2V8h-2v4z" />
                                </svg>
                                <span>Perusahaan Pembina</span>
                                <svg id="perusahaanArrow" class="w-3 h-3 ml-1 mt-0.5 text-gray-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div id="perusahaanDropdown" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-sky-100 ring-1 ring-sky-200 ring-opacity-50 hidden z-50">
                                <a href="{{ route('pt.index') }}" class="submenu-item block px-4 py-2 text-sky-800 hover:bg-sky-200 transition-colors duration-150" data-parent="pt" data-submenu="pt-ip">PT. IP</a>
                            </div>
                        </div>

                        <div class="relative">
                            <button onclick="toggleDropdown('kelompokDropdown')" class="menu-item flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors duration-150 focus:outline-none" data-menu="kelompok">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 2.05 1.97 3.45V20h6v-3.5c0-2.33-4.67-3.5-6-3.5z" />
                                </svg>
                                <span>Kelompok Integrasi</span>
                                <svg id="kelompokArrow" class="w-3 h-3 ml-1 mt-0.5 text-gray-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            <div id="kelompokDropdown" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-50"></div>
                        </div>

                        <a href="https://wa.me/6289647038212?text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                            rel="noopener noreferrer"
                            class="menu-item flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors duration-150"
                            data-menu="kontak">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Kontak</span>
                        </a>
                    </div>

                    <div class="flex justify-center space-x-8 text-gray-800 mt-2">
                        <a href="{{ route('produk.index') }}" class="menu-item flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors duration-150" data-menu="produk">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13L17 13M7 13H5.4M17 13l1.5 6M6 19a1 1 0 100 2 1 1 0 000-2zm12 0a1 1 0 100 2 1 1 0 000-2z" />
                            </svg>
                            <span>Produk</span>
                        </a>

                        <a href="{{ route('publikasi.index') }}" class="menu-item flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors duration-150" data-menu="publikasi">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <span>Publikasi</span>
                        </a>
                    </div>
                </div>

                <div class="flex items-center ml-auto">
                    <a href="#" class="bg-sky-600 text-white font-semibold px-5 py-2 rounded-md hover:bg-sky-700">Masuk</a>
                </div>

                <div class="md:hidden flex items-center ml-4">
                    <button id="mobile-menu-button" class="focus:outline-none">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    <script>
        // Data dari database disuntikkan menggunakan Blade (perbaikan sintaks)
        const kelompokIntegrasiData = @json(\App\ Models\ KategoriKelompok::with('kelompok') - > get());

        // Fungsi untuk mengisi dropdown dengan data
        function populateKelompokDropdown(data) {
            const dropdown = document.getElementById('kelompokDropdown');
            dropdown.innerHTML = ''; // Kosongkan dropdown sebelum diisi

            data.forEach(category => {
                const categoryDiv = document.createElement('div');
                categoryDiv.className = 'relative';

                const button = document.createElement('button');
                button.id = `${category.nama.toLowerCase().replace(/\s+/g, '-')}-button`;
                button.onclick = () => toggleDropdown(`${category.nama.toLowerCase().replace(/\s+/g, '-')}-dropdown`);
                button.className = 'dropdown-submenu-item w-full text-left px-4 py-2 hover:bg-sky-100 hover:text-sky-600 flex justify-between items-center transition-colors duration-150';
                button.setAttribute('data-menu', category.nama.toLowerCase().replace(/\s+/g, '-'));
                button.textContent = category.nama; // Menggunakan 'nama' dari KategoriKelompok
                const arrow = document.createElement('svg');
                arrow.id = `${category.nama.toLowerCase().replace(/\s+/g, '-')}-arrow`;
                arrow.className = 'w-3 h-3 ml-2 text-gray-600 flex-shrink-0 transform transition-transform duration-200';
                arrow.setAttribute('fill', 'none');
                arrow.setAttribute('stroke', 'currentColor');
                arrow.setAttribute('viewBox', '0 0 24 24');
                arrow.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />';
                button.appendChild(arrow);

                const subDropdown = document.createElement('div');
                subDropdown.id = `${category.nama.toLowerCase().replace(/\s+/g, '-')}-dropdown`;
                subDropdown.className = 'mt-1 ml-6 w-44 rounded-md shadow-lg bg-sky-100 ring-1 ring-sky-200 ring-opacity-50 hidden';

                category.kelompok.forEach(kelompok => {
                    const link = document.createElement('a');
                    link.href = `{{ url('kelompok') }}/${kelompok.id_kelompok}`;; // Sesuaikan dengan route
                    link.className = 'submenu-item block px-4 py-2 text-sky-800 hover:bg-sky-200 transition-colors duration-150';
                    link.setAttribute('data-parent', category.nama.toLowerCase().replace(/\s+/g, '-'));
                    link.setAttribute('data-submenu', kelompok.id_kelompok);
                    link.textContent = kelompok.nama; // Menggunakan 'nama' dari Kelompok
                    subDropdown.appendChild(link);
                });

                categoryDiv.appendChild(button);
                categoryDiv.appendChild(subDropdown);
                dropdown.appendChild(categoryDiv);
            });

            // Tambahkan event listener untuk submenu item
            document.querySelectorAll('.submenu-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    const parentMenu = this.getAttribute('data-parent');
                    if (parentMenu) {
                        setActiveMenu(parentMenu);
                    }
                    setActiveSubmenuItem(this);
                });
            });
        }

        let path = window.location.pathname;

        let currentActiveMenu = 'beranda';
        if (path.includes('publikasi')) {
            currentActiveMenu = 'publikasi';
        } else if (path.includes('produk')) {
            currentActiveMenu = 'produk';
        } else if (path.includes('kontak')) {
            currentActiveMenu = 'kontak';
        } else if (path.includes('pt')) {
            currentActiveMenu = 'pt';
        } else if (path.includes('kelompok')) {
            currentActiveMenu = 'kelompok';
        }

        function setActiveMenu(menuId) {
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('text-sky-600', 'active');
            });

            document.querySelectorAll('.dropdown-submenu-item').forEach(item => {
                item.classList.remove('text-sky-600', 'active');
            });

            document.querySelectorAll('.submenu-item').forEach(item => {
                item.classList.remove('bg-sky-600', 'text-white');
                item.classList.add('text-sky-800');
            });

            const activeItem = document.querySelector(`[data-menu="${menuId}"]`);
            if (activeItem) {
                activeItem.classList.add('text-sky-600', 'active');
                currentActiveMenu = menuId;
            }

            if (!['kelompok', 'pt', 'kwt', 'pertanian'].includes(menuId)) {
                closeAllDropdowns();
            }
        }

        function setActiveSubmenuItem(element) {
            document.querySelectorAll('.submenu-item').forEach(item => {
                item.classList.remove('bg-sky-600', 'text-white');
                item.classList.add('text-sky-800');
            });

            element.classList.add('bg-sky-600', 'text-white');
            element.classList.remove('text-sky-800');
            activeSubmenuItem = element.getAttribute('data-submenu');
        }

        function rotateArrow(arrowId, isOpen) {
            const arrow = document.getElementById(arrowId);
            if (arrow) {
                if (isOpen) {
                    arrow.style.transform = 'rotate(90deg)';
                } else {
                    arrow.style.transform = 'rotate(0deg)';
                }
            }
        }

        function closeAllDropdowns() {
            const allDropdowns = ['kelompokDropdown', 'perusahaanDropdown', 'kwtDropdown', 'pertanianDropdown'];
            const allArrows = ['kelompokArrow', 'perusahaanArrow', 'kwtArrow', 'pertanianArrow'];

            allDropdowns.forEach(dropId => {
                document.getElementById(dropId).classList.add('hidden');
            });

            allArrows.forEach(arrowId => {
                rotateArrow(arrowId, false);
            });
        }

        function toggleDropdown(id) {
            const el = document.getElementById(id);
            const isCurrentlyHidden = el.classList.contains('hidden');

            const mainDropdowns = ['kelompokDropdown', 'perusahaanDropdown'];
            const subDropdowns = ['kwtDropdown', 'pertanianDropdown'];

            if (mainDropdowns.includes(id)) {
                mainDropdowns.forEach(dropId => {
                    if (dropId !== id) {
                        document.getElementById(dropId).classList.add('hidden');
                        if (dropId === 'kelompokDropdown') {
                            rotateArrow('kelompokArrow', false);
                        } else if (dropId === 'perusahaanDropdown') {
                            rotateArrow('perusahaanArrow', false);
                        }
                    }
                });

                if (id === 'kelompokDropdown') {
                    setActiveMenu('kelompok');
                    rotateArrow('kelompokArrow', isCurrentlyHidden);
                } else if (id === 'perusahaanDropdown') {
                    setActiveMenu('pt');
                    rotateArrow('perusahaanArrow', isCurrentlyHidden);
                }
            }

            if (subDropdowns.includes(id)) {
                subDropdowns.forEach(dropId => {
                    if (dropId !== id) {
                        document.getElementById(dropId).classList.add('hidden');
                        if (dropId === 'kwtDropdown') {
                            rotateArrow('kwtArrow', false);
                        } else if (dropId === 'pertanianDropdown') {
                            rotateArrow('pertanianArrow', false);
                        }
                    }
                });

                if (id === 'kwtDropdown') {
                    setActiveMenu('kwt');
                    rotateArrow('kwtArrow', isCurrentlyHidden);
                } else if (id === 'pertanianDropdown') {
                    setActiveMenu('pertanian');
                    rotateArrow('pertanianArrow', isCurrentlyHidden);
                }
            }
            el.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const dropdowns = ['kelompokDropdown', 'perusahaanDropdown', 'kwtDropdown', 'pertanianDropdown'];
            dropdowns.forEach(id => {
                const el = document.getElementById(id);
                if (el && !el.contains(e.target) && !document.querySelector(`[onclick="toggleDropdown('${id}')"]`).contains(e.target)) {
                    el.classList.add('hidden');
                    if (id === 'kelompokDropdown') {
                        rotateArrow('kelompokArrow', false);
                    } else if (id === 'perusahaanDropdown') {
                        rotateArrow('perusahaanArrow', false);
                    } else if (id === 'kwtDropdown') {
                        rotateArrow('kwtArrow', false);
                    } else if (id === 'pertanianDropdown') {
                        rotateArrow('pertanianArrow', false);
                    }
                }
            });
        });

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const menuId = this.getAttribute('data-menu');
                if (menuId) {
                    setActiveMenu(menuId);
                }
            });
        });

        document.querySelectorAll('.dropdown-submenu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const menuId = this.getAttribute('data-menu');
                if (menuId) {
                    setActiveMenu(menuId);
                }
            });
        });

        document.querySelectorAll('.submenu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const parentMenu = this.getAttribute('data-parent');
                if (parentMenu) {
                    setActiveMenu(parentMenu);
                }
                setActiveSubmenuItem(this);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            populateKelompokDropdown(kelompokIntegrasiData);
            setActiveMenu(currentActiveMenu);
        });
    </script>

</body>

</html>