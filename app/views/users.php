<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
            </tr>
            <?php
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user['id']}</td>";
                echo "<td>{$user['firstname']}</td>";
                echo "<td>{$user['lastname']}</td>";
                echo "<td>{$user['email']}</td>";
                echo "<td>{$user['username']}</td>";
                echo "</tr>";
            }
            ?>
        </thead>
        <tbody>
        </tbody>
</body>
</html>