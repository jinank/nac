<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LiveData extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['MainSite.Content.index','MainSite.Content.LandingPage.index'], function ($view) {
            // for break work 
            $userId = session('user')->id??null;
           
            if ($userId) {
                $userData = User::find($userId);
            }
            $view->with([
                'userData' => $userData??'',
            ]);
        });
                
                
    }
}
