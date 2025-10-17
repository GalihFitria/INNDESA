<!-- resources/views/profil.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Tambahin ini biar icon FA muncul -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    
    /* ✅ Hilangkan icon mata bawaan browser (Edge, Chrome, dll) */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
        display: none;
    }
    input[type="password"]::-webkit-credentials-auto-fill-button,
    input[type="password"]::-webkit-password-toggle-button {
        display: none !important;
    }
    /* ✅ PRELOADER */
    #preloader {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(255, 255, 255, 255);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }
    #preloader.fade-out {
        opacity: 0;
        pointer-events: none;
    }
    .logo-loading {
        width: 120px;
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    {{-- ✅ Tambahin ini paling atas sebelum preloader --}}
    @if(session('success'))
        <input type="hidden" id="success-message" value="{{ session('success') }}">
    @endif

    <!-- ✅ PRELOADER -->
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>

    <script>
    window.addEventListener("load", function() {
        let preloader = document.getElementById("preloader");
        preloader.classList.add("fade-out");

        // Tunggu animasi preloader selesai
        setTimeout(() => {
            preloader.style.display = "none";

            // 🔹 Jalankan notifikasi CRUD setelah preloader hilang
            const successMessageEl = document.getElementById('success-message');
            if (successMessageEl) {
                const successMessage = successMessageEl.value || successMessageEl.innerText;
                if (successMessage) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: successMessage,
                        confirmButtonColor: '#7c3aed'
                    });
                }
            }
        }, 600); // sedikit tambah delay biar halus
    });
    </script>





    <!-- KOTAK PROFIL -->
<div class="bg-white rounded-2xl shadow-lg 
        w-[90%] max-w-[300px] sm:w-[85%] sm:max-w-md  
        h-auto sm:min-h-[600px] p-6 flex flex-col">



    <!-- Bagian isi profil -->
    <div>
         <!-- Foto Profil -->
<div class="flex flex-col items-center">
    <div class="w-16 h-16 sm:w-28 sm:h-28 rounded-full bg-gray-200 flex items-center justify-center">
        <svg class="w-12 h-12 sm:w-20 sm:h-20 text-gray-400 rounded-full bg-gray-200 p-2"
             fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 
                     1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 
                     1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
        </svg>
    </div>
</div>


       <!-- Info Profil -->
<div class="mt-6 space-y-4 text-xs sm:text-sm">
    
     <!-- Nama Kelompok -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <!-- Ikon User/People -->
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-500 mr-2" 
             fill="none" stroke="currentColor" stroke-width="2" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <div>
            <p class="text-gray-500 text-[10px] sm:text-xs">Nama Kelompok</p>
            <p class="text-gray-800 font-semibold text-sm sm:text-base">
                {{ $admin_kelompok->kelompok->nama ?? 'Tidak ada data' }}
            </p>
        </div>
    </div>
</div>

<!-- Password -->
<div class="flex justify-between items-center">
    <div class="flex items-center">
        <!-- Ikon Lock -->
        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500 mr-2" 
             fill="none" stroke="currentColor" stroke-width="2" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 11c-1.105 0-2 .895-2 2v3h4v-3c0-1.105-.895-2-2-2z" />
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M17 11V7a5 5 0 00-10 0v4H5a2 2 0 00-2 2v6a2 
                     2 0 002 2h14a2 2 0 002-2v-6a2 2 
                     0 00-2-2h-2z" />
        </svg>
        <div>
            <p class="text-gray-500 text-[10px] sm:text-xs">Password</p>
            <p class="text-gray-800 font-semibold text-sm sm:text-base">********</p>
        </div>
    </div>
    <button onclick="openPasswordModal()" 
            class="text-blue-600 hover:underline text-xs sm:text-sm">
        Edit
    </button>
</div>




            <!-- No Telp -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg class="w-3.5 h-3.5 sm:w-6 sm:h-6 text-gray-500 mr-3" 
                         fill="none" stroke="currentColor" stroke-width="2"
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
                        <p class="text-gray-500 text-xs sm:text-sm">No Telp</p>
                        <p class="text-gray-800 font-semibold">{{ $admin_kelompok->no_telp ?? '-' }}</p>
                    </div>
                </div>
                <button onclick="openModal('No Telp','no_telp','{{ $admin_kelompok->no_telp ?? '' }}')" 
                        class="text-blue-600 hover:underline text-xs sm:text-sm">
                    Edit
                </button>
            </div>

            <!-- Instagram -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg class="w-3.5 h-3.5 sm:w-6 sm:h-6 text-pink-500 mr-3" 
                         fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.5 2h9a5.5 5.5 0 
                        015.5 5.5v9a5.5 5.5 0 01-5.5 
                        5.5h-9A5.5 5.5 0 012 16.5v-9A5.5 
                        5.5 0 017.5 2zm0 2A3.5 3.5 0 
                        004 7.5v9A3.5 3.5 0 007.5 20h9a3.5 
                        3.5 0 003.5-3.5v-9A3.5 3.5 0 
                        0016.5 4h-9zm4.5 3a5.5 5.5 0 
                        110 11 5.5 5.5 0 010-11zm0 
                        2a3.5 3.5 0 100 7 3.5 3.5 0 
                        000-7zm5-1a1 1 0 110 2 1 1 0 
                        010-2z" />
                    </svg>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Instagram</p>
                        <p class="text-gray-800 font-semibold">{{ $admin_kelompok->ig ?? '-' }}</p>
                    </div>
                </div>
                <button onclick="openModal('Instagram','ig','{{ $admin_kelompok->ig ?? '' }}')" 
                        class="text-blue-600 hover:underline text-xs sm:text-sm">
                    Edit
                </button>
            </div>

            <!-- Facebook -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg class="w-3.5 h-3.5 sm:w-6 sm:h-6 text-blue-600 mr-3" 
                         fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 
                        10-11.5 9.95v-7.05H8v-2.9h2.5V9.5a3.5 
                        3.5 0 013.5-3.5h2.5v2.9h-2c-.6 
                        0-1 .4-1 1v1.7h3l-.5 2.9h-2.5V22A10 
                        10 0 0022 12z" />
                    </svg>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Facebook</p>
                        <p class="text-gray-800 font-semibold">{{ $admin_kelompok->facebook ?? '-' }}</p>
                    </div>
                </div>
                <button onclick="openModal('Facebook','facebook','{{ $admin_kelompok->facebook ?? '' }}')" 
                        class="text-blue-600 hover:underline text-xs sm:text-sm">
                    Edit
                </button>
            </div>

            <!-- Email -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg class="w-3.5 h-3.5 sm:w-5 sm:h-5 text-red-500 mr-2" 
             fill="none" stroke="currentColor" stroke-width="2" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 
                     002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
                    <div>
                        <p class="text-gray-500 text-xs sm:text-sm">Email</p>
                        <p class="text-gray-800 font-semibold">{{ $admin_kelompok->email ?? '-' }}</p>
                    </div>
                </div>
                <button onclick="openModal('Email','email','{{ $admin_kelompok->email ?? '' }}')" 
                        class="text-blue-600 hover:underline text-xs sm:text-sm">
                    Edit
                </button>
            </div>

             <!-- Tombol Kembali selalu di bawah -->
    <div class="flex justify-center mt-6 sm:mt-12">
        <a href="{{ route('Admin_Kelompok.kelompok.show', $admin_kelompok->kelompok->id_kelompok) }}"
           class="text-blue-600 hover:underline text-sm sm:text-base font-medium">
           Kembali Ke Halaman Utama
        </a>
    </div>
</div>

    </div>


    <!-- Modal -->
     <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-80 sm:w-96 max-w-sm p-6 relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black text-sm sm:text-base">✖</button>
        <h2 id="modalTitle" class="text-base sm:text-lg font-semibold mb-4">Edit</h2>
        
        <form id="editForm" action="{{ route('Admin_Kelompok.profil.update', $admin_kelompok->id_admin) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="field" id="fieldName">

            <div class="mb-4">
                <label id="modalLabel" for="modalInput" class="block text-xs sm:text-sm text-gray-600 mb-1"></label>
                <input id="modalInput" name="value" type="text" 
                       class="w-full border rounded-lg px-2 py-1 text-xs sm:text-sm focus:ring focus:ring-blue-300">
                <p id="error_value" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" 
                        class="px-2 py-1 mr-2 rounded bg-gray-300 hover:bg-gray-400 text-xs sm:text-sm">
                    Batal
                </button>
                <button type="submit" 
                        class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700 text-xs sm:text-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
    <div id="toast" class="toast">Password berhasil diubah</div>

    <!-- Modal Password -->
<div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
     <div class="bg-white rounded-lg shadow-lg w-7/12 sm:w-96 max-w-sm p-6 relative">


        <button onclick="closePasswordModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">✖</button>
        <h2 class="text-lg font-semibold mb-4">Ganti Password</h2>
        
       <form id="passwordForm">

            @csrf
            @method('PATCH')

             <div class="mb-4">
    <label class="block text-sm text-gray-600 mb-2">Password Lama</label>
    <div class="relative">
        <input type="password" name="password_lama" id="password_lama"
            class="w-full border rounded-lg px-2 py-1 text-xs sm:text-sm focus:ring focus:ring-blue-300 pr-8" required>
        <i class="fa-solid fa-eye absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"
           onclick="togglePassword('password_lama', this)"></i>
    </div>
    <p id="error_password_lama" class="text-red-500 text-sm mt-1 hidden"></p>
</div>
            <div class="mb-4">
    <label class="block text-sm text-gray-600 mb-2">Password Baru</label>
    <div class="relative">
        <input type="password" name="password_baru" id="password_baru"
            class="w-full border rounded-lg px-2 py-1 text-xs sm:text-sm focus:ring focus:ring-blue-300 pr-8" required>
        <i class="fa-solid fa-eye absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"
           onclick="togglePassword('password_baru', this)"></i>
    </div>
    <p id="error_password_baru" class="text-red-500 text-sm mt-1 hidden"></p>
</div>
            <div class="mb-4">
    <label class="block text-sm text-gray-600 mb-2">Konfirmasi Password</label>
    <div class="relative">
        <input type="password" name="password_baru_confirmation" id="password_baru_confirmation"
            class="w-full border rounded-lg px-2 py-1 text-xs sm:text-sm focus:ring focus:ring-blue-300 pr-8" required>
        <i class="fa-solid fa-eye absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"
           onclick="togglePassword('password_baru_confirmation', this)"></i>
    </div>
    <p id="error_password_baru_confirmation" class="text-red-500 text-sm mt-1 hidden"></p>
</div>

           <div class="flex justify-end">
    <button type="button" onclick="closePasswordModal()" 
        class="px-2 py-1 mr-2 rounded bg-gray-300 hover:bg-gray-400 text-xs sm:text-sm">
        Batal
    </button>
    <button type="submit" 
        class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700 text-xs sm:text-sm">
        Simpan
    </button>
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
function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

<div id="toast" class="toast"></div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   
document.getElementById("passwordForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    // Reset pesan error kecil
    document.querySelectorAll("#passwordForm p").forEach(el => {
        el.classList.add("hidden");
        el.innerText = "";
    });

    let formData = new FormData(this);
    formData.append('_method', 'PATCH');

    try {
        let response = await fetch("{{ route('Admin_Kelompok.profil.updatePassword', $admin_kelompok->id_admin) }}", {

    method: "POST",
    headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Accept": "application/json"   // ⬅️ WAJIB tambahin ini
    },
    body: formData
});


        let data = await response.json();

           if (response.status === 422) {
    // 🔴 Validasi gagal → tampilkan error per-field, tanpa popup
    if (data.errors) {
        for (let field in data.errors) {
            let errorEl = document.getElementById("error_" + field);
            if (errorEl) {
                errorEl.innerText = data.errors[field][0];
                errorEl.classList.remove("hidden");
            }
        }
    }

    return; // stop total, jangan lanjut ke bawah
}

// 🟢 Kalau bukan error validasi (422), cek error lain
if (!response.ok) {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: data.message || 'Terjadi kesalahan server.',
    });
    return;
}


        // 🟢 Sukses
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: data.message || 'Password berhasil diubah',
            timer: 2000,
            showConfirmButton: false
        });

        setTimeout(() => {
            closePasswordModal();
            location.reload();
        }, 2000);

    } catch (error) {
        console.error("Terjadi error:", error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan server.',
        });
    }
});



</script>

<script>
   // FORM EDIT FIELD (No Telp, IG, FB, Email)
   document.getElementById("editForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append('_method', 'PATCH');

    try {
        let response = await fetch(this.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        });

        let data = await response.json();

        if (response.status === 422) {
    Swal.fire({
        icon: 'error',
        title: 'Email sudah digunakan!',
        text: data.message || 'Silakan gunakan email lain.',
        confirmButtonColor: '#7c3aed'
    });
    return;
}


    } catch (err) {
        console.error("Terjadi error:", err);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan server.',
        });
    }
});
</script>



<script>
function openPasswordModal() {
    // reset form saat modal dibuka
    const form = document.getElementById("passwordForm");
    form.reset();

    // sembunyikan semua error
    document.querySelectorAll("#passwordForm p").forEach(el => {
        el.classList.add("hidden");
        el.innerText = "";
    });

    // buka modal
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

 <style>
/* 🔹 Responsive SweetAlert2 khusus untuk mobile */
@media (max-width: 640px) {
  .swal2-popup {
    width: 75% !important;            /* lebih lebar sedikit biar seimbang */
    max-width: 320px !important;      /* batas maksimal biar gak terlalu besar */
    aspect-ratio: 1 / 1 !important;   /* bikin popup jadi kotak (persegi) */
    font-size: 0.85rem !important;    /* teks sedikit lebih kecil */
    padding: 1rem !important;         /* ruang dalam cukup */
    display: flex !important;         /* bantu positioning tengah */
    flex-direction: column;
    justify-content: center;
  }

  .swal2-icon {
    margin: 0 auto 0.5rem auto !important; /* ikon di tengah */
    transform: scale(0.8); /* ikon agak kecil */
  }

  .swal2-title {
    font-size: 1rem !important;
    margin-bottom: 0.4rem !important;
    line-height: 1.2 !important;
  }

  .swal2-html-container {
    font-size: 0.85rem !important;
    margin-bottom: 0.8rem !important;
  }

  .swal2-confirm, .swal2-cancel {
    font-size: 0.75rem !important;
    padding: 0.35rem 0.8rem !important;
    border-radius: 6px !important;
  }
}
</style>

</body>
</html>
