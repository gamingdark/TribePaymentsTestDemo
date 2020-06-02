<?php

declare(strict_types = 1);

use Classes\Config;

function autoload(string $baseDirectory): void {
    $di = new RecursiveDirectoryIterator($baseDirectory, FilesystemIterator::SKIP_DOTS);
    foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
        require_once($filename);
    }
}

autoload('classes');

/**
 * DATABSE CONNECTION CONFIG
 */

Config::set('db_host', 'localhost:3308');
Config::set('db_database', 'tribe');
Config::set('db_username', 'root');
Config::set('db_password', '');
