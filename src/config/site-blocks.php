<?php
return [
    /*
        |-------------------------------------
        | Доступные модели
        |-------------------------------------
        |
        | Можно перечислить модели которые обладают блоком,
        | при этом у модели должен быть метод blockGroups():
        |
        | добавьте трейт use BlockGroups к модели.
        |
        | public function blockGroups() {
        |   return $this->morphMany('App\BlockGroup', 'blockGroupable');
        | }
        |
        */

    'models' => array(
       // 'pages' => 'App\Page',
    ),

    'templates' => [
        "site-blocks::site.block-groups.templates.accordion",
        "site-blocks::site.block-groups.templates.about",
        "site-blocks::site.block-groups.templates.step",
        "site-blocks::site.block-groups.templates.vacancy",
        "site-blocks::site.block-groups.templates.benefit",
        "site-blocks::site.block-groups.templates.digit",
        "site-blocks::site.block-groups.templates.tab",
        "site-blocks::site.block-groups.templates.alert",
        "site-blocks::site.block-groups.templates.partner",
        "site-blocks::site.block-groups.templates.hero",
    ],

    'fill' => array(
        [
            "title" => "Вопрос-Ответ",
            "slug" => "faq",
            "template" => "site-blocks::site.block-groups.templates.home-accordion",
        ],
        [
            "title" => "О компании",
            "slug" => "about-company",
            "template" => "site-blocks::site.block-groups.templates.home-about",
        ],
        [
            "title" => "Этапы",
            "slug" => "steps",
            "template" => "site-blocks::site.block-groups.templates.home-step",
        ],
        [
            "title" => "Вакансии",
            "slug" => "vacancy",
            "template" => "site-blocks::site.block-groups.templates.home-vacancy",
        ],
        [
            "title" => "Преимущества",
            "slug" => "benefit",
            "template" => "site-blocks::site.block-groups.templates.home-benefit",
        ],
        [
            "title" => "Цифры",
            "slug" => "digit",
            "template" => "site-blocks::site.block-groups.templates.home-digit",
        ],
        [
            "title" => "Уведомление",
            "slug" => "attention",
            "template" => "site-blocks::site.block-groups.templates.home-alert",
        ],
        [
            "title" => "Партнеры",
            "slug" => "partner",
            "template" => "site-blocks::site.block-groups.templates.home-partner",
        ],
        [
            "title" => "Слоган",
            "slug" => "hero",
            "template" => "site-blocks::site.block-groups.templates.home-hero",
        ]
    ),
    'fillGroups' => array(
       [
           "title" => "Таб1",
           "slug" => "tab-1",
           "template" => "site-blocks::site.block-groups.templates.tab",
           "groupTemplate" => "site-blocks::site.block-groups.templates.home-tab-pills",
       ],
        [
           "title" => "Таб2",
           "slug" => "tab-3",
           "template" => "site-blocks::site.block-groups.templates.tab",
           "groupTemplate" => "site-blocks::site.block-groups.templates.home-tab-pills",
       ],
    ),
    "sitePackageName" => "Блоки",
    "blocksAdminRoutes" => true,
    "adminPager" => 20,

    'filters' => array(
        "lg-grid-4" => 992,
        "md-grid-6" => 768
    ),

    'filtersBenefit' => array(
    ),
    'filtersDigit' => array(
    ),
    'filtersPartner' => array(    ),
    'filtersTab' => array(
    ),

    "floatImgAboutTemplate" => "float-md-left float-lg-none float-xl-left",
    "floatImgAccordionTemplate" => "float-md-right float-lg-none float-xl-right",
    "floatImgVacancyTemplate" => "float-md-right float-lg-none float-xl-right",
    "floatImgStepTemplate" => "",

    "blockGroupFacade" => \Notabenedev\SiteBlocks\Helpers\BlockGroupActionsManager::class,

];