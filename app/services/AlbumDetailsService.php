<?php

declare(strict_types=1);

namespace Albums\services;

use Albums\core\AppContainer;
use Albums\interfaces\albumDetails\AlbumDetailsServiceInterface;
use Albums\interfaces\albumDetails\AlbumDetailsRepositoryInterface;
use Albums\interfaces\album\AlbumServiceInterface;

class AlbumDetailsService implements AlbumDetailsServiceInterface
{
    public function prepare_data(string $album_id): array
    {
        $albumInfo = AppContainer::instance()->get(AlbumServiceInterface::class)->get_album($album_id);
        if (0 === count($albumInfo)) {
            redirectTo("/");
        }

        $images = AppContainer::instance()->get(AlbumDetailsRepositoryInterface::class)->get_images_with_meta_by_album_id($album_id);

        return $images;
    }
}