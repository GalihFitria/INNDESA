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
        <div>
            <label for="sk_desa" class="block text-sm font-medium text-gray-700">SK Desa (PDF)</label>
            <input type="file" name="sk_desa" id="sk_desa" accept=".pdf" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @if ($kelompok->sk_desa)
            <p class="text-sm text-gray-500 mt-1">File saat ini: {{ basename($kelompok->sk_desa) }}</p>
            @endif
        </div>
        <div>
            <label for="background" class="block text-sm font-medium text-gray-700">Background (JPG/PNG)</label>
            <input type="file" name="background" id="background" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @if ($kelompok->background)
            <p class="text-sm text-gray-500 mt-1">File saat ini: {{ basename($kelompok->background) }}</p>
            @endif
        </div>
        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo (JPG/PNG)</label>
            <input type="file" name="logo" id="logo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            @if ($kelompok->logo)
            <p class="text-sm text-gray-500 mt-1">File saat ini: {{ basename($kelompok->logo) }}</p>
            @endif
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