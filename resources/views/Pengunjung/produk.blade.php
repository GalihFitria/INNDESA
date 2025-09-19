<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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

            /* Filter mobile - Full screen overlay */
            .filter-mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 50;
                display: flex;
                align-items: flex-end;
                justify-content: center;
            }

            .filter-mobile-content {
                background: white;
                width: 100%;
                max-height: 80vh;
                overflow-y: auto;
                border-radius: 1rem 1rem 0 0;
                padding: 1.5rem 1rem;
                transform: translateY(100%);
                transition: transform 0.3s ease-in-out;
            }

            .filter-mobile-overlay.show .filter-mobile-content {
                transform: translateY(0);
            }

            .filter-mobile-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid #e5e7eb;
            }

            .filter-mobile-header h2 {
                font-size: 1.25rem;
                font-weight: 600;
                color: #374151;
            }

            .close-filter-btn {
                background: none;
                border: none;
                font-size: 1.5rem;
                color: #6b7280;
                cursor: pointer;
                padding: 0.25rem;
                line-height: 1;
            }

            .close-filter-btn:hover {
                color: #374151;
            }

            /* Checkbox styling mobile */
            .checkbox-mobile {
                padding: 0.75rem;
                border-radius: 0.5rem;
                border: 1px solid #e5e7eb;
                margin-bottom: 0.5rem;
                transition: all 0.2s;
            }

            .checkbox-mobile:hover {
                background-color: #f9fafb;
                border-color: #0097D4;
            }

            .checkbox-mobile input[type="checkbox"] {
                margin-right: 0.75rem;
                transform: scale(1.2);
                accent-color: #0097D4;
            }

            .checkbox-mobile span {
                font-size: 0.9375rem;
                color: #374151;
            }

            /* Buttons mobile */
            .buttons-mobile {
                display: flex;
                gap: 0.75rem;
                margin-top: 1.5rem;
                padding-top: 1rem;
                border-top: 1px solid #e5e7eb;
            }

            .buttons-mobile button {
                flex: 1;
                padding: 0.875rem;
                border-radius: 0.5rem;
                font-weight: 600;
                font-size: 0.9375rem;
                transition: all 0.2s;
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
                <!-- Tombol filter muncul hanya di mobile -->
                <!-- Container untuk button filter dan reset di mobile -->
                <div class="md:hidden flex gap-2 mb-4">
                    <button type="button" id="filterToggle"
                        class="flex-1 bg-[#0097D4] text-white py-3 rounded-lg font-medium hover:bg-[#007bb3] flex items-center justify-center gap-2 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('produk.index') }}"
                        class="flex-shrink-0 bg-gray-500 text-white py-3 px-4 rounded-lg font-medium hover:bg-gray-600 flex items-center justify-center gap-2 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </a>
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

                <!-- Mobile Filter Overlay -->
                <div id="filterMobileOverlay" class="filter-mobile-overlay hidden">
                    <div class="filter-mobile-content">
                        <div class="filter-mobile-header">
                            <h2>Filter Kategori</h2>
                            <button type="button" id="closeFilterMobile" class="close-filter-btn">&times;</button>
                        </div>

                        <div class="space-y-2">
                            @foreach (App\Models\Kelompok::all() as $kelompok)
                            <label class="checkbox-mobile flex items-center cursor-pointer">
                                <input type="checkbox" name="kategori_mobile" value="{{ $kelompok->nama }}"
                                    class="kategori-mobile text-[#0097D4] rounded focus:ring-[#0097D4]"
                                    {{ request('kategori') === $kelompok->nama ? 'checked' : '' }}>
                                <span>{{ $kelompok->nama }}</span>
                            </label>
                            @endforeach
                        </div>

                        <div class="buttons-mobile">
                            <!-- <button type="button" id="resetBtnMobileOverlay"
                                class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                                Reset
                            </button> -->
                            <button type="button" id="applyFilterMobile"
                                class="bg-[#0097D4] text-white hover:bg-[#007bb3]">
                                Terapkan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- card produk -->
        <div class="col-span-12 md:col-span-9 grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-6 grid-mobile">
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

        @if ($produk->hasPages())
        <div class="mt-6 col-span-12 flex justify-center pagination-mobile">
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

    <div class="mt-12 sm:mt-20">
        @include('footer')
    </div>

    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        const kategoriCheckboxes = document.querySelectorAll(".kategori");
        const kategoriMobileCheckboxes = document.querySelectorAll(".kategori-mobile");
        const kategoriForm = document.getElementById("kategoriForm");
        const loadingOverlay = document.getElementById("loadingOverlay");
        const filterToggle = document.getElementById("filterToggle");
        const filterMobileOverlay = document.getElementById("filterMobileOverlay");
        const closeFilterMobile = document.getElementById("closeFilterMobile");
        const applyFilterMobile = document.getElementById("applyFilterMobile");

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

        function showLoading() {
            loadingOverlay.classList.add("active");
        }

        function hideLoading() {
            setTimeout(() => {
                loadingOverlay.classList.remove("active");
            }, 500);
        }

        kategoriForm.addEventListener("submit", (e) => {
            showLoading();
        });

        // Desktop reset button
        document.getElementById("resetBtn")?.addEventListener("click", () => {
            kategoriCheckboxes.forEach(cb => cb.checked = false);
            kategoriMobileCheckboxes.forEach(cb => cb.checked = false);
            showLoading();
            kategoriForm.submit();
        });

        // Mobile filter toggle
        filterToggle?.addEventListener('click', function() {
            // For mobile screens, show overlay
            if (window.innerWidth < 768) {
                filterMobileOverlay.classList.remove('hidden');
                filterMobileOverlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                // For larger screens, toggle the filter box
                let filterBox = document.getElementById('filterBox');
                filterBox.classList.toggle('hidden');
            }
        });

        // Close mobile filter
        closeFilterMobile?.addEventListener('click', function() {
            filterMobileOverlay.classList.remove('show');
            setTimeout(() => {
                filterMobileOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        });

        // Close mobile filter when clicking overlay
        filterMobileOverlay?.addEventListener('click', function(e) {
            if (e.target === filterMobileOverlay) {
                closeFilterMobile.click();
            }
        });

        // Apply mobile filter
        applyFilterMobile?.addEventListener('click', function() {
            showLoading();
            kategoriForm.submit();
        });

        // Reset mobile filter
        document.getElementById("resetBtnMobileOverlay")?.addEventListener('click', function() {
            kategoriCheckboxes.forEach(cb => cb.checked = false);
            kategoriMobileCheckboxes.forEach(cb => cb.checked = false);
        });

        // Legacy mobile reset button (fallback)
        document.getElementById("resetBtnMobile")?.addEventListener('click', function() {
            kategoriCheckboxes.forEach(cb => cb.checked = false);
            kategoriMobileCheckboxes.forEach(cb => cb.checked = false);
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768 && !filterMobileOverlay.classList.contains('hidden')) {
                closeFilterMobile.click();
            }
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
            hideLoading();
        });
    </script>
</body>

</html>