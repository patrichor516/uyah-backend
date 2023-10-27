<?php

namespace App\Providers;

use App\Models\Books;
use App\Observers\BooksObserver;
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
        Books::observe(BooksObserver::class);
    }
}
