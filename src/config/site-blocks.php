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
    "sitePackageName" => "Блоки",
    "blocksAdminRoutes" => true,
];