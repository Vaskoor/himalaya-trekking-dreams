<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\HelicopterTourController;
use App\Http\Controllers\Api\PeakController;
use App\Http\Controllers\Api\TourPackageController;
use App\Http\Controllers\Api\TrekController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\GalleryImageController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\WhyChooseUsController;
use App\Http\Controllers\Api\TeamMemberController;
use App\Http\Controllers\Api\HomepageSettingsController;
use Illuminate\Support\Facades\Route;

// Existing routes
Route::get('helicopter-tours', [HelicopterTourController::class, 'index']);
Route::get('helicopter-tours/{slug}', [HelicopterTourController::class, 'show']);
Route::get('peaks', [PeakController::class, 'index']);
Route::get('peaks/{slug}', [PeakController::class, 'show']);
Route::get('tour-packages', [TourPackageController::class, 'index']);
Route::get('tour-packages/{slug}', [TourPackageController::class, 'show']);
Route::get('activities', [ActivityController::class, 'index']);
Route::get('activities/{slug}', [ActivityController::class, 'show']);
Route::get('treks', [TrekController::class, 'index']);
Route::get('treks/{slug}', [TrekController::class, 'show']);

// Dynamic content endpoints
Route::apiResource('gallery', GalleryImageController::class)->only(['index']);
Route::apiResource('testimonials', TestimonialController::class)->only(['index']);
Route::apiResource('why-choose-us', WhyChooseUsController::class)->only(['index']);
Route::apiResource('team-members', TeamMemberController::class)->only(['index']);
Route::apiResource('faqs', FaqController::class)->only(['index']);
Route::get('homepage-settings', [HomepageSettingsController::class, 'index']);
Route::get('carousel-slides', [App\Http\Controllers\Api\CarouselSlideController::class, 'index']);
Route::apiResource('blogs', Api\BlogController::class)->only(['index', 'show']);
Route::apiResource('regions', Api\RegionController::class)->only(['index', 'show']);
Route::apiResource('comparisons', Api\ComparisonController::class)->only(['index', 'show']);
Route::apiResource('seasonal-guides', Api\SeasonalGuideController::class)->only(['index', 'show']);
Route::apiResource('seasonal-guides', App\Http\Controllers\Api\SeasonalGuideController::class)->only(['index', 'show']);
