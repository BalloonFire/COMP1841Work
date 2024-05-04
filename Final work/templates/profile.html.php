<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User Profile</title>
    <style>
        .container {
            max-width: 600px;
        }

        .profile-box {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-box h1,
        .profile-box h3 {
            margin-bottom: 15px;
        }

        .logout-btn {
            margin-top: 10px;
        }

        .logout-btn,
        .edit-btn {
            width: 100%;
        }

        .edit-btn {
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="profile-box">
        <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
        <h3>User ID: <?= htmlspecialchars($userDetails['id'], ENT_QUOTES, 'UTF-8') ?></h3>
        <h3>Username: <?= htmlspecialchars($userDetails['Username'], ENT_QUOTES, 'UTF-8') ?></h3>
        <h3>Email: <?= htmlspecialchars($userDetails['Email'], ENT_QUOTES, 'UTF-8') ?></h3>
    </div>
    <a href="editprofile.php" class="btn btn-primary edit-btn">Edit Profile</a>
    <a href="deleteprofile.php" class="btn btn-danger logout-btn">Delete Profile</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
