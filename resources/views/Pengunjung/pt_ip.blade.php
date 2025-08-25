<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-title {
            text-shadow: 2px 2px 0px #ffffff, -2px -2px 0px #ffffff, 2px -2px 0px #ffffff, -2px 2px 0px #ffffff, 0px 2px 0px #ffffff, 2px 0px 0px #ffffff, 0px -2px 0px #ffffff, -2px 0px 0px #ffffff;
            -webkit-text-stroke: 1px #ffffff;
        }

        .hero-subtitle {
            text-shadow: 1px 1px 0px #ffffff, -1px -1px 0px #ffffff, 1px -1px 0px #ffffff, -1px 1px 0px #ffffff;
            -webkit-text-stroke: 0.5px #ffffff;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-blue {
            background-color: #3b82f6;
            color: white;
        }

        .btn-blue:hover {
            background-color: #2563eb;
        }

        .btn-green {
            background-color: #10b981;
            color: white;
        }

        .btn-green:hover {
            background-color: #059669;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
        }
    </style>
</head>

<body class="min-h-screen bg-white">
    @include('navbar')

    <section class="relative text-white overflow-hidden min-h-[550px] flex flex-col items-center pt-32"
        style="background-image: url('{{ asset('images/background_beranda_INNDESA.jpeg') }}'); background-size: cover; background-position: center; font-family: 'Poppins', sans-serif;">

        <div class="absolute top-10 left-14 flex items-center space-x-2">
            <img src="{{ asset('images/logo_BUMN.png') }}" alt="Logo" class="h-8 w-auto">
            <img src="{{ asset('images/logo_pln.png') }}" alt="Logo" class="h-8 w-auto">
        </div>

        <div class="text-center space-y-4">
            <h2 class="text-5xl md:text-5xl font-bold" style="color:#0097D4; line-height:1.2;">
                PT. PLN Indonesia Power
            </h2>
            <h2 class="text-5xl md:text-5xl font-bold" style="color:#0097D4; line-height:1.2;">
                UBP Jawa Tengah 2 Adipala
            </h2>
        </div>
    </section>

    <section class="py-16 bg-white font-poppins">
        <div class="max-w-3xl mx-auto text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-600 mb-6">Profil Perusahaan</h2>
            <div class="bg-white border border-gray-300 rounded-lg p-8 shadow-sm">
                <p class="text-gray-800 text-lg md:text-xl leading-relaxed">
                    Mengoperasikan 1 unit Pembangkit Listrik Tenaga Uap (PLTU) dengan kapasitas 660 MW yang berlokasi di Desa Bunton, Kecamatan Adipala, Kabupaten Cilacap. PLTU Adipala beroperasi dengan menggunakan bahan bakar batubara dan mempunyai teknologi supercritical yang membuat operasional PLTU lebih efisien.
                </p>
            </div>
        </div>

        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4">Visi</h3>
                <div class="flex-1 bg-white border border-gray-300 rounded-lg p-6 shadow-sm flex items-center justify-center">
                    <p class="text-gray-800 text-lg md:text-xl lg:text-xl leading-relaxed">
                        Menjadi Perusahaan Pembangkit Listrik Terkemuka dan Berkelanjutan di Asia Tenggara
                    </p>
                </div>
            </div>

            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4">Misi</h3>
                <div class="flex-1 bg-white border border-gray-300 rounded-lg p-6 shadow-sm flex items-center justify-center">
                    <p class="text-gray-800 text-lg md:text-xl lg:text-xl leading-relaxed">
                        Menyelenggarakan Bisnis Solusi Energi yang Andal, Efisien, Inovatif, dan Melampaui Harapan Pelanggan, Menuju Energi Bersih yang Terjangkau
                    </p>
                </div>
            </div>
        </div>
    </section>


    <div class="mt-20">
        @include('footer')
    </div>

</body>


</html>