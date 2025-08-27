@extends('Admin.sidebar')

@section('title', 'Edit Struktur Organisasi - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Struktur Organisasi::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.struktur.update', $struktur->id_struktur) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}" {{ $struktur->id_kelompok == $k->id_kelompok ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $struktur->nama }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama " required>
        </div>
        <div>
            <label for="jabatan" class="block text-sm font-medium text-gray-700">Posisi</label>
            <input type="text" name="jabatan" id="jabatan" value="{{ $struktur->jabatan }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Posisi (Ketua/Anggota)" required>
        </div>
        <div>
            <label for="rentan" class="block text-sm font-medium text-gray-700">Kelompok Rentan</label>
            <input type="text" name="rentan" id="rentan" value="{{ $struktur->rentan }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Kelompok rentan (Pengangguran,Janda dll)" required>
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.struktur.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Edit
            </button>
        </div>
    </form>
</div>
@endsection