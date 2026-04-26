<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'MoKursus - Lembaga Kursus & Pelatihan Bersertifikat')</title>
    
    {{-- Tailwind CSS via CDN (untuk sementara, nanti bisa pindah ke Vite) --}}
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet" />
    
    @stack('styles')
</head>
<body>
    <!-- SPINNER -->
    <div id="page-spinner">
        <!-- <img src="logo-sekunder.png" alt="" style="height:40px;margin-bottom:4px;" onerror="this.style.display='none'"/> -->
        <div class="sring"></div>
        <div class="sdots"><span></span><span></span><span></span></div>
        <p style="font-size:13px;color:#94a3b8;font-weight:600;">Memuat halaman...</p>
    </div>

    {{-- Header --}}
    <x-header.topbar />
    <x-header.navbar />

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    <x-sections.footer />

    @stack('scripts')
    <script>
        // SPINNER
        window.addEventListener("load",()=>{
        setTimeout(()=>{const s=document.getElementById("page-spinner");s.classList.add("hide");setTimeout(()=>{if(s.parentNode)s.parentNode.removeChild(s);},500);},900);
        });
    </script>
</body>
</html>