<?php

declare(strict_types = 1);

namespace Classes\Db;

use Classes\Config;
use mysqli;

class SqlDriver {
    const SELECT_SYNTAX = 'SELECT %s FROM %s WHERE %s';


    private static ?mysqli $connection = null;

    private static function connection() {
        if (self::$connection === null) {
            self::$connection = new mysqli(
                Config::get('db_host'),
                Config::get('db_username'),
                Config::get('db_password'),
                Config::get('db_database')
            );
        }

        return self::$connection;
    }

    public static function selectMany(string $table, string $condition = '1', ?array $fields = ['*'], ?string $keyBy = null): array {
        $preparedQuery = sprintf(self::SELECT_SYNTAX, implode(', ', $fields), $table, $condition);
        $result = self::connection()->query($preparedQuery);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            if (empty($row[$keyBy])) {
                $data[] = $row;
            } else {
                $data[$row[$keyBy]][] = $row;
            }
        }

        return $data;
    }

    public static function selectFirst(string $table, string $condition = '1', ?array $fields = ['*']): ?array {
        $preparedQuery = sprintf(self::SELECT_SYNTAX, implode(', ', $fields), $table, $condition);
        $result = self::connection()->query($preparedQuery);

        return $result->fetch_assoc();
    }
}
