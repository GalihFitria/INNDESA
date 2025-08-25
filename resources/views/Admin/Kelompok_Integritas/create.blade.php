@extends('Admin.sidebar')

@section('title', 'Tambah Kelompok Integrasi - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Tambah Kelompok Integritas::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.kelompok_integritas.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama Kelompok" required>
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('kelompok.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </form>
</div>
@endsection