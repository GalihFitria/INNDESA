<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard INNDESA')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-sm border-b px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-24 h-24 rounded-full overflow-hidden flex-shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo INNDESA" class="object-cover w-full h-full" />
                </div>
                <div>
                    <h1 class="font-extrabold text-3xl leading-tight text-gray-900 select-none">INNDESA</h1>
                    <p class="text-base leading-snug text-gray-600 select-none">Inovasi Nusantara Desa Integratif Pangan</p>
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
        <aside class="w-64 bg-white shadow-sm min-h-screen">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('Admin.dashboard.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.dashboard.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3 text-blue-600"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Admin.kelompok_integritas.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.kelompok_integritas.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-users mr-3 text-orange-600"></i>
                            <span>Kelompok Integrasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Admin.kelompok.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.kelompok.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-user-group mr-3 text-green-600"></i>
                            <span>Kelompok</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Admin.produk.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.produk.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-box mr-3 text-yellow-600"></i>
                            <span>Produk</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('Admin.kegiatan.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.kegiatan.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-calendar-alt mr-3 text-green-600"></i>
                            <span>Kegiatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Admin.struktur.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.struktur.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-sitemap mr-3 text-purple-600"></i>
                            <span>Struktur Organisasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Admin.inovasi.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.inovasi.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-sitemap mr-3 text-purple-600"></i>
                            <span>Inovasi & Penghargaan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('Admin.katalog.index') }}" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center {{ Route::is('Admin.katalog.index') ? 'bg-blue-100 text-blue-700' : '' }}">
                            <i class="fas fa-sitemap mr-3 text-purple-600"></i>
                            <span>Katalog</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item w-full text-left px-4 py-3 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                            <i class="fas fa-user mr-3 text-blue-500"></i>
                            <span>User</span>
                        </a>
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

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>

</html>