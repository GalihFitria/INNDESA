@extends('Admin.sidebar')

@section('title', 'Tambah Kelompok - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Tambah Kelompok::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.kelompok.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="id_kategori" id="id_kategori" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama Kelompok" required>
        </div>
        <div>
            <label for="sejarah" class="block text-sm font-medium text-gray-700">Sejarah</label>
            <input type="text" name="sejarah" id="sejarah" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Sejarah Kelompok" required>
        </div>
        <div>
            <label for="sk_desa" class="block text-sm font-medium text-gray-700">SK Desa</label>
            <input type="file" name="sk_desa" id="sk_desa" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('sk_desa')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="background" class="block text-sm font-medium text-gray-700">Background</label>
            <input type="file" name="background" id="background" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('background')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
            <input type="file" name="logo" id="logo" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('logo')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.kelompok.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </form>
</div>
@endsection