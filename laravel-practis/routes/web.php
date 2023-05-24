<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/companies', function () {
    return view('company');
})->middleware(['auth', 'verified'])->name('company');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('companies', \App\Http\Controllers\CompanyController::class);
    Route::resource('companies/{company}/sections', \App\Http\Controllers\SectionController::class);
    Route::resource('companies/{company}/sections.users', \App\Http\Controllers\SectionUserController::class)->only(['create','store']);
});

require __DIR__ . '/auth.php';
