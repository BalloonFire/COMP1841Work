<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit Profile</title>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Edit Profile</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form action="editprofile.php" method="post">
        <div class="mb-3">
            <label for="newUsername" class="form-label">Enter Your New Username:</label>
            <input type="text" class="form-control" name="newUsername" value="<?= htmlspecialchars($userDetails['Username'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>
        <div class="mb-3">
            <label for="newEmail" class="form-label">Enter Your New Email:</label>
            <input type="email" class="form-control" name="newEmail" value="<?= htmlspecialchars($userDetails['Email'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>
        <div class="mb-3">
            <label for="oldPassword" class="form-label">Enter Your Old Password:</label>
            <input type="password" class="form-control" name="oldPassword" required>
        </div>
        <div class="mb-3">
            <label for="newPassword" class="form-label">Enter Your New Password:</label>
            <input type="password" class="form-control" name="newPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
