<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Logo & Background</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 font-sans">

  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <!-- Logo -->
    <div class="flex justify-center mb-4">
      <img src="{{ asset('images/logo.png') }}" alt="Logo"> 
    </div>

    <!-- Judul -->
    <h2 class="text-center text-2xl font-bold text-blue-600 mb-2">Edit Logo & Background</h2>
    <p class="text-center text-gray-600 mb-6">Unggah logo dan background kelompok Anda</p>

    <!-- Form -->
   <form action="{{ route('edit_logo_background.update', $kelompok->id_kelompok) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Logo -->
      <div class="mb-4">
        <label for="logo" class="block text-gray-700 font-medium mb-2">Logo</label>
        <input type="file" id="logo" name="logo" accept="image/*"
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
      </div>

      <!-- Background -->
      <div class="mb-4">
        <label for="background" class="block text-gray-700 font-medium mb-2">Background</label>
        <input type="file" id="background" name="background" accept="image/*"
               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
      </div>

      <!-- Tombol -->
      <button type="submit"
              class="w-full bg-blue-600 text-white font-medium py-2 rounded-md hover:bg-blue-700 transition">
        Simpan
      </button>

      <div class="text-center mt-4">
        <a href="{{ route('Admin_Kelompok.kelompok.index') }}" class="text-sm text-blue-500 hover:underline">Kembali</a>
      </div>
    </form>
  </div>

</body>
</html>
