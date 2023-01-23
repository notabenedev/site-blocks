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
                            {--fill : create default groups from config fill array}
    npm run dev
    Add to morphed Model: 
                            use ShouldBlockGroup;
## Versions    
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
                            