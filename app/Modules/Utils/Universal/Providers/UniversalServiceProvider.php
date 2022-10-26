<?php

namespace App\Modules\Utils\Universal\Providers;


use Illuminate\Support\ServiceProvider;

class UniversalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Http/Routes/api.php');
    }

}
