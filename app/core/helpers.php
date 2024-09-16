<?php

function requireComponentWithParams($componentPath, $args = [], $silent = false): ?string
{
    ob_start();

    extract($args);
    require $componentPath;

    $content = ob_get_clean();

    if ($silent) {
        return $content;
    } else {
        echo $content;
    }

    return null;
}

function redirectTo(string $url, int $status_code = 302): void
{
    http_response_code($status_code);

    header("Location: " . $url);

    exit();
}

function get_hashed_scripts_file_name()
{
    $dir_items = scandir(PATH_PUBLIC_ASSETS . '/scripts');

    $dir_items = array_filter($dir_items, function ($item) {
        return $item !== "." && $item !== "..";
    });

    $dir_items = array_values($dir_items);

    if (count($dir_items) === 0) {
        throw new Exception("script file doesn't exist");
    }

    if (count($dir_items) > 1) {
        throw new Exception("multiple script files exist");
    }

    return $dir_items[0];
}