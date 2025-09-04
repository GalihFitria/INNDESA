<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Kelompok Contoh</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .modal {
            transition: opacity 0.3s ease;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
        }

        .form-textarea {
            min-height: 100px;
        }
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">
    @include('navbar')
    <!-- Hero Section -->
    <section class="relative text-white overflow-hidden min-h-[550px] flex flex-col items-center pt-32 bg-gray-800 bg-cover bg-center">
        <div class="text-center space-y-5 mt-20">
            <div class="absolute top-12 left-16 flex items-center space-x-3">
                <img
                    src="https://via.placeholder.com/150"
                    alt="Logo Kelompok"
                    class="h-24 w-auto max-h-32 object-contain">
            </div>
            <h2 class="text-5xl md:text-7xl font-bold text-[#0097D4]">
                Kelompok Petani Milenial
            </h2>
        </div>
    </section>

    <!-- Profil Kelompok Section -->
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
                <div class="flex justify-end mb-4">
                    <button onclick="openStrukturForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Anggota
                    </button>
                </div>
                <table class="w-full border-collapse mb-6 border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="border border-gray-200 p-3 text-left font-semibold">Posisi</th>
                            <th class="border border-gray-200 p-3 text-left font-semibold">Nama</th>
                            <th class="border border-gray-200 p-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="struktur-tbody">
                        <tr>
                            <td class="border border-gray-200 p-3">Ketua</td>
                            <td class="border border-gray-200 p-3">Ahmad Wijaya</td>
                            <td class="border border-gray-200 p-3 text-center">
                                <button onclick="editStruktur(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteStruktur(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 p-3">Wakil Ketua</td>
                            <td class="border border-gray-200 p-3">Siti Nurhaliza</td>
                            <td class="border border-gray-200 p-3 text-center">
                                <button onclick="editStruktur(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteStruktur(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 p-3">Sekretaris</td>
                            <td class="border border-gray-200 p-3">Budi Santoso</td>
                            <td class="border border-gray-200 p-3 text-center">
                                <button onclick="editStruktur(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteStruktur(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 p-3">Bendahara</td>
                            <td class="border border-gray-200 p-3">Dewi Lestari</td>
                            <td class="border border-gray-200 p-3 text-center">
                                <button onclick="editStruktur(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteStruktur(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- SEJARAH -->
            <div id="sejarah" class="profile-tab-content hidden py-4">
                <div class="flex justify-end mb-4">
                    <button onclick="openSejarahForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-edit mr-2"></i>Edit Sejarah
                    </button>
                </div>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify">
                    <p class="indent-8" id="sejarah-content">
                        Kelompok ini didirikan pada tahun 2010 sebagai wadah untuk mengembangkan potensi masyarakat desa.
                        Melalui berbagai program dan kegiatan, kelompok ini telah berhasil meningkatkan kesejahteraan anggotanya
                        dan memberikan kontribusi positif bagi perkembangan desa. Dengan semangat gotong royong dan kebersamaan,
                        kelompok ini terus berkembang dan berinovasi untuk menghadapi tantangan zaman.
                    </p>
                </div>
            </div>

            <!-- SK DESA -->
            <div id="sk-desa" class="profile-tab-content hidden py-4">
                <div class="flex justify-end mb-4">
                    <button onclick="openSkDesaForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah SK Desa
                    </button>
                </div>
                <div class="relative">
                    <div id="sk-desa-carousel" class="carousel">
                        <div class="sk-desa-item">
                            <img
                                src="https://via.placeholder.com/800x600"
                                alt="SK Desa"
                                class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer"
                                onclick="openPreview('https://via.placeholder.com/800x600', 'SK Desa')">
                            <div class="text-center mt-2">
                                <button onclick="editSkDesa(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="deleteSkDesa(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center space-x-2 mt-4 hidden" id="sk-desa-dots"></div>
                    <div class="flex justify-center mt-4 hidden" id="sk-desa-nav">
                        <button class="btn btn-outline mr-2" onclick="prevSlide('sk-desa')" aria-label="Previous slide">←</button>
                        <button class="btn btn-outline" onclick="nextSlide('sk-desa')" aria-label="Next slide">→</button>
                    </div>
                </div>
            </div>

            <!-- KELOMPOK RENTAN -->
            <div id="kelompok-rentan" class="profile-tab-content hidden py-4">
                <div class="flex justify-end mb-4">
                    <button onclick="openRentanForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Data
                    </button>
                </div>
                <table class="w-full border-collapse mt-4 border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 p-2 text-left">Lansia</th>
                            <th class="border border-gray-200 p-2 text-left">Disabilitas</th>
                            <th class="border border-gray-200 p-2 text-left">Anak Yatim</th>
                            <th class="border border-gray-200 p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rentan-tbody">
                        <tr>
                            <td class="border border-gray-200 p-2">Suparman</td>
                            <td class="border border-gray-200 p-2">Siti Aminah</td>
                            <td class="border border-gray-200 p-2">Budi</td>
                            <td class="border border-gray-200 p-2 text-center">
                                <button onclick="editRentan(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteRentan(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 p-2">Rahayu</td>
                            <td class="border border-gray-200 p-2">&nbsp;</td>
                            <td class="border border-gray-200 p-2">Siti</td>
                            <td class="border border-gray-200 p-2 text-center">
                                <button onclick="editRentan(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteRentan(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 p-2">&nbsp;</td>
                            <td class="border border-gray-200 p-2">&nbsp;</td>
                            <td class="border border-gray-200 p-2">Ahmad</td>
                            <td class="border border-gray-200 p-2 text-center">
                                <button onclick="editRentan(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteRentan(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- TOTAL PRODUK -->
            <div id="total-produk" class="profile-tab-content hidden py-4">
                <div class="flex justify-end mb-4">
                    <button onclick="openTotalProdukForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Produk
                    </button>
                </div>
                <table class="w-full border-collapse mt-4 border border-gray-200">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 p-2 text-left">Nama Produk</th>
                            <th class="border border-gray-200 p-2 text-left">Total</th>
                            <th class="border border-gray-200 p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="total-produk-tbody">
                        <tr>
                            <td class="border border-gray-200 p-2">Kerajinan Anyaman</td>
                            <td class="border border-gray-200 p-2">125 pcs</td>
                            <td class="border border-gray-200 p-2 text-center">
                                <button onclick="editTotalProduk(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTotalProduk(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 p-2">Makanan Khas</td>
                            <td class="border border-gray-200 p-2">87 pcs</td>
                            <td class="border border-gray-200 p-2 text-center">
                                <button onclick="editTotalProduk(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTotalProduk(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 p-2">Batik Tulis</td>
                            <td class="border border-gray-200 p-2">45 pcs</td>
                            <td class="border border-gray-200 p-2 text-center">
                                <button onclick="editTotalProduk(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTotalProduk(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Informasi Section -->
    <h2 class="text-4xl font-bold text-blue-600 text-center mb-8">Informasi</h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border">
        <div class="bg-white p-6 max-w-4xl mx-auto">
            <div class="flex rounded-lg overflow-hidden bg-gray-200">
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white" onclick="openTab('produk', 'info')" aria-label="Lihat Produk">Produk</button>
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('kegiatan', 'info')" aria-label="Lihat Kegiatan">Kegiatan</button>
                <button class="info-tab-button flex-1 py-2 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700" onclick="openTab('inovasi', 'info')" aria-label="Lihat Inovasi & Penghargaan">Inovasi & Penghargaan</button>
            </div>

            <!-- PRODUK -->
            <div id="produk" class="info-tab-content block py-4">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-x-6">
                        <div class="text-green-600 font-medium">Total Produk Terjual: 257</div>
                        <a href="https://wa.me/6289647038212?text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
                            rel="noopener noreferrer"
                            class="flex items-center gap-1 text-gray-800 hover:text-sky-600 transition-colors font-medium"
                            aria-label="Kontak via WhatsApp">
                            <span>Kontak</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-x-4">
                        <button onclick="openProdukForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            <i class="fas fa-plus mr-2"></i>Tambah Produk
                        </button>
                        <input type="text" id="searchProduk" placeholder="Cari Produk..."
                            class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500"
                            aria-label="Cari Produk">
                    </div>
                </div>

                <div class="relative">
                    <div id="produk-carousel" class="carousel grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="produk-item" data-nama="Kerajinan Anyaman">
                            <a href="#" class="block no-underline">
                                <div class="border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto cursor-pointer">
                                    <img src="https://via.placeholder.com/200x160"
                                        alt="Kerajinan Anyaman"
                                        class="w-full h-40 object-cover rounded-lg">
                                    <h3 class="mt-3 font-semibold text-lg truncate">Kerajinan Anyaman</h3>
                                    <div class="flex items-center justify-between pb-2">
                                        <p class="text-green-600 font-bold text-lg truncate">Rp. 150,000</p>
                                        <p class="text-black-500 text-sm truncate">Stok: 25</p>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <button onclick="editProduk(this)" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button onclick="deleteProduk(this)" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="produk-item" data-nama="Makanan Khas">
                            <a href="#" class="block no-underline">
                                <div class="border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto cursor-pointer">
                                    <img src="https://via.placeholder.com/200x160"
                                        alt="Makanan Khas"
                                        class="w-full h-40 object-cover rounded-lg">
                                    <h3 class="mt-3 font-semibold text-lg truncate">Makanan Khas</h3>
                                    <div class="flex items-center justify-between pb-2">
                                        <p class="text-green-600 font-bold text-lg truncate">Rp. 75,000</p>
                                        <p class="text-black-500 text-sm truncate">Stok: 42</p>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <button onclick="editProduk(this)" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button onclick="deleteProduk(this)" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="produk-item" data-nama="Batik Tulis">
                            <a href="#" class="block no-underline">
                                <div class="border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto cursor-pointer">
                                    <img src="https://via.placeholder.com/200x160"
                                        alt="Batik Tulis"
                                        class="w-full h-40 object-cover rounded-lg">
                                    <h3 class="mt-3 font-semibold text-lg truncate">Batik Tulis</h3>
                                    <div class="flex items-center justify-between pb-2">
                                        <p class="text-green-600 font-bold text-lg truncate">Rp. 350,000</p>
                                        <p class="text-black-500 text-sm truncate">Stok: 15</p>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <button onclick="editProduk(this)" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button onclick="deleteProduk(this)" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="produk-item" data-nama="Souvenir Kayu">
                            <a href="#" class="block no-underline">
                                <div class="border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto cursor-pointer">
                                    <img src="https://via.placeholder.com/200x160"
                                        alt="Souvenir Kayu"
                                        class="w-full h-40 object-cover rounded-lg">
                                    <h3 class="mt-3 font-semibold text-lg truncate">Souvenir Kayu</h3>
                                    <div class="flex items-center justify-between pb-2">
                                        <p class="text-green-600 font-bold text-lg truncate">Rp. 125,000</p>
                                        <p class="text-black-500 text-sm truncate">Stok: 33</p>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <button onclick="editProduk(this)" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button onclick="deleteProduk(this)" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
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
                <div class="flex items-center justify-between mb-4">
                    <input type="text" placeholder="Cari Kegiatan..."
                        class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500"
                        aria-label="Cari Kegiatan">
                    <button onclick="openKegiatanForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
                    </button>
                </div>
                <div class="relative">
                    <div id="kegiatan-carousel" class="carousel grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="kegiatan-item">
                            <a href="#" class="block no-underline">
                                <div class="bg-white text-black rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow w-[200px] min-h-[300px] mx-auto cursor-pointer">
                                    <div class="h-40">
                                        <img src="https://via.placeholder.com/200x160"
                                            alt="Pelatihan Kewirausahaan"
                                            class="w-full h-full object-cover rounded-t-lg"
                                            style="max-height: 160px;">
                                    </div>
                                    <div class="p-4 flex flex-col justify-between h-[180px]">
                                        <div>
                                            <h3 class="font-bold text-sm mb-2 leading-tight line-clamp-2">Pelatihan Kewirausahaan</h3>
                                            <p class="text-xs opacity-75 mb-2 line-clamp-3">Pelatihan untuk meningkatkan kemampuan wirausaha bagi anggota kelompok</p>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <p class="text-xs opacity-75 truncate">15 Juni 2023</p>
                                        </div>
                                        <div class="flex justify-between mt-2">
                                            <button onclick="editKegiatan(this)" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button onclick="deleteKegiatan(this)" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="kegiatan-item">
                            <a href="#" class="block no-underline">
                                <div class="bg-white text-black rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow w-[200px] min-h-[300px] mx-auto cursor-pointer">
                                    <div class="h-40">
                                        <img src="https://via.placeholder.com/200x160"
                                            alt="Bazaar Produk UMKM"
                                            class="w-full h-full object-cover rounded-t-lg"
                                            style="max-height: 160px;">
                                    </div>
                                    <div class="p-4 flex flex-col justify-between h-[180px]">
                                        <div>
                                            <h3 class="font-bold text-sm mb-2 leading-tight line-clamp-2">Bazaar Produk UMKM</h3>
                                            <p class="text-xs opacity-75 mb-2 line-clamp-3">Pameran produk-produk unggulan kelompok untuk memperluas pasar</p>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <p class="text-xs opacity-75 truncate">22 Juli 2023</p>
                                        </div>
                                        <div class="flex justify-between mt-2">
                                            <button onclick="editKegiatan(this)" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button onclick="deleteKegiatan(this)" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="kegiatan-item">
                            <a href="#" class="block no-underline">
                                <div class="bg-white text-black rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow w-[200px] min-h-[300px] mx-auto cursor-pointer">
                                    <div class="h-40">
                                        <img src="https://via.placeholder.com/200x160"
                                            alt="Workshop Digital Marketing"
                                            class="w-full h-full object-cover rounded-t-lg"
                                            style="max-height: 160px;">
                                    </div>
                                    <div class="p-4 flex flex-col justify-between h-[180px]">
                                        <div>
                                            <h3 class="font-bold text-sm mb-2 leading-tight line-clamp-2">Workshop Digital Marketing</h3>
                                            <p class="text-xs opacity-75 mb-2 line-clamp-3">Pelatihan pemasaran digital untuk meningkatkan penjualan produk</p>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <p class="text-xs opacity-75 truncate">5 Agustus 2023</p>
                                        </div>
                                        <div class="flex justify-between mt-2">
                                            <button onclick="editKegiatan(this)" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button onclick="deleteKegiatan(this)" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="kegiatan-item">
                            <a href="#" class="block no-underline">
                                <div class="bg-white text-black rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow w-[200px] min-h-[300px] mx-auto cursor-pointer">
                                    <div class="h-40">
                                        <img src="https://via.placeholder.com/200x160"
                                            alt="Kunjungan Industri"
                                            class="w-full h-full object-cover rounded-t-lg"
                                            style="max-height: 160px;">
                                    </div>
                                    <div class="p-4 flex flex-col justify-between h-[180px]">
                                        <div>
                                            <h3 class="font-bold text-sm mb-2 leading-tight line-clamp-2">Kunjungan Industri</h3>
                                            <p class="text-xs opacity-75 mb-2 line-clamp-3">Studi banding ke industri serupa untuk meningkatkan kualitas produk</p>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <p class="text-xs opacity-75 truncate">12 September 2023</p>
                                        </div>
                                        <div class="flex justify-between mt-2">
                                            <button onclick="editKegiatan(this)" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button onclick="deleteKegiatan(this)" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
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
                <div class="flex justify-end mb-4">
                    <button onclick="openInovasiForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i>Tambah Inovasi
                    </button>
                </div>
                <div class="relative">
                    <div id="inovasi-carousel" class="carousel">
                        <div class="inovasi-item">
                            <img
                                src="https://via.placeholder.com/800x600"
                                alt="Inovasi Produk"
                                class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer block"
                                onclick="openPreview('https://via.placeholder.com/800x600', 'Inovasi Produk')">
                            <div class="text-center mt-2">
                                <button onclick="editInovasi(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="deleteInovasi(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                        <div class="inovasi-item">
                            <img
                                src="https://via.placeholder.com/800x600"
                                alt="Penghargaan UMKM"
                                class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer hidden"
                                onclick="openPreview('https://via.placeholder.com/800x600', 'Penghargaan UMKM')">
                            <div class="text-center mt-2">
                                <button onclick="editInovasi(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="deleteInovasi(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center space-x-2 mt-4" id="inovasi-dots"></div>
                    <div class="flex justify-center mt-4">
                        <button class="btn btn-outline mr-2" onclick="prevSlide('inovasi')" aria-label="Previous slide">←</button>
                        <button class="btn btn-outline" onclick="nextSlide('inovasi')" aria-label="Next slide">→</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50" tabindex="-1" role="dialog" aria-labelledby="previewTitle">
        <div class="bg-white rounded-lg p-6 max-w-3xl w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="previewTitle" class="text-xl font-semibold text-gray-800"></h3>
                <button onclick="closePreview()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close preview modal">&times;</button>
            </div>
            <img id="previewImage" src="" alt="Preview" class="w-full max-h-[70vh] object-contain rounded-lg">
        </div>
    </div>

    <!-- Form Modal Struktur -->
    <div id="strukturModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="strukturModalTitle" class="text-xl font-semibold text-gray-800">Tambah Anggota Struktur</h3>
                <button onclick="closeStrukturForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="strukturForm" onsubmit="saveStruktur(event)">
                <div class="form-group">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-input" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeStrukturForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Modal Sejarah -->
    <div id="sejarahModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Edit Sejarah</h3>
                <button onclick="closeSejarahForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="sejarahForm" onsubmit="saveSejarah(event)">
                <div class="form-group">
                    <label for="sejarahContent" class="form-label">Isi Sejarah</label>
                    <textarea id="sejarahContent" name="sejarahContent" class="form-textarea" required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeSejarahForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Modal SK Desa -->
    <div id="skDesaModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="skDesaModalTitle" class="text-xl font-semibold text-gray-800">Tambah SK Desa</h3>
                <button onclick="closeSkDesaForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="skDesaForm" onsubmit="saveSkDesa(event)">
                <div class="form-group">
                    <label for="skJudul" class="form-label">Judul Dokumen</label>
                    <input type="text" id="skJudul" name="skJudul" class="form-input" placeholder="Contoh: SK Pembentukan Kelompok" required>
                </div>
                <div class="form-group">
                    <label for="skFile" class="form-label">Pilih File</label>
                    <input type="file" id="skFile" name="skFile" class="form-input" accept="image/*,.pdf" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeSkDesaForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Modal Kelompok Rentan -->
    <div id="rentanModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="rentanModalTitle" class="text-xl font-semibold text-gray-800">Tambah Data Kelompok Rentan</h3>
                <button onclick="closeRentanForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="rentanForm" onsubmit="saveRentan(event)">
                <div class="form-group">
                    <label for="lansia" class="form-label">Lansia</label>
                    <input type="text" id="lansia" name="lansia" class="form-input">
                </div>
                <div class="form-group">
                    <label for="disabilitas" class="form-label">Disabilitas</label>
                    <input type="text" id="disabilitas" name="disabilitas" class="form-input">
                </div>
                <div class="form-group">
                    <label for="anakYatim" class="form-label">Anak Yatim</label>
                    <input type="text" id="anakYatim" name="anakYatim" class="form-input">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRentanForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Modal Total Produk -->
    <div id="totalProdukModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="totalProdukModalTitle" class="text-xl font-semibold text-gray-800">Tambah Produk</h3>
                <button onclick="closeTotalProdukForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="totalProdukForm" onsubmit="saveTotalProduk(event)">
                <div class="form-group">
                    <label for="namaProduk" class="form-label">Nama Produk</label>
                    <input type="text" id="namaProduk" name="namaProduk" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="totalProduk" class="form-label">Total</label>
                    <input type="text" id="totalProduk" name="totalProduk" class="form-input" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeTotalProdukForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Modal Produk -->
    <div id="produkModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="produkModalTitle" class="text-xl font-semibold text-gray-800">Tambah Produk</h3>
                <button onclick="closeProdukForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="produkForm" onsubmit="saveProduk(event)">
                <div class="form-group">
                    <label for="produkNama" class="form-label">Nama Produk</label>
                    <input type="text" id="produkNama" name="produkNama" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="produkHarga" class="form-label">Harga</label>
                    <input type="text" id="produkHarga" name="produkHarga" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="produkStok" class="form-label">Stok</label>
                    <input type="number" id="produkStok" name="produkStok" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="produkGambar" class="form-label">Gambar</label>
                    <input type="file" id="produkGambar" name="produkGambar" class="form-input" accept="image/*">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeProdukForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Modal Kegiatan -->
    <div id="kegiatanModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="kegiatanModalTitle" class="text-xl font-semibold text-gray-800">Tambah Kegiatan</h3>
                <button onclick="closeKegiatanForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="kegiatanForm" onsubmit="saveKegiatan(event)">
                <div class="form-group">
                    <label for="kegiatanJudul" class="form-label">Judul Kegiatan</label>
                    <input type="text" id="kegiatanJudul" name="kegiatanJudul" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="kegiatanDeskripsi" class="form-label">Deskripsi</label>
                    <textarea id="kegiatanDeskripsi" name="kegiatanDeskripsi" class="form-textarea" required></textarea>
                </div>
                <div class="form-group">
                    <label for="kegiatanTanggal" class="form-label">Tanggal</label>
                    <input type="date" id="kegiatanTanggal" name="kegiatanTanggal" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="kegiatanGambar" class="form-label">Gambar</label>
                    <input type="file" id="kegiatanGambar" name="kegiatanGambar" class="form-input" accept="image/*">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeKegiatanForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form Modal Inovasi -->
    <div id="inovasiModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="inovasiModalTitle" class="text-xl font-semibold text-gray-800">Tambah Inovasi</h3>
                <button onclick="closeInovasiForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="inovasiForm" onsubmit="saveInovasi(event)">
                <div class="form-group">
                    <label for="inovasiJudul" class="form-label">Judul Inovasi</label>
                    <input type="text" id="inovasiJudul" name="inovasiJudul" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="inovasiGambar" class="form-label">Gambar</label>
                    <input type="file" id="inovasiGambar" name="inovasiGambar" class="form-input" accept="image/*,.pdf" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeInovasiForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-20">
        @include('footer')
    </div>

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
                            if (productName.toLowerCase().includes(searchTerm)) {
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
            if (e.key === 'Escape') {
                closePreview();
                closeAllForms();
            }

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

        // CRUD Functions for Struktur
        function openStrukturForm(editMode = false, row = null) {
            const modal = document.getElementById('strukturModal');
            const modalTitle = document.getElementById('strukturModalTitle');
            const form = document.getElementById('strukturForm');

            if (editMode && row) {
                modalTitle.textContent = 'Edit Anggota Struktur';
                document.getElementById('jabatan').value = row.cells[0].textContent;
                document.getElementById('nama').value = row.cells[1].textContent;
                form.dataset.editMode = 'true';
                form.dataset.rowIndex = row.rowIndex;
            } else {
                modalTitle.textContent = 'Tambah Anggota Struktur';
                form.reset();
                form.dataset.editMode = 'false';
                delete form.dataset.rowIndex;
            }

            modal.classList.remove('hidden');
        }

        function closeStrukturForm() {
            document.getElementById('strukturModal').classList.add('hidden');
        }

        function saveStruktur(event) {
            event.preventDefault();
            const form = event.target;
            const jabatan = document.getElementById('jabatan').value;
            const nama = document.getElementById('nama').value;
            const tbody = document.getElementById('struktur-tbody');

            if (form.dataset.editMode === 'true') {
                const rowIndex = form.dataset.rowIndex;
                const row = tbody.rows[rowIndex - 1];
                row.cells[0].textContent = jabatan;
                row.cells[1].textContent = nama;
            } else {
                const newRow = tbody.insertRow();
                newRow.innerHTML = `
                    <td class="border border-gray-200 p-3">${jabatan}</td>
                    <td class="border border-gray-200 p-3">${nama}</td>
                    <td class="border border-gray-200 p-3 text-center">
                        <button onclick="editStruktur(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteStruktur(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            }

            closeStrukturForm();
            showNotification('Data berhasil disimpan!');
        }

        function editStruktur(button) {
            const row = button.closest('tr');
            openStrukturForm(true, row);
        }

        function deleteStruktur(button) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const row = button.closest('tr');
                row.remove();
                showNotification('Data berhasil dihapus!');
            }
        }

        // CRUD Functions for Sejarah
        function openSejarahForm() {
            const modal = document.getElementById('sejarahModal');
            const content = document.getElementById('sejarah-content').textContent.trim();
            document.getElementById('sejarahContent').value = content;
            modal.classList.remove('hidden');
        }

        function closeSejarahForm() {
            document.getElementById('sejarahModal').classList.add('hidden');
        }

        function saveSejarah(event) {
            event.preventDefault();
            const content = document.getElementById('sejarahContent').value;
            document.getElementById('sejarah-content').textContent = content;
            closeSejarahForm();
            showNotification('Sejarah berhasil diperbarui!');
        }

        // CRUD Functions for SK Desa
        function openSkDesaForm(editMode = false, element = null) {
            const modal = document.getElementById('skDesaModal');
            const modalTitle = document.getElementById('skDesaModalTitle');
            const form = document.getElementById('skDesaForm');

            if (editMode && element) {
                modalTitle.textContent = 'Edit SK Desa';
                const skItem = element.closest('.sk-desa-item');
                const img = skItem.querySelector('img');
                const judul = img.alt;

                document.getElementById('skJudul').value = judul;
                form.dataset.editMode = 'true';
                form.dataset.elementId = skItem.id || Date.now();
            } else {
                modalTitle.textContent = 'Tambah SK Desa';
                form.reset();
                form.dataset.editMode = 'false';
                delete form.dataset.elementId;
            }

            modal.classList.remove('hidden');
        }

        function closeSkDesaForm() {
            document.getElementById('skDesaModal').classList.add('hidden');
        }

        function saveSkDesa(event) {
            event.preventDefault();
            const form = event.target;
            const judul = document.getElementById('skJudul').value;
            const fileInput = document.getElementById('skFile');
            const carousel = document.getElementById('sk-desa-carousel');

            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;

                if (form.dataset.editMode === 'true') {
                    const elementId = form.dataset.elementId;
                    const skItem = document.getElementById(elementId);

                    if (skItem) {
                        const img = skItem.querySelector('img');
                        img.alt = judul;
                        img.setAttribute('onclick', `openPreview('${img.src}', '${judul}')`);
                    }
                } else {
                    const newId = 'sk-desa-' + Date.now();
                    const newSk = document.createElement('div');
                    newSk.className = 'sk-desa-item';
                    newSk.id = newId;
                    newSk.innerHTML = `
                        <img
                            src="https://via.placeholder.com/800x600"
                            alt="${judul}"
                            class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer"
                            onclick="openPreview('https://via.placeholder.com/800x600', '${judul}')">
                        <div class="text-center mt-2">
                            <button onclick="editSkDesa(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="deleteSkDesa(this)" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    `;
                    carousel.appendChild(newSk);
                }

                closeSkDesaForm();
                initializeCarousel('sk-desa');
                showNotification(`File "${fileName}" berhasil disimpan!`);
            }
        }

        function editSkDesa(button) {
            openSkDesaForm(true, button);
        }

        function deleteSkDesa(button) {
            if (confirm('Apakah Anda yakin ingin menghapus SK Desa ini?')) {
                const skItem = button.closest('.sk-desa-item');
                skItem.remove();
                initializeCarousel('sk-desa');
                showNotification('SK Desa berhasil dihapus!');
            }
        }

        // CRUD Functions for Kelompok Rentan
        function openRentanForm(editMode = false, row = null) {
            const modal = document.getElementById('rentanModal');
            const modalTitle = document.getElementById('rentanModalTitle');
            const form = document.getElementById('rentanForm');

            if (editMode && row) {
                modalTitle.textContent = 'Edit Data Kelompok Rentan';
                document.getElementById('lansia').value = row.cells[0].textContent.trim() === '&nbsp;' ? '' : row.cells[0].textContent;
                document.getElementById('disabilitas').value = row.cells[1].textContent.trim() === '&nbsp;' ? '' : row.cells[1].textContent;
                document.getElementById('anakYatim').value = row.cells[2].textContent.trim() === '&nbsp;' ? '' : row.cells[2].textContent;
                form.dataset.editMode = 'true';
                form.dataset.rowIndex = row.rowIndex;
            } else {
                modalTitle.textContent = 'Tambah Data Kelompok Rentan';
                form.reset();
                form.dataset.editMode = 'false';
                delete form.dataset.rowIndex;
            }

            modal.classList.remove('hidden');
        }

        function closeRentanForm() {
            document.getElementById('rentanModal').classList.add('hidden');
        }

        function saveRentan(event) {
            event.preventDefault();
            const form = event.target;
            const lansia = document.getElementById('lansia').value || '&nbsp;';
            const disabilitas = document.getElementById('disabilitas').value || '&nbsp;';
            const anakYatim = document.getElementById('anakYatim').value || '&nbsp;';
            const tbody = document.getElementById('rentan-tbody');

            if (form.dataset.editMode === 'true') {
                const rowIndex = form.dataset.rowIndex;
                const row = tbody.rows[rowIndex - 1];
                row.cells[0].textContent = lansia;
                row.cells[1].textContent = disabilitas;
                row.cells[2].textContent = anakYatim;
            } else {
                const newRow = tbody.insertRow();
                newRow.innerHTML = `
                    <td class="border border-gray-200 p-2">${lansia}</td>
                    <td class="border border-gray-200 p-2">${disabilitas}</td>
                    <td class="border border-gray-200 p-2">${anakYatim}</td>
                    <td class="border border-gray-200 p-2 text-center">
                        <button onclick="editRentan(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteRentan(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            }

            closeRentanForm();
            showNotification('Data berhasil disimpan!');
        }

        function editRentan(button) {
            const row = button.closest('tr');
            openRentanForm(true, row);
        }

        function deleteRentan(button) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const row = button.closest('tr');
                row.remove();
                showNotification('Data berhasil dihapus!');
            }
        }

        // CRUD Functions for Total Produk
        function openTotalProdukForm(editMode = false, row = null) {
            const modal = document.getElementById('totalProdukModal');
            const modalTitle = document.getElementById('totalProdukModalTitle');
            const form = document.getElementById('totalProdukForm');

            if (editMode && row) {
                modalTitle.textContent = 'Edit Produk';
                const nama = row.cells[0].textContent;
                const total = row.cells[1].textContent.replace(' pcs', '');
                document.getElementById('namaProduk').value = nama;
                document.getElementById('totalProduk').value = total;
                form.dataset.editMode = 'true';
                form.dataset.rowIndex = row.rowIndex;
            } else {
                modalTitle.textContent = 'Tambah Produk';
                form.reset();
                form.dataset.editMode = 'false';
                delete form.dataset.rowIndex;
            }

            modal.classList.remove('hidden');
        }

        function closeTotalProdukForm() {
            document.getElementById('totalProdukModal').classList.add('hidden');
        }

        function saveTotalProduk(event) {
            event.preventDefault();
            const form = event.target;
            const nama = document.getElementById('namaProduk').value;
            const total = document.getElementById('totalProduk').value;
            const tbody = document.getElementById('total-produk-tbody');

            if (form.dataset.editMode === 'true') {
                const rowIndex = form.dataset.rowIndex;
                const row = tbody.rows[rowIndex - 1];
                row.cells[0].textContent = nama;
                row.cells[1].textContent = total + ' pcs';
            } else {
                const newRow = tbody.insertRow();
                newRow.innerHTML = `
                    <td class="border border-gray-200 p-2">${nama}</td>
                    <td class="border border-gray-200 p-2">${total} pcs</td>
                    <td class="border border-gray-200 p-2 text-center">
                        <button onclick="editTotalProduk(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteTotalProduk(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            }

            closeTotalProdukForm();
            showNotification('Data berhasil disimpan!');
        }

        function editTotalProduk(button) {
            const row = button.closest('tr');
            openTotalProdukForm(true, row);
        }

        function deleteTotalProduk(button) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const row = button.closest('tr');
                row.remove();
                showNotification('Data berhasil dihapus!');
            }
        }

        // CRUD Functions for Produk
        function openProdukForm(editMode = false, element = null) {
            const modal = document.getElementById('produkModal');
            const modalTitle = document.getElementById('produkModalTitle');
            const form = document.getElementById('produkForm');

            if (editMode && element) {
                modalTitle.textContent = 'Edit Produk';
                const produkItem = element.closest('.produk-item');
                const nama = produkItem.getAttribute('data-nama');
                const hargaText = produkItem.querySelector('.text-green-600').textContent;
                const harga = hargaText.replace('Rp. ', '').replace('.', '');
                const stokText = produkItem.querySelector('.text-black-500').textContent;
                const stok = stokText.replace('Stok: ', '');

                document.getElementById('produkNama').value = nama;
                document.getElementById('produkHarga').value = harga;
                document.getElementById('produkStok').value = stok;
                form.dataset.editMode = 'true';
                form.dataset.elementId = produkItem.id || Date.now();
            } else {
                modalTitle.textContent = 'Tambah Produk';
                form.reset();
                form.dataset.editMode = 'false';
                delete form.dataset.elementId;
            }

            modal.classList.remove('hidden');
        }

        function closeProdukForm() {
            document.getElementById('produkModal').classList.add('hidden');
        }

        function saveProduk(event) {
            event.preventDefault();
            const form = event.target;
            const nama = document.getElementById('produkNama').value;
            const harga = document.getElementById('produkHarga').value;
            const stok = document.getElementById('produkStok').value;
            const carousel = document.getElementById('produk-carousel');

            if (form.dataset.editMode === 'true') {
                const elementId = form.dataset.elementId;
                const produkItem = document.getElementById(elementId) || document.querySelector(`[data-nama="${elementId}"]`);

                if (produkItem) {
                    produkItem.setAttribute('data-nama', nama);
                    produkItem.querySelector('h3').textContent = nama;
                    produkItem.querySelector('.text-green-600').textContent = `Rp. ${Number(harga).toLocaleString('id-ID')}`;
                    produkItem.querySelector('.text-black-500').textContent = `Stok: ${stok}`;
                }
            } else {
                const newId = 'produk-' + Date.now();
                const newProduk = document.createElement('div');
                newProduk.className = 'produk-item';
                newProduk.id = newId;
                newProduk.setAttribute('data-nama', nama);
                newProduk.innerHTML = `
                    <a href="#" class="block no-underline">
                        <div class="border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto cursor-pointer">
                            <img src="https://via.placeholder.com/200x160"
                                alt="${nama}"
                                class="w-full h-40 object-cover rounded-lg">
                            <h3 class="mt-3 font-semibold text-lg truncate">${nama}</h3>
                            <div class="flex items-center justify-between pb-2">
                                <p class="text-green-600 font-bold text-lg truncate">Rp. ${Number(harga).toLocaleString('id-ID')}</p>
                                <p class="text-black-500 text-sm truncate">Stok: ${stok}</p>
                            </div>
                            <div class="flex justify-between mt-2">
                                <button onclick="editProduk(this)" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="deleteProduk(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </a>
                `;
                carousel.appendChild(newProduk);
            }

            closeProdukForm();
            initializeCarousel('produk');
            showNotification('Produk berhasil disimpan!');
        }

        function editProduk(button) {
            openProdukForm(true, button);
        }

        function deleteProduk(button) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                const produkItem = button.closest('.produk-item');
                produkItem.remove();
                initializeCarousel('produk');
                showNotification('Produk berhasil dihapus!');
            }
        }

        // CRUD Functions for Kegiatan
        function openKegiatanForm(editMode = false, element = null) {
            const modal = document.getElementById('kegiatanModal');
            const modalTitle = document.getElementById('kegiatanModalTitle');
            const form = document.getElementById('kegiatanForm');

            if (editMode && element) {
                modalTitle.textContent = 'Edit Kegiatan';
                const kegiatanItem = element.closest('.kegiatan-item');
                const judul = kegiatanItem.querySelector('h3').textContent;
                const deskripsi = kegiatanItem.querySelector('.line-clamp-3').textContent;
                const tanggalText = kegiatanItem.querySelector('.text-xs.opacity-75').textContent;

                document.getElementById('kegiatanJudul').value = judul;
                document.getElementById('kegiatanDeskripsi').value = deskripsi;
                form.dataset.editMode = 'true';
                form.dataset.elementId = kegiatanItem.id || Date.now();
            } else {
                modalTitle.textContent = 'Tambah Kegiatan';
                form.reset();
                form.dataset.editMode = 'false';
                delete form.dataset.elementId;
            }

            modal.classList.remove('hidden');
        }

        function closeKegiatanForm() {
            document.getElementById('kegiatanModal').classList.add('hidden');
        }

        function saveKegiatan(event) {
            event.preventDefault();
            const form = event.target;
            const judul = document.getElementById('kegiatanJudul').value;
            const deskripsi = document.getElementById('kegiatanDeskripsi').value;
            const tanggal = document.getElementById('kegiatanTanggal').value;
            const formattedDate = new Date(tanggal).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            const carousel = document.getElementById('kegiatan-carousel');

            if (form.dataset.editMode === 'true') {
                const elementId = form.dataset.elementId;
                const kegiatanItem = document.getElementById(elementId);

                if (kegiatanItem) {
                    kegiatanItem.querySelector('h3').textContent = judul;
                    kegiatanItem.querySelector('.line-clamp-3').textContent = deskripsi;
                    kegiatanItem.querySelector('.text-xs.opacity-75').textContent = formattedDate;
                }
            } else {
                const newId = 'kegiatan-' + Date.now();
                const newKegiatan = document.createElement('div');
                newKegiatan.className = 'kegiatan-item';
                newKegiatan.id = newId;
                newKegiatan.innerHTML = `
                    <a href="#" class="block no-underline">
                        <div class="bg-white text-black rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow w-[200px] min-h-[300px] mx-auto cursor-pointer">
                            <div class="h-40">
                                <img src="https://via.placeholder.com/200x160"
                                    alt="${judul}"
                                    class="w-full h-full object-cover rounded-t-lg"
                                    style="max-height: 160px;">
                            </div>
                            <div class="p-4 flex flex-col justify-between h-[180px]">
                                <div>
                                    <h3 class="font-bold text-sm mb-2 leading-tight line-clamp-2">${judul}</h3>
                                    <p class="text-xs opacity-75 mb-2 line-clamp-3">${deskripsi}</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-xs opacity-75 truncate">${formattedDate}</p>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <button onclick="editKegiatan(this)" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button onclick="deleteKegiatan(this)" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
                carousel.appendChild(newKegiatan);
            }

            closeKegiatanForm();
            initializeCarousel('kegiatan');
            showNotification('Kegiatan berhasil disimpan!');
        }

        function editKegiatan(button) {
            openKegiatanForm(true, button);
        }

        function deleteKegiatan(button) {
            if (confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')) {
                const kegiatanItem = button.closest('.kegiatan-item');
                kegiatanItem.remove();
                initializeCarousel('kegiatan');
                showNotification('Kegiatan berhasil dihapus!');
            }
        }

        // CRUD Functions for Inovasi
        function openInovasiForm(editMode = false, element = null) {
            const modal = document.getElementById('inovasiModal');
            const modalTitle = document.getElementById('inovasiModalTitle');
            const form = document.getElementById('inovasiForm');

            if (editMode && element) {
                modalTitle.textContent = 'Edit Inovasi';
                form.dataset.editMode = 'true';
                form.dataset.elementId = element.closest('.inovasi-item').id || Date.now();
            } else {
                modalTitle.textContent = 'Tambah Inovasi';
                form.reset();
                form.dataset.editMode = 'false';
                delete form.dataset.elementId;
            }

            modal.classList.remove('hidden');
        }

        function closeInovasiForm() {
            document.getElementById('inovasiModal').classList.add('hidden');
        }

        function saveInovasi(event) {
            event.preventDefault();
            const form = event.target;
            const judul = document.getElementById('inovasiJudul').value;
            const carousel = document.getElementById('inovasi-carousel');

            if (form.dataset.editMode === 'true') {
                const elementId = form.dataset.elementId;
                const inovasiItem = document.getElementById(elementId);

                if (inovasiItem) {
                    const img = inovasiItem.querySelector('img');
                    img.alt = judul;
                    img.setAttribute('onclick', `openPreview('${img.src}', '${judul}')`);
                }
            } else {
                const newId = 'inovasi-' + Date.now();
                const newInovasi = document.createElement('div');
                newInovasi.className = 'inovasi-item';
                newInovasi.id = newId;
                newInovasi.innerHTML = `
                    <img
                        src="https://via.placeholder.com/800x600"
                        alt="${judul}"
                        class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer block"
                        onclick="openPreview('https://via.placeholder.com/800x600', '${judul}')">
                    <div class="text-center mt-2">
                        <button onclick="editInovasi(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button onclick="deleteInovasi(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                `;
                carousel.appendChild(newInovasi);
            }

            closeInovasiForm();
            initializeCarousel('inovasi');
            showNotification('Inovasi berhasil disimpan!');
        }

        function editInovasi(button) {
            openInovasiForm(true, button);
        }

        function deleteInovasi(button) {
            if (confirm('Apakah Anda yakin ingin menghapus inovasi ini?')) {
                const inovasiItem = button.closest('.inovasi-item');
                inovasiItem.remove();
                initializeCarousel('inovasi');
                showNotification('Inovasi berhasil dihapus!');
            }
        }

        function closeAllForms() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.classList.add('hidden');
            });
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50';
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>

</html>