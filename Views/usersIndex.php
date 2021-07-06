<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <a href="users/create" class="button">Create user</a>
    <a href="/logout" class="button button-exit">Exit</a>
    <table>
    <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Age</th>
    </tr>
    <?php foreach($users as $user): ?>
    <tr>
        <td><?=$user->name;?></td>
        <td><?=$user->surname;?></td>
        <td><?=$user->age;?></td>
    </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>