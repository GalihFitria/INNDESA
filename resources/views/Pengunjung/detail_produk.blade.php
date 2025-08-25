<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Abon Lele</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
            width: 100%;
        }

        .product-image {
            width: 100%;
            height: 100%;
            max-width: 450px;
            max-height: 450px;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>

<body class="bg-white">
    @include('navbar')
    <div class="content w-full mt-6 px-6 lg:px-12">
        <div class="bg-white card p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex justify-center">
                <div class="w-100 h-100 overflow-hidden rounded-lg">
                    <img src="{{ asset('images/Abon Lele.jpeg') }}" alt="Abon Lele" class="product-image">
                </div>
            </div>
            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-gray-900">Abon Lele</h1>
                <div class="flex items-center gap-x-6 border-b pb-2">
                    <p class="text-xl font-semibold text-gray-900">Rp. 25.000</p>
                    <p class="text-xl font-semibold text-gray-900">Stok: 5</p>
                </div>

                
                <div class="w-full mt-6">
                    <div class="flex bg-gray-200 rounded-lg overflow-hidden">
                        <button id="tab-deskripsi"
                            onclick="openTab('deskripsi')"
                            class="flex-1 px-4 py-2 font-semibold bg-[#0097D4] text-white transition">
                            Deskripsi
                        </button>
                        <button id="tab-sertifikat"
                            onclick="openTab('sertifikat')"
                            class="flex-1 px-4 py-2 font-semibold bg-gray-200 text-gray-700 transition">
                            Sertifikat
                        </button>
                    </div>


                    <div id="content-deskripsi" class="mt-4">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Produk ini merupakan hasil inovasi masyarakat desa yang mengedepankan kualitas dan keberlanjutan.
                            Dibuat dari bahan-bahan pilihan dan diproduksi dengan standar higienis yang tinggi, produk ini
                            sangat cocok untuk memenuhi kebutuhan sehari-hari konsumen.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Selain itu, produk ini dikembangkan dengan memperhatikan aspek ramah lingkungan dan mendukung
                            pemberdayaan ekonomi lokal. Dengan membeli produk ini, Anda tidak hanya mendapatkan manfaat secara
                            langsung, tetapi juga ikut serta dalam mendukung perekonomian masyarakat desa.
                        </p>
                    </div>

                    <div id="content-sertifikat" class="hidden mt-4">
                        <img src="{{ asset('images/Abon Lele.jpeg') }}"
                            alt="Sertifikat Produk"
                            class="product-image mx-auto mt-4 rounded-lg shadow-md border border-gray-200">
                    </div>
                </div>


                <div class="flex flex-col border-t border-gray-300 mt-4 pt-4">
                    <span class="text-gray-700 mb-2">Untuk pemesanan dapat menghubungi kami:</span>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('images/Abon Lele.jpeg') }}" alt="Nama Penanggung Jawab" class="w-10 h-10 rounded-full">
                            <span class="text-gray-700 font-bold">USERNAME</span>
                        </div>

                        <div class="relative">
                            <button onclick="toggleContactDropdown()"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                Hubungi Kami
                            </button>

                            <div id="contactDropdownMenu" class="hidden absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg">
                                <a href="https://wa.me/6281327661330"
                                    class="flex flex-col px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <span class="font-semibold">WhatsApp</span>
                                    <span class="text-sm text-gray-500">+62 813-2766-1330</span>
                                </a>
                                <a href="https://www.instagram.com/fijarrfqh_/"
                                    class="flex flex-col px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <span class="font-semibold">Instagram</span>
                                    <span class="text-sm text-gray-500">@fijarrfqh_</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8">
                <h2 class="text-xl font-bold text-[#0097D4] mb-4">Produk dari toko yang sama</h2>
            </div>
        </div>
    </div>

    <footer class="w-full">
        @include('footer')
    </footer>

    <script>
            <!-- Produk Terkait -->
        function openTab(tab) {
            document.getElementById('content-deskripsi').classList.add('hidden');
            document.getElementById('content-sertifikat').classList.add('hidden');
            document.getElementById('content-' + tab).classList.remove('hidden');

            document.getElementById('tab-deskripsi').classList.remove('bg-[#0097D4]', 'text-white');
            document.getElementById('tab-deskripsi').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-sertifikat').classList.remove('bg-[#0097D4]', 'text-white');
            document.getElementById('tab-sertifikat').classList.add('bg-gray-200', 'text-gray-700');

            document.getElementById('tab-' + tab).classList.remove('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-' + tab).classList.add('bg-[#0097D4]', 'text-white');
        }

        function toggleContactDropdown() {
            document.getElementById("contactDropdownMenu").classList.toggle("hidden");
        }

        document.addEventListener("click", function(event) {
            const dropdown = document.getElementById("contactDropdownMenu");
            const button = event.target.closest("button[onclick='toggleContactDropdown()']");

            if (!dropdown.contains(event.target) && !button) {
                dropdown.classList.add("hidden");
            }
        });
    </script>
</body>

</html>