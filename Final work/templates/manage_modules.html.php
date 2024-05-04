<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Manage Modules</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Manage Modules</h2>

        <!-- Add Module Form -->
        <form action="add_modules.php" method="post" class="mb-3">
            <label for="module_name">Module Name:</label>
            <input type="text" name="module_name" required>
            <button type="submit" class="btn btn-success">Add Module</button>
        </form>

        <!-- List of Modules Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Module Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modules as $module): ?>
                    <tr>
                        <td><?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($module['ModuleName'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <a href="edit_modules.php?id=<?= $module['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_modules.php?id=<?= $module['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
