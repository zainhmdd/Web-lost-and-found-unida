@extends('layouts.app')

@section('title', 'Barang Temuan - Lost & Found UNIDA Gontor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Barang Temuan</h1>
        <p class="text-gray-600">Temukan {{ $items->total() }} barang yang telah dilaporkan</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <div class="flex items-center mb-4">
                    <svg class="w-5 h-5 text-teal mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <h3 class="font-semibold text-gray-800">Filter & Sortir</h3>
                </div>

                <form method="GET" action="{{ route('items.index') }}" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Barang</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <select name="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal">
                            <option value="">Semua Lokasi</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-teal hover:bg-teal/90 text-white py-2 rounded-lg transition font-medium">Terapkan Filter</button>
                    @if(request()->hasAny(['search', 'category', 'location', 'sort']))
                        <a href="{{ route('items.index') }}" class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 rounded-lg transition font-medium">Reset Filter</a>
                    @endif
                </form>
            </div>
        </div>

        <div class="lg:col-span-3">
            <p class="text-gray-600 mb-4">Menampilkan {{ $items->count() }} barang</p>
            
            @if($items->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                        <a href="{{ route('items.show', $item) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group">
                            <div class="h-48 bg-gray-200 overflow-hidden relative">
                                @if(!empty($item->images) && isset($item->images[0]))
                                    <img src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center bg-gray-300">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="inline-block px-3 py-1 bg-teal/10 text-teal rounded-full text-sm mb-2">{{ $item->category->name }}</div>
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
                <div class="mt-8">{{ $items->links() }}</div>
            @else
                <div class="text-center py-16 bg-white rounded-lg shadow-md">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada barang ditemukan</h3>
                    <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian Anda</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection