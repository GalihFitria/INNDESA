@extends('Admin.sidebar')

@section('title', 'Edit Katalog - INNDESA')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Katalog::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto">
    <form action="{{ route('Admin.katalog.update', $katalog->id_katalog) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Pilih Kelompok -->
        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}" {{ $katalog->id_kelompok == $k->id_kelompok ? 'selected' : '' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
            @error('id_kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- File Katalog -->
        <div class="mb-4">
            <label for="katalog" class="block text-sm font-medium text-gray-700">File Katalog</label>
            @if ($katalog->katalog)
            <div class="mb-2">
                <a href="#" onclick="event.preventDefault(); previewExistingFile('{{ asset('storage/' . $katalog->katalog) }}', '{{ str_ends_with($katalog->katalog, '.pdf') ? 'application/pdf' : 'image/' }}')" class="text-blue-600 hover:underline">{{ basename($katalog->katalog) }}</a>
            </div>
            @endif
            <input type="file" name="katalog" id="katalog" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <div id="katalog_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file yang dipilih.</p>
            </div>
            @error('katalog')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.katalog.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>

    <!-- Modal Preview -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-4 rounded-lg w-[800px] h-[600px] relative">
            <button onclick="closePreview()" class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded">✕</button>
            <div class="w-full h-[80%] flex items-center justify-center relative">
                <img id="previewImage" class="max-w-full max-h-full object-contain hidden" alt="File Preview">
                <iframe id="previewFrame" class="w-full h-full hidden" frameborder="0"></iframe>
            </div>
            <div id="previewControls" class="mt-4 flex space-x-2 justify-center">
                <button onclick="rotateImage(-90)" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    <i class="fas fa-rotate-left"></i>
                </button>
                <button onclick="rotateImage(90)" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    <i class="fas fa-rotate-right"></i>
                </button>
                <button onclick="toggleCropper()" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                    <i class="fas fa-crop-alt"></i>
                </button>
            </div>
            <div id="cropperControls" class="mt-4 flex space-x-2 justify-center hidden">
                <button onclick="cancelCrop()" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">
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
    let katalogFile = null;
    let cropper = null;
    let originalImageUrl = null;
    let rotatedImageUrl = null;
    let isCropping = false;

    document.getElementById('katalog').addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            katalogFile = files[0];
            updateKatalogPreview();
        }
    });

    function updateKatalogPreview() {
        const previewDiv = document.getElementById('katalog_filename');
        previewDiv.innerHTML = '';

        if (katalogFile) {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mb-2';

            const fileName = document.createElement('a');
            fileName.textContent = `${katalogFile.name}`;
            fileName.onclick = (e) => {
                e.preventDefault();
                previewFile(katalogFile);
            };
            fileName.href = '#';
            fileName.className = 'text-blue-500 hover:underline';

            const removeBtn = document.createElement('button');
            removeBtn.textContent = '×';
            removeBtn.className = 'text-red-500 hover:text-red-700 ml-2';
            removeBtn.onclick = (e) => {
                e.preventDefault();
                removeKatalogFile();
            };

            div.appendChild(fileName);
            div.appendChild(removeBtn);
            previewDiv.appendChild(div);
        } else {
            previewDiv.innerHTML = '<p>Tidak ada file yang dipilih.</p>';
        }
        const dt = new DataTransfer();
        if (katalogFile) dt.items.add(katalogFile);
        document.getElementById('katalog').files = dt.files;
    }

    function removeKatalogFile() {
        katalogFile = null;
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateKatalogPreview();
    }

    function previewFile(file) {
        const modal = document.getElementById('previewModal');
        const previewImage = document.getElementById('previewImage');
        const previewFrame = document.getElementById('previewFrame');
        const previewControls = document.getElementById('previewControls');
        const cropperControls = document.getElementById('cropperControls');
        originalImageUrl = URL.createObjectURL(file);
        rotatedImageUrl = originalImageUrl;

        previewImage.classList.add('hidden');
        previewFrame.classList.add('hidden');
        cropperControls.classList.add('hidden');
        previewControls.classList.remove('hidden');
        previewImage.src = '';
        previewFrame.src = '';

        if (file.type.startsWith('image/')) {
            previewImage.src = rotatedImageUrl;
            previewImage.classList.remove('hidden');
        } else if (file.type === 'application/pdf') {
            previewFrame.src = rotatedImageUrl;
            previewFrame.classList.remove('hidden');
            previewControls.classList.add('hidden');
        } else {
            alert('Pratinjau hanya tersedia untuk gambar dan PDF.');
            return;
        }

        modal.classList.remove('hidden');
    }

    function previewExistingFile(url, type) {
        const modal = document.getElementById('previewModal');
        const previewImage = document.getElementById('previewImage');
        const previewFrame = document.getElementById('previewFrame');
        const previewControls = document.getElementById('previewControls');
        const cropperControls = document.getElementById('cropperControls');
        originalImageUrl = url;
        rotatedImageUrl = originalImageUrl;

        previewImage.classList.add('hidden');
        previewFrame.classList.add('hidden');
        cropperControls.classList.add('hidden');
        previewControls.classList.remove('hidden');
        previewImage.src = '';
        previewFrame.src = '';

        if (type.startsWith('image/')) {
            previewImage.src = rotatedImageUrl;
            previewImage.classList.remove('hidden');
        } else if (type === 'application/pdf') {
            previewFrame.src = rotatedImageUrl;
            previewFrame.classList.remove('hidden');
            previewControls.classList.add('hidden');
        } else {
            alert('Pratinjau hanya tersedia untuk gambar dan PDF.');
            return;
        }

        modal.classList.remove('hidden');
    }

    function toggleCropper() {
        const previewImage = document.getElementById('previewImage');
        const previewControls = document.getElementById('previewControls');
        const cropperControls = document.getElementById('cropperControls');

        if (!isCropping) {
            isCropping = true;
            previewControls.classList.add('hidden');
            cropperControls.classList.remove('hidden');
            if (cropper) cropper.destroy();
            cropper = new Cropper(previewImage, {
                aspectRatio: NaN,
                viewMode: 1,
                autoCropArea: 0.8,
                responsive: true,
            });
        }
    }

    function rotateImage(degree) {
        const previewImage = document.getElementById('previewImage');
        if (!cropper) {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.src = rotatedImageUrl;
            img.onload = () => {
                canvas.width = img.height;
                canvas.height = img.width;
                ctx.translate(canvas.width / 2, canvas.height / 2);
                ctx.rotate((degree * Math.PI) / 180);
                ctx.drawImage(img, -img.width / 2, -img.height / 2);
                rotatedImageUrl = canvas.toDataURL('image/jpeg');
                previewImage.src = rotatedImageUrl;
                canvas.toBlob((blob) => {
                    if (blob) {
                        katalogFile = new File([blob], katalogFile ? katalogFile.name : 'file.jpg', {
                            type: 'image/jpeg'
                        });
                        updateKatalogPreview();
                    }
                }, 'image/jpeg');
            };
        } else {
            cropper.rotate(degree);
        }
    }

    function cropImage() {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                if (blob) {
                    katalogFile = new File([blob], katalogFile ? katalogFile.name : 'file.jpg', {
                        type: 'image/jpeg'
                    });
                    updateKatalogPreview();
                    closePreview();
                } else {
                    alert('Gagal memotong gambar. Silakan coba lagi.');
                }
            }, 'image/jpeg');
        } else {
            alert('Cropper belum diinisialisasi.');
        }
    }

    function cancelCrop() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
            const previewImage = document.getElementById('previewImage');
            previewImage.src = rotatedImageUrl;
            document.getElementById('cropperControls').classList.add('hidden');
            document.getElementById('previewControls').classList.remove('hidden');
            isCropping = false;
        }
    }

    function closePreview() {
        const modal = document.getElementById('previewModal');
        const previewImage = document.getElementById('previewImage');
        const previewFrame = document.getElementById('previewFrame');
        const previewControls = document.getElementById('previewControls');
        const cropperControls = document.getElementById('cropperControls');
        modal.classList.add('hidden');
        previewImage.src = '';
        previewFrame.src = '';
        previewControls.classList.add('hidden');
        cropperControls.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        if (originalImageUrl) URL.revokeObjectURL(originalImageUrl);
        if (rotatedImageUrl) URL.revokeObjectURL(rotatedImageUrl);
    }

    document.getElementById('previewModal').addEventListener('click', function(e) {
        if (e.target === this) closePreview();
    });
</script>
@endsection