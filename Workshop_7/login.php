<?php
    require 'db.php';
    require 'preference.php';

    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['login'])) {
        $student_id = $_POST['student_id'];
        $password = $_POST['password'];
        $table_name = "students";

        $sql = "SELECT * FROM $table_name WHERE student_id = ?";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_id]);
            $student = $stmt->fetch();

        if ($student){
             $hashedPassword = $student['password_hash'];
             $isPasswordValid = password_verify($password, $hashedPassword);
            if ($isPasswordValid){
                echo "WELCOME ".$student['full_name'];
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $student['full_name'];
                header("Location:dashboard.php");
            }else{
                echo "Invalid password.";
            }   
        }else{
            echo "Invalid Students id";
        }

    }catch(PDOException $e){
        die("Database error:".$e->getMessage());
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
</head>
<body>
    <a href="register.php">Register</a>
    <h1>Login Page</h1>
    <form method="POST">
        <label for="student_id">Student ID</label>
        <input type="text" id="student_id" name="student_id" required><br>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>