@extends('Admin.sidebar')

@section('title', 'Edit Katalog - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Katalog::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.katalog.update', $katalog->id_katalog) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}" {{ $katalog->id_kelompok == $k->id_kelompok ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="katalog" class="block text-sm font-medium text-gray-700">Katalog</label>
            <input type="file" name="katalog" id="katalog" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">

            @if($katalog->katalog)
            <p class="mt-2 text-sm text-gray-700">
                File saat ini:
                <a href="https://drive.google.com/file/d/{{ $katalog->katalog }}/view" target="_blank" class="text-blue-600 hover:underline">
                    Lihat Katalog
                </a>
            </p>
            @endif
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.katalog.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Edit
            </button>
        </div>
    </form>
</div>
@endsection