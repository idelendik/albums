<?php

declare(strict_types=1);

namespace Albums\interfaces\albumDetails;

interface AlbumDetailsRepositoryInterface
{
    public function get_images_with_meta_by_album_id(string $album_id): array;
}