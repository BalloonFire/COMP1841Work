<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            color: #495057; /* Dark gray text */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #343a40; /* Dark background for navigation */
            overflow: hidden;
        }

        nav li {
            float: left;
        }

        nav a {
            display: block;
            color: #ffffff; /* White text for navigation links */
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #495057; /* Darker background on hover */
        }

        .username-container {
            display: flex;
            align-items: center;
        }

    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="../admin/admin.php">Home</a></li>
            <li><a href="../admin/questions.php">Questions List</a></li>
            <li><a href="../admin/addquestions.php">Add new question</a></li>
            <li><a href="../admin/manage_modules.php">Managing Modules</a></li>
            <li><a href="../admin/user_table.php">Managing Users</a></li>
            <li style="float: right;"><a href="../admin/logout.php">Logout</a></li>
            <li style="float: right;"><a href="../admin/profile.php">Profile</a></li>
            <li style="float: right;"><a href="../admin/viewadminmessages.php">Check Messages From Users</a></li>
            <li style="float: right;"><a href="../index.php">Public Site</a></li>
        </ul>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>