<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\TestNotificationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->group(function() {


Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin', 'verified'])->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'settings_data'])->name('settings_data');

    Route::resource('categories', CategoryController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('roles', RoleController::class);
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {
    // Site Routes
    Route::get('/', [SiteController::class, 'index'])->name('site.index');
    Route::get('/about', [SiteController::class, 'about'])->name('site.about');
    Route::get('/courses', [SiteController::class, 'courses'])->name('site.courses');
    Route::get('/courses/{slug}', [SiteController::class, 'course'])->name('site.course');
    Route::post('/courses/{slug}/review', [SiteController::class, 'review'])->name('site.review')->middleware('auth');
    Route::get('/courses/{slug}/enroll', [SiteController::class, 'enroll'])->name('site.enroll')->middleware('auth');
    Route::get('/courses/{slug}/payment', [SiteController::class, 'payment'])->name('site.payment')->middleware('auth');
    Route::get('/our-team', [SiteController::class, 'our_team'])->name('site.our_team');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
});

// Route for test only
Route::get('/api-test', [TestController::class, 'test_api']);
Route::get('/api-weather', [TestController::class, 'weather_api']);

Route::get('send', [TestNotificationController::class, 'send']);
Route::get('read', [TestNotificationController::class, 'read']);
Route::get('read/{id}', [TestNotificationController::class, 'read_notify']);
Route::get('read-all', [TestNotificationController::class, 'read_all']);
