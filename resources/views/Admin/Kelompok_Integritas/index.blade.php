@extends('Admin.sidebar')

@section('title', 'Kelola Kelompok Integrasi - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Kelompok Integritas::.</h2>

<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <a href="{{ route('Admin.kelompok_integritas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah
        </a>
        <input type="text" placeholder="Cari..." class="w-1/3 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Id Kategori</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $index => $item)
                <tr>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $item->id_kategori }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $item->nama }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm">
                        <a href="{{ route('Admin.kelompok_integritas.edit', $item->id_kategori) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.kelompok_integritas.destroy', $item->id_kategori) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data?');">
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
@endsection