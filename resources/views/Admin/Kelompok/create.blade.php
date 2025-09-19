
@extends('Admin.sidebar')

@section('title', 'Tambah Kelompok - INNDESA')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Tambah Kelompok::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto max-h-[500px] overflow-y-auto">
    <form action="{{ route('Admin.kelompok.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="kelompokForm">
        @csrf

        <div class="mb-4">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="id_kategori" id="id_kategori" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
            @error('id_kategori')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" value="{{ old('nama') }}" placeholder="Masukkan Nama Kelompok" required>
            @error('nama')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="sejarah" class="block text-sm font-medium text-gray-700">Sejarah</label>
            <textarea name="sejarah" id="sejarah" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Sejarah Kelompok" rows="5" required>{{ old('sejarah') }}</textarea>
            @error('sejarah')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="sk_desa" class="block text-sm font-medium text-gray-700">SK Desa (opsional)</label>
            <input type="file" name="sk_desa" id="sk_desa" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <div id="sk_desa_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file yang dipilih.</p>
            </div>
            @error('sk_desa')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="background" class="block text-sm font-medium text-gray-700">Background</label>
            <input type="file" name="background" id="background" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
            <div id="background_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file yang dipilih.</p>
            </div>
            @error('background')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo (opsional)</label>
            <input type="file" name="logo" id="logo" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <div id="logo_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file yang dipilih.</p>
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
                <i class="fas fa-save mr-2"></i>Simpan
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
        file: null
    };
    let cropper = null;
    let rotatedImageUrl = null;
    let isCropping = false;
    let originalFile = null;

    // SK Desa
    document.getElementById('sk_desa').addEventListener('change', e => {
        skDesaFile = e.target.files[0] || null;
        updateSkDesaPreview();
    });

    function updateSkDesaPreview() {
        const previewDiv = document.getElementById('sk_desa_filename');
        previewDiv.innerHTML = skDesaFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(skDesaFile, 'sk_desa')">${skDesaFile.name}</a>
                <button type="button" onclick="removeSkDesaFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file yang dipilih.</p>';

        const dt = new DataTransfer();
        if (skDesaFile) dt.items.add(skDesaFile);
        document.getElementById('sk_desa').files = dt.files;
    }

    function removeSkDesaFile() {
        skDesaFile = null;
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateSkDesaPreview();
    }

    // Background
    document.getElementById('background').addEventListener('change', e => {
        backgroundFile = e.target.files[0] || null;
        updateBackgroundPreview();
    });

    function updateBackgroundPreview() {
        const previewDiv = document.getElementById('background_filename');
        previewDiv.innerHTML = backgroundFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(backgroundFile, 'background')">${backgroundFile.name}</a>
                <button type="button" onclick="removeBackgroundFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file yang dipilih.</p>';

        const dt = new DataTransfer();
        if (backgroundFile) dt.items.add(backgroundFile);
        document.getElementById('background').files = dt.files;
    }

    function removeBackgroundFile() {
        backgroundFile = null;
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateBackgroundPreview();
    }

    // Logo
    document.getElementById('logo').addEventListener('change', e => {
        logoFile = e.target.files[0] || null;
        updateLogoPreview();
    });

    function updateLogoPreview() {
        const previewDiv = document.getElementById('logo_filename');
        previewDiv.innerHTML = logoFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(logoFile, 'logo')">${logoFile.name}</a>
                <button type="button" onclick="removeLogoFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file yang dipilih.</p>';

        const dt = new DataTransfer();
        if (logoFile) dt.items.add(logoFile);
        document.getElementById('logo').files = dt.files;
    }

    function removeLogoFile() {
        logoFile = null;
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateLogoPreview();
    }

    function previewFile(file, previewType) {
        currentPreview = {
            type: previewType,
            file
        };
        originalFile = file;
        rotatedImageUrl = URL.createObjectURL(file);
        showPreview(rotatedImageUrl, file.type);
    }

    function showPreview(url, type) {
        const modal = document.getElementById('previewModal');
        const img = document.getElementById('previewImage');
        const frame = document.getElementById('previewFrame');
        img.classList.add('hidden');
        frame.classList.add('hidden');
        document.getElementById('cropperControls').classList.add('hidden');
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
                autoCropArea: 0.8
            });
        }
    }

    function rotateImage(degree) {
        const previewImage = document.getElementById('previewImage');
        if (cropper) {
            cropper.rotate(degree);
            return;
        }
        if (currentPreview.type !== 'application/pdf') {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.src = rotatedImageUrl;
            img.onload = () => {
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
                ctx.translate(canvas.width / 2, canvas.height / 2);
                ctx.rotate((degree * Math.PI) / 180);
                ctx.drawImage(img, -img.width / 2, -img.height / 2);
                rotatedImageUrl = canvas.toDataURL('image/jpeg');
                previewImage.src = rotatedImageUrl;
                canvas.toBlob((blob) => {
                    if (blob) {
                        const newFile = new File([blob], currentPreview.file.name, {
                            type: 'image/jpeg'
                        });
                        updateCurrentFile(newFile);
                    }
                }, 'image/jpeg');
            };
        }
    }

    function cropImage() {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                if (blob) {
                    const newFile = new File([blob], currentPreview.file.name, {
                        type: 'image/jpeg'
                    });
                    updateCurrentFile(newFile);
                    closePreview();
                }
            }, 'image/jpeg');
        }
    }

    function updateCurrentFile(newFile) {
        if (currentPreview.type === 'sk_desa') {
            skDesaFile = newFile;
            updateSkDesaPreview();
        } else if (currentPreview.type === 'background') {
            backgroundFile = newFile;
            updateBackgroundPreview();
        } else if (currentPreview.type === 'logo') {
            logoFile = newFile;
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
        if (rotatedImageUrl) {
            URL.revokeObjectURL(rotatedImageUrl);
            rotatedImageUrl = null;
        }
    }
</script>
@endsection