<?php

declare(strict_types=1);

use Albums\interfaces\core\MigrationInterface;

class Migration_20240803_1 implements MigrationInterface
{
    public static function get_apply_query(): string
    {
        return "
        CREATE TABLE IF NOT EXISTS `albums`.`mig` (
            `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE = InnoDB;";
    }

    public static function get_rollback_query(): string
    {
        return "DROP TABLE `albums`.mig";
    }
}