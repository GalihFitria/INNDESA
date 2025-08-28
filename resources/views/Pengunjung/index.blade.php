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

    @include('navbar')



    <section class="relative text-white text-center overflow-hidden min-h-[550px] flex items-center justify-center"
        style="background-image: url('{{ asset('images/background_beranda_INNDESA.jpeg') }}'); background-size: cover; background-position: center; font-family: 'Poppins', sans-serif;">
        <div class="relative z-10 max-w-6xl mx-auto px-5">
            <div class="relative inline-block mb-5">
                <span class="absolute inset-0 text-8xl md:text-9xl font-extrabold text-white"
                    style="z-index:-1; -webkit-text-stroke: 10px white;">INNDESA</span>
                <span class="text-8xl md:text-9xl font-extrabold bg-gradient-to-b from-blue-300 to-blue-900 text-transparent bg-clip-text">
                    INNDESA
                </span>
            </div>
            <h2 class="text-3xl md:text-5xl font-bold mb-4" style="color:#0097D4;">
                Inovasi Nusantara Desa Integratif Pangan
            </h2>
            <p class="text-2xl md:text-3xl font-bold mb-10" style="color:#FFA500;">
                PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala
            </p>

            <!-- <div class="flex flex-wrap justify-center gap-5 mb-10">
                <a href="#"
                    class="px-6 py-3 rounded-xl font-semibold bg-white text-blue-600 hover:bg-slate-100 transition">Profile</a>
                <a href="#"
                    class="px-6 py-3 rounded-xl font-semibold bg-emerald-500 text-white hover:bg-emerald-600 transition">Bagan Integritas</a>
            </div> -->
        </div>
    </section>


    <section class="relative -mt-20 z-10 pb-10">
        <div class="max-w-6xl mx-auto px-5">
            <div class="flex flex-col items-center gap-5">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full max-w-3xl">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-3 text-lg">Total Kelompok</h3>
                        <p class="text-emerald-500 font-extrabold text-4xl" id="totalKelompok">{{ $totalKelompok }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-3 text-lg">Total Anggota Kelompok</h3>
                        <p class="text-emerald-500 font-extrabold text-4xl" id="totalAnggota">{{ $totalAnggota }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-3 text-lg">Total Produk</h3>
                        <p class="text-emerald-500 font-extrabold text-4xl" id="totslProduk">{{ $totalProduk }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full max-w-xl">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-3 text-lg">Total Kelompok Rentan</h3>
                        <p class="text-emerald-500 font-extrabold text-4xl" id="totalKelompokRentan">{{ $totalKelompokRentan }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 text-center">
                        <h3 class="text-gray-700 font-bold mb-3 text-lg">Total Views</h3>
                        <p id="viewCount" class="text-emerald-500 font-extrabold text-4xl">0</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-blue-600 mb-8">Gambaran Umum Program</h2>
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Inovasi Nusantara Desa Integratif Pangan</h3>

                <div class="max-w-4xl mx-auto text-gray-700 leading-relaxed space-y-4">
                    <p>
                        INNDESA adalah program pemberdayaan berbasis inovasi sosial yang mengintegrasikan tiga sektor utama yaitu
                        produksi pangan untuk pertanian, peternakan, dan perikanan dengan pendekatan zero waste dan ekonomi
                        sirkular, serta mendorong partisipasi aktif generasi muda dalam membangun ekosistem pangan desa yang
                        berkelanjutan. Program ini bertujuan untuk menciptakan desa yang mandiri pangan dan ekonomi yang
                        terintegrasi dengan proses bisnis PLN dengan penggunaan teknologi ramah lingkungan non 3R (TARA) untuk
                        infrastruktur dan proses pembinaan.
                    </p>
                </div>
            </div>


            <div class="text-center">
                <h2 class="text-4xl font-bold text-blue-600 mb-8">Tujuan Program</h2>

                <div class="max-w-4xl mx-auto text-gray-700 leading-relaxed space-y-4">
                    <p>
                        INNDESA adalah program pemberdayaan berbasis inovasi sosial yang mengintegrasikan tiga sektor utama
                        produksi pangan yaitu pertanian, peternakan, dan perikanan dengan pendekatan zero waste dan ekonomi
                        sirkular, serta mendorong partisipasi aktif generasi muda dalam membangun ekosistem pangan desa yang
                        berkelanjutan, berkualitas, dan berdaya saing serta terintegrasi dengan proses bisnis PLN dengan
                        penggunaan teknologi ramah lingkungan non 3R (TARA) untuk infrastruktur dan proses pembinaan.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="py-16 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">Masalah Program</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="card p-8 bg-yellow-400 text-black">
                        <h3 class="text-xl font-bold mb-6 text-center">Ekonomi</h3>
                        <div class="space-y-4 text-sm leading-relaxed">
                            <p>
                                Produksi pangan lokal tidak mampu memenuhi kebutuhan konsumsi masyarakat, sehingga terpaksa defisit
                                pangan dan ketergantungan pangan dari luar daerah.
                            </p>
                        </div>
                    </div>

                    <div class="card p-8 bg-green-500 text-white">
                        <h3 class="text-xl font-bold mb-6 text-center">Lingkungan</h3>
                        <div class="space-y-4 text-sm leading-relaxed">
                            <p>
                                Akumulasi limbah produksi organik yang tidak bisa diolah secara alami berkesinambungan pada
                                perencanaan pangan dan menyebabkan kerusakan pada.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <div class="w-full md:w-1/2 md:max-w-md">
                        <div class="card p-8 bg-red-400 text-white">
                            <h3 class="text-xl font-bold mb-6 text-center">Sosial</h3>
                            <div class="space-y-4 text-sm leading-relaxed">
                                <p>
                                    • Krisis regenerasi petani menjadi ancaman untuk keberlanjutan sistem pangan desa, dengan rendahnya
                                    minat generasi muda terhadap pertanian menyebabkan kesenjangan dalam pangan desa yang inklusif.
                                </p>
                                <p>
                                    • Meningkatnya teknologi dan kecakapan SDM pada sektor produksi pangan berkesinambungan pada
                                    berkesinambungan integrasi sektor pangan desa yang inklusif.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">Bagan Integritas</h2>
            </div>

            <div class="flex justify-center">
                <img
                    src="{{ asset('images/bagan_integritas.png') }}"
                    class="max-w-full h-auto rounded-lg shadow-lg" />
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">Update Kegiatan</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="card bg-red-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/pln-inndesa-training-5ZHDJ7mmSqAXQnhvu7MmJ8M5mhRmw8.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI PELATIHAN"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI PELATIHAN</h3>
                        <p class="text-xs opacity-90 mb-3">Program pelatihan untuk mendukung pengembangan inovasi nusantara desa integratif pangan</p>
                        <p class="text-xs opacity-75 mb-4">15 Desember 2024</p>
                        <a href="{{ route('update_kegiatan.index') }}"
                            class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30 text-center block">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="card bg-gray-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/sustainable-farm-workshop-OAt66DVmtx6DMlcB56QGKEJ7m23ohm.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI WORKSHOP"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI WORKSHOP</h3>
                        <p class="text-xs opacity-90 mb-3">Workshop pengembangan kapasitas masyarakat dalam bidang pertanian berkelanjutan</p>
                        <p class="text-xs opacity-75 mb-4">12 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="card bg-green-600 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/farmer-livestock-tech-assistance-mKH30H7UEnN1GoAYOc62yTeqJusFEb.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI PENDAMPINGAN"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI PENDAMPINGAN</h3>
                        <p class="text-xs opacity-90 mb-3">Program pendampingan teknis untuk kelompok tani dan peternak lokal</p>
                        <p class="text-xs opacity-75 mb-4">10 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="card bg-pink-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/inndesa-socialization-wHDM9f4IhzYOCuJ8CccpKwL8IjN06m.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI</h3>
                        <p class="text-xs opacity-90 mb-3">Sosialisasi program INNDESA kepada masyarakat desa dan stakeholder terkait</p>
                        <p class="text-xs opacity-75 mb-4">8 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="card bg-pink-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/inndesa-socialization-wHDM9f4IhzYOCuJ8CccpKwL8IjN06m.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI</h3>
                        <p class="text-xs opacity-90 mb-3">Sosialisasi program INNDESA kepada masyarakat desa dan stakeholder terkait</p>
                        <p class="text-xs opacity-75 mb-4">8 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="card bg-pink-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/inndesa-socialization-wHDM9f4IhzYOCuJ8CccpKwL8IjN06m.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI</h3>
                        <p class="text-xs opacity-90 mb-3">Sosialisasi program INNDESA kepada masyarakat desa dan stakeholder terkait</p>
                        <p class="text-xs opacity-75 mb-4">8 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="card bg-pink-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/inndesa-socialization-wHDM9f4IhzYOCuJ8CccpKwL8IjN06m.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI</h3>
                        <p class="text-xs opacity-90 mb-3">Sosialisasi program INNDESA kepada masyarakat desa dan stakeholder terkait</p>
                        <p class="text-xs opacity-75 mb-4">8 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="card bg-pink-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/inndesa-socialization-wHDM9f4IhzYOCuJ8CccpKwL8IjN06m.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI</h3>
                        <p class="text-xs opacity-90 mb-3">Sosialisasi program INNDESA kepada masyarakat desa dan stakeholder terkait</p>
                        <p class="text-xs opacity-75 mb-4">8 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <div class="card bg-pink-500 text-white overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-32 bg-black/20">
                        <img
                            src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/inndesa-socialization-wHDM9f4IhzYOCuJ8CccpKwL8IjN06m.png"
                            alt="PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-sm mb-2 leading-tight">PLN UPJP JAWA TENGAH DUKUNG PROGRAM INNDESA MELALUI SOSIALISASI</h3>
                        <p class="text-xs opacity-90 mb-3">Sosialisasi program INNDESA kepada masyarakat desa dan stakeholder terkait</p>
                        <p class="text-xs opacity-75 mb-4">8 Desember 2024</p>
                        <button class="btn w-full bg-white/20 hover:bg-white/30 text-white border-white/30">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-center space-x-2">
                <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
            </div>

            <div class="flex justify-center mt-4">
                <button class="btn btn-outline mr-2">←</button>
                <button class="btn btn-outline">→</button>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="relative aspect-video bg-gray-900 cursor-pointer group"
                    onclick="openModal('https://www.youtube.com/embed/A4Bc6Z7VyaU?autoplay=1')">
                    <img src="https://img.youtube.com/vi/A4Bc6Z7VyaU/maxresdefault.jpg"
                        alt="PROGRAM CSR PEMBERDAYAAN MASYARAKAT PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala"
                        class="w-full h-full object-cover">
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 transition">
                        <div
                            class="w-20 h-20 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition shadow-lg">
                            <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex gap-3">
                        <a href="https://youtu.be/A4Bc6Z7VyaU" target="_blank"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M10 15l5.19-3.34L10 8.32V15zM19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
                            </svg>
                            Tonton di YouTube
                        </a>
                        <button onclick="copyLink()"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 8a3 3 0 01-3 3H5a3 3 0 110-6h7a3 3 0 013 3zM19 16a3 3 0 01-3 3H5a3 3 0 110-6h11a3 3 0 013 3z" />
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="videoModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
        <div class="relative w-full max-w-3xl aspect-video">
            <iframe id="youtubeFrame" class="w-full h-full" src="" frameborder="0"
                allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
            <button onclick="closeModal()" class="absolute -top-10 right-0 text-white text-3xl">&times;</button>
        </div>
    </div>

    <div class="mt-20">
        @include('footer')
    </div>

</body>
<script>
    let views = localStorage.getItem("page_views") || 0;
    views = parseInt(views);
    views += 1;
    localStorage.setItem("page_views", views);

    const viewCountEl = document.getElementById("viewCount");
    if (viewCountEl) {
        viewCountEl.textContent = views;
    }

    function openModal(url) {
        document.getElementById('youtubeFrame').src = url;
        document.getElementById('videoModal').classList.remove('hidden');
        document.getElementById('videoModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('youtubeFrame').src = '';
        document.getElementById('videoModal').classList.add('hidden');
        document.getElementById('videoModal').classList.remove('flex');
    }

    function copyLink() {
        navigator.clipboard.writeText('https://youtu.be/A4Bc6Z7VyaU');
        alert('Link video berhasil disalin!');
    }

    async function updateStatistik() {
        try {
            const response = await fetch("/api/statistik");
            const data = await response.json();

            document.getElementById("totalKelompok").textContent = data.totalKelompok;
            document.getElementById("totalAnggota").textContent = data.totalAnggota;
            document.getElementById("totalProduk").textContent = data.totalProduk;
            document.getElementById("totalKelompokRentan").textContent = data.totalKelompokRentan;
        } catch (error) {
            console.error("Gagal fetch statistik:", error);
        }
    }

    // jalankan langsung pas load
    updateStatistik();

    // refresh tiap 10 detik
    setInterval(updateStatistik, 10000);
</script>

</html>