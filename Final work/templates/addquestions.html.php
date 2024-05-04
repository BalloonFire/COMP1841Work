<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add Questions</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Add New Question</h2>

        <form action="addquestions.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="QTitle" class="form-label">Question Title:</label>
                <input type="text" class="form-control" name="QTitle" required>
            </div>

            <div class="mb-3">
                <label for="QContent" class="form-label">Question Content:</label>
                <textarea class="form-control" name="QContent" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="fileToUpload" class="form-label">Choose Image:</label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" accept="image/*" onchange="previewImage()">
                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 200px; margin-top: 10px; display: none;">
            </div>

            <div class="mb-3">
                <label for="ModuleID" class="form-label">Select Module:</label>
                <select class="form-select" name="ModuleID" required>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= $module['id'] ?>"><?= htmlspecialchars($module['ModuleName'], ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function previewImage() {
            var fileInput = document.getElementById('fileToUpload');
            var imagePreview = document.getElementById('imagePreview');

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
</body>
</html>
