<?php
return [
    /*
        |-------------------------------------
        | Доступные модели
        |-------------------------------------
        |
        | Можно перечислить модели которые обладают блоком,
        | при этом у модели должен быть метод blockGroups().
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
    ],

    'fill' => array(
        [
            "title" => "Вопрос-Ответ",
            "slug" => "faq",
            "template" => "site-blocks::site.block-groups.templates.accordion",
        ],
        [
            "title" => "О компании",
            "slug" => "about-company",
            "template" => "site-blocks::site.block-groups.templates.about",
        ],
    ),
    "sitePackageName" => "Блоки",
    "blocksAdminRoutes" => true,
    "adminPager" => 20,
];