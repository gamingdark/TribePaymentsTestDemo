<?php

declare(strict_types = 1);

namespace Classes;

class Request {
    public static function getPage(): ?string {
        return $_GET['page'] ?? null;
    }

    public static function getForm(): ?string {
        return $_POST['form'] ?? null;
    }

    public static function getPost(string $field): ?string {
        return $_POST[$field] ?? null;
    }
}
