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

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }

        .product-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .product-card-content {
            padding: 1rem;
        }

        /* Loading overlay for smooth transition */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #0097D4;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 640px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 1rem;
            }

            .product-card img {
                height: 160px;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-white">
    @include('navbar')

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
        <form action="{{ route('produk.index') }}" method="GET">
            <div class="mt-8 flex items-center space-x-3">
                <input type="text" name="search" placeholder="Cari Produk ...."
                    class="px-4 py-2 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-[#0097D4] text-gray-700 w-64"
                    value="{{ request('search') }}" />
                <button type="submit"
                    class="bg-[#0097D4] hover:bg-[#007bb3] text-white px-6 py-2 rounded-lg shadow-md font-semibold transition">
                    Cari
                </button>
            </div>
        </form>
    </section>

    <div class="max-w-7xl mx-auto mt-8 px-6 grid grid-cols-12 gap-6">
        <div class="col-span-12 md:col-span-3">
            <form id="kategoriForm" action="{{ route('produk.index') }}" method="GET">
                <div class="p-5 rounded-lg shadow-md border">
                    <h2 class="text-xl font-semibold mb-4">Kelompok</h2>
                    <div class="space-y-3 text-gray-700">
                        @foreach (App\Models\Kelompok::all() as $kelompok)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="kategori" value="{{ $kelompok->nama }}" class="w-4 h-4 kategori"
                                {{ request('kategori') === $kelompok->nama ? 'checked' : '' }}>
                            <span>{{ $kelompok->nama }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="flex flex-col space-y-3 mt-6">
                        <button type="submit" class="w-full bg-[#0097D4] text-white py-2 rounded-lg font-medium hover:bg-[#007bb3]">Terapkan</button>
                        <button type="button" id="resetBtn" class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-medium hover:bg-gray-400">Reset</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- card produk -->
        <div id="produk-carousel" class="col-span-12 md:col-span-9 product-grid">
            @foreach ($produk as $item)
            <a href="{{ route('detail_produk.show', $item->id_produk) }}" class="block no-underline">
                <div class="product-card">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                    <div class="product-card-content">
                        <h3 class="font-semibold text-lg text-gray-800 truncate">{{ $item->nama }}</h3>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-green-600 font-bold text-lg">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-sm">Stok: {{ $item->stok }}</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-6 col-span-12 flex justify-center">
            {{ $produk->links() }}
        </div>
    </div>

    <div class="mt-20">
        @include('footer')
    </div>

    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        const kategoriCheckboxes = document.querySelectorAll(".kategori");
        const kategoriForm = document.getElementById("kategoriForm");
        const loadingOverlay = document.getElementById("loadingOverlay");

        // Handle checkbox exclusivity (only one checkbox can be checked at a time)
        kategoriCheckboxes.forEach(cb => {
            cb.addEventListener("change", (e) => {
                if (e.target.checked) {
                    kategoriCheckboxes.forEach(other => {
                        if (other !== e.target) {
                            other.checked = false;
                        }
                    });
                }
            });
        });

        function showLoading() {
            loadingOverlay.classList.add("active");
        }

        kategoriForm.addEventListener("submit", (e) => {
            showLoading();
        });

        document.getElementById("resetBtn").addEventListener("click", () => {
            kategoriCheckboxes.forEach(cb => cb.checked = false);
            showLoading();
            kategoriForm.submit();
        });
    </script>
</body>

</html>