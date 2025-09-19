@extends('Admin.sidebar')

@section('content')
<h2 class="text-center text-3xl font-bold text-gray-800 mb-6">.::Tambah Produk Terjual/Tahun::.</h2>

<div class="bg-white shadow-md p-6 rounded-lg max-w-3xl mx-auto">
    <form action="{{ route('Admin.produk_pertahun.store') }}" method="POST">
        @csrf
        {{-- Tahun --}}
        <div class="mb-4">
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
            <select id="tahun" name="tahun"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('tahun') border-red-500 @enderror">
                <option value="">-- Pilih Tahun --</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
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
                <option value="{{ $produk->id_produk }}">{{ $produk->nama }} ({{ $produk->kelompok->nama ?? 'Tidak Diketahui' }})</option>
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
                value="{{ old('harga') }}">
            @error('harga')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Produk Terjual --}}
        <div class="mb-4">
            <label for="jumlah_terjual" class="block text-sm font-medium text-gray-700">Jumlah Produk Terjual</label>
            <input type="number" id="jumlah_terjual" name="jumlah_terjual" placeholder="Masukkan jumlah produk terjual"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('jumlah_terjual') border-red-500 @enderror"
                value="{{ old('jumlah_terjual') }}">
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
                Simpan
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