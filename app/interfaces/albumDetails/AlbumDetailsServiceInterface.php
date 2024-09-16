<?php

declare(strict_types=1);

namespace Albums\interfaces\albumDetails;

interface AlbumDetailsServiceInterface
{
    public function prepare_data(string $album_id): array;
}