<?php

namespace Notabenedev\SiteBlocks;
use Illuminate\Support\ServiceProvider;

class SiteBlocksServiceProvider extends ServiceProvider
{

    public function boot()
    {
        setlocale(LC_ALL, 'ru_RU.UTF-8');


    }

    public function register()
    {
    }

}
