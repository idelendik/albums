<?php

namespace Albums\core;

use Albums\interfaces\RouterInterface;

class Router implements RouterInterface
{
    private array $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;

        return $this;
    }

    private function applyRegexReplacementsToRoute(string $route): string
    {
        $replacements = [
            '{id}' => '([0-9]+)',
            '{imageId}' => '([0-9A-Za-z]+)',
        ];

        foreach ($replacements as $rep_key => $rep_value) {
            $route = str_replace($rep_key, $rep_value, $route);
        }

        return "#^{$route}$#";
    }

    public function route(): void
    {
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = array_filter(
            $this->routes,
            fn($route, $key) => preg_match(
                $this->applyRegexReplacementsToRoute($key),
                $url_path
            ), ARRAY_FILTER_USE_BOTH
        );

        if (count($route) === 0) {
            http_response_code(404);
            requireComponentWithParams(PATH_PAGES . '/404.php');
            exit();
        }

        [$method, $controller, $callback] = array_values($route)[0];

        $server_request_method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($server_request_method !== $method) {
            http_response_code(404);
            requireComponentWithParams(PATH_PAGES . '/404.php');
            exit();
        }

//        var_dump($controller);
//        dd("cont", $this->container->get($controller));
//        dd($this->container->get($controller));

        call_user_func_array([new $controller(), $callback], []);
    }
}
