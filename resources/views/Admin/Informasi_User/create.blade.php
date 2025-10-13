@extends('Admin.sidebar')

@section('title', 'Tambah Informasi User - INNDESA')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Tambah Informasi User::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto" style="max-height: 80vh; overflow-y: auto;">
    <form action="{{ route('Admin.informasi_user.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- ID Kelompok --}}
        <div>
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Kelompok</label>
            <select name="id_kelompok" id="id_kelompok"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
                <option value="" disabled {{ old('id_kelompok') ? '' : 'selected' }}>Pilih Kelompok</option>
                @foreach($kelompoks as $kelompok)
                <option value="{{ $kelompok->id_kelompok }}"
                    {{ old('id_kelompok') == $kelompok->id_kelompok ? 'selected' : '' }}>
                    {{ $kelompok->nama }}
                </option>
                @endforeach
            </select>
            @error('id_kelompok')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- ID User --}}
        <div>
            <label for="id_user" class="block text-sm font-medium text-gray-700">User</label>
            <select name="id_user" id="id_user"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
                <option value="" disabled {{ old('id_user') ? '' : 'selected' }}>Pilih User</option>
                @foreach($users as $user)
                <option value="{{ $user->id_user }}"
                    {{ old('id_user') == $user->id_user ? 'selected' : '' }}>
                    {{ $user->id_user }}
                </option>
                @endforeach
            </select>
            @error('id_user')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Username --}}
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username"
                value="{{ old('username') }}"
                class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Username (harus sama dengan tabel users)" required>
            @error('username')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Password" required>

            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        {{-- No Telp --}}
        <div>
            <label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telp</label>
            <input type="text" name="no_telp" id="no_telp"
                value="{{ old('no_telp') }}"
                class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Nomor Telepon" required>
            @error('no_telp')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- IG --}}
        <div>
            <label for="ig" class="block text-sm font-medium text-gray-700">Instagram</label>
            <input type="text" name="ig" id="ig"
                value="{{ old('ig') }}"
                class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Username IG">
        </div>

        {{-- Facebook --}}
        <div>
            <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
            <input type="text" name="facebook" id="facebook"
                value="{{ old('facebook') }}"
                class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Username Facebook">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                value="{{ old('email') }}"
                class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Email" required>
            @error('email')
            <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            <a href="{{ route('Admin.informasi_user.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </form>
</div>

@if(session('warning'))
<script>
    alert("{{ session('warning') }}");
</script>
@endif
@endsection