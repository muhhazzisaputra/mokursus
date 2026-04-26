@extends('layouts.app')

@push('styles')
<style>
    /* ── HERO (light) ── */
    .page-hero{
        background:linear-gradient(135deg,#e6f0ff 0%,#d9e9ff 100%);
        padding:40px 20px 44px;text-align:center;position:relative;overflow:hidden;
        border-bottom:1px solid rgba(0,96,210,.1);
    }
    .page-hero::before{
        content:"";position:absolute;inset:0;
        background-image:radial-gradient(circle,rgba(0,96,210,.08) 1px,transparent 1px);
        background-size:22px 22px;pointer-events:none;
    }

    /* ── MAIN GRID ── */
    #main-grid {
      display: grid; grid-template-columns:1fr 320px; gap: 20px; align-items: start;
    }

    /* ── SECTION CARD (light) ── */
    .sec-card{
        background:#ffffff;
        border:1px solid #e2e8f0;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 8px 20px rgba(0,0,0,.02);
        transition:box-shadow .2s;
    }
    .sec-header{
        background:#f8fafc;
        padding:14px 20px;
        font-size:17px;
        font-weight:800;
        color:#0f172a;
        border-bottom:1px solid #eef2ff;
    }

    /* Notice */
    .notice{background:#fff8f8;border:1px solid #fecaca;border-radius:14px;padding:16px 20px;}

    /* Right summary sticky */
    .summary-wrap{position:sticky;top:76px;}

    /* ── KELAS CARDS (light) ── */
    #kelas-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:12px;
    }
    .kelas-card{
        background:#ffffff;
        border:1.5px solid #e2e8f0;
        border-radius:16px;
        overflow:hidden;
        cursor:pointer;
        transition:transform .2s,border-color .2s,box-shadow .2s;
    }
    .kelas-card:hover{
        transform:translateY(-3px);
        border-color:#009dff;
        box-shadow:0 8px 20px rgba(0,96,210,.12);
    }
    .kelas-card.selected{
        border-color:#0060d2;
        box-shadow:0 0 0 3px rgba(0,96,210,.2);
        background:#f0f9ff;
    }
    .kelas-img-ph{
        width:100%;height:88px;
        display:flex;align-items:center;justify-content:center;
        font-size:28px;
        background:#eef2ff;
        color:#0060d2;
    }

    /* ── TYPE SELECT (light) ── */
    .type-select{
        appearance:none;
        width:100%;padding:10px 36px 10px 14px;
        border:1.5px solid #cbd5e1;
        border-radius:12px;
        font-size:13px;font-family:inherit;
        background:#fff;color:#1e293b;
        cursor:pointer;outline:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' viewBox='0 0 24 24' stroke='%23334155' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat:no-repeat;background-position:right 12px center;
    }

    .type-select:focus{border-color:#0060d2;box-shadow:0 0 0 3px rgba(0,96,210,.15);}

    /* ── FORM INPUTS (light) ── */
    .form-input{
        width:100%;padding:11px 14px;
        border:1.5px solid #cbd5e1;
        border-radius:12px;
        font-size:13.5px;font-family:inherit;
        background:#fff;color:#1e293b;
        transition:border-color .2s,box-shadow .2s;
        outline:none;
    }
    .form-input:focus{border-color:#0060d2;box-shadow:0 0 0 3px rgba(0,96,210,.12);}
    .form-input::placeholder{color:#94a3b8;}
    .form-input[readonly]{background:#f1f5f9;color:#475569;}
    .form-input.err{border-color:#ef4444 !important;box-shadow:0 0 0 3px rgba(239,68,68,.1) !important;}
    input[type="date"].form-input::-webkit-calendar-picker-indicator{opacity:.6;cursor:pointer;}

    .row-2col{display:grid;grid-template-columns:1fr 1fr;gap:14px;}

    /* ── SUMMARY FIELDS (light) ── */
    .sum-field{
      background:#f8fafc;
      border:1px solid #e2e8f0;
      border-radius:12px;
      padding:10px 14px;
      font-size:13.5px;
      color:#1e293b;
      width:100%;
    }

    /* ── VOUCHER ── */
    .voucher-wrap{display:flex;gap:8px;}
    .voucher-inp{
      flex:1;padding:10px 14px;
      border:1.5px solid #cbd5e1;
      border-radius:12px;
      font-size:13px;font-family:inherit;
      background:#fff;color:#1e293b;
      outline:none;
    }
    .voucher-inp:focus{border-color:#0060d2;box-shadow:0 0 0 3px rgba(0,96,210,.12);}
    .voucher-inp::placeholder{color:#94a3b8;}
    .voucher-btn{
      padding:10px 16px;
      background:#eef2ff;
      border:1.5px solid #cbd5e1;
      border-radius:12px;
      color:#0060d2;
      font-size:12px;font-weight:700;
      cursor:pointer;font-family:inherit;
      transition:background .2s;
    }
    .voucher-btn:hover{background:#d9e9ff;}

    /* ── LANJUTKAN BUTTON (warm light) ── */
    .btn-lanjut{
      width:100%;padding:14px;border:none;border-radius:16px;
      background:linear-gradient(135deg,#f59e0b,#d97706);
      color:#fff;
      font-size:16px;font-weight:800;cursor:pointer;
      box-shadow:0 4px 12px rgba(245,158,11,.3);
      transition:opacity .2s,transform .15s;
    }
    .btn-lanjut:hover:not(:disabled){opacity:.9;transform:translateY(-1px);}
    .btn-lanjut:disabled{opacity:.5;cursor:not-allowed;}

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
      #main-grid{grid-template-columns:1fr;}
      .summary-wrap{position:static;}
      #right-col{order:-1;}
    }
    @media (max-width: 640px) {
      #kelas-grid{grid-template-columns:repeat(2,1fr);}
      .row-2col{grid-template-columns:1fr;gap:12px;}
      .page-hero{padding:28px 16px 32px;}
      .btn-lanjut{font-size:15px;padding:13px;}
      .sec-header{font-size:15px;padding:12px 16px;}
      #main-content{padding:16px 12px 48px !important;}
    }
    @media (max-width: 380px) {
      #kelas-grid{grid-template-columns:1fr;}
    }
</style>
@endpush


@section('title', 'MoKursus - Lembaga Kursus & Pelatihan Bersertifikat')

@section('content')
    <div class="page-hero anim-fadeup">
        <h1 style="font-size:clamp(22px,4vw,36px);font-weight:900;color:#0f172a;margin-bottom:8px;">
            Formulir Pemesanan Kursus
        </h1>
        <p style="font-size:14px;color:#334155;font-family:'DM Sans',sans-serif;max-width:600px;margin:0 auto;">
            Selalu waspada terhadap pihak yang tidak bertanggung jawab!
            <span style="color:#dc2626;font-weight:700;"> mengatasnamakan MoKursus.</span>
        </p>
    </div>

    <main style="max-width:1100px;margin:0 auto;padding:28px 16px 60px;">
        <!-- PERHATIAN -->
        <div class="notice" style="margin-bottom:24px;animation:fadeUp .4s .05s ease both;">
                <div style="color:#dc2626;font-weight:800;font-size:13px;margin-bottom:8px;">⚠️ Perhatian:</div>
                    <ol style="list-style:decimal;padding-left:20px;margin:0;color:#374151;font-size:13px;font-family:'DM Sans',sans-serif;line-height:1.8;">
                    <li>Jangan lakukan pembayaran dengan nominal yang berbeda dengan yang tertera pada tagihan anda</li>
                    <li>Jangan lakukan transfer di luar nomor rekening atas nama MoKursus / Harianto.</li>
                    <li>Pastikan data anda valid untuk data sertifikat.</li>
                </ol>
        </div>

        <!-- MAIN GRID -->
        <div id="main-grid" class="anim-fadeup-1">

            <!-- LEFT COL -->
            <div id="left-col">
            <!-- DAFTAR KELAS -->
            <div id="kelas-panel">
                <div class="sec-card">
                <div class="sec-header">📚 Daftar Kelas</div>
                <div style="padding:16px 16px 20px;">
                    <select class="type-select" id="kelas-type" onchange="filterKelas()" style="margin-bottom:14px;">
                    <option value="reguler">Reguler</option>
                    <option value="private">Private</option>
                    <option value="sekolah">For School</option>
                    </select>
                    <div id="kelas-grid">
                    <!-- 9 kelas sesuai data awal, semua atribut tetap -->
                    <div class="kelas-card" data-type="reguler,sekolah" data-nama="Microsoft Office" data-harga="1585000" data-harga-asli="2700000" onclick="pilihKelas(this)"><div class="kelas-img-ph">💼</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Microsoft Office</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 2.700.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.585.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,private" data-nama="AutoCAD" data-harga="1550000" data-harga-asli="3100000" onclick="pilihKelas(this)"><div class="kelas-img-ph">📐</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">AutoCAD</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 3.100.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.550.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,private" data-nama="Fullstack Developer" data-harga="2500000" data-harga-asli="5000000" onclick="pilihKelas(this)"><div class="kelas-img-ph">💻</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Fullstack Developer</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 5.000.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 2.500.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,online" data-nama="Digital Marketing" data-harga="1550000" data-harga-asli="2000000" onclick="pilihKelas(this)"><div class="kelas-img-ph">📣</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Digital Marketing</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 2.000.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.550.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,private" data-nama="Bahasa Inggris" data-harga="1550000" data-harga-asli="2000000" onclick="pilihKelas(this)"><div class="kelas-img-ph">🗣️</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Bahasa Inggris</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 2.000.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.550.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,private" data-nama="Revit Architecture" data-harga="1750000" data-harga-asli="3100000" onclick="pilihKelas(this)"><div class="kelas-img-ph">🏗️</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Revit Architecture</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 3.100.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.750.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,private,sekolah" data-nama="Adobe Photoshop" data-harga="1500000" data-harga-asli="2000000" onclick="pilihKelas(this)"><div class="kelas-img-ph">🎨</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Adobe Photoshop</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 2.000.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.500.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,private" data-nama="Data Analysis (Python)" data-harga="1550000" data-harga-asli="1650000" onclick="pilihKelas(this)"><div class="kelas-img-ph">📊</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Data Analysis Python</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 1.650.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.550.000</div></div></div>
                    <div class="kelas-card" data-type="reguler,online" data-nama="Video Editing" data-harga="1585000" data-harga-asli="2000000" onclick="pilihKelas(this)"><div class="kelas-img-ph">🎬</div><div style="padding:10px;"><div style="font-weight:800;font-size:13px;">Video Editing</div><div style="color:#dc2626;font-size:11px;text-decoration:line-through;">Rp 2.000.000</div><div style="color:#059669;font-weight:700;font-size:12px;">Rp 1.585.000</div></div></div>
                    </div>
                </div>
                </div>
            </div>

            <!-- DATA PEMESAN -->
            <div id="pemesan-panel" style="display:none;">
                <div class="sec-card">
                <div class="sec-header" style="display:flex;justify-content:space-between;align-items:center;">
                    <span>👤 Data Pemesan</span>
                    <button onclick="gantiKelas()" style="font-size:11px;color:#0060d2;background:none;border:none;cursor:pointer;font-weight:700;">← Ganti Kelas</button>
                </div>
                <div style="padding:18px 18px 12px;">
                    <div class="row-2col" style="margin-bottom:14px;">
                    <div><label style="font-size:11px;font-weight:700;color:#475569;">ID Pemesanan</label><input type="text" class="form-input" id="inp-id" readonly/></div>
                    <div><label style="font-size:11px;font-weight:700;color:#475569;">Nama Lengkap</label><input type="text" class="form-input" id="inp-nama" placeholder="Nama lengkap sesuai KTP"/><div class="err-msg" id="err-nama">Nama tidak boleh kosong.</div></div>
                    </div>
                    <div class="row-2col" style="margin-bottom:14px;">
                    <div><label style="font-size:11px;font-weight:700;color:#475569;">Tempat Lahir</label><input type="text" class="form-input" id="inp-pob" placeholder="Cth: Makassar"/><div class="err-msg" id="err-pob">Wajib diisi.</div></div>
                    <div><label style="font-size:11px;font-weight:700;color:#475569;">Tanggal Lahir</label><input type="date" class="form-input" id="inp-dob"/><div class="err-msg" id="err-dob">Wajib diisi.</div></div>
                    </div>
                    <div style="margin-bottom:14px;"><label style="font-size:11px;font-weight:700;color:#475569;">Nomor Handphone / WhatsApp</label><input type="tel" class="form-input" id="inp-hp" placeholder="08xxxxxxxxxx"/><div class="err-msg" id="err-hp">Minimal 10 digit.</div></div>
                    <div style="margin-bottom:14px;"><label style="font-size:11px;font-weight:700;color:#475569;">Email Aktif</label><input type="email" class="form-input" id="inp-email" placeholder="email@contoh.com"/><div class="err-msg" id="err-email">Masukkan email yang valid.</div></div>
                    <div id="offline-fields" style="margin-bottom:14px;"><label style="font-size:11px;font-weight:700;color:#475569;">Alamat Lengkap</label><input type="text" class="form-input" id="inp-alamat" placeholder="Jl. contoh No. 1, Makassar"/><div class="err-msg" id="err-alamat">Alamat tidak boleh kosong.</div></div>
                    <div id="online-fields" style="display:none;margin-bottom:14px;">
                    <div class="row-2col">
                        <div><label style="font-size:11px;font-weight:700;color:#475569;">Platform</label><select class="type-select" id="inp-platform"><option value="zoom">Zoom</option><option value="gmeet">Google Meet</option></select></div>
                        <div><label style="font-size:11px;font-weight:700;color:#475569;">Preferensi Jadwal</label><select class="type-select" id="inp-jadwal"><option>Pagi (08.00–10.00)</option><option>Siang (12.00–14.00)</option><option>Sore (15.00–17.00)</option><option>Malam (19.00–21.00)</option></select></div>
                    </div>
                    </div>
                </div>
                </div>
                <button class="btn-lanjut" id="btn-lanjut" onclick="submitForm()" style="margin-top:14px;">
                <span id="lanjut-txt">Lanjutkan ke Pembayaran</span>
                <span id="lanjut-load" style="display:none;align-items:center;justify-content:center;gap:8px;">
                    <svg style="animation:spin .8s linear infinite;width:18px;" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity:.25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" style="opacity:.75"/></svg>
                    Memproses...
                </span>
                </button>
            </div>
            </div>

            <!-- RIGHT SUMMARY -->
            <div id="right-col">
            <div class="summary-wrap">
                <div class="sec-card">
                <div class="sec-header">📋 Detail Pesanan</div>
                <div style="padding:18px;" id="right-content">
                    <div id="right-empty" style="text-align:center;padding:28px 0;"><div style="font-size:36px;">👆</div><div style="font-size:14px;font-weight:700;color:#0060d2;">Pilih Kelas Terlebih Dahulu</div><div style="font-size:12px;color:#64748b;">Klik salah satu kelas di sebelah kiri</div></div>
                    <div id="right-detail" style="display:none;">
                    <div style="margin-bottom:14px;"><div style="font-size:10px;font-weight:800;color:#64748b;">Program</div><div class="sum-field" id="sum-program">–</div></div>
                    <div style="margin-bottom:14px;"><div style="font-size:10px;font-weight:800;color:#64748b;">Tipe</div><div class="sum-field" id="sum-tipe">–</div></div>
                    <div style="margin-bottom:14px;"><div style="font-size:10px;font-weight:800;color:#64748b;">Harga (Rp)</div><div class="sum-field" id="sum-harga-asli">–</div></div>
                    <div style="margin-bottom:14px;"><div style="font-size:10px;font-weight:800;color:#64748b;">Diskon (Rp)</div><div class="sum-field" style="color:#059669;" id="sum-diskon">–</div></div>
                    <div style="margin-bottom:14px;"><div style="font-size:10px;font-weight:800;color:#64748b;">Pajak (Rp)</div><div class="sum-field" id="sum-pajak">0</div></div>
                    <div style="margin-bottom:16px;"><div class="voucher-wrap"><input type="text" class="voucher-inp" id="voucher-input" placeholder="Punya kode voucher ?"/>
                        <!-- <button class="voucher-btn" onclick="applyVoucher()">Pakai</button> -->
                    </div><div style="font-size:11px;color:#059669;display:none;" id="voucher-ok">✓ Voucher diterapkan!</div><div style="font-size:11px;color:#dc2626;display:none;" id="voucher-err">Kode voucher tidak valid.</div></div>
                    <div style="background:#eef2ff;border-radius:16px;padding:14px 16px;"><div style="font-size:10px;font-weight:800;color:#334155;">TOTAL (Rp)</div><div style="font-size:24px;font-weight:900;color:#0f172a;" id="sum-total">–</div></div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            let currentMode = "offline",
            selectedKelas = null,
            voucherDisc = 0;
            
            function setMode(mode) {
                currentMode = mode;
                document.getElementById("online-fields").style.display=mode==="online"?"block":"none";
                document.getElementById("offline-fields").style.display=mode==="offline"?"block":"none";
                if(document.getElementById("sum-tipe"))
                    document.getElementById("sum-tipe").textContent=mode==="online"?"Kelas Online":"Kelas Offline";
            }

            function filterKelas() {
                const t = document.getElementById("kelas-type").value;
                document.querySelectorAll(".kelas-card").forEach(c => {
                    c.style.display = c.getAttribute("data-type").split(",").includes(t) ? "" : (t === "reguler" ? "" : "none")
                });
            }

            function pilihKelas(el) {
                document.querySelectorAll(".kelas-card").forEach(c => c.classList.remove("selected"));
                el.classList.add("selected");
                selectedKelas = {
                    nama: el.getAttribute("data-nama"),
                    harga: parseInt(el.getAttribute("data-harga")),
                    hargaAsli: parseInt(el.getAttribute("data-harga-asli"))
                };
                updateSummary();
                document.getElementById("kelas-panel").style.display = "none";
                document.getElementById("pemesan-panel").style.display = "block";
                document.getElementById("inp-id").value = generateID();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            }

            function gantiKelas() {
                selectedKelas = null;
                voucherDisc = 0;
                document.getElementById("pemesan-panel").style.display = "none";
                document.getElementById("kelas-panel").style.display = "block";
                document.getElementById("right-empty").style.display = "block";
                document.getElementById("right-detail").style.display = "none";
                document.querySelectorAll(".kelas-card").forEach(c => c.classList.remove("selected"));
                document.getElementById("voucher-ok").style.display = "none";
                document.getElementById("voucher-err").style.display = "none";
            }

            function updateSummary() {
                if (!selectedKelas) return;
                let diskon = selectedKelas.hargaAsli - selectedKelas.harga;
                let total = Math.max(selectedKelas.harga - voucherDisc, 0);
                document.getElementById("sum-program").textContent = selectedKelas.nama;
                document.getElementById("sum-tipe").textContent = currentMode === "online" ? "Kelas Online" : "Kelas Offline";
                document.getElementById("sum-harga-asli").textContent = "Rp " + selectedKelas.hargaAsli.toLocaleString("id-ID");
                document.getElementById("sum-diskon").textContent = "– Rp " + diskon.toLocaleString("id-ID");
                document.getElementById("sum-total").textContent = "Rp " + total.toLocaleString("id-ID");
                document.getElementById("right-empty").style.display = "none";
                document.getElementById("right-detail").style.display = "block";
            }

            function generateID() {
                let d = new Date();
                let p = n => String(n).padStart(2, "0");
                return p(d.getDate()) + p(d.getMonth() + 1) + d.getFullYear().toString().slice(2) + p(d.getHours()) + p(d.getMinutes()) + p(d.getSeconds());
            }
        </script>
    @endpush
@endsection