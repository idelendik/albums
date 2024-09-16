<?php

declare(strict_types=1);

namespace Albums\core;

use Albums\interfaces\DatabaseInterface;
use PDO;
use PDOException;
use PDOStatement;

class Database implements DatabaseInterface
{
    private ?PDO $pdo;

    private ?PDOStatement $stmt;

    public function __construct(string $dsn, string $user, string $password)
    {
        try {
            $this->pdo = new PDO(
                $dsn,
                $user,
                $password,
                [
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function __destruct()
    {
        if (isset($this->pdo)) {
            $this->pdo = null;
        }

        if (isset($this->stmt)) {
            $this->stmt = null;
        }
    }

    public function query(string $query, array $args = []): PDOStatement
    {
        $this->stmt = $this->pdo->prepare($query);

        $this->stmt->execute($args);

        return $this->stmt;
    }

    public function lastInsertId(): false|string
    {
        return $this->pdo->lastInsertId();
    }

    public function inTransaction(): bool
    {
        return $this->pdo->inTransaction();
    }

    public function beginTransaction(): bool
    {
        return $this->pdo->beginTransaction();
    }

    public function rollBack(): bool
    {
        return $this->pdo->rollBack();
    }

    public function commit(): bool
    {
        return $this->pdo->commit();
    }
}
