@extends('layouts.app')

@section('title', 'Home - Landing Page Modern')
@section('meta_description', 'Landing page profesional dengan Laravel dan Tailwind CSS')
@section('meta_keywords', 'laravel, tailwind, landing page, bisnis')

@section('content')
    {{-- Hero Section --}}
    <x-sections.hero 
        title="Solusi Terbaik untuk Bisnis Anda"
        subtitle="Tingkatkan produktivitas dan efisiensi bisnis Anda dengan platform modern yang kami sediakan. Mudah digunakan dan terintegrasi dengan berbagai tools."
        buttonText="Mulai Gratis"
        buttonUrl="#"
        secondaryButtonText="Demo Video"
        secondaryButtonUrl="#"
        :stats="[
            ['value' => '10K+', 'label' => 'Pengguna Aktif'],
            ['value' => '99%', 'label' => 'Kepuasan'],
            ['value' => '24/7', 'label' => 'Support'],
        ]"
    />

    {{-- Features Section --}}
    <x-sections.features 
        title="Fitur Unggulan"
        subtitle="Semua yang Anda butuhkan untuk mengembangkan bisnis dalam satu platform terintegrasi"
        :features="[
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
            [
                'icon' => '📊',
                'title' => 'Analisis Real-time',
                'description' => 'Pantau performa bisnis Anda dengan dashboard analitik real-time.',
                'color' => 'orange'
            ],
            [
                'icon' => '🤖',
                'title' => 'AI-Powered',
                'description' => 'Rekomendasi cerdas berbasis AI untuk strategi bisnis Anda.',
                'color' => 'red'
            ],
            [
                'icon' => '☁️',
                'title' => 'Cloud Based',
                'description' => 'Akses dari mana saja dengan sistem cloud yang aman dan andal.',
                'color' => 'indigo'
            ],
        ]"
    />

    {{-- Call to Action --}}
    <x-sections.cta 
        title="Siap Meningkatkan Bisnis Anda?"
        subtitle="Bergabunglah dengan ribuan pengguna yang sudah merasakan manfaatnya"
        buttonText="Mulai Sekarang Gratis →"
        buttonUrl="#"
        gradient="from-blue-600 to-purple-600"
    />
@endsection