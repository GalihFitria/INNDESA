@extends('Admin.sidebar')

@section('title', 'Dashboard - INNDESA')

@section('content')
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
                <p id="viewCount" class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <i class="fas fa-eye text-3xl text-orange-600"></i>
        </div>
    </div>
</div>

<script>
    // View-display logic (only read from localStorage, do not increment)
    let views = localStorage.getItem("page_views") || 0;
    views = parseInt(views);

    const viewCountEl = document.getElementById("viewCount");
    if (viewCountEl) {
        viewCountEl.textContent = views;
    }
</script>
@endsection