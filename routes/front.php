<?php

use App\Http\Controllers\Admin\NewsletterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontController;
/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register front routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'delete');

Route::prefix('laravel-demo')
    ->group(function () {

Route::get('/', [FrontController::class, 'home'])->name('home');

Route::get('about-us', [FrontController::class, 'aboutUs'])
    ->name('about-us');

Route::get('experiences', [FrontController::class, 'experiences'])
    ->name('experiences');

Route::get('contact', [FrontController::class, 'contact'])
    ->name('contact');


Route::post('contact/enquiry', [FrontController::class, 'store'])
    ->name('contact.enquiry.store');

Route::post('/newsletter/subscribe', [FrontController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('gallery', [FrontController::class, 'gallery'])->name('gallery');

Route::get('offers', [FrontController::class, 'offers'])->name('offers');

});
// View::Composer(['partials.header','partials.footer'], function($view){
//     $view->with([
//         'settings'=>Setting::get(),
//     ]);
// });
