<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define(
            'manage-invitation',
            fn (User $user): bool => $user->is_admin
                && mb_strtolower($user->email) === mb_strtolower((string) config('admin.email')),
        );
    }
}
