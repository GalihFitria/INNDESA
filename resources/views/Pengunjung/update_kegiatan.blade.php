<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Custom CSS untuk menyesuaikan posisi Kegiatan Lainnya */
        .kegiatan-lainnya-wrapper {
            margin-top: 120px;
            /* Menurunkan posisi agar tidak sejajar dengan judul */
        }

        @media (max-width: 1024px) {
            .kegiatan-lainnya-wrapper {
                margin-top: 20px;
                /* Margin lebih kecil untuk mobile */
            }
        }
    </style>
</head>

<body class="bg-white">
    @include('navbar')
    <div class="container mx-auto pt-8">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-2/3 px-4">
                <div class="mb-2">
                    <h1 class="text-4xl font-bold text-black mb-2 leading-snug">
                        {{ $kegiatan->judul }}
                    </h1>
                    <p class="text-gray-500 mb-4">
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                    </p>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full px-0">
                            @if ($kegiatan->foto)
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}"
                                alt="{{ $kegiatan->judul }}"
                                class="rounded-lg w-[800px] h-[500px] object-cover">
                            @else
                            <img src="{{ asset('images/placeholder.jpg') }}"
                                alt="{{ $kegiatan->judul }}"
                                class="rounded-lg w-[800px] h-[500px] object-cover">
                            @endif <br>
                            <div class="mb-2">
                                <h2 class="text-xl font-semibold text-gray-800 mb-1">Sumber Berita</h2>
                                <ul class="list-disc list-inside text-blue-600 space-y-1">
                                    @php
                                    $getWebsiteName = function ($url) {
                                    $parsedUrl = parse_url(trim($url));
                                    if ($parsedUrl && isset($parsedUrl['host'])) {
                                    $host = $parsedUrl['host'];
                                    $host = str_replace('www.', '', $host);
                                    $parts = explode('.', $host);
                                    if (count($parts) > 1) {
                                    $domain = $parts[count($parts) - 2];
                                    return ucwords(str_replace('-', ' ', $domain));
                                    }
                                    return ucwords($host);
                                    }
                                    return 'Sumber Tidak Diketahui';
                                    };
                                    @endphp
                                    @foreach ($sumberBerita as $sumber)
                                    <li>
                                        <a href="{{ $sumber }}"
                                            rel="noopener noreferrer"
                                            class="hover:underline">
                                            {{ $getWebsiteName($sumber) }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="prose text-xl max-w-none text-gray-700 leading-relaxed text-justify mb-2">
                                @foreach (explode("\n", $kegiatan->deskripsi) as $paragraph)
                                @if (!empty(trim($paragraph)))
                                <p class="mb-4">
                                    @if ($loop->first)
                                    <b>INNDESA-</b>
                                    @endif
                                    {{ $paragraph }}
                                </p>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{ url()->previous() }}"
                        class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        ← Kembali
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-1/3 px-4">
                <div class="kegiatan-lainnya-wrapper bg-white shadow-lg rounded-lg p-4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Kegiatan Lainnya</h2>
                    <!-- Container untuk kegiatan -->
                    <div id="kegiatan-container" class="space-y-4 mb-4">
                        @php
                        // Ambil hanya 5 kegiatan pertama untuk ditampilkan
                        $kegiatanTampil = $kegiatanLainnya->take(5);
                        @endphp
                        @foreach ($kegiatanTampil as $item)
                        <div class="kegiatan-item flex flex-col lg:flex-row items-start mb-4">
                            <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                                @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->judul }}"
                                    class="rounded-lg w-full max-w-xs">
                                @else
                                <img src="{{ asset('images/placeholder.jpg') }}"
                                    alt="{{ $item->judul }}"
                                    class="rounded-lg w-full max-w-xs">
                                @endif
                            </div>
                            <div class="w-full lg:w-2/3 lg:pl-4">
                                <h3 class="text-xl font-bold text-blue-600 mb-2 leading-snug">{{ $item->judul }}</h3>
                                <p class="text-xs text-gray-500 mb-2">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d F Y') }}
                                </p>
                                <a href="{{ route('update_kegiatan.show', $item->id_kegiatan) }}"
                                    class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Pagination Controls -->
                    @if($kegiatanLainnya->count() > 5)
                    <div class="flex justify-between items-center">
                        <button id="prev-btn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            ← Sebelumnya
                        </button>
                        <span id="page-info" class="text-sm text-gray-600">
                            Halaman 1
                        </span>
                        <button id="next-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Selanjutnya →
                        </button>
                    </div>
                    @endif
                    <!-- Hidden data untuk JavaScript -->
                    <div id="kegiatan-data" class="hidden">
                        @foreach ($kegiatanLainnya as $item)
                        <div class="kegiatan-data-item"
                            data-id="{{ $item->id_kegiatan }}"
                            data-judul="{{ $item->judul }}"
                            data-foto="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/placeholder.jpg') }}"
                            data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}"
                            data-url="{{ route('update_kegiatan.show', $item->id_kegiatan) }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="mt-20">
        @include('footer')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kegiatanDataItems = document.querySelectorAll('.kegiatan-data-item');
            const container = document.getElementById('kegiatan-container');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const pageInfo = document.getElementById('page-info');
            if (!nextBtn) return;
            const kegiatanData = Array.from(kegiatanDataItems).map(item => ({
                id: item.getAttribute('data-id'),
                judul: item.getAttribute('data-judul'),
                foto: item.getAttribute('data-foto'),
                tanggal: item.getAttribute('data-tanggal'),
                url: item.getAttribute('data-url')
            }));
            const itemsPerPage = 10;
            let currentPage = 1;
            const totalPages = Math.ceil(kegiatanData.length / itemsPerPage);

            function displayKegiatan(page) {
                container.innerHTML = '';
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, kegiatanData.length);
                const currentItems = kegiatanData.slice(startIndex, endIndex);
                currentItems.forEach(item => {
                    const kegiatanElement = document.createElement('div');
                    kegiatanElement.className = 'kegiatan-item flex flex-col lg:flex-row items-start mb-4';
                    kegiatanElement.innerHTML = `
                        <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                            <img src="${item.foto}"
                                alt="${item.judul}"
                                class="rounded-lg w-full max-w-xs">
                        </div>
                        <div class="w-full lg:w-2/3 lg:pl-4">
                            <h3 class="text-xl font-bold text-blue-600 mb-2 leading-snug">${item.judul}</h3>
                            <p class="text-xs text-gray-500 mb-2">${item.tanggal}</p>
                            <a href="${item.url}"
                                class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                        </div>
                    `;
                    container.appendChild(kegiatanElement);
                });
                pageInfo.textContent = `Halaman ${page} dari ${totalPages}`;
                prevBtn.disabled = page === 1;
                nextBtn.disabled = page === totalPages;
            }
            prevBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    displayKegiatan(currentPage);
                }
            });
            nextBtn.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayKegiatan(currentPage);
                }
            });
            // Initial display
            displayKegiatan(currentPage);
        });
    </script>
</body>

</html>