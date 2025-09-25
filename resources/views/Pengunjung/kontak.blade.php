<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Kontak</title>
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
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

        .contact-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .contact-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .contact-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .contact-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .contact-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        /* Mobile-specific styles */
        @media (max-width: 640px) {
            .contact-card {
                padding: 16px;
                border-radius: 8px;
            }

            .contact-icon {
                width: 40px;
                height: 40px;
            }

            .contact-icon i {
                font-size: 18px;
            }

            .contact-name {
                font-size: 16px;
            }

            .contact-number {
                font-size: 14px;
            }

            .whatsapp-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .whatsapp-btn i {
                font-size: 14px;
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
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 mb-2 sm:mb-4">Hubungi Kami</h2>
                <p class="text-sm sm:text-base text-gray-600">Silakan hubungi Admin INNDESA atau kelompok kami melalui WhatsApp</p>
            </div>

            <div class="space-y-4 sm:space-y-6">
                <!-- Admin INNDESA -->
                <div class="contact-card admin-card bg-white rounded-lg shadow-md p-4 sm:p-5 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="contact-icon w-12 h-12 sm:w-12 sm:h-12 rounded-full bg-blue-100 flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-user-tie text-blue-600 text-xl sm:text-xl"></i>
                        </div>
                        <div>
                            <h3 class="contact-name text-base sm:text-lg font-bold text-gray-800">Admin INNDESA</h3>
                            <div class="flex items-center mt-1">
                                <i class="fab fa-whatsapp text-green-500 mr-1 sm:mr-2 text-sm sm:text-base"></i>
                                <span class="contact-number text-gray-700 text-sm sm:text-base">+62 812-3456-7890</span>
                            </div>
                        </div>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=6281234567890&text=Halo%20Admin%20INNDESA"
                        target="_blank"
                        class="whatsapp-btn text-white font-medium py-2 px-3 sm:px-4 rounded-lg flex items-center text-xs sm:text-sm">
                        <i class="fab fa-whatsapp mr-1 sm:mr-2"></i>
                        Hubungi
                    </a>
                </div>

                <!-- Kelompok 1 -->
                <div class="contact-card group-card bg-white rounded-lg shadow-md p-4 sm:p-5 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="contact-icon w-12 h-12 sm:w-12 sm:h-12 rounded-full bg-green-100 flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-users text-green-600 text-xl sm:text-xl"></i>
                        </div>
                        <div>
                            <h3 class="contact-name text-base sm:text-lg font-bold text-gray-800">Kelompok 1</h3>
                            <div class="flex items-center mt-1">
                                <i class="fab fa-whatsapp text-green-500 mr-1 sm:mr-2 text-sm sm:text-base"></i>
                                <span class="contact-number text-gray-700 text-sm sm:text-base">+62 878-9012-3456</span>
                            </div>
                        </div>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=6287890123456&text=Halo%20Kelompok%201"
                        target="_blank"
                        class="whatsapp-btn text-white font-medium py-2 px-3 sm:px-4 rounded-lg flex items-center text-xs sm:text-sm">
                        <i class="fab fa-whatsapp mr-1 sm:mr-2"></i>
                        Hubungi
                    </a>
                </div>

                <!-- Kelompok 2 -->
                <div class="contact-card group-card bg-white rounded-lg shadow-md p-4 sm:p-5 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="contact-icon w-12 h-12 sm:w-12 sm:h-12 rounded-full bg-green-100 flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-users text-green-600 text-xl sm:text-xl"></i>
                        </div>
                        <div>
                            <h3 class="contact-name text-base sm:text-lg font-bold text-gray-800">Kelompok 2</h3>
                            <div class="flex items-center mt-1">
                                <i class="fab fa-whatsapp text-green-500 mr-1 sm:mr-2 text-sm sm:text-base"></i>
                                <span class="contact-number text-gray-700 text-sm sm:text-base">+62 857-1234-5678</span>
                            </div>
                        </div>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=6285712345678&text=Halo%20Kelompok%202"
                        target="_blank"
                        class="whatsapp-btn text-white font-medium py-2 px-3 sm:px-4 rounded-lg flex items-center text-xs sm:text-sm">
                        <i class="fab fa-whatsapp mr-1 sm:mr-2"></i>
                        Hubungi
                    </a>
                </div>

                <!-- Kelompok 3 -->
                <div class="contact-card group-card bg-white rounded-lg shadow-md p-4 sm:p-5 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="contact-icon w-12 h-12 sm:w-12 sm:h-12 rounded-full bg-green-100 flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-users text-green-600 text-xl sm:text-xl"></i>
                        </div>
                        <div>
                            <h3 class="contact-name text-base sm:text-lg font-bold text-gray-800">Kelompok 3</h3>
                            <div class="flex items-center mt-1">
                                <i class="fab fa-whatsapp text-green-500 mr-1 sm:mr-2 text-sm sm:text-base"></i>
                                <span class="contact-number text-gray-700 text-sm sm:text-base">+62 896-5432-1098</span>
                            </div>
                        </div>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=6289654321098&text=Halo%20Kelompok%203"
                        target="_blank"
                        class="whatsapp-btn text-white font-medium py-2 px-3 sm:px-4 rounded-lg flex items-center text-xs sm:text-sm">
                        <i class="fab fa-whatsapp mr-1 sm:mr-2"></i>
                        Hubungi
                    </a>
                </div>

                <!-- Kelompok 4 -->
                <div class="contact-card group-card bg-white rounded-lg shadow-md p-4 sm:p-5 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="contact-icon w-12 h-12 sm:w-12 sm:h-12 rounded-full bg-green-100 flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-users text-green-600 text-xl sm:text-xl"></i>
                        </div>
                        <div>
                            <h3 class="contact-name text-base sm:text-lg font-bold text-gray-800">Kelompok 4</h3>
                            <div class="flex items-center mt-1">
                                <i class="fab fa-whatsapp text-green-500 mr-1 sm:mr-2 text-sm sm:text-base"></i>
                                <span class="contact-number text-gray-700 text-sm sm:text-base">+62 813-2468-1357</span>
                            </div>
                        </div>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone=6281324681357&text=Halo%20Kelompok%204"
                        target="_blank"
                        class="whatsapp-btn text-white font-medium py-2 px-3 sm:px-4 rounded-lg flex items-center text-xs sm:text-sm">
                        <i class="fab fa-whatsapp mr-1 sm:mr-2"></i>
                        Hubungi
                    </a>
                </div>
            </div>

            <div class="mt-8 sm:mt-12 text-center">
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-1 sm:mb-2">Butuh Bantuan?</h3>
                    <p class="text-xs sm:text-base text-gray-600 mb-3 sm:mb-4">Hubungi kami sekarang juga melalui WhatsApp</p>

                    <a href="https://api.whatsapp.com/send?phone=6281234567890&text=Halo%20saya%20membutuhkan%20bantuan"
                        target="_blank"
                        class="whatsapp-btn text-white font-medium py-2 sm:py-3 px-4 sm:px-6 rounded-lg flex items-center justify-center mx-auto text-xs sm:text-sm">
                        <i class="fab fa-whatsapp mr-1 sm:mr-2"></i>
                        Chat Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-12 sm:mt-20">
        @include('footer')
    </div>

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

        // Prevent zoom on double tap for better mobile UX
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(event) {
            const now = new Date().getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
    </script>
</body>

</html>