<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])
    @yield('styles')
</head>
<body>

<body>
     @include('header') {{-- Inclut le header --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
        @include('footer') {{-- Inclut le footer --}}
</body>
</html>
