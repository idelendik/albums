<?php

declare(strict_types=1);

use Albums\interfaces\core\MigrationInterface;

class Migration_20240803_2 implements MigrationInterface
{
    public static function get_apply_query(): string
    {
        return "INSERT INTO `albums`.mig (name) VALUES ('testname_2')";
    }

    public static function get_rollback_query(): string
    {
        return "DELETE FROM mig WHERE name = 'testname_2'";
    }
}