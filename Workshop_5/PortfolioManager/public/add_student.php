<?php
include "../include/header.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = ucwords(trim($_POST['name']));
        $email = $_POST['email'];
        $skills = explode(",", $_POST['skills']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email");
        }

        $line = $name . "|" . $email . "|" . implode(",", $skills) . PHP_EOL;
        file_put_contents("../data/students.txt", $line, FILE_APPEND);

        $message = "Student saved successfully!";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Skills (comma separated): <input type="text" name="skills" required><br><br>
    <button type="submit">Save</button>
</form>

<p><?php echo $message; ?></p>

<?php include "../include/footer.php"; ?>
