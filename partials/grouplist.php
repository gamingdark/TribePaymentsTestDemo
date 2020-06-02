<table class="groups">
    <caption>Group List</caption>
    <tr>
        <th>ID</th><th>Name</th><th>Description</th><th>Permissions</th>
    </tr>
    <?php
        if (empty($data)) {
            echo'<tr><td class="error" colspan="4">Insufficient permissions</td></tr>';
        } else {
            foreach ($data as $group) {
                echo sprintf(
                    '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
                    $group['id'],
                    $group['name'],
                    $group['description'],
                    implode(', ', $group['permissions'])
                );
            }
        }
    ?>
</table>
