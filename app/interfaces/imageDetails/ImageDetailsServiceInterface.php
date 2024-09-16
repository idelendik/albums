<?php

declare(strict_types=1);

namespace Albums\interfaces\imageDetails;

interface ImageDetailsServiceInterface
{
    public function prepare_data(string $album_id, string $image_id): array;
}