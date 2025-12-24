<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan PDF.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
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

        /* Back to top button styles - PERBAIKAN */
        #backToTop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        #backToTop.show {
            opacity: 1;
            visibility: visible;
        }

        #backToTop:hover {
            background-color: #2563eb;
            transform: translateY(-5px);
        }

        #backToTop i {
            font-size: 24px;
            color: white;
            display: block !important;
        }

        /* Fallback for Font Awesome - PERBAIKAN */
        #backToTop .arrow-fallback {
            display: none;
            width: 24px;
            height: 24px;
        }

        #backToTop.no-icon .arrow-fallback {
            display: block;
        }

        #backToTop.no-icon i {
            display: none !important;
        }

        /* Only show on mobile */
        @media (min-width: 641px) {
            #backToTop {
                display: none;
            }
        }

        /* PDF Preview Styles */
        .pdf-container {
            position: relative;
            width: 100%;
            height: 12rem;
            background-color: #f9fafb;
            border-radius: 0.5rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pdf-canvas-container {
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: #ffffff;
            border-radius: 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .pdf-page-canvas {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            object-fit: contain;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .pdf-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #4b5563;
        }

        .pdf-loading-spinner {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        @media (min-width: 1024px) {
            .pdf-container {
                height: 15rem;
            }
        }

        /* ================= MODAL PREVIEW ================= */
        .preview-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .preview-modal.active {
            display: flex;
            opacity: 1;
        }

        .preview-content {
            background: white;
            border-radius: 12px;
            width: 100%;
            max-width: 900px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .preview-modal.active .preview-content {
            transform: scale(1);
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            background: #ffffff;
            z-index: 10;
            position: relative;
        }

        .preview-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .preview-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .preview-close:hover {
            background: #f1f5f9;
            color: #1e293b;
            transform: rotate(90deg);
        }

        .preview-body {
            position: relative;
            width: 100%;
            height: calc(90vh - 70px);
            overflow: hidden;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preview-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .preview-pdf {
            width: 100%;
            height: 100%;
            overflow-y: auto;
            padding: 1rem;
            background: #ffffff;
            border-radius: 8px;
            -webkit-overflow-scrolling: touch;
        }

        .preview-pdf canvas {
            display: block;
            width: 100% !important;
            height: auto !important;
            margin: 0 auto 1rem auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
            image-rendering: pixelated;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
            will-change: transform;
        }

        .preview-pdf iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 8px;
        }

        /* Tambahkan class untuk navbar tetap terlihat saat modal aktif */
        body.modal-active {
            overflow: hidden;
        }

        body.modal-active .navbar {
            z-index: 10000;
        }

        /* Responsive untuk modal - TIDAK FULLSCREEN */
        @media (max-width: 768px) {
            .preview-modal {
                padding: 1rem;
            }

            .preview-content {
                max-width: 95%;
                max-height: 85vh;
                border-radius: 12px;
            }

            .preview-header {
                padding: 0.75rem;
                position: sticky;
                top: 0;
                z-index: 100;
                background: white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .preview-title {
                font-size: 1rem;
            }

            .preview-close {
                width: 36px;
                height: 36px;
                font-size: 1.2rem;
            }

            .preview-body {
                height: calc(85vh - 60px);
            }

            .preview-pdf {
                padding: 0.75rem;
            }

            .preview-pdf canvas {
                max-width: 100%;
                transform: none;
                -webkit-transform: none;
                image-rendering: -webkit-optimize-contrast;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }

        @media (max-width: 480px) {
            .preview-modal {
                padding: 0.75rem;
            }

            .preview-content {
                max-width: 98%;
                max-height: 80vh;
                border-radius: 12px;
            }

            .preview-header {
                padding: 0.5rem;
            }

            .preview-title {
                font-size: 0.9rem;
            }

            .preview-close {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }

            .preview-body {
                height: calc(80vh - 50px);
            }

            .preview-pdf {
                padding: 0.5rem;
            }

            .preview-pdf canvas {
                margin-bottom: 0.75rem;
                image-rendering: auto;
                image-rendering: -webkit-optimize-contrast;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
            }
        }

        @media (max-width: 360px) {
            .preview-modal {
                padding: 0.5rem;
            }

            .preview-content {
                max-width: 100%;
                max-height: 75vh;
                border-radius: 8px;
            }

            .preview-body {
                height: calc(75vh - 45px);
            }

            .preview-pdf {
                padding: 0.25rem;
            }
        }

        /* Loading state untuk PDF */
        .pdf-loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 200px;
            padding: 2rem;
        }

        .pdf-loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f4f6;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        .pdf-loading-text {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Error state untuk PDF */
        .pdf-error-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 200px;
            padding: 2rem;
            text-align: center;
        }

        .pdf-error-icon {
            color: #ef4444;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .pdf-error-text {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .pdf-error-subtext {
            color: #9ca3af;
            font-size: 0.75rem;
        }

        /* Teks "Lihat File" */
        .preview-overlay-text {
            position: absolute;
            background-color: rgba(59, 130, 246, 0.9);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 0.875rem;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .preview-overlay-text:hover {
            background-color: rgba(37, 99, 235, 0.95);
            transform: scale(1.05);
        }

        .preview-overlay-text i {
            font-size: 1rem;
        }

        /* Posisi untuk mobile */
        @media (max-width: 768px) {
            .preview-overlay-text {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }

        /* Posisi untuk desktop */
        @media (min-width: 769px) {
            .preview-overlay-text {
                top: 1rem;
                right: 1rem;
                transform: none;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-white font-['Poppins']">
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>

    <div id="content">
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
                            <p id="viewCount" class="text-emerald-500 font-extrabold text-3xl sm:text-4xl">{{ $homePageViews }}</p>
                        </div>
                    </div>

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
                                        <div class="number" id="viewCountMobile">{{ $homePageViews }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

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

        <!-- PUBIKASI - DITAMBAHKAN -->
        <section class="py-12 sm:py-16 bg-white-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 sm:mb-12">
                    <h2 class="text-xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-4 sm:mb-6 md:mb-8">Modul Pembelajaran</h2>
                </div>

                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="relative w-full h-48 md:h-60 block modul-item">
                        <div class="pdf-container relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">
                            <!-- Container untuk PDF.js -->
                            <div id="pdf-modul-js" class="pdf-canvas-container w-full h-full">
                                <div class="pdf-loading">
                                    <div class="pdf-loading-spinner"></div>
                                    <p>Memuat PDF...</p>
                                </div>
                            </div>

                            <!-- Teks "Lihat File" -->
                            <div class="preview-overlay-text" onclick="openPreviewModal('{{ asset('images/Modul Pembelajaran INNDESA.pdf') }}', 'Modul Pembelajaran INNDESA', 'pdf')">
                                <i class="fas fa-eye"></i>
                                <span>Lihat File</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">Modul Pembelajaran INNDESA</h3>
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                            <button onclick="openPreviewModal('{{ asset('images/Modul Pembelajaran INNDESA.pdf') }}', 'Modul Pembelajaran INNDESA', 'pdf')"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium flex items-center gap-2 justify-center">
                                <i class="fas fa-file-pdf"></i>
                                Baca Modul
                            </button>
                            <a href="{{ asset('images/Modul Pembelajaran INNDESA.pdf') }}" download
                                class="bg-green-600 hover:bg-green-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium flex items-center gap-2 justify-center">
                                <i class="fas fa-download"></i>
                                Unduh PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- UPDATE KEGIATAN -->
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
                        <div class="flex flex-col h-full p-3 md:p-4">
                            <h3 class="font-bold text-sm md:text-sm mb-2 leading-tight">
                                {{ $kegiatan->judul }}
                            </h3>

                            {{-- Bagian isi ditarik biar fleksibel --}}
                            <div class="flex flex-col justify-between flex-1">
                                <div>
                                    <p class="text-xs opacity-75">
                                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                    </p>

                                    {{-- Deskripsi singkat --}}
                                    <p class="text-xs md:text-sm text-black-600 mt-2 line-clamp-3 md:line-clamp-2">
                                        {{ Str::limit($kegiatan->deskripsi, 120) }}
                                    </p>
                                </div>

                                {{-- Baca Selengkapnya rata tengah di bawah --}}
                                <a href="{{ url('update_kegiatan/' . \App\Http\Controllers\Update_KegiatanController::createHashUrl($kegiatan->id_kegiatan, $kegiatan->judul)) }}"
                                    class="text-white-600 hover:underline text-xs md:text-sm mt-3 block text-center">
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

                        {{-- Tombol Previous --}}
                        @if ($kegiatans->onFirstPage())
                        <span class="pagination-btn disabled">←</span>
                        @else
                        <a href="{{ $kegiatans->previousPageUrl() }}" class="pagination-btn" data-page-link>←</a>
                        @endif

                        {{-- Nomor halaman --}}
                        @php
                        $current = $kegiatans->currentPage();
                        $last = $kegiatans->lastPage();
                        $start = max(1, $current - 1);
                        $end = min($last, $current + 1);
                        @endphp

                        {{-- Tampilkan halaman pertama --}}
                        @if ($start > 1)
                        <a href="{{ $kegiatans->url(1) }}" class="pagination-btn {{ $current == 1 ? 'active' : '' }}">1</a>
                        @if ($start > 2)
                        <span class="px-1 sm:px-2 text-gray-500 text-sm">...</span>
                        @endif
                        @endif

                        {{-- Halaman sekitar current --}}
                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page==$current)
                            <span class="pagination-btn active">{{ $page }}</span>
                            @else
                            <a href="{{ $kegiatans->url($page) }}" class="pagination-btn" data-page-link>{{ $page }}</a>
                            @endif
                            @endfor

                            {{-- Tampilkan halaman terakhir --}}
                            @if ($end < $last)
                                @if ($end < $last - 1)
                                <span class="px-1 sm:px-2 text-gray-500 text-sm">...</span>
                                @endif
                                <a href="{{ $kegiatans->url($last) }}" class="pagination-btn {{ $current == $last ? 'active' : '' }}">{{ $last }}</a>
                                @endif

                                {{-- Tombol Next --}}
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

        <!-- YOUTUBE -->
        <section class="py-12 sm:py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="relative aspect-video bg-gray-900 cursor-pointer group"
                        onclick="openModal('https://www.youtube.com/embed/oSwpCKhvGto?autoplay=1')">
                        <img src="https://img.youtube.com/vi/oSwpCKhvGto/maxresdefault.jpg"
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
                            <a href="https://youtu.be/oSwpCKhvGto?si=y6G9y_nzXm_EbT_w"
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
                        class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded transition">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M15 8a3 3 0 01-3 3H5a3 3 0 110-6h7a3 3 0 01 3 3zM19 16a3 3 0 01-3 3H5a3 3 0 110-6h11a3 3 0 01 3 3z" />
                        </svg>
                        Salin Link
                    </button>

                    <span id="copy-status" class="text-sm text-brown-600 mt-1"></span>
                </div>
                <button onclick="closeShareModal()" class="mt-3 w-full bg-gray-200 hover:bg-gray-300 py-2 rounded">
                    Tutup
                </button>
            </div>
        </div>

        <!-- Modal Preview untuk PDF -->
        <div id="previewModal" class="preview-modal">
            <div class="preview-content">
                <div class="preview-header">
                    <h3 id="previewTitle" class="preview-title"></h3>
                    <button onclick="closePreviewModal()" class="preview-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="preview-body">
                    <!-- PDF preview -->
                    <div id="previewPdf" class="preview-pdf hidden"></div>
                </div>
            </div>
        </div>

        <div class="mt-16 sm:mt-20">
            @include('footer')
        </div>

        <!-- KEMBALI KEATAS -->
        <!-- KEMBALI KEATAS - PERBAIKAN -->
        <a href="#" id="backToTop" title="Kembali ke Atas">
            <i class="fas fa-arrow-up"></i>
            <!-- SVG fallback jika Font Awesome tidak berhasil dimuat -->
            <svg class="arrow-fallback" fill="white" viewBox="0 0 24 24">
                <path d="M7 14l5-5 5 5z" />
            </svg>
        </a>
    </div>
</body>
<script>
    // Set worker untuk PDF.js
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

    // KEMBALI KE ATAS
    function checkFontAwesome() {
        const icon = document.createElement('i');
        icon.className = 'fas fa-arrow-up';
        const isLoaded = window.getComputedStyle(icon, ':before').getPropertyValue('content') !== 'none';

        if (isLoaded) {
            document.body.classList.add('fa-loaded');
        }
    }

    // Run check after DOM is loaded
    document.addEventListener('DOMContentLoaded', checkFontAwesome);

    // Also run check after window is fully loaded
    window.addEventListener('load', checkFontAwesome);

    // KEMBALI KE ATAS
    const backToTopButton = document.getElementById('backToTop');

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

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

    const shareBtn = document.getElementById('shareBtn');
    const shareModal = document.getElementById('shareModal');
    const videoLink = 'https://youtu.be/oSwpCKhvGto';

    shareBtn.addEventListener('click', () => {
        shareModal.style.display = 'flex'; // tampilkan modal
    });

    function closeShareModal() {
        shareModal.style.display = 'none'; // sembunyikan modal
    }

    function copyLink() {
        const videoLink = "https://youtu.be/oSwpCKhvGto"; // ganti sesuai link dinamis
        navigator.clipboard.writeText(videoLink).then(() => {
            const status = document.getElementById("copy-status");
            status.textContent = "Link berhasil disalin!";

            // Hilangkan setelah 2,5 detik
            setTimeout(() => {
                status.textContent = "";
            }, 2500);
        });
    }

    function shareWhatsApp() {
        window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(videoLink)}`);
    }

    function shareFacebook() {
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(videoLink)}`);
    }

    function shareTwitter() {
        window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(videoLink)}`);
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

    // Fungsi untuk mendeteksi apakah browser mendukung PDF viewer
    function canDisplayPdfInline() {
        // Cek apakah browser adalah Safari di iOS
        const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

        // Cek apakah browser adalah Chrome di Android
        const isAndroid = /Android/.test(navigator.userAgent);

        // Untuk iOS dan Android, lebih baik tidak menampilkan PDF inline
        if (isIOS || isAndroid) {
            return false;
        }

        // Untuk desktop, cek apakah browser mendukung PDF viewer
        const pdfPlugin = navigator.mimeTypes && navigator.mimeTypes['application/pdf'];
        return !!(pdfPlugin || navigator.plugins && navigator.plugins.length > 0);
    }

    // Fungsi untuk render PDF dengan PDF.js
    async function renderPdfWithJs(pdfUrl, containerId) {
        try {
            const container = document.getElementById(containerId);
            if (!container) return false;

            // Tampilkan loading
            const loadingDiv = container.querySelector('.pdf-loading');
            if (loadingDiv) loadingDiv.style.display = 'flex';

            // Load PDF
            const pdf = await pdfjsLib.getDocument(pdfUrl).promise;
            const numPages = pdf.numPages;

            // Sembunyikan loading
            if (loadingDiv) loadingDiv.style.display = 'none';

            // Hapus canvas yang ada
            const canvases = container.querySelectorAll('.pdf-page-canvas');
            canvases.forEach(canvas => canvas.remove());

            // Deteksi perangkat mobile
            const isMobile = window.innerWidth <= 768;

            // Render each page
            for (let pageNum = 1; pageNum <= numPages; pageNum++) {
                const page = await pdf.getPage(pageNum);

                // Hitung skala yang sesuai dengan container
                const containerWidth = container.clientWidth;
                const containerHeight = container.clientHeight;
                const baseViewport = page.getViewport({
                    scale: 1.0
                });

                // Hitung skala agar PDF muat dalam container
                let scale;
                if (isMobile) {
                    // Untuk mobile, gunakan skala yang lebih tinggi untuk kualitas HD
                    scale = Math.min(
                        (containerWidth * 2) / baseViewport.width,
                        (containerHeight * 2) / baseViewport.height,
                        3.0
                    );
                } else {
                    scale = Math.min(
                        containerWidth / baseViewport.width,
                        containerHeight / baseViewport.height,
                        1.5
                    );
                }

                const viewport = page.getViewport({
                    scale: scale
                });

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d', {
                    alpha: false,
                    willReadFrequently: true
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                canvas.className = 'pdf-page-canvas';

                // Untuk mobile, atur ukuran tampilan CSS lebih kecil dari ukuran sebenarnya
                if (isMobile) {
                    canvas.style.width = (canvas.width / 2) + 'px';
                    canvas.style.height = (canvas.height / 2) + 'px';
                }

                // Set kualitas rendering
                context.imageSmoothingEnabled = true;
                context.imageSmoothingQuality = 'high';
                context.textBaseline = 'alphabetic';
                context.fillStyle = '#000000';

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport,
                    enableWebGL: true
                };

                await page.render(renderContext).promise;
                container.appendChild(canvas);
            }

            // Set scroll position ke atas setelah render selesai
            container.scrollTop = 0;

            return true;
        } catch (error) {
            console.error('Error rendering PDF with PDF.js:', error);

            // Tampilkan pesan error di container
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full p-4 text-center">
                        <div class="text-red-500 mb-2">
                            <i class="fas fa-exclamation-triangle text-2xl"></i>
                        </div>
                        <p class="text-sm text-gray-600">PDF tidak dapat ditampilkan.</p>
                    </div>
                `;
            }

            return false;
        }
    }

    // Fungsi untuk render PDF di modal dengan kualitas HD untuk mobile
    async function renderPdfInModal(pdfUrl, containerId) {
        try {
            const container = document.getElementById(containerId);
            if (!container) return;

            // Deteksi perangkat mobile
            const isMobile = window.innerWidth <= 768;
            const isSmallMobile = window.innerWidth <= 480;
            const isVerySmallMobile = window.innerWidth <= 360;

            // Tampilkan loading yang lebih baik
            container.innerHTML = `
                <div class="pdf-loading-container">
                    <div class="pdf-loading-spinner"></div>
                    <p class="pdf-loading-text">Memuat PDF...</p>
                </div>
            `;
            container.classList.remove('hidden');

            // Load PDF dengan opsi yang dioptimalkan
            const loadingTask = pdfjsLib.getDocument({
                url: pdfUrl,
                cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/cmaps/',
                cMapPacked: true,
                standardFontDataUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/standard_fonts/'
            });

            const pdf = await loadingTask.promise;
            const numPages = pdf.numPages;

            // Clear loading
            container.innerHTML = '';

            // Render each page dengan kualitas tinggi
            for (let pageNum = 1; pageNum <= numPages; pageNum++) {
                const page = await pdf.getPage(pageNum);

                // Calculate scale to fit container width dengan kualitas lebih tinggi
                const containerWidth = container.clientWidth - (isMobile ? 16 : 32);

                // Untuk mobile, gunakan skala yang lebih tinggi untuk kualitas HD
                const baseViewport = page.getViewport({
                    scale: 1.0
                });

                // Tentukan skala yang optimal
                let scale;
                if (isMobile) {
                    // Untuk mobile, gunakan skala 2x atau 3x untuk kualitas HD
                    let scaleFactor;
                    if (isVerySmallMobile) {
                        scaleFactor = 2;
                    } else if (isSmallMobile) {
                        scaleFactor = 2.5;
                    } else {
                        scaleFactor = 2.5;
                    }
                    scale = Math.min((containerWidth * scaleFactor) / baseViewport.width, 3.5);
                } else {
                    // Untuk desktop, gunakan skala normal
                    scale = containerWidth / baseViewport.width;
                }

                const viewport = page.getViewport({
                    scale: scale
                });

                // Buat canvas dengan resolusi tinggi
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d', {
                    alpha: false,
                    desynchronized: true,
                    willReadFrequently: true
                });

                // Set ukuran canvas sesuai viewport
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Untuk mobile, atur ukuran tampilan CSS lebih kecil dari ukuran sebenarnia
                if (isMobile) {
                    let displayScale;
                    if (isVerySmallMobile) {
                        displayScale = 2;
                    } else if (isSmallMobile) {
                        displayScale = 2.5;
                    } else {
                        displayScale = 2.5;
                    }
                    canvas.style.width = (canvas.width / displayScale) + 'px';
                    canvas.style.height = (canvas.height / displayScale) + 'px';
                }

                // Set kualitas rendering maksimal
                context.imageSmoothingEnabled = true;
                context.imageSmoothingQuality = 'high';

                // Aktifkan anti-aliasing untuk teks
                context.textBaseline = 'alphabetic';
                context.fillStyle = '#000000';

                // Render halaman dengan opsi yang dioptimalkan
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport,
                    enableWebGL: true,
                    renderInteractiveForms: true
                };

                await page.render(renderContext).promise;
                container.appendChild(canvas);
            }

            // Scroll ke atas setelah render selesai
            container.scrollTop = 0;

        } catch (error) {
            console.error('Error rendering PDF:', error);
            const container = document.getElementById(containerId);
            if (container) {
                container.innerHTML = `
                    <div class="pdf-error-container">
                        <div class="pdf-error-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <p class="pdf-error-text">PDF tidak dapat ditampilkan</p>
                        <p class="pdf-error-subtext">Silakan coba lagi atau hubungi administrator</p>
                    </div>
                `;
            }
        }
    }

    // Modifikasi fungsi initializeInlinePdfs
    function initializeInlinePdfs() {
        // Inisialisasi PDF untuk modul pembelajaran
        const modulJsContainer = document.getElementById('pdf-modul-js');

        if (modulJsContainer) {
            const pdfUrl = "{{ asset('images/Modul Pembelajaran INNDESA.pdf') }}";

            // Tampilkan loading
            const loadingDiv = modulJsContainer.querySelector('.pdf-loading');
            if (loadingDiv) loadingDiv.style.display = 'flex';

            // Cek apakah perangkat mendukung PDF viewer
            if (canDisplayPdfInline()) {
                // Render dengan PDF.js
                renderPdfWithJs(pdfUrl, 'pdf-modul-js').then(success => {
                    if (!success) {
                        // Tampilkan pesan error jika PDF.js gagal
                        modulJsContainer.innerHTML = `
                            <div class="flex flex-col items-center justify-center h-full p-4 text-center">
                                <div class="text-red-500 mb-2">
                                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                                </div>
                                <p class="text-sm text-gray-600">PDF tidak dapat ditampilkan.</p>
                                <p class="text-xs text-gray-500 mt-2">Silakan unduh file untuk melihat kontennya.</p>
                            </div>
                        `;
                    }
                }).catch(error => {
                    console.error('Error rendering PDF:', error);
                    // Tampilkan pesan error jika terjadi error
                    modulJsContainer.innerHTML = `
                        <div class="flex flex-col items-center justify-center h-full p-4 text-center">
                            <div class="text-red-500 mb-2">
                                <i class="fas fa-exclamation-triangle text-2xl"></i>
                            </div>
                            <p class="text-sm text-gray-600">PDF tidak dapat ditampilkan.</p>
                            <p class="text-xs text-gray-500 mt-2">Silakan unduh file untuk melihat kontennya.</p>
                        </div>
                    `;
                });
            } else {
                // Untuk perangkat yang tidak mendukung PDF viewer, tampilkan thumbnail
                modulJsContainer.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full p-4 text-center">
                        <div class="text-blue-500 mb-3">
                            <i class="fas fa-file-pdf text-4xl"></i>
                        </div>
                        <p class="text-sm text-gray-700 font-medium">Modul Pembelajaran INNDESA</p>
                        <p class="text-xs text-gray-500 mt-2">Klik "Baca Modul" untuk melihat konten</p>
                    </div>
                `;
            }
        }
    }

    // Fungsi untuk membuka modal preview
    function openPreviewModal(fileSrc, title, type = 'image', isKatalog = false) {
        const modal = document.getElementById('previewModal');
        const previewPdf = document.getElementById('previewPdf');
        const previewTitle = document.getElementById('previewTitle');

        previewTitle.textContent = title;

        if (type === 'pdf') {
            // Render PDF tanpa watermark
            renderPdfInModal(fileSrc, 'previewPdf');
        }

        // Tampilkan modal dengan animasi
        modal.classList.add('active');

        // Tambahkan class untuk body agar navbar tetap terlihat
        document.body.classList.add('modal-active');

        // Fokus ke modal untuk accessibility
        modal.focus();
    }

    // Fungsi untuk menutup modal preview
    function closePreviewModal() {
        const modal = document.getElementById('previewModal');

        // Hapus class active untuk animasi
        modal.classList.remove('active');

        // Hapus class modal-active dari body
        document.body.classList.remove('modal-active');

        // Reset konten setelah animasi selesai
        setTimeout(() => {
            const previewPdf = document.getElementById('previewPdf');
            previewPdf.innerHTML = '';
        }, 300);
    }

    // Event listener untuk menutup modal dengan klik di luar
    document.getElementById('previewModal').addEventListener('click', (e) => {
        if (e.target.id === 'previewModal') {
            closePreviewModal();
        }
    });

    // Event listener untuk tombol close
    document.querySelectorAll('.preview-close').forEach(btn => {
        btn.addEventListener('click', closePreviewModal);
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closePreviewModal();
        }
    });

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        // Fungsi untuk menginisialisasi carousel kartu di mobile
        function initCardCarousel() {
            const cardSlider = document.getElementById('cardSlider');
            if (!cardSlider) return;

            const slides = cardSlider.querySelectorAll('.card-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            let currentSlide = 0;
            let slideInterval;

            // Fungsi untuk pindah ke slide tertentu
            function goToSlide(slideIndex) {
                if (slideIndex < 0) slideIndex = slides.length - 1;
                if (slideIndex >= slides.length) slideIndex = 0;

                currentSlide = slideIndex;
                cardSlider.style.transform = `translateX(-${currentSlide * 100}%)`;

                // Update status dot pagination
                dots.forEach((dot, index) => {
                    if (index === currentSlide) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }

            // Fungsi untuk memulai auto-slide
            function startAutoSlide() {
                slideInterval = setInterval(() => {
                    goToSlide(currentSlide + 1);
                }, 3000); // Ganti slide setiap 3 detik
            }

            // Fungsi untuk menghentikan auto-slide
            function stopAutoSlide() {
                clearInterval(slideInterval);
            }

            // Event listener untuk dot pagination
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    goToSlide(index);
                    stopAutoSlide();
                    startAutoSlide(); // Restart auto-slide setelah klik
                });
            });

            // Touch/swipe functionality untuk mobile
            let touchStartX = 0;
            let touchEndX = 0;

            cardSlider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                stopAutoSlide();
            }, {
                passive: true
            });

            cardSlider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
                startAutoSlide(); // Restart auto-slide setelah swipe
            }, {
                passive: true
            });

            function handleSwipe() {
                if (touchEndX < touchStartX - 50) {
                    // Swipe ke kiri - slide berikutnya
                    goToSlide(currentSlide + 1);
                }
                if (touchEndX > touchStartX + 50) {
                    // Swipe ke kanan - slide sebelumnya
                    goToSlide(currentSlide - 1);
                }
            }

            // Mulai auto-slide
            startAutoSlide();

            // Pause auto-slide saat user hover (untuk desktop)
            cardSlider.addEventListener('mouseenter', stopAutoSlide);
            cardSlider.addEventListener('mouseleave', startAutoSlide);
        }

        // Attach pagination listeners
        attachPaginationListeners();

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function(e) {
            // Save current scroll position
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            loadPageContent(window.location.href, scrollPosition);
        });

        // Setup auto-update for statistics
        updateStatistik();
        setInterval(updateStatistik, 30000); // Update setiap 30 detik

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

        // Inisialisasi PDF.js untuk inline preview
        initializeInlinePdfs();

        // Inisialisasi carousel kartu
        initCardCarousel();
    });
</script>

</html>