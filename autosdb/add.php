<?php

session_start();
// Demand a SESSION ----------- THIS IS WEEK 4 COURSE 3
if (!isset($_SESSION['email'])) {
    die('Not logged in');
}

// If the user requested logout go back to index.php
if ( isset($_GET['logout']) ) {
    unset($_SESSION['email']);
    header('Location: index.php');
    return;
}


//NOT A PROFESSIONAL MOVE IT's JUST RECOMMENDED ACTION
require_once "pdo.php";


if(isset($_GET['make']) && isset($_GET['year']) && isset($_GET['mileage'])) //this is when the form post below is submitted
{
    if(strlen($_GET['make']) < 1)
    {
        $_SESSION['fail'] = "Make is required";
    }
    else if(!is_numeric($_GET['year']) || !is_numeric($_GET['mileage']))
    {
        $_SESSION['fail'] = "Mileage and year must be numeric";
    }
    else
    {
        $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
        ':mk' => $_GET['make'],
        ':yr' => $_GET['year'],
        ':mi' => $_GET['mileage'])
        );
        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
    }
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
        unset($_SESSION['fail']);
    }
?>
<form method="get">
<p>Make:
<input type="text" name="make" size="60"/></p>
<p>Year:
<input type="text" name="year"/></p>
<p>Mileage:
<input type="text" name="mileage"/></p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>
<ul>
<?php
    $stmt = $pdo -> query("SELECT * FROM autos");
    while($row = $stmt -> fetch(PDO::FETCH_ASSOC))
    {
        echo "<li>";
        echo htmlentities($row['year']), " ", htmlentities($row['make']), " / " , htmlentities($row['mileage']);
        echo "</li>\n";
    }
?>
</ul>
</div>
</body>
</html>
