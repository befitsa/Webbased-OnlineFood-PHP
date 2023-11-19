<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDirectory = 'uploads/'; // Directory where the file will be saved
    $targetFile = $targetDirectory . basename($_FILES['image']['name']); // Full path of the target file

    // Check if the file is an actual image
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    if (!in_array($imageFileType, $allowedExtensions)) {
        echo 'Error: Only JPG, JPEG, PNG, and GIF files are allowed.';
    } elseif (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        echo 'Image uploaded successfully.';
    } else {
        echo 'Error uploading the image.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <input type="submit" value="Upload">
    </form>
</body>
</html>
