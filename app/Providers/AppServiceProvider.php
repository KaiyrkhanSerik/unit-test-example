<?php

namespace App\Providers;

use App\Contracts\Repositories\ProductsRepository;
use App\Contracts\Services\SendEmailService;
use App\Repositories\ProductRepository;
use App\Services\MailchampEmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductsRepository::class, ProductRepository::class);
        $this->app->bind(SendEmailService::class, MailchampEmailService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
