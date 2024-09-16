<?php

declare(strict_types=1);

use Albums\core\App;
use Albums\core\AppContainer;

require dirname(__DIR__, 1) . "/app/bootstrap.php";

AppContainer::instance(require PATH_CONFIG . "/container-definitions.php");

AppContainer::instance()->get(\Albums\interfaces\core\SessionStorageInterface::class);

(new App())->run();