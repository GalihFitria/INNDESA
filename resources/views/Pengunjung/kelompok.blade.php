<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - {{ $kelompok->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-subtitle {
            text-shadow: 1px 1px 0px #ffffff, -1px -1px 0px #ffffff, 1px -1px 0px #ffffff, -1px 1px 0px #ffffff;
            -webkit-text-stroke: 0.5px #ffffff;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
        }

        .dot {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            margin: 0 0.25rem;
            cursor: pointer;
        }
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">
    @include('navbar')

    <section class="relative text-white overflow-hidden min-h-[550px] flex flex-col items-center pt-32 {{ $kelompok->background ? 'bg-[url(\'' . asset('storage/' . $kelompok->background) . '\')]' : 'bg-gray-800' }} bg-cover bg-center">
        <div class="text-center space-y-5 mt-20">
            <div class="absolute top-12 left-16 flex items-center space-x-3">
                @if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo))
                @php
                $extension = pathinfo($kelompok->logo, PATHINFO_EXTENSION);
                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                @endphp
                @if ($isImage)
                <img
                    src="{{ asset('storage/' . $kelompok->logo) }}"
                    alt="Logo {{ $kelompok->getKodeKelompokAttribute() }}"
                    class="h-24 w-auto max-h-32 object-contain"
                    onerror="this.src='{{ asset('images/fallback-logo.png') }}'">
                @else
                <a
                    href="{{ asset('storage/' . $kelompok->logo) }}"
                    target="_blank"
                    class="text-blue-400 hover:text-blue-600 text-xl"
                    aria-label="View logo in PDF format">
                    View Logo (PDF)
                </a>
                @endif
                @else
                <img
                    src="{{ asset('images/fallback-logo.png') }}"
                    alt="Default Logo"
                    class="h-24 w-auto max-h-32 object-contain">
                @endif
            </div>
            <h2 class="text-5xl md:text-7xl font-bold text-[#0097D4]">
                Kelompok {{ $kelompok->nama }}
            </h2>
        </div>
    </section>

    <h2 class="text-4xl font-bold text-blue-600 text-center mb-8 mt-10">Profil Kelompok</h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border">
        <div class="bg-white p-6 max-w-4xl mx-auto">
            <div class="flex rounded-lg overflow-hidden bg-gray-200">
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white" onclick="openTab('struktur', 'profile')" aria-label="Lihat Struktur">Struktur</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('sejarah', 'profile')" aria-label="Lihat Sejarah">Sejarah</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('sk-desa', 'profile')" aria-label="Lihat SK Desa">SK Desa</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('kelompok-rentan', 'profile')" aria-label="Lihat Kelompok Rentan">Kelompok Rentan</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('total-produk', 'profile')" aria-label="Lihat Total Produk">Total Produk</button>
            </div>

            <!-- STRUKTUR -->
            <div id="struktur" class="profile-tab-content block py-4">
                <table class="w-full border-collapse mb-6 border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="border border-gray-200 p-3 text-left font-semibold">Posisi</th>
                            <th class="border border-gray-200 p-3 text-left font-semibold">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($struktur as $item)
                        <tr>
                            <td class="border border-gray-200 p-3">{{ $item->jabatan }}</td>
                            <td class="border border-gray-200 p-3">{{ $item->nama }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center p-4 text-gray-500">
                                Tidak ada data struktur organisasi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- SEJARAH -->
            <div id="sejarah" class="profile-tab-content hidden py-4">
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
                    <p class="indent-8">
                        {{ $kelompok->sejarah ?? 'Belum ada data sejarah untuk kelompok ini.' }}
                    </p>
                </div>
            </div>

            <!-- SK DESA -->
            <div id="sk-desa" class="profile-tab-content hidden py-4">
                <div class="relative">
                    @if ($kelompok && $kelompok->sk_desa)
                    @php
                    $extension = pathinfo($kelompok->sk_desa, PATHINFO_EXTENSION);
                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                    @endphp
                    <div id="sk-desa-carousel" class="carousel">
                        @if ($isImage)
                        <img
                            src="{{ asset('storage/' . $kelompok->sk_desa) }}"
                            alt="SK Desa {{ $kelompok->getKodeKelompokAttribute() }}"
                            class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer"
                            onclick="openPreview('{{ asset('storage/' . $kelompok->sk_desa) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}')"
                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                        @else
                        <iframe
                            src="{{ asset('storage/' . $kelompok->sk_desa) }}"
                            type="application/pdf"
                            class="w-full max-w-[30rem] mx-auto h-60 rounded-lg shadow-md border border-gray-200"
                            title="SK Desa {{ $kelompok->getKodeKelompokAttribute() }}">
                        </iframe>
                        @endif
                    </div>
                    <div class="flex justify-center space-x-2 mt-4 hidden" id="sk-desa-dots"></div>
                    <div class="flex justify-center mt-4 hidden" id="sk-desa-nav">
                        <button class="btn btn-outline mr-2" onclick="prevSlide('sk-desa')" aria-label="Previous slide">←</button>
                        <button class="btn btn-outline" onclick="nextSlide('sk-desa')" aria-label="Next slide">→</button>
                    </div>
                    @else
                    <p class="text-center text-gray-500">Tidak ada data SK Desa yang tersedia.</p>
                    @endif
                </div>
            </div>

            <!-- KELOMPOK RENTAN -->
            <div id="kelompok-rentan" class="profile-tab-content hidden py-4">
                @if ($rentanCategories->isNotEmpty())
                <table class="w-full border-collapse mt-4 border border-gray-200">
                    <thead>
                        <tr>
                            @foreach ($rentanCategories as $category)
                            <th class="border border-gray-200 p-2 text-left">{{ $category }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $maxRows = max(array_map(function($category) use ($rentanGrouped) {
                        return isset($rentanGrouped[$category]) ? $rentanGrouped[$category]->count() : 0;
                        }, $rentanCategories->toArray()));
                        @endphp
                        @for ($i = 0; $i < $maxRows; $i++)
                            <tr>
                            @foreach ($rentanCategories as $category)
                            <td class="border border-gray-200 p-2">
                                @if (isset($rentanGrouped[$category]) && isset($rentanGrouped[$category][$i]))
                                {{ $rentanGrouped[$category][$i]->nama_anggota }}
                                @else
                                &nbsp;
                                @endif
                            </td>
                            @endforeach
                            </tr>
                            @endfor
                    </tbody>
                </table>
                @else
                <p class="text-center text-gray-500">Tidak ada data kelompok rentan yang tersedia.</p>
                @endif
            </div>

            <!-- TOTAL PRODUK -->
            <div id="total-produk" class="profile-tab-content hidden py-4">
                @if ($produk->isNotEmpty())
                <table class="w-full border-collapse mt-4 border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 p-2 text-left">Nama Produk</th>
                            <th class="border border-gray-200 p-2 text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $item->nama }}</td>
                            <td class="border border-gray-200 p-2">{{ $item->stok }} pcs</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center text-gray-500">Tidak ada data produk yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <h2 class="text-4xl font-bold text-blue-600 text-center mb-8">Informasi</h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border">
        <div class="bg-white p-6 max-w-4xl mx-auto">
            <div class="flex rounded-lg overflow-hidden bg-gray-200">
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white" onclick="openTab('produk', 'info')" aria-label="Lihat Produk">Produk</button>
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('kegiatan', 'info')" aria-label="Lihat Kegiatan">Kegiatan</button>
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('inovasi', 'info')" aria-label="Lihat Inovasi & Penghargaan">Inovasi & Penghargaan</button>
            </div>


            <div id="produk" class="info-tab-content block py-4">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-x-6">
                        <div class="text-green-600 font-medium">Total Produk Terjual: {{ $totalProdukTerjual }}</div>
                        <a href="https://wa.me/6289647038212?text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                            rel="noopener noreferrer"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium"
                            aria-label="Kontak via WhatsApp">
                            <span>Kontak</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-x-4">
                        @if($katalog && $katalog->katalog)
                        <a href="{{ asset('storage/' . $katalog->katalog) }}"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium"
                            aria-label="Lihat Katalog">
                            Katalog
                        </a>
                        @else
                        <span class="text-gray-500">Katalog tidak tersedia</span>
                        @endif
                        <input type="text" id="searchProduk" placeholder="Cari Produk..."
                            class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500"
                            aria-label="Cari Produk">
                    </div>
                </div>

                <!-- PRODUK -->
                <div class="relative">
                    <div id="produk-carousel" class="carousel grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($produk as $item)
                        <a href="{{ route('detail_produk.show', $item->id_produk) }}" class="block no-underline">
                            <div class="border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto cursor-pointer">
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    class="w-full h-40 object-cover rounded-lg"
                                    onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                <h3 class="mt-3 font-semibold text-lg truncate">{{ $item->nama }}</h3>
                                <div class="flex items-center justify-between pb-2">
                                    <p class="text-green-600 font-bold text-lg truncate">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    <p class="text-black-500 text-sm truncate">Stok: {{ $item->stok }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="flex justify-center space-x-2 mt-4 hidden" id="produk-dots"></div>
                    <div class="flex justify-center mt-4 hidden" id="produk-nav">
                        <button class="btn btn-outline mr-2" onclick="prevSlide('produk')" aria-label="Previous slide">←</button>
                        <button class="btn btn-outline" onclick="nextSlide('produk')" aria-label="Next slide">→</button>
                    </div>
                </div>
            </div>

            <!-- KEGIATAN -->
            <div id="kegiatan" class="info-tab-content hidden py-4">
                <div class="flex items-center justify-end mb-4">
                    <input type="text" placeholder="Cari Kegiatan..."
                        class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500"
                        aria-label="Cari Kegiatan">
                </div>
                <div class="relative">
                    <div id="kegiatan-carousel" class="carousel grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        @if ($kegiatan->isNotEmpty())
                        @foreach ($kegiatan as $item)
                        <a href="{{ route('update_kegiatan.show', $item->id_kegiatan) }}" class="block no-underline">
                            <div class="bg-white text-black rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow w-[200px] min-h-[300px] mx-auto cursor-pointer">
                                <div class="h-40">
                                    @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover rounded-t-lg"
                                        style="max-height: 160px;"
                                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    @else
                                    <img src="{{ asset('images/placeholder.jpg') }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover rounded-t-lg"
                                        style="max-height: 160px;">
                                    @endif
                                </div>
                                <div class="p-4 flex flex-col justify-between h-[180px]">
                                    <div>
                                        <h3 class="font-bold text-sm mb-2 leading-tight line-clamp-2">{{ $item->judul }}</h3>
                                        <p class="text-xs opacity-75 mb-2 line-clamp-3">{{ $item->deskripsi }}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs opacity-75 truncate">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</p>
                                    </div>
                                    <button class="btn btn-blue text-xs px-3 py-1">Baca Selengkapnya</button>

                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                        <p>Tidak ada kegiatan yang tersedia.</p>
                        @endif
                    </div>
                    <div class="flex justify-center space-x-2 mt-4" id="kegiatan-dots"></div>
                    <div class="flex justify-center mt-4" id="kegiatan-nav">
                        <button class="btn btn-outline mr-2" onclick="prevSlide('kegiatan')" aria-label="Previous slide">←</button>
                        <button class="btn btn-outline" onclick="nextSlide('kegiatan')" aria-label="Next slide">→</button>
                    </div>
                </div>
            </div>

            <!-- INOVASI & PENGHARGAAN -->
            <div id="inovasi" class="info-tab-content hidden py-4">
                <div class="relative">
                    @if ($inovasiImages->isNotEmpty())
                    <div id="inovasi-carousel" class="carousel">
                        @foreach ($inovasiImages as $index => $inovasi)
                        @php
                        $extension = pathinfo($inovasi->foto, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                        @endphp
                        @if ($isImage)
                        <img
                            src="{{ asset('storage/' . $inovasi->foto) }}"
                            alt="Inovasi {{ $inovasi->getKodeInovasiAttribute() }}"
                            class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer {{ $index === 0 ? 'block' : 'hidden' }}"
                            onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}')"
                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                        @else

                        <div
                            class="w-full max-w-[30rem] mx-auto h-60 rounded-lg shadow-md border border-gray-200 cursor-pointer {{ $index === 0 ? 'block' : 'hidden' }}"
                            onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}', 'pdf')">
                            <object
                                data="{{ asset('storage/' . $inovasi->foto) }}#view=FitH"
                                type="application/pdf"
                                class="w-full h-full rounded-lg"
                                title="Inovasi {{ $inovasi->getKodeInovasiAttribute() }}">
                                <p>PDF tidak dapat ditampilkan. <a href="{{ asset('storage/' . $inovasi->foto) }}" target="_blank">Klik untuk membuka di tab baru</a></p>
                            </object>
                        </div>

                        @endif
                        @endforeach
                    </div>
                    <div class="flex justify-center space-x-2 mt-4" id="inovasi-dots"></div>
                    <div class="flex justify-center mt-4">
                        <button class="btn btn-outline mr-2" onclick="prevSlide('inovasi')" aria-label="Previous slide">←</button>
                        <button class="btn btn-outline" onclick="nextSlide('inovasi')" aria-label="Next slide">→</button>
                    </div>
                    @else
                    <p class="text-center text-gray-500">Tidak ada data inovasi atau penghargaan yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50" tabindex="-1" role="dialog" aria-labelledby="previewTitle">
        <div class="bg-white rounded-lg p-6 max-w-3xl w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="previewTitle" class="text-xl font-semibold text-gray-800"></h3>
                <button onclick="closePreview()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close preview modal">&times;</button>
            </div>
            <img id="previewImage" src="" alt="Preview" class="w-full max-h-[70vh] object-contain rounded-lg">
        </div>
    </div>

    @include('footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi carousel
            ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => initializeCarousel(section));

            // Fungsi pencarian produk
            const searchInput = document.getElementById('searchProduk');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    const produkItems = document.querySelectorAll('.produk-item');

                    // Jika kosong, tampilkan semua
                    if (searchTerm === '') {
                        produkItems.forEach(item => {
                            item.style.display = 'block';
                        });
                    } else {
                        // Filter berdasarkan nama produk
                        produkItems.forEach(item => {
                            const productName = item.getAttribute('data-nama');
                            if (productName.includes(searchTerm)) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    }

                    // Reset carousel ke halaman pertama dan perbarui
                    carousels['produk'].current = 0;
                    initializeCarousel('produk');
                });
            }
        });


        function openTab(tabId, tabType) {
            const tabClass = tabType === 'profile' ? 'profile-tab-content' : 'info-tab-content';
            const buttonClass = tabType === 'profile' ? 'profile-tab-button' : 'info-tab-button';
            const tabs = document.querySelectorAll(`.${tabClass}`);
            const buttons = document.querySelectorAll(`.${buttonClass}`);

            tabs.forEach(tab => {
                tab.classList.add('hidden');
                tab.classList.remove('block');
            });
            buttons.forEach(button => {
                button.classList.remove('bg-[#0097D4]', 'text-white');
                button.classList.add('bg-gray-200', 'text-gray-700');
                if (button.getAttribute('onclick').includes(tabId)) {
                    button.classList.add('bg-[#0097D4]', 'text-white');
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                }
            });
            const activeTab = document.getElementById(tabId);
            activeTab.classList.remove('hidden');
            activeTab.classList.add('block');
        }

        function openPreview(imageSrc, title) {
            const modal = document.getElementById('previewModal');
            const previewImage = document.getElementById('previewImage');
            const previewTitle = document.getElementById('previewTitle');
            previewImage.src = imageSrc;
            previewTitle.textContent = title;
            modal.classList.remove('hidden');
            modal.focus();
        }

        function closePreview() {
            const modal = document.getElementById('previewModal');
            modal.classList.add('hidden');
        }

        const carousels = {
            'sk-desa': {
                current: 0,
                itemsPerPage: 1
            },
            'produk': {
                current: 0,
                itemsPerPage: 4
            },
            'kegiatan': {
                current: 0,
                itemsPerPage: 4
            },
            'inovasi': {
                current: 0,
                itemsPerPage: 1
            }
        };

        function initializeCarousel(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const dotsContainer = document.getElementById(`${section}-dots`);
            const navContainer = document.getElementById(`${section}-nav`);
            const items = carousel?.children;
            if (!items) return;

            const itemsPerPage = carousels[section].itemsPerPage;
            const pageCount = Math.ceil(items.length / itemsPerPage);

            dotsContainer.innerHTML = '';
            if (items.length > itemsPerPage) {
                dotsContainer.classList.remove('hidden');
                if (navContainer) navContainer.classList.remove('hidden');
                for (let i = 0; i < pageCount; i++) {
                    const dot = document.createElement('div');
                    dot.className = `dot ${i === 0 ? 'bg-blue-600' : 'bg-gray-300'}`;
                    dot.setAttribute('aria-label', `Go to page ${i + 1} in ${section} carousel`);
                    dot.dataset.index = i;
                    dot.addEventListener('click', () => {
                        carousels[section].current = i;
                        updateCarousel(section);
                    });
                    dotsContainer.appendChild(dot);
                }
            } else {
                dotsContainer.classList.add('hidden');
                if (navContainer) navContainer.classList.add('hidden');
            }

            updateCarousel(section);
        }

        function updateCarousel(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const dots = document.getElementById(`${section}-dots`).children;
            const items = carousel?.children;
            if (!items) return;

            const itemsPerPage = carousels[section].itemsPerPage;
            const currentPage = carousels[section].current;

            Array.from(items).forEach((item, i) => {
                item.classList.toggle('hidden', i < currentPage * itemsPerPage || i >= (currentPage + 1) * itemsPerPage);
            });

            Array.from(dots).forEach((dot, i) => {
                dot.classList.toggle('bg-blue-600', i === currentPage);
                dot.classList.toggle('bg-gray-300', i !== currentPage);
            });
        }

        function nextSlide(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const items = carousel?.children;
            if (!items) return;

            const itemsPerPage = carousels[section].itemsPerPage;
            const pageCount = Math.ceil(items.length / itemsPerPage);
            carousels[section].current = (carousels[section].current + 1) % pageCount;
            updateCarousel(section);
        }

        function prevSlide(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const items = carousel?.children;
            if (!items) return;

            const itemsPerPage = carousels[section].itemsPerPage;
            const pageCount = Math.ceil(items.length / itemsPerPage);
            carousels[section].current = (carousels[section].current - 1 + pageCount) % pageCount;
            updateCarousel(section);
        }

        document.addEventListener('DOMContentLoaded', () => {
            ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => initializeCarousel(section));
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closePreview();
            if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => {
                    const nav = document.getElementById(`${section}-nav`);
                    if (nav && !nav.classList.contains('hidden')) {
                        e.key === 'ArrowRight' ? nextSlide(section) : prevSlide(section);
                    }
                });
            }
        });

        document.querySelectorAll('.btn-outline').forEach(btn => {
            btn.setAttribute('tabindex', '0');
            btn.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') btn.click();
            });
        });
    </script>
</body>

</html>