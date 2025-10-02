@extends('Admin.sidebar')

@section('title', 'INNDESA - Kelola Rekap Penjualan Produk')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Kelola Penjualan Produk per-Tahun::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <div class="flex items-center space-x-4">
            <a href="{{ route('Admin.produk_pertahun.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-plus mr-2"></i>Tambah
            </a>
            <a href="{{ route('Admin.produk_pertahun.pdf') }}" id="exportPdfBtn"
                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center">
                <i class="fas fa-file-pdf mr-2"></i>Export PDF
            </a>
            <!-- Export Excel -->
            <button id="exportExcelBtn"
                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex items-center">
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
        <input type="text" id="searchInput" placeholder="Cari..." value="{{ request('search') }}" class="w-1/3 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="0">No <i class="fas fa-sort ml-1"></i></th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="1">Id Tahun <i class="fas fa-sort ml-1"></i></th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="2">Tahun <i class="fas fa-sort ml-1"></i></th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="3">Nama Kelompok <i class="fas fa-sort ml-1"></i></th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="4">Nama Produk <i class="fas fa-sort ml-1"></i></th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="5">Harga <i class="fas fa-sort ml-1"></i></th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase cursor-pointer" data-column="6">Produk Terjual <i class="fas fa-sort ml-1"></i></th>
                    <th class="border border-gray-300 p-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($produks_pertahun as $index => $p)
                <tr class="data-row">
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $p->kode_tahun }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $p->tahun }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $p->nama_kelompok }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $p->nama_produk }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900" data-value="{{ $p->harga }}">{{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900" data-value="{{ $p->produk_terjual }}">{{ $p->produk_terjual }}</td>
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">
                        <a href="{{ route('Admin.produk_pertahun.edit', $p->id_tahun) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.produk_pertahun.destroy', $p->id_tahun) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="8" class="border border-gray-300 p-3 text-center text-sm text-gray-900">Tidak ada data ditemukan</td>
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
        // Notifikasi sukses
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

        // Konfirmasi hapus
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

        // Variabel global
        let rowsPerPage = parseInt(document.getElementById('rowsPerPage').value);
        let currentPage = 1;
        let filteredRows = [];
        let allRows = Array.from(document.querySelectorAll('#tableBody .data-row'));
        let sortDirection = {};

        // Fungsi update tabel
        function updateTable() {
            const rows = document.querySelectorAll('#tableBody .data-row');
            const noDataRow = document.getElementById('noDataRow');
            const noSearchResults = document.getElementById('noSearchResults');
            const prevButton = document.getElementById('prevPage');
            const nextButton = document.getElementById('nextPage');
            const pageInfo = document.getElementById('pageInfo');
            const searchInput = document.getElementById('searchInput');

            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

            // Filter data
            filteredRows = Array.from(rows).filter(row => {
                const kodeTahun = row.cells[1].textContent.toLowerCase();
                const tahun = row.cells[2].textContent.toLowerCase();
                const namaKelompok = row.cells[3].textContent.toLowerCase();
                const namaProduk = row.cells[4].textContent.toLowerCase();
                return kodeTahun.includes(searchTerm) ||
                    tahun.includes(searchTerm) ||
                    namaKelompok.includes(searchTerm) ||
                    namaProduk.includes(searchTerm);
            });

            // Sembunyikan semua baris
            rows.forEach(row => row.style.display = 'none');

            // Pagination
            const totalRows = filteredRows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            currentPage = Math.min(currentPage, Math.max(1, totalPages || 1));

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            filteredRows.slice(start, end).forEach(row => row.style.display = '');

            // Update tombol pagination
            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages || totalRows === 0;
            pageInfo.textContent = totalRows > 0 ? `Halaman ${currentPage} dari ${totalPages} (Total: ${totalRows} data)` : '';

            // Tampilkan pesan jika tidak ada data
            if (noDataRow) {
                noDataRow.style.display = rows.length === 0 ? '' : 'none';
            }
            noSearchResults.classList.toggle('hidden', totalRows > 0 || rows.length === 0);
        }

        // Event listeners
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

        // Sorting
        document.querySelectorAll("thead th[data-column]").forEach(header => {
            header.addEventListener("click", function() {
                const columnIndex = parseInt(this.getAttribute("data-column"));
                const icon = this.querySelector("i");

                // Reset semua ikon sort
                document.querySelectorAll("thead th[data-column] i").forEach(i => {
                    i.classList.remove("fa-sort-up", "fa-sort-down");
                    i.classList.add("fa-sort");
                });

                // Tentukan arah sort
                const currentDirection = sortDirection[columnIndex] || 'asc';
                const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
                sortDirection[columnIndex] = newDirection;

                // Update ikon
                icon.classList.remove("fa-sort", "fa-sort-up", "fa-sort-down");
                icon.classList.add(newDirection === 'asc' ? "fa-sort-up" : "fa-sort-down");

                // Sort data
                const rows = Array.from(document.querySelectorAll("#tableBody .data-row"));
                rows.sort((a, b) => {
                    let aVal, bVal;

                    // Ambil nilai asli untuk kolom angka
                    if (columnIndex === 5 || columnIndex === 6) {
                        aVal = parseFloat(a.cells[columnIndex].getAttribute('data-value')) || 0;
                        bVal = parseFloat(b.cells[columnIndex].getAttribute('data-value')) || 0;
                    } else {
                        aVal = a.cells[columnIndex].textContent.trim().toLowerCase();
                        bVal = b.cells[columnIndex].textContent.trim().toLowerCase();
                    }

                    if (typeof aVal === 'number' && typeof bVal === 'number') {
                        return newDirection === 'asc' ? aVal - bVal : bVal - aVal;
                    } else {
                        return newDirection === 'asc' ?
                            aVal.localeCompare(bVal) :
                            bVal.localeCompare(aVal);
                    }
                });

                // Update DOM
                const tbody = document.getElementById("tableBody");
                tbody.innerHTML = "";
                rows.forEach(row => tbody.appendChild(row));

                // Reset ke halaman pertama dan update tampilan
                currentPage = 1;
                updateTable();
            });
        });

        // Export PDF dengan notifikasi
        document.getElementById('exportPdfBtn').addEventListener('click', function(e) {
            e.preventDefault();

            // Tampilkan notifikasi loading
            Swal.fire({
                title: 'Mempersiapkan PDF...',
                text: 'Mohon tunggu sebentar',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simpan URL asli
            const url = this.getAttribute('href');

            // Simulasi proses download (2 detik)
            setTimeout(() => {
                // Download file
                const a = document.createElement('a');
                a.href = url;
                a.download = `Data_Produk_Tahunan_${new Date().toISOString().slice(0, 10)}.pdf`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);

                // Tampilkan notifikasi sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Export Berhasil!',
                    text: 'Data berhasil diekspor ke PDF',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 2000);
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

            // Header untuk Excel (sesuai dengan tampilan web, kecuali kolom Id Tahun dan Aksi)
            const headers = [
                'No',
                'Tahun',
                'Nama Kelompok',
                'Nama Produk',
                'Harga',
                'Produk Terjual'
            ];

            // Ambil semua data yang sudah difilter
            const excelData = [];
            filteredRows.forEach((row, index) => {
                const rowData = [];
                const cells = row.querySelectorAll('td');

                // Kolom No (nomor urut)
                rowData.push(index + 1);

                // Kolom Tahun (index 2)
                rowData.push(cells[2].textContent.trim());

                // Kolom Nama Kelompok (index 3)
                rowData.push(cells[3].textContent.trim());

                // Kolom Nama Produk (index 4)
                rowData.push(cells[4].textContent.trim());

                // Kolom Harga (index 5) - konversi ke angka
                const hargaValue = parseFloat(cells[5].getAttribute('data-value')) || 0;
                // Format harga dengan titik sebagai pemisah ribuan
                const formattedHarga = new Intl.NumberFormat('en-US').format(hargaValue);
                rowData.push(formattedHarga);

                // Kolom Produk Terjual (index 6) - konversi ke angka
                const terjualValue = parseInt(cells[6].getAttribute('data-value')) || 0;
                // Format produk terjual dengan titik sebagai pemisah ribuan
                const formattedTerjual = new Intl.NumberFormat('en-US').format(terjualValue);
                rowData.push(formattedTerjual);

                excelData.push(rowData);
            });

            // Buat workbook dan worksheet
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet([headers, ...excelData]);

            // Atur lebar kolom untuk tampilan yang lebih baik
            const colWidths = [{
                    wch: 5
                }, // No
                {
                    wch: 10
                }, // Tahun
                {
                    wch: 20
                }, // Nama Kelompok
                {
                    wch: 30
                }, // Nama Produk
                {
                    wch: 15
                }, // Harga
                {
                    wch: 15
                } // Produk Terjual
            ];
            ws['!cols'] = colWidths;

            // Format angka untuk kolom Harga dan Produk Terjual dengan format US (menggunakan titik)
            const range = XLSX.utils.decode_range(ws['!ref']);
            for (let R = range.s.r + 1; R <= range.e.r; ++R) {
                // Format Harga (kolom E, index 4) - menggunakan format US dengan titik sebagai pemisah ribuan
                const hargaCell = XLSX.utils.encode_cell({
                    r: R,
                    c: 4
                });
                if (!ws[hargaCell]) continue;
                ws[hargaCell].z = '#,##0'; // Format ini akan menggunakan titik sebagai pemisah ribuan di Excel

                // Format Produk Terjual (kolom F, index 5) - menggunakan format US dengan titik sebagai pemisah ribuan
                const terjualCell = XLSX.utils.encode_cell({
                    r: R,
                    c: 5
                });
                if (!ws[terjualCell]) continue;
                ws[terjualCell].z = '#,##0'; // Format ini akan menggunakan titik sebagai pemisah ribuan di Excel
            }

            // Tambahkan worksheet ke workbook
            XLSX.utils.book_append_sheet(wb, ws, "Data Produk Tahunan");

            // Buat nama file dengan tanggal saat ini
            const fileName = `Data_Produk_Tahunan_${new Date().toISOString().slice(0, 10)}.xlsx`;

            // Langsung unduh file
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

        // Inisialisasi tampilan awal
        updateTable();
    });
</script>
@endsection