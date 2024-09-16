<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\interfaces\album\AlbumServiceInterface;

class CreateAlbumController
{
    public static function index(): void
    {
        $album_name = $_POST['album-name'];
        $album_description = $_POST['album-description'];

        AppContainer::instance()
            ->get(AlbumServiceInterface::class)
            ->create_album($album_name, $album_description);
    }
}