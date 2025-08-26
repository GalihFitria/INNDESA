@extends('Admin.sidebar')

@section('title', 'Kelola Kelompok - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Kelompok::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <a href="{{ route('Admin.kelompok.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah
        </a>
        <input type="text" placeholder="Cari..." class="w-1/3 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Id Kelompok</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kategori Kelompok</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelompok</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Sejarah</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Sk Desa</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Background</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>


                </tr>
            </thead>
            <tbody>
                @foreach($kelompok as $index => $k)
                <tr>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->kode_kelompok }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->kategori->nama ?? '-' }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->nama}}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->sejarah}}</td>
                   
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if($k->sk_desa)
                        <a href="{{ asset('uploads/skdesa/' . $k->sk_desa) }}"
                            target="_blank"
                            class="text-blue-600 hover:underline">
                            Lihat File
                        </a>
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if($k->background)
                        <img src="{{ asset('uploads/background/' . $k->background) }}"
                            alt="Background"
                            class="w-16 h-16 object-cover mx-auto rounded">
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if($k->logo)
                        <img src="{{ asset('uploads/logo/' . $k->logo) }}"
                            alt="Logo"
                            class="w-16 h-16 object-cover mx-auto rounded-full">
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="border border-gray-300 p-3 text-center text-sm">
                        <a href="{{ route('Admin.kelompok.edit', $k->id_kategori) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.kelompok.destroy', $k->id_kategori) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    const message = @json(session('success'));
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: message,
        timer: 2000,
        showConfirmButton: false
    });
    @endif

    document.querySelectorAll('.delete-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection