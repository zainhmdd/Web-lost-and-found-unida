@extends('layouts.app')

@section('title', 'Dashboard - Lost & Found UNIDA Gontor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Saya</h1>
        <p class="text-gray-600">Kelola laporan dan profil Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
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
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 bg-teal text-white rounded-lg">
                        <span>📋</span>
                        <span>Laporan Saya</span>
                    </a>
                    <a href="{{ route('dashboard.profile') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition">
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
            <div class="bg-white rounded-lg shadow-md mb-6">
                <div class="flex border-b">
                    <button 
                        onclick="switchTab('lost')" 
                        id="tabLost"
                        class="flex-1 px-6 py-4 font-medium text-center border-b-2 border-transparent text-gray-600 hover:text-gray-800"
                    >
                        Barang Hilang Saya
                    </button>
                    <button 
                        onclick="switchTab('found')" 
                        id="tabFound"
                        class="flex-1 px-6 py-4 font-medium text-center border-b-2 border-teal text-teal"
                    >
                        Barang Temuan Saya
                    </button>
                </div>
            </div>

            <!-- Lost Items -->
            <div id="contentLost" class="hidden space-y-4">
                @forelse($lostItems as $item)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex gap-4">
                            <div class="w-32 h-32 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                @if(!empty($item->images) && isset($item->images[0]))
                                    <img src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-4xl">📦</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-teal/10 text-teal rounded-full text-sm mb-2">
                                            {{ $item->category->name }}
                                        </span>
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $item->name }}</h3>
                                    </div>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">{{ $item->status }}</span>
                                </div>
                                <p class="text-gray-600 mb-3">{{ $item->description }}</p>
                                <div class="flex gap-4 text-sm text-gray-600">
                                    <span>📍 {{ $item->location->name }}</span>
                                    <span>📅 {{ $item->date->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-md p-12 text-center">
                        <p class="text-gray-500">Belum ada laporan barang hilang</p>
                        <a href="{{ route('items.create', ['type' => 'lost']) }}" class="inline-block mt-4 text-teal hover:text-teal/80 font-medium">
                            Laporkan Barang Hilang →
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Found Items -->
            <div id="contentFound" class="space-y-4">
                @forelse($foundItems as $item)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex gap-4">
                            <div class="w-32 h-32 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                @if(!empty($item->images) && isset($item->images[0]))
                                    <img src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-4xl">📦</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-teal/10 text-teal rounded-full text-sm mb-2">
                                            {{ $item->category->name }}
                                        </span>
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $item->name }}</h3>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">{{ $item->status }}</span>
                                </div>
                                <p class="text-gray-600 mb-3">{{ $item->description }}</p>
                                <div class="flex gap-4 text-sm text-gray-600">
                                    <span>📍 {{ $item->location->name }}</span>
                                    <span>📅 {{ $item->date->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-md p-12 text-center">
                        <p class="text-gray-500">Belum ada laporan barang temuan</p>
                        {{-- ✅ PERBAIKAN DI SINI: Tambahkan ?type=found --}}
                        <a href="{{ route('items.create', ['type' => 'found']) }}" class="inline-block mt-4 text-teal hover:text-teal/80 font-medium">
                            Laporkan Barang Temuan →
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tab) {
        const tabLost = document.getElementById('tabLost');
        const tabFound = document.getElementById('tabFound');
        const contentLost = document.getElementById('contentLost');
        const contentFound = document.getElementById('contentFound');
        
        // Safety check
        if (!tabLost || !tabFound || !contentLost || !contentFound) {
            console.error('Tab elements not found');
            return;
        }
        
        // Reset all tabs
        [tabLost, tabFound].forEach(el => {
            el.classList.remove('border-teal', 'text-teal');
            el.classList.add('border-transparent', 'text-gray-600');
        });
        
        // Hide all content
        contentLost.classList.add('hidden');
        contentFound.classList.add('hidden');
        
        // Show selected tab
        if (tab === 'lost') {
            tabLost.classList.remove('border-transparent', 'text-gray-600');
            tabLost.classList.add('border-teal', 'text-teal');
            contentLost.classList.remove('hidden');
        } else {
            tabFound.classList.remove('border-transparent', 'text-gray-600');
            tabFound.classList.add('border-teal', 'text-teal');
            contentFound.classList.remove('hidden');
        }
    }

    // Initialize on page load - default to "found" tab
    document.addEventListener('DOMContentLoaded', function() {
        switchTab('found');
    });
</script>
@endsection