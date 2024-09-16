<?php

declare(strict_types=1);

namespace Albums\repositories;

use Albums\core\AppContainer;
use Albums\interfaces\albumDetails\AlbumDetailsRepositoryInterface;
use Albums\interfaces\DatabaseInterface;

class AlbumDetailsRepository implements AlbumDetailsRepositoryInterface
{
    public function get_images_with_meta_by_album_id(string $album_id): array
    {
        try {
            $images = AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query('SELECT images.id, name, description, album_id, image_link_full, image_link_thumbnail, images_meta.likes_count, images_meta.dislikes_count, ( SELECT COUNT(*) FROM comments WHERE image_id = images.id ) as comments_count FROM `images` LEFT OUTER JOIN images_meta ON images_meta.image_id = `images`.`id` WHERE album_id = :album_id', [
                    'album_id' => $album_id,
                ])->fetchAll();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());

            return [];
        }

        if (!is_array($images)) {
            var_dump("An error occurred while getting images");

            return [];
        }

        return $images;
    }
}