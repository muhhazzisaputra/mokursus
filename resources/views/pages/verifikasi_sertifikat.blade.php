@extends('layouts.app')

    @push('styles')
    <style>
        /* custom styling for certificate pattern */
        .cert-badge {
            background: linear-gradient(135deg, #0060d2 0%, #009dff 100%);
        }
        .input-pattern {
            letter-spacing: 2px;
            font-family: 'DM Sans', monospace;
            font-weight: 500;
        }
        .captcha-bg {
            background: #f1f4f9;
            border: 1px solid #e2e8f0;
        }
    </style>
    @endpush

@section('title', 'MoKursus - Lembaga Kursus & Pelatihan Bersertifikat')

@section('content')
    <main class="max-w-3xl mx-auto px-5 py-10 md:py-6">
    
    <!-- Hero section with title & illustration -->
    <div class="text-center mb-8 md:mb-10 animate-fadeSlide">
      <div class="inline-flex items-center gap-2 bg-white/60 backdrop-blur-sm rounded-full px-4 py-1.5 shadow-sm mb-4">
        <span class="text-[#0060d2] text-sm font-bold">✓ Verifikasi Digital</span>
      </div>
      <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight">
        Validasi <span class="bg-gradient-to-r from-[#0060d2] to-[#009dff] bg-clip-text text-transparent">Sertifikat</span>
      </h1>
      <p class="text-gray-500 max-w-lg mx-auto mt-3 text-base">Masukkan nomor sertifikat untuk memvalidasi keasliannya secara resmi.</p>
    </div>

    <!-- Main card: form validasi -->
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/80 overflow-hidden transition-all duration-300 animate-fadeSlide" style="animation-delay: 0.05s;">
      
      <!-- header card -->
      <div class="cert-badge px-6 py-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <div>
            <h2 class="text-white font-bold text-xl">Lembar Verifikasi Sertifikat</h2>
            <p class="text-white/70 text-xs">Pastikan data yang dimasukkan sesuai dengan dokumen asli</p>
          </div>
        </div>
      </div>

      <div class="p-6 md:p-8">
        <!-- Form -->
        <form id="validationForm" onsubmit="return false;">
          <!-- Nomor Sertifikat field -->
          <div class="mb-7">
            <label class="block text-gray-700 font-bold text-sm mb-2 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-[#0060d2]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Nomor Sertifikat
            </label>
            <div class="relative">
              <input type="text" id="certNumber" placeholder="______/____-____/____/____" 
                class="input-pattern w-full px-5 py-3.5 text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#009dff]/40 focus:border-[#009dff] outline-none transition bg-gray-50/50 text-gray-800"
                autocomplete="off">
            </div>
            <p class="text-xs text-gray-400 mt-1.5 ml-1">Contoh: 2401/PLN-001/ILT/2024 &nbsp; | &nbsp; Masukkan nomor sesuai yang tertera pada sertifikat.</p>
          </div>

          <!-- Hitung captcha: 2 + 9 = ? -->
          <div class="mb-8">
            <label class="block text-gray-700 font-bold text-sm mb-2 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-[#0060d2]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Hitung: <span class="font-mono font-bold text-gray-800">2 + 9 = ?</span>
            </label>
            <div class="flex flex-wrap items-center gap-3">
              <div class="relative flex-1 max-w-[180px]">
                <input type="number" id="captchaInput" placeholder="Masukkan hasil" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#009dff]/40 focus:border-[#009dff] outline-none bg-white text-gray-800">
              </div>
              <div class="captcha-bg px-4 py-2.5 rounded-xl text-center font-mono font-bold text-gray-700 text-sm">
                2 + 9 = 11
              </div>
            </div>
          </div>

          <!-- Tombol Validasi -->
          <button type="submit" id="validateBtn" 
            class="w-full bg-gradient-to-r from-[#0060d2] to-[#009dff] hover:shadow-lg hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 text-white font-extrabold py-3.5 rounded-xl text-base shadow-md flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Validasi Sertifikat
          </button>
        </form>

        <!-- Area hasil validasi (dinamis) -->
        <div id="resultArea" class="mt-8 transition-all duration-300"></div>
      </div>
    </div>

    <!-- informasi tambahan / footer -->
    <div class="mt-8 text-center text-xs text-gray-400 flex flex-wrap justify-center gap-6">
      <span>🔒 Verifikasi real-time & terenkripsi</span>
      <span>📜 Sertifikat terdaftar resmi oleh MoKursus</span>
      <span>🏆 Keaslian dijamin dengan blockchain</span>
    </div>
  </main>

    @push('scripts')
    <script>
        (function() {
            const form = document.getElementById('validationForm');
            const certInput = document.getElementById('certNumber');
            const captchaInput = document.getElementById('captchaInput');
            const validateBtn = document.getElementById('validateBtn');
            const resultArea = document.getElementById('resultArea');

            // Contoh database sertifikat valid (simulasi) 
            // Format bebas, tapi untuk demo kita pakai beberapa nomor valid.
            // Kamu bisa menambah data sesuai kebutuhan.
            const validCertificates = new Map([
                ['2401/PLN-001/ILT/2024', { name: 'Ahmad Fauzi', course: 'Sertifikasi PLC & Automation', date: '15 Januari 2024', status: 'valid', grade: 'A' }],
                ['2309/MK-045/PRV/2023', { name: 'Siti Nurhaliza', course: 'Microsoft Office Specialist', date: '20 September 2023', status: 'valid', grade: 'B+' }],
                ['2412/FD-892/FSD/2024', { name: 'Rizky Ramadhan', course: 'Fullstack Developer Bootcamp', date: '10 Desember 2024', status: 'valid', grade: 'A' }],
                ['2502/ADB-123/DSN/2025', { name: 'Putri Maharani', course: 'Adobe Photoshop Expert', date: '5 Februari 2025', status: 'valid', grade: 'A-' }],
                ['2408/REV-07/ARC/2024', { name: 'Budi Santoso', course: 'Revit Architecture Professional', date: '12 Agustus 2024', status: 'valid', grade: 'B' }]
            ]);

            // helper: bersihkan animasi dan tampilkan pesan error dengan style
            function showError(message) {
                resultArea.innerHTML = `
                <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-4 flex items-start gap-3 shadow-sm result-card">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    </div>
                    <div>
                    <p class="font-bold text-red-700">Validasi Gagal</p>
                    <p class="text-red-600 text-sm">${message}</p>
                    </div>
                </div>
                `;
                // smooth scroll ke hasil
                resultArea.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            function showSuccess(certData, certNumberRaw) {
                // data sertifikat dari Map
                const { name, course, date, grade } = certData;
                // format nomor tampilan lebih rapi
                const displayNumber = certNumberRaw;
                resultArea.innerHTML = `
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl overflow-hidden shadow-md result-card animate-fadeSlide">
                    <div class="bg-gradient-to-r from-emerald-600 to-teal-500 px-5 py-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-white font-bold text-base">✓ Sertifikat Valid & Terdaftar</span>
                    </div>
                    <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-2">
                        <div><span class="font-semibold text-gray-500">Nomor Sertifikat</span><br><span class="font-mono text-gray-800 text-sm bg-gray-100 px-2 py-1 rounded-md inline-block mt-1">${displayNumber}</span></div>
                        <div><span class="font-semibold text-gray-500">Nama Peserta</span><br><span class="font-bold text-gray-800">${name}</span></div>
                        <div><span class="font-semibold text-gray-500">Program Kursus</span><br><span class="text-gray-700">${course}</span></div>
                        </div>
                        <div class="space-y-2">
                        <div><span class="font-semibold text-gray-500">Tanggal Terbit</span><br><span class="text-gray-700">${date}</span></div>
                        <div><span class="font-semibold text-gray-500">Grade / Predikat</span><br><span class="inline-flex items-center gap-1"><span class="bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full text-xs font-bold">${grade}</span> <span class="text-gray-500 text-xs">(kompeten)</span></span></div>
                        <div><span class="font-semibold text-gray-500">Lembaga</span><br><span class="text-gray-600">MoKursus Certification Board</span></div>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-emerald-100 text-center text-xs text-emerald-700 flex justify-between items-center">
                        <span>🔐 Tanda tangan digital terverifikasi</span>
                        <span class="bg-emerald-100 px-3 py-1 rounded-full font-mono">SHA-256</span>
                    </div>
                    </div>
                </div>
                `;
                resultArea.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            // fungsi validasi utama
            function validateCertificate() {
                // reset animasi shake jika ada
                const elementsToShake = [certInput, captchaInput];
                
                let hasError = false;
                let errorMessage = '';

                // 1. cek nomor sertifikat tidak kosong
                let certNumber = certInput.value.trim();
                if (certNumber === "") {
                errorMessage = 'Nomor sertifikat tidak boleh kosong.';
                hasError = true;
                certInput.classList.add('border-red-400', 'bg-red-50');
                certInput.focus();
                } else {
                certInput.classList.remove('border-red-400', 'bg-red-50');
                }

                // 2. cek captcha: hasil 2+9 harus 11
                let captchaValue = parseInt(captchaInput.value.trim(), 10);
                if (isNaN(captchaValue) || captchaValue !== 11) {
                if (!hasError) errorMessage = 'Jawaban captcha salah. Hasil dari 2 + 9 harus 11.';
                else errorMessage = 'Nomor sertifikat tidak valid / Captcha salah.';
                hasError = true;
                captchaInput.classList.add('border-red-400', 'bg-red-50');
                // animasi shake
                const formCard = document.querySelector('.bg-white/90');
                formCard.classList.add('shake-effect');
                setTimeout(() => formCard.classList.remove('shake-effect'), 500);
                } else {
                captchaInput.classList.remove('border-red-400', 'bg-red-50');
                }

                if (hasError) {
                showError(errorMessage || 'Data yang dimasukkan tidak valid. Periksa kembali nomor sertifikat dan perhitungan.');
                return;
                }

                // 3. cek apakah nomor sertifikat terdaftar di database simulasi (case-insensitive? biar exact match namun kita normalize spasi)
                let normalizedCert = certNumber.trim();
                if (validCertificates.has(normalizedCert)) {
                const certData = validCertificates.get(normalizedCert);
                showSuccess(certData, normalizedCert);
                } else {
                // Jika tidak terdaftar => sertifikat tidak valid / palsu
                resultArea.innerHTML = `
                    <div class="bg-amber-50 border-l-4 border-amber-400 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                    <div class="flex-shrink-0 bg-amber-100 rounded-full p-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#d97706" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-amber-700">Sertifikat Tidak Ditemukan</p>
                        <p class="text-amber-700 text-sm">Nomor sertifikat <span class="font-mono font-bold">${normalizedCert}</span> tidak terdaftar dalam sistem kami. Pastikan nomor yang dimasukkan sudah benar atau hubungi admin.</p>
                    </div>
                    </div>
                `;
                resultArea.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                // efek getar pada input
                certInput.classList.add('border-amber-400', 'bg-amber-50');
                setTimeout(() => {
                    certInput.classList.remove('border-amber-400', 'bg-amber-50');
                }, 1500);
                }
            }

            // event listener form submit
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                validateCertificate();
            });

            // realtime hapus style error saat mengetik
            certInput.addEventListener('input', function() {
                this.classList.remove('border-red-400', 'bg-red-50', 'border-amber-400', 'bg-amber-50');
            });
            captchaInput.addEventListener('input', function() {
                this.classList.remove('border-red-400', 'bg-red-50');
            });

            // optional: demo hint placeholder
            certInput.placeholder = "Contoh: 2401/PLN-001/ILT/2024";
        })();
  </script>
    @endpush
@endsection