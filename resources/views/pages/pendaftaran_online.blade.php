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

    /* Card */
    .form-card{background:#fff;border-radius:16px;box-shadow:0 2px 4px rgba(0,0,0,.04),0 8px 28px rgba(0,96,210,.08),0 0 0 1px rgba(0,96,210,.05);}
    .card-header{background:#3d4a60;border-radius:14px 14px 0 0;padding:16px 22px;font-size:20px;font-weight:800;color:#fff;letter-spacing:.2px;}

    /* Inputs */
    .form-label{display:block;font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;}
    .form-input{
      width:100%;padding:11px 14px;border:1.5px solid #e2e8f0;border-radius:10px;
      font-size:13.5px;font-family:inherit;background:#f8faff;color:#0f172a;
      transition:border-color .2s,box-shadow .2s,background .2s;outline:none;
    }
    .form-input:focus{border-color:#009dff;box-shadow:0 0 0 3px rgba(0,157,255,.12);background:#fff;}
    .form-input::placeholder{color:#94a3b8;}
    .form-input[readonly]{background:#f1f5f9;color:#475569;cursor:default;}
    .form-input.err{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.1);}
    input[type="date"].form-input{color:#0f172a;}
    input[type="date"].form-input::-webkit-calendar-picker-indicator{opacity:.5;cursor:pointer;}

    /* Summary fields (right col) */
    .sum-label{font-size:12px;font-weight:700;color:#64748b;margin-bottom:5px;display:block;}
    .sum-field{
      width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;
      font-size:13.5px;background:#f8faff;color:#475569;font-family:inherit;
      outline:none;
    }
    .sum-field.total{
      background:#f0f9ff;border-color:#bae6fd;color:#0f172a;font-weight:800;font-size:16px;
    }

    /* Voucher */
    .voucher-wrap{display:flex;gap:8px;}
    .voucher-inp{
      flex:1;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;
      font-size:13.5px;font-family:inherit;background:#f8faff;color:#0f172a;
      outline:none;transition:border-color .2s;
    }
    .voucher-inp:focus{border-color:#009dff;box-shadow:0 0 0 3px rgba(0,157,255,.12);}
    .voucher-inp::placeholder{color:#94a3b8;}
    .voucher-btn{
      padding:10px 16px;background:linear-gradient(135deg,#0060d2,#009dff);
      border:none;border-radius:10px;color:#fff;font-size:12px;font-weight:700;
      cursor:pointer;font-family:inherit;transition:opacity .2s;white-space:nowrap;
    }
    .voucher-btn:hover{opacity:.88;}

    /* Lanjutkan btn */
    .btn-lanjut{
      width:100%;padding:15px;border:none;border-radius:12px;
      background:linear-gradient(135deg,#d97706,#f59e0b,#fbbf24);
      color:#1c1917;font-size:17px;font-weight:800;cursor:pointer;font-family:inherit;
      letter-spacing:.3px;transition:opacity .2s,transform .15s;
      box-shadow:0 4px 20px rgba(245,158,11,.35);
    }
    .btn-lanjut:hover:not(:disabled){opacity:.92;transform:translateY(-1px);}
    .btn-lanjut:disabled{opacity:.55;cursor:not-allowed;transform:none;}

    /* Notice */
    .notice{background:#fff8f8;border:1px solid #fecaca;border-radius:14px;padding:16px 20px;}

    /* Mode toggle */
    .mode-tab{
      flex:1;padding:10px 0;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;
      border:1.5px solid #e2e8f0;background:#fff;color:#64748b;
      transition:all .2s;font-family:inherit;text-align:center;
    }
    .mode-tab.active{background:linear-gradient(135deg,#0060d2,#009dff);color:#fff;border-color:transparent;box-shadow:0 4px 14px rgba(0,96,210,.25);}

    /* Right card */
    .right-card{background:#fff;border-radius:16px;box-shadow:0 2px 4px rgba(0,0,0,.04),0 8px 28px rgba(0,96,210,.08),0 0 0 1px rgba(0,96,210,.05);overflow:hidden;position:sticky;top:80px;}
    .right-header{background:#3d4a60;padding:16px 22px;font-size:18px;font-weight:800;color:#fff;}

    /* Modal */
    .modal-overlay{position:fixed;inset:0;background:rgba(15,23,42,.55);backdrop-filter:blur(5px);z-index:100;display:flex;align-items:center;justify-content:center;padding:16px;animation:fadeIn .2s ease;}
    .modal-box{background:#fff;border-radius:20px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.15);animation:scaleIn .3s ease;}

    /* ── RESPONSIVE ── */
    #main-grid { display: grid; grid-template-columns: 320px 1fr; gap: 20px; align-items: start; }
    .row-2col  { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
    .row-2col-sm { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }

    @media (max-width: 960px) {
        #main-grid { grid-template-columns: 1fr !important; }
        .right-card { position: static !important; top: auto !important; }
    }
    @media (max-width: 640px) {
        .row-2col  { grid-template-columns: 1fr !important; }
        .row-2col-sm { grid-template-columns: 1fr !important; }
        .nav-desk  { display: none !important; }
        .ham-mobile { display: flex !important; }
        .mode-tabs { gap: 8px !important; }
        .mode-tab  { font-size: 13px !important; padding: 9px 10px !important; }
        .page-hero { padding: 24px 16px 28px !important; }
        .btn-lanjut { font-size: 15px !important; padding: 13px !important; }
        .card-header { font-size: 17px !important; }
        .right-header { font-size: 16px !important; }
        main { padding: 16px 12px 48px !important; }
    }
    .ham-mobile { display: none; align-items: center; }

    /* Right card sticky only on desktop */
    @media (min-width: 961px) {
        .right-card { position: sticky; top: 80px; }
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

        <!-- 2-COLUMN GRID -->
        <div id="main-grid">

            <!-- ══ RIGHT: Detail Pesanan ══ -->
            <div style="animation:fadeUp .4s .1s ease both;">
                <div class="right-card" style="border-radius:16px;">
                    <div class="right-header">📋 Detail Pesanan</div>
                    <div style="padding:20px;display:flex;flex-direction:column;gap:14px;">

                    <!-- Program -->
                    <div>
                        <span class="sum-label">Program</span>
                        <input type="text" class="sum-field" id="sum-program" readonly placeholder="Pilih program..." value=""/>
                    </div>

                    <!-- Harga -->
                    <div>
                        <span class="sum-label">Harga (Rp)</span>
                        <input type="text" class="sum-field" id="sum-harga" readonly placeholder="–" value=""/>
                    </div>

                    <!-- Diskon -->
                    <div>
                        <span class="sum-label">Diskon (Rp)</span>
                        <input type="text" class="sum-field" id="sum-diskon" readonly placeholder="–" value="" style="color:#16a34a;font-weight:600;"/>
                    </div>

                    <!-- Pajak -->
                    <div>
                        <span class="sum-label">Pajak (Rp)</span>
                        <input type="text" class="sum-field" id="sum-pajak" readonly value="0"/>
                    </div>

                    <!-- Voucher -->
                    <div>
                        <div class="voucher-wrap">
                        <input type="text" class="voucher-inp" id="voucher-inp" placeholder="Punya kode voucher ?" maxlength="20"/>
                        <!-- <button class="voucher-btn" onclick="applyVoucher()">Pakai</button> -->
                        </div>
                        <div style="font-size:11px;color:#16a34a;font-weight:600;margin-top:4px;display:none;" id="voucher-ok">✓ Voucher berhasil diterapkan!</div>
                        <div style="font-size:11px;color:#ef4444;font-weight:600;margin-top:4px;display:none;" id="voucher-err">Kode voucher tidak valid.</div>
                    </div>

                    <!-- Total -->
                    <div>
                        <span class="sum-label" style="font-weight:800;color:#0f172a;font-size:13px;text-transform:none;letter-spacing:0;">TOTAL (Rp)</span>
                        <input type="text" class="sum-field total" id="sum-total" readonly placeholder="–" value=""/>
                    </div>

                    <!-- Program selector (hidden, auto-populated from URL or default) -->
                    <div style="border-top:1px solid #e2e8f0;padding-top:12px;">
                        <span class="sum-label">Ganti Program</span>
                        <select class="sum-field" id="program-select" onchange="updateProgram()" style="cursor:pointer;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="">-- Pilih Program --</option>
                        <option value="ms-office|Microsoft Office|2700000|1585000">Microsoft Office</option>
                        <option value="autocad|AutoCAD|3100000|1550000">AutoCAD</option>
                        <option value="fullstack|Fullstack Developer|5000000|2500000">Fullstack Developer</option>
                        <option value="digmark|Digital Marketing|2000000|1550000">Digital Marketing</option>
                        <option value="english|Bahasa Inggris|2000000|1550000">Bahasa Inggris</option>
                        <option value="revit|Revit Architecture|3100000|1750000">Revit Architecture</option>
                        <option value="photoshop|Adobe Photoshop|2000000|1500000">Adobe Photoshop</option>
                        <option value="datapy|Data Analysis (Python)|1650000|1550000">Data Analysis (Python)</option>
                        <option value="rstudio|R Studio (Data Analysis)|1799000|1710000">R Studio (Data Analysis)</option>
                        <option value="video|Video Editing|2000000|1585000">Video Editing</option>
                        <option value="sketchup|SketchUp|2500000|1500000">SketchUp</option>
                        </select>
                    </div>

                    <!-- Mode badge -->
                    <div style="display:flex;align-items:center;justify-content:center;gap:6px;padding:8px;background:#f0f9ff;border-radius:8px;border:1px solid #bae6fd;">
                        <span id="mode-badge-icon">🏫</span>
                        <span style="font-size:12px;font-weight:700;color:#0369a1;" id="mode-badge-txt">Kelas Offline – Makassar</span>
                    </div>

                    </div>
                </div>
            </div><!-- /right -->

            <!-- ══ LEFT: Form ══ -->
            <div style="animation:fadeUp .4s .15s ease both;">
            <div class="form-card">

                <!-- Header -->
                <div class="card-header">👤 Data Pemesan</div>

                <div style="padding:22px;">

                <!-- Row 1: ID + Nama -->
                <div class="row-2col">
                    <div>
                    <label class="form-label">ID_Pemesanan</label>
                    <input type="text" class="form-input" id="inp-id" readonly/>
                    </div>
                    <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" id="inp-nama" placeholder="Nama lengkap sesuai KTP"/>
                    <div class="err-msg" id="err-nama">Nama tidak boleh kosong.</div>
                    </div>
                </div>

                <!-- Row 2: Tempat + Tanggal -->
                <div class="row-2col">
                    <div>
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-input" id="inp-pob" placeholder="Cth: Makassar"/>
                    <div class="err-msg" id="err-pob">Wajib diisi.</div>
                    </div>
                    <div>
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-input" id="inp-dob"/>
                    <div class="err-msg" id="err-dob">Wajib diisi.</div>
                    </div>
                </div>

                <!-- Row 3: No HP -->
                <div style="margin-bottom:16px;">
                    <label class="form-label">Nomor Handphone</label>
                    <input type="tel" class="form-input" id="inp-hp" placeholder="08xxxxxxxxxx"/>
                    <div class="err-msg" id="err-hp">Minimal 10 digit.</div>
                </div>

                <!-- Row 4: Email -->
                <div style="margin-bottom:16px;">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" id="inp-email" placeholder="email@contoh.com"/>
                    <div class="err-msg" id="err-email">Masukkan email yang valid.</div>
                </div>

                <!-- Offline-only: Alamat -->
                <div id="field-alamat" style="margin-bottom:16px;">
                    <label class="form-label">Alamat Lengkap</label>
                    <input type="text" class="form-input" id="inp-alamat" placeholder="Jl. contoh No. 1, Makassar"/>
                    <div class="err-msg" id="err-alamat">Alamat tidak boleh kosong.</div>
                </div>

                <!-- Online-only fields -->
                <div id="online-fields" style="display:none;">
                    <div class="row-2col">
                    <div>
                        <label class="form-label">Platform</label>
                        <select class="form-input" id="inp-platform" style="cursor:pointer;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option value="zoom">Zoom</option>
                        <option value="gmeet">Google Meet</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Preferensi Jadwal</label>
                        <select class="form-input" id="inp-jadwal" style="cursor:pointer;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;padding-right:36px;">
                        <option>Pagi (08.00–10.00)</option>
                        <option>Siang (12.00–14.00)</option>
                        <option>Sore (15.00–17.00)</option>
                        <option>Malam (19.00–21.00)</option>
                        </select>
                    </div>
                    </div>
                </div>

                <!-- Divider -->
                <div style="border-top:1px solid #f1f5f9;margin:8px 0 20px;"></div>

                <!-- Lanjutkan button -->
                <button class="btn-lanjut" id="btn-lanjut" onclick="submitForm()">
                    <span id="lanjut-txt">lanjutkan ke pembayaran</span>
                    <span id="lanjut-load" style="display:none;align-items:center;justify-content:center;gap:8px;">
                    <svg style="animation:spin .8s linear infinite;width:18px;height:18px;" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity:.25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" style="opacity:.75"/></svg>
                    Memproses...
                    </span>
                </button>

                </div>
            </div>
            </div><!-- /left -->

        </div><!-- /main-grid -->
    </main>

    @push('scripts')
        <script>
            // GENERATE ID
            function genID(){
                const d=new Date();
                const p=n=>String(n).padStart(2,"0");
                return p(d.getDate())+p(d.getMonth()+1)+d.getFullYear().toString().slice(2)+p(d.getHours())+p(d.getMinutes())+p(d.getSeconds());
            }
            document.getElementById("inp-id").value=genID();

            // PROGRAM UPDATE
            let voucherDisc=0;
            function updateProgram(){
                const sel=document.getElementById("program-select").value;
                if(!sel){
                ["sum-program","sum-harga","sum-diskon","sum-total"].forEach(id=>document.getElementById(id).value="");
                return;
                }
                const parts=sel.split("|");
                const nama=parts[1];
                const hargaAsli=parseInt(parts[2]);
                const hargaPromo=parseInt(parts[3]);
                const diskon=hargaAsli-hargaPromo;
                const total=Math.max(hargaPromo-voucherDisc,0);

                document.getElementById("sum-program").value=nama;
                document.getElementById("sum-harga").value=hargaAsli.toLocaleString("id-ID");
                document.getElementById("sum-diskon").value=diskon.toLocaleString("id-ID");
                document.getElementById("sum-total").value=total.toLocaleString("id-ID");
            }

            // Pre-select from URL param ?program=rstudio
            const urlP=new URLSearchParams(window.location.search).get("program");
            if(urlP) {
                const opts=document.getElementById("program-select").options;
                for(let i=0;i<opts.length;i++) {
                    if(opts[i].value.startsWith(urlP+"|")) {
                        document.getElementById("program-select").selectedIndex=i;
                        updateProgram();
                        break;
                    }
                }
            }
        </script>
    @endpush
@endsection