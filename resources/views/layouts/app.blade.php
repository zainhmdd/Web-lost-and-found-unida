<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lost & Found UNIDA Gontor')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: '#17bbb9',
                        darkblue: '#26607d',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-darkblue text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="bg-teal p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-lg leading-tight">Lost & Found</div>
                        <div class="text-xs text-gray-300 leading-tight">UNIDA Gontor</div>
                    </div>
                </a>
                
                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="hover:text-teal transition {{ Route::is('home') ? 'text-teal' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('items.index') }}" class="hover:text-teal transition {{ Route::is('items.index') || Route::is('items.show') ? 'text-teal' : '' }}">
                        Barang Temuan
                    </a>
                    <a href="{{ route('items.create') }}" class="hover:text-teal transition {{ Route::is('items.create') ? 'text-teal' : '' }}">
                        Lapor Barang
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:text-teal transition">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-teal hover:bg-teal/90 px-4 py-2 rounded-lg transition font-medium">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-teal transition">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-teal hover:bg-teal/90 px-4 py-2 rounded-lg transition font-medium">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-darkblue text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <div class="text-sm mb-2">© 2024 Lost & Found UNIDA Gontor</div>
                <div class="text-gray-300 italic flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                    <span>Kejujuran adalah budaya. Kepedulian adalah kekuatan.</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>