<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Answers List</title>
</head>
<body>

<div class="container mt-5">
    <?php if ($question): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <!-- Display Question Content -->
                    <div class="col-md-8">
                        <p class="card-text">
                            <strong>Question:</strong> <?= htmlspecialchars($question['QContent'], ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <p class="card-text">
                            (Question by <a href="mailto:<?= htmlspecialchars($question['QEmail'], ENT_QUOTES, 'UTF-8' ); ?>">
                            <?= htmlspecialchars($question['QUsername'], ENT_QUOTES, 'UTF-8'); ?></a>)
                        </p>
                        <p class="card-text">
                            (Timestamp: <?= htmlspecialchars($question['QDate'], ENT_QUOTES, 'UTF-8'); ?></a>)
                        </p>
                    </div>
                    <!-- Display Image Thumbnail -->
                    <?php if (!empty($question['image'])): ?>
                        <div class="col-md-4 text-center">
                            <img src="<?= htmlspecialchars($question['image'], ENT_QUOTES, 'UTF-8') ?>" class="img-thumbnail" style="max-width: 150px; max-height: 150px;" alt="Question Image">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Display answers -->
    <?php foreach ($answers as $answer): ?>
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">
                    <strong>Answer:</strong> <?= htmlspecialchars($answer['AContent'], ENT_QUOTES, 'UTF-8') ?>
                </p>
                <p class="card-text">
                    (Answer by <a href="mailto:<?= htmlspecialchars($answer['AEmail'], ENT_QUOTES, 'UTF-8' ); ?>">
                    <?= htmlspecialchars($answer['AUsername'], ENT_QUOTES, 'UTF-8'); ?></a>)
                </p>
                <p class="card-text">
                    (Timestamp: <?= htmlspecialchars($answer['ADate'], ENT_QUOTES, 'UTF-8'); ?></a>)
                </p>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Check if there are no answers for the displayed question -->
    <?php if (empty($answers)): ?>
        <div class="alert alert-info" role="alert">
            No replies yet. Be the first to answer!
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
