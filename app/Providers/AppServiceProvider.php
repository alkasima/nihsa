<?php

namespace App\Providers;

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
        // Load custom language files
        $this->loadTranslationsFrom(lang_path('en'), 'messages');
        $this->loadTranslationsFrom(lang_path('ha'), 'messages');
        $this->loadTranslationsFrom(lang_path('yo'), 'messages');
        $this->loadTranslationsFrom(lang_path('ig'), 'messages');
    }
}
