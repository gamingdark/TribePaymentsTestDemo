<?php

declare(strict_types = 1);

namespace Classes;

use Exception;

class Config {
    private static array $cache = [];

    public static function set(string $key, $value): void {
        self::$cache[$key] = $value;
    }

    public static function get(string $key) {
        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        throw new Exception(sprintf('Config: requested key "%s" not set', $key));
    }
}
