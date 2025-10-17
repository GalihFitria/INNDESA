<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom shadow tipis dan hitam di bagian atas footer */
        .custom-shadow {
            box-shadow: 0 -8px 15px -3px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="bg-gray-100">
    <footer class="bg-gradient-to-r from-blue-800 to-cyan-400 text-white py-8 px-4 custom-shadow">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-lg sm:text-2xl font-bold mb-6">Narahubung INNDESA</h2>

                <!-- Kontak -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8 max-w-lg mx-auto">
                    <!-- Telepon -->
                    <div class="flex items-center justify-start sm:justify-center space-x-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-sm sm:text-base">Telepon</h3>
                            <p class="text-xs sm:text-sm opacity-90">+62 823-2490-0948</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center justify-start sm:justify-center space-x-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                        </div>
                        <div class="text-left flex-1 min-w-0">
                            <h3 class="font-semibold text-sm sm:text-base">Email</h3>
                            <p class="text-xs sm:text-sm opacity-90 whitespace-nowrap overflow-visible">
                                inndesa.official@gmail.com
                            </p>
                        </div>
                    </div>


                </div>

                <!-- Copyright -->
                <div class="mt-6 pt-6 border-t border-white/20 text-center">
                    <p class="text-xs sm:text-sm opacity-75">© 2025 INNDESA - Inovasi Nusantara Desa Integratif Pangan</p>
                    <!-- <p class="text-[10px] sm:text-xs opacity-60 mt-1">PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala</p> -->
                </div>
            </div>
        </div>
    </footer>
</body>

</html>