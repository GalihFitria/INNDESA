@extends('Admin.sidebar')

@section('title', 'INNDESA - Kelola Produk')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Produk::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <div class="flex items-center space-x-4">
            <a href="{{ route('Admin.produk.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-plus mr-2"></i>Tambah Produk
            </a>
            <div class="flex items-center">
                <label for="rowsPerPage" class="mr-2 text-sm text-gray-600">Tampilkan:</label>
                <select id="rowsPerPage"
                    class="border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
        </div>
        <input type="text" id="searchInput" placeholder="Cari..." value="{{ request('search') }}"
            class="w-1/3 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th data-column="0"
                        class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer">
                        <span class="flex items-center justify-center">
                            No <i class="fas fa-sort ml-1"></i>
                        </span>
                    </th>
                    <th data-column="1"
                        class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer">
                        <span class="flex items-center justify-center">
                            Id Produk <i class="fas fa-sort ml-1"></i>
                        </span>
                    </th>
                    <th data-column="2"
                        class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer">
                        <span class="flex items-center justify-center">
                            Nama Kelompok <i class="fas fa-sort ml-1"></i>
                        </span>
                    </th>
                    <th data-column="3"
                        class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer">
                        <span class="flex items-center justify-center">
                            Nama Produk <i class="fas fa-sort ml-1"></i>
                        </span>
                    </th>
                    <th data-column="4"
                        class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer">
                        <span class="flex items-center justify-center">
                            Harga <i class="fas fa-sort ml-1"></i>
                        </span>
                    </th>
                    <th data-column="5"
                        class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer">
                        <span class="flex items-center justify-center">
                            Stok <i class="fas fa-sort ml-1"></i>
                        </span>
                    </th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">
                        Foto Produk
                    </th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">
                        Deskripsi
                    </th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">
                        Sertifikat
                    </th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">
                        Produk Terjual
                    </th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($produk as $index => $p)
                <tr class="data-row">
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $p->kode_produk }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $p->kelompok->nama ?? '-' }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $p->nama }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $p->stok }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if ($p->foto)
                        <a href="{{ asset('storage/' . $p->foto) }}" class="text-blue-600 hover:underline">
                            {{ basename($p->foto) }}
                        </a>
                        @else
                        <span class="text-gray-400">Tidak ada foto produk</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 break-words max-w-xs">{{ $p->deskripsi }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900 text-center">
                        @if ($p->sertifikat)
                        @php
                        $sertifikatPaths = json_decode($p->sertifikat, true) ?? [];
                        @endphp
                        @foreach ($sertifikatPaths as $path)
                        <a href="{{ Storage::url($path) }}" class="text-blue-600 hover:underline">Lihat Sertifikat</a><br>
                        @endforeach
                        @else
                        <p class="text-gray-400">Tidak ada sertifikat.</p>
                        @endif
                    </td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $p->produk_terjual }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm">
                        <a href="{{ route('Admin.produk.edit', $p->id_produk) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.produk.destroy', $p->id_produk) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="11" class="border border-gray-300 p-3 text-center text-sm text-gray-900">Tidak ada data ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noSearchResults" class="text-center text-sm text-gray-900 mt-4 hidden">Data tidak ditemukan</div>
    </div>

    <div class="flex justify-between mt-4">
        <button id="prevPage"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg disabled:opacity-50" disabled>
            Previous
        </button>
        <span id="pageInfo" class="text-sm text-gray-900 self-center"></span>
        <button id="nextPage"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 disabled:opacity-50" disabled>
            Next
        </button>
    </div>
</div>

<input type="hidden" id="success-message" value="{{ session('success') ?? '' }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // === SWEETALERT SUCCESS MESSAGE ===
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

    // === DELETE CONFIRMATION ===
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

    // === SORTING TABLE ===
    document.querySelectorAll("thead th[data-column]").forEach(header => {
        header.addEventListener("click", function() {
            const columnIndex = parseInt(this.getAttribute("data-column"));
            const rows = Array.from(document.querySelectorAll("#tableBody .data-row"));
            const icon = this.querySelector("i");

            // Reset ikon di semua kolom
            document.querySelectorAll("thead th[data-column] i").forEach(i => {
                i.classList.remove("fa-sort-up", "fa-sort-down");
                i.classList.add("fa-sort");
            });

            // Toggle asc / desc
            const isAsc = !this.classList.contains("asc");
            document.querySelectorAll("thead th").forEach(th => th.classList.remove("asc", "desc"));
            this.classList.add(isAsc ? "asc" : "desc");

            rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim();
                const bText = b.cells[columnIndex].textContent.trim();

                const aNum = parseFloat(aText.replace(/\./g, '').replace(',', '.'));
                const bNum = parseFloat(bText.replace(/\./g, '').replace(',', '.'));

                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return isAsc ? aNum - bNum : bNum - aNum;
                }
                return isAsc ? aText.localeCompare(bText) : bText.localeCompare(aText);
            });

            // Ganti ikon
            icon.classList.remove("fa-sort");
            icon.classList.add(isAsc ? "fa-sort-up" : "fa-sort-down");

            // Render ulang tbody
            const tbody = document.getElementById("tableBody");
            tbody.innerHTML = "";
            rows.forEach(row => tbody.appendChild(row));

            updateTable();
        });
    });

    // === PAGINATION + SEARCH ===
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
            const kodeProduk = row.cells[1].textContent.toLowerCase();
            const namaKelompok = row.cells[2].textContent.toLowerCase();
            const namaProduk = row.cells[3].textContent.toLowerCase();
            return kodeProduk.includes(searchTerm) || namaKelompok.includes(searchTerm) || namaProduk.includes(searchTerm);
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

    updateTable();
</script>
@endsection