<?php

use Albums\core\Database;
use Albums\core\Router;
use Albums\core\SessionStorage;
use Albums\interfaces\album\AlbumRepositoryInterface;
use Albums\interfaces\album\AlbumServiceInterface;
use Albums\interfaces\albumDetails\AlbumDetailsRepositoryInterface;
use Albums\interfaces\albumDetails\AlbumDetailsServiceInterface;
use Albums\interfaces\core\SessionStorageInterface;
use Albums\interfaces\DatabaseInterface;
use Albums\interfaces\image\ImageRepositoryInterface;
use Albums\interfaces\image\ImageServiceInterface;
use Albums\interfaces\imageDetails\ImageDetailsRepositoryInterface;
use Albums\interfaces\imageDetails\ImageDetailsServiceInterface;
use Albums\interfaces\RouterInterface;
use Albums\repositories\AlbumDetailsRepository;
use Albums\repositories\AlbumRepository;
use Albums\repositories\ImageDetailsRepository;
use Albums\repositories\ImageRepository;
use Albums\services\AlbumDetailsService;
use Albums\services\AlbumService;
use Albums\services\ImageDetailsService;
use Albums\services\ImageService;

return [
    AlbumServiceInterface::class => AlbumService::class,
    AlbumRepositoryInterface::class => AlbumRepository::class,

    AlbumDetailsServiceInterface::class => AlbumDetailsService::class,
    AlbumDetailsRepositoryInterface::class => AlbumDetailsRepository::class,

    ImageServiceInterface::class => ImageService::class,
    ImageRepositoryInterface::class => ImageRepository::class,

    ImageDetailsServiceInterface::class => ImageDetailsService::class,
    ImageDetailsRepositoryInterface::class => ImageDetailsRepository::class,

    RouterInterface::class => function () {
        return new Router(require(PATH_CONFIG . '/routes.php'));
    },

    DatabaseInterface::class => function () {
        return new Database($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    },

    SessionStorageInterface::class => function () {
        switch (session_status()) {
            case PHP_SESSION_DISABLED:
                throw new \Exception("Sessions are disabled");
            case PHP_SESSION_NONE:
                // configure the session by passing the needed options
                if (!session_start()) {
                    throw new \Exception("Failed to start session");
                }
        }

        return new SessionStorage($_SESSION);
    }
];