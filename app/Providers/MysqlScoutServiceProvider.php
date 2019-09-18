<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Yab\MySQLScout\Engines\MySQLEngine;
use Yab\MySQLScout\Commands\ManageIndexes;
use Yab\MySQLScout\Engines\Modes\ModeContainer;
use Yab\MySQLScout\Providers\MySQLScoutServiceProvider as MySQLScoutEngine;

class MysqlScoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // if ($this->app->runningInConsole()) {
            $this->commands([
                ManageIndexes::class,
            ]);
        // }

        $this->app->make(EngineManager::class)->extend('mysql', function () {
            return new MySQLEngine(app(ModeContainer::class));
        });
    }

}
