<?php

use Albums\controllers\AddCommentController;
use Albums\controllers\AlbumDetailsController;
use Albums\controllers\CreateAlbumController;
use Albums\controllers\CreateImageController;
use Albums\controllers\DeleteAlbumController;
use Albums\controllers\DeleteImageController;
use Albums\controllers\EditImageController;
use Albums\controllers\HomeController;
use Albums\controllers\ImageDetailsController;

return [
    '/' => ['GET', HomeController::class, 'index'],

    // TODO: use singular forms in URLs (albums instead of albums, image instead of image, etc.)
    '/albums/{id}' => ['GET', AlbumDetailsController::class, 'index'],
    '/albums/create' => ['POST', CreateAlbumController::class, 'index'], // TODO: combine with other Album controllers, rename index to 'create' for example
    '/albums' => ['DELETE', DeleteAlbumController::class, 'index'],

    '/albums/{id}/{imageId}' => ['GET', ImageDetailsController::class, 'index'],
    '/images/create' => ['POST', CreateImageController::class, 'index'], // TODO: change to /image
    '/images/edit' => ['UPDATE', EditImageController::class, 'index'], // TODO: change to /image
    '/images' => ['DELETE', DeleteImageController::class, 'index'],

    '/images/reaction' => ['POST', ImageDetailsController::class, 'reaction'], // TODO: change to /reaction

    '/comments' => ['POST', AddCommentController::class, 'index']
];

// TODO: Think of implementing v2 with renamed routes
//$v2 = [
//    '/' => ['GET', 'HomeController'],
//    '/albums' => ['POST', 'CreateAlbumController'],
//    '/albums/{id}' => ['GET', 'AlbumDetailsController'],
//    '/albums/{id}/{imageId}' => ['GET', 'ImageDetailsController'],
//    '/images' => ['POST', 'CreateImageController'],
//    '/images' => ['DELETE', 'DeleteImageController'],
//    '/images' => ['UPDATE', 'EditImageController'],
//];

//\Albums\core\App::router()::get('/', 'HomeController::index');
//\Albums\core\App::router()::post('Home', 'index');
