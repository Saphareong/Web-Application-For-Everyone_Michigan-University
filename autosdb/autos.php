<?php

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

//NOT A PROFESSIONAL MOVE IT's JUST RECOMMENDED ACTION
require_once "pdo.php";


//validation field
$fail = false; //carrying message
$success = false; //this one does that too
if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) //this is when the form post below is submitted
{
    if(strlen($_POST['make']) < 1)
    {
        $fail = "Make is required";
    }
    else if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage']))
    {
        $fail = "Mileage and year must be numeric";

    }
    else
    {
        $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(array(
        ':mk' => $_POST['make'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'])
        );
        $success = "Record inserted";
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
    if(isset($_REQUEST['name']))
    {
        echo "<h1>Tracking Autos for ";
        echo htmlentities($_REQUEST['name']);
        echo "</h1>\n";
    }
    if($fail !== false)
    {
        echo('<p style="color:red;">'.htmlentities($fail)."</p>\n");
    }
    else if($success !== false)
    {
        echo('<p style="color:green;">'.htmlentities($success)."</p>\n");
    }
?>
<form method="post">
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
