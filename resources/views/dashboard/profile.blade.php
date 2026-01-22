@extends('layouts.app')

@section('title', 'Profil Saya - Lost & Found UNIDA Gontor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Saya</h1>
        <p class="text-gray-600">Kelola laporan dan profil Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <div class="text-center mb-6">
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover border-4 border-teal/20">
                        @else
                            <div class="bg-teal/10 w-full h-full rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-600">NIM: {{ $user->nim }}</p>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        <span>📋</span>
                        <span>Laporan Saya</span>
                    </a>
                    <a href="{{ route('dashboard.profile') }}" class="flex items-center space-x-3 px-4 py-3 bg-teal text-white rounded-lg">
                        <span>👤</span>
                        <span>Profil Saya</span>
                    </a>
                    <a href="{{ route('dashboard.points') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        <span>🏆</span>
                        <span>Poin & Apresiasi</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Avatar Upload -->
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200">
                                @if($user->avatar)
                                    <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <img id="avatar-preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                    <div id="avatar-placeholder" class="w-full h-full flex items-center justify-center bg-teal/10">
                                        <svg class="w-12 h-12 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                            <input 
                                type="file" 
                                name="avatar" 
                                accept="image/*"
                                onchange="previewAvatar(this)"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal file:text-white hover:file:bg-teal/90"
                            >
                            <p class="mt-1 text-sm text-gray-500">JPG, PNG max 2MB</p>
                            @error('avatar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ $user->name }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIM / NIP</label>
                        <input 
                            type="text" 
                            value="{{ $user->nim }}"
                            disabled
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            value="{{ $user->email }}"
                            disabled
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                        >
                    </div>

                    {{-- ✅ GANTI NO. HP JADI USERNAME TELEGRAM --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Username Telegram
                            <span class="text-red-500">*</span>
                            <span class="text-gray-500 text-xs font-normal">(Wajib untuk dihubungi pengklaim)</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-semibold">@</span>
                            </div>
                            <input 
                                type="text" 
                                name="telegram_username" 
                                value="{{ $user->telegram_username }}"
                                placeholder="username_telegram"
                                required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                            >
                        </div>
                        <div class="mt-2 bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <p class="text-sm text-blue-800">
                                <strong>📱 Cara cek username Telegram:</strong><br>
                                1. Buka Telegram → Settings<br>
                                2. Klik nama/foto profil kamu<br>
                                3. Username ada di bawah nama (contoh: @ahmad_gontor)<br>
                                4. Masukkan tanpa tanda @
                            </p>
                        </div>
                        @error('telegram_username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit"
                            class="bg-teal hover:bg-teal/90 text-white py-3 px-6 rounded-lg transition font-semibold"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewAvatar(input) {
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection