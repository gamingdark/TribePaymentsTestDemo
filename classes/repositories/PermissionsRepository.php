<?php

declare(strict_types = 1);

namespace Classes\Repositories;

use Classes\Abstracts\RepositoryAbstract;
use Classes\Db\SqlDriver;
use Classes\Repositories\GroupsRepository;

class PermissionsRepository extends RepositoryAbstract {
    const TABLE_NAME = '`permissions`';
    const PERMISSIONS_GROUPS_PIVOT_TABLE_NAME = '`permissions_groups_pivot`';

    public static function getPermissionsByUserId(int $userId): array {
        $groups = GroupsRepository::getGroupsByUserId($userId);
        $permissions = self::getPermissionsByGroups(array_keys($groups));
        return array_flip(array_column($permissions, 'permission_name'));
    }

    public static function getPermissionsByGroups(array $groups, bool $keyByGroup = false): array {
        $joinClause = sprintf(
            '%s JOIN %s ON %s.permission_id = %s.id',
            self::PERMISSIONS_GROUPS_PIVOT_TABLE_NAME,
            self::TABLE_NAME,
            self::PERMISSIONS_GROUPS_PIVOT_TABLE_NAME,
            self::TABLE_NAME
        );

        $fields = [
            self::PERMISSIONS_GROUPS_PIVOT_TABLE_NAME.'.group_id AS group_id',
            self::TABLE_NAME.'.id AS permission_id',
            self::TABLE_NAME.'.name AS permission_name'
        ];

        if (empty($groups)) {
            $condition = '1';
        } else {
            $condition = sprintf('%s.group_id IN (%s)', self::PERMISSIONS_GROUPS_PIVOT_TABLE_NAME, implode(', ', $groups));
        }

        $key = $keyByGroup ? 'group_id' : null;

        return SqlDriver::selectMany($joinClause, $condition, $fields, $key);
    }
}
