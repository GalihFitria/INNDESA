<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-white">

    @include('navbar')

    <div class="container mx-auto pt-8">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-2/3 px-4">
                <div class="mb-2">
                    <h1 class="text-3xl font-bold text-black mb-2 leading-snug">
                        {{ $kegiatan->judul }}
                    </h1>
                    <p class="text-gray-500 mb-4">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('l, d F Y') }}</p>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full lg:w-2/3 px-4">
                            @if ($kegiatan->foto)
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}"
                                alt="{{ $kegiatan->judul }}"
                                class="rounded-lg w-full max-w-4xl mb-2">
                            @else
                            <img src="{{ asset('images/placeholder.jpg') }}"
                                alt="{{ $kegiatan->judul }}"
                                class="rounded-lg w-full max-w-4xl mb-2">
                            @endif
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
                            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify mb-2">
                                @foreach (explode("\n", $kegiatan->deskripsi) as $paragraph)
                                @if (!empty(trim($paragraph)))
                                <p class="indent-8">{{ $paragraph }}</p>
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
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Kegiatan Lainnya</h2>
                    <div class="space-y-4">
                        @foreach ($kegiatanLainnya as $item)
                        <div class="flex flex-col lg:flex-row items-start mb-4">
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
                                <p class="text-xs text-gray-500 mb-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</p>
                                <a href="{{ route('update_kegiatan.show', $item->id_kegiatan) }}"
                                    class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                            </div>
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

</body>

</html>