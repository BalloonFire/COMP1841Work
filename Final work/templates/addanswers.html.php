<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Your Page Title</title>
</head>
<body>

<div class="container mt-5">
    <form action="addanswers.php?id=<?php echo $QuestionID; ?>" method="post">
        <div class="mb-3">
            <input type="hidden" name="QuestionID" value="<?= $QuestionID; ?>">
            <label for="AContent" class="form-label">Type your answer here:</label>
            <textarea class="form-control" name="AContent" rows="3"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit Answer</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>