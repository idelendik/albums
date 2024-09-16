<?php

declare(strict_types=1);

namespace Albums\interfaces\core;

interface MigrationInterface
{
    static function get_apply_query(): string;

    static function get_rollback_query(): string;
}