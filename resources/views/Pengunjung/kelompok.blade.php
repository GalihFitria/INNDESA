<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
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
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">

    @include('navbar')
    <section class="relative text-white overflow-hidden min-h-[550px] flex flex-col items-center pt-32 {{ $kelompok->background ? 'bg-[url(\'' . asset('storage/' . $kelompok->background) . '\')]' : 'bg-gray-800' }} bg-cover bg-center">
        <div class="text-center space-y-5 mt-20">
            <div class="absolute top-12 left-16 flex items-center space-x-3">
                @if (!empty($kelompok->logo) && Storage::disk('public')->exists($kelompok->logo))
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
                    class="text-blue-400 hover:text-blue-600 text-xl">
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

            <h2 class="text-7xl md:text-7xl font-bold text-[#0097D4]">
                Kelompok {{ $kelompok->nama }}
            </h2>
        </div>
    </section>

    <h2 class="text-4xl font-bold text-blue-600 text-center mb-8 mt-10">Profile Kelompok</h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border">
        <div class="bg-white p-6 max-w-4xl mx-auto">
            <div class="flex rounded-lg overflow-hidden bg-gray-200">
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white" onclick="openProfileTab('struktur')">Struktur</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openProfileTab('sejarah')">Sejarah</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openProfileTab('sk-desa')">SK Desa</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openProfileTab('kelompok-rentan')">Kelompok Rentan</button>
                <button class="profile-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openProfileTab('total-produk')">Total Produk</button>
            </div>
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
            <div id="sejarah" class="profile-tab-content hidden py-4">
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
                    <p class="indent-8">
                        {{ $kelompok->sejarah ?? 'Belum ada data sejarah untuk kelompok ini.' }}
                    </p>
                </div>
            </div>
            <div id="sk-desa" class="profile-tab-content hidden py-4">
                <div class="relative">
                    @if ($kelompok && $kelompok->sk_desa)
                    <div id="sk-desa-carousel" class="carousel">
                        @php
                        $skDesaFiles = [$kelompok->sk_desa]; // Ambil sk_desa sebagai array tunggal
                        $extension = pathinfo($kelompok->sk_desa, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                        @endphp
                        @foreach ($skDesaFiles as $index => $file)
                        @if ($isImage)
                        <img
                            src="{{ asset('storage/' . $file) }}"
                            alt="SK Desa {{ $kelompok->getKodeKelompokAttribute() }}"
                            class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer {{ $index === 0 ? 'block' : 'hidden' }}"
                            onclick="openPreview('{{ asset('storage/' . $file) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}')">
                        @else
                        <iframe
                            src="{{ asset('storage/' . $file) }}"
                            type="application/pdf"
                            class="w-full max-w-[30rem] mx-auto h-60 rounded-lg shadow-md border border-gray-200 {{ $index === 0 ? 'block' : 'hidden' }}"
                            onclick="openPreview('{{ asset('storage/' . $file) }}', 'SK Desa {{ $kelompok->getKodeKelompokAttribute() }}')">
                        </iframe>
                        @endif
                        @endforeach
                    </div>
                    <div class="flex justify-center space-x-2 mt-4" id="sk-desa-dots"></div>
                    <div class="flex justify-center mt-4">
                        <button class="btn btn-outline mr-2" onclick="prevSlide('sk-desa')">←</button>
                        <button class="btn btn-outline" onclick="nextSlide('sk-desa')">→</button>
                    </div>
                    @else
                    <p class="text-center text-gray-500">Tidak ada data SK Desa yang tersedia.</p>
                    @endif
                </div>
            </div>
            <div id="kelompok-rentan" class="profile-tab-content hidden py-4">
                @if ($rentanCategories->isNotEmpty())
                <table class="w-full border-collapse mt-4 border border-gray-200">
                    <tr>
                        @foreach ($rentanCategories as $category)
                        <th class="border border-gray-200 p-2 text-left">{{ $category }}</th>
                        @endforeach
                    </tr>
                    @php
                    // Hitung jumlah baris maksimum untuk setiap kategori
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
                </table>
                @else
                <p>Tidak ada data kelompok rentan yang tersedia.</p>
                @endif
            </div>

            <div id="total-produk" class="profile-tab-content hidden py-4">
                @if ($produk->isNotEmpty())
                <table class="w-full border-collapse mt-4 border border-gray-200">
                    <tr>
                        <th class="border border-gray-200 p-2 text-left">Nama Produk</th>
                        <th class="border border-gray-200 p-2 text-left">Total</th>
                    </tr>
                    @foreach ($produk as $item)
                    <tr>
                        <td class="border border-gray-200 p-2">{{ $item->nama }}</td>
                        <td class="border border-gray-200 p-2">{{ $item->stok }} pcs</td>
                    </tr>
                    @endforeach
                </table>
                @else
                <p>Tidak ada data produk yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>


    <h2 class="text-4xl font-bold text-blue-600 text-center mb-8">Informasi</h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border">
        <div class="bg-white p-6 max-w-4xl mx-auto">
            <div class="flex rounded-lg overflow-hidden bg-gray-200">
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white" onclick="openInfoTab('produk')">Produk</button>
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openInfoTab('kegiatan')">Kegiatan</button>
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openInfoTab('inovasi')">Inovasi & Penghargaan</button>
            </div>
            <div id="produk" class="info-tab-content block py-4">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-x-6">
                        <div class="text-green-600 font-medium">Total Produk yang terjual: {{ $totalProdukTerjual }}</div>
                        <a href="https://wa.me/6289647038212?text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                            rel="noopener noreferrer"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium">
                            <span>Kontak</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-x-4">
                        @if($katalog && $katalog->katalog)
                        <a href="{{ asset('storage/' . $katalog->katalog) }}"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium">
                            Katalog
                        </a>
                        @else
                        <span class="text-gray-500">Katalog tidak tersedia</span>
                        @endif
                        <input type="text" placeholder="Cari Produk..."
                            class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                    </div>

                </div>
                <div class="relative">
                    <a href="{{ route('detail_produk.index', ['id' => 1]) }}" class="block no-underline">
                        <div id="produk-carousel" class="carousel grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                                <img src="{{ asset('images/Abon Lele.jpeg') }}" alt="Abon Lele" class="w-full h-40 object-cover rounded-lg">
                                <h3 class="mt-3 font-semibold text-lg">Abon Lele</h3>
                                <div class="flex items-center gap-x-6 pb-2">
                                    <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                                    <p class="text-black-500">stok: 5</p>
                                </div>
                            </div>
                    </a>

                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                        <img src="{{ asset('images/Jahe Instan.jpeg') }}" alt="Jahe Instant" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Jahe Instant</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                            <p class="text-black-500">stok: 20</p>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                        <img src="{{ asset('images/Kripik Pisang.jpeg') }}" alt="Kripik Pisang" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Kripik Pisang</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                            <p class="text-black-500">stok: 10</p>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                        <img src="{{ asset('images/Kripik Tempe.jpeg') }}" alt="Kripik Tempe" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Kripik Tempe</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 12.000</p>
                            <p class="text-black-500">stok: 8</p>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                        <img src="{{ asset('images/Sambal Bawang.jpeg') }}" alt="Sambal Bawang" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Sambal Bawang</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 20.000</p>
                            <p class="text-black-500">stok: 6</p>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                        <img src="{{ asset('images/Kopi Bubuk.jpeg') }}" alt="Kopi Bubuk" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Kopi Bubuk</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 15.000</p>
                            <p class="text-black-500">stok: 5</p>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                        <img src="{{ asset('images/Teh Herbal.jpeg') }}" alt="Teh Herbal" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Teh Herbal</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 18.000</p>
                            <p class="text-black-500">stok: 15</p>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer">
                        <img src="{{ asset('images/Sirup Jahe.jpeg') }}" alt="Sirup Jahe" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Sirup Jahe</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 22.000</p>
                            <p class="text-black-500">stok: 7</p>
                        </div>
                    </div>
                    <div class="border rounded-lg shadow-md p-3 max-w-[200px] mx-auto cursor-pointer hidden">
                        <img src="{{ asset('images/Kue Kering.jpeg') }}" alt="Kue Kering" class="w-full h-40 object-cover rounded-lg">
                        <h3 class="mt-3 font-semibold text-lg">Kue Kering</h3>
                        <div class="flex items-center gap-x-6 pb-2">
                            <p class="text-green-600 font-bold text-lg">Rp. 30.000</p>
                            <p class="text-black-500">stok: 9</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center space-x-2 mt-4 hidden" id="produk-dots"></div>
                <div class="flex justify-center mt-4 hidden" id="produk-nav">
                    <button class="btn btn-outline mr-2" onclick="prevSlide('produk')">←</button>
                    <button class="btn btn-outline" onclick="nextSlide('produk')">→</button>
                </div>
            </div>
        </div>
        <div id="kegiatan" class="info-tab-content hidden py-4">
            <div class="relative">
                <div id="kegiatan-carousel" class="carousel grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Abon Lele.jpeg') }}" alt="Rapat Kelompok Tani Sida Megar" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Rapat Kelompok Tani Sida Megar</h3>
                            <p class="text-xs opacity-75 mb-4">20 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Jahe Instan.jpeg') }}" alt="Menanam Kelompok Tani Sida Megar" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Menanam Kelompok Tani Sida Megar</h3>
                            <p class="text-xs opacity-75 mb-4">18 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Kripik Pisang.jpeg') }}" alt="Pelatihan Kelompok Tani" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Pelatihan Kelompok Tani</h3>
                            <p class="text-xs opacity-75 mb-4">15 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Kripik Tempe.jpeg') }}" alt="Sosialisasi Program INNDESA" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Sosialisasi Program INNDESA</h3>
                            <p class="text-xs opacity-75 mb-4">12 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Sambal Bawang.jpeg') }}" alt="Workshop Pertanian" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Workshop Pertanian</h3>
                            <p class="text-xs opacity-75 mb-4">10 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Kopi Bubuk.jpeg') }}" alt="Pendampingan Petani" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Pendampingan Petani</h3>
                            <p class="text-xs opacity-75 mb-4">8 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Teh Herbal.jpeg') }}" alt="Pameran Produk Lokal" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Pameran Produk Lokal</h3>
                            <p class="text-xs opacity-75 mb-4">5 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer">
                        <div class="h-32">
                            <img src="{{ asset('images/Sirup Jahe.jpeg') }}" alt="Pelatihan Pengolahan Pangan" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Pelatihan Pengolahan Pangan</h3>
                            <p class="text-xs opacity-75 mb-4">3 Agustus 2025</p>
                        </div>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow max-w-[250px] mx-auto cursor-pointer hidden">
                        <div class="h-32">
                            <img src="{{ asset('images/Kue Kering.jpeg') }}" alt="Kunjungan Lapangan" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-sm mb-2 leading-tight">Kunjungan Lapangan</h3>
                            <p class="text-xs opacity-75 mb-4">1 Agustus 2025</p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center space-x-2 mt-4 hidden" id="kegiatan-dots"></div>
                <div class="flex justify-center mt-4 hidden" id="kegiatan-nav">
                    <button class="btn btn-outline mr-2" onclick="prevSlide('kegiatan')">←</button>
                    <button class="btn btn-outline" onclick="nextSlide('kegiatan')">→</button>
                </div>
            </div>
        </div>
        <div id="inovasi" class="info-tab-content hidden py-4">
            <div class="relative">
                @if ($inovasiImages->isNotEmpty())
                <div id="inovasi-carousel" class="carousel">
                    @foreach ($inovasiImages as $index => $inovasi)
                    @php
                    $extension = pathinfo($inovasi->foto, PATHINFO_EXTENSION);
                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                    @endphp

                    @if ($isImage)
                    <img
                        src="{{ asset('storage/' . $inovasi->foto) }}"
                        alt="Inovasi {{ $inovasi->getKodeInovasiAttribute() }}"
                        class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer {{ $index === 0 ? 'block' : 'hidden' }}"
                        onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}')">
                    @else
                    <iframe
                        src="{{ asset('storage/' . $inovasi->foto) }}"
                        type="application/pdf"
                        class="w-full max-w-[30rem] mx-auto h-60 rounded-lg shadow-md border border-gray-200 {{ $index === 0 ? 'block' : 'hidden' }}"
                        onclick="openPreview('{{ asset('storage/' . $inovasi->foto) }}', 'Inovasi {{ $inovasi->getKodeInovasiAttribute() }}', {{ json_encode($inovasi->materi) }})">
                    </iframe>
                    @endif
                    @endforeach
                </div>
                <div class="flex justify-center space-x-2 mt-4" id="inovasi-dots"></div>
                <div class="flex justify-center mt-4">
                    <button class="btn btn-outline mr-2" onclick="prevSlide('inovasi')">←</button>
                    <button class="btn btn-outline" onclick="nextSlide('inovasi')">→</button>
                </div>
                @else
                <p class="text-center text-gray-500">Tidak ada data inovasi atau penghargaan yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>
    </div>

    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 max-w-3xl w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="previewTitle" class="text-xl font-semibold text-gray-800"></h3>
                <button onclick="closePreview()" class="text-gray-600 hover:text-gray-800 text-2xl">&times;</button>
            </div>
            <img id="previewImage" src="" alt="Preview" class="w-full max-h-[70vh] object-contain rounded-lg">
        </div>
    </div>


    <div class="w-full">
        @include('footer')
    </div>

    <script>
        function openProfileTab(tabId) {
            const tabs = document.querySelectorAll('.profile-tab-content');
            const buttons = document.querySelectorAll('.profile-tab-button');
            tabs.forEach(tab => tab.classList.add('hidden'));
            tabs.forEach(tab => tab.classList.remove('block'));
            buttons.forEach(button => {
                button.classList.remove('bg-[#0097D4]', 'text-white', 'bg-gray-200', 'text-gray-700');
                if (button.getAttribute('onclick').includes(tabId)) {
                    button.classList.add('bg-[#0097D4]', 'text-white');
                } else {
                    button.classList.add('bg-gray-200', 'text-gray-700');
                }
            });
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('block');
        }

        function openInfoTab(tabId) {
            const tabs = document.querySelectorAll('.info-tab-content');
            const buttons = document.querySelectorAll('.info-tab-button');
            tabs.forEach(tab => tab.classList.add('hidden'));
            tabs.forEach(tab => tab.classList.remove('block'));
            buttons.forEach(button => {
                button.classList.remove('bg-[#0097D4]', 'text-white', 'bg-gray-200', 'text-gray-700');
                if (button.getAttribute('onclick').includes(tabId)) {
                    button.classList.add('bg-[#0097D4]', 'text-white');
                } else {
                    button.classList.add('bg-gray-200', 'text-gray-700');
                }
            });
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('block');
        }

        function openPreview(imageSrc, title) {
            const modal = document.getElementById('previewModal');
            const previewImage = document.getElementById('previewImage');
            const previewTitle = document.getElementById('previewTitle');
            previewImage.src = imageSrc;
            previewTitle.textContent = title;
            modal.classList.remove('hidden');
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
                itemsPerPage: 8
            },
            'kegiatan': {
                current: 0,
                itemsPerPage: 8
            },
            'inovasi': {
                current: 0,
                itemsPerPage: 1
            }
        };

        function createDots(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const dotsContainer = document.getElementById(`${section}-dots`);
            const navContainer = document.getElementById(`${section}-nav`);
            const items = carousel.children;
            const itemsPerPage = carousels[section].itemsPerPage;
            const pageCount = Math.ceil(items.length / itemsPerPage);

            dotsContainer.innerHTML = '';
            if (items.length > itemsPerPage) {
                dotsContainer.classList.remove('hidden');
                if (navContainer) navContainer.classList.remove('hidden');
                for (let i = 0; i < pageCount; i++) {
                    const dot = document.createElement('div');
                    dot.className = `w-3 h-3 rounded-full ${i === 0 ? 'bg-blue-600' : 'bg-gray-300'}`;
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
        }

        function updateCarousel(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const dots = document.getElementById(`${section}-dots`).children;
            const items = carousel.children;
            const itemsPerPage = carousels[section].itemsPerPage;
            const currentPage = carousels[section].current;
            const pageCount = Math.ceil(items.length / itemsPerPage);

            for (let i = 0; i < items.length; i++) {
                items[i].classList.add('hidden');
                if (i >= currentPage * itemsPerPage && i < (currentPage + 1) * itemsPerPage) {
                    items[i].classList.remove('hidden');
                }
            }

            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove('bg-blue-600');
                dots[i].classList.add('bg-gray-300');
            }
            if (dots[currentPage]) {
                dots[currentPage].classList.remove('bg-gray-300');
                dots[currentPage].classList.add('bg-blue-600');
            }
        }

        function nextSlide(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const items = carousel.children;
            const itemsPerPage = carousels[section].itemsPerPage;
            const pageCount = Math.ceil(items.length / itemsPerPage);
            carousels[section].current = (carousels[section].current + 1) % pageCount;
            updateCarousel(section);
        }

        function prevSlide(section) {
            const carousel = document.getElementById(`${section}-carousel`);
            const items = carousel.children;
            const itemsPerPage = carousels[section].itemsPerPage;
            const pageCount = Math.ceil(items.length / itemsPerPage);
            carousels[section].current = (carousels[section].current - 1 + pageCount) % pageCount;
            updateCarousel(section);
        }

        createDots('sk-desa');
        createDots('produk');
        createDots('kegiatan');
        createDots('inovasi');
        updateCarousel('sk-desa');
        updateCarousel('produk');
        updateCarousel('kegiatan');
        updateCarousel('inovasi');

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closePreview();
            if (e.key === 'ArrowRight') {
                nextSlide('sk-desa');
                if (document.getElementById('produk-nav').classList.contains('hidden') === false) nextSlide('produk');
                if (document.getElementById('kegiatan-nav').classList.contains('hidden') === false) nextSlide('kegiatan');
                nextSlide('inovasi');
            }
            if (e.key === 'ArrowLeft') {
                prevSlide('sk-desa');
                if (document.getElementById('produk-nav').classList.contains('hidden') === false) prevSlide('produk');
                if (document.getElementById('kegiatan-nav').classList.contains('hidden') === false) prevSlide('kegiatan');
                prevSlide('inovasi');
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