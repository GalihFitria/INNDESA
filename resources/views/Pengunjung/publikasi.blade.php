<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
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
                height: 48vw;
                /* Flexible height based on viewport width */
                min-height: 200px;
            }
        }
    </style>
</head>

<body class="bg-white">
    <!-- PRELOADER -->
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>

    @include('navbar')

    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-sky-400 to-sky-800 h-64 sm:h-80 md:h-96 flex items-center justify-center px-4 hero-section">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white text-center">Publikasi</h1>
    </div>

    <!-- Share Card -->
    <div class="flex justify-center -mt-20 px-4">
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

    <div class="mt-20">
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

        // Dynamic share links
        const currentUrl = encodeURIComponent(window.location.href);
        const shareText = encodeURIComponent("Check out this page from INNDESA!");

        // Update Facebook share link
        const facebookShare = document.getElementById("facebookShare");
        facebookShare.href = `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`;

        // Update Twitter share link
        const twitterShare = document.getElementById("twitterShare");
        twitterShare.href = `https://twitter.com/intent/tweet?url=${currentUrl}&text=${shareText}`;

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