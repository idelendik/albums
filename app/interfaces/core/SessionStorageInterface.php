<?php

declare(strict_types=1);

namespace Albums\interfaces\core;

interface SessionStorageInterface
{
    public function get(string $key, mixed $defaultValue = null): mixed;

    public function put(string $key, mixed $value = null): void;

    public function all(): array;

    public function has(string $key): bool;

    public function remove(string $key): void;

    public function clear(): void;
}