<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpeditionController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ArtifactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('explorer', [ExplorerController::class, 'index'])->middleware(['auth', 'verified'])->name('index-explorer');
Route::get('explorer/create', [ExplorerController::class, 'create'])->middleware(['auth', 'verified'])->name('create-explorer');
Route::post('explorer', [ExplorerController::class, 'store'])->middleware(['auth', 'verified'])->name('store-explorer');
Route::get('explorer/{id}/edit', [ExplorerController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit-explorer');
Route::put('explorer/{id}', [ExplorerController::class, 'update'])->middleware(['auth', 'verified'])->name('update-explorer');
Route::delete('explorer/{id}', [ExplorerController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy-explorer');

Route::get('expedition', [ExpeditionController::class, 'index'])->middleware(['auth', 'verified'])->name('index-expedition');
Route::get('expedition/create', [ExpeditionController::class, 'create'])->middleware(['auth', 'verified'])->name('create-expedition');
Route::post('expedition', [ExpeditionController::class, 'store'])->middleware(['auth', 'verified'])->name('store-expedition');
Route::get('expedition/{id}/edit', [ExpeditionController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit-expedition');
Route::put('expedition/{id}', [ExpeditionController::class, 'update'])->middleware(['auth', 'verified'])->name('update-expedition');
Route::delete('expedition/{id}', [ExpeditionController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy-expedition');

Route::get('guide', [GuideController::class, 'index'])->middleware(['auth', 'verified'])->name('index-guide');
Route::get('guide/create', [GuideController::class, 'create'])->middleware(['auth', 'verified'])->name('create-guide');
Route::post('guide', [GuideController::class, 'store'])->middleware(['auth', 'verified'])->name('store-guide');
Route::get('guide/{id}/edit', [GuideController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit-guide');
Route::put('guide/{id}', [GuideController::class, 'update'])->middleware(['auth', 'verified'])->name('update-guide');
Route::delete('guide/{id}', [GuideController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy-guide');

Route::get('artifact', [ArtifactController::class, 'index'])->middleware(['auth', 'verified'])->name('index-artifact');
Route::get('artifact/create', [ArtifactController::class, 'create'])->middleware(['auth', 'verified'])->name('create-artifact');
Route::post('artifact', [ArtifactController::class, 'store'])->middleware(['auth', 'verified'])->name('store-artifact');
Route::get('artifact/{id}/edit', [ArtifactController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit-artifact');
Route::put('artifact/{id}', [ArtifactController::class, 'update'])->middleware(['auth', 'verified'])->name('update-artifact');
Route::delete('artifact/{id}', [ArtifactController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy-artifac');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';