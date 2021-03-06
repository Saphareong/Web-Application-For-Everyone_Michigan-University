<?php

session_start();
// Demand a SESSION ----------- THIS IS WEEK 4 COURSE 3
if (!isset($_SESSION['email'])) {
    die('ACCESS DENIED');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    unset($_SESSION['email']);
    header('Location: index.php');
    return;
}


//NOT A PROFESSIONAL MOVE IT's JUST RECOMMENDED ACTION
require_once "pdo.php";


if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model'])) //this is when the form post below is submitted
{
    if(strlen($_POST['make']) < 1 && strlen($_POST['year']) < 1 
        && strlen($_POST['mileage']) < 1 && strlen($_POST['model']) < 1)
    {
        $_SESSION['fail'] = "All fields are required";
    }
    else if(strlen($_POST['make']) < 1)
    {
        $_SESSION['fail'] = "Make is required";
    }
    else if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage']))
    {
        $_SESSION['fail'] = "Mileage and year must be numeric";
    }
    else
    {
        $stmt = $pdo->prepare('INSERT INTO autos
        (make, model, year, mileage) VALUES ( :mk, :md, :yr, :mi)');
        $stmt->execute(array(
        ':mk' => $_POST['make'],
        ':md' => $_POST['model'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'])
        );
        $_SESSION['success'] = "added";
        header("Location: view.php");
        return;
    }
    header("Location: add.php");
    return;
}



?>
<!DOCTYPE html>
<html>
<head>
<title>Saphareong</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<?php 
    if(isset($_SESSION['email']))
    {
        echo "<h1>Tracking Autos for ";
        echo htmlentities($_SESSION['email']);
        echo "</h1>\n";
    }
    if(isset($_SESSION['fail']))
    {
        echo('<p style="color:red;">'.htmlentities($_SESSION['fail'])."</p>\n");
        echo "<p>Endogenic</p>";
        unset($_SESSION['fail']);
    }
?>
<form method="post">
<p>Make:
<input type="text" name="make" size="60"/></p>
<p>Model:
    <input type="text" name="model"/></p>
<p>Year:
<input type="text" name="year"/></p>
<p>Mileage:
<input type="text" name="mileage"/></p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>
</div>
</body>
</html>
