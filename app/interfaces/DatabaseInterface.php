<?php

declare(strict_types=1);

namespace Albums\interfaces;

interface DatabaseInterface
{
    public function query(string $query, array $args = []): \PDOStatement;

    public function lastInsertId(): false|string;

    public function inTransaction(): bool;

    public function beginTransaction(): bool;

    public function rollBack(): bool;

    public function commit(): bool;
}
