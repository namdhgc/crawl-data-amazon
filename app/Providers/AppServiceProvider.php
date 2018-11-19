<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer(
            ['layouts/admin/sidebar', 'layouts/admin/header'],
            'Spr\Base\ViewComposers\PageInformation'
        );

        view()->composer(
            ['layouts/user/footer'],
            'Spr\Base\ViewComposers\PageUserInformation'
        );

        view()->composer(
            ['layouts/user/aside_information'],
            'Spr\Base\ViewComposers\AsideUserInformation'
        );

        view()->composer(
            ['pages/user/confirm_orders_info', 'pages/mobile/confirm_orders_info'],
            'Spr\Base\ViewComposers\CityInformation'
        );


        Validator::extend(
          'recaptcha',
          'Spr\Base\Validates\ReCaptcha@validate'
        );

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
