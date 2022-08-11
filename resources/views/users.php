<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de usuarios</title>
</head>
<body>
    <h1>Usuarios</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?= e($user) ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <h1>Neas</h1>
    <ul>
        <?php foreach ($neas as $nea): ?>
            <li>
                <?= e($nea) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>