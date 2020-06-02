<table class="users">
    <caption>User List</caption>
    <tr>
        <th>ID</th><th>Username</th><th>Groups</th>
    </tr>
    <?php
        if (empty($data)) {
            echo'<tr><td class="error" colspan="3">Insufficient permissions</td></tr>';
        } else {
            foreach ($data as $user) {
                echo sprintf(
                    '<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
                    $user['id'],
                    $user['username'],
                    implode(', ', $user['groups'])
                );
            }
        }
    ?>
</table>
