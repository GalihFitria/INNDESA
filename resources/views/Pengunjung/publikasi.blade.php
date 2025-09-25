<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Publikasi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="INNDESA - Publikasi">
    <meta property="og:description" content="Bagikan informasi tentang produk dan inovasi dari INNDESA!">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="INNDESA - Publikasi">
    <meta name="twitter:description" content="Bagikan informasi tentang produk dan inovasi dari INNDESA!">
    <meta name="twitter:image" content="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* CSS styles tetap sama seperti sebelumnya */
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

        body:not(.loaded) #content {
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
                height: 40vw;
                min-height: 180px;
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

        /* Animasi untuk update otomatis */
        .update-animation {
            animation: pulse 1.5s ease-in-out;
        }

        @keyframes pulse {
            0% {
                opacity: 0.7;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.7;
            }
        }

        /* Notifikasi update */
        .update-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #10b981;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: flex;
            align-items: center;
            transform: translateY(100px);
            transition: transform 0.3s ease-out;
        }

        .update-notification.show {
            transform: translateY(0);
        }

        .update-notification .close-btn {
            margin-left: 15px;
            cursor: pointer;
            font-weight: bold;
        }

        /* Loading spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        /* Animasi untuk card kegiatan baru */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .new-activity {
            animation: slideIn 0.5s ease-out;
            border: 2px solid #10b981;
        }
    </style>
</head>

<body class="min-h-screen bg-white font-['Poppins']">
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>

    <div id="content">
        @include('navbar')

        <!-- Hero Section - Diubah untuk Publikasi -->
        <div class="bg-gradient-to-b from-sky-400 to-sky-800 h-64 sm:h-80 md:h-96 flex items-center justify-center px-4 hero-section">
            <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white text-center">Publikasi</h1>
        </div>

        <!-- Share Card - Bagian Baru untuk Publikasi -->
        <section class="relative -mt-16 sm:-mt-20 z-10 pb-8 sm:pb-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-5">
                <div class="flex flex-col items-center gap-4 sm:gap-5">
                    <div class="bg-gray-200 p-4 sm:p-8 rounded-2xl shadow-2xl shadow-gray-500/50 w-full max-w-3xl">
                        <h2 class="text-lg sm:text-2xl font-medium mb-4 sm:mb-6 text-center">Bagikan laman ini</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                            <a href="#" id="facebookShare" target="_blank"
                                class="flex items-center bg-[#3b5998] hover:bg-[#334d84] text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md transition-colors"
                                aria-label="Bagikan ke Facebook">
                                <i class="fab fa-facebook-f text-sm sm:text-lg mr-2 sm:mr-3"></i>
                                <span class="text-sm sm:text-base">Share on Facebook</span>
                            </a>

                            <a href="#" id="twitterShare" target="_blank"
                                class="flex items-center bg-[#1DA1F2] hover:bg-[#0d8ddb] text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md transition-colors"
                                aria-label="Bagikan ke Twitter">
                                <i class="fab fa-twitter text-sm sm:text-lg mr-2 sm:mr-3"></i>
                                <span class="text-sm sm:text-base">Share on Twitter</span>
                            </a>

                            <a href="https://www.instagram.com/fijarrfqh_/" target="_blank"
                                class="flex items-center bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 hover:opacity-90 text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md transition-opacity"
                                aria-label="Kunjungi Instagram kami">
                                <i class="fab fa-instagram text-sm sm:text-lg mr-2 sm:mr-3"></i>
                                <span class="text-sm sm:text-base">Visit our Instagram</span>
                            </a>

                            <a href="https://api.whatsapp.com/send?phone=6289647038212&text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                                target="_blank" rel="noopener noreferrer"
                                class="flex items-center bg-[#25D366] hover:bg-[#1ebe57] text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md transition-colors"
                                aria-label="Hubungi via WhatsApp">
                                <i class="fab fa-whatsapp text-sm sm:text-lg mr-2 sm:mr-3"></i>
                                <span class="text-sm sm:text-base">Chat via WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- UPDATE KEGIATAN - Sama persis dengan Index -->
        <section id="update-kegiatan-section" class="py-6 sm:py-12 md:py-10" data-latest-id="{{ $kegiatans->first()->id_kegiatan ?? 0 }}">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-12">
                    <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-4 sm:mb-6 md:mb-8">Update Kegiatan</h2>
                </div>
                <div class="update-kegiatan-grid grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                    @foreach ($kegiatans as $kegiatan)
                    <div class="update-kegiatan-card bg-blue-500 text-white border rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow min-h-[280px] md:min-h-[320px] h-full cursor-pointer flex flex-col" data-id-kegiatan="{{ $kegiatan->id_kegiatan }}">
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

                @if ($kegiatans->hasPages())
                <div class="mt-4 sm:mt-6 flex justify-center">
                    <div class="flex items-center space-x-1 sm:space-x-2">
                        @if ($kegiatans->onFirstPage())
                        <span class="pagination-btn disabled">←</span>
                        @else
                        <a href="{{ $kegiatans->previousPageUrl() }}" class="pagination-btn" data-page-link>←</a>
                        @endif

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
                                <a href="{{ $kegiatans->url($page) }}" class="pagination-btn" data-page-link>{{ $page }}</a>
                                @endif
                                @endfor

                                @php
                                if ($end < $kegiatans->lastPage() - 1) {
                                    echo '<span class="px-1 sm:px-2 text-gray-500 text-sm">...</span>';
                                    }
                                    @endphp
                        </div>

                        @if ($kegiatans->hasMorePages())
                        <a href="{{ $kegiatans->nextPageUrl() }}" class="pagination-btn" data-page-link>→</a>
                        @else
                        <span class="pagination-btn disabled">→</span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- YOUTUBE - Sama persis dengan Index -->
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
                        <svg class="w-5 h-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12c0 2.11.55 4.09 1.5 5.79L2 22l4.29-1.42C8.91 21.45 10.89 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm5.46 14.52c-.24.67-1.38 1.3-1.91 1.39-.51.09-1.14.13-2.64-.41-3.56-1.15-5.88-5.02-6.05-5.21-.17-.19-1.45-1.85-1.45-3.53c0-1.68.91-2.5 1.23-2.84.32-.33.73-.42.97-.42.24 0 .49 0 .7 0.22.01.49.26.59.75.56.26.59.88 2.05.96 2.2.09.15.13.32.01.52-.12.21-.18.33-.37.51-.19.18-.4.39-.57.52-.18.13-.36.27-.16.53.2.26.88 1.46 1.89 2.36 1.3 1.2 2.39 1.6 2.68 1.78.29.18.46.15.63-.09.17-.24.73-.87.93-1.16.2-.29.42-.24.7-.14.28.1 1.76.83 2.07.98.31.15.52.23.6.36.08.13.08.74-.16 1.41z" />
                        </svg>
                        WhatsApp
                    </button>

                    <button onclick="shareFacebook()"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54v-2.89h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z" />
                        </svg>
                        Facebook
                    </button>

                    <button onclick="shareTwitter()"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53A4.48 4.48 0 0022.4 1.6a9.06 9.06 0 01-2.88 1.1A4.52 4.52 0 0016.5.5c-2.5 0-4.52 2.03-4.52 4.53 0 .35.03.7.1 1.03-3.76-.18-7.1-1.99-9.32-4.73a4.45 4.45 0 00-.61 2.28c0 1.57.8 2.95 2 3.77A4.48 4.48 0 012 7.95v.05c0 2.18 1.54 4 3.6 4.44a4.52 4.52 0 01-2.05.08 4.53 4.53 0 004.22 3.14A9.05 9.05 0 010 19.54a12.8 12.8 0 006.95 2.03c8.33 0 12.88-6.9 12.88-12.88 0-.2 0-.41-.02-.61A9.2 9.2 0 0023 3z" />
                        </svg>
                        Twitter
                    </button>

                    <button onclick="copyLink()"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded">
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
    </div>
</body>
<script>
    // JS PRELOADER
    window.addEventListener("load", function() {
        let preloader = document.getElementById("preloader");
        let content = document.getElementById("content");

        // Add fade-out animation
        preloader.classList.add("fade-out");

        // After animation completes, hide preloader and show content
        setTimeout(function() {
            preloader.style.display = "none";
            document.body.classList.add("loaded");
        }, 500); // Match transition duration (0.5s)
    });

    // Dynamic share links untuk halaman publikasi
    const currentUrl = encodeURIComponent(window.location.href);
    const shareText = encodeURIComponent("Check out this page from INNDESA!");

    // Update Facebook share link
    const facebookShare = document.getElementById("facebookShare");
    facebookShare.href = `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`;

    // Update Twitter share link
    const twitterShare = document.getElementById("twitterShare");
    twitterShare.href = `https://twitter.com/intent/tweet?url=${currentUrl}&text=${shareText}`;

    const shareBtn = document.getElementById('shareBtn');
    const shareModal = document.getElementById('shareModal');
    const videoLink = 'https://youtu.be/A4Bc6Z7VyaU';

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

    // Fungsi untuk menampilkan notifikasi update
    function showUpdateNotification() {
        const notification = document.getElementById('updateNotification');
        notification.classList.add('show');

        // Sembunyikan notifikasi setelah 5 detik
        setTimeout(() => {
            hideUpdateNotification();
        }, 5000);
    }

    function hideUpdateNotification() {
        const notification = document.getElementById('updateNotification');
        notification.classList.remove('show');
    }

    // Fungsi untuk memperbarui statistik
    async function updateStatistik() {
        try {
            const response = await fetch("/api/statistik");
            const data = await response.json();

            // Update desktop version dengan animasi
            animateValue("totalKelompok", data.totalKelompok);
            animateValue("totalAnggota", data.totalAnggota);
            animateValue("totalProduk", data.totalProduk);
            animateValue("totalKelompokRentan", data.totalKelompokRentan);

            // Update view count
            if (document.getElementById("viewCount")) {
                animateValue("viewCount", data.homePageViews);
            }
            if (document.getElementById("viewCountMobile")) {
                animateValue("viewCountMobile", data.homePageViews);
            }

            // Update mobile version
            animateValue("totalKelompokMobile", data.totalKelompok);
            animateValue("totalAnggotaMobile", data.totalAnggota);
            animateValue("totslProdukMobile", data.totalProduk);
            animateValue("totalKelompokRentanMobile", data.totalKelompokRentan);

            // Tampilkan notifikasi update
            showUpdateNotification();
        } catch (error) {
            console.error("Gagal fetch statistik:", error);
        }
    }

    // Fungsi untuk animasi perubahan nilai
    function animateValue(id, newValue) {
        const element = document.getElementById(id);
        if (!element) return;

        const oldValue = parseInt(element.textContent) || 0;
        const diff = newValue - oldValue;

        if (diff === 0) return;

        // Tambahkan kelas animasi
        element.classList.add('update-animation');

        // Animasi perubahan nilai
        const duration = 1000; // 1 detik
        const startTime = performance.now();

        function updateValue(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function untuk animasi yang lebih halus
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const currentValue = Math.floor(oldValue + diff * easeOutQuart);

            element.textContent = currentValue;

            if (progress < 1) {
                requestAnimationFrame(updateValue);
            } else {
                element.textContent = newValue;
                // Hapus kelas animasi setelah selesai
                setTimeout(() => {
                    element.classList.remove('update-animation');
                }, 500);
            }
        }

        requestAnimationFrame(updateValue);
    }

    // Fungsi untuk mengecek update kegiatan (tanpa backend API)
    function checkActivityUpdates() {
        const updateKegiatanSection = document.getElementById('update-kegiatan-section');
        if (!updateKegiatanSection) return;

        // Ambil ID kegiatan pertama sebagai penanda terbaru
        const firstCard = updateKegiatanSection.querySelector('.update-kegiatan-card');
        if (!firstCard) return;

        const currentLatestId = parseInt(firstCard.dataset.idKegiatan || '0');

        // Simpan ID terbaru di localStorage untuk perbandingan
        const storedLatestId = parseInt(localStorage.getItem('latestActivityId') || '0');

        // Jika ada perubahan (ID terbaru lebih besar dari yang tersimpan)
        if (currentLatestId > storedLatestId) {
            // Update localStorage
            localStorage.setItem('latestActivityId', currentLatestId);

            // Tampilkan notifikasi update
            showUpdateNotification();

            // Tambahkan animasi pada card terbaru
            firstCard.classList.add('new-activity');
        }
    }

    // Fungsi untuk memuat ulang bagian update kegiatan
    function refreshUpdateKegiatan() {
        const updateKegiatanSection = document.getElementById('update-kegiatan-section');
        const url = window.location.href; // URL saat ini

        // Tambahkan indikator loading
        const gridContainer = updateKegiatanSection.querySelector('.update-kegiatan-grid');
        if (gridContainer) {
            gridContainer.style.opacity = '0.5';
            gridContainer.style.position = 'relative';

            // Tambahkan loading spinner
            const loadingSpinner = document.createElement('div');
            loadingSpinner.className = 'absolute inset-0 flex items-center justify-center bg-white bg-opacity-70';
            loadingSpinner.innerHTML = '<div class="loading-spinner"></div>';
            gridContainer.appendChild(loadingSpinner);
        }

        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newUpdateKegiatan = doc.getElementById('update-kegiatan-section');

                if (newUpdateKegiatan) {
                    // Simpan ID kegiatan yang sudah ada
                    const existingIds = Array.from(
                        updateKegiatanSection.querySelectorAll('.update-kegiatan-card')
                    ).map(card => parseInt(card.dataset.idKegiatan));

                    // Ganti konten
                    updateKegiatanSection.innerHTML = newUpdateKegiatan.innerHTML;

                    // Tambahkan animasi untuk kegiatan baru
                    const newCards = updateKegiatanSection.querySelectorAll('.update-kegiatan-card');
                    newCards.forEach(card => {
                        const cardId = parseInt(card.dataset.idKegiatan);
                        if (!existingIds.includes(cardId)) {
                            card.classList.add('new-activity');
                        }
                    });

                    // Update latest_id dari section baru
                    updateKegiatanSection.dataset.latestId = newUpdateKegiatan.dataset.latestId || '0';

                    // Pasang kembali event listener untuk pagination
                    attachPaginationListeners();

                    // Update localStorage dengan ID terbaru
                    const newFirstCard = updateKegiatanSection.querySelector('.update-kegiatan-card');
                    if (newFirstCard) {
                        localStorage.setItem('latestActivityId', newFirstCard.dataset.idKegiatan);
                    }
                }

                // Hapus loading spinner
                if (gridContainer) {
                    gridContainer.style.opacity = '1';
                    const spinner = gridContainer.querySelector('.absolute.inset-0');
                    if (spinner) spinner.remove();
                }
            })
            .catch(error => {
                console.error('Error refreshing update kegiatan:', error);

                // Hapus loading spinner jika terjadi error
                if (gridContainer) {
                    gridContainer.style.opacity = '1';
                    const spinner = gridContainer.querySelector('.absolute.inset-0');
                    if (spinner) spinner.remove();
                }
            });
    }

    // Fungsi untuk memuat halaman dengan AJAX
    function loadPageContent(url, scrollToPosition = null) {
        const updateKegiatanSection = document.getElementById('update-kegiatan-section');

        // Show loading indicator
        updateKegiatanSection.style.opacity = '0.5';

        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newUpdateKegiatan = doc.getElementById('update-kegiatan-section');

                if (newUpdateKegiatan) {
                    updateKegiatanSection.innerHTML = newUpdateKegiatan.innerHTML;
                    attachPaginationListeners();
                    history.pushState({}, '', url);

                    if (scrollToPosition !== null) {
                        window.scrollTo(0, scrollToPosition);
                    }

                    // Update localStorage dengan ID terbaru
                    const newFirstCard = updateKegiatanSection.querySelector('.update-kegiatan-card');
                    if (newFirstCard) {
                        localStorage.setItem('latestActivityId', newFirstCard.dataset.idKegiatan);
                    }
                }

                updateKegiatanSection.style.opacity = '1';
            })
            .catch(error => {
                console.error('Error loading page:', error);
                updateKegiatanSection.style.opacity = '1';
            });
    }

    // Fungsi untuk menambahkan event listener pada pagination
    function attachPaginationListeners() {
        const paginationLinks = document.querySelectorAll('[data-page-link]');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const url = this.getAttribute('href');
                // Save current scroll position
                const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

                loadPageContent(url, scrollPosition);
            });
        });
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        // Attach pagination listeners
        attachPaginationListeners();

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function(e) {
            // Save current scroll position
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            loadPageContent(window.location.href, scrollPosition);
        });

        // Setup auto-update for activities
        // Ambil latest_id dari section update kegiatan
        const updateKegiatanSection = document.getElementById('update-kegiatan-section');
        if (updateKegiatanSection) {
            // Simpan ID terbaru saat halaman dimuat pertama kali
            const firstCard = updateKegiatanSection.querySelector('.update-kegiatan-card');
            if (firstCard) {
                localStorage.setItem('latestActivityId', firstCard.dataset.idKegiatan);
            }

            // Cek update setiap 2 menit
            setInterval(checkActivityUpdates, 120000); // 2 menit = 120000 ms

            // Cek update pertama kali setelah 10 detik
            setTimeout(checkActivityUpdates, 10000);
        }
    });
</script>

</html>