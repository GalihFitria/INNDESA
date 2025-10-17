@extends('Admin.sidebar')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

@section('title', 'Tambah User - INNDESA')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Hilangkan icon mata bawaan browser */
input[type="password"]::-ms-reveal,
input[type="password"]::-ms-clear {
    display: none;
}

input[type="password"]::-webkit-credentials-auto-fill-button,
input[type="password"]::-webkit-password-toggle-button {
    display: none !important;
}

</style>
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

    <div class="relative">
        <input 
            type="password" 
            name="password" 
            id="password"
            class="mt-1 block w-full border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 pr-10"
            placeholder="Masukkan Password" 
            required
        >
        <i 
            class="fa-solid fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer" 
            id="togglePassword">
        </i>
    </div>

    @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
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
<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        const passwordInput = document.getElementById("password");
        const icon = this;

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
</script>

@endsection
