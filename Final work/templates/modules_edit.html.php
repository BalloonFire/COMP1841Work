<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit Module</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Edit Module</h2>

        <form action="edit_modules.php" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>">

            <div class="mb-3">
                <label for="ModuleName">Module Name:</label>
                <input type="text" name="ModuleName" value="<?= htmlspecialchars($module['ModuleName'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Update Module</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
