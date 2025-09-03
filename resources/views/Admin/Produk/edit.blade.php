@extends('Admin.sidebar')

@section('title', 'Edit Produk - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Produk::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.produk.update', $produk->id_produk) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}" {{ $produk->id_kelompok == $k->id_kelompok ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama" id="nama" value="{{ $produk->nama }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama Produk " required>
        </div>
        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="text" name="harga" id="harga" value="{{ $produk->harga }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Harga Produk" required>
        </div>
        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="text" name="stok" id="stok" value="{{ $produk->stok }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Stok Produk" required>
        </div>
        <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk</label>
            @if ($produk->foto)
            <a href="{{ asset('storage/' . $produk->foto) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($produk->foto) }}</a>
            @endif
            <input type="file" name="foto" id="foto" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('produk')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Deskripsi Produk" required>{{ $produk->deskripsi ?? '' }}</textarea>
        </div>
        <div class="mb-4">
            <label for="sertifikat" class="block text-sm font-medium text-gray-700">Sertifikat</label>
            @if ($produk->sertifikat)
            <a href="{{ asset('storage/' . $produk->sertifikat) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($produk->sertifikat) }}</a>
            @endif
            <input type="file" name="sertifikat" id="sertifikat" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('produk')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="produk_terjual" class="block text-sm font-medium text-gray-700">Produk Terjual</label>
            <input type="text" name="produk_terjual" id="produk_terjual" value="{{ $produk->produk_terjual }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Deskripsi" required>
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Edit
            </button>
        </div>
    </form>
</div>
@endsection