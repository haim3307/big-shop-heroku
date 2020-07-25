<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Blade::extend(function ($value) {
            return preg_replace('/\@define(.+)/', '<?php ${1}; ?>', $value);
        });

        view()->composer('*', function ($view) {
            $view->with([
                'store_name' => 'Big-Shop',
                'defaultMetaDesc' => "Life Style Store with sports , camping ,gaming and playground products , Choose Your life style at big store",
            ]);
        });
    }
}
