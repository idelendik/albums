<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\interfaces\image\ImageServiceInterface;

class CreateImageController
{
    public static function index(): void
    {
        $album_id = $_POST['album_id'];
        $image_file = $_FILES['image-file'];

        $image_name = $_POST['image-name'];
        $image_description = $_POST['image-description'];

        /**
         * @var $imageService ImageServiceInterface
         */
        $imageService = AppContainer::instance()->get(ImageServiceInterface::class);
        $imageService->upload_image($album_id, $image_file, $image_name, $image_description);
    }
}