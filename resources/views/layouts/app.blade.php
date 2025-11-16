<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sites Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
{{-- Навигация --}}
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <a href="/" class="flex items-center">
                    <span class="text-xl font-bold">Sites Manager</span>
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Контент --}}
<main>
    @yield('content')
</main>
</body>
</html>
