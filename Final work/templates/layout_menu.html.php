<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        header {
            background-color: #007bff; /* Vibrant blue header */
            color: #ffffff; /* White text for header */
            text-align: center;
            padding: 10px;
        }

        main {
            padding-block-end: 50px; 
        }

        footer {
            background-color: #343a40; /* Dark background for footer */
            color: #ffffff; /* White text for footer */
            text-align: center;
            padding: 0px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

    </style>
</head>
<body>
    <header>
        <h1>Student Question Forum</h1>
    </header>
    <main>
        <?=$output?>
    </main>
    <footer>&copy; Student Question Forum 2023</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>