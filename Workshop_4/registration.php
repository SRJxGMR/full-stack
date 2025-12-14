<?php
$name = $email = '';
$nameErr = $emailErr = $passwordErr = $cPasswordErr = '';
$successMessage = '';

function validatePassword($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one number.";
    }
    if (!preg_match('/[\W]/', $password)) {
        return "Password must contain at least one special character.";
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $cPassword = $_POST['cpassword'] ?? '';

    $isValid = true;

    // Name validation
    if (empty($name)) {
        $nameErr = "Name is required.";
        $isValid = false;
    }

    // Email validation
    if (empty($email)) {
        $emailErr = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
        $isValid = false;
    }

    // Password validation
    $passwordCheck = validatePassword($password);
    if ($passwordCheck !== true) {
        $passwordErr = $passwordCheck;
        $isValid = false;
    }

    // Confirm password validation
    if (empty($cPassword)) {
        $cPasswordErr = "Please confirm your password.";
        $isValid = false;
    } elseif ($password !== $cPassword) {
        $cPasswordErr = "Passwords do not match.";
        $isValid = false;
    }

    // If everything is valid
    if ($isValid) {
        $jsonFile = "users.json";

        // Ensure JSON file exists
        if (!file_exists($jsonFile)) {
            file_put_contents($jsonFile, json_encode([]));
        }

        // Read and decode users.json
        $users = json_decode(file_get_contents($jsonFile), true);

        // Check if email already exists
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $emailErr = "Email already registered.";
                $isValid = false;
                break;
            }
        }

        if ($isValid) {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Create user array
            $newUser = [
                "name" => $name,
                "email" => $email,
                "password" => $hashedPassword
            ];

            // Add user to array
            $users[] = $newUser;

            // Save back to JSON
            file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT));

            $successMessage = "Registration successful!";
            $name = $email = '';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Registration Form</h2>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" value=" <?php echo htmlspecialchars($name); ?>">
    <span class="error"><?php echo $nameErr; ?></span><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <span class="error"><?php echo $emailErr; ?></span><br><br>

    <label>Password:</label><br>
    <input type="password" name="password">
    <span class="error"><?php echo $passwordErr; ?></span><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="cpassword">
    <span class="error"><?php echo $cPasswordErr; ?></span><br><br>

    <button type="submit">Register</button>
</form>

<p class="success"><?php echo $successMessage; ?></p>

</body>
</html>
