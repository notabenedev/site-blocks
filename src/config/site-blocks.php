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
        'pages' => 'App\Page',
    ),

    'templates' => [
        "site-blocks::site.block-groups.templates.accordion",
        "site-blocks::site.block-groups.templates.about",
        "site-blocks::site.block-groups.templates.step",
        "site-blocks::site.block-groups.templates.vacancy",
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
    ),
    "sitePackageName" => "Блоки",
    "blocksAdminRoutes" => true,
    "adminPager" => 20,

    'filters' => array(
        "lg-grid-4" => 992,
        "md-grid-6" => 768
    ),

    "floatImgAboutTemplate" => "float-md-left float-lg-none float-xl-left",
    "floatImgAccordionTemplate" => "float-md-right float-lg-none float-xl-right",
    "floatImgVacancyTemplate" => "float-md-right float-lg-none float-xl-right",
    "floatImgStepTemplate" => "",

    "blockGroupFacade" => \Notabenedev\SiteBlocks\Helpers\BlockGroupActionsManager::class,

];