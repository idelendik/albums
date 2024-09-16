<?php

declare(strict_types=1);

namespace Albums\core;

class View
{
    public static function render(string $view, array $data): void
    {
        extract($data);

        require PATH_PAGES . '/' . $view . '.php';
    }
}
