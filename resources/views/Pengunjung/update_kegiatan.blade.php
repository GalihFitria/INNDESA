<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INNDESA - Inovasi Nusantara Desa Integratif Pangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-white">

    <!-- Navbar -->
    @include('navbar')

    <!-- Konten -->
    <div class="container mx-auto pt-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Main Content dan Artikel Lainnya -->
            <div class="w-full lg:w-full px-4">
                <div class="w-full px-4 mb-6">
                    <h1 class="text-3xl font-bold text-black mb-2 leading-snug">
                        Berdayakan Warga Terdampak Banjir Demak melalui Pelatihan Pembuatan Makanan Olahan
                    </h1>
                    <p class="text-gray-500 mb-4">Rabu, 01 Mei 2024</p>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <!-- Foto Kegiatan Utama -->
                    <div class="w-full lg:w-2/3 px-4">
                        <img src="{{ asset('images/berita_dummy.jpg') }}"
                            alt="Pelatihan"
                            class="rounded-lg w-full max-w-4xl mb-2">
                        <!-- Sumber Berita, Deskripsi, dan Tombol langsung di bawah foto -->
                        <div class="mb-2">
                            <h2 class="text-xl font-semibold text-gray-800 mb-1">Sumber Berita</h2>
                            <ul class="list-disc list-inside text-blue-600 space-y-1">
                                <li>
                                    <a href="https://serayunews.com/pln-indonesia-power-ubp-adipala-berdayakan-warga-terdampak-banjir-demak-melalui-pelatihan-pembuatan-makanan-olahan"
                                        rel="noopener noreferrer"
                                        class="hover:underline">
                                        Serayunews - Berdayakan Warga Terdampak Banjir Demak
                                    </a>
                                </li>
                                <li>
                                    <a href="https://radarbanyumas.disway.id/read/117861/pt-pln-indonesia-power-ubp-jawa-tengah-2-adipala-gelar-pelatihan-kriya-anyaman-di-dusun-bogemanjir-adipala"
                                        rel="noopener noreferrer"
                                        class="hover:underline">
                                        Radar Banyumas - Berdayakan Warga Terdampak Banjir Demak
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify mb-2">
                            <p class="indent-8">
                                PLN Indonesia Power UBP Jawa Tengah 2 Adipala menunjukkan komitmennya dalam mendukung pemulihan
                                pascabencana dengan memberdayakan masyarakat terdampak banjir di Kabupaten Demak. Program ini tidak hanya
                                berfokus pada bantuan darurat, tetapi juga memberikan keterampilan baru agar masyarakat bisa mandiri secara
                                ekonomi setelah bencana berlalu. Melalui pelatihan pembuatan makanan olahan, warga diharapkan mampu mengubah
                                bahan pangan sederhana menjadi produk bernilai jual tinggi.
                            </p>
                            <p class="indent-8">
                                Pelatihan ini diikuti oleh 30 peserta dari Dusun Ngemplik Wetan, Kecamatan Karanganyar, Kabupaten Demak.
                                Program ini menyasar kelompok perempuan dan ibu rumah tangga yang selama ini berperan penting dalam
                                pengelolaan konsumsi keluarga. Para peserta dibekali keterampilan mengolah hasil pertanian lokal menjadi
                                makanan olahan, seperti keripik sayur, nugget tempe, hingga aneka kue kering. Produk-produk tersebut memiliki
                                potensi besar untuk dipasarkan di tingkat lokal maupun regional.
                            </p>
                            <p class="indent-8">
                                Selain praktik pembuatan makanan, kegiatan ini juga memberikan materi tentang pengemasan produk, manajemen
                                usaha, dan strategi pemasaran digital. Peserta diajarkan bagaimana membuat label yang menarik, menjaga kualitas
                                produk agar tahan lebih lama, serta memanfaatkan media sosial untuk memperluas jangkauan pasar. Dengan begitu,
                                masyarakat tidak hanya belajar keterampilan teknis, tetapi juga pengetahuan bisnis yang bisa meningkatkan
                                pendapatan keluarga.
                            </p>
                            <p class="indent-8">
                                Program ini mendapatkan apresiasi dari pemerintah daerah dan tokoh masyarakat setempat. Mereka menilai
                                inisiatif PLN Indonesia Power menjadi contoh nyata bagaimana perusahaan bisa berperan aktif dalam pembangunan
                                berkelanjutan. Harapannya, kegiatan serupa dapat dilaksanakan secara rutin sehingga semakin banyak warga yang
                                merasakan manfaatnya, terutama di wilayah yang rawan terdampak bencana.
                            </p>
                            <p class="indent-8">
                                Ke depan, PLN Indonesia Power berencana memperluas cakupan program dengan menggandeng lebih banyak mitra,
                                termasuk lembaga pendidikan, komunitas lokal, dan pelaku UMKM. Kolaborasi ini diharapkan mampu menciptakan
                                ekosistem pemberdayaan yang berkelanjutan, sehingga masyarakat tidak hanya pulih dari bencana, tetapi juga
                                semakin kuat dan mandiri dalam menghadapi tantangan ekonomi di masa mendatang.
                            </p>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('beranda') }}"
                                class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                ← Kembali
                            </a>
                        </div>
                    </div>
                    <!-- Artikel Lainnya -->
                    <div class="w-full lg:w-1/3 px-4">
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kegiatan Lainnya</h2>
                            <div class="space-y-4">
                                <div class="flex flex-col lg:flex-row items-start mb-4">
                                    <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/pln-inndesa-training-5ZHDJ7mmSqAXQnhvu7MmJ8M5mhRmw8.png"
                                            alt="PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Pelatihan"
                                            class="rounded-lg w-full max-w-xs">
                                    </div>
                                    <div class="w-full lg:w-2/3 lg:pl-4">
                                        <h3 class="text-xl font-bold text-blue-600 mb-2 leading-snug">PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Pelatihan</h3>
                                        <p class="text-xs text-gray-500 mb-2">15 Desember 2024</p>
                                        <a href="#" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                                    </div>
                                </div>
                                <div class="flex flex-col lg:flex-row items-start mb-4">
                                    <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/sustainable-farm-workshop-OAt66DVmtx6DMlcB56QGKEJ7m23ohm.png"
                                            alt="PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Workshop"
                                            class="rounded-lg w-full max-w-xs">
                                    </div>
                                    <div class="w-full lg:w-2/3 lg:pl-4">
                                        <h3 class="text-xl font-bold text-blue-600 mb-2 leading-snug">PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Workshop</h3>
                                        <p class="text-xs text-gray-500 mb-2">12 Desember 2024</p>
                                        <a href="#" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                                    </div>
                                </div>
                                <div class="flex flex-col lg:flex-row items-start mb-4">
                                    <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/farmer-livestock-tech-assistance-mKH30H7UEnN1GoAYOc62yTeqJusFEb.png"
                                            alt="PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Pendampingan"
                                            class="rounded-lg w-full max-w-xs">
                                    </div>
                                    <div class="w-full lg:w-2/3 lg:pl-4">
                                        <h3 class="text-xl font-bold text-blue-600 mb-2 leading-snug">PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Pendampingan</h3>
                                        <p class="text-xs text-gray-500 mb-2">10 Desember 2024</p>
                                        <a href="#" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                                    </div>
                                </div>
                                <div class="flex flex-col lg:flex-row items-start">
                                    <div class="w-full lg:w-1/3 mb-4 lg:mb-0">
                                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/attachments/gen-images/public/inndesa-socialization-wHDM9f4IhzYOCuJ8CccpKwL8IjN06m.png"
                                            alt="PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Sosialisasi"
                                            class="rounded-lg w-full max-w-xs">
                                    </div>
                                    <div class="w-full lg:w-2/3 lg:pl-4">
                                        <h3 class="text-xl font-bold text-blue-600 mb-2 leading-snug">PT PLN Indonesia Power UBP Jateng 2 Adipala Dukung Program INNDESA melalui Sosialisasi</h3>
                                        <p class="text-xs text-gray-500 mb-2">8 Desember 2024</p>
                                        <a href="#" class="text-blue-600 hover:underline text-sm">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-20">
        @include('footer')
    </div>

</body>

</html>