@props([
    'contactInfo' => [
        ['icon' => 'location', 'text' => 'Kelas Offline di Makassar'],
        ['icon' => 'video', 'text' => 'Online via Google Meet / Zoom'],
    ],
    'phone' => '+62 853 9425 2941'
])

<div class="bg-ptc-blue text-white text-xs py-2 px-4 md:px-8 flex items-center justify-between flex-wrap gap-1">
    <div class="flex items-center gap-3 md:gap-6 opacity-90 flex-wrap">
        <span class="flex items-center gap-1">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{ $contactInfo[0]['text'] }}
        </span>
        <span class="hidden sm:flex items-center gap-1">
            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
            </svg>
            {{ $contactInfo[1]['text'] }}
        </span>
    </div>
    <a href="tel:{{ $phone }}" class="text-ptc-light hover:text-white transition-colors flex items-center gap-1 opacity-90">
        <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
        </svg>
        {{ $phone }}
    </a>
</div>