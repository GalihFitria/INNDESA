@extends('Admin.sidebar')

@section('title', 'Kelola Kegiatan - INNDESA')

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Kegiatan::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <div class="flex items-center space-x-4">
            <a href="{{ route('Admin.kegiatan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-plus mr-2"></i>Tambah
            </a>
            <div class="flex items-center">
                <label for="rowsPerPage" class="mr-2 text-sm text-gray-600">Tampilkan:</label>
                <select id="rowsPerPage" class="border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
        </div>
        <input type="text" id="searchInput" placeholder="Cari ..." value="{{ request('search') }}" class="w-1/3 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Kode Kegiatan</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Nama Kelompok</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase w-2/5">Deskripsi</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Foto Kegiatan</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase w-1/5">Sumber Berita</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($kegiatan as $index => $kg)
                <tr class="data-row">
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->kode_kegiatan }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->kelompok->nama ?? '-' }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->judul }}</td>

                    {{-- Deskripsi lebih lebar --}}
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 break-words w-2/5">
                        {{ $kg->deskripsi }}
                    </td>

                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if ($kg->foto)
                        <a href="{{ asset('storage/' . $kg->foto) }}" class="text-blue-600 hover:underline">
                            {{ basename($kg->foto) }}
                        </a>
                        @else
                        <span class="text-gray-400">Tidak ada foto kegiatan</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->tanggal }}</td>

                    {{-- Sumber berita lebih lebar --}}
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 w-1/5">
                        @php
                        $sources = [];
                        if (!empty($kg->sumber_berita)) {
                        $decoded = json_decode($kg->sumber_berita, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $sources = $decoded;
                        } else {
                        $sources = explode(',', $kg->sumber_berita);
                        }
                        }

                        $groupedLinks = [];
                        foreach ($sources as $source) {
                        $source = trim($source);
                        if (filter_var($source, FILTER_VALIDATE_URL)) {
                        $parsedUrl = parse_url($source);
                        $domain = $parsedUrl['host'] ?? 'unknown';
                        $groupedLinks[$domain][] = $source;
                        }
                        }
                        @endphp

                        @if(!empty($groupedLinks))
                        @foreach($groupedLinks as $domain => $links)
                        <p>
                            <strong>{{ $domain }}:</strong>
                            @foreach($links as $link)
                            <a href="{{ $link }}" target="_blank" class="text-blue-500 underline">
                                {{ $link }}
                            </a>
                            @if(!$loop->last) | @endif
                            @endforeach
                        </p>
                        @endforeach
                        @else
                        <span class="text-gray-400 text-center">Tidak ada sumber berita</span>
                        @endif
                    </td>

                    <td class="border border-gray-300 p-3 text-center text-sm">
                        <a href="{{ route('Admin.kegiatan.edit', $kg->id_kegiatan) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.kegiatan.destroy', $kg->id_kegiatan) }}" method="POST" class="inline-block delete-form">
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

    let rowsPerPage = parseInt(document.getElementById('rowsPerPage').value);
    let currentPage = 1;
    let filteredRows = [];

    function updateTable() {
        const rows = document.querySelectorAll('#tableBody .data-row');
        const noDataRow = document.getElementById('noDataRow');
        const noSearchResults = document.getElementById('noSearchResults');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const pageInfo = document.getElementById('pageInfo');
        const searchInput = document.getElementById('searchInput');

        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

        filteredRows = Array.from(rows).filter(row => {
            const kodeKegiatan = row.cells[1].textContent.toLowerCase(); // Kolom Kode Kegiatan
            const namaKelompok = row.cells[2].textContent.toLowerCase(); // Kolom Nama Kelompok
            const judul = row.cells[3].textContent.toLowerCase(); // Kolom Judul
            return kodeKegiatan.includes(searchTerm) || namaKelompok.includes(searchTerm) || judul.includes(searchTerm);
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
            noDataRow.style.display = rows.length === 0 ? '' : 'none';
        }
        noSearchResults.classList.toggle('hidden', totalRows > 0 || rows.length === 0);
    }

    document.getElementById('searchInput').addEventListener('input', function() {
        currentPage = 1;
        updateTable();
    });

    document.getElementById('rowsPerPage').addEventListener('change', function() {
        rowsPerPage = parseInt(this.value);
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

    // Inisialisasi tabel saat halaman dimuat
    updateTable();
</script>
@endsection