<?php

declare(strict_types=1);

namespace Albums\services;

use Albums\core\AppContainer;
use Albums\interfaces\image\ImageRepositoryInterface;
use Albums\interfaces\imageDetails\ImageDetailsServiceInterface;

class ImageDetailsService implements ImageDetailsServiceInterface
{
    public function prepare_data(string $album_id, string $image_id): array
    {
        $image = AppContainer::instance()->get(ImageRepositoryInterface::class)->get_image_from_album_by_id($album_id, $image_id);
        if (empty($image)) {
            redirectTo('/albums/' . $album_id);
        }

        $comments = AppContainer::instance()
            ->get(ImageRepositoryInterface::class)
            ->get_comments($image_id);

        $message = count($comments) ? "" : "There are no comments yet";

        return [$image, $comments, $message];
    }
}