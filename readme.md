## Конфиг
    php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=config
## Assets
    php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
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