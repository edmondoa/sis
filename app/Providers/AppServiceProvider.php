<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tenanti;
use App\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $entity = new User;
        Tenanti::connection('master', function ($entity, array $config) {
            $config['database'] = "domain{$entity->getKey()}"; 
            // refer to config under `database.connections.tenants.*`.

            return $config;
        });
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
