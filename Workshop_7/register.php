<?php
require 'db.php';
require 'preference.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add_student'])) {
    $student_id = $_POST['student_id'] ?? "";
    $name = $_POST['name'] ?? "";
    $password = $_POST['password'] ?? "";
    $table_name = "students";

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO $table_name (student_id, full_name, password_hash) VALUES (?,?,?)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_id, $name, $hashedPassword]);
        echo "Student added successfully.";
        header("Refresh:1,url=login.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration</title>
</head>
<body>
    <a href="login.php">login</a>
    <h1>User Registration</h1>

    <form method="POST">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="add_student">Submit</button>
    </form>

</body>
</html>