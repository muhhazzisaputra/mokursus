@extends('layouts.app')

    @push('styles')
    <style>
        /* Card */
        .card{background:#fff;border-radius:20px;box-shadow:0 2px 4px rgba(0,0,0,0.03),0 8px 32px rgba(0,96,210,0.07),0 0 0 1px rgba(0,96,210,0.05);}
        /* Invoice row */
        .inv-row{display:flex;align-items:flex-start;padding:14px 0;border-bottom:1px solid #f1f5f9;gap:12px;}
        .inv-row:last-child{border-bottom:none;}
        .inv-label{font-weight:700;font-size:13.5px;color:#334155;min-width:130px;flex-shrink:0;}
        .inv-sep{font-weight:700;font-size:13.5px;color:#94a3b8;flex-shrink:0;padding-top:1px;}
        .inv-val{font-size:13.5px;color:#0f172a;font-weight:500;flex:1;}

        /* Kode spesial input */
        .kode-wrap{display:flex;gap:8px;align-items:center;}
        .kode-input{
        flex:1;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:9px;
        font-size:13px;font-family:inherit;background:#f8faff;color:#0f172a;
        transition:border-color .2s,box-shadow .2s;outline:none;
        }
        .kode-input:focus{border-color:#009dff;box-shadow:0 0 0 3px rgba(0,157,255,0.1);}
        .kode-input::placeholder{color:#94a3b8;}
        .kode-btn{
        padding:8px 14px;background:linear-gradient(135deg,#0060d2,#009dff);
        color:#fff;border:none;border-radius:9px;font-size:12px;font-weight:700;
        cursor:pointer;font-family:inherit;transition:opacity .2s;white-space:nowrap;
        }
        .kode-btn:hover{opacity:0.9;}

        /* Total badge */
        .total-badge{
        display:inline-flex;align-items:center;padding:8px 18px;
        background:linear-gradient(135deg,#16a34a,#22c55e);
        color:#fff;border-radius:10px;font-weight:800;font-size:15px;
        box-shadow:0 3px 12px rgba(34,197,94,0.3);
        }

        /* Copy btn */
        .copy-btn{
        padding:6px 14px;border:1.5px solid #e2e8f0;border-radius:8px;
        font-size:12px;font-weight:700;color:#475569;background:#fff;
        cursor:pointer;font-family:inherit;transition:all .15s;
        }
        .copy-btn:hover{border-color:#009dff;color:#0060d2;background:#f0f9ff;}
        .copy-btn.copied{border-color:#22c55e;color:#16a34a;background:#f0fdf4;}

        /* Upload area */
        .upload-area{
        border:2px dashed #cbd5e1;border-radius:14px;padding:28px 20px;
        text-align:center;cursor:pointer;transition:border-color .2s,background .2s;
        background:#f8faff;position:relative;
        }
        .upload-area:hover,.upload-area.dragover{border-color:#009dff;background:#f0f9ff;}
        .upload-area input[type="file"]{
        position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;
        }

        /* Upload btn red */
        .btn-upload{
        width:100%;padding:13px;border:none;border-radius:12px;
        background:linear-gradient(135deg,#dc2626,#ef4444);
        color:#fff;font-size:14px;font-weight:800;cursor:pointer;
        font-family:inherit;transition:opacity .2s,transform .15s;
        box-shadow:0 4px 16px rgba(220,38,38,0.28);
        display:flex;align-items:center;justify-content:center;gap:8px;
        }
        .btn-upload:hover{opacity:0.92;transform:translateY(-1px);}
        .btn-upload:disabled{opacity:0.6;cursor:not-allowed;transform:none;}

        /* Cetak btn */
        .btn-cetak{
        display:inline-flex;align-items:center;gap:8px;padding:11px 22px;
        background:#1e293b;color:#fff;border:none;border-radius:10px;
        font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;
        transition:background .2s;box-shadow:0 2px 8px rgba(0,0,0,0.18);
        }
        .btn-cetak:hover{background:#0f172a;}

        /* Kembali btn */
        .btn-kembali{
        display:inline-flex;align-items:center;gap:7px;padding:10px 20px;
        border:1.5px solid #e2e8f0;color:#475569;background:#fff;border-radius:10px;
        font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;
        transition:all .15s;text-decoration:none;
        }
        .btn-kembali:hover{border-color:#009dff;color:#0060d2;background:#f0f9ff;}

        /* Status badge */
        .badge-tagihan{display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:99px;background:#fff7ed;color:#c2410c;font-size:11px;font-weight:700;}
        .dot-tagihan{width:6px;height:6px;border-radius:50%;background:#f97316;animation:pulse2 2s ease-in-out infinite;display:inline-block;}

        /* Preview image */
        .preview-wrap{position:relative;border-radius:12px;overflow:hidden;border:1.5px solid #e2e8f0;}
        .preview-wrap img{width:100%;height:160px;object-fit:cover;display:block;}
        .preview-remove{position:absolute;top:8px;right:8px;width:28px;height:28px;background:rgba(15,23,42,0.6);border:none;border-radius:99px;color:#fff;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;transition:background .15s;}
        .preview-remove:hover{background:rgba(239,68,68,0.9);}

        /* Print styles */
        @media print {
        .no-print{display:none!important;}
        body{background:#fff!important;}
        .card{box-shadow:none!important;border:1px solid #e2e8f0!important;border-radius:0!important;}
        .print-area{page-break-inside:avoid;}
        }

        /* Timeline step */
        .step{display:flex;align-items:flex-start;gap:12px;}
        .step-dot{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;flex-shrink:0;margin-top:1px;}
        .step-line{width:2px;background:#e2e8f0;flex-shrink:0;margin-left:13px;height:24px;}
    </style>
    @endpush

@section('title', 'MoKursus - Lembaga Kursus & Pelatihan Bersertifikat')

@section('content')
    <!-- ══════════ MAIN ══════════ -->
<main class="max-w-[1280px] mx-auto px-4 md:px-8 py-8 lg:py-12">

  <!-- Breadcrumb -->
  <!-- <nav class="flex items-center gap-2 text-[12px] text-slate-400 mb-6 font-medium no-print animate-fadeUp" aria-label="Breadcrumb">
    <a href="home.php" class="hover:text-ptc-blue transition-colors">Beranda</a>
    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <a href="pemesanan.php" class="hover:text-ptc-blue transition-colors">Status Pemesanan</a>
    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <span class="text-ptc-blue font-semibold">Detail Tagihan</span>
  </nav> -->

  <!-- Page title -->
  <div class="flex items-center justify-between gap-4 mb-7 animate-fadeUp no-print">
    <div>
      <h1 class="text-[24px] sm:text-[28px] font-black text-slate-900">Detail Tagihan</h1>
      <p class="text-slate-500 text-[13px] mt-1 font-body">Selesaikan pembayaran sebelum batas waktu yang ditentukan.</p>
    </div>
    <span class="badge-tagihan flex-shrink-0">
      <span class="dot-tagihan"></span>Menunggu Pembayaran
    </span>
  </div>

  <!-- Deadline banner -->
  <!-- <div class="flex items-center gap-3 bg-red-50 border border-red-200 rounded-2xl px-5 py-4 mb-7 no-print animate-fadeUp">
    <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-xl flex-shrink-0">⏰</div>
    <div class="flex-1 min-w-0">
      <div class="font-bold text-[13px] text-red-700">Batas Waktu Pembayaran</div>
      <div class="text-[12px] text-red-500 font-body mt-0.5">Selesaikan pembayaran sebelum <strong>20 April 2026, pukul 23:59 WIB</strong></div>
    </div>
    <div id="countdown" class="text-right flex-shrink-0">
      <div class="text-[10px] text-red-400 font-bold uppercase tracking-wide">Sisa Waktu</div>
      <div class="font-black text-[16px] text-red-600" id="timer">– – : – –</div>
    </div>
  </div> -->

  <!-- ── 2-COLUMN LAYOUT ── -->
  <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] xl:grid-cols-[1fr_360px] gap-6 items-start">

    <!-- ═══ LEFT: Invoice Detail ═══ -->
    <div class="animate-fadeUp print-area">
      <div class="card overflow-hidden">

        <!-- Card Header -->
        <div class="flex items-center justify-between px-6 sm:px-8 py-5 border-b border-slate-100">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-xl flex-shrink-0">🧾</div>
            <div>
              <div class="font-black text-[16px] text-slate-900">Detail Invoice Pembayaran Anda</div>
              <div class="text-[11px] text-slate-400 font-body mt-0.5">Invoice resmi MoKursus</div>
            </div>
          </div>
          <!-- Print logo (only visible when printing) -->
          <img src="logo-primer.png" alt="MoKursus" class="hidden h-8 print:block" />
        </div>

        <!-- Invoice rows -->
        <div class="px-6 sm:px-8 py-2">

          <div class="inv-row">
            <div class="inv-label">Invoice</div>
            <div class="inv-sep">:</div>
            <div class="inv-val font-mono font-black text-ptc-blue text-[14px]">#inv180420261439</div>
          </div>

          <div class="inv-row">
            <div class="inv-label">Ditagih ke</div>
            <div class="inv-sep">:</div>
            <div class="inv-val">
              <div class="font-bold text-[14px]">Muhammad Fadhil</div>
              <div class="text-[11px] text-slate-400 font-body mt-0.5">fadhil@email.com</div>
            </div>
          </div>

          <div class="inv-row">
            <div class="inv-label">Program</div>
            <div class="inv-sep">:</div>
            <div class="inv-val">
              <div class="font-bold text-[14px]">Microsoft Office For School</div>
              <div class="flex items-center gap-2 mt-1 flex-wrap">
                <span class="inline-flex items-center gap-1 bg-blue-50 text-ptc-blue text-[10px] font-bold px-2 py-0.5 rounded-lg">
                  <svg width="9" height="9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                  Offline
                </span>
                <span class="text-[11px] text-slate-400 font-body">24 Pertemuan · Sertifikat</span>
              </div>
            </div>
          </div>

          <div class="inv-row">
            <div class="inv-label">Tanggal Daftar</div>
            <div class="inv-sep">:</div>
            <div class="inv-val font-semibold">15 April 2026</div>
          </div>

          <div class="inv-row">
            <div class="inv-label">Biaya</div>
            <div class="inv-sep">:</div>
            <div class="inv-val font-bold text-[15px]">Rp. 2.000.000</div>
          </div>

          <div class="inv-row">
            <div class="inv-label">Diskon</div>
            <div class="inv-sep">:</div>
            <div class="inv-val font-bold text-green-600">
              – Rp. 300.000
              <span class="ml-2 text-[10px] bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded-lg">Promo</span>
            </div>
          </div>

          <div class="inv-row">
            <div class="inv-label">Pajak</div>
            <div class="inv-sep">:</div>
            <div class="inv-val font-semibold text-slate-500">Rp. 0</div>
          </div>

          <!-- Kode Spesial -->
          <div class="inv-row">
            <div class="inv-label">Kode Spesial</div>
            <div class="inv-sep">:</div>
            <!-- <div class="inv-val">
              <div class="kode-wrap">
                <input type="text" class="kode-input" id="kode-input" placeholder="Masukkan kode..." maxlength="20" />
                <button class="kode-btn" onclick="applyKode()">Terapkan</button>
              </div>
              <div class="text-[11px] text-slate-400 font-body mt-1.5">Punya kode diskon khusus? Masukkan di sini.</div>
              <div class="hidden text-[11px] text-green-600 font-bold mt-1 no-print" id="kode-success">
                ✓ Kode berhasil diterapkan! Diskon tambahan Rp 100.000
              </div>
              <div class="hidden text-[11px] text-red-500 font-bold mt-1 no-print" id="kode-error">
                ✕ Kode tidak valid atau sudah kadaluarsa.
              </div>
            </div> -->
          </div>

          <!-- TOTAL -->
          <div class="inv-row !border-none pt-4 pb-2">
            <div class="inv-label font-black text-[15px] text-slate-900">TOTAL</div>
            <div class="inv-sep font-black text-[15px] text-slate-900">:</div>
            <div class="inv-val">
              <div class="total-badge" id="total-display">Rp. 1.700.000</div>
              <div class="text-[11px] text-slate-400 font-body mt-2">Termasuk semua biaya & diskon yang berlaku.</div>
            </div>
          </div>

        </div>

        <!-- Card Footer -->
        <div class="px-6 sm:px-8 py-5 border-t border-slate-100 flex items-center justify-between flex-wrap gap-3 no-print">
          <a href="pemesanan.php" class="btn-kembali">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali
          </a>
          <button class="btn-cetak" onclick="window.print()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Invoice
          </button>
        </div>

      </div>
    </div>

    <!-- ═══ RIGHT: Info Pembayaran ═══ -->
    <div class="space-y-5 animate-fadeUp no-print" style="animation-delay:.1s;">

      <!-- Rekening Card -->
      <div class="card p-6">
        <div class="flex items-center gap-3 mb-5">
          <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center text-lg flex-shrink-0">💳</div>
          <div class="font-black text-[15px] text-slate-900">Informasi Pembayaran</div>
        </div>

        <!-- Bank info -->
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-4">
          <div class="flex items-center justify-between mb-3">
            <div>
              <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Transfer ke</div>
              <div class="font-black text-[18px] text-slate-900">BCA</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-ptc-blue flex items-center justify-center">
              <span class="text-white font-black text-[11px] tracking-tight">BCA</span>
            </div>
          </div>

          <!-- Nomor rekening -->
          <div class="bg-white border border-slate-200 rounded-xl p-3.5 mb-3">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nomor Rekening</div>
            <div class="flex items-center justify-between gap-3">
              <div class="font-mono font-black text-[20px] text-slate-900 tracking-widest" id="rek-number">3909996555</div>
              <button class="copy-btn" id="copy-btn" onclick="copyRek()">Salin</button>
            </div>
          </div>

          <!-- Atas nama -->
          <div class="text-center">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Atas Nama</div>
            <div class="font-bold text-[12px] text-slate-700 uppercase tracking-wide">PT. PELITA TRAINING CENTRE INDONESIA</div>
          </div>
        </div>

        <!-- Nominal yg harus ditransfer -->
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-3.5 mb-4">
          <div class="text-[10px] font-black text-ptc-blue uppercase tracking-widest mb-1.5">Transfer Tepat</div>
          <div class="flex items-center justify-between">
            <div class="font-black text-[22px] text-ptc-blue" id="nominal-transfer">Rp. 1.700.000</div>
            <button class="copy-btn" id="copy-nominal-btn" onclick="copyNominal()">Salin</button>
          </div>
          <div class="text-[11px] text-ptc-blue/70 font-body mt-1">Transfer dengan jumlah yang tepat untuk mempermudah verifikasi.</div>
        </div>

        <!-- Upload area -->
        <div class="mb-4">
          <div class="text-[12px] font-bold text-slate-700 mb-2.5 flex items-center gap-2">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            Upload Bukti Pembayaran
          </div>

          <!-- Preview (hidden by default) -->
          <div class="preview-wrap mb-3 hidden" id="preview-wrap">
            <img src="" alt="Preview" id="preview-img" />
            <button class="preview-remove" onclick="removeFile()" title="Hapus">✕</button>
          </div>

          <!-- Drop zone -->
          <div class="upload-area" id="upload-area">
            <input type="file" id="file-input" accept="image/*,.pdf" onchange="handleFile(this)" />
            <div id="upload-placeholder">
              <div class="text-3xl mb-2">📎</div>
              <div class="font-bold text-[13px] text-slate-700 mb-1">Klik atau seret file ke sini</div>
              <div class="text-[11px] text-slate-400 font-body">JPG, PNG, PDF · Maks. 5 MB</div>
            </div>
          </div>
          <div class="hidden text-[11px] text-red-500 font-bold mt-1.5" id="file-err">File terlalu besar atau format tidak didukung.</div>
          <div class="hidden text-[11px] text-green-600 font-bold mt-1.5" id="file-ok">
            ✓ File siap diupload
          </div>
        </div>

        <!-- Upload btn -->
        <button class="btn-upload" id="upload-btn" onclick="handleUpload()">
          <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <span id="upload-btn-txt">Upload Bukti Pembayaran</span>
          <span id="upload-btn-load" class="hidden items-center gap-2">
            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
            Mengupload...
          </span>
        </button>

      </div>

      <!-- Langkah Pembayaran -->
      <!-- <div class="card p-6">
        <div class="font-black text-[14px] text-slate-900 mb-4 flex items-center gap-2">
          <span class="text-lg">📋</span> Langkah Pembayaran
        </div>
        <div class="space-y-3">
          <div class="step">
            <div class="step-dot bg-ptc-blue text-white">1</div>
            <div>
              <div class="font-bold text-[13px] text-slate-800">Transfer ke rekening BCA</div>
              <div class="text-[11.5px] text-slate-500 font-body mt-0.5">Salin nomor rekening dan transfer sesuai nominal tagihan.</div>
            </div>
          </div>
          <div class="step-line ml-[13px]"></div>
          <div class="step">
            <div class="step-dot bg-ptc-mid text-white">2</div>
            <div>
              <div class="font-bold text-[13px] text-slate-800">Ambil screenshot / foto bukti</div>
              <div class="text-[11.5px] text-slate-500 font-body mt-0.5">Simpan bukti transfer dari mobile banking atau ATM.</div>
            </div>
          </div>
          <div class="step-line ml-[13px]"></div>
          <div class="step">
            <div class="step-dot bg-ptc-light text-ptc-dark">3</div>
            <div>
              <div class="font-bold text-[13px] text-slate-800">Upload bukti di halaman ini</div>
              <div class="text-[11.5px] text-slate-500 font-body mt-0.5">Upload foto/screenshot, lalu klik tombol Upload.</div>
            </div>
          </div>
          <div class="step-line ml-[13px]"></div>
          <div class="step">
            <div class="step-dot bg-green-500 text-white">4</div>
            <div>
              <div class="font-bold text-[13px] text-slate-800">Tunggu konfirmasi admin</div>
              <div class="text-[11.5px] text-slate-500 font-body mt-0.5">Admin akan memverifikasi dalam 1×24 jam kerja.</div>
            </div>
          </div>
        </div>
      </div> -->

      <!-- Bantuan -->
      <!-- <div class="card p-5">
        <div class="text-[12px] font-bold text-slate-700 mb-3 flex items-center gap-2">
          <span>🙋</span> Butuh Bantuan?
        </div>
        <div class="space-y-2">
          <a href="https://wa.me/6285394252941" target="_blank" class="flex items-center gap-3 p-3 bg-green-50 border border-green-100 rounded-xl hover:bg-green-100 transition-colors group">
            <div class="w-8 h-8 rounded-lg bg-green-500 flex items-center justify-center flex-shrink-0">
              <svg width="15" height="15" fill="white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </div>
            <div>
              <div class="font-bold text-[12px] text-green-800">WhatsApp Admin</div>
              <div class="text-[11px] text-green-600 font-body">+62 853 9425 2941</div>
            </div>
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2.5" class="ml-auto group-hover:translate-x-0.5 transition-transform"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div> -->

    </div><!-- /right col -->
  </div><!-- /grid -->

</main>
    @push('scripts')
    <style>

    </style>
    @endpush
@endsection