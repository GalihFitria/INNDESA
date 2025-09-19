@extends('Admin.sidebar')

@section('content')
<h2 class="text-center text-3xl font-bold text-gray-800 mb-6">.::Edit Produk Terjual/Tahun::.</h2>

<div class="bg-white shadow-md p-6 rounded-lg max-w-3xl mx-auto">
    <form action="{{ route('Admin.produk_pertahun.update', $produk_pertahun->id_tahun) }}" method="POST">
        @csrf
        @method('PUT') <!-- Metode PUT untuk update -->
        {{-- Tahun --}}
        <div class="mb-4">
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
            <select id="tahun" name="tahun"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('tahun') border-red-500 @enderror">
                <option value="">-- Pilih Tahun --</option>
                <option value="2016" {{ old('tahun', $produk_pertahun->tahun) == '2016' ? 'selected' : '' }}>2016</option>
                <option value="2017" {{ old('tahun', $produk_pertahun->tahun) == '2017' ? 'selected' : '' }}>2017</option>
                <option value="2018" {{ old('tahun', $produk_pertahun->tahun) == '2018' ? 'selected' : '' }}>2018</option>
                <option value="2019" {{ old('tahun', $produk_pertahun->tahun) == '2019' ? 'selected' : '' }}>2019</option>
                <option value="2020" {{ old('tahun', $produk_pertahun->tahun) == '2020' ? 'selected' : '' }}>2020</option>
                <option value="2021" {{ old('tahun', $produk_pertahun->tahun) == '2021' ? 'selected' : '' }}>2021</option>
                <option value="2022" {{ old('tahun', $produk_pertahun->tahun) == '2022' ? 'selected' : '' }}>2022</option>
                <option value="2023" {{ old('tahun', $produk_pertahun->tahun) == '2023' ? 'selected' : '' }}>2023</option>
                <option value="2024" {{ old('tahun', $produk_pertahun->tahun) == '2024' ? 'selected' : '' }}>2024</option>
                <option value="2025" {{ old('tahun', $produk_pertahun->tahun) == '2025' ? 'selected' : '' }}>2025</option>
                <option value="2026" {{ old('tahun', $produk_pertahun->tahun) == '2026' ? 'selected' : '' }}>2026</option>
                <option value="2027" {{ old('tahun', $produk_pertahun->tahun) == '2027' ? 'selected' : '' }}>2027</option>
                <option value="2028" {{ old('tahun', $produk_pertahun->tahun) == '2028' ? 'selected' : '' }}>2028</option>
                <option value="2029" {{ old('tahun', $produk_pertahun->tahun) == '2029' ? 'selected' : '' }}>2029</option>
                <option value="2030" {{ old('tahun', $produk_pertahun->tahun) == '2030' ? 'selected' : '' }}>2030</option>
            </select>
            @error('tahun')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="id_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <select id="id_produk" name="id_produk" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('id_produk') border-red-500 @enderror select2" style="width: 100%;">
                <option value="">-- Pilih Produk --</option>
                @foreach ($produks as $produk)
                <option value="{{ $produk->id_produk }}" {{ old('id_produk', $produk_pertahun->id_produk) == $produk->id_produk ? 'selected' : '' }}>
                    {{ $produk->nama }} ({{ $produk->kelompok->nama ?? 'Tidak Diketahui' }})
                </option>
                @endforeach
            </select>
            @error('id_produk')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Harga --}}
        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" placeholder="Masukkan harga"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('harga') border-red-500 @enderror"
                value="{{ old('harga', $produk_pertahun->harga) }}">
            @error('harga')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Produk Terjual --}}
        <div class="mb-4">
            <label for="jumlah_terjual" class="block text-sm font-medium text-gray-700">Jumlah Produk Terjual</label>
            <input type="number" id="jumlah_terjual" name="jumlah_terjual" placeholder="Masukkan jumlah produk terjual"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('jumlah_terjual') border-red-500 @enderror"
                value="{{ old('jumlah_terjual', $produk_pertahun->produk_terjual) }}">
            @error('jumlah_terjual')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('Admin.produk_pertahun.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Batal
            </a>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Update
            </button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Pilih Produk --",
            allowClear: true
        });
    });
</script>
@endsection