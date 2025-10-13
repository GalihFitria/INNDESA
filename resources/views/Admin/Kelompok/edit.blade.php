@extends('Admin.sidebar')

@section('title', 'Edit Kelompok - INNDESA')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Kelompok::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto max-h-[500px] overflow-y-auto">
    <form action="{{ route('Admin.kelompok.update', $kelompok->id_kelompok) }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="kelompokForm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori Kelompok</label>
            <select name="id_kategori" id="id_kategori" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}" {{ old('id_kategori', $kelompok->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
            @error('id_kategori')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $kelompok->nama) }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama Kelompok" required data-original-name="{{ $kelompok->nama }}" data-original-kategori="{{ $kelompok->id_kategori }}">
            <span id="namaWarning" class="text-red-500 text-sm hidden">Kombinasi nama kelompok dan kategori sudah ada.</span>
            @error('nama')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="total_anggota" class="block text-sm font-medium text-gray-700">Total Anggota (tidak perlu diisi)</label>
            <input
                type="text"
                name="total_anggota"
                id="total_anggota"
                value="{{ old('total_anggota', $kelompok->total_anggota) }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100 text-gray-600 cursor-not-allowed focus:ring-0 focus:border-gray-300"
                readonly>
            @error('total_anggota')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="sejarah" class="block text-sm font-medium text-gray-700">Sejarah</label>
            <textarea name="sejarah" id="sejarah" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Sejarah Kelompok" rows="5" required>{{ old('sejarah', $kelompok->sejarah) }}</textarea>
            @error('sejarah')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="sk_desa" class="block text-sm font-medium text-gray-700">SK Desa (opsional)</label>
            @if ($kelompok->sk_desa)
            <div class="mb-2" data-file-path="{{ $kelompok->sk_desa }}">
                <a href="#" onclick="event.preventDefault(); previewExistingFile('{{ asset('storage/' . $kelompok->sk_desa) }}', '{{ str_ends_with($kelompok->sk_desa, '.pdf') ? 'application/pdf' : 'image/' }}', 'sk_desa', '{{ $kelompok->sk_desa }}')" class="text-blue-600 hover:underline">
                    {{ basename($kelompok->sk_desa) }}
                </a>
                <button type="button" onclick="removeExistingSkDesa()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>
            @endif
            <input type="file" name="sk_desa" id="sk_desa" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <input type="hidden" name="remove_sk_desa" id="remove_sk_desa" value="0">
            <div id="sk_desa_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file baru yang dipilih.</p>
            </div>
            @error('sk_desa')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="background" class="block text-sm font-medium text-gray-700">Background</label>
            @if ($kelompok->background)
            <div class="mb-2" data-file-path="{{ $kelompok->background }}">
                <a href="#" onclick="event.preventDefault(); previewExistingFile('{{ asset('storage/' . $kelompok->background) }}', '{{ str_ends_with($kelompok->background, '.pdf') ? 'application/pdf' : 'image/' }}', 'background', '{{ $kelompok->background }}')" class="text-blue-600 hover:underline">
                    {{ basename($kelompok->background) }}
                </a>
                <button type="button" onclick="removeExistingBackground()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>
            @endif
            <input type="file" name="background" id="background" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <input type="hidden" name="remove_background" id="remove_background" value="0">
            <div id="background_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file baru yang dipilih.</p>
            </div>
            @error('background')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo (opsional)</label>
            @if ($kelompok->logo)
            <div class="mb-2" data-file-path="{{ $kelompok->logo }}">
                <a href="#" onclick="event.preventDefault(); previewExistingFile('{{ asset('storage/' . $kelompok->logo) }}', '{{ str_ends_with($kelompok->logo, '.pdf') ? 'application/pdf' : 'image/' }}', 'logo', '{{ $kelompok->logo }}')" class="text-blue-600 hover:underline">
                    {{ basename($kelompok->logo) }}
                </a>
                <button type="button" onclick="removeExistingLogo()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>
            @endif
            <input type="file" name="logo" id="logo" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <input type="hidden" name="remove_logo" id="remove_logo" value="0">
            <div id="logo_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file baru yang dipilih.</p>
            </div>
            @error('logo')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.kelompok.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>

    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-4 rounded-lg w-[800px] h-[600px] relative">
            <button onclick="closePreview()" class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">✕</button>
            <div class="w-full h-[80%] flex items-center justify-center relative">
                <img id="previewImage" class="max-w-full max-h-full object-contain hidden" alt="File Preview">
                <iframe id="previewFrame" class="w-full h-full hidden" frameborder="0"></iframe>
            </div>
            <div id="previewControls" class="mt-4 flex space-x-2 justify-center">
                <button id="rotateLeft" onclick="rotateImage(-90)" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    <i class="fas fa-rotate-left"></i>
                </button>
                <button id="rotateRight" onclick="rotateImage(90)" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    <i class="fas fa-rotate-right"></i>
                </button>
                <button id="cropToggle" onclick="toggleCropper()" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                    <i class="fas fa-crop-alt"></i>
                </button>
            </div>
            <div id="cropperControls" class="mt-4 flex space-x-2 justify-center hidden">
                <button onclick="cancelCrop()" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-red-600">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button onclick="cropImage()" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                    <i class="fas fa-crop-alt"></i> Crop
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let skDesaFile = null;
    let backgroundFile = null;
    let logoFile = null;
    let currentPreview = {
        type: null,
        isExisting: false,
        path: null,
        file: null
    };
    let cropper = null;
    let rotatedImageUrl = null;
    let isCropping = false;
    let originalFile = null;
    let currentImageType = null; // Tambahkan variabel untuk menyimpan tipe gambar

    // Validasi frontend untuk nama kelompok
    const namaInput = document.getElementById('nama');
    const kategoriSelect = document.getElementById('id_kategori');
    const warningElement = document.getElementById('namaWarning');
    const originalName = namaInput.getAttribute('data-original-name');
    const originalKategori = kategoriSelect.getAttribute('data-original-kategori');

    // Fungsi untuk validasi kombinasi nama dan kategori
    function validateCombination() {
        const currentName = namaInput.value.trim();
        const currentKategori = kategoriSelect.value;

        // Hanya validasi jika nama diubah
        if (currentName !== originalName) {
            // Simulasi pengecekan (ganti dengan API call jika perlu)
            const sampleData = [{
                    nama: 'Kelompok A',
                    kategori: '1'
                },
                {
                    nama: 'Kelompok B',
                    kategori: '2'
                },
                {
                    nama: 'Kelompok C',
                    kategori: '1'
                }
            ];

            const isDuplicate = sampleData.some(item =>
                item.nama === currentName && item.kategori === currentKategori
            );

            if (isDuplicate) {
                warningElement.classList.remove('hidden');
                namaInput.setCustomValidity('Kombinasi nama kelompok dan kategori sudah ada.');
                return false;
            } else {
                warningElement.classList.add('hidden');
                namaInput.setCustomValidity('');
                return true;
            }
        } else {
            warningElement.classList.add('hidden');
            namaInput.setCustomValidity('');
            return true;
        }
    }

    // Event listener untuk perubahan nama
    namaInput.addEventListener('input', validateCombination);

    // Event listener untuk perubahan kategori (jika nama sudah diubah)
    kategoriSelect.addEventListener('change', function() {
        if (namaInput.value.trim() !== originalName) {
            validateCombination();
        }
    });

    // Validasi saat submit form
    document.getElementById('kelompokForm').addEventListener('submit', function(e) {
        if (!validateCombination()) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Kombinasi nama kelompok dan kategori sudah ada.',
                confirmButtonText: 'OK'
            });
        }

        // Pastikan file yang diedit dimasukkan ke form sebelum submit
        if (skDesaFile) {
            const dt = new DataTransfer();
            dt.items.add(skDesaFile);
            document.getElementById('sk_desa').files = dt.files;
        }
        if (backgroundFile) {
            const dt = new DataTransfer();
            dt.items.add(backgroundFile);
            document.getElementById('background').files = dt.files;
        }
        if (logoFile) {
            const dt = new DataTransfer();
            dt.items.add(logoFile);
            document.getElementById('logo').files = dt.files;
        }
    });

    // SK Desa
    document.getElementById('sk_desa').addEventListener('change', e => {
        skDesaFile = e.target.files[0] || null;
        document.getElementById('remove_sk_desa').value = skDesaFile ? '0' : '1';
        updateSkDesaPreview();
    });

    function updateSkDesaPreview() {
        const previewDiv = document.getElementById('sk_desa_filename');
        previewDiv.innerHTML = skDesaFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(skDesaFile, 'sk_desa')">${skDesaFile.name}</a>
                <button type="button" onclick="removeSkDesaFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file baru yang dipilih.</p>';
    }

    function removeSkDesaFile() {
        skDesaFile = null;
        document.getElementById('remove_sk_desa').value = '1';
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateSkDesaPreview();
    }

    function removeExistingSkDesa() {
        document.querySelector('[data-file-path="{{ $kelompok->sk_desa }}"]')?.remove();
        document.getElementById('remove_sk_desa').value = '1';
    }

    // Background
    document.getElementById('background').addEventListener('change', e => {
        backgroundFile = e.target.files[0] || null;
        document.getElementById('remove_background').value = backgroundFile ? '0' : '1';
        updateBackgroundPreview();
    });

    function updateBackgroundPreview() {
        const previewDiv = document.getElementById('background_filename');
        previewDiv.innerHTML = backgroundFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(backgroundFile, 'background')">${backgroundFile.name}</a>
                <button type="button" onclick="removeBackgroundFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file baru yang dipilih.</p>';
    }

    function removeBackgroundFile() {
        backgroundFile = null;
        document.getElementById('remove_background').value = '1';
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateBackgroundPreview();
    }

    function removeExistingBackground() {
        document.querySelector('[data-file-path="{{ $kelompok->background }}"]')?.remove();
        document.getElementById('remove_background').value = '1';
    }

    // Logo
    document.getElementById('logo').addEventListener('change', e => {
        logoFile = e.target.files[0] || null;
        document.getElementById('remove_logo').value = logoFile ? '0' : '1';
        updateLogoPreview();
    });

    function updateLogoPreview() {
        const previewDiv = document.getElementById('logo_filename');
        previewDiv.innerHTML = logoFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(logoFile, 'logo')">${logoFile.name}</a>
                <button type="button" onclick="removeLogoFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file baru yang dipilih.</p>';
    }

    function removeLogoFile() {
        logoFile = null;
        document.getElementById('remove_logo').value = '1';
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateLogoPreview();
    }

    function removeExistingLogo() {
        document.querySelector('[data-file-path="{{ $kelompok->logo }}"]')?.remove();
        document.getElementById('remove_logo').value = '1';
    }

    function previewFile(file, previewType) {
        currentPreview = {
            type: previewType,
            isExisting: false,
            file
        };
        originalFile = file;
        currentImageType = file.type; // Simpan tipe gambar
        rotatedImageUrl = URL.createObjectURL(file);
        showPreview(rotatedImageUrl, file.type);
    }

    function previewExistingFile(url, mimeType, previewType, path) {
        fetch(url)
            .then(res => res.blob())
            .then(blob => {
                const fileName = path.split('/').pop();
                const file = new File([blob], fileName, {
                    type: blob.type
                });
                originalFile = file;
                currentImageType = blob.type; // Simpan tipe gambar
                rotatedImageUrl = URL.createObjectURL(file);
                currentPreview = {
                    type: previewType,
                    isExisting: true,
                    path,
                    file
                };
                showPreview(rotatedImageUrl, blob.type);
            })
            .catch(error => console.error('Error fetching file:', error));
    }

    function showPreview(url, type) {
        const modal = document.getElementById('previewModal');
        const img = document.getElementById('previewImage');
        const frame = document.getElementById('previewFrame');
        img.classList.add('hidden');
        frame.classList.add('hidden');
        document.getElementById('cropperControls').classList.add('hidden');

        // Reset cropper state
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;

        if (type.startsWith('image/')) {
            img.src = url;
            img.classList.remove('hidden');
            document.getElementById('previewControls').classList.remove('hidden');
        } else if (type === 'application/pdf') {
            frame.src = url;
            frame.classList.remove('hidden');
            document.getElementById('previewControls').classList.add('hidden');
        }
        modal.classList.remove('hidden');
    }

    function toggleCropper() {
        const previewImage = document.getElementById('previewImage');
        if (!isCropping && currentPreview.type !== 'application/pdf') {
            isCropping = true;
            document.getElementById('previewControls').classList.add('hidden');
            document.getElementById('cropperControls').classList.remove('hidden');
            if (cropper) cropper.destroy();
            cropper = new Cropper(previewImage, {
                aspectRatio: NaN,
                viewMode: 1,
                autoCropArea: 0.8,
                background: false // Menonaktifkan background grid yang mungkin mengganggu transparansi
            });
        }
    }

    function rotateImage(degree) {
        const previewImage = document.getElementById('previewImage');

        // Jika cropper aktif, gunakan cropper untuk rotasi
        if (cropper) {
            cropper.rotate(degree);
            return;
        }

        // Jika bukan PDF, lakukan rotasi dengan canvas
        if (currentPreview.type !== 'application/pdf') {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.crossOrigin = "Anonymous"; // Tambahkan untuk handle CORS jika perlu
            img.src = rotatedImageUrl;
            img.onload = () => {
                // Menentukan ukuran canvas berdasarkan rotasi
                if (degree === 90 || degree === -270) {
                    canvas.width = img.height;
                    canvas.height = img.width;
                } else if (degree === -90 || degree === 270) {
                    canvas.width = img.height;
                    canvas.height = img.width;
                } else if (degree === 180 || degree === -180) {
                    canvas.width = img.width;
                    canvas.height = img.height;
                } else {
                    canvas.width = img.width;
                    canvas.height = img.height;
                }

                // Membersihkan canvas dengan transparansi
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Menempatkan titik tengah canvas
                ctx.translate(canvas.width / 2, canvas.height / 2);

                // Melakukan rotasi
                ctx.rotate((degree * Math.PI) / 180);

                // Menggambar gambar dengan mempertahankan transparansi
                ctx.drawImage(img, -img.width / 2, -img.height / 2);

                // Menentukan format file berdasarkan file asli
                let outputType = 'image/jpeg';
                if (currentImageType === 'image/png') {
                    outputType = 'image/png';
                }

                canvas.toBlob((blob) => {
                    if (blob) {
                        const newFile = new File([blob], currentPreview.file.name, {
                            type: outputType
                        });
                        updateCurrentFile(newFile);
                        rotatedImageUrl = URL.createObjectURL(blob);
                        previewImage.src = rotatedImageUrl;
                    }
                }, outputType);
            };
        }
    }

    function cropImage() {
        if (cropper) {
            // Menentukan format output berdasarkan file asli
            let outputType = 'image/jpeg';
            if (currentImageType === 'image/png') {
                outputType = 'image/png';
            }

            cropper.getCroppedCanvas({
                // Menonaktifkan background untuk mempertahankan transparansi
                backgroundColor: null,
                // Jika file asli PNG, pastikan output juga PNG
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            }).toBlob((blob) => {
                if (blob) {
                    const newFile = new File([blob], currentPreview.file.name, {
                        type: outputType
                    });
                    updateCurrentFile(newFile);
                    closePreview();
                }
            }, outputType);
        }
    }

    function updateCurrentFile(newFile) {
        if (currentPreview.type === 'sk_desa') {
            skDesaFile = newFile;
            // Reset remove flag karena kita mengganti file, bukan menghapusnya
            document.getElementById('remove_sk_desa').value = '0';
            // Hapus tampilan file lama jika ada
            if (currentPreview.isExisting) {
                document.querySelector(`[data-file-path="${currentPreview.path}"]`)?.remove();
            }
            // Perbarui input file
            const dt = new DataTransfer();
            dt.items.add(skDesaFile);
            document.getElementById('sk_desa').files = dt.files;
            // Perbarui tampilan preview
            updateSkDesaPreview();
        } else if (currentPreview.type === 'background') {
            backgroundFile = newFile;
            document.getElementById('remove_background').value = '0';
            if (currentPreview.isExisting) {
                document.querySelector(`[data-file-path="${currentPreview.path}"]`)?.remove();
            }
            const dt = new DataTransfer();
            dt.items.add(backgroundFile);
            document.getElementById('background').files = dt.files;
            updateBackgroundPreview();
        } else if (currentPreview.type === 'logo') {
            logoFile = newFile;
            document.getElementById('remove_logo').value = '0';
            if (currentPreview.isExisting) {
                document.querySelector(`[data-file-path="${currentPreview.path}"]`)?.remove();
            }
            const dt = new DataTransfer();
            dt.items.add(logoFile);
            document.getElementById('logo').files = dt.files;
            updateLogoPreview();
        }
    }

    function cancelCrop() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
            isCropping = false;
        }
        document.getElementById('cropperControls').classList.add('hidden');
        document.getElementById('previewControls').classList.remove('hidden');
        const previewImage = document.getElementById('previewImage');
        previewImage.src = URL.createObjectURL(originalFile);
        rotatedImageUrl = URL.createObjectURL(originalFile);
    }

    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
            isCropping = false;
        }
        originalFile = null;
        currentImageType = null;
        if (rotatedImageUrl) {
            URL.revokeObjectURL(rotatedImageUrl);
            rotatedImageUrl = null;
        }
    }

    // Tampilkan error dari backend jika ada
    document.addEventListener('DOMContentLoaded', function() {
        const errorMessage = "{{ $errors->first('nama') }}";
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: errorMessage,
                confirmButtonText: 'OK'
            });
        }
    });
</script>
@endsection