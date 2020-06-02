<?php

declare(strict_types = 1);

namespace Classes;

use Classes\Repositories\UsersRepository;
use Classes\Repositories\GroupsRepository;
use Classes\Repositories\PermissionsRepository;

class FrontendController {
    private static function getPartialPath(string $name): string {
        return sprintf('%s/../partials/%s.php', __DIR__, $name);
    }

    // not the best solution, just quick replacement for templating
    private static function renderPartial(string $name, array $data = null): string {
        ob_start();
        include self::getPartialPath($name);
        return ob_get_clean();
    }

    public static function displayLogin(): string {
        return self::renderPartial('login');
    }

    public static function displayPage(): string {
        $users = isset($_SESSION['permissions']['user_list']) ? UsersRepository::getUsersAndGroups() : null;
        $groups = isset($_SESSION['permissions']['group_list']) ? GroupsRepository::getGroupsAndPermissions() : null;
        $permissions = isset($_SESSION['permissions']['permission_list']) ? PermissionsRepository::getAll() : null;

        $content = self::renderPartial('logout');
        $content .= self::renderPartial('userlist', $users);
        $content .= self::renderPartial('grouplist', $groups);
        $content .= self::renderPartial('permissionlist', $permissions);

        return $content;
    }
}
