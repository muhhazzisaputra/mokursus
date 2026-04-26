@props([
    'logoDesktop' => 'images/logo-primer.png',
    'logoMobile' => 'images/logo-sekunder.png',
    'menuItems' => [
        ['name' => 'Beranda', 'url' => '/', 'route' => 'home'],
        ['name' => 'Transaksi', 'url' => '/cek-pemesanan', 'route' => 'cek-pemesanan'],
        ['name' => 'Karya Alumni', 'url' => '/karya-alumni', 'route' => 'karya-alumni'],
        ['name' => 'Blog', 'url' => 'https://blog.ptcindonesia.co.id/', 'route' => ''],
        ['name' => 'Cek Sertifikat', 'url' => '/verifikasi-sertifikat', 'route' => 'verifikasi-sertifikat'],
        ['name' => 'Jadi Trainer', 'url' => 'https://docs.google.com/forms/d/e/1FAIpQLSdCiGXtNFHs6XYxZVoaB3l8aD89tkTadjGI2KFswrJ5EFLG8Q/viewform', 'route' => ''],
    ],
    'isSticky' => true
])

<header class="{{ $isSticky ? 'nav-glass sticky top-0 z-50' : 'nav-glass' }}">
    <div class="max-w-[1280px] mx-auto px-4 md:px-8 h-[64px] flex items-center justify-between gap-4">
        
        {{-- Logo --}}
        <a href="/" class="flex items-center flex-shrink-0">
            <img src="{{ $logoMobile }}" alt="MoKursus" class="h-9 md:hidden" />
            <img src="{{ $logoDesktop }}" alt="MoKursus" class="h-9 hidden md:block" />
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden lg:flex items-center gap-6">
            @foreach($menuItems as $item)
            <a href="{{ $item['url'] }}" 
               class="text-[13px] font-semibold {{ request()->routeIs($item['route']) ? 'text-ptc-blue border-b-2 border-ptc-blue' : 'text-slate-700 hover:text-ptc-blue' }} transition-colors">
                {{ $item['name'] }}
            </a>
            @endforeach
        </nav>

        {{-- Desktop CTAs --}}
        <div class="hidden lg:flex items-center gap-2">
            <a href="/login" class="text-[12px] font-semibold text-ptc-blue border border-ptc-blue/30 rounded-lg px-4 py-2 hover:bg-blue-50 transition-colors">
                Masuk
            </a>
            <a href="/login" class="text-[12px] font-bold text-white bg-ptc-gradient rounded-lg px-4 py-2 shadow-md shadow-ptc-blue/25 hover:opacity-90 transition-opacity whitespace-nowrap">
                Daftar Sekarang
            </a>
        </div>

        {{-- Mobile/Tablet: CTA + hamburger --}}
        <div class="flex lg:hidden items-center gap-2">
            <a href="/login" class="text-[12px] font-bold text-white bg-ptc-gradient rounded-lg px-3 py-2 shadow-md hover:opacity-90 transition-opacity whitespace-nowrap">
                Daftar
            </a>
            <button id="hamburger" class="p-2 rounded-lg border border-slate-200 hover:bg-slate-50" onclick="toggleMobileMenu()">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="lg:hidden border-t border-slate-100 bg-white">
        <div class="max-w-[1280px] mx-auto px-4 py-4 flex flex-col gap-1">
            @foreach($menuItems as $item)
            <a href="{{ $item['url'] }}" 
               class="py-2.5 px-3 text-[14px] font-semibold text-slate-700 hover:text-ptc-blue hover:bg-blue-50 rounded-lg transition-colors">
                {{ $item['name'] }}
            </a>
            @endforeach
            <div class="border-t border-slate-100 mt-2 pt-3">
                <a href="/login" class="block py-2.5 px-3 text-[14px] font-semibold text-ptc-blue hover:bg-blue-50 rounded-lg transition-colors">
                    Masuk
                </a>
            </div>
        </div>
    </div>
</header>

@push('scripts')
<script>
    function toggleMobileMenu() {
        document.getElementById('mobile-menu').classList.toggle('open');
    }
    
    // Close mobile menu when clicking on a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.remove('open');
        });
    });
</script>
@endpush