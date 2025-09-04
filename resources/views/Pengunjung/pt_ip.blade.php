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
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
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
            transition: transform 0.3s ease;
        }

        .location-card:hover {
            transform: scale(1.05);
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
            transition: transform 0.3s ease;
        }

        .csr-card:hover {
            transform: scale(1.05);
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
            transition: transform 0.3s ease;
        }

        .policy-item:hover {
            transform: scale(1.05);
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

        /* Animasi scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animasi untuk card */
        .card-reveal {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .card-reveal.active {
            opacity: 1;
            transform: scale(1);
        }

        /* Animasi untuk section judul */
        .section-title {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }

        .section-title.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animasi untuk CSR card */
        .csr-card-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .csr-card-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animasi untuk policy item */
        .policy-reveal {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }

        .policy-reveal:nth-child(even) {
            transform: translateX(30px);
        }

        .policy-reveal.active {
            opacity: 1;
            transform: translateX(0);
        }

        /* Parallax effect untuk hero background */
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="min-h-screen bg-white font-poppins">
    @include('navbar')
    <section class="relative text-white overflow-hidden min-h-[550px] flex flex-col items-center pt-32 parallax-bg"
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
    <section class="py-16 bg-white reveal">
        <div class="max-w-3xl mx-auto text-center mb-12 section-title">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-600 mb-6">Profile Perusahaan</h2>
        </div>
        <div class="max-w-3xl mx-auto mb-12">
            <div class="card p-8 border border-gray-300 rounded-lg card-reveal">
                <p class="text-center text-gray-800 text-lg md:text-xl leading-relaxed">
                    Mengoperasikan 1 unit Pembangkit Listrik Tenaga Uap (PLTU) dengan kapasitas 660 MW yang berlokasi di Desa Bunton, Kecamatan Adipala, Kabupaten Cilacap. PLTU Adipala beroperasi dengan menggunakan bahan bakar batubara dan mempunyai teknologi supercritical yang membuat operasional PLTU lebih efisien.
                </p>
            </div>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4 section-title">Visi</h3>
                <div class="card flex-1 p-6 flex items-center justify-center border border-gray-300 rounded-lg card-reveal">
                    <p class="text-gray-800 text-lg md:text-xl lg:text-xl leading-relaxed">
                        Menjadi Perusahaan Pembangkit Listrik Terkemuka dan Berkelanjutan di Asia Tenggara
                    </p>
                </div>
            </div>
            <div class="flex flex-col h-full text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4 section-title">Misi</h3>
                <div class="card flex-1 p-6 flex items-center justify-center border border-gray-300 rounded-lg card-reveal">
                    <p class="text-gray-800 text-lg md:text-xl lg:text-xl leading-relaxed">
                        Menyelenggarakan Bisnis Solusi Energi yang Andal, Efisien, Inovatif, dan Melampaui Harapan Pelanggan, Menuju Energi Bersih yang Terjangkau
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-white reveal">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 section-title">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">Lokasi Perusahaan</h2>
            </div>
            <div class="flex justify-center card-reveal">
                <img
                    src="{{ asset('images/Denahlokasi.png') }}"
                    class="max-w-full h-auto rounded-lg shadow-lg" />
            </div>
        </div>
    </section>
    <!-- CSR Profile -->
    <section class="py-16 bg-white reveal">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-600 mb-12 text-center section-title"><i>Corporate Social Responsibility</i> (CSR)</h2>
            <!-- Pengertian CSR -->
            <div class="mb-16">
                <h3 class="text-4xl font-bold text-blue-600 mb-6 text-center section-title">Pengertian CSR</h3>
                <div class="card p-8 border border-gray-300 rounded-lg max-w-4xl mx-auto card-reveal">
                    <p class=" text-center text-gray-800 text-lg md:text-xl leading-relaxed">
                        <i>Corporate Social Responsibility</i> (CSR) atau Tanggung Jawab Sosial dan Lingkungan (TJSL) adalah komitmen PT.PLN Indonesia Power UBP Jawa Tengah 2 Adipala untuk memperhatikan dampak sosial dan lingkungan dari setiap aktivitas bisnis, serta berkontribusi pada pembangunan berkelanjutan.
                        Bagi Indonesia Power, CSR tidak hanya sebatas kepatuhan, tetapi merupakan tanggung jawab perusahaan terhadap masyarakat, pemangku kepentingan, dan lingkungan agar tercipta manfaat berkesinambutan. Implementasinya diwujudkan melalui program INPOWER-CARE <i>(Community Assistance, Relation, and Empowerment)</i> yang berfokus pada peningkatan kualitas hidup, pemberdayaan masyarakat, dan kelestarian lingkungan.
                    </p>
                </div>
            </div>
            <!-- Program CSR -->
            <div class="mb-16">
                <h3 class="text-4xl font-bold text-blue-600 mb-6 text-center section-title">Program INPOWER - CARE</h3>
                <p class=" text-center text-gray-800 text-lg md:text-xl leading-relaxed card-reveal">
                    INPOWER-CARE adalah kegiatan pelibatan dan pengembangan komunitas yang dilakukan Perusahaan sebagai wujud tanggung jawab sosial dan tata kelola Perusahaan yang baik. INPOWERCARE bertujuan untuk memperbesar akses masyarakat agar mencapai kondisi sosial, ekonomi, dan budaya yang lebih baik dari sebelumnya. Sehingga, kehidupan masyarakat di sekitar wilayah operasional Perusahaan diharapkan menjadi lebih berdaya dan mandiri dengan kualitas dan kesejahteraan yang lebih baik.
                    Penyelenggaraan INPOWER-CARE merupakan perwujudan visi dan misi Perusahaan, khususnya bersahabat dengan lingkungan serta perwujudan Tanggung Jawab Sosial dan Lingkungan (TJSL) Perusahaan sebagai bagian dari tata kelola perusahaan yang baik.
                </p><br>
                <div class="flex justify-center card-reveal">
                    <img
                                src="{{ asset('images/Program_INPOWERCARE.png') }}"
                                class="max-w-full h-auto rounded-lg shadow-lg" />
                </div><br>
                <div class="csr-grid">
                    <div class="csr-card border border-gray-300 rounded-lg csr-card-reveal">
                        <!-- <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Bantuan Fasilitas KWT">
                            <div class="icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                        </div> -->
                        <div class="content">
                            <h4>Bantuan Pelayanan Masyarakat</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Bantuan Sarana dan Prasarana</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pelayanan Kesehatan</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pelayanan Pendidikan</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Bencana Alam</li>
                            </ul>
                        </div>
                    </div>
                    <div class="csr-card  border border-gray-300 rounded-lg csr-card-reveal">
                        <!-- <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Penyaluran Paket Sembako">
                            <div class="icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div> -->
                        <div class="content">
                            <h4>Bakti Pembinaan Hubungan</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Komunikasi Sosial</li>
                                <li><i class="fas fa-check-circle"></i> Partisipasi Peringatan Hari Besar</li>
                                <li><i class="fas fa-check-circle"></i> Partisipasi Kegiatan Masyarakat</li>
                            </ul>
                        </div>
                    </div>
                    <div class="csr-card border border-gray-300 rounded-lg csr-card-reveal">
                        <!-- <div class="image-container">
                            <img src="https://images.unsplash.com/photo-1588702592395-a8f7a407a58d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Pelatihan Pengolahan Limbah Perikanan">
                            <div class="icon">
                                <i class="fas fa-fish"></i>
                            </div>
                        </div> -->
                        <div class="content">
                            <h4>Bakti Pemberdayaan Masyarakat</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pengembangan dan Modal Usaha</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Peningkatan Ketrampilan</li>
                                <li><i class="fas fa-check-circle"></i> Bantuan Pemasaran Produk</li>
                                <li><i class="fas fa-check-circle"></i> Riset dan Pengembangan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kebijakan CSR -->
            <div class="mb-16">
                <h3 class="text-4xl font-bold text-blue-600 mb-6 text-center section-title">Kebijakan</h3>
                <div class="max-w-4xl mx-auto">
                    <p class=" text-center text-gray-800 text-lg md:text-xl leading-relaxed card-reveal">
                        Penyelenggaraan program tanggung jawab social terhadap masyarakat di PT.PLN Indonesia Power UBP Jawa Tengah 2 Adipala dilaksanakan berdasarkan pada Keputusan Direksi No. 25.K/010/IP/2014 tentang Pedoman Tanggung Jawab Sosial dan Lingkungan Perusahaan.
                        Sesuai peraturan internal tersebut, Tanggung Jawab Sosial dan Lingkungan Perusahaan (TJSLP), atau di internal disebut dengan program INPOWER-CARE, merupakan komitmen Perusahaan untuk berperan serta dalam pembangunan ekonomi
                        berkelanjutan sebagai bentuk tanggung jawab terhadap dampak pengambilan keputusan dan proses bisnis Perusahaan guna meningkatkan kualitas kehidupan dan lingkungan yang bermanfaat, baik bagi Perusahaan maupun komunitas setempat.
                    </p><br>
                    <div class="policy-item policy-reveal">
                        <h4><i class="fas fa-leaf"></i> Komitmen Ekonomi Berkelanjutan</h4>
                        <p>CSR adalah komitmen perusahaan untuk pembangunan ekonomi berkelanjutan.</p>
                    </div>
                    <div class="policy-item policy-reveal">
                        <h4><i class="fas fa-handshake"></i> Tanggung Jawab Bisnis</h4>
                        <p>CSR dilaksanakan sebagai bentuk tanggung jawab terhadap dampak keputusan dan proses bisnis.</p>
                    </div>
                    <div class="policy-item policy-reveal">
                        <h4><i class="fas fa-users"></i> Peningkatan Kualitas Hidup</h4>
                        <p>Tujuannya meningkatkan kualitas kehidupan masyarakat dan lingkungan yang bermanfaat, baik bagi perusahaan maupun komunitas setempat.</p>
                    </div>
                </div>

                <section class="py-16 bg-white reveal">
                    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12 section-title">
                            <h2 class="text-4xl font-bold text-blue-600 mb-4">Roadmap</h2>
                        </div>
                        <div class="flex justify-center card-reveal">
                            <!-- <img
                                src="{{ asset('images/lokasi.png') }}"
                                class="max-w-full h-auto rounded-lg shadow-lg" /> -->
                        </div>
                    </div>
                </section>

            </div>

        </div>
    </section>
    <div class="mt-20">
        @include('footer')
    </div>
</body>
<script>
    // Scroll reveal animation
    function reveal() {
        const reveals = document.querySelectorAll('.reveal, .card-reveal, .section-title, .csr-card-reveal, .policy-reveal');

        for (let i = 0; i < reveals.length; i++) {
            const windowHeight = window.innerHeight;
            const elementTop = reveals[i].getBoundingClientRect().top;
            const elementVisible = 150;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add('active');
            } else {
                reveals[i].classList.remove('active');
            }
        }
    }

    window.addEventListener('scroll', reveal);

    // Jalankan reveal saat halaman dimuat
    reveal();

    // Parallax effect untuk hero background
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.parallax-bg');
        if (parallax) {
            parallax.style.backgroundPositionY = -(scrolled * 0.5) + 'px';
        }
    });
</script>

</html>