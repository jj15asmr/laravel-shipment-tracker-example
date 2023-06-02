<?php

namespace App\Providers;

use Illuminate\Support\Str;
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
        Str::macro('randomDigits', function(int $length) {
            $min = (int) str_repeat('0', $length);
            $max = (int) str_repeat('9', $length);

            $random_digits = random_int($min, $max);

            if (str($random_digits)->length() < $length) {
                $random_digits = (string) str($random_digits)->padLeft($length, '0');
            }

            return $random_digits;
        });
    }
}
