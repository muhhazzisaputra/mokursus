@props([
    'title' => 'Fitur Unggulan',
    'subtitle' => 'Semua yang Anda butuhkan untuk mengembangkan bisnis dalam satu platform terintegrasi',
    'features' => [
        [
            'icon' => '⚡',
            'title' => 'Cepat & Efisien',
            'description' => 'Proses yang cepat dan efisien untuk meningkatkan produktivitas tim Anda.',
            'color' => 'blue'
        ],
        [
            'icon' => '🔒',
            'title' => 'Keamanan Terjamin',
            'description' => 'Sistem keamanan berlapis untuk melindungi data berharga Anda.',
            'color' => 'purple'
        ],
        [
            'icon' => '🔗',
            'title' => 'Integrasi Mudah',
            'description' => 'Terintegrasi dengan berbagai platform dan tools populer.',
            'color' => 'green'
        ],
    ]
])

<section id="features" class="py-20 px-4 bg-white">
    <div class="container mx-auto max-w-6xl">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                {{ $title }}
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ $subtitle }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($features as $feature)
            <div class="group p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-{{ $feature['color'] }}-200">
                <div class="w-14 h-14 bg-{{ $feature['color'] }}-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-{{ $feature['color'] }}-600 transition-all duration-300 text-2xl">
                    {{ $feature['icon'] }}
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $feature['title'] }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>