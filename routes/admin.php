<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\CoreValueController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ExperiencePageController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ResortController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\WelcomeSectionController;
use App\Http\Controllers\Admin\VideoSectionController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OfferIntroController;
use App\Http\Controllers\Admin\PhilosophyController;
use App\Http\Controllers\Admin\GalleryIntroController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ResortIntroController;
use App\Http\Controllers\Admin\TestimonialIntroController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


// Auth::routes([
//     'register' => false,
//     'reset' => false,
//     'verify' => false,
// ]);
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::prefix('resorts/{type}')
        ->where(['type' => '1'])
        ->group(function () {
        Route::get('/create', [ResortController::class, 'create'])->name('resorts.create');
        Route::post('/', [ResortController::class, 'store'])->name('resorts.store');
        Route::delete('/{resort}', [ResortController::class, 'destroy'])->name('resorts.destroy');
    });
    Route::prefix('resorts/{type}')
    ->where(['type' => '1|2|3|4'])
    ->group(function () {
        Route::get('/', [ResortController::class, 'index'])->name('resorts.index');
        Route::get('/{resort}', [ResortController::class, 'show'])->name('resorts.show');
        Route::get('/{resort}/edit', [ResortController::class, 'edit'])->name('resorts.edit');
        Route::put('/{resort}', [ResortController::class, 'update'])->name('resorts.update');
    });
    Route::get('resort-intro', [ResortIntroController::class, 'edit'])
            ->name('resort-intro.edit');
    Route::put('resort-intro', [ResortIntroController::class, 'update'])
            ->name('resort-intro.update');
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('gallery-categories', GalleryCategoryController::class);
    Route::prefix('gallery/{type}')
    ->where(['type' => '1|2|3'])
    ->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
        Route::get('/create', [GalleryController::class, 'create'])->name('galleries.create');
        Route::post('/', [GalleryController::class, 'store'])->name('galleries.store');
        Route::get('/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
        Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::put('/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    });
    Route::prefix('offers/{type}')
        ->where(['type' => '1|2'])
        ->group(function () {
            Route::get('/', [OfferController::class, 'index'])->name('offers.index');
            Route::get('/create', [OfferController::class, 'create'])->name('offers.create');
            Route::post('/', [OfferController::class, 'store'])->name('offers.store');
            Route::get('/{offer}', [OfferController::class, 'show'])->name('offers.show');
            Route::get('/{offer}/edit', [OfferController::class, 'edit'])->name('offers.edit');
            Route::put('/{offer}', [OfferController::class, 'update'])->name('offers.update');
            Route::delete('/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');
        });
    Route::prefix('offer-intro/{type}')
        ->where(['type' => '1|2'])
        ->group(function () {
            Route::get('/', [OfferIntroController::class, 'edit'])
                ->name('offer-intro.edit');

            Route::put('/', [OfferIntroController::class, 'update'])
                ->name('offer-intro.update');
        });
    Route::prefix('gallery-intro/{type}')
        ->where(['type' => '1|2'])
        ->group(function () {
            Route::get('/', [GalleryIntroController::class, 'edit'])
                ->name('gallery-intro.edit');

            Route::put('/', [GalleryIntroController::class, 'update'])
                ->name('gallery-intro.update');
        });
    Route::get('testimonial-intro', [TestimonialIntroController::class, 'edit'])
        ->name('testimonial-intro.edit');
    Route::put('testimonial-intro', [TestimonialIntroController::class, 'update'])
        ->name('testimonial-intro.update');
    Route::get('welcome-section', [WelcomeSectionController::class, 'edit'])
        ->name('welcome-section.edit');
    Route::put('welcome-section', [WelcomeSectionController::class, 'update'])
        ->name('welcome-section.update');
    Route::get('video-section', [VideoSectionController::class, 'edit'])
        ->name('video-section.edit');
    Route::put('video-section', [VideoSectionController::class, 'update'])
        ->name('video-section.update');
    Route::prefix('banners/{type}')
        ->group(function () {
            Route::get('/', [BannerController::class, 'index'])->where('type', '2')->name('banners.index');
            Route::get('/create', [BannerController::class, 'create'])->where('type', '2')->name('banners.create');
            Route::post('/', [BannerController::class, 'store'])->where('type', '2')->name('banners.store');
            Route::get('/{banner}', [BannerController::class, 'show'])->where('type', '2')->name('banners.show');
            Route::get('/{banner}/edit', [BannerController::class, 'edit'])->where(['type' => '1|2'])->name('banners.edit');
            Route::put('/{banner}', [BannerController::class, 'update'])->where(['type' => '1|2'])->name('banners.update');
            Route::delete('/{banner}', [BannerController::class, 'destroy'])->where('type', '2')->name('banners.destroy');
        });


    // About Singleton
    Route::get(
        'about',
        [AboutController::class, 'edit']
    )->name('about.edit');

    Route::put(
        'about',
        [AboutController::class, 'update']
    )->name('about.update');


    // Philosophy CRUD
    Route::resource(
        'philosophies',
        PhilosophyController::class
    );


    //   Core Values CRUD

    Route::resource(
        'core-values',
        CoreValueController::class
    );

    // | Experience Page (Singleton)


    Route::prefix('experiences/{type}')
        ->where(['type' => '1|2'])
        ->group(function () {
            Route::get('/', [ExperiencePageController::class, 'edit'])->name('experiences.edit');
            Route::put('/', [ExperiencePageController::class, 'update'])->name('experiences.update');
        });

    // | Experience Items
    Route::prefix('experience-items/{type}')
        ->where(['type' => '1|2'])
        ->group(function () {
            Route::get('/', [ExperienceController::class, 'index'])->name('experience-items.index');
            Route::get('/create', [ExperienceController::class, 'create'])->name('experience-items.create');
            Route::post('/', [ExperienceController::class, 'store'])->name('experience-items.store');
            Route::get('/{experience}/edit', [ExperienceController::class, 'edit'])->name('experience-items.edit');
            Route::put('/{experience}', [ExperienceController::class, 'update'])->name('experience-items.update');
            Route::delete('/{experience}', [ExperienceController::class, 'destroy'])->name('experience-items.destroy');
        });

    // Contact Page
    Route::get(
        'contact-page',
        [ContactPageController::class, 'edit']
    )->name('contact-page.edit');

    Route::put(
        'contact-page',
        [ContactPageController::class, 'update']
    )->name('contact-page.update');

    Route::resource(
        'contact-enquiry',
        ContactEnquiryController::class
    )->only(['index', 'show', 'destroy']);


    // Settings
    Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');


    // Newsletter Enquiries
    Route::get('newsletter-enquiries', [NewsletterController::class, 'index'])
        ->name('newsletters.index');

    Route::delete('newsletter-enquiries/{newsletter}', [NewsletterController::class, 'destroy'])
        ->name('newsletters.destroy');
});