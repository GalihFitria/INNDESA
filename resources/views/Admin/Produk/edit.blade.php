@extends('Admin.sidebar')

@section('title', 'Edit Produk - INNDESA')
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<h2 class="text-center text-4xl font-bold text-gray-800 mb-6">.::Edit Produk::.</h2>
<div class="bg-white shadow-md p-4 rounded-lg max-w-2xl mx-auto max-h-[500px] overflow-y-auto">
    <form action="{{ route('Admin.produk.update', $produk->id_produk) }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="produkForm">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="id_kelompok" class="block text-sm font-medium text-gray-700">Nama Kelompok</label>
            <select name="id_kelompok" id="id_kelompok"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('id_kelompok') border-red-500 @enderror select2"
                style="width: 100%;" required data-original-value="{{ $produk->id_kelompok }}">
                <option value="">-- Pilih Kelompok --</option>
                @foreach ($kelompok as $k)
                <option value="{{ $k->id_kelompok }}"
                    {{ old('id_kelompok', $produk->id_kelompok ?? '') == $k->id_kelompok ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
            @error('id_kelompok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required data-original-value="{{ $produk->nama }}">
            <span id="namaWarning" class="text-red-500 text-sm hidden">Produk dengan nama ini sudah ada dalam kelompok yang dipilih.</span>
            @error('nama')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="text" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
            @error('harga')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <input type="text" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                @error('stok')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
                <select name="satuan" id="satuan" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 @error('satuan') border-red-500 @enderror select2" style="width: 100%;" required>
                    <option value="">-- Pilih Satuan --</option>
                    <option value="kg" {{ old('satuan', $produk->satuan ?? '') == 'kg' ? 'selected' : '' }}>Kg</option>
                    <option value="gram" {{ old('satuan', $produk->satuan ?? '') == 'gram' ? 'selected' : '' }}>Gram</option>
                    <option value="ons" {{ old('satuan', $produk->satuan ?? '') == 'ons' ? 'selected' : '' }}>Ons</option>
                    <option value="liter" {{ old('satuan', $produk->satuan ?? '') == 'liter' ? 'selected' : '' }}>Liter</option>
                    <option value="bungkus" {{ old('satuan', $produk->satuan ?? '') == 'bungkus' ? 'selected' : '' }}>Bungkus</option>
                    <option value="pack" {{ old('satuan', $produk->satuan ?? '') == 'pack' ? 'selected' : '' }}>Pack</option>
                    <option value="sachet" {{ old('satuan', $produk->satuan ?? '') == 'sachet' ? 'selected' : '' }}>Sachet</option>
                    <option value="buah" {{ old('satuan', $produk->satuan ?? '') == 'buah' ? 'selected' : '' }}>Buah</option>
                    <option value="ikat" {{ old('satuan', $produk->satuan ?? '') == 'ikat' ? 'selected' : '' }}>Ikat</option>
                    <option value="butir" {{ old('satuan', $produk->satuan ?? '') == 'butir' ? 'selected' : '' }}>Butir</option>
                    <option value="ekor" {{ old('satuan', $produk->satuan ?? '') == 'ekor' ? 'selected' : '' }}>Ekor</option>
                    <option value="potong" {{ old('satuan', $produk->satuan ?? '') == 'potong' ? 'selected' : '' }}>Potong</option>
                    <option value="batang" {{ old('satuan', $produk->satuan ?? '') == 'batang' ? 'selected' : '' }}>Batang</option>
                    <option value="pcs" {{ old('satuan', $produk->satuan ?? '') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                </select>
                @error('satuan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Produk <span class="text-red-500">*</span></label>
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

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="sertifikat" class="block text-sm font-medium text-gray-700">Sertifikat</label>
            @php
            $sertifikatPaths = $produk->sertifikat ? explode(',', $produk->sertifikat) : [];
            @endphp
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

        <div>
            <label for="produk_terjual" class="block text-sm font-medium text-gray-700">Produk Terjual</label>
            <div class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-gray-100 text-gray-600">
                {{ $produk->produk_terjual ?? 0 }}
            </div>
            <input type="hidden" name="produk_terjual" value="{{ $produk->produk_terjual ?? 0 }}" id="produk_terjual">
            <p class="mt-1 text-sm text-gray-500">Field ini tidak dapat diubah</p>
            @error('produk_terjual')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('Admin.produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
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


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#id_kelompok').select2({
            placeholder: "-- Pilih Kelompok --",
            allowClear: true
        });

        $('#satuan').select2({
            placeholder: "-- Pilih Satuan --",
            allowClear: true
        });

        const namaInput = document.getElementById('nama');
        const kelompokSelect = document.getElementById('id_kelompok');
        const warningElement = document.getElementById('namaWarning');
        const originalNama = namaInput.getAttribute('data-original-value');
        const originalKelompok = kelompokSelect.getAttribute('data-original-value');

        function validateCombination() {
            const currentName = namaInput.value.trim();
            const currentKelompok = kelompokSelect.value;

            if ((currentName !== originalNama || currentKelompok !== originalKelompok) && currentName && currentKelompok) {
                const sampleData = [{
                        nama: 'Produk A',
                        kelompok: '1'
                    },
                    {
                        nama: 'Produk B',
                        kelompok: '2'
                    },
                    {
                        nama: 'Produk C',
                        kelompok: '1'
                    }
                ];

                const isDuplicate = sampleData.some(item =>
                    item.nama === currentName && item.kelompok === currentKelompok
                );

                if (isDuplicate) {
                    warningElement.classList.remove('hidden');
                    namaInput.setCustomValidity('Produk dengan nama ini sudah ada dalam kelompok yang dipilih.');
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

        namaInput.addEventListener('input', validateCombination);
        kelompokSelect.addEventListener('change', validateCombination);

        document.getElementById('produkForm').addEventListener('submit', function(e) {
            const removeFoto = document.getElementById('remove_foto').value;
            const fotoInput = document.getElementById('foto');
            const hasNewFoto = fotoInput.files.length > 0;
            const hasExistingFoto = document.querySelector('[data-file-path="{{ $produk->foto }}"]') !== null;

            if (removeFoto === '1' && !hasNewFoto && !hasExistingFoto) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: 'Foto produk tidak boleh kosong. Silakan unggah foto baru.',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (!validateCombination()) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: 'Produk dengan nama ini sudah ada dalam kelompok yang dipilih.',
                    confirmButtonText: 'OK'
                });
            }
        });

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

    // Variabel global
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
    let lastEditedFile = null; // Untuk melacak file terakhir yang diedit

    // Event listeners
    document.getElementById('foto').addEventListener('change', handleFotoChange);
    document.getElementById('sertifikat').addEventListener('change', handleSertifikatChange);

    function handleFotoChange(e) {
        const file = e.target.files[0] || null;
        if (file) {
            setFotoFile(file);
        }
    }

    function handleSertifikatChange(e) {
        Array.from(e.target.files).forEach(file => {
            if (!sertifikatFiles.some(f => f.name === file.name)) {
                sertifikatFiles.push(file);
            }
        });
        updateSertifikatPreview();
    }

    function setFotoFile(file) {
        // Clean up previous URL if exists
        if (rotatedImageUrl) {
            URL.revokeObjectURL(rotatedImageUrl);
            rotatedImageUrl = null;
        }

        fotoFile = file;
        originalFile = file;
        lastEditedFile = file;
        document.getElementById('remove_foto').value = '0';
        updateFotoPreview();
    }

    function updateFotoPreview() {
        const previewDiv = document.getElementById('foto_filename');
        previewDiv.innerHTML = '';

        if (fotoFile) {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mb-2';
            div.innerHTML = `
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(fotoFile, 'foto', 0)">${fotoFile.name}</a>
                <button type="button" onclick="removeFotoFile()" class="text-red-500 hover:text-red-700 ml-2">×</button>
            `;
            previewDiv.appendChild(div);
        } else {
            previewDiv.innerHTML = '<p>Tidak ada file baru yang dipilih.</p>';
        }

        // Update file input
        const dt = new DataTransfer();
        if (fotoFile) dt.items.add(fotoFile);
        document.getElementById('foto').files = dt.files;
    }

    function removeFotoFile() {
        // Clean up URL
        if (rotatedImageUrl) {
            URL.revokeObjectURL(rotatedImageUrl);
            rotatedImageUrl = null;
        }

        fotoFile = null;
        originalFile = null;
        lastEditedFile = null;
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

    function updateSertifikatPreview() {
        const previewDiv = document.getElementById('sertifikat_filename');
        previewDiv.innerHTML = '';

        sertifikatFiles.forEach((file, i) => {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mb-2';
            div.innerHTML = `
                <a href="#" class="text-blue-500 hover:underline" onclick="event.preventDefault(); previewFile(sertifikatFiles[${i}], 'sertifikat', ${i})">${i+1}. ${file.name}</a>
                <button type="button" onclick="removeSertifikatFile(${i})" class="text-red-500 hover:text-red-700 ml-2">×</button>
            `;
            previewDiv.appendChild(div);
        });

        if (!sertifikatFiles.length) {
            previewDiv.innerHTML = '<p>Tidak ada file baru yang dipilih.</p>';
        }

        // Update file input
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
        const existingInputs = document.querySelectorAll('#existing_sertifikat_container input[value="' + path + '"]');
        existingInputs.forEach(input => input.remove());
    }

    function removeExistingSertifikatFile(path) {
        addRemovedSertifikat(path);
        document.querySelector(`[data-file-path="${path}"]`)?.remove();
    }

    function previewFile(file, previewType, index) {
        // Clean up previous URLs
        cleanupPreviewResources();

        currentPreview = {
            type: previewType,
            index,
            isExisting: false,
            path: null,
            file
        };
        originalFile = file;
        lastEditedFile = file;
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

                // Clean up previous URLs
                cleanupPreviewResources();

                originalFile = file;
                lastEditedFile = file;
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

    function cleanupPreviewResources() {
        if (rotatedImageUrl) {
            URL.revokeObjectURL(rotatedImageUrl);
            rotatedImageUrl = null;
        }

        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        isCropping = false;
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

        // Store current URL for cleanup
        const currentImageUrl = rotatedImageUrl;

        img.src = currentImageUrl;
        img.onload = () => {
            // Set canvas dimensions based on rotation
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

            // Apply rotation
            ctx.translate(canvas.width / 2, canvas.height / 2);
            ctx.rotate((degree * Math.PI) / 180);
            ctx.drawImage(img, -img.width / 2, -img.height / 2);

            canvas.toBlob((blob) => {
                if (blob) {
                    // Clean up old URL
                    if (currentImageUrl) {
                        URL.revokeObjectURL(currentImageUrl);
                    }

                    // Create new URL
                    rotatedImageUrl = URL.createObjectURL(blob);
                    previewImage.src = rotatedImageUrl;

                    // Create new file
                    const newFile = new File([blob], currentPreview.file.name, {
                        type: 'image/jpeg'
                    });

                    // Update current file
                    lastEditedFile = newFile;
                }
            }, 'image/jpeg');
        };
    }

    function cropImage() {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                if (blob) {
                    // Clean up old URL
                    if (rotatedImageUrl) {
                        URL.revokeObjectURL(rotatedImageUrl);
                    }

                    // Create new URL
                    rotatedImageUrl = URL.createObjectURL(blob);

                    // Create new file
                    const newFile = new File([blob], currentPreview.file.name, {
                        type: 'image/jpeg'
                    });

                    // Update current file
                    lastEditedFile = newFile;

                    // Close preview
                    closePreview();
                }
            }, 'image/jpeg');
        }
    }

    function updateCurrentFile(newFile) {
        if (currentPreview.type === 'foto') {
            // Update foto file
            fotoFile = newFile;

            if (currentPreview.isExisting) {
                document.getElementById('remove_foto').value = '1';
                const existingElement = document.querySelector(`[data-file-path="${currentPreview.path}"]`);
                if (existingElement) {
                    existingElement.remove();
                }
            }

            updateFotoPreview();
        } else if (currentPreview.type === 'sertifikat') {
            if (currentPreview.isExisting) {
                addRemovedSertifikat(currentPreview.path);
                sertifikatFiles.push(newFile);
                const existingElement = document.querySelector(`[data-file-path="${currentPreview.path}"]`);
                if (existingElement) {
                    existingElement.remove();
                }
            } else {
                sertifikatFiles[currentPreview.index] = newFile;
            }
            updateSertifikatPreview();
        }

        // Update original and last edited file
        originalFile = newFile;
        lastEditedFile = newFile;
    }

    function cancelCrop() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        isCropping = false;
        document.getElementById('cropperControls').classList.add('hidden');
        document.getElementById('previewControls').classList.remove('hidden');

        const previewImage = document.getElementById('previewImage');

        // Clean up current URL
        if (rotatedImageUrl) {
            URL.revokeObjectURL(rotatedImageUrl);
        }

        // Restore to last edited file
        rotatedImageUrl = URL.createObjectURL(lastEditedFile);
        previewImage.src = rotatedImageUrl;
    }

    function closePreview() {
        // If we have a last edited file, update the current file
        if (lastEditedFile && lastEditedFile !== originalFile) {
            updateCurrentFile(lastEditedFile);
        }

        // Clean up resources
        cleanupPreviewResources();

        // Reset variables
        originalFile = null;
        lastEditedFile = null;

        // Hide modal
        document.getElementById('previewModal').classList.add('hidden');
    }
</script>
@endsection