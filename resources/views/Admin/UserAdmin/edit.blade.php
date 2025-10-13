@extends('Admin.sidebar')

@section('title', 'Edit User - INNDESA')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit User::.</h2>

@if(session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('Admin.users.update', $user->id_user) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700">Username</label>
        <input type="text" name="username" value="{{ $user->username }}" class="w-full p-2 border rounded-lg" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Password</label>
        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
            class="w-full p-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg">
        @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Role</label>
        <select name="role" class="w-full p-2 border rounded-lg" required>
            <option value="">Pilih Role</option>
            <option value="admin_kelompok" {{ $user->role == 'admin_kelompok' ? 'selected' : '' }}>Admin Kelompok</option>
            <option value="admin_web" {{ $user->role == 'admin_web' ? 'selected' : '' }}>Admin Web</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Status</label>
        <div class="w-full p-2 border rounded-lg bg-gray-100">
            {{ $user->status == 'belum daftar' ? 'Belum Daftar' : 'Sudah Daftar' }}
        </div>
        <input type="hidden" name="status" value="{{ $user->status }}">
        <small class="text-gray-500">Status tidak dapat diubah</small>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('Admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
            <i class="fas fa-save mr-2"></i>Simpan Perubahan
        </button>
    </div>
</form>
@endsection