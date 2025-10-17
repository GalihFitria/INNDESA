@extends('Admin.sidebar')

@section('content')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

<h2 class="text-center text-3xl font-bold text-gray-800 mb-6">.::Tambah Produk Terjual/Tahun::.</h2>

<div class="bg-white shadow-md p-6 rounded-lg max-w-3xl mx-auto">
    <form action="{{ route('Admin.produk_pertahun.store') }}" method="POST">
        @csrf

        {{-- Produk --}}
        <div class="mb-4">
            <label for="id_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <select id="id_produk" name="id_produk"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 select2"
                style="width: 100%;">
                <option value="">-- Pilih Produk --</option>
                @foreach ($produks as $produk)
                <option value="{{ $produk->id_produk }}">{{ $produk->nama }} ({{ $produk->kelompok->nama ?? 'Tidak Diketahui' }})</option>
                @endforeach
            </select>
        </div>

        {{-- Tahun --}}
        <div class="mb-4">
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
            <select id="tahun" name="tahun"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 select2"
                style="width: 100%;">
                <option value="">-- Pilih Tahun --</option>
                @for ($y = 2016; $y <= 2030; $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
            </select>
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
    $(function() {
        // Ambil data tahun yang sudah dipakai per produk dari DB (tanpa controller)
        const usedYearsRaw = @json(\App\Models\ProdukPertahun::all()->groupBy('id_produk')->map(function($items) {
            return $items->pluck('tahun')->map(fn($t) => (int) $t)->toArray();
        })->toArray());

        // Normalisasi keys jadi string & values jadi angka
        const usedYears = {};
        Object.keys(usedYearsRaw).forEach(k => {
            usedYears[String(k)] = usedYearsRaw[k].map(y => parseInt(y, 10));
        });

        const $selectProduk = $('#id_produk');
        const $selectTahun = $('#tahun');

        // Simpan semua option tahun awal (urutan & teks)
        const allYears = [];
        $selectTahun.find('option').each(function() {
            allYears.push({
                value: $(this).attr('value'),
                text: $(this).text()
            });
        });

        // Inisialisasi select2 untuk produk (sekali)
        $selectProduk.select2({
            placeholder: $selectProduk.data('placeholder') || '-- Pilih Produk --',
            allowClear: true,
            width: '100%'
        });

        // Fungsi untuk rebuild option tahun berdasarkan produk yg dipilih
        function renderTahunOptions(idProduk, currentYear = null) {
            // Jika select2 sudah aktif pada select tahun → destroy dulu
            if ($selectTahun.hasClass('select2-hidden-accessible')) {
                $selectTahun.select2('destroy');
            }

            // Bersihkan options dan tambahkan placeholder empty option (untuk select2 placeholder)
            $selectTahun.empty();
            $selectTahun.append($('<option>')); // <option value=""></option>

            const blocked = idProduk && usedYears[String(idProduk)] ? usedYears[String(idProduk)] : [];

            allYears.forEach(function(y) {
                // skip placeholder entry
                if (!y.value) return;
                const val = parseInt(y.value, 10);

                // Kalau sedang edit dan ini tahun yang sama → tetap tampil dan selected
                if (currentYear && parseInt(currentYear, 10) === val) {
                    $selectTahun.append($('<option>', {
                        value: y.value,
                        text: y.text,
                        selected: true
                    }));
                } else if (blocked.indexOf(val) === -1) {
                    // hanya append tahun yang belum dipakai
                    $selectTahun.append($('<option>', {
                        value: y.value,
                        text: y.text
                    }));
                }
            });

            // Re-inisialisasi select2 untuk tahun (supaya fitur search muncul dan options baru terbaca)
            $selectTahun.select2({
                placeholder: $selectTahun.data('placeholder') || '-- Pilih Tahun --',
                allowClear: true,
                width: '100%'
            });
        }

        // Render awal (mis. saat load page)
        renderTahunOptions($selectProduk.val(), null);

        // Event: kalau produk berubah → filter tahun
        $selectProduk.on('change', function() {
            renderTahunOptions($(this).val(), null);
        });
    });
</script>



@endsection