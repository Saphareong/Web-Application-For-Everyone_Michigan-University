<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Saphareong</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1>Welcome to the Automobiles Database</h1>
    <p><strong>Note:</strong> This sample code is only
    partially done and serves only as a starting point for the assignment.
    </p>
    <?php
        if(isset($_SESSION['success']))
        {
            echo "<p>", htmlentities($_SESSION['success']), "</p>";
            unset($_SESSION['success']);
        }
    ?>
    <p>
    <a href="login.php">Please log in</a>
    </p>
    <p>
    Attempt to go to 
    <a href="autos.php">autos.php</a> without logging in - it should fail with an error message.
    <p>
    <p>
    Attempt to go to 
    <a href="view.php">view.php</a> without logging in - it should fail with an error message.
    <p>
    <a href="https://github.com/Saphareong/Web-Application-For-Everyone_Michigan-University"
     target="_blank">Source Code for this Application</a>
    </p>
</div>
</body>

