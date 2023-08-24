## Config
    php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=config
## Assets
    php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
## Fill config
    Set up fill array to your project
## Install
    php artisan migrate
    php artisan make:blocks
                            {--all : Run all}
                            {--models : Export models}
                            {--policies : Export models}
                            {--controllers : Export controllers}
                            {--vue : Export components}
                            {--scss : Export styles}
                            {--menu : Make admin menu}
                            {--fill : create default groups from config site-blocks.fill array (to home)}
                            {--remove-fill : remove default  groups from config site-blocks.fill array (from home)}
    npm run dev
    Add to morphed Model: 
                            use ShouldBlockGroup;
## Versions    

    v1.0.11 - шаблон vacancy
        - Config:
            php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public
        - Set up new config params to Config:
         'fill' => 
                [
                    "title" => "Вакансии",
                    "slug" => "vacancy",
                    "template" => "site-blocks::site.block-groups.templates.home-vacancy",
                ],
        'templates' => [
                "site-blocks::site.block-groups.templates.vacancy",
                ],
        "floatImgVacancyTemplate" => "float-md-right float-lg-none float-xl-right",

        - php artisan make:blocks --fill
        - php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
    v1.0.10 - base 3 | 4, fix admin pills
    v1.0.9 - добавлен флаг --remove-fill к команде конфигурации пакета
            Флаг позволяет удалить неиспользуемые дефолтные группы блоков, созданные ранее флагом --fill 
            !ВАЖНО: после выполнения этой команды актуализируйте  конфиг site-blocks.fill (оставьте только используемые группы блоков)
    v1.0.8 - откорректирвоан пункт меню Группы блоков для админ-интерфейса (проверка связки с другими моделями)
    v1.0.7 - откорректирвоан редирект после удаления блока в админке (back())
    v0.1.6 - изменен шаблон accordion-teaser  & scss blocks-accordion 
            php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force

    v0.1.5 - шаблон steps
        - Config:
            php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
        - Set up new config params:
         'fill' => 
                [
                    "title" => "Этапы",
                    "slug" => "steps",
                    "template" => "site-blocks::site.block-groups.templates.home-step",
                ],
        'templates' => [
                "site-blocks::site.block-groups.templates.step",
                ],
        - php artisan make:blocks --fill
        - php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
                            