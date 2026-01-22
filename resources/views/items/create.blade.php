@extends('layouts.app')

@section('title', 'Lapor Barang - Lost & Found UNIDA Gontor')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Lapor Barang</h1>
        <p class="text-gray-600">Isi formulir di bawah dengan lengkap dan jujur</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 max-w-3xl mx-auto">
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Report Type -->
            <div>
                <label class="block text-base font-semibold text-gray-800 mb-4">Jenis Laporan</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative flex flex-col items-center justify-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-teal transition has-[:checked]:border-teal has-[:checked]:bg-teal/5">
                        <input type="radio" name="type" value="lost" class="peer sr-only" {{ request('type') == 'found' ? '' : 'checked' }}>
                        <div class="text-center">
                            <div class="font-semibold text-gray-800 mb-1">Kehilangan</div>
                            <div class="text-sm text-teal">Saya kehilangan barang</div>
                        </div>
                    </label>

                    <label class="relative flex flex-col items-center justify-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-teal transition has-[:checked]:border-teal has-[:checked]:bg-teal/5">
                        <input type="radio" name="type" value="found" class="peer sr-only" {{ request('type') == 'found' ? 'checked' : '' }}>
                        <div class="text-center">
                            <div class="font-semibold text-gray-800 mb-1">Menemukan</div>
                            <div class="text-sm text-teal">Saya menemukan barang</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Item Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-800 mb-2">
                    Nama Barang <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    required 
                    value="{{ old('name') }}"
                    placeholder="Contoh: Kunci Motor Vario Hitam"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-800 mb-2">
                    Kategori Barang <span class="text-red-500">*</span>
                </label>
                <select 
                    id="category_id" 
                    name="category_id" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal bg-white"
                >
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date (Dynamic based on type) -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-800 mb-2">
                    <span id="date-label">Tanggal Hilang</span> <span class="text-red-500">*</span>
                </label>
                <input 
                    type="date" 
                    id="date" 
                    name="date" 
                    required 
                    max="{{ date('Y-m-d') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                >
            </div>

            <!-- Location (Dynamic based on type) -->
            <div>
                <label for="location_id" class="block text-sm font-medium text-gray-800 mb-2">
                    <span id="location-label">Lokasi Terakhir</span> <span class="text-red-500">*</span>
                </label>
                <select 
                    id="location_id" 
                    name="location_id" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal bg-white"
                >
                    <option value="">Pilih Lokasi</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-800 mb-2">
                    Deskripsi Rinci <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="5" 
                    required
                    placeholder="Jelaskan ciri khusus seperti merk, warna, goresan, atau stiker..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal resize-none"
                >{{ old('description') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Semakin detail deskripsi, semakin mudah barang dikenali</p>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-800 mb-2">
                    Unggah Foto Barang <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-teal transition cursor-pointer" onclick="document.getElementById('images').click()">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p class="text-gray-600 font-medium mb-1">Klik atau seret foto ke sini</p>
                    <p class="text-sm text-gray-500">Format: JPG, PNG (Max 5MB)</p>
                    <input 
                        type="file" 
                        id="images" 
                        name="images[]" 
                        multiple 
                        accept="image/*"
                        required
                        class="hidden"
                        onchange="displayFileNames(this)"
                    >
                </div>
                <div id="fileNames" class="mt-2 text-sm text-gray-600"></div>
                <p class="mt-1 text-sm text-gray-500">Foto sangat penting untuk verifikasi kepemilikan</p>
            </div>

            <!-- Reward Section (only shown when type is "lost") -->
            <div id="reward-section" class="space-y-3">
                <label class="flex items-start space-x-3 cursor-pointer">
                    <input 
                        type="checkbox" 
                        id="offer_reward_checkbox"
                        name="has_reward" 
                        value="1"
                        class="mt-0.5 w-4 h-4 text-teal border-gray-300 rounded focus:ring-teal"
                    >
                    <span class="text-sm text-gray-700">
                        Saya bersedia memberikan apresiasi (reward) kepada penemu
                    </span>
                </label>

                <!-- Reward Input Field -->
                <div id="reward-input-field" class="hidden">
                    <input 
                        type="text" 
                        name="reward_description" 
                        placeholder="Contoh: uang terima kasih / makanan / souvenir"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                    >
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button 
                    type="submit"
                    class="w-full bg-teal hover:bg-teal/90 text-white font-semibold px-8 py-3 rounded-lg transition shadow-md hover:shadow-lg flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Kirim Laporan
                </button>
            </div>

            <p class="text-center text-sm text-gray-600 pt-2">
                Dengan mengirim laporan, Anda menyetujui bahwa data yang diberikan adalah benar
            </p>
        </form>

        <!-- Tips Section -->
        <div class="mt-8 bg-cyan-50 border border-cyan-200 rounded-lg p-6">
            <h3 class="font-semibold text-cyan-900 mb-3">Tips Laporan yang Baik</h3>
            <ul class="space-y-2 text-sm text-cyan-800">
                <li>• Berikan deskripsi yang detail dan spesifik</li>
                <li>• Upload foto dari berbagai sudut</li>
                <li>• Ingat tanggal dan lokasi dengan tepat</li>
                <li>• Periksa kembali sebelum mengirim</li>
            </ul>
        </div>
    </div>
</div>

<script>
    function displayFileNames(input) {
        const fileNames = document.getElementById('fileNames');
        if (input.files.length > 0) {
            const names = Array.from(input.files).map(file => file.name).join(', ');
            fileNames.textContent = `${input.files.length} file dipilih: ${names}`;
        } else {
            fileNames.textContent = '';
        }
    }

    // Handle report type change
    const radioButtons = document.querySelectorAll('input[name="type"]');
    const dateLabel = document.getElementById('date-label');
    const locationLabel = document.getElementById('location-label');
    const rewardSection = document.getElementById('reward-section');

    // Initialize based on current selection
    function updateLabelsAndReward() {
        const selectedType = document.querySelector('input[name="type"]:checked').value;
        if (selectedType === 'lost') {
            dateLabel.textContent = 'Tanggal Hilang';
            locationLabel.textContent = 'Lokasi Terakhir';
            rewardSection.style.display = 'block';
        } else {
            dateLabel.textContent = 'Tanggal Ditemukan';
            locationLabel.textContent = 'Lokasi Ditemukan';
            rewardSection.style.display = 'none';
        }
    }

    // Call on page load
    updateLabelsAndReward();

    // Listen for changes
    radioButtons.forEach(radio => {
        radio.addEventListener('change', updateLabelsAndReward);
    });

    // Handle reward checkbox change
    const rewardCheckbox = document.getElementById('offer_reward_checkbox');
    const rewardInputField = document.getElementById('reward-input-field');

    if (rewardCheckbox) {
        rewardCheckbox.addEventListener('change', function() {
            if (this.checked) {
                rewardInputField.classList.remove('hidden');
            } else {
                rewardInputField.classList.add('hidden');
            }
        });
    }
</script>
@endsection