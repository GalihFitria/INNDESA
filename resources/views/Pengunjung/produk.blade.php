<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* PRELOADER */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .logo-loading {
            width: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }

        body:not(.loaded)>*:not(#preloader) {
            display: none;
        }


        .hero-title {
            text-shadow: 2px 2px 0px #ffffff, -2px -2px 0px #ffffff, 2px -2px 0px #ffffff, -2px 2px 0px #ffffff, 0px 2px 0px #ffffff, 2px 0px 0px #ffffff, 0px -2px 0px #ffffff, -2px 0px 0px #ffffff;
            -webkit-text-stroke: 1px #ffffff;
        }

        .hero-subtitle {
            text-shadow: 1px 1px 0px #ffffff, -1px -1px 0px #ffffff, 1px -1px 0px #ffffff, -1px 1px 0px #ffffff;
            -webkit-text-stroke: 0.5px #ffffff;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-blue {
            background-color: #3b82f6;
            color: white;
        }

        .btn-blue:hover {
            background-color: #2563eb;
        }

        .btn-green {
            background-color: #10b981;
            color: white;
        }

        .btn-green:hover {
            background-color: #059669;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
        }

        .pagination-btn {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            border: 1px solid #d1d5db;
            background-color: white;
            color: #374151;
            text-decoration: none;
            margin: 0 0.25rem;
        }

        .pagination-btn:hover {
            background-color: #f9fafb;
        }

        .pagination-btn.active {
            background-color: #0097D4;
            color: white;
            border-color: #0097D4;
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* PRODUK */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }

        .product-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .product-card-content {
            padding: 1rem;
        }

        /* Mobile style - Enhanced untuk responsivitas lebih baik */
        @media (max-width: 640px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                /* jadi 2 kolom */
                gap: 1rem;
            }

            .product-card img {
                height: 140px;
                /* lebih kecil di mobile */
            }

            .product-card-content h3 {
                font-size: 0.85rem;
                /* lebih kecil */
                line-height: 1.2;
                height: 2.4em;
                /* Fixed height untuk konsistensi */
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
            }

            .product-card-content p {
                font-size: 0.75rem;
                /* harga & stok lebih kecil */
            }

            /* Hero section mobile */
            .hero-section-mobile {
                min-height: 400px;
                padding-top: 5rem;
                padding-bottom: 2rem;
            }

            .hero-text-mobile h2 {
                font-size: 0.875rem !important;
                line-height: 1.3;
                margin-bottom: 0.5rem;
            }

            /* Search form mobile - keep side by side */
            .search-form-mobile {
                flex-direction: row;
                gap: 0.5rem;
                width: 100%;
                max-width: none;
                padding: 0 1rem;
            }

            .search-form-mobile input {
                flex: 1;
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
                min-width: 0;
            }

            .search-form-mobile button {
                flex-shrink: 0;
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
                white-space: nowrap;
            }

            /* Container mobile */
            .container-mobile {
                margin-top: 1rem;
                padding: 0 0.75rem;
                gap: 1rem;
            }

            /* Filter mobile - Button and dropdown style */
            .mobile-filter-container {
                display: flex;
                gap: 0.5rem;
                margin-bottom: 0.75rem;
            }

            .filter-button {
                flex: 1;
                background-color: #0097D4;
                color: white;
                border: none;
                border-radius: 0.5rem;
                padding: 0.75rem;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }

            .filter-button:hover {
                background-color: #007bb3;
            }

            .reset-button {
                background-color: #6b7280;
                color: white;
                border: none;
                border-radius: 0.5rem;
                padding: 0.75rem;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }

            .reset-button:hover {
                background-color: #4b5563;
            }

            .filter-dropdown {
                position: relative;
                width: 100%;
            }

            .filter-dropdown-content {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: white;
                border: 1px solid #d1d5db;
                border-radius: 0.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
                z-index: 50;
                margin-top: 0.25rem;
                max-height: 300px;
                overflow-y: auto;
                display: none;
            }

            .filter-dropdown-content.show {
                display: block;
            }

            .filter-dropdown-header {
                padding: 0.5rem 1rem;
                border-bottom: 1px solid #e5e7eb;
                font-weight: 600;
                color: #374151;
                font-size: 0.875rem;
            }

            .filter-dropdown-body {
                padding: 0.25rem 0;
            }

            .filter-dropdown-item {
                padding: 0.25rem 1rem;
                display: flex;
                align-items: center;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .filter-dropdown-item:hover {
                background-color: #f9fafb;
            }

            .filter-dropdown-item input[type="checkbox"] {
                margin-right: 0.5rem;
                accent-color: #0097D4;
                width: 0.875rem;
                height: 0.875rem;
            }

            .filter-dropdown-item span {
                font-size: 0.875rem;
            }

            .filter-dropdown-footer {
                padding: 0.5rem 1rem;
                border-top: 1px solid #e5e7eb;
            }

            .filter-dropdown-apply {
                width: 100%;
                background-color: #0097D4;
                color: white;
                border: none;
                border-radius: 0.375rem;
                padding: 0.5rem;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
            }

            .filter-dropdown-apply:hover {
                background-color: #007bb3;
            }

            /* No products message */
            .no-products {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 2rem 1rem;
                color: #6b7280;
                min-height: 300px;
            }

            .no-products-title {
                font-size: 1.125rem;
                font-weight: 600;
                margin-bottom: 0.75rem;
                color: #374151;
            }

            .no-products-text {
                font-size: 0.875rem;
                max-width: 400px;
                margin: 0 auto 1.5rem;
                line-height: 1.5;
            }

            .no-products-button {
                background-color: #0097D4;
                color: white;
                border: none;
                border-radius: 0.5rem;
                padding: 0.75rem 1.25rem;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
            }

            .no-products-button:hover {
                background-color: #007bb3;
            }

            /* Pagination mobile */
            .pagination-mobile {
                padding: 1rem 0;
                overflow-x: auto;
            }

            .pagination-mobile .pagination-btn {
                font-size: 0.875rem;
                padding: 0.5rem 0.75rem;
                margin: 0 0.125rem;
                min-width: 2.5rem;
                text-align: center;
            }

            /* Grid mobile improvements */
            .grid-mobile {
                gap: 0.75rem;
            }
        }

        /* Tablet responsive */
        @media (min-width: 641px) and (max-width: 1024px) {
            .hero-section-tablet h2 {
                font-size: 1.125rem;
            }

            .container-tablet {
                padding: 0 1.5rem;
            }

            .product-card img {
                height: 180px;
            }

            /* No products message for tablet */
            .no-products {
                padding: 3rem 1rem;
                min-height: 350px;
            }

            .no-products-title {
                font-size: 1.375rem;
            }

            .no-products-text {
                font-size: 1rem;
                max-width: 500px;
            }

            .no-products-button {
                font-size: 1rem;
                padding: 0.75rem 1.5rem;
            }
        }

        /* Desktop responsive */
        @media (min-width: 1025px) {

            /* No products message for desktop */
            .no-products {
                padding: 4rem 1rem;
                min-height: 400px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            .no-products-title {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
                color: #374151;
            }

            .no-products-text {
                font-size: 1.125rem;
                max-width: 600px;
                margin: 0 auto 2rem;
                line-height: 1.5;
            }

            .no-products-button {
                background-color: #0097D4;
                color: white;
                border: none;
                border-radius: 0.5rem;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s;
            }

            .no-products-button:hover {
                background-color: #007bb3;
            }
        }

        /* Very small mobile (iPhone SE, etc) */
        @media (max-width: 375px) {
            .hero-text-mobile h2 {
                font-size: 0.8125rem !important;
                padding: 0 0.5rem;
            }

            .product-card img {
                height: 120px;
            }

            .product-card-content {
                padding: 0.75rem;
            }

            .product-card-content h3 {
                font-size: 0.8125rem;
                height: 2.6em;
            }

            .product-card-content p {
                font-size: 0.6875rem;
            }

            .container-mobile {
                padding: 0 0.5rem;
            }

            /* No products message for very small mobile */
            .no-products {
                padding: 1.5rem 1rem;
                min-height: 250px;
            }

            .no-products-title {
                font-size: 1rem;
            }

            .no-products-text {
                font-size: 0.8125rem;
                margin-bottom: 1rem;
            }

            .no-products-button {
                font-size: 0.8125rem;
                padding: 0.5rem 1rem;
            }
        }

        /* Loading overlay for smooth transition */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #0097D4;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Focus states untuk accessibility */
        input:focus,
        button:focus {
            outline: 2px solid #0097D4;
            outline-offset: 2px;
        }

        /* Touch targets untuk mobile */
        @media (max-width: 640px) {

            button,
            a,
            input[type="checkbox"] {
                min-height: 44px;
                min-width: 44px;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-white">
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>
    @include('navbar')

    <section class="relative text-white overflow-hidden min-h-[550px] sm:min-h-[450px] md:min-h-[550px] flex flex-col items-center pt-32 sm:pt-24 md:pt-32 hero-section-mobile hero-section-tablet"
        style="background-image: url('{{ asset('images/background_beranda_INNDESA.jpeg') }}'); background-size: cover; background-position: center; font-family: 'Poppins', sans-serif;">
        <div class="text-center text-[#0097D4] leading-snug space-y-2 sm:space-y-3 hero-text-mobile max-w-6xl px-4">
            <h2 class="text-sm sm:text-lg md:text-2xl lg:text-3xl font-bold">
                Ditengah alam yang melimpah, hanya tangan-tangan
            </h2>
            <h2 class="text-sm sm:text-lg md:text-2xl lg:text-3xl font-bold">
                terampil yang mampu mengolahnya jadi berkah.
            </h2>
            <h2 class="text-sm sm:text-lg md:text-2xl lg:text-3xl font-bold">
                karena setiap hasil tani dan perikanan punya keunikan
            </h2>
            <h2 class="text-sm sm:text-lg md:text-2xl lg:text-3xl font-bold">
                yang layak dibanggakan.
            </h2>
        </div>
        <form action="{{ route('produk.index') }}" method="GET" class="mt-6 w-full max-w-lg px-4">
            <div class="flex items-center space-x-2 sm:space-x-3 search-form-mobile">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari Produk ...."
                    class="flex-1 px-3 py-2 text-sm sm:px-4 sm:py-3 sm:text-base rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-[#0097D4] text-gray-700 w-full"
                    value="{{ request('search') }}" />
                <button
                    type="submit"
                    class="bg-[#0097D4] hover:bg-[#007bb3] text-white px-4 py-2 text-sm sm:px-6 sm:py-3 sm:text-base rounded-lg shadow-md font-semibold transition whitespace-nowrap">
                    Cari
                </button>
            </div>
        </form>
    </section>

    <div class="max-w-7xl mx-auto mt-6 sm:mt-8 px-3 sm:px-6 grid grid-cols-12 gap-4 sm:gap-6 container-mobile container-tablet">
        <!-- KATEGORI -->
        <div class="col-span-12 md:col-span-3">
            <form id="kategoriForm" action="{{ route('produk.index') }}" method="GET">
                <!-- Tombol filter dan reset untuk mobile -->
                <div class="md:hidden mobile-filter-container">
                    <button type="button" id="filterButton" class="filter-button">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('produk.index') }}" class="reset-button">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </a>
                </div>

                <!-- Dropdown filter untuk mobile -->
                <div class="md:hidden filter-dropdown">
                    <div class="filter-dropdown-content" id="filterDropdownContent">
                        <div class="filter-dropdown-header">
                            Kelompok
                        </div>
                        <div class="filter-dropdown-body">
                            @foreach (App\Models\Kelompok::all() as $kelompok)
                            <label class="filter-dropdown-item">
                                <input type="checkbox" name="kategori_mobile" value="{{ $kelompok->nama }}"
                                    class="kategori-mobile text-[#0097D4] rounded focus:ring-[#0097D4]"
                                    {{ request('kategori') === $kelompok->nama ? 'checked' : '' }}>
                                <span>{{ $kelompok->nama }}</span>
                            </label>
                            @endforeach
                        </div>
                        <div class="filter-dropdown-footer">
                            <button type="button" id="applyFilterDropdown" class="filter-dropdown-apply">
                                Terapkan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Box filter untuk desktop -->
                <div id="filterBox"
                    class="p-5 rounded-lg shadow-md border hidden md:block bg-white">
                    <h2 class="text-xl font-semibold mb-4">Kelompok</h2>
                    <div class="space-y-3 text-gray-700">
                        @foreach (App\Models\Kelompok::all() as $kelompok)
                        <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                            <input type="checkbox" name="kategori" value="{{ $kelompok->nama }}"
                                class="w-4 h-4 kategori text-[#0097D4] rounded focus:ring-[#0097D4] focus:ring-offset-0"
                                {{ request('kategori') === $kelompok->nama ? 'checked' : '' }}>
                            <span class="text-sm sm:text-base">{{ $kelompok->nama }}</span>
                        </label>
                        @endforeach
                    </div>

                    <!-- Tombol di desktop -->
                    <div class="hidden md:flex flex-col space-y-3 mt-6">
                        <button type="submit"
                            class="w-full bg-[#0097D4] text-white py-3 rounded-lg font-medium hover:bg-[#007bb3] transition-all">
                            Terapkan
                        </button>
                        <button type="button" id="resetBtn"
                            class="w-full bg-gray-300 text-gray-600 py-3 rounded-lg font-medium hover:bg-gray-400 transition-all">
                            Reset
                        </button>
                    </div>

                    <!-- Tombol di mobile (fallback jika modal tidak bekerja) -->
                    <div class="flex md:hidden justify-between space-x-2 mt-6">
                        <button type="submit"
                            class="flex-1 bg-[#0097D4] text-white py-3 rounded-md text-sm hover:bg-[#007bb3] transition-all">
                            Terapkan
                        </button>
                        <button type="button" id="resetBtnMobile"
                            class="flex-1 bg-gray-300 text-gray-600 py-3 rounded-md text-sm hover:bg-gray-400 transition-all">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- card produk -->
        <div class="col-span-12 md:col-span-9">
            @if($produk->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-6 grid-mobile">
                @foreach ($produk as $item)
                <a href="{{ route('detail_produk.show', $item->id_produk) }}" class="block no-underline group">
                    <div class="product-card hover:shadow-lg transition-all duration-300 border">
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full object-cover">
                        <div class="p-3 sm:p-4 product-card-content">
                            <h3 class="font-semibold text-sm sm:text-base text-gray-800 mb-2">
                                {{ $item->nama }}
                            </h3>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-green-600 font-bold text-sm sm:text-base">
                                    Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                </p>
                                <p class="text-gray-500 text-xs sm:text-sm">
                                    Stok: {{ $item->stok }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="no-products">
                <h3 class="no-products-title">Produk tidak tersedia</h3>
                <p class="no-products-text">
                    @if(request('kategori'))
                    Produk pada kelompok "{{ request('kategori') }}" tidak tersedia saat ini.
                    @else
                    Tidak ada produk yang sesuai dengan pencarian Anda.
                    @endif
                </p>
                <button onclick="window.location.href='{{ route('produk.index') }}'" class="no-products-button">
                    Lihat Semua Produk
                </button>
            </div>
            @endif

            @if ($produk->hasPages())
            <div class="mt-6 flex justify-center pagination-mobile">
                <div class="flex items-center space-x-1 sm:space-x-2 overflow-x-auto pb-2">

                    @if ($produk->onFirstPage())
                    <span class="pagination-btn disabled">←</span>
                    @else
                    <a href="{{ $produk->previousPageUrl() }}" class="pagination-btn btn-outline">←</a>
                    @endif

                    <div class="flex space-x-1">
                        @php
                        $start = max(1, $produk->currentPage() - 1);
                        $end = min($produk->lastPage(), $produk->currentPage() + 1);

                        // Ellipsis awal jika start > 2
                        if ($start > 2) {
                        echo '<span class="px-2 text-gray-500 text-sm">...</span>';
                        }
                        @endphp

                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page==$produk->currentPage())
                            <span class="pagination-btn active">{{ $page }}</span>
                            @else
                            <a href="{{ $produk->url($page) }}" class="pagination-btn">{{ $page }}</a>
                            @endif
                            @endfor

                            @php
                            // Ellipsis akhir jika end < lastPage - 1
                                if ($end < $produk->lastPage() - 1) {
                                echo '<span class="px-2 text-gray-500 text-sm">...</span>';
                                }
                                @endphp
                    </div>

                    @if ($produk->hasMorePages())
                    <a href="{{ $produk->nextPageUrl() }}" class="pagination-btn btn-outline">→</a>
                    @else
                    <span class="pagination-btn disabled">→</span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="mt-12 sm:mt-20">
        @include('footer')
    </div>

    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        // JS PRELOADER
        window.addEventListener("load", function() {
            let preloader = document.getElementById("preloader");
            // Add fade-out animation
            preloader.classList.add("fade-out");

            // After animation completes, hide preloader and show content
            setTimeout(function() {
                preloader.style.display = "none";
                document.body.classList.add("loaded");
            }, 500); // Match transition duration (0.5s)
        });

        const kategoriCheckboxes = document.querySelectorAll(".kategori");
        const kategoriMobileCheckboxes = document.querySelectorAll(".kategori-mobile");
        const kategoriForm = document.getElementById("kategoriForm");
        const loadingOverlay = document.getElementById("loadingOverlay");
        const preloader = document.getElementById("preloader");

        // Mobile filter elements
        const filterButton = document.getElementById("filterButton");
        const filterDropdownContent = document.getElementById("filterDropdownContent");
        const applyFilterDropdown = document.getElementById("applyFilterDropdown");

        // Handle checkbox exclusivity (only one checkbox can be checked at a time)
        function handleCheckboxExclusivity(checkboxes) {
            checkboxes.forEach(cb => {
                cb.addEventListener("change", (e) => {
                    if (e.target.checked) {
                        checkboxes.forEach(other => {
                            if (other !== e.target) {
                                other.checked = false;
                            }
                        });
                    }
                });
            });
        }

        // Apply exclusivity to both desktop and mobile checkboxes
        handleCheckboxExclusivity(kategoriCheckboxes);
        handleCheckboxExclusivity(kategoriMobileCheckboxes);

        // Sync mobile and desktop checkboxes
        function syncCheckboxes(fromCheckboxes, toCheckboxes) {
            fromCheckboxes.forEach((cb, index) => {
                cb.addEventListener("change", (e) => {
                    if (toCheckboxes[index]) {
                        toCheckboxes[index].checked = e.target.checked;
                    }
                });
            });
        }

        syncCheckboxes(kategoriCheckboxes, kategoriMobileCheckboxes);
        syncCheckboxes(kategoriMobileCheckboxes, kategoriCheckboxes);

        function showPreloader() {
            preloader.style.display = "flex";
            preloader.classList.remove("fade-out");
        }

        function hidePreloader() {
            setTimeout(() => {
                preloader.classList.add("fade-out");
                setTimeout(() => {
                    preloader.style.display = "none";
                }, 500);
            }, 500);
        }

        kategoriForm.addEventListener("submit", (e) => {
            showPreloader();
        });

        // Desktop reset button
        document.getElementById("resetBtn")?.addEventListener("click", () => {
            kategoriCheckboxes.forEach(cb => cb.checked = false);
            kategoriMobileCheckboxes.forEach(cb => cb.checked = false);
            showPreloader();
            kategoriForm.submit();
        });

        // Mobile filter button functionality
        filterButton?.addEventListener('click', function(e) {
            e.stopPropagation();
            filterDropdownContent.classList.toggle('show');
        });

        // Apply filter from mobile dropdown
        applyFilterDropdown?.addEventListener('click', function() {
            filterDropdownContent.classList.remove('show');
            showPreloader();
            kategoriForm.submit();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!filterButton?.contains(e.target) && !filterDropdownContent?.contains(e.target)) {
                filterDropdownContent?.classList.remove('show');
            }
        });

        // Legacy mobile reset button (fallback)
        document.getElementById("resetBtnMobile")?.addEventListener('click', function() {
            kategoriCheckboxes.forEach(cb => cb.checked = false);
            kategoriMobileCheckboxes.forEach(cb => cb.checked = false);
        });

        // Prevent zoom on double tap for better mobile UX
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(event) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);

        // Hide loading overlay after page load
        window.addEventListener('load', function() {
            hidePreloader();
        });
    </script>
</body>

</html>