<?php

namespace App\Providers;

use App\Enums\Status;
use App\Models\ContactPage;
use App\Models\Resort;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['front.partials.header', 'front.partials.footer'], function ($view) {

            $megaMenuResorts = Resort::where('mega_menu_status', Status::ACTIVE->value)
                ->orderByDesc('id')
                ->get();

            $bookNowResorts = Resort::where('book_now_status', Status::ACTIVE->value)
                ->orderByDesc('id')
                ->get();

            $contactpage = ContactPage::first();
            $resorts = Resort::latest()->get();
            $view->with(['contactpage' => $contactpage, 'resorts' => $resorts, 'megaMenuResorts' => $megaMenuResorts, 'bookNowResorts' => $bookNowResorts]);
        });
    }
}
