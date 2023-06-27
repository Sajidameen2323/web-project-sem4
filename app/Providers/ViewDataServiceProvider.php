<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            // Access the authenticated user
            if (Auth::user()) {
                $user = Auth::user();

                $role = Role::findOrFail($user->role)->role;

                $write_permission = $role == 'admin' || $role == 'manager';

                // Share user-specific data with the view
                $view->with(['user' => $user, 'write_permission' => $write_permission]);
            }
        });
    }
}
