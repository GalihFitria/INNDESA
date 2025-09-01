@extends('Admin.sidebar')

@section('title', 'Edit Kelompok - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Kelompok::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.kelompok.update', $kelompok->id_kelompok) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="id_kategori" id="id_kategori" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}" {{ $kelompok->id_kategori == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $kelompok->nama }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama Kelompok" required>
        </div>
        <div>
            <label for="sejarah" class="block text-sm font-medium text-gray-700">Sejarah</label>
            <input type="text" name="sejarah" id="sejarah" value="{{ $kelompok->sejarah }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Sejarah Kelompok" required>
        </div>
        <div class="mb-4">
            <label for="sk_desa" class="block text-sm font-medium text-gray-700">SK Desa</label>
            @if ($kelompok->sk_desa)
            <a href="{{ asset('storage/' . $kelompok->sk_desa) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($kelompok->sk_desa) }}</a>
            @endif
            <input type="file" name="sk_desa" id="sk_desa" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="background" class="block text-sm font-medium text-gray-700">Background</label>
            @if ($kelompok->background)
            <a href="{{ asset('storage/' . $kelompok->background) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($kelompok->background) }}</a>
            @endif
            <input type="file" name="background" id="background" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
            @if ($kelompok->logo)
            <a href="{{ asset('storage/' . $kelompok->logo) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($kelompok->logo) }}</a>
            @endif
            <input type="file" name="logo" id="logo" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @error('kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.kelompok.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Edit
            </button>
        </div>
    </form>
</div>
@endsection