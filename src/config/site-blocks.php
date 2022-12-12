<?php
return [
    /*
        |-------------------------------------
        | Доступные модели
        |-------------------------------------
        |
        | Можно перечислить модели которые обладают блоком,
        | при этом у модели должен быть метод blocks().
        |
        | public function blocks() {
        |   return $this->morphMany('App\Block', 'blockable');
        | }
        |
        */
    'models' => array(
        'page' => 'App\Page',
    ),
    'templates' => array(
        "accordion",
        "about",
    ),
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
];