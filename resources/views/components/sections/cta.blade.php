@props([
    'title' => 'Siap Meningkatkan Bisnis Anda?',
    'subtitle' => 'Bergabunglah dengan ribuan pengguna yang sudah merasakan manfaatnya',
    'buttonText' => 'Mulai Sekarang Gratis →',
    'buttonUrl' => '#',
    'gradient' => 'from-blue-600 to-purple-600'
])

<section class="py-20 px-4 bg-gradient-to-r {{ $gradient }}">
    <div class="container mx-auto max-w-4xl text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
            {{ $title }}
        </h2>
        <p class="text-blue-100 text-lg mb-8">
            {{ $subtitle }}
        </p>
        <x-common.button 
            :href="$buttonUrl" 
            variant="primary" 
            size="lg"
            class="bg-white text-{{ explode('-', $gradient)[1] }}-600 hover:bg-gray-100">
            {{ $buttonText }}
        </x-common.button>
    </div>
</section>