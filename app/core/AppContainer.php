<?php

declare(strict_types=1);

namespace Albums\core;

final class AppContainer
{
    private static ?self $instance = null;

    private array $dependencies;
    private array $dependency_instances = [];

    private function __construct(array $dependencies = [])
    {
        // Protects singleton from direct instantiation
        $this->dependencies = $dependencies;
    }

    private function __clone()
    {
        // Protects singleton from cloning
    }

    public function __wakeup()
    {
    }

    public static function instance(array $dependencies = []): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($dependencies);
        }

        return self::$instance;
    }

    public function has(string $id): bool
    {
        return isset($this->dependency_instances[$id]) || isset($this->dependencies[$id]);
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new \Exception("dependency '$id' not found");
        }

        return $this->dependency_instances[$id] ?? $this->resolve($id, $this->dependencies[$id]);
    }

    private function resolve(string $id, string|callable $value): mixed
    {
        if (is_callable($value)) {
            $this->dependency_instances[$id] = call_user_func($value);
            return $this->dependency_instances[$id];
        }

        $reflection_class = new \ReflectionClass($value);

        $constructor = $reflection_class->getConstructor();
        if (is_null($constructor)) {
            $this->dependency_instances[$id] = $reflection_class->newInstance();
            return $this->dependency_instances[$id];
        }

        $params = $constructor->getParameters();
        if (0 === count($params)) {
            $this->dependency_instances[$id] = $reflection_class->newInstance();
            return $this->dependency_instances[$id];
        }

        $args = [];

        foreach ($params as $param) {
            $type = $param->getType();

            if ($type->isBuiltin()) {
                $args[] = $type->getName();
            } else {
                $args[] = $this->get($type->getName());
            }
        }

        $this->dependency_instances[$id] = $reflection_class->newInstanceArgs($args);
        return $this->dependency_instances[$id];
    }
}


