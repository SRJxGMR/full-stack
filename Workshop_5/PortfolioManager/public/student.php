<?php
include "../include/header.php";

$path = "../data/students.txt";

if (file_exists($path)) {
    $students = file($path);

    foreach ($students as $student) {
        list($name, $email, $skills) = explode("|", $student);
        echo "<strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong> $skills<br><hr>";
    }
} else {
    echo "No records found.";
}

include "../include/footer.php";
?>
