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
    Route::resource('companies.sections', \App\Http\Controllers\SectionController::class);

    Route::post('/companies/{id}/sections', [SectionController::class, 'store'])->name('sections.store');
    Route::get('/companies/{company}/sections/{section}/show', [SectionController::class, 'show'])
        ->name('sections.show');
    Route::get('/companies/{company}/sections/{section}/edit', [SectionController::class, 'edit'])
        ->name('sections.edit');
    Route::put('/companies/{company}/sections/{id}', [SectionController::class, 'update'])
        ->name('sections.update');
});

require __DIR__ . '/auth.php';
