@extends('Admin.sidebar')

@section('title', 'INNDESA - Kelola User')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.:: Daftar User ::.</h2>

<div class="bg-white shadow-md p-4 rounded-lg">
    <div class="flex justify-between mb-4">
        <div class="flex items-center space-x-4">
            <a href="{{ route('Admin.users.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-plus mr-2"></i>Tambah User
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
        <form action="{{ route('Admin.users.index') }}" method="GET" class="w-1/3">
            <input type="text" name="search" id="searchInput" placeholder="Cari berdasarkan nama..." value="{{ request('search') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">Username</th>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">Password</th>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="border p-2 text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($users as $index => $user)
                <tr class="data-row text-center">
                    <td class="border border-gray-300 p-3 text-center text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{ $user->kode_user }}</td>
                    <td class="p-2 border">{{ $user->username }}</td>
                    <td class="p-2 border">******</td>
                    <td class="p-2 border">{{ $user->email }}</td>
                    <td class="p-2 border">{{ $user->role }}</td>
                    <td class="p-2 border">
                        @if($user->status === 'sudah daftar')
                        <span class="text-green-600 font-bold">Sudah Daftar</span>
                        @else
                        <span class="text-red-600 font-bold">Belum Daftar</span>
                        @endif
                    </td>
                    <td class="p-2 border">
                        <a href="{{ route('Admin.users.edit', $user->id_user) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('Admin.users.destroy', $user->id_user) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr id="noDataRow">
                    <td colspan="8" class="border p-3 text-center text-sm text-gray-900">Tidak ada data ditemukan</td>
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
                    title: 'Yakin ingin menghapus user?',
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
            const searchInput = document.getElementById('searchInput');

            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

            // Filter data berdasarkan username, email, dan role
            filteredRows = Array.from(rows).filter(row => {
                const username = row.cells[2].textContent.toLowerCase(); // Username (kolom ke-3)
                const email = row.cells[4].textContent.toLowerCase(); // Email (kolom ke-5)
                const role = row.cells[5].textContent.toLowerCase(); // Role (kolom ke-6)
                const id = row.cells[1].textContent.toLowerCase(); // ID (kolom ke-2)

                return username.includes(searchTerm) ||
                    email.includes(searchTerm) ||
                    role.includes(searchTerm) ||
                    id.includes(searchTerm);
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

        // Inisialisasi tabel saat halaman dimuat
        updateTable();
    });
</script>
@endsection
