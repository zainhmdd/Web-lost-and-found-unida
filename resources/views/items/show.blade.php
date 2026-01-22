@extends('layouts.app')

@section('title', $item->name . ' - Lost & Found UNIDA Gontor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Button -->
    <a href="{{ route('items.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 mb-6">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Daftar Barang
    </a>

    <!-- Success Message - Clean & Simple -->
    @if(session('success'))
        <div class="mb-6">
            <div class="bg-white border-l-4 border-green-500 rounded-lg shadow-sm p-5">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 mb-1">Klaim berhasil dikirim!</h3>
                        @if(session('telegram_url'))
                            <p class="text-sm text-gray-600 mb-3">
                                Hubungi <strong>{{ session('finder_name') }}</strong> melalui Telegram untuk verifikasi.
                            </p>
                            <a 
                                href="{{ session('telegram_url') }}" 
                                target="_blank"
                                class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/>
                                </svg>
                                Hubungi via Telegram
                            </a>
                        @else
                            <p class="text-sm text-gray-600">
                                Tim kami akan memverifikasi dalam 1-2 hari kerja.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6">
            <div class="bg-white border-l-4 border-red-500 rounded-lg shadow-sm p-5">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 mb-1">{{ session('error') }}</h3>
                        <p class="text-sm text-gray-600">Penemu: <strong>{{ session('finder_name') }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Image Section -->
        <div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if(!empty($item->images) && isset($item->images[0]))
                    <img src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->name }}" class="w-full h-96 object-contain bg-gray-100">
                @else
                    <div class="w-full h-96 flex items-center justify-center bg-gray-200">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>
        </div>

        <!-- Info Section -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Status & Category -->
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 bg-teal/10 text-teal rounded-full text-sm">
                        {{ $item->category->name }}
                    </span>
                    
                    @if($item->status === 'verified')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Terverifikasi
                        </span>
                    @elseif($item->status === 'claimed')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            Sedang Diklaim
                        </span>
                    @elseif($item->status === 'returned')
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm flex items-center">
                            ✅ Sudah Dikembalikan
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                            Menunggu Verifikasi
                        </span>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $item->name }}</h1>

                <!-- Details -->
                <div class="space-y-4 mb-6">
                    <!-- Location -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-teal mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <div>
                            <div class="text-sm text-gray-600">Lokasi Ditemukan</div>
                            <div class="font-semibold text-gray-800">{{ $item->location->name }}</div>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-teal mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <div class="text-sm text-gray-600">Tanggal Ditemukan</div>
                            <div class="font-semibold text-gray-800">{{ $item->date->format('d F Y') }}</div>
                        </div>
                    </div>

                    <!-- Found By -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-teal mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <div>
                            <div class="text-sm text-gray-600">Ditemukan oleh</div>
                            <div class="font-semibold text-gray-800">{{ $item->user->name }}</div>
                        </div>
                    </div>

                    <!-- Reward -->
                    @if($item->has_reward && $item->reward_description)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-teal mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                            <div>
                                <div class="text-sm text-gray-600">Reward</div>
                                <div class="font-semibold text-green-600">{{ $item->reward_description }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="border-t pt-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Deskripsi Lengkap</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $item->description }}</p>
                </div>

                <!-- Claim Button -->
                @auth
                    @if($item->status === 'claimed' || $item->status === 'returned')
                        <div class="w-full mt-6 bg-gray-100 text-gray-600 font-semibold py-3 rounded-lg text-center">
                            <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $item->status === 'returned' ? 'Barang Sudah Dikembalikan' : 'Barang Sedang Diklaim' }}
                        </div>
                    @else
                        <button onclick="document.getElementById('claimModal').classList.remove('hidden')" class="w-full mt-6 bg-teal hover:bg-teal/90 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Ini Barang Saya, Klaim Sekarang!
                        </button>
                        <p class="text-center text-sm text-gray-600 mt-3">
                            Anda akan diminta untuk memverifikasi kepemilikan barang
                        </p>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full mt-6 bg-teal hover:bg-teal/90 text-white font-semibold py-3 rounded-lg transition text-center">
                        Login untuk Klaim Barang
                    </a>
                @endauth
            </div>

            <!-- Claim Instructions -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="font-semibold text-blue-900 mb-3">Cara Mengklaim Barang</h3>
                <ol class="space-y-2 text-sm text-blue-800 list-decimal list-inside">
                    <li>Klik tombol "Klaim Sekarang" di atas</li>
                    <li>Isi formulir klaim dengan detail kepemilikan barang</li>
                    <li>Upload bukti kepemilikan (foto, nota pembelian, dll)</li>
                    <li>Sistem akan mengarahkan Anda ke Telegram penemu</li>
                    <li>Chat penemu untuk verifikasi dan pengambilan barang</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Claim Modal -->
<div id="claimModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Klaim Barang</h2>
                <button onclick="document.getElementById('claimModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('items.claim', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Claim Description -->
                <div>
                    <label for="claim_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Jelaskan Mengapa Ini Barang Anda <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="claim_description" 
                        name="claim_description" 
                        rows="4" 
                        required
                        placeholder="Contoh: Saya kehilangan tas ransel hitam merk Eiger pada tanggal 25 Desember 2024 di Perpustakaan. Di dalam tas ada buku catatan warna biru dan laptop ASUS..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                    ></textarea>
                    <p class="mt-1 text-sm text-gray-500">Jelaskan detail barang untuk verifikasi</p>
                </div>

                <!-- Proof Images -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Bukti Kepemilikan (Opsional)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-teal transition cursor-pointer" onclick="document.getElementById('proof_images').click()">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-gray-600 font-medium mb-1">Upload foto nota pembelian, foto lama barang, dll</p>
                        <p class="text-sm text-gray-500">Format: JPG, PNG (Max 5MB per file)</p>
                        <input 
                            type="file" 
                            id="proof_images" 
                            name="proof_images[]" 
                            multiple 
                            accept="image/*"
                            class="hidden"
                            onchange="displayProofFileNames(this)"
                        >
                    </div>
                    <div id="proofFileNames" class="mt-2 text-sm text-gray-600"></div>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3 pt-4">
                    <button 
                        type="button"
                        onclick="document.getElementById('claimModal').classList.add('hidden')"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg transition"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 bg-teal hover:bg-teal/90 text-white font-semibold py-3 rounded-lg transition"
                    >
                        Kirim Klaim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function displayProofFileNames(input) {
        const fileNames = document.getElementById('proofFileNames');
        if (input.files.length > 0) {
            const names = Array.from(input.files).map(file => file.name).join(', ');
            fileNames.textContent = `${input.files.length} file dipilih: ${names}`;
        } else {
            fileNames.textContent = '';
        }
    }
</script>
@endsection