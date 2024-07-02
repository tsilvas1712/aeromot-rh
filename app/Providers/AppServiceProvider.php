<?php

namespace App\Providers;

use App\Models\FeedBack;
use App\Models\FeedBackProfessional;
use App\Observers\FeedBackObserver;
use App\Observers\FeedBackProfessionalObserver;
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
        FeedBack::observe(FeedBackObserver::class);
        FeedBackProfessional::observe(FeedBackProfessionalObserver::class);
    }
}
