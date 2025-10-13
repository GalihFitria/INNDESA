@extends('Admin.sidebar')

@section('title', 'Edit Struktur Organisasi - INNDESA')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Struktur Organisasi::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.struktur.update', $struktur->id_struktur) }}" method="POST" class="space-y-6" id="form-struktur">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('id_kelompok') border-red-500 @enderror select2"
                style="width: 100%;" required>
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}"
                    {{ old('id_kelompok', $struktur->id_kelompok ?? '') == $k->id_kelompok ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
            @error('id_kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ $struktur->nama }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama" required>
        </div>

        <div class="mb-4">
            <label for="jabatan" class="block text-sm font-medium text-gray-700">Posisi</label>
            <select id="jabatan" name="jabatan"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('jabatan') border-red-500 @enderror">
                <option value="">-- Pilih Posisi --</option>
                <option value="Ketua" {{ old('jabatan', $struktur->jabatan) == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                <option value="Wakil Ketua" {{ old('jabatan', $struktur->jabatan) == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                <option value="Sekretaris" {{ old('jabatan', $struktur->jabatan) == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="Bendahara" {{ old('jabatan', $struktur->jabatan) == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                <option value="Anggota" {{ old('jabatan', $struktur->jabatan) == 'Anggota' ? 'selected' : '' }}>Anggota</option>
            </select>
            @error('jabatan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p id="jabatan-warning" class="text-yellow-600 text-sm mt-1 {{ !in_array($struktur->jabatan, ['Ketua', 'Wakil Ketua']) ? 'hidden' : '' }}">Peringatan: Jabatan ini hanya bisa diisi oleh satu orang per kelompok</p>
        </div>

        <div class="mb-4">
            <label for="id_rentan" class="block text-sm font-medium text-gray-700">Kelompok Rentan</label>
            <select name="id_rentan" id="id_rentan" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">-- Pilih Kelompok Rentan --</option>
                @foreach ($rentan as $r)
                <option value="{{ $r->id_rentan }}" {{ $struktur->id_rentan == $r->id_rentan ? 'selected' : '' }}>
                    {{ $r->nama_rentan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.struktur.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Data struktur untuk validasi -->
<input type="hidden" id="current-struktur-id" value="{{ $struktur->id_struktur }}">
<input type="hidden" id="current-jabatan" value="{{ $struktur->jabatan }}">
<input type="hidden" id="current-kelompok" value="{{ $struktur->id_kelompok }}">

<!-- Data struktur organisasi untuk validasi jabatan -->
<input type="hidden" id="struktur-data" value='@json($strukturList)'>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#id_kelompok').select2({
            placeholder: "-- Pilih Kelompok --",
            allowClear: true
        });

        // Tampilkan peringatan jika jabatan Ketua atau Wakil Ketua dipilih
        $('#jabatan').change(function() {
            const jabatan = $(this).val();
            const warning = $('#jabatan-warning');

            if (jabatan === 'Ketua' || jabatan === 'Wakil Ketua') {
                warning.removeClass('hidden');
            } else {
                warning.addClass('hidden');
            }
        });

        // Validasi form sebelum submit
        $('#form-struktur').submit(function(e) {
            const jabatan = $('#jabatan').val();
            const idKelompok = $('#id_kelompok').val();
            const currentId = $('#current-struktur-id').val();
            const currentJabatan = $('#current-jabatan').val();
            const currentKelompok = $('#current-kelompok').val();
            const strukturData = JSON.parse($('#struktur-data').val());

            // Jika jabatan Ketua atau Wakil Ketua dipilih tapi kelompok belum dipilih
            if ((jabatan === 'Ketua' || jabatan === 'Wakil Ketua') && !idKelompok) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Validasi Gagal',
                    text: 'Silakan pilih kelompok terlebih dahulu sebelum memilih jabatan ' + jabatan,
                    confirmButtonText: 'OK'
                }).then(() => {
                    $('#id_kelompok').focus();
                });
                return;
            }

            // Validasi untuk jabatan Ketua atau Wakil Ketua
            if (jabatan === 'Ketua' || jabatan === 'Wakil Ketua') {
                // Jika jabatan sama dengan jabatan saat ini dan kelompok sama dengan kelompok saat ini, izinkan
                if (jabatan === currentJabatan && idKelompok === currentKelompok) {
                    return true;
                }

                // Cek apakah jabatan sudah ada di kelompok yang sama
                let jabatanExists = false;
                for (let i = 0; i < strukturData.length; i++) {
                    const struktur = strukturData[i];
                    if (struktur.id_kelompok == idKelompok &&
                        struktur.jabatan === jabatan &&
                        struktur.id_struktur != currentId) {
                        jabatanExists = true;
                        break;
                    }
                }

                if (jabatanExists) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        text: 'Jabatan ' + jabatan + ' sudah ada di kelompok ini!',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Tampilkan konfirmasi dengan SweetAlert2
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: `Apakah Anda yakin ingin mengubah jabatan menjadi ${jabatan}? Jabatan ini hanya boleh diisi oleh satu orang per kelompok.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengkonfirmasi, submit form
                        $('#form-struktur').unbind('submit').submit();
                    }
                });
            }
        });

        // Tampilkan error dari backend jika ada
        @if($errors - > any())
        @foreach($errors - > all() as $error)
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            text: '{{ $error }}',
            confirmButtonText: 'OK'
        });
        @endforeach
        @endif

        // Tampilkan pesan sukses jika ada
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('
            success ') }}',
            confirmButtonText: 'OK'
        });
        @endif
    });
</script>
@endsection