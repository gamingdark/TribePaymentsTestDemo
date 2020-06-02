<?php

declare(strict_types = 1);

namespace Classes\Repositories;

use Classes\Abstracts\RepositoryAbstract;
use Classes\Db\SqlDriver;
use Classes\Repositories\GroupsRepository;

class UsersRepository extends RepositoryAbstract {
    const TABLE_NAME = '`users`';
    const USERS_GROUPS_PIVOT_TABLE_NAME = '`users_groups_pivot`';

    public static function getUser(string $username, string $password): ?array {
        $condition = sprintf('`username` = "%s" AND `password` = "%s"', $username, md5($password));
        return SqlDriver::selectFirst(self::TABLE_NAME, $condition);
    }

    public static function getUsersAndGroups(): array {
        $users = self::getAll();
        $pivotedData = GroupsRepository::getGroupsByUsers(array_column($users, 'id'));

        foreach ($users as $index => $user) {
            $groups = [];
            foreach ($pivotedData[$user['id']] as $group) {
                $groups[] = $group['group_name'];
            }

            $users[$index]['groups'] = $groups;
        }

        return $users;
    }
}
