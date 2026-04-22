@props([
    'title' => 'Solusi Terbaik untuk Bisnis Anda',
    'subtitle' => 'Tingkatkan produktivitas dan efisiensi bisnis Anda dengan platform modern yang kami sediakan.',
    'buttonText' => 'Mulai Gratis',
    'buttonUrl' => '#',
    'secondaryButtonText' => 'Demo Video',
    'secondaryButtonUrl' => '#',
    'imageUrl' => 'https://placehold.co/600x500/3B82F6/FFFFFF/png?text=Hero+Image',
    'stats' => [
        ['value' => '10K+', 'label' => 'Pengguna Aktif'],
        ['value' => '99%', 'label' => 'Kepuasan'],
        ['value' => '24/7', 'label' => 'Support'],
    ]
])

<section id="home" class="pt-32 pb-20 px-4 bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <div class="container mx-auto max-w-6xl">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            {{-- Left Content --}}
            <div class="flex-1 text-center lg:text-left">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        {{ $title }}
                    </span>
                </h1>
                <p class="text-gray-600 text-lg mt-6 mb-8 max-w-lg mx-auto lg:mx-0">
                    {{ $subtitle }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <x-common.button :href="$buttonUrl" variant="primary" size="lg">
                        🚀 {{ $buttonText }}
                    </x-common.button>
                    
                    <x-common.button :href="$secondaryButtonUrl" variant="outline" size="lg">
                        ▶️ {{ $secondaryButtonText }}
                    </x-common.button>
                </div>

                {{-- Stats --}}
                <div class="flex flex-wrap gap-8 mt-12 justify-center lg:justify-start">
                    @foreach($stats as $stat)
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ $stat['value'] }}</div>
                        <div class="text-gray-500">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Image --}}
            <div class="flex-1">
                <img src="{{ $imageUrl }}" alt="Hero" class="rounded-2xl shadow-2xl w-full">
            </div>
        </div>
    </div>
</section>