<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\core\View;
use Albums\interfaces\image\ImageServiceInterface;
use Albums\interfaces\imageDetails\ImageDetailsServiceInterface;

class ImageDetailsController
{
    public static function index(): void
    {
        $parsed_uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $album_id = $parsed_uri[2];
        $image_id = $parsed_uri[3];

        list($image, $comments, $message) = AppContainer::instance()->get(ImageDetailsServiceInterface::class)->prepare_data($album_id, $image_id);

        View::render('ImageDetails', [
            'image' => $image,
            'comments' => $comments,
            'message' => $message
        ]);
    }

    public static function reaction(): void
    {
        $parsed_uri = explode('/', parse_url($_SERVER["HTTP_REFERER"], PHP_URL_PATH));

        $image_id = $parsed_uri[3];

        $actions_to_apply = json_decode(file_get_contents("php://input"), true);

        AppContainer::instance()->get(ImageServiceInterface::class)->update_image_reactions($image_id, $actions_to_apply);
    }
}