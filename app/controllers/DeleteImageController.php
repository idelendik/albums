<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\interfaces\image\ImageServiceInterface;

class DeleteImageController
{
    public static function index(): void
    {
        $image_id = $_POST['image_id'];

        AppContainer::instance()->get(ImageServiceInterface::class)->delete_image($image_id);
    }
}