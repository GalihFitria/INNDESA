<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom CSS untuk responsive design */
        .kegiatan-lainnya-wrapper {
            margin-top: 120px;
        }

        @media (max-width: 1024px) {
            .kegiatan-lainnya-wrapper {
                margin-top: 20px;
            }
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem !important;
                line-height: 1.2;
            }

            .main-image {
                width: 100% !important;
                height: 250px !important;
            }

            .content-text {
                font-size: 1rem !important;
            }

            /* Kegiatan items tetap horizontal di mobile dengan spacing yang baik */
            .kegiatan-item-mobile {
                flex-direction: row !important;
                padding: 12px 0;
            }

            .kegiatan-image-mobile {
                width: 90px !important;
                height: 60px !important;
                margin-bottom: 0;
                margin-right: 12px !important;
            }

            .kegiatan-content-mobile {
                flex: 1 !important;
                padding-left: 0 !important;
            }

            .kegiatan-title {
                font-size: 0.875rem !important;
                line-height: 1.3 !important;
                margin-bottom: 6px !important;
            }
        }

        @media (max-width: 640px) {
            .container-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .main-title {
                font-size: 1.75rem !important;
            }

            .sidebar-title {
                font-size: 1.25rem !important;
            }

            .kegiatan-title {
                font-size: 1rem !important;
            }
        }
    </style>
</head>

<body class="bg-white">
    @include('navbar')
    <div class="container mx-auto pt-4 sm:pt-8 container-padding">
        <div class="flex flex-wrap -mx-2 lg:-mx-4">
            <div class="w-full lg:w-2/3 px-2 lg:px-4">
                <div class="mb-4 sm:mb-6">
                    <h1 class="main-title text-3xl sm:text-4xl lg:text-5xl font-bold text-black mb-2 sm:mb-4 leading-tight">
                        {{ $kegiatan->judul }}
                    </h1>
                    <p class="text-gray-500 mb-4 flex items-center gap-2 text-sm sm:text-base">
                        <!-- Ikon kalender -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 9h18M4.5 
                 7.5h15a1.5 1.5 0 0 1 1.5 1.5v11.25a1.5 
                 1.5 0 0 1-1.5 1.5h-15a1.5 1.5 0 0 1-1.5-1.5V9a1.5 
                 1.5 0 0 1 1.5-1.5z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                    </p>

                    <div class="flex flex-wrap -mx-2 lg:-mx-4">
                        <div class="w-full px-0">
                            @if ($kegiatan->foto)
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}"
                                alt="{{ $kegiatan->judul }}"
                                class="main-image rounded-lg w-full sm:w-[600px] lg:w-[800px] h-[200px] sm:h-[350px] lg:h-[500px] object-cover">
                            @else
                            <img src="{{ asset('images/placeholder.jpg') }}"
                                alt="{{ $kegiatan->judul }}"
                                class="main-image rounded-lg w-full sm:w-[600px] lg:w-[800px] h-[200px] sm:h-[350px] lg:h-[500px] object-cover">
                            @endif <br>

                            <p class="text-gray-700 mb-4 flex items-center gap-2 text-sm sm:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-4 h-4 sm:w-5 sm:h-5 text-gray-700 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 4.5-1.128M4.5 
                 18A9.38 9.38 0 0 0 9 19.128M9 
                 13.5a3 3 0 1 0 6 0 3 3 0 0 0-6 
                 0zm12 0a9 9 0 1 1-18 0 9 9 0 
                 0 1 18 0z" />
                                </svg>
                                Kelompok {{ $kegiatan->kelompok->nama }}
                            </p>

                            <div class="mb-4 sm:mb-6">
                                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">Sumber Berita</h2>
                                <ul class="list-disc list-inside text-blue-600 space-y-1 text-sm sm:text-base ml-2">
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
                                            class="hover:underline break-all">
                                            {{ $getWebsiteName($sumber) }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="content-text prose max-w-none text-gray-700 leading-relaxed text-justify mb-4 sm:mb-6 text-base sm:text-lg lg:text-xl">
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
                <div class="mt-4 sm:mt-6">
                    <a href="{{ url()->previous() }}"
                        class="inline-block px-4 sm:px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm sm:text-base">
                        ← Kembali
                    </a>
                </div>
            </div>

            <!-- KEGIATAN LAINNYA -->
            <div class="w-full lg:w-1/3 px-2 lg:px-4 mt-8 lg:mt-0">
                <div class="kegiatan-lainnya-wrapper bg-white shadow-lg rounded-lg p-3 sm:p-4">
                    <h2 class="sidebar-title text-xl sm:text-2xl font-semibold text-gray-800 mb-3 sm:mb-4">Kegiatan Lainnya</h2>
                    <div id="kegiatan-container" class="space-y-4 sm:space-y-5 mb-6">
                        @php
                        // Ambil hanya 5 kegiatan pertama untuk ditampilkan
                        $kegiatanTampil = $kegiatanLainnya->take(5);
                        @endphp
                        @foreach ($kegiatanTampil as $item)
                        <div class="kegiatan-item kegiatan-item-mobile flex items-start mb-4 pb-4 border-b border-gray-100 last:border-b-0">
                            <div class="kegiatan-image-mobile w-24 sm:w-32 lg:w-40 flex-shrink-0 mr-3 sm:mr-4">
                                <div class="relative overflow-hidden rounded-lg w-full h-16 sm:h-20 lg:h-24">
                                    @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        alt="{{ $item->judul }}"
                                        class="absolute inset-0 w-full h-full object-cover">
                                    @else
                                    <img src="{{ asset('images/placeholder.jpg') }}"
                                        alt="{{ $item->judul }}"
                                        class="absolute inset-0 w-full h-full object-cover">
                                    @endif
                                </div>
                            </div>
                            <div class="kegiatan-content-mobile flex-1">
                                <h3 class="kegiatan-title text-sm sm:text-base lg:text-lg font-bold text-blue-600 mb-2 leading-tight">{{ $item->judul }}</h3>
                                <p class="text-xs sm:text-sm text-gray-500 mb-2">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}
                                </p>
                                <a href="{{ route('update_kegiatan.show', $item->id_kegiatan) }}"
                                    class="text-blue-600 hover:underline text-xs sm:text-sm font-medium">Baca Selengkapnya</a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination Controls -->
                    @if($kegiatanLainnya->count() > 5)
                    <div class="flex justify-between items-center">
                        <button id="prev-btn" class="px-3 sm:px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 disabled:opacity-50 disabled:cursor-not-allowed text-xs sm:text-sm" disabled>
                            ← Sebelumnya
                        </button>
                        <span id="page-info" class="text-xs sm:text-sm text-gray-600">
                            Halaman 1
                        </span>
                        <button id="next-btn" class="px-3 sm:px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs sm:text-sm">
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
    <div class="mt-10 sm:mt-20">
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

            const itemsPerPage = 5;
            let currentPage = 1;
            const totalPages = Math.ceil(kegiatanData.length / itemsPerPage);

            function displayKegiatan(page) {
                container.innerHTML = '';
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, kegiatanData.length);
                const currentItems = kegiatanData.slice(startIndex, endIndex);

                currentItems.forEach(item => {
                    const kegiatanElement = document.createElement('div');
                    kegiatanElement.className = 'kegiatan-item kegiatan-item-mobile flex items-start';
                    kegiatanElement.innerHTML = `
                        <div class="kegiatan-image-mobile w-full sm:w-32 lg:w-40 flex-shrink-0">
                            <div class="relative overflow-hidden rounded-lg w-full h-24 sm:h-20 lg:h-24">
                                <img src="${item.foto}"
                                    alt="${item.judul}"
                                    class="absolute inset-0 w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="kegiatan-content-mobile w-full sm:pl-3 lg:pl-4">
                            <h3 class="kegiatan-title text-base sm:text-lg lg:text-xl font-bold text-blue-600 mb-1 sm:mb-2 leading-tight">${item.judul}</h3>
                            <p class="text-xs sm:text-sm text-gray-500 mb-1 sm:mb-2">${item.tanggal}</p>
                            <a href="${item.url}" class="text-blue-600 hover:underline text-xs sm:text-sm">Baca Selengkapnya</a>
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