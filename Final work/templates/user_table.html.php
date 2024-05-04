<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User Management</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>User Management (Total: <?= $allUsers ?> Users)</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                    <th>Admin Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['Username'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['Email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        <td>
                            <?php if ($user['admin'] == 'Y'): ?>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display: inline;">
                                    <input type="hidden" name="revoke_admin_id" value="<?= $user['id'] ?>">
                                    <button type="submit" name="revoke_admin" class="btn btn-warning btn-sm">Revoke Admin</button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display: inline;">
                                    <input type="hidden" name="assign_admin_id" value="<?= $user['id'] ?>">
                                    <button type="submit" name="assign_admin" class="btn btn-success btn-sm">Assign Admin</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
