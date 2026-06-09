<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TrekController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HomepageSettingsController;
use App\Http\Controllers\Admin\CarouselSlideController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\ComparisonController;
use App\Http\Controllers\Admin\TravelGuideController;
use App\Http\Controllers\Admin\SeasonalGuideController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('treks', TrekController::class);
    Route::resource('gallery', GalleryImageController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('why-choose-us', WhyChooseUsController::class);
    Route::resource('team-members', TeamMemberController::class);
    Route::resource('faqs', FaqController::class);
    Route::get('homepage', [HomepageSettingsController::class, 'edit'])->name('homepage.edit');
    Route::put('homepage', [HomepageSettingsController::class, 'update'])->name('homepage.update');
    Route::resource('carousel-slides', CarouselSlideController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('travel-guides', TravelGuideController::class);
    Route::resource('comparisons', ComparisonController::class);
});