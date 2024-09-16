<?php

declare(strict_types=1);

namespace Albums\core;

use Albums\interfaces\RouterInterface;

class App
{
    public function run(): void
    {
        /**
         * @var RouterInterface $router
         */
        $router = AppContainer::instance()->get(RouterInterface::class);

        $router->route();
    }
}
