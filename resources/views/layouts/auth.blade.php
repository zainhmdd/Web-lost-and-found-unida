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
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-lg">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
</body>
</html>