<?php

declare(strict_types = 1);

namespace Classes\Abstracts;

use Classes\Db\SqlDriver;

abstract class RepositoryAbstract {
    public static function getAll(): array {
        return SqlDriver::selectMany(static::TABLE_NAME);
    }
}
