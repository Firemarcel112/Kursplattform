<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (!app()->isProduction()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(config('app.check_lazy_loading', false));
        Schema::defaultStringLength(191);
        View::addNamespace('mail', [
            resource_path('views/mail'),
            resource_path('views/vendor/mail'),
            resource_path('views/vendor/mail/html'),
            resource_path('views/vendor/mail/text'),
        ]);
    }
}
