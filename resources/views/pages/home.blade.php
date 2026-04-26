@extends('layouts.app')

@section('title', 'MoKursus - Lembaga Kursus & Pelatihan Bersertifikat')

@section('content')
    @props([
        'title' => 'Kuasai <span class="text-gradient">Skill Digital</span><br/>Bersama Trainer<br class="hidden sm:block"/>Terbaik Makassar',
        'subtitle' => 'Tingkatkan kompetensimu dengan kelas berkualitas, materi berstandar KKNI & industri, sertifikat resmi, dan konsultasi gratis selama 1 tahun.',
        'badgeText' => 'Kelas Offline & Online Tersedia',
        'primaryButtonText' => 'Daftar Kelas Offline →',
        'primaryButtonUrl' => '/pendaftaran-offline',
        'secondaryButtonText' => 'Lihat Semua Kelas',
        'secondaryButtonUrl' => '#kelas',
        'popularClasses' => [
            ['icon' => '💼', 'name' => 'Microsoft Office', 'price' => 'Rp 1,5Jt'],
            ['icon' => '💻', 'name' => 'Fullstack Developer', 'price' => 'Rp 2,2Jt'],
            ['icon' => '🎨', 'name' => 'Adobe Photoshop', 'price' => 'Rp 1,5Jt'],
            ['icon' => '📊', 'name' => 'Data Analysis Python', 'price' => 'Rp 1,55Jt'],
        ],

        'stats' => [
            ['value' => '4.9★', 'label' => 'Rating Google'],
            ['value' => '96%', 'label' => 'Tingkat Kepuasan'],
            ['value' => '17+', 'label' => 'Program Kelas'],
            ['value' => '1Thn', 'label' => 'Gratis Konsultasi'],
            ['value' => '2017', 'label' => 'Berdiri Sejak'],
        ],

        'titleFeature' => 'Mengapa Pilih MoKursus?',
        'subtitleFeature' => 'Kami hadir untuk memastikan setiap peserta mendapatkan pengalaman belajar terbaik yang siap menghadapi dunia kerja.',
        'features' => [
            ['icon' => '📚', 'title' => 'E-Book & Modul Gratis', 'description' => 'Dapatkan buku latihan dan e-book lengkap tanpa biaya tambahan untuk mendukung proses belajarmu.'],
            ['icon' => '🎓', 'title' => 'Bersertifikat Resmi', 'description' => 'Sertifikat kelulusan yang diakui industri setelah kamu menyelesaikan seluruh materi kelas.'],
            ['icon' => '💬', 'title' => 'Konsultasi 1 Tahun', 'description' => 'Akses konsultasi gratis bersama trainer selama 1 tahun penuh setelah kelas selesai.'],
            ['icon' => '📋', 'title' => 'Materi Standar KKNI', 'description' => 'Kurikulum disusun sesuai standar KKNI dan kebutuhan industri yang relevan dan mutakhir.'],
            ['icon' => '🔄', 'title' => 'Update Materi Rutin', 'description' => 'Setiap 3 bulan materi diperbarui agar selalu sesuai perkembangan teknologi terkini.'],
            ['icon' => '🤝', 'title' => 'Trainer Berpengalaman', 'description' => 'Dibimbing langsung oleh trainer profesional yang siap mendampingi hingga kamu mendapat pekerjaan.'],
        ],

        'titleCourse' => 'Pilih Kelas Sesuai Kebutuhanmu',
        'subtitleCourse' => 'Tersedia kelas online & offline dengan instruktur berpengalaman.',
        'categories' => ['Semua', 'Office', 'Desain', 'Coding', 'Teknik', 'Data'],
        'courses' => [
            ['icon' => '💼', 'category' => 'Office', 'title' => 'Microsoft Office', 'price' => 'Rp 1.500.000', 'originalPrice' => 'Rp 2.000.000', 'discount' => '-25%'],
            ['icon' => '💻', 'category' => 'Coding', 'title' => 'Fullstack Developer', 'price' => 'Rp 2.200.000', 'originalPrice' => 'Rp 2.500.000', 'discount' => '-12%'],
            ['icon' => '🎨', 'category' => 'Desain', 'title' => 'Adobe Photoshop', 'price' => 'Rp 1.500.000', 'originalPrice' => 'Rp 2.000.000', 'discount' => '-25%'],
            ['icon' => '📐', 'category' => 'Teknik', 'title' => 'AutoCAD', 'price' => 'Rp 1.450.000', 'originalPrice' => 'Rp 1.500.000', 'discount' => '-3%'],
            ['icon' => '📊', 'category' => 'Data', 'title' => 'Data Analysis (Python)', 'price' => 'Rp 1.550.000', 'originalPrice' => 'Rp 1.650.000', 'discount' => '-6%'],
            ['icon' => '📹', 'category' => 'Kreatif', 'title' => 'Video Editing', 'price' => 'Rp 1.585.000', 'originalPrice' => 'Rp 2.000.000', 'discount' => '-21%'],
            ['icon' => '🏗️', 'category' => 'Arsitektur', 'title' => 'SketchUp', 'price' => 'Rp 1.500.000', 'originalPrice' => 'Rp 2.500.000', 'discount' => '-40%'],
            ['icon' => '📣', 'category' => 'Marketing', 'title' => 'Digital Marketing', 'price' => 'Rp 1.425.000', 'originalPrice' => 'Rp 1.500.000', 'discount' => '-5%'],
        ],

        'iconCourseCard' => '💼',
        'category' => 'Office',
        'titleCourseCard' => 'Microsoft Office',
        'price' => 'Rp 1.500.000',
        'originalPrice' => 'Rp 2.000.000',
        'discount' => '-25%',
        'registerUrl' => '/pendaftaran-online',
        'detailUrl' => '#',

        'titleTestimoni' => 'Kata Mereka yang Telah Bergabung',
        'subtitleTestimoni' => 'Ribuan alumni telah merasakan manfaat belajar bersama MoKursus.',
        'testimonials' => [
            [
                'rating' => 5,
                'text' => 'Rekomendasi buat teman-teman yang ingin kursus komputer. Pelayanannya sangat baik, tutornya dalam menyampaikan materi mudah dimengerti dan sangat profesional.',
                'initial' => 'MF',
                'name' => 'Muhammad Fadhil',
                'source' => 'Review via Google'
            ],
            [
                'rating' => 5,
                'text' => 'PTC sangat recommended untuk yang mencari tempat pelatihan komputer. Banyak ilmu yang saya dapatkan, fasilitas nyaman dan trainer sangat ramah.',
                'initial' => 'MD',
                'name' => 'Muh. Daffa Abbas',
                'source' => 'Review via Google'
            ],
            [
                'rating' => 5,
                'text' => 'Sangat merekomendasikan ke teman-teman yang ingin belajar komputer. Tentornya ramah dan materinya mudah dipahami dengan sangat baik.',
                'initial' => 'PR',
                'name' => 'Putri Rezky',
                'source' => 'Review via Google'
            ],
        ],

        'titlePartner' => 'Dipercaya oleh perusahaan terkemuka',
        'partners' => ['UC Makassar', 'Astra Isuzu', 'Telkomsel', 'Astra Finance', 'Kalla Group', 'Astra Graphia', 'LPS'],

        'titleCta' => 'Siap Memulai Perjalanan Karirmu?',
        'subtitleCta' => 'Daftar sekarang dan dapatkan konsultasi gratis bersama trainer profesional kami.',
        'primaryButtonText' => 'Daftar Kelas Offline →',
        'primaryButtonUrl' => '/pendaftaran-offline',
        'secondaryButtonText' => 'Daftar Kelas Online',
        'secondaryButtonUrl' => '/pendaftaran-online'
    ])
    <main>
        <section class="relative min-h-[520px] lg:min-h-[600px] bg-hero-mesh overflow-hidden flex items-center">
            <div class="hero-dots absolute inset-0 opacity-30"></div>
            <div class="deco-circle w-64 h-64 lg:w-[500px] lg:h-[500px] border border-white/10 -right-16 -top-16 lg:-right-32 lg:-top-32"></div>
            <div class="deco-circle w-32 h-32 lg:w-[180px] lg:h-[180px] bg-ptc-light/10 right-1/3 top-12 animate-floatY hidden sm:block"></div>

            <div class="max-w-[1280px] mx-auto px-4 md:px-8 w-full py-12 lg:py-20 flex flex-col lg:flex-row items-center gap-10 lg:gap-16 relative z-10">
                
                {{-- Left content --}}
                <div class="flex-1 text-center lg:text-left">
                    <div class="live-dot inline-flex items-center text-ptc-light text-xs font-bold tracking-widest uppercase bg-white/10 px-4 py-2 rounded-full mb-5 border border-white/15">
                        {{ $badgeText }}
                    </div>
                    <h1 class="text-[32px] sm:text-[40px] lg:text-[50px] font-black leading-[1.15] text-white mb-4">
                        {!! $title !!}
                    </h1>
                    <p class="text-white/75 text-[14px] lg:text-[15px] leading-relaxed max-w-[480px] mb-7 font-body mx-auto lg:mx-0">
                        {{ $subtitle }}
                    </p>
                    <div class="flex gap-3 flex-wrap justify-center lg:justify-start mb-8">
                        <a href="{{ $primaryButtonUrl }}" class="bg-white text-ptc-blue font-extrabold text-[13px] px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all">
                            {{ $primaryButtonText }}
                        </a>
                        <a href="{{ $secondaryButtonUrl }}" class="bg-white/10 border border-white/30 text-white font-semibold text-[13px] px-6 py-3 rounded-xl hover:bg-white/20 transition-all">
                            {{ $secondaryButtonText }}
                        </a>
                    </div>
                    <div class="flex items-center gap-4 flex-wrap justify-center lg:justify-start">
                        <div class="flex items-center gap-2 text-white/80 text-[12px]">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="font-semibold">4.9</span>
                            <span class="opacity-60">Rating Google</span>
                        </div>
                        <div class="w-px h-4 bg-white/20 hidden sm:block"></div>
                        <div class="text-white/80 text-[12px]"><span class="font-semibold">1.000+</span> <span class="opacity-60">Alumni</span></div>
                        <div class="w-px h-4 bg-white/20 hidden sm:block"></div>
                        <div class="text-white/80 text-[12px]"><span class="font-semibold">17+</span> <span class="opacity-60">Program Kelas</span></div>
                    </div>
                </div>

                {{-- Right: floating card --}}
                <div class="flex-shrink-0 w-full max-w-[340px] lg:w-[340px] animate-floatY hidden sm:block">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-white font-bold text-[14px]">Kelas Populer</div>
                            <span class="bg-ptc-light/20 text-ptc-light text-[10px] font-bold px-3 py-1 rounded-full">17 Kelas</span>
                        </div>
                        <div class="space-y-2">
                            @foreach($popularClasses as $class)
                            <div class="flex items-center gap-3 bg-white/10 hover:bg-white/15 transition-colors rounded-xl p-2.5 cursor-pointer">
                                <div class="w-8 h-8 rounded-lg bg-ptc-mid/30 flex items-center justify-center text-base flex-shrink-0">
                                    {{ $class['icon'] }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-white font-semibold text-[12px] truncate">{{ $class['name'] }}</div>
                                </div>
                                <div class="text-ptc-light font-bold text-[11px] flex-shrink-0">{{ $class['price'] }}</div>
                            </div>
                            @endforeach
                        </div>
                        <a href="#kelas" class="mt-4 w-full py-2.5 bg-ptc-gradient rounded-xl text-white font-bold text-[12px] flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                            Lihat Semua Kelas →
                        </a>
                    </div>
                </div>
            </div>
            <div class="wave-bottom">
                <svg viewBox="0 0 1440 48" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M0,48 C360,0 1080,0 1440,48 L1440,48 L0,48 Z" fill="#ffffff"/>
                </svg>
            </div>
        </section>

        <section class="border-b border-slate-100 bg-white">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8 py-8 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($stats as $stat)
                <div class="text-center">
                    <div class="stat-value">{{ $stat['value'] }}</div>
                    <div class="text-slate-500 text-[12px] mt-1 font-medium">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </section>

        <section class="py-14 lg:py-20 bg-[#f8faff]">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <div class="text-center mb-10 lg:mb-14">
                    <div class="inline-block bg-blue-100 text-ptc-blue text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-3">
                        Keunggulan Kami
                    </div>
                    <h2 class="text-[26px] sm:text-[32px] lg:text-[36px] font-black text-slate-900 mb-3">{{ $titleFeature }}</h2>
                    <p class="text-slate-500 text-[14px] max-w-lg mx-auto leading-relaxed font-body">{{ $subtitleFeature }}</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($features as $feature)
                    <div class="card-lift bg-white rounded-2xl p-6 border border-slate-100">
                        <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center text-xl mb-4">{{ $feature['icon'] }}</div>
                        <h3 class="font-bold text-[14px] text-slate-900 mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-slate-500 text-[13px] leading-relaxed font-body">{{ $feature['description'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="kelas" class="py-14 lg:py-20 bg-white">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 lg:mb-10">
                    <div>
                        <div class="inline-block bg-blue-100 text-ptc-blue text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-3">Program Kelas</div>
                        <h2 class="text-[26px] sm:text-[32px] lg:text-[36px] font-black text-slate-900 mb-2">{{ $titleCourse }}</h2>
                        <p class="text-slate-500 text-[14px] font-body">{{ $subtitleCourse }}</p>
                    </div>
                    <a href="#kelas" class="text-[12px] font-bold text-ptc-blue border border-ptc-blue/30 px-5 py-2.5 rounded-xl hover:bg-blue-50 transition-colors flex-shrink-0 self-start sm:self-auto">
                        Lihat Semua →
                    </a>
                </div>

                {{-- Filter --}}
                <div class="flex gap-2 mb-7 flex-wrap" id="filter-buttons">
                    @foreach($categories as $index => $category)
                    <button class="text-[11px] font-semibold px-4 py-1.5 rounded-full border border-slate-200 bg-white text-slate-600 hover:border-ptc-mid hover:text-ptc-blue transition-all filter-btn {{ $index === 0 ? 'filter-active' : '' }}">
                        {{ $category }}
                    </button>
                    @endforeach
                </div>

                {{-- Course Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="courses-grid">
                    @foreach($courses as $course)
                    <div class="course-card bg-white rounded-2xl border border-slate-100 overflow-hidden">
                        <div class="h-24 bg-ptc-gradient flex items-center justify-center text-4xl relative">
                            {{ $iconCourseCard }}
                            @if($discount)
                            <span class="absolute top-2 right-2 bg-green-400 text-white text-[9px] font-black px-2 py-0.5 rounded-full">{{ $discount }}</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="text-ptc-mid text-[9px] font-black uppercase tracking-widest mb-1">{{ $course['category'] }}</div>
                            <div class="font-bold text-[13px] text-slate-900 mb-3">{{ $course['title'] }}</div>
                            <div class="flex items-baseline gap-2 mb-3">
                                <div class="font-extrabold text-[16px] text-ptc-blue">{{ $course['price'] }}</div>
                                @if($originalPrice)
                                <div class="text-slate-400 text-[11px] line-through">{{ $originalPrice }}</div>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ $registerUrl }}" class="flex-1 py-2 bg-ptc-gradient text-white text-[11px] font-bold rounded-lg text-center hover:opacity-90">Daftar</a>
                                <a href="{{ $detailUrl }}" class="px-3 py-2 border border-slate-200 text-slate-600 text-[11px] font-semibold rounded-lg hover:border-ptc-mid hover:text-ptc-blue">Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-14 lg:py-20 bg-[#f8faff]">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <div class="text-center mb-10 lg:mb-14">
                    <div class="inline-block bg-blue-100 text-ptc-blue text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-3">Testimoni</div>
                    <h2 class="text-[26px] sm:text-[32px] lg:text-[36px] font-black text-slate-900 mb-2">{{ $titleTestimoni }}</h2>
                    <p class="text-slate-500 text-[14px] font-body">{{ $subtitleTestimoni }}</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($testimonials as $testimonial)
                    <div class="card-lift bg-white rounded-2xl p-6 border border-slate-100">
                        <div class="star text-base mb-3">{{ str_repeat('★', $testimonial['rating']) }}</div>
                        <p class="text-slate-600 text-[13px] leading-relaxed font-body mb-5">{{ $testimonial['text'] }}</p>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-ptc-gradient flex items-center justify-center text-white font-bold text-[11px] flex-shrink-0">
                                {{ $testimonial['initial'] }}
                            </div>
                            <div>
                                <div class="font-bold text-[12px] text-slate-900">{{ $testimonial['name'] }}</div>
                                <div class="text-slate-400 text-[10px]">{{ $testimonial['source'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-10 border-t border-slate-100 bg-white">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <div class="text-center text-slate-400 text-[11px] font-black uppercase tracking-widest mb-6">{{ $titlePartner }}</div>
                <div class="flex items-center justify-center gap-3 flex-wrap">
                    @foreach($partners as $partner)
                    <div class="bg-slate-50 text-slate-600 text-[12px] font-bold px-4 py-2.5 rounded-xl border border-slate-100">
                        {{ $partner }}
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="relative bg-hero-mesh py-16 lg:py-24 overflow-hidden">
            <div class="hero-dots absolute inset-0 opacity-20"></div>
            <div class="max-w-[1280px] mx-auto px-4 md:px-8 text-center relative z-10">
                <div class="inline-block bg-white/15 text-ptc-light text-[10px] font-black uppercase tracking-widest px-5 py-2 rounded-full mb-5 border border-white/20">
                    Mulai Sekarang
                </div>
                <h2 class="text-[28px] sm:text-[34px] lg:text-[42px] font-black text-white mb-4 leading-tight">{{ $titleCta }}</h2>
                <p class="text-white/75 text-[14px] mb-8 max-w-xl mx-auto font-body leading-relaxed">{{ $subtitleCta }}</p>
                <div class="flex gap-3 justify-center flex-wrap">
                    <a href="{{ $primaryButtonUrl }}" class="bg-white text-ptc-blue font-extrabold text-[14px] px-7 py-3.5 rounded-xl shadow-xl hover:scale-[1.02] transition-all">
                        {{ $primaryButtonText }}
                    </a>
                    <a href="{{ $secondaryButtonUrl }}" class="bg-white/10 border border-white/30 text-white font-semibold text-[14px] px-7 py-3.5 rounded-xl hover:bg-white/20 transition-all">
                        {{ $secondaryButtonText }}
                    </a>
                </div>
            </div>
        </section>

        @push('scripts')
        <script>
            document.querySelectorAll(".filter-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("filter-active"));
                    this.classList.add("filter-active");
                    
                    const category = this.textContent;
                    const cards = document.querySelectorAll("#courses-grid > div");
                    
                    cards.forEach(card => {
                        const cardCategory = card.querySelector(".text-ptc-mid")?.textContent || "";
                        if (category === "Semua" || cardCategory === category) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
            });
        </script>
        @endpush
    </main>
@endsection