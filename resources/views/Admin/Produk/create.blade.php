@extends('Admin.sidebar')

@section('title', 'Tambah Produk - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Tambah Produk::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto max-h-[500px] overflow-y-auto">
    <form action="{{ route('Admin.produk.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}">{{ $k->nama }}</option>
                @endforeach
            </select>
            @error('id_kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama Produk" required>
            @error('nama')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="text" name="harga" id="harga" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Harga Produk" required>
            @error('harga')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="text" name="stok" id="stok" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Stok Produk" required>
            @error('stok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk</label>
            <input type="file" name="foto" id="foto" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('foto')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Deskripsi Produk" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="sertifikat" class="block text-sm font-medium text-gray-700">Sertifikat</label>
            <input type="file" name="sertifikat" id="sertifikat" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('sertifikat')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="produk_terjual" class="block text-sm font-medium text-gray-700">Produk Terjual</label>
            <input type="text" name="produk_terjual" id="produk_terjual" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Produk Terjual" required>
            @error('produk_terjual')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </form>
</div>
@endsection