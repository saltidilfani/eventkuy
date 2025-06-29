<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RegistrationController;
use App\Models\Event;
use App\Models\User;
use App\Models\Registration;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda bisa mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dan semuanya akan ditugaskan ke grup
| middleware "web".
|
*/

// ===================================================================
// RUTE PUBLIK (Bisa diakses siapa saja)
// ===================================================================

// Halaman utama, menampilkan event dan kategori
Route::get('/', [EventController::class, 'welcome'])->name('home');

// Halaman untuk melihat detail sebuah event
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.detail');

// Halaman untuk melihat semua event dalam satu kategori
Route::get('/categories/{id}', [EventController::class, 'showByCategory'])->name('categories.show');

// Halaman untuk melihat semua event
Route::get('/events', [EventController::class, 'allEvents'])->name('events.all');


// ===================================================================
// RUTE AUTENTIKASI (Login & Register)
// ===================================================================

// Rute ini hanya bisa diakses oleh pengguna yang BELUM LOGIN (tamu)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute ini hanya bisa diakses oleh pengguna yang SUDAH LOGIN
Route::middleware('auth')->group(function () {
    // Tombol Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Alur pendaftaran event (form, konfirmasi, simpan)
    Route::get('/events/{id}/register', [EventController::class, 'showRegistrationForm'])->name('events.register');
    Route::post('/events/{id}/register', [EventController::class, 'register'])->name('events.register.store');
    Route::get('/events/{id}/register/confirm', [EventController::class, 'showConfirmation'])->name('events.register.confirm');
    Route::post('/events/{id}/register/confirm', [EventController::class, 'confirmRegistration'])->name('events.register.confirm.store');
});


// ===================================================================
// RUTE ADMIN (Terlindungi)
// ===================================================================

// Semua rute di sini akan otomatis memiliki URL '/admin/...' dan nama 'admin....'
// serta dilindungi oleh middleware 'auth' dan 'admin'.
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Halaman Dashboard Admin
    Route::get('/dashboard', function () {
        $totalEvents = Event::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalRegistrations = Registration::count();
        $recentEvents = Event::with(['category', 'location'])->latest()->take(5)->get();
        
        // Data for Chart
        $categoriesForChart = Category::has('events')->withCount('events')->orderBy('events_count', 'desc')->get();
        $categoryLabels = $categoriesForChart->pluck('name');
        $categoryData = $categoriesForChart->pluck('events_count');

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalUsers',
            'totalRegistrations',
            'recentEvents',
            'categoryLabels',
            'categoryData'
        ));
    })->name('dashboard');

    // Manajemen CRUD (Create, Read, Update, Delete) untuk:
    // - Events
    // - Categories
    // - Locations
    Route::resource('events', EventController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('locations', LocationController::class)->except(['show']);
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    // Route::get('/categories/add_kategori', [CategoryController::class, 'create'])->name('admin.categories.add_kategori');
});