<?php
function uploadFile($file, $uploadDirectory) {
    if (empty($file["name"])) {
        return ""; // Return empty string if no file is provided
    }

    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return false; // Invalid image file
    }

    // Generate a unique filename to avoid overwriting existing files
    $uniqueFilename = uniqid() . "." . $imageFileType;

    // Set the target file path
    $targetFile = $uploadDirectory . $uniqueFilename;

    // Check file size
    if ($file["size"] > 10000000) {
        return false; // File size exceeds limit
    }

    // Allow only certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        return false; // Invalid file format
    }

    // Check if file is uploaded successfully
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Return the full relative path including the directory
        return $uploadDirectory . $uniqueFilename;
    } else {
        return false; // File upload failed
    }
}