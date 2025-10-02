<!-- resources/views/profil.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
        <!-- Header -->
        

        <!-- Foto Profil -->
        <div class="flex flex-col items-center">
            <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>

        <!-- Info Profil -->
        <div class="mt-6 space-y-4">
           <!-- Nama Kelompok -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-gray-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <div>
            <p class="text-sm text-gray-500">Nama Kelompok</p>
            <p class="text-gray-800 font-medium">
                {{ $admin_kelompok->kelompok->nama ?? 'Tidak ada data' }}
            </p>
        </div>
    </div>
</div>

<!-- Password -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-gray-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3v2a3 3 0 
                     003 3h0a3 3 0 003-3v-2zM15 11h3a2 2 0 012 2v3a2 2 
                     0 01-2 2h-3v-7z" />
        </svg>
        <div>
            <p class="text-sm text-gray-500">Password</p>
            <p class="text-gray-800 font-medium">********</p>
        </div>
    </div>
    <button onclick="openPasswordModal()" class="text-blue-600 hover:underline text-sm">Edit</button>

</div>



<!-- No Telp -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-gray-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 5a2 2 0 012-2h3.28c.34 0 
                     .67.136.91.38l2.83 2.83a1 1 0 
                     01.21 1.09l-1.12 2.24a16.06 
                     16.06 0 006.72 6.72l2.24-1.12a1 
                     1 0 011.09.21l2.83 2.83c.244.24.38.57.38.91V19a2 
                     2 0 01-2 2h-1C9.716 21 3 14.284 
                     3 6V5z" />
        </svg>
        <div>
            <p class="text-sm text-gray-500">No Telp</p>
            <p class="text-gray-800 font-medium">{{ $admin_kelompok->no_telp ?? '-' }}</p>
        </div>
    </div>
    <button onclick="openModal('No Telp','no_telp','{{ $admin_kelompok->no_telp ?? '' }}')" 
        class="text-blue-600 hover:underline text-sm">
    Edit
</button>
</div>

<!-- Instagram -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-pink-500 mr-3" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7.5 2h9a5.5 5.5 0 015.5 5.5v9a5.5 
                     5.5 0 01-5.5 5.5h-9A5.5 5.5 0 
                     012 16.5v-9A5.5 5.5 0 
                     017.5 2zm0 2A3.5 3.5 0 004 
                     7.5v9A3.5 3.5 0 007.5 20h9a3.5 
                     3.5 0 003.5-3.5v-9A3.5 3.5 0 
                     0016.5 4h-9zm4.5 3a5.5 5.5 
                     0 110 11 5.5 5.5 0 010-11zm0 
                     2a3.5 3.5 0 100 7 3.5 3.5 0 
                     000-7zm5-1a1 1 0 110 2 1 1 0 
                     010-2z" />
        </svg>
        <div>
            <p class="text-sm text-gray-500">Instagram</p>
            <p class="text-gray-800 font-medium">{{ $admin_kelompok->ig ?? '-' }}</p>
        </div>
    </div>
    <button onclick="openModal('Instagram','ig','{{ $admin_kelompok->ig ?? '' }}')" 
        class="text-blue-600 hover:underline text-sm">
    Edit
</button>
</div>

<!-- Facebook -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 12a10 10 0 10-11.5 
                     9.95v-7.05H8v-2.9h2.5V9.5a3.5 
                     3.5 0 013.5-3.5h2.5v2.9h-2c-.6 
                     0-1 .4-1 1v1.7h3l-.5 2.9h-2.5V22A10 
                     10 0 0022 12z" />
        </svg>
        <div>
            <p class="text-sm text-gray-500">Facebook</p>
            <p class="text-gray-800 font-medium">{{ $admin_kelompok->facebook ?? '-' }}</p>
        </div>
    </div>
    <button onclick="openModal('Facebook','facebook','{{ $admin_kelompok->facebook ?? '' }}')" 
        class="text-blue-600 hover:underline text-sm">
    Edit
</button>
</div>

<!-- Email -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16 12H8m0 0l-4-4m4 
                     4l-4 4m12-4h4m0 0l-4-4m4 
                     4l-4 4" />
        </svg>
        <div>
            <p class="text-sm text-gray-500">Email</p>
            <p class="text-gray-800 font-medium">{{ $admin_kelompok->email ?? '-' }}</p>
        </div>
    </div>
    <button onclick="openModal('Email','email','{{ $admin_kelompok->email ?? '' }}')" 
        class="text-blue-600 hover:underline text-sm">
    Edit
</button>
</div>

           <!-- Tombol Kembali -->
<div class="flex justify-center mt-6">
    <a href="{{ route('Admin_Kelompok.kelompok.show', $admin_kelompok->kelompok->id_kelompok) }}"
       class="text-blue-600 hover:underline">
       Kembali Ke Halaman Utama
    </a>
</div>


        </div>
    </div>

    <!-- Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">✖</button>
            <h2 id="modalTitle" class="text-lg font-semibold mb-4">Edit</h2>
            
            <form id="editForm" action="{{ route('Admin_Kelompok.profil.update', $admin_kelompok->id_admin) }}">
    @csrf
    @method('PATCH')
    <input type="hidden" name="field" id="fieldName">
    <div class="mb-4">
        <label id="modalLabel" for="modalInput" class="block text-sm text-gray-600 mb-2"></label>
        <input id="modalInput" name="value" type="text" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300">
    </div>
    <div class="flex justify-end">
        <button type="button" onclick="closeModal()" class="px-4 py-2 mr-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
    </div>
</form>
        </div>
    </div>
    <div id="toast" class="toast">Password berhasil diubah</div>

    <!-- Modal Password -->
<div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
        <button onclick="closePasswordModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">✖</button>
        <h2 class="text-lg font-semibold mb-4">Ganti Password</h2>
        
       <form id="passwordForm">

            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-2">Password Lama</label>
                <input type="password" name="password_lama" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
                <p id="error_password_lama" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-2">Password Baru</label>
                <input type="password" name="password_baru" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
                <p id="error_password_baru" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-2">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300" required>
                <p id="error_konfirmasi_password" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closePasswordModal()" class="px-4 py-2 mr-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
<style>
    .toast {
        visibility: hidden;
        min-width: 250px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        border-radius: 4px;
        padding: 16px;
        position: fixed;
        z-index: 1000;
        left: 50%;
        bottom: 30px;
        transform: translateX(-50%);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .toast.show {
        visibility: visible;
        animation: fadeIn 0.5s, fadeOut 0.5s 2.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
</style>

<script>
document.getElementById("passwordForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    // Reset error messages
    document.querySelectorAll("#passwordForm p").forEach(el => {
        el.classList.add("hidden");
        el.innerText = "";
    });

    let formData = new FormData(this);
    formData.append('_method', 'PATCH'); // <-- WAJIB supaya Laravel tau ini PATCH

    console.log("DATA DIKIRIM:", [...formData.entries()]);

    try {
        let response = await fetch("{{ route('profil.updatePassword', $admin_kelompok->id_admin) }}", {
            method: "POST", // <-- Ganti POST supaya Laravel parsing FormData
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        });

        let data = await response.json();

        if (!response.ok) {
            if (data.errors) {
                for (let field in data.errors) {
                    let errorEl = document.getElementById("error_" + field);
                    if (errorEl) {
                        errorEl.innerText = data.errors[field][0];
                        errorEl.classList.remove("hidden");
                    }
                }
            }
            return;
        }

        // ✅ Kalau sukses, tampilkan toast
        const toast = document.getElementById("toast");
        toast.innerText = "Password berhasil diubah!";
        toast.classList.add("show");

        setTimeout(() => {
            toast.classList.remove("show");
            closePasswordModal();
            location.reload();
        }, 3000);

    } catch (error) {
        console.error("Terjadi error:", error);
    }
});
</script>


<script>
function openPasswordModal() {
    document.getElementById("passwordModal").classList.remove("hidden");
}

function closePasswordModal() {
    document.getElementById("passwordModal").classList.add("hidden");
}
</script>


    <script>
    function openModal(label, field, value = '') {
        document.getElementById("editModal").classList.remove("hidden");
        document.getElementById("modalTitle").innerText = "Edit " + label;
        document.getElementById("modalLabel").innerText = label;
        document.getElementById("fieldName").value = field;
        document.getElementById("modalInput").value = value; // ← isi otomatis
    }

    function closeModal() {
        document.getElementById("editModal").classList.add("hidden");
    }
</script>

<script>
document.getElementById("editForm").addEventListener("submit", async function(e) {
    e.preventDefault(); // ⛔ hentikan submit normal

    let formData = new FormData(this);
    formData.append('_method', 'PATCH'); // Laravel butuh ini

    try {
        let response = await fetch(this.action, {
            method: "POST", // tetap POST karena _method=PATCH
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        });

        let data = await response.json();

        if (response.ok) {
            closeModal(); // ✅ tutup modal
            location.reload(); // ✅ reload supaya data terbaru muncul
        } else {
            alert(data.message || "Gagal memperbarui data");
        }

    } catch (err) {
        console.error("Terjadi error:", err);
        alert("Terjadi kesalahan saat mengupdate data.");
    }
});
</script>



</body>
</html>
