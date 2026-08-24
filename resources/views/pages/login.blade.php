<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MoKursus - Masuk / Daftar</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
</head>
<body class="min-h-screen flex">
  <!-- SPINNER -->
  <div id="page-spinner">
      <!-- <img src="logo-sekunder.png" alt="" style="height:40px;margin-bottom:4px;" onerror="this.style.display='none'"/> -->
      <div class="sring"></div>
      <div class="sdots"><span></span><span></span><span></span></div>
      <p style="font-size:13px;color:#94a3b8;font-weight:600;">Memuat halaman...</p>
  </div>

<!-- ════════════════════════════════════
     LEFT PANEL — branding (desktop only)
════════════════════════════════════ -->
<div class="hidden lg:flex lg:w-[44%] xl:w-[42%] relative bg-hero-mesh overflow-hidden flex-col items-center justify-center p-10 xl:p-14">
  <div class="dots-bg absolute inset-0 opacity-25 pointer-events-none"></div>

  <!-- Decorative circles -->
  <div class="deco w-80 h-80 border border-white/10 -right-24 -top-24"></div>
  <div class="deco w-52 h-52 border border-white/10 left-6 bottom-6"></div>
  <div class="deco w-28 h-28 bg-ptc-light/12 right-24 top-28 animate-floatY"></div>
  <div class="deco w-16 h-16 bg-white/8 left-20 top-20"></div>

  <div class="relative z-10 text-center max-w-[340px] xl:max-w-[360px]">
    <!-- Logo -->
    <!-- <img src="logo-primer.png" alt="MoKursus" class="h-11 mx-auto mb-9" /> -->

    <h2 class="text-[30px] xl:text-[34px] font-black text-white leading-[1.2] mb-4">
      Kuasai Skill Digital<br/>Bersama Trainer<br/>Terbaik Makassar
    </h2>
    <p class="text-white/65 text-[13.5px] leading-relaxed font-body mb-9">
      Bergabung dengan ribuan alumni yang telah meningkatkan karir mereka melalui pelatihan bersertifikat kami.
    </p>

    <!-- Floating feature card -->
    <div class="bg-white/10 backdrop-blur-md border border-white/18 rounded-2xl p-5 text-left mb-5 animate-floatY" style="animation-delay:0.5s;">
      <div class="text-ptc-light text-[10px] font-black uppercase tracking-widest mb-3">Keunggulan MoKursus</div>
      <div class="space-y-2.5">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-xl bg-white/15 flex items-center justify-center text-[15px] flex-shrink-0">🎓</div>
          <span class="text-white text-[13px] font-medium">Sertifikat resmi diakui industri</span>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-xl bg-white/15 flex items-center justify-center text-[15px] flex-shrink-0">💬</div>
          <span class="text-white text-[13px] font-medium">Konsultasi gratis 1 tahun</span>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-xl bg-white/15 flex items-center justify-center text-[15px] flex-shrink-0">📚</div>
          <span class="text-white text-[13px] font-medium">E-Book & modul gratis</span>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-xl bg-white/15 flex items-center justify-center text-[15px] flex-shrink-0">⭐</div>
          <span class="text-white text-[13px] font-medium">Rating 4.9 di Google</span>
        </div>
      </div>
    </div>

    <!-- Mini testimonial -->
    <div class="bg-white/8 border border-white/12 rounded-xl p-4 text-left">
      <div style="color:#f59e0b;font-size:12px;margin-bottom:6px;">★★★★★</div>
      <p class="text-white/75 text-[12px] font-body leading-relaxed mb-3">"Setelah kursus di sini, saya langsung dapat kerja dalam 2 bulan. Trainer-nya profesional banget!"</p>
      <div class="flex items-center gap-2">
        <div class="w-7 h-7 rounded-full bg-ptc-gradient flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">AR</div>
        <div class="text-white/60 text-[11px] font-medium">Ahmad Rizky · Alumni 2024</div>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     RIGHT PANEL — forms
════════════════════════════════════ -->
<div class="flex-1 flex flex-col min-h-screen">

  <!-- Mobile topbar -->
  <div class="lg:hidden flex items-center justify-between px-4 py-3.5 bg-white border-b border-slate-100 shadow-sm">
    <img src="images/logo-sekunder.png" alt="MoKursus" class="h-8" />
    <a href="/" class="text-[12px] text-ptc-blue font-semibold flex items-center gap-1 hover:underline">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      Kembali
    </a>
  </div>

  <!-- Center content -->
  <div class="flex-1 flex items-start lg:items-center justify-center p-4 sm:p-6 md:p-8 pt-6 lg:pt-8">
    <div class="w-full max-w-[420px]">

      <!-- Desktop back link -->
      <a href="/" class="hidden lg:flex items-center gap-1.5 text-[12px] text-slate-500 hover:text-ptc-blue mb-5 transition-colors font-medium w-fit">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Beranda
      </a>

      <div class="auth-card p-6 sm:p-7 md:p-8">

        <!-- Mobile logo -->
        <div class="flex justify-center mb-5 lg:hidden">
          <img src="images/logo-sekunder.png" alt="MoKursus" class="h-9" />
        </div>

        <!-- ══ MAIN SECTION (tabs) ══ -->
        <div id="main-section">

          <!-- Tabs -->
          <div class="flex gap-6 border-b border-slate-100 mb-6" id="tab-row">
            <button class="tab-btn active" id="tab-login" onclick="switchTab('login')">Masuk</button>
            <button class="tab-btn" id="tab-register" onclick="switchTab('register')">Buat Akun</button>
          </div>

          <!-- ─── LOGIN ─── -->
          <div class="panel active" id="panel-login">
            <div class="mb-5">
              <h1 class="text-[21px] font-black text-slate-900">Selamat Datang! 👋</h1>
              <p class="text-slate-500 text-[13px] mt-0.5 font-body">Masuk ke akun MoKursus kamu</p>
            </div>

            <!-- Google -->
            <!--<button class="btn-google mb-4" onclick="handleSSO('Google')">-->
            <!--  <svg width="17" height="17" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>-->
            <!--  Lanjutkan dengan Google-->
            <!--</button>-->

            <!--<div class="divider mb-4"><span>atau masuk dengan email</span></div>-->

            <form id="login-form" novalidate>
              <div class="space-y-4">

                <!-- Email -->
                <div>
                  <label class="block text-[12.5px] font-semibold text-slate-700 mb-1.5">Email</label>
                  <div class="input-wrap">
                    <input type="email" id="login-email" class="input-field" placeholder="nama@email.com" autocomplete="email" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                  </div>
                  <div class="err-msg" id="login-email-err">Masukkan email yang valid.</div>
                </div>

                <!-- Password -->
                <div>
                  <div class="flex items-center justify-between mb-1.5">
                    <label class="text-[12.5px] font-semibold text-slate-700">Password</label>
                    <button type="button" class="lnk text-[12px]" onclick="switchView('forgot')">Lupa password?</button>
                  </div>
                  <div class="input-wrap">
                    <input type="password" id="login-pw" class="input-field" placeholder="••••••••" autocomplete="current-password" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <button type="button" class="pw-toggle" onclick="togglePw('login-pw',this)" title="Tampilkan/sembunyikan password">
                      <svg class="eye-icon" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                  </div>
                  <div class="err-msg" id="login-pw-err">Password minimal 8 karakter.</div>
                </div>

                <!-- Submit -->
                <button type="button" class="btn-primary" onclick="handleLogin()" id="login-btn">
                  <span id="login-txt">Masuk Sekarang</span>
                  <span id="login-load" class="hidden items-center justify-center gap-2">
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    Memproses...
                  </span>
                </button>
              </div>
            </form>

            <p class="text-center text-[12.5px] text-slate-500 mt-5 font-body">
              Belum punya akun? <button class="lnk" onclick="switchTab('register')">Buat akun gratis</button>
            </p>
          </div>

          <!-- ─── REGISTER ─── -->
          <div class="panel" id="panel-register">
            <div class="mb-5">
              <h1 class="text-[21px] font-black text-slate-900">Buat Akun Baru ✨</h1>
              <p class="text-slate-500 text-[13px] mt-0.5 font-body">Gratis! Mulai belajar hari ini</p>
            </div>

            <form id="reg-form" novalidate>
              <div class="space-y-3.5">

                <!-- Nama Lengkap -->
                <div>
                  <div class="input-wrap">
                    <input type="text" name="nama_lengkap" id="reg-name" class="input-field" placeholder="Nama Lengkap" autocomplete="name" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                  </div>
                  <div class="err-msg" id="reg-name-err">Nama tidak boleh kosong.</div>
                </div>

                <!-- Tempat & Tanggal Lahir -->
                <div class="grid grid-cols-2 gap-2.5">
                  <div>
                    <div class="input-wrap">
                      <input type="text" name="tempat_lahir" id="reg-pob" class="input-field" placeholder="Tempat Lahir" />
                      <svg class="input-icon" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="err-msg" id="reg-pob-err">Wajib diisi.</div>
                  </div>
                  <div>
                    <div class="input-wrap">
                      <input type="date" name="tanggal_lahir" id="reg-dob" class="input-field no-icon" style="padding-left:14px;color:#94a3b8;" onchange="this.style.color='#0f172a'" />
                    </div>
                    <div class="err-msg" id="reg-dob-err">Wajib diisi.</div>
                  </div>
                </div>

                <!-- Alamat -->
                <div>
                  <div class="input-wrap">
                    <input type="text"  name="alamat" id="reg-address" class="input-field" placeholder="Alamat Lengkap" autocomplete="street-address" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                  </div>
                  <div class="err-msg" id="reg-addr-err">Alamat tidak boleh kosong.</div>
                </div>

                <!-- No. WhatsApp -->
                <div>
                  <div class="input-wrap">
                    <input type="tel" name="nomor_whatsapp" id="reg-phone" class="input-field" placeholder="No. WhatsApp / HP Min 10 karakter*" autocomplete="tel" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                  </div>
                  <div class="err-msg" id="reg-phone-err">Nomor HP minimal 10 karakter.</div>
                </div>

                <!-- Email -->
                <div>
                  <div class="input-wrap">
                    <input type="email" name="email" id="reg-email" class="input-field" placeholder="Email aktif..." autocomplete="email" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                  </div>
                  <div class="err-msg" id="reg-email-err">Masukkan email yang valid.</div>
                </div>

                <!-- Password -->
                <div>
                  <div class="input-wrap">
                    <!-- <input type="password" id="reg-pw" class="input-field" placeholder="Password" autocomplete="new-password" oninput="checkStrength(this.value)" /> -->
                    <input type="password" name="password" id="reg-pw" class="input-field" placeholder="Password" autocomplete="new-password" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <button type="button" class="pw-toggle" onclick="togglePw('reg-pw',this)" title="Tampilkan/sembunyikan password">
                      <svg class="eye-icon" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                  </div>
                  <!-- Strength bars -->
                  <!-- <div class="flex gap-1.5 mt-1.5">
                    <div class="s-bar" id="sb1"></div>
                    <div class="s-bar" id="sb2"></div>
                    <div class="s-bar" id="sb3"></div>
                    <div class="s-bar" id="sb4"></div>
                  </div> -->
                  <!-- <div id="strength-label"></div> -->
                  <div class="err-msg show" id="reg-pw-err" style="color:#ef4444;">Password minimal 8 karakter</div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                  <div class="input-wrap">
                    <input type="password" name="password2" id="reg-pw2" class="input-field" placeholder="Konfirmasi Password" autocomplete="new-password" />
                    <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <button type="button" class="pw-toggle" onclick="togglePw('reg-pw2',this)" title="Tampilkan/sembunyikan password">
                      <svg class="eye-icon" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                  </div>
                  <div class="err-msg" id="reg-pw2-err">Password tidak cocok.</div>
                </div>

                <!-- Syarat & Ketentuan -->
                <div>
                  <label class="flex items-start gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" class="custom-check mt-0.5" id="agree" />
                    <span class="text-[12px] text-slate-600 leading-relaxed font-body">
                      Dengan mendaftar anda menyetujui syarat, <a href="#" class="lnk text-[12px]">ketentuan</a> &amp; <a href="#" class="lnk text-[12px]">kebijakan privasi</a> kami !
                    </span>
                  </label>
                  <div class="err-msg" id="reg-agree-err">Kamu harus menyetujui syarat & ketentuan.</div>
                </div>

                <!-- reCAPTCHA (simulasi) -->
                <div class="border border-slate-200 rounded-xl p-3 bg-slate-50 flex items-center justify-between" id="captcha-box">
                  <label class="flex items-center gap-3 cursor-pointer select-none">
                    <input type="checkbox" class="custom-check" id="reg-captcha" onchange="verifyCaptcha(this)" />
                    <span class="text-[13px] text-slate-700 font-medium">I'm not a robot</span>
                  </label>
                  <div class="text-right flex-shrink-0">
                    <svg width="36" height="36" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M32 8C18.745 8 8 18.745 8 32s10.745 24 24 24 24-10.745 24-24S45.255 8 32 8z" fill="#4A90D9" opacity=".15"/>
                      <path d="M46 28c0-7.732-6.268-14-14-14S18 20.268 18 28" stroke="#4A90D9" stroke-width="3" stroke-linecap="round" fill="none"/>
                      <path d="M44 26l2 2 2-2" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                      <path d="M18 36c0 7.732 6.268 14 14 14s14-6.268 14-14" stroke="#34A853" stroke-width="3" stroke-linecap="round" fill="none"/>
                      <path d="M20 38l-2-2-2 2" stroke="#34A853" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                    <div class="text-[8px] text-slate-400 font-bold tracking-wide leading-tight">reCAPTCHA<br/>Privacy - Terms</div>
                  </div>
                </div>
                <div class="err-msg" id="reg-captcha-err">Harap centang reCAPTCHA terlebih dahulu.</div>

                <!-- Tombol Buat Akun -->
                <button type="button" class="btn-primary" onclick="handleRegister()" id="reg-btn">
                  <span id="reg-txt">Buat Akun</span>
                  <span id="reg-load" class="hidden items-center justify-center gap-2">
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    Membuat akun...
                  </span>
                </button>

                <!-- Divider -->
                <div class="divider"><span>Sudah punya akun ?</span></div>

                <!-- Tombol Login -->
                <button type="button" class="w-full py-3 border-2 border-ptc-blue rounded-xl text-ptc-blue font-bold text-[14px] bg-white hover:bg-blue-50 transition-colors" onclick="switchTab('login')">
                  Login !
                </button>

              </div>
            </form>
          </div>

        </div><!-- /main-section -->

        <!-- ══ FORGOT PASSWORD ══ -->
        <div class="side-panel" id="sp-forgot">
          <button class="flex items-center gap-1.5 text-[12px] text-slate-500 hover:text-ptc-blue mb-5 transition-colors font-medium" onclick="switchView('main')">
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Login
          </button>
          <div class="text-center mb-6">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-[26px]">🔐</div>
            <h2 class="text-[21px] font-black text-slate-900 mb-1.5">Lupa Password?</h2>
            <p class="text-slate-500 text-[13px] font-body leading-relaxed">Masukkan email terdaftar dan kami akan mengirimkan link reset password.</p>
          </div>
          <div class="space-y-4">
            <div>
              <label class="block text-[12.5px] font-semibold text-slate-700 mb-1.5">Email Terdaftar</label>
              <div class="input-wrap">
                <input type="email" id="forgot-email" class="input-field" placeholder="nama@email.com" autocomplete="email" />
                <svg class="input-icon" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              </div>
              <div class="err-msg" id="forgot-err">Masukkan email yang valid.</div>
            </div>
            <button type="button" class="btn-primary" onclick="handleForgot()" id="forgot-btn">
              <span id="forgot-txt">Kirim Link Reset</span>
              <span id="forgot-load" class="hidden items-center justify-center gap-2">
                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                Mengirim...
              </span>
            </button>
          </div>
        </div>

        <!-- ══ FORGOT SUCCESS ══ -->
        <div class="side-panel" id="sp-forgot-ok">
          <div class="text-center py-6">
            <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-5">
              <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5">
                <path class="check-draw" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <h2 class="text-[21px] font-black text-slate-900 mb-2">Email Terkirim!</h2>
            <p class="text-slate-500 text-[13px] font-body leading-relaxed mb-1">Link reset password telah dikirim ke</p>
            <p class="font-extrabold text-ptc-blue text-[15px] mb-4" id="ok-email"></p>
            <p class="text-slate-400 text-[12px] font-body mb-6">Periksa folder <strong>Spam</strong> jika email tidak muncul dalam beberapa menit.</p>
            <button class="btn-primary" onclick="switchView('main')">Kembali ke Login</button>
          </div>
        </div>

        <!-- ══ REGISTER SUCCESS ══ -->
        <div class="side-panel" id="sp-reg-ok">
          <div class="text-center py-6">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-5 text-[30px]">🎉</div>
            <h2 class="text-[21px] font-black text-slate-900 mb-2">Akun Berhasil Dibuat!</h2>
            <p class="text-slate-500 text-[13px] font-body leading-relaxed mb-6">Selamat bergabung di MoKursus! Cek email untuk verifikasi, lalu mulai belajar.</p>
            <button class="btn-primary mb-3" onclick="switchView('main'); switchTab('login')">Masuk ke Akun</button>
            <a href="/" class="block text-center text-[13px] text-slate-500 hover:text-ptc-blue font-medium transition-colors mt-1">Lihat Kelas Tersedia →</a>
          </div>
        </div>

      </div><!-- /auth-card -->

      <p class="text-center text-[11px] text-slate-400 mt-5 font-body">
        © 2026 MoKursus ·
        <a href="#" class="hover:text-ptc-blue transition-colors">Syarat & Ketentuan</a> ·
        <a href="#" class="hover:text-ptc-blue transition-colors">Privasi</a>
      </p>
    </div>
  </div>
</div>

<!-- ════════ JAVASCRIPT ════════ -->
<script>

  // SPINNER
  window.addEventListener("load",()=>{
    setTimeout(()=>{const s=document.getElementById("page-spinner");s.classList.add("hide");setTimeout(()=>{if(s.parentNode)s.parentNode.removeChild(s);},500);},900);
  });
// ── Panels ──
const sidePanels = ["sp-forgot","sp-forgot-ok","sp-reg-ok"];

function showSidePanel(id) {
  document.getElementById("main-section").style.display = "none";
  sidePanels.forEach(p => {
    const el = document.getElementById(p);
    el.classList.remove("active");
  });
  if (id) {
    const el = document.getElementById(id);
    el.classList.add("active");
  } else {
    document.getElementById("main-section").style.display = "block";
  }
}

function switchView(view) {
  if (view === "main") {
    showSidePanel(null);
  } else if (view === "forgot") {
    showSidePanel("sp-forgot");
  } else if (view === "forgot-ok") {
    showSidePanel("sp-forgot-ok");
  } else if (view === "reg-ok") {
    showSidePanel("sp-reg-ok");
  }
}

// init
document.getElementById("main-section").style.display = "block";

// ── Tabs ──
function switchTab(tab) {
  ["login","register"].forEach(t => {
    document.getElementById("tab-"+t).classList.toggle("active", t === tab);
    document.getElementById("panel-"+t).classList.toggle("active", t === tab);
  });
}

// ── Password Toggle ──
const eyeOpen = `<svg class="eye-icon" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>`;
const eyeOff  = `<svg class="eye-icon" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>`;

function togglePw(inputId, btn) {
  const inp = document.getElementById(inputId);
  const showing = inp.type === "text";
  inp.type = showing ? "password" : "text";
  btn.innerHTML = showing ? eyeOpen : eyeOff;
  btn.style.color = showing ? "#94a3b8" : "#0060d2";
}

// ── Password Strength ──
function checkStrength(val) {
  const bars  = ["sb1","sb2","sb3","sb4"];
  const lbl   = document.getElementById("strength-label");
  const colors = ["#ef4444","#f97316","#eab308","#22c55e"];
  const labels = ["Sangat Lemah","Cukup","Kuat","Sangat Kuat"];

  let sc = 0;
  if (val.length >= 8) sc++;
  if (/[A-Z]/.test(val)) sc++;
  if (/[0-9]/.test(val)) sc++;
  if (/[^A-Za-z0-9]/.test(val)) sc++;

  bars.forEach((id,i) => {
    document.getElementById(id).style.background = (i < sc) ? colors[sc-1] : "#e2e8f0";
  });
  if (!val) { lbl.textContent=""; return; }
  lbl.textContent = labels[sc-1] || "Sangat Lemah";
  lbl.style.color  = colors[Math.max(sc-1,0)];
}

// ── Helpers ──
const isEmail = v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);

function fieldErr(inputId, errId, show) {
  const inp = document.getElementById(inputId);
  const err = document.getElementById(errId);
  if (show) { inp.classList.add("error"); err.classList.add("show"); }
  else       { inp.classList.remove("error"); err.classList.remove("show"); }
  return show;
}

function shake(elId) {
  const el = document.getElementById(elId);
  el.classList.remove("do-shake");
  void el.offsetWidth;
  el.style.animation = "none";
  void el.offsetWidth;
  el.style.animation = "shake 0.4s ease";
  setTimeout(()=>{ el.style.animation=""; }, 500);
}

function setLoad(prefix, on) {
  const btn  = document.getElementById(prefix+"-btn");
  const txt  = document.getElementById(prefix+"-txt");
  const load = document.getElementById(prefix+"-load");
  btn.disabled = on;
  txt.classList.toggle("hidden", on);
  load.classList.toggle("hidden", !on);
  if (on) load.classList.add("flex"); else load.classList.remove("flex");
}

// ── Login ──
function handleLogin() {
  const email = document.getElementById("login-email").value.trim();
  const pw    = document.getElementById("login-pw").value;

  let err = false;
  if (!isEmail(email)) err = fieldErr("login-email","login-email-err",true)||true;
  else fieldErr("login-email","login-email-err",false);
  if (pw.length < 8) err = fieldErr("login-pw","login-pw-err",true)||true;
  else fieldErr("login-pw","login-pw-err",false);

  if (err) { shake("login-form"); return; }

  setLoad("login", true);
//   setTimeout(() => {
//     setLoad("login", false);
//     alert("Login berhasil! (Demo — hubungkan ke backend)");
//   }, 1800);
	  // AJAX Login Request
	fetch('/login_process', {
		method : 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
		},
		body: JSON.stringify({
			email   : email,
			password: pw
		})
	})
	.then(response => response.json())
	.then(data => {
		setLoad("login", false);
			if (data.success) {
				window.location.href = '/blank';
				alert('Login berhasil');
			} else {
				alert(data.message || "Login gagal! Periksa email dan password Anda.");
			}
	})
	.catch(error => {
		setLoad("login", false);
		console.error('Error:', error);
		alert("Terjadi kesalahan. Silakan coba lagi.");
	});
}

// ── reCAPTCHA simulasi ──
function verifyCaptcha(cb) {
  const box = document.getElementById("captcha-box");
  if (cb.checked) {
    box.style.borderColor = "#22c55e";
    box.style.background  = "#f0fdf4";
  } else {
    box.style.borderColor = "";
    box.style.background  = "";
  }
}

// ── Register ──
function handleRegister() {
  const name    = document.getElementById("reg-name").value.trim();
  const pob     = document.getElementById("reg-pob").value.trim();
  const dob     = document.getElementById("reg-dob").value;
  const address = document.getElementById("reg-address").value.trim();
  const phone   = document.getElementById("reg-phone").value.trim();
  const email   = document.getElementById("reg-email").value.trim();
  const pw      = document.getElementById("reg-pw").value;
  const pw2     = document.getElementById("reg-pw2").value;
  const agreed  = document.getElementById("agree").checked;
  const captcha = document.getElementById("reg-captcha").checked;

  let err = false;

  if (!name)           err = fieldErr("reg-name","reg-name-err",true)||true;    else fieldErr("reg-name","reg-name-err",false);
  if (!pob)            err = fieldErr("reg-pob","reg-pob-err",true)||true;      else fieldErr("reg-pob","reg-pob-err",false);
  if (!dob)            err = fieldErr("reg-dob","reg-dob-err",true)||true;      else fieldErr("reg-dob","reg-dob-err",false);
  if (!address)        err = fieldErr("reg-address","reg-addr-err",true)||true; else fieldErr("reg-address","reg-addr-err",false);
  if (phone.length<10) err = fieldErr("reg-phone","reg-phone-err",true)||true;  else fieldErr("reg-phone","reg-phone-err",false);
  if (!isEmail(email)) err = fieldErr("reg-email","reg-email-err",true)||true;  else fieldErr("reg-email","reg-email-err",false);

  // password: hide the "always-visible" hint and show real error if needed
  const pwErr = document.getElementById("reg-pw-err");
  if (pw.length < 8) {
    pwErr.classList.add("show"); pwErr.style.display = "block";
    document.getElementById("reg-pw").classList.add("error");
    err = true;
  } else {
    pwErr.style.display = "none";
    document.getElementById("reg-pw").classList.remove("error");
  }

  if (pw !== pw2)      err = fieldErr("reg-pw2","reg-pw2-err",true)||true;  else fieldErr("reg-pw2","reg-pw2-err",false);

  const agreeErr = document.getElementById("reg-agree-err");
  if (!agreed) { agreeErr.classList.add("show"); err=true; }
  else agreeErr.classList.remove("show");

  const captchaErr = document.getElementById("reg-captcha-err");
  if (!captcha) { captchaErr.classList.add("show"); err=true; }
  else captchaErr.classList.remove("show");

  if (err) { shake("reg-form"); return; }

	// setLoad("reg", true);
	// setTimeout(() => {
	// 	setLoad("reg", false);
	// 	switchView("reg-ok");
	// }, 2000);

	// AJAX Register Request
  	fetch('/register', {
		method : 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
		},
		body: JSON.stringify({
			nama_lengkap         : name,
			tempat_lahir         : pob,
			tanggal_lahir        : dob,
			alamat               : address,
			nomor_whatsapp       : phone,
			email                : email,
			password             : pw,
			password_confirmation: pw2
		})
  	})
	.then(response => response.json())
	.then(data => {
		setLoad("reg", false);
		if (data.success) {
		// Reset form
		document.getElementById("reg-form").reset();
		document.getElementById("reg-captcha").checked = false;
		verifyCaptcha(document.getElementById("reg-captcha"));
		
		// Show success panel
		switchView("reg-ok");
		} else {
		// Show error message from server
		let errorMsg = data.message || "Registrasi gagal!";
		if (data.errors) {
			errorMsg = Object.values(data.errors).flat().join('\n');
		}
		alert(errorMsg);
		}
	})
	.catch(error => {
		setLoad("reg", false);
		console.error('Error:', error);
		alert("Terjadi kesalahan. Silakan coba lagi.");
	});
}

// ── Forgot ──
function handleForgot() {
  const email = document.getElementById("forgot-email").value.trim();
  if (!isEmail(email)) {
    fieldErr("forgot-email","forgot-err",true);
    shake("sp-forgot");
    return;
  }
  fieldErr("forgot-email","forgot-err",false);
  setLoad("forgot", true);
  setTimeout(() => {
    setLoad("forgot", false);
    document.getElementById("ok-email").textContent = email;
    switchView("forgot-ok");
  }, 1800);
}

// ── SSO ──
function handleSSO(provider) {
  const btn = event.currentTarget;
  btn.disabled = true;
  btn.innerHTML = `<svg class="animate-spin w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="#94a3b8" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menghubungkan...`;
  setTimeout(() => {
    btn.disabled = false;
    btn.innerHTML = `<svg width="17" height="17" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg> Lanjutkan dengan ${provider}`;
    alert("Redirect ke " + provider + " OAuth... (Demo)");
  }, 1200);
}

// clear errors on typing
document.querySelectorAll(".input-field").forEach(inp => {
  inp.addEventListener("input", () => {
    inp.classList.remove("error");
    const next = inp.closest(".input-wrap")?.nextElementSibling;
    if (next?.classList.contains("err-msg")) next.classList.remove("show");
  });
});

// enter key support
document.getElementById("login-email").addEventListener("keydown", e => { if(e.key==="Enter") document.getElementById("login-pw").focus(); });
document.getElementById("login-pw").addEventListener("keydown", e => { if(e.key==="Enter") handleLogin(); });
document.getElementById("forgot-email").addEventListener("keydown", e => { if(e.key==="Enter") handleForgot(); });
document.getElementById("reg-pw2").addEventListener("keydown", e => { if(e.key==="Enter") handleRegister(); });
</script>
</body>
</html>
