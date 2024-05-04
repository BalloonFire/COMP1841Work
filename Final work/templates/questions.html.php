<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Questions</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Questions (Total: <?= $totalQuestions ?? 0 ?>)</h2>

        <!-- Sort Options -->
        <div class="col-md-4">
            <label for="sortOrder" class="form-label">Sort Order:</label>
            <select class="form-select" id="sortOrder" name="sortOrder" onchange="submitForm()">
                <option value="newest" <?= ($_GET['sortOrder'] ?? '') == 'newest' ? 'selected' : '' ?>>Newest First</option>
                <option value="oldest" <?= ($_GET['sortOrder'] ?? '') == 'oldest' ? 'selected' : '' ?>>Oldest First</option>
                <option value="none" <?= ($_GET['sortOrder'] ?? '') == 'none' ? 'selected' : '' ?>>None</option>
            </select>
        </div>

        <script>
            function submitForm() {
                // Get the selected sort order
                var sortOrder = document.getElementById('sortOrder').value;

                // Get the current URL
                var currentUrl = window.location.href;

                // Parse the current URL to extract existing search parameters
                var url = new URL(currentUrl);

                // Update the existing search parameters with the selected sort order
                url.searchParams.set('sortOrder', sortOrder);

                // Redirect to the updated URL
                window.location.href = url.toString();
            }
        </script>

        <!-- Filter and Search Form -->
        <form class="mb-3" method="GET" action="questions.php">
            <div class="row">
                <div class="col-md-4">
                    <label for="moduleFilter" class="form-label">Filter by Module:</label>
                    <select class="form-select" id="moduleFilter" name="moduleFilter" onchange="this.form.submit()">
                        <option value="">All Modules</option>
                        <!-- Populate options dynamically from modules data -->
                        <?php if (isset($modules) && is_array($modules)): ?>
                            <?php foreach ($modules as $module): ?>
                                <option value="<?= $module['id'] ?>" <?= (isset($_GET['moduleFilter']) && $_GET['moduleFilter'] == $module['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($module['ModuleName'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="searchInput" class="form-label">Search:</label>
                    <input type="text" class="form-control" id="searchInput" name="searchInput" value="<?= $_GET['searchInput'] ?? '' ?>" placeholder="Enter keywords">
                </div>
                <input type="hidden" name="sortOrder" value="<?= $_GET['sortOrder'] ?? '' ?>">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary mt-4">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Module Name</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Username</th>
                    <th>Timestamp</th>
                    <th>Replies</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?= isset($question['ModuleName']) ? htmlspecialchars($question['ModuleName'], ENT_QUOTES, 'UTF-8') : '' ?></td>
                        <td><?= isset($question['QTitle']) ? htmlspecialchars($question['QTitle'], ENT_QUOTES, 'UTF-8') : '' ?></td>
                        <td><?= isset($question['QContent']) ? htmlspecialchars($question['QContent'], ENT_QUOTES, 'UTF-8') : '' ?></td>
                        <td>
                            <?php if (!empty($question['image'])): ?>
                                <img src="../<?= htmlspecialchars($question['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Question Image" style="width: 100px; height: 100px;">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (isset($question['Email'])): ?>
                                <div class="username-container">
                                    <a href="mailto:<?= htmlspecialchars($question['Email'], ENT_QUOTES, 'UTF-8' ) ?>">
                                        <?= isset($question['Username']) ? htmlspecialchars($question['Username'], ENT_QUOTES, 'UTF-8') : '' ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= isset($question['QDate']) ? htmlspecialchars($question['QDate'], ENT_QUOTES, 'UTF-8') : '' ?></td>
                        <td><?= getRepliesCount($pdo, $question['id']) ?></td>
                        <td>
                            <a href="answers.php?id=<?= isset($question['id']) ? $question['id'] : '' ?>" class="btn btn-info btn-sm">View Replies</a>
                            <a href="addanswers.php?id=<?= isset($question['id']) ? $question['id'] : '' ?>" class="btn btn-success btn-sm">Reply</a>
                            <?php if (isset($question['UserID']) && ($question['UserID'] == $_SESSION['id'] || $_SESSION['admin'] == "Y")): ?>
                                <a href="editquestions.php?id=<?= isset($question['id']) ? $question['id'] : '' ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="deletequestions.php" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= isset($question['id']) ? $question['id'] : '' ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="questions.php?page=<?= $currentPage - 1 ?><?php if (!empty($_GET['searchInput'])) echo '&searchInput=' . urlencode($_GET['searchInput']); if (!empty($_GET['moduleFilter'])) echo '&moduleFilter=' . urlencode($_GET['moduleFilter']); if (!empty($_GET['sortOrder'])) echo '&sortOrder=' . urlencode($_GET['sortOrder']); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                        <li class="page-item <?= ($currentPage == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="questions.php?page=<?= $page ?><?php if (!empty($_GET['searchInput'])) echo '&searchInput=' . urlencode($_GET['searchInput']); if (!empty($_GET['moduleFilter'])) echo '&moduleFilter=' . urlencode($_GET['moduleFilter']); if (!empty($_GET['sortOrder'])) echo '&sortOrder=' . urlencode($_GET['sortOrder']); ?>"><?= $page ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="questions.php?page=<?= $currentPage + 1 ?><?php if (!empty($_GET['searchInput'])) echo '&searchInput=' . urlencode($_GET['searchInput']); if (!empty($_GET['moduleFilter'])) echo '&moduleFilter=' . urlencode($_GET['moduleFilter']); if (!empty($_GET['sortOrder'])) echo '&sortOrder=' . urlencode($_GET['sortOrder']); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>