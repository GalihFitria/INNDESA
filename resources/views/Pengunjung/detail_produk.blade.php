<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
            width: 100%;
        }

        .product-image {
            width: 100%;
            height: 100%;
            max-width: 450px;
            max-height: 450px;
            object-fit: cover;
            object-position: center;
        }

        /* Custom style untuk card produk */
        .product-card {
            padding: 0.75rem;
            width: 200px;
            min-height: 280px;
        }

        .product-card h3 {
            margin-top: 0.5rem;
            font-size: 1.1rem;
        }

        .product-card .price {
            font-size: 1rem;
        }

        .product-card .stock {
            font-size: 0.9rem;
        }

        /* Style untuk container produk terkait */
        .related-products {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: flex-start;
        }
    </style>
</head>

<body class="bg-white">
    @include('navbar')
    <div class="content w-full mt-6 px-6 lg:px-12">
        <div class="bg-white card p-6 grid grid-cols-1 md:grid-cols-2 gap-6 min-h-[450px]">
            <div class="flex justify-center">
                <div class="flex justify-center items-center">
                    <div class="w-[450px] h-[450px] overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}" class="product-image w-full h-full">
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-gray-900">{{ $produk->nama }}</h1>
                <div class="flex items-center gap-x-6 border-b pb-2">
                    <p class="text-xl font-semibold text-gray-900">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="text-xl font-semibold text-gray-900">Stok: {{ $produk->stok }}</p>
                </div>
                <div class="w-full mt-6">
                    <div class="flex bg-gray-200 rounded-lg overflow-hidden">
                        <button id="tab-deskripsi"
                            onclick="openTab('deskripsi')"
                            class="flex-1 px-4 py-2 font-semibold bg-[#0097D4] text-white transition">
                            Deskripsi
                        </button>
                        <button id="tab-sertifikat"
                            onclick="openTab('sertifikat')"
                            class="flex-1 px-4 py-2 font-semibold bg-gray-200 text-gray-700 transition">
                            Sertifikat
                        </button>
                    </div>
                    <div id="content-deskripsi" class="mt-4">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>
                    <div id="content-sertifikat" class="hidden mt-4">
                        <img src="{{ asset('storage/' . $produk->sertifikat) }}"
                            alt="Sertifikat Produk"
                            class="product-image mx-auto mt-4 rounded-lg shadow-md border border-gray-200">
                    </div>
                </div>
                <div class="flex flex-col border-t border-gray-300 mt-4 pt-4">
                    <span class="text-gray-700 mb-2">Untuk pemesanan dapat menghubungi kami:</span>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('storage/' . $produk->kelompok->foto) }}" alt="Nama Penanggung Jawab" class="w-10 h-10 rounded-full">
                            <span class="text-gray-700 font-bold">{{ $produk->kelompok->nama }}</span>
                        </div>
                        <div class="relative">
                            <button onclick="toggleContactDropdown()"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                Hubungi Kami
                            </button>
                            <div id="contactDropdownMenu" class="hidden absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg">
                                <a href="https://wa.me/6281327661330"
                                    class="flex flex-col px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <span class="font-semibold">WhatsApp</span>
                                    <span class="text-sm text-gray-500">+62 813-2766-1330</span>
                                </a>
                                <a href="https://www.instagram.com/fijarrfqh_/"
                                    class="flex flex-col px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <span class="font-semibold">Instagram</span>
                                    <span class="text-sm text-gray-500">@fijarrfqh_</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Produk Lain dari Toko yang Sama -->
        <div class="mt-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Produk Lain dari Toko yang Sama</h2>
            <div class="relative">
                <div id="produk-carousel" class="related-products">
                    @php
                    // Ambil produk lain dari kelompok yang sama, kecuali produk saat ini
                    $produk_terkait = \App\Models\Produk::where('id_kelompok', $produk->id_kelompok)
                    ->where('id_produk', '!=', $produk->id_produk)
                    ->take(8)
                    ->get();
                    @endphp
                    @forelse ($produk_terkait as $item)
                    <a href="{{ route('detail_produk.show', $item->id_produk) }}" class="block no-underline">
                        <div class="border rounded-lg shadow-md product-card cursor-pointer hover:shadow-lg transition-shadow">
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama }}"
                                class="w-full h-40 object-cover rounded-lg"
                                onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                            <h3 class="font-semibold truncate">{{ $item->nama }}</h3>
                            <div class="flex items-center justify-between pb-1">
                                <p class="text-green-600 font-bold price truncate">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                <p class="text-black-500 stock truncate">Stok: {{ $item->stok }}</p>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Tidak ada produk lain dari toko ini</p>
                    </div>
                    @endforelse
                </div>
                <div class="flex justify-center space-x-2 mt-4 hidden" id="produk-dots"></div>
                <div class="flex justify-center mt-4 hidden" id="produk-nav">
                    <button class="btn btn-outline mr-2" onclick="prevSlide('produk')" aria-label="Previous slide">←</button>
                    <button class="btn btn-outline" onclick="nextSlide('produk')" aria-label="Next slide">→</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="w-full">
        @include('footer')
    </footer>
    <script>
        function openTab(tab) {
            document.getElementById('content-deskripsi').classList.add('hidden');
            document.getElementById('content-sertifikat').classList.add('hidden');
            document.getElementById('content-' + tab).classList.remove('hidden');
            document.getElementById('tab-deskripsi').classList.remove('bg-[#0097D4]', 'text-white');
            document.getElementById('tab-deskripsi').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-sertifikat').classList.remove('bg-[#0097D4]', 'text-white');
            document.getElementById('tab-sertifikat').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-' + tab).classList.remove('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-' + tab).classList.add('bg-[#0097D4]', 'text-white');
        }

        function toggleContactDropdown() {
            document.getElementById("contactDropdownMenu").classList.toggle("hidden");
        }
        document.addEventListener("click", function(event) {
            const dropdown = document.getElementById("contactDropdownMenu");
            const button = event.target.closest("button[onclick='toggleContactDropdown()']");
            if (!dropdown.contains(event.target) && !button) {
                dropdown.classList.add("hidden");
            }
        });
        // Fungsi untuk carousel produk terkait
        let currentSlide = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('#produk-carousel > a');
            if (slides.length === 0) return;
            if (index >= slides.length) currentSlide = 0;
            if (index < 0) currentSlide = slides.length - 1;
            slides.forEach((slide, i) => {
                slide.style.display = i === currentSlide ? 'block' : 'none';
            });
            updateDots();
        }

        function nextSlide() {
            currentSlide++;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide--;
            showSlide(currentSlide);
        }

        function updateDots() {
            const dots = document.querySelectorAll('#produk-dots > span');
            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-blue-500', i === currentSlide);
                dot.classList.toggle('bg-gray-300', i !== currentSlide);
            });
        }
        // Inisialisasi carousel
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('#produk-carousel > a');
            const dotsContainer = document.getElementById('produk-dots');
            const navContainer = document.getElementById('produk-nav');
            if (slides.length > 4) {
                // Tampilkan navigasi jika ada lebih dari 4 produk
                navContainer.classList.remove('hidden');
                // Buat indikator dots
                for (let i = 0; i < Math.ceil(slides.length / 4); i++) {
                    const dot = document.createElement('span');
                    dot.className = 'w-3 h-3 rounded-full bg-gray-300 inline-block mx-1 cursor-pointer';
                    dot.onclick = () => {
                        currentSlide = i * 4;
                        showSlide(currentSlide);
                    };
                    dotsContainer.appendChild(dot);
                }
                dotsContainer.classList.remove('hidden');
                // Tampilkan slide pertama
                showSlide(0);
            }
        });
    </script>
</body>

</html>