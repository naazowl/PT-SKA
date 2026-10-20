<?php

namespace App\Providers;

use App\Models\CompanyProfile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            static $profile = false; 

            if ($profile === false) {
                $profile = Schema::hasTable('company_profiles')
                    ? CompanyProfile::first()
                    : null;
            }

            $view->with('siteProfile', $profile);
        });
    }
}