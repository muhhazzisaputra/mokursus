@extends('layouts.app')

    @push('styles')
    <style>
        /* note box */
        .note-box{background:#fffbeb;border:1px solid #fde68a;border-radius:14px;padding:16px 20px;}
        .note-box li{font-size:13px;color:#92400e;font-family:"DM Sans",sans-serif;line-height:1.6;}
        .note-box li::marker{color:#f59e0b;}

        /* card */
        .card{background:#fff;border-radius:20px;box-shadow:0 2px 4px rgba(0,0,0,0.03),0 8px 32px rgba(0,96,210,0.07),0 0 0 1px rgba(0,96,210,0.05);}

        /* tab active */
        .filter-tab{padding:6px 16px;border-radius:99px;font-size:12px;font-weight:600;cursor:pointer;border:1.5px solid #e2e8f0;color:#64748b;background:#fff;transition:all .15s;font-family:inherit;}
        .filter-tab.active,.filter-tab:hover{background:linear-gradient(90deg,#0060d2,#009dff);color:#fff;border-color:transparent;}

        /* btn detail tagihan */
        .btn-tagihan{
            display:inline-flex;align-items:center;gap:6px;padding:7px 16px;
            background:linear-gradient(135deg,#f97316,#fb923c);
            color:#fff;border:none;border-radius:8px;font-size:12px;font-weight:700;
            cursor:pointer;font-family:inherit;transition:opacity .2s,transform .15s;
            box-shadow:0 2px 8px rgba(249,115,22,0.3);
        }
        .btn-tagihan:hover{opacity:0.9;transform:translateY(-1px);}

        .btn-lunas{
            display:inline-flex;align-items:center;gap:6px;padding:7px 16px;
            background:linear-gradient(135deg,#16a34a,#22c55e);
            color:#fff;border:none;border-radius:8px;font-size:12px;font-weight:700;
            cursor:pointer;font-family:inherit;transition:opacity .2s,transform .15s;
            box-shadow:0 2px 8px rgba(34,197,94,0.25);
        }
        .btn-lunas:hover{opacity:0.9;transform:translateY(-1px);}

        /* status badge */
        .badge{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
        .badge-pending  {background:#fef9c3;color:#854d0e;}
        .badge-tagihan  {background:#fff7ed;color:#c2410c;}
        .badge-lunas    {background:#dcfce7;color:#166534;}
        .badge-proses   {background:#e0f2fe;color:#075985;}
        .badge-batal    {background:#fee2e2;color:#991b1b;}

        /* dot pulse for status */
        .dot{width:7px;height:7px;border-radius:50%;display:inline-block;flex-shrink:0;}
        .dot-pending{background:#eab308;animation:pulse2 2s ease-in-out infinite;}
        .dot-tagihan{background:#f97316;animation:pulse2 2s ease-in-out infinite;}
        .dot-lunas  {background:#22c55e;}
        .dot-proses {background:#0ea5e9;animation:pulse2 2s ease-in-out infinite;}
        .dot-batal  {background:#ef4444;}
        </style>
    @endpush

@section('title', 'MoKursus - Lembaga Kursus & Pelatihan Bersertifikat')

@section('content')
    <main class="max-w-[1280px] mx-auto px-4 md:px-8 py-8 lg:py-12">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7 animate-fadeUp">
            <div>
                <h1 class="text-[24px] sm:text-[28px] font-black text-slate-900 leading-tight">Cek Status Pemesanan</h1>
                <p class="text-slate-500 text-[13px] mt-1 font-body">Pantau status pembayaran dan tagihan kelas kamu di sini.</p>
            </div>
            <a href="/#kelas" class="inline-flex items-center gap-2 bg-ptc-gradient text-white font-bold text-[13px] px-5 py-2.5 rounded-xl shadow-md shadow-ptc-blue/20 hover:opacity-90 transition-opacity flex-shrink-0 self-start sm:self-auto">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Daftar Kelas Baru
            </a>
        </div>

        <!-- NOTE BOX -->
        <div class="note-box mb-7 animate-fadeUp">
            <div class="flex items-start gap-3">
                <div class="text-xl flex-shrink-0 mt-0.5">📋</div>
                <div>
                    <div class="font-bold text-[13px] text-amber-800 mb-1.5">Catatan Penting:</div>
                    <ol class="list-decimal list-inside space-y-1">
                    <li>Apabila status pembayaran anda <strong>Selesai</strong>, silahkan kembali ke halaman kelas/tugas.</li>
                    <li>Apabila status pembayaran anda <strong>Detail Tagihan</strong>, silahkan klik tombol dan segera melakukan pembayaran.</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- SUMMARY CARDS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-7 animate-fadeUp">
            <div class="card p-5">
                <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Kelas</div>
                <div class="text-[28px] font-black text-slate-900 leading-none mb-1">3</div>
                <div class="text-[12px] text-slate-500 font-body">Program terdaftar</div>
            </div>
            <div class="card p-5">
                <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Tagihan</div>
                <div class="text-[28px] font-black text-orange-500 leading-none mb-1">1</div>
                <div class="text-[12px] text-slate-500 font-body">Menunggu pembayaran</div>
            </div>
            <div class="card p-5">
                <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Lunas</div>
                <div class="text-[28px] font-black text-green-500 leading-none mb-1">2</div>
                <div class="text-[12px] text-slate-500 font-body">Pembayaran selesai</div>
            </div>
            <div class="card p-5">
                <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Tagihan</div>
                <div class="text-[20px] font-black text-ptc-blue leading-none mb-1">Rp 4,7Jt</div>
                <div class="text-[12px] text-slate-500 font-body">Seluruh pemesanan</div>
            </div>
        </div>

        <!-- TABLE CARD -->
        <div class="card animate-fadeUp overflow-hidden">

            <!-- Card header + filter -->
            <div class="px-5 sm:px-7 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center text-lg flex-shrink-0">🧾</div>
                    <div>
                    <div class="font-bold text-[15px] text-slate-900">Daftar Pemesanan</div>
                    <div class="text-[12px] text-slate-400 font-body">3 program terdaftar</div>
                    </div>
                </div>
                <!-- Filter tabs -->
                <div class="flex gap-2 flex-wrap">
                    <button class="filter-tab active" onclick="filterTable('semua',this)">Semua</button>
                    <button class="filter-tab" onclick="filterTable('tagihan',this)">Tagihan</button>
                    <button class="filter-tab" onclick="filterTable('lunas',this)">Lunas</button>
                </div>
            </div>

            <!-- Desktop Table -->
            <div class="hidden sm:block overflow-x-auto">
            <table class="w-full" id="order-table">
                <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="text-left px-6 py-3.5 text-[11px] font-black text-slate-500 uppercase tracking-widest w-8">#</th>
                    <th class="text-left px-4 py-3.5 text-[11px] font-black text-slate-500 uppercase tracking-widest">Program</th>
                    <th class="text-left px-4 py-3.5 text-[11px] font-black text-slate-500 uppercase tracking-widest">Tipe Kelas</th>
                    <th class="text-left px-4 py-3.5 text-[11px] font-black text-slate-500 uppercase tracking-widest">Tanggal Daftar</th>
                    <th class="text-right px-4 py-3.5 text-[11px] font-black text-slate-500 uppercase tracking-widest">Tagihan</th>
                    <th class="text-center px-4 py-3.5 text-[11px] font-black text-slate-500 uppercase tracking-widest">Status Pembayaran</th>
                </tr>
                </thead>
                <tbody id="table-body">

                <!-- Row 1 – Detail Tagihan (belum bayar) -->
                <tr class="trow border-b border-slate-50" data-status="tagihan">
                    <td class="px-6 py-4 text-[13px] text-slate-400 font-medium">1</td>
                    <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-ptc-gradient flex items-center justify-center text-lg flex-shrink-0">💼</div>
                        <div>
                        <div class="font-bold text-[13.5px] text-slate-900">Microsoft Office For School</div>
                        <div class="text-[11px] text-slate-400 font-body mt-0.5">24 Pertemuan · Sertifikat</div>
                        </div>
                    </div>
                    </td>
                    <td class="px-4 py-4">
                    <span class="inline-flex items-center gap-1 bg-blue-50 text-ptc-blue text-[11px] font-bold px-2.5 py-1 rounded-lg">
                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Offline
                    </span>
                    </td>
                    <td class="px-4 py-4 text-[13px] text-slate-600 font-body">15 Apr 2026</td>
                    <td class="px-4 py-4 text-right">
                    <div class="font-extrabold text-[14px] text-slate-900">Rp 1.700.000</div>
                    <div class="text-[11px] text-slate-400 font-body line-through">Rp 2.000.000</div>
                    </td>
                    <td class="px-4 py-4 text-center">
                    <!-- <button class="btn-tagihan" onclick="openModal('tagihan','Microsoft Office For School','Rp 1.700.000')"> -->
                    <a href="/detail-pemesanan" class="btn-tagihan">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Detail Tagihan
                    </a>
                    </td>
                </tr>

                <!-- Row 2 – Lunas -->
                <tr class="trow border-b border-slate-50" data-status="lunas">
                    <td class="px-6 py-4 text-[13px] text-slate-400 font-medium">2</td>
                    <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-ptc-gradient flex items-center justify-center text-lg flex-shrink-0">🎨</div>
                        <div>
                        <div class="font-bold text-[13.5px] text-slate-900">Adobe Photoshop</div>
                        <div class="text-[11px] text-slate-400 font-body mt-0.5">20 Pertemuan · Sertifikat</div>
                        </div>
                    </div>
                    </td>
                    <td class="px-4 py-4">
                    <span class="inline-flex items-center gap-1 bg-purple-50 text-purple-600 text-[11px] font-bold px-2.5 py-1 rounded-lg">
                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Online
                    </span>
                    </td>
                    <td class="px-4 py-4 text-[13px] text-slate-600 font-body">02 Mar 2026</td>
                    <td class="px-4 py-4 text-right">
                    <div class="font-extrabold text-[14px] text-slate-900">Rp 1.500.000</div>
                    </td>
                    <td class="px-4 py-4 text-center">
                    <button class="btn-lunas" onclick="openModal('lunas','Adobe Photoshop','Rp 1.500.000')">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Pembayaran Selesai
                    </button>
                    </td>
                </tr>

                <!-- Row 3 – Lunas -->
                <tr class="trow" data-status="lunas">
                    <td class="px-6 py-4 text-[13px] text-slate-400 font-medium">3</td>
                    <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-ptc-gradient flex items-center justify-center text-lg flex-shrink-0">📊</div>
                        <div>
                        <div class="font-bold text-[13.5px] text-slate-900">Data Analysis (Python)</div>
                        <div class="text-[11px] text-slate-400 font-body mt-0.5">32 Pertemuan · Sertifikat</div>
                        </div>
                    </div>
                    </td>
                    <td class="px-4 py-4">
                    <span class="inline-flex items-center gap-1 bg-blue-50 text-ptc-blue text-[11px] font-bold px-2.5 py-1 rounded-lg">
                        <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Offline
                    </span>
                    </td>
                    <td class="px-4 py-4 text-[13px] text-slate-600 font-body">10 Jan 2026</td>
                    <td class="px-4 py-4 text-right">
                    <div class="font-extrabold text-[14px] text-slate-900">Rp 1.550.000</div>
                    </td>
                    <td class="px-4 py-4 text-center">
                    <button class="btn-lunas" onclick="openModal('lunas','Data Analysis (Python)','Rp 1.550.000')">
                        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Pembayaran Selesai
                    </button>
                    </td>
                </tr>

                </tbody>
            </table>

            <!-- Empty state (hidden default) -->
            <div id="empty-state" class="hidden text-center py-16 px-4">
                <div class="empty-icon">🔍</div>
                <div class="font-bold text-[15px] text-slate-700 mb-1">Tidak ada data</div>
                <div class="text-slate-400 text-[13px] font-body">Tidak ada pemesanan dengan filter ini.</div>
            </div>
            </div>

            <!-- Mobile Cards (< sm) -->
            <div class="sm:hidden divide-y divide-slate-100" id="mobile-cards">

                <!-- Card 1 -->
                <div class="p-4" data-status-m="tagihan">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-ptc-gradient flex items-center justify-center text-xl flex-shrink-0">💼</div>
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-[14px] text-slate-900 leading-snug">Microsoft Office For School</div>
                            <div class="text-[11px] text-slate-400 font-body mt-0.5">Offline · 24 Pertemuan</div>
                        </div>
                        <span class="badge badge-tagihan"><span class="dot dot-tagihan"></span>Tagihan</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="p-4" data-status-m="lunas">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-ptc-gradient flex items-center justify-center text-xl flex-shrink-0">🎨</div>
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-[14px] text-slate-900 leading-snug">Adobe Photoshop</div>
                            <div class="text-[11px] text-slate-400 font-body mt-0.5">Online · 20 Pertemuan</div>
                        </div>
                        <span class="badge badge-lunas"><span class="dot dot-lunas"></span>Lunas</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-[11px] text-slate-400 font-body">Total Tagihan</div>
                            <div class="font-extrabold text-[16px] text-slate-900">Rp 1.500.000</div>
                        </div>
                        <button class="btn-lunas" onclick="openModal('lunas','Adobe Photoshop','Rp 1.500.000')">
                            Selesai
                        </button>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="p-4" data-status-m="lunas">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-ptc-gradient flex items-center justify-center text-xl flex-shrink-0">📊</div>
                            <div class="flex-1 min-w-0">
                                <div class="font-bold text-[14px] text-slate-900 leading-snug">Data Analysis (Python)</div>
                                <div class="text-[11px] text-slate-400 font-body mt-0.5">Offline · 32 Pertemuan</div>
                            </div>
                            <span class="badge badge-lunas"><span class="dot dot-lunas"></span>Lunas</span>
                        </div>
                        <div class="flex items-center justify-between">
                        <div>
                            <div class="text-[11px] text-slate-400 font-body">Total Tagihan</div>
                            <div class="font-extrabold text-[16px] text-slate-900">Rp 1.550.000</div>
                        </div>
                        <button class="btn-lunas" onclick="openModal('lunas','Data Analysis (Python)','Rp 1.550.000')">
                            Selesai
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table footer -->
            <div class="px-5 sm:px-7 py-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="text-[12px] text-slate-400 font-body">Menampilkan <span id="showing-count" class="font-bold text-slate-600">3</span> dari 3 pemesanan</div>
                <div class="flex items-center gap-2">
                    <a href="/" class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 font-bold text-[12px] px-4 py-2.5 rounded-xl hover:bg-slate-200 transition-colors">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                    </a>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        // ── Filter Table ──
  function filterTable(status, btn) {
    // update tabs
    document.querySelectorAll(".filter-tab").forEach(t => t.classList.remove("active"));
    btn.classList.add("active");

    // desktop rows
    const rows = document.querySelectorAll("#table-body tr");
    let visible = 0;
    rows.forEach(row => {
      const s = row.getAttribute("data-status");
      const show = status === "semua" || s === status;
      row.style.display = show ? "" : "none";
      if (show) visible++;
    });
    document.getElementById("empty-state").classList.toggle("hidden", visible > 0);

    // mobile cards
    const cards = document.querySelectorAll("#mobile-cards > div");
    cards.forEach(card => {
      const s = card.getAttribute("data-status-m");
      card.style.display = (status === "semua" || s === status) ? "" : "none";
    });

    document.getElementById("showing-count").textContent = visible;
  }
    </script>
    @endpush
@endsection