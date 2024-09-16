<?php

declare(strict_types=1);

namespace Albums\core;

use Albums\interfaces\core\SessionStorageInterface;

class SessionStorage implements SessionStorageInterface
{
    private array $storage;

    public function __construct(array $storage)
    {
        $this->storage = &$storage;
    }

    public function put(string $key, mixed $value = null): void
    {
        $this->storage[$key] = $value;
    }

    public function has(string $key): bool
    {
        return isset($this->storage[$key]);
    }

    public function get(string $key, mixed $defaultValue = null): mixed
    {
        return $this->storage[$key] ?? $defaultValue;
    }

    public function remove(string $key): void
    {
        unset($this->storage[$key]);
    }

    public function all(): array
    {
        return $this->storage;
    }

    public function clear(): void
    {
        foreach (array_keys($this->storage) as $key) {
            unset($this->storage[$key]);
        }
    }
}