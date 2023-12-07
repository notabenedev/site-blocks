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
## Versions    
    v1.1.1-v1.1.2 - шаблон attention
        - php artisan make:blocks --js
        - php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
        - Set up new config params (if you need):
            'fill' =>
                [
                "title" => "Уведомление",
                "slug" => "attention",
                "template" => "site-blocks::site.block-groups.templates.home-attention",
                ],
            'templates' => [
                "site-blocks::site.block-groups.templates.attention",
                ],
        - & after you've changed config - generate home-blocks (if you need):
            php artisan make:blocks --fill 
    v1.1.0 - обновление Трейта > blockGroupsByTemplates(array), blockGroupsNotInTemplates(array)
    v1.0.17-v1.0.18 - обновления вывода табов:
            - Добавлен шаблон home-tab-pills (в тч в конфиг, для вывода табов на отдельной странице)
           Проверить переопределение:
            - шаблона: site.block-groups.templates.tab-pills
    v1.0.16 - обновления в админ панели групп и блоков:
            - группы - поиск по заголовку, типу 
            - блоки - поиск по группе
            - редирект после удаления блока со страницы блока - на страницу группы
          Проверить переопределение: 
            - шаблонов: admin.block-groups.index, admin.blocks.pills, admin.blocks.index
            - контроллеров:  Admin/BlockGroupController(index), Admin/BlocksController(destroy, index)
    v1.0.15 - block title validator (пропустить не уникальный title)
    v1.0.14 - шаблон tab для отображения нескольких Групп блоков в виде Табов
          - Set up new config params :
            'templates' => [
                "site-blocks::site.block-groups.templates.tab",
            ],
          - (если нужно) задайте группы блоков для домашеней страницы  , например
             'fillGroups' => array(
                [
                   "title" => "Таб1",
                   "slug" => "tab-1",
                   "template" => "site-blocks::site.block-groups.templates.tab",
                   "groupTemplate" => "site-blocks::site.block-groups.templates.tab-pills",
                ],
                [
                   "title" => "Таб2",
                   "slug" => "tab-2",
                   "template" => "site-blocks::site.block-groups.templates.tab",
                   "groupTemplate" => "site-blocks::site.block-groups.templates.tab-pills",
                ],
            ),
          - (если нужно) создайте заданные в конфиге блоки для домашней страницы:
                php artisan make:blocks --fill   
                (обновит старые и создаст новые блоки согласно Конфига fill, fillGroups)
          - (если нужно) для вывода данных табов на домашней страцы подключите шаблон: 
                @includeIf("site-blocks::site.block-groups.templates.tab-pills")  
          - Важно! 
            (Если переопределены шаблон вывода страницы site-pages или  Блоки подключены к другим моделям)
            - При подключении табов к Модели разделите вывод групп блоков по заданному шаблону табов:
                    $page->blockGroupsByTemplete("site-blocks::site.block-groups.templates.tab") 
                    $page->blockGroupsNotInTempletes(["site-blocks::site.block-groups.templates.tab"]) 
            Стандартный шаблон site-pages ^v3.1.0 содержит даннное разделение.

    v1.0.13 - шаблон digit
         - Set up new config params to Config:
        'fill' =>
            [
            "title" => "Цифры",
            "slug" => "digit",
            "template" => "site-blocks::site.block-groups.templates.home-digit",
            ],
        'templates' => [
            "site-blocks::site.block-groups.templates.digit",
            ],
        - php artisan make:blocks --fill 
        - php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
    v1.0.12 - шаблон benefit
        - Set up new config params to Config:
        'fill' =>
            [
            "title" => "Преимущества",
            "slug" => "benefit",
            "template" => "site-blocks::site.block-groups.templates.home-benefit",
            ],
        'templates' => [
            "site-blocks::site.block-groups.templates.benefit",
            ],
        'filtersBenefit' => array(),
        - php artisan make:blocks --fill
        - php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=public --force
    v1.0.11 - шаблон vacancy
        - Config:
            php artisan vendor:publish --provider="Notabenedev\SiteBlocks\SiteBlocksServiceProvider" --tag=config
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
                            