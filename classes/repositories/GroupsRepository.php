<?php

declare(strict_types = 1);

namespace Classes\Repositories;

use Classes\Abstracts\RepositoryAbstract;
use Classes\Db\SqlDriver;
use Classes\Repositories\PermissionsRepository;

class GroupsRepository extends RepositoryAbstract {
    const TABLE_NAME = '`groups`';
    const USERS_GROUPS_PIVOT_TABLE_NAME = '`users_groups_pivot`';

    public static function getGroupsByUsers(?array $users): array {
        $joinClause = sprintf(
            '%s JOIN %s ON %s.group_id = %s.id',
            self::USERS_GROUPS_PIVOT_TABLE_NAME,
            self::TABLE_NAME,
            self::USERS_GROUPS_PIVOT_TABLE_NAME,
            self::TABLE_NAME
        );

        $fields = [
            self::USERS_GROUPS_PIVOT_TABLE_NAME.'.user_id AS user_id',
            self::TABLE_NAME.'.id AS group_id',
            self::TABLE_NAME.'.name AS group_name',
        ];

        if (empty($groups)) {
            $condition = '1';
        } else {
            $condition = sprintf('%s.user_id IN (%s)', self::USERS_GROUPS_PIVOT_TABLE_NAME, implode(', ', $users));
        }

        return SqlDriver::selectMany($joinClause, $condition, $fields, 'user_id');
    }

    public static function getGroupsAndPermissions(): array {
        $groups = self::getAll();
        $pivotedData = PermissionsRepository::getPermissionsByGroups(array_column($groups, 'id'), true);

        foreach ($groups as $index => $group) {
            $permissions = [];
            foreach ($pivotedData[$group['id']] as $permission) {
                $permissions[] = $permission['permission_name'];
            }

            $groups[$index]['permissions'] = $permissions;
        }

        return $groups;
    }

    public static function getGroupsByUserId(int $userId): array {
        return SqlDriver::selectMany(self::USERS_GROUPS_PIVOT_TABLE_NAME, 'user_id = '.$userId, ['group_id'], 'group_id');
    }
}
