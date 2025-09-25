@extends('Admin.sidebar')

@section('title', 'Tambah User - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Tambah User::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- ID User (readonly, auto increment) --}}
        <!-- <div>
            <label for="id_user" class="block text-sm font-medium text-gray-700">ID User</label>
            <input type="text" name="id_user" id="id_user" 
                   class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100 cursor-not-allowed" 
                   value="(Auto Increment)" readonly>
        </div> -->

        {{-- Username --}}
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Username" required>
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan Password" required>
        </div>

        {{-- Role (Dropdown) --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="admin_websiteinndesa">Admin Website INNDESA</option>
                <option value="admin_kelompok">Admin Kelompok</option>
            </select>
        </div>

        {{-- Status (Dropdown True/False) --}}
        <!-- <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" 
                    class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" 
                    required>
                <option value="sudah daftar">sudah daftar</option>
                <option value="belum daftar">belum daftar</option>
            </select>
        </div> -->

        {{-- Tombol --}}
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </form>
</div>
@endsection