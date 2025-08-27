
@extends('Admin.sidebar')

@section('title', 'Kelola Kelompok - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Kelompok::.</h2>

<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <a href="{{ route('Admin.kelompok.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah
        </a>
        <form action="{{ route('Admin.kelompok.index') }}" method="GET" class="w-1/3">
            <input type="text" name="search" id="searchInput" placeholder="Cari ..." value="{{ request('search') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300" id="dataTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Id Kelompok</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelompok Integrasi</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelompok</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Sejarah</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">SK Desa</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Background</th>
                    <th class="border border-gray-300 p-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($kelompok as $index => $k)
                <tr class="data-row">
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->kode_kelompok }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->kategori->nama ?? '-' }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->nama }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $k->sejarah }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if($k->sk_desa)
                        <a href="{{ asset('Uploads/skdesa/' . $k->sk_desa) }}"
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
                        <img src="{{ asset('Uploads/background/' . $k->background) }}"
                            alt="Background"
                            class="w-16 h-16 object-cover mx-auto rounded">
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if($k->logo)
                        <img src="{{ asset('Uploads/logo/' . $k->logo) }}"
                            alt="Logo"
                            class="w-16 h-16 object-cover mx-auto rounded-full">
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-3 text-center text-sm">
                        <a href="{{ route('Admin.kelompok.edit', $k->id_kelompok) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.kelompok.destroy', $k->id_kelompok) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="9" class="border border-gray-300 p-3 text-center text-sm text-gray-900">Tidak ada data ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noSearchResults" class="text-center text-sm text-gray-900 mt-4 hidden">Data tidak ditemukan</div>
    </div>

    <div class="flex justify-between mt-4">
        <button id="prevPage" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg disabled:opacity-50" disabled>Previous</button>
        <span id="pageInfo" class="text-sm text-gray-900 self-center"></span>
        <button id="nextPage" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 disabled:opacity-50" disabled>Next</button>
    </div>
</div>

<input type="hidden" id="success-message" value="{{ session('success') ?? '' }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const successMessage = document.getElementById('success-message').value;
    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: successMessage,
            timer: 2000,
            showConfirmButton: true,
            confirmButtonText: 'OK'
        });
    }

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

    const rowsPerPage = 10;
    let currentPage = 1;
    let filteredRows = [];

    function updateTable() {
        const rows = document.querySelectorAll('#tableBody .data-row');
        const noDataRow = document.getElementById('noDataRow');
        const noSearchResults = document.getElementById('noSearchResults');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const pageInfo = document.getElementById('pageInfo');

        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        filteredRows = Array.from(rows).filter(row => {
            const kodeKelompok = row.cells[1].textContent.toLowerCase();
            const namaKelompokIntegrasi = row.cells[2].textContent.toLowerCase();
            const namaKelompok = row.cells[3].textContent.toLowerCase();
            return kodeKelompok.includes(searchTerm) ||
                namaKelompokIntegrasi.includes(searchTerm) ||
                namaKelompok.includes(searchTerm);
        });

        rows.forEach(row => row.style.display = 'none');

        const totalRows = filteredRows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        currentPage = Math.min(currentPage, Math.max(1, totalPages));

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        filteredRows.slice(start, end).forEach(row => row.style.display = '');

        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalRows === 0;
        pageInfo.textContent = totalRows > 0 ? `Page ${currentPage} of ${totalPages}` : '';

        if (noDataRow) {
            noDataRow.parentElement.style.display = rows.length === 0 ? '' : 'none';
        }
        noSearchResults.classList.toggle('hidden', totalRows > 0 || rows.length === 0);
    }

    document.getElementById('searchInput').addEventListener('input', function() {
        currentPage = 1;
        updateTable();
    });

    document.getElementById('prevPage').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    });

    document.getElementById('nextPage').addEventListener('click', function() {
        const totalRows = filteredRows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            updateTable();
        }
    });
    updateTable();
</script>
@endsection