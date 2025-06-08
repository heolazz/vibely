<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;

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
    public function boot()
{
    View::composer('layouts.admin', function ($view) {
        $tips = [
            "Luangkan waktu untuk dirimu hari ini. Rehat sejenak bukan berarti mundur. 🌿",
            "Tarik napas dalam-dalam, dan lepaskan perlahan. Kamu sedang berproses. 🍃",
            "Tidak apa-apa merasa lelah, istirahat juga bagian dari kemajuan. 💆‍♂️",
            "Kesehatan mental sama pentingnya dengan kesehatan fisik. 🌈",
            "Hari ini, cukup lakukan yang kamu mampu. Itu sudah cukup. 🌤️",
        ];

        $randomTip = $tips[array_rand($tips)];

        $view->with('randomTip', $randomTip);
    });

    Blade::componentNamespace('App\\View\\Components', 'components');
    // ...

    //  if (app()->environment('production')) {
    //     URL::forceScheme('https');
    // }
}
}

