<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/app/bootstrap.php';

(new Albums\core\MigrationManager())->rollback();
