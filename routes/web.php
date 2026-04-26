<?php

use Illuminate\Support\Facades\Route;

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/pendaftaran-online', function () {
    return view('pages.pendaftaran_online');
})->name('pendaftaran-online');

Route::get('/pendaftaran-offline', function () {
    return view('pages.pendaftaran_offline');
})->name('pendaftaran-offline');

Route::get('/cek-pemesanan', function () {
    return view('pages.cek_pemesanan');
})->name('cek-pemesanan');

Route::get('/detail-pemesanan', function () {
    return view('pages.detail_pemesanan');
})->name('detail-pemesanan');

Route::get('/karya-alumni', function () {
    return view('pages.karya_alumni');
})->name('karya-alumni');

Route::get('/verifikasi-sertifikat', function () {
    return view('pages.verifikasi_sertifikat');
})->name('verifikasi-sertifikat');