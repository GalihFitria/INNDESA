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

        /* Custom styles for mobile menu */
        .mobile-menu {
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu-hidden {
            transform: translateX(100%);
        }

        .mobile-menu-open {
            transform: translateX(0);
        }

        body,
        nav,
        nav * {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Perbaikan: CSS yang sangat spesifik untuk button masuk agar konsisten di semua halaman */
        .nav-login-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #0284c7;
            /* sky-600 */
            color: white;
            font-weight: 600;
            border-radius: 0.375rem;
            /* rounded-md */
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
            white-space: nowrap;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        /* Ukuran untuk mobile */
        @media (max-width: 767px) {
            .nav-login-btn {
                font-size: 0.875rem;
                /* 14px */
                padding: 0.625rem 1.25rem;
                /* py-2.5 px-5 */
                line-height: 1.25rem;
                /* leading-none */
            }
        }

        /* Ukuran untuk desktop */
        @media (min-width: 768px) {
            .nav-login-btn {
                font-size: 1rem;
                /* 16px */
                padding: 0.5rem 1.25rem;
                /* py-2 px-5 */
                line-height: 1.5rem;
                /* leading-none */
            }
        }

        /* Hover state */
        .nav-login-btn:hover {
            background-color: #0369a1;
            /* sky-700 */
        }

        /* Perbaikan: Ukuran font yang konsisten untuk mobile */
        .mobile-menu-item {
            font-size: 1rem;
            /* 16px untuk mobile */
            font-weight: 500;
            padding: 0.75rem 0;
            /* py-3 */
        }

        /* Perbaikan: Menu mobile yang konsisten */
        @media (max-width: 767px) {

            /* Logo yang lebih kecil di mobile */
            .nav-logo-mobile {
                width: 3rem;
                /* 48px */
                height: 3rem;
                /* 48px */
            }

            /* PERBAIKAN: Brand text yang lebih kecil di mobile dengan ukuran tetap */
            .nav-brand-text-mobile {
                font-size: 1.25rem !important;
                /* 20px - ukuran tetap untuk mobile */
                line-height: 1.2 !important;
                /* Menjaga jarak antar baris */
            }

            /* Menu items dengan tinggi yang konsisten */
            .mobile-menu-item {
                min-height: 3rem;
                /* 48px */
                display: flex;
                align-items: center;
            }
        }

        /* Perbaikan: Hover state yang konsisten untuk mobile */
        .mobile-menu-item:hover {
            color: #0284c7;
            /* sky-600 */
        }

        /* Perbaikan: Active state yang konsisten untuk mobile */
        .mobile-menu-item.active {
            color: #0284c7;
            /* sky-600 */
        }

        /* Perbaikan: Dropdown konsisten di semua ukuran */
        .dropdown-container {
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .dropdown-sub-container {
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .dropdown-sub-item {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        /* Perbaikan: Dropdown untuk mobile */
        @media (max-width: 767px) {
            .dropdown-container {
                background-color: #f0f9ff;
                border: 1px solid #bae6fd;
                max-height: 300px;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            .dropdown-item {
                padding: 0.75rem 1rem;
                font-size: 1rem;
                line-height: 1.5rem;
            }

            .dropdown-sub-container {
                background-color: #e0f2fe;
                border: 1px solid #7dd3fc;
                margin-left: 1rem;
                margin-top: 0.25rem;
                max-height: 250px;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            .dropdown-sub-item {
                padding: 0.75rem 1rem;
                font-size: 1rem;
                line-height: 1.5rem;
            }
        }

        /* Perbaikan: Dropdown untuk desktop */
        @media (min-width: 768px) {
            .dropdown-container {
                background-color: #ffffff;
                border: 1px solid #e5e7eb;
            }

            .dropdown-item {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                line-height: 1.25rem;
            }

            /* Hanya bagian submenu yang diubah */
            .dropdown-sub-container {
                background-color: #f0f9ff;
                border: 1px solid #bae6fd;
                margin-top: 0.25rem;
                margin-left: 1rem;
                /* Menjorok ke dalam */
                width: 100%;
                /* Lebar sama dengan parent */
                min-width: 100%;
                /* Minimal sama dengan lebar parent */
                max-width: 100%;
                /* Maksimal sama dengan lebar parent */
                white-space: normal;
                /* Izinkan wrapping untuk teks dengan spasi */
                word-wrap: break-word;
                /* Pecah kata jika perlu */
                overflow: hidden;
                /* Sembunyikan overflow */

            }

            .dropdown-sub-item {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                line-height: 1.25rem;
                white-space: normal;
                /* Izinkan wrapping untuk teks dengan spasi */
                word-wrap: break-word;
                /* Pecah kata jika perlu */
            }

            /* Khusus untuk teks tanpa spasi (panjang) */
            .dropdown-sub-item:has(> span:not(:empty)) {
                white-space: nowrap;
                /* Teks tanpa spasi tetap satu baris */
                overflow: visible;
                /* Tampilkan overflow */
            }
        }

        /* PERBAIKAN UTAMA: Padding-top untuk body agar konten tidak tertutup navbar */
        @media (max-width: 767px) {
            body {
                padding-top: 4rem;
                /* 64px, sama dengan tinggi navbar di mobile (h-16) */
            }
        }

        @media (min-width: 768px) {
            body {
                padding-top: 8rem;
                /* 128px, sama dengan tinggi navbar di desktop (h-32) */
            }
        }

        /* Style untuk informasi kelompok di dropdown mobile */
        .kelompok-info-mobile {
            display: none;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
        }

        @media (max-width: 767px) {
            .kelompok-info-mobile {
                display: block;
            }
        }

        /* Perbaikan untuk ukuran avatar yang konsisten */
        .user-avatar {
            width: 2.5rem !important;
            height: 2.5rem !important;
            flex-shrink: 0 !important;
        }

        /* Bagian ini ditambahkan/diubah */
        .kelompok-info-container {
            min-width: 0;
            /* Memungkinkan flex item untuk mengecil */
            flex-shrink: 1;
            /* Memungkinkan container untuk mengecil */
            max-width: 250px;
            /* Batas maksimal lebar container */
            width: fit-content;
            /* Container menyesuaikan dengan konten */
        }

        /* Bagian ini ditambahkan/diubah */
        .kelompok-name {
            white-space: normal;
            /* Mengizinkan teks untuk wrap ke baris baru */
            word-wrap: break-word;
            /* Memastikan kata panjang bisa dipotong */
            font-size: clamp(0.65rem, 1.2vw, 0.875rem);
            /* Ukuran font yang responsif */
            line-height: 1.2;
            /* Jarak antar baris yang normal */
            text-align: right;
            /* Rata kanan untuk desktop */
            max-width: 100%;
            /* Maksimal lebar sesuai container */
        }

        .kelompok-kategori {
            white-space: normal;
            /* Mengizinkan teks untuk wrap ke baris baru */
            word-wrap: break-word;
            /* Memastikan kata panjang bisa dipotong */
            font-size: clamp(0.6rem, 1vw, 0.75rem);
            /* Ukuran font yang responsif */
            line-height: 1.2;
            /* Jarak antar baris yang normal */
            text-align: right;
            /* Rata kanan untuk desktop */
            max-width: 100%;
            /* Maksimal lebar sesuai container */
        }

        /* Untuk mobile dropdown */
        @media (max-width: 767px) {
            .kelompok-info-mobile .kelompok-name {
                text-align: left;
                /* Rata kiri untuk mobile dropdown */
                font-size: clamp(0.65rem, 2vw, 0.875rem);
                /* Ukuran font yang responsif */
                white-space: normal;
                /* Mengizinkan teks untuk wrap ke baris baru */
                word-wrap: break-word;
                /* Memastikan kata panjang bisa dipotong */
                max-width: 100%;
                /* Maksimal lebar sesuai container */
                line-height: 1.2;
                /* Jarak antar baris yang normal */
            }

            .kelompok-info-mobile .kelompok-kategori {
                text-align: left;
                /* Rata kiri untuk mobile dropdown */
                font-size: clamp(0.6rem, 1.8vw, 0.75rem);
                /* Ukuran font yang responsif */
                white-space: normal;
                /* Mengizinkan teks untuk wrap ke baris baru */
                word-wrap: break-word;
                /* Memastikan kata panjang bisa dipotong */
                max-width: 100%;
                /* Maksimal lebar sesuai container */
                line-height: 1.2;
                /* Jarak antar baris yang normal */
            }
        }

        /* Untuk mobile view */
        @media (max-width: 767px) {
            .kelompok-info-container {
                max-width: 180px;
                /* Batas maksimal lebar container di mobile */
                width: fit-content;
                /* Container menyesuaikan dengan konten */
            }

            .kelompok-name {
                text-align: left;
                /* Rata kiri untuk mobile */
                font-size: clamp(0.65rem, 2vw, 0.875rem);
                /* Ukuran font yang responsif */
                white-space: normal;
                /* Mengizinkan teks untuk wrap ke baris baru */
                word-wrap: break-word;
                /* Memastikan kata panjang bisa dipotong */
                max-width: 100%;
                /* Maksimal lebar sesuai container */
                line-height: 1.2;
                /* Jarak antar baris yang normal */
            }

            .kelompok-kategori {
                text-align: left;
                /* Rata kiri untuk mobile */
                font-size: clamp(0.6rem, 1.8vw, 0.75rem);
                /* Ukuran font yang responsif */
                white-space: normal;
                /* Mengizinkan teks untuk wrap ke baris baru */
                word-wrap: break-word;
                /* Memastikan kata panjang bisa dipotong */
                max-width: 100%;
                /* Maksimal lebar sesuai container */
                line-height: 1.2;
                /* Jarak antar baris yang normal */
            }
        }

        /* Bagian ini ditambahkan/diubah */
        .nav-menu-container {
            flex-shrink: 0;
            /* Mencegah menu navigasi menyusut */
            min-width: 600px;
            /* Lebar minimum untuk menu navigasi */
        }

        /* PERBAIKAN BARU: CSS untuk memastikan teks "Inovasi Nusantara Desa Integratif Pangan" tetap satu baris */
        .nav-brand-tagline {
            white-space: nowrap;
            /* Mencegah teks dari pembungkusan ke baris baru */
            overflow: hidden;
            /* Menyembunyikan teks yang melampaui container */
            text-overflow: ellipsis;
            /* Menambahkan "..." jika teks terlalu panjang */
            max-width: 100%;
            /* Maksimal lebar sesuai container */
        }

        /* Untuk memastikan container brand memiliki layout yang stabil */
        .nav-brand-container {
            display: flex;
            flex-direction: column;
            min-width: 0;
            /* Memungkinkan flex item untuk mengecil */
            flex-shrink: 0;
            /* Mencegah container brand dari menyusut */
        }

        /* PERBAIKAN BARU: Mengurangi ukuran teks untuk desktop tetapi mempertahankan ukuran logo */
        @media (min-width: 768px) {
            .nav-brand-container {
                min-width: 200px;
                /* Mengurangi lebar minimum untuk container brand di desktop */
            }

            /* PERBAIKAN: Mengurangi ukuran font tagline */
            .nav-brand-tagline {
                font-size: clamp(0.6rem, 0.9vw, 0.75rem);
                /* Mengurangi ukuran font tagline */
            }

            /* PERBAIKAN: Memperbesar ukuran font judul INNDESA untuk desktop */
            .nav-brand-title {
                font-size: 2.5rem !important;
                /* Memperbesar ukuran font judul untuk desktop */
                line-height: 1.2 !important;
            }

            /* PERBAIKAN: Mengurangi jarak antara nama kelompok, avatar, dan menu navbar */
            .kelompok-avatar-container {
                margin-left: 0.75rem;
                /* Mengurangi jarak lebih kecil lagi */
            }
        }


        /* Tambahkan di style CSS */
        .dropdown-sub-item span {
            font-weight: 600;
        }

        /* Reset box-sizing untuk semua elemen */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* Reset khusus untuk tombol login */
        .nav-login-wrapper,
        .nav-login-wrapper * {
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            text-decoration: none !important;
            box-sizing: border-box !important;
            font-family: 'Poppins', sans-serif !important;
            letter-spacing: 0 !important;
            text-transform: none !important;
            line-height: 1.25 !important;
        }

        /* Perkuat kelas untuk tombol login */
        .nav-login-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background-color: #0284c7 !important;
            /* sky-600 */
            color: white !important;
            font-weight: 600 !important;
            border-radius: 0.375rem !important;
            /* rounded-md */
            transition: background-color 0.2s ease-in-out !important;
            white-space: nowrap !important;
            min-height: 40px !important;
            /* Tinggi minimum konsisten */
            min-width: 80px !important;
            /* Lebar minimum konsisten */
            text-align: center !important;
            vertical-align: middle !important;
            position: relative !important;
            overflow: hidden !important;
        }

        /* Ukuran untuk mobile */
        @media (max-width: 767px) {
            .nav-login-btn {
                font-size: 14px !important;
                /* 14px fixed */
                padding: 10px 20px !important;
                /* py-2.5 px-5 */
                height: 40px !important;
                /* Tinggi fixed */
                width: auto !important;
                /* Lebar otomatis */
            }
        }

        /* Ukuran untuk desktop */
        @media (min-width: 768px) {
            .nav-login-btn {
                font-size: 16px !important;
                /* 16px fixed */
                padding: 8px 20px !important;
                /* py-2 px-5 */
                height: 40px !important;
                /* Tinggi fixed */
                width: auto !important;
                /* Lebar otomatis */
            }
        }

        /* Hover state */
        .nav-login-btn:hover {
            background-color: #0369a1 !important;
            /* sky-700 */
        }

        /* Wrapper khusus untuk tombol login */
        .nav-login-wrapper {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            padding: 0 !important;
            flex-shrink: 0 !important;
            height: 40px !important;
            /* Sama dengan tombol */
            min-width: 80px !important;
            /* Lebar minimum */
        }

        /* PERBAIKAN: Aturan untuk tampilan mobile */
        @media (max-width: 767px) {
            .nav-right-container {
                display: flex;
                align-items: center;
                gap: 0.25rem; /* Mengurangi jarak antar elemen */
                margin-right: 0.25rem; /* Mengurangi jarak dari tepi kanan */
            }

            .hamburger-button {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 36px; /* Mengurangi ukuran tombol hamburger */
                height: 36px; /* Mengurangi ukuran tombol hamburger */
            }

            /* Mengurangi ukuran avatar di mobile */
            #userMenuButton svg {
                width: 2rem !important;
                height: 2rem !important;
            }

            /* Menghilangkan margin pada tombol avatar di mobile */
            #userMenuButton {
                margin-right: 0 !important;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-white">
    <nav class="bg-white shadow-md fixed top-0 w-full z-50">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bagian ini diubah -->
            <div class="flex items-center h-16 md:h-32 w-full">
                <!-- PERBAIKAN: Mengubah margin logo agar lebih terlihat -->
                <a href="{{ route('beranda') }}" class="flex items-center ml-4 md:ml-8 space-x-4">
                    <div class="w-12 h-12 md:w-28 md:h-28 rounded-full overflow-hidden flex-shrink-0 nav-logo-mobile">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo INNDESA" class="object-cover w-full h-full" />
                    </div>
                    <div class="nav-brand-container">
                        <!-- PERBAIKAN: Menambahkan class nav-brand-title untuk mengontrol ukuran font di desktop -->
                        <h1 class="font-extrabold leading-tight text-gray-900 select-none nav-brand-text-mobile nav-brand-title">INNDESA</h1>
                        <p class="text-sm md:text-base leading-snug text-gray-600 select-none hidden md:block">Inovasi Nusantara Desa Integratif Pangan</p>
                    </div>
                </a>

                <!-- PERBAIKAN: Mengubah margin menu navigasi menjadi seperti kode kedua -->
                <div class="hidden md:flex flex-col font-semibold select-none ml-auto flex-shrink-0">
                    <div class="flex space-x-8 text-gray-800 mb-1 items-center">
                        <!-- Menu items -->
                        <a href="{{ route('beranda') }}" class="menu-item flex items-center gap-1 hover:text-sky-600 transition-colors duration-150" data-menu="beranda">
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
                            <div id="perusahaanDropdown" class="absolute left-0 mt-2 w-48 dropdown-container hidden z-50">
                                <a href="{{ route('perusahaan_pembina.index') }}" class="dropdown-item block text-sky-800 hover:bg-sky-200 transition-colors duration-150" data-parent="pt" data-submenu="pt-ip">PT. IP</a>
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
                            <div id="kelompokDropdown" class="absolute left-0 mt-2 w-48 dropdown-container hidden z-50"></div>
                        </div>

                        <a href="{{ route('kontak.index') }}"
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
                        <a href="{{ route('produk.index') }}?from=produk" class="menu-item flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors duration-150" data-menu="produk">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13L17 13M7 13H5.4M17 13l1.5 6M6 19a1 1 0 100 2 1 1 0 000-2zm12 0a1 1 0 100 2 1 1 0 000-2z" />
                            </svg>
                            <span>Produk</span>
                        </a>

                        <a href="{{ route('publikasi.index') }}" class="menu-item flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors duration-150" data-menu="publikasi">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4-H7V8z" />
                            </svg>
                            <span>Publikasi</span>
                        </a>
                    </div>
                </div>

                <!-- PERBAIKAN: Struktur HTML untuk bagian kanan navbar -->
                <div class="nav-right-container ml-auto flex items-center">
                    @guest('web')
                    <div class="nav-login-wrapper">
                        <a href="{{ route('admin_login.index') }}" class="nav-login-btn">
                            Masuk
                        </a>
                    </div>
                    @endguest

                    @auth('web')
                    @php
                    $user = auth()->user();

                    // kalau user role admin_kelompok, ambil data kelompok
                    $kelompok = null;
                    $kategori = null;

                    if ($user->role === 'admin_kelompok' && $user->status === 'sudah daftar') {
                    $adminKelompok = \App\Models\InformasiUser::with('kelompok.kategori')
                    ->where('id_user', $user->id_user)
                    ->first();

                    if ($adminKelompok) {
                    $kelompok = $adminKelompok->kelompok;
                    $kategori = $kelompok?->kategori;
                    }
                    }
                    @endphp

                    <!-- Avatar & Dropdown dengan profil kelompok -->
                    <div class="flex items-center">
                        @if($kelompok)
                        <div class="mr-5 md:mr-5 text-right flex flex-col justify-center items-end leading-snug hidden md:flex kelompok-info-container">
                            <div class="text-sm md:text-base font-semibold text-gray-800 kelompok-name" title="{{ $kelompok->nama }}">
                                {{ $kelompok->nama }}
                            </div>
                            <div class="text-[11px] md:text-sm text-gray-500 kelompok-kategori" title="{{ $kategori?->nama ?? 'Kategori Tidak Ditemukan' }}">
                                {{ $kategori?->nama ?? 'Kategori Tidak Ditemukan' }}
                            </div>
                        </div>
                        @endif

                        <div class="relative">
                            <button id="userMenuButton" onclick="toggleUserMenu()"
                                class="flex items-center focus:outline-none">
                                <svg class="w-10 h-10 text-gray-400 rounded-full bg-gray-200 p-2"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </button>


                            <div id="userMenu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 z-50">

                                <!-- Informasi kelompok untuk mobile -->
                                @if($kelompok)
                                <div class="kelompok-info-mobile px-4 py-2">
                                    <div class="text-sm font-semibold text-gray-800 kelompok-name" title="{{ $kelompok->nama }}">{{ $kelompok->nama }}</div>
                                    <div class="text-xs text-gray-500 kelompok-kategori" title="{{ $kategori?->nama ?? 'Kategori Tidak Ditemukan' }}">{{ $kategori?->nama ?? 'Kategori Tidak Ditemukan' }}</div>
                                </div>
                                @endif

                                <a href="{{ route('Admin_Kelompok.profil.index') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth

                    <!-- Hamburger Mobile -->
                    <button id="mobile-menu-button" class="md:hidden focus:outline-none hamburger-button">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden fixed top-0 right-0 h-full w-64 bg-white shadow-lg mobile-menu mobile-menu-hidden z-50">
            <div class="flex flex-col p-4">
                <button id="mobile-menu-close" class="self-end mb-4 focus:outline-none">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <a href="{{ route('beranda') }}" class="mobile-menu-item menu-item flex items-center gap-2 text-gray-800 hover:text-sky-600 transition-colors duration-150" data-menu="beranda">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 9.75L12 3l9 6.75v11.25a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75V9.75z" />
                    </svg>
                    <span>Beranda</span>
                </a>
                <div class="relative">
                    <button onclick="toggleMobileDropdown('mobile-perusahaanDropdown')" class="mobile-menu-item menu-item flex items-center gap-2 text-gray-800 hover:text-sky-600 transition-colors duration-150 w-full" data-menu="pt">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 22V2h16v20H4zm2-2h2v-2H6v2zm0-4h2v-2H6v2zm0-4h2V8H6v4zm4 8h2v-2h-2v2zm0-4h2v-2h-2v2zm0-4h2V8h-2v4zm4 8h2v-2h-2v2zm0-4h2v-2h-2v2zm0-4h2V8h-2v4z" />
                        </svg>
                        <span>Perusahaan Pembina</span>
                        <svg id="mobile-perusahaanArrow" class="w-3 h-3 ml-auto text-gray-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <div id="mobile-perusahaanDropdown" class="ml-4 dropdown-container hidden">
                        <a href="{{ route('perusahaan_pembina.index') }}" class="dropdown-item block text-sky-800 hover:bg-sky-200 transition-colors duration-150" data-parent="pt" data-submenu="pt-ip">PT. IP</a>
                    </div>
                </div>
                <div class="relative">
                    <button onclick="toggleMobileDropdown('mobile-kelompokDropdown')" class="mobile-menu-item menu-item flex items-center gap-2 text-gray-800 hover:text-sky-600 transition-colors duration-150 w-full" data-menu="kelompok">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-3.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 2.05 1.97 3.45V20h6v-3.5c0-2.33-4.67-3.5-6-3.5z" />
                        </svg>
                        <span>Kelompok Integrasi</span>
                        <svg id="mobile-kelompokArrow" class="w-3 h-3 ml-auto text-gray-600 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <div id="mobile-kelompokDropdown" class="ml-4 dropdown-container hidden"></div>
                </div>
                <a href="{{ route('kontak.index') }}"
                    rel="noopener noreferrer"
                    class="mobile-menu-item menu-item flex items-center gap-2 text-gray-800 hover:text-sky-600 transition-colors duration-150"
                    data-menu="kontak">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Kontak</span>
                </a>

                <a href="{{ route('produk.index') }}?from=produk" class="mobile-menu-item menu-item flex items-center gap-2 text-gray-800 hover:text-sky-600 transition-colors duration-150" data-menu="produk">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13L17 13M7 13H5.4M17 13l1.5 6M6 19a1 1 0 100 2 1 1 0 000-2zm12 0a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                    <span>Produk</span>
                </a>
                <a href="{{ route('publikasi.index') }}" class="mobile-menu-item menu-item flex items-center gap-2 text-gray-800 hover:text-sky-600 transition-colors duration-150" data-menu="publikasi">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4-H7V8z" />
                    </svg>
                    <span>Publikasi</span>
                </a>
            </div>
        </div>
    </nav>

    <script>
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
        }

        // Tutup dropdown kalau klik di luar
        window.addEventListener('click', function(e) {
            const menu = document.getElementById('userMenu');
            const button = document.getElementById('userMenuButton');
            if (menu && !menu.contains(e.target) && !button.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

    <script>
        // TAMBAHAN
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menerapkan styling secara langsung
            function ensureButtonConsistency() {
                const loginButtons = document.querySelectorAll('.nav-login-btn');

                loginButtons.forEach(button => {
                    // Terapkan styling secara inline untuk memastikan konsistensi
                    button.style.display = 'inline-flex';
                    button.style.alignItems = 'center';
                    button.style.justifyContent = 'center';
                    button.style.backgroundColor = '#0284c7';
                    button.style.color = 'white';
                    button.style.fontWeight = '600';
                    button.style.fontFamily = "'Poppins', sans-serif";
                    button.style.borderRadius = '0.375rem';
                    button.style.textDecoration = 'none';
                    button.style.border = 'none';
                    button.style.cursor = 'pointer';
                    button.style.transition = 'background-color 0.2s ease-in-out';
                    button.style.whiteSpace = 'nowrap';
                    button.style.boxSizing = 'border-box';
                    button.style.lineHeight = '1.25';
                    button.style.letterSpacing = '0';
                    button.style.textTransform = 'none';
                    button.style.minHeight = '40px';
                    button.style.minWidth = '80px';
                    button.style.textAlign = 'center';
                    button.style.verticalAlign = 'middle';
                    button.style.position = 'relative';
                    button.style.overflow = 'hidden';

                    // Terapkan padding berdasarkan ukuran layar
                    if (window.innerWidth < 768) {
                        button.style.fontSize = '14px';
                        button.style.padding = '10px 20px';
                        button.style.height = '40px';
                    } else {
                        button.style.fontSize = '16px';
                        button.style.padding = '8px 20px';
                        button.style.height = '40px';
                    }
                });
            }

            // Panggil fungsi saat halaman dimuat
            ensureButtonConsistency();

            // Panggil lagi saat window di-resize
            window.addEventListener('resize', ensureButtonConsistency);
        });


        const loggedInKelompokId = @json($kelompok_login ?->id_kelompok ?? null);

        // Data dari database disuntikkan menggunakan Blade
        const kelompokIntegrasiData = @json(\App\Models\KategoriKelompok::with('kelompok')->get());

        // Fungsi untuk mengisi dropdown dengan data
        function populateKelompokDropdown(data, isMobile = false) {
            const dropdown = isMobile ? document.getElementById('mobile-kelompokDropdown') : document.getElementById('kelompokDropdown');
            dropdown.innerHTML = '';

            data.forEach(category => {
                const categoryDiv = document.createElement('div');
                categoryDiv.className = 'relative';

                const button = document.createElement('button');
                const categoryId = category.nama.toLowerCase().replace(/\s+/g, '-');
                button.id = `${categoryId}-button${isMobile ? '-mobile' : ''}`;
                button.onclick = () => toggleDropdown(`${categoryId}-dropdown${isMobile ? '-mobile' : ''}`, isMobile);
                button.className = `dropdown-item w-full text-left hover:bg-sky-100 hover:text-sky-600 flex justify-between items-center transition-colors duration-150`;
                button.setAttribute('data-menu', categoryId);
                button.textContent = category.nama;

                const arrow = document.createElement('svg');
                arrow.id = `${categoryId}-arrow${isMobile ? '-mobile' : ''}`;
                arrow.className = 'w-3 h-3 ml-2 text-gray-600 flex-shrink-0 transform transition-transform duration-200';
                arrow.setAttribute('fill', 'none');
                arrow.setAttribute('stroke', 'currentColor');
                arrow.setAttribute('viewBox', '0 0 24 24');
                arrow.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />';
                button.appendChild(arrow);

                const subDropdown = document.createElement('div');
                subDropdown.id = `${categoryId}-dropdown${isMobile ? '-mobile' : ''}`;
                subDropdown.className = `dropdown-sub-container hidden`;

                category.kelompok.forEach(kelompok => {
                    const link = document.createElement('a');

                    // LOGIKA UTAMA: Tentukan URL berdasarkan login status
                    if (loggedInKelompokId && String(kelompok.id_kelompok) === String(loggedInKelompokId)) {
                        // Admin melihat CRUD untuk kelompoknya sendiri
                        link.href = `{{ url('Admin_Kelompok/kelompok') }}/${kelompok.id_kelompok}`;
                    } else {
                        // Pengunjung atau admin melihat kelompok lain
                        link.href = `{{ url('kelompok') }}/${kelompok.id_kelompok}?from=kelompok&id=${kelompok.id_kelompok}`;
                    }

                    link.className = `dropdown-sub-item block text-sky-800 hover:bg-sky-200 transition-colors duration-150`;
                    link.setAttribute('data-parent', categoryId);
                    link.setAttribute('data-submenu', kelompok.id_kelompok);
                    link.textContent = kelompok.nama;

                    // Tambahkan indikator visual untuk kelompok sendiri (opsional)
                    if (loggedInKelompokId && String(kelompok.id_kelompok) === String(loggedInKelompokId)) {
                        link.innerHTML += ' <span class="text-xs text-sky-600 ml-1">(Kelompok Anda)</span>';
                    }

                    subDropdown.appendChild(link);
                });

                categoryDiv.appendChild(button);
                categoryDiv.appendChild(subDropdown);
                dropdown.appendChild(categoryDiv);
            });

            // Event listener untuk submenu item
            document.querySelectorAll('.dropdown-sub-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    const parentMenu = this.getAttribute('data-parent');
                    if (parentMenu) {
                        localStorage.setItem('lastActiveMenu', 'kelompok');
                        setActiveMenu('kelompok');
                    }
                    setActiveSubmenuItem(this);
                    if (isMobile) {
                        closeMobileMenu();
                    }
                });
            });
        }

        // Fungsi untuk menentukan menu aktif berdasarkan URL
        // Ganti bagian determineActiveMenu() dengan ini:
        function determineActiveMenu() {
            const path = window.location.pathname;
            const params = new URLSearchParams(window.location.search);
            const from = params.get('from');

            // Cek parameter 'from' terlebih dahulu
            if (from) {
                return from;
            }

            // Cek localStorage untuk lastActiveMenu
            const lastActiveMenu = localStorage.getItem('lastActiveMenu');
            if (lastActiveMenu) {
                return lastActiveMenu;
            }

            // Default pengecekan berdasarkan path
            if (path.includes('publikasi')) {
                return 'publikasi';
            } else if (path.includes('produk')) {
                return 'produk';
            } else if (path.includes('kontak')) {
                return 'kontak';
            } else if (path.includes('pt')) {
                return 'pt';
            } else if (path.includes('kelompok') || path.includes('Admin_Kelompok')) {
                // Tambahkan pengecekan untuk Admin_Kelompok
                return 'kelompok';
            }

            return 'beranda';
        }

        let currentActiveMenu = determineActiveMenu();

        function setActiveMenu(menuId) {
            // Simpan menu aktif ke localStorage
            localStorage.setItem('lastActiveMenu', menuId);

            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('text-sky-600', 'active');
            });

            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.classList.remove('text-sky-600', 'active');
            });

            document.querySelectorAll('.dropdown-sub-item').forEach(item => {
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
            document.querySelectorAll('.dropdown-sub-item').forEach(item => {
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
                arrow.style.transform = isOpen ? 'rotate(90deg)' : 'rotate(0deg)';
            }
        }

        function closeAllDropdowns(isMobile = false) {
            const allDropdowns = isMobile ? ['mobile-kelompokDropdown', 'mobile-perusahaanDropdown'] : ['kelompokDropdown', 'perusahaanDropdown', 'kwtDropdown', 'pertanianDropdown'];
            const allArrows = isMobile ? ['mobile-kelompokArrow', 'mobile-perusahaanArrow'] : ['kelompokArrow', 'perusahaanArrow', 'kwtArrow', 'pertanianArrow'];

            allDropdowns.forEach(dropId => {
                const el = document.getElementById(dropId);
                if (el) el.classList.add('hidden');
            });

            allArrows.forEach(arrowId => {
                rotateArrow(arrowId, false);
            });
        }

        function toggleDropdown(id, isMobile = false) {
            const el = document.getElementById(id);
            const isCurrentlyHidden = el.classList.contains('hidden');

            const mainDropdowns = isMobile ? ['mobile-kelompokDropdown', 'mobile-perusahaanDropdown'] : ['kelompokDropdown', 'perusahaanDropdown'];
            const subDropdowns = isMobile ? [] : ['kwtDropdown', 'pertanianDropdown'];

            if (mainDropdowns.includes(id)) {
                mainDropdowns.forEach(dropId => {
                    if (dropId !== id) {
                        const dropEl = document.getElementById(dropId);
                        if (dropEl) dropEl.classList.add('hidden');
                        if (dropId === (isMobile ? 'mobile-kelompokDropdown' : 'kelompokDropdown')) {
                            rotateArrow(isMobile ? 'mobile-kelompokArrow' : 'kelompokArrow', false);
                        } else if (dropId === (isMobile ? 'mobile-perusahaanDropdown' : 'perusahaanDropdown')) {
                            rotateArrow(isMobile ? 'mobile-perusahaanArrow' : 'perusahaanArrow', false);
                        }
                    }
                });

                if (id === (isMobile ? 'mobile-kelompokDropdown' : 'kelompokDropdown')) {
                    setActiveMenu('kelompok');
                    rotateArrow(isMobile ? 'mobile-kelompokArrow' : 'kelompokArrow', isCurrentlyHidden);
                } else if (id === (isMobile ? 'mobile-perusahaanDropdown' : 'perusahaanDropdown')) {
                    setActiveMenu('pt');
                    rotateArrow(isMobile ? 'mobile-perusahaanArrow' : 'perusahaanArrow', isCurrentlyHidden);
                }
            }

            if (subDropdowns.includes(id)) {
                subDropdowns.forEach(dropId => {
                    if (dropId !== id) {
                        const dropEl = document.getElementById(dropId);
                        if (dropEl) dropEl.classList.add('hidden');
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

        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('mobile-menu-hidden');
            mobileMenu.classList.toggle('mobile-menu-open');
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.add('mobile-menu-hidden');
            mobileMenu.classList.remove('mobile-menu-open');
            closeAllDropdowns(true);
        }

        function toggleMobileDropdown(id) {
            toggleDropdown(id, true);
        }

        window.addEventListener('click', function(e) {
            const dropdowns = ['kelompokDropdown', 'perusahaanDropdown', 'kwtDropdown', 'pertanianDropdown'];
            dropdowns.forEach(id => {
                const el = document.getElementById(id);
                const toggleButton = document.querySelector(`[onclick="toggleDropdown('${id}')"]`);
                if (el && !el.contains(e.target) && toggleButton && !toggleButton.contains(e.target)) {
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
                    // Simpan menu yang diklik ke localStorage
                    localStorage.setItem('lastActiveMenu', menuId);
                    setActiveMenu(menuId);
                }
            });
        });

        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const menuId = this.getAttribute('data-menu');
                if (menuId) {
                    // Simpan menu yang diklik ke localStorage
                    localStorage.setItem('lastActiveMenu', menuId);
                    setActiveMenu(menuId);
                }
            });
        });

        document.querySelectorAll('.dropdown-sub-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const parentMenu = this.getAttribute('data-parent');
                if (parentMenu) {
                    // Simpan parent menu ke localStorage
                    localStorage.setItem('lastActiveMenu', parentMenu);
                    setActiveMenu(parentMenu);
                }
                setActiveSubmenuItem(this);
            });
        });

        document.getElementById('mobile-menu-button').addEventListener('click', toggleMobileMenu);
        document.getElementById('mobile-menu-close').addEventListener('click', closeMobileMenu);

        // PERBAIKAN
        // Ganti bagian DOMContentLoaded dengan ini:
        document.addEventListener('DOMContentLoaded', function() {
            populateKelompokDropdown(kelompokIntegrasiData);
            populateKelompokDropdown(kelompokIntegrasiData, true);

            const path = window.location.pathname;
            const params = new URLSearchParams(window.location.search);
            const from = params.get('from');

            if (path === '/' && !from) {
                localStorage.removeItem('lastActiveMenu'); // Hapus data lama jika di root
                setActiveMenu('beranda');
            } else if (from) {
                setActiveMenu(from);
            } else {
                // Tambahkan pengecekan khusus untuk halaman admin kelompok
                if (path.includes('/Admin_Kelompok/kelompok')) {
                    localStorage.setItem('lastActiveMenu', 'kelompok');
                    setActiveMenu('kelompok');
                } else {
                    const lastActiveMenu = localStorage.getItem('lastActiveMenu');
                    if (lastActiveMenu) {
                        setActiveMenu(lastActiveMenu);
                    } else {
                        setActiveMenu('beranda');
                    }
                }
            }
        });
    </script>
</body>

</html>