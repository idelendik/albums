<?php

declare(strict_types=1);

namespace Albums\interfaces\album;

interface AlbumRepositoryInterface
{
    public function get_album(string $album_id): array;

    public function get_albums(): array;

    public function create_album(string $album_name, string $album_description): false|string;

    public function delete_album(string $album_id): void;
}