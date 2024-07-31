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
                            {--js : Export js}
                            {--scss : Export styles}
                            {--menu : Make admin menu}
                            {--fill : create default groups from config site-blocks.fill array (to home)}
                            {--remove-fill : remove default  groups from config site-blocks.fill array (from home)}
    npm run dev
    Add to morphed Model: 
                            use ShouldBlockGroup;

