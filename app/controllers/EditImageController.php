<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\core\HttpStatusCode\HttpStatusCode;
use Albums\core\Response;
use Albums\interfaces\image\ImageServiceInterface;

class EditImageController
{
    public static function index(): void
    {
        $image_name = $_POST['image-name'];
        $image_description = $_POST['image-description'];
        $image_id = $_POST['image-id'];

        /**
         * @var ImageServiceInterface $imageService
         */
        $imageService = AppContainer::instance()->get(ImageServiceInterface::class);

        $imageService->update_image($image_name, $image_description, $image_id);

        (new Response(
            success: true,
            statusCode: HttpStatusCode::SUCCESS::CREATED,
            body: ['message' => 'image details updated successfully']
        ))->send();

//      send another response if an error occurred
//        (new Response(
//            success: false,
//            statusCode: ???,
//            body: ['message' => 'an error occurred while updating image details. Please try again later']
//        ))->send();
    }
}