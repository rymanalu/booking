<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->viewComposer();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function viewComposer()
    {
        view()->composer(['layouts.app', 'profile'], function ($view) {
            $user = user();
            $isUser = isset($user->email);

            $view->withUser($user)->withIsUser($isUser);
        });
    }
}
