<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\core\Controller;
use Albums\core\View;
use Albums\interfaces\album\AlbumServiceInterface;

class HomeController extends Controller
{
    public function index(): void
    {
        /**
         * @var AlbumServiceInterface $albumsService
         */
        $albumsService = AppContainer::instance()->get(AlbumServiceInterface::class);

        $albums = $albumsService->get_albums();

        View::render('Home', [
                'albums' => $albums
            ]
        );
    }
}
