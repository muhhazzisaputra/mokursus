@props([
    'logo' => 'BrandLogo',
    'logoUrl' => '/',
    'menuItems' => [
        ['name' => 'Home', 'url' => '#home'],
        ['name' => 'Fitur', 'url' => '#features'],
        ['name' => 'Harga', 'url' => '#pricing'],
        ['name' => 'Testimoni', 'url' => '#testimonials'],
        ['name' => 'Kontak', 'url' => '#contact'],
    ],
    'ctaText' => 'Mulai Sekarang',
    'ctaUrl' => '#',
    'isSticky' => true
])

<nav class="{{ $isSticky ? 'fixed top-0 left-0 right-0' : '' }} bg-white/80 backdrop-blur-md shadow-sm z-50 border-b border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ $logoUrl }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent hover:opacity-80 transition">
                    {{ $logo }}
                </a>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-8">
                @foreach($menuItems as $item)
                <a href="{{ $item['url'] }}" 
                   class="text-gray-700 hover:text-blue-600 transition-colors duration-200">
                    {{ $item['name'] }}
                </a>
                @endforeach
            </div>

            {{-- Desktop CTA Button --}}
            <div class="hidden md:block">
                <x-common.button 
                    :href="$ctaUrl" 
                    variant="primary"
                    size="md">
                    {{ $ctaText }}
                </x-common.button>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu Dropdown --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 py-4">
        <div class="flex flex-col space-y-3 px-4">
            @foreach($menuItems as $item)
            <a href="{{ $item['url'] }}" 
               class="text-gray-700 hover:text-blue-600 transition-colors py-2">
                {{ $item['name'] }}
            </a>
            @endforeach
            <div class="pt-2">
                <x-common.button 
                    :href="$ctaUrl" 
                    variant="primary"
                    size="sm"
                    class="w-full text-center">
                    {{ $ctaText }}
                </x-common.button>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
@endpush