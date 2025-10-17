<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-blue {
            background-color: #0097D4;
            color: white;
        }

        .btn-blue:hover {
            background-color: #0078a7;
            transform: translateY(-2px);
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
            border: 2px solid #0097D4;
            color: #0097D4;
        }

        .btn-outline:hover {
            background-color: #0097D4;
            color: white;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            padding-bottom: 40%;
            height: 0;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .location-card {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .location-card:hover {
            transform: scale(1.05);
        }

        .location-card img {
            transition: all 0.5s ease;
        }

        .location .location-card:hover img {
            transform: scale(1.05);
        }

        .location-card .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 100%);
            padding: 2rem 1.5rem 1.5rem;
            color: white;
        }

        .csr-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .csr-card {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .csr-card:hover {
            transform: scale(1.05);
        }

        .csr-card .image-container {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .csr-card .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .csr-card .icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #0097D4;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .csr-card .content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .csr-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0097D4;
            margin-bottom: 1rem;
        }

        .csr-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .csr-card ul li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
        }

        .csr-card ul li:last-child {
            border-bottom: none;
        }

        .csr-card ul li i {
            color: #10b981;
            margin-right: 0.75rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #e5e7eb;
            border-radius: 4px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 2rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2.375rem;
            top: 0.5rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0097D4;
            border: 4px solid white;
            box-shadow: 0 0 0 0 4px #e5e7eb;
        }

        .timeline-item.active::before {
            background: #10b981;
        }

        .policy-item {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-left: 4px solid #0097D4;
            transition: transform 0.3s ease;
        }

        .policy-item:hover {
            transform: scale(1.05);
        }

        .policy-item h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0097D4;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .policy-item h4 i {
            margin-right: 0.75rem;
        }

        .policy-item p {
            color: #4b5563;
        }

        /* Animasi scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .card-reveal {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .card-reveal.active {
            opacity: 1;
            transform: scale(1);
        }

        .section-title {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }

        .section-title.active {
            opacity: 1;
            transform: translateY(0);
        }

        .csr-card-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .csr-card-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .policy-reveal {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }

        .policy-reveal:nth-child(even) {
            transform: translateX(30px);
        }

        .policy-reveal.active {
            opacity: 1;
            transform: translateX(0);
        }

        .hero-bg {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Mobile-specific styles */
        @media (max-width: 640px) {

            /* Reset overflow dan ukuran container */
            * {
                max-width: 100%;
                box-sizing: border-box;
            }

            html,
            body {
                overflow-x: hidden;
                width: 100%;
                min-width: 0;
            }

            .container,
            .max-w-6xl,
            .max-w-5xl,
            .max-w-4xl,
            .max-w-3xl {
                width: 100%;
                padding-left: 0.75rem;
                padding-right: 0.75rem;
                overflow-x: hidden;
            }

            section {
                padding-top: 1rem;
                padding-bottom: 1rem;
                overflow-x: hidden;
            }

            .hero-title {
                -webkit-text-stroke: 0.3px #ffffff;
            }

            .hero-subtitle {
                -webkit-text-stroke: 0.2px #ffffff;
            }

            /* Ukuran font yang lebih proporsional */
            .text-7xl {
                font-size: 1.5rem;
                line-height: 1.1;
            }

            .text-4xl {
                font-size: 1.2rem;
            }

            .text-3xl {
                font-size: 1rem;
            }

            .text-2xl {
                font-size: 0.9rem;
            }

            .text-xl {
                font-size: 0.85rem;
            }

            .text-lg {
                font-size: 0.8rem;
            }

            .text-base {
                font-size: 0.75rem;
            }

            .text-sm {
                font-size: 0.7rem;
            }

            /* Card dan button */
            .card {
                padding: 0.75rem;
                box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
                margin-bottom: 0.75rem;
            }

            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
            }

            /* CSR Grid */
            .csr-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .csr-card .image-container {
                height: 100px;
            }

            .csr-card .icon {
                width: 30px;
                height: 30px;
                font-size: 1rem;
            }

            .csr-card .content {
                padding: 0.75rem;
            }

            .csr-card h4 {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }

            .csr-card ul li {
                font-size: 0.75rem;
                padding: 0.25rem 0;
            }

            .csr-card ul li i {
                font-size: 0.75rem;
                margin-right: 0.5rem;
            }

            /* Map container */
            .map-container {
                padding-bottom: 60%;
            }

            .location-card .overlay {
                padding: 0.75rem 0.5rem;
            }

            .location-card img {
                width: 100%;
                height: auto;
            }

            /* Timeline */
            .timeline {
                padding-left: 1rem;
            }

            .timeline-item::before {
                left: -0.625rem;
                width: 10px;
                height: 10px;
                border: 2px solid white;
            }

            /* Policy item */
            .policy-item {
                padding: 0.75rem;
                margin-bottom: 0.75rem;
            }

            .policy-item h4 {
                font-size: 0.9rem;
                margin-bottom: 0.25rem;
            }

            .policy-item h4 i {
                font-size: 0.9rem;
                margin-right: 0.5rem;
            }

            .policy-item p {
                font-size: 0.75rem;
            }

            /* Section spacing */
            .section-title {
                margin-bottom: 0.75rem;
            }

            section[min-h~="550px"] {
                min-height: 250px;
                padding-top: 1.5rem;
            }

            section[min-h~="550px"] .absolute {
                top: 0.5rem;
                left: 0.5rem;
            }

            section[min-h~="550px"] img {
                height: 1rem;
            }

            .hero-bg {
                background-attachment: scroll;
            }

            /* Body text */
            body {
                font-size: 0.8rem;
                line-height: 1.4;
            }

            h2 {
                font-size: 1.2rem;
                margin-bottom: 0.75rem;
            }

            h3 {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }

            h4 {
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }

            p {
                font-size: 0.75rem;
                line-height: 1.4;
                margin-bottom: 0.5rem;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            /* Margin dan padding yang lebih kecil */
            .mb-16 {
                margin-bottom: 1rem;
            }

            .mb-12 {
                margin-bottom: 0.75rem;
            }

            .mb-6 {
                margin-bottom: 0.5rem;
            }

            .mb-4 {
                margin-bottom: 0.4rem;
            }

            .py-16 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            .pt-32 {
                padding-top: 1.5rem;
            }

            .space-y-4>*+* {
                margin-top: 0.5rem;
            }

            /* Grid */
            .grid-cols-1 {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .grid-cols-2 {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            /* Padding khusus untuk konten */
            .px-4 {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .px-6 {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            .px-8 {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }

            /* Hero section adjustments */
            .text-center.space-y-0 {
                margin-top: 0.5rem;
            }

            .text-center.space-y-0 h2 {
                margin-bottom: 0.25rem;
            }
        }

        /* Back to top button styles */
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

        @media (min-width: 641px) {
            #backToTop {
                display: none;
            }
        }

        /* SOSMED */
        /* Tambahkan di bagian CSS yang sudah ada */

        /* Media sosial card styles */
        .social-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 1px solid #f3f4f6;
            overflow: hidden;
        }

        .social-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .social-card a {
            display: block;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
        }

        .social-card .icon-container {
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .social-card .icon-container i {
            font-size: 1.5rem;
        }

        .social-card h3 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1f2937;
        }

        /* Mobile responsive styles */
        @media (max-width: 640px) {
            .social-card a {
                padding: 0.75rem;
            }

            .social-card .icon-container {
                width: 2.5rem;
                height: 2.5rem;
                margin-bottom: 0.5rem;
            }

            .social-card .icon-container i {
                font-size: 1.125rem;
            }

            .social-card h3 {
                font-size: 0.875rem;
            }

            .grid-cols-2>div {
                margin-bottom: 0.5rem;
            }

            .gap-3 {
                gap: 0.75rem;
            }

            /* Tambahan untuk memastikan card tidak terlalu besar di mobile */
            .grid {
                gap: 0.75rem;
            }

            .rounded-xl {
                border-radius: 0.5rem;
            }

            /* Mengurangi efek hover di mobile untuk performa yang lebih baik */
            .social-card:hover {
                transform: translateY(-2px);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>
    @include('navbar')

    <section
        class="relative text-white overflow-hidden aspect-[16/9] md:aspect-auto md:min-h-[700px] flex flex-col items-center pt-16 sm:pt-20 md:pt-0 md:justify-center"
        style="background-image: url('{{ asset('images/pltu.jpg') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black bg-opacity-50 z-0"></div>

        <!-- Logo untuk desktop -->
        <div class="absolute top-12 left-16 hidden md:flex items-center space-x-4 z-10">
            <img src="{{ asset('images/logo_BUMN.png') }}" alt="Logo" class="h-8 md:h-10 lg:h-12 w-auto">
            <img src="{{ asset('images/logo_PLN.png') }}" alt="Logo" class="h-8 md:h-10 lg:h-12 w-auto">
        </div>

        <!-- Logo untuk mobile -->
        <div class="absolute top-4 left-3 sm:top-6 sm:left-8 flex items-center space-x-1 md:hidden z-10">
            <img src="{{ asset('images/logo_BUMN.png') }}" alt="Logo" class="h-3 sm:h-4 w-auto">
            <img src="{{ asset('images/logo_PLN.png') }}" alt="Logo" class="h-3 sm:h-4 w-auto">
        </div>

        <div class="text-center space-y-0 z-10 px-4 mt-[-5px] md:mt-0 md:space-y-4">
            <h2 class="text-2xl sm:text-2xl md:text-5xl lg:text-7xl font-bold 
       text-[#0097D4] 
       drop-shadow-[0_2px_6px_rgba(0,0,0,0.7)]">
                PT. PLN Indonesia Power
            </h2>
            <h2 class="text-xl sm:text-2xl md:text-5xl lg:text-7xl font-bold 
       text-[#FFD700] 
       drop-shadow-[0_2px_6px_rgba(0,0,0,0.7)] leading-tight">
                UBP Jawa Tengah 2 Adipala
            </h2>
        </div>
    </section>

    <section class="py-16 bg-white reveal">
        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Profile Perusahaan</h2>
        </div>
        <div class="max-w-3xl mx-auto mb-12">
            <div class="card p-8 border border-gray-300 rounded-lg card-reveal">
                <p class="text-center text-gray-800 text-base sm:text-lg md:text-xl leading-relaxed sm:leading-relaxed leading-snug card-reveal mb-4">
                    Mengoperasikan 1 unit Pembangkit Listrik Tenaga Uap (PLTU) dengan kapasitas 660 MW yang berlokasi di Desa Bunton, Kecamatan Adipala, Kabupaten Cilacap. PLTU Adipala beroperasi dengan menggunakan bahan bakar batubara dan mempunyai teknologi supercritical yang membuat operasional PLTU lebih efisien.
                </p>
            </div>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-2 sm:gap-6 gap-4">
            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Visi</h3>
                <div class="card flex-1 p-3 sm:p-6 flex items-center justify-center border border-gray-300 rounded-lg card-reveal">
                    <p class="text-center text-gray-800 text-base sm:text-lg md:text-xl leading-relaxed sm:leading-relaxed leading-snug card-reveal mb-4">
                        Menjadi Perusahaan Pembangkit Listrik Terkemuka dan Berkelanjutan di Asia Tenggara
                    </p>
                </div>
            </div>
            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Misi</h3>
                <div class="card flex-1 p-3 sm:p-6 flex items-center justify-center border border-gray-300 rounded-lg card-reveal">
                    <p class="text-center text-gray-800 text-base sm:text-lg md:text-xl leading-relaxed sm:leading-relaxed leading-snug card-reveal mb-4">
                        Menyelenggarakan Bisnis Solusi Energi yang Andal, Efisien, Inovatif, dan Melampaui Harapan Pelanggan, Menuju Energi Bersih yang Terjangkau
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-2 sm:py-12 md:py-16 bg-white reveal">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 section-title">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Lokasi Perusahaan</h2>
            </div>
            <div class="flex justify-center card-reveal">
                <img
                    src="{{ asset('images/Denahlokasi.png') }}"
                    class="max-w-full h-auto rounded-lg shadow-lg" />
            </div>
        </div>
    </section>

    <section class="py-16 bg-white reveal">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title"><i>Corporate Social Responsibility</i> (CSR)</h2>
            <div class="mb-16">
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Pengertian CSR</h3>
                <div class="card p-4 sm:p-6 md:p-8 border border-gray-300 rounded-lg max-w-3xl md:max-w-4xl mx-auto card-reveal">
                    <p class="text-center text-gray-800 text-sm sm:text-base md:text-lg leading-snug sm:leading-relaxed md:leading-relaxed card-reveal mb-4">
                        <i>Corporate Social Responsibility</i> (CSR) atau Tanggung Jawab Sosial dan Lingkungan (TJSL) adalah komitmen PT.PLN Indonesia Power UBP Jawa Tengah 2 Adipala untuk memperhatikan dampak sosial dan lingkungan dari setiap aktivitas bisnis, serta berkontribusi pada pembangunan berkelanjutan.
                        Bagi Indonesia Power, CSR tidak hanya sebatas kepatuhan, tetapi merupakan tanggung jawab perusahaan terhadap masyarakat, pemangku kepentingan, dan lingkungan agar tercipta manfaat berkesinambungan. Implementasinya diwujudkan melalui program INPOWER-CARE <i>(Community Assistance, Relation, and Empowerment)</i> yang berfokus pada peningkatan kualitas hidup, pemberdayaan masyarakat, dan kelestarian lingkungan.
                    </p>
                </div>
            </div>
            <div class="mb-16">
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">
                    Program INPOWER - CARE
                </h3>
                <p class="text-center text-gray-800 text-sm sm:text-base md:text-lg leading-snug sm:leading-relaxed md:leading-relaxed card-reveal mb-4">
                    INPOWER-CARE adalah kegiatan pelibatan dan pengembangan komunitas yang dilakukan Perusahaan sebagai wujud tanggung jawab sosial dan tata kelola Perusahaan yang baik. INPOWERCARE bertujuan untuk memperbesar akses masyarakat agar mencapai kondisi sosial, ekonomi, dan budaya yang lebih baik dari sebelumnya. Sehingga, kehidupan masyarakat di sekitar wilayah operasional Perusahaan diharapkan menjadi lebih berdaya dan mandiri dengan kualitas dan kesejahteraan yang lebih baik.
                    Penyelenggaraan INPOWER-CARE merupakan perwujudan visi dan misi Perusahaan, khususnya bersahabat dengan lingkungan serta perwujudan Tanggung Jawab Sosial dan Lingkungan (TJSL) Perusahaan sebagai bagian dari tata kelola perusahaan yang baik.
                </p>
                <div class="flex justify-center card-reveal">
                    <img
                        src="{{ asset('images/Program_INPOWERCARE.png') }}"
                        class="w-full sm:w-3/4 md:w-11/12 lg:w-1/2 h-auto rounded-lg shadow-lg" />
                </div><br>
                <div class="csr-grid">
                    <div class="csr-card border border-gray-300 rounded-lg csr-card-reveal">
                        <div class="content">
                            <h4>Bantuan Pelayanan Masyarakat</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Bantuan Sarana dan Prasarana</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pelayanan Kesehatan</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pelayanan Pendidikan</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Bencana Alam</li>
                            </ul>
                        </div>
                    </div>
                    <div class="csr-card border border-gray-300 rounded-lg csr-card-reveal">
                        <div class="content">
                            <h4>Bakti Pembinaan Hubungan</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Komunikasi Sosial</li>
                                <li><i class="fas fa-check-circle"></i> Partisipasi Peringatan Hari Besar</li>
                                <li><i class="fas fa-check-circle"></i> Partisipasi Kegiatan Masyarakat</li>
                            </ul>
                        </div>
                    </div>
                    <div class="csr-card border border-gray-300 rounded-lg csr-card-reveal">
                        <div class="content">
                            <h4>Bakti Pemberdayaan Masyarakat</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pengembangan dan Modal Usaha</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Peningkatan Ketrampilan</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pemasaran Produk</li>
                                <li><i class="fas fa-check-circle"></i> Riset dan Pengembangan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-16">
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Kebijakan</h3>
                <div class="max-w-4xl mx-auto">
                    <p class="text-center text-gray-800 text-sm sm:text-base md:text-lg leading-snug sm:leading-relaxed md:leading-relaxed card-reveal mb-4">
                        Penyelenggaraan program tanggung jawab sosial terhadap masyarakat di PT.PLN Indonesia Power UBP Jawa Tengah 2 Adipala dilaksanakan berdasarkan pada Keputusan Direksi No. 25.K/010/IP/2014 tentang Pedoman Tanggung Jawab Sosial dan Lingkungan Perusahaan.
                        Sesuai peraturan internal tersebut, Tanggung Jawab Sosial dan Lingkungan Perusahaan (TJSLP), atau di internal disebut dengan program INPOWER-CARE, merupakan komitmen Perusahaan untuk berperan serta dalam pembangunan ekonomi
                        berkelanjutan sebagai bentuk tanggung jawab terhadap dampak pengambilan keputusan dan proses bisnis Perusahaan guna meningkatkan kualitas kehidupan dan lingkungan yang bermanfaat, baik bagi Perusahaan maupun komunitas setempat.
                    </p><br>
                    <div class="policy-item policy-reveal">
                        <h4><i class="fas fa-leaf"></i> Komitmen Ekonomi Berkelanjutan</h4>
                        <p>CSR adalah komitmen perusahaan untuk pembangunan ekonomi berkelanjutan.</p>
                    </div>
                    <div class="policy-item policy-reveal">
                        <h4><i class="fas fa-handshake"></i> Tanggung Jawab Bisnis</h4>
                        <p>CSR dilaksanakan sebagai bentuk tanggung jawab terhadap dampak keputusan dan proses bisnis.</p>
                    </div>
                    <div class="policy-item policy-reveal">
                        <h4><i class="fas fa-users"></i> Peningkatan Kualitas Hidup</h4>
                        <p>Tujuannya meningkatkan kualitas kehidupan masyarakat dan lingkungan yang bermanfaat, baik bagi perusahaan maupun komunitas setempat.</p>
                    </div>
                </div>
                <section class="py-16 bg-white reveal">
                    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12 section-title">
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Roadmap</h2>
                        </div>
                        <div class="flex justify-center card-reveal">
                            <!-- <img
                                src="{{ asset('images/lokasi.png') }}"
                                class="max-w-full h-auto rounded-lg shadow-lg" /> -->
                        </div>
                    </div>
                </section>

                <section class="py-16 bg-white reveal">
                    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12 section-title">
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 mb-6 text-center section-title">Media Sosial Kami</h2>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6">
                            <!-- Instagram -->
                            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-reveal">
                                <a href="https://www.instagram.com/plnip.ubpadipala/" class="block p-3 md:p-6 text-center">
                                    <div class="w-10 h-10 md:w-16 md:h-16 mx-auto bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-2 md:mb-4">
                                        <i class="fab fa-instagram text-white text-lg md:text-2xl"></i>
                                    </div>
                                    <h3 class="text-sm md:text-lg font-bold text-gray-800">Instagram</h3>
                                </a>
                            </div>

                            <!-- WhatsApp -->
                            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-reveal">
                                <a href="https://wa.me/6282324900948" class="block p-3 md:p-6 text-center">
                                    <div class="w-10 h-10 md:w-16 md:h-16 mx-auto bg-green-500 rounded-full flex items-center justify-center mb-2 md:mb-4">
                                        <i class="fab fa-whatsapp text-white text-lg md:text-2xl"></i>
                                    </div>
                                    <h3 class="text-sm md:text-lg font-bold text-gray-800">WhatsApp</h3>
                                </a>
                            </div>

                            <!-- YouTube -->
                            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-reveal">
                                <a href="https://www.youtube.com/@plnindonesiapoweradipalaom2886" class="block p-3 md:p-6 text-center">
                                    <div class="w-10 h-10 md:w-16 md:h-16 mx-auto bg-red-600 rounded-full flex items-center justify-center mb-2 md:mb-4">
                                        <i class="fab fa-youtube text-white text-lg md:text-2xl"></i>
                                    </div>
                                    <h3 class="text-sm md:text-lg font-bold text-gray-800">YouTube</h3>
                                </a>
                            </div>

                            <!-- Facebook -->
                            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-reveal">
                                <a href="https://www.facebook.com/share/1CPD2kxMsm/" target="_blank" class="block p-3 md:p-6 text-center">
                                    <div class="w-10 h-10 md:w-16 md:h-16 mx-auto bg-blue-700 rounded-full flex items-center justify-center mb-2 md:mb-4">
                                        <i class="fab fa-facebook-f text-white text-lg md:text-2xl"></i>
                                    </div>
                                    <h3 class="text-sm md:text-lg font-bold text-gray-800">Facebook</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <div class="mt-20">
        @include('footer')
    </div>

    <a href="#" id="backToTop" title="Kembali ke Atas">
        <i class="fas fa-arrow-up"></i>
        <svg class="arrow-fallback" fill="white" viewBox="0 0 24 24">
            <path d="M7 14l5-5 5 5z" />
        </svg>
    </a>
</body>

<script>
    // Scroll reveal animation
    function reveal() {
        const reveals = document.querySelectorAll('.reveal, .card-reveal, .section-title, .csr-card-reveal, .policy-reveal');
        for (let i = 0; i < reveals.length; i++) {
            const windowHeight = window.innerHeight;
            const elementTop = reveals[i].getBoundingClientRect().top;
            const elementVisible = 100;
            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add('active');
            } else {
                reveals[i].classList.remove('active');
            }
        }
    }

    window.addEventListener('scroll', reveal);
    reveal();

    // JS PRELOADER
    window.addEventListener("load", function() {
        let preloader = document.getElementById("preloader");
        preloader.classList.add("fade-out");
        setTimeout(function() {
            preloader.style.display = "none";
            document.body.classList.add("loaded");
        }, 500);
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

    document.addEventListener('DOMContentLoaded', checkFontAwesome);
    window.addEventListener('load', checkFontAwesome);

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

</html>