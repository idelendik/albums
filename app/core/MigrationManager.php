<?php

declare(strict_types=1);

namespace Albums\core;

class MigrationManager
{
    private ?\PDO $db = null;
    protected array $migration_files;

    public function __construct()
    {
        $this->migration_files = $this->get_migration_files(Path::$PATH_MIGRATIONS);

        $this->create_migrations_table();
    }

    protected function get_migration_files(string $path): array
    {
        return array_values(array_filter(scandir($path), function ($file_name) {
            return $file_name !== "." && $file_name !== "..";
        }));
    }

    private function create_migrations_table(): void
    {
        $this->init_db_connection();

        $this->db->query("
            CREATE TABLE IF NOT EXISTS `albums`.`migrations` (
                `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                `migration_id` VARCHAR(255) NOT NULL,
                `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE = InnoDB;
        ");
    }

    private function init_db_connection(): void
    {
        if (is_null($this->db)) {
            try {
                $this->db = new \PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
                    \PDO::ATTR_AUTOCOMMIT => 0
                ]);
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }

    public function apply(): void
    {
        ksort($this->migration_files);

        foreach ($this->migration_files as $file) {
            $file_name = explode(".php", $file)[0];

            require Path::$PATH_MIGRATIONS . '/' . $file;

            $this->apply_migration($file_name, call_user_func([$file_name, 'get_apply_query']));
        }
    }

    protected function apply_migration(string $migration_name, string $query): void
    {
        $is_migration_exist = $this->db->query("SELECT * FROM `albums`.migrations WHERE migration_id = '$migration_name'")->fetch();

        if (is_array($is_migration_exist)) {
            var_dump($migration_name . ' already applied. Skipped.');
            return;
        }

        if (!$this->db->inTransaction()) {
            $this->db->beginTransaction();
        }

        try {
            $this->db->query($query);

            $this->db->query("INSERT INTO `albums`.migrations (migration_id) VALUES ('$migration_name')");

            $this->db->commit();

            var_dump($migration_name . ' applied.');
        } catch (\Exception $e) {
            $this->db->rollBack();

            var_dump($e->getMessage());

            exit();
        }
    }

    public function rollback(): void
    {
        krsort($this->migration_files);

        foreach ($this->migration_files as $file) {
            $file_name = explode(".php", $file)[0];

            require Path::$PATH_MIGRATIONS . '/' . $file;

            $this->rollback_migration($file_name, call_user_func([$file_name, 'get_rollback_query']));
        }
    }

    private function rollback_migration(string $migration_name, string $query): void
    {
        $is_migration_exist = $this->db->query("SELECT * FROM `albums`.migrations WHERE migration_id = '$migration_name'")->fetch();

        if (!is_array($is_migration_exist)) {
            var_dump($migration_name . ' does not exist. Nothing to rollback.');
            return;
        }

        if (!$this->db->inTransaction()) {
            $this->db->beginTransaction();
        }

        try {
            $this->db->query($query);

            $this->db->query("DELETE FROM `albums`.migrations WHERE migration_id = '$migration_name'");

            $this->db->commit();

            var_dump($migration_name . ' rolled back.');
        } catch (\Exception $e) {
            $this->db->rollBack();

            var_dump($e->getMessage());

            exit();
        }
    }
}