<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Messages</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Admin Messages</h2>

        <?php if (!empty($adminMessages)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Message ID</th>
                        <th>Message Content</th>
                        <th>User Sent</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adminMessages as $message): ?>
                        <tr>
                            <td><?= htmlspecialchars($message['MessageID'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($message['MContent'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($message['Username'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($message['MDate'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No admin messages available.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
