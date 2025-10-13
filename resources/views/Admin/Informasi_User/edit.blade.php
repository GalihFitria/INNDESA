@extends('Admin.sidebar')

@section('title', 'Edit Informasi User - INNDESA')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Informasi User::.</h2>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto" style="max-height: 80vh; overflow-y: auto;">
    <form action="{{ route('Admin.informasi_user.update', $user->id_admin) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- ID Kelompok dengan Select2 --}}
        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('id_kelompok') border-red-500 @enderror select2"
                style="width: 100%;" required>
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompoks as $k)
                <option value="{{ $k->id_kelompok }}"
                    {{ old('id_kelompok', $user->id_kelompok ?? '') == $k->id_kelompok ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
            @error('id_kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- ID User --}}
        <div>
            <label for="id_user" class="block text-sm font-medium text-gray-700">ID User</label>
            <input type="number" name="id_user" id="id_user" value="{{ $user->id_user }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100 cursor-not-allowed"
                readonly>

        </div>

        {{-- Username --}}
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" value="{{ $user->username }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Username" required>
        </div>

        {{-- Password - Menampilkan hash yang ada --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Biarkan kosong jika tidak ingin mengubah password">

            <small class="text-gray-500">Kosongkan jika tidak ingin mengubah password.</small>

            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- No Telp --}}
        <div>
            <label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telp</label>
            <input type="text" name="no_telp" id="no_telp" value="{{ $user->no_telp }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Nomor Telepon" required>
        </div>

        {{-- IG --}}
        <div>
            <label for="ig" class="block text-sm font-medium text-gray-700">Instagram</label>
            <input type="text" name="ig" id="ig" value="{{ $user->ig }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Username IG">
        </div>

        {{-- Facebook --}}
        <div>
            <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
            <input type="text" name="facebook" id="facebook" value="{{ $user->facebook }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Username Facebook">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Email" required>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('Admin.informasi_user.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Library Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#id_kelompok').select2({
            placeholder: "-- Pilih Kelompok --",
            allowClear: true,
            dropdownParent: $('#id_kelompok').parent()
        });
    });
</script>
@endsection