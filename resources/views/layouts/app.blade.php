<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Landing page modern dengan Laravel dan Tailwind CSS')">
    <meta name="keywords" content="@yield('meta_keywords', 'laravel, tailwind, landing page')">
    
    <title>@yield('title', 'Laravel Landing Page')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-white font-sans antialiased">
    
    {{-- Header Section with Topbar & Navbar --}}
    <header>
        @include('components.header.topbar')
        @include('components.header.navbar')
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.sections.footer')

    {{-- Mobile Menu Script --}}
    @stack('scripts')
    
</body>
</html>