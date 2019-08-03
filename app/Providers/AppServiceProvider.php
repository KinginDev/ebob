<?php

namespace App\Providers;

use App\OurClient;
use App\Post;
use View;
use App\Menu;
use App\Social;
use App\Advertisment;
use App\GeneralSettings;

use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
       \URL::forceScheme('https');
        try{
            $data['basic'] = GeneralSettings::first();
            $data['gnl'] = GeneralSettings::first();
            $data['menus'] = Menu::all();
            $data['social'] = Social::all();

            view::share($data);

            view()->composer('partials.clients', function ($view){
                $view->with('clients', OurClient::all());
            });
        } catch(\QueryException $e){
            return 'Setup Database';
        }
        

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
}
