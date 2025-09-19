<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white">
    @include('navbar')

    <div class="bg-gradient-to-b from-sky-400 to-sky-800 h-64 sm:h-80 md:h-96 flex items-center justify-center px-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white text-center">Publikasi</h1>
    </div>

    <div class="flex justify-center -mt-20 px-4">
    <!-- Made card more compact for mobile with smaller padding and text -->
    <div class="bg-gray-200 p-4 sm:p-8 rounded-2xl shadow-2xl shadow-gray-500/50 w-full max-w-3xl">
        <h2 class="text-lg sm:text-2xl font-medium mb-4 sm:mb-6 text-center">Bagikan laman ini</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://example.com" target="_blank"
                class="flex items-center bg-[#3b5998] hover:bg-[#334d84] text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md">
                <!-- Made icon and text smaller for mobile -->
                <i class="fab fa-facebook-f text-sm sm:text-lg mr-2 sm:mr-3"></i>
                <span class="text-sm sm:text-base">Share on Facebook</span>
            </a>

            <a href="https://twitter.com/intent/tweet?url=https://example.com&text=Check%20out%20this%20page!" target="_blank"
                class="flex items-center bg-[#1DA1F2] hover:bg-[#0d8ddb] text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md">
                <i class="fab fa-twitter text-sm sm:text-lg mr-2 sm:mr-3"></i>
                <span class="text-sm sm:text-base">Share on Twitter</span>
            </a>

            <a href="https://www.instagram.com/fijarrfqh_/"
                class="flex items-center bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 hover:opacity-90 text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md">
                <i class="fab fa-instagram text-sm sm:text-lg mr-2 sm:mr-3"></i>
                <span class="text-sm sm:text-base">Share on Instagram</span>
            </a>

            <a href="https://api.whatsapp.com/send?phone=6289647038212&text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                rel="noopener noreferrer"
                class="flex items-center bg-[#25D366] hover:bg-[#1ebe57] text-white py-2 sm:py-3 px-3 sm:px-4 rounded-md shadow-md">
                <i class="fab fa-whatsapp text-sm sm:text-lg mr-2 sm:mr-3"></i>
                <span class="text-sm sm:text-base">Chat via WhatsApp</span>
            </a>

        </div>
    </div>
</div>


    <div class="mt-20">
        @include('footer')
    </div>

</body>

</html>