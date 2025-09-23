@extends('Admin.sidebar')

@section('title', 'Dashboard - INNDESA')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card Total Kelompok dengan link -->
    <a href="{{ asset('Admin/kelompok') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-sm border hover:shadow-md transition duration-300 cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Kelompok</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalKelompok }}</p>
                </div>
                <i class="fas fa-users text-3xl text-yellow-600"></i>
            </div>
        </div>
    </a>

    <a href="{{ asset('Admin/struktur') }}" class="block">
        <div class="bg-white p-6 rounded-lg shadow-sm border hover:shadow-md transition duration-300 cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Anggota Kelompok</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalAnggota }}</p>
                </div>
                <i class="fas fa-user-friends text-3xl text-purple-600"></i>
            </div>
        </div>

        <a href="{{ asset('Admin/produk') }}" class="block">
            <div class="bg-white p-6 rounded-lg shadow-sm border hover:shadow-md transition duration-300 cursor-pointer">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalProduk }}</p>
                    </div>
                    <i class="fas fa-box-open text-3xl text-orange-600"></i>
                </div>
            </div>

            <a href="{{ asset('Admin/kelompok_rentan') }}" class="block">
                <div class="bg-white p-6 rounded-lg shadow-sm border hover:shadow-md transition duration-300 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Kelompok Rentan</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalKelompokRentan }}</p>
                        </div>
                        <i class="fas fa-user-shield text-3xl text-orange-600"></i>
                    </div>
                </div>

                <a href="#" class="block">
                    <div class="bg-white p-6 rounded-lg shadow-sm border">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Views</p>
                                <p id="viewCount" class="text-2xl font-bold text-gray-800">{{ $totalViews }}</p>
                            </div>
                            <i class="fas fa-eye text-3xl text-blue-600"></i>
                        </div>
                    </div>
</div>

<!-- Tambahkan script untuk refresh data secara real-time -->
<script>
    // Fungsi untuk refresh data statistik
    async function refreshStats() {
        try {
            const response = await fetch("/api/statistik");
            const data = await response.json();

            // Update view count
            const viewCountEl = document.getElementById("viewCount");
            if (viewCountEl) {
                viewCountEl.textContent = data.homePageViews;
            }
        } catch (error) {
            console.error("Gagal refresh statistik:", error);
        }
    }

    // Refresh statistik setiap 10 detik
    setInterval(refreshStats, 10000);
</script>
@endsection