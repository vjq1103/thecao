<?php

namespace App\Providers;

use App\SetingBank;
use App\SetingData;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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

        $settingData = SetingData::paginate(2);
        View::share('settingData',$settingData);



        $settingData2 = SetingData::find(2);
        View::share('settingData2',$settingData2);



        $settingBank = SetingBank::all();
        View::share('settingBank',$settingBank);


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
