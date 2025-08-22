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
                <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
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
                                <p class="text-sm text-gray-600">Total Produk</p>
                                <p class="text-2xl font-bold text-gray-800">24</p>
                            </div>
                            <i class="fas fa-box text-3xl text-yellow-600"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Perusahaan Pembina</p>
                                <p class="text-2xl font-bold text-gray-800">8</p>
                            </div>
                            <i class="fas fa-building text-3xl text-purple-600"></i>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Kelompok Integrasi</p>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                            </div>
                            <i class="fas fa-users text-3xl text-orange-600"></i>
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
                    <button onclick="openModal('perusahaan')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Tambah Perusahaan
                    </button>
                </div>
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Perusahaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bidang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kontak</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">PT Agro Nusantara</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Pertanian Organik</td>
                                <td class="px-6 py-4 text-sm text-gray-500">info@agronusantara.com</td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">CV Pangan Sehat</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Pengolahan Pangan</td>
                                <td class="px-6 py-4 text-sm text-gray-500">contact@pangansehat.id</td>
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
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <p id="detail-struktur" class="mt-2">Kosong</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Produk</h4>
                                <button onclick="openDataModal('produk')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <p id="detail-produk" class="mt-2">Kosong</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Kegiatan</h4>
                                <button onclick="openDataModal('kegiatan')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <p id="detail-kegiatan" class="mt-2">Kosong</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Sertifikat</h4>
                                <button onclick="openDataModal('sertifikat')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <p id="detail-sertifikat" class="mt-2">Kosong</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Sejarah</h4>
                                <button onclick="openDataModal('sejarah')" class="px-2 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <p id="detail-sejarah" class="mt-2">Kosong</p>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Beras Organik Premium</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Beras</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Rp 25.000/kg</td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Sayuran Hidroponik</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Sayuran</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Rp 15.000/pack</td>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">John Doe</td>
                                <td class="px-6 py-4 text-sm text-gray-500">john.doe@inndesa.id</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3"><i class="fas fa-edit"></i></button>
                                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">Jane Smith</td>
                                <td class="px-6 py-4 text-sm text-gray-500">jane.smith@inndesa.id</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Editor</td>
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

            <!-- Modal untuk CRUD Data Kelompok -->
            <div id="data-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-bold text-gray-800 mb-4" id="data-modal-title">Tambah Data</h3>
                    <form id="data-form">
                        <input type="hidden" id="data-type">
                        <input type="hidden" id="data-index">
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

        function showKelompokDetail(jenis, nama) {
            const data = {
                'kwt-Kelompok Wanita Tani 1': {
                    struktur: 'Ketua: Susanto, Sekretaris: Ariel, Bendahara: Aji',
                    produk: 'Beras Organik, Sayuran Hidroponik',
                    kegiatan: 'Pelatihan Bulanan, Panen Bersama',
                    sertifikat: 'Sertifikat Organik 2023',
                    sejarah: 'Didirikan 2015, 15 anggota awal'
                },
                'kwt-Kelompok Wanita Tani 2': {
                    struktur: 'Ketua: Maya, Sekretaris: Rina',
                    produk: 'Kerajinan Tangan, Madu Alami',
                    kegiatan: 'Workshop Kreatif',
                    sertifikat: 'Sertifikat UMKM 2024',
                    sejarah: 'Didirikan 2018, 20 anggota'
                },
                'pertanian-Kelompok Tani Makmur': {
                    struktur: 'Ketua: Budi, Sekretaris: Toni',
                    produk: 'Jagung, Padi',
                    kegiatan: 'Penanaman, Irigasi',
                    sertifikat: 'Sertifikat Pertanian Organik',
                    sejarah: 'Didirikan 2010, 25 anggota'
                },
                'pertanian-Koperasi Sejahtera': {
                    struktur: 'Ketua: Joko, Sekretaris: Sari',
                    produk: 'Teh Hijau, Kopi Luwak',
                    kegiatan: 'Panen, Pengolahan',
                    sertifikat: 'Sertifikat Ekspor 2022',
                    sejarah: 'Didirikan 2012, 30 anggota'
                }
            };

            const key = `${jenis}-${nama}`;
            currentKelompokData = data[key] || {
                struktur: '',
                produk: '',
                kegiatan: '',
                sertifikat: '',
                sejarah: ''
            };

            document.getElementById('detail-title').textContent = `Detail ${nama} (${jenis.toUpperCase()})`;
            document.getElementById('detail-struktur').textContent = currentKelompokData.struktur || 'Kosong';
            document.getElementById('detail-produk').textContent = currentKelompokData.produk || 'Kosong';
            document.getElementById('detail-kegiatan').textContent = currentKelompokData.kegiatan || 'Kosong';
            document.getElementById('detail-sertifikat').textContent = currentKelompokData.sertifikat || 'Kosong';
            document.getElementById('detail-sejarah').textContent = currentKelompokData.sejarah || 'Kosong';
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

        function openDataModal(type) {
            document.getElementById('data-modal').classList.remove('hidden');
            document.getElementById('data-modal-title').textContent = `Tambah ${type.charAt(0).toUpperCase() + type.slice(1)}`;
            document.getElementById('data-type').value = type;
            document.getElementById('data-index').value = -1; // -1 untuk tambah baru
            document.getElementById('data-label').textContent = `Isi ${type.charAt(0).toUpperCase() + type.slice(1)}`;
            document.getElementById('data-content').value = '';
        }

        function editData(type, index) {
            document.getElementById('data-modal').classList.remove('hidden');
            document.getElementById('data-modal-title').textContent = `Edit ${type.charAt(0).toUpperCase() + type.slice(1)}`;
            document.getElementById('data-type').value = type;
            document.getElementById('data-index').value = index;
            document.getElementById('data-label').textContent = `Isi ${type.charAt(0).toUpperCase() + type.slice(1)}`;
            document.getElementById('data-content').value = currentKelompokData[type] || '';
        }

        document.getElementById('data-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const type = document.getElementById('data-type').value;
            const index = parseInt(document.getElementById('data-index').value);
            const content = document.getElementById('data-content').value;

            if (index === -1) {
                currentKelompokData[type] = content;
            } else {
                // Logika update (simpel untuk contoh)
                currentKelompokData[type] = content;
            }

            // Perbarui tampilan
            document.getElementById(`detail-${type}`).textContent = content || 'Kosong';
            closeModal('data');
        });

        // Contoh fungsi untuk hapus (akan diimplementasikan lebih lanjut)
        function deleteData(type) {
            if (confirm(`Hapus data ${type}?`)) {
                currentKelompokData[type] = '';
                document.getElementById(`detail-${type}`).textContent = 'Kosong';
            }
        }
    </script>

    <style>
        .menu-item.active {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
    </style>
</body>

</html>