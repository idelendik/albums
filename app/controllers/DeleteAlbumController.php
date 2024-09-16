<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\interfaces\album\AlbumServiceInterface;

class DeleteAlbumController
{
    public static function index(): void
    {
        $album_id = $_POST['album_id'];

        AppContainer::instance()->get(AlbumServiceInterface::class)->delete_album($album_id);
    }
}