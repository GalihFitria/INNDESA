<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="INNDESA - Kontak">
    <meta property="og:description" content="Hubungi Admin INNDESA dan kelompok melalui WhatsApp">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="INNDESA - Kontak">
    <meta name="twitter:description" content="Hubungi Admin INNDESA dan kelompok melalui WhatsApp">
    <meta name="twitter:image" content="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* PRELOADER */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 1);
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

        /* Hide all content except preloader until page is loaded */
        body:not(.loaded)>*:not(#preloader) {
            display: none;
        }

        /* Focus states for accessibility */
        a:focus,
        button:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        /* Responsive hero section */
        @media (max-width: 640px) {
            .hero-section {
                height: 40vw;
                min-height: 180px;
            }
        }

        /* Contact card styles */
        .contact-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .admin-card {
            border-left-color: #0097D4;
        }

        .group-card {
            border-left-color: #25D366;
        }

        .whatsapp-btn {
            background-color: #25D366;
            transition: all 0.3s ease;
        }

        .whatsapp-btn:hover {
            background-color: #128C7E;
        }

        /* Animation for contact cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .admin-card {
            animation-delay: 0.1s;
        }

        .group-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .group-card:nth-child(2) {
            animation-delay: 0.3s;
        }

        .group-card:nth-child(3) {
            animation-delay: 0.4s;
        }

        .group-card:nth-child(4) {
            animation-delay: 0.5s;
        }

        .group-card:nth-child(5) {
            animation-delay: 0.6s;
        }

        /* Mobile-specific styles */
        @media (max-width: 640px) {
            .contact-card {
                padding: 10px;
                border-radius: 6px;
            }

            .contact-icon {
                width: 28px;
                height: 28px;
            }

            .contact-icon i {
                font-size: 14px;
            }

            .contact-name {
                font-size: 13px;
            }

            .contact-number {
                font-size: 11px;
            }

            .whatsapp-btn {
                padding: 5px 8px;
                font-size: 11px;
            }

            .whatsapp-btn i {
                font-size: 11px;
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
        }

        /* Fallback for Font Awesome */
        #backToTop::before {
            content: "↑";
            font-size: 24px;
            color: white;
        }

        #backToTop i {
            display: none;
        }

        /* Show Font Awesome icon if loaded */
        .fa-loaded #backToTop i {
            display: block;
        }

        .fa-loaded #backToTop::before {
            display: none;
        }

        /* Only show on mobile */
        @media (min-width: 641px) {
            #backToTop {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- PRELOADER -->
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>

    @include('navbar')

    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-sky-400 to-sky-800 h-64 sm:h-80 md:h-96 flex items-center justify-center px-4 hero-section">
        <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white text-center">Kontak Kami</h1>
    </div>

    <!-- Contact Section -->
    <section class="py-8 sm:py-12 md:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 mb-2 sm:mb-4">Hubungi Kami</h2>
                <p class="text-sm sm:text-base text-gray-600">Silakan hubungi Admin INNDESA atau kelompok kami melalui WhatsApp</p>
            </div>

            <!-- Admin INNDESA Card (di tengah atas) -->
            <div class="flex justify-center mb-10 sm:mb-14">
                <div class="contact-card admin-card bg-white rounded-lg shadow-md p-5 sm:p-6 w-full max-w-md">
                    <div class="flex flex-col items-center text-center">
                        <div class="contact-icon w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                            <i class="fas fa-user-tie text-blue-600 text-7xl sm:text-2xl sm:scale-100 scale-150"></i>

                        </div>
                        <h3 class="contact-name text-xl sm:text-2xl font-bold text-gray-800 mb-2">Admin INNDESA</h3>
                        <div class="flex items-center justify-center mb-4">
                            <i class="fab fa-whatsapp text-green-500 mr-2 text-lg"></i>
                            <span class="contact-number text-gray-700 text-base sm:text-lg">+62 812-3456-7890</span>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=6281234567890&text=Halo%20Admin%20INNDESA"
                            target="_blank"
                            class="whatsapp-btn text-white font-medium py-3 px-6 rounded-lg flex items-center text-sm sm:text-base">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Grid Layout untuk Kelompok -->
            <div class="mb-6 sm:mb-8">
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Kelompok Terdaftar</h3>
            </div>

            <div class="grid grid-cols-2 gap-2 sm:grid-cols-2 sm:gap-4 md:grid-cols-2 md:gap-6 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4 xl:gap-6">
                <!-- Kelompok dari database -->
                @foreach ($kontak as $item)
                @php
                $noWa = preg_replace('/\D/', '', $item->no_telp);
                if (strpos($noWa, '0') === 0) {
                $noWa = '62' . substr($noWa, 1);
                }

                $namaKelompok = optional($item->kelompok)->nama ?? 'Tanpa Nama';

                $pesan = urlencode(
                "Halo, saya tertarik dengan produk dari kelompok {$namaKelompok}.\n".
                "Apakah bisa diberikan informasi lebih lanjut mengenai produk, harga, dan cara pemesanannya?\n".
                "Terima kasih"
                );
                @endphp

                <div class="contact-card group-card bg-white rounded-lg shadow-md p-2 sm:p-5 flex flex-col h-full">
                    <div class="flex flex-col items-center text-center mb-2 sm:mb-4">
                        <div class="contact-icon w-10 h-10 sm:w-16 sm:h-16 rounded-full bg-green-100 flex items-center justify-center mb-2 sm:mb-3">
                            <i class="fas fa-users text-green-600 text-lg sm:text-2xl"></i>
                        </div>
                        <h3 class="contact-name font-bold text-gray-800 text-center text-xs sm:text-base break-words leading-tight sm:leading-normal">
                            {{ $namaKelompok }}
                        </h3>
                    </div>
                    <div class="mt-auto">
                        <a href="https://wa.me/{{ $noWa }}?text={{ $pesan }}"
                            class="whatsapp-btn text-white font-medium py-1 px-2 sm:py-2 sm:px-4 rounded-lg flex items-center justify-center text-xs w-full">
                            <i class="fab fa-whatsapp mr-1 sm:mr-2"></i> Hubungi
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="mt-12 sm:mt-20">
        @include('footer')
    </div>

    <!-- KEMBALI KEATAS -->
    <a href="#" id="backToTop" title="Kembali ke Atas">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script>
        // Preloader
        window.addEventListener("load", function() {
            const preloader = document.getElementById("preloader");
            preloader.classList.add("fade-out");
            setTimeout(() => {
                preloader.style.display = "none";
                document.body.classList.add("loaded");
            }, 500);
        });

        // Check if Font Awesome is loaded
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