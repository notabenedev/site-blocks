<?php

namespace Notabenedev\SiteBlocks;
use App\BlockGroup;
use Illuminate\Support\ServiceProvider;
use Notabenedev\SiteBlocks\Console\Commands\BlocksMakeCommand;

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
               BlocksMakeCommand::class
            ]);
        }

        //Подключаем роуты
        if (config("site-blocks.blocksAdminRoutes")) {
            $this->loadRoutesFrom(__DIR__."/routes/admin/block-group.php");
            $this->loadRoutesFrom(__DIR__."/routes/admin/block.php");
        }

        // Подключение шаблонов.
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'site-blocks');
        view()->composer([
            "site-blocks::admin.blocks.create",
            "site-blocks::admin.blocks.edit",
        ], function ($view){
            $groups = BlockGroup::getFree();
            $view->with("groups", $groups);
        });
        view()->composer([
            "site-blocks::site.block-groups.templates.accordion",
        ], function ($view){
            $blocks = null;
            $group = null;
            try{
                $group = BlockGroup::query()->where("slug","=","faq")->firstOrFail();
                $blocks = $group->blocks;
                $view->with("group", $group);
                $view->with("blocks", $blocks);
            }
            catch (\Exception $e){
            }

        });

        // Подключаем изображения.
        $imagecache = app()->config['imagecache.paths'];
        $imagecache[] = 'storage/blocks/main';
        app()->config['imagecache.paths'] = $imagecache;
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/site-blocks.php','site-blocks'
        );
    }

}
