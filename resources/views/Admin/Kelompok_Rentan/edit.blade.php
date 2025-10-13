@extends('Admin.sidebar')

@section('title', 'Edit Kelompok Rentan - INNDESA')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Kelompok Rentan::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.kelompok_rentan.update', $rentan->id_rentan) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_rentan" class="block text-sm font-medium text-gray-700">Nama Kelompok Rentan</label>
            <input
                type="text"
                name="nama_rentan"
                id="nama_rentan"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Nama Kelompok Rentan"
                value="{{ old('nama_rentan', $rentan->nama_rentan) }}"
                required>
            @error('nama_rentan')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="total" class="block text-sm font-medium text-gray-700">Total (tidak perlu diisi)</label>
            <input
                type="text"
                name="total"
                id="total"
                value="{{ old('total', $rentan->total) }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100 text-gray-600 cursor-not-allowed focus:ring-0 focus:border-gray-300"
                readonly>
            @error('total')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.kelompok_rentan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<input type="hidden" id="error-message" value="{{ $errors->first('nama_rentan') ?? '' }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const errorMessage = document.getElementById('error-message').value;
    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    }
</script>
@endsection