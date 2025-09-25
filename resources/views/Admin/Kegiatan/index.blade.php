@extends('Admin.sidebar')

@section('title', 'INNDESA - Kelola Kegiatan')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

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
                    @php
                    $columns = [
                    ['label'=>'No','sortable'=>true],
                    ['label'=>'Kode Kegiatan','sortable'=>true],
                    ['label'=>'Nama Kelompok','sortable'=>true],
                    ['label'=>'Judul','sortable'=>false],
                    ['label'=>'Deskripsi','sortable'=>false],
                    ['label'=>'Foto Kegiatan','sortable'=>false],
                    ['label'=>'Tanggal','sortable'=>true],
                    ['label'=>'Sumber Berita','sortable'=>false],
                    ['label'=>'Aksi','sortable'=>false],
                    ];
                    @endphp
                    @foreach($columns as $i => $col)
                    <th data-column="{{ $i }}" class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase 
                        {{ $col['sortable'] ? 'cursor-pointer sortable' : '' }}">
                        <span class="flex items-center justify-center">
                            {{ $col['label'] }}
                            @if($col['sortable'])
                            <i class="fas fa-sort ml-1"></i>
                            @endif
                        </span>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($kegiatan as $index => $kg)
                <tr class="data-row">
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->kode_kegiatan }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->kelompok->nama ?? '-' }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->judul }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 break-words w-2/5">{{ $kg->deskripsi }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if ($kg->foto)
                        <a href="{{ asset('storage/' . $kg->foto) }}" class="text-blue-600 hover:underline">{{ basename($kg->foto) }}</a>
                        @else
                        <span class="text-gray-400">Tidak ada foto kegiatan</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $kg->tanggal }}</td>
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
                        <p><strong>{{ $domain }}:</strong>
                            @foreach($links as $link)
                            <a href="{{ $link }}" target="_blank" class="text-blue-500 underline">{{ $link }}</a>
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
    // SweetAlert success
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

    // Delete confirmation
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // SORTABLE COLUMNS
    document.querySelectorAll("thead th.sortable").forEach(header => {
        header.addEventListener("click", function() {
            const columnIndex = parseInt(this.getAttribute("data-column"));
            const rows = Array.from(document.querySelectorAll("#tableBody .data-row"));
            const icon = this.querySelector("i");

            document.querySelectorAll("thead th.sortable i").forEach(i => {
                i.classList.remove("fa-sort-up", "fa-sort-down");
                i.classList.add("fa-sort");
            });

            const isAsc = !this.classList.contains("asc");
            document.querySelectorAll("thead th.sortable").forEach(th => th.classList.remove("asc", "desc"));
            this.classList.add(isAsc ? "asc" : "desc");

            rows.sort((a, b) => {
                let aText = a.cells[columnIndex].textContent.trim();
                let bText = b.cells[columnIndex].textContent.trim();
                const aNum = Date.parse(aText) || parseFloat(aText.replace(/\./g, '').replace(',', '.'));
                const bNum = Date.parse(bText) || parseFloat(bText.replace(/\./g, '').replace(',', '.'));
                if (!isNaN(aNum) && !isNaN(bNum)) return isAsc ? aNum - bNum : bNum - aNum;
                return isAsc ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });

            icon.classList.remove("fa-sort");
            icon.classList.add(isAsc ? "fa-sort-up" : "fa-sort-down");

            const tbody = document.getElementById("tableBody");
            tbody.innerHTML = "";
            rows.forEach(r => tbody.appendChild(r));

            rows.forEach((r, i) => r.cells[0].textContent = i + 1);
            updateTable();
        });
    });

    // PAGINATION + SEARCH
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
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();

        filteredRows = Array.from(rows).filter(row => {
            return Array.from(row.cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));
        });

        rows.forEach(r => r.style.display = '');
        const totalRows = filteredRows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        currentPage = Math.min(currentPage, Math.max(1, totalPages));

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach(r => r.style.display = 'none');
        filteredRows.slice(start, end).forEach(r => r.style.display = '');

        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalRows === 0;
        pageInfo.textContent = totalRows > 0 ? `Page ${currentPage} of ${totalPages}` : '';

        if (noDataRow) noDataRow.style.display = rows.length === 0 ? '' : 'none';
        noSearchResults.classList.toggle('hidden', totalRows > 0 || rows.length === 0);
    }

    document.getElementById('searchInput').addEventListener('input', () => {
        currentPage = 1;
        updateTable();
    });
    document.getElementById('rowsPerPage').addEventListener('change', function() {
        rowsPerPage = parseInt(this.value);
        currentPage = 1;
        updateTable();
    });
    document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    });
    document.getElementById('nextPage').addEventListener('click', () => {
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