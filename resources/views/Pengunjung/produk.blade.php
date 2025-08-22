<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
    </style>
</head>

<body class="min-h-screen bg-white">
    <!-- Navbar -->
    @include('navbar')

    <!-- Hero Section -->
    <!-- Tambahkan link font Poppins di head -->

    <section class="relative text-white overflow-hidden min-h-[550px] flex flex-col items-center pt-32"
        style="background-image: url('{{ asset('images/background_beranda_INNDESA.jpeg') }}'); background-size: cover; background-position: center; font-family: 'Poppins', sans-serif;">

        <div class="text-center text-[#0097D4] leading-snug space-y-3">
            <h2 class="text-2xl md:text-3xl font-bold">
                Ditengah alam yang melimpah, hanya tangan-tangan
            </h2>
            <h2 class="text-2xl md:text-3xl font-bold">
                terampil yang mampu mengolahnya jadi berkah.
            </h2>
            <h2 class="text-2xl md:text-3xl font-bold">
                karena setiap hasil tani dan perikanan punya keunikan
            </h2>
            <h2 class="text-2xl md:text-3xl font-bold">
                yang layak dibanggakan.
            </h2>
        </div>

        <!-- Search + Button -->
        <div class="mt-8 flex items-center space-x-3">
            <input type="text" placeholder="Cari Produk ...."
                class="px-4 py-2 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-[#0097D4] text-gray-700 w-64" />
            <button
                class="bg-[#0097D4] hover:bg-[#007bb3] text-white px-6 py-2 rounded-lg shadow-md font-semibold transition">
                Jelajahi Produk
            </button>
        </div>
    </section>

    <!-- Konten -->
    <div class="max-w-7xl mx-auto mt-8 px-6 grid grid-cols-12 gap-6">

        <!-- Sidebar Kategori -->
        <div class="col-span-12 md:col-span-3">
            <div class="p-5 rounded-lg shadow-md border">
                <h2 class="text-xl font-semibold mb-4">Kategori</h2>
                <div class="space-y-3 text-gray-700">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="w-4 h-4 kategori">
                        <span>Kelompok Tani Wanita Sida Megar</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="w-4 h-4 kategori">
                        <span>Kelompok Tani Milenial</span>
                    </label>
                </div>
                <div class="flex flex-col space-y-3 mt-6">
                    <button class="w-full bg-[#0097D4] text-white py-2 rounded-lg font-medium hover:bg-[#007bb3]">Terapkan</button>
                    <button id="resetBtn" class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-medium hover:bg-gray-400">Reset</button>
                </div>
            </div>
        </div>

        <!-- Produk -->
        <div class="col-span-12 md:col-span-9 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            <!-- Card Produk -->
            <a href="{{ route('detail_produk.index', ['id' => 1]) }}" class="block no-underline">
                <div class="border rounded-lg shadow-md p-3 hover:bg-gray-50 transition">
                    <img src="{{ asset('images/Abon Lele.jpeg')}}" alt="Abon Lele" class="w-full h-40 object-cover rounded-lg">
                    <h3 class="mt-3 font-semibold text-lg">Abon Lele</h3>
                    <div class="flex items-center gap-x-6 pb-2">
                        <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                        <p class="text-black-500 text-bold">stok: 5</p>
                    </div>
                </div>
            </a>

            <!-- Card Produk -->
            <div class="border rounded-lg shadow-md p-3">
                <img src="{{ asset('images/Jahe Instan.jpeg') }}" alt="Jahe Instant" class="w-full h-40 object-cover rounded-lg">
                <h3 class="mt-3 font-semibold text-lg">Jahe Instant</h3>
                <div class="flex items-center gap-x-6 pb-2">
                    <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                    <p class="text-black-500 text-bold">stok: 5</p>
                </div>
            </div>

            <!-- Card Produk -->
            <div class="border rounded-lg shadow-md p-3">
                <img src="{{ asset('images/Kripik Pisang.jpeg') }}" alt="Kripik Pisang" class="w-full h-40 object-cover rounded-lg">
                <h3 class="mt-3 font-semibold text-lg">Kripik Pisang</h3>
                <div class="flex items-center gap-x-6 pb-2">
                    <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                    <p class="text-black-500 text-bold">stok: 5</p>
                </div>
            </div>

            <!-- Tambahan produk lain -->
            <div class="border rounded-lg shadow-md p-3">
                <img src="{{ asset('images/bawang_merah.jpg') }}" alt="Bawang Merah" class="w-full h-40 object-cover rounded-lg">
                <h3 class="mt-3 font-semibold text-lg">Bawang Merah</h3>
                <div class="flex items-center gap-x-6 pb-2">
                    <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                    <p class="text-black-500 text-bold">stok: 5</p>
                </div>
            </div>

            <div class="border rounded-lg shadow-md p-3">
                <img src="{{ asset('images/Jamur_Tiram.jpg') }}" alt="Jamur Tiram" class="w-full h-40 object-cover rounded-lg">
                <h3 class="mt-3 font-semibold text-lg">Jamur Tiram</h3>
                <div class="flex items-center gap-x-6 pb-2">
                    <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                    <p class="text-black-500 text-bold">stok: 5</p>
                </div>
            </div>

            <div class="border rounded-lg shadow-md p-3">
                <img src="#" alt="Kripik Singkong" class="w-full h-40 object-cover rounded-lg">
                <h3 class="mt-3 font-semibold text-lg">Kripik Singkong</h3>
                <div class="flex items-center gap-x-6 pb-2">
                    <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                    <p class="text-black-500 text-bold">stok: 5</p>
                </div>
            </div>

        </div>
    </div>



    <div class="mt-20">
        @include('footer')
    </div>

</body>
<script>
    const kategoriCheckboxes = document.querySelectorAll(".kategori");

    kategoriCheckboxes.forEach(cb => {
        cb.addEventListener("change", (e) => {
            if (e.target.checked) {
                // Uncheck semua checkbox lain
                kategoriCheckboxes.forEach(other => {
                    if (other !== e.target) {
                        other.checked = false;
                    }
                });
            }
        });
    });

    // Reset Checkbox
    document.getElementById("resetBtn").addEventListener("click", () => {
        document.querySelectorAll(".kategori").forEach(cb => cb.checked = false);
    });
</script>

</html>