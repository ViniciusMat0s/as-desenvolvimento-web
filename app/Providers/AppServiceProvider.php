<?php

namespace App\Providers;

use App\Models\Explorer;
use App\Policies\ExplorerPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::policy(Explorer::class, ExplorerPolicy::class);
    }
}