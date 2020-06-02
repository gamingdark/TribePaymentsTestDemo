<table class="permissions">
    <caption>Permissions List</caption>
    <tr>
        <th>ID</th><th>Name</th><th>Description</th>
    </tr>
    <?php
        if (empty($data)) {
            echo'<tr><td class="error" colspan="3">Insufficient permissions</td></tr>';
        } else {
            foreach ($data as $permission) {
                echo sprintf(
                    '<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
                    $permission['id'],
                    $permission['name'],
                    $permission['description']
                );
            }
        }
    ?>
</table>
