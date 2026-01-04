<?php
    require 'preference.php';
    
    session_start();
    if(isset($_SESSION['logged_in'])){
        echo "User is logged in!";
    }else{
        header("Location:login.php");
    };

    if (isset($_POST["logout"])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome <?=$_SESSION['username']?></h1>
    <form method="post">
        <button type="Post" name="logout">Log out</button>
    </form>
</body>
</html>