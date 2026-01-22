@extends('layouts.app')

@section('title', 'Poin & Apresiasi - Lost & Found UNIDA Gontor')

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
                <!-- User Info -->
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

                <!-- Menu -->
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        <span>📋</span>
                        <span>Laporan Saya</span>
                    </a>
                    <a href="{{ route('dashboard.profile') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        <span>👤</span>
                        <span>Profil Saya</span>
                    </a>
                    <a href="{{ route('dashboard.points') }}" class="flex items-center space-x-3 px-4 py-3 bg-teal text-white rounded-lg">
                        <span>🏆</span>
                        <span>Poin & Apresiasi</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Total Points Card -->
            <div class="bg-gradient-to-r from-teal to-teal rounded-lg shadow-lg p-8 text-center mb-8 text-white">
                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                <div class="text-6xl font-bold mb-2">{{ $user->points }}</div>
                <div class="text-xl">Total Poin Terkumpul</div>
            </div>

            <!-- Badge & Pencapaian -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Badge & Pencapaian</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Badge 1 - Penemu Jujur (Achieved) -->
                    <div class="border-2 border-teal bg-teal/5 rounded-lg p-6 text-center">
                        <svg class="w-16 h-16 mx-auto mb-3 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <h3 class="font-semibold text-gray-800 mb-1">Penemu Jujur</h3>
                        <p class="text-sm text-gray-600">Lapor 5 barang temuan</p>
                    </div>

                    <!-- Badge 2 - Sahabat Amanah (Not achieved) -->
                    <div class="border-2 border-gray-300 rounded-lg p-6 text-center opacity-50">
                        <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <h3 class="font-semibold text-gray-600 mb-1">Sahabat Amanah</h3>
                        <p class="text-sm text-gray-500">10 verifikasi berhasil</p>
                    </div>

                    <!-- Badge 3 - Pahlawan Kampus (Not achieved) -->
                    <div class="border-2 border-gray-300 rounded-lg p-6 text-center opacity-50">
                        <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <h3 class="font-semibold text-gray-600 mb-1">Pahlawan Kampus</h3>
                        <p class="text-sm text-gray-500">Bantu 20 orang</p>
                    </div>
                </div>
            </div>

            <!-- Cara Mendapatkan Poin -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Cara Mendapatkan Poin</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b">
                        <span class="text-gray-700">Lapor barang temuan</span>
                        <span class="text-teal font-semibold">+10 poin</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b">
                        <span class="text-gray-700">Laporan terverifikasi</span>
                        <span class="text-teal font-semibold">+5 poin</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Barang berhasil dikembalikan</span>
                        <span class="text-teal font-semibold">+15 poin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection