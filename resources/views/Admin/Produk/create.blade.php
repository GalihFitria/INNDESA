@extends('Admin.sidebar')

@section('title', 'Tambah Produk - INNDESA')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Tambah Produk::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto max-h-[500px] overflow-y-auto">
    <form action="{{ route('Admin.produk.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="produkForm">
        @csrf

        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('id_kelompok') border-red-500 @enderror select2"
                style="width: 100%;" required>
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}">{{ $k->nama }}</option>
                @endforeach
            </select>
            @error('id_kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Nama Produk" required>
            @error('nama')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="text" name="harga" id="harga" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Harga Produk" required>
            @error('harga')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="text" name="stok" id="stok" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Stok Produk" required>
            @error('stok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk</label>
            <input type="file" name="foto" id="foto" accept=".jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <div id="foto_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file yang dipilih.</p>
            </div>
            @error('foto')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Deskripsi Produk" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="sertifikat" class="block text-sm font-medium text-gray-700">Sertifikat</label>
            <input type="file" name="sertifikat[]" id="sertifikat" accept=".pdf,.jpg,.jpeg,.png" multiple class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <div id="sertifikat_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file yang dipilih.</p>
            </div>
            @error('sertifikat.*')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
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


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_kelompok').select2({
            placeholder: "-- Pilih Kelompok --",
            allowClear: true
        });
    });

    let fotoFile = null;
    let sertifikatFiles = [];
    let currentPreview = {
        type: null,
        index: null,
        isExisting: false,
        file: null
    };
    let cropper = null;
    let rotatedImageUrl = null;
    let isCropping = false;
    let originalFile = null;

    // Foto Produk
    document.getElementById('foto').addEventListener('change', e => {
        fotoFile = e.target.files[0] || null;
        updateFotoPreview();
    });

    function updateFotoPreview() {
        const previewDiv = document.getElementById('foto_filename');
        previewDiv.innerHTML = fotoFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(fotoFile, 'foto', 0)">${fotoFile.name}</a>
                <button type="button" onclick="removeFotoFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file yang dipilih.</p>';

        const dt = new DataTransfer();
        if (fotoFile) dt.items.add(fotoFile);
        document.getElementById('foto').files = dt.files;
    }

    function removeFotoFile() {
        fotoFile = null;
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateFotoPreview();
    }

    document.getElementById('sertifikat').addEventListener('change', e => {
        Array.from(e.target.files).forEach(file => {
            if (!sertifikatFiles.some(f => f.name === file.name)) {
                sertifikatFiles.push(file);
            }
        });
        updateSertifikatPreview();
    });

    function updateSertifikatPreview() {
        const previewDiv = document.getElementById('sertifikat_filename');
        previewDiv.innerHTML = '';
        sertifikatFiles.forEach((file, i) => {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mb-2';
            div.innerHTML = `<a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(sertifikatFiles[${i}], 'sertifikat', ${i})">${i+1}. ${file.name}</a>
                             <button type="button" onclick="removeSertifikatFile(${i})" class="text-red-500 hover:text-red-700 ml-2">×</button>`;
            previewDiv.appendChild(div);
        });
        if (!sertifikatFiles.length) {
            previewDiv.innerHTML = '<p>Tidak ada file yang dipilih.</p>';
        }
        const dt = new DataTransfer();
        sertifikatFiles.forEach(f => dt.items.add(f));
        document.getElementById('sertifikat').files = dt.files;
    }

    function removeSertifikatFile(index) {
        sertifikatFiles.splice(index, 1);
        updateSertifikatPreview();
    }

    function previewFile(file, previewType, index) {
        currentPreview = {
            type: previewType,
            index,
            isExisting: false,
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
        if (!isCropping) {
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
        if (currentPreview.type === 'foto') {
            fotoFile = newFile;
            updateFotoPreview();
        } else if (currentPreview.type === 'sertifikat') {
            sertifikatFiles[currentPreview.index] = newFile;
            updateSertifikatPreview();
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