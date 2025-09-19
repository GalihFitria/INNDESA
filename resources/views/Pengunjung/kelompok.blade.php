
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - {{ $kelompok->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- PERBAIKAN: Tambahkan PDF.js library untuk rendering PDF di mobile -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <style>
        .hero-subtitle {
            text-shadow: 1px 1px 0px #ffffff, -1px -1px 0px #ffffff, 1px -1px 0px #ffffff, -1px 1px 0px #ffffff;
            -webkit-text-stroke: 0.5px #ffffff;
        }

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

        .dot {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            margin: 0 0.25rem;
            cursor: pointer;
        }

        /* Watermark styling */
        .watermark {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Disable right-click, drag, and selection for images and PDFs */
        .no-context-menu {
            pointer-events: auto;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        /* Pagination button style */
        .pagination-btn {
            @apply px-3 py-1 border border-gray-300 rounded-md text-sm font-medium transition-colors cursor-pointer;
        }

        .pagination-btn.active {
            @apply bg-blue-600 text-white border-blue-600;
        }

        .pagination-btn:not(.active) {
            @apply bg-white text-gray-700 hover:bg-gray-50;
        }

        .pagination-dots {
            @apply px-2 text-sm text-gray-500;
        }

        /* PERBAIKAN: Styling khusus untuk PDF iframe di inline preview dan modal untuk mobile */
        .pdf-preview-iframe {
            border: none;
            background: white;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* PERBAIKAN: Tambahkan object-fit seperti gambar */
        }

        .pdf-preview-iframe::-webkit-scrollbar {
            width: 6px;
        }

        .pdf-preview-iframe::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .pdf-preview-iframe::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        /* PERBAIKAN: Container untuk PDF dengan fallback - SAMAKAN DENGAN GAMBAR */
        .pdf-container {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: #f9fafb;
            border-radius: 0.5rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            /* PERBAIKAN: Tambahkan tinggi yang sama dengan container gambar */
            height: 12rem;
        }

        @media (min-width: 768px) {
            .pdf-container {
                height: 15rem;
            }
        }

        .pdf-fallback {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
            z-index: 10;
        }

        /* PERBAIKAN: Canvas untuk PDF.js rendering - UBAH justify-content ke flex-start untuk memulai dari atas */
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
            /* PERBAIKAN: Ubah dari center ke flex-start agar scroll mulai dari halaman pertama */
        }

        .pdf-page-canvas {
            max-width: 100%;
            max-height: 100%;
            height: auto;
            object-fit: contain;
            /* PERBAIKAN: Tambahkan object-fit seperti gambar */
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

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .hero-logo {
                position: static !important;
                margin-bottom: 1rem;
            }

            .hero-title {
                font-size: 2rem !important;
                line-height: 1.2;
                margin-top: 1rem;
            }

            .tab-buttons {
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }

            .tab-buttons::-webkit-scrollbar {
                display: none;
            }

            .tab-buttons button {
                flex: 0 0 auto;
                min-width: 80px;
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
                text-align: center;
                white-space: nowrap;
            }


            .mobile-table {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .mobile-table table {
                min-width: 100%;
                white-space: nowrap;
            }

            /* Product grid mobile - PERBAIKAN: Pastikan 2 kolom berjajar */
            .product-grid-mobile {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem;
                width: 100%;
                display: grid;
            }

            .product-card-mobile {
                width: 100% !important;
                min-height: 240px !important;
                padding: 0.5rem !important;
                display: flex;
                flex-direction: column;
            }

            .product-card-mobile img {
                height: 120px !important;
                object-fit: cover;
            }

            .product-card-mobile h3 {
                font-size: 0.875rem !important;
                margin-top: 0.5rem !important;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .product-card-mobile .price-stock {
                font-size: 0.75rem !important;
                display: flex;
                justify-content: space-between;
                margin-top: auto;
            }

            /* Kegiatan grid mobile - PERBAIKAN: Ubah menjadi 2 kolom berjajar */
            .kegiatan-grid-mobile {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem;
                width: 100%;
                display: grid;
            }

            .kegiatan-card-mobile {
                min-height: 280px !important;
                width: 100% !important;
                display: flex;
                flex-direction: column;
            }

            .kegiatan-card-mobile .kegiatan-image {
                height: 140px !important;
            }

            .kegiatan-card-mobile img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .kegiatan-card-mobile .p-3 {
                padding: 0.5rem !important;
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .kegiatan-card-mobile h3 {
                font-size: 0.75rem !important;
                line-height: 1.2;
                margin-bottom: 0.5rem;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .kegiatan-card-mobile .text-xs {
                font-size: 0.625rem !important;
            }

            .kegiatan-card-mobile .text-sm {
                font-size: 0.625rem !important;
            }

            /* Control buttons mobile - PERBAIKAN: Buat 4 elemen berjajar */
            .controls-mobile {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                gap: 0.25rem !important;
                align-items: center !important;
                justify-content: space-between !important;
                overflow-x: auto !important;
                padding-bottom: 0.25rem !important;
                margin-bottom: 0.5rem !important;
            }

            .controls-mobile>div {
                display: flex !important;
                flex-direction: row !important;
                gap: 0.25rem !important;
                align-items: center !important;
                flex-shrink: 0 !important;
            }

            .controls-mobile>div:first-child {
                flex: 1 !important;
                justify-content: flex-start !important;
                margin-right: 0.5rem !important;
            }

            .controls-mobile>div:last-child {
                flex: 1 !important;
                justify-content: flex-end !important;
            }

            .controls-mobile input {
                width: 100px !important;
                min-width: 100px !important;
                flex-shrink: 0 !important;
            }

            /* PERBAIKAN: Perkecil ukuran teks untuk kontrol mobile */
            .controls-mobile .text-green-600 {
                font-size: 0.625rem !important;
                white-space: nowrap !important;
                flex-shrink: 0 !important;
            }

            .controls-mobile a {
                font-size: 0.625rem !important;
                white-space: nowrap !important;
                flex-shrink: 0 !important;
            }

            .controls-mobile span {
                font-size: 0.625rem !important;
                white-space: nowrap !important;
                flex-shrink: 0 !important;
            }

            .controls-mobile input {
                font-size: 0.625rem !important;
                padding: 0.25rem 0.5rem !important;
            }

            /* PERBAIKAN: Modal mobile - Kurangi tinggi modal untuk mobile */
            .modal-mobile {
                width: 95% !important;
                height: 85vh !important;
                /* Diubah dari 95vh menjadi 85vh */
                margin: 7.5vh auto;
                /* Disesuaikan dengan tinggi baru */
            }

            .modal-content-mobile {
                height: 70vh !important;
                /* Diubah dari 80vh menjadi 70vh */
                max-height: 70vh !important;
            }

            /* PERBAIKAN: Khusus untuk iframe PDF di mobile - pastikan height full dan overflow auto */
            #previewPdf {
                height: 70vh !important;
                /* Diubah dari 80vh menjadi 70vh */
                max-height: 70vh !important;
                overflow: auto !important;
                -webkit-overflow-scrolling: touch;
            }

            /* PERBAIKAN: Styling untuk inline PDF preview di mobile */
            .sk-desa-item iframe,
            .inovasi-item iframe {
                width: 100% !important;
                height: 100% !important;
                border: none !important;
                overflow: auto !important;
                -webkit-overflow-scrolling: touch;
            }

            /* PERBAIKAN: Tambahkan styling untuk container PDF - SAMAKAN DENGAN GAMBAR */
            .pdf-container {
                width: 100% !important;
                height: 12rem !important;
                /* Sama dengan h-48 */
                position: relative;
            }

            /* PERBAIKAN: Watermark khusus untuk PDF di mobile - kurangi jumlah dan ukuran */
            .pdf-watermark-mobile .grid {
                grid-template-columns: repeat(6, 1fr) !important;
                /* Kurangi dari 8 menjadi 6 */
            }

            .pdf-watermark-mobile span {
                font-size: 6px !important;
                /* Kurangi dari 8px menjadi 6px */
                opacity: 8% !important;
                /* Kurangi opacity dari 10% menjadi 8% */
            }

            /* Pagination mobile */
            .pagination-mobile {
                flex-wrap: wrap;
                gap: 0.25rem;
            }

            .pagination-mobile button {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
                min-width: 32px;
            }

            /* Image preview mobile - PERBAIKAN: Samakan ukuran dengan PDF */
            .preview-container-mobile {
                max-width: 100%;
                height: 12rem !important;
                /* h-48 = 12rem */
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* PERBAIKAN: Gambar di modal preview mobile - tambahkan object-fit */
            #previewImage {
                object-fit: contain !important;
                /* Tambahkan ini agar gambar tidak ketarik */
                max-width: 100%;
                max-height: 100%;
            }

            @media (min-width: 768px) {
                .preview-container-mobile {
                    height: 15rem !important;
                    /* md:h-60 = 15rem */
                }
            }

            /* Contact info mobile */
            .contact-info-mobile {
                flex-direction: row;
                align-items: center;
                gap: 0.25rem;
                flex-wrap: nowrap;
            }

            .contact-info-mobile>div {
                justify-content: flex-start;
                gap: 0.25rem;
            }

            /* Spacing adjustments */
            .section-padding-mobile {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .content-container-mobile {
                max-width: none;
                margin: 0;
                padding: 1rem;
                width: 100%;
            }
        }

        @media (max-width: 480px) {

            /* Extra small screens */
            .hero-title {
                font-size: 1.5rem !important;
            }

            .tab-buttons button {
                font-size: 0.6rem;
                padding: 0.4rem 0.2rem;
            }

            /* PERBAIKAN: Tetap 2 kolom bahkan di layar sangat kecil */
            .product-grid-mobile {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.5rem;
            }

            .product-card-mobile {
                width: 100% !important;
                min-height: 220px !important;
                padding: 0.4rem !important;
            }

            .product-card-mobile img {
                height: 100px !important;
            }

            .product-card-mobile h3 {
                font-size: 0.75rem !important;
            }

            .product-card-mobile .price-stock {
                font-size: 0.625rem !important;
            }

            /* PERBAIKAN: Tetap 2 kolom bahkan di layar sangat kecil */
            .kegiatan-grid-mobile {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.6rem;
                /* jarak antar card sedikit lega */
            }

            .kegiatan-card-mobile {
                min-height: 200px !important;
                /* lebih pendek */
                max-width: 180px !important;
                /* agak lebih lebar */
                margin: 0 auto;
                /* ketengah */
            }

            .kegiatan-card-mobile .kegiatan-image {
                height: 90px !important;
                /* gambar lebih rendah */
            }

            /* Judul */
            .kegiatan-card-mobile h3 {
                font-size: 0.8rem !important;
                /* 13px */
                line-height: 1.1rem !important;
            }

            /* Tanggal */
            .kegiatan-card-mobile .text-xs {
                font-size: 0.7rem !important;
                /* 11px */
            }

            /* "Baca selengkapnya" */
            .kegiatan-card-mobile .text-sm {
                font-size: 0.75rem !important;
                /* 12px */
            }

            /* PERBAIKAN: Kontrol mobile untuk layar sangat kecil */
            .controls-mobile {
                flex-wrap: wrap !important;
                gap: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }

            .controls-mobile>div {
                flex-direction: row;
                justify-content: space-between;
                gap: 0.5rem;
                width: 100% !important;
            }

            .controls-mobile>div:first-child {
                margin-right: 0 !important;
            }

            .controls-mobile input {
                width: 100% !important;
                min-width: auto !important;
            }

            /* PERBAIKAN: Untuk extra small screens, sesuaikan height PDF lebih lagi */
            #previewPdf {
                height: 65vh !important;
                /* Diubah dari 75vh menjadi 65vh */
            }

            /* PERBAIKAN: Inline PDF di extra small screens */
            .sk-desa-item iframe,
            .inovasi-item iframe {
                min-height: 250px !important;
            }

            /* PERBAIKAN: Sesuaikan ukuran PDF container di layar sangat kecil */
            .pdf-container {
                height: 10rem !important;
            }

            /* PERBAIKAN: Modal untuk layar sangat kecil */
            .modal-mobile {
                height: 80vh !important;
                /* Diubah dari 85vh menjadi 80vh */
                margin: 10vh auto;
            }

            .modal-content-mobile {
                height: 65vh !important;
                /* Diubah dari 70vh menjadi 65vh */
                max-height: 65vh !important;
            }
        }

        /* PERBAIKAN: Tambahkan styling khusus untuk desktop agar PDF sama dengan gambar */
        @media (min-width: 768px) {
            .preview-container-mobile {
                max-width: 30rem;
                height: 15rem;
            }

            .pdf-container {
                max-width: 30rem;
                height: 15rem;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">
    @include('navbar')

    <section class="relative text-white overflow-hidden 
    min-h-[300px] sm:min-h-[350px] md:min-h-[550px] 
    flex flex-col justify-start md:justify-center
    pt-12 sm:pt-16 md:pt-0
    {{ $kelompok->background 
        ? 'bg-[url(\'' . asset('storage/' . $kelompok->background) . '\')] 
           bg-contain bg-top md:bg-cover md:bg-center bg-no-repeat' 
        : 'bg-gray-800' }}">

        <!-- LOGO -->
        <div class="hero-logo flex items-center justify-start pl-4 -mt-6 sm:mt-6 md:mt-0 md:absolute md:top-12 md:left-16">


            @if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo))
            <img
                src="{{ asset('storage/' . $kelompok->logo) }}"
                alt="Logo {{ $kelompok->getKodeKelompokAttribute() }}"
                class="h-12 sm:h-14 md:h-20 lg:h-24 w-auto 
                       max-h-16 sm:max-h-20 md:max-h-28 lg:max-h-32 
                       object-contain no-context-menu"
                draggable="false"
                oncontextmenu="return false;"
                ondragstart="return false;"
                onselectstart="return false;"
                onerror="this.src='{{ asset('images/fallback-logo.png') }}'">
            @else
            <img
                src="{{ asset('images/fallback-logo.png') }}"
                alt="Default Logo"
                class="h-12 sm:h-14 md:h-20 lg:h-24 w-auto 
                       max-h-16 sm:max-h-20 md:max-h-28 lg:max-h-32 
                       object-contain no-context-menu"
                draggable="false"
                oncontextmenu="return false;"
                ondragstart="return false;"
                onselectstart="return false;">
            @endif
        </div>

        <!-- JUDUL -->
        <div class="text-center md:text-center absolute top-10 left-1/2 -translate-x-1/2 md:static md:transform-none md:mt-0 px-4">
            <h2 class="hero-title text-xl sm:text-3xl md:text-5xl lg:text-7xl font-bold text-[#0097D4]">
                Kelompok {{ $kelompok->nama }}
            </h2>
        </div>
    </section>

    <h2 class="text-2xl md:text-4xl font-bold text-blue-600 text-center mb-6 md:mb-8 mt-6 md:mt-10 px-4">Profil Kelompok</h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border section-padding-mobile">
        <div class="bg-white p-3 md:p-6 content-container-mobile md:max-w-4xl md:mx-auto">
            <div class="tab-buttons flex rounded-lg overflow-x-auto bg-gray-200 whitespace-nowrap">
                <button class="profile-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white text-xs md:text-base" onclick="openTab('struktur', 'profile')" aria-label="Lihat Struktur">Struktur</button>
                <button class="profile-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700 text-xs md:text-base" onclick="openTab('sejarah', 'profile')" aria-label="Lihat Sejarah">Sejarah</button>
                <button class="profile-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700 text-xs md:text-base" onclick="openTab('sk-desa', 'profile')" aria-label="Lihat SK Desa">SK Desa</button>
                <button class="profile-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700 text-xs md:text-base" onclick="openTab('kelompok-rentan', 'profile')" aria-label="Lihat Kelompok Rentan">Kelompok Rentan</button>
                <button class="profile-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700 text-xs md:text-base" onclick="openTab('total-produk', 'profile')" aria-label="Lihat Total Produk">Stok Produk</button>
            </div>

            <!-- STRUKTUR -->
            <div id="struktur" class="profile-tab-content block py-4">
                <div class="mobile-table overflow-x-auto">
                    <table class="w-full border-collapse mb-6 border border-gray-200 text-xs md:text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-left font-semibold text-xs md:text-base">
                                    Posisi
                                </th>
                                <th class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-left font-semibold text-xs md:text-base">
                                    Nama
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($struktur->where('jabatan', '!=', 'Anggota') as $item)
                            <tr>
                                <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-xs md:text-base">
                                    {{ $item->jabatan }}
                                </td>
                                <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-xs md:text-base">
                                    {{ $item->nama }}
                                </td>
                            </tr>
                            @endforeach

                            @php
                            $anggota = $struktur->where('jabatan', 'Anggota');
                            @endphp

                            @if($anggota->count())
                            <tr>
                                <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-xs md:text-base align-top">
                                    Anggota
                                </td>
                                <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2">
                                    <ul class="list-disc pl-4">
                                        @foreach($anggota as $a)
                                        <li class="text-xs md:text-base">{{ $a->nama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endif

                            @if($struktur->count() == 0)
                            <tr>
                                <td colspan="2" class="text-center p-3 md:p-4 text-gray-500 text-xs md:text-base">
                                    Tidak ada data struktur organisasi
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- SEJARAH -->
            <div id="sejarah" class="profile-tab-content hidden py-4">
                <div class="prose prose-xs md:prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
                    @foreach (explode("\n", $kelompok->sejarah ?? 'Belum ada data sejarah untuk kelompok ini.') as $paragraph)
                    @if (!empty(trim($paragraph)))
                    <p class="mb-3 md:mb-4 indent-2 md:indent-8 text-xs md:text-base leading-snug md:leading-relaxed">
                        {{ $paragraph }}
                    </p>
                    @endif
                    @endforeach
                </div>
            </div>


            <!-- SK DESA -->
            <div id="sk-desa" class="profile-tab-content hidden py-4">
                <div class="relative">
                    @if ($kelompok && $kelompok->sk_desa)
                    @php
                    $skDesaItems = is_array($kelompok->sk_desa) ? $kelompok->sk_desa : [$kelompok->sk_desa];
                    @endphp

                    <div id="sk-desa-carousel" class="carousel">
                        @foreach ($skDesaItems as $index => $skDesa)
                        @php
                        $extension = pathinfo($skDesa, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                        @endphp

                        <!-- IMAGE -->
                        @if ($isImage)
                        <div class="preview-container-mobile relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto {{ $index === 0 ? 'block' : 'hidden' }} sk-desa-item" data-index="{{ $index }}">
                            <div class="relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">
                                <img
                                    src="{{ asset('storage/' . $skDesa) }}"
                                    alt="SK Desa {{ $kelompok->getKodeKelompokAttribute() }}"
                                    class="w-full h-full object-contain cursor-pointer no-context-menu"
                                    draggable="false"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;"
                                    onclick="openPreview('{{ asset('storage/' . $skDesa) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}', 'image', false)"
                                    onerror="this.src='{{ asset('images/placeholder.jpg') }}'">

                                {{-- ✅ Watermark mobile --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                    <div class="grid grid-cols-4 w-full h-full">
                                        @for ($i = 0; $i < 40; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                {{-- ✅ Watermark desktop --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PDF -->
                        @else
                        <div class="preview-container-mobile relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto {{ $index === 0 ? 'block' : 'hidden' }} sk-desa-item" data-index="{{ $index }}">
                            <div class="pdf-container relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">

                                <div id="pdf-sk-desa-js-{{ $index }}" class="pdf-canvas-container w-full h-full">
                                    <div class="pdf-loading">
                                        <div class="pdf-loading-spinner"></div>
                                        <p>Memuat PDF...</p>
                                    </div>
                                </div>

                                <iframe
                                    id="pdf-sk-desa-{{ $index }}"
                                    src="{{ asset('storage/' . $skDesa) }}#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH"
                                    class="w-full h-full rounded-lg pdf-preview-iframe no-context-menu hidden"
                                    title="SK Desa {{ $kelompok->getKodeKelompokAttribute() }}"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;"
                                    onload="this.contentWindow.focus(); checkPdfLoad(this, 'sk-desa', '{{ $index }}', '{{ asset('storage/' . $skDesa) }}');">
                                </iframe>

                                <object
                                    id="pdf-sk-desa-object-{{ $index }}"
                                    data="{{ asset('storage/' . $skDesa) }}#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH"
                                    type="application/pdf"
                                    class="w-full h-full rounded-lg pdf-preview-iframe no-context-menu hidden"
                                    title="SK Desa {{ $kelompok->getKodeKelompokAttribute() }}">
                                    <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                    <a href="{{ asset('storage/' . $skDesa) }}" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                        Buka PDF di Tab Baru
                                    </a>
                                </object>

                                {{-- Fallback link --}}
                                <div id="pdf-sk-desa-fallback-{{ $index }}" class="pdf-fallback hidden">
                                    <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                    <a href="{{ asset('storage/' . $skDesa) }}" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                        Buka PDF di Tab Baru
                                    </a>
                                </div>

                                {{-- ✅ Watermark mobile (rapat seperti desktop) --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>


                                {{-- ✅ Watermark desktop --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                {{-- Overlay klik PDF --}}
                                <div class="absolute inset-0 cursor-pointer no-context-menu"
                                    onclick="openPreview('{{ asset('storage/' . $skDesa) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}', 'pdf', false)"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;">
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if(count($skDesaItems) > 1)
                    <div class="pagination-mobile flex justify-center mt-4">
                        <button id="sk-desa-prev" class="btn btn-outline mr-2" onclick="prevSlide('sk-desa')" aria-label="Previous slide">←</button>
                        <div id="sk-desa-pagination" class="flex space-x-1"></div>
                        <button id="sk-desa-next" class="btn btn-outline" onclick="nextSlide('sk-desa')" aria-label="Next slide">→</button>
                    </div>
                    @endif
                    @else
                    <p class="text-center text-gray-500 text-sm md:text-base">Tidak ada data SK Desa yang tersedia.</p>
                    @endif
                </div>
            </div>


            <!-- KELOMPOK RENTAN -->
            <div id="kelompok-rentan" class="profile-tab-content hidden py-4">
                @if ($rentanCategories->isNotEmpty())
                <div class="mobile-table overflow-x-auto">
                    <table class="w-full border-collapse mb-4 border border-gray-200 text-[10px] md:text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                @foreach ($rentanCategories as $category)
                                <th class="border border-gray-200 px-1 py-0.5 md:px-3 md:py-2 text-left font-semibold text-[10px] md:text-base">
                                    {{ $category }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $maxRows = max(array_map(function($category) use ($rentanGrouped) {
                            return isset($rentanGrouped[$category]) ? $rentanGrouped[$category]->count() : 0;
                            }, $rentanCategories->toArray()));
                            @endphp

                            @for ($i = 0; $i < $maxRows; $i++)
                                <tr>
                                @foreach ($rentanCategories as $category)
                                <td class="border border-gray-200 px-1 py-0.5 md:px-3 md:py-2 text-[10px] md:text-base">
                                    @if (isset($rentanGrouped[$category]) && isset($rentanGrouped[$category][$i]))
                                    {{ $rentanGrouped[$category][$i]->nama_anggota }}
                                    @else
                                    &nbsp;
                                    @endif
                                </td>
                                @endforeach
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
                @else
                <table class="w-full border-collapse mb-4 border border-gray-200">
                    <tbody>
                        <tr>
                            <td class="text-center p-2 md:p-4 text-gray-500 text-[10px] md:text-base" colspan="{{ $rentanCategories->count() ?: 1 }}">
                                Tidak ada data kelompok rentan yang tersedia.
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>

            <!-- STOK PRODUK -->
            <div id="total-produk" class="profile-tab-content hidden py-4">
                @if ($produk->isNotEmpty())
                <div class="mobile-table overflow-x-auto">
                    <table class="w-full border-collapse mt-4 border border-gray-200 text-[10px] md:text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-200 px-1 py-0.5 md:px-3 md:py-2 text-left font-semibold text-[10px] md:text-base">
                                    Nama Produk
                                </th>
                                <th class="border border-gray-200 px-1 py-0.5 md:px-3 md:py-2 text-left font-semibold text-[10px] md:text-base">
                                    Stok Produk
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                            <tr>
                                <td class="border border-gray-200 px-1 py-0.5 md:px-3 md:py-2 text-[10px] md:text-base">
                                    {{ $item->nama }}
                                </td>
                                <td class="border border-gray-200 px-1 py-0.5 md:px-3 md:py-2 text-[10px] md:text-base">
                                    {{ $item->stok }} pcs
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-center text-gray-500 text-[10px] md:text-base">
                    Tidak ada data produk yang tersedia.
                </p>
                @endif
            </div>

        </div>
    </div>

    <!-- INFORMASI -->
    <h2 class="text-2xl md:text-4xl font-bold text-blue-600 text-center mb-6 md:mb-8 px-4">Informasi</h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border section-padding-mobile">
        <div class="bg-white p-3 md:p-6 content-container-mobile md:max-w-4xl md:mx-auto">
            <div class="tab-buttons flex rounded-lg overflow-hidden bg-gray-200">
                <button class="info-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white text-xs md:text-base" onclick="openTab('produk', 'info')" aria-label="Lihat Produk">Produk</button>
                <button class="info-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700 text-xs md:text-base" onclick="openTab('kegiatan', 'info')" aria-label="Lihat Kegiatan">Kegiatan</button>
                <button class="info-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700 text-xs md:text-base" onclick="openTab('inovasi', 'info')" aria-label="Lihat Inovasi & Penghargaan">Inovasi & Penghargaan</button>
            </div>

            <div id="produk" class="info-tab-content block py-4">
                <!-- TOTAL PRODUK TERJUAL, KONTAK, KATALOG -->
                <!-- Mobile layout -->
                <div class="controls-mobile flex flex-wrap items-center justify-between mb-4 md:hidden">
                    <!-- Produk Terjual -->
                    <div class="text-green-600 font-medium text-sm mr-3">
                        Total Produk Terjual: {{ $totalProdukTerjual }}
                    </div>

                    <!-- Kontak -->
                    <a href="https://wa.me/6289647038212?text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                        rel="noopener noreferrer"
                        class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium text-sm mr-3"
                        aria-label="Kontak via WhatsApp">
                        <span>Kontak</span>
                    </a>

                    <!-- Katalog - PERBAIKAN: Ganti href ke onclick untuk preview -->
                    @if($katalog && $katalog->katalog)
                    <a onclick="openKatalogPreview('{{ asset('storage/' . $katalog->katalog) }}', 'Katalog {{ $kelompok->nama }}')"
                        class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium text-sm mr-3 cursor-pointer"
                        aria-label="Lihat Katalog">
                        Katalog
                    </a>
                    @else
                    <span class="text-gray-500 text-sm mr-3">Katalog tidak tersedia</span>
                    @endif

                    <!-- Input Pencarian -->
                    <input type="text" id="searchProduk" placeholder="Cari Produk..."
                        class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500 
               text-sm w-full mt-2"
                        aria-label="Cari Produk">
                </div>

                <!-- Desktop layout -->
                <div class="controls-desktop hidden md:flex md:flex-nowrap items-center justify-between mb-4">
                    <div class="contact-info-desktop flex items-center gap-x-6">
                        <div class="text-green-600 font-medium text-base">
                            Total Produk Terjual: {{ $totalProdukTerjual }}
                        </div>
                        <a href="https://wa.me/6289647038212?text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                            rel="noopener noreferrer"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium text-base"
                            aria-label="Kontak via WhatsApp">
                            <span>Kontak</span>
                        </a>
                    </div>

                    <div class="flex flex-row items-center gap-x-4">
                        <!-- Katalog - PERBAIKAN: Ganti href ke onclick untuk preview -->
                        @if($katalog && $katalog->katalog)
                        <a onclick="openKatalogPreview('{{ asset('storage/' . $katalog->katalog) }}', 'Katalog {{ $kelompok->nama }}')"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium text-base cursor-pointer"
                            aria-label="Lihat Katalog">
                            Katalog
                        </a>
                        @else
                        <span class="text-gray-500 text-base">Katalog tidak tersedia</span>
                        @endif

                        <!-- Input pencarian desktop -->
                        <input type="text" id="searchProdukDesktop" placeholder="Cari Produk..."
                            class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500 text-base w-auto ml-2"
                            aria-label="Cari Produk">
                    </div>
                </div>

                <!-- PRODUK -->
                <div class="relative">
                    <div id="produk-carousel" class="product-grid-mobile carousel grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4">
                        @foreach ($produk as $item)
                        <a href="{{ route('detail_produk.show', $item->id_produk) }}" class="block no-underline produk-item" data-nama="{{ strtolower($item->nama) }}">
                            <div class="product-card-mobile border rounded-lg shadow-md p-2 md:p-3 w-full min-h-[240px] md:min-h-[280px] mx-auto cursor-pointer">
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    class="w-full h-32 md:h-40 object-cover rounded-lg no-context-menu"
                                    draggable="false"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;"
                                    onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                <h3 class="mt-2 md:mt-3 font-semibold text-sm md:text-lg truncate">{{ $item->nama }}</h3>
                                <div class="price-stock flex items-center justify-between pb-2">
                                    <p class="text-green-600 font-bold text-sm md:text-lg truncate">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    <p class="text-black-500 text-xs md:text-sm truncate">Stok: {{ $item->stok }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <p id="produk-no-results" class="text-center text-gray-500 hidden mt-4 text-sm md:text-base">Tidak ada produk yang ditemukan.</p>
                    @if($produk->count() > 4)
                    <div class="pagination-mobile flex justify-center mt-4">
                        <button id="produk-prev" class="btn btn-outline mr-2" onclick="prevSlide('produk')" aria-label="Previous slide">←</button>
                        <div id="produk-pagination" class="flex space-x-1"></div>
                        <button id="produk-next" class="btn btn-outline" onclick="nextSlide('produk')" aria-label="Next slide">→</button>
                    </div>
                    @endif
                </div>
            </div>

            <div id="kegiatan" class="info-tab-content hidden py-4">
                <div class="flex items-center justify-end mb-4">
                    <input type="text" id="searchKegiatan" placeholder="Cari Kegiatan..."
                        class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500 text-sm w-full md:w-auto"
                        aria-label="Cari Kegiatan">
                </div>

                <!-- KEGIATAN -->
                <div class="relative">
                    <div id="kegiatan-carousel"
                        class="kegiatan-grid-mobile grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4 items-stretch">
                        @if ($kegiatan->isNotEmpty())
                        @foreach ($kegiatan as $item)
                        <a href="{{ route('update_kegiatan.show', $item->id_kegiatan) }}" class="block no-underline kegiatan-item h-full" data-judul="{{ strtolower($item->judul) }}">
                            <div class="kegiatan-card-mobile bg-white text-black border rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow min-h-[280px] md:min-h-[320px] h-full cursor-pointer flex flex-col">
                                <!-- Gambar -->
                                <div class="kegiatan-image h-36 md:h-40">
                                    @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover rounded-t-lg no-context-menu"
                                        draggable="false"
                                        oncontextmenu="return false;"
                                        ondragstart="return false;"
                                        onselectstart="return false;"
                                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    @else
                                    <img src="{{ asset('images/placeholder.jpg') }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover rounded-t-lg no-context-menu"
                                        draggable="false"
                                        oncontextmenu="return false;"
                                        ondragstart="return false;"
                                        onselectstart="return false;">
                                    @endif
                                </div>
                                <div class="p-3 md:p-4 flex flex-col justify-between flex-1">
                                    <h3 class="font-bold text-sm md:text-sm mb-2 leading-tight">
                                        {{ $item->judul }}
                                    </h3>
                                    <div>
                                        <p class="text-xs opacity-75 truncate">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}
                                        </p>
                                        <span class="text-blue-600 hover:underline text-sm">
                                            Baca Selengkapnya
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                        <p class="text-center text-gray-500 text-sm md:text-base">Tidak ada kegiatan yang tersedia.</p>
                        @endif
                    </div>
                    <p id="kegiatan-no-results" class="text-center text-gray-500 hidden mt-4 text-sm md:text-base">Tidak ada kegiatan yang ditemukan.</p>
                    @if($kegiatan->count() > 4)
                    <div class="pagination-mobile flex justify-center mt-4">
                        <button id="kegiatan-prev" class="btn btn-outline mr-2" onclick="prevSlide('kegiatan')" aria-label="Previous slide">←</button>
                        <div id="kegiatan-pagination" class="flex space-x-1"></div>
                        <button id="kegiatan-next" class="btn btn-outline" onclick="nextSlide('kegiatan')" aria-label="Next slide">→</button>
                    </div>
                    @endif
                </div>
            </div>

            <!-- INOVASI -->
            <div id="inovasi" class="info-tab-content hidden py-4">
                <div class="relative">
                    @if ($inovasiImages->isNotEmpty())
                    <div id="inovasi-carousel" class="carousel">
                        @foreach ($inovasiImages as $index => $inovasi)
                        @php
                        $extension = pathinfo($inovasi->foto, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                        @endphp

                        {{-- ========== IMAGE ========== --}}
                        @if ($isImage)
                        <div class="preview-container-mobile relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto {{ $index === 0 ? 'block' : 'hidden' }} inovasi-item" data-index="{{ $index }}">
                            <div class="relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">
                                <img
                                    src="{{ asset('storage/' . $inovasi->foto) }}"
                                    alt="Inovasi {{ $inovasi->getKodeInovasiAttribute() }}"
                                    class="w-full h-full object-contain cursor-pointer no-context-menu"
                                    draggable="false"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;"
                                    onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}', 'image', false)"
                                    onerror="this.src='{{ asset('images/placeholder.jpg') }}'">

                                {{-- ✅ Watermark mobile (rapat seperti SK Desa) --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                {{-- ✅ Watermark desktop --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ========== PDF ========== --}}
                        @else
                        <div class="preview-container-mobile relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto {{ $index === 0 ? 'block' : 'hidden' }} inovasi-item" data-index="{{ $index }}">
                            <div class="pdf-container relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">

                                {{-- PDF.js container --}}
                                <div id="pdf-inovasi-js-{{ $index }}" class="pdf-canvas-container w-full h-full">
                                    <div class="pdf-loading">
                                        <div class="pdf-loading-spinner"></div>
                                        <p>Memuat PDF...</p>
                                    </div>
                                </div>

                                {{-- Fallback iframe --}}
                                <iframe
                                    id="pdf-inovasi-{{ $index }}"
                                    src="{{ asset('storage/' . $inovasi->foto) }}#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH"
                                    class="w-full h-full rounded-lg pdf-preview-iframe no-context-menu hidden"
                                    title="Inovasi {{ $inovasi->getKodeInovasiAttribute() }}"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;"
                                    onload="this.contentWindow.focus(); checkPdfLoad(this, 'inovasi', '{{ $index }}', '{{ asset('storage/' . $inovasi->foto) }}');">
                                </iframe>

                                {{-- Fallback object --}}
                                <object
                                    id="pdf-inovasi-object-{{ $index }}"
                                    data="{{ asset('storage/' . $inovasi->foto) }}#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH"
                                    type="application/pdf"
                                    class="w-full h-full rounded-lg pdf-preview-iframe no-context-menu hidden"
                                    title="Inovasi {{ $inovasi->getKodeInovasiAttribute() }}">
                                    <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                    <a href="{{ asset('storage/' . $inovasi->foto) }}" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                        Buka PDF di Tab Baru
                                    </a>
                                </object>

                                {{-- Fallback link --}}
                                <div id="pdf-inovasi-fallback-{{ $index }}" class="pdf-fallback hidden">
                                    <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                                    <a href="{{ asset('storage/' . $inovasi->foto) }}" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                        Buka PDF di Tab Baru
                                    </a>
                                </div>

                                {{-- ✅ Watermark mobile (rapat seperti SK Desa) --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                {{-- ✅ Watermark desktop --}}
                                <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                {{-- Overlay klik PDF --}}
                                <div class="absolute inset-0 cursor-pointer no-context-menu"
                                    onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}', 'pdf', false)"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;">
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if($inovasiImages->count() > 1)
                    <div class="pagination-mobile flex justify-center mt-4">
                        <button id="inovasi-prev" class="btn btn-outline mr-2" onclick="prevSlide('inovasi')" aria-label="Previous slide">←</button>
                        <div id="inovasi-pagination" class="flex space-x-1"></div>
                        <button id="inovasi-next" class="btn btn-outline" onclick="nextSlide('inovasi')" aria-label="Next slide">→</button>
                    </div>
                    @endif
                    @else
                    <p class="text-center text-gray-500 text-sm md:text-base">Tidak ada data inovasi atau penghargaan yang tersedia.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL openPreview - PERBAIKAN: Tambahkan class modal-content-mobile ke iframe untuk konsistensi height -->
    <div id="previewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="modal-mobile bg-white p-3 md:p-4 rounded-lg w-11/12 md:w-11/12 h-5/6 relative">

            <!-- Tombol Download - PERBAIKAN: Pindah ke bawah, hanya untuk katalog -->
            <a id="downloadLink" href="#" download class="absolute bottom-4 left-4 bg-green-500 text-white px-3 py-2 rounded text-sm font-medium hover:bg-green-600 transition hidden" aria-label="Download file">
                Download
            </a>

            <!-- Tombol Close (✕) -->
            <button onclick="closePreview()"
                class="absolute top-2 right-2 bg-red-500 text-white px-2 md:px-3 py-1 rounded text-sm md:text-base hover:bg-red-600 transition">
                ✕
            </button>

            <h2 id="previewTitle" class="text-base md:text-lg font-bold mb-3 md:mb-4"></h2>

            <img id="previewImage" class="modal-content-mobile max-h-[70%] md:max-h-[80%] mx-auto hidden no-context-menu"
                alt="Preview"
                draggable="false"
                oncontextmenu="return false;"
                ondragstart="return false;"
                onselectstart="return false;">

            <!-- Container PDF -->
            <div id="pdfModalContainer" class="w-full h-[70%] md:h-[80%] modal-content-mobile hidden">
                <!-- PDF.js -->
                <div id="pdfModalJsContainer" class="pdf-canvas-container hidden">
                    <div class="pdf-loading">
                        <div class="pdf-loading-spinner"></div>
                        <p>Memuat PDF...</p>
                    </div>
                </div>
                <!-- iframe fallback -->
                <iframe id="previewPdf" class="w-full h-full no-context-menu pdf-preview-iframe" frameborder="0"
                    oncontextmenu="return false;"
                    onload="this.contentWindow.focus(); checkModalPdfLoad();">
                </iframe>
                <!-- object fallback -->
                <object id="previewPdfObject" class="w-full h-full no-context-menu pdf-preview-iframe hidden" type="application/pdf">
                    <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                    <a id="previewPdfLink" href="#" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Buka PDF di Tab Baru
                    </a>
                </object>
                <!-- fallback terakhir -->
                <div id="previewPdfFallback" class="pdf-fallback hidden">
                    <p class="text-sm md:text-base text-gray-700 mb-3">PDF tidak dapat ditampilkan di browser ini.</p>
                    <a id="previewPdfLink2" href="#" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Buka PDF di Tab Baru
                    </a>
                </div>
            </div>

            <!-- Watermark IMAGE Mobile -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden" id="imageWatermarkMobile">
                <div class="grid grid-cols-4 w-full h-full">
                    @for ($i = 0; $i < 40; $i++)
                        <span class="flex items-center justify-center text-gray-800 text-[14px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                        INNDESA
                        </span>
                        @endfor
                </div>
            </div>
            <!-- Watermark IMAGE Desktop -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block" id="imageWatermarkDesktop">
                <div class="grid grid-cols-8 md:grid-cols-12 w-full h-full">
                    @for ($i = 0; $i < 150; $i++)
                        <span class="flex items-center justify-center text-gray-800 text-[20px] md:text-[40px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                        INNDESA
                        </span>
                        @endfor
                </div>
            </div>

            <!-- Watermark PDF Mobile -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden" id="pdfWatermarkMobile">
                <div class="grid grid-cols-4 w-full h-full">
                    @for ($i = 0; $i < 40; $i++)
                        <span class="flex items-center justify-center text-gray-800 text-[14px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                        INNDESA
                        </span>
                        @endfor
                </div>
            </div>
            <!-- Watermark PDF Desktop -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block" id="pdfWatermarkDesktop">
                <div class="grid grid-cols-8 md:grid-cols-12 w-full h-full">
                    @for ($i = 0; $i < 150; $i++)
                        <span class="flex items-center justify-center text-gray-800 text-[20px] md:text-[40px] font-bold opacity-10 -rotate-45 whitespace-nowrap">
                        INNDESA
                        </span>
                        @endfor
                </div>
            </div>

        </div>
    </div>


    @include('footer')

    <script>
        // PERBAIKAN: Set worker untuk PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

        // PENCARIAN
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi carousel
            ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => initializeCarousel(section));

            // Fungsi debounce untuk mencegah pencarian berulang
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Fungsi pencarian umum
            function searchItems(section, searchInputId, itemClass, dataAttr, noResultsId) {
                const searchInput = document.getElementById(searchInputId);
                const noResults = document.getElementById(noResultsId);

                if (searchInput) {
                    const searchHandler = debounce(function() {
                        const searchTerm = searchInput.value.toLowerCase().trim();
                        const items = document.querySelectorAll(`.${itemClass}`);
                        let hasResults = false;

                        items.forEach(item => {
                            const itemText = item.getAttribute(dataAttr);
                            if (itemText && itemText.includes(searchTerm)) {
                                item.style.display = 'block';
                                hasResults = true;
                            } else {
                                item.style.display = 'none';
                            }
                        });

                        // Tampilkan pesan jika tidak ada hasil
                        noResults.classList.toggle('hidden', hasResults || searchTerm === '');

                        // FIX: Reset pagination
                        if (searchTerm === '') {
                            initializeCarousel(section); // semua item balik → hitung ulang per page
                        } else {
                            showSlide(section, 0); // pencarian aktif → mulai dari page 1
                        }

                    }, 300);

                    searchInput.addEventListener('input', searchHandler);
                }
            }


            // Inisialisasi pencarian untuk produk dan kegiatan
            searchItems('produk', 'searchProduk', 'produk-item', 'data-nama', 'produk-no-results');
            searchItems('kegiatan', 'searchKegiatan', 'kegiatan-item', 'data-judul', 'kegiatan-no-results');

            // Disable right-click, drag, and selection for images and PDFs
            const noContextElements = document.querySelectorAll('.no-context-menu');
            noContextElements.forEach(element => {
                element.addEventListener('contextmenu', (e) => e.preventDefault());
                element.addEventListener('dragstart', (e) => e.preventDefault());
                element.addEventListener('selectstart', (e) => e.preventDefault());
            });

            // Global protection for all images and PDFs
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

            // PERBAIKAN: Inisialisasi PDF.js untuk inline preview saat halaman dimuat
            initializeInlinePdfs();
        });

        function openTab(tabId, tabType) {
            const tabClass = tabType === 'profile' ? 'profile-tab-content' : 'info-tab-content';
            const buttonClass = tabType === 'profile' ? 'profile-tab-button' : 'info-tab-button';
            const tabs = document.querySelectorAll(`.${tabClass}`);
            const buttons = document.querySelectorAll(`.${buttonClass}`);

            tabs.forEach(tab => {
                tab.classList.add('hidden');
                tab.classList.remove('block');
            });
            buttons.forEach(button => {
                button.classList.remove('bg-[#0097D4]', 'text-white');
                button.classList.add('bg-gray-200', 'text-gray-700');
                if (button.getAttribute('onclick').includes(tabId)) {
                    button.classList.add('bg-[#0097D4]', 'text-white');
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                }
            });
            const activeTab = document.getElementById(tabId);
            activeTab.classList.remove('hidden');
            activeTab.classList.add('block');

            // PERBAIKAN: Inisialisasi PDF.js untuk tab yang aktif
            if (tabId === 'sk-desa' || tabId === 'inovasi') {
                setTimeout(() => {
                    initializeInlinePdfs();
                }, 100);
            }
        }

        // PERBAIKAN: Fungsi untuk inisialisasi PDF.js untuk inline preview
        function initializeInlinePdfs() {
            // Cek untuk SK Desa
            const skDesaItems = document.querySelectorAll('.sk-desa-item');
            skDesaItems.forEach((item, index) => {
                const jsContainer = document.getElementById(`pdf-sk-desa-js-${index}`);
                if (jsContainer && !jsContainer.dataset.initialized) {
                    jsContainer.dataset.initialized = 'true';

                    // Dapatkan URL PDF dari iframe
                    const iframe = document.getElementById(`pdf-sk-desa-${index}`);
                    if (iframe) {
                        const pdfUrl = iframe.src.split('#')[0]; // Hapus parameter URL

                        // Coba render dengan PDF.js untuk mobile
                        if (window.innerWidth <= 768) {
                            renderPdfWithJs(pdfUrl, `pdf-sk-desa-js-${index}`).then(success => {
                                if (success) {
                                    iframe.classList.add('hidden');
                                } else {
                                    // Jika PDF.js gagal, tampilkan iframe
                                    jsContainer.classList.add('hidden');
                                    iframe.classList.remove('hidden');
                                }
                            });
                        } else {
                            // Untuk desktop, sembunyikan PDF.js dan tampilkan iframe
                            jsContainer.classList.add('hidden');
                            iframe.classList.remove('hidden');
                        }
                    }
                }
            });

            // Cek untuk Inovasi
            const inovasiItems = document.querySelectorAll('.inovasi-item');
            inovasiItems.forEach((item, index) => {
                const jsContainer = document.getElementById(`pdf-inovasi-js-${index}`);
                if (jsContainer && !jsContainer.dataset.initialized) {
                    jsContainer.dataset.initialized = 'true';

                    // Dapatkan URL PDF dari iframe
                    const iframe = document.getElementById(`pdf-inovasi-${index}`);
                    if (iframe) {
                        const pdfUrl = iframe.src.split('#')[0]; // Hapus parameter URL

                        // Coba render dengan PDF.js untuk mobile
                        if (window.innerWidth <= 768) {
                            renderPdfWithJs(pdfUrl, `pdf-inovasi-js-${index}`).then(success => {
                                if (success) {
                                    iframe.classList.add('hidden');
                                } else {
                                    // Jika PDF.js gagal, tampilkan iframe
                                    jsContainer.classList.add('hidden');
                                    iframe.classList.remove('hidden');
                                }
                            });
                        } else {
                            // Untuk desktop, sembunyikan PDF.js dan tampilkan iframe
                            jsContainer.classList.add('hidden');
                            iframe.classList.remove('hidden');
                        }
                    }
                }
            });
        }

        // PERBAIKAN: Fungsi untuk render PDF dengan PDF.js - TAMBAHKAN scrollTop = 0 setelah render selesai
        async function renderPdfWithJs(pdfUrl, containerId) {
            try {
                const container = document.getElementById(containerId);
                if (!container) return false;

                const loadingDiv = container.querySelector('.pdf-loading');

                // Show loading
                if (loadingDiv) {
                    loadingDiv.style.display = 'flex';
                }

                // Load PDF
                const pdf = await pdfjsLib.getDocument(pdfUrl).promise;
                const numPages = pdf.numPages;

                // Clear loading
                if (loadingDiv) {
                    loadingDiv.style.display = 'none';
                }

                // Hapus canvas yang ada (kecuali loading)
                const canvases = container.querySelectorAll('.pdf-page-canvas');
                canvases.forEach(canvas => canvas.remove());

                // Render each page
                for (let pageNum = 1; pageNum <= numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);

                    // PERBAIKAN: Hitung skala yang sesuai dengan container
                    const containerWidth = container.clientWidth;
                    const containerHeight = container.clientHeight;
                    const viewport = page.getViewport({
                        scale: 1.0
                    });

                    // Hitung skala agar PDF muat dalam container
                    const scaleX = containerWidth / viewport.width;
                    const scaleY = containerHeight / viewport.height;
                    const scale = Math.min(scaleX, scaleY, 1.5); // Batas maksimal skala 1.5

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

                // PERBAIKAN: Set scroll position ke atas setelah render selesai
                container.scrollTop = 0;

                return true;
            } catch (error) {
                console.error('Error rendering PDF with PDF.js:', error);
                return false;
            }
        }

        // PERBAIKAN: Fungsi untuk mengecek apakah PDF berhasil dimuat
        async function checkPdfLoad(iframe, type, index, pdfUrl) {
            // Tunggu beberapa saat untuk memastikan PDF telah dimuat
            setTimeout(async () => {
                try {
                    // Coba akses konten iframe
                    if (iframe.contentDocument && iframe.contentDocument.body) {
                        // Jika body kosong, PDF gagal dimuat
                        if (iframe.contentDocument.body.innerHTML.trim() === '') {
                            // Coba dengan PDF.js
                            const jsContainer = document.getElementById(`pdf-${type}-js-${index}`);
                            if (jsContainer) {
                                jsContainer.classList.remove('hidden');

                                const success = await renderPdfWithJs(pdfUrl, `pdf-${type}-js-${index}`);

                                if (success) {
                                    iframe.style.display = 'none';
                                } else {
                                    // Jika PDF.js juga gagal, coba dengan object tag
                                    const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                                    if (objectTag) {
                                        objectTag.classList.remove('hidden');
                                        iframe.style.display = 'none';

                                        // Tunggu lagi untuk mengecek object tag
                                        setTimeout(() => {
                                            try {
                                                // Jika object juga gagal, tampilkan fallback
                                                document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                                objectTag.style.display = 'none';
                                            } catch (e) {
                                                document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                                objectTag.style.display = 'none';
                                            }
                                        }, 3000);
                                    } else {
                                        // Jika tidak ada object tag, langsung tampilkan fallback
                                        document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                        iframe.style.display = 'none';
                                    }
                                }
                            } else {
                                // Jika tidak ada container PDF.js, coba dengan object tag
                                const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                                if (objectTag) {
                                    objectTag.classList.remove('hidden');
                                    iframe.style.display = 'none';

                                    // Tunggu lagi untuk mengecek object tag
                                    setTimeout(() => {
                                        try {
                                            // Jika object juga gagal, tampilkan fallback
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        } catch (e) {
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        }
                                    }, 3000);
                                } else {
                                    // Jika tidak ada object tag, langsung tampilkan fallback
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    iframe.style.display = 'none';
                                }
                            }
                        }
                    }
                } catch (e) {
                    // Jika terjadi error (biasanya karena cross-origin), coba dengan PDF.js
                    const jsContainer = document.getElementById(`pdf-${type}-js-${index}`);
                    if (jsContainer) {
                        jsContainer.classList.remove('hidden');

                        renderPdfWithJs(pdfUrl, `pdf-${type}-js-${index}`).then(success => {
                            if (!success) {
                                // Jika PDF.js juga gagal, coba dengan object tag
                                const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                                if (objectTag) {
                                    objectTag.classList.remove('hidden');
                                    iframe.style.display = 'none';
                                    jsContainer.classList.add('hidden');

                                    // Tunggu lagi untuk mengecek object tag
                                    setTimeout(() => {
                                        try {
                                            // Jika object juga gagal, tampilkan fallback
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        } catch (e) {
                                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                            objectTag.style.display = 'none';
                                        }
                                    }, 3000);
                                } else {
                                    // Jika tidak ada object tag, langsung tampilkan fallback
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    iframe.style.display = 'none';
                                    jsContainer.classList.add('hidden');
                                }
                            } else {
                                iframe.style.display = 'none';
                            }
                        });
                    } else {
                        // Jika tidak ada container PDF.js, coba dengan object tag
                        const objectTag = document.getElementById(`pdf-${type}-object-${index}`);
                        if (objectTag) {
                            objectTag.classList.remove('hidden');
                            iframe.style.display = 'none';

                            // Tunggu lagi untuk mengecek object tag
                            setTimeout(() => {
                                try {
                                    // Jika object juga gagal, tampilkan fallback
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    objectTag.style.display = 'none';
                                } catch (e) {
                                    document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                                    objectTag.style.display = 'none';
                                }
                            }, 3000);
                        } else {
                            // Jika tidak ada object tag, langsung tampilkan fallback
                            document.getElementById(`pdf-${type}-fallback-${index}`).classList.remove('hidden');
                            iframe.style.display = 'none';
                        }
                    }
                }
            }, 3000); // Tunggu 3 detik
        }

        // PERBAIKAN: Fungsi untuk mengeck PDF di modal - TAMBAHKAN scrollTop = 0 setelah render
        async function checkModalPdfLoad() {
            const iframe = document.getElementById('previewPdf');
            const fallback = document.getElementById('previewPdfFallback');
            const objectTag = document.getElementById('previewPdfObject');
            const jsContainer = document.getElementById('pdfModalJsContainer');

            setTimeout(async () => {
                try {
                    if (iframe.contentDocument && iframe.contentDocument.body) {
                        if (iframe.contentDocument.body.innerHTML.trim() === '') {
                            // Coba dengan PDF.js
                            jsContainer.classList.remove('hidden');

                            const pdfUrl = document.getElementById('previewPdfLink').href;
                            const success = await renderPdfWithJs(pdfUrl, 'pdfModalJsContainer');

                            if (success) {
                                iframe.style.display = 'none';
                            } else {
                                // Jika PDF.js juga gagal, coba dengan object tag
                                objectTag.classList.remove('hidden');
                                iframe.style.display = 'none';
                                jsContainer.classList.add('hidden');

                                // Tunggu lagi untuk mengecek object tag
                                setTimeout(() => {
                                    try {
                                        // Jika object juga gagal, tampilkan fallback
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
                    // Jika terjadi error (biasanya karena cross-origin), coba dengan PDF.js
                    jsContainer.classList.remove('hidden');

                    const pdfUrl = document.getElementById('previewPdfLink').href;
                    renderPdfWithJs(pdfUrl, 'pdfModalJsContainer').then(success => {
                        if (!success) {
                            // Jika PDF.js juga gagal, coba dengan object tag
                            objectTag.classList.remove('hidden');
                            iframe.style.display = 'none';
                            jsContainer.classList.add('hidden');

                            // Tunggu lagi untuk mengecek object tag
                            setTimeout(() => {
                                try {
                                    // Jika object juga gagal, tampilkan fallback
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

        // PERBAIKAN: Update fungsi openPreview untuk menangani PDF dengan lebih baik - Tambahkan parameter isKatalog
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

            // PERBAIKAN: Set download link hanya untuk katalog
            if (isKatalog) {
                downloadLink.href = fileSrc;
                downloadLink.classList.remove('hidden');
            } else {
                downloadLink.classList.add('hidden');
            }

            // PERBAIKAN: Handle watermark berdasarkan isKatalog
            const watermarks = [
                'imageWatermarkMobile',
                'imageWatermarkDesktop',
                'pdfWatermarkMobile',
                'pdfWatermarkDesktop'
            ];
            if (isKatalog) {
                // Sembunyikan watermark untuk katalog
                watermarks.forEach(id => {
                    const wm = document.getElementById(id);
                    if (wm) wm.style.display = 'none';
                });
            } else {
                // Tampilkan watermark untuk yang lain
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

                // Simpan URL PDF untuk fallback
                previewPdfLink.href = fileSrc;
                previewPdfLink2.href = fileSrc;

                // Reset container untuk PDF.js
                const canvasContainer = document.getElementById('pdfModalJsContainer');
                while (canvasContainer.firstChild) {
                    if (canvasContainer.firstChild.classList && canvasContainer.firstChild.classList.contains('pdf-loading')) {
                        break;
                    }
                    canvasContainer.removeChild(canvasContainer.firstChild);
                }

                // PERBAIKAN: Coba langsung dengan PDF.js untuk mobile
                if (window.innerWidth <= 768) {
                    jsContainer.classList.remove('hidden');
                    renderPdfWithJs(fileSrc, 'pdfModalJsContainer').then(success => {
                        if (success) {
                            previewPdf.style.display = 'none';
                        } else {
                            // Jika PDF.js gagal, coba dengan iframe
                            jsContainer.classList.add('hidden');
                            const pdfUrl = fileSrc + '#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH';
                            previewPdf.src = pdfUrl;

                            // Force reload iframe untuk memastikan rendering di mobile
                            setTimeout(() => {
                                previewPdf.src = pdfUrl + '&cache=' + new Date().getTime();
                            }, 100);
                        }
                    });
                } else {
                    // Untuk desktop, gunakan iframe
                    const pdfUrl = fileSrc + '#toolbar=0&navpanes=0&statusbar=0&scrollbar=0&view=FitH';
                    previewPdf.src = pdfUrl;

                    // Force reload iframe untuk memastikan rendering
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

        // PERBAIKAN: Fungsi baru untuk preview katalog (tanpa watermark, dengan download)
        function openKatalogPreview(fileSrc, title) {
            const extension = fileSrc.split('.').pop().toLowerCase();
            const type = (extension === 'pdf') ? 'pdf' : 'image';
            openPreview(fileSrc, title, type, true); // isKatalog = true
        }

        function closePreview() {
            const modal = document.getElementById('previewModal');
            const downloadLink = document.getElementById('downloadLink');
            modal.classList.add('hidden');
            downloadLink.classList.add('hidden'); // Sembunyikan tombol download saat tutup
            // Reset watermark ke default (visible)
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

        // ========== PAGINATION SYSTEM DENGAN NOMOR HALAMAN ==========
        const carousels = {
            'sk-desa': {
                itemsPerPage: 1
            },
            'produk': {
                itemsPerPage: window.innerWidth <= 768 ? 4 : 8
            },
            'kegiatan': {
                itemsPerPage: window.innerWidth <= 768 ? 4 : 8 // PERBAIKAN: Sesuaikan dengan grid 2 kolom
            },
            'inovasi': {
                itemsPerPage: 1
            }
        };

        // Update items per page on window resize
        window.addEventListener('resize', () => {
            carousels['produk'].itemsPerPage = window.innerWidth <= 768 ? 4 : 8;
            carousels['kegiatan'].itemsPerPage = window.innerWidth <= 768 ? 4 : 8; // PERBAIKAN: Sesuaikan dengan grid 2 kolom

            // Re-initialize carousels with new settings
            ['produk', 'kegiatan'].forEach(section => {
                const items = document.querySelectorAll(`#${section}-carousel .${section}-item`);
                if (items.length > 0) {
                    showSlide(section, 0);
                }
            });

            // PERBAIKAN: Re-inisialisasi PDF.js saat ukuran layar berubah
            setTimeout(() => {
                initializeInlinePdfs();
            }, 100);
        });

        function initializeCarousel(section) {
            showSlide(section, 0); // Tampilkan slide pertama
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
            const itemsPerPage = carousels[idPrefix].itemsPerPage;
            const totalPages = Math.ceil(total / itemsPerPage);
            const current = getCurrentSlideIndex(idPrefix) + 1;
            const page = Math.ceil(current / itemsPerPage);
            const maxButtons = 3;

            // Jika total item <= itemsPerPage, sembunyikan pagination dan tombol prev/next
            if (total <= itemsPerPage) {
                if (prevBtn) prevBtn.style.display = "none";
                if (nextBtn) nextBtn.style.display = "none";
                return;
            } else {
                if (prevBtn) prevBtn.style.display = "inline-block";
                if (nextBtn) nextBtn.style.display = "inline-block";
            }

            let startPage, endPage;

            // Logika untuk menentukan rentang halaman yang ditampilkan
            if (totalPages <= maxButtons) {
                startPage = 1;
                endPage = totalPages;
            } else {
                const currentGroup = Math.ceil(page / maxButtons);
                startPage = (currentGroup - 1) * maxButtons + 1;
                endPage = Math.min(startPage + maxButtons - 1, totalPages);

                // Tambahkan elipsis di awal jika startPage > 1
                if (startPage > 1) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.className = 'px-2';
                    pagination.appendChild(dots);
                }
            }

            // Buat tombol untuk setiap halaman dalam rentang
            for (let p = startPage; p <= endPage; p++) {
                const btn = document.createElement('button');
                btn.textContent = p;
                btn.className = `px-2 md:px-3 py-1 border rounded text-xs md:text-sm ${p === page ? 'bg-blue-600 text-white' : 'bg-white'}`;
                btn.onclick = () => {
                    const slideIndex = (p - 1) * itemsPerPage;
                    showSlide(idPrefix, slideIndex);
                };
                pagination.appendChild(btn);
            }

            // Tambahkan elipsis di akhir jika endPage < totalPages
            if (endPage < totalPages) {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.className = 'px-2';
                pagination.appendChild(dots);
            }

            // Update status tombol navigasi
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
            const itemsPerPage = carousels[idPrefix].itemsPerPage;
            let current = getCurrentSlideIndex(idPrefix);

            // Calculate the next batch start index
            const nextBatchStart = Math.ceil((current + 1) / itemsPerPage) * itemsPerPage;

            if (nextBatchStart < items.length) {
                showSlide(idPrefix, nextBatchStart);
            } else {
                // Loop back to the first slide
                showSlide(idPrefix, 0);
            }
        }

        function prevSlide(idPrefix) {
            let current = getCurrentSlideIndex(idPrefix);

            if (current > 0) {
                showSlide(idPrefix, current - 1);
            } else {
                // Jika di halaman pertama, lompat ke slide terakhir
                const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);
                const itemsPerPage = carousels[idPrefix].itemsPerPage;
                const lastIndex = Math.floor((items.length - 1) / itemsPerPage) * itemsPerPage;
                showSlide(idPrefix, lastIndex);
            }
        }

        function showSlide(idPrefix, index) {
            const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);

            if (items.length === 0) return;
            if (index >= items.length) index = items.length - 1;
            if (index < 0) index = 0;

            const itemsPerPage = carousels[idPrefix].itemsPerPage;
            const batchStart = Math.floor(index / itemsPerPage) * itemsPerPage;

            items.forEach((item, i) => {
                const isInBatch = i >= batchStart && i < batchStart + itemsPerPage;
                item.classList.toggle('hidden', !isInBatch);
            });

            renderPagination(idPrefix);

            // PERBAIKAN: Inisialisasi PDF.js untuk slide yang aktif
            setTimeout(() => {
                initializeInlinePdfs();
            }, 100);
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

        // ========== INISIALISASI CAROUSEL ==========
        document.addEventListener('DOMContentLoaded', function() {
            ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => {
                const items = document.querySelectorAll(`#${section}-carousel .${section}-item`);
                if (items.length > 0) {
                    showSlide(section, 0); // Tampilkan slide pertama
                }
            });
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closePreview();
            if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => {
                    const nav = document.getElementById(`${section}-pagination`);
                    if (nav && !nav.classList.contains('hidden')) {
                        e.key === 'ArrowRight' ? nextSlide(section) : prevSlide(section);
                    }
                });
            }
        });

        document.querySelectorAll('.btn-outline').forEach(btn => {
            btn.setAttribute('tabindex', '0');
            btn.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') btn.click();
            });
        });
    </script>
</body>

</html>