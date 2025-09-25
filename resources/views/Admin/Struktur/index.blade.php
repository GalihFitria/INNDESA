@extends('Admin.sidebar')

@section('title', 'INNDESA - Kelola Struktur Organisasi')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Struktur Organisasi::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <div class="flex items-center space-x-4">
            <a href="{{ route('Admin.struktur.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
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
        <input type="text" id="searchInput" placeholder="Cari..." class="w-1/3 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="0">No <i class="fas fa-sort ml-1"></i></th>
                    <th class="border p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="1">Id Struktur <i class="fas fa-sort ml-1"></i></th>
                    <th class="border p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="2">Nama Kelompok <i class="fas fa-sort ml-1"></i></th>
                    <th class="border p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="3">Nama <i class="fas fa-sort ml-1"></i></th>
                    <th class="border p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="4">Posisi <i class="fas fa-sort ml-1"></i></th>
                    <th class="border p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="5">Kelompok Rentan <i class="fas fa-sort ml-1"></i></th>
                    <th class="border p-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($struktur as $index => $s)
                <tr class="data-row">
                    <td class="border p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border p-3 text-sm text-gray-900">{{ $s->kode_struktur }}</td>
                    <td class="border p-3 text-sm text-gray-900">{{ $s->kelompok->nama ?? '-' }}</td>
                    <td class="border p-3 text-sm text-gray-900">{{ $s->nama }}</td>
                    <td class="border p-3 text-sm text-gray-900">{{ $s->jabatan }}</td>
                    <td class="border p-3 text-sm text-gray-900">{{ $s->rentan->nama_rentan ?? '-' }}</td>
                    <td class="border p-3 text-center text-sm">
                        <a href="{{ route('Admin.struktur.edit', $s->id_struktur) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.struktur.destroy', $s->id_struktur) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="7" class="border p-3 text-center text-sm text-gray-900">Tidak ada data ditemukan</td>
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
<!-- Gunakan CDN yang lebih stabil untuk SheetJS -->
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

        // Sorting dengan ikon panah
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
                rows.forEach(row => tbody.appendChild(row));

                updateTable();
            });
        });

        // Paginasi + Pencarian
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
                const nama = row.cells[3].textContent.toLowerCase();
                const kodeStruktur = row.cells[1].textContent.toLowerCase();
                const namaKelompok = row.cells[2].textContent.toLowerCase();
                return nama.includes(searchTerm) || kodeStruktur.includes(searchTerm) || namaKelompok.includes(searchTerm);
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

        // Fungsi export Excel - PERBAIKAN NOTIFIKASI
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

            // Siapkan header untuk Excel
            const headers = [
                'No',
                'Nama Kelompok',
                'Nama',
                'Posisi',
                'Kelompok Rentan'
            ];

            // Siapkan data untuk Excel
            const excelData = [];
            allRows.forEach((row, index) => {
                const rowData = [];
                const cells = row.querySelectorAll('td');

                // Skip kolom ID Struktur (index 1) dan kolom Aksi (terakhir)
                rowData.push(index + 1); // Nomor urut
                rowData.push(cells[2].textContent.trim()); // Nama Kelompok
                rowData.push(cells[3].textContent.trim()); // Nama
                rowData.push(cells[4].textContent.trim()); // Posisi
                rowData.push(cells[5].textContent.trim()); // Kelompok Rentan

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
                    wch: 20
                }, // Nama Kelompok
                {
                    wch: 30
                }, // Nama
                {
                    wch: 20
                }, // Posisi
                {
                    wch: 15
                } // Kelompok Rentan
            ];
            ws['!cols'] = colWidths;

            XLSX.utils.book_append_sheet(wb, ws, "Data Struktur Organisasi");

            // Generate filename dengan tanggal
            const today = new Date();
            const dateStr = today.getFullYear() + '-' +
                String(today.getMonth() + 1).padStart(2, '0') + '-' +
                String(today.getDate()).padStart(2, '0');
            const fileName = `Data_Struktur_Organisasi_${dateStr}.xlsx`;

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