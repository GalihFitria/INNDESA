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

        /* Hide scrollbar for horizontal scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* Card Carousel Styles */
        .card-carousel {
            position: relative;
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
            overflow: hidden;
        }

        .card-slider {
            display: flex;
            transition: transform 0.3s ease-out;
            will-change: transform;
            touch-action: pan-y;
        }

        .card-slide {
            min-width: 100%;
            flex-shrink: 0;
            padding: 0 0.25rem;
        }

        .carousel-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
            padding: 1rem;
            text-align: center;
            aspect-ratio: 1 / 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            user-select: none;
            cursor: grab;
            position: relative;
            overflow: hidden;
            height: 160px;
            width: 160px;
            margin: 0 auto;
        }

        .carousel-card:active {
            cursor: grabbing;
        }

        .carousel-card h3 {
            font-size: 0.7rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .carousel-card .number {
            font-size: 1.75rem;
            font-weight: 800;
            color: #10b981;
            line-height: 1;
        }

        /* Pagination dots */
        .carousel-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .carousel-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #d1d5db;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: #10b981;
            transform: scale(1.2);
        }

        /* Touch/drag interaction improvements */
        .card-slider.dragging {
            transition: none;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .hero-title {
                font-size: 3rem !important;
                -webkit-text-stroke: 0.5px #ffffff;
            }

            .hero-subtitle {
                font-size: 1.25rem !important;
                -webkit-text-stroke: 0.3px #ffffff;
            }

            .hero-section {
                min-height: 400px !important;
            }

            .card-carousel {
                max-width: 180px;
            }

            .carousel-card {
                padding: 0.75rem;
                height: 140px;
                width: 140px;
            }

            .carousel-card h3 {
                font-size: 0.65rem;
                margin-bottom: 0.5rem;
            }

            .carousel-card .number {
                font-size: 1.5rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            .pagination-btn {
                padding: 0.4rem 0.6rem;
                font-size: 0.875rem;
            }
        }

        /* Responsive adjustments for Update Kegiatan (mirip halaman kelompok) */
        @media (max-width: 768px) {
            .update-kegiatan-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem;
                width: 100%;
                display: grid;
            }

            .update-kegiatan-card {
                min-height: 280px !important;
                width: 100% !important;
                display: flex;
                flex-direction: column;
            }

            .update-kegiatan-card .kegiatan-image {
                height: 140px !important;
            }

            .update-kegiatan-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .update-kegiatan-card .p-4 {
                padding: 0.5rem !important;
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .update-kegiatan-card h3 {
                font-size: 0.75rem !important;
                line-height: 1.2;
                margin-bottom: 0.5rem;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .update-kegiatan-card .text-xs {
                font-size: 0.625rem !important;
            }

            .update-kegiatan-card .text-sm {
                font-size: 0.45rem !important;
            }
        }

        @media (max-width: 480px) {

            /* Extra small screens for Update Kegiatan */
            .update-kegiatan-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.6rem;
                /* jarak antar card sedikit lega */
            }

            .update-kegiatan-card {
                min-height: 200px !important;
                /* lebih pendek */
                max-width: 180px !important;
                /* agak lebih lebar */
                margin: 0 auto;
                /* ketengah */
            }

            .update-kegiatan-card .kegiatan-image {
                height: 90px !important;
                /* gambar lebih rendah */
            }

            /* Judul */
            .update-kegiatan-card h3 {
                font-size: 1.2rem !important;
                /* 19px */
                line-height: 1rem !important;
                /* 25px */
            }

            /* Tanggal */
            .update-kegiatan-card .text-xs {
                font-size: 0.7rem !important;
                /* 11px */
            }

            /* "Baca selengkapnya" */
            .update-kegiatan-card .text-sm {
                font-size: 0.75rem !important;
                /* lebih kecil lagi */
            }
        }
    </style>
</head>

<body class="min-h-screen bg-white font-['Poppins']">

    @include('navbar')
    
<section class="relative text-white text-center overflow-hidden min-h-[300px] sm:min-h-[400px] md:min-h-[550px] flex flex-col items-start justify-start pt-20 sm:pt-28 md:pt-32 hero-section"
    style="background-image: url('{{ asset('images/background_beranda_INNDESA.jpeg') }}'); background-size: cover; background-position: center;">
    
    <div class="relative z-10 w-full max-w-6xl mx-auto px-3 sm:px-5 py-6 sm:py-12 md:py-16 
        md:-translate-y-12 lg:-translate-y-16">
        
        <!-- Judul -->
        <div class="relative inline-block mb-2 sm:mb-4 w-full">
            <span class="absolute inset-0 text-3xl sm:text-6xl md:text-9xl font-extrabold text-white select-none pointer-events-none"
                style="z-index:-1; -webkit-text-stroke: 1px white;">
                INNDESA
            </span>
            <span class="block text-3xl sm:text-6xl md:text-9xl font-extrabold bg-gradient-to-b from-blue-300 to-blue-900 text-transparent bg-clip-text leading-tight break-words">
                INNDESA
            </span>
        </div>

        <!-- Subjudul -->
        <h2 class="text-base sm:text-2xl md:text-5xl font-bold mb-2 sm:mb-3 leading-snug" style="color:#0097D4;">
            Inovasi Nusantara Desa Integratif Pangan
        </h2>

        <!-- Deskripsi -->
        <p class="text-sm sm:text-xl md:text-3xl font-bold mb-2 sm:mb-6 leading-snug" style="color:#FFA500; -webkit-text-stroke: 0.3px white;">
            PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala
        </p>
    </div>
</section>


    <!-- CARD STATIK -->
    <section class="relative -mt-16 sm:-mt-20 z-10 pb-8 sm:pb-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-5">
            <div class="flex flex-col items-center gap-4 sm:gap-5">
                <!-- Desktop Version - 3 cards first row, 2 cards second row -->
                <div class="hidden sm:flex sm:grid sm:grid-cols-3 sm:overflow-visible gap-3 sm:gap-4 w-full max-w-3xl">
                    <div class="card border border-gray-200 rounded-xl shadow-lg p-4 sm:p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-2 sm:mb-3 text-base sm:text-lg">Total Kelompok</h3>
                        <p class="text-emerald-500 font-extrabold text-3xl sm:text-4xl" id="totalKelompok">{{ $totalKelompok }}</p>
                    </div>
                    <div class="card border border-gray-200 rounded-xl shadow-lg p-4 sm:p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-2 sm:mb-3 text-base sm:text-lg">Total Anggota Kelompok</h3>
                        <p class="text-emerald-500 font-extrabold text-3xl sm:text-4xl" id="totalAnggota">{{ $totalAnggota }}</p>
                    </div>
                    <div class="card border border-gray-200 rounded-xl shadow-lg p-4 sm:p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-2 sm:mb-3 text-base sm:text-lg">Total Produk</h3>
                        <p class="text-emerald-500 font-extrabold text-3xl sm:text-4xl" id="totslProduk">{{ $totalProduk }}</p>
                    </div>
                </div>

                <div class="hidden sm:flex sm:grid sm:grid-cols-2 sm:overflow-visible gap-3 sm:gap-4 w-full max-w-xl">
                    <div class="card border border-gray-200 rounded-xl shadow-lg p-4 sm:p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-2 sm:mb-3 text-base sm:text-lg">Total Kelompok Rentan</h3>
                        <p class="text-emerald-500 font-extrabold text-3xl sm:text-4xl" id="totalKelompokRentan">{{ $totalKelompokRentan }}</p>
                    </div>
                    <div class="card border border-gray-200 rounded-xl shadow-lg p-4 sm:p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-2 sm:mb-3 text-base sm:text-lg">Total Views</h3>
                        <p id="viewCount" class="text-emerald-500 font-extrabold text-3xl sm:text-4xl">0</p>
                    </div>
                </div>

                <!-- Mobile Version - Card Carousel -->
                <div class="sm:hidden w-full">
                    <div class="card-carousel">
                        <div class="card-slider" id="cardSlider">
                            <div class="card-slide">
                                <div class="carousel-card">
                                    <h3>Total Kelompok</h3>
                                    <div class="number" id="totalKelompokMobile">{{ $totalKelompok }}</div>
                                </div>
                            </div>
                            <div class="card-slide">
                                <div class="carousel-card">
                                    <h3>Total Anggota Kelompok</h3>
                                    <div class="number" id="totalAnggotaMobile">{{ $totalAnggota }}</div>
                                </div>
                            </div>
                            <div class="card-slide">
                                <div class="carousel-card">
                                    <h3>Total Produk</h3>
                                    <div class="number" id="totslProdukMobile">{{ $totalProduk }}</div>
                                </div>
                            </div>
                            <div class="card-slide">
                                <div class="carousel-card">
                                    <h3>Total Kelompok Rentan</h3>
                                    <div class="number" id="totalKelompokRentanMobile">{{ $totalKelompokRentan }}</div>
                                </div>
                            </div>
                            <div class="card-slide">
                                <div class="carousel-card">
                                    <h3>Total Views</h3>
                                    <div class="number" id="viewCountMobile">0</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Dots -->
                    <div class="carousel-pagination">
                        <div class="carousel-dot active" data-slide="0"></div>
                        <div class="carousel-dot" data-slide="1"></div>
                        <div class="carousel-dot" data-slide="2"></div>
                        <div class="carousel-dot" data-slide="3"></div>
                        <div class="carousel-dot" data-slide="4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GAMBARAN UMUM -->
    <section class="py-2 sm:py-12 md:py-6 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12 md:mb-16">
                <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-4 sm:mb-6 md:mb-8">Gambaran Umum Program</h2>
                <h3 class="text-base sm:text-lg md:text-xl font-semibold text-gray-800 mb-3 sm:mb-4">Inovasi Nusantara Desa Integratif Pangan</h3>
                <div class="max-w-4xl mx-auto text-gray-700 leading-relaxed space-y-4 text-xs sm:text-sm md:text-base lg:text-lg">
                    <p>
                        INNDESA adalah program pemberdayaan berbasis inovasi sosial yang mengintegrasikan tiga sektor utama yaitu
                        produksi pangan untuk pertanian, peternakan, dan perikanan dengan pendekatan zero waste dan ekonomi
                        sirkular, serta mendorong partisipasi aktif generasi muda dalam membangun ekosistem pangan desa yang
                        berkelanjutan. Program ini bertujuan untuk menciptakan desa yang mandiri pangan dan ekonomi yang
                        terintegrasi dengan proses bisnis PLN dengan penggunaan teknologi ramah lingkungan non 3R (TARA) untuk
                        infrastruktur dan proses pembinaan.
                    </p>
                </div>
            </div>

            <!-- TUJUAN PROGRAM -->
            <div class="text-center mb-8 sm:mb-12 md:mb-16">
                <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-4 sm:mb-6 md:mb-8">Tujuan Program</h2>
                <div class="max-w-4xl mx-auto text-gray-700 leading-relaxed space-y-4 text-xs sm:text-sm md:text-base lg:text-lg">
                    <p>
                        INNDESA adalah program pemberdayaan berbasis inovasi sosial yang mengintegrasikan tiga sektor utama
                        produksi pangan yaitu pertanian, peternakan, dan perikanan dengan pendekatan zero waste dan ekonomi
                        sirkular, serta mendorong partisipasi aktif generasi muda dalam membangun ekosistem pangan desa yang
                        berkelanjutan, berkualitas, dan berdaya saing serta terintegrasi dengan proses bisnis PLN dengan
                        penggunaan teknologi ramah lingkungan non 3R (TARA) untuk infrastruktur dan proses pembinaan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- MASALAH PROGRAM -->
    <section class="py-2 sm:py-12 md:py-10">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-lg sm:text-3xl md:text-4xl font-bold text-blue-600 mb-3 sm:mb-6 md:mb-8">
                    Masalah Program
                </h2>
            </div>
            <div class="max-w-4xl mx-auto">
                <!-- grid 2 card -->
                <div class="grid grid-cols-2 md:grid-cols-2 gap-3 sm:gap-6 mb-3 sm:mb-6">
                    <div class="card aspect-square md:aspect-auto p-3 sm:p-6 bg-yellow-400 text-black flex flex-col justify-center">
                        <h3 class="text-xs sm:text-lg font-bold mb-2 sm:mb-6 text-center">Ekonomi</h3>
                        <div class="space-y-1 sm:space-y-4 text-[10px] sm:text-sm leading-relaxed text-center">
                            <p>
                                Produksi pangan lokal tidak mampu memenuhi kebutuhan konsumsi masyarakat, sehingga terpaksa defisit
                                pangan dan ketergantungan pangan dari luar daerah.
                            </p>
                        </div>
                    </div>

                    <div class="card aspect-square md:aspect-auto p-3 sm:p-6 bg-green-500 text-white flex flex-col justify-center">
                        <h3 class="text-xs sm:text-lg font-bold mb-2 sm:mb-6 text-center">Lingkungan</h3>
                        <div class="space-y-1 sm:space-y-4 text-[10px] sm:text-sm leading-relaxed text-center">
                            <p>
                                Akumulasi limbah produksi organik yang tidak bisa diolah secara alami berkesinambungan pada
                                perencanaan pangan dan menyebabkan kerusakan pada.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 1 card bawah -->
                <div class="flex justify-center">
                    <div class="w-1/2 md:w-1/2 md:max-w-md">
                        <div class="card aspect-square md:aspect-auto p-3 sm:p-6 bg-red-400 text-white flex flex-col justify-center">
                            <h3 class="text-xs sm:text-lg font-bold mb-2 sm:mb-6 text-center">Sosial</h3>
                            <div class="space-y-1 sm:space-y-4 text-[10px] sm:text-sm leading-relaxed text-justify">
                                <p>
                                    • Krisis regenerasi petani menjadi ancaman untuk keberlanjutan sistem pangan desa, dengan rendahnya
                                    minat generasi muda terhadap pertanian menyebabkan kesenjangan dalam pangan desa yang inklusif.
                                </p>
                                <p>
                                    • Meningkatnya teknologi dan kecakapan SDM pada sektor produksi pangan berkesinambungan pada
                                    berkesinambungan integrasi sektor pangan desa yang inklusif.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BAGAN INTEGRITAS -->
    <section class="py-12 sm:py-12 md:py-10 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 sm:mb-12">
                <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-4 sm:mb-6 md:mb-8">Bagan Integritas</h2>
            </div>

            <div class="flex justify-center">
                <img
                    src="{{ asset('images/bagan_integritas.png') }}"
                    class="max-w-full w-full sm:w-3/4 h-auto rounded-lg shadow-lg" />
            </div>
        </div>
    </section>

    <!-- UPDATE KEGIATAN -->
    <section class="py-6 sm:py-12 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 sm:mb-12">
                <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-4 sm:mb-6 md:mb-8">Update Kegiatan</h2>
            </div>
            <div class="update-kegiatan-grid grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                @foreach ($kegiatans as $kegiatan)
                <div class="update-kegiatan-card bg-blue-500 text-white border rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow min-h-[280px] md:min-h-[320px] h-full cursor-pointer flex flex-col">
                    <div class="kegiatan-image h-36 md:h-40">
                        <img
                            src="{{ asset('storage/' . $kegiatan->foto) }}"
                            alt="{{ $kegiatan->judul }}"
                            class="w-full h-full object-cover rounded-t-lg" />
                    </div>
                    <div class="p-3 md:p-4 flex flex-col justify-between flex-1">
                        <h3 class="font-bold text-base text-sm md:text-sm mb-2 leading-tight">
                            {{ $kegiatan->judul }}
                        </h3>
                        <div>
                            <p class="text-[10px] md:text-xs opacity-75 truncate">
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}
                            </p>
                            <a href="{{ route('update_kegiatan.show', $kegiatan->id_kegiatan) }}"
                                class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30 text-center block text-xs sm:text-sm">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Custom Pagination -->
            @if ($kegiatans->hasPages())
            <div class="mt-4 sm:mt-6 flex justify-center">
                <div class="flex items-center space-x-1 sm:space-x-2">
                    <!-- Prev Button -->
                    @if ($kegiatans->onFirstPage())
                    <span class="pagination-btn disabled">←</span>
                    @else
                    <a href="{{ $kegiatans->previousPageUrl() }}" class="pagination-btn">←</a>
                    @endif

                    <!-- Page Numbers with Ellipsis -->
                    <div class="flex space-x-1">
                        @php
                        $start = max(1, $kegiatans->currentPage() - 1);
                        $end = min($kegiatans->lastPage(), $kegiatans->currentPage() + 1);

                        if ($start > 2) {
                        echo '<span class="px-1 sm:px-2 text-gray-500 text-sm">...</span>';
                        }
                        @endphp

                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page==$kegiatans->currentPage())
                            <span class="pagination-btn active">{{ $page }}</span>
                            @else
                            <a href="{{ $kegiatans->url($page) }}" class="pagination-btn">{{ $page }}</a>
                            @endif
                            @endfor

                            @php
                            if ($end < $kegiatans->lastPage() - 1) {
                                echo '<span class="px-1 sm:px-2 text-gray-500 text-sm">...</span>';
                                }
                                @endphp
                    </div>

                    <!-- Next Button -->
                    @if ($kegiatans->hasMorePages())
                    <a href="{{ $kegiatans->nextPageUrl() }}" class="pagination-btn">→</a>
                    @else
                    <span class="pagination-btn disabled">→</span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- YOUTUBE -->
    <section class="py-12 sm:py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="relative aspect-video bg-gray-900 cursor-pointer group"
                    onclick="openModal('https://www.youtube.com/embed/A4Bc6Z7VyaU?autoplay=1')">
                    <img src="https://img.youtube.com/vi/A4Bc6Z7VyaU/maxresdefault.jpg"
                        alt="PROGRAM CSR PEMBERDAYAAN MASYARAKAT PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala"
                        class="w-full h-full object-cover">
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 transition">
                        <div
                            class="w-16 sm:w-20 h-16 sm:h-20 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition shadow-lg">
                            <svg class="w-6 sm:w-8 h-6 sm:h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                        <a href="https://youtu.be/A4Bc6Z7VyaU" target="_blank"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium flex items-center gap-2 justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M10 15l5.19-3.34L10 8.32V15zM19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
                            </svg>
                            Tonton di YouTube
                        </a>
                        <button id="shareBtn"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium flex items-center gap-2 justify-center">
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="videoModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
        <div class="relative w-full max-w-3xl aspect-video px-4">
            <iframe id="youtubeFrame" class="w-full h-full" src="" frameborder="0"
                allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
            <button onclick="closeModal()" class="absolute -top-8 sm:-top-10 right-0 text-white text-2xl sm:text-3xl">&times;</button>
        </div>
    </div>

    <!-- Modal Share -->
    <div id="shareModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-72 p-4">
            <h3 class="text-lg font-semibold mb-3">Bagikan ke</h3>
            <div class="flex flex-col gap-2">
                <button onclick="shareWhatsApp()"
                    class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded">
                    <!-- Icon WhatsApp -->
                    <svg class="w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12c0 2.11.55 4.09 1.5 5.79L2 22l4.29-1.42C8.91 21.45 10.89 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm5.46 14.52c-.24.67-1.38 1.3-1.91 1.39-.51.09-1.14.13-2.64-.41-3.56-1.15-5.88-5.02-6.05-5.21-.17-.19-1.45-1.85-1.45-3.53 0-1.68.91-2.5 1.23-2.84.32-.33.73-.42.97-.42.24 0 .49 0 .7 0 .22.01.49-.03.75.56.26.59.88 2.05.96 2.2.09.15.13.32.01.52-.12.21-.18.33-.37.51-.19.18-.4.39-.57.52-.18.13-.36.27-.16.53.2.26.88 1.46 1.89 2.36 1.3 1.2 2.39 1.6 2.68 1.78.29.18.46.15.63-.09.17-.24.73-.87.93-1.16.2-.29.42-.24.7-.14.28.1 1.76.83 2.07.98.31.15.52.23.6.36.08.13.08.74-.16 1.41z" />
                    </svg>
                    WhatsApp
                </button>

                <button onclick="shareFacebook()"
                    class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded">
                    <!-- Icon Facebook -->
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.89h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z" />
                    </svg>
                    Facebook
                </button>

                <button onclick="shareTwitter()"
                    class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded">
                    <!-- Icon Twitter -->
                    <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0022.4 1.6a9.06 9.06 0 01-2.88 1.1A4.52 4.52 0 0016.5.5c-2.5 0-4.52 2.03-4.52 4.53 0 .35.03.7.1 1.03-3.76-.18-7.1-1.99-9.32-4.73a4.45 4.45 0 00-.61 2.28c0 1.57.8 2.95 2 3.77A4.48 4.48 0 012 7.95v.05c0 2.18 1.54 4 3.6 4.44a4.52 4.52 0 01-2.05.08 4.53 4.53 0 004.22 3.14A9.05 9.05 0 010 19.54a12.8 12.8 0 006.95 2.03c8.33 0 12.88-6.9 12.88-12.88 0-.2 0-.41-.02-.61A9.2 9.2 0 0023 3z" />
                    </svg>
                    Twitter
                </button>

                <button onclick="copyLink()"
                    class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded">
                    <!-- Icon Copy -->
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M15 8a3 3 0 01-3 3H5a3 3 0 110-6h7a3 3 0 013 3zM19 16a3 3 0 01-3 3H5a3 3 0 110-6h11a3 3 0 013 3z" />
                    </svg>
                    Salin Link
                </button>
            </div>
            <button onclick="closeShareModal()" class="mt-3 w-full bg-gray-200 hover:bg-gray-300 py-2 rounded">
                Tutup
            </button>
        </div>
    </div>

    <div class="mt-16 sm:mt-20">
        @include('footer')
    </div>

</body>
<script>
    const shareBtn = document.getElementById('shareBtn');
    const shareModal = document.getElementById('shareModal');

    shareBtn.addEventListener('click', () => {
        shareModal.style.display = 'flex'; // tampilkan modal
    });

    function closeShareModal() {
        shareModal.style.display = 'none'; // sembunyikan modal
    }

    function copyLink() {
        navigator.clipboard.writeText(videoLink).then(() => {
            alert('Link berhasil disalin!');
        });
    }

    function shareWhatsApp() {
        window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(videoLink)}`, '_blank');
    }

    function shareFacebook() {
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(videoLink)}`, '_blank');
    }

    function shareTwitter() {
        window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(videoLink)}`, '_blank');
    }

    let views = localStorage.getItem("page_views") || 0;
    views = parseInt(views);
    views += 1;
    localStorage.setItem("page_views", views);

    const viewCountEl = document.getElementById("viewCount");
    const viewCountMobileEl = document.getElementById("viewCountMobile");
    if (viewCountEl) {
        viewCountEl.textContent = views;
    }
    if (viewCountMobileEl) {
        viewCountMobileEl.textContent = views;
    }

    function openModal(url) {
        document.getElementById('youtubeFrame').src = url;
        document.getElementById('videoModal').classList.remove('hidden');
        document.getElementById('videoModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('youtubeFrame').src = '';
        document.getElementById('videoModal').classList.add('hidden');
        document.getElementById('videoModal').classList.remove('flex');
    }

    function copyLink() {
        navigator.clipboard.writeText('https://youtu.be/A4Bc6Z7VyaU');
        alert('Link video berhasil disalin!');
    }

    async function updateStatistik() {
        try {
            const response = await fetch("/api/statistik");
            const data = await response.json();

            // Update desktop version
            document.getElementById("totalKelompok").textContent = data.totalKelompok;
            document.getElementById("totalAnggota").textContent = data.totalAnggota;
            document.getElementById("totalProduk").textContent = data.totalProduk;
            document.getElementById("totalKelompokRentan").textContent = data.totalKelompokRentan;

            // Update mobile version
            document.getElementById("totalKelompokMobile").textContent = data.totalKelompok;
            document.getElementById("totalAnggotaMobile").textContent = data.totalAnggota;
            document.getElementById("totslProdukMobile").textContent = data.totalProduk;
            document.getElementById("totalKelompokRentanMobile").textContent = data.totalKelompokRentan;
        } catch (error) {
            console.error("Gagal fetch statistik:", error);
        }
    }

    updateStatistik();
    setInterval(updateStatistik, 10000);

    // Card Carousel functionality
    class CardCarousel {
        constructor() {
            this.slider = document.getElementById('cardSlider');
            this.dots = document.querySelectorAll('.carousel-dot');
            this.currentSlide = 0;
            this.totalSlides = 5;
            this.startX = 0;
            this.currentX = 0;
            this.isDragging = false;
            this.threshold = 30; // minimum distance to trigger swipe

            this.init();
        }

        init() {
            if (!this.slider) return;

            // Prevent default drag behavior
            this.slider.addEventListener('dragstart', (e) => e.preventDefault());

            // Touch events for mobile
            this.slider.addEventListener('touchstart', this.handleStart.bind(this), {
                passive: false
            });
            this.slider.addEventListener('touchmove', this.handleMove.bind(this), {
                passive: false
            });
            this.slider.addEventListener('touchend', this.handleEnd.bind(this));

            // Mouse events for desktop testing
            this.slider.addEventListener('mousedown', this.handleStart.bind(this));
            this.slider.addEventListener('mousemove', this.handleMove.bind(this));
            this.slider.addEventListener('mouseup', this.handleEnd.bind(this));
            this.slider.addEventListener('mouseleave', this.handleEnd.bind(this));

            // Dot click events
            this.dots.forEach((dot, index) => {
                dot.addEventListener('click', () => this.goToSlide(index));
            });

            // Auto-play carousel
            this.startAutoPlay();
        }

        getEventX(e) {
            return e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
        }

        handleStart(e) {
            this.startX = this.getEventX(e);
            this.isDragging = true;
            this.slider.classList.add('dragging');
            this.stopAutoPlay();

            if (e.type === 'mousedown') {
                e.preventDefault();
            }
        }

        handleMove(e) {
            if (!this.isDragging) return;

            this.currentX = this.getEventX(e);

            if (e.type === 'touchmove') {
                e.preventDefault();
            }
        }

        handleEnd(e) {
            if (!this.isDragging) return;

            const diffX = this.startX - this.currentX;

            if (Math.abs(diffX) > this.threshold) {
                if (diffX > 0) {
                    this.nextSlide();
                } else {
                    this.prevSlide();
                }
            }

            this.isDragging = false;
            this.slider.classList.remove('dragging');
            this.startAutoPlay();
        }

        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            this.updateSlider();
        }

        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.updateSlider();
        }

        goToSlide(index) {
            this.currentSlide = index;
            this.updateSlider();
            this.stopAutoPlay();
            this.startAutoPlay();
        }

        updateSlider() {
            const translateX = -this.currentSlide * 100;
            this.slider.style.transform = `translateX(${translateX}%)`;

            // Update pagination dots
            this.dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === this.currentSlide);
            });
        }

        startAutoPlay() {
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, 4000);
        }

        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
            }
        }
    }

    // Initialize carousel when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        if (window.innerWidth <= 640) {
            const carousel = new CardCarousel();
        }
    });
</script>

</html>