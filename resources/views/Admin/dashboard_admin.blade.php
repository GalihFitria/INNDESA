<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard INNDESA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Top Navbar -->
    <nav class="bg-white shadow-sm border-b px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo INNDESA" class="object-cover w-full h-full" />
                </div>
                <div>
                    <h1 class="font-extrabold text-xl leading-tight text-gray-900 select-none">INNDESA</h1>
                    <p class="text-xs leading-snug text-gray-600 select-none">Inovasi Nusantara Desa Integratif Pangan</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                    <img src="https://via.placeholder.com/40" alt="User Profile" class="object-cover w-full h-full" />
                </div>
                <span class="text-gray-800 font-medium">Admin</span>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-sm min-h-screen">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <button onclick="showSection('dashboard')" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center active">
                            <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                            <span>Dashboard</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('beranda')" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-home mr-3 text-green-600"></i>
                            <span>Beranda</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('perusahaan')" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-building mr-3 text-purple-600"></i>
                            <span>Perusahaan Pembina</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('kelompok')" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-users mr-3 text-orange-600"></i>
                            <span>Kelompok Integrasi</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('produk')" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-box mr-3 text-yellow-600"></i>
                            <span>Produk</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="showSection('user')" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-user mr-3 text-blue-500"></i>
                            <span>User</span>
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('beranda') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-external-link-alt mr-3 text-blue-600"></i>
                            <span>Lihat Website</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('beranda') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-sign-out-alt mr-3 text-red-600"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Dashboard Section -->
            <div id="dashboard-section" class="content-section">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Kelompok</p>
                                <p class="text-2xl font-bold text-gray-800">24</p>
                            </div>
                            <i class="fas fa-users text-3xl text-yellow-600"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Anggota Kelompok</p>
                                <p class="text-2xl font-bold text-gray-800">8</p>
                            </div>
                            <i class="fas fa-user-friends text-3xl text-purple-600"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Produk</p>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                            </div>
                            <i class="fas fa-box-open text-3xl text-orange-600"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Kelompok Rentan</p>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                            </div>
                            <i class="fas fa-user-shield text-3xl text-orange-600"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Views</p>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                            </div>
                            <i class="fas fa-eye text-3xl text-orange-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beranda Section -->
            <div id="beranda-section" class="content-section hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Konten Beranda</h2>
                    <button onclick="openModal('beranda')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Konten
                    </button>
                </div>
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Hero Section</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Banner utama halaman beranda</td>
                                <td class="px-6 py-4"><span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Aktif</span></td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Tentang Kami</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Informasi tentang INNDESA</td>
                                <td class="px-6 py-4"><span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Aktif</span></td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Perusahaan Section -->
            <div id="perusahaan-section" class="content-section hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Perusahaan Pembina</h2>
                    <a href="#"
                        class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        + Tambah Perusahaan
                    </a>
                    <!-- <button onclick="openModal('perusahaan')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Perusahaan
                    </button> -->
                </div>
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Perusahaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Misi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">PT Agro Nusantara</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Pertanian Organik</td>
                                <td class="px-6 py-4 text-sm text-gray-500">info@agronusantara.com</td>
                                <td class="px-6 py-4 text-sm text-gray-500">info@agronusantara.com</td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kelompok Section with Hierarchy -->
            <div id="kelompok-section" class="content-section hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Kelompok Integrasi</h2>
                    <button onclick="openJenisModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Jenis Kelompok
                    </button>
                </div>
                <div class="space-y-4">
                    <!-- List of Jenis Kelompok (Accordion Style) -->
                    <div id="jenis-list">
                        <!-- Example Jenis -->
                        <button onclick="toggleJenis('kwt')" class="w-full text-left px-4 py-3 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-between">
                            <span>KWT</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="kwt-content" class="hidden pl-4 mt-2 space-y-2">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Kelompok di KWT</h3>
                                <button onclick="openKelompokModal('kwt')" class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                    <i class="fas fa-plus mr-1"></i>Tambah Kelompok
                                </button>
                            </div>
                            <ul class="space-y-1">
                                <li>
                                    <button onclick="showKelompokDetail('kwt', 'Kelompok Wanita Tani 1')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                                        Kelompok Wanita Tani 1
                                    </button>
                                </li>
                                <li>
                                    <button onclick="showKelompokDetail('kwt', 'Kelompok Wanita Tani 2')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                                        Kelompok Wanita Tani 2
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <button onclick="toggleJenis('pertanian')" class="w-full text-left px-4 py-3 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-between">
                            <span>Pertanian</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="pertanian-content" class="hidden pl-4 mt-2 space-y-2">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold">Kelompok di Pertanian</h3>
                                <button onclick="openKelompokModal('pertanian')" class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                    <i class="fas fa-plus mr-1"></i>Tambah Kelompok
                                </button>
                            </div>
                            <ul class="space-y-1">
                                <li>
                                    <button onclick="showKelompokDetail('pertanian', 'Kelompok Tani Makmur')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                                        Kelompok Tani Makmur
                                    </button>
                                </li>
                                <li>
                                    <button onclick="showKelompokDetail('pertanian', 'Koperasi Sejahtera')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                                        Koperasi Sejahtera
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Detail Kelompok Panel with CRUD -->
                <div id="kelompok-detail" class="hidden mt-6 bg-white rounded-lg shadow-sm border p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800" id="detail-title"></h3>
                        <button onclick="hideKelompokDetail()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Tutup
                        </button>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Struktur</h4>
                                <button onclick="openDataModal('struktur')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah/Edit
                                </button>
                            </div>
                            <p id="detail-struktur" class="mt-2">Kosong</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Sejarah</h4>
                                <button onclick="openDataModal('sejarah')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah/Edit
                                </button>
                            </div>
                            <p id="detail-sejarah" class="mt-2">Kosong</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">SK Desa (Foto/PDF)</h4>
                                <button onclick="openFileModal('sk_desa')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Upload
                                </button>
                            </div>
                            <div id="detail-sk_desa" class="mt-2">
                                <p>Kosong</p>
                                <div id="sk_desa-preview" class="mt-2"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Kelompok Rentan</h4>
                                <button onclick="openDataModal('kelompok_rentan')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah/Edit
                                </button>
                            </div>
                            <p id="detail-kelompok_rentan" class="mt-2">Kosong</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Total Produk</h4>
                            </div>
                            <p id="detail-total_produk" class="mt-2">0</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Produk</h4>
                                <button onclick="openProdukModal()" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div id="detail-produk" class="mt-2">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="produk-table" class="divide-y divide-gray-200"></tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Kegiatan</h4>
                                <button onclick="openKegiatanModal()" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div id="detail-kegiatan" class="mt-2">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kegiatan-table" class="divide-y divide-gray-200"></tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Inovasi & Penghargaan (Foto/PDF)</h4>
                                <button onclick="openFileModal('inovasi_penghargaan')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Upload
                                </button>
                            </div>
                            <div id="detail-inovasi_penghargaan" class="mt-2">
                                <p>Kosong</p>
                                <div id="inovasi_penghargaan-preview" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Section -->
            <div id="produk-section" class="content-section hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Produk</h2>
                    <button onclick="openModal('produk')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Produk
                    </button>
                </div>
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Id Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sertifikat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">1</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">P001</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Beras Organik Premium</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Beras</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Rp 25.000/kg</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Beras</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Beras</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Beras</td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- User Section -->
            <div id="user-section" class="content-section hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Data User</h2>
                    <button onclick="openModal('user')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah User
                    </button>
                </div>
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Password</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sosmed</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Id Kelompok</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">1</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">John Doe</td>
                                <td class="px-6 py-4 text-sm text-gray-500">john.doe@inndesa.id</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>

                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal untuk Tambah Jenis Kelompok -->
            <div id="jenis-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Jenis Kelompok</h3>
                    <form id="jenis-form">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nama Jenis (misalnya KWT, Pertanian)</label>
                            <input type="text" id="nama-jenis" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('jenis')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal untuk Tambah Kelompok dalam Jenis -->
            <div id="kelompok-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Kelompok</h3>
                    <form id="kelompok-form">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
                            <input type="text" id="nama-kelompok" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('kelompok')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal untuk CRUD Data Teks -->
            <div id="data-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4" id="data-modal-title">Tambah Data</h3>
                    <form id="data-form">
                        <input type="hidden" id="data-type">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700" id="data-label">Isi Data</label>
                            <textarea id="data-content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('data')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal untuk Upload File (SK Desa, Inovasi & Penghargaan) -->
            <div id="file-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4" id="file-modal-title">Upload File</h3>
                    <form id="file-form">
                        <input type="hidden" id="file-type">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Pilih File (Foto/PDF)</label>
                            <input type="file" id="file-input" accept="image/*,application/pdf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('file')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Upload</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal untuk Tambah Produk -->
            <div id="produk-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Produk</h3>
                    <form id="produk-form">
                        <input type="hidden" id="produk-index">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                            <input type="text" id="produk-nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Foto Produk</label>
                            <input type="file" id="produk-foto" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="text" id="produk-harga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" id="produk-stok" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('produk')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal untuk Tambah Kegiatan -->
            <div id="kegiatan-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Kegiatan</h3>
                    <form id="kegiatan-form">
                        <input type="hidden" id="kegiatan-index">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                            <input type="text" id="kegiatan-judul" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Foto Kegiatan</label>
                            <input type="file" id="kegiatan-foto" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" id="kegiatan-tanggal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="kegiatan-deskripsi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal('kegiatan')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        let currentKelompokData = {};

        function showSection(sectionName) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.classList.add('hidden'));
            document.getElementById(sectionName + '-section').classList.remove('hidden');

            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active', 'bg-blue-100', 'text-blue-700'));
            event.target.closest('.menu-item').classList.add('active', 'bg-blue-100', 'text-blue-700');
        }

        function openModal(type) {
            alert('Modal untuk menambah/edit ' + type + ' akan dibuka di sini');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.menu-item').classList.add('bg-blue-100', 'text-blue-700');
        });

        function toggleJenis(jenisId) {
            const content = document.getElementById(jenisId + '-content');
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        }

        function openJenisModal() {
            document.getElementById('jenis-modal').classList.remove('hidden');
        }

        function openKelompokModal(jenis) {
            document.getElementById('kelompok-modal').classList.remove('hidden');
            window.currentJenis = jenis;
        }

        function closeModal(type) {
            document.getElementById(type + '-modal').classList.add('hidden');
        }

        function openFileModal(type) {
            document.getElementById('file-modal').classList.remove('hidden');
            document.getElementById('file-modal-title').textContent = `Upload ${type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}`;
            document.getElementById('file-type').value = type;
        }

        function openProdukModal(index = -1) {
            document.getElementById('produk-modal').classList.remove('hidden');
            document.getElementById('produk-index').value = index;
            if (index >= 0 && currentKelompokData.produk && currentKelompokData.produk[index]) {
                const produk = currentKelompokData.produk[index];
                document.getElementById('produk-nama').value = produk.nama;
                document.getElementById('produk-harga').value = produk.harga;
                document.getElementById('produk-stok').value = produk.stok;
                // Note: File input cannot be pre-filled for security reasons
            } else {
                document.getElementById('produk-nama').value = '';
                document.getElementById('produk-harga').value = '';
                document.getElementById('produk-stok').value = '';
                document.getElementById('produk-foto').value = '';
            }
        }

        function openKegiatanModal(index = -1) {
            document.getElementById('kegiatan-modal').classList.remove('hidden');
            document.getElementById('kegiatan-index').value = index;
            if (index >= 0 && currentKelompokData.kegiatan && currentKelompokData.kegiatan[index]) {
                const kegiatan = currentKelompokData.kegiatan[index];
                document.getElementById('kegiatan-judul').value = kegiatan.judul;
                document.getElementById('kegiatan-tanggal').value = kegiatan.tanggal;
                document.getElementById('kegiatan-deskripsi').value = kegiatan.deskripsi;
                // Note: File input cannot be pre-filled for security reasons
            } else {
                document.getElementById('kegiatan-judul').value = '';
                document.getElementById('kegiatan-tanggal').value = '';
                document.getElementById('kegiatan-deskripsi').value = '';
                document.getElementById('kegiatan-foto').value = '';
            }
        }

        function showKelompokDetail(jenis, nama) {
            const data = {
                'kwt-Kelompok Wanita Tani 1': {
                    struktur: 'Ketua: Susanto, Sekretaris: Ariel, Bendahara: Aji',
                    sejarah: 'Didirikan 2015, 15 anggota awal',
                    sk_desa: 'sk_desa1.pdf',
                    kelompok_rentan: 'Janda: 5, Pengangguran: 3',
                    produk: [{
                            nama: 'Beras Organik',
                            foto: 'beras.jpg',
                            harga: 'Rp 25.000/kg',
                            stok: 100
                        },
                        {
                            nama: 'Sayuran Hidroponik',
                            foto: 'sayuran.jpg',
                            harga: 'Rp 15.000/pack',
                            stok: 50
                        }
                    ],
                    kegiatan: [{
                            judul: 'Pelatihan Bulanan',
                            foto: 'pelatihan.jpg',
                            tanggal: '2025-07-15',
                            deskripsi: 'Pelatihan pertanian organik'
                        },
                        {
                            judul: 'Panen Bersama',
                            foto: 'panen.jpg',
                            tanggal: '2025-08-01',
                            deskripsi: 'Panen padi bersama komunitas'
                        }
                    ],
                    inovasi_penghargaan: 'penghargaan1.pdf'
                },
                'kwt-Kelompok Wanita Tani 2': {
                    struktur: 'Ketua: Maya, Sekretaris: Rina',
                    sejarah: 'Didirikan 2018, 20 anggota',
                    sk_desa: 'sk_desa2.jpg',
                    kelompok_rentan: 'Janda: 4, Pengangguran: 2',
                    produk: [{
                            nama: 'Kerajinan Tangan',
                            foto: 'kerajinan.jpg',
                            harga: 'Rp 50.000/unit',
                            stok: 20
                        },
                        {
                            nama: 'Madu Alami',
                            foto: 'madu.jpg',
                            harga: 'Rp 100.000/botol',
                            stok: 30
                        }
                    ],
                    kegiatan: [{
                        judul: 'Workshop Kreatif',
                        foto: 'workshop.jpg',
                        tanggal: '2025-06-20',
                        deskripsi: 'Workshop membuat kerajinan'
                    }],
                    inovasi_penghargaan: 'penghargaan2.jpg'
                },
                'pertanian-Kelompok Tani Makmur': {
                    struktur: 'Ketua: Budi, Sekretaris: Toni',
                    sejarah: 'Didirikan 2010, 25 anggota',
                    sk_desa: 'sk_desa3.pdf',
                    kelompok_rentan: 'Janda: 3, Pengangguran: 5',
                    produk: [{
                            nama: 'Jagung',
                            foto: 'jagung.jpg',
                            harga: 'Rp 10.000/kg',
                            stok: 200
                        },
                        {
                            nama: 'Padi',
                            foto: 'padi.jpg',
                            harga: 'Rp 12.000/kg',
                            stok: 150
                        }
                    ],
                    kegiatan: [{
                            judul: 'Penanaman',
                            foto: 'penanaman.jpg',
                            tanggal: '2025-05-10',
                            deskripsi: 'Penanaman jagung'
                        },
                        {
                            judul: 'Irigasi',
                            foto: 'irigasi.jpg',
                            tanggal: '2025-06-15',
                            deskripsi: 'Pemeliharaan sistem irigasi'
                        }
                    ],
                    inovasi_penghargaan: 'penghargaan3.pdf'
                },
                'pertanian-Koperasi Sejahtera': {
                    struktur: 'Ketua: Joko, Sekretaris: Sari',
                    sejarah: 'Didirikan 2012, 30 anggota',
                    sk_desa: 'sk_desa4.jpg',
                    kelompok_rentan: 'Janda: 6, Pengangguran: 4',
                    produk: [{
                            nama: 'Teh Hijau',
                            foto: 'teh.jpg',
                            harga: 'Rp 30.000/pack',
                            stok: 80
                        },
                        {
                            nama: 'Kopi Luwak',
                            foto: 'kopi.jpg',
                            harga: 'Rp 200.000/kg',
                            stok: 10
                        }
                    ],
                    kegiatan: [{
                            judul: 'Panen',
                            foto: 'panen_kopi.jpg',
                            tanggal: '2025-07-20',
                            deskripsi: 'Panen kopi luwak'
                        },
                        {
                            judul: 'Pengolahan',
                            foto: 'pengolahan.jpg',
                            tanggal: '2025-08-05',
                            deskripsi: 'Pengolahan teh hijau'
                        }
                    ],
                    inovasi_penghargaan: 'penghargaan4.jpg'
                }
            };

            const key = `${jenis}-${nama}`;
            currentKelompokData = data[key] || {
                struktur: '',
                sejarah: '',
                sk_desa: '',
                kelompok_rentan: '',
                produk: [],
                kegiatan: [],
                inovasi_penghargaan: ''
            };

            // Update detail panel
            document.getElementById('detail-title').textContent = `Detail ${nama} (${jenis.toUpperCase()})`;
            document.getElementById('detail-struktur').textContent = currentKelompokData.struktur || 'Kosong';
            document.getElementById('detail-sejarah').textContent = currentKelompokData.sejarah || 'Kosong';
            document.getElementById('detail-kelompok_rentan').textContent = currentKelompokData.kelompok_rentan || 'Kosong';
            document.getElementById('detail-total_produk').textContent = currentKelompokData.produk ? currentKelompokData.produk.length : 0;

            // SK Desa
            const skDesaPreview = document.getElementById('sk_desa-preview');
            skDesaPreview.innerHTML = '';
            if (currentKelompokData.sk_desa) {
                const ext = currentKelompokData.sk_desa.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png'].includes(ext)) {
                    skDesaPreview.innerHTML = `<img src="${currentKelompokData.sk_desa}" alt="SK Desa" class="max-w-xs h-auto">`;
                } else if (ext === 'pdf') {
                    skDesaPreview.innerHTML = `<a href="${currentKelompokData.sk_desa}" target="_blank" class="text-blue-600 hover:underline">Lihat PDF SK Desa</a>`;
                }
                document.getElementById('detail-sk_desa').querySelector('p').textContent = '';
            } else {
                document.getElementById('detail-sk_desa').querySelector('p').textContent = 'Kosong';
            }

            // Produk Table
            const produkTable = document.getElementById('produk-table');
            produkTable.innerHTML = '';
            if (currentKelompokData.produk && currentKelompokData.produk.length > 0) {
                currentKelompokData.produk.forEach((produk, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-4 py-2 text-sm text-gray-900">${produk.nama}</td>
                        <td class="px-4 py-2 text-sm"><img src="${produk.foto}" alt="${produk.nama}" class="w-16 h-16 object-cover"></td>
                        <td class="px-4 py-2 text-sm text-gray-500">${produk.harga}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">${produk.stok}</td>
                        <td class="px-4 py-2 text-sm">
                            <button onclick="openProdukModal(${index})" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                            <button onclick="deleteProduk(${index})" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                        </td>
                    `;
                    produkTable.appendChild(row);
                });
            } else {
                produkTable.innerHTML = `<tr><td colspan="5" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada produk</td></tr>`;
            }

            // Kegiatan Table
            const kegiatanTable = document.getElementById('kegiatan-table');
            kegiatanTable.innerHTML = '';
            if (currentKelompokData.kegiatan && currentKelompokData.kegiatan.length > 0) {
                currentKelompokData.kegiatan.forEach((kegiatan, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-4 py-2 text-sm text-gray-900">${kegiatan.judul}</td>
                        <td class="px-4 py-2 text-sm"><img src="${kegiatan.foto}" alt="${kegiatan.judul}" class="w-16 h-16 object-cover"></td>
                        <td class="px-4 py-2 text-sm text-gray-500">${kegiatan.tanggal}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">${kegiatan.deskripsi}</td>
                        <td class="px-4 py-2 text-sm">
                            <button onclick="openKegiatanModal(${index})" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                            <button onclick="deleteKegiatan(${index})" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                        </td>
                    `;
                    kegiatanTable.appendChild(row);
                });
            } else {
                kegiatanTable.innerHTML = `<tr><td colspan="5" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada kegiatan</td></tr>`;
            }

            // Inovasi & Penghargaan
            const inovasiPreview = document.getElementById('inovasi_penghargaan-preview');
            inovasiPreview.innerHTML = '';
            if (currentKelompokData.inovasi_penghargaan) {
                const ext = currentKelompokData.inovasi_penghargaan.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png'].includes(ext)) {
                    inovasiPreview.innerHTML = `<img src="${currentKelompokData.inovasi_penghargaan}" alt="Inovasi & Penghargaan" class="max-w-xs h-auto">`;
                } else if (ext === 'pdf') {
                    inovasiPreview.innerHTML = `<a href="${currentKelompokData.inovasi_penghargaan}" target="_blank" class="text-blue-600 hover:underline">Lihat PDF Inovasi & Penghargaan</a>`;
                }
                document.getElementById('detail-inovasi_penghargaan').querySelector('p').textContent = '';
            } else {
                document.getElementById('detail-inovasi_penghargaan').querySelector('p').textContent = 'Kosong';
            }

            document.getElementById('kelompok-detail').classList.remove('hidden');
        }

        function hideKelompokDetail() {
            document.getElementById('kelompok-detail').classList.add('hidden');
        }

        document.getElementById('jenis-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const namaJenis = document.getElementById('nama-jenis').value.toLowerCase();
            const list = document.getElementById('jenis-list');
            const button = document.createElement('button');
            button.onclick = () => toggleJenis(namaJenis);
            button.classList = 'w-full text-left px-4 py-3 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors flex items-center justify-between';
            button.innerHTML = `<span>${namaJenis.toUpperCase()}</span><i class="fas fa-chevron-down"></i>`;
            list.appendChild(button);

            const content = document.createElement('div');
            content.id = namaJenis + '-content';
            content.classList = 'hidden pl-4 mt-2 space-y-2';
            content.innerHTML = `
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Kelompok di ${namaJenis.toUpperCase()}</h3>
                    <button onclick="openKelompokModal('${namaJenis}')" class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        <i class="fas fa-plus mr-1"></i>Tambah Kelompok
                    </button>
                </div>
                <ul class="space-y-1"></ul>
            `;
            list.appendChild(content);
            closeModal('jenis');
        });

        document.getElementById('kelompok-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const namaKelompok = document.getElementById('nama-kelompok').value;
            const jenis = window.currentJenis;
            const ul = document.getElementById(jenis + '-content').querySelector('ul');
            const li = document.createElement('li');
            li.innerHTML = `
                <button onclick="showKelompokDetail('${jenis}', '${namaKelompok}')" class="w-full text-left px-4 py-2 hover:bg-gray-100 rounded">
                    ${namaKelompok}
                </button>
            `;
            ul.appendChild(li);
            closeModal('kelompok');
        });

        document.getElementById('data-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const type = document.getElementById('data-type').value;
            const content = document.getElementById('data-content').value;

            currentKelompokData[type] = content;
            document.getElementById(`detail-${type}`).textContent = content || 'Kosong';
            closeModal('data');
        });

        document.getElementById('file-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const type = document.getElementById('file-type').value;
            const fileInput = document.getElementById('file-input');
            const file = fileInput.files[0];
            if (file) {
                // Simulate file upload (in a real app, this would be sent to a server)
                const fileUrl = URL.createObjectURL(file);
                currentKelompokData[type] = fileUrl;

                const preview = document.getElementById(`${type}-preview`);
                preview.innerHTML = '';
                if (file.type.startsWith('image/')) {
                    preview.innerHTML = `<img src="${fileUrl}" alt="${type.replace('_', ' ')}" class="max-w-xs h-auto">`;
                } else if (file.type === 'application/pdf') {
                    preview.innerHTML = `<a href="${fileUrl}" target="_blank" class="text-blue-600 hover:underline">Lihat PDF ${type.replace('_', ' ')}</a>`;
                }
                document.getElementById(`detail-${type}`).querySelector('p').textContent = '';
            }
            closeModal('file');
        });

        document.getElementById('produk-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const index = parseInt(document.getElementById('produk-index').value);
            const nama = document.getElementById('produk-nama').value;
            const harga = document.getElementById('produk-harga').value;
            const stok = document.getElementById('produk-stok').value;
            const foto = document.getElementById('produk-foto').files[0];
            const fotoUrl = foto ? URL.createObjectURL(foto) : '';

            const produk = {
                nama,
                foto: fotoUrl,
                harga,
                stok
            };
            if (!currentKelompokData.produk) currentKelompokData.produk = [];

            if (index >= 0) {
                currentKelompokData.produk[index] = produk;
            } else {
                currentKelompokData.produk.push(produk);
            }

            // Update total produk
            document.getElementById('detail-total_produk').textContent = currentKelompokData.produk.length;

            // Update produk table
            const produkTable = document.getElementById('produk-table');
            produkTable.innerHTML = '';
            if (currentKelompokData.produk.length > 0) {
                currentKelompokData.produk.forEach((produk, i) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-4 py-2 text-sm text-gray-900">${produk.nama}</td>
                        <td class="px-4 py-2 text-sm"><img src="${produk.foto}" alt="${produk.nama}" class="w-16 h-16 object-cover"></td>
                        <td class="px-4 py-2 text-sm text-gray-500">${produk.harga}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">${produk.stok}</td>
                        <td class="px-4 py-2 text-sm">
                            <button onclick="openProdukModal(${i})" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                            <button onclick="deleteProduk(${i})" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                        </td>
                    `;
                    produkTable.appendChild(row);
                });
            } else {
                produkTable.innerHTML = `<tr><td colspan="5" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada produk</td></tr>`;
            }

            closeModal('produk');
        });

        document.getElementById('kegiatan-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const index = parseInt(document.getElementById('kegiatan-index').value);
            const judul = document.getElementById('kegiatan-judul').value;
            const tanggal = document.getElementById('kegiatan-tanggal').value;
            const deskripsi = document.getElementById('kegiatan-deskripsi').value;
            const foto = document.getElementById('kegiatan-foto').files[0];
            const fotoUrl = foto ? URL.createObjectURL(foto) : '';

            const kegiatan = {
                judul,
                foto: fotoUrl,
                tanggal,
                deskripsi
            };
            if (!currentKelompokData.kegiatan) currentKelompokData.kegiatan = [];

            if (index >= 0) {
                currentKelompokData.kegiatan[index] = kegiatan;
            } else {
                currentKelompokData.kegiatan.push(kegiatan);
            }

            // Update kegiatan table
            const kegiatanTable = document.getElementById('kegiatan-table');
            kegiatanTable.innerHTML = '';
            if (currentKelompokData.kegiatan.length > 0) {
                currentKelompokData.kegiatan.forEach((kegiatan, i) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-4 py-2 text-sm text-gray-900">${kegiatan.judul}</td>
                        <td class="px-4 py-2 text-sm"><img src="${kegiatan.foto}" alt="${kegiatan.judul}" class="w-16 h-16 object-cover"></td>
                        <td class="px-4 py-2 text-sm text-gray-500">${kegiatan.tanggal}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">${kegiatan.deskripsi}</td>
                        <td class="px-4 py-2 text-sm">
                            <button onclick="openKegiatanModal(${i})" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                            <button onclick="deleteKegiatan(${i})" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                        </td>
                    `;
                    kegiatanTable.appendChild(row);
                });
            } else {
                kegiatanTable.innerHTML = `<tr><td colspan="5" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada kegiatan</td></tr>`;
            }

            closeModal('kegiatan');
        });

        function deleteProduk(index) {
            if (confirm('Hapus produk ini?')) {
                currentKelompokData.produk.splice(index, 1);
                document.getElementById('detail-total_produk').textContent = currentKelompokData.produk.length;
                const produkTable = document.getElementById('produk-table');
                produkTable.innerHTML = '';
                if (currentKelompokData.produk.length > 0) {
                    currentKelompokData.produk.forEach((produk, i) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="px-4 py-2 text-sm text-gray-900">${produk.nama}</td>
                            <td class="px-4 py-2 text-sm"><img src="${produk.foto}" alt="${produk.nama}" class="w-16 h-16 object-cover"></td>
                            <td class="px-4 py-2 text-sm text-gray-500">${produk.harga}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">${produk.stok}</td>
                            <td class="px-4 py-2 text-sm">
                                <button onclick="openProdukModal(${i})" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                <button onclick="deleteProduk(${i})" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                            </td>
                        `;
                        produkTable.appendChild(row);
                    });
                } else {
                    produkTable.innerHTML = `<tr><td colspan="5" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada produk</td></tr>`;
                }
            }
        }

        function deleteKegiatan(index) {
            if (confirm('Hapus kegiatan ini?')) {
                currentKelompokData.kegiatan.splice(index, 1);
                const kegiatanTable = document.getElementById('kegiatan-table');
                kegiatanTable.innerHTML = '';
                if (currentKelompokData.kegiatan.length > 0) {
                    currentKelompokData.kegiatan.forEach((kegiatan, i) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="px-4 py-2 text-sm text-gray-900">${kegiatan.judul}</td>
                            <td class="px-4 py-2 text-sm"><img src="${kegiatan.foto}" alt="${kegiatan.judul}" class="w-16 h-16 object-cover"></td>
                            <td class="px-4 py-2 text-sm text-gray-500">${kegiatan.tanggal}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">${kegiatan.deskripsi}</td>
                            <td class="px-4 py-2 text-sm">
                                <button onclick="openKegiatanModal(${i})" class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                <button onclick="deleteKegiatan(${i})" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                            </td>
                        `;
                        kegiatanTable.appendChild(row);
                    });
                } else {
                    kegiatanTable.innerHTML = `<tr><td colspan="5" class="px-4 py-2 text-sm text-gray-500 text-center">Tidak ada kegiatan</td></tr>`;
                }
            }
        }

        function deleteData(type) {
            if (confirm(`Hapus data ${type.replace('_', ' ')}?`)) {
                currentKelompokData[type] = '';
                document.getElementById(`detail-${type}`).textContent = 'Kosong';
                const preview = document.getElementById(`${type}-preview`);
                if (preview) preview.innerHTML = '';
                if (document.getElementById(`detail-${type}`).querySelector('p')) {
                    document.getElementById(`detail-${type}`).querySelector('p').textContent = 'Kosong';
                }
            }
        }
    </script>

    <style>
        .menu-item.active {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        #sk_desa-preview img,
        #inovasi_penghargaan-preview img {
            max-width: 200px;
            height: auto;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
        }

        #produk-table img,
        #kegiatan-table img {
            border: 1px solid #e5e7eb;
            border-radius: 4px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #e5e7eb;
        }
    </style>
</body>

</html>