<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard', ['title' => 'Admin Dashboard']);
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:Pembina'])->group(function () {
    Route::get('/pembina/dashboard', function () {
        return view('dashboard', ['title' => 'Pembina Dashboard']);
    })->name('pembina.dashboard');
    
    Route::get('/attendance', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [\App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
});

Route::middleware(['auth', 'role:Siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        $user = auth()->user();
        $pendaftarans = \App\Models\Pendaftaran::with('ekstrakurikuler')->where('siswa_id', $user->id)->get();
        return view('siswa.dashboard', compact('user', 'pendaftarans'));
    })->name('siswa.dashboard');
    
    Route::get('/siswa/explore', [\App\Http\Controllers\ExploreController::class, 'index'])->name('siswa.explore');
    
    Route::get('/siswa/pendaftaran', [\App\Http\Controllers\PendaftaranController::class, 'create'])->name('siswa.pendaftaran');
    Route::post('/siswa/pendaftaran', [\App\Http\Controllers\PendaftaranController::class, 'store'])->name('siswa.pendaftaran.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
