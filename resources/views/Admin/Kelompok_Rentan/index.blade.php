@extends('Admin.sidebar')

@section('title', 'INNDESA - Kelola Kelompok Rentan')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Kelompok Rentan::.</h2>

<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <div class="flex items-center space-x-4">
            <a href="{{ route('Admin.kelompok_rentan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-plus mr-2"></i>Tambah
            </a>
            <!-- Export Excel -->
            <button id="exportExcelBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </button>
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
        <form action="{{ route('Admin.kelompok_rentan.index') }}" method="GET" class="w-1/3">
            <input type="text" name="search" id="searchInput" placeholder="Cari ..." value="{{ request('search') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300" id="dataTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Id Kelompok Rentan</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Nama Kelompok Rentan</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($rentan as $index => $r)
                <tr class="data-row">
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $r->kode_rentan }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900">{{ $r->nama_rentan }}</td>
                    <td class="border border-gray-300 p-3 text-sm text-gray-900" data-value="{{ $r->total }}">{{ $r->total }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm">
                        <a href="{{ route('Admin.kelompok_rentan.edit', $r->id_rentan) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.kelompok_rentan.destroy', $r->id_rentan) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="5" class="border border-gray-300 p-3 text-center text-sm text-gray-900">Tidak ada data ditemukan</td>
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

<!-- Tambahkan library SheetJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Success message handling
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

        // Pagination + Search
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
                const nama = row.cells[2].textContent.toLowerCase();
                const kodeRentan = row.cells[1].textContent.toLowerCase();
                return nama.includes(searchTerm) || kodeRentan.includes(searchTerm);
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
            pageInfo.textContent = totalRows > 0 ? `Halaman ${currentPage} dari ${totalPages} (Total: ${totalRows} data)` : '';

            if (noDataRow) {
                noDataRow.parentElement.style.display = rows.length === 0 ? '' : 'none';
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

        // Export Excel
        document.getElementById('exportExcelBtn').addEventListener('click', function() {
            // Tampilkan notifikasi loading
            Swal.fire({
                title: 'Mempersiapkan Excel...',
                text: 'Mohon tunggu sebentar',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Ambil semua data (tidak terpengaruh filter/pagination)
            const allRows = document.querySelectorAll('#tableBody .data-row');

            // Siapkan header untuk Excel (tanpa Id Kelompok Rentan)
            const headers = [
                'No',
                'Nama Kelompok Rentan',
                'Total'
            ];

            // Siapkan data untuk Excel
            const excelData = [];
            allRows.forEach((row, index) => {
                const rowData = [];
                const cells = row.querySelectorAll('td');

                // Ambil kolom yang diperlukan saja (skip Id Kelompok Rentan dan Aksi)
                rowData.push(index + 1); // Nomor urut
                rowData.push(cells[2].textContent.trim()); // Nama Kelompok Rentan

                // Ambil nilai asli untuk kolom Total
                const totalValue = cells[3].getAttribute('data-value');
                rowData.push(parseInt(totalValue) || 0); // Total

                excelData.push(rowData);
            });

            // Buat workbook Excel
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet([headers, ...excelData]);

            // Atur lebar kolom
            const colWidths = [{
                    wch: 5
                }, // No
                {
                    wch: 30
                }, // Nama Kelompok Rentan
                {
                    wch: 10
                } // Total
            ];
            ws['!cols'] = colWidths;

            // Format angka untuk kolom Total
            const range = XLSX.utils.decode_range(ws['!ref']);
            for (let R = range.s.r + 1; R <= range.e.r; ++R) {
                // Format Total (kolom C)
                const totalCell = XLSX.utils.encode_cell({
                    r: R,
                    c: 2
                });
                if (!ws[totalCell]) continue;
                ws[totalCell].z = '0';
            }

            XLSX.utils.book_append_sheet(wb, ws, "Data Kelompok Rentan");

            // Generate filename dengan tanggal
            const today = new Date();
            const dateStr = today.getFullYear() + '-' +
                String(today.getMonth() + 1).padStart(2, '0') + '-' +
                String(today.getDate()).padStart(2, '0');
            const fileName = `Data_Kelompok_Rentan_${dateStr}.xlsx`;

            // Download file
            XLSX.writeFile(wb, fileName);

            // Tampilkan notifikasi sukses
            Swal.fire({
                icon: 'success',
                title: 'Export Berhasil!',
                text: 'Data berhasil diekspor ke Excel',
                timer: 2000,
                showConfirmButton: false
            });
        });

        // Inisialisasi tabel saat halaman dimuat
        updateTable();
    });
</script>
@endsection