@extends('layouts.app')

@section('title', 'Beranda - Lost & Found UNIDA Gontor')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-darkblue via-darkblue to-teal text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
            Sistem Informasi Lost & Found UNIDA Gontor
        </h1>
        <p class="text-xl md:text-2xl text-gray-100 mb-12">
            Temukan kembali yang hilang. Kembalikan dengan aman dan penuh amanah.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="{{ route('items.create', ['type' => 'lost']) }}" class="inline-flex items-center justify-center space-x-2 bg-teal hover:bg-teal/90 text-white px-8 py-4 rounded-lg text-lg font-semibold transition shadow-lg">
                <span>+</span>
                <span>Saya Kehilangan Barang</span>
            </a>
            <a href="{{ route('items.create', ['type' => 'found']) }}" class="inline-flex items-center justify-center space-x-2 bg-white text-darkblue hover:bg-gray-100 px-8 py-4 rounded-lg text-lg font-semibold transition shadow-lg">
                <span>+</span>
                <span>Saya Menemukan Barang</span>
            </a>
        </div>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('items.index') }}" method="GET" class="relative flex">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="search"
                        placeholder="Cari barang temuan di sini... (misal: 'Kunci Motor Vario')"
                        class="w-full pl-12 pr-4 py-4 rounded-l-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal"
                    >
                </div>
                <button type="submit" class="bg-teal hover:bg-teal/90 text-white px-8 py-4 rounded-r-lg transition font-semibold">
                    Cari
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Recent Found Items -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Barang Temuan Terbaru</h2>
        <p class="text-gray-600">Semoga barang Anda ada di sini</p>
    </div>

    @if($recentItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($recentItems as $item)
                <a href="{{ route('items.show', $item) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        @if(!empty($item->images) && isset($item->images[0]))
                            <img src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="inline-block px-3 py-1 bg-teal/10 text-teal rounded-full text-sm mb-2">
                            {{ $item->category->name }}
                        </div>
                        <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $item->name }}</h3>
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            {{ $item->location->name }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $item->date->format('d M Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('items.index') }}" class="inline-block bg-teal hover:bg-teal/90 text-white px-8 py-3 rounded-lg transition font-semibold">
                Lihat Semua Barang Temuan
            </a>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-gray-500 text-lg">Belum ada barang temuan</p>
        </div>
    @endif
</div>

<!-- How It Works -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Cara Kerja</h2>
            <p class="text-gray-600">3 langkah mudah untuk menemukan barang Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg text-center shadow-md hover:shadow-xl transition">
                <div class="bg-teal/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">1. Lapor atau Cari Barang</h3>
                <p class="text-gray-600">Laporkan barang yang hilang atau temukan di daftar barang temuan</p>
            </div>

            <div class="bg-white p-8 rounded-lg text-center shadow-md hover:shadow-xl transition">
                <div class="bg-teal/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">2. Verifikasi Kepemilikan</h3>
                <p class="text-gray-600">Tim kami akan memverifikasi kepemilikan dengan bukti yang Anda berikan</p>
            </div>

            <div class="bg-white p-8 rounded-lg text-center shadow-md hover:shadow-xl transition">
                <div class="bg-teal/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">3. Barang Kembali dengan Aman</h3>
                <p class="text-gray-600">Ambil barang Anda dengan aman di kantor Lost & Found</p>
            </div>
        </div>
    </div>
</div>
@endsection