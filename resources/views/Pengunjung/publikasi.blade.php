<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome Free CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white">

    <!-- Include Navbar -->
    @include('navbar')

    <!-- Background Gradasi Biru -->
    <div class="bg-gradient-to-b from-sky-400 to-sky-800 h-96 flex items-center justify-center ">
        <h1 class="text-6xl font-extrabold text-white">Publikasi</h1>
    </div>

    <!-- Card -->
    <div class="flex justify-center -mt-20 px-4">
        <div class="bg-gray-200 p-8 rounded-2xl shadow-2xl shadow-gray-500/50 w-full max-w-3xl">
            <h2 class="text-2xl font-medium mb-6 text-center">Bagikan laman ini</h2>

            <!-- Grid Sosmed -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://example.com" target="_blank"
                    class="flex items-center bg-[#3b5998] hover:bg-[#334d84] text-white py-3 px-4 rounded-md shadow-md">
                    <i class="fab fa-facebook-f text-lg mr-3"></i>
                    Share on Facebook
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?url=https://example.com&text=Check%20out%20this%20page!" target="_blank"
                    class="flex items-center bg-[#1DA1F2] hover:bg-[#0d8ddb] text-white py-3 px-4 rounded-md shadow-md">
                    <i class="fab fa-twitter text-lg mr-3"></i>
                    Share on Twitter
                </a>

                <!-- Instagram -->
                <a href="https://www.instagram.com/fijarrfqh_/" target="_blank"
                    class="flex items-center bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 hover:opacity-90 text-white py-3 px-4 rounded-md shadow-md">
                    <i class="fab fa-instagram text-lg mr-3"></i>
                    Share on Instagram
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?phone=6289647038212&text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                    rel="noopener noreferrer"
                    class="flex items-center bg-[#25D366] hover:bg-[#1ebe57] text-white py-3 px-4 rounded-md shadow-md">
                    <i class="fab fa-whatsapp text-lg mr-3"></i>
                    Chat via WhatsApp
                </a>

            </div>
        </div>
    </div>

    <div class="mt-20">
        @include('footer')
    </div>

</body>

</html>