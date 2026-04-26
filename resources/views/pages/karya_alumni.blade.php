@extends('layouts.app')

    @push('styles')
    <style>
        /* ─── HERO ─── */
        .hero-bg{
            background:linear-gradient(135deg,#e6f0ff 0%,#d9e9ff 100%);
            position:relative;overflow:hidden;
        }
        .hero-grid{
            background-image:
                linear-gradient(rgba(90,213,251,0.05) 1px,transparent 1px),
                linear-gradient(90deg,rgba(90,213,251,0.05) 1px,transparent 1px);
            background-size:40px 40px;
        }

        /* ─── FILTER BAR ─── */
        .filter-card{
            background:#fff;
            border-bottom:1px solid #e8eaf0;
            padding:20px 0;
        }
        .filter-label{font-size:13px;font-weight:700;color:#374151;margin-bottom:6px;}
        .sel{
            appearance:none;-webkit-appearance:none;
            width:100%;padding:10px 36px 10px 14px;
            border:1.5px solid #d1d5db;border-radius:8px;
            font-size:13px;font-family:inherit;background:#fff;color:#374151;
            cursor:pointer;outline:none;
            background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 24 24' stroke='%236b7280' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat:no-repeat;background-position:right 11px center;
            transition:border-color .2s;
        }
        .sel:focus{border-color:#009dff;outline:none;}

        /* ─── SEARCH ─── */
        .search-box{
            position:relative;
        }
        .search-box input{
            width:100%;padding:10px 14px 10px 38px;
            border:1.5px solid #d1d5db;border-radius:8px;
            font-size:13px;font-family:inherit;color:#374151;background:#fff;
            outline:none;transition:border-color .2s;
        }
        .search-box input:focus{border-color:#009dff;}
        .search-box input::placeholder{color:#9ca3af;}
        .search-icon{position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#9ca3af;pointer-events:none;}

        /* ─── KARYA CARD ─── */
        .karya-card {
            background:#fff;border-radius:4px;
            border:1px solid #e5e7eb;
            overflow:hidden;
            transition:box-shadow .2s,transform .2s;
            cursor:pointer;
        }
        .karya-card:hover {
            box-shadow:0 8px 30px rgba(0,0,0,0.12);
            transform:translateY(-3px);
        }
        .karya-thumb {
            width:100%;height:200px;object-fit:cover;display:block;
            background:#f3f4f6;
        }
        .karya-thumb-placeholder {
            width:100%;height:200px;display:flex;align-items:center;justify-content:center;
            font-size:56px;
        }

        /* ─── LIHAT KARYA BTN ─── */
        .btn-lihat{
            display:inline-block;padding:8px 18px;
            background:#2563eb;color:#fff;
            border:none;border-radius:4px;font-size:13px;font-weight:700;
            cursor:pointer;font-family:inherit;
            transition:background .15s;text-decoration:none;
        }
        .btn-lihat:hover{background:#1d4ed8;}

        .btn-belum{
            display:inline-block;padding:7px 16px;
            background:#f3f4f6;color:#9ca3af;
            border:1px solid #e5e7eb;border-radius:4px;
            font-size:13px;font-weight:600;cursor:default;font-family:inherit;
        }

        /* ─── SKELETON ─── */
        .skel{
            background:linear-gradient(90deg,#f1f5f9 25%,#e2e8f0 50%,#f1f5f9 75%);
            background-size:600px 100%;
            animation:shimmer 1.3s infinite;
            border-radius:4px;
        }

        /* ─── PAGINATION ─── */
        .pg {
        width:36px;height:36px;border-radius:4px;border:1px solid #d1d5db;
        background:#fff;color:#374151;font-size:13px;font-weight:600;
        cursor:pointer;display:flex;align-items:center;justify-content:center;
        font-family:inherit;transition:all .15s;
        }
        .pg:hover,.pg.on{background:#2563eb;color:#fff;border-color:#2563eb;}
        .pg:disabled{opacity:.4;cursor:not-allowed;}

        /* ─── MODAL ─── */
        .modal-bg{
            position:fixed;inset:0;background:rgba(0,0,0,0.55);
            backdrop-filter:blur(4px);z-index:500;
            display:flex;align-items:center;justify-content:center;padding:16px;
        }
        .modal-box{
            background:#fff;border-radius:8px;width:100%;max-width:520px;
            max-height:88vh;overflow-y:auto;
            box-shadow:0 24px 80px rgba(0,0,0,.22);
            animation:fadeUp .3s ease both;
        }

        /* ─── PAGE TRANSITION ─── */
        #pg-overlay{
            position:fixed;inset:0;z-index:9998;
            background:linear-gradient(135deg,#0060d2,#009dff);
            transform:translateY(-100%);
            transition:transform .35s cubic-bezier(.4,0,.2,1);
            pointer-events:none;
        }
        #pg-overlay.in{transform:translateY(0);}

        /* line-clamp */
        .clamp2{display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden;}
        .clamp3{display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:3;overflow:hidden;}
    </style>
    @endpush

@section('title', 'MoKursus - Lembaga Kursus & Pelatihan Bersertifikat')

@section('content')
    <!-- ═══ HERO ═══ -->
    <section class="hero-bg">
        <div class="hero-grid absolute inset-0"></div>
        <!-- glow blobs -->
        <div style="position:absolute;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(0,157,255,0.12),transparent 70%);top:-100px;left:50%;transform:translateX(-50%);pointer-events:none;"></div>
        <div style="position:absolute;width:250px;height:250px;border-radius:50%;background:radial-gradient(circle,rgba(90,213,251,0.08),transparent 70%);bottom:0;right:10%;pointer-events:none;"></div>

        <div style="position:relative;z-index:1;max-width:860px;margin:0 auto;padding:56px 24px 64px;text-align:center;">
            <h1 style="font-size:clamp(28px,5vw,52px);font-weight:900;color:#0f172a;line-height:1.15;margin-bottom:16px;">
            Galeri Karya Alumni MoKursus
            </h1>
            <p style="color:#0f172a; font-size:15px;line-height:1.7;margin-bottom:10px;" class="font-body">
            Di MoKursus, kamu nggak cuma belajar teori, kamu juga harus menciptakan sesuatu yang nyata.
            </p>
            <p style="color:#0060d2;font-size:13.5px;line-height:1.7;max-width:720px;margin:0 auto 36px;" class="font-body">
            Dari website keren, desain UI/UX, hingga karya digital kreatif lainnya — ini semua adalah karya alumni MoKursus dari berbagai latar belakang: pelajar, mahasiswa, profesional.
            </p>
            <!-- scroll arrow -->
            <div style="display:inline-flex;flex-direction:column;align-items:center;gap:4px;" class="animate-bounce" onclick="scrollToNextSection()">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5" style="opacity:.7;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
            </div>
        </div>

        <!-- bottom wave -->
        <div style="overflow:hidden;line-height:0;pointer-events:none;">
            <svg viewBox="0 0 1440 40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="display:block;">
            <path d="M0,40 C480,0 960,0 1440,40 L1440,40 L0,40 Z" fill="#f5f6fa"/>
            </svg>
        </div>
    </section>

    <!-- ═══ FILTER BAR ═══ -->
    <div class="filter-card">
        <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;align-items:end;">

                <!-- Urutkan -->
                <div>
                    <div class="filter-label">Urutkan Berdasarkan:</div>
                    <select class="sel" id="sort-sel" onchange="applyFilters()">
                    <option value="terbaru">Terbaru</option>
                    <option value="terlama">Terlama</option>
                    <option value="nama-az">Nama A–Z</option>
                    <option value="nama-za">Nama Z–A</option>
                    <option value="harga-asc">Harga Terendah</option>
                    <option value="harga-desc">Harga Tertinggi</option>
                    </select>
                </div>

                <!-- Filter Alumni -->
                <div>
                    <div class="filter-label">Filter Nama Alumni:</div>
                    <select class="sel" id="alumni-sel" onchange="applyFilters()">
                    <option value="">Semua Alumni</option>
                    <option>Megawati 88</option>
                    <option>Asriani</option>
                    <option>Andi Adelia Amanda</option>
                    <option>Andi Aulia Amanda</option>
                    <option>Riski Ramadhan</option>
                    <option>Nurul Hikmah</option>
                    <option>Ahmad Fauzi</option>
                    <option>Siti Rahma</option>
                    <option>Bagas Pratama</option>
                    <option>Reza Maulana</option>
                    </select>
                </div>

                <!-- Cari -->
                <div>
                    <div class="filter-label">Cari:</div>
                    <div class="search-box">
                    <svg class="search-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="Judul atau nama alumni..." id="q-input" oninput="applyFilters()" />
                    </div>
                </div>

                <!-- Count + Reset -->
                <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:2px;">
                    <div style="font-size:13px;color:#6b7280;" class="font-body">
                    Menampilkan <span id="rc" style="font-weight:700;color:#111827;">0</span> karya
                    </div>
                    <button onclick="resetF()" style="font-size:12px;color:#009dff;font-weight:700;background:none;border:none;cursor:pointer;font-family:inherit;display:flex;align-items:center;gap:4px;">
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Reset
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ═══ GALLERY ═══ -->
    <main style="max-width:1280px;margin:0 auto;padding:32px 24px 60px;">

        <!-- Skeleton -->
        <div id="skel-grid" style="display:none;grid-template-columns:repeat(4,1fr);gap:20px;" class="sm:grid-cols-2 lg:grid-cols-4">
            <!-- 8 skeleton cards -->
            <script>document.write(Array(8).fill(`<div style="background:#fff;border-radius:4px;border:1px solid #e5e7eb;overflow:hidden;"><div class="skel" style="height:200px;"></div><div style="padding:14px;"><div class="skel" style="height:10px;width:75%;margin-bottom:8px;"></div><div class="skel" style="height:10px;width:100%;margin-bottom:4px;"></div><div class="skel" style="height:10px;width:85%;margin-bottom:14px;"></div><div class="skel" style="height:10px;width:50%;margin-bottom:14px;"></div><div class="skel" style="height:10px;width:30%;margin-bottom:10px;"></div></div></div>`).join(""))</script>
        </div>

        <!-- Actual grid -->
        <div id="karya-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;"></div>

        <!-- Empty -->
        <div id="empty" style="display:none;text-align:center;padding:72px 0;">
            <div style="font-size:48px;margin-bottom:12px;">🔍</div>
            <div style="font-weight:700;font-size:16px;color:#374151;margin-bottom:6px;">Tidak ada karya ditemukan</div>
            <div style="font-size:13px;color:#9ca3af;margin-bottom:20px;" class="font-body">Coba ubah filter atau kata kunci.</div>
            <button onclick="resetF()" class="btn-lihat">Reset Filter</button>
        </div>

        <!-- Pagination -->
        <div id="pag" style="display:flex;justify-content:center;gap:6px;margin-top:36px;flex-wrap:wrap;"></div>

    </main>

    <!-- ═══ MODAL ═══ -->
    <div class="modal-bg" id="modal" style="display:none;" onclick="closeModal(event)">
        <div class="modal-box" id="modal-box">
            <!-- filled by JS -->
        </div>
    </div>

    @push('scripts')
        <script>
            // Data
            const DATA = [
            {
                id:1,
                judul:"Aplikasi Pemesanan Online",
                desk:"Aplikasi pemesanan online ini di buat untuk mempemudah customer melakukan pemesanan langsung di tempat outlet. Dibangun menggunakan React Native dan Laravel backend.",
                alumni:"Megawati 88",
                cat:"app",
                harga:0,hargaAsli:0,
                link:"https://github.com",tersedia:true,
                tgl:"2026-04-15",
                bg:"linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%)",
                icon:"📱",
                tags:["React Native","Laravel","Mobile App"]
            },
            {
                id:2,
                judul:"Desain Komposisi Vektor",
                desk:"Karena file upload.php barusan kamu pakai template yang saya kasih (grid portofolio), padahal upload.php biasanya...",
                alumni:"Asriani",
                cat:"desain",
                harga:0,hargaAsli:0,
                link:null,tersedia:false,
                tgl:"2026-04-12",
                bg:"linear-gradient(135deg,#166534 0%,#4ade80 100%)",
                icon:"🎨",
                tags:["Adobe Illustrator","Desain Grafis","Vektor"]
            },
            {
                id:3,
                judul:"Logo Personal Branding",
                desk:"Ini adalah desain pertama saya, di pertemuan pertama PTC. Menggunakan tipografi kustom dengan warna pink yang berkarakter.",
                alumni:"Andi Adelia Amanda",
                cat:"desain",
                harga:0,hargaAsli:0,
                link:null,tersedia:false,
                tgl:"2026-04-10",
                bg:"linear-gradient(135deg,#831843 0%,#f472b6 100%)",
                icon:"✍️",
                tags:["Photoshop","Logo","Typography"]
            },
            {
                id:4,
                judul:"Ilustrasi Tanaman Hias",
                desk:"Lorem Ipsun Akmp semth. Karya ilustrasi digital menampilkan berbagai jenis tanaman hias dalam pot menggunakan Adobe Illustrator.",
                alumni:"Andi Aulia Amanda",
                cat:"desain",
                harga:0,hargaAsli:0,
                link:null,tersedia:false,
                tgl:"2026-04-08",
                bg:"linear-gradient(135deg,#14532d 0%,#86efac 100%)",
                icon:"🌿",
                tags:["Illustrator","Vector Art","Ilustrasi"]
            },
            {
                id:5,
                judul:"Website Toko Online",
                desk:"Website toko online lengkap dengan sistem pembayaran, manajemen produk, dan dashboard admin. Dibangun menggunakan PHP & Bootstrap.",
                alumni:"Riski Ramadhan",
                cat:"web",
                harga:500000,hargaAsli:1000000,
                link:"https://github.com",tersedia:true,
                tgl:"2026-04-05",
                bg:"linear-gradient(135deg,#1e3a8a 0%,#60a5fa 100%)",
                icon:"🛒",
                tags:["PHP","MySQL","Bootstrap","E-Commerce"]
            },
            {
                id:6,
                judul:"Video Iklan Produk UMKM",
                desk:"Video iklan produk makanan UMKM lokal Makassar, durasi 60 detik, editing menggunakan Adobe Premiere Pro.",
                alumni:"Nurul Hikmah",
                cat:"video",
                harga:0,hargaAsli:0,
                link:"https://youtube.com",tersedia:true,
                tgl:"2026-03-28",
                bg:"linear-gradient(135deg,#7c2d12 0%,#fb923c 100%)",
                icon:"🎬",
                tags:["Premiere Pro","Video Editing","Motion Graphic"]
            },
            {
                id:7,
                judul:"Foto Produk Profesional",
                desk:"Sesi foto produk makanan dengan teknik flat lay. Editing menggunakan Adobe Lightroom untuk hasil yang bersih dan appetizing.",
                alumni:"Ahmad Fauzi",
                cat:"foto",
                harga:300000,hargaAsli:500000,
                link:null,tersedia:true,
                tgl:"2026-03-20",
                bg:"linear-gradient(135deg,#78350f 0%,#fbbf24 100%)",
                icon:"📸",
                tags:["Lightroom","Food Photography","Editing"]
            },
            {
                id:8,
                judul:"Sistem Absensi Digital",
                desk:"Sistem absensi berbasis QR Code dengan laporan bulanan dan notifikasi WhatsApp. Backend Node.js + MongoDB.",
                alumni:"Siti Rahma",
                cat:"web",
                harga:0,hargaAsli:0,
                link:"https://github.com",tersedia:true,
                tgl:"2026-03-15",
                bg:"linear-gradient(135deg,#0c4a6e 0%,#38bdf8 100%)",
                icon:"✅",
                tags:["Node.js","MongoDB","QR Code"]
            },
            {
                id:9,
                judul:"UI/UX Mobile Banking",
                desk:"Redesign aplikasi mobile banking modern dengan memperhatikan aspek accessibility dan usability, dibuat di Figma.",
                alumni:"Bagas Pratama",
                cat:"desain",
                harga:0,hargaAsli:0,
                link:"https://figma.com",tersedia:true,
                tgl:"2026-03-10",
                bg:"linear-gradient(135deg,#312e81 0%,#a78bfa 100%)",
                icon:"💳",
                tags:["Figma","UI/UX","Prototype"]
            },
            {
                id:10,
                judul:"Poster Event Digital",
                desk:"Kumpulan poster event untuk festival dan seminar lokal Makassar. Dibuat menggunakan Adobe Photoshop dengan konsep berbeda-beda.",
                alumni:"Asriani",
                cat:"desain",
                harga:200000,hargaAsli:400000,
                link:null,tersedia:true,
                tgl:"2026-03-05",
                bg:"linear-gradient(135deg,#701a75 0%,#e879f9 100%)",
                icon:"🎪",
                tags:["Photoshop","Poster Design","Event"]
            },
            {
                id:11,
                judul:"Landing Page Startup",
                desk:"Landing page modern dengan animasi scroll untuk startup teknologi lokal. Dibuat menggunakan HTML, CSS, JS vanilla.",
                alumni:"Reza Maulana",
                cat:"web",
                harga:0,hargaAsli:0,
                link:"https://github.com",tersedia:true,
                tgl:"2026-02-28",
                bg:"linear-gradient(135deg,#0f172a 0%,#2563eb 100%)",
                icon:"🚀",
                tags:["HTML","CSS","JavaScript","Animasi"]
            },
            {
                id:12,
                judul:"Konten Instagram Bisnis",
                desk:"Paket 30 template konten Instagram untuk bisnis kuliner dan fashion. Semua template dapat diedit di Canva.",
                alumni:"Nurul Hikmah",
                cat:"desain",
                harga:150000,hargaAsli:300000,
                link:null,tersedia:true,
                tgl:"2026-02-20",
                bg:"linear-gradient(135deg,#be185d 0%,#fb7185 100%)",
                icon:"📱",
                tags:["Canva","Instagram","Content Design"]
            },
            ];

            // State
            let page = 1;
            const PER = 8;

            // Filtered
            function filtered() {
            const sort   = document.getElementById("sort-sel").value;
            const alumni = document.getElementById("alumni-sel").value;
            const q      = document.getElementById("q-input").value.toLowerCase().trim();

            let d = [...DATA];
            if (alumni) d = d.filter(k => k.alumni === alumni);
            if (q) d = d.filter(k =>
                k.judul.toLowerCase().includes(q) ||
                k.alumni.toLowerCase().includes(q) ||
                k.desk.toLowerCase().includes(q)
            );

            if (sort === "terbaru")    d.sort((a,b) => b.tgl.localeCompare(a.tgl));
            if (sort === "terlama")    d.sort((a,b) => a.tgl.localeCompare(b.tgl));
            if (sort === "nama-az")    d.sort((a,b) => a.judul.localeCompare(b.judul));
            if (sort === "nama-za")    d.sort((a,b) => b.judul.localeCompare(a.judul));
            if (sort === "harga-asc")  d.sort((a,b) => a.harga - b.harga);
            if (sort === "harga-desc") d.sort((a,b) => b.harga - a.harga);
            return d;
            }

            // Render
            function render(data, pg) {
            const grid  = document.getElementById("karya-grid");
            const empty = document.getElementById("empty");
            const pag   = document.getElementById("pag");
            const rc    = document.getElementById("rc");

            rc.textContent = data.length;

            if (!data.length) {
                grid.style.display = "none";
                empty.style.display = "block";
                pag.innerHTML = "";
                return;
            }
            empty.style.display = "none";
            grid.style.display = "grid";

            const slice = data.slice((pg-1)*PER, pg*PER);

            grid.innerHTML = slice.map((k,i) => `
                <div class="karya-card" onclick="openModal(${k.id})" style="animation:fadeUp .4s ${i*.05}s both;">
                <!-- Thumbnail -->
                <div style="position:relative;overflow:hidden;">
                    <div class="karya-thumb-placeholder" style="background:${k.bg};">${k.icon}</div>
                </div>

                <!-- Body -->
                <div style="padding:14px;">
                    <p class="clamp3" style="font-size:13px;color:#374151;line-height:1.6;margin-bottom:8px;" class="font-body">${k.desk}</p>
                    <p style="font-size:12.5px;color:#6b7280;margin-bottom:10px;" class="font-body">
                    Oleh Kk <strong style="color:#111827;">${k.alumni}</strong>
                    </p>
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap;">
                    <div>
                        ${k.harga === 0
                        ? `<span style="font-weight:800;font-size:14px;color:#111827;">Rp 0</span>${k.hargaAsli > 0 ? `<span style="font-size:11px;color:#9ca3af;text-decoration:line-through;margin-left:6px;">Rp ${k.hargaAsli.toLocaleString('id')}</span>` : ''}`
                        : `<span style="font-weight:800;font-size:14px;color:#111827;">Rp ${k.harga.toLocaleString('id')}</span>${k.hargaAsli > k.harga ? `<span style="font-size:11px;color:#9ca3af;text-decoration:line-through;margin-left:6px;">Rp ${k.hargaAsli.toLocaleString('id')}</span>` : ''}`
                        }
                    </div>
                    ${k.tersedia && k.link
                        ? `<button class="btn-lihat" onclick="event.stopPropagation();window.open('${k.link}','_blank')">Lihat Karya</button>`
                        : `<span class="btn-belum">Belum Tersedia</span>`
                    }
                    </div>
                </div>
                </div>
            `).join("");

            // Responsive grid
            const cols = window.innerWidth < 640 ? 1 : window.innerWidth < 1024 ? 2 : 4;
            grid.style.gridTemplateColumns = `repeat(${cols},1fr)`;

            // Pagination
            const total = Math.ceil(data.length / PER);
            if (total <= 1) { pag.innerHTML = ""; return; }

            let html = `<button class="pg" onclick="goPg(${Math.max(1,pg-1)})" ${pg===1?"disabled":""}><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg></button>`;
            for (let p=1; p<=total; p++) {
                html += `<button class="pg${p===pg?' on':''}" onclick="goPg(${p})">${p}</button>`;
            }
            html += `<button class="pg" onclick="goPg(${Math.min(total,pg+1)})" ${pg===total?"disabled":""}><svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></button>`;
            pag.innerHTML = html;
            }

            function goPg(p) {
            page = p;
            render(filtered(), page);
            document.getElementById("karya-grid").scrollIntoView({behavior:"smooth",block:"start"});
            }

            // Apply filters with skeleton
            function applyFilters() {
            const skel = document.getElementById("skel-grid");
            const grid = document.getElementById("karya-grid");

            skel.style.display = "grid";
            const cols = window.innerWidth < 640 ? 1 : window.innerWidth < 1024 ? 2 : 4;
            skel.style.gridTemplateColumns = `repeat(${cols},1fr)`;
            grid.style.display = "none";

            setTimeout(() => {
                skel.style.display = "none";
                page = 1;
                render(filtered(), page);
            }, 380);
            }

            function resetF() {
            document.getElementById("sort-sel").value   = "terbaru";
            document.getElementById("alumni-sel").value = "";
            document.getElementById("q-input").value    = "";
            applyFilters();
            }

            // Modal
            function openModal(id) {
            const k = DATA.find(x => x.id === id);
            if (!k) return;

            const fmt = n => n === 0 ? "Rp 0 (Gratis)" : "Rp " + n.toLocaleString("id");
            const tags = k.tags.map(t => `<span style="display:inline-block;background:#eff6ff;color:#1d4ed8;font-size:10px;font-weight:700;padding:3px 10px;border-radius:4px;">${t}</span>`).join("");

            document.getElementById("modal-box").innerHTML = `
                <!-- Header -->
                <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid #f1f5f9;">
                <div style="font-weight:800;font-size:15px;color:#111827;">${k.judul}</div>
                <button onclick="closeModal()" style="width:30px;height:30px;border-radius:6px;background:#f1f5f9;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;color:#6b7280;">✕</button>
                </div>

                <!-- Thumb -->
                <div style="height:200px;display:flex;align-items:center;justify-content:center;font-size:72px;background:${k.bg};">${k.icon}</div>

                <!-- Body -->
                <div style="padding:20px;">
                <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:14px;">${tags}</div>
                <p style="font-size:13.5px;color:#4b5563;line-height:1.7;margin-bottom:16px;" class="font-body">${k.desk}</p>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px;">
                    <div style="background:#f9fafb;border-radius:6px;padding:12px;">
                    <div style="font-size:10px;font-weight:800;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;margin-bottom:4px;">Alumni</div>
                    <div style="font-weight:700;font-size:13px;color:#111827;">Kk ${k.alumni}</div>
                    </div>
                    <div style="background:#f9fafb;border-radius:6px;padding:12px;">
                    <div style="font-size:10px;font-weight:800;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;margin-bottom:4px;">Harga</div>
                    <div style="font-weight:800;font-size:13px;color:${k.harga===0?'#16a34a':'#1d4ed8'};">${fmt(k.harga)}</div>
                    </div>
                    <div style="background:#f9fafb;border-radius:6px;padding:12px;">
                    <div style="font-size:10px;font-weight:800;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;margin-bottom:4px;">Kategori</div>
                    <div style="font-weight:700;font-size:13px;color:#111827;text-transform:capitalize;">${k.cat}</div>
                    </div>
                    <div style="background:#f9fafb;border-radius:6px;padding:12px;">
                    <div style="font-size:10px;font-weight:800;color:#9ca3af;text-transform:uppercase;letter-spacing:.6px;margin-bottom:4px;">Status</div>
                    <div style="font-weight:700;font-size:13px;color:${k.tersedia&&k.link?'#16a34a':'#9ca3af'};">${k.tersedia&&k.link?'✓ Tersedia':'Belum Tersedia'}</div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;">
                    <button onclick="closeModal()" style="flex:1;padding:11px;border:1.5px solid #e5e7eb;border-radius:6px;font-size:13px;font-weight:700;color:#6b7280;background:#fff;cursor:pointer;font-family:inherit;">Tutup</button>
                    ${k.tersedia && k.link
                    ? `<a href="${k.link}" target="_blank" style="flex:1;padding:11px;background:#2563eb;color:#fff;border-radius:6px;font-size:13px;font-weight:800;text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Lihat Karya</a>`
                    : `<button disabled style="flex:1;padding:11px;background:#f1f5f9;color:#9ca3af;border:none;border-radius:6px;font-size:13px;font-weight:700;cursor:not-allowed;font-family:inherit;">Belum Tersedia</button>`
                    }
                </div>
                </div>
            `;

            document.getElementById("modal").style.display = "flex";
            document.body.style.overflow = "hidden";
            }

            function closeModal(e) {
            if (e && e.target !== document.getElementById("modal")) return;
            document.getElementById("modal").style.display = "none";
            document.body.style.overflow = "";
            }

            document.addEventListener("keydown", e => {
            if (e.key === "Escape") {
                document.getElementById("modal").style.display = "none";
                document.body.style.overflow = "";
            }
            });

            // Close button inside modal
            document.getElementById("modal").addEventListener("click", function(e) {
            if (e.target === this) {
                this.style.display = "none";
                document.body.style.overflow = "";
            }
            });

            // Page transition
            function goPage(e, url) {
            if (!url || url === "#") return;
            e.preventDefault();
            const ov = document.getElementById("pg-overlay");
            ov.classList.add("in");
            setTimeout(() => { window.location.href = url; }, 340);
            }

            // Responsive grid on resize
            window.addEventListener("resize", () => render(filtered(), page));

            // Spinner
            window.addEventListener("load", () => {
            setTimeout(() => {
                const sp = document.getElementById("page-spinner");
                sp.classList.add("hide");
                setTimeout(() => { sp.remove(); }, 450);
            }, 700);
            });

            window.addEventListener("beforeunload", () => {
            const sp = document.getElementById("page-spinner");
            if (sp) { sp.classList.remove("hide"); }
            });

            // Init
            render(filtered(), page);

            function scrollToNextSection() {
                // Scroll ke section berikutnya (misal: 100vh)
                window.scrollBy({
                    top: window.innerHeight,
                    behavior: 'smooth'
                });
            }
        </script>
    @endpush
@endsection