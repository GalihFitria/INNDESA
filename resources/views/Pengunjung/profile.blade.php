<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Tim - INNDESA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="Profile Tim - INNDESA">
    <meta property="og:description" content="Kenali tim di balik INNDESA - Inovasi Nusantara Desa Integratif Pangan">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Profile Tim - INNDESA">
    <meta name="twitter:description" content="Kenali tim di balik INNDESA - Inovasi Nusantara Desa Integratif Pangan">
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

        /* Profile Card Styles */
        .profile-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .profile-image {
            transition: all 0.5s ease;
            border-radius: 50%;
            object-fit: cover;
            width: 200px;
            height: 200px;
            border: 5px solid white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .profile-card:hover .profile-image {
            transform: scale(1.05);
        }

        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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

<body class="min-h-screen bg-white font-['Poppins']">
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>

    <div id="content">
        <!-- Navbar - Sama seperti di halaman lain -->
        @include('Navbar')

        <!-- Hero Section -->
        <div class="bg-gradient-to-b from-sky-400 to-sky-800 h-64 sm:h-80 md:h-96 flex items-center justify-center px-4 hero-section">
            <h1 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white text-center">Profile Tim</h1>
        </div>

        <!-- Profile Section -->
        <section class="py-12 sm:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-sky-800 mb-4">Tim Kami</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">Kenali lebih dekat anggota tim yang berdedikasi di balik INNDESA</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                    <!-- Profile 1 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden profile-card fade-in">
                        <div class="pt-10 pb-6 px-6 text-center">
                            <div class="flex justify-center mb-6">
                                <img src="{{ asset('images/fijar.jpg') }}" alt="Profile" class="profile-image">
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Galih Fitria Fijar Rofiqoh</h3>

                            <div class="flex items-center justify-center mb-4 mt-6">
                                <i class="fas fa-graduation-cap text-sky-600 text-xl mr-3"></i>
                                <div class="text-left">
                                    <!-- <p class="text-sm text-gray-500">Pendidikan</p> -->
                                    <p class="font-medium">Politeknik Negeri Cilacap</p>
                                    <p class="text-sm text-gray-600">D3 Teknik Informatika</p>
                                </div>
                            </div>

                            <p class="text-gray-600 mb-6 text-left">
                                Mahasiswa Teknik Informatika dengan minat di bidang pengembangan web dan desain UI/UX. Terampil dalam membangun antarmuka yang interaktif serta memahami alur pengguna untuk menciptakan pengalaman digital yang optimal.
                            </p>

                            <div class="flex justify-center space-x-4">
                                <a href="https://www.linkedin.com/in/galih-fitria-fijar-rofiqoh-4b6602294/" class="social-icon text-blue-700 hover:text-blue-900">
                                    <i class="fab fa-linkedin text-2xl"></i>
                                </a>
                                <a href="https://www.instagram.com/fijarrfqh_/" class="social-icon text-pink-600 hover:text-pink-800">
                                    <i class="fab fa-instagram text-2xl"></i>
                                </a>
                                <a href="https://github.com/GalihFitria" class="social-icon text-gray-800 hover:text-black">
                                    <i class="fab fa-github text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile 2 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden profile-card fade-in">
                        <div class="pt-10 pb-6 px-6 text-center">
                            <div class="flex justify-center mb-6">
                                <img src="{{ asset('images/windy.jpg') }}" alt="Profile" class="profile-image">
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">Windy Anggita Putri</h3>

                            <div class="flex items-center justify-center mb-4 mt-6">
                                <i class="fas fa-graduation-cap text-sky-600 text-xl mr-3"></i>
                                <div class="text-left">
                                    <!-- <p class="text-sm text-gray-500">Pendidikan</p> -->
                                    <p class="font-medium">Politeknik Negeri Cilacap</p>
                                    <p class="text-sm text-gray-600">D3 Teknik Informatika</p>
                                </div>
                            </div>

                            <p class="text-gray-600 mb-6 text-left">
                                Mahasiswa Teknik Informatika dengan minat di bidang pengembangan web dan desain UI/UX. Terampil dalam membangun antarmuka yang interaktif serta memahami alur pengguna untuk menciptakan pengalaman digital yang optimal.
                            </p>

                            <div class="flex justify-center space-x-4">
                                <a href="https://www.linkedin.com/in/windyanggitaputri?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="social-icon text-blue-700 hover:text-blue-900">
                                    <i class="fab fa-linkedin text-2xl"></i>
                                </a>
                                <a href="https://www.instagram.com/windyanggitaa_" class="social-icon text-pink-600 hover:text-pink-800">
                                    <i class="fab fa-instagram text-2xl"></i>
                                </a>
                                <a href="https://github.com/WindyAnggitaPutri" class="social-icon text-gray-800 hover:text-black">
                                    <i class="fab fa-github text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="mt-20">
            @include('footer')
        </div>

        <!-- KEMBALI KEATAS -->
        <a href="#" id="backToTop" title="Kembali ke Atas">
            <i class="fas fa-arrow-up"></i>
        </a>
    </div>

    <script>
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

        // Add fade-in animation to elements on scroll
        const fadeElements = document.querySelectorAll('.fade-in');
        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        fadeElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease-out';
            fadeObserver.observe(el);
        });
    </script>
</body>

</html>