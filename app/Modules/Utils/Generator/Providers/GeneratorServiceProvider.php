<?php

namespace App\Modules\Utils\Generator\Providers;


use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Http/Routes/api.php');
    }

}
