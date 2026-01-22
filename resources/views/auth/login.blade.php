@extends('layouts.auth')

@section('title', 'Login - Lost & Found UNIDA Gontor')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4" style="background: linear-gradient(135deg, #26607d 0%, #17bbb9 100%);">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8">
        <!-- Icon -->
        <div class="flex justify-center mb-6">
            <div class="bg-teal rounded-full p-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h2>
            <p class="text-gray-600 mt-2">Masuk ke akun Lost & Found Anda</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email / Username UNIDA
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        value="{{ old('email') }}"
                        placeholder="nama@unida.gontor.ac.id"
                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent"
                    >
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Kata Sandi
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        placeholder="••••••••"
                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent"
                    >
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        id="remember" 
                        name="remember" 
                        type="checkbox" 
                        class="h-4 w-4 text-teal focus:ring-teal border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Ingat saya
                    </label>
                </div>
                <a href="#" class="text-sm text-teal hover:text-teal/80">
                    Lupa kata sandi?
                </a>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-teal hover:bg-teal/90 text-white font-semibold py-3 rounded-lg transition shadow-md hover:shadow-lg"
            >
                Masuk
            </button>
        </form>

        <!-- Register Link -->
        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-teal hover:text-teal/80 font-semibold">
                Daftar di sini
            </a>
        </p>

        <!-- Note -->
        <p class="mt-4 text-center text-xs text-gray-500">
            Login diperlukan untuk melaporkan barang dan mengklaim
        </p>
    </div>
</div>
@endsection