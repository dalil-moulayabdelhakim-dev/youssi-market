<?php

namespace App\Providers;

use App\Models\Wilaya;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

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
        // تغيير اللغة
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        // نمرّر الولايات لصفحة التسجيل
        View::composer('auth.register', function ($view) {
            $view->with('wilayas', Wilaya::all());
        });

        // نمرر المتغيرات العامة لجميع الصفحات
        View::composer('*', function ($view) {
            $user = \Illuminate\Support\Facades\Auth::user();
            $view->with([
                'categories' => \App\Models\Category::all(),
                'admin_info' => \App\Models\AdministrativeInformation::first(),
                'cartCount' => $user ? $user->cart()->count() : 0,
                'user_type' => $user ? $user->user_type_id : null,
                'subscription_status' => ($user && $user->store) ? $user->store->subscription_status : null,
                'subscription' => ($user && $user->store) ? $user->store->subscription_method_id : null,
                'unresolved_tickets_count' => ($user && $user->user_type_id == 1) ? \App\Models\Ticket::whereIn('status', ['open', 'in_progress'])->count() : 0,
            ]);
        });
    }
}
