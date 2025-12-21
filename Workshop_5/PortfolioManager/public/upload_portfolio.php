<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileupload'])) {

    try {
        $file = $_FILES['fileupload'];

        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileTmp  = $file['tmp_name'];
        $fileError = $file['error'];

        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        $maxSize = 3 * 1024 * 1024;

        if ($fileError !== 0) {
            throw new Exception("File upload error");
        }

        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Only PDF, JPG, PNG files are allowed");
        }

        if ($fileSize > $maxSize) {
            throw new Exception("File size must be less than 3MB");
        }

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = time() . "_" . rand(1000,9999) . "." . $extension;

        if (!move_uploaded_file($fileTmp, "../uploads/" . $newName)) {
            throw new Exception("Failed to move uploaded file");
        }

        $message = "Portfolio uploaded successfully!";

    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Portfolio</title>
</head>
<body>

<div class="glass-box">
    <h3>Upload Portfolio</h3>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="fileupload" accept=".pdf,.jpg,.png" required>
        <button type="submit">Upload Portfolio</button>
    </form>

    <p><?php echo $message; ?></p>
</div>

</body>
</html>
