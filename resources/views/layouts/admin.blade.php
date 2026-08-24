<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} | TailAdmin - Laravel Tailwind CSS Admin Dashboard Template</title>
    
    @stack('scripts')
    
    <!-- Scripts -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <!-- Alpine.js -->
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Theme Store -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                        'light';
                    this.theme = savedTheme || systemTheme;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const body = document.body;
                    if (this.theme === 'dark') {
                        html.classList.add('dark');
                        body.classList.add('dark', 'bg-gray-900');
                    } else {
                        html.classList.remove('dark');
                        body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });

            Alpine.store('sidebar', {
                // Initialize based on screen size
                isExpanded: window.innerWidth >= 1280, // true for desktop, false for mobile
                isMobileOpen: false,
                isHovered: false,

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    // When toggling desktop sidebar, ensure mobile menu is closed
                    this.isMobileOpen = false;
                },

                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                    // Don't modify isExpanded when toggling mobile menu
                },

                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },

                setHovered(val) {
                    // Only allow hover effects on desktop when sidebar is collapsed
                    if (window.innerWidth >= 1280 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>

    <!-- Apply dark mode immediately to prevent flash -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.body.classList.add('dark', 'bg-gray-900');
            } else {
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('dark', 'bg-gray-900');
            }
        })();
    </script>
</head>

<body
    x-data="{ 'loaded': true}"
    x-init="$store.sidebar.isExpanded = window.innerWidth >= 1280;
    const checkMobile = () => {
        if (window.innerWidth < 1280) {
            $store.sidebar.setMobileOpen(false);
            $store.sidebar.isExpanded = false;
        } else {
            $store.sidebar.isMobileOpen = false;
            $store.sidebar.isExpanded = true;
        }
    };
    window.addEventListener('resize', checkMobile);">

    {{-- preloader --}}
    <x-common.preloader/>
    {{-- preloader end --}}

    <div class="min-h-screen xl:flex">
        @include('layouts.backdrop')
        @include('layouts.sidebar')

        <div class="flex-1 transition-all duration-300 ease-in-out"
            :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">
            <!-- app header start -->
            @include('layouts.app-header')
            <!-- app header end -->
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                @yield('content')
            </div>
        </div>

    </div>
    
</body>

<!-- Toastify JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    // Fungsi toast notifikasi dengan posisi top center
    function showToast(message, type = 'success') {
        // Warna berdasarkan tipe
        let backgroundColor = '';
        let icon = '';
        
        switch(type) {
            case 'success':
                backgroundColor = 'linear-gradient(135deg, #10b981, #059669)';
                icon = '✅';
                break;
            case 'error':
                backgroundColor = 'linear-gradient(135deg, #ef4444, #dc2626)';
                icon = '❌';
                break;
            case 'warning':
                backgroundColor = 'linear-gradient(135deg, #f59e0b, #d97706)';
                icon = '⚠️';
                break;
            case 'info':
                backgroundColor = 'linear-gradient(135deg, #3b82f6, #2563eb)';
                icon = 'ℹ️';
                break;
            default:
                backgroundColor = 'linear-gradient(135deg, #3b82f6, #2563eb)';
                icon = '✅';
        }
        
        Toastify({
            text: icon + ' ' + message,
            duration: 3000,
            close: true,
            gravity: "top", // top or bottom
            position: "center", // left, center or right
            stopOnFocus: true,
            style: {
                background: backgroundColor,
                borderRadius: '8px',
                fontSize: '14px',
                padding: '12px 20px',
                boxShadow: '0 4px 12px rgba(0,0,0,0.15)'
            },
            onClick: function(){} // Callback after click
        }).showToast();
    }

    function formatNumber(input) {
        // Hapus semua karakter selain angka, koma, dan titik
        let value = input.value.replace(/[^\d,.]/g, '');
        
        // Pisahkan bagian desimal (setelah titik)
        let decimalPart = '';
        if (value.includes('.')) {
            let parts = value.split('.');
            decimalPart = '.' + parts.pop();
            value = parts.join('');
        }
        
        // Hapus semua koma yang ada
        value = value.replace(/,/g, '');
        
        // Batasi maksimal 11 digit untuk bilangan bulat (99.999.999.999)
        if (value.length > 11) {
            value = value.slice(0, 11);
        }
        
        // Jika kosong atau 0
        if (value === '') {
            input.value = '';
            return;
        }
        
        // Format dengan pemisah ribuan menggunakan koma
        let formatted = '';
        let numberStr = value.toString();
        let length = numberStr.length;
        
        for (let i = 0; i < length; i++) {
            if (i > 0 && (length - i) % 3 === 0) {
                formatted += ',';
            }
            formatted += numberStr[i];
        }
        
        input.value = formatted + decimalPart;
    }

    // Event handler saat input kehilangan fokus (blur)
    function onBlurFormat(input) {
        let value = input.value.replace(/[^\d]/g, '');
        if (value === '' || value === '0') {
            input.value = '';
        } else {
            formatNumber(input);
        }
    }

    // Format angka untuk display dari nilai numeric
    function formatNumberDisplay(angka) {
        if (!angka || angka == 0) return '0';
        
        // Pisahkan desimal
        let parts = angka.toString().split('.');
        let integerPart = parts[0];
        let decimalPart = parts[1] ? '.' + parts[1] : '';
        
        // Format integer dengan koma
        let formatted = '';
        let length = integerPart.length;
        for (let i = 0; i < length; i++) {
            if (i > 0 && (length - i) % 3 === 0) {
                formatted += ',';
            }
            formatted += integerPart[i];
        }
        
        return formatted + decimalPart;
    }

// Contoh penggunaan
// showToast('Data berhasil disimpan', 'success');
// showToast('Terjadi kesalahan', 'error');
// showToast('Perhatikan!', 'warning');
// showToast('Informasi penting', 'info');
</script>

</html>