<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Tambahkan PDF.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <style>
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

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
            width: 100%;
        }

        .product-image {
            width: 100%;
            height: 100%;
            max-width: 450px;
            max-height: 450px;
            object-fit: cover;
            object-position: center;
        }

        /* Product Card Styles */
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

        .product-card-content h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            line-height: 1.2;
            height: 2.4em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-card-content p {
            font-size: 0.875rem;
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
        }

        /* Pagination Button Styles */
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

        /* Related Products Carousel */
        .related-products {
            display: flex;
            flex-wrap: nowrap;
            gap: 1.5rem;
            overflow: hidden;
        }

        .produk-item {
            flex: 0 0 auto;
            width: 250px;
        }

        /* Watermark styling */
        .watermark {
            opacity: 0.1;
            transform: rotate(-45deg);
            white-space: nowrap;
        }

        /* Disable right-click, drag, and selection */
        .no-context-menu {
            pointer-events: auto;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        /* PDF Preview Styles */
        .pdf-preview-iframe {
            border: none;
            background: white;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

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

            #content-deskripsi,
            #content-sertifikat {
                min-height: 350px;
            }

            .pdf-container {
                height: 15rem;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .content {
                margin-top: 1rem;
                padding: 0 1rem;
            }

            .card {
                grid-template-columns: 1fr !important;
                gap: 1rem;
                padding: 1rem;
                min-height: auto;
            }

            .product-image {
                max-width: 100%;
                max-height: 300px;
                height: auto !important;
            }

            .overflow-hidden.rounded-lg {
                width: 100% !important;
                height: auto !important;
                max-height: 300px;
            }

            h1.text-4xl {
                font-size: 1.5rem !important;
            }

            .text-xl {
                font-size: 1rem !important;
            }

            /* PERBAIKAN: Button Hubungi Kami tetap bersebelahan di mobile */
            .flex.flex-wrap.items-center.gap-4 {
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: center !important;
                flex-wrap: nowrap !important;
            }

            .flex.items-center.space-x-2 {
                flex-shrink: 0 !important;
            }

            .related-products {
                gap: 1rem;
            }

            .produk-item {
                width: calc(50% - 0.5rem);
            }

            .product-card img {
                height: 140px;
            }

            .product-card-content h3 {
                font-size: 0.85rem;
                height: 2.4em;
            }

            .product-card-content p {
                font-size: 0.75rem;
            }

            .btn {
                padding: 0.4rem 1rem;
                font-size: 0.85rem;
            }

            #tab-deskripsi,
            #tab-sertifikat {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .text-gray-700 {
                font-size: 0.9rem;
            }

            .sertifikat-item {
                height: 200px !important;
                max-width: 100%;
            }

            .sertifikat-item img,
            .sertifikat-item object,
            .sertifikat-item .pdf-container {
                height: 200px !important;
            }

            .watermark {
                font-size: 6px !important;
            }

            #previewModal .p-4 {
                padding: 0.5rem !important;
            }

            #previewModal .w-11\/12.h-5\/6 {
                width: 95% !important;
                height: 85vh !important;
                margin: 7.5vh auto;
            }

            #previewTitle.text-lg {
                font-size: 1rem !important;
            }

            /* PERBAIKAN: Gambar di modal preview mobile - pastikan tidak terdistorsi */
            #previewImage {
                object-fit: contain !important;
                width: 100% !important;
                height: 100% !important;
                max-width: 100% !important;
                max-height: 70vh !important;
            }

            #previewPdf,
            #pdfModalJsContainer {
                max-height: 70vh !important;
                height: 70vh !important;
            }

            #imageWatermark .watermark,
            #pdfWatermarkMobile .watermark,
            #pdfWatermarkDesktop .watermark {
                font-size: 14px !important;
            }

            .flex.flex-col.border-t.border-gray-300 .flex.items-center.space-x-4 {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .flex.items-center.space-x-2 img {
                width: 32px !important;
                height: 32px !important;
            }

            .flex.items-center.space-x-2 span {
                font-size: 0.9rem !important;
            }

            #contactDropdownMenu {
                width: 100% !important;
                max-width: none !important;
                margin-top: 0.5rem;
            }

            #contactDropdownMenu a {
                padding: 0.75rem;
                font-size: 0.9rem;
            }

            #contactDropdownMenu .text-sm {
                font-size: 0.8rem;
            }

            .btn-outline {
                padding: 0.3rem 0.8rem !important;
                font-size: 0.8rem !important;
            }

            #sertifikat-pagination button,
            #produk-pagination button {
                padding: 0.3rem 0.6rem !important;
                font-size: 0.8rem !important;
            }

            h2.text-xl {
                font-size: 1rem !important;
            }

            .mt-8.mb-12 {
                margin-top: 1.5rem !important;
                margin-bottom: 2rem !important;
            }

            .pdf-watermark-mobile .grid {
                grid-template-columns: repeat(6, 1fr) !important;
            }
        }

        /* Tablet Responsive */
        @media (min-width: 641px) and (max-width: 1024px) {
            .product-card img {
                height: 180px;
            }
        }

        /* Very Small Mobile */
        @media (max-width: 375px) {
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

            .pdf-container {
                height: 10rem !important;
            }

            #previewModal .w-11\/12.h-5\/6 {
                height: 80vh !important;
                margin: 10vh auto;
            }

            #previewImage,
            #previewPdf,
            #pdfModalJsContainer {
                max-height: 65vh !important;
                height: 65vh !important;
            }

            /* PERBAIKAN: Button Hubungi Kami tetap bersebelahan di very small mobile */
            .flex.flex-wrap.items-center.gap-4 {
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: center !important;
                flex-wrap: nowrap !important;
                gap: 0.5rem !important;
            }

            .flex.items-center.space-x-2 {
                flex-shrink: 0 !important;
                white-space: nowrap !important;
            }

            .bg-green-500.text-white.px-4.py-2.rounded-lg {
                flex-shrink: 0 !important;
                white-space: nowrap !important;
            }
        }

        /* Loading Spinner */
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

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Focus States for Accessibility */
        input:focus,
        button:focus {
            outline: 2px solid #0097D4;
            outline-offset: 2px;
        }

        /* Touch Targets for Mobile */
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

<body class="bg-white">
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>
    @include('navbar')
    <div class="content w-full mt-6 px-6 lg:px-12">
        <div class="bg-white card p-6 grid grid-cols-1 md:grid-cols-2 gap-6 min-h-[450px]">
            <div class="flex justify-center">
                <div class="flex justify-center items-center">
                    <div class="w-full h-48 sm:w-[450px] sm:h-[450px] overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                            alt="{{ $produk->nama }}"
                            class="w-full h-full object-cover no-context-menu"
                            draggable="false"
                            oncontextmenu="return false;"
                            ondragstart="return false;"
                            onselectstart="return false;">
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-gray-900">{{ $produk->nama }}</h1>
                <div class="flex items-center gap-4 border-b pb-2">
                    <p class="text-base sm:text-xl font-semibold text-gray-900 whitespace-nowrap">
                        Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                    </p>
                    <p class="text-base sm:text-xl font-semibold text-gray-900 whitespace-nowrap">
                        Stok: {{ $produk->stok }}
                    </p>
                </div>
                <div class="w-full mt-6">
                    <div class="flex bg-gray-200 rounded-lg overflow-hidden">
                        <button id="tab-deskripsi"
                            onclick="openTab('deskripsi')"
                            class="flex-1 px-4 py-2 font-semibold bg-[#0097D4] text-white transition">
                            Deskripsi
                        </button>
                        <button id="tab-sertifikat"
                            onclick="openTab('sertifikat')"
                            class="flex-1 px-4 py-2 font-semibold bg-gray-200 text-gray-700 transition">
                            Sertifikat
                        </button>
                    </div>
                    <!-- DESKRIPSI -->
                    <div id="content-deskripsi" class="mt-4">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>
                    <!-- SERTIFIKAT -->
                    <div id="content-sertifikat" class="hidden mt-4">
                        <div class="relative">
                            @php
                            $sertifikatPaths = $produk->sertifikat ? json_decode($produk->sertifikat, true) ?? [] : [];
                            @endphp
                            @if (!empty($sertifikatPaths))
                            <div id="sertifikat-carousel" class="carousel">
                                @foreach ($sertifikatPaths as $index => $filePath)
                                @php
                                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                $namaSertifikat = 'Sertifikat ' . ($index + 1);
                                @endphp
                                @if ($isImage && Storage::disk('public')->exists($filePath))
                                <div class="relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto h-48 md:h-60 block sertifikat-item"
                                    data-index="{{ $index }}">
                                    <img
                                        src="{{ asset('storage/' . $filePath) }}"
                                        alt="Sertifikat {{ $namaSertifikat }}"
                                        class="w-full h-full object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer no-context-menu"
                                        draggable="false"
                                        oncontextmenu="return false;"
                                        ondragstart="return false;"
                                        onselectstart="return false;"
                                        onclick="openPreview('{{ asset('storage/' . $filePath) }}', 'Sertifikat {{ $namaSertifikat }}', 'image')"
                                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'; this.onerror=null;">
                                    <div class="absolute inset-0 pointer-events-none overflow-hidden">
                                        <div class="grid grid-cols-12 w-full h-full">
                                            @for ($i = 0; $i < 150; $i++)
                                                <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-10 -rotate-45 whitespace-nowrap watermark">
                                                INNDESA
                                                </span>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                @elseif (Storage::disk('public')->exists($filePath))
                                <div class="relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto h-48 md:h-60 block sertifikat-item"
                                    data-index="{{ $index }}">
                                    <div class="pdf-container relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">
                                        <div id="pdf-sertifikat-js-{{ $index }}" class="pdf-canvas-container w-full h-full">
                                            <div class="pdf-loading">
                                                <div class="pdf-loading-spinner"></div>
                                                <p>Memuat PDF...</p>
                                            </div>
                                        </div>
                                        <iframe
                                            id="pdf-sertifikat-{{ $index }}"
                                            src="{{ asset('storage/' . $filePath) }}#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH"
                                            class="w-full h-full rounded-lg pdf-preview-iframe no-context-menu hidden"
                                            title="Sertifikat {{ $namaSertifikat }}"
                                            oncontextmenu="return false;"
                                            ondragstart="return false;"
                                            onselectstart="return false;"
                                            onload="this.contentWindow.focus(); checkPdfLoad(this, 'sertifikat', '{{ $index }}', '{{ asset('storage/' . $filePath) }}');">
                                        </iframe>
                                        <object
                                            id="pdf-sertifikat-object-{{ $index }}"
                                            data="{{ asset('storage/' . $filePath) }}#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH"
                                            type="application/pdf"
                                            class="w-full h-full rounded-lg pdf-preview-iframe no-context-menu hidden"
                                            title="Sertifikat {{ $namaSertifikat }}">
                                            <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                                Buka PDF di Tab Baru
                                            </a>
                                        </object>
                                        <div id="pdf-sertifikat-fallback-{{ $index }}" class="pdf-fallback hidden">
                                            <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                                Buka PDF di Tab Baru
                                            </a>
                                        </div>
                                        <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden pdf-watermark-mobile">
                                            <div class="grid grid-cols-6 w-full h-full">
                                                @for ($i = 0; $i < 36; $i++)
                                                    <span class="flex items-center justify-center text-gray-800 text-[6px] font-bold opacity-10 -rotate-45 whitespace-nowrap watermark">
                                                    INNDESA
                                                    </span>
                                                    @endfor
                                            </div>
                                        </div>
                                        <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                            <div class="grid grid-cols-12 w-full h-full">
                                                @for ($i = 0; $i < 150; $i++)
                                                    <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-10 -rotate-45 whitespace-nowrap watermark">
                                                    INNDESA
                                                    </span>
                                                    @endfor
                                            </div>
                                        </div>
                                        <div class="absolute inset-0 cursor-pointer no-context-menu"
                                            onclick="openPreview('{{ asset('storage/' . $filePath) }}', 'Sertifikat {{ $namaSertifikat }}', 'pdf')"
                                            oncontextmenu="return false;"
                                            ondragstart="return false;"
                                            onselectstart="return false;">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="flex justify-center mt-4">
                                <button id="sertifikat-prev" class="btn btn-outline mr-2 pagination-btn" onclick="prevSlide('sertifikat')" aria-label="Previous slide" style="display: none;">←</button>
                                <div id="sertifikat-pagination" class="flex space-x-1"></div>
                                <button id="sertifikat-next" class="btn btn-outline pagination-btn" onclick="nextSlide('sertifikat')" aria-label="Next slide" style="display: none;">→</button>
                            </div>
                            @else
                            <p class="text-center text-gray-500">Tidak ada data sertifikat yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="previewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-4 rounded-lg w-11/12 h-5/6 relative">
                        <a id="downloadLink" href="#" download class="absolute bottom-4 left-4 bg-green-500 text-white px-3 py-2 rounded text-sm font-medium hover:bg-green-600 transition hidden" aria-label="Download file">
                            Download
                        </a>
                        <button onclick="closePreview()" class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded">✕</button>
                        <h2 id="previewTitle" class="text-lg font-bold mb-4"></h2>
                        <img id="previewImage" class="max-h-[70vh] mx-auto hidden no-context-menu" alt="Preview"
                            draggable="false"
                            oncontextmenu="return false;"
                            ondragstart="return false;"
                            onselectstart="return false;">
                        <div id="pdfModalContainer" class="w-full h-[70vh] hidden">
                            <div id="pdfModalJsContainer" class="pdf-canvas-container hidden">
                                <div class="pdf-loading">
                                    <div class="pdf-loading-spinner"></div>
                                    <p>Memuat PDF...</p>
                                </div>
                            </div>
                            <iframe id="previewPdf" class="w-full h-full no-context-menu pdf-preview-iframe" frameborder="0"
                                oncontextmenu="return false;"
                                onload="this.contentWindow.focus(); checkModalPdfLoad();">
                            </iframe>
                            <object id="previewPdfObject" class="w-full h-full no-context-menu pdf-preview-iframe hidden" type="application/pdf">
                                <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                <a id="previewPdfLink" href="#" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Buka PDF di Tab Baru
                                </a>
                            </object>
                            <div id="previewPdfFallback" class="pdf-fallback hidden">
                                <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                <a id="previewPdfLink2" href="#" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Buka PDF di Tab Baru
                                </a>
                            </div>
                        </div>
                        <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden" id="imageWatermarkMobile">
                            <div class="grid grid-cols-6 w-full h-full">
                                @for ($i = 0; $i < 36; $i++)
                                    <span class="flex items-center justify-center text-gray-800 text-[14px] font-bold opacity-10 -rotate-45 whitespace-nowrap watermark">
                                    INNDESA
                                    </span>
                                    @endfor
                            </div>
                        </div>
                        <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block" id="imageWatermarkDesktop">
                            <div class="grid grid-cols-12 w-full h-full">
                                @for ($i = 0; $i < 150; $i++)
                                    <span class="flex items-center justify-center text-gray-800 text-[40px] font-bold opacity-10 -rotate-45 whitespace-nowrap watermark">
                                    INNDESA
                                    </span>
                                    @endfor
                            </div>
                        </div>
                        <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden" id="pdfWatermarkMobile">
                            <div class="grid grid-cols-6 w-full h-full">
                                @for ($i = 0; $i < 36; $i++)
                                    <span class="flex items-center justify-center text-gray-800 text-[14px] font-bold opacity-10 -rotate-45 whitespace-nowrap watermark">
                                    INNDESA
                                    </span>
                                    @endfor
                            </div>
                        </div>
                        <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block" id="pdfWatermarkDesktop">
                            <div class="grid grid-cols-12 w-full h-full">
                                @for ($i = 0; $i < 150; $i++)
                                    <span class="flex items-center justify-center text-gray-800 text-[40px] font-bold opacity-10 -rotate-45 whitespace-nowrap watermark">
                                    INNDESA
                                    </span>
                                    @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col border-t border-gray-300 mt-4 pt-4">
                    <span class="text-gray-700 mb-2">Untuk pemesanan dapat menghubungi kami:</span>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-10 h-10 text-gray-400 rounded-full bg-gray-200 p-2"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                            </svg>
                            <span class="text-gray-700 font-bold">{{ $produk->kelompok->nama }}</span>
                        </div>
                        <div class="relative">
                            <button onclick="toggleContactDropdown()"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                Hubungi Kami
                            </button>
                            <div id="contactDropdownMenu"
                                class="hidden absolute top-full left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50">
                                <a href="https://wa.me/6289647038212?text={{ urlencode('Halo, saya tertarik dengan produk ' . $produk->nama . '. Harga: Rp. ' . number_format($produk->harga, 0, ',', '.') . '. Link produk: ' . route('detail_produk.show', $produk->id_produk)) }}"
                                    class="flex flex-col px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <span class="font-semibold">WhatsApp</span>
                                    <span class="text-sm text-gray-500">+62 896-4703-8212</span>
                                </a>
                                <a href="https://www.instagram.com/fijarrfqh_/"
                                    class="flex flex-col px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <span class="font-semibold">Instagram</span>
                                    <span class="text-sm text-gray-500">@fijarrfqh_</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Produk Lain dari Toko yang Sama -->
        <div class="mt-8 mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Produk Lain dari Toko yang Sama</h2>
            <div class="relative">
                <div id="produk-carousel" class="related-products">
                    @php
                    $produk_terkait = \App\Models\Produk::where('id_kelompok', $produk->id_kelompok)
                    ->where('id_produk', '!=', $produk->id_produk)
                    ->take(8)
                    ->get();
                    @endphp
                    @forelse ($produk_terkait as $item)
                    <a href="{{ route('detail_produk.show', $item->id_produk) }}" class="block no-underline produk-item">
                        <div class="product-card hover:shadow-lg transition-all duration-300">
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama }}"
                                class="w-full object-cover no-context-menu"
                                draggable="false"
                                oncontextmenu="return false;"
                                ondragstart="return false;"
                                onselectstart="return false;"
                                onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                            <div class="product-card-content">
                                <h3 class="font-semibold text-gray-800 mb-2">{{ $item->nama }}</h3>
                                <div class="flex items-center justify-between">
                                    <p class="text-green-600 font-bold">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    <p class="text-gray-500">Stok: {{ $item->stok }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Tidak ada produk lain dari toko ini</p>
                    </div>
                    @endforelse
                </div>
                <div class="flex justify-center mt-4">
                    <button id="produk-prev" class="btn btn-outline mr-2 pagination-btn" onclick="prevSlide('produk')" aria-label="Previous slide" style="display: none;">←</button>
                    <div id="produk-pagination" class="flex space-x-1"></div>
                    <button id="produk-next" class="btn btn-outline pagination-btn" onclick="nextSlide('produk')" aria-label="Next slide" style="display: none;">→</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="w-full">
        @include('footer')
    </footer>
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
        // Set worker untuk PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
        document.addEventListener('DOMContentLoaded', () => {
            const noContextElements = document.querySelectorAll('.no-context-menu');
            noContextElements.forEach(element => {
                element.addEventListener('contextmenu', (e) => e.preventDefault());
                element.addEventListener('dragstart', (e) => e.preventDefault());
                element.addEventListener('selectstart', (e) => e.preventDefault());
            });
            document.addEventListener('contextmenu', (e) => {
                if (e.target.tagName === 'IMG' || e.target.tagName === 'OBJECT' || e.target.tagName === 'IFRAME') {
                    e.preventDefault();
                }
            });
            document.addEventListener('dragstart', (e) => {
                if (e.target.tagName === 'IMG' || e.target.tagName === 'OBJECT' || e.target.tagName === 'IFRAME') {
                    e.preventDefault();
                }
            });
            document.addEventListener('selectstart', (e) => {
                if (e.target.tagName === 'IMG' || e.target.tagName === 'OBJECT' || e.target.tagName === 'IFRAME') {
                    e.preventDefault();
                }
            });
            // Inisialisasi carousel
            ['sertifikat', 'produk'].forEach(section => {
                const items = document.querySelectorAll(`#${section}-carousel .${section}-item`);
                if (items.length > 0) {
                    showSlide(section, 0);
                }
            });
            // Inisialisasi PDF.js untuk inline preview
            initializeInlinePdfs();
        });

        function initializeInlinePdfs() {
            const sertifikatItems = document.querySelectorAll('.sertifikat-item');
            sertifikatItems.forEach((item, index) => {
                const jsContainer = document.getElementById(`pdf-sertifikat-js-${index}`);
                if (jsContainer && !jsContainer.dataset.initialized) {
                    jsContainer.dataset.initialized = 'true';
                    const iframe = document.getElementById(`pdf-sertifikat-${index}`);
                    if (iframe) {
                        const pdfUrl = iframe.src.split('#')[0];
                        if (window.innerWidth <= 768) {
                            renderPdfWithJs(pdfUrl, `pdf-sertifikat-js-${index}`).then(success => {
                                if (success) {
                                    iframe.classList.add('hidden');
                                } else {
                                    jsContainer.classList.add('hidden');
                                    iframe.classList.remove('hidden');
                                }
                            });
                        } else {
                            jsContainer.classList.add('hidden');
                            iframe.classList.remove('hidden');
                        }
                    }
                }
            });
        }
        async function renderPdfWithJs(pdfUrl, containerId) {
            try {
                const container = document.getElementById(containerId);
                if (!container) return false;
                const loadingDiv = container.querySelector('.pdf-loading');
                if (loadingDiv) loadingDiv.style.display = 'flex';
                const pdf = await pdfjsLib.getDocument(pdfUrl).promise;
                const numPages = pdf.numPages;
                if (loadingDiv) loadingDiv.style.display = 'none';
                const canvases = container.querySelectorAll('.pdf-page-canvas');
                canvases.forEach(canvas => canvas.remove());
                for (let pageNum = 1; pageNum <= numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);
                    const containerWidth = container.clientWidth;
                    const containerHeight = container.clientHeight;
                    const viewport = page.getViewport({
                        scale: 1.0
                    });
                    const scaleX = containerWidth / viewport.width;
                    const scaleY = containerHeight / viewport.height;
                    const scale = Math.min(scaleX, scaleY, 1.5);
                    const scaledViewport = page.getViewport({
                        scale: scale
                    });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = scaledViewport.height;
                    canvas.width = scaledViewport.width;
                    canvas.className = 'pdf-page-canvas';
                    const renderContext = {
                        canvasContext: context,
                        viewport: scaledViewport
                    };
                    await page.render(renderContext).promise;
                    container.appendChild(canvas);
                }
                container.scrollTop = 0;
                return true;
            } catch (error) {
                console.error('Error rendering PDF with PDF.js:', error);
                return false;
            }
        }
        async function checkPdfLoad(iframe, type, index, pdfUrl) {
            setTimeout(async () => {
                try {
                    if (iframe.contentDocument && iframe.contentDocument.body) {
                        if (iframe.contentDocument.body.innerHTML.trim() === '') {
                            const jsContainer = document.getElementById(`pdf-${type}-js-${index}`);
                            if (jsContainer) {
                                jsContainer.classList.remove('hidden');
                                const success = await renderPdfWithJs(pdfUrl, `pdf-${type}-js-${index}`);
                                if (success) {
                                    iframe.style.display = 'none';
                                } else {
                                    jsContainer.classList.add('hidden');
                                    iframe.style.display = 'none';
                                    const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                                    if (objectTag) {
                                        objectTag.classList.remove('hidden');
                                        setTimeout(() => {
                                            try {
                                                document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                                objectTag.style.display = 'none';
                                            } catch (e) {
                                                document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                                objectTag.style.display = 'none';
                                            }
                                        }, 3000);
                                    } else {
                                        document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                        iframe.style.display = 'none';
                                    }
                                }
                            } else {
                                const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                                if (objectTag) {
                                    objectTag.classList.remove('hidden');
                                    iframe.style.display = 'none';
                                    setTimeout(() => {
                                        try {
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        } catch (e) {
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        }
                                    }, 3000);
                                } else {
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    iframe.style.display = 'none';
                                }
                            }
                        }
                    }
                } catch (e) {
                    const jsContainer = document.getElementById(`pdf-${type}-js-${index}`);
                    if (jsContainer) {
                        jsContainer.classList.remove('hidden');
                        renderPdfWithJs(pdfUrl, `pdf-${type}-js-${index}`).then(success => {
                            if (!success) {
                                jsContainer.classList.add('hidden');
                                iframe.style.display = 'none';
                                const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                                if (objectTag) {
                                    objectTag.classList.remove('hidden');
                                    setTimeout(() => {
                                        try {
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        } catch (e) {
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        }
                                    }, 3000);
                                } else {
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    iframe.style.display = 'none';
                                }
                            } else {
                                iframe.style.display = 'none';
                            }
                        });
                    } else {
                        const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                        if (objectTag) {
                            objectTag.classList.remove('hidden');
                            iframe.style.display = 'none';
                            setTimeout(() => {
                                try {
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    objectTag.style.display = 'none';
                                } catch (e) {
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    objectTag.style.display = 'none';
                                }
                            }, 3000);
                        } else {
                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                            iframe.style.display = 'none';
                        }
                    }
                }
            }, 3000);
        }
        async function checkModalPdfLoad() {
            const iframe = document.getElementById('previewPdf');
            const fallback = document.getElementById('previewPdfFallback');
            const objectTag = document.getElementById('previewPdfObject');
            const jsContainer = document.getElementById('pdfModalJsContainer');
            setTimeout(async () => {
                try {
                    if (iframe.contentDocument && iframe.contentDocument.body) {
                        if (iframe.contentDocument.body.innerHTML.trim() === '') {
                            jsContainer.classList.remove('hidden');
                            const pdfUrl = document.getElementById('previewPdfLink').href;
                            const success = await renderPdfWithJs(pdfUrl, 'pdfModalJsContainer');
                            if (success) {
                                iframe.style.display = 'none';
                            } else {
                                objectTag.classList.remove('hidden');
                                iframe.style.display = 'none';
                                jsContainer.classList.add('hidden');
                                setTimeout(() => {
                                    try {
                                        fallback.classList.remove('hidden');
                                        objectTag.style.display = 'none';
                                    } catch (e) {
                                        fallback.classList.remove('hidden');
                                        objectTag.style.display = 'none';
                                    }
                                }, 3000);
                            }
                        }
                    }
                } catch (e) {
                    jsContainer.classList.remove('hidden');
                    const pdfUrl = document.getElementById('previewPdfLink').href;
                    renderPdfWithJs(pdfUrl, 'pdfModalJsContainer').then(success => {
                        if (!success) {
                            objectTag.classList.remove('hidden');
                            iframe.style.display = 'none';
                            jsContainer.classList.add('hidden');
                            setTimeout(() => {
                                try {
                                    fallback.classList.remove('hidden');
                                    objectTag.style.display = 'none';
                                } catch (e) {
                                    fallback.classList.remove('hidden');
                                    objectTag.style.display = 'none';
                                }
                            }, 3000);
                        } else {
                            iframe.style.display = 'none';
                        }
                    });
                }
            }, 3000);
        }

        function openPreview(fileSrc, title, type = 'image', isKatalog = false) {
            const modal = document.getElementById('previewModal');
            const previewImage = document.getElementById('previewImage');
            const previewPdf = document.getElementById('previewPdf');
            const pdfModalContainer = document.getElementById('pdfModalContainer');
            const previewPdfFallback = document.getElementById('previewPdfFallback');
            const previewPdfObject = document.getElementById('previewPdfObject');
            const previewPdfLink = document.getElementById('previewPdfLink');
            const previewPdfLink2 = document.getElementById('previewPdfLink2');
            const jsContainer = document.getElementById('pdfModalJsContainer');
            const previewTitle = document.getElementById('previewTitle');
            const downloadLink = document.getElementById('downloadLink');
            previewTitle.textContent = title;
            if (isKatalog) {
                downloadLink.href = fileSrc;
                downloadLink.classList.remove('hidden');
            } else {
                downloadLink.classList.add('hidden');
            }
            const watermarks = [
                'imageWatermarkMobile',
                'imageWatermarkDesktop',
                'pdfWatermarkMobile',
                'pdfWatermarkDesktop'
            ];
            if (isKatalog) {
                watermarks.forEach(id => {
                    const wm = document.getElementById(id);
                    if (wm) wm.style.display = 'none';
                });
            } else {
                watermarks.forEach(id => {
                    const wm = document.getElementById(id);
                    if (wm) wm.style.display = 'block';
                });
            }
            if (type === 'pdf') {
                previewImage.classList.add('hidden');
                pdfModalContainer.classList.remove('hidden');
                previewPdfFallback.classList.add('hidden');
                previewPdfObject.classList.add('hidden');
                jsContainer.classList.add('hidden');
                previewPdfLink.href = fileSrc;
                previewPdfLink2.href = fileSrc;
                const canvasContainer = document.getElementById('pdfModalJsContainer');
                while (canvasContainer.firstChild) {
                    if (canvasContainer.firstChild.classList && canvasContainer.firstChild.classList.contains('pdf-loading')) {
                        break;
                    }
                    canvasContainer.removeChild(canvasContainer.firstChild);
                }
                if (window.innerWidth <= 768) {
                    jsContainer.classList.remove('hidden');
                    renderPdfWithJs(fileSrc, 'pdfModalJsContainer').then(success => {
                        if (success) {
                            previewPdf.style.display = 'none';
                        } else {
                            jsContainer.classList.add('hidden');
                            const pdfUrl = fileSrc + '#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH';
                            previewPdf.src = pdfUrl;
                            setTimeout(() => {
                                previewPdf.src = pdfUrl + '&cache=' + new Date().getTime();
                            }, 100);
                        }
                    });
                } else {
                    const pdfUrl = fileSrc + '#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH';
                    previewPdf.src = pdfUrl;
                    setTimeout(() => {
                        previewPdf.src = pdfUrl + '&cache=' + new Date().getTime();
                    }, 100);
                }
            } else {
                pdfModalContainer.classList.add('hidden');
                previewImage.classList.remove('hidden');
                previewImage.src = fileSrc;
            }
            modal.classList.remove('hidden');
            modal.focus();
        }

        function closePreview() {
            const modal = document.getElementById('previewModal');
            const downloadLink = document.getElementById('downloadLink');
            modal.classList.add('hidden');
            downloadLink.classList.add('hidden');
            const watermarks = [
                'imageWatermarkMobile',
                'imageWatermarkDesktop',
                'pdfWatermarkMobile',
                'pdfWatermarkDesktop'
            ];
            watermarks.forEach(id => {
                const wm = document.getElementById(id);
                if (wm) wm.style.display = 'block';
            });
        }

        function openTab(tab) {
            document.getElementById('content-deskripsi').classList.add('hidden');
            document.getElementById('content-sertifikat').classList.add('hidden');
            document.getElementById('content-' + tab).classList.remove('hidden');
            document.getElementById('tab-deskripsi').classList.remove('bg-[#0097D4]', 'text-white');
            document.getElementById('tab-deskripsi').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-sertifikat').classList.remove('bg-[#0097D4]', 'text-white');
            document.getElementById('tab-sertifikat').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-' + tab).classList.remove('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-' + tab).classList.add('bg-[#0097D4]', 'text-white');
            if (tab === 'sertifikat') {
                setTimeout(() => {
                    initializeInlinePdfs();
                }, 100);
            }
        }

        function toggleContactDropdown() {
            document.getElementById("contactDropdownMenu").classList.toggle("hidden");
        }
        document.addEventListener("click", function(event) {
            const dropdown = document.getElementById("contactDropdownMenu");
            const button = event.target.closest("button[onclick='toggleContactDropdown()']");
            if (!dropdown.contains(event.target) && !button) {
                dropdown.classList.add("hidden");
            }
        });
        // ========== PAGINATION SYSTEM DENGAN NOMOR HALAMAN ==========
        let sertifikatPage = 1;
        let produkPage = 1;

        function getItemsPerPage(idPrefix) {
            if (idPrefix === 'sertifikat') return 1;
            return window.innerWidth <= 767 ? 2 : 4;
        }

        function renderPagination(idPrefix) {
            const carousel = document.getElementById(`${idPrefix}-carousel`);
            const items = carousel.querySelectorAll(`.${idPrefix}-item`);
            const pagination = document.getElementById(`${idPrefix}-pagination`);
            const prevBtn = document.getElementById(`${idPrefix}-prev`);
            const nextBtn = document.getElementById(`${idPrefix}-next`);
            if (!pagination || items.length === 0) return;
            pagination.innerHTML = '';
            const total = items.length;
            const itemsPerPage = getItemsPerPage(idPrefix);
            const totalPages = Math.ceil(total / itemsPerPage);
            if (total <= itemsPerPage) {
                if (prevBtn) prevBtn.style.display = "none";
                if (nextBtn) nextBtn.style.display = "none";
                return;
            } else {
                if (prevBtn) prevBtn.style.display = "inline-block";
                if (nextBtn) nextBtn.style.display = "inline-block";
            }
            const current = getCurrentSlideIndex(idPrefix) + 1;
            const page = Math.ceil(current / itemsPerPage);
            if (idPrefix === 'sertifikat') sertifikatPage = page;
            else produkPage = page;
            const maxButtons = 3;
            let startPage, endPage;
            const groupSize = maxButtons;
            const currentGroup = Math.ceil(page / groupSize);
            startPage = (currentGroup - 1) * groupSize + 1;
            endPage = Math.min(startPage + groupSize - 1, totalPages);
            if (startPage > 3 && currentGroup > 2) {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = "px-2";
                pagination.appendChild(dots);
            }
            for (let p = startPage; p <= endPage; p++) {
                const btn = document.createElement('button');
                btn.textContent = p;
                btn.className = `pagination-btn ${p === page ? 'active' : ''}`;
                btn.onclick = () => {
                    const slideIndex = (p - 1) * itemsPerPage;
                    showSlide(idPrefix, slideIndex);
                };
                pagination.appendChild(btn);
            }
            if (endPage < totalPages) {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = "px-2";
                pagination.appendChild(dots);
            }
            updateNavigationButtons(idPrefix, current, total, itemsPerPage);
        }

        function updateNavigationButtons(idPrefix, current, total, itemsPerPage) {
            const prevBtn = document.getElementById(`${idPrefix}-prev`);
            const nextBtn = document.getElementById(`${idPrefix}-next`);
            if (prevBtn) {
                const isFirstPage = current <= itemsPerPage;
                prevBtn.disabled = isFirstPage;
                prevBtn.classList.toggle('opacity-50', isFirstPage);
                prevBtn.classList.toggle('cursor-not-allowed', isFirstPage);
            }
            if (nextBtn) {
                const isLastPage = current + itemsPerPage - 1 >= total;
                nextBtn.disabled = isLastPage;
                nextBtn.classList.toggle('opacity-50', isLastPage);
                nextBtn.classList.toggle('cursor-not-allowed', isLastPage);
            }
        }

        function nextSlide(idPrefix) {
            const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);
            let current = getCurrentSlideIndex(idPrefix);
            const itemsPerPage = getItemsPerPage(idPrefix);
            if (current < items.length - itemsPerPage) {
                showSlide(idPrefix, current + itemsPerPage);
            }
            const prevBtn = document.getElementById(`${idPrefix}-prev`);
            if (prevBtn && current + itemsPerPage > 0) {
                prevBtn.disabled = false;
                prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        function prevSlide(idPrefix) {
            let current = getCurrentSlideIndex(idPrefix);
            const itemsPerPage = getItemsPerPage(idPrefix);
            if (current >= itemsPerPage) {
                showSlide(idPrefix, current - itemsPerPage);
            }
            const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);
            const nextBtn = document.getElementById(`${idPrefix}-next`);
            if (nextBtn && current - itemsPerPage < items.length - itemsPerPage) {
                nextBtn.disabled = false;
                nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        function showSlide(idPrefix, index) {
            const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);
            if (items.length === 0) return;
            if (index >= items.length) index = Math.max(0, items.length - getItemsPerPage(idPrefix));
            if (index < 0) index = 0;
            const itemsPerPage = getItemsPerPage(idPrefix);
            const batchStart = Math.floor(index / itemsPerPage) * itemsPerPage;
            items.forEach((item, i) => {
                const isInBatch = i >= batchStart && i < batchStart + itemsPerPage;
                item.classList.toggle('hidden', !isInBatch);
            });
            renderPagination(idPrefix);
            if (idPrefix === 'sertifikat') {
                setTimeout(() => {
                    initializeInlinePdfs();
                }, 100);
            }
        }

        function getCurrentSlideIndex(idPrefix) {
            const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);
            for (let i = 0; i < items.length; i++) {
                if (!items[i].classList.contains('hidden')) {
                    return i;
                }
            }
            return 0;
        }
        // Swipe functionality for mobile
        function handleSwipe(startX, endX, idPrefix) {
            const threshold = 50;
            const diff = startX - endX;
            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    nextSlide(idPrefix);
                } else {
                    prevSlide(idPrefix);
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const produkCarousel = document.getElementById('produk-carousel');
            let startX = 0;
            let endX = 0;
            if (produkCarousel) {
                produkCarousel.addEventListener('touchstart', (e) => {
                    startX = e.changedTouches[0].screenX;
                });
                produkCarousel.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].screenX;
                    handleSwipe(startX, endX, 'produk');
                });
            }
            window.addEventListener('resize', function() {
                showSlide('sertifikat', getCurrentSlideIndex('sertifikat'));
                showSlide('produk', getCurrentSlideIndex('produk'));
                initializeInlinePdfs();
            });
        });
    </script>
</body>

</html>