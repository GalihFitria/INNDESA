<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- PDF.js library untuk rendering PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
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

        /* Styling khusus untuk PDF iframe */
        .pdf-preview-iframe {
            border: none;
            background: white;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
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

        /* Container untuk PDF dengan fallback */
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

        /* Canvas untuk PDF.js rendering */
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

        /* ================= SK DESA ================= */
        .sk-desa-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        /* Container untuk gambar */
        .sk-desa-image-container {
            position: relative;
            width: 100%;
            height: 500px;
            background: #f8fafc;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .sk-desa-image-container:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        }

        .sk-desa-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .sk-desa-image:hover {
            transform: scale(1.02);
        }

        /* Watermark untuk gambar */
        .sk-desa-watermark {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 2;
        }

        .watermark-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            width: 100%;
            height: 100%;
        }

        .watermark-text {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.08);
            transform: rotate(-45deg);
            white-space: nowrap;
            user-select: none;
        }

        /* Container untuk PDF */
        .sk-desa-pdf-container {
            position: relative;
            width: 100%;
            height: 500px;
            background: #ffffff;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .sk-desa-pdf-viewer {
            width: 100%;
            height: 100%;
            overflow-y: auto;
            background: #ffffff;
        }

        .sk-desa-pdf-viewer canvas {
            display: block;
            width: 100% !important;
            height: auto !important;
            margin: 0 auto 1rem auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        /* Overlay untuk PDF */
        .sk-desa-pdf-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.02);
            cursor: pointer;
            transition: background 0.2s ease;
            z-index: 1;
        }

        .sk-desa-pdf-overlay:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        /* Pesan kosong */
        .sk-desa-empty {
            max-width: 500px;
            margin: 3rem auto;
            padding: 3rem 2rem;
            text-align: center;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            color: #64748b;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #94a3b8;
        }

        .empty-text {
            font-size: 1.1rem;
            font-weight: 500;
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
        }

        .preview-pdf canvas {
            display: block;
            width: 100% !important;
            height: auto !important;
            margin: 0 auto 1rem auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .preview-watermark {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 5;
            overflow: hidden;
        }

        .preview-watermark .watermark-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            height: 100%;
        }

        .preview-watermark .watermark-text {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.05);
            transform: rotate(-45deg);
            white-space: nowrap;
            user-select: none;
        }

        /* Tambahkan class untuk navbar tetap terlihat saat modal aktif */
        body.modal-active {
            overflow: hidden;
        }

        body.modal-active .navbar {
            z-index: 10000;
        }

        /* Style untuk tombol download */
        #previewDownload {
            display: none;
            /* Sembunyikan secara default */
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #previewDownload.show {
            display: flex;
            /* Tampilkan hanya jika ada class show */
        }

        #previewDownload:hover {
            background-color: #2563eb;
        }

        #previewDownload i {
            font-size: 0.875rem;
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

        /* Responsive untuk modal */
        @media (max-width: 768px) {
            .preview-modal {
                padding: 0.5rem;
            }

            .preview-content {
                max-width: 95%;
                max-height: 75vh;
                /* Dikurangi dari 95vh menjadi 75vh */
            }

            .preview-header {
                padding: 0.75rem;
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
                height: calc(75vh - 60px);
                /* Disesuaikan dengan max-height */
            }

            .preview-watermark .watermark-text {
                font-size: 14px;
                color: rgba(0, 0, 0, 0.1);
                /* Lebih tebal untuk mobile */
            }

            #previewDownload {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }

            #previewDownload i {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .preview-modal {
                padding: 0.25rem;
            }

            .preview-content {
                max-width: 98%;
                max-height: 70vh;
                /* Lebih kecil untuk layar sangat kecil */
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
                height: calc(70vh - 50px);
                /* Disesuaikan dengan max-height */
            }

            .preview-watermark .watermark-text {
                font-size: 12px;
                color: rgba(0, 0, 0, 0.1);
                /* Lebih tebal lagi untuk layar sangat kecil */
            }

            /* Untuk PDF di layar sangat kecil */
            .preview-pdf {
                padding: 0.5rem;
            }

            .preview-pdf canvas {
                margin-bottom: 0.5rem;
            }
        }

        /* ================= RESPONSIVE ================= */
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

            /* Product grid mobile */
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

            /* Kegiatan grid mobile */
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

            /* Control buttons mobile */
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

            /* Perkecil ukuran teks untuk kontrol mobile */
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

            /* Modal mobile */
            .modal-mobile {
                width: 95% !important;
                height: 75vh !important;
                margin: 12.5vh auto;
            }

            .modal-content-mobile {
                height: 60vh !important;
                max-height: 60vh !important;
            }

            /* Khusus untuk iframe PDF di mobile */
            #previewPdf {
                height: 60vh !important;
                max-height: 60vh !important;
                overflow: auto !important;
                -webkit-overflow-scrolling: touch;
            }

            /* Styling untuk inline PDF preview di mobile */
            .sk-desa-item iframe,
            .inovasi-item iframe {
                width: 100% !important;
                height: 100% !important;
                border: none !important;
                overflow: auto !important;
                -webkit-overflow-scrolling: touch;
            }

            /* Tambahkan styling untuk container PDF */
            .pdf-container {
                width: 100% !important;
                height: 12rem !important;
                position: relative;
            }

            /* Watermark khusus untuk PDF di mobile */
            .pdf-watermark-mobile .grid {
                grid-template-columns: repeat(6, 1fr) !important;
            }

            .pdf-watermark-mobile span {
                font-size: 6px !important;
                opacity: 8% !important;
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

            /* Image preview mobile */
            .preview-container-mobile {
                max-width: 100%;
                height: 12rem !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Gambar di modal preview mobile */
            #previewImage {
                object-fit: contain !important;
                max-width: 100%;
                max-height: 100%;
            }

            @media (min-width: 768px) {
                .preview-container-mobile {
                    height: 15rem !important;
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

            /* SK DESA RESPONSIVE */
            .sk-desa-container {
                padding: 1.5rem 1rem;
                margin: 0 1rem;
            }

            .sk-desa-image-container,
            .sk-desa-pdf-container {
                height: 350px;
            }

            .sk-desa-empty {
                margin: 2rem 1rem;
                padding: 2rem 1.5rem;
            }

            .empty-icon {
                font-size: 2.5rem;
            }

            .empty-text {
                font-size: 1rem;
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

            /* Tetap 2 kolom bahkan di layar sangat kecil */
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

            /* Tetap 2 kolom bahkan di layar sangat kecil */
            .kegiatan-grid-mobile {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.6rem;
            }

            .kegiatan-card-mobile {
                min-height: 200px !important;
                max-width: 180px !important;
                margin: 0 auto;
            }

            .kegiatan-card-mobile .kegiatan-image {
                height: 90px !important;
            }

            .kegiatan-card-mobile h3 {
                font-size: 0.8rem !important;
                line-height: 1.1rem !important;
            }

            .kegiatan-card-mobile .text-xs {
                font-size: 0.7rem !important;
            }

            .kegiatan-card-mobile .text-sm {
                font-size: 0.75rem !important;
            }

            /* Kontrol mobile untuk layar sangat kecil */
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

            /* Untuk extra small screens, sesuaikan height PDF lebih lagi */
            #previewPdf {
                height: 55vh !important;
            }

            /* Inline PDF di extra small screens */
            .sk-desa-item iframe,
            .inovasi-item iframe {
                min-height: 250px !important;
            }

            /* Sesuaikan ukuran PDF container di layar sangat kecil */
            .pdf-container {
                height: 10rem !important;
            }

            /* Modal untuk layar sangat kecil */
            .modal-mobile {
                height: 70vh !important;
                margin: 15vh auto;
            }

            .modal-content-mobile {
                height: 55vh !important;
                max-height: 55vh !important;
            }

            /* SK DESA EXTRA SMALL */
            .sk-desa-image-container,
            .sk-desa-pdf-container {
                height: 280px;
            }

            .watermark-text {
                font-size: 12px;
            }

            .preview-watermark .watermark-text {
                font-size: 14px;
            }
        }

        /* Tambahkan styling khusus untuk desktop agar PDF sama dengan gambar */
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

        /* Tambahkan class untuk navbar tetap terlihat saat modal aktif */
        body.modal-active {
            overflow: hidden;
        }

        body.modal-active .navbar {
            z-index: 10000;
        }

        /* kembali ke atas */
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
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>
    @include('navbar')

    <section class="relative text-white overflow-hidden aspect-[16/9] md:aspect-auto md:min-h-[700px] flex flex-col justify-start md:justify-center pt-8 sm:pt-10 md:pt-0 
    {{ $kelompok->background 
        ? 'bg-[url(\'' . asset('storage/' . $kelompok->background) . '\')] bg-cover bg-center' 
        : 'bg-[url(\'' . asset('images/background_beranda_INNDESA.jpeg') . '\')] bg-cover bg-center' 
    }}">

        <!-- Overlay untuk mobile -->
        <div class="absolute top-0 left-0 right-0 z-0 md:hidden"
            style="background: rgba(0, 0, 0, 0.5); height: 0; padding-bottom: 56.25%;"></div>

        <!-- Overlay untuk desktop -->
        <div class="absolute inset-0 bg-black bg-opacity-50 z-0 hidden md:block"></div>

        <!-- LOGO -->
        <div class="hero-logo flex items-center justify-start pl-8 mt-[-10px] sm:mt-2 md:mt-0 md:absolute md:top-12 md:left-16 z-10">
            @if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo))
            <img
                src="{{ asset('storage/' . $kelompok->logo) }}"
                alt="Logo {{ $kelompok->getKodeKelompokAttribute() }}"
                class="h-10 sm:h-14 md:h-24 lg:h-28 w-auto
                   max-h-16 sm:max-h-20 md:max-h-32 lg:max-h-40
                   object-contain no-context-menu"
                draggable="false"
                oncontextmenu="return false;"
                ondragstart="return false;"
                onselectstart="return false;"
                onerror="this.src='{{ asset('images/fallback-logo.png') }}'">
            @else
            <img
                src="{{ asset('images/fallback-logo.png') }}"
                alt=""
                class="h-10 sm:h-14 md:h-24 lg:h-28 w-auto
                   max-h-16 sm:max-h-20 md:max-h-32 lg:max-h-40
                   object-contain no-context-menu"
                draggable="false"
                oncontextmenu="return false;"
                ondragstart="return false;"
                onselectstart="return false;">
            @endif
        </div>

        <!-- JUDUL -->
        <div class="text-center md:text-center relative z-10 px-4 mt-[-20px] md:mt-0">
            <h2 class="hero-title text-xl sm:text-3xl md:text-5xl lg:text-7xl font-bold text-white drop-shadow-[0_2px_6px_rgba(0,0,0,0.7)]">
                Kelompok <br><span class="text-yellow-400">{{ $kelompok->nama }}</span>
            </h2>
        </div>
    </section>

    <div class="relative z-10 px-4 mt-8 md:mt-0">
        <h2 class="text-2xl md:text-4xl font-bold text-blue-600 text-center mb-6 md:mb-8 mt-2 md:mt-10 px-4">Profil Kelompok</h2>
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
                                @php
                                // Pisahkan data non-anggota dan anggota
                                $nonAnggota = $struktur->where('jabatan', '!=', 'Anggota');
                                $anggota = $struktur->where('jabatan', 'Anggota');

                                // Kelompokkan non-anggota berdasarkan jabatan
                                $groupedNonAnggota = $nonAnggota->groupBy('jabatan');
                                @endphp

                                @foreach($groupedNonAnggota as $jabatan => $items)
                                <tr>
                                    <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-xs md:text-base">
                                        {{ $jabatan }}
                                    </td>
                                    <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-xs md:text-base">
                                        @if($items->count() > 1)
                                        <ol class="list-decimal pl-4">
                                            @foreach($items as $item)
                                            <li>{{ $item->nama }}</li>
                                            @endforeach
                                        </ol>
                                        @else
                                        {{ $items->first()->nama }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                @if($anggota->count())
                                <tr>
                                    <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-xs md:text-base align-top">
                                        Anggota
                                    </td>
                                    <td class="border border-gray-200 px-2 py-1 md:px-3 md:py-2">
                                        <ol class="list-decimal pl-4">
                                            @foreach($anggota as $a)
                                            <li class="text-xs md:text-base">{{ $a->nama }}</li>
                                            @endforeach
                                        </ol>
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

                                    <!-- Watermark mobile -->
                                    <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                        <div class="grid grid-cols-12 w-full h-full">
                                            @for ($i = 0; $i < 150; $i++)
                                                <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                                INNDESA
                                                </span>
                                                @endfor
                                        </div>
                                    </div>

                                    <!-- Watermark desktop -->
                                    <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                        <div class="grid grid-cols-12 w-full h-full">
                                            @for ($i = 0; $i < 150; $i++)
                                                <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                                INNDESA
                                                </span>
                                                @endfor
                                        </div>
                                    </div>

                                    <!-- Teks "Lihat File" -->
                                    <div class="preview-overlay-text" onclick="openPreview('{{ asset('storage/' . $skDesa) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}', 'image', false)">
                                        <i class="fas fa-eye"></i>
                                        <span>Lihat File</span>
                                    </div>
                                </div>
                            </div>
                            <!-- PDF -->
                            @else
                            <div class="preview-container-mobile relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto {{ $index === 0 ? 'block' : 'hidden' }} sk-desa-item" data-index="{{ $index }}">
                                <div class="pdf-container relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">
                                    <!-- PDF.js container -->
                                    <div id="pdf-sk-desa-js-{{ $index }}" class="pdf-canvas-container w-full h-full">
                                        <div class="pdf-loading">
                                            <div class="pdf-loading-spinner"></div>
                                            <p>Memuat PDF...</p>
                                        </div>
                                    </div>

                                    <!-- Fallback iframe -->
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

                                    <!-- Watermark mobile -->
                                    <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                        <div class="grid grid-cols-12 w-full h-full">
                                            @for ($i = 0; $i < 150; $i++)
                                                <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                                INNDESA
                                                </span>
                                                @endfor
                                        </div>
                                    </div>

                                    <!-- Watermark desktop -->
                                    <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                        <div class="grid grid-cols-12 w-full h-full">
                                            @for ($i = 0; $i < 150; $i++)
                                                <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                                INNDESA
                                                </span>
                                                @endfor
                                        </div>
                                    </div>

                                    <!-- Overlay klik PDF -->
                                    <div class="absolute inset-0 cursor-pointer no-context-menu"
                                        onclick="openPreview('{{ asset('storage/' . $skDesa) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}', 'pdf', false)"
                                        oncontextmenu="return false;"
                                        ondragstart="return false;"
                                        onselectstart="return false;">
                                    </div>

                                    <!-- Teks "Lihat File" -->
                                    <div class="preview-overlay-text" onclick="openPreview('{{ asset('storage/' . $skDesa) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}', 'pdf', false)">
                                        <i class="fas fa-eye"></i>
                                        <span>Lihat File</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if(count($skDesaItems) > 1)
                        <div class="pagination-mobile flex justify-center mt-4">
                            <button id="sk-desa-prev" class="btn btn-outline mr-2" onclick="prevSlide('sk-desa')" aria-label="Previous slide">←</button>
                            <div id="sk-desa-pagination" class="flex space-x-1"></div>
                            <button id="sk-desa-next" class="btn btn-outline" onclick="nextSlide('sk-desa')" aria-label="Next slide">→</button>
                        </div>
                        @endif
                        @else
                        <!-- Pesan jika belum ada SK Desa -->
                        <div class="sk-desa-empty max-w-500px mx-auto my-8 p-6 text-center bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg text-gray-500">
                            <div class="empty-icon text-4xl mb-3 text-gray-400">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <p class="empty-text text-lg font-medium">Belum ada SK Desa yang diunggah</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- KELOMPOK RENTAN -->
                <div id="kelompok-rentan" class="profile-tab-content hidden py-4">
                    @php
                    $hasRentan = $rentanCategories->isNotEmpty() && $rentanGrouped->flatten()->isNotEmpty();
                    @endphp

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
                                @if ($hasRentan)
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
                                        -
                                        @endif
                                    </td>
                                    @endforeach
                                    </tr>
                                    @endfor
                                    @else
                                    <tr>
                                        <td class="text-center p-2 md:p-4 text-gray-500 text-[10px] md:text-base"
                                            colspan="{{ $rentanCategories->count() ?: 1 }}">
                                            Tidak ada data kelompok rentan yang tersedia.
                                        </td>
                                    </tr>
                                    @endif
                            </tbody>
                        </table>
                    </div>
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
                                        {{ $item->stok }} {{ $item->satuan }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-center text-gray-500 text-[10px] md:text-base">
                        Tidak ada data stok produk yang tersedia.
                    </p>
                    @endif
                </div>
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
                <!-- <button class="info-tab-button flex-1 py-2 px-2 md:px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700 text-xs md:text-base" onclick="openTab('rekap', 'info')" aria-label="Lihat Rekap Produk Terjual">Rekap Penjualan Produk</button> -->
            </div>

            <!-- PRODUK -->
            <div id="produk" class="info-tab-content block py-4">
                <!-- TOTAL PRODUK TERJUAL, KONTAK, KATALOG -->
                <!-- Mobile layout -->
                <div class="controls-mobile flex flex-wrap items-center justify-between mb-4 md:hidden">
                    <!-- Produk Terjual -->
                    <div class="text-green-600 font-medium text-sm mr-3">
                        Total Produk Terjual: {{ $totalProdukTerjual }}
                    </div>
                    @php
                    $noWa = $informasiUser->no_telp ?? null;

                    if ($noWa) {
                    // Bersihkan biar cuma angka
                    $noWa = preg_replace('/[^0-9]/', '', $noWa);

                    // Kalau formatnya 08xxxx → ubah jadi 628xxxx
                    if (strpos($noWa, '0') === 0) {
                    $noWa = '62' . substr($noWa, 1);
                    }

                    $pesan = urlencode(
                    "Halo, saya tertarik dengan produk dari kelompok {$kelompok->nama}.\n".
                    "Saya sudah melihat katalog yang tersedia.\n".
                    "Boleh minta informasi lebih detail terkait harga dan cara pemesanan?\n
                    ".
                    "Terima kasih 🙏"
                    );
                    }
                    @endphp

                    @if ($noWa)
                    <a href="https://wa.me/{{ $noWa }}?text={{ $pesan }}"
                        rel="noopener noreferrer"
                        class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium text-sm mr-3"
                        aria-label="Kontak via WhatsApp">
                        <span>Kontak</span>
                    </a>
                    @else
                    <span class="text-gray-500 text-sm mr-3">Kontak tidak tersedia</span>
                    @endif

                    <!-- Katalog -->
                    @if($katalog && $katalog->katalog)
                    <a onclick="openKatalogPreview('{{ asset('storage/' . $katalog->katalog) }}', 'Katalog {{ $kelompok->nama }}')"
                        class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium text-sm mr-3 cursor-pointer"
                        aria-label="Lihat Katalog">
                        Katalog
                    </a>
                    @else
                    <span class="text-gray-500 text-sm mr-3">Katalog tidak tersedia</span>
                    @endif
                </div>

                <!-- Input Pencarian Mobile -->
                <div class="flex items-center justify-end mb-4 md:hidden">
                    <input type="text" id="searchProduk" placeholder="Cari Produk..."
                        class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500 text-sm w-full md:w-auto"
                        aria-label="Cari Produk">
                </div>

                <!-- Desktop layout -->
                <div class="controls-desktop hidden md:flex md:flex-nowrap items-center justify-between mb-4">
                    <div class="contact-info-desktop flex items-center gap-x-6">
                        <div class="text-green-600 font-medium text-base">
                            Total Produk Terjual: {{ $totalProdukTerjual }}
                        </div>
                        <!-- Kontak -->
                        @php
                        $noWa = $informasiUser->no_telp ?? null;

                        if ($noWa) {
                        // Bersihkan biar cuma angka
                        $noWa = preg_replace('/[^0-9]/', '', $noWa);

                        // Kalau formatnya 08xxxx → ubah jadi 628xxxx
                        if (strpos($noWa, '0') === 0) {
                        $noWa = '62' . substr($noWa, 1);
                        }

                        $pesan = urlencode(
                        "Halo, saya tertarik dengan produk dari kelompok {$kelompok->nama}.\n".
                        "Saya sudah melihat katalog yang tersedia.\n".
                        "Boleh minta informasi lebih detail terkait harga dan cara pemesanan?\n".
                        "Terima kasih"
                        );
                        }
                        @endphp

                        @if($noWa)
                        <a href="https://wa.me/{{ $noWa }}?text={{ $pesan }}"
                            rel="noopener noreferrer"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium text-sm mr-3"
                            aria-label="Kontak via WhatsApp">
                            <span>Kontak</span>
                        </a>
                        @else
                        <span class="text-gray-500 text-sm mr-3">Kontak tidak tersedia</span>
                        @endif
                    </div>
                    <div class="flex flex-row items-center gap-x-4">
                        <!-- Katalog -->
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
                    @if($produk->isNotEmpty())
                    <div id="produk-carousel" class="product-grid-mobile carousel grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4">
                        @foreach ($produk as $item)
                        <a href="{{ url('detail_produk/' . \App\Http\Controllers\DetailProdukController::createHashUrl($item->id_produk, $item->nama)) }}?from=kelompok"
                            class="block no-underline produk-item"
                            data-nama="{{ strtolower($item->nama) }}">
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

                    @if($produk->count() > 4)
                    <div class="pagination-mobile flex justify-center mt-4">
                        <button id="produk-prev" class="btn btn-outline mr-2" onclick="prevSlide('produk')" aria-label="Previous slide">←</button>
                        <div id="produk-pagination" class="flex space-x-1"></div>
                        <button id="produk-next" class="btn btn-outline" onclick="nextSlide('produk')" aria-label="Next slide">→</button>
                    </div>
                    @endif
                    @else
                    <p class="text-center text-gray-500 mt-4 text-sm md:text-base">
                        Tidak ada produk yang tersedia.
                    </p>
                    @endif

                    <!-- Pesan tidak ada hasil pencarian -->
                    <p id="produk-no-results" class="text-center text-gray-500 hidden mt-4 text-sm md:text-base">
                        Tidak ada produk yang ditemukan.
                    </p>
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
                    @if ($kegiatan->isNotEmpty())
                    <div id="kegiatan-carousel"
                        class="kegiatan-grid-mobile grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4 items-stretch">
                        @foreach ($kegiatan as $item)
                        <a href="{{ url('update_kegiatan/' . \App\Http\Controllers\Update_KegiatanController::createHashUrl($item->id_kegiatan, $item->judul)) }}?from=kelompok"
                            class="block no-underline kegiatan-item"
                            data-judul="{{ strtolower($item->judul) }}">
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
                                            {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                        </p>
                                        {{-- Tambahin deskripsi --}}
                                        <p class="text-xs md:text-sm text-gray-600 mt-2 line-clamp-3 md:line-clamp-2">
                                            {{ Str::limit($item->deskripsi, 120) }}
                                        </p>
                                        <span class="text-blue-600 hover:underline text-sm">
                                            Baca Selengkapnya
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </a>
                        @endforeach
                    </div>

                    @if($kegiatan->count() > 4)
                    <div class="pagination-mobile flex justify-center mt-4">
                        <button id="kegiatan-prev" class="btn btn-outline mr-2" onclick="prevSlide('kegiatan')" aria-label="Previous slide">←</button>
                        <div id="kegiatan-pagination" class="flex space-x-1"></div>
                        <button id="kegiatan-next" class="btn btn-outline" onclick="nextSlide('kegiatan')" aria-label="Next slide">→</button>
                    </div>
                    @endif
                    @else
                    <p class="text-center text-gray-500 mt-4 text-sm md:text-base">
                        Tidak ada kegiatan yang tersedia.
                    </p>
                    @endif

                    <p id="kegiatan-no-results" class="text-center text-gray-500 hidden mt-4 text-sm md:text-base">
                        Tidak ada kegiatan yang ditemukan.
                    </p>
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

                                <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                <!-- Teks "Lihat File" -->
                                <div class="preview-overlay-text" onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}', 'image', false)">
                                    <i class="fas fa-eye"></i>
                                    <span>Lihat File</span>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="preview-container-mobile relative w-full max-w-[20rem] md:max-w-[30rem] mx-auto {{ $index === 0 ? 'block' : 'hidden' }} inovasi-item" data-index="{{ $index }}">
                            <div class="pdf-container relative w-full h-full rounded-lg shadow-md border border-gray-200 overflow-hidden">
                                <div id="pdf-inovasi-js-{{ $index }}" class="pdf-canvas-container w-full h-full">
                                    <div class="pdf-loading">
                                        <div class="pdf-loading-spinner"></div>
                                        <p>Memuat PDF...</p>
                                    </div>
                                </div>

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

                                <div class="absolute inset-0 pointer-events-none overflow-hidden md:hidden">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[8px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                <div class="absolute inset-0 pointer-events-none overflow-hidden hidden md:block">
                                    <div class="grid grid-cols-12 w-full h-full">
                                        @for ($i = 0; $i < 150; $i++)
                                            <span class="flex items-center justify-center text-gray-800 text-[10px] font-bold opacity-20 -rotate-45 whitespace-nowrap">
                                            INNDESA
                                            </span>
                                            @endfor
                                    </div>
                                </div>

                                <div class="absolute inset-0 cursor-pointer no-context-menu"
                                    onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}', 'pdf', false)"
                                    oncontextmenu="return false;"
                                    ondragstart="return false;"
                                    onselectstart="return false;">
                                </div>

                                <!-- Teks "Lihat File" -->
                                <div class="preview-overlay-text" onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}', 'pdf', false)">
                                    <i class="fas fa-eye"></i>
                                    <span>Lihat File</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

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

            <!-- REKAP PENJUALAN PRODUK -->
            <!-- <div id="rekap" class="info-tab-content hidden py-4">
                <div class="mobile-table overflow-x-auto">
                    <table class="w-full border-collapse mb-6 border border-gray-200 text-xs md:text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-left font-semibold text-xs md:text-base">
                                    Nama Produk
                                </th>
                                <th class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-left font-semibold text-xs md:text-base">
                                    Tahun
                                </th>
                                <th class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-left font-semibold text-xs md:text-base">
                                    Harga
                                </th>
                                <th class="border border-gray-200 px-2 py-1 md:px-3 md:py-2 text-left font-semibold text-xs md:text-base">
                                    Terjual
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekap as $namaProduk => $items)
                            @foreach($items as $index => $item)
                            <tr>
                                @if($index == 0)
                                <td class="border border-gray-200 px-2 py-1" rowspan="{{ count($items) }}">
                                    {{ $namaProduk }}
                                </td>
                                @endif
                                <td class="border border-gray-200 px-2 py-1">{{ $item->tahun }}</td>
                                <td class="border border-gray-200 px-2 py-1">{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="border border-gray-200 px-2 py-1">{{ $item->produk_terjual }}</td>
                            </tr>
                            @endforeach
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-gray-500">
                                    Data rekap penjualan produk pertahun tidak ada
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Modal Preview -->
    <div id="previewModal" class="preview-modal">
        <div class="preview-content">
            <div class="preview-header">
                <h3 id="previewTitle" class="preview-title"></h3>
                <div class="flex items-center space-x-2">
                    <!-- Tombol Download -->
                    <button id="previewDownload" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors flex items-center" onclick="downloadPreviewFile()" aria-label="Download file">
                        <i class="fas fa-download mr-1"></i>
                        Download
                    </button>
                    <!-- Tombol Close -->
                    <button onclick="closePreview()" class="preview-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="preview-body">
                <!-- Image preview -->
                <img id="previewImage" class="preview-image hidden" alt="Preview">

                <!-- PDF preview -->
                <div id="previewPdf" class="preview-pdf hidden"></div>

                <!-- Watermark overlay -->
                <div class="preview-watermark">
                    <div class="watermark-grid">
                        @for ($i = 0; $i < 300; $i++)
                            <span class="watermark-text">INNDESA</span>
                            @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 sm:mt-20">
        @include('footer')
    </div>


    <!-- KEMBALI KEATAS - PERBAIKAN -->
    <a href="#" id="backToTop" title="Kembali ke Atas">
        <i class="fas fa-arrow-up"></i>
        <!-- SVG fallback jika Font Awesome tidak berhasil dimuat -->
        <svg class="arrow-fallback" fill="white" viewBox="0 0 24 24">
            <path d="M7 14l5-5 5 5z" />
        </svg>
    </a>

    <script>
        // Variabel global untuk menyimpan informasi file yang sedang dipreview
        let currentPreviewFile = '';
        let currentPreviewType = '';
        let currentIsKatalog = false;

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

        // Render PDF saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            @if(!empty($kelompok -> sk_desa) && strtolower(pathinfo($kelompok -> sk_desa, PATHINFO_EXTENSION)) === 'pdf')
            renderPdfWithWatermark(
                "{{ asset('storage/' . $kelompok->sk_desa) }}",
                "pdfSkDesaViewer"
            );
            @endif

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

            // Fungsi pencarian
            function searchItems(section, searchInputId, itemClass, dataAttr, noResultsId) {
                const searchInput = document.getElementById(searchInputId);
                const noResults = document.getElementById(noResultsId);
                if (searchInput) {
                    // Inisialisasi state untuk input pencarian
                    if (!searchInput.dataset.searchActive) {
                        searchInput.dataset.searchActive = 'false';
                        searchInput.dataset.currentPage = '0';
                    }

                    const searchHandler = debounce(function() {
                        const searchTerm = searchInput.value.toLowerCase().trim();
                        const items = document.querySelectorAll(`.${itemClass}`);
                        let hasResults = false;

                        // Cek apakah ada data di database
                        const hasData = items.length > 0;

                        // Jika input kosong, sembunyikan pesan "tidak ada hasil" dan tampilkan semua item
                        if (!searchTerm) {
                            noResults.classList.add('hidden');
                            items.forEach(item => {
                                item.style.display = '';
                                item.classList.remove('hidden');
                            });

                            // Kembalikan ke state pagination sebelum pencarian
                            const currentPage = parseInt(searchInput.dataset.currentPage || '0');
                            showSlide(section, currentPage);
                            searchInput.dataset.searchActive = 'false';

                            // Tampilkan kembali kontrol pagination
                            const paginationContainer = document.querySelector(`#${section}-pagination`).parentElement;
                            if (paginationContainer) {
                                paginationContainer.style.display = 'flex';
                            }
                            return;
                        }

                        // Tampilkan/sembunyikan item berdasarkan pencarian
                        items.forEach(item => {
                            const itemText = item.getAttribute(dataAttr);
                            if (itemText && itemText.includes(searchTerm)) {
                                item.style.display = 'block';
                                hasResults = true;
                            } else {
                                item.style.display = 'none';
                            }
                        });

                        // Tampilkan pesan jika tidak ada hasil dan ada data di database
                        if (hasData) {
                            noResults.classList.toggle('hidden', hasResults);
                        } else {
                            // Jika tidak ada data di database, sembunyikan pesan pencarian
                            noResults.classList.add('hidden');
                        }

                        // Handle pagination
                        if (searchTerm) {
                            // Simpan state pagination sebelum pencarian
                            if (searchInput.dataset.searchActive !== 'true') {
                                searchInput.dataset.searchActive = 'true';
                                searchInput.dataset.currentPage = getCurrentSlideIndex(section);
                            }
                            // Sembunyikan pagination saat pencarian aktif
                            const paginationContainer = document.querySelector(`#${section}-pagination`).parentElement;
                            if (paginationContainer) {
                                paginationContainer.style.display = 'none';
                            }
                        }
                    }, 300);

                    searchInput.addEventListener('input', searchHandler);
                }
            }

            // Fungsi untuk mereset pencarian saat berpindah tab
            function resetSearchWhenTabChange() {
                // Reset pencarian produk
                const searchProduk = document.getElementById('searchProduk');
                const searchProdukDesktop = document.getElementById('searchProdukDesktop');
                const produkNoResults = document.getElementById('produk-no-results');

                if (searchProduk) {
                    searchProduk.value = '';
                    searchProduk.dataset.searchActive = 'false';
                    // Sembunyikan pesan "tidak ada hasil" untuk produk
                    if (produkNoResults) {
                        produkNoResults.classList.add('hidden');
                    }
                }
                if (searchProdukDesktop) {
                    searchProdukDesktop.value = '';
                    searchProdukDesktop.dataset.searchActive = 'false';
                    // Sembunyikan pesan "tidak ada hasil" untuk produk
                    if (produkNoResults) {
                        produkNoResults.classList.add('hidden');
                    }
                }

                // Reset pencarian kegiatan
                const searchKegiatan = document.getElementById('searchKegiatan');
                const kegiatanNoResults = document.getElementById('kegiatan-no-results');

                if (searchKegiatan) {
                    searchKegiatan.value = '';
                    searchKegiatan.dataset.searchActive = 'false';
                    // Sembunyikan pesan "tidak ada hasil" untuk kegiatan
                    if (kegiatanNoResults) {
                        kegiatanNoResults.classList.add('hidden');
                    }
                }
            }

            // Inisialisasi pencarian untuk produk dan kegiatan
            searchItems('produk', 'searchProduk', 'produk-item', 'data-nama', 'produk-no-results');
            searchItems('produk', 'searchProdukDesktop', 'produk-item', 'data-nama', 'produk-no-results');
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

            // Inisialisasi PDF.js untuk inline preview saat halaman dimuat
            initializeInlinePdfs();
        });

        // Modifikasi fungsi openTab
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

            // Reset pencarian saat berpindah tab
            resetSearchWhenTabChange();

            // Inisialisasi PDF.js untuk tab yang aktif
            if (tabId === 'sk-desa' || tabId === 'inovasi') {
                setTimeout(() => {
                    initializeInlinePdfs();
                }, 100);
            }
        }

        // Fungsi untuk inisialisasi PDF.js untuk inline preview
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

        // Fungsi untuk render PDF dengan PDF.js
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

                    // Hitung skala yang sesuai dengan container
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

                // Set scroll position ke atas setelah render selesai
                container.scrollTop = 0;
                return true;
            } catch (error) {
                console.error('Error rendering PDF with PDF.js:', error);
                return false;
            }
        }

        // Fungsi untuk render PDF dengan watermark
        async function renderPdfWithWatermark(pdfUrl, containerId) {
            try {
                const container = document.getElementById(containerId);
                if (!container) return;

                // Tampilkan loading
                container.innerHTML = '<div class="pdf-loading"><div class="pdf-loading-spinner"></div><p>Memuat PDF...</p></div>';

                // Load PDF
                const pdf = await pdfjsLib.getDocument(pdfUrl).promise;
                const numPages = pdf.numPages;

                // Clear loading
                container.innerHTML = '';

                // Render each page
                for (let pageNum = 1; pageNum <= numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);

                    // Calculate scale to fit container width
                    const containerWidth = container.clientWidth;
                    const viewport = page.getViewport({
                        scale: 1.0
                    });
                    const scale = containerWidth / viewport.width;
                    const scaledViewport = page.getViewport({
                        scale: scale
                    });

                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = scaledViewport.height;
                    canvas.width = scaledViewport.width;

                    const renderContext = {
                        canvasContext: context,
                        viewport: scaledViewport
                    };

                    await page.render(renderContext).promise;
                    container.appendChild(canvas);
                }
            } catch (error) {
                console.error('Error rendering PDF:', error);
                const container = document.getElementById(containerId);
                if (container) {
                    container.innerHTML = '<div class="pdf-error"><p>PDF tidak dapat ditampilkan. <a href="' + pdfUrl + '" target="_blank">Buka di tab baru</a></p></div>';
                }
            }
        }

        // Fungsi untuk mengecek apakah PDF berhasil dimuat
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
                                    // Jika PDF.js juga gagal, tampilkan iframe
                                    jsContainer.classList.add('hidden');
                                    iframe.classList.remove('hidden');
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
                                // Jika PDF.js juga gagal, tampilkan iframe
                                jsContainer.classList.add('hidden');
                                iframe.classList.remove('hidden');
                            } else {
                                iframe.style.display = 'none';
                            }
                        });
                    }
                }
            }, 3000); // Tunggu 3 detik
        }

        // Update fungsi openPreview untuk menangani PDF dengan lebih baik
        function openPreview(src, title, type = 'image', isKatalog = false) {
            const modal = document.getElementById('previewModal');
            const previewImage = document.getElementById('previewImage');
            const previewPdf = document.getElementById('previewPdf');
            const previewTitle = document.getElementById('previewTitle');
            const watermark = document.querySelector('.preview-watermark');
            const downloadBtn = document.getElementById('previewDownload');

            // Simpan informasi file saat ini
            currentPreviewFile = src;
            currentPreviewType = type;
            currentIsKatalog = isKatalog;

            previewTitle.textContent = title;

            if (type === 'pdf') {
                previewImage.classList.add('hidden');
                previewPdf.classList.remove('hidden');
                // Render PDF dengan watermark
                renderPdfWithWatermark(src, 'previewPdf');
            } else {
                previewPdf.classList.add('hidden');
                previewImage.classList.remove('hidden');
                previewImage.src = src;
            }

            // Sembunyikan watermark jika ini katalog
            if (watermark) {
                watermark.style.display = isKatalog ? 'none' : 'block';
            }

            // Tampilkan tombol download hanya jika ini katalog
            if (downloadBtn) {
                if (isKatalog) {
                    downloadBtn.classList.add('show');
                } else {
                    downloadBtn.classList.remove('show');
                }
            }

            // Tampilkan modal dengan animasi
            modal.classList.add('active');

            // Tambahkan class untuk body agar navbar tetap terlihat
            document.body.classList.add('modal-active');

            // Fokus ke modal untuk accessibility
            modal.focus();
        }

        // Fungsi untuk mendownload file
        function downloadPreviewFile() {
            if (!currentPreviewFile) return;

            // Buat link download
            const link = document.createElement('a');
            link.href = currentPreviewFile;

            // Ekstrak nama file dari URL
            const filename = currentPreviewFile.split('/').pop();
            link.download = filename;

            // Trigger download
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Fungsi baru untuk preview katalog (tanpa watermark, dengan download)
        function openKatalogPreview(fileSrc, title) {
            const extension = fileSrc.split('.').pop().toLowerCase();
            const type = (extension === 'pdf') ? 'pdf' : 'image';
            openPreview(fileSrc, title, type, true); // isKatalog = true
        }

        function closePreview() {
            const modal = document.getElementById('previewModal');

            // Hapus class active untuk animasi
            modal.classList.remove('active');

            // Hapus class modal-active dari body
            document.body.classList.remove('modal-active');

            // Reset konten setelah animasi selesai
            setTimeout(() => {
                const previewPdf = document.getElementById('previewPdf');
                const previewImage = document.getElementById('previewImage');

                previewPdf.innerHTML = '';
                previewImage.src = '';
            }, 300);
        }

        // Event listener untuk menutup modal dengan klik di luar
        document.getElementById('previewModal').addEventListener('click', (e) => {
            if (e.target.id === 'previewModal') {
                closePreview();
            }
        });

        // Event listener untuk tombol close
        document.querySelectorAll('.preview-close').forEach(btn => {
            btn.addEventListener('click', closePreview);
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closePreview();
            }
        });

        // ========== PAGINATION SYSTEM ==========
        const carousels = {
            'sk-desa': {
                itemsPerPage: 1
            },
            'produk': {
                itemsPerPage: window.innerWidth <= 768 ? 4 : 8
            },
            'kegiatan': {
                itemsPerPage: window.innerWidth <= 768 ? 4 : 8
            },
            'inovasi': {
                itemsPerPage: 1
            }
        };

        // Update items per page on window resize
        window.addEventListener('resize', () => {
            carousels['produk'].itemsPerPage = window.innerWidth <= 768 ? 4 : 8;
            carousels['kegiatan'].itemsPerPage = window.innerWidth <= 768 ? 4 : 8;

            // Re-initialize carousels with new settings
            ['produk', 'kegiatan'].forEach(section => {
                const items = document.querySelectorAll(`#${section}-carousel .${section}-item`);
                if (items.length > 0) {
                    showSlide(section, 0);
                }
            });

            // Re-inisialisasi PDF.js saat ukuran layar berubah
            setTimeout(() => {
                initializeInlinePdfs();
            }, 100);
        });

        function initializeCarousel(section) {
            showSlide(section, 0); // Tampilkan slide pertama
        }

        // Modifikasi fungsi renderPagination untuk menangani visibility
        function renderPagination(idPrefix) {
            const carousel = document.getElementById(`${idPrefix}-carousel`);
            // Hanya hitung item yang visible (tidak di-hide oleh pencarian)
            const items = Array.from(carousel.querySelectorAll(`.${idPrefix}-item`)).filter(item => item.style.display !== 'none');
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
            const items = Array.from(document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`)).filter(item => item.style.display !== 'none');
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
                const items = Array.from(document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`)).filter(item => item.style.display !== 'none');
                const itemsPerPage = carousels[idPrefix].itemsPerPage;
                const lastIndex = Math.floor((items.length - 1) / itemsPerPage) * itemsPerPage;
                showSlide(idPrefix, lastIndex);
            }
        }

        // Modifikasi fungsi showSlide untuk menangani pagination dengan benar
        function showSlide(idPrefix, index) {
            const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);
            if (items.length === 0) return;

            if (index >= items.length) index = items.length - 1;
            if (index < 0) index = 0;

            const itemsPerPage = carousels[idPrefix].itemsPerPage;
            const batchStart = Math.floor(index / itemsPerPage) * itemsPerPage;

            // Reset semua item ke state default
            items.forEach((item, i) => {
                // Reset ke state default
                item.style.display = '';
                item.classList.remove('hidden');

                // Terapkan pagination hanya pada item yang visible (tidak di-hide oleh pencarian)
                if (item.style.display !== 'none') {
                    const isInBatch = i >= batchStart && i < batchStart + itemsPerPage;
                    item.classList.toggle('hidden', !isInBatch);
                }
            });

            renderPagination(idPrefix);

            // Inisialisasi PDF.js untuk slide yang aktif
            setTimeout(() => {
                initializeInlinePdfs();
            }, 100);
        }

        // Modifikasi fungsi getCurrentSlideIndex untuk mengabaikan item yang di-hide pencarian
        function getCurrentSlideIndex(idPrefix) {
            const items = document.querySelectorAll(`#${idPrefix}-carousel .${idPrefix}-item`);
            let visibleIndex = 0;

            for (let i = 0; i < items.length; i++) {
                // Lewati item yang di-hide oleh pencarian
                if (items[i].style.display === 'none') continue;

                if (!items[i].classList.contains('hidden')) {
                    return visibleIndex;
                }
                visibleIndex++;
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
    </script>
</body>

</html>