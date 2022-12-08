<?php

namespace Notabenedev\SiteBlocks;
use Illuminate\Support\ServiceProvider;
use Notabenedev\SiteBlocks\Console\Commands\SiteBlocksMakeCommand;

class SiteBlocksServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Публикация конфигурации
        $this->publishes([
            __DIR__.'/config/site-staff.php' => config_path('site-staff.php')
        ], 'config');

        // Подключение миграции
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Console
        if ($this->app->runningInConsole()){
            $this->commands([
                SiteBlocksMakeCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/site-blocks.php','site-blocks'
        );
    }

}
