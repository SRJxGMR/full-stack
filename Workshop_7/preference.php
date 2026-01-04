<?php
if (isset($_POST["theme"])) {
    $theme = $_POST["theme"];
    setcookie("theme", $theme, time() + (86400 * 30), "/");
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit();
}

$theme = $_COOKIE["theme"] ?? "dark";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student login page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/<?php echo $theme; ?>.css">

</head>
<body>
    <form method="post">
    <button name="theme" value="light">Light Mode</button>
    <button name="theme" value="dark">Dark Mode</button>
</form>
</body>
</html>