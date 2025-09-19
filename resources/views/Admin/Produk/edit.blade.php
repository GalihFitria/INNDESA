@extends('Admin.sidebar')

@section('title', 'Edit Produk - INNDESA')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Produk::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto max-h-[500px] overflow-y-auto">
    <form action="{{ route('Admin.produk.update', $produk->id_produk) }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="produkForm">
        @csrf
        @method('PUT')

        {{-- Pilih Kelompok --}}
        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}" {{ old('id_kelompok', $produk->id_kelompok) == $k->id_kelompok ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
            @error('id_kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Nama Produk --}}
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('nama')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Harga --}}
        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="text" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('harga')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Stok --}}
        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="text" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('stok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Foto Produk --}}
        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk</label>
            @if ($produk->foto)
            <div class="mb-2" data-file-path="{{ $produk->foto }}">
                <a href="#" onclick="event.preventDefault(); previewExistingFile('{{ asset('storage/' . $produk->foto) }}', 'image/', 'foto', '{{ $produk->foto }}')" class="text-blue-600 hover:underline">
                    {{ basename($produk->foto) }}
                </a>
                <button type="button" onclick="removeExistingFoto()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>
            @endif
            <input type="file" name="foto" id="foto" accept=".jpg,.jpeg,.png" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <input type="hidden" name="remove_foto" id="remove_foto" value="0">
            <div id="foto_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file baru yang dipilih.</p>
            </div>
            @error('foto')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Sertifikat --}}
        <div>
            <label for="sertifikat" class="block text-sm font-medium text-gray-700">Sertifikat</label>
            @php $sertifikatPaths = $produk->sertifikat ? json_decode($produk->sertifikat, true) : []; @endphp
            @foreach ($sertifikatPaths as $i => $path)
            <div class="mb-2" data-file-path="{{ $path }}">
                <a href="#" onclick="event.preventDefault(); previewExistingFile('{{ asset('storage/' . $path) }}', '{{ str_ends_with($path, '.pdf') ? 'application/pdf' : 'image/' }}', 'sertifikat', '{{ $path }}')" class="text-blue-600 hover:underline">
                    {{ $i+1 }}. {{ basename($path) }}
                </a>
                <button type="button" onclick="removeExistingSertifikatFile('{{ $path }}')" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>
            @endforeach

            <input type="file" name="sertifikat[]" id="sertifikat" accept=".pdf,.jpg,.jpeg,.png" multiple class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            <div id="sertifikat_filename" class="mt-2 text-sm text-gray-600">
                <p>Tidak ada file baru yang dipilih.</p>
            </div>
            <div id="removed_sertifikat_container"></div>
            <div id="existing_sertifikat_container">
                @foreach ($sertifikatPaths as $path)
                <input type="hidden" name="existing_sertifikat[]" value="{{ $path }}">
                @endforeach
            </div>
            @error('sertifikat.*')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Produk Terjual (Read-Only, default 0) --}}
        <div>
            <label for="produk_terjual" class="block text-sm font-medium text-gray-700">Produk Terjual</label>
            <input type="text" name="produk_terjual" id="produk_terjual" value="0" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" readonly required>
            @error('produk_terjual')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- Modal Preview --}}
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

{{-- Script --}}
<script>
    let fotoFile = null;
    let sertifikatFiles = [];
    let currentPreview = {
        type: null,
        index: null,
        isExisting: false,
        path: null,
        file: null
    };
    let cropper = null;
    let rotatedImageUrl = null;
    let isCropping = false;
    let originalFile = null;

    document.getElementById('foto').addEventListener('change', e => {
        fotoFile = e.target.files[0] || null;
        document.getElementById('remove_foto').value = '0';
        updateFotoPreview();
    });

    function updateFotoPreview() {
        const previewDiv = document.getElementById('foto_filename');
        previewDiv.innerHTML = fotoFile ?
            `<div class="flex items-center gap-2 mb-2">
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(fotoFile, 'foto', 0)">${fotoFile.name}</a>
                <button type="button" onclick="removeFotoFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            </div>` :
            '<p>Tidak ada file baru yang dipilih.</p>';

        const dt = new DataTransfer();
        if (fotoFile) dt.items.add(fotoFile);
        document.getElementById('foto').files = dt.files;
    }

    function removeFotoFile() {
        fotoFile = null;
        document.getElementById('remove_foto').value = '1';
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        isCropping = false;
        updateFotoPreview();
    }

    function removeExistingFoto() {
        document.querySelector('[data-file-path="{{ $produk->foto }}"]')?.remove();
        document.getElementById('remove_foto').value = '1';
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
            previewDiv.innerHTML = '<p>Tidak ada file baru yang dipilih.</p>';
        }
        const dt = new DataTransfer();
        sertifikatFiles.forEach(f => dt.items.add(f));
        document.getElementById('sertifikat').files = dt.files;
    }

    function removeSertifikatFile(index) {
        sertifikatFiles.splice(index, 1);
        updateSertifikatPreview();
    }

    function addRemovedSertifikat(path) {
        const container = document.getElementById('removed_sertifikat_container');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'removed_sertifikat[]';
        input.value = path;
        container.appendChild(input);
        // Remove from existing_sertifikat_container
        const existingInputs = document.querySelectorAll('#existing_sertifikat_container input[value="' + path + '"]');
        existingInputs.forEach(input => input.remove());
    }

    function removeExistingSertifikatFile(path) {
        addRemovedSertifikat(path);
        document.querySelector(`[data-file-path="${path}"]`)?.remove();
    }

    function previewFile(file, previewType, index) {
        currentPreview = {
            type: previewType,
            index,
            isExisting: false,
            path: null,
            file
        };
        originalFile = file;
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
                rotatedImageUrl = URL.createObjectURL(file);
                currentPreview = {
                    type: previewType,
                    index: null,
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
            if (currentPreview.isExisting) {
                document.getElementById('remove_foto').value = '1';
                document.querySelector(`[data-file-path="${currentPreview.path}"]`)?.remove();
            }
            updateFotoPreview();
        } else if (currentPreview.type === 'sertifikat') {
            if (currentPreview.isExisting) {
                addRemovedSertifikat(currentPreview.path);
                sertifikatFiles.push(newFile);
                document.querySelector(`[data-file-path="${currentPreview.path}"]`)?.remove();
            } else {
                sertifikatFiles[currentPreview.index] = newFile;
            }
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