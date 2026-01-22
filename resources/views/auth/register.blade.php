@extends('layouts.auth')

@section('title', 'Daftar - Lost & Found UNIDA Gontor')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4" style="background: linear-gradient(135deg, #26607d 0%, #17bbb9 100%);">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8">
        <div class="flex justify-center mb-6">
            <div class="bg-teal rounded-full p-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Akun Baru</h2>
            <p class="text-gray-600 mt-2">Bergabung dengan Lost & Found UNIDA Gontor</p>
        </div>

        <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    required 
                    value="{{ old('name') }}" 
                    placeholder="Muhammad Ahmad" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM / NIP</label>
                <input 
                    id="nim" 
                    name="nim" 
                    type="text" 
                    required 
                    value="{{ old('nim') }}" 
                    placeholder="202412345" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                >
                @error('nim')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email UNIDA</label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                    value="{{ old('email') }}" 
                    placeholder="nama@unida.gontor.ac.id" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    required 
                    placeholder="••••••••" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                <input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    required 
                    placeholder="••••••••" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-teal hover:bg-teal/90 text-white font-semibold py-3 rounded-lg transition shadow-md hover:shadow-lg"
            >
                Daftar Akun
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-teal hover:text-teal/80 font-semibold">
                Masuk di sini
            </a>
        </p>

        <p class="mt-4 text-center text-xs text-gray-500">
            Gunakan email UNIDA Gontor yang valid untuk verifikasi
        </p>
    </div>
</div>
@endsection
