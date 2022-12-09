## Конфиг
    php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=config
## Install
    php artisan migrate
    php artisan make:blocks
                            {--all : Run all}
                            {--models : Export models}
                            {--policies : Export models}
    npm run dev