<?php // Do not put any HTML above this line
    session_start();
if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

//$failure = false;  // If we have no POST data, WEEK 2 ONLY
// IF YOU ARE ON WEEK 2 COMMENT EVERYTHING I WRITE FOR WEEK 4 AND UNCOMMENT WEEK 2 AND REVERSE IF YOU ARE WEEK 4.

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['email']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) 
    {
        //$failure = "Email and password are required"; //this is week 2 course 3
        $_SESSION['error'] = "Email and password are required";
    }
    else if(strpos($_POST['email'], '@') === false)
    {
        //$failure = "Email must have an at-sign (@)"; //this is week 2 course 3
        $_SESSION['error'] = "Email must have an at-sign (@)";
    }
    else 
    {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) 
        {
            error_log("Login success ".$_POST['email']);
            $_SESSION['email'] = $_POST['email']; //this one is for week 4
            unset($_SESSION['error']);
            header("Location: view.php");
            //header("Location: autos.php?name=".urlencode($_POST['email'])); //this is week 2 course 3
            return;
        } 
        else 
        {
            //$failure = "Incorrect password";
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
        }
    }
    header("Location: Login.php");
    return;
}

// Fall through into the View
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bootstrap.php"; ?>
<title>Saphareong</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php
// Note triple not equals and think how badly double
// not equals would work here...
if ( isset($_SESSION['error']) ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>
<form method="POST">
<label for="nam">User Name</label>
<input type="text" name="email" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="password" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is the four character sound a cat
makes (all lower case) followed by 123. -->
</p>
</div>
</body>
