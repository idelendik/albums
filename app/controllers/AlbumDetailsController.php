<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\core\View;
use Albums\interfaces\albumDetails\AlbumDetailsServiceInterface;

class AlbumDetailsController
{
    private static View $view;

    public function __construct(string $className = View::class)
    {
        static::$view = (new $className());
    }

    public static function index(): void
    {
        $album_id = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[2];

        $images = AppContainer::instance()->get(AlbumDetailsServiceInterface::class)->prepare_data($album_id);

        static::$view::render('AlbumDetails', [
            'images' => $images,
            'album_id' => $album_id
        ]);
    }
}