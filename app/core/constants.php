<?php

declare(strict_types=1);

define('PATH_BASE', dirname(__DIR__, 2));
define('PATH_UPLOADS', PATH_BASE . '/storage/uploads');
define('PATH_ROOT', PATH_BASE . '/app');
define('PATH_CONFIG', PATH_ROOT . '/config');
define('PATH_CORE', PATH_ROOT . '/core');
define('PATH_CONTROLLERS', PATH_ROOT . '/controllers');
define('PATH_MODELS', PATH_ROOT . '/models');
define('PATH_VIEWS', PATH_ROOT . '/views');
define('PATH_COMPONENTS', PATH_VIEWS . '/components');
define('PATH_MODALS', PATH_VIEWS . '/modals');
define('PATH_PAGES', PATH_VIEWS . '/pages');
define('PATH_PARTIALS', PATH_VIEWS . '/partials');

define('PATH_ASSETS', '/assets');
define('PATH_IMAGES', PATH_ASSETS . '/images');
define('PATH_ICONS', PATH_IMAGES . '/icons');
define('PATH_SCRIPTS', PATH_ASSETS . '/scripts');
define('PATH_STYLES', PATH_ASSETS . '/styles');

define('PATH_MIGRATIONS', PATH_BASE . '/migrations');

define('PATH_PUBLIC', PATH_BASE . '/public');
define('PATH_PUBLIC_ASSETS', PATH_PUBLIC . '/assets');