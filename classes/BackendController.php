<?php

declare(strict_types = 1);

namespace Classes;

use Classes\Request;
use Classes\Repositories\UsersRepository;
use Classes\Repositories\PermissionsRepository;

class BackendController {
    public static function processRequest(): void {
        switch (Request::getForm()) {
            case 'login':
                self::processLogin();
                break;
            case 'logout':
                self::processLogout();
                break;
            default:
                self::error('Form not set');
        }
    }

    private static function error(string $message): void {
        http_response_code(500);
        echo $message;
        die;
    }

    private static function processLogout(): void {
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        unset($_SESSION['permissions']);
    }

    private static function processLogin(): void {
        $username = Request::getPost('username');
        $password = Request::getPost('password');

        if (empty($username) || empty($password)) {
            self::error('Both fields are required!');
        }

        $user = UsersRepository::getUser($username, $password);
        if (empty($user)) {
            self::error('Invalid credentials!');
        }

        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['permissions'] = PermissionsRepository::getPermissionsByUserId($_SESSION['user_id']);
    }
}
