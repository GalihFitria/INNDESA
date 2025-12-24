
<!DOCTYPE html>
<html lang="id">
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* tanda panah untuk kembali keatas di mobile*/
        #backToTop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #3b82f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        #backToTop.show {
            opacity: 1;
            visibility: visible;
        }

        #backToTop:hover {
            background-color: #2563eb;
            transform: translateY(-5px);
        }

        #backToTop i {
            font-size: 24px;
            color: white;
            display: block !important;
        }

        /* Fallback for Font Awesome - PERBAIKAN */
        #backToTop .arrow-fallback {
            display: none;
            width: 24px;
            height: 24px;
        }

        #backToTop.no-icon .arrow-fallback {
            display: block;
        }

        #backToTop.no-icon i {
            display: none !important;
        }

        /* Only show on mobile */
        @media (min-width: 641px) {
            #backToTop {
                display: none;
            }
        }
        /* PRELOADER YG PAKE LOGO*/
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .logo-loading {
            width: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        } 

         .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }

        body:not(.loaded)>*:not(#preloader) {
            display: none;
        }
        .hero-subtitle {
            text-shadow: 1px 1px 0px #ffffff, -1px -1px 0px #ffffff, 1px -1px 0px #ffffff, -1px 1px 0px #ffffff;
            -webkit-text-stroke: 0.5px #ffffff;
        } 
        

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
        }

        .dot {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            margin: 0 0.25rem;
            cursor: pointer;
        }

        .modal {
            transition: opacity 0.3s ease;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
        }

        .form-textarea {
            min-height: 100px;
        }

/* ✅ MOBILE */
/* ✅ MOBILE */
@media (max-width: 767px) {
  .profile-tab-wrapper {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    max-width: 100%;
    gap: 0.3rem;
  }
  .profile-tab-wrapper::-webkit-scrollbar {
    display: none;
  }

  .profil-tabs {
    flex: 0 0 auto !important;     /* biar ga melebar */
    min-width: 90px;               /* kecilin lebar minimal */
    font-size: 0.7rem !important;  /* kecilin font */
    padding: 0.3rem 0.5rem !important; /* kecilin padding */
    border-radius: 0.4rem;
  }

  .profil-title {
    font-size: 1.2rem !important;  /* kecilin judul */
    margin: 0.5rem 0 !important;
  }

  .tambah-anggota-btn {
    font-size: 0.65rem;
    padding: 0.15rem 0.35rem;
    border-radius: 0.5rem;
    display: inline-flex;
    align-items: center;
    gap: 0.2rem;
    width: auto;
    min-width: unset;
    max-width: fit-content;
  }
  .tambah-anggota-btn i {
    font-size: 0.65rem;
  }

  #struktur table th,
  #struktur table td {
    font-size: 0.7rem;
    padding: 0.3rem;
  }
  #struktur table td button i {
    font-size: 0.75rem;
  }
}

/* ✅ DESKTOP */
@media (min-width: 768px) {
  .profile-tab-wrapper {
    display: flex;
    overflow-x: visible;
  }
  .profil-tabs {
    flex: 1 1 0% !important;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 0;
  }
}



/* SKDESA */
/* ✅ Khusus tampilan mobile */
@media (max-width: 768px) {
  /* Konten SK Desa kecil & center */
  #sk-desa .prose {
    max-width: 95%;
    margin-left: auto;
    margin-right: auto;
    padding: 0.75rem;
    font-size: 0.7rem; /*kcilin  ukuran font */
    line-height: 1.5rem;
  }

  /* Tombol edit & hapus dikecilin */
  #sk-desa .tambah-anggota-btn,
  #sk-desa .edit-btn,
  #sk-desa .hapus-btn {
    padding: 0.25rem 0.5rem; /* tombol lebih kecil */
    font-size: 0.7rem;       /* teks tombol kecil */
  }

  /* Biar center juga */
  #sk-desa .flex {
    max-width: 95%;
    margin-left: auto;
    margin-right: auto;
  }
}
/*  SK Desa tombol kecil (khusus mobile) */
/*  SK Desa khusus mobile */
@media (max-width: 768px) {
  #sk-desa .sk-desa-item .relative {
    max-width: 90% !important;   /* Lebarnya jadi lebih kecil */
    height: 150px !important;    /* Kotaknya dipendekin */
  }

  #sk-desa .sk-desa-item img,
  #sk-desa .sk-desa-item #pdfSkDesaViewer {
    height: 150px !important;   /* isi kotaknya ikut kecil */
  }

  /* Tombol edit & hapus ikut kecil */
  #sk-desa .btn-action {
    font-size: 0.75rem;   /* perkecil font */
    padding: 0.25rem 0.5rem;
  }

  /* Ikon lebih kecil */
  #sk-desa .btn-action i {
    font-size: 0.85rem;
  }
}

/*INFOMASI DAN TAB MENUNYA  */
/*  MOBILE */
/*INFOMASI DAN TAB MENUNYA*/

/*   MOBILE */
@media (max-width: 767px) {
  .info-tab-wrapper {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    max-width: 100%;
    gap: 0.3rem;
  }
  .info-tab-wrapper::-webkit-scrollbar {
    display: none;
  }

  .info-tabs {
    flex: 0 0 auto !important;
    min-width: 90px;                  /* lebih kecil dari sebelumnya */
    white-space: nowrap;
    font-size: 0.7rem !important;     /* kecilin font */
    padding: 0.3rem 0.5rem !important;/* kecilin padding */
    border-radius: 0.35rem;
  }

  .info-title {
    font-size: 1.3rem !important;     /* kecilin judul */
    line-height: 1.6rem !important;
    margin: 0.5rem 0 !important;
    font-weight: 700 !important;
  }
}

/*   DESKTOP */
@media (min-width: 768px) {
  .info-tab-wrapper {
    display: flex;
    overflow-x: visible;
  }
  .info-tabs {
    flex: 1 1 0% !important;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 0;
  }
}


/* INOVASI DAN PENGHARGAAN */
/* INOVASI - Khusus Mobile */
@media (max-width: 768px) {
  /* Kontainer inovasi */
  #inovasi .inovasi-item .relative {
    max-width: 90% !important;   /* kecilin lebar kontainer */
    height: 150px !important;    /* tinggi kotak */
    margin-left: auto;
    margin-right: auto;
  }

  #inovasi .inovasi-item img,
  #inovasi .inovasi-item [id^="pdfInovasiViewer"] {
    height: 150px !important;    /* isi kotak ikut kecil */
  }

  /* Tombol tambah inovasi lebih kecil */
  #inovasi .tambah-anggota-btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
  }

  /* Tombol edit & hapus dikecilkan */
  #inovasi .btn-action,
  #inovasi .text-blue-600,
  #inovasi .text-red-600 {
    font-size: 0.75rem !important;
    padding: 0.25rem 0.5rem !important;
  }

  /* Ikon lebih kecil */
  #inovasi i {
    font-size: 0.85rem !important;
  }

  /* Navigasi kecil */
  #inovasi-nav button {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
  }
}

/* Edit & Hapus Inovasi lebih mepet */
@media (max-width: 768px) {
  #inovasi .inovasi-item .flex {
    gap: 0.15rem !important;   /*   super kecil jaraknya */
    justify-content: center;
  }

  #inovasi .inovasi-item button,
  #inovasi .inovasi-item form button {
    font-size: 0.75rem;      /* biar sama ukurannya */
    padding: 0.25rem 0.4rem; /* tombol kecil */
  }

  /* Ikon biar ikut kecil */
  #inovasi .inovasi-item i {
    font-size: 0.85rem;
  }
}




    </style>
    <style>

/* Tambahkan di bagian <style> */
.inovasi-item {
  position: relative;
  z-index: 10; /* Pastikan inovasi item memiliki z-index */
}

.inovasi-item img,
.inovasi-item canvas,
.inovasi-item iframe {
  position: relative;
  z-index: 11; /* Konten di atas watermark */
}

.watermark-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 12; /* Watermark di atas konten */
  pointer-events: none;
}

.action-buttons {
  position: relative;
  z-index: 20; /* Tombol di atas semua */
  background: rgba(255, 255, 255, 0.8); /* Background semi-transparan */
  padding: 4px 8px;
  border-radius: 4px;
}

#previewModal {
  z-index: 9999 !important; /* Modal harus paling atas */
}

/* Pastikan modal tidak menutupi elemen saat hidden */
#previewModal.hidden {
  display: none !important;
  visibility: hidden !important;
  opacity: 0 !important;
  pointer-events: none !important;
}

/* Pastikan body memiliki overflow yang benar */
/* html, body {
    overflow-x: hidden;
    width: 100%;
    min-height: 100vh;
    margin: 0;
    padding: 0;
} */

#preloader {
    position: fixed;
    z-index: 100; /* Di bawah navbar tapi di atas konten */
}

.content-wrapper { /* Ganti dengan kelas container utama di halaman admin */
    overflow: visible; /* Pastikan konten tidak mengganggu sticky */
    margin-top: 64px; /* Sesuaikan dengan tinggi navbar (h-16) */
}
/* profil klompok dan menunya */

/* Navbar Sticky Fix */
.navbar-wrapper {
    position: fixed !important;
    top: 0 !important;
    z-index: 9999 !important;
    width: 100% !important;
    background-color: white !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
}

/* Main Content Fix */
.main-content {
       margin-top: 130px; !important;
    padding-top: 0 !important;
    position: relative;
    z-index: 1;
}

/* Override untuk mobile (max 768px) */
@media (max-width: 768px) {
    .main-content {
        margin-top: 64px !important;  /* Hilangin gap putih */
    }
}

/* Body Fix */
html, body {
    overflow-x: hidden !important;
    width: 100% !important;
    min-height: 100vh !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* Hero Section Fix */
.hero-section {
    margin-top: 120px !important;
    padding-top: 0 !important;
}
/*   Hero Section khusus mobile */
@media (max-width: 768px) {
  .hero-section {
    margin-top: 100px !important;
    min-height: 200px !important; /*   lebih pendek */
    background-size: cover !important; 
    background-position: top center !important;
  }
}
@media (max-width: 768px) {
  .navbar-wrapper {
    position: fixed !important;
    top: 0 !important;
    z-index: 9999 !important;
  }

  .hero-section {
    margin-top: 64px !important; /* hilangkan gap putih */
  }
}
/*    Responsif ukuran logo */ 
.logo-preview {
  height: 100px;
  width: auto;
  object-fit: contain;
  background-color: transparent;
  border-radius: 0;
  box-shadow: none;
}

/*   Mobile: kecilin logo */
@media (max-width: 768px) {
  .logo-preview {
    height: 60px !important; /* dari 100px → 60px */
    max-width: 60px !important;
  }
}

/*   Tablet: sedang */
@media (min-width: 769px) and (max-width: 1024px) {
  .logo-preview {
    height: 80px !important;
    max-width: 80px !important;
  }
}

/*   Desktop: besar */
@media (min-width: 1025px) {
  .logo-preview {
    height: 100px !important;
    max-width: 100px !important;
  }
}

/*   Biar nama file dan X sejajar di semua ukuran layar */
.file-preview {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 4px;
  flex-wrap: nowrap;
}

/* Nama file biar gak kepotong */
.file-name {
  flex: 1;
  word-break: break-all;
}

/* Tombol X tetap kecil & sejajar */
.file-remove {
  flex-shrink: 0;
  margin-left: 6px;
  color: #ef4444; /* merah tailwind */
  cursor: pointer;
  font-weight: bold;
}



</style>

</style>


</head>

<body class="min-h-screen bg-white font-poppins">
    
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>
    <script>
        // JS PRELOADER
        window.addEventListener("load", function() {
            let preloader = document.getElementById("preloader");
            // Add fade-out animation
            preloader.classList.add("fade-out");
            // After animation completes, hide preloader and show content
            setTimeout(function() {
                preloader.style.display = "none";
                document.body.classList.add("loaded");
            }, 500); // Match transition duration (0.5s)
        });
    </script>
    <!-- KEMBALI KEATAS - PERBAIKAN -->
    <a href="#" id="backToTop" title="Kembali ke Atas">
        <i class="fas fa-arrow-up"></i>
        <!-- SVG fallback jika Font Awesome tidak berhasil dimuat -->
        <svg class="arrow-fallback" fill="white" viewBox="0 0 24 24">
            <path d="M7 14l5-5 5 5z" />
        </svg>
    </a>

    <script>
        // KEMBALI KE ATAS
        function checkFontAwesome() {
            const icon = document.createElement('i');
            icon.className = 'fas fa-arrow-up';
            const isLoaded = window.getComputedStyle(icon, ':before').getPropertyValue('content') !== 'none';

            if (isLoaded) {
                document.body.classList.add('fa-loaded');
            }
        }

        // Run check after DOM is loaded
        document.addEventListener('DOMContentLoaded', checkFontAwesome);

        // Also run check after window is fully loaded
        window.addEventListener('load', checkFontAwesome);

        // KEMBALI KE ATAS
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });

        backToTopButton.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
       <!-- Hero Section -->
    <section class=" hero-section relative text-white overflow-hidden
        min-h-[300px] sm:min-h-[350px] md:min-h-[550px]
        flex flex-col justify-start md:justify-center
        pt-0 sm:pt-0 md:pt-40 {{--   Mobile & tablet nempel ke navbar, desktop ada jarak --}}
        {{ $kelompok->background
        ? 'bg-[url(\'' . asset('storage/' . $kelompok->background) . '\')] bg-contain bg-top md:bg-cover md:bg-center bg-no-repeat'
        : 'bg-[url(\'' . asset('images/background_beranda_INNDESA.jpeg') . '\')] bg-cover bg-center' }}">

            <!-- Overlay untuk mobile -->
            <div class="absolute inset-0 bg-black bg-opacity-50 z-0 md:hidden"></div>

            <!-- Overlay untuk desktop -->
            <div class="absolute inset-0 bg-black bg-opacity-50 z-0 hidden md:block"></div>

            <!-- Tombol Edit -->
            <div x-data="editLogoBgModal()">

                <button
        @click="open = true"
        class="absolute bottom-3 right-3 
                px-2 py-1 text-[10px]   <!--   font super kecil di mobile -->
                sm:px-4 sm:py-2 sm:text-sm 
                bg-white text-gray-800 rounded-md shadow hover:bg-gray-100 
                font-medium flex items-center z-20">
        <i class="fa fa-pen mr-1 sm:mr-2 text-[11px] sm:text-sm"></i> 
        <span class="hidden sm:inline">Edit Logo & Background</span>
        <span class="sm:hidden">Edit Logo & Background</span>
        </button>



            <!-- Modal Form -->
            <div 
             id="editLogoBgModal"
                x-show="open" 
                x-cloak 
                x-transition 
                style="display:none"
                x-effect="document.body.classList.toggle('modal-open', open)"
                class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center pointer-events-auto z-[999999]">

    
                <!--   Responsive modal -->
                <div class="bg-white shadow-lg rounded-lg
                            p-3 w-11/12 max-w-[260px] text-xs
                            sm:p-8 sm:w-full sm:max-w-md sm:text-base
                            relative z-[9999] max-h-[80vh] overflow-y-auto">

                <!-- Tombol Close -->
                 <button @click="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-lg">✕</button>



                <!-- Logo -->
                <div class="flex justify-center mb-3 sm:mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="h-10 sm:h-16">
                </div>

                <!-- Judul -->
                <h2 class="text-center text-sm sm:text-2xl font-bold text-blue-600 mb-2">
                    Edit Logo & Background
                </h2>
                <p class="text-center text-gray-600 mb-4 sm:mb-6 text-xs sm:text-base">
                    Unggah logo dan background kelompok Anda
                </p>

                <!-- Form -->
                <form action="{{ route('Admin_Kelompok.kelompok.updateLogoBackground', $kelompok->id_kelompok) }}" 
                    method="POST" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Flag hapus file -->
                    <input type="hidden" name="delete_logo" id="deleteLogo" value="0">
                    <input type="hidden" name="delete_background" id="deleteBackground" value="0">

                    <!-- Logo -->
                    <div class="mb-3 sm:mb-4">
                        <label for="logo" class="block text-gray-700 font-medium mb-1 sm:mb-2">Logo(Opsional)</label>
                        <input type="file" id="logo" name="logo" accept="image/*"
                                class="block w-full border rounded-md p-1.5 sm:p-2 text-xs sm:text-sm">
                        <div id="logoFilePreview" class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600 ">
                            @if($kelompok->logo)
                            <div class="file-preview">
                                <span class="file-name cursor-pointer" onclick="previewExistingLogo()">
                                    {{ $kelompok->logo }}
                                </span>
                                <span class="file-remove cursor-pointer text-red-500 ml-1 sm:ml-2"
                                        onclick="removeLogoFile()">✕</span>
                            </div>
                            @else
                            <p>Tidak ada file yang dipilih.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Background -->
                    <div class="mb-3 sm:mb-4">
                        <label for="background" class="block text-gray-700 font-medium mb-1 sm:mb-2">Background(Opsional)</label>
                        <input type="file" id="background" name="background" accept="image/*"
                                class="block w-full border rounded-md p-1.5 sm:p-2 text-xs sm:text-sm">
                        <div id="bgFilePreview" class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600">
                            @if($kelompok->background)
                            <div class="file-preview">
                                <span class="file-name cursor-pointer" onclick="previewExistingBackground()">
                                    {{ $kelompok->background }}
                                </span>
                                <span class="file-remove cursor-pointer text-red-500 ml-1 sm:ml-2"
                                        onclick="removeBackgroundFile()">✕</span>
                            </div>
                            @else
                            <p>Tidak ada file yang dipilih.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol -->
                    <button type="submit"
                            class="w-full px-2 sm:px-4 py-1.5 sm:py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs sm:text-base">
                        Simpan
                    </button>
                </form>
                </div>
            </div>
        </div>

        <!--   Hero Logo di pojok kiri atas -->
        <div class="absolute top-4 left-4 sm:top-6 sm:left-6 md:top-12 md:left-16 z-10">
            @if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo))
                <img src="{{ asset('storage/' . $kelompok->logo) }}"
                    alt="Logo {{ $kelompok->getKodeKelompokAttribute() }}"
                    class="logo-preview object-contain no-context-menu"
                    draggable="false"
                    oncontextmenu="return false;"
                    ondragstart="return false;"
                    onselectstart="return false;"
                    onerror="this.src='{{ asset('images/fallback-logo.png') }}'">
            @else
                <img src="{{ asset('images/fallback-logo.png') }}" alt=""
                    class="h-10 sm:h-14 md:h-20 lg:h-24 w-auto object-contain no-context-menu"
                    draggable="false"
                    oncontextmenu="return false;"
                    ondragstart="return false;"
                    onselectstart="return false;">
            @endif
        </div>

        <!-- Hero Content -->
        <!-- Hero Content -->
    <!-- Hero Content -->
    <!-- Hero Content -->
    <!-- Hero Content -->
        <div class="text-center relative z-10 px-4 flex flex-col items-center justify-start
                    pt-16 sm:pt-20 md:pt-10 h-full"> 
        <!--   desktop padding atas kecil -->

        <!--   Nama Kelompok -->
        <h2 class="hero-title
                    text-xl sm:text-3xl md:text-5xl lg:text-7xl
                    font-bold text-white drop-shadow-[0_2px_6px_rgba(0,0,0,0.7)]
                    mt-6 sm:mt-8 md:mt-10 lg:mt-12
        ">
            Kelompok <br><span class="text-yellow-400">{{ $kelompok->nama }}</span>
        </h2>
        </div>



    </section>


        <div class="navbar-wrapper">
        @include('navbar')
    </div>


    <!-- Hero Section -->
     <!-- Perbaikan: Tambahkan wrapper untuk konten utama -->


    <div class="main-content">



    </div>



    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .logo-preview {
    height: 100px; /* sesuaikan tinggi sesuai tampilanmu */
    width: auto;
    object-fit: contain;
    background-color: transparent;
    border-radius: 0; /* biar gak dipaksa bentuk */
    box-shadow: none;
    }

    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    const logoImg = document.querySelector(".logo-preview");
    if (logoImg) {
        logoImg.onload = function() {
        const { naturalWidth, naturalHeight } = logoImg;
        if (Math.abs(naturalWidth - naturalHeight) < 10) {
            // kalau hampir persegi, buat bulat
            logoImg.style.borderRadius = "50%";
        } else {
            // kalau bukan persegi, biarkan bentuk asli
            logoImg.style.borderRadius = "0";
        }
        };
    }
    });
    </script>




<!-- Tambahkan CSS untuk x-cloak -->
 
    <style>
        /*   Saat modal terbuka, kunci scroll halaman tapi biarkan posisi layout tetap */
    body.modal-open {
    overflow: hidden !important; /* cegah halaman di-scroll waktu modal terbuka */
    }

    /*   Hapus aturan yang bikin navbar geser atau ketutup */
    body.modal-open .navbar-wrapper {
    position: static !important;
    z-index: auto !important;
    pointer-events: auto !important;
    }

    /*   Overlay modal harus di atas semua */
    .modal-overlay {
    z-index: 999999 !important;
    pointer-events: auto !important;
    }
    .modal-overlay * {
    pointer-events: auto !important;
    }

    /*   Area file-preview & tombol X */
    .file-preview {
    position: relative !important;
    z-index: 9999999 !important;
    }
    .file-remove {
    position: relative !important;
    z-index: 99999999 !important;
    pointer-events: all !important;
    cursor: pointer !important;
    }

    /*   Sembunyikan elemen x-cloak */
    [x-cloak] {
    display: none !important;
    }

    </style>
    


   

        <!-- Profil Kelompok Section -->
    <h2 class="profil-title text-4xl font-bold text-blue-600 text-center mb-8 mt-10">
        Profil Kelompok
    </h2>
    <div class="w-full border-t border-gray-200 pt-4 box-border">
    <div class="bg-white p-6 max-w-4xl mx-auto">

        <!--   Tab Menu -->
        <div class="profile-tab-wrapper flex rounded-lg bg-gray-200 
                overflow-x-auto sm:overflow-hidden whitespace-nowrap">
    <button class="profile-tab-button profil-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white"
        onclick="openTab('struktur', 'profile')" aria-label="Lihat Struktur">
        Struktur
    </button>
    <button class="profile-tab-button profil-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700"
        onclick="openTab('sejarah', 'profile')" aria-label="Lihat Sejarah">
        Sejarah
    </button>
    <button class="profile-tab-button profil-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700"
        onclick="openTab('sk-desa', 'profile')" aria-label="Lihat SK Desa">
        SK Desa
    </button>
    <button class="profile-tab-button profil-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700"
        onclick="openTab('kelompok-rentan', 'profile')" aria-label="Lihat Kelompok Rentan">
        Kelompok Rentan
    </button>
    <button class="profile-tab-button profil-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700"
        onclick="openTab('stok-produk', 'profile')" aria-label="Lihat Stok Produk">
        Stok Produk
    </button>
    </div>








      <!-- STRUKTUR -->
     <div id="struktur" class="profile-tab-content block py-4">
        <div class="flex justify-end mb-4">
             {{-- Tambah anggota --}}
            <button type="button" onclick="openStrukturForm()" 
                class="tambah-anggota-btn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah
            </button>
        </div>
        <table class="w-full border-collapse mb-6 border border-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="border border-gray-200 p-3 text-left">Posisi</th>
                    <th class="border border-gray-200 p-3 text-left">Nama</th>
                
                    <th class="border border-gray-200 p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="struktur-tbody">
                @php
                    $jabatanList = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota'];
                    $groupedStruktur = $struktur->groupBy('jabatan');
                @endphp

                @foreach($jabatanList as $jabatan)
                    @if(isset($groupedStruktur[$jabatan]))
                        @php
                            $items = $groupedStruktur[$jabatan];
                            $rowspan = $items->count();
                        @endphp

                        @foreach($items as $index => $item)
                            <tr>
                                {{-- tampilkan jabatan hanya sekali --}}
                                @if($index === 0)
                                    <td class="border border-gray-200 p-3 text-left align-top" rowspan="{{ $rowspan }}">
                                        {{ $jabatan }}
                                    </td>
                                @endif

                                <td class="border border-gray-200 p-3">{{ $item->nama }}</td>
                                <td class="border border-gray-200 p-3 text-center">
                                <button type="button" 
                                        onclick="editStruktur(this)" 
                                        data-id="{{ $item->id_struktur }}"
                                        data-rentan="{{ $item->id_rentan }}"
                                        data-jabatan="{{ $jabatan }}"
                                        data-nama="{{ $item->nama }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                <!-- Tombol hapus -->
            <!-- Tombol hapus -->
            <button type="button"
                onclick="confirmDeleteUniversal('delete-form-{{ $item->id_struktur }}', 'Yakin ingin menghapus anggota ini?', 'Data anggota akan dihapus!')"
                class="text-red-600 hover:text-red-800">
                <i class="fas fa-trash"></i>
            </button>

            <form id="delete-form-{{ $item->id_struktur }}"
                action="{{ route('Admin_Kelompok.deleteStruktur', $item->id_struktur) }}"
                method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>





                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach

                @if($struktur->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center p-4 text-gray-500">
                            Tidak ada data struktur organisasi
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

     </div>


        <!-- SEJARAH -->
        <div id="sejarah" class="profile-tab-content hidden py-4">
            <div class="flex justify-end mb-4">
                <button onclick="openSejarahForm()" 
                        class="tambah-anggota-btn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-edit mr-2"></i>Edit Sejarah
                </button>
            </div>

            <!-- ✅ Konten dengan paragraf per baris -->
            <div id="sejarah-content" class="w-full text-gray-700 leading-relaxed text-justify text-xs md:text-base">
                @foreach (explode("\n", $kelompok->sejarah ?? 'Belum ada sejarah yang diisi.') as $paragraph)
                    @if (!empty(trim($paragraph)))
                        <p class="indent-8 mb-3 md:mb-4 leading-snug md:leading-relaxed">
                            {{ $paragraph }}
                        </p>
                    @endif
                @endforeach
            </div>
        </div>





        <!-- SK DESA -->
        <div id="sk-desa" class="profile-tab-content hidden py-4">
            <!-- Tombol tambah -->
            <div class="flex justify-end mb-4">
                @if(empty($kelompok->sk_desa))
                <button onclick="openSkDesaForm()" 
                        class=" tambah-anggota-btn  bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i>Tambah 
                </button>
                @endif
            </div>
               @if(empty($kelompok->sk_desa))
    <div class="text-center text-gray-500 py-10" id="sk-desa-empty">
        <p class="text-sm font-arial ">SK Desa tidak tersedia.</p>
    </div>
    @endif

        <!-- tampilkan file -->
            @if(!empty($kelompok->sk_desa))
                <div class="sk-desa-item text-center relative">

                @php
                    $ext = strtolower(pathinfo($kelompok->sk_desa, PATHINFO_EXTENSION));
                @endphp

                @if(in_array($ext, ['jpg','jpeg','png']))
                    {{-- Preview Gambar --}}
                    <div class="relative w-full max-w-[30rem] mx-auto h-60">
                    <img src="{{ asset('storage/' . $kelompok->sk_desa) }}"
                        alt="SK Desa"
                        class="w-full h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer no-context-menu"
                        draggable="false"
                        oncontextmenu="return false;"
                        onclick="openPreview('{{ asset('storage/' . $kelompok->sk_desa) }}','SK Desa','image')"
                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'">

                    <!-- Watermark overlay -->
                    <div class="absolute inset-0 pointer-events-none overflow-hidden">
                        <div class="grid grid-cols-12 w-full h-full">
                        @for ($i = 0; $i < 200; $i++)
                        <span class="flex items-center justify-center text-gray-900 text-[9px] font-semibold opacity-15 -rotate-45 whitespace-nowrap select-none"> INNDESA</span>
                        @endfor
                        </div>
                    </div>
                    </div>

                @elseif($ext === 'pdf')
                    {{-- Preview PDF pakai pdf.js --}}
                    <div class="relative w-full max-w-[30rem] mx-auto h-60 border border-gray-200 rounded-lg shadow-md">
                    <div id="pdfSkDesaViewer" 
                            class="w-full h-60 overflow-auto">
                        </div>

                <!-- Overlay hanya di area PDF -->
                <div class="absolute inset-0 cursor-pointer no-context-menu"
                    onclick="openPreview('{{ asset('storage/' . $kelompok->sk_desa) }}','SK Desa','pdf')"
                    oncontextmenu="return false;">
                </div>
                    </div>

                @endif

                <!-- Tombol Edit/Hapus -->
                <div class="mt-2">
                    <button type="button" onclick="openSkDesaForm(true)" 
                            class=" btn-action text-blue-600 hover:text-blue-800 mr-2">
                    <i class="fas fa-edit"></i> Edit
                    </button>
                <!-- Tombol Hapus SK Desa -->
            <button type="button"
                onclick="confirmDeleteUniversal('delete-skdesa-form-{{ $kelompok->id_kelompok }}', 'Yakin ingin menghapus SK Desa?', 'Data SK Desa akan dihapus!')"
                class="btn-action text-red-600 hover:text-red-800">
                <i class="fas fa-trash"></i> Hapus
            </button>

            <form id="delete-skdesa-form-{{ $kelompok->id_kelompok }}"
                action="{{ route('Admin_Kelompok.deleteSkDesa', $kelompok->id_kelompok) }}"
                method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>



                </div>
                </div>
            @endif
        </div>

        <style>
        /*  Perbesar watermark hanya di tampilan mobile */
        @media (max-width: 768px) {
        .sk-desa-item .absolute span {
            font-size: 5px !important;   /* lebih besar */
            font-weight: 600 !important;  /* lebih tebal */
            opacity: 0.25 !important;     /* lebih jelas */
        }
        }


        </style>




<!-- KELOMPOK RENTAN -->
<!-- KELOMPOK RENTAN -->
<div id="kelompok-rentan" class="profile-tab-content hidden py-4">
    <div class="overflow-x-auto">
        <table class="min-w-[600px] w-full border-collapse mt-4 border border-gray-200 text-xs sm:text-sm">

            @php
                // === DIUBAH ===
                // Ambil semua kolom (nama_rentan) kecuali yang '-', tapi jangan hilangkan kolom kosong.
                $allColumns = [];
foreach ($rentan as $r) {
    if ($r->nama_rentan === '-') continue; // skip "-"
    $allColumns[] = $r->nama_rentan;
}

                // Cek apakah ada data valid di salah satu kolom (untuk menentukan apakah tampilkan "Tidak ada data..." atau tabel data)
                $hasAnyData = false;
                foreach ($allColumns as $col) {
                    $filtered = array_filter($dataRentan[$col] ?? [], fn($v) =>
                        trim($v) !== '' && trim($v) !== '-'
                    );
                    if (!empty($filtered)) {
                        $hasAnyData = true;
                        break;
                    }
                }
                // === END DIUBAH ===
            @endphp

            @if(count($allColumns) > 0)
                <thead class="bg-gray-100">
                    <tr>
                        @foreach($allColumns as $col)
                            <th class="border border-gray-200 px-2 py-1 sm:px-4 sm:py-2 text-left font-semibold">
                                {{ ucfirst($col) }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                @php
                    // Cari jumlah baris terbanyak dari kolom (tetap hitung berdasarkan data yang valid)
                    $maxRows = 0;
                    foreach ($allColumns as $col) {
                        $filtered = array_filter($dataRentan[$col] ?? [], fn($v) =>
                            trim($v) !== '' && trim($v) !== '-'
                        );
                        $maxRows = max($maxRows, count($filtered));
                    }
                @endphp

                @if($hasAnyData)
                    <tbody>
                        @for($i = 0; $i < $maxRows; $i++)
                            <tr>
                                @foreach($allColumns as $col)
                                    @php
                                        $filtered = array_filter($dataRentan[$col] ?? [], fn($v) =>
                                            trim($v) !== '' && trim($v) !== '-'
                                        );
                                        $filtered = array_values($filtered);
                                        $value = $filtered[$i] ?? '-';

                                    @endphp
                                    <td class="border border-gray-200 px-2 py-1 sm:px-4 sm:py-2">
                                        {{ $value }}
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td class="text-center text-gray-500 py-4" colspan="{{ count($allColumns) }}">
                                Tidak ada data kelompok rentan yang tersedia
                            </td>
                        </tr>
                    </tbody>
                @endif

            @else
                {{-- Jika tidak ada kolom sama sekali (semua nama_rentan mungkin '-') --}}
                <tbody>
                    <tr>
                        <td class="text-center text-gray-500 py-4">
                            Tidak ada data kelompok rentan yang tersedia
                        </td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
</div>


<!-- STOK PRODUK -->
<div id="stok-produk" class="profile-tab-content hidden py-4">
    <!-- <div class="flex justify-end mb-4">
        <button onclick="openStokProdukForm()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>Tambah Produk
        </button>
    </div> -->

    <table class="w-full border-collapse mt-4 border border-gray-200">
        <thead>
            <tr>
                <th class="border border-gray-200 p-2 text-left">Nama Produk</th>
                <th class="border border-gray-200 p-2 text-left">Stok</th>
                <th class="border border-gray-200 p-2 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody id="stok-produk-tbody">
            @if($produk->isEmpty())
                <tr>
                    <td colspan="3" class="border border-gray-200 p-4 text-center text-gray-500">
                        Tidak ada data stok produk
                    </td>
                </tr>
            @else
                @foreach($produk as $p)
                    <tr data-id="{{ $p->id_produk }}" data-satuan="{{ $p->satuan }}">
                        <td class="border border-gray-200 p-2">{{ $p->nama }}</td>
                        <td class="border border-gray-200 p-2">
    {{ $p->stok }} {{ ucfirst($p->satuan) }}
</td>

                        <td class="border border-gray-200 p-2 text-center">
                            <button type="button" 
                                    onclick="editStokProduk(this)" 
                                    class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
    </div>
         </div>

     
     
        <!-- Informasi Section -->
<h2 class="info-title text-4xl font-bold text-blue-600 text-center mb-8">Informasi</h2>
<div class="w-full border-t border-gray-200 pt-4 box-border">
  <div class="bg-white p-6 max-w-4xl mx-auto">

    <!-- ✅ Tab Menu -->
    <!-- ✅ Tab Menu -->
<div class="info-tab-wrapper flex rounded-lg bg-gray-200 
            overflow-x-auto sm:overflow-hidden whitespace-nowrap">

 <button class="info-tab-button info-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-[#0097D4] text-white"
    data-tab="produk" onclick="openTab('produk', 'info')" aria-label="Lihat Produk">
    Produk
</button>

<button class="info-tab-button info-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700"
    data-tab="kegiatan" onclick="openTab('kegiatan', 'info')" aria-label="Lihat Kegiatan">
    Kegiatan
</button>

<button class="info-tab-button info-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700"
    data-tab="inovasi" onclick="openTab('inovasi', 'info')" aria-label="Lihat Inovasi & Penghargaan">
    Inovasi & Penghargaan
</button>

<button class="info-tab-button info-tabs flex-1 py-3 px-4 font-semibold text-center transition-colors bg-gray-200 text-gray-700"
    data-tab="produk_pertahun" onclick="openTab('produk_pertahun', 'info')" aria-label="Lihat Produk Pertahun">
    Rekapan Produk
</button>

</div>


               <!-- PRODUK -->
    <style>
        /* Kecilkan font di mobile */
@media (max-width: 768px) {
  .mobile-small-text {
    font-size: 0.75rem;   /* text-xs */
  }
}

@media (max-width: 768px) {
  .mobile-flex-wrap {
    flex-direction: column; /* Biar elemen dibagi vertikal */
    align-items: flex-start; /* Rapat ke kiri */
    gap: 0.5rem; /* kasih sedikit jarak antar elemen */
  }
}


    </style>
 

<meta name="csrf-token" content="{{ csrf_token() }}">
 <div id="produk" class="info-tab-content block py-4">

 
          <!-- Baris 1: Total Produk & Kontak -->
  <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
      <div class="flex items-center gap-4">
        <div class="text-green-600 font-medium mobile-small-text">
            Total Produk Terjual: {{ $totalProdukTerjual }}
        </div>
        @php
    $adminKelompok = \App\Models\InformasiUser::where('id_kelompok', $kelompok->id_kelompok)->first();
@endphp

@if($adminKelompok && $adminKelompok->no_telp)
    <a href="https://wa.me/{{ $adminKelompok->no_telp }}?text=Halo%20saya%20tertarik%20dengan%20produk%20Anda"
       target="_blank"
        class="text-black-600 hover:underline mobile-small-text">
       Kontak
    </a>
@endif
  </div>
  </div>




    <!-- Baris 2: Tombol -->
<div class="flex justify-between items-center mb-2 w-full">
         <button onclick="openProdukForm()" 
        class="bg-blue-600 text-white 
               px-1.5 py-1 text-xs rounded-md hover:bg-blue-700 
               md:px-3 md:py-1.5 md:text-base">
        <i class="fas fa-plus mr-1"></i>Tambah Produk
    </button>
        <div id="katalog-container" class="flex flex-col gap-2">
            

                @if(empty($katalog))
                    {{-- Kalau belum ada katalog --}}
                     <button onclick="openKatalogForm(false)" 
                class="bg-blue-600 text-white 
                       px-1.5 py-1 text-xs rounded-md hover:bg-blue-700 
                       md:px-3 md:py-1.5 md:text-base">
                <i class="fas fa-plus mr-1"></i>Tambah Katalog
            </button>


                @else
                    {{-- Kalau sudah ada katalog --}}
                    <div class="flex items-center space-x-2">
                        @if(Str::endsWith(strtolower($katalog->katalog), ['.jpg','.jpeg','.png']))
                            <button type="button" 
                                onclick="previewKatalog('{{ asset('storage/'.$katalog->katalog) }}', 'image')"
                                  class="text-black-600 hover:underline mobile-small-text">
                                Katalog
                            </button>
                        @elseif(Str::endsWith(strtolower($katalog->katalog), '.pdf'))
                            <button type="button" 
                                onclick="previewKatalog('{{ asset('storage/'.$katalog->katalog) }}', 'pdf')"
                                  class="text-black-600 hover:underline mobile-small-text">
                                Katalog 
                            </button>
                        @endif

                        <button type="button"
                            onclick="openKatalogForm(
                                true,
                                {{ $katalog->id_katalog }},
                                '{{ $katalog->katalog }}',
                              
                                '{{ asset('storage/'.$katalog->katalog) }}',
                                '{{ $katalog->nama_katalog }}',
                                `{{ $katalog->deskripsi_katalog }}`)"
                            class="text-blue-600 hover:text-blue-800">
    <i class="fas fa-edit"></i> <span class="hidden md:inline">Edit</span>
</button>

                       <form id="delete-katalog-{{ $katalog->id_katalog }}"
      action="{{ route('Admin_Kelompok.deleteKatalog', $katalog->id_katalog) }}"
      method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<button type="button"
    onclick="confirmDeleteUniversal('delete-katalog-{{ $katalog->id_katalog }}', 'Yakin ingin menghapus katalog?', 'Data katalog akan dihapus!')"
    class="text-red-600 hover:text-red-800">
    <i class="fas fa-trash"></i> <span class="hidden md:inline">Hapus</span>
</button>

                    </div>
                @endif
            </div></div>
            <!-- Modal Preview Katalog -->
 <!-- Modal Preview Katalog -->
<div id="previewKatalogModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999]">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-[600px] max-h-[80vh] flex flex-col overflow-hidden relative p-4">

        <!-- Tombol Close & Download (kanan atas) -->
        <div class="absolute top-2 right-2 flex items-center space-x-2 z-[10000]">
            <!-- Tombol Download -->
            <a id="downloadKatalogBtn"
               href="#"
               download
               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors flex items-center shadow z-[10000]">
                <i class="fas fa-download mr-1"></i> Download
            </a>

            <!-- Tombol Close -->
            <button onclick="closePreviewKatalog()" 
                    class="text-gray-600 hover:text-gray-800 transition-colors z-[10000]">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Konten Preview -->
        <div id="previewContent" class="flex-1 w-full h-full flex justify-center items-center overflow-auto p-4 relative z-[9999]"></div>
    </div>
</div>


 <style>
    #katalogModal.hidden,
#previewKatalogModal.hidden,
#previewModal.hidden {
    display: none !important;
    pointer-events: none !important;
    visibility: hidden !important;
}

 </style>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js"></script>

 <script>
 async function renderPdfInKatalog(url, containerId) {
    const container = document.getElementById(containerId);
    container.innerHTML = ""; // reset konten

    try {
        const loadingTask = pdfjsLib.getDocument(url);
        const pdf = await loadingTask.promise;

        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const page = await pdf.getPage(pageNum);
            const viewport = page.getViewport({ scale: 1.2 });

            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");

            canvas.width = viewport.width;
            canvas.height = viewport.height;

            const renderContext = { canvasContext: context, viewport: viewport };
            await page.render(renderContext).promise;

            // responsive biar scroll hanya ke bawah
            canvas.style.width = "100%";
            canvas.style.height = "auto";
            canvas.classList.add("mb-4", "shadow");

            container.appendChild(canvas);
        }
    } catch (err) {
        container.innerHTML = `<p class="text-red-500">Gagal memuat PDF: ${err.message}</p>`;
        console.error(err);
    }
}

 function previewKatalog(url, type = 'image') {
    if (!url) return;

    const modal = document.getElementById('previewKatalogModal');
    const previewContent = document.getElementById('previewContent');
    const downloadBtn = document.getElementById('downloadKatalogBtn');

    // Reset konten
    previewContent.innerHTML = '';
    downloadBtn.href = url;

    if (type === 'image') {
        // Tampilkan loading
        previewContent.innerHTML = `
            <div class="flex flex-col items-center justify-center h-full">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mb-4"></div>
                <p class="text-gray-600">Memuat gambar...</p>
            </div>
        `;

        const img = new Image();
        img.onload = function() {
            previewContent.innerHTML = `
                <img src="${url}" alt="Katalog" class="max-w-full max-h-[70vh] object-contain rounded-lg shadow-lg mx-auto" />
            `;
            modal.classList.remove('hidden');
        };
        img.onerror = function() {
            previewContent.innerHTML = `
                <div class="text-center p-8">
                    <div class="text-red-500 mb-4">
                        <i class="fas fa-exclamation-triangle text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Gagal Memuat Gambar</h3>
                    <p class="text-gray-600 mb-4">File gambar tidak dapat ditemukan atau rusak.</p>
                    <div class="space-y-2">
                        <button onclick="window.open('${url}', '_blank')" 
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            <i class="fas fa-external-link-alt mr-2"></i>Buka di Tab Baru
                        </button>
                        <button onclick="closePreviewKatalog()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition ml-2">
                            Tutup
                        </button>
                    </div>
                </div>
            `;
            modal.classList.remove('hidden');
        };
        img.src = url;
    } else if (type === 'pdf') {
        renderPdfInKatalog(url, "previewContent");
        modal.classList.remove('hidden');
    }
}

function closePreviewKatalog() {
    document.getElementById('previewKatalogModal').classList.add('hidden');
    document.getElementById('previewContent').innerHTML = '';
}


 </script>
 <style> 
  #previewContent {
  width: 100%;
  height: 100%;
  overflow-y: auto;   /* scroll ke bawah */
  overflow-x: hidden; /* cegah scroll samping */
  display: block;     /* biar canvas numpuk ke bawah */
}
#previewWrapper {
  height: 100%;
  overflow-y: auto;   /* ✅ Scroll hanya di sini */
  overflow-x: hidden;
}

#previewContent img {
  max-width: 100%;
  max-height: 70vh;  /* Biar gambar ga lebih dari modal */
  object-fit: contain;
  display: block;
  margin: 0 auto;
}

#previewContent canvas {
  width: 100%;  /* Biar PDF responsif */
  height: auto;
  margin-bottom: 1rem;
}





</style>



   <!-- ✅ Search dipindah tepat di bawah tombol -->
   <!-- ✅ Search dipindah tepat di bawah tombol -->

<!-- ✅ Search dipindah ke bawah tombol -->
<div class="w-full md:w-1/3 mb-4">
    <input type="text" id="searchProduk" placeholder="Cari Produk..."
        class="w-full border rounded px-2 py-1 text-sm 
               focus:outline-none focus:ring-1 focus:ring-sky-500
               md:px-3 md:py-2 md:text-base"
        aria-label="Cari Produk">
</div>
{{-- tambahkan ini DI LUAR #produk-carousel --}}
<div id="produk-empty" class="col-span-full text-center text-gray-500 py-10 hidden">
    <p class="text-sm font-arial">Produk tidak tersedia.</p>
</div>

 <script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchProduk");
    const produkItems = document.querySelectorAll(".produk-item");
    const emptyMessage = document.getElementById("produk-empty");
    const adaProdukAwal = produkItems.length > 0; // ✅ Cek apakah ada produk dari awal

    if (searchInput) {
        searchInput.addEventListener("input", function() {
            let keyword = this.value.toLowerCase().trim();
            let found = false;

            // kalau dari awal emang ga ada produk → langsung keluar, gak usah lanjut filter
            if (!adaProdukAwal) {
                // pastiin pesan “tidak ada produk yang tersedia” tetap tampil
                emptyMessage.classList.add("hidden"); // sembunyikan "produk tidak tersedia"
                return;
            }

            produkItems.forEach(item => {
                let nama = item.dataset.nama.toLowerCase();
                if (nama.includes(keyword)) {
                    item.style.display = "";
                    found = true;
                } else {
                    item.style.display = "none";
                }
            });

            // kalau ada produk tapi hasil cari ga ketemu
            if (adaProdukAwal && !found) {
                emptyMessage.classList.remove("hidden");
            } else {
                emptyMessage.classList.add("hidden");
            }
        });
    }
});
</script>




   

    <!-- ✅ Search hanya muncul di Mobile
    <div class="block md:hidden mt-4">
        <input type="text" id="searchProdukMobile" placeholder="Cari Produk..."
            class="w-full border rounded px-2 py-2 focus:outline-none focus:ring-1 focus:ring-sky-500"
            aria-label="Cari Produk">
    </div> -->

    <div class="relative">
      

        <div id="produk-carousel" class="carousel grid grid-cols-2 md:grid-cols-4 gap-4 z-10">
                @if($produk->isEmpty())
        <div class="col-span-full text-center text-gray-500 py-10">
            <!-- <i class="fas fa-box-open text-4xl mb-3"></i> -->
            <p class="text-sm  font-arial">Tidak ada produk yang tersedia.</p>
            <!-- <p class="text-sm text-gray-400">Silakan tambahkan produk baru dengan menekan tombol <b>Tambah Produk</b>.</p> -->
        </div>
    @else

            @foreach($produk as $p)
                <div class="produk-item" id="produk-{{ $p->id }}" data-nama="{{ $p->nama }}">
    <div 
        class="produk-card border rounded-lg shadow-md p-3 w-full h-full min-h-[280px] cursor-pointer flex flex-col"
        onclick="goToDetailProduk('{{ \App\Http\Controllers\DetailProdukController::createHashUrl($p->id_produk, $p->nama) }}', event)"

    >
        {{-- Foto Produk --}}
        @if(!empty($p->foto))
            @if(Str::endsWith(strtolower($p->foto), ['.jpg', '.jpeg', '.png']))
                <img src="{{ asset('storage/'.$p->foto) }}"
                    alt="{{ $p->nama }}"
                    class="w-full h-40 object-cover rounded-lg shadow-md border border-gray-200">
            @endif
        @else
            {{-- Default placeholder --}}
            <img src="https://via.placeholder.com/200x160"
                alt="{{ $p->nama }}"
                class="w-full h-40 object-cover rounded-lg border border-gray-200">
        @endif

       <h3 class="mt-3 font-semibold text-lg break-words whitespace-normal line-clamp-none">
  {{ $p->nama }}
</h3>

        <div class="flex items-center justify-between pb-2">
            <p class="text-green-600 font-bold text-sm md:text-lg truncate">
                Rp. {{ number_format($p->harga, 0, ',', '.') }}
            </p>
            <p class="text-black-500 text-sm truncate">Stok: {{ $p->stok }}</p>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-between mt-auto relative z-10">
            <button type="button"
                onclick="event.stopPropagation(); openProdukForm(true, this);"
                data-id="{{ $p->id_produk }}"
                data-nama="{{ $p->nama }}"
                data-harga="{{ $p->harga }}"
                data-stok="{{ $p->stok }}"
                  data-satuan="{{ $p->satuan }}"  
                data-deskripsi="{{ $p->deskripsi }}"
                data-foto="{{ $p->foto }}"
                data-sertifikat='@json($p->sertifikat ? explode(",", $p->sertifikat) : [])'
                class="text-blue-600 hover:text-blue-800">
        <i class="fas fa-edit"></i> Edit
            </button>

             {{-- ✅ Form Delete Produk --}}
                <form id="delete-produk-{{ $p->id_produk }}"
                      action="{{ route('Admin_Kelompok.deleteProduk', $p->id_produk) }}"
                      method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>

                {{-- ✅ Tombol Hapus Produk --}}
                <button type="button"
                    onclick="event.stopPropagation(); confirmDeleteProduk(
                        'delete-produk-{{ $p->id_produk }}',
                        {{ $p->produk_pertahun_count > 0 ? 'true' : 'false' }}
                    )"
                    class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash"></i> Hapus
                </button>
           <script>
  function confirmDeleteProduk(formId, isUsedInPertahun) {
    if (isUsedInPertahun) {
        // Kalau produk dipakai di produk_pertahun → kasih warning extra
        Swal.fire({
            title: "⚠ Peringatan",
            text: "Jika Anda menghapus produk ini, produk ini juga akan terhapus di rekap produk.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, lanjut",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                confirmDeleteUniversal(
                    formId,
                    "Yakin ingin menghapus produk ini?",
                    "Produk akan dihapus permanen!"
                );
            }
        });
    } else {
        // Kalau produk belum ada di produk_pertahun → langsung konfirmasi biasa
        confirmDeleteUniversal(
            formId,
            "Yakin ingin menghapus produk ini?",
            "Produk akan dihapus permanen!"
        );
    }
}

</script>

        </div>
    </div>
</div>

            @endforeach

            {{-- ✅ Tambah placeholder kalau jumlah produk ganjil --}}
            @if(count($produk) % 2 != 0)
                <div class="invisible border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto"></div>
            @endif
                @endif
        </div>
        


        <div id="produk-nav" class="flex justify-center mt-4 hidden">
    <button class="btn btn-outline mr-2" 
        onclick="prevSlide('produk')" 
        aria-label="Previous slide">←</button>

    <div id="produk-dots" class="flex space-x-1"></div>

    <button class="btn btn-outline" 
        onclick="nextSlide('produk')" 
        aria-label="Next slide">→</button>
</div>

    </div>
</div>






<!-- KEGIATAN -->
<div id="kegiatan" class="info-tab-content hidden py-4">
     <div class="flex flex-wrap items-center justify-between mb-4 px-1 sm:px-0">
    
    <!-- input pencarian -->
    <input type="text" id="searchKegiatan" placeholder="Cari Kegiatan..."
        class="border rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-sky-500
               w-full sm:w-auto order-1 sm:order-1 mb-2 sm:mb-0"
        aria-label="Cari Kegiatan">

    <!-- tombol tambah -->
    <button onclick="openKegiatanForm()" 
        class="tambah-anggota-btn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition
               w-fit order-2 sm:order-2 sm:ml-2">
        <i class="fas fa-plus mr-2"></i>Tambah 
    </button>
</div>


    <div class="relative">
        <!-- 🔥 Grid konsisten kayak Produk -->
          @if ($kegiatan->count() > 0)
        <div id="kegiatan-carousel" class="carousel grid grid-cols-2 md:grid-cols-4 gap-4">
               
            @foreach ($kegiatan as $k)
    <div class="kegiatan-item" 
         id="kegiatan-{{ $k->id_kegiatan }}" 
         data-nama="{{ strtolower($k->judul) }}">
        
    <div class="border rounded-lg shadow-md p-3 w-full h-full min-h-[300px] cursor-pointer flex flex-col"
         onclick="goToDetailKegiatan('{{ \App\Http\Controllers\Update_KegiatanController::createHashUrl($k->id_kegiatan, $k->judul) }}', event)">
         
            <div class="h-40">
                <img src="{{ $k->foto ? asset('storage/'.$k->foto) : 'https://via.placeholder.com/200x160' }}"
                     alt="{{ $k->judul }}"
                     class="w-full h-full object-cover rounded-lg">
            </div>

            <h3 class="mt-3 font-semibold text-sm line-clamp-2">{{ $k->judul }}</h3>
            <p class="text-xs text-gray-600 line-clamp-2 mb-2">{{ $k->deskripsi }}</p>

            <p class="text-xs text-gray-500 mb-2">
                {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}
            </p>
            
        <div class="flex justify-between mt-auto">
    {{-- Tombol Edit --}}
     <button
    onclick="openKegiatanForm(
        true, 
        {{ $k->id_kegiatan }}, 
        this.dataset.judul, 
        this.dataset.deskripsi, 
        this.dataset.tanggal, 
        this.dataset.sumber, 
        this.dataset.foto
    )"
    class="text-blue-600 hover:text-blue-800"
    data-kegiatan-id="{{ $k->id_kegiatan }}"
    data-judul="{{ htmlspecialchars($k->judul, ENT_QUOTES) }}"
    data-deskripsi="{{ htmlspecialchars($k->deskripsi, ENT_QUOTES) }}"
    data-tanggal="{{ $k->tanggal }}"
    data-sumber="{{ $k->sumber_berita ?? '' }}"
    data-foto="{{ $k->foto }}"
>
    <i class="fas fa-edit"></i> Edit
</button>


    {{-- Tombol Hapus --}}
    <form 
        id="delete-kegiatan-{{ $k->id_kegiatan }}"
        action="{{ route('Admin_Kelompok.deleteKegiatan', $k->id_kegiatan) }}"
        method="POST" 
        style="display:none;"
    >
        @csrf
        @method('DELETE')
    </form>

    <button 
        type="button"
        onclick="confirmDeleteUniversal(
            'delete-kegiatan-{{ $k->id_kegiatan }}', 
            'Yakin ingin menghapus kegiatan?', 
            'Data kegiatan akan dihapus!'
        )"
        class="text-red-600 hover:text-red-800"
    >
        <i class="fas fa-trash"></i> Hapus
    </button>
</div>
</div> 
</div> 
@endforeach
</div>
   <!-- muncul cuma kalau hasil pencarian kosong -->
        <div id="kegiatan-empty" class="col-span-4 text-center text-gray-500 py-8 hidden">
            Kegiatan tidak tersedia
        </div>
    @else
        <!-- muncul cuma kalau database kosong -->
        <div id="kegiatan-none" class="col-span-4 text-center text-gray-500 py-8">
            Tidak ada kegiatan yang tersedia
        </div>
    @endif
 </div>

 
<!-- Tambahin ini -->
<div id="kegiatan-empty" class="col-span-4 text-center text-gray-500 py-8 hidden">
    Kegiatan tidak tersedia
</div>
        <div id="kegiatan-nav" class="flex justify-center mt-4 hidden">
    <button id="kegiatan-prev" 
        class="btn btn-outline mr-2" 
        onclick="prevSlide('kegiatan')" 
        aria-label="Previous slide">←</button>

    <!-- ganti pagination ke dots -->
    <div id="kegiatan-dots" class="flex space-x-1"></div>

    <button id="kegiatan-next" 
        class="btn btn-outline" 
        onclick="nextSlide('kegiatan')" 
        aria-label="Next slide">→</button>
</div>
    </div>
</div>
<script>
function goToDetailProduk(hash, event) {
    if (event.target.closest('button')) return;
    localStorage.setItem('isFromCrud', 'false');
    window.location.href = `/detail_produk/${hash}`;
}
</script>
 

<script>
function goToDetailKegiatan(hash, event) {
    // biar gak jalan kalau tombol yang diklik
    if (event.target.closest('button')) return;

    // tandain bukan dari CRUD
    localStorage.setItem('isFromCrud', 'false');

    // redirect ke halaman detail
    window.location.href = `/update_kegiatan/${hash}`;
}
</script>






                <!-- INOVASI & PENGHARGAAN -->
 <!-- INOVASI & PENGHARGAAN -->
 <!-- INOVASI & PENGHARGAAN -->
  <!-- INOVASI & PENGHARGAAN -->
 <!-- Menjadi -->
   <div id="inovasi" class="info-tab-content hidden py-4">
  <div class="max-w-4xl mx-auto px-4">
       <div class="flex justify-end mb-4">
    <button type="button" 
    onclick="openInovasiForm({{ $kelompok->id_kelompok }})"
    class="tambah-anggota-btn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
    <i class="fas fa-plus mr-2"></i>Tambah 
   </button>



</div>
     <!-- <div class="flex justify-end mb-4"> -->
@if($inovasi && $inovasi->count() > 0)
    <div id="inovasi-carousel" class="space-y-6">
        @foreach($inovasi as $item)
            <div class="inovasi-item" data-id="{{ $item->id_inovasi }}">
                {{-- Foto / PDF --}}
                @if(!empty($item->foto))
                    {{-- Jika file berupa gambar --}}
@if(Str::endsWith(strtolower($item->foto), ['.jpg','.jpeg','.png']))
    <div class="relative w-full max-w-[30rem] mx-auto h-60">
        <img src="{{ asset('storage/' . $item->foto) }}"
             alt="{{ $item->judul_inovasi }}"
             class="w-full h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer no-context-menu"
             draggable="false"
             oncontextmenu="return false;"
             onclick="openPreview('{{ asset('storage/' . $item->foto) }}', '{{ $item->judul_inovasi }}')"
             onerror="this.src='{{ asset('images/placeholder.jpg') }}'">

             
        {{-- 🔹 Watermark overlay (sama seperti SK Desa) --}}
{{-- 🔹 Watermark overlay (lebih rapat, 12 baris tulisan INNDESA) --}}
<div class="absolute inset-0 pointer-events-none overflow-hidden">
    <div class="grid grid-cols-24 grid-rows-12 w-full h-full">
        @for ($i = 0; $i < 288; $i++) {{-- 24 kolom × 12 baris --}}
            <span class="flex items-center justify-center text-gray-800 text-[3px] font-semibold opacity-10 -rotate-45 whitespace-nowrap select-none">
                INNDESA
            </span>
        @endfor
    </div>
</div>

    </div>

                    @elseif(Str::endsWith(strtolower($item->foto), '.pdf'))
                        <div class="relative w-full max-w-[30rem] mx-auto h-60 border border-gray-200 rounded-lg shadow-md cursor-pointer"
     onclick="openPreview('{{ asset('storage/' . $item->foto) }}', '{{ $item->judul_inovasi }}', 'pdf')">
                            <div id="pdfInovasiViewer-{{ $item->id_inovasi }}" class="w-full h-60 overflow-auto"></div>
                        </div>
                    @endif
                @endif

                {{-- Tombol Aksi --}}
                <div class="flex justify-center items-center gap-4 mt-2">
                   <button type="button"
   onclick="openInovasiForm({{ $kelompok->id_kelompok }}, true, {{ $item->id_inovasi }}, '{{ $item->foto }}')"
   data-existing-file="{{ $item->foto }}"
   class="text-blue-600 hover:text-blue-800 mr-2">
   <i class="fas fa-edit"></i> Edit
</button>



                    {{-- Tombol Hapus pakai confirmDeleteUniversal --}}
<form id="delete-inovasi-{{ $item->id_inovasi }}"
      action="{{ route('Admin_Kelompok.deleteInovasi', $item->id_inovasi) }}"
      method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<button type="button"
        onclick="confirmDeleteUniversal('delete-inovasi-{{ $item->id_inovasi }}', 'Yakin ingin menghapus inovasi?', 'Data inovasi akan dihapus permanen!')"
        class="flex items-center text-red-600 hover:text-red-800">
    <i class="fas fa-trash mr-1"></i> Hapus
</button>

                </div>
            </div>
        @endforeach
    </div>

    {{-- Navigasi hanya tampil jika lebih dari 1 --}}
        @if($inovasi->count() > 1)
            <div id="inovasi-nav" class="flex justify-center mt-4">
                <button class="btn btn-outline mr-2" onclick="prevSlide('inovasi')">←</button>
                <div id="inovasi-dots" class="flex space-x-1"></div>
                <button class="btn btn-outline" onclick="nextSlide('inovasi')">→</button>
            </div>
        @endif
    @else
        {{-- Pesan jika kosong --}}
        <p class="text-gray-500 text-center  mt-4">
            Belum ada inovasi yang ditambahkan.
        </p>
    @endif

</div>
</div>
<style>
.inovasi-item .absolute.inset-0 {
    z-index: 15;
    pointer-events: none;
}

.inovasi-item .absolute.inset-0 .grid {
    width: 100%;
    height: 100%;
    grid-template-columns: repeat(14, 1fr); /* rapat horizontal */
    grid-template-rows: repeat(12, 1fr);   /* jadi 12 baris vertikal */
}

/* Tulisan kecil tapi tetap jelas */
.inovasi-item .absolute.inset-0 span {
    font-size: 8px !important;   /* kecil tapi masih terbaca */
    font-weight: 900 !important;
    opacity: 0.1 !important;
    color: #111827 !important;
    transform: rotate(-45deg);
}
</style>


 
   
<!-- PRODUK PER TAHUN -->
<!-- PRODUK PER TAHUN -->
<div id="produk_pertahun" class="info-tab-content hidden py-4">
  <div class="max-w-4xl mx-auto px-4">
    
    <!-- Tombol Tambah -->
    <div class="flex justify-end mb-6">
      <button type="button" onclick="openProdukTahunForm()"
        class="tambah-anggota-btn bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah 
      </button>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
      <table class="w-full border border-gray-200 text-sm">
        <thead>
          <tr class="bg-gray-100 text-gray-700">
            <th class="border p-2 text-left w-40">Nama Produk</th>
            <th class="border p-2 text-left w-24">Tahun</th>
            <th class="border p-2 text-left w-24">Harga</th>
            <th class="border p-2 text-left w-24">Produk Terjual</th>
            <th class="border p-2 text-center  w-24">Aksi</th>
          </tr>
        </thead>
        <tbody>
       @php
$groupedProduk = $produkPertahun
    ->groupBy('nama_produk')
    ->map(function ($items) {
        return $items->sortBy('tahun')->values(); // urut tahun kecil → besar dan reset index
    });
@endphp

@foreach($groupedProduk as $namaProduk => $items)
    @php $rowspan = $items->count(); @endphp
    @foreach($items as $index => $item)
        <tr>
            @if($index === 0)
                <td class="border p-2 align-top font-medium w-40" rowspan="{{ $rowspan }}">
                    {{ $namaProduk }}
                </td>
            @endif

            <td class="border p-2 w-24">{{ $item->tahun }}</td>
            <td class="border p-2 w-24">{{ number_format($item->harga, 0, ',', '.') }}</td>
            <td class="border p-2 text-left w-24">
  {{ $item->produk_terjual }} {{ $item->satuan ?? '' }}
</td>

            <td class="border p-2 text-center w-24">
                <div class="flex items-center justify-center space-x-3">
                    <!-- Tombol Edit -->
                    <button type="button"
                        onclick="editProdukTahun(this)"
                        data-id="{{ $item->id_tahun }}"
                        data-id-produk="{{ $item->id_produk }}"
                        data-nama-produk="{{ $item->nama_produk }}"  
                        data-harga="{{ $item->harga }}"
                        data-terjual="{{ $item->produk_terjual }}"
                        data-satuan="{{ $item->satuan }}" 
                        data-tahun="{{ $item->tahun }}"
                        data-update-url="{{ route('Admin_Kelompok.updateProdukTahun', $item->id_tahun) }}"
                        class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Tombol Hapus -->
                    <form id="delete-produk-tahun-{{ $item->id_tahun }}"
                        action="{{ route('Admin_Kelompok.deleteProdukTahun', $item->id_tahun) }}"
                        method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <button type="button"
                        onclick="confirmDeleteUniversal('delete-produk-tahun-{{ $item->id_tahun }}', 'Yakin ingin menghapus data produk tahun?', 'Data ini akan dihapus secara permanen!')"
                        class="text-red-600 hover:text-red-800">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
@endforeach


          @if($produkPertahun->isEmpty())
            <tr>
              <td colspan="5" class="text-center p-4 text-gray-500 ">
                Tidak ada data produk per tahun
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

   <script>
    // Data tahun yang sudah dipakai per produk
   const usedYears = @json(
    $produkPertahun->groupBy('id_produk')->map(function($items){
        return $items->pluck('tahun')->map(fn($t) => (int)$t)->toArray();
    })
);

</script>





     <!--MODALL-->

     <!-- PDF.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

    document.addEventListener('DOMContentLoaded', () => {
    // === Render semua inovasi (kalau PDF) ===
    @foreach($inovasi as $item)
        @if(Str::endsWith(strtolower($item->foto), '.pdf'))
            renderPdfWithWatermark(
                "{{ asset('storage/' . $item->foto) }}",
                "pdfInovasiViewer-{{ $item->id_inovasi }}"
            );
        @endif
    @endforeach

    // === Render SK Desa (kalau ada dan PDF) ===
    @if(!empty($kelompok->sk_desa) && strtolower(pathinfo($kelompok->sk_desa, PATHINFO_EXTENSION)) === 'pdf')
        renderPdfWithWatermark(
            "{{ asset('storage/' . $kelompok->sk_desa) }}",
            "pdfSkDesaViewer"
        );
    @endif

    // Tambahkan event listener untuk menutup modal dengan klik di luar
    const previewModal = document.getElementById('previewModal');
    if (previewModal) { // Pastikan elemen ada sebelum menambah event listener
        previewModal.addEventListener('click', (e) => {
            if (e.target === previewModal) {
                closePreview();
            }
        });
        
        // Tambahkan event listener untuk tombol close
        const closeButtons = previewModal.querySelectorAll('[onclick="closePreview()"]');
        closeButtons.forEach(btn => {
            btn.addEventListener('click', closePreview);
        });
    }
});

    // Fungsi yang sudah dimodifikasi dengan penanganan error
   async function renderPdfWithWatermark(url, containerId) {
    try {
        const pdf = await pdfjsLib.getDocument(url).promise;
        const container = document.getElementById(containerId);
        
        if (!container) {
            console.error('Container tidak ditemukan:', containerId);
            return;
        }
        
        container.innerHTML = ""; // reset isi

        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            try {
                const page = await pdf.getPage(pageNum);
                const viewport = page.getViewport({ scale: 1.2 });

                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                await page.render({ canvasContext: context, viewport }).promise;

                // Biar responsive di desktop & mobile
                canvas.style.maxWidth = "100%";
                canvas.style.height = "auto";
                canvas.style.display = "block";
                canvas.style.margin = "0 auto 1rem auto";
                canvas.style.boxShadow = "0 0 6px rgba(0,0,0,0.1)";

             // 🔹 Watermark super padat (2x lebih banyak)
context.save();
context.font = "500 8px Arial"; // lebih kecil dan tipis
context.fillStyle = "rgba(70, 70, 70, 0.12)"; // lebih halus
 // opacity dikurangi
context.rotate(-Math.PI / 4);


// 🔸 Jarak super rapat (2x lebih banyak dari versi sebelumnya)
for (let y = -canvas.height; y < canvas.height * 2; y += 18) {   // semula 35 → makin rapat
    for (let x = -canvas.width; x < canvas.width * 2; x += 60) { // semula 95 → makin rapat
        context.fillText("INNDESA", x, y);
    }
}

context.restore();





                container.appendChild(canvas);
            } catch (pageError) {
                console.error(`Error rendering page ${pageNum}:`, pageError);
            }
        }
    } catch (error) {
        console.error('Error rendering PDF:', error);
        const container = document.getElementById(containerId);
        if (container) {
            container.innerHTML = '<p class="text-red-500">Gagal memuat PDF. Silakan coba lagi.</p>';
        }
    }
}
    
</script>





 
<!-- Preview Modal -->
   <!-- Preview Modal -->
<div id="previewModal" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50" 
     tabindex="-1" role="dialog" aria-labelledby="previewTitle">

    <!-- Container utama -->
    <div class="bg-white rounded-lg p-6 w-11/12 max-w-3xl max-h-[85vh] relative flex flex-col overflow-hidden">


        <!-- Header -->
        <div class="flex justify-between items-center mb-4 relative z-20">
            <h3 id="previewTitle" class="text-xl font-semibold text-gray-800"></h3>
            <button onclick="closePreview()" 
                    class="text-gray-600 hover:text-gray-800 text-2xl" 
                    aria-label="Close preview modal">&times;</button>
        </div>

        <!-- Preview content -->
        <div class="relative w-full flex justify-center">

            <!-- Image container -->
            <img id="previewImage"
                 src=""
                 alt="Preview"
                 class="w-full max-h-[70vh] object-contain rounded-lg no-context-menu hidden relative z-10"
                 draggable="false"
                 oncontextmenu="return false;"
                 ondragstart="return false;"
                 onselectstart="return false;">

            <!-- PDF container -->
            <!-- PDF container -->
   <div id="previewPdf"
     class="w-full flex-1 rounded-lg overflow-y-auto no-context-menu hidden relative z-10">
</div>



                    

            <!-- Watermark overlay (gambar/pdf) -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden z-20">
                <div class="grid grid-cols-12 w-full h-full">
                    @for ($i = 0; $i < 800; $i++)
                        <span class="flex items-center justify-center text-gray-900 text-[9px] font-medium opacity-10 -rotate-45 whitespace-nowrap select-none">
  INNDESA
</span>


                    @endfor
                </div>
            </div>

            <!-- Watermark background putih -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
                <div class="grid grid-cols-12 w-full h-full">
                    @for ($i = 0; $i < 800; $i++)
                       <span class="flex items-center justify-center text-gray-900 text-[9px] font-medium opacity-10 -rotate-45 whitespace-nowrap select-none">
  INNDESA
</span>


                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
 <style>
   #previewPdf {
  width: 100%;
  height: 70vh;        /* batas tinggi viewport modal */
  overflow-y: auto;    /* scroll ke bawah */
}

#previewPdf canvas {
  display: block;
  width: 100% !important;
  height: auto !important;
  margin: 0 auto 1rem auto; /* tengah + jarak antar halaman */
  box-shadow: 0 0 6px rgba(0,0,0,0.1);
}


    /* Canvas di tampilan awal (desktop & mobile) */
    [id^="pdfInovasiViewer-"] canvas,
    #pdfSkDesaViewer canvas {
      max-width: 100% !important;
      height: auto !important;
      display: block;
      margin: 0 auto 1rem auto;
      box-shadow: 0 0 6px rgba(0,0,0,0.1);
    }
</style>

<style>
    /* 🌸=== MOBILE RESPONSIVE UNTUK PREVIEW MODAL ===🌸*/
@media (max-width: 768px) {
  /* Modal biar sedikit lebih kecil dan nyaman di layar HP */
  #previewModal .bg-white {
    width: 95% !important;
    padding: 1rem !important;
    max-height: 80vh !important;
  }

  /* Judul modal */
  #previewTitle {
    font-size: 1rem !important;
  }

  /* Gambar preview di modal */
  #previewImage {
    max-height: 60vh !important;
    object-fit: contain !important;
  }

  /* PDF container di modal */
  #previewPdf {
    height: 60vh !important;
  }

  /* Watermark di modal diperbesar sedikit biar kelihatan di mobile */
  #previewModal span {
    font-size: 5px !important;
    opacity: 0.25 !important;
    font-weight: 600 !important;
  }

  /* Canvas PDF tampilan mobile (biar nggak kepotong) */
  #previewPdf canvas {
    max-width: 100% !important;
    height: auto !important;
    margin: 0 auto 0.5rem auto !important;
  }
}

</style>

  <!-- Form Modal Struktur -->
<div id="strukturModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">
    <!-- ✅ Versi kecil di mobile, tetap lebar di desktop -->
    <div class="bg-white rounded-lg p-3 w-11/12 max-w-[250px] text-xs 
            sm:p-6 sm:w-full sm:max-w-lg sm:text-base relative">

                    <!-- 🔹 Tombol X di pojok kanan atas -->
        <button onclick="closeStrukturForm()" 
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl font-bold"
                aria-label="Close form">
            &times;
        </button>
        <h2 id="strukturModalTitle" class="text-sm sm:text-xl font-bold mb-3">Tambah Anggota Struktur</h2>

        {{-- FORM --}}
        <form id="strukturForm" method="POST">
            @csrf

            <input type="hidden" name="id_kelompok" 
                value="{{ $kelompok instanceof \Illuminate\Support\Collection ? ($kelompok->first()->id_kelompok ?? '') : $kelompok->id_kelompok }}">

            <input type="hidden" name="id_struktur" id="id_struktur">
            <input type="hidden" name="_method" id="_method" value="POST">

            <div class="mb-2 sm:mb-3">
                <label for="jabatan" class="block">Jabatan</label>
                <select id="jabatan" name="jabatan" class="w-full border rounded p-1 sm:p-2" required oninvalid="this.setCustomValidity('Silakan pilih jabatan terlebih dahulu , karena field ini wajib diisi.')" oninput="this.setCustomValidity('')">
                    @php
                        $jabatanList = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota'];
                        $usedJabatan = \App\Models\StrukturOrganisasi::where('id_kelompok', $kelompok->id_kelompok)
                                        ->pluck('jabatan')
                                        ->toArray();
                    @endphp

                    @foreach($jabatanList as $j)
                        @if(($j === 'Ketua' || $j === 'Wakil Ketua') && in_array($j, $usedJabatan))
                            @continue
                        @endif
                        <option value="{{ $j }}">{{ $j }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2 sm:mb-3">
                <label class="block">Nama</label>
                <input type="text" id="nama" name="nama" class="w-full border rounded p-1 sm:p-2" placeholder="Contoh : Putri"    required oninvalid="this.setCustomValidity('Silakan isi nama terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')">
            </div>

            <div class="mb-2 sm:mb-3">
                <label for="id_rentan" class="block">Kelompok Rentan</label>
                <select id="id_rentan" name="id_rentan" class="w-full border rounded p-1 sm:p-2" required oninvalid="this.setCustomValidity('Silakan pilih kelompok rentan terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')">
                    <option value="">-- Pilih Kelompok Rentan --</option>
                    @foreach($rentan as $r)
                        <option value="{{ $r->id_rentan }}">{{ $r->nama_rentan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-1 sm:space-x-2">
                <button type="button" onclick="closeStrukturForm()" class="px-2 py-1 sm:px-4 sm:py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-2 py-1 sm:px-4 sm:py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
<!-- Tambahkan ini di bawah semua script lain -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
/* Biar dropdown nggak ketutup modal */
#strukturModal,
#strukturModal .form-group,
#strukturModal .mb-4 {
  overflow: visible !important;
}

/* Atur tinggi maksimum scroll dropdown */
.select2-results__options {
  max-height: 150px !important;
  overflow-y: auto !important;
}

/* Pastikan muncul di atas modal */
.select2-container {
  z-index: 99999 !important;
}
</style>

<script>
$(document).ready(function() {
    // Dropdown Jabatan
    $('#jabatan').select2({
        placeholder: "-- Pilih Jabatan --",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#strukturModal')
    });

    // Dropdown Kelompok Rentan
    $('#id_rentan').select2({
        placeholder: "-- Pilih Kelompok Rentan --",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#strukturModal')
    });
});
</script>


      <!-- Form Modal Sejarah -->
         <div id="sejarahModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Edit Sejarah</h3>
                <button onclick="closeSejarahForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>
            <form id="sejarahForm" method="POST" action="{{ route('Admin_Kelompok.updateSejarah', $kelompok->id_kelompok) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="sejarahContent" class="form-label">Isi Sejarah</label>
                    <textarea id="sejarahContent" name="sejarah" class="form-textarea w-full border rounded p-2" required oninvalid="this.setCustomValidity('Silakan isi sejarah terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')">{{ $kelompok->sejarah ?? '' }}</textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeSejarahForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
          </div>
          <style>
/* ✅ Aturan khusus mobile */
@media (max-width: 640px) {
    #sejarahModal .bg-white {
        max-width: 90% !important;   /* biar nggak mepet */
        width: 260px !important;     /* ukuran kecil mirip modal struktur */
        padding: 12px !important;    /* padding lebih rapat */
    }

    #sejarahModal h3 {
        font-size: 14px !important;  /* judul lebih kecil */
    }

    #sejarahModal label {
        font-size: 12px !important;  /* label kecil */
    }

    #sejarahModal textarea {
        font-size: 12px !important;  
        padding: 4px 6px !important; /* lebih ringkas */
    }

    #sejarahModal button {
        font-size: 12px !important;
        padding: 4px 10px !important;
    }
}
</style>

   <!-- Form Modal SK Desa -->
    <div id="skDesaModal"
    data-existing-file="{{ $kelompok->sk_desa }}"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">
    <div class="bg-white rounded-lg p-4 w-11/12 max-w-md overflow-y-auto">


        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h3 id="skDesaModalTitle" class="text-xl font-semibold text-gray-800">
                Tambah SK Desa
            </h3>
            <button type="button"
                    onclick="closeSkDesaForm()"
                    class="text-gray-600 hover:text-gray-800 text-2xl"
                    aria-label="Close form">&times;</button>
        </div>
        <form id="skDesaForm"
              method="POST"

              action="{{ route('Admin_Kelompok.storeSkDesa', $kelompok->id_kelompok) }}"
              enctype="multipart/form-data" >

                @csrf
    @method('PUT')
            <input type="hidden" id="deleteSkDesa" name="delete_sk_desa" value="0">


            <input type="hidden" id="croppedSkFile" name="cropped_file">
            <input type="hidden" name="file_original_name" id="skFileOriginalName">
<input type="hidden" id="croppedSkFile" name="cropped_file">



            <!-- File -->
            <div class="form-group mb-4">
                <label for="skFile" class="form-label block mb-1 font-medium">
                    Pilih File
                </label>
                <input type="file"
                       id="file"
                       name="file"
                       class="form-input w-full border rounded px-3 py-2" required
                       accept="image/*,.pdf" required  oninvalid="this.setCustomValidity('Silakan pilih file terlebih dahulu, karena ini field ini wajib diisi.')"
    oninput="this.setCustomValidity('')"
                       >

                <!-- Tempat tampil nama file -->
                <div id="skFilePreview" class="mt-2 text-sm text-gray-600">
                    <p>Tidak ada file yang dipilih.</p>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end space-x-2">
                <button type="button"
                        onclick="closeSkDesaForm()"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<style>
/* ✅ Mobile style untuk modal */
@media (max-width: 640px) {
    /* Sejarah Modal */
    #sejarahModal .bg-white {
        max-width: 90% !important;
        width: 260px !important;
        padding: 12px !important;
    }
    #sejarahModal h3 { font-size: 14px !important; }
    #sejarahModal label { font-size: 12px !important; }
    #sejarahModal textarea {
        font-size: 12px !important;
        padding: 4px 6px !important;
    }
    #sejarahModal button {
        font-size: 12px !important;
        padding: 4px 10px !important;
    }
}
    /* ✅ Mobile style untuk modal */
@media (max-width: 640px) {
     #skDesaModal .bg-white {
      width: 85% !important;     /* biar nggak penuh */
      max-width: 340px !important; /* batas maksimal */
      margin: 0 auto !important;  /* biar center */
      padding: 14px !important;
  }
   #skDesaModal > div {
    width: 95% !important;        /* hampir penuh tapi masih ada jarak pinggir */
    max-width: 420px !important;  /* cukup lebar di layar hp */
    height: auto !important;      
    max-height: 85% !important;   /* kalau tinggi, bisa scroll */
    margin: 0 auto !important;    
    padding: 14px !important;
  }
    

    #skDesaModal h3 { font-size: 14px !important; }
    #skDesaModal label { font-size: 12px !important; }
    #skDesaModal input,
    #skDesaModal select {
        font-size: 12px !important;
        padding: 4px 6px !important;
    }
    #skDesaModal #skFilePreview {
        font-size: 11px !important;
    }
    #skDesaModal button {
        font-size: 12px !important;
        padding: 4px 10px !important;
    }
}
</style>

<style>
    
</style>









     <!-- Form Modal Kelompok Rentan -->
         <div id="rentanModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 modal">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 id="rentanModalTitle" class="text-xl font-semibold text-gray-800">Tambah Data Rentan</h3>
                <button onclick="closeRentanForm()" class="text-gray-600 hover:text-gray-800 text-2xl" aria-label="Close form">&times;</button>
            </div>

            <form id="rentanForm" method="POST" action="{{ route('Admin_Kelompok.kelompokRentan') }}">
                @csrfstore
                <div class="form-group mb-3">
                    <label for="nama_rentan" class="form-label">Nama Rentan</label>
                    <input type="text" id="nama_rentan" name="nama_rentan" class="form-input w-full border rounded p-2">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRentanForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
         </div>


<!-- MODAL STOK PRODUK -->
<div id="stokProdukModal" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">

  <!-- ✅ Versi kecil di mobile, tetap lebar di desktop -->
  <div class="bg-white rounded-lg p-3 w-11/12 max-w-[250px] text-xs 
              sm:p-6 sm:w-full sm:max-w-md sm:text-base 
              shadow-lg relative">
              
    <!-- 🔹 Tombol X di pojok kanan atas -->
    <button onclick="closeStokProdukForm()" 
            class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl font-bold"
            aria-label="Close modal">
      &times;
    </button>

    <h2 id="stokProdukModalTitle" 
        class="text-sm sm:text-lg font-bold mb-3 sm:mb-4">
      Edit Stok Produk
    </h2>

    <form id="stokProdukForm" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" id="produkId" name="id"> <!-- untuk passing id produk -->

      <div class="mb-2 sm:mb-3">
        <label for="namaProduk" class="block">Nama Produk</label>
        <input type="text" id="namaProduk" name="nama"
               class="w-full border rounded p-1 sm:p-2" readonly>
      </div>

      <!-- Stok dan Satuan sejajar -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 mb-2 sm:mb-3">
        
        <!-- Input Stok -->
        <div class="w-full sm:w-1/2">
          <label for="stokProduk" class="block">Stok</label>
          <input type="number" id="stokProduk" name="stok"
                 class="w-full border rounded p-1 sm:p-2" required>
        </div>

        <!-- Dropdown Satuan -->
        <div class="w-full sm:w-1/2 mt-2 sm:mt-0">
          <label for="satuanProduk" class="block">Satuan</label>
          <select id="satuanProduk" name="satuan"
                  class="select2-satuan w-full border rounded p-1 sm:p-2" required>
            <option value="">-- Pilih Satuan --</option>
            <option value="kg">Kg</option>
            <option value="gram">Gram</option>
            <option value="ons">Ons</option>
            <option value="liter">Liter</option>
            <option value="bungkus">Bungkus</option>
            <option value="pack">Pack</option>
            <option value="sachet">Sachet</option>
            <option value="buah">Buah</option>
            <option value="ikat">Ikat</option>
            <option value="butir">Butir</option>
            <option value="ekor">Ekor</option>
            <option value="potong">Potong</option>
            <option value="batang">Batang</option>
            <option value="pcs">Pcs</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end space-x-1 sm:space-x-2">
        <button type="button" onclick="closeStokProdukForm()"
                class="px-2 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
          Batal
        </button>
        <button type="submit"
                class="px-2 py-1 sm:px-4 sm:py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ✅ Inisialisasi Select2 -->
<script>
  $(document).ready(function() {
    $('.select2-satuan').select2({
      width: '100%',
      placeholder: '-- Pilih Satuan --',
      allowClear: true,
      dropdownParent: $('#stokProdukModal') // biar dropdown tetap di dalam modal
    });
  });
</script>

     

     <!-- Form Modal Produk -->

    <!--FORM MODAL KATALOG-->
    <!-- Modal Form Tambah Katalog -->
 <!-- Modal Form Tambah Katalog -->
<!-- Form Modal Katalog -->
  <div id="katalogModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">
    <!-- ✅ Versi kecil di mobile, tetap lebar di desktop -->
    <div class="bg-white rounded-lg p-3 w-11/12 max-w-[250px] text-xs 
                sm:p-6 sm:w-full sm:max-w-lg sm:text-base">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-3 sm:mb-4">
            <h3 id="katalogModalTitle" class="text-sm sm:text-xl font-semibold text-gray-800">
                Tambah Katalog
            </h3>
            <button type="button"
                    onclick="closeKatalogForm()"
                    class="text-gray-600 hover:text-gray-800 text-lg sm:text-2xl"
                    aria-label="Close form">&times;</button>
        </div>

        <form id="formKatalog"
              method="POST"
              action="{{ route('Admin_Kelompok.storeKatalog') }}"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="deleteExistingKatalog" id="deleteExistingKatalog" value="0">
            <input type="hidden" name="delete_katalog_file" id="deleteKatalogFile" value="0">
            <input type="hidden" name="id_kelompok" value="{{ $kelompok->id_kelompok ?? 2 }}">
            <input type="hidden" name="id_katalog" id="katalogIdHidden">

            <!-- File -->
            <div class="form-group mb-2 sm:mb-4">
                <label for="katalog" class="block mb-1 font-medium text-xs sm:text-sm">
                    Upload Katalog
                </label>
                <input type="file"
                       id="katalog"
                       name="katalog"
                       class="w-full border rounded px-2 py-1 sm:px-3 sm:py-2 text-xs sm:text-base"
                       accept="image/*,.pdf" required  oninvalid="this.setCustomValidity('Silakan pilih file terlebih dahulu, karena ini field ini wajib diisi.')"
    oninput="this.setCustomValidity('')">

                <!-- Tempat preview nama file -->
                <div id="katalogFilePreview" class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600">
                    <p>Tidak ada file yang dipilih.</p>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end space-x-1 sm:space-x-2">
                <button type="button"
                        onclick="closeKatalogForm()"
                        class="px-2 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-xs sm:text-base">
                    Batal
                </button>
                <button type="submit"
                        class="px-2 py-1 sm:px-4 sm:py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs sm:text-base">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>




        <!-- Modal Produk -->
   <!-- Modal Produk -->
   <div id="produkModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">
    <!-- ✅ Responsive modal: kecil di mobile, normal di desktop -->
     <div class="bg-white rounded-lg p-3 w-11/12 max-w-[250px] text-xs
            sm:p-6 sm:w-full sm:max-w-md sm:text-base 
            max-h-[50vh] overflow-y-auto">

        
        <div class="flex justify-between items-center mb-3 sm:mb-4">
            <h3 id="produkModalTitle" class="text-sm sm:text-xl font-semibold text-gray-800">Tambah Produk</h3>
            <button onclick="closeProdukForm()" class="text-gray-600 hover:text-gray-800 text-xl sm:text-2xl" aria-label="Close form">&times;</button>
        </div>

        <form id="produkForm" action="{{ route('Admin_Kelompok.storeProduk', $kelompok->id_kelompok) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="removed_sertifikat" id="removedSertifikat" value="">
            <input type="hidden" name="_method" id="produkMethod" value="POST">
            <input type="hidden" name="id_produk" id="id_produk">
            <input type="hidden" id="replacedSertifikat" name="replaced_sertifikat" value="[]">


            <div class="form-group mb-2 sm:mb-3">
                <label for="produkNama" class="form-label">Nama Produk</label>
                <input type="text" id="produkNama" name="nama" class="form-input p-1 sm:p-2" placeholder="Contoh : Kripik Pisang" required oninvalid="this.setCustomValidity('Silakan isi nama produk terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group mb-2 sm:mb-3">
                <label for="produkHarga" class="form-label">Harga</label>
                <input type="number" id="produkHarga" name="harga" class="form-input p-1 sm:p-2" placeholder="Contoh : 12000"  required oninvalid="this.setCustomValidity('Silakan isi harga terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')">
            </div>

            <!-- Stok dan Satuan dalam satu baris -->
<div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 mb-2 sm:mb-3">
  
  <!-- Input Stok -->
  <div class="w-full sm:w-1/2">
    <label for="produkStok" class="form-label block">Stok</label>
    <input 
      type="number" 
      id="produkStok" 
      name="stok" 
      class="form-input w-full p-1 sm:p-2"
      placeholder="Contoh : 23"  
      required 
      oninvalid="this.setCustomValidity('Silakan isi stok terlebih dahulu, karena field ini wajib diisi.')"
      oninput="this.setCustomValidity('')">
  </div>

  <!-- Dropdown Satuan -->
  <div class="w-full sm:w-1/2 mt-2 sm:mt-0">
    <label for="produkSatuan" class="form-label block">Satuan</label>
    <select 
      id="produkSatuan" 
      name="satuan"
      class="select2-satuan mt-1 block w-full border border-gray-300 rounded-lg p-2 
             focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm"
      required
      oninvalid="this.setCustomValidity('Silakan pilih satuan terlebih dahulu.')"
      oninput="this.setCustomValidity('')">
        <option value="">-- Pilih Satuan --</option>
        <option value="kg">Kg</option>
        <option value="gram">Gram</option>
        <option value="ons">Ons</option>
        <option value="liter">Liter</option>
        <option value="bungkus">Bungkus</option>
        <option value="pack">Pack</option>
        <option value="sachet">Sachet</option>
        <option value="buah">Buah</option>
        <option value="ikat">Ikat</option>
        <option value="butir">Butir</option>
        <option value="ekor">Ekor</option>
        <option value="potong">Potong</option>
        <option value="batang">Batang</option>
        <option value="pcs">Pcs</option>
    </select>
  </div>

</div>



  <div class="form-group mb-2 sm:mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-input p-1 sm:p-2" rows="3" placeholder="Contoh : Makanan ini terbuat dari"  required oninvalid="this.setCustomValidity('Silakan isi deskripsi terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')"></textarea>
            </div>

            <!-- Foto Produk -->
            <div class="form-group mb-3 sm:mb-4">
                <label for="produkGambar" class="form-label block mb-1 font-medium">Foto Produk</label>
              <input 
    type="file" 
    id="produkGambar" 
    name="foto" 
    class="form-input w-full border rounded px-2 py-1 sm:px-3 sm:py-2" 
    accept="image/*"
    oninvalid="this.setCustomValidity('Silakan pilih file terlebih dahulu, karena ini field ini wajib diisi.')"
    oninput="this.setCustomValidity('')">



                <input type="hidden" name="removed_foto" id="removedFoto" value="">

                <div id="produkGambarPreview" class="mt-2 text-xs sm:text-sm text-gray-600">
                    <p>Tidak ada file yang dipilih.</p>
                </div>
                <div id="existingFoto" class="mt-2 text-xs sm:text-sm text-gray-600"></div>
            </div>

            <!-- <div class="form-group mb-2 sm:mb-3">
                <label for="produk_terjual" class="form-label">Produk Terjual</label>
                <input 
                    type="text" 
                    id="produk_terjual" 
                    name="produk_terjual" 
                    class="form-input bg-gray-200 text-gray-700 cursor-not-allowed p-1 sm:p-2" 
                    value="0" 
                    disabled>
            </div> -->

          

            <!-- Sertifikat -->
            <!-- Sertifikat -->
<div class="form-group mb-3 sm:mb-4">
  <label for="sertifikat" class="form-label block mb-1 font-medium">Sertifikat</label>

  <!-- 🔹 File sertifikat lama (existing) -->
<!-- 🔹 File sertifikat lama (edit produk) -->
<div id="existingSertifikat" class="text-sm mt-1">
  @php
    $sertifikatPaths = (isset($produk) && !($produk instanceof \Illuminate\Support\Collection) && !empty($produk->sertifikat))
        ? explode(',', $produk->sertifikat)
        : [];
  @endphp

  @if (!empty($sertifikatPaths))
    @foreach ($sertifikatPaths as $index => $path)
      <div class="file-preview flex items-center gap-2 mb-1">
        <span class="text-blue-600 hover:underline cursor-pointer flex-1 break-all"
              onclick="window.open('{{ asset('storage/' . $path) }}', '_blank')">
          {{ basename($path) }}
        </span>
        <button type="button"
                class="file-remove text-red-500 hover:text-red-700"
                onclick="removeExistingSertifikat('{{ basename($path) }}')">✕</button>
      </div>
    @endforeach
  @endif
</div>



  <!-- 🔹 Input sertifikat baru -->
  <input 
      type="file" 
      id="sertifikat" 
      name="sertifikat[]" 
      class="form-input w-full border rounded px-2 py-1 sm:px-3 sm:py-2" 
      accept="image/*,.pdf" 
      multiple>

  <!-- 🔹 Preview sertifikat baru -->
  <div id="sertifikatPreview" class="mt-2 text-xs sm:text-sm text-gray-600">
      <p>Tidak ada file yang dipilih.</p>
  </div>
</div>


            <div class="flex justify-end space-x-1 sm:space-x-2">
               <button type="button" 
    class="px-2 py-1 sm:px-4 sm:py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
    onclick="resetProdukForm(); document.getElementById('produkGambar').removeAttribute('required'); document.getElementById('produkModal').classList.add('hidden');">
    Batal
</button>

                <button type="submit" class="px-2 py-1 sm:px-4 sm:py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@if(session('duplicate_produk'))
<script>
Swal.fire({
    icon: "warning",
    title: "Nama produk sudah terdaftar",
    confirmButtonText: "OK",
    confirmButtonColor: "#3085d6"
});
</script>
@endif


<script>
// 🔒 Batasi semua input angka agar cuma bisa isi 0-9 (tanpa e, +, -, . , ,)
document.addEventListener("DOMContentLoaded", function () {
    const numericSelectors = [
        "#produkHarga",
        "#produkStok",
        "#stokProduk",
        "#harga",
        "#produk_terjual_tahun"
    ];

    // Ambil semua input yang sesuai
    const numericInputs = document.querySelectorAll(numericSelectors.join(","));

    numericInputs.forEach(input => {
        // Blok huruf & simbol saat diketik
        input.addEventListener("keypress", function (e) {
            if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
            }
        });

        // Blok e, E, +, -, titik, koma, spasi saat diketik
        input.addEventListener("keydown", function (e) {
            const forbiddenKeys = ["e", "E", "+", "-", ".", ",", " "];
            if (forbiddenKeys.includes(e.key)) {
                e.preventDefault();
            }
        });

        // Bersihkan input kalau di-paste teks non-angka
        input.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, "");
        });
    });
});
</script>
<script>
$(document).ready(function() {
  // Inisialisasi Select2 cuma sekali
  $('.select2-satuan').select2({
    width: '100%',
    placeholder: '-- Pilih Satuan --',
    allowClear: true,
    dropdownParent: $('#produkModal') // biar dropdown-nya tetap di dalam modal
  });
});
</script>
<style>
/* 🔹 Samain tinggi dropdown biar proporsional */
.select2-container--default .select2-selection--single {
  height: 42px !important;
  border: 1px solid #d1d5db !important;
  border-radius: 0.375rem !important;
  padding: 6px 10px !important;
  font-size: 0.9rem !important;
}

/* 🔹 Teks pas di tengah */
.select2-selection__rendered {
  line-height: 32px !important;
}

/* 🔹 Panah dropdown sejajar */
.select2-selection__arrow {
  height: 40px !important;
}

/* 🔹 Perbesar ikon 'x' (clear button) biar seimbang */
.select2-selection__clear {
  font-size: 25px !important; /* 🔸 perbesar ukuran X */
  line-height: 1 !important;
  margin-right: 15px !important;
  color: #6b7280 !important; /* abu Tailwind: gray-500 */
  transition: color 0.2s ease;
}

.select2-selection__clear:hover {
  color: #ef4444 !important; /* 🔸 jadi merah pas hover */
}
</style>

<style>
    /* 🔹 Biar stok & satuan sejajar juga di mobile */
@media (max-width: 640px) { /* sm breakpoint */
  #produkModal .flex-col {
    flex-direction: row !important; /* ubah dari kolom ke baris */
    align-items: center !important;
    gap: 8px !important; /* kasih jarak dikit */
  }

  #produkModal .flex-col > div {
    width: 50% !important; /* biar dua-duanya pas 1 baris */
    margin-top: 0 !important; /* hilangin jarak atas */
  }

  /* Label biar rapih dan ga numpuk */
  #produkModal .flex-col label {
    display: block;
    margin-bottom: 4px;
    font-size: 0.8rem;
  }
}

@media (max-width: 640px) {
  /* 🔹 Kecilkan dropdown satuan dan ikon X biar pas sama input stok */
  .select2-container--default .select2-selection--single {
    height: 34px !important; /* lebih kecil dari default 38px */
    padding: 2px 6px !important;
    font-size: 0.8rem !important;
  }

  .select2-selection__rendered {
    line-height: 28px !important; /* biar teks tetap center */
  }

  .select2-selection__arrow {
    height: 30px !important;
    width: 24px !important; /* kecilin ikon panah */
  }

  .select2-selection__clear {
    font-size: 0.8rem !important; /* kecilin ikon X */
    line-height: 0 !important;
  }
}


</style>




    <!-- Form Modal Kegiatan -->
    <!-- Form Modal Kegiatan -->
  <!-- Form Modal Kegiatan -->
<div id="kegiatanModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">
    <!-- ✅ Responsive modal: kecil di mobile, normal di desktop -->
    <div class="bg-white rounded-lg p-3 w-11/12 max-w-[250px] text-xs 
                sm:p-6 sm:w-full sm:max-w-md sm:text-base 
                max-h-[50vh] overflow-y-auto shadow-lg relative"> <!-- ✅ tambah 'relative' & 'shadow' -->

        <!-- 🔹 Tombol X di pojok kanan atas -->
        <button onclick="closeKegiatanForm()" 
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl font-bold"
                aria-label="Close modal">
            &times;
        </button>
        <h2 id="kegiatanModalTitle" class="text-sm sm:text-lg font-bold mb-3 sm:mb-4">Tambah Kegiatan</h2>

        <form id="kegiatanForm" action="{{ route('Admin_Kelompok.storeKegiatan', ['id' => $kelompok->id_kelompok]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="kegiatanMethod" value="POST">

            <div class="mb-2 sm:mb-3">
                <label class="block text-xs sm:text-sm font-medium">Judul</label>
                <input type="text" name="judul" id="kegiatanJudul" class="border rounded w-full px-2 py-1 sm:px-3 sm:py-2" placeholder="Contoh : Menanam padi" required oninvalid="this.setCustomValidity('Silakan isi judul terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')">
            </div>

            <div class="mb-2 sm:mb-3">
                <label class="block text-xs sm:text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" id="kegiatanDeskripsi" class="border rounded w-full px-2 py-1 sm:px-3 sm:py-2" placeholder="Contoh : Kegiatan ini dilakukan" required oninvalid="this.setCustomValidity('Silakan isi deskripsi kegiatan terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')"></textarea>
            </div>

            <div class="mb-2 sm:mb-3">
                <label class="block text-xs sm:text-sm font-medium">Tanggal</label>
                <input type="date" name="tanggal" id="kegiatanTanggal" class="border rounded w-full px-2 py-1 sm:px-3 sm:py-2"required oninvalid="this.setCustomValidity('Silakan isi tanggal kegiatan terlebih dahulu, karena  field ini wajib diisi.')" oninput="this.setCustomValidity('')">
            </div>

              <!-- 🔹 Ubah input sumber_berita jadi textarea -->
            <div class="mb-2 sm:mb-3">
                <label class="block text-xs sm:text-sm font-medium">Sumber Berita</label>
                <textarea name="sumber_berita" id="kegiatanSumber" class="border rounded w-full px-2 py-1 sm:px-3 sm:py-2" rows="2" placeholder="Contoh: https://contohberita.com/artikel123"></textarea>
            </div>

            <!-- Foto dengan preview -->
            <input type="hidden" id="deleteKegiatanFile" name="deleteKegiatanFile" value="0">

            <div class="mb-2 sm:mb-3">
                <label class="block text-xs sm:text-sm font-medium">Foto</label>
                <input type="file" name="foto" id="kegiatanFoto" class="border rounded w-full px-2 py-1 sm:px-3 sm:py-2" accept="image/*" 
                  oninvalid="this.setCustomValidity('Silakan pilih file terlebih dahulu, karena ini field ini wajib diisi.')"
    oninput="this.setCustomValidity('')">
                <input type="hidden" id="croppedKegiatanFile" name="cropped_file">

                <div id="kegiatanFotoPreview" class="mt-2 text-xs sm:text-sm text-gray-600">
                    <p>Tidak ada file yang dipilih.</p>
                </div>
            </div>

            <div class="flex justify-end space-x-1 sm:space-x-2">
                <button type="button" onclick="closeKegiatanForm()" class="px-2 py-1 sm:px-4 sm:py-2 bg-gray-500 text-white rounded">Batal</button>
                <button type="submit" class="px-2 py-1 sm:px-4 sm:py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('kegiatanForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('kegiatanFoto');
    const deleteFlag = document.getElementById('deleteKegiatanFile').value;
    const existingFile = existingKegiatanFile;
    const newFile = fileInput.files.length > 0;

    // Kasus EDIT: file lama dihapus tapi tidak upload baru
    if (deleteFlag === "1" && !newFile) {
        e.preventDefault();
        fileInput.setCustomValidity('Silakan pilih file terlebih dahulu, karena field ini wajib diisi.');
        fileInput.reportValidity();
        return false;
    }

    // Reset validasi custom kalau semua aman
    fileInput.setCustomValidity('');
});
</script>

<!-- Modal Preview File Kegiatan -->





    <!-- Form Modal Inovasi -->
<!-- Form Modal Inovasi -->
<!-- Form Modal Inovasi -->
 <div id="inovasiModal"
    class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-[9999] pointer-events-auto">

    <!-- ✅ Responsive modal: kecil di mobile, normal di desktop -->
    <div class="bg-white rounded-lg p-3 w-11/12 max-w-[250px] text-xs 
                sm:p-6 sm:w-full sm:max-w-lg sm:text-base shadow-lg relative z-50 pointer-events-auto">

        <!-- Tombol X -->
        <button type="button" onclick="closeInovasiForm()"
            class="absolute top-1 right-3 text-gray-500 hover:text-gray-700 text-xl sm:text-2xl leading-none">
            &times;
        </button>

        <h2 id="inovasiModalTitle" class="text-sm sm:text-lg font-bold mb-3 sm:mb-4">Tambah Inovasi</h2>

        <form id="inovasiForm" method="POST" enctype="multipart/form-data"

              action="{{ route('Admin_Kelompok.storeInovasi', ['id' => $kelompok->id_kelompok]) }}">
            @csrf
            
            <input type="hidden" id="deleteInovasiFile" name="deleteInovasiFile" value="0">
            <input type="hidden" name="_method" id="inovasiMethod" value="POST">
            <input type="hidden" id="inovasiFileOriginalName" name="file_original_name">

          
            <!-- Input File + Preview -->
            <div class="mb-2 sm:mb-4">
                <label for="inovasiFile" class="block text-xs sm:text-sm font-medium">Pilih File</label>
                
                <input type="file" id="inovasiFile" name="foto" 
                       class="w-full border rounded px-2 py-1 sm:px-3 sm:py-2"
                       accept="image/*,.pdf" required  oninvalid="this.setCustomValidity('Silakan pilih file terlebih dahulu, karena ini field ini wajib diisi.')"
    oninput="this.setCustomValidity('')">
                <input type="hidden" id="croppedInovasiFile" name="cropped_file">

                <div id="inovasiFilePreview" class="mt-2 text-xs sm:text-sm text-gray-600">
                    <p>Tidak ada file yang dipilih.</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-1 sm:space-x-2">
                <button type="button" onclick="closeInovasiForm()"
                        class="px-2 py-1 sm:px-4 sm:py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Batal
                </button>
                <button type="submit"
                        class="px-2 py-1 sm:px-4 sm:py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("inovasiFile").addEventListener("change", function (e) {
    const file = e.target.files[0];
    const preview = document.getElementById("inovasiFilePreview");
    preview.innerHTML = "";

    if (!file) {
        preview.innerHTML = "<p>Tidak ada file yang dipilih.</p>";
        return;
    }

    const fileUrl = URL.createObjectURL(file);

    if (file.type.startsWith("image/")) {
        const img = document.createElement("img");
        img.src = fileUrl;
        img.className = "h-20 cursor-pointer border rounded shadow";
        img.onclick = () => openUniversalPreview(file);
        preview.appendChild(img);

    } else if (file.type === "application/pdf") {
        const link = document.createElement("a");
        link.href = "#";
        link.textContent = file.name;
        link.className = "text-blue-600 underline cursor-pointer";
        link.onclick = (ev) => { ev.preventDefault(); openUniversalPreview(file); };
        preview.appendChild(link);

    } else {
        preview.innerHTML = "<p class='text-red-500'>File tidak didukung.</p>";
    }
});
</script>


 


<style>

.file-preview {
    display: inline-flex;
    align-items: center;
    margin-top: 5px;
}

.file-name {
    color: #3b82f6;
    cursor: pointer;
    text-decoration: underline;
    margin-right: 5px;
}

.file-remove {
    color: #3b82f6; /* Sama dengan warna nama file */
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    line-height: 1;
    padding: 0;
    background: none;
    border: none;
    transition: color 0.2s ease;
}

.file-name:hover,
.file-remove:hover {
    color: #2563eb; /* Warna biru lebih gelap saat hover */
}
</style>

<!-- Modal Preview File Inovasi -->






            
<!-- Preview muncul di luar modal
<div id="previewContainer" class="hidden mt-4 text-center">
    <h3 class="text-md font-bold mb-2">Preview Gambar</h3>
    <img id="previewImage" class="w-60 mx-auto rounded border border-gray-300 shadow" />
</div> -->


<!--MODAL PRODUK TAHUNAN-->
<!-- Modal Produk Pertahun -->
 <!-- Modal Produk Pertahun -->
  <div id="produkTahunModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[9999] modal">
    <!-- ✅ Responsive modal: kecil di mobile, normal di desktop -->
        <div class="bg-white rounded-lg p-3 w-11/12 max-w-[220px] text-xs 
                sm:p-6 sm:w-full sm:max-w-md sm:text-base 
                max-h-[70vh] pb-10 relative"> <!-- ✅ tambahkan 'relative' di sini -->

        <!-- 🔹 Tombol X di pojok kanan atas -->
        <button onclick="closeProdukTahunForm()" 
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl font-bold"
                aria-label="Close form">
            &times;
        </button>

        
        <h2 id="produkTahunModalTitle" class="text-sm sm:text-xl font-bold mb-3 sm:mb-4">
            Tambah Produk Per Tahun
        </h2>

        <form id="produkTahunForm" method="POST" action="" >
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id_kelompok" id="id_kelompok" value="{{ $kelompok->id_kelompok }}">

             <!-- Nama Produk -->
<div class="form-group mb-2 sm:mb-3">
    <label for="id_produk" class="block">Nama Produk</label>
    <select name="id_produk" id="id_produk_select" 
            class="w-full border rounded p-1.5 sm:p-2 text-xs sm:text-sm" required oninvalid="this.setCustomValidity('Silakan pilih nama produk, karena ini field ini wajib diisi.')" oninput="this.setCustomValidity('')">
        <option value="">Pilih Produk</option>
        @foreach ($produk as $p)
            <option value="{{ $p->id_produk }}" data-nama="{{ $p->nama }}">
                {{ $p->nama }}
            </option>
        @endforeach
    </select>
</div>
     {{-- Tahun --}}
<div class="mb-4">
  <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
  <select id="tahun" name="tahun"
      class="select2-tahun mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('tahun') border-red-500 @enderror" required oninvalid="this.setCustomValidity('Silakan pilih  tahun terlebih dahulu, karena ini field ini wajib diisi.')" oninput="this.setCustomValidity('')">
      <option value="">-- Pilih Tahun --</option>
      @for ($i = 2016; $i <= 2030; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
      @endfor
  </select>
  @error('tahun')
  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>


             

            <!-- Harga -->
            <div class="form-group mb-2 sm:mb-3">
                <label for="harga" class="block">Harga</label>
                <input type="number" step="1" name="harga" id="harga" 
                       class="w-full border rounded p-1.5 sm:p-2 text-xs sm:text-sm" placeholder="Contoh : 12000" required  oninvalid="this.setCustomValidity('Silakan isi harganya terlebih dahulu, karena ini field ini wajib diisi.')"
    oninput="this.setCustomValidity('')">
            </div>

<!-- Produk Terjual + Satuan -->
<!-- Produk Terjual + Satuan -->
<div class="form-group mb-2 sm:mb-3">
  <div class="flex space-x-2">
    
    <!-- Produk Terjual -->
    <div class="w-[50%]">
      <label for="produk_terjual_tahun" class="block mb-1">Produk Terjual</label>
      <input type="number"
        step="1"
        min="0"
        name="produk_terjual"
        id="produk_terjual_tahun"
        class="w-full border rounded p-1.5 sm:p-2 text-xs sm:text-sm"
        placeholder="Contoh : 23"
        required
        oninvalid="this.setCustomValidity('Produk terjual minimal 0, tidak boleh negatif')"
        oninput="this.setCustomValidity('')">
    </div>

    <!-- Satuan -->
    <div class="w-[50%]">
      <label for="satuan_tahun" class="block mb-1">Satuan</label>
      <select name="satuan_tahun" id="satuan_tahun"
        class="select2-satuan w-full border rounded py-[2px] px-2 text-xs sm:text-sm"
        required>
        <option value="">-- Pilih Satuan --</option>
        <option value="Kg">Kg</option>
        <option value="Gram">Gram</option>
        <option value="Pcs">Pcs</option>
        <option value="Ikat">Ikat</option>
        <option value="Liter">Liter</option>
      </select>
    </div>

  </div>
</div>




            <!-- Tombol -->
            <div class="flex justify-end space-x-1 sm:space-x-2">
                <button type="button" onclick="closeProdukTahunForm()" 
                        class="px-2 sm:px-4 py-1.5 sm:py-2 bg-gray-300 rounded text-xs sm:text-sm">
                    Batal
                </button>
                <button type="submit" 
                        class="px-2 sm:px-4 py-1.5 sm:py-2 bg-blue-600 text-white rounded text-xs sm:text-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
/* Scrollable dropdown */
.select2-results__options {
  max-height: 150px !important;
  overflow-y: auto !important;
}

/* Biar dropdown gak ketutup modal */
.select2-container {
  z-index: 99999 !important;
}

/* Samain tinggi Select2 dengan input biasa */
.select2-container--default .select2-selection--single {
  height: 38px !important; /* desktop default */
  padding: 2px 8px !important;
  border-radius: 4px !important;
  border: 1px solid #d1d5db !important;
}

/* Tengahin teks biar pas */
.select2-selection__rendered {
  line-height: 28px !important;
  font-size: 0.875rem; /* text-sm */
}

/* Tengahin icon panah */
.select2-selection__arrow {
  height: 30px !important;
}

/* --- Tambahan untuk layar kecil (mobile) --- */
@media (max-width: 640px) {
  .select2-container--default .select2-selection--single {
    height: 29px !important; /* sedikit lebih kecil dari desktop */
    padding: 1px 6px !important;
  }

  .select2-selection__rendered {
    line-height: 24px !important;
    font-size: 0.75rem !important; /* text-xs */
  }

  .select2-selection__arrow {
    height: 26px !important;
  }
}



</style>
<script>
$(document).ready(function () {
    const $modal = $('#produkTahunModal');
    const $selectProduk = $('#id_produk_select');
    const $selectTahun = $('#tahun');

    // ✅ Simpan semua tahun awal (buat filter tetap jalan)
    const allYears = [...$selectTahun[0].options].map(opt => ({
        value: opt.value,
        text: opt.text
    }));

    // ✅ Dropdown produk (scrollable + Select2)
    $selectProduk.select2({
        placeholder: "-- Pilih Produk --",
        allowClear: true,
        dropdownParent: $modal,
        width: "100%"
    });

    // ✅ Dropdown tahun (scrollable + Select2)
    $selectTahun.select2({
        placeholder: "-- Pilih Tahun --",
        dropdownParent: $modal,
        width: "100%"
    });

    // ⚡ Tetap panggil filterTahunDropdown() pas produk berubah
    $selectProduk.on("change", function () {
        const idProduk = $(this).val();
        filterTahunDropdown(idProduk, null, allYears, $selectTahun[0]);
    });

    // ✅ Inisialisasi Select2 untuk dropdown satuan
    //    (dibuat sedikit delay biar modal kebuka dulu)
    setTimeout(() => {
        $('#satuan_tahun').select2({
            placeholder: "-- Pilih Satuan --",
            allowClear: true,
            dropdownParent: $modal,
            width: '100%'
        });
    }, 100);
});
</script>





 <!--PREVIEW TANPA WATERMARK, PAKE CROP ROTASI-->

  <!-- Modal Preview Universal -->
<div id="universalPreviewModal" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[99999]">

    <!-- 📱 Mobile kecil, 💻 Desktop 800x600 -->
    <div class="bg-white p-2 rounded-lg w-[90%] max-w-[320px] h-[70%] relative
                sm:p-4 sm:w-[800px] sm:h-[600px] sm:max-w-none">
        
        <!-- Tombol Close -->
        <button onclick="closeUniversalPreview()" 
                class="absolute top-1 right-1 sm:top-2 sm:right-2 
                       bg-red-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded">
            ✕
        </button>
        
        <!-- Konten -->
        <div class="w-full h-[85%] sm:h-[90%] flex items-center justify-center">
            <img id="universalPreviewImage" class="max-w-full max-h-full object-contain hidden" alt="Preview">
            <div id="universalPreviewPdf" class="w-full h-full overflow-y-auto hidden"></div>


        </div>
        
        <!-- Controls for Image -->
        <div id="universalPreviewControls" 
             class="mt-2 sm:mt-4 flex space-x-1 sm:space-x-2 justify-center hidden">
            <button onclick="rotateUniversalImage(-90)" class="bg-blue-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded hover:bg-blue-600">
                <i class="fas fa-rotate-left"></i>
            </button>
            <button onclick="rotateUniversalImage(90)" class="bg-blue-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded hover:bg-blue-600">
                <i class="fas fa-rotate-right"></i>
            </button>
            <button onclick="toggleUniversalCropper()" class="bg-green-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded hover:bg-green-600">
                <i class="fas fa-crop-alt"></i>
            </button>
        </div>

        <!-- Crop Controls -->
        <div id="universalCropperControls" 
             class="mt-2 sm:mt-4 flex space-x-1 sm:space-x-2 justify-center hidden">
            <button onclick="cancelUniversalCrop()" type="button" class="bg-gray-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded hover:bg-gray-600">
                <i class="fas fa-times"></i> Cancel
            </button>
            <button onclick="applyUniversalCrop()" type="button" class="bg-green-500 text-white px-2 py-1 sm:px-3 sm:py-1 rounded hover:bg-green-600">
                <i class="fas fa-crop-alt"></i> Crop
            </button>
        </div>
    </div>
</div>

<style>
        /* Pastikan modal preview memiliki z-index tertinggi */
        #universalPreviewModal {
            z-index: 9999999 !important;
        }
        
        /* Pastikan modal Edit Logo & Background tidak menutupi preview */
        .modal-overlay[x-show="open"] {
            z-index: 999999 !important;
        }
        
        /* Pastikan tombol close modal memiliki z-index tinggi */
        .modal-overlay button {
            z-index: 100000000 !important;
        }
        
        /* Perbaiki posisi modal saat terbuka */
        body.modal-open .modal-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 999999 !important;
        }
        
        /* Pastikan preview modal berada di atas semua elemen */
        .fixed.inset-0.bg-black.bg-opacity-50.flex.items-center.justify-center {
            z-index: 9999999 !important;
        }
        
        /* Perbaiki positioning untuk preview modal */
        .preview-modal {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 9999999 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js"></script>


<script>


async function renderPdfUniversal(url, containerId) {
    const container = document.getElementById(containerId);
    container.innerHTML = "<p class='text-gray-500'>Memuat PDF...</p>";

    try {
        const loadingTask = pdfjsLib.getDocument(url);
        const pdf = await loadingTask.promise;
        container.innerHTML = "";

        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const page = await pdf.getPage(pageNum);
            const viewport = page.getViewport({ scale: 1.0 });

            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");

            canvas.width = viewport.width;
            canvas.height = viewport.height;

            await page.render({ canvasContext: context, viewport }).promise;

            canvas.style.width = "100%";
            canvas.style.height = "auto";
            canvas.classList.add("mb-4", "shadow");

            container.appendChild(canvas);
        }
    } catch (err) {
        container.innerHTML = `<p class="text-red-500">Gagal memuat PDF: ${err.message}</p>`;
    }
}

    // Global state untuk universal cropping
let universalCropper = null;
let universalFile = null;
let universalRotatedUrl = null;
let universalOriginalUrl = null; // ✅ simpan url asli
let universalIsCropping = false;
let universalCallback = null;

// Fungsi universal untuk preview file
  
   // Perbaiki fungsi openUniversalPreview untuk menangani callback
        function openUniversalPreview(file, callback = null) {
            const modal = document.getElementById('universalPreviewModal');
            const img = document.getElementById('universalPreviewImage');
            const pdfContainer = document.getElementById('universalPreviewPdf');
            const controls = document.getElementById('universalPreviewControls');
            const cropperControls = document.getElementById('universalCropperControls');

            // Reset
            img.classList.add('hidden');
            pdfContainer.classList.add('hidden');
            controls.classList.add('hidden');
            cropperControls.classList.add('hidden');
            img.src = "";
            pdfContainer.innerHTML = "";

            // Simpan file & callback
            universalFile = file;
            universalCallback = callback;

            const fileUrl = URL.createObjectURL(file);
            universalOriginalUrl = fileUrl; // ✅ simpan url asli

            if (file.type.startsWith('image/')) {
                img.src = fileUrl;
                img.classList.remove('hidden');
                controls.classList.remove('hidden');
            } else if (file.type === 'application/pdf') {
                pdfContainer.classList.remove('hidden');
                renderPdfUniversal(fileUrl, "universalPreviewPdf");
            } else {
                alert('Preview hanya tersedia untuk gambar atau PDF.');
                if (callback) callback(null, null);
                return;
            }

            modal.classList.remove('hidden');
            
            // Simpan fungsi close asli
            const originalCloseFunction = closeUniversalPreview;
            
            // Override fungsi close untuk memanggil callback
            window.closeUniversalPreview = function() {
                // Panggil fungsi close asli
                originalCloseFunction();
                
                // Panggil callback jika ada
                if (callback) {
                    const blob = universalFile ? new Blob([universalFile], {type: universalFile.type}) : null;
                    callback(blob, universalFile);
                }
                
                // Kembalikan fungsi close asli
                window.closeUniversalPreview = originalCloseFunction;
            };
        }
 
function cancelUniversalCrop() {
    if (universalCropper) {
        universalCropper.destroy();
        universalCropper = null;
    }

    const img = document.getElementById('universalPreviewImage');
    // ✅ balik ke gambar asli kalau belum ada rotasi/crop
    img.src = universalRotatedUrl || universalOriginalUrl;

    document.getElementById('universalCropperControls').classList.add('hidden');
    document.getElementById('universalPreviewControls').classList.remove('hidden');
    universalIsCropping = false;
}



// Fungsi untuk menutup modal universal
function closeUniversalPreview() {
    const modal = document.getElementById('universalPreviewModal');
    modal.classList.add('hidden');
    
    // Reset
    document.getElementById('universalPreviewImage').src = '';
    document.getElementById('universalPreviewPdf').innerHTML = '';
    
    if (universalCropper) {
        universalCropper.destroy();
        universalCropper = null;
    }
    
    document.getElementById('universalPreviewControls').classList.add('hidden');
    document.getElementById('universalCropperControls').classList.add('hidden');
    
    universalFile = null;
    universalRotatedUrl = null;
    universalIsCropping = false;
    universalCallback = null;
}


// Fungsi universal untuk toggle cropper
function toggleUniversalCropper() {
    const img = document.getElementById('universalPreviewImage');
    const controls = document.getElementById('universalPreviewControls');
    const cropperControls = document.getElementById('universalCropperControls');
    
    if (!universalIsCropping) {
        universalIsCropping = true;
        controls.classList.add('hidden');
        cropperControls.classList.remove('hidden');
        
        if (universalCropper) {
            universalCropper.destroy();
        }
        
        universalCropper = new Cropper(img, {
            aspectRatio: NaN, // Bebas aspect ratio
            viewMode: 1,
            autoCropArea: 0.8,
            responsive: true,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: false,
        });
    } else {
        universalIsCropping = false;
        if (universalCropper) {
            universalCropper.destroy();
            universalCropper = null;
        }
        controls.classList.remove('hidden');
        cropperControls.classList.add('hidden');
    }
}
// Fungsi universal untuk rotasi
 function rotateUniversalImage(degree) {
    const img = document.getElementById('universalPreviewImage');

    if (universalCropper) {
        // Kalau lagi cropping, rotasi langsung di cropper
        universalCropper.rotate(degree);
        return;
    }

    // Ambil source dari rotatedUrl kalau ada, kalau tidak pakai img.src
    const tmpImg = new Image();
    tmpImg.src = universalRotatedUrl || img.src;

    tmpImg.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        if (degree % 180 !== 0) {
            canvas.width = tmpImg.height;
            canvas.height = tmpImg.width;
        } else {
            canvas.width = tmpImg.width;
            canvas.height = tmpImg.height;
        }

        ctx.translate(canvas.width / 2, canvas.height / 2);
        ctx.rotate((degree * Math.PI) / 180);
        ctx.drawImage(tmpImg, -tmpImg.width / 2, -tmpImg.height / 2);

        // 🔹 ROTASI — tetap transparan
canvas.toBlob((blob) => {
    universalFile = new File([blob], universalFile.name, { type: 'image/png' });
    universalRotatedUrl = URL.createObjectURL(blob);
    img.src = universalRotatedUrl;

    if (universalCallback) {
        universalCallback(blob, universalFile);
    }
}, 'image/png');

    };
}

// Fungsi universal untuk apply crop
function applyUniversalCrop() {
    if (universalCropper) {
        // 🔹 CROP — tetap transparan
universalCropper.getCroppedCanvas({
    maxWidth: 1920,
    maxHeight: 1080,
    imageSmoothingEnabled: true,
    imageSmoothingQuality: 'high',
}).toBlob((blob) => {
    universalFile = new File([blob], universalFile.name, { 
        type: 'image/png',
        lastModified: new Date().getTime()
    });
    universalRotatedUrl = URL.createObjectURL(blob);

    const img = document.getElementById('universalPreviewImage');
    img.src = universalRotatedUrl;

    if (universalCallback) {
        universalCallback(blob, universalFile);
    }

    closeUniversalPreview();
}, 'image/png', 1.0);
// Kualitas 90%
    }
}



</script>




 <script>
let logoFile = null;
let backgroundFile = null;

// Simpan kondisi awal (saat pertama kali modal dibuka)
let originalLogoPreview = "";
let originalBackgroundPreview = "";
// ✅ Tambahan (nyimpen file lama kayak versi SK Desa)
let existingLogoFile = null;
let existingBackgroundFile = null;

document.addEventListener("alpine:init", () => {
    Alpine.data('editLogoBgModal', () => ({
        open: false,
        closeModal() {
            this.open = false;

            // Reset kondisi form
            document.getElementById('deleteLogo').value = "0";
            document.getElementById('deleteBackground').value = "0";
            document.getElementById('logo').value = "";
            document.getElementById('background').value = "";

            // Balikkan preview ke data asli
            document.getElementById('logoFilePreview').innerHTML = `
                @if($kelompok->logo)
                    <div class="file-preview">
                         <span class="file-name cursor-pointer text-blue-600 underline" onclick="previewExistingLogo()">
    {{ $kelompok->logo }}
</span>

                        <span class="file-remove text-red-500 ml-2" onclick="removeExistingLogoFile()">✕</span>
                    </div>
                @else
                    <p>Tidak ada file yang dipilih.</p>
                @endif
            `;
            document.getElementById('bgFilePreview').innerHTML = `
                @if($kelompok->background)
                    <div class="file-preview">
                         <span class="file-name cursor-pointer text-blue-600 underline"
                  onclick="previewExistingBackground()">
                {{ $kelompok->background }}
            </span>
                        <span class="file-remove text-red-500 ml-2" onclick="removeExistingBackgroundFile()">✕</span>
                    </div>
                @else
                    <p>Tidak ada file yang dipilih.</p>
                @endif
            `;
        }
    }))
})

 document.getElementById("editLogoBgModal").addEventListener("show.bs.modal", function () {
    // ✅ Simpan kondisi awal file lama (kayak SK Desa)
    existingLogoFile = "{{ $kelompok->logo ?? '' }}";
    existingBackgroundFile = "{{ $kelompok->background ?? '' }}";

    // tampilkan preview dari file lama (kalau ada)
    updateLogoFilePreview();
    updateBgFilePreview();
});


// Reset kalau modal ditutup tanpa simpan
 document.getElementById("editLogoBgModal").addEventListener("hidden.bs.modal", function () {
    // reset flag dan input file
    document.getElementById("deleteLogo").value = "0";
    document.getElementById("deleteBackground").value = "0";
    document.getElementById("logo").value = "";
    document.getElementById("background").value = "";

    // reset variabel file baru
    logoFile = null;
    backgroundFile = null;

    // ✅ restore preview lama dari existing file (tanpa refresh)
    updateLogoFilePreview();
    updateBgFilePreview();
});






/* ================== LOGO ================== */
 function updateLogoFilePreview() {
    const preview = document.getElementById('logoFilePreview');

    if (logoFile) {
        preview.innerHTML = `
            <div class="file-preview">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      onclick="previewLogoFile(logoFile)">
                    ${logoFile.name}
                </span>
                <span class="file-remove cursor-pointer text-red-500 ml-2" onclick="removeLogoFile()">✕</span>
            </div>
        `;
    } else if (existingLogoFile) {
        // ✅ kalau belum hapus, tampilkan file lama
        preview.innerHTML = `
            <div class="file-preview">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      onclick="previewExistingLogo()">
                    ${existingLogoFile.split('/').pop()}
                </span>
                <span class="file-remove cursor-pointer text-red-500 ml-2"
                      onclick="removeExistingLogoFile()">✕</span>
            </div>
        `;
    } else {
        preview.innerHTML = `<p class="text-gray-500">Tidak ada logo dipilih.</p>`;
    }
}


function removeLogoFile() {
    // tandai untuk dihapus
    document.getElementById("deleteLogo").value = "1";
    // ubah tampilan preview
    const preview = document.getElementById("logoFilePreview");
    if (preview) preview.innerHTML = "<p>Logo akan dihapus setelah kamu klik Simpan.</p>";
}


function previewLogoFile(file, isRepreview = false) {
    if (!file) return;
    
    openUniversalPreview(file, (blob, processedFile) => {
         logoFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });
        const dt = new DataTransfer();
        dt.items.add(processedFile);
        document.getElementById('logo').files = dt.files;

        const reader = new FileReader();
        reader.onloadend = () => {
            document.getElementById('croppedLogo').value = reader.result;
        };
        reader.readAsDataURL(blob);

        // ✅ kalau user cuma re-preview, jangan update ulang DOM biar onclick gak ilang
        if (!isRepreview) updateLogoFilePreview();
    });
}


  // ✅ Versi fix — nggak nutup modal utama
 function previewExistingLogo() {
    const existingFileName = "{{ $kelompok->logo ?? '' }}";
    if (!existingFileName) return;

    fetch('/storage/' + existingFileName)
        .then(res => res.blob())
        .then(blob => {
            const file = new File([blob], existingFileName.split('/').pop(), { type: blob.type });
            
            openUniversalPreview(file, (processedBlob, processedFile) => {
                // ✅ simpan hasil crop/rotasi
               logoFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

                const dt = new DataTransfer();
                dt.items.add(processedFile);
                document.getElementById('logo').files = dt.files;

                // simpan base64 ke hidden input
                const reader = new FileReader();
                reader.onloadend = () => {
                    document.getElementById('croppedLogo').value = reader.result;
                };
                reader.readAsDataURL(processedBlob);

                updateLogoFilePreview();
            });
        });
}


/* ================== BACKGROUND ================== */
function updateBgFilePreview() {
    const preview = document.getElementById('bgFilePreview');

    if (backgroundFile) {
        preview.innerHTML = `
            <div class="file-preview">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      onclick="previewBgFile(backgroundFile)">
                    ${backgroundFile.name}
                </span>
                <span class="file-remove cursor-pointer text-red-500 ml-2" 
                      onclick="removeBackgroundFile()">✕</span>
            </div>
        `;
    } else {
        @if($kelompok->background)
            preview.innerHTML = `
                <div class="file-preview">
                    <span class="file-name text-blue-600 cursor-pointer hover:underline"
                          onclick="previewExistingBackground()">
                        {{ $kelompok->background }}
                    </span>
                    <span class="file-remove cursor-pointer text-red-500 ml-2" 
                          onclick="removeBackgroundFile()">✕</span>
                </div>
            `;
        @else
            preview.innerHTML = `<p class="text-gray-500">Tidak ada background dipilih.</p>`;
        @endif
    }
}

function removeBackgroundFile() {
    // tandai untuk dihapus
    document.getElementById("deleteBackground").value = "1";
    // ubah tampilan preview
    const preview = document.getElementById("bgFilePreview");
    if (preview) preview.innerHTML = "<p>Background akan dihapus setelah kamu klik Simpan.</p>";
}

function previewBgFile(file) {
    if (!file) return;
    openUniversalPreview(file, (blob, processedFile) => {
        backgroundFile = processedFile;
        const dt = new DataTransfer();
        dt.items.add(processedFile);
        document.getElementById('background').files = dt.files;

        const reader = new FileReader();
        reader.onloadend = () => {
            document.getElementById('croppedBackground').value = reader.result;
        };
        reader.readAsDataURL(blob);

        updateBgFilePreview();
    });
}

   function previewExistingBackground() {
    const existingFileName = "{{ $kelompok->background ?? '' }}";
    if (!existingFileName) return;

    fetch('/storage/' + existingFileName)
        .then(res => res.blob())
        .then(blob => {
            const file = new File([blob], existingFileName.split('/').pop(), { type: blob.type });
            
            openUniversalPreview(file, (processedBlob, processedFile) => {
                // ✅ simpan hasil crop/rotasi
                backgroundFile = processedFile;
                const dt = new DataTransfer();
                dt.items.add(processedFile);
                document.getElementById('background').files = dt.files;

                // simpan base64 ke hidden input
                const reader = new FileReader();
                reader.onloadend = () => {
                    document.getElementById('croppedBackground').value = reader.result;
                };
                reader.readAsDataURL(processedBlob);

                updateBgFilePreview();
            });
        });
}


/* ================== EVENT LISTENER ================== */
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('logo').addEventListener('change', e => {
        if (e.target.files && e.target.files[0]) {
            logoFile = e.target.files[0];
            updateLogoFilePreview();
        }
    });

    document.getElementById('background').addEventListener('change', e => {
        if (e.target.files && e.target.files[0]) {
            backgroundFile = e.target.files[0];
            updateBgFilePreview();
        }
    });
});

function removeLogoFile() {
    document.getElementById("deleteLogo").value = "1";

    // 🔽 Tambahan penting:
    document.getElementById("logo").value = ""; 
    logoFile = null;

    const preview = document.getElementById("logoFilePreview");
    if (preview) preview.innerHTML = "<p>Logo akan dihapus setelah kamu klik Simpan.</p>";
}

function removeBackgroundFile() {
    document.getElementById("deleteBackground").value = "1";

    // 🔽 Tambahan penting:
    document.getElementById("background").value = ""; 
    backgroundFile = null;

    const preview = document.getElementById("bgFilePreview");
    if (preview) preview.innerHTML = "<p>Background akan dihapus setelah kamu klik Simpan.</p>";
}

// ✅ Tambahan: hapus file lama tapi belum disimpan
function removeExistingLogoFile() {
    existingLogoFile = null;
    document.getElementById('deleteLogo').value = "1";
    document.getElementById('logo').value = '';
    document.getElementById('logoFilePreview').innerHTML =
        "<p class='text-red-500 italic'>Logo akan dihapus setelah disimpan.</p>";
}

function removeExistingBackgroundFile() {
    existingBackgroundFile = null;
    document.getElementById('deleteBackground').value = "1";
    document.getElementById('background').value = '';
    document.getElementById('bgFilePreview').innerHTML =
        "<p class='text-red-500 italic'>Background akan dihapus setelah disimpan.</p>";
}


</script>

<style>
    #previewModal {
  z-index: 999999999 !important;
  position: fixed !important;
  top: 0; left: 0; right: 0; bottom: 0;
}

</style>
 

   <script>
// ========================== SK DESA ==========================

// Variabel global
let existingSkFile = null;
let skFile = null;

// ======== Update preview file SK Desa ========
function updateSkFilePreview() {
    const preview = document.getElementById('skFilePreview');
    preview.innerHTML = '';

    if (skFile) {
        // File baru (hasil upload / crop / rotasi)
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      onclick="previewSkFile(skFile)">
                    ${skFile.name}
                </span>
                <button type="button" 
                        class="file-remove text-red-500 hover:text-red-700"
                        onclick="removeSkFile()">✕</button>
            </div>
        `;
    } else if (existingSkFile) {
        // File lama dari database
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      onclick="previewExistingSkFile()">
                    ${existingSkFile.split('/').pop()}
                </span>
                <button type="button" 
                        class="file-remove text-red-500 hover:text-red-700"
                        onclick="removeExistingSkFile()">✕</button>
            </div>
        `;
    } else {
        preview.innerHTML = '<p class="text-gray-500">Tidak ada file yang dipilih.</p>';
    }
}

// ======== Preview file baru (hasil pilih atau hasil edit) ========
function previewSkFile(file, isRepreview = false) {
    if (!file) return;

    openUniversalPreview(file, (blob, processedFile) => {
        // Simpan hasil crop/rotasi
        skFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

        // Sinkronkan input file
        const dt = new DataTransfer();
        dt.items.add(processedFile);
        document.getElementById('file').files = dt.files;

        // Simpan base64 ke hidden input (jika backend butuh)
        const reader = new FileReader();
        reader.onloadend = () => {
            document.getElementById('croppedSkFile').value = reader.result;
        };
        reader.readAsDataURL(blob);

        // Jangan update DOM kalau hanya re-preview
        if (!isRepreview) updateSkFilePreview();

        // Pastikan nama file bisa diklik lagi setelah crop/rotasi
        const preview = document.getElementById('skFilePreview');
        if (preview) {
            const fileNameEl = preview.querySelector('.file-name');
            if (fileNameEl) fileNameEl.onclick = () => previewSkFile(skFile, true);
        }
    });
}

// ======== Preview file SK Desa dari database ========
function previewExistingSkFile() {
    const modal = document.getElementById('skDesaModal');
    const existingFileName = modal.dataset.existingFile;
    if (!existingFileName) return;

    fetch('/storage/' + existingFileName)
        .then(response => response.blob())
        .then(blob => {
            const file = new File([blob], existingFileName.split('/').pop(), { type: blob.type });

            openUniversalPreview(file, (processedBlob, processedFile) => {
                skFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

                const dt = new DataTransfer();
                dt.items.add(processedFile);
                document.getElementById('file').files = dt.files;

                // Simpan base64 ke hidden input
                const reader = new FileReader();
                reader.onloadend = () => {
                    document.getElementById('croppedSkFile').value = reader.result;
                };
                reader.readAsDataURL(processedBlob);

                updateSkFilePreview();

                // Nama file tetap bisa diklik ulang
                const preview = document.getElementById('skFilePreview');
                if (preview) {
                    const fileNameEl = preview.querySelector('.file-name');
                    if (fileNameEl) fileNameEl.onclick = () => previewSkFile(skFile, true);
                }
            });
        })
        .catch(err => console.error("Gagal fetch file SK Desa:", err));
}

// ======== Hapus file SK Desa baru ========
function removeSkFile() {
    skFile = null;
    document.getElementById('file').value = '';
    document.getElementById('croppedSkFile').value = '';

    // Set flag hapus
    document.getElementById('deleteSkDesa').value = "1";

    // Update tampilan
    const preview = document.getElementById('skFilePreview');
    preview.innerHTML = "<p class='text-red-500 italic'>File akan dihapus setelah disimpan.</p>";
}

// ======== Hapus file SK Desa lama (dari DB) ========
function removeExistingSkFile() {
    existingSkFile = null;

    // Set hidden input trigger hapus
    const deleteInput = document.getElementById('deleteSkDesa');
    if (deleteInput) deleteInput.value = "1";

    // Reset file input
    document.getElementById('file').value = '';
    document.getElementById('croppedSkFile').value = '';

    const preview = document.getElementById('skFilePreview');
    preview.innerHTML = "<p class='text-red-500 italic'>File akan dihapus setelah disimpan.</p>";
}

// ======== Event listener input file ========
document.addEventListener('DOMContentLoaded', () => {
    const skInput = document.getElementById('file');
    if (skInput) {
        skInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                skFile = e.target.files[0];
                existingSkFile = null;

                const deleteInput = document.getElementById('deleteSkDesa');
                if (deleteInput) deleteInput.value = "0";

                updateSkFilePreview();
            }
        });
    }

    // Saat pertama kali buka modal, isi existing file kalau ada
    const modal = document.getElementById('skDesaModal');
    const existing = modal.dataset.existingFile;
    if (existing) {
        existingSkFile = existing;
        updateSkFilePreview();
    }
});
</script>



    <script>
    // ====================== PRODUK ======================
    // Variabel global
    let produkGambarFile = null;
    let produkSertifikatFiles = [];
    let existingProdukFile = null;
    let removedSertifikat = [];
    

    // 🔧 Update: fungsi updateProdukGambarPreview sekarang meniru perilaku katalog
    function updateProdukGambarPreview() {
        const preview = document.getElementById('produkGambarPreview');
        preview.innerHTML = ''; // bersihkan dulu

        if (produkGambarFile) {
            // Tampilkan file baru yang dipilih
            preview.innerHTML = `
                <div class="file-preview flex items-center gap-2">
                    <span class="file-name text-blue-600 cursor-pointer hover:underline" id="produkFileName">
                        ${produkGambarFile.name}
                    </span>
                    <button class="file-remove text-red-500 hover:text-red-700" 
                            onclick="removeProdukGambarFile()" 
                            title="Hapus file">✕</button>
                </div>
            `;

            // ✅ Tambah event listener agar bisa re-preview hasil crop/rotasi
            document.getElementById('produkFileName').addEventListener('click', () => {
                previewProdukGambarFile(produkGambarFile, true);
            });

        } else if (existingProdukFile) {
            const fileName = existingProdukFile.split('/').pop();
            preview.innerHTML = `
                <div class="file-preview flex items-center gap-2">
                    <span class="file-name text-blue-600 cursor-pointer hover:underline" id="produkFileName">
                        ${fileName}
                    </span>
                    <button class="file-remove text-red-500 hover:text-red-700"
                            onclick="removeExistingProdukFile()" 
                            title="Hapus file">✕</button>
                </div>
            `;

            // ✅ Tambah event listener untuk preview file lama dari URL
            document.getElementById('produkFileName').addEventListener('click', () => {
                previewProdukFileFromUrl(existingProdukFile, fileName);
            });

        } else {
            preview.innerHTML = '<p class="text-gray-500">Tidak ada file yang dipilih.</p>';
        }
    }

    // 🔧 Preview file dari URL (file lama)
    function previewProdukFileFromUrl(url, fileName) {
        fetch(url)
            .then(res => res.blob())
            .then(blob => {
                const file = new File([blob], fileName, { type: blob.type });
                openUniversalPreview(file, (processedBlob, processedFile) => {
                    saveProcessedProdukFoto(processedBlob, processedFile);
                });
            })
            .catch(err => console.error('Gagal fetch file produk:', err));
    }

    // 🔧 Simpan hasil crop/rotate untuk foto produk
    function saveProcessedProdukFoto(blob, processedFile) {
        produkGambarFile = new File([processedFile], processedFile.name, { type: processedFile.type });

        // Sinkronkan ke input file
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(produkGambarFile);
        document.getElementById('produkGambar').files = dataTransfer.files;

        // ✅ Update ulang preview supaya bisa diklik lagi
        updateProdukGambarPreview();
    }

    // 🔧 Fungsi preview gambar produk (baru & hasil edit)
    function previewProdukGambarFile(file, isRepreview = false) {
        if (!file) return;

        openUniversalPreview(file, (blob, processedFile) => {
            // Simpan hasil crop/rotasi
            produkGambarFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

            // Update input file agar sinkron
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(produkGambarFile);
            document.getElementById('produkGambar').files = dataTransfer.files;

            // ✅ Perbarui preview agar bisa diklik ulang
            updateProdukGambarPreview();
        });
    }

    // Fungsi untuk menghapus file produk
    function removeProdukGambarFile() {
        produkGambarFile = null;
        document.getElementById('produkGambar').value = '';
        document.getElementById('removedFoto').value = '1';
        updateProdukGambarPreview();
    }

    function removeExistingProdukFile() {
        existingProdukFile = null;
        document.getElementById('produkGambar').value = '';
        document.getElementById('removedFoto').value = '1';
        document.getElementById('produkGambarPreview').innerHTML =
            "<p class='text-red-500 italic'>File akan dihapus setelah disimpan.</p>";
    }
    function removeProdukGambarFile() {
    produkGambarFile = null;
    document.getElementById('produkGambar').value = '';
    document.getElementById('removedFoto').value = '1';
    updateProdukGambarPreview();

    // ✅ Tambahan baru: aktifkan kembali "required" kalau foto dihapus
    document.getElementById('produkGambar').setAttribute('required', true);
}

function removeExistingProdukFile() {
    existingProdukFile = null;
    document.getElementById('produkGambar').value = '';
    document.getElementById('removedFoto').value = '1';
    document.getElementById('produkGambarPreview').innerHTML =
        "<p class='text-red-500 italic'>File akan dihapus setelah disimpan.</p>";

    // ✅ Tambahan baru: aktifkan kembali "required" kalau file lama dihapus
    document.getElementById('produkGambar').setAttribute('required', true);
}


    // ====================== SERTIFIKAT ======================
// ====================== SERTIFIKAT ======================
function updateProdukSertifikatPreview() {
    const preview = document.getElementById('sertifikatPreview');
    preview.innerHTML = '';

    if (produkSertifikatFiles.length === 0) {
        preview.innerHTML = '<p class="text-gray-500">Tidak ada file yang dipilih.</p>';
        return;
    }

    produkSertifikatFiles.forEach((file, index) => {
        const div = document.createElement('div');
        div.className = 'file-preview flex items-center gap-2 mb-1'; // setiap file di baris baru
        div.dataset.index = index;

        div.innerHTML = `
            <span class="text-blue-600 hover:underline cursor-pointer" 
                  onclick="previewProdukSertifikatFile(${index})">
                ${index + 1}. ${file.name}
            </span>
            <button type="button" 
                    class="text-blue-700 hover:text-red-700"
                    onclick="removeProdukSertifikatFile(${index})">
                ✕
            </button>
        `;

        preview.appendChild(div);
    });
}





   // 🔧 Preview file sertifikat baru (atau hasil edit ulang)
function previewProdukSertifikatFile(index) {
    const file = produkSertifikatFiles[index];
    if (!file) return;

    openUniversalPreview(file, (blob, processedFile, actionType) => {
        if (actionType === 'cancel') return;

        // 🔁 Gantikan file lama di memori browser
        produkSertifikatFiles[index] = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });


        // sinkronkan input file
        const dataTransfer = new DataTransfer();
        produkSertifikatFiles.forEach(f => dataTransfer.items.add(f));
        document.getElementById('sertifikat').files = dataTransfer.files;

        // perbarui tampilan preview
       // setelah selesai edit
updateProdukSertifikatPreview();
setTimeout(() => updateProdukSertifikatPreview(), 0);

    });
}

    // 🔧 Preview sertifikat lama dari URL (PDF, JPG, PNG, dll)
  function previewExistingProdukSertifikat(url) {
    fetch(url)
        .then(res => res.blob())
        .then(blob => {
            const fileName = url.split('/').pop();
            const mime = blob.type || 'application/pdf';
            const file = new File([blob], fileName, { type: mime });

            openUniversalPreview(file, (processedBlob, processedFile, actionType) => {
                // 🟡 Tambahkan pemeriksaan ketat
                if (actionType === 'cancel' || !processedFile) return;

                // 🧹 HAPUS FILE LAMA HANYA JIKA ADA PERUBAHAN
                const existingContainer = document.getElementById("existingSertifikat");
                if (existingContainer) {
                    const item = Array.from(existingContainer.querySelectorAll(".file-preview"))
                        .find(el => el.textContent.includes(fileName));
                    if (item) item.remove();
                }

                // tandai file lama dihapus
                removedSertifikat.push(`sertifikat_produk/${fileName}`);
                document.getElementById("removedSertifikat").value = JSON.stringify(removedSertifikat);

                // simpan file hasil edit
                 // simpan file hasil edit TANPA DUPLIKAT
produkSertifikatFiles = produkSertifikatFiles.filter(f => f.name !== processedFile.name);
produkSertifikatFiles.push(processedFile);


                // update input file
                const dataTransfer = new DataTransfer();
                produkSertifikatFiles.forEach(f => dataTransfer.items.add(f));
                document.getElementById('sertifikat').files = dataTransfer.files;

                updateProdukSertifikatPreview();
            });
        })
        .catch(err => console.error('Gagal memuat file sertifikat lama:', err));
}




    // 🔧 Hapus file sertifikat baru (belum tersimpan)
function removeProdukSertifikatFile(index) {
    produkSertifikatFiles.splice(index, 1);

    const dataTransfer = new DataTransfer();
    produkSertifikatFiles.forEach(f => dataTransfer.items.add(f));
    document.getElementById('sertifikat').files = dataTransfer.files;

    updateProdukSertifikatPreview();
}
    function removeSertifikat(file) {
    removedSertifikat.push(file);

    const existingSertifikatContainer = document.getElementById("existingSertifikat");
    existingSertifikatContainer.querySelectorAll(".file-preview").forEach(item => {
        if (item.textContent.includes(file.split('/').pop())) {
            item.remove();
        }
    });

    let removedInput = document.getElementById("removedSertifikat");
    if (!removedInput) {
        removedInput = document.createElement("input");
        removedInput.type = "hidden";
        removedInput.id = "removedSertifikat";
        removedInput.name = "removedSertifikat";
        document.getElementById("produkForm").appendChild(removedInput);
    }

    removedInput.value = JSON.stringify(removedSertifikat);
}

    // ====================== EVENT LISTENER ======================
    document.addEventListener('DOMContentLoaded', () => {
        const produkGambarInput = document.getElementById('produkGambar');
        const produkSertifikatInput = document.getElementById('sertifikat');

        if (produkGambarInput) {
            produkGambarInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    produkGambarFile = e.target.files[0];
                    existingProdukFile = null;
                    document.getElementById('removedFoto').value = '';
                    updateProdukGambarPreview();
                }
            });
        }

        if (produkSertifikatInput) {
            produkSertifikatInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files.length > 0) {
                    const newFiles = Array.from(e.target.files);
                    produkSertifikatFiles = [...produkSertifikatFiles, ...newFiles];
                    const dataTransfer = new DataTransfer();
                    produkSertifikatFiles.forEach(f => dataTransfer.items.add(f));
                    produkSertifikatInput.files = dataTransfer.files;
                    updateProdukSertifikatPreview();
                }
            });
        }
    });
    </script>

    <script>
        function resetProdukForm() {
    const form = document.getElementById("produkForm");
    form.reset();

    // reset preview
    document.getElementById("produkGambarPreview").innerHTML = "<p>Tidak ada file yang dipilih.</p>";
    document.getElementById("sertifikatPreview").innerHTML = "<p>Tidak ada file yang dipilih.</p>";
    document.getElementById("existingFoto").innerHTML = "";
    document.getElementById("existingSertifikat").innerHTML = "";

    // reset hidden inputs
    document.getElementById("removedFoto").value = "";
    const removedSertifikatInput = document.getElementById("removedSertifikat");
    if (removedSertifikatInput) removedSertifikatInput.value = "";

    // reset variabel global
    produkGambarFile = null;
    produkSertifikatFiles = [];
    existingProdukFile = null;
    removedSertifikat = [];

    // reset atribut required
    const fileInput = document.getElementById("produkGambar");
    if (fileInput) fileInput.removeAttribute("required"); // ✅ tambahkan ini

    // hapus file input
    const produkGambarInput = document.getElementById("produkGambar");
    const produkSertifikatInput = document.getElementById("sertifikat");
    if (produkGambarInput) produkGambarInput.value = "";
    if (produkSertifikatInput) produkSertifikatInput.value = "";
}


    </script>

  


 <style>
/* 🌸=========================================
   STYLE UNTUK FITUR TAMBAH (Upload Baru)
   (#sertifikatPreview)
  ========================================= */

/* Link nama file */
#sertifikatPreview a {
  display: inline-block;
  margin-bottom: 0.5rem; /* jarak antar file */
  color: #2563eb;        /* biru seperti link */
  text-decoration: underline;
  cursor: pointer;
  white-space: normal;
  word-break: break-all;
}

/* Setiap item file di preview */
#sertifikatPreview .file-preview {
  display: flex;               /* sejajarkan teks dan tombol ✕ */
  align-items: center;
  justify-content: flex-start; /* biar X nempel setelah teks */
  gap: 6px;
  margin-bottom: 4px;
  flex-wrap: wrap;             /* jaga kalau nama file panjang */
}

/* Nama file di list tambah */
#sertifikatPreview .file-preview span {
  white-space: normal; /* bisa turun baris */
  word-break: break-all;
}

/* Tombol ✕ di list tambah */
#sertifikatPreview .file-remove {
  color: #2563eb;
  cursor: pointer;
  flex-shrink: 0;
  margin-top: 0;
}

/* Container utama tambah */
#sertifikatPreview {
  display: block; /* tiap file-preview pasti baris baru */
}










/* ✅ STYLE FITUR EDIT (disamakan dengan fitur tambah) */
#existingSertifikat {
  display: block; /* sama seperti fitur tambah */
}

/* Setiap item file di edit */
#existingSertifikat .file-preview {
  display: flex;               /* sejajarkan teks dan tombol ✕ */
  align-items: center;
  justify-content: flex-start; /* biar X nempel setelah teks */
  gap: 6px;
  margin-bottom: 4px;
  flex-wrap: wrap;             /* jaga kalau nama file panjang */
}

/* Nama file di list edit */
#existingSertifikat .file-preview span,
#existingSertifikat a {
  display: inline-block;
  margin-bottom: 0.5rem;       /* sama seperti di tambah */
  color: #2563eb;              /* biru seperti link */
  text-decoration: underline;
  cursor: pointer;
  white-space: normal;
  word-break: break-all;
}

/* Tombol ✕ di list edit */
#existingSertifikat .file-remove {
  color: #2563eb;
  cursor: pointer;
  flex-shrink: 0;
  margin-top: 0;
}

</style>


<script>
// ✅ Fungsi untuk menambahkan penomoran otomatis pada sertifikat lama
function reindexExistingSertifikat() {
    const existingItems = document.querySelectorAll('#existingSertifikat .file-preview span');
    existingItems.forEach((span, index) => {
        // Ambil nama file tanpa nomor sebelumnya
        const text = span.textContent.replace(/^\d+\.\s*/, '');
        span.textContent = `${index + 1}. ${text}`;
    });
}

// ✅ Jalankan saat halaman atau modal produk dibuka
document.addEventListener('DOMContentLoaded', () => {
    reindexExistingSertifikat();
});
</script>




 <script>
let kegiatanFile = null;
let existingKegiatanFile = null;

// ==================== UPDATE PREVIEW ====================
function updateKegiatanFilePreview() {
    const preview = document.getElementById('kegiatanFotoPreview');
    preview.innerHTML = '';

    if (kegiatanFile) {
        // ✅ File baru yang dipilih atau hasil edit (crop/rotate)
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      onclick="previewKegiatanFile(kegiatanFile)">
                    ${kegiatanFile.name}
                </span>
                <button type="button"
                        class="file-remove text-red-500 hover:text-red-700"
                        onclick="removeKegiatanFile()">✕</button>
            </div>
        `;
    } else if (existingKegiatanFile) {
        // ✅ File lama dari database
        const fileName = existingKegiatanFile.split('/').pop();
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      onclick="previewExistingKegiatanFile()">
                    ${fileName}
                </span>
                <button type="button"
                        class="file-remove text-red-500 hover:text-red-700"
                        onclick="removeExistingKegiatanFile()">✕</button>
            </div>
        `;
    } else {
        preview.innerHTML = '<p class="text-gray-500">Tidak ada file yang dipilih.</p>';
    }
}

// ==================== PREVIEW FILE BARU ====================
function previewKegiatanFile(file, isRepreview = false) {
    if (!file) return;

    openUniversalPreview(file, (blob, processedFile) => {
        // Simpan hasil crop/rotate ke variabel global
        kegiatanFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

        // Sinkronkan ke input file
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(processedFile);
        document.getElementById('kegiatanFoto').files = dataTransfer.files;

        // Simpan hasil crop ke input hidden (base64)
        const reader = new FileReader();
        reader.onloadend = function () {
            document.getElementById('croppedKegiatanFile').value = reader.result;
        };
        reader.readAsDataURL(blob);

        // ✅ Hanya update preview kalau bukan re-preview
        if (!isRepreview) updateKegiatanFilePreview();

        // ✅ Pastikan klik nama file tetap aktif setelah crop/rotate
        const preview = document.getElementById('kegiatanFotoPreview');
        if (preview) {
            const fileNameEl = preview.querySelector('.file-name');
            if (fileNameEl) fileNameEl.onclick = () => previewKegiatanFile(kegiatanFile, true);
        }
    });
}

// ==================== PREVIEW FILE LAMA ====================
function previewExistingKegiatanFile() {
    if (!existingKegiatanFile) return;

    fetch(`/storage/${existingKegiatanFile}`)
        .then(response => response.blob())
        .then(blob => {
            const file = new File([blob], existingKegiatanFile.split('/').pop(), { type: blob.type });

            openUniversalPreview(file, (processedBlob, processedFile) => {
                // Simpan hasil edit
                kegiatanFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(processedFile);
                document.getElementById('kegiatanFoto').files = dataTransfer.files;

                const reader = new FileReader();
                reader.onloadend = function() {
                    document.getElementById('croppedKegiatanFile').value = reader.result;
                };
                reader.readAsDataURL(processedBlob);

                updateKegiatanFilePreview();

                // ✅ Tambahkan ulang event klik agar bisa re-preview
                const preview = document.getElementById('kegiatanFotoPreview');
                if (preview) {
                    const fileNameEl = preview.querySelector('.file-name');
                    if (fileNameEl) fileNameEl.onclick = () => previewKegiatanFile(kegiatanFile, true);
                }
            });
        })
        .catch(err => console.error("Gagal fetch file:", err));
}

// ==================== REMOVE FILE ====================
function removeKegiatanFile() {
    kegiatanFile = null;
    document.getElementById('kegiatanFoto').value = '';
    document.getElementById('croppedKegiatanFile').value = '';
    document.getElementById('deleteKegiatanFile').value = "1";

    document.getElementById('kegiatanFotoPreview').innerHTML = 
        '<p class="text-red-500 italic">File akan dihapus setelah klik Simpan.</p>';
}

function removeExistingKegiatanFile() {
    existingKegiatanFile = null;
    document.getElementById('deleteKegiatanFile').value = "1";
    document.getElementById('kegiatanFotoPreview').innerHTML = 
        '<p class="text-red-500 italic">File akan dihapus setelah klik Simpan.</p>';
}

// ==================== EVENT LISTENER ====================
document.addEventListener('DOMContentLoaded', () => {
    const kegiatanFileInput = document.getElementById('kegiatanFoto');
    if (kegiatanFileInput) {
        kegiatanFileInput.addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                kegiatanFile = e.target.files[0];
                existingKegiatanFile = null;
                document.getElementById('deleteKegiatanFile').value = "0";
                updateKegiatanFilePreview();
            }
        });
    }
});
</script>

 <script>
let inovasiFile = null;
let existingInovasiFile = null; // ✅ untuk menyimpan file lama seperti existingKatalogFile

// =================== UPDATE PREVIEW FILE ===================
function updateInovasiFilePreview() {
    const preview = document.getElementById('inovasiFilePreview');
    preview.innerHTML = '';

    if (inovasiFile) {
        // ✅ File baru dipilih / hasil crop / rotasi (disimpan sementara)
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline" id="inovasiFileName">
                    ${inovasiFile.name}
                </span>
                <button type="button" class="file-remove text-red-500 ml-2 hover:text-red-700"
                        onclick="removeInovasiFile()">✕</button>
            </div>
        `;

        // ✅ tambahkan event listener agar bisa klik ulang untuk re-preview
        document.getElementById('inovasiFileName').addEventListener('click', function() {
            previewInovasiFile(inovasiFile, true);
        });

    } else if (existingInovasiFile) {
        // ✅ File lama dari database
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline" id="inovasiFileName">
                    ${existingInovasiFile.split('/').pop()}
                </span>
                <button type="button" class="file-remove text-red-500 ml-2 hover:text-red-700"
                        onclick="removeExistingInovasiFile()">✕</button>
            </div>
        `;

        document.getElementById('inovasiFileName').addEventListener('click', function() {
            previewExistingInovasiFile();
        });

    } else {
        preview.innerHTML = '<p class="text-gray-500">Tidak ada file yang dipilih.</p>';
    }
}

// =================== PREVIEW FILE BARU (HASIL CROP / ROTASI SEMENTARA) ===================
function previewInovasiFile(file, isRepreview = false) {
    if (!file) return;

    openUniversalPreview(file, (blob, processedFile) => {
        // ✅ Simpan hasil crop/rotasi ke variabel global (sementara)
        inovasiFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

        // ✅ Update input file supaya hasil crop ikut terkirim
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(processedFile);
        document.getElementById('inovasiFile').files = dataTransfer.files;

        // ✅ update preview agar bisa diklik ulang (lihat hasil edit)
        updateInovasiFilePreview();
    });
}

// =================== PREVIEW FILE LAMA (DARI DATABASE) ===================
function previewExistingInovasiFile() {
    const existingFileName = document.getElementById('inovasiModal').dataset.existingFile;
    if (!existingFileName) return;

    fetch('/storage/' + existingFileName)
        .then(response => response.blob())
        .then(blob => {
            const file = new File([blob], existingFileName.split('/').pop(), { type: blob.type });

            openUniversalPreview(file, (processedBlob, processedFile) => {
                // ✅ Simpan hasil edit sementara di variabel inovasiFile
                inovasiFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

                // ✅ Update input file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(processedFile);
                document.getElementById('inovasiFile').files = dataTransfer.files;

                // ✅ Update preview
                updateInovasiFilePreview();
            });
        })
        .catch(err => console.error("Gagal fetch file inovasi:", err));
}

// =================== HAPUS FILE BARU ===================
function removeInovasiFile() {
    inovasiFile = null;
    document.getElementById('inovasiFile').value = '';
    document.getElementById('deleteInovasiFile').value = "1";

    const preview = document.getElementById('inovasiFilePreview');
    preview.innerHTML = "<p class='text-red-500 italic'>File akan dihapus setelah klik Simpan.</p>";
}

// =================== HAPUS FILE LAMA DARI DB ===================
function removeExistingInovasiFile() {
    existingInovasiFile = null;

    let deleteInput = document.getElementById('deleteInovasiFile');
    if (!deleteInput) {
        deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = 'deleteInovasiFile';
        deleteInput.id = 'deleteInovasiFile';
        document.getElementById('inovasiForm').appendChild(deleteInput);
    }
    deleteInput.value = "1";

    document.getElementById('inovasiFile').value = '';

    const preview = document.getElementById('inovasiFilePreview');
    preview.innerHTML = "<p class='text-red-500 italic'>File akan dihapus setelah disimpan.</p>";
}

// =================== EVENT INPUT FILE ===================
document.addEventListener('DOMContentLoaded', () => {
    const inovasiInput = document.getElementById('inovasiFile');
    if (inovasiInput) {
        inovasiInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                inovasiFile = e.target.files[0];
                existingInovasiFile = null; // ✅ reset file lama karena pilih file baru
                document.getElementById('deleteInovasiFile').value = "0";
                updateInovasiFilePreview();
            }
        });
    }
});

</script>




<script>

// Fungsi untuk menghapus file yang dipilih
// function removeInovasiFile() {
//     // Reset file input
//     document.getElementById('inovasiFoto').value = '';
    
//     // Set flag hapus untuk controller
//     document.getElementById('deleteInovasiFile').value = "1";
    
//     // Update preview
//     const preview = document.getElementById('inovasiFilePreview');
//     preview.innerHTML = '<p class="text-sm text-gray-500">File akan dihapus setelah klik Simpan.</p>';
// }

// // Fungsi preview untuk inovasi
// function previewInovasiFile(file) {
//     if (!file) return;
    
//     inovasiFile = file;
//     openUniversalPreview(file, (blob, processedFile) => {
//         // Update file dengan hasil crop/rotasi
//         inovasiFile = processedFile;
        
//         // Update input file
//         const dataTransfer = new DataTransfer();
//         dataTransfer.items.add(processedFile);
//         document.getElementById('inovasiFoto').files = dataTransfer.files;
        
//         // Update preview nama file
//         updateInovasiFilePreview();
//     });
// }

// // Event listener untuk input file inovasi
// document.addEventListener('DOMContentLoaded', function() {
//     const inovasiFotoInput = document.getElementById('inovasiFoto');
//     if (inovasiFotoInput) {
//         inovasiFotoInput.addEventListener('change', function(e) {
//             const file = e.target.files[0];
//             if (file) {
//                 // Update preview
//                 const preview = document.getElementById('inovasiFilePreview');
//                 preview.innerHTML = `
//                     <div class="file-preview flex items-center justify-between bg-gray-50 p-2 rounded border">
//                         <span class="file-name text-blue-600 underline cursor-pointer">
//                             ${file.name}
//                         </span>
//                         <button type="button" class="text-red-500 hover:text-red-700" onclick="removeInovasiFile()">
//                             ✕
//                         </button>
//                     </div>
//                 `;
                
//                 // Reset delete flag
//                 document.getElementById('deleteInovasiFile').value = "0";
//             }
//         });
//     }
// });

// KATALOG
</script>


 <script>
// Variabel global untuk melacak file katalog
let existingKatalogFile = null;
let katalogFile = null;

// Modifikasi fungsi updateKatalogFilePreview - ikuti pola Inovasi
function updateKatalogFilePreview() {
    const preview = document.getElementById('katalogFilePreview');
    
    // Kosongkan preview terlebih dahulu
    preview.innerHTML = '';

    if (katalogFile) {
        // Tampilkan file baru yang dipilih
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      id="katalogFileName">
                    ${katalogFile.name}
                </span>
                <button type="button" 
                        class="file-remove text-red-500 hover:text-red-700"
                        onclick="removeKatalogFile()">✕</button>
            </div>
        `;
        
        // Tambah event listener setelah elemen dibuat
        document.getElementById('katalogFileName').addEventListener('click', function() {
            previewKatalogFile(katalogFile, true);
        });
        
    } else if (existingKatalogFile) {
        // Tampilkan file yang sudah ada di database
        preview.innerHTML = `
            <div class="file-preview flex items-center gap-2">
                <span class="file-name text-blue-600 cursor-pointer hover:underline"
                      id="katalogFileName">
                    ${existingKatalogFile.split('/').pop()}
                </span>
                <button type="button" 
                        class="file-remove text-red-500 hover:text-red-700"
                        onclick="removeExistingKatalogFile()">✕</button>
            </div>
        `;
        
        // Tambah event listener setelah elemen dibuat
        document.getElementById('katalogFileName').addEventListener('click', function() {
            previewExistingKatalogFile();
        });
        
    } else {
        // Tidak ada file
        preview.innerHTML = '<p class="text-gray-500">Tidak ada file yang dipilih.</p>';
    }
}

// Modifikasi fungsi openKatalogForm

// Fungsi untuk preview katalog dari DB
// ✅ Preview file katalog baru (dengan dukungan klik ulang setelah crop/rotasi)
function previewKatalogFile(file, isRepreview = false) {
    if (!file) return;

    openUniversalPreview(file, (blob, processedFile) => {
        // Simpan hasil crop/rotasi ke variabel global
        katalogFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

        // Update input file agar sinkron
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(processedFile);
        document.getElementById('katalog').files = dataTransfer.files;

        // ✅ Selalu update preview tapi dengan cara yang mempertahankan event listener
        updateKatalogFilePreview();
    });
}

// ✅ Preview file katalog dari database (mirip logo dan sk_desa)
function previewExistingKatalogFile() {
    const existingFileName = document.getElementById('katalogModal').dataset.existingFile;
    if (!existingFileName) return;

    fetch('/storage/' + existingFileName)
        .then(response => response.blob())
        .then(blob => {
            const file = new File([blob], existingFileName.split('/').pop(), { type: blob.type });

            openUniversalPreview(file, (processedBlob, processedFile) => {
                katalogFile = new File([processedFile], processedFile.name || file.name, { type: processedFile.type || file.type });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(processedFile);
                document.getElementById('katalog').files = dataTransfer.files;

                updateKatalogFilePreview();
            });
        })
        .catch(err => console.error("Gagal fetch file katalog:", err));
}

// Modifikasi fungsi removeKatalogFile
function removeKatalogFile() {
    // Reset file input
    document.getElementById('katalog').value = '';
    
    // Reset variabel file baru
    katalogFile = null;
    
    // Update preview
    updateKatalogFilePreview();
}

// Tambah fungsi removeExistingKatalogFile
function removeExistingKatalogFile() {
    existingKatalogFile = null;

    // set hidden input untuk trigger hapus row
    let deleteInput = document.getElementById('deleteExistingKatalog');
    if (!deleteInput) {
        deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = 'deleteExistingKatalog';
        deleteInput.id = 'deleteExistingKatalog';
        document.getElementById('formKatalog').appendChild(deleteInput);
    }
    deleteInput.value = "1";

    // reset file input
    document.getElementById('katalog').value = '';

    // tampilkan pesan kalau file akan dihapus
    const preview = document.getElementById('katalogFilePreview');
    preview.innerHTML = "<p class='text-red-500 italic'>File akan dihapus setelah disimpan.</p>";
}

// Modifikasi event listener untuk input file - Tambah logika hapus file lama
document.addEventListener('DOMContentLoaded', () => {
    const katalogInput = document.getElementById('katalog');
    if (katalogInput) {
        katalogInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                // Set file baru
                katalogFile = e.target.files[0];
                
                // Hapus file yang sudah ada karena ada file baru
                existingKatalogFile = null;
                
                // Reset flag hapus
                const deleteInput = document.getElementById('deleteExistingKatalog');
                if (deleteInput) deleteInput.value = "0";
                
                // Update preview
                updateKatalogFilePreview();
            }
        });
    }
});
</script>


<script>
//CLOSE ALL 

function closeInovasiForm() {
    document.getElementById('inovasiModal').classList.add('hidden');
    document.getElementById('inovasiForm').reset();
    
    // Reset file preview
    inovasiFile = null;
    updateInovasiFilePreview();
} 

function closeLogoBackgroundForm() {
    // Reset file
    logoFile = null;
    backgroundFile = null;
    updateLogoFilePreview();
    updateBgFilePreview();
    
    // Tutup modal (sesuaikan dengan cara Anda menutup modal)
    document.querySelector('[x-show="open"]').setAttribute('x-show', 'false');
}

function closeSkDesaForm() {
    // Reset file
    skFile = null;
    updateSkFilePreview();
    
    // Tutup modal
    document.getElementById('skDesaModal').classList.add('hidden');
}

function closeKatalogForm() {
    // Reset file
    katalogFile = null;
    updateKatalogFilePreview();
    
    // Tutup modal
    document.getElementById('katalogModal').classList.add('hidden');
}

function closeProdukForm() {
    // Reset file
    produkGambarFile = null;
    produkSertifikatFiles = [];
    updateProdukGambarPreview();
    updateProdukSertifikatPreview();
    
    // Tutup modal
    document.getElementById('produkModal').classList.add('hidden');
}

function closeKegiatanForm() {
    // Reset file
    kegiatanFile = null;
    updateKegiatanFilePreview();
    
    // Tutup modal
    document.getElementById('kegiatanModal').classList.add('hidden');
}

// document.addEventListener('DOMContentLoaded', () => {
//     // Logo dan Background
//     const logoInput = document.getElementById('logo');
//     const backgroundInput = document.getElementById('background');
    
//     if (logoInput) {
//         logoInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files[0]) {
//                 previewFile(e.target.files[0], 'croppedLogo');
//             }
//         });
//     }
    
//     if (backgroundInput) {
//         backgroundInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files[0]) {
//                 previewFile(e.target.files[0], 'croppedBackground');
//             }
//         });
//     }
    
//     // SK Desa
//     const skFileInput = document.getElementById('file');
//     if (skFileInput) {
//         skFileInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files[0]) {
//                 previewSkFile(e.target.files[0]);
//             }
//         });
//     }
    
//     // Produk - Foto Produk
//     const produkGambarInput = document.getElementById('produkGambar');
//     if (produkGambarInput) {
//         produkGambarInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files[0]) {
//                 previewProdukFile(e.target.files[0]);
//             }
//         });
//     }
    
//     // Produk - Sertifikat
//     const sertifikatInput = document.getElementById('sertifikat');
//     if (sertifikatInput) {
//         sertifikatInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files.length > 0) {
//                 // Handle multiple files
//                 const files = Array.from(e.target.files);
//                 files.forEach(file => {
//                     previewProdukFile(file);
//                 });
//             }
//         });
//     }
    
//     // Katalog
//     const katalogInput = document.getElementById('katalog');
//     if (katalogInput) {
//         katalogInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files[0]) {
//                 previewKatalog(e.target.files[0]);
//             }
//         });
//     }
    
//     // Kegiatan
//     const kegiatanFotoInput = document.getElementById('kegiatanFoto');
//     if (kegiatanFotoInput) {
//         kegiatanFotoInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files[0]) {
//                 previewKegiatanFile(e.target.files[0]);
//             }
//         });
//     }
    
//     // Inovasi
//     const inovasiFotoInput = document.getElementById('inovasiFoto');
//     if (inovasiFotoInput) {
//         inovasiFotoInput.addEventListener('change', function(e) {
//             if (e.target.files && e.target.files[0]) {
//                 previewInovasiFile(e.target.files[0]);
//             }
//         });
//     }
// });




 </script>












    <div class="mt-20">
        @include('footer')
    </div>


    <script>

   function openTab(tabId, tabType) {
    const tabClass = tabType === 'profile' ? 'profile-tab-content' : 'info-tab-content';
    const buttonClass = tabType === 'profile' ? 'profile-tab-button' : 'info-tab-button';
    const tabs = document.querySelectorAll(`.${tabClass}`);
    const buttons = document.querySelectorAll(`.${buttonClass}`);

    // 1. Sembunyikan semua konten tab
    tabs.forEach(tab => {
        tab.classList.add('hidden');
        tab.classList.remove('block');
    });

    // 2. Reset semua tombol
    buttons.forEach(button => {
        button.classList.remove('bg-[#0097D4]', 'text-white');
        button.classList.add('bg-gray-200', 'text-gray-700');

        // ✅ kalau profile: tetap pakai cara lama (onclick)
        if (tabType === 'profile') {
            if (button.getAttribute('onclick').includes(tabId)) {
                button.classList.add('bg-[#0097D4]', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-700');
            }
        }

        // ✅ kalau info: lebih aman pakai data-tab
        if (tabType === 'info') {
            if (button.dataset.tab === tabId) {
                button.classList.add('bg-[#0097D4]', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-700');
            }
        }
    });

    // 3. Tampilkan tab aktif
    const activeTab = document.getElementById(tabId);
    if (activeTab) {
        activeTab.classList.remove('hidden');
        activeTab.classList.add('block');
    }
}




document.addEventListener("DOMContentLoaded", function() {
    // default buka Produk
    openTab("produk", "info");
});



   function openPreview(src, title, type = 'image') {
    const modal = document.getElementById('previewModal');
    const previewImage = document.getElementById('previewImage');
    const previewPdf = document.getElementById('previewPdf');
    const previewTitle = document.getElementById('previewTitle');

    // Reset
    previewImage.classList.add('hidden');
    previewPdf.innerHTML = ''; // kosongkan dulu canvas lama
    previewPdf.classList.add('hidden');

    // Set title
    previewTitle.textContent = title;

    if (type === 'pdf') {
        previewPdf.classList.remove('hidden');

        // render pakai pdf.js
        renderPdfWithWatermark(src, 'previewPdf');
    } else {
        previewImage.classList.remove('hidden');
        previewImage.src = src;
    }

    // tampilkan modal
    modal.style.display = 'flex';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    modal.focus();
}



function closePreview() {
    const modal = document.getElementById('previewModal');
    const previewPdf = document.getElementById('previewPdf');
    const previewImage = document.getElementById('previewImage');

    // Reset semua konten
    previewPdf.src = '';
    previewImage.src = '';
  
    modal.style.display = 'none';
    modal.classList.add('hidden');
  
    // Hapus backdrop kalau ada
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) backdrop.remove();
  
    // Balikin scroll
    document.body.style.overflow = 'auto';
}


//Search
// ✅ fungsi helper biar perPage menyesuaikan layar
function getPerPage() {
    return window.innerWidth <= 768 ? 4 : 8;
}
let filteredProduk = null;
let filteredKegiatan = null;

// ================= KEGIATAN =================
 document.addEventListener('DOMContentLoaded', () => {
    // ================= KEGIATAN =================
    const kegiatanInput = document.getElementById('searchKegiatan');
    const kegiatanItems = document.querySelectorAll('#kegiatan-carousel .kegiatan-item');

  function filterKegiatan(keyword) {
    keyword = keyword.toLowerCase().trim();
    const allItems = Array.from(document.querySelectorAll('#kegiatan-carousel .kegiatan-item'));
    const emptyMessage = document.getElementById('kegiatan-empty'); // untuk hasil pencarian kosong
    const noDataMessage = document.getElementById('kegiatan-none'); // untuk database kosong
    let filtered = [];

    // kalau dari awal database-nya kosong, langsung keluar
    if (allItems.length === 0) {
        if (noDataMessage) noDataMessage.classList.remove('hidden');
        if (emptyMessage) emptyMessage.classList.add('hidden');
        return;
    }

    // filter berdasarkan keyword
    allItems.forEach(item => {
        let nama = item.dataset.nama.toLowerCase();
        if (nama.includes(keyword)) {
            item.style.display = "";
            filtered.push(item);
        } else {
            item.style.display = "none";
        }
    });

    // tampilkan pesan sesuai kondisi
    if (filtered.length === 0) {
        emptyMessage.classList.remove('hidden'); // hasil pencarian kosong
        noDataMessage.classList.add('hidden');
    } else {
        emptyMessage.classList.add('hidden');
        noDataMessage.classList.add('hidden');
    }
}


    if (kegiatanInput) {
        kegiatanInput.addEventListener('input', () => filterKegiatan(kegiatanInput.value));
    }

    // ================= PRODUK =================
    const desktopInput = document.getElementById('searchProduk');
    const mobileInput  = document.getElementById('searchProdukMobile');
    const produkItems = document.querySelectorAll('#produk-carousel .produk-item');


       
 function filterProduk(keyword) {
    keyword = keyword.toLowerCase().trim();
    const allItems = Array.from(document.querySelectorAll('#produk-carousel .produk-item'));
    const emptyMessage = document.getElementById('produk-empty');
    let filtered = [];

    allItems.forEach(item => {
        let nama = item.dataset.nama.toLowerCase();
        if (nama.includes(keyword)) {
            item.style.display = "";
            filtered.push(item);
        } else {
            item.style.display = "none";
        }
    });

    // tampilkan / sembunyikan pesan
    if (filtered.length === 0) {
        emptyMessage.classList.remove('hidden');
    } else {
        emptyMessage.classList.add('hidden');
    }

    // reset ke halaman pertama (kalau kamu pakai carousel)
    if (window.carousels && carousels['produk']) {
        carousels['produk'].current = 0;
        updateCarousel('produk');
    }
}
 



    // Sinkronkan input desktop & mobile
    function syncInput(src, dest) {
        dest.value = src.value;
        filterProduk(src.value);
    }

    if (desktopInput) {
        desktopInput.addEventListener('input', () => syncInput(desktopInput, mobileInput));
    }
    if (mobileInput) {
        mobileInput.addEventListener('input', () => syncInput(mobileInput, desktopInput));
    }

    // ================= CAROUSEL =================
    ['sk-desa', 'produk', 'kegiatan', 'inovasi', 'produk_pertahun']
        .forEach(section => initializeCarousel(section));
});


// === Fungsi atur halaman kegiatan ===
function showKegiatanPage(visibleItems, page) {
    let perPage = getPerPage();
    let start = (page - 1) * perPage;
    let end = start + perPage;

    visibleItems.forEach((item, index) => {
        item.style.display = (index >= start && index < end) ? "block" : "none";
    });
}



// ================= PRODUK =================
// document.addEventListener('DOMContentLoaded', () => {
//     // Inisialisasi carousel
//     ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => initializeCarousel(section));

//     const desktopInput = document.getElementById('searchProduk');
//     const mobileInput  = document.getElementById('searchProdukMobile');
//     const items = document.querySelectorAll('#produk-carousel .produk-item');

//     function filterProduk(keyword) {
//         let visibleItems = [];
//         keyword = keyword.toLowerCase().trim();

//         items.forEach(item => {
//             let nama = item.getAttribute('data-nama').toLowerCase();
//             if (keyword === '' || nama.includes(keyword)) {
//                 item.style.display = "block";
//                 visibleItems.push(item);
//             } else {
//                 item.style.display = "none";
//             }
//         });

//         // Reset pagination ke awal setelah filter
//         showProdukPage(visibleItems, 1);
//     }

//     // Sinkronkan input desktop & mobile
//     function syncInput(src, dest) {
//         dest.value = src.value;
//         filterProduk(src.value);
//     }

//     if (desktopInput) {
//         desktopInput.addEventListener('input', () => syncInput(desktopInput, mobileInput));
//     }
//     if (mobileInput) {
//         mobileInput.addEventListener('input', () => syncInput(mobileInput, desktopInput));
//     }

//     // ✅ atur ulang kalau resize (desktop <-> mobile)
//     window.addEventListener('resize', () => {
//         let visibleItems = Array.from(items).filter(item => item.style.display !== "none");
//         showProdukPage(visibleItems, 1);
//     });
// });

// === Fungsi atur halaman produk ===
function showProdukPage(visibleItems, page) {
    let perPage = getPerPage();
    let start = (page - 1) * perPage;
    let end = start + perPage;

    visibleItems.forEach((item, index) => {
        item.style.display = (index >= start && index < end) ? "block" : "none";
    });
}




      const carousels = {
    'sk-desa': { current: 0, itemsPerPage: 1 },
    'produk': { current: 0, itemsPerPage: window.innerWidth <= 768 ? 4 : 8 },
    'kegiatan': { current: 0, itemsPerPage: window.innerWidth <= 768 ? 4 : 8 },
    'inovasi': { current: 0, itemsPerPage: 1 },
    'produk_pertahun': { current: 0, itemsPerPage: 4 }
};

// ✅ Tambahin fungsi ini di sini
function getVisibleItems(section) {
    if (section === 'produk' && filteredProduk !== null) {
        return filteredProduk;
    }
    if (section === 'kegiatan' && filteredKegiatan !== null) {
        return filteredKegiatan;
    }
    return document.getElementById(`${section}-carousel`)?.children || [];
}

// Responsive: update itemsPerPage saat resize
window.addEventListener('resize', () => {
    carousels['produk'].itemsPerPage = window.innerWidth <= 768 ? 4 : 8;
    carousels['kegiatan'].itemsPerPage = window.innerWidth <= 768 ? 4 : 8;
    ['produk', 'kegiatan'].forEach(section => initializeCarousel(section));
});

// 🔹 Inisialisasi carousel
function initializeCarousel(section) {
    const carousel = document.getElementById(`${section}-carousel`);
    const dotsContainer = document.getElementById(`${section}-dots`);
    const navContainer = document.getElementById(`${section}-nav`);
    const items = carousel ? carousel.querySelectorAll(`.${section}-item`) : [];

    if (!items.length) return;

    const itemsPerPage = carousels[section].itemsPerPage;
    const pageCount = section === 'inovasi'
        ? items.length  // 1 item per page
        : Math.ceil(items.length / itemsPerPage);

    dotsContainer.innerHTML = '';

     if (items.length > itemsPerPage) {
    dotsContainer.classList.remove('hidden');
    if (navContainer) navContainer.classList.remove('hidden');
    renderPaginationNumbers(section);
} else {
    dotsContainer.classList.add('hidden');
    if (navContainer) navContainer.classList.add('hidden');
}


    // ✅ langsung update tampilan
    updateCarousel(section);
}

// 🔹 Update tampilan item
   



// 🔹 Next & Prev
 function nextSlide(section) {
    const carousel = document.getElementById(`${section}-carousel`);
    const items = carousel?.children;
    if (!items) return;

    const itemsPerPage = carousels[section].itemsPerPage;
    const pageCount = section === 'inovasi' 
        ? items.length 
        : Math.ceil(items.length / itemsPerPage);

    if (carousels[section].current < pageCount - 1) {
        carousels[section].current++;
        updateCarousel(section);
    }
}

// 🔹 Update tampilan item
 function updateCarousel(section) {
    const carousel = document.getElementById(`${section}-carousel`);
    const items = getVisibleItems(section);
    if (!items || items.length === 0) return;

    // kalau ada filter, sembunyikan semua dulu
    // kalau ada filter atau section inovasi, sembunyikan semua dulu
if ((section === 'produk' && filteredProduk !== null) || 
    (section === 'kegiatan' && filteredKegiatan !== null) ||
    section === 'inovasi') {
    Array.from(carousel.children).forEach(el => el.classList.add('hidden'));
}
    // 🔹 Tampilkan pesan kalau kosong
    const emptyMessage = document.getElementById(`${section}-empty`);
    const visibleItems = Array.from(document.querySelectorAll(`#${section}-carousel .${section}-item`))
        .filter(i => i.style.display !== 'none');

    if (emptyMessage) {
        if (visibleItems.length === 0) {
            emptyMessage.classList.remove('hidden');
        } else {
            emptyMessage.classList.add('hidden');
        }
    }



    const itemsPerPage = carousels[section].itemsPerPage;
    let currentPage = carousels[section].current;

    // 🔹 Bedakan inovasi (1 item per halaman) dengan lainnya
    const pageCount = section === 'inovasi'
        ? items.length   // inovasi = total item
        : Math.ceil(items.length / itemsPerPage);

    if (currentPage >= pageCount && pageCount > 0) {
        currentPage = pageCount - 1;
        carousels[section].current = currentPage;
    }

    if (section === 'inovasi') {
    Array.from(items).forEach((item, i) => {
        item.classList.toggle('hidden', i !== currentPage);
    });
} else {
        // Produk/Kegiatan default
        Array.from(items).forEach((item, i) => {
            const isVisible = i >= currentPage * itemsPerPage &&
                             i < (currentPage + 1) * itemsPerPage;
            item.classList.toggle('hidden', !isVisible);
        });
    }

    renderPaginationNumbers(section);
}


// 🔹 Pagination numbers: bedakan inovasi juga
function renderPaginationNumbers(section) {
    const dotsContainer = document.getElementById(`${section}-dots`);
    const items = document.getElementById(`${section}-carousel`)?.children;
    if (!items) return;

    const itemsPerPage = carousels[section].itemsPerPage;

    // 🔹 inovasi selalu 1 item per halaman
    const pageCount = section === 'inovasi'
        ? items.length
        : Math.ceil(items.length / itemsPerPage);

    const currentPage = carousels[section].current;

    dotsContainer.innerHTML = ''; // reset

    if (pageCount <= 3) {
        for (let i = 0; i < pageCount; i++) {
            addPageButton(section, i, currentPage);
        }
    } else {
        const group = Math.floor(currentPage / 3);
        const start = group * 3;
        const end = Math.min(start + 3, pageCount);

        for (let i = start; i < end; i++) {
            addPageButton(section, i, currentPage);
        }

        if (end < pageCount) {
            dotsContainer.appendChild(makeEllipsis());
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    ['sk-desa', 'produk', 'kegiatan', 'inovasi', 'produk_pertahun']
        .forEach(section => initializeCarousel(section));

    // ✅ Tambahan khusus inovasi: biar langsung 1 item aja yang tampil
    updateCarousel('inovasi');
});

function prevSlide(section) {
    const carousel = document.getElementById(`${section}-carousel`);
    const items = carousel?.children;
    if (!items) return;

    const itemsPerPage = carousels[section].itemsPerPage;
    const pageCount = section === 'inovasi' 
        ? items.length 
        : Math.ceil(items.length / itemsPerPage);

    if (carousels[section].current > 0) {
        carousels[section].current--;
        updateCarousel(section);
    }
}



// 🔹 Keyboard navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closePreview();
        closeAllForms();
    }

    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
        ['sk-desa', 'produk', 'kegiatan', 'inovasi'].forEach(section => {
            const nav = document.getElementById(`${section}-nav`);
            if (nav && !nav.classList.contains('hidden')) {
                e.key === 'ArrowRight' ? nextSlide(section) : prevSlide(section);
            }
        });
    }
});

// 🔹 Accessibility: enter = click
document.querySelectorAll('.btn-outline').forEach(btn => {
    btn.setAttribute('tabindex', '0');
    btn.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') btn.click();
    });
});

// 🔹 Jalankan pas DOM siap
// document.addEventListener('DOMContentLoaded', () => {
//     ['sk-desa', 'produk', 'kegiatan', 'inovasi', 'produk_pertahun'].forEach(section =>
//         initializeCarousel(section)
//     );
// });


 
function addPageButton(section, index, currentPage) {
    const dotsContainer = document.getElementById(`${section}-dots`);
    const btn = document.createElement('button');
    btn.textContent = index + 1;
    btn.className = `px-2 ${index === currentPage ? 'text-blue-600 font-bold' : 'text-gray-600'}`;
    btn.addEventListener('click', () => {
        carousels[section].current = index;
        updateCarousel(section);
    });
    dotsContainer.appendChild(btn);
}

function makeEllipsis() {
    const span = document.createElement('span');
    span.textContent = '...';
    span.className = 'px-2 text-gray-400';
    return span;
}


document.addEventListener('DOMContentLoaded', function() {
    // ... kode yang sudah ada ...
    
    // Pastikan inovasi hanya menampilkan 1 item per halaman saat pertama kali load
    const inovasiItems = document.querySelectorAll('#inovasi-carousel .inovasi-item');
    if (inovasiItems.length > 0) {
        // Sembunyikan semua item kecuali yang pertama
        inovasiItems.forEach((item, index) => {
            if (index > 0) {
                item.classList.add('hidden');
            }
        });
        
        // Update pagination
        updateCarousel('inovasi');
    }
});


        // CRUD Functions for Struktur




 // ✅ Perbaikan agar data edit tetap muncul di dropdown Select2
 function editStruktur(button) {
    const id = button.getAttribute('data-id');
    const id_rentan = button.getAttribute('data-rentan');
    const jabatan = button.getAttribute('data-jabatan');
    const nama = button.getAttribute('data-nama');

    // panggil form edit dengan data langsung
    openStrukturForm(true, { jabatan, nama }, id, id_rentan);
}
 function openStrukturForm(editMode = false, data = null, id = null, id_rentan = null) {
    const modal = document.getElementById('strukturModal');
    const modalTitle = document.getElementById('strukturModalTitle');
    const form = document.getElementById('strukturForm');
    const methodInput = document.getElementById('_method');
    const jabatanSelect = document.getElementById('jabatan');
    const namaInput = document.getElementById('nama');
    const rentanSelect = document.getElementById('id_rentan');
        // 🧹 Reset semua validasi sebelum isi ulang form
    Array.from(form.querySelectorAll("input, select")).forEach(el => {
        el.setCustomValidity("");
        el.reportValidity();
    });
    

    // Reset dropdown jabatan
    jabatanSelect.innerHTML = '';
    
    // Tambahkan opsi default
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = '-- Pilih Jabatan --';
    jabatanSelect.appendChild(defaultOption);

    // Ambil data jabatan yang sudah digunakan dari tabel
    const usedJabatan = [];
    const rows = document.querySelectorAll('#struktur-tbody tr');
    
    rows.forEach(row => {
        const jabatanCell = row.querySelector('td:first-child');
        if (jabatanCell) {
            const jabatanText = jabatanCell.textContent.trim();
            // Jika mode edit dan jabatan ini sedang diedit, jangan masukkan ke usedJabatan
            if (!(editMode && data && data.jabatan === jabatanText)) {
                usedJabatan.push(jabatanText);
            }
        }
    });

    // Daftar semua jabatan
    const allJabatan = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota'];
    
    // Tambahkan opsi jabatan ke dropdown
    allJabatan.forEach(jabatan => {
        // Untuk Ketua dan Wakil Ketua, hanya tampilkan jika belum digunakan
        if ((jabatan === 'Ketua' || jabatan === 'Wakil Ketua') && usedJabatan.includes(jabatan)) {
            return; // Skip jabatan ini
        }
        
        const option = document.createElement('option');
        option.value = jabatan;
        option.textContent = jabatan;
        
        // Jika mode edit dan ini adalah jabatan yang sedang diedit
        if (editMode && data && data.jabatan === jabatan) {
            option.selected = true;
        }
        
        jabatanSelect.appendChild(option);
    });

    if (editMode && data) {
        modalTitle.textContent = 'Edit Anggota Struktur';
        
        // Isi field text
        namaInput.value = data.nama;
        rentanSelect.value = id_rentan ?? "";
        rentanSelect.dispatchEvent(new Event('change')); // Trigger untuk Select2

        // PERUBAHAN: Untuk jabatan Ketua atau Wakil Ketua, jangan disable apa-apa
        if (data.jabatan === 'Ketua' || data.jabatan === 'Wakil Ketua') {
            // Semua field dapat diedit
            jabatanSelect.disabled = false;
            namaInput.disabled = false;
            namaInput.removeAttribute('readonly');
            rentanSelect.disabled = false;
        } else {
            // Untuk jabatan lainnya, semua field juga dapat diedit
            jabatanSelect.disabled = false;
            namaInput.disabled = false;
            namaInput.removeAttribute('readonly');
            rentanSelect.disabled = false;
        }
        
        $('#id_struktur').val(id);
        form.action = "/Admin_Kelompok/update-struktur/" + id;
        methodInput.value = "PUT";
    } else {
        modalTitle.textContent = 'Tambah Anggota Struktur';
        form.reset();
        $('#id_struktur').val("");
        jabatanSelect.disabled = false; // Pastikan select jabatan aktif untuk mode tambah
        namaInput.disabled = false; // Pastikan field nama aktif
        namaInput.removeAttribute('readonly');
        rentanSelect.disabled = false; // Pastikan field rentan aktif
        $('#id_rentan').val('').trigger('change');
        form.action = "{{ route('Admin_Kelompok.struktur.store', $kelompok->id_kelompok) }}";
        methodInput.value = "POST";
    }

    // Refresh Select2
    $('#jabatan').select2('destroy');
    $('#jabatan').select2({
        placeholder: "-- Pilih Jabatan --",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#strukturModal')
    });

    modal.classList.remove('hidden');
     // 🧹 Bersihkan validasi setelah modal muncul
    setTimeout(() => {
        Array.from(form.querySelectorAll("input, select")).forEach(el => {
            el.setCustomValidity("");
            el.reportValidity();
        });
    }, 50);
}
// ✅ Fungsi Reset Form Struktur (sama konsep dengan produk)
function resetStrukturForm() {
    const form = document.getElementById("strukturForm");
    const jabatanSelect = document.getElementById("jabatan");
    const namaInput = document.getElementById("nama");
    const rentanSelect = document.getElementById("id_rentan");

    // Reset semua input
    form.reset();

    // Reset select2 dropdown
    $('#jabatan').val('').trigger('change');
    $('#id_rentan').val('').trigger('change');

    // Aktifkan semua field
    jabatanSelect.disabled = false;
    namaInput.disabled = false;
    rentanSelect.disabled = false;

    // Kembalikan ke mode tambah (POST)
    document.getElementById("_method").value = "POST";
    form.action = `/Admin_Kelompok/kelompok/{{ $kelompok->id_kelompok }}/storeStruktur`;

    // 🧹 Bersihkan status validasi
    Array.from(form.querySelectorAll("input, select")).forEach(el => {
        el.setCustomValidity("");
        el.reportValidity();
    });
}


// Perbaikan juga fungsi closeStrukturForm
function closeStrukturForm() {
     resetStrukturForm();
    const modal = document.getElementById('strukturModal');
    const jabatanSelect = document.getElementById('jabatan');
    const namaInput = document.getElementById('nama');
    const rentanSelect = document.getElementById('id_rentan');
    
    // Reset form dan aktifkan kembali semua field
    document.getElementById('strukturForm').reset();
    jabatanSelect.disabled = false;
    namaInput.disabled = false;
    namaInput.removeAttribute('readonly');
    rentanSelect.disabled = false;
    
    modal.classList.add('hidden');
}

function saveStruktur(event) {
    event.preventDefault();
    const form = event.target;
    const data = new FormData(form);

    fetch("{{ route('Admin_Kelompok.kelompok.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
        },
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert('Data berhasil disimpan!');
            location.reload(); // atau update tabel manual
        } else {
            alert('Gagal menyimpan data!');
        }
    })
    .catch(err => console.error(err));
}




function deleteStruktur(button) {
    if (!confirm("Yakin ingin menghapus data ini?")) return;

    const id = button.getAttribute('data-id');

    // bikin form DELETE dinamis
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/Admin_Kelompok/delete-struktur/' + id;

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';

    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';

    form.appendChild(csrf);
    form.appendChild(method);
    document.body.appendChild(form);

    form.submit();
}

  




        // CRUD Sejarah
         function openSejarahForm() {
    const modal = document.getElementById('sejarahModal');
    const contentEl = document.getElementById('sejarah-content');

    // gabungkan semua paragraf jadi string dengan newline
    let content = Array.from(contentEl.querySelectorAll('p'))
                       .map(p => p.textContent.trim())
                       .join("\n");

    document.getElementById('sejarahContent').value = content;
    modal.classList.remove('hidden');
}


        function closeSejarahForm() {
            document.getElementById('sejarahModal').classList.add('hidden');
        }

        function saveSejarah(event) {
            event.preventDefault();
            const content = document.getElementById('sejarahContent').value;
            document.getElementById('sejarah-content').textContent = content;
            closeSejarahForm();
            showNotification('Sejarah berhasil diperbarui!');
        }






        // CRUD Functions for SK Desa

function getKelompokIdFromUrl() {
    const parts = window.location.pathname.split('/').filter(Boolean);
    // Contoh URL: /Admin_Kelompok/kelompok/123
    const idx = parts.indexOf('kelompok');
    if (idx !== -1 && parts[idx + 1]) {
        return parts[idx + 1];
    }
    return null;
}



  function openSkDesaForm(editMode = false, element = null) {
    const modal = document.getElementById('skDesaModal');
    const modalTitle = document.getElementById('skDesaModalTitle');
    const form = document.getElementById('skDesaForm');
    const preview = document.getElementById('skFilePreview');
    const fileInput = document.getElementById('file'); 

    if (editMode) {
        modalTitle.textContent = 'Edit SK Desa';
        form.action = `/Admin_Kelompok/kelompok/${getKelompokIdFromUrl()}/sk-desa`;
        
        // tambahkan spoofing method PUT
        if (!form.querySelector('input[name="_method"]')) {
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
        }
        fileInput.removeAttribute('required');

        // Tampilkan file yang sudah ada di preview
        const existingFileName = modal.dataset.existingFile;
        if (existingFileName) {
            preview.innerHTML = `
                <div class="file-preview">
                    <span class="file-name" onclick="previewExistingSkFile()">${existingFileName}</span>
                    <button class="file-remove" onclick="removeSkFile()" title="Hapus file">✕</button>
                </div>
            `;
        } else {
            preview.innerHTML = '<p>Tidak ada file yang dipilih.</p>';
        }
    } else {
        modalTitle.textContent = 'Tambah SK Desa';
        form.action = `/Admin_Kelompok/kelompok/${getKelompokIdFromUrl()}/sk-desa`;
        
        // hapus spoofing method kalau ada
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();

        fileInput.setAttribute('required', true);
        // Reset preview untuk mode tambah
        preview.innerHTML = '<p>Tidak ada file yang dipilih.</p>';
    }

    modal.classList.remove('hidden');
}




function closeSkDesaForm() {
    document.getElementById('skDesaModal').classList.add('hidden');
}

function saveSkDesaForm(event) {
    event.preventDefault(); // cegah reload default

    console.log("Fungsi saveSkDesaForm dipanggil ✅");

    const judulInput = document.getElementById('skJudul');
    const fileInput = document.getElementById('skFile');

    const id = getKelompokIdFromUrl();
    if (!id) {
        alert('Gagal menemukan ID kelompok dari URL.');
        return;
    }

    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    formData.append('judul', judulInput.value);
    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
    }

    fetch(`/Admin_Kelompok/kelompok/${id}/sk-desa`, {
        method: 'POST',
        body: formData
    })
    .then(res => {
        if (res.ok) {
            location.reload();
        } else {
            alert('Gagal menyimpan SK Desa');
        }
    })
    .catch(err => console.error(err));
}


function editSkDesa(button) {
    openSkDesaForm(true, button);
}

function deleteSkDesa(button) {
    if (!confirm('Apakah Anda yakin ingin menghapus SK Desa ini?')) return;

    const skItem = button.closest('.sk-desa-item');
    const allItems = Array.from(document.querySelectorAll('#sk-desa-carousel .sk-desa-item'));
    const index = allItems.indexOf(skItem);

    const id = getKelompokIdFromUrl();
    if (index < 0 || !id) {
        alert('Tidak bisa menemukan item untuk dihapus.');
        return;
    }

    fetch(`/Admin_Kelompok/kelompok/${id}/sk-desa/${index}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: '_method=DELETE'
    })
    .then(res => {
        if (!res.ok) throw new Error("Gagal menghapus SK Desa");
        location.reload();
    })
    .catch(err => {
        console.error(err);
        alert('Gagal menghapus SK Desa. Periksa console.');
    });
}


        // CRUD Functions for Kelompok Rentan
 function openRentanForm(editMode = false, row = null) {
    const modal = document.getElementById('stokProdukModal');
    const form = document.getElementById('stokProdukForm');

    if (editMode && row) {
        const id = row.dataset.id;
        const nama = row.cells[0].textContent.trim();
        const stok = row.cells[1].textContent.replace(' pcs', '').trim();

        document.getElementById('produkId').value = id;
        document.getElementById('namaProduk').value = nama;
        document.getElementById('stokProduk').value = stok;

        // arahkan form ke route update
        form.action = `/Admin_Kelompok/produk/${id}`;
    }

    modal.classList.remove('hidden');
}

        function closeRentanForm() {
            document.getElementById('rentanModal').classList.add('hidden');
        }

        function saveRentan(event) {
            event.preventDefault();
            const form = event.target;
            const lansia = document.getElementById('lansia').value || '&nbsp;';
            const disabilitas = document.getElementById('disabilitas').value || '&nbsp;';
            const anakYatim = document.getElementById('anakYatim').value || '&nbsp;';
            const tbody = document.getElementById('rentan-tbody');

            if (form.dataset.editMode === 'true') {
                const rowIndex = form.dataset.rowIndex;
                const row = tbody.rows[rowIndex - 1];
                row.cells[0].textContent = lansia;
                row.cells[1].textContent = disabilitas;
                row.cells[2].textContent = anakYatim;
            } else {
                const newRow = tbody.insertRow();
                newRow.innerHTML = `
                    <td class="border border-gray-200 p-2">${lansia}</td>
                    <td class="border border-gray-200 p-2">${disabilitas}</td>
                    <td class="border border-gray-200 p-2">${anakYatim}</td>
                    <td class="border border-gray-200 p-2 text-center">
                        <button onclick="editRentan(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteRentan(this)" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            }

            closeRentanForm();
            showNotification('Data berhasil disimpan!');
        }

        function editRentan(button) {
            const row = button.closest('tr');
            openRentanForm(true, row);
        }

        function deleteRentan(button) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                const row = button.closest('tr');
                row.remove();
                showNotification('Data berhasil dihapus!');
            }
        }

        // CRUD Functions for Stok Produk
        // 
 function openStokProdukForm(editMode = false, row = null) {
  const modal = document.getElementById('stokProdukModal');
  const form = document.getElementById('stokProdukForm');
  const modalTitle = document.getElementById('stokProdukModalTitle');

  if (editMode && row) {
    const id = row.dataset.id;
    const nama = row.cells[0].textContent.trim();
    const stok = row.cells[1].textContent.replace(/[^0-9]/g, '').trim();
    const satuan = row.dataset.satuan || "";

    document.getElementById('produkId').value = id;
    document.getElementById('namaProduk').value = nama;
    document.getElementById('stokProduk').value = stok;

    const satuanSelect = document.getElementById('satuanProduk');
    satuanSelect.value = satuan;

    form.action = `/Admin_Kelompok/produk/${id}`;
    form.querySelector('input[name="_method"]').value = 'PUT';
    modalTitle.textContent = 'Edit Stok Produk';
  }

  modal.classList.remove('hidden');
    // Baru inisialisasi Select2 di sini
  $('.select2-satuan').select2({
    width: '100%',
    placeholder: '-- Pilih Satuan --',
    allowClear: true,
    dropdownParent: $('#stokProdukModal')
  });

}

function closeStokProdukForm() {
  document.getElementById('stokProdukModal').classList.add('hidden');
}

function editStokProduk(button) {
  const row = button.closest('tr');
  openStokProdukForm(true, row);
}

        // function saveStokProduk(event) {
        //     event.preventDefault();
        //     const form = event.target;
        //     const nama = document.getElementById('namaProduk').value;
        //     const total = document.getElementById('stokProduk').value;
        //     const tbody = document.getElementById('stok-produk-tbody');

        //     if (form.dataset.editMode === 'true') {
        //         const rowIndex = form.dataset.rowIndex;
        //         const row = tbody.rows[rowIndex - 1];
        //         row.cells[0].textContent = nama;
        //         row.cells[1].textContent = total + ' pcs';
        //     } else {
        //         const newRow = tbody.insertRow();
        //         newRow.innerHTML = `
        //             <td class="border border-gray-200 p-2">${nama}</td>
        //             <td class="border border-gray-200 p-2">${total} pcs</td>
        //             <td class="border border-gray-200 p-2 text-center">
        //                 <button onclick="editStokProduk(this)" class="text-blue-600 hover:text-blue-800 mr-2">
        //                     <i class="fas fa-edit"></i>
        //                 </button>
        //                 <button onclick="deleteStokProduk(this)" class="text-red-600 hover:text-red-800">
        //                     <i class="fas fa-trash"></i>
        //                 </button>
        //             </td>
        //         `;
        //     }

        //     closeStokProdukForm();
        //     showNotification('Data berhasil disimpan!');
 
        // function deleteStokProduk(button) {
        //     if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        //         const row = button.closest('tr');
        //         row.remove();
        //         showNotification('Data berhasil dihapus!');
        //     }
        // }


    //CRUD KATALOG 
    //CRUD KATALOG 
   // ✅ Buka modal Katalog (edit/tambah)


// Modifikasi fungsi openKatalogForm

function openKatalogForm(edit = false, id = null, existingFile = null, existingUrl = null, existingNama = null, existingDeskripsi = null) {
    const modal = document.getElementById('katalogModal');
    const form = document.getElementById('formKatalog');
    const title = document.getElementById('katalogModalTitle');
     const fileInput = document.getElementById('katalog'); 

    // Reset form dan file
    form.reset();
    katalogFile = null;
    existingKatalogFile = null;
    isEditMode = edit;

    if (edit && id) {
        title.textContent = 'Edit Katalog';
        form.action = `/Admin_Kelompok/update-katalog/${id}`;

        let methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
        }
          fileInput.removeAttribute('required');

        if (existingNama) {
            const namaInput = form.querySelector('[name="nama_katalog"]');
            if (namaInput) namaInput.value = existingNama;
        }
        if (existingDeskripsi) {
            const deskripsiInput = form.querySelector('[name="deskripsi_katalog"]');
            if (deskripsiInput) deskripsiInput.value = existingDeskripsi;
        }

        // Simpan file yang sudah ada
        existingKatalogFile = existingFile;
        
        // Simpan file yang sudah ada di dataset
        modal.dataset.existingFile = existingFile;
        
        // Tampilkan file yang sudah ada di preview
        updateKatalogFilePreview();
    } else {
        isEditMode = false;
        title.textContent = 'Tambah Katalog';
        form.action = "{{ route('Admin_Kelompok.storeKatalog') }}";

        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();
fileInput.setAttribute('required', true);

        // Hapus dataset file yang sudah ada
        delete modal.dataset.existingFile;
        
        // Tampilkan preview kosong
        updateKatalogFilePreview();
    }

    modal.classList.remove('hidden');
}


function closeKatalogForm() {
        document.getElementById('katalogModal').classList.add('hidden');
    }

    // Intercept submit form katalog untuk handling success/error (opsional, karena redirect back sudah handle)
    document.getElementById('formKatalog').addEventListener('submit', function(e) {
        // Bisa tambah loading state jika mau
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
    });
   
        // CRUD Functions for Produk



function openProdukForm(isEdit = false, button = null) {
    const form = document.getElementById("produkForm");
// 🧹 Hapus semua status validasi lama sebelum modal dibuka ulang
Array.from(form.querySelectorAll("input, textarea")).forEach(el => {
    el.setCustomValidity(""); // hapus custom error
    el.reportValidity(); // paksa browser reset status validasi
});



    // ✅ Tambahan baru: ambil elemen input file
const fileInput = document.getElementById("produkGambar");

// ✅ Tambahan baru: logika 'required' cuma aktif saat tambah produk
if (isEdit) {
    // kalau edit, tidak wajib upload foto baru
    fileInput.removeAttribute("required");
} else {
    // kalau tambah produk baru, wajib upload foto
    fileInput.setAttribute("required", true);
}

     reindexExistingSertifikat(); 

    // reset preview
    document.getElementById("produkGambarPreview").innerHTML = "<p>Tidak ada file yang dipilih.</p>";
    document.getElementById("sertifikatPreview").innerHTML = "<p>Tidak ada file yang dipilih.</p>";
    document.getElementById("existingFoto").innerHTML = "";
    document.getElementById("existingSertifikat").innerHTML = "";
    document.getElementById("removedFoto").value = "";

    produkGambarFile = null;
    produkSertifikatFiles = [];
    existingProdukFile = null;
    removedSertifikat = [];

    if (isEdit && button) {
        const id = button.getAttribute("data-id");
        const nama = button.getAttribute("data-nama");
        const harga = button.getAttribute("data-harga");
        const stok = button.getAttribute("data-stok");
           const satuan = button.getAttribute("data-satuan");
        const deskripsi = button.getAttribute("data-deskripsi");
        const foto = button.getAttribute("data-foto");

        // ✅ PARSING SERTIFIKAT LEBIH AMAN
        let sertifikatRaw = button.getAttribute("data-sertifikat") || "";
        let sertifikat = [];
        if (sertifikatRaw.trim()) {
            sertifikat = sertifikatRaw
                .replace(/^\[|\]$/g, "") // hapus [ dan ]
                .replace(/"/g, "")       // hapus semua tanda "
                .split(",")              // pisah berdasarkan koma
                .map(f => f.trim())      // hapus spasi
                .filter(f => f.length);  // pastikan tidak ada yang kosong
        }

        // isi field
        document.getElementById("id_produk").value = id;
        document.getElementById("produkNama").value = nama;
        document.getElementById("produkHarga").value = harga;
        document.getElementById("produkStok").value = stok;
        // ✅ Set value satuan dan update tampilan Select2
$('#produkSatuan').val(satuan).trigger('change');

        document.getElementById("deskripsi").value = deskripsi;

        // tampilkan foto lama
         // tampilkan foto lama
// tampilkan foto lama
// ✅ tampilkan foto lama dengan event klik untuk preview
if (foto) {
    const filePath = `/storage/${foto}`; // path lengkap
    existingProdukFile = filePath;       // simpan ke variabel global
    updateProdukGambarPreview();         // otomatis tampil + bisa diklik
}



// tampilkan sertifikat lama
// tampilkan sertifikat lama
// tampilkan sertifikat lama
if (sertifikat.length > 0) {
    const existingSertifikatContainer = document.getElementById("existingSertifikat");
    existingSertifikatContainer.innerHTML = "";

    sertifikat.forEach(file => {
        const fileName = file.split('/').pop();
        const filePath = `/storage/${file}`;

       existingSertifikatContainer.innerHTML += `
    <div class="file-preview">
        <span class="text-blue-600 hover:underline cursor-pointer"
              onclick="previewExistingProdukSertifikat('${filePath}')">
            ${fileName}
        </span>
        <button type="button"
                class="file-remove text-red-500 hover:text-red-700"
                onclick="removeSertifikat('${file}')">
            ✕
        </button>
    </div>
`;

    });

    // 🧠 Tambahkan baris ini agar numbering muncul
    reindexExistingSertifikat();
}


        form.action = `/Admin_Kelompok/kelompok/updateProduk/${id}`;
        document.getElementById("produkMethod").value = "PUT";
        document.getElementById("produkModalTitle").innerText = "Edit Produk";
    } else {
        form.reset();
        form.action = `/Admin_Kelompok/kelompok/{{ $kelompok->id_kelompok }}/storeProduk`;
        document.getElementById("produkMethod").value = "POST";
        document.getElementById("produkModalTitle").innerText = "Tambah Produk";
    }

    document.getElementById("produkModal").classList.remove("hidden");
    // 🧹 Bersihkan status validasi setelah modal muncul
setTimeout(() => {
    Array.from(form.querySelectorAll("input, textarea")).forEach(el => {
        el.setCustomValidity("");
        el.reportValidity();
    });
}, 50);
}



    function closeProdukForm() {
        resetProdukForm();
        document.getElementById("produkModal").classList.add("hidden");
    }

  function deleteProduk(button) {
    if (confirm("Yakin ingin menghapus produk ini?")) {
        const url = button.getAttribute("data-delete-url");
        const form = document.createElement("form");
        form.method = "POST";
        form.action = url;

        form.innerHTML = `
            @csrf
            <input type="hidden" name="_method" value="DELETE">
        `;

        document.body.appendChild(form);
        form.submit();
    }
}







        function saveProduk(event) {
            event.preventDefault();
            const form = event.target;
            const nama = document.getElementById('produkNama').value;
            const harga = document.getElementById('produkHarga').value;
            const stok = document.getElementById('produkStok').value;
            const produk_terjual = document.getElementById('produk_terjual').value;
            const carousel = document.getElementById('produk-carousel');

            if (form.dataset.editMode === 'true') {
                const elementId = form.dataset.elementId;
                const produkItem = document.getElementById(elementId) || document.querySelector(`[data-nama="${elementId}"]`);

                if (produkItem) {
                    produkItem.setAttribute('data-nama', nama);
                    produkItem.querySelector('h3').textContent = nama;
                    produkItem.querySelector('.text-green-600').textContent = `Rp. ${Number(harga).toLocaleString('id-ID')}`;
                    produkItem.querySelector('.text-black-500').textContent = `Stok: ${stok}`;
                }
            } else {
                const newId = 'produk-' + Date.now();
                const newProduk = document.createElement('div');
                newProduk.className = 'produk-item';
                newProduk.id = newId;
                newProduk.setAttribute('data-nama', nama);
                newProduk.innerHTML = `
                    <a href="#" class="block no-underline">
                        <div class="border rounded-lg shadow-md p-3 w-[200px] min-h-[280px] mx-auto">

                            <img src="https://via.placeholder.com/200x160"
                                alt="${nama}"
                                class="w-full h-40 object-cover rounded-lg">
                           <h3 class="mt-3 font-semibold text-lg break-words whitespace-normal line-clamp-none">
  ${nama}
</h3>


                            <div class="flex items-center justify-between pb-2">
                                <p class="text-green-600 font-bold text-lg truncate">Rp. ${Number(harga).toLocaleString('id-ID')}</p>
                                <p class="text-black-500 text-sm truncate">Stok: ${stok}</p>
                            </div>
                            <div class="flex justify-between mt-2">
                                <button onclick="editProduk(this)" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="deleteProduk(this)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </a>
                `;
                carousel.appendChild(newProduk);
            }

            closeProdukForm();
            initializeCarousel('produk');
            showNotification('Produk berhasil disimpan!');
        }
function resetProdukForm() {
    const form = document.getElementById("produkForm");

    // 🔹 Reset semua input form ke keadaan awal
    form.reset();

    // 🔹 Kosongkan preview dan file lama
    document.getElementById("produkGambarPreview").innerHTML = "<p>Tidak ada file yang dipilih.</p>";
    document.getElementById("sertifikatPreview").innerHTML = "<p>Tidak ada file yang dipilih.</p>";
    document.getElementById("existingFoto").innerHTML = "";
    document.getElementById("existingSertifikat").innerHTML = "";

    // 🔹 Reset hidden input
    document.getElementById("removedFoto").value = "";
    document.getElementById("removedSertifikat").value = "[]";
    document.getElementById("replacedSertifikat").value = "[]";
    document.getElementById("id_produk").value = "";
    document.getElementById("produkMethod").value = "POST";

    // 🔹 Kembalikan action ke "store" (bukan update)
    form.action = `/Admin_Kelompok/kelompok/{{ $kelompok->id_kelompok }}/storeProduk`;

    // 🔹 Reset variabel global agar gak nyangkut dari edit sebelumnya
    produkGambarFile = null;
    produkSertifikatFiles = [];
    existingProdukFile = null;
    removedSertifikat = [];
    editedSertifikatCache = {};

    // 🔹 Tutup modal
    document.getElementById("produkModal").classList.add("hidden");

    // 🔹 Pastikan field foto kembali wajib diisi (karena ini mode tambah)
    const fileInput = document.getElementById("produkGambar");
    fileInput.setAttribute("required", true);
    // 🧹 Bersihkan status validasi saat form direset
Array.from(form.querySelectorAll("input, textarea")).forEach(el => {
    el.setCustomValidity("");
    el.reportValidity();
});

}

//  function editProduk(button) {
//     // ambil data dari tombol edit
//     const id = button.dataset.id;
//     const nama = button.dataset.nama;
//     const harga = button.dataset.harga;
//     const stok = button.dataset.stok;
//     const terjual = button.dataset.terjual;
//     const deskripsi = button.dataset.deskripsi;

//     // set judul modal jadi "Edit Produk"
//     document.getElementById('produkModalTitle').innerText = "Edit Produk";

//     // isi form dengan data lama
//     document.getElementById('produkNama').value = nama;
//     document.getElementById('produkHarga').value = harga;
//     document.getElementById('produkStok').value = stok;
//     document.getElementById('produk_terjual').value = terjual;
//     document.getElementById('deskripsi').value = deskripsi;

//     // atur form action ke update route
//     document.getElementById('produkForm').action = "/Admin_Kelompok/kelompok/updateProduk/" + id;

//     // tampilkan modal
//     document.getElementById('produkModal').classList.remove('hidden');
// }


 
// CRUD Functions for Kegiatan
 const kelompokId = {{ $kelompok->id_kelompok }}; // pastikan ini ada di controller (show)
    const baseKegiatanUrl = "{{ url('Admin_Kelompok/kegiatan') }}"; // => contoh: /Admin_Kelompok/kegiatan
 function openKegiatanForm(isEdit = false, id = null, judul = '', deskripsi = '', tanggal = '', sumber = '', filePath = '') {
    const modal = document.getElementById('kegiatanModal');
    const form = document.getElementById('kegiatanForm');
    const method = document.getElementById('kegiatanMethod');
    const title = document.getElementById('kegiatanModalTitle');
    const fileInput = document.getElementById('kegiatanFoto'); // ✅ Tambahan baru

      // 🧹 Bersihkan validasi dulu
    Array.from(form.querySelectorAll("input, textarea")).forEach(el => {
        el.setCustomValidity("");
        el.reportValidity();
    });

    // ✅ Tambahan baru: logika 'required' cuma aktif saat tambah produk
if (isEdit) {
    // kalau edit, tidak wajib upload foto baru
    fileInput.removeAttribute("required");
} else {
    // kalau tambah produk baru, wajib upload foto
    fileInput.setAttribute("required", true);
}

    if (isEdit && id) {
        form.action = `${baseKegiatanUrl}/${id}`;
        method.value = "PUT";
        title.innerText = "Edit Kegiatan";

        document.getElementById('kegiatanJudul').value = judul;
        document.getElementById('kegiatanDeskripsi').value = deskripsi;
        document.getElementById('kegiatanTanggal').value = tanggal;
        document.getElementById('kegiatanSumber').value = sumber;

        // ✅ BAGIAN YANG DITAMBAHKAN & DIUBAH
        if (filePath && filePath.trim() !== "") {
            existingKegiatanFile = filePath; // Path lengkap dari database
            kegiatanFile = null;
            document.getElementById('deleteKegiatanFile').value = "0";
            updateKegiatanFilePreview();

            // 🔹 Nonaktifkan 'required' kalau file lama sudah ada
            fileInput.removeAttribute('required');
        } else {
            existingKegiatanFile = null;
            kegiatanFile = null;
            document.getElementById('deleteKegiatanFile').value = "0";
            document.getElementById('kegiatanFotoPreview').innerHTML = 
                '<p class="text-gray-500">Tidak ada file yang dipilih.</p>';

            // 🔹 Aktifkan 'required' kalau tidak ada file lama
            fileInput.setAttribute('required', true);
        }
        // ✅ SAMPAI SINI bagian yang diubah di dalam blok (isEdit)
    } else {
        // Mode tambah baru
        form.action = `${baseKegiatanUrl}/${kelompokId}`;
        method.value = "POST";
        title.innerText = "Tambah Kegiatan";
        form.reset();
        
        existingKegiatanFile = null;
        kegiatanFile = null;
        document.getElementById('deleteKegiatanFile').value = "0";
        updateKegiatanFilePreview();

        // ✅ Tambahan: wajib upload file di mode tambah
        fileInput.setAttribute('required', true);
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
       // Bersihkan validasi setelah modal tampil
    setTimeout(() => {
        Array.from(form.querySelectorAll("input, textarea")).forEach(el => {
            el.setCustomValidity("");
            el.reportValidity();
        });
    }, 50);
}

// ✅ Reset Form (sama kayak produk & struktur)
function resetKegiatanForm() {
    const form = document.getElementById('kegiatanForm');
    const fileInput = document.getElementById('kegiatanFoto');
    const preview = document.getElementById('kegiatanFotoPreview');
    const deleteInput = document.getElementById('deleteKegiatanFile');

    // Reset form HTML
    form.reset();

    // Reset variabel file
    kegiatanFile = null;
    existingKegiatanFile = null;

    // Reset hidden input
    deleteInput.value = "0";

    // Reset preview file
    preview.innerHTML = "<p class='text-gray-500'>Tidak ada file yang dipilih.</p>";

    // Kembalikan ke mode tambah (POST)
    document.getElementById('kegiatanMethod').value = "POST";
    const kelompokId = {{ $kelompok->id_kelompok }};
    form.action = `/Admin_Kelompok/kegiatan/${kelompokId}`;

    // Aktifkan kembali file input
    fileInput.removeAttribute("disabled");
    fileInput.setAttribute("required", true);

    // 🧹 Hapus validasi lama
    Array.from(form.querySelectorAll("input, textarea")).forEach(el => {
        el.setCustomValidity("");
        el.reportValidity();
    });
}

function closeKegiatanForm() {
     resetKegiatanForm();
    const modal = document.getElementById("kegiatanModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
}

function closeKegiatanForm() {
    document.getElementById('kegiatanModal').classList.add('hidden');
}

        function saveKegiatan(event) {
            event.preventDefault();
            const form = event.target;
            const judul = document.getElementById('kegiatanJudul').value;
            const deskripsi = document.getElementById('kegiatanDeskripsi').value;
            const tanggal = document.getElementById('kegiatanTanggal').value;
            const formattedDate = new Date(tanggal).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            const carousel = document.getElementById('kegiatan-carousel');

            if (form.dataset.editMode === 'true') {
                const elementId = form.dataset.elementId;
                const kegiatanItem = document.getElementById(elementId);

                if (kegiatanItem) {
                    kegiatanItem.querySelector('h3').textContent = judul;
                    kegiatanItem.querySelector('.line-clamp-3').textContent = deskripsi;
                    kegiatanItem.querySelector('.text-xs.opacity-75').textContent = formattedDate;
                }
            } else {
                const newId = 'kegiatan-' + Date.now();
                const newKegiatan = document.createElement('div');
                newKegiatan.className = 'kegiatan-item';
                newKegiatan.id = newId;
                newKegiatan.innerHTML = `
                    <a href="#" class="block no-underline">
                        <div class="bg-white text-black rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow w-[200px] min-h-[300px] mx-auto cursor-pointer">
                            <div class="h-40">
                                <img src="https://via.placeholder.com/200x160"
                                    alt="${judul}"
                                    class="w-full h-full object-cover rounded-t-lg"
                                    style="max-height: 160px;">
                            </div>
                            <div class="p-4 flex flex-col justify-between h-[180px]">
                                <div>
                                    <h3 class="font-bold text-sm mb-2 leading-tight line-clamp-2">${judul}</h3>
                                    <p class="text-xs opacity-75 mb-2 line-clamp-3">${deskripsi}</p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-xs opacity-75 truncate">${formattedDate}</p>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <button onclick="editKegiatan(this)" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button onclick="deleteKegiatan(this)" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
                carousel.appendChild(newKegiatan);
            }

            closeKegiatanForm();
            initializeCarousel('kegiatan');
            showNotification('Kegiatan berhasil disimpan!');
        }

        function editKegiatan(button) {
            openKegiatanForm(true, button);
        }

        function deleteKegiatan(button) {
            if (confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')) {
                const kegiatanItem = button.closest('.kegiatan-item');
                kegiatanItem.remove();
                initializeCarousel('kegiatan');
                showNotification('Kegiatan berhasil dihapus!');
            }
        }

        const KEL_ID = {{ $kelompok->id ?? 0 }};
         
        // CRUD Functions for Inovasi
        




// Fungsi untuk ambil file dari server dan buka preview universal
// async function fetchAndPreviewFile(path) {
//     try {
//         const response = await fetch('/storage/' + path);
//         const blob = await response.blob();

//         let file = new File([blob], path.split('/').pop(), { type: blob.type });

//         // Simpan nama file asli
//         document.getElementById('inovasiFileOriginalName').value = file.name;

//         openUniversalPreview(file, (processedBlob, processedFile) => {
//             file = processedFile;

//             // Update input file supaya ikut submit
//             const dt = new DataTransfer();
//             dt.items.add(processedFile);
//             document.getElementById('inovasiFileInput').files = dt.files;

//             // Simpan versi base64 (kalau mau dipakai di controller)
//             const reader = new FileReader();
//             reader.onloadend = function() {
//                 document.getElementById('croppedInovasiFile').value = reader.result;
//             };
//             reader.readAsDataURL(processedBlob);

//             // Update preview tampilan
//             const preview = document.getElementById('inovasiFilePreview');
//             preview.innerHTML = `
//                 <div class="flex items-center gap-2">
//                     <button type="button"
//                             class="text-blue-600 hover:underline"
//                             onclick="openUniversalPreview(file)">
//                         ${file.name}
//                     </button>
//                     <button type="button"
//                             class="text-blue-600 hover:text-red-600"
//                             onclick="removeInovasiFile()">
//                         ✕
//                     </button>
//                 </div>
//             `;
//         });
//     } catch (error) {
//         console.error("Gagal fetch file:", error);
//         alert("Gagal menampilkan preview file.");
//     }
// }


// =================== OPEN FORM INOVASI ===================
function openInovasiForm(idKelompok, editMode = false, id = null, filePath = '') {
    const modal = document.getElementById('inovasiModal');
    const form = document.getElementById('inovasiForm');
    const title = document.getElementById('inovasiModalTitle');
    const fileInput = document.getElementById('inovasiFile');


    inovasiFile = null;
    existingInovasiFile = null;
    document.getElementById('deleteInovasiFile').value = "0";

    if (editMode) {
    title.textContent = 'Edit Inovasi';
    form.action = `/Admin_Kelompok/inovasi/${id}`;

    let methodInput = form.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'PUT';

    // ✅ Tambahan baru: di mode edit file tidak wajib diisi
    fileInput.removeAttribute('required');

    if (filePath && filePath.trim() !== "") {
        // kalau ada file lama, simpan & tampilkan preview
        existingInovasiFile = filePath;
        modal.dataset.existingFile = filePath;
    } else {
        // kalau tidak ada file lama, tampilkan preview kosong
        delete modal.dataset.existingFile;
    }

    // panggil fungsi update preview (biar tampil sesuai kondisi)
    updateInovasiFilePreview();
}


    modal.classList.remove('hidden');
}

function closeInovasiForm() {
    const modal = document.getElementById('inovasiModal');
    if (modal) {
        modal.classList.add('hidden');
    }
    
    // Reset form
    document.getElementById('inovasiForm').reset();
    
    // Reset file preview
    document.getElementById('inovasiFilePreview').innerHTML = '<p>Tidak ada file yang dipilih.</p>';
    
    // Reset file input
    document.getElementById('inovasiFoto').value = '';
    
    // Reset delete flag
    document.getElementById('deleteInovasiFile').value = "0";
}
        

async function saveInovasi(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const carousel = document.getElementById('inovasi-carousel');

    // Cek mode edit/tambah
    const isEdit = form.dataset.editMode === 'true';
    const url = form.action;
    const method = isEdit ? 'PUT' : 'POST';

    try {
        const res = await fetch(url, {
            method: 'POST', // Laravel spoof method
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });

        const data = await res.json();

        if (data.success) {
            if (isEdit) {
                // update DOM item lama
                const inovasiItem = document.querySelector(`.inovasi-item[data-id="${data.id}"]`);
                if (inovasiItem) {
                    const img = inovasiItem.querySelector('img');
                    if (img) {
                        img.src = data.foto ?? 'https://via.placeholder.com/800x600';
                        img.alt = data.judul;
                        img.setAttribute('onclick', `openPreview('${img.src}', '${data.judul}')`);
                    }
                }
            } else {
                // tambah baru
                const newInovasi = document.createElement('div');
                newInovasi.className = 'inovasi-item';
                newInovasi.dataset.id = data.id;
                newInovasi.innerHTML = `
                    <img
                        src="${data.foto ?? 'https://via.placeholder.com/800x600'}"
                        alt="${data.judul}"
                        class="w-full max-w-[30rem] mx-auto h-60 object-contain rounded-lg shadow-md border border-gray-200 cursor-pointer block"
                        onclick="openPreview('${data.foto ?? 'https://via.placeholder.com/800x600'}', '${data.judul}')">
                    <div class="text-center mt-2">
                        <button onclick="editInovasi(this)" class="text-blue-600 hover:text-blue-800 mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form method="POST" action="/Admin_Kelompok/inovasi/${data.id}" class="inline" onsubmit="return confirmDelete(event)">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                `;
                carousel.appendChild(newInovasi);
            }

            closeInovasiForm();
            initializeCarousel('inovasi');
            showNotification('Inovasi berhasil disimpan!');
        } else {
            alert('Gagal menyimpan inovasi');
        }
    } catch (err) {
        console.error(err);
        alert('Terjadi error saat menyimpan inovasi');
    }
}



function editInovasi(button) {
    const inovasiItem = button.closest('.inovasi-item');
    const id = inovasiItem.dataset.id; // id dari DB
    const img = inovasiItem.querySelector('img');
    const filePath = img ? img.getAttribute('src').replace(window.location.origin + '/storage/', '') : '';

    openInovasiForm({{ $kelompok->id_kelompok }}, true, id, filePath);
}


        function deleteInovasi(button) {
            if (confirm('Apakah Anda yakin ingin menghapus inovasi ini?')) {
                const inovasiItem = button.closest('.inovasi-item');
                inovasiItem.remove();
                initializeCarousel('inovasi');
                showNotification('Inovasi berhasil dihapus!');
            }
        }


        function closeAllForms() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.classList.add('hidden');
            });
        }
        

        //CRUD PRODUK PERTAUN
// function updateNamaProduk() {
//     const select = document.getElementById('id_produk');
//     const namaProdukInput = document.getElementById('nama_produk');
//     if (!select || !namaProdukInput) {
//         console.error('Elemen select atau input nama_produk tidak ditemukan!');
//         return;
//     }

//     const selectedId = select.value;
//     console.log('Selected ID:', selectedId); // Debugging
//     if (selectedId) {
//         const namaProduk = produkData[selectedId] || '';
//         console.log('Nama Produk from Data:', namaProduk); // Debugging
//         namaProdukInput.value = namaProduk;
//     } else {
//         namaProdukInput.value = '';
//         console.log('No selection, clearing nama_produk'); // Debugging
//     }
// }


// // Pastikan JavaScript dijalankan setelah DOM siap
// document.addEventListener('DOMContentLoaded', () => {
//     const addButton = document.querySelector('#produk_pertahun button[onclick="openProdukTahunForm()"]');
//     if (addButton) {
//         addButton.addEventListener('click', () => openProdukTahunForm());
//     }
//     const idProdukSelect = document.getElementById('id_produk');
//     if (idProdukSelect) {
//         idProdukSelect.addEventListener('change', updateNamaProduk);
//     }
// });

 function isiNamaProduk() {
    let select = document.getElementById("id_produk");
    let option = select.options[select.selectedIndex];
    let nama = option.getAttribute("data-nama");

    document.getElementById("nama_produk").value = nama ?? "";
}


// function getProduk() {
//     let id = document.getElementById("id_produk").value;

//     if(id) {
//         fetch(`/produk/${id}`)
//             .then(res => {
//                 if (!res.ok) {
//                     throw new Error("Produk tidak ditemukan");
//                 }
//                 return res.json();
//             })
//             .then(data => {
//                 document.getElementById("nama_produk").value = data.nama;
//             })
//             .catch(err => {
//                 document.getElementById("nama_produk").value = "";
//                 alert(err.message);
//             });
//     } else {
//         document.getElementById("nama_produk").value = "";
//     }
// }

 // CRUD Functions for Produk Pertahun
// CRUD Functions for Produk Pertahu
 let allYearsCache = [];
 function openProdukTahunForm(editMode = false, data = {}) {
   
    const modal = document.getElementById('produkTahunModal');
    const form = document.getElementById('produkTahunForm');
    const methodInput = document.getElementById('formMethod');
    const title = document.getElementById('produkTahunModalTitle');

    const selectProduk = document.getElementById('id_produk_select');
    const selectTahun = document.getElementById('tahun');

    // Simpan semua tahun awal
    const allYears = [...selectTahun.options].map(opt => ({value: opt.value, text: opt.text}));

      // 🧹 Bersihkan validasi dulu
    Array.from(form.querySelectorAll("input, select")).forEach(el => {
        el.setCustomValidity("");
        el.reportValidity();
    });


    if (editMode && data) {
    title.textContent = "Edit Produk Per Tahun";

    // Set produk (update Select2 juga)
    $('#id_produk_select').val(data.id_produk).trigger('change');

    // Filter tahun sesuai produk
    filterTahunDropdown(data.id_produk, data.tahun, allYears, selectTahun);

    // Set tahun (update Select2 juga)
    $('#tahun').val(data.tahun).trigger('change');

    // Isi field lain
// Isi field lain
document.getElementById('harga').value = data.harga || '';
document.getElementById('produk_terjual_tahun').value = data.produk_terjual || '';

// 🧩 Atur satuan (case-insensitive + tambahkan jika belum ada)
let satuanValue = (data.satuan || '').trim();
if (!satuanValue) satuanValue = '';

// Cek apakah value sudah ada di dropdown (abaikan besar kecil huruf)
const optionExists = $('#satuan_tahun option').toArray().some(opt =>
    opt.value.toLowerCase() === satuanValue.toLowerCase()
);

if (optionExists) {
    // Ambil value persis dari opsi yang cocok
    const matched = $('#satuan_tahun option').filter(function () {
        return this.value.toLowerCase() === satuanValue.toLowerCase();
    }).val();
    $('#satuan_tahun').val(matched).trigger('change');
} else if (satuanValue) {
    // Tambah manual kalau belum ada
    $('#satuan_tahun').append(`<option value="${satuanValue}">${satuanValue}</option>`);
    $('#satuan_tahun').val(satuanValue).trigger('change');
}

    form.action = data.updateUrl;
    methodInput.value = "PUT";
}
 else {
        title.textContent = "Tambah Produk Per Tahun";
        form.reset();
        form.action = '{{ route("Admin_Kelompok.storeProdukTahun") }}';
        methodInput.value = "POST";

        // --- Filter tahun default berdasarkan produk yang dipilih ---
        filterTahunDropdown(selectProduk.value, null, allYears, selectTahun);
    }

    modal.classList.remove('hidden');
      // Pastikan validasi bersih setelah modal tampil
    setTimeout(() => {
        Array.from(form.querySelectorAll("input, select")).forEach(el => {
            el.setCustomValidity("");
            el.reportValidity();
        });
    }, 50);
}

// ✅ Fungsi Reset Form (bersih total)
function resetProdukTahunForm() {
    const form = document.getElementById('produkTahunForm');
    const selectProduk = document.getElementById('id_produk_select');
    const selectTahun = document.getElementById('tahun');
    const methodInput = document.getElementById('formMethod');

    // Reset form HTML
    form.reset();

    // Reset dropdown tahun (pakai cache)
    if (allYearsCache.length > 0) {
        selectTahun.innerHTML = '';
        allYearsCache.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.value;
            option.textContent = opt.text;
            selectTahun.appendChild(option);
        });
    }

    // Reset method ke POST
    methodInput.value = "POST";

    // Reset Select2
    $('#id_produk_select').val('').trigger('change');
    $('#tahun').val('').trigger('change');

    // Hapus semua validasi lama
    Array.from(form.querySelectorAll("input, select")).forEach(el => {
        el.setCustomValidity("");
        el.reportValidity();
    });
}

function filterTahunDropdown(idProduk, currentYear, allYears, selectTahun) {
    selectTahun.innerHTML = "";
    selectTahun.append(new Option("Pilih Tahun", ""));

    if (!idProduk || !usedYears[idProduk]) {
        allYears.forEach(y => {
            if (y.value) selectTahun.append(new Option(y.text, y.value));
        });
        return;
    }

    const blockedYears = usedYears[idProduk];

    allYears.forEach(y => {
        if (!y.value) return;

        // kalau edit → tahun yang sedang dipakai tetap boleh muncul
        if (currentYear && parseInt(y.value) === parseInt(currentYear)) {
            const opt = new Option(y.text, y.value);
            opt.selected = true;
            selectTahun.append(opt);
        } else if (!blockedYears.includes(parseInt(y.value))) {
            selectTahun.append(new Option(y.text, y.value));
        }
    });
}



 document.addEventListener('DOMContentLoaded', function() {
    const selectProduk = document.getElementById('id_produk_select');
    const selectTahun = document.getElementById('tahun');

    // Simpan semua tahun awal (2015-2030)
    const allYears = [...selectTahun.options].map(opt => ({value: opt.value, text: opt.text}));

    // Event kalau produk berubah → langsung filter dropdown tahun
    selectProduk.addEventListener('change', function() {
        filterTahunDropdown(this.value, null, allYears, selectTahun);
    });
});



 function editProdukTahun(button) {
    const data = {
        id: button.getAttribute('data-id'),
        id_produk: button.getAttribute('data-id-produk'),
        nama_produk: button.getAttribute('data-nama-produk'), // Ambil nama produk
        harga: button.getAttribute('data-harga'),
        produk_terjual: button.getAttribute('data-terjual'),
        tahun: button.getAttribute('data-tahun'),
        satuan: (button.getAttribute('data-satuan') || '').trim(),
        updateUrl: button.getAttribute('data-update-url'),
    };

    openProdukTahunForm(true, data);
}

    function closeProdukTahunForm() {
            resetProdukTahunForm();
    const modal = document.getElementById('produkTahunModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

function deleteProdukTahun(button) {
    if (!confirm('Yakin ingin menghapus data ini?')) return;

    const id = button.getAttribute('data-id');
    const idKelompok = button.getAttribute('data-id-kelompok');

    if (!id || !idKelompok) {
        console.error('ID atau ID Kelompok tidak ditemukan!');
        alert('Gagal menghapus: ID atau ID Kelompok tidak ditemukan.');
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/delete-produk-tahun/' + id; // Sesuaikan dengan route deleteProdukTahun

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = document.querySelector('meta[name="csrf-token"]').content;

    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';

    const hiddenKelompok = document.createElement('input');
    hiddenKelompok.type = 'hidden';
    hiddenKelompok.name = 'id_kelompok';
    hiddenKelompok.value = idKelompok;

    form.appendChild(csrf);
    form.appendChild(method);
    form.appendChild(hiddenKelompok);
    document.body.appendChild(form);
    form.submit();
}

// Event listener untuk dropdown id_produk
document.addEventListener('DOMContentLoaded', () => {
    const idProdukSelect = document.getElementById('id_produk');
    if (idProdukSelect) {
        idProdukSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const namaProduk = selectedOption ? selectedOption.getAttribute('data-nama') : '';
            // Tidak perlu input nama_produk, karena hanya digunakan di backend
        });
    }
});

// document.getElementById('inovasiFoto').addEventListener('change', function (e) {
//     const fileInput = document.getElementById('inovasiFoto');
// const fileNameClickable = document.getElementById('fileNameClickable');
// const previewContainer = document.getElementById('previewContainer');
// const previewImage = document.getElementById('previewImage');
// let tempImageUrl = null;

// // Saat pilih file → tampilkan nama file custom di bawah field
// fileInput.addEventListener('change', function () {
//     const file = fileInput.files[0];
//     if (file) {
//         fileNameClickable.textContent = file.name;
//         fileNameClickable.classList.remove('hidden');
//         // simpan gambar sementara
//         const reader = new FileReader();
//         reader.onload = function (event) {
//             tempImageUrl = event.target.result;
//         };
//         reader.readAsDataURL(file);
//     } else {
//         fileNameClickable.classList.add('hidden');
//         previewContainer.classList.add('hidden');
//         tempImageUrl = null;
//     }
// });

// // Kalau nama file custom di-klik → tampilkan preview di luar modal
// fileNameClickable.addEventListener('click', function () {
//     if (tempImageUrl) {
//         previewImage.src = tempImageUrl;
//         previewContainer.classList.remove('hidden');
//     }
// });




// });



//         function showNotification(message) {
//             const notification = document.createElement('div');
//             notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50';
//             notification.textContent = message;
//             document.body.appendChild(notification);

//             setTimeout(() => {
//                 notification.remove();
//             }, 3000);
//         }

//  document.addEventListener("DOMContentLoaded", function () {
//     const items = document.querySelectorAll("#produk-carousel .produk-item");
//     const prevBtn = document.querySelector("#produk-nav button:first-child");
//     const nextBtn = document.querySelector("#produk-nav button:last-child");
//     const produkNav = document.getElementById("produk-nav");

//     let currentPage = 0;
//     const itemsPerPage = 4;

//     function showPage(page) {
//         items.forEach((item, index) => {
//             item.style.display = (index >= page * itemsPerPage && index < (page + 1) * itemsPerPage)
//                 ? "block"
//                 : "none";
//         });

//         // kontrol tombol
//         prevBtn.disabled = (page === 0);
//         nextBtn.disabled = ((page + 1) * itemsPerPage >= items.length);
//     }

//     if (items.length > itemsPerPage) {
//         produkNav.classList.remove("hidden"); // munculin tombol
//     }

//     // event tombol
//     prevBtn.addEventListener("click", () => {
//         if (currentPage > 0) {
//             currentPage--;
//             showPage(currentPage);
//         }
//     });

//     nextBtn.addEventListener("click", () => {
//         if ((currentPage + 1) * itemsPerPage < items.length) {
//             currentPage++;
//             showPage(currentPage);
//         }
//     });

//     // tampilkan halaman pertama
//     showPage(currentPage);
// });


// let inovasiFile = null;

//     document.getElementById('inovasiFoto').addEventListener('change', function(e) {
//         const files = e.target.files;
//         if (files.length > 0) {
//             inovasiFile = files[0];
//             updateInovasiPreview();
//         }
//     });

//     function updateInovasiPreview() {
//         const fileNameClickable = document.getElementById('fileNameClickable');
//         fileNameClickable.innerHTML = '';

//         if (inovasiFile) {
//             const fileLink = document.createElement('a');
//             fileLink.textContent = inovasiFile.name;
//             fileLink.href = '#';
//             fileLink.className = 'text-blue-600 underline cursor-pointer';
//             fileLink.onclick = (e) => {
//                 e.preventDefault();
//                 previewInovasiFile(inovasiFile);
//             };

//             fileNameClickable.appendChild(fileLink);
//             fileNameClickable.classList.remove('hidden');
//         } else {
//             fileNameClickable.classList.add('hidden');
//         }

//         // update input hidden supaya file tetap ke-submit
//         const dt = new DataTransfer();
//         if (inovasiFile) dt.items.add(inovasiFile);
//         document.getElementById('inovasiFoto').files = dt.files;
//     }

//     function previewInovasiFile(file) {
//         const previewContainer = document.getElementById('previewContainer');
//         const previewImage = document.getElementById('previewImage');
//         previewImage.src = '';
//         previewImage.classList.add('hidden');

//         if (file && file.type.startsWith('image/')) {
//             const url = URL.createObjectURL(file);
//             previewImage.src = url;
//             previewImage.classList.remove('hidden');
//             previewContainer.classList.remove('hidden');
//         } else {
//             alert('Preview hanya tersedia untuk file gambar (jpg, jpeg, png).');
//         }
//     }


//inovasi

// ========== INOVASI ==========
// let inovasiPage = 1;
// const inovasiPerPage = 1; // 1 item per halaman

// function renderInovasi(idPrefix) {
//     const carousel = document.getElementById(`${idPrefix}-carousel`);
//     const items = carousel.querySelectorAll('.inovasi-item');
//     const nav = document.getElementById(`${idPrefix}-nav`);
//     const pagination = document.getElementById(`${idPrefix}-pagination`);

//     const total = items.length;
//     const totalPages = Math.ceil(total / inovasiPerPage);

//     // tampilkan inovasi sesuai halaman (hanya 1 per halaman)
//     items.forEach((item, index) => {
//         item.style.display =
//             (index >= (inovasiPage - 1) * inovasiPerPage && index < inovasiPage * inovasiPerPage)
//                 ? "block"
//                 : "none";
//     });

//     // tampilkan navigasi hanya jika ada lebih dari 1 inovasi
//     if (total > inovasiPerPage) {
//         nav.classList.remove("hidden");
//         pagination.innerHTML = "";

//         renderInovasiPagination(totalPages, inovasiPage, (page) => {
//             inovasiPage = page;
//             renderInovasi(idPrefix);
//         }, pagination);

//     } else {
//         nav.classList.add("hidden");
//     }
// }

// function renderInovasiPagination(totalPages, currentPage, onClick, container) {
//     container.innerHTML = "";

//     let block = Math.floor((currentPage - 1) / 3);
//     let start = block * 3 + 1;
//     let end = Math.min(start + 2, totalPages);

//     // tombol prev blok
//  if (start > 1) {
//     const prevBlock = document.createElement("button");
//     prevBlock.innerText = "←";
//     prevBlock.className = "bg-gray-200 px-3 py-1 rounded hover:bg-gray-300";
//     prevBlock.onclick = () => {
//         onClick(start - 1); // pindah ke halaman terakhir blok sebelumnya
//     };
//     container.appendChild(prevBlock);
// }


//     // tombol angka
//     for (let i = start; i <= end; i++) {
//         const btn = document.createElement("button");
//         btn.innerText = i;
//         btn.className = (i === currentPage)
//             ? "bg-blue-500 text-white px-3 py-1 rounded"
//             : "bg-gray-200 px-3 py-1 rounded hover:bg-gray-300";
//         btn.onclick = () => onClick(i);
//         container.appendChild(btn);
//     }

//    // tombol next blok
// if (end < totalPages) {
//     const nextBlock = document.createElement("button");
//     nextBlock.innerText = "→";
//     nextBlock.className = "bg-gray-200 px-3 py-1 rounded hover:bg-gray-300";
//     nextBlock.onclick = () => {
//         onClick(end + 1); // pindah ke halaman pertama blok berikutnya
//     };
//     container.appendChild(nextBlock);
// }

// }


// function nextInovasiSlide(idPrefix) {
//     const carousel = document.getElementById(`${idPrefix}-carousel`);
//     const items = carousel.querySelectorAll(".inovasi-item");
//     const totalPages = Math.ceil(items.length / inovasiPerPage);
//     if (inovasiPage < totalPages) {
//         inovasiPage++;
//         renderInovasi(idPrefix);
//     }
// }

// function prevInovasiSlide(idPrefix) {
//     if (inovasiPage > 1) {
//         inovasiPage--;
//         renderInovasi(idPrefix);
//     }
// }

// // init
// document.addEventListener("DOMContentLoaded", () => {
//     renderInovasi('inovasi');
// });




//kegiatan
// KEGIATAN
// let kegiatanPage = 1;
// const kegiatanPerPage = 8; // 8 kegiatan per halaman

// function renderKegiatan() {
//     const carousel = document.getElementById("kegiatan-carousel");
//     const items = carousel.querySelectorAll(".kegiatan-item");
//     const nav = document.getElementById("kegiatan-nav");
//     const pagination = document.getElementById("kegiatan-pagination");

//     const total = items.length;
//     const totalPages = Math.ceil(total / kegiatanPerPage);

//     // tampilkan kegiatan sesuai halaman
//     items.forEach((item, index) => {
//         item.style.display =
//             (index >= (kegiatanPage - 1) * kegiatanPerPage && index < kegiatanPage * kegiatanPerPage)
//                 ? "block"
//                 : "none";
//     });

//     // tampilkan navigasi hanya jika ada lebih dari 8 kegiatan
//     if (total > kegiatanPerPage) {
//         nav.classList.remove("hidden");
//         pagination.innerHTML = "";

//         renderKegiatanPagination(totalPages, kegiatanPage, (page) => {
//             kegiatanPage = page;
//             renderKegiatan();
//         }, pagination);

//     } else {
//         nav.classList.add("hidden");
//     }
// }

// function renderKegiatanPagination(totalPages, currentPage, onClick, container) {
//     container.innerHTML = "";

//     let start = Math.floor((currentPage - 1) / 3) * 3 + 1;
//     let end = Math.min(start + 2, totalPages);

//     for (let i = start; i <= end; i++) {
//         const btn = document.createElement("button");
//         btn.innerText = i; // hanya angka
//         btn.className = (i === currentPage)
//             ? "bg-blue-500 text-white px-3 py-1 rounded"
//             : "bg-gray-200 px-3 py-1 rounded hover:bg-gray-300";
//         btn.onclick = () => onClick(i);
//         container.appendChild(btn);
//     }
// }

// function nextKegiatanSlide() {
//     const carousel = document.getElementById("kegiatan-carousel");
//     const items = carousel.querySelectorAll(".kegiatan-item");
//     const totalPages = Math.ceil(items.length / kegiatanPerPage);
//     if (kegiatanPage < totalPages) {
//         kegiatanPage++;
//         renderKegiatan();
//     }
// }

// function prevKegiatanSlide() {
//     if (kegiatanPage > 1) {
//         kegiatanPage--;
//         renderKegiatan();
//     }
// }

// // render pertama kali
// renderKegiatan();

// // binding tombol prev/next
// document.getElementById("kegiatan-prev").onclick = prevKegiatanSlide;
// document.getElementById("kegiatan-next").onclick = nextKegiatanSlide;

// //serach kegiatan
// const searchKegiatan = document.getElementById('searchKegiatan');
// const kegiatanItems = document.querySelectorAll('#kegiatan-carousel .kegiatan-item');

// // Event pencarian
// searchKegiatan.addEventListener('keyup', function () {
//     let keyword = this.value.toLowerCase();
//     let visibleItems = [];

//     // Filter kegiatan berdasarkan judul
//     kegiatanItems.forEach(item => {
//         let judul = item.querySelector('h3').innerText.toLowerCase();
//         if (judul.includes(keyword)) {
//             item.style.display = "block";
//             visibleItems.push(item);
//         } else {
//             item.style.display = "none";
//         }
//     });

//     // Reset ke halaman 1 setiap kali filter berubah
//     showKegiatanPage(visibleItems, 1);
// });

// // Fungsi menampilkan kegiatan per halaman (maks 8 item)
// function showKegiatanPage(visibleItems, page) {
//     let perPage = 8;
//     let start = (page - 1) * perPage;
//     let end = start + perPage;

//     visibleItems.forEach((item, index) => {
//         if (index >= start && index < end) {
//             item.style.display = "block";
//         } else {
//             item.style.display = "none";
//         }
//     });

//     // Update navigasi pagination
//     let nav = document.getElementById('kegiatan-nav');
//     if (visibleItems.length > perPage) {
//         nav.classList.remove('hidden');
//     } else {
//         nav.classList.add('hidden');
//     }
// }




// PRODUK
// let produkPage = 1;
// const produkPerPage = 8; // 8 produk per slide

// function renderProduk() {
//     const carousel = document.getElementById("produk-carousel");
//     const items = carousel.querySelectorAll(".produk-item");
//     const nav = document.getElementById("produk-nav");
//     const pagination = document.getElementById("produk-pagination");

//     const total = items.length;
//     const totalPages = Math.ceil(total / produkPerPage);

//     // tampilkan produk sesuai halaman
//     items.forEach((item, index) => {
//         item.style.display =
//             (index >= (produkPage - 1) * produkPerPage && index < produkPage * produkPerPage)
//                 ? "block"
//                 : "none";
//     });

//     // tampilkan navigasi hanya jika ada lebih dari 8 produk
//     if (total > produkPerPage) {
//         nav.classList.remove("hidden");
//         pagination.innerHTML = "";

//         renderProdukPagination(totalPages, produkPage, (page) => {
//             produkPage = page;
//             renderProduk();
//         }, pagination);

//     } else {
//         nav.classList.add("hidden");
//     }
// }

// function renderProdukPagination(totalPages, currentPage, onClick, container) {
//     container.innerHTML = "";

//     let start = Math.floor((currentPage - 1) / 3) * 3 + 1;
//     let end = Math.min(start + 2, totalPages);

//     for (let i = start; i <= end; i++) {
//         const btn = document.createElement("button");
//         btn.innerText = i; // hanya angka
//         btn.className = (i === currentPage)
//             ? "bg-blue-500 text-white px-3 py-1 rounded"
//             : "bg-gray-200 px-3 py-1 rounded hover:bg-gray-300";
//         btn.onclick = () => onClick(i);
//         container.appendChild(btn);
//     }
// }

// function nextProdukSlide() {
//     const carousel = document.getElementById("produk-carousel");
//     const items = carousel.querySelectorAll(".produk-item");
//     const totalPages = Math.ceil(items.length / produkPerPage);
//     if (produkPage < totalPages) {
//         produkPage++;
//         renderProduk();
//     }
// }

// function prevProdukSlide() {
//     if (produkPage > 1) {
//         produkPage--;
//         renderProduk();
//     }
// }

// // render pertama kali
// renderProduk();



//   function openPdfModal(pdfUrl) {
//         // tambahin #toolbar=0 biar hilang bar default
//         document.getElementById('pdfViewer').src = pdfUrl + "#toolbar=0&navpanes=0&scrollbar=0";
//         document.getElementById('pdfModal').classList.remove('hidden');
//     }

//     function closePdfModal() {
//         document.getElementById('pdfModal').classList.add('hidden');
//         document.getElementById('pdfViewer').src = "";
//     }


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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Periksa apakah user datang dari operasi CRUD
            const isFromCrud = localStorage.getItem('isFromCrud');
            
            // Hanya tampilkan notifikasi jika benar-benar dari CRUD
            if(isFromCrud !== 'false') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#7c3aed'
                });
            }
            
            // Reset flag untuk penggunaan selanjutnya
            localStorage.setItem('isFromCrud', 'true');
        });
    </script>
@endif

<script>
function confirmDeleteUniversal(formId, title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
</script>
<style>
    @keyframes fadeIn {
  from { opacity: 0; transform: translateY(5px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fadeIn 0.3s ease-in-out;
}

</style>



</body>

</html> 