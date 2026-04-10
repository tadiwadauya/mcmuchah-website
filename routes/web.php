<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\ContentBlockController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/contact', [ContactPageController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::patch('content-blocks/{contentBlock}/toggle-active', [ContentBlockController::class, 'toggleActive'])
        ->name('content-blocks.toggle-active');
    Route::patch('content-blocks/{contentBlock}/move-up', [ContentBlockController::class, 'moveUp'])
        ->name('content-blocks.move-up');
    Route::patch('content-blocks/{contentBlock}/move-down', [ContentBlockController::class, 'moveDown'])
        ->name('content-blocks.move-down');
    Route::post('content-blocks/{contentBlock}/duplicate', [ContentBlockController::class, 'duplicate'])
        ->name('content-blocks.duplicate');
    Route::post('content-blocks/bulk-action', [ContentBlockController::class, 'bulkAction'])
        ->name('content-blocks.bulk-action');

    Route::patch('services/{service}/toggle-active', [ServiceController::class, 'toggleActive'])
        ->name('services.toggle-active');
    Route::patch('services/{service}/toggle-home', [ServiceController::class, 'toggleHome'])
        ->name('services.toggle-home');
    Route::patch('services/{service}/toggle-navbar', [ServiceController::class, 'toggleNavbar'])
        ->name('services.toggle-navbar');
    Route::patch('services/{service}/move-up', [ServiceController::class, 'moveUp'])
        ->name('services.move-up');
    Route::patch('services/{service}/move-down', [ServiceController::class, 'moveDown'])
        ->name('services.move-down');
    Route::post('services/{service}/duplicate', [ServiceController::class, 'duplicate'])
        ->name('services.duplicate');
    Route::post('services/bulk-action', [ServiceController::class, 'bulkAction'])
        ->name('services.bulk-action');

    Route::get('/inquiries', [ContactInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [ContactInquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('/inquiries/{inquiry}/toggle-read', [ContactInquiryController::class, 'toggleRead'])->name('inquiries.toggle-read');
    Route::delete('/inquiries/{inquiry}', [ContactInquiryController::class, 'destroy'])->name('inquiries.destroy');

    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    Route::resource('content-blocks', ContentBlockController::class);
    Route::resource('services', ServiceController::class);
});

require __DIR__ . '/auth.php';