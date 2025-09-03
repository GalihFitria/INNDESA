<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-blue {
            background-color: #0097D4;
            color: white;
        }

        .btn-blue:hover {
            background-color: #0078a7;
            transform: translateY(-2px);
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
            border: 2px solid #0097D4;
            color: #0097D4;
        }

        .btn-outline:hover {
            background-color: #0097D4;
            color: white;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            padding-bottom: 40%;
            height: 0;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .location-card {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .location-card img {
            transition: all 0.5s ease;
        }

        .location-card:hover img {
            transform: scale(1.05);
        }

        .location-card .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 100%);
            padding: 2rem 1.5rem 1.5rem;
            color: white;
        }

        .csr-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .csr-card {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .csr-card .image-container {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .csr-card .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .csr-card .icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #0097D4;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .csr-card .content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .csr-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0097D4;
            margin-bottom: 1rem;
        }

        .csr-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .csr-card ul li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
        }

        .csr-card ul li:last-child {
            border-bottom: none;
        }

        .csr-card ul li i {
            color: #10b981;
            margin-right: 0.75rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #e5e7eb;
            border-radius: 4px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 2rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2.375rem;
            top: 0.5rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0097D4;
            border: 4px solid white;
            box-shadow: 0 0 0 4px #e5e7eb;
        }

        .timeline-item.active::before {
            background: #10b981;
        }

        .policy-item {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-left: 4px solid #0097D4;
        }

        .policy-item h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0097D4;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .policy-item h4 i {
            margin-right: 0.75rem;
        }

        .policy-item p {
            color: #4b5563;
        }
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">
    @include('navbar')
    <section class="relative text-white overflow-hidden min-h-[550px] flex flex-col items-center pt-32"
        style="background-image: url('{{ asset('images/background_beranda_INNDESA.jpeg') }}'); background-size: cover; background-position: center;">
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

    <section class="py-16 bg-white">
        <div class="max-w-3xl mx-auto text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-600 mb-6">Profil Perusahaan</h2>
            <div class="card p-8">
                <p class="text-gray-800 text-lg md:text-xl leading-relaxed">
                    Mengoperasikan 1 unit Pembangkit Listrik Tenaga Uap (PLTU) dengan kapasitas 660 MW yang berlokasi di Desa Bunton, Kecamatan Adipala, Kabupaten Cilacap. PLTU Adipala beroperasi dengan menggunakan bahan bakar batubara dan mempunyai teknologi supercritical yang membuat operasional PLTU lebih efisien.
                </p>
            </div>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4">Visi</h3>
                <div class="card flex-1 p-6 flex items-center justify-center">
                    <p class="text-gray-800 text-lg md:text-xl lg:text-xl leading-relaxed">
                        Menjadi Perusahaan Pembangkit Listrik Terkemuka dan Berkelanjutan di Asia Tenggara
                    </p>
                </div>
            </div>
            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4">Misi</h3>
                <div class="card flex-1 p-6 flex items-center justify-center">
                    <p class="text-gray-800 text-lg md:text-xl lg:text-xl leading-relaxed">
                        Menyelenggarakan Bisnis Solusi Energi yang Andal, Efisien, Inovatif, dan Melampaui Harapan Pelanggan, Menuju Energi Bersih yang Terjangkau
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">Lokasi Perusahaan</h2>
            </div>

            <div class="flex justify-center">
                <img
                    src="{{ asset('images/lokasi.png') }}"
                    class="max-w-full h-auto rounded-lg shadow-lg" />
            </div>
        </div>
    </section>

    <!-- CSR Profile -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-600 mb-12 text-center">Profil CSR</h2>

            <!-- Pengertian CSR -->
            <div class="mb-16">
                <h3 class="text-2xl font-bold text-blue-600 mb-6 text-center">Pengertian CSR</h3>
                <div class="card p-8 max-w-4xl mx-auto">
                    <p class="text-gray-800 text-lg leading-relaxed">
                        Corporate Social Responsibility (CSR) atau Tanggung Jawab Sosial Perusahaan adalah konsep bahwa organisasi, khususnya perusahaan, memiliki tanggung jawab terhadap pemangku kepentingan (stakeholders) yang meliputi konsumen, karyawan, pemegang saham, komunitas, dan lingkungan dalam semua aspek operasional perusahaan. CSR bertujuan untuk menciptakan dampak positif bagi masyarakat dan lingkungan sekitar, sejalan dengan prinsip keberlanjutan.
                    </p>
                </div>
            </div>

            <!-- Program Unggulan -->
            <div class="mb-16">
                <h3 class="text-2xl font-bold text-blue-600 mb-6 text-center">Program CSR</h3>

                <div class="csr-grid">
                    <div class="csr-card">
                        <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Bantuan Fasilitas KWT">
                            <div class="icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                        </div>
                        <div class="content">
                            <h4>Bantuan Fasilitas KWT</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Sarana pendukung untuk Kelompok Wanita Tani</li>
                                <li><i class="fas fa-check-circle"></i> Pengembangan potensi lokal</li>
                                <li><i class="fas fa-check-circle"></i> Peningkatan kapasitas produksi</li>
                                <li><i class="fas fa-check-circle"></i> Pemberdayaan ekonomi perempuan</li>
                            </ul>
                        </div>
                    </div>

                    <div class="csr-card">
                        <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Penyaluran Paket Sembako">
                            <div class="icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                        <div class="content">
                            <h4>Penyaluran Paket Sembako</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Bantuan untuk warga Dusun Bogemanjir</li>
                                <li><i class="fas fa-check-circle"></i> Program rutin musim kemarau</li>
                                <li><i class="fas fa-check-circle"></i> Pemenuhan kebutuhan pokok</li>
                                <li><i class="fas fa-check-circle"></i> Ketahanan pangan lokal</li>
                            </ul>
                        </div>
                    </div>

                    <div class="csr-card">
                        <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1588702592395-a8f7a407a58d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Pelatihan Pengolahan Limbah Perikanan">
                            <div class="icon">
                                <i class="fas fa-fish"></i>
                            </div>
                        </div>
                        <div class="content">
                            <h4>Pelatihan Pengolahan Limbah Perikanan</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Pengolahan limbah ramah lingkungan</li>
                                <li><i class="fas fa-check-circle"></i> Pelatihan untuk warga Desa Wlahar</li>
                                <li><i class="fas fa-check-circle"></i> Pembukaan peluang usaha baru</li>
                                <li><i class="fas fa-check-circle"></i> Peningkatan nilai ekonomis limbah</li>
                            </ul>
                        </div>
                    </div>

                    <div class="csr-card">
                        <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Pelatihan Pembuatan Pupuk Organik Cair">
                            <div class="icon">
                                <i class="fas fa-flask"></i>
                            </div>
                        </div>
                        <div class="content">
                            <h4>Pelatihan Pembuatan POC</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Pengolahan limbah rumah tangga</li>
                                <li><i class="fas fa-check-circle"></i> Pelatihan untuk KWT Sidamegar</li>
                                <li><i class="fas fa-check-circle"></i> Pupuk organik cair bernilai guna</li>
                                <li><i class="fas fa-check-circle"></i> Alternatif pupuk kimia</li>
                            </ul>
                        </div>
                    </div>

                    <div class="csr-card">
                        <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Bantuan Benih Cabai">
                            <div class="icon">
                                <i class="fas fa-pepper-hot"></i>
                            </div>
                        </div>
                        <div class="content">
                            <h4>Bantuan Benih Cabai</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Benih cabai unggulan untuk petani</li>
                                <li><i class="fas fa-check-circle"></i> Meningkatkan produktivitas</li>
                                <li><i class="fas fa-check-circle"></i> Ketahanan pangan lokal</li>
                                <li><i class="fas fa-check-circle"></i> Dukungan untuk petani Adipala</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kebijakan CSR -->
            <div class="mb-16">
                <h3 class="text-2xl font-bold text-blue-600 mb-6 text-center">Kebijakan CSR</h3>
                <div class="max-w-4xl mx-auto">
                    <div class="policy-item">
                        <h4><i class="fas fa-users"></i> Keterlibatan Stakeholder</h4>
                        <p>Melibatkan masyarakat, pemerintah daerah, dan pemangku kepentingan lainnya dalam perencanaan dan pelaksanaan program CSR.</p>
                    </div>
                    <div class="policy-item">
                        <h4><i class="fas fa-sync-alt"></i> Keberlanjutan</h4>
                        <p>Memastikan program CSR memberikan dampak jangka panjang dan berkelanjutan bagi masyarakat.</p>
                    </div>
                    <div class="policy-item">
                        <h4><i class="fas fa-eye"></i> Transparansi</h4>
                        <p>Menyediakan informasi yang jelas dan akurat mengenai program CSR yang dilaksanakan.</p>
                    </div>
                    <div class="policy-item">
                        <h4><i class="fas fa-balance-scale"></i> Akuntabilitas</h4>
                        <p>Bertanggung jawab atas dampak dari program CSR yang telah dilaksanakan.</p>
                    </div>
                    <div class="policy-item">
                        <h4><i class="fas fa-link"></i> Keterpaduan</h4>
                        <p>Mengintegrasikan program CSR dengan kegiatan operasional perusahaan dan program pemerintah.</p>
                    </div>
                </div>
            </div>

            <!-- Roadmap CSR -->
            <div>
                <h3 class="text-2xl font-bold text-blue-600 mb-6 text-center">Roadmap CSR</h3>
            </div>
        </div>
    </section>
    <div class="mt-20">
        @include('footer')
    </div>
</body>

</html>