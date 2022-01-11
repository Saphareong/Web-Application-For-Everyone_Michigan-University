<?php
/* WEEK 2
// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Not logged in');
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
*/
session_start();
// Demand a SESSION ----------- THIS IS WEEK 4 COURSE 3
if (!isset($_SESSION['email'])) {
    die('Not logged in');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    unset($_SESSION['email']);
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
    if(isset($_SESSION['email']))
    {
        echo "<h1>Tracking Autos for ";
        echo htmlentities($_SESSION['email']);
        echo "</h1>\n";
    }
    if(isset($_SESSION['success']))
    {
        echo('<p style="color:green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    }?>
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
<a href="logout.php">Logout | </a><a href="add.php">Add New</a>
</div>
</body>
</html>
