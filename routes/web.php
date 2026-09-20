<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\Admin\CourseGroupController;

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

Route::get('/blank', function () {
    return view('pages.admin.blank');
})->name('blank');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/modals', function () {
    return view('pages.modals');
})->name('modals');

Route::post('/register', [AuthController::class, 'register'])->name('register-process');
Route::post('/login_process', [AuthController::class, 'login'])->name('login-process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// routes/web.php - Tambahkan prefix admin
Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('users-data', [UserController::class, 'getData'])->name('users.data');

    Route::resource('courses', CourseController::class);
    Route::get('courses-data', [CourseController::class, 'getData'])->name('courses.data');

    Route::resource('trainers', TrainerController::class);
    Route::get('trainers-data', [TrainerController::class, 'getData'])->name('trainers.data');
    Route::get('trainers-test', [TrainerController::class, 'test'])->name('trainers.test');

    Route::resource('alumni', AlumniController::class);
    Route::get('alumni-data', [AlumniController::class, 'getData'])->name('alumni.data');
    Route::get('alumni-search-member', [AlumniController::class, 'searchMember'])->name('alumni.search');

    Route::resource('works', WorkController::class);
    Route::get('work-data', [WorkController::class, 'getData'])->name('works.data');
    Route::get('work-search-member', [WorkController::class, 'searchMember'])->name('works.search');

    Route::resource('promotions', PromotionController::class);
    Route::get('promotion-data', [PromotionController::class, 'getData'])->name('promotions.data');
    Route::get('promo-search-user', [PromotionController::class, 'searchUser'])->name('promotions.search');

    Route::resource('bonuses', BonusController::class);
    Route::get('bonus-data', [BonusController::class, 'getData'])->name('bonuses.data');
    Route::get('bonus-search-user', [BonusController::class, 'searchUser'])->name('bonuses.search');
    Route::get('bonus-search-member', [BonusController::class, 'searchMember'])->name('bonuses.search_member');

    Route::resource('groups', CourseGroupController::class);
    Route::get('group-data', [CourseGroupController::class, 'getData'])->name('groups.data');
});