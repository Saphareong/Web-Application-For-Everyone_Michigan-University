<?php

session_start();
// Demand a SESSION ----------- THIS IS WEEK 4 COURSE 3
if (!isset($_SESSION['email'])) {
    die('ACCESS DENIED');
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
        $stmt = $pdo->prepare('UPDATE autos SET `make` = :mk, `model` = :md, `year` = :yr, `mileage` = :mi
        WHERE `autos_id` = :ai');
        $stmt->execute(array(
        ':mk' => $_POST['make'],
        ':md' => $_POST['model'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'],
        ':ai' => $_POST['autos_id'])
        );
        $_SESSION['success'] = "edited";
        header("Location: view.php");
        return;
    }
    header("Location: edit.php?autos_id=".$_REQUEST['autos_id']);
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
<div class="container" style="margin-top: 100px;">
<?php 
    $autoid = $_REQUEST['autos_id'];
    $stmt = $pdo -> prepare("SELECT * FROM `autos` WHERE `autos_id` = :ai");
    $stmt -> execute(array(':ai' => $autoid));
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(isset($_SESSION['fail']))
    {
        echo('<p style="color:red;">'.htmlentities($_SESSION['fail'])."</p>\n");
        unset($_SESSION['fail']);
    }
?>
<form method="post">
<p>Make:
    <?php echo '<input type="text" name="make" size="60" value="', $row['make'], '"/>' ?>
</p>
<p>Model:
    <?php echo '<input type="text" name="model" value="', $row['model'], '"/>' ?>
    <?php echo '<input type="hidden" name="autos_id" value="', $row['autos_id'], '"/>' ?>
</p>
<p>Year:
    <?php echo '<input type="text" name="year" value="', $row['year'], '"/>' ?>
<p>Mileage:
    <?php echo '<input type="text" name="mileage" value="', $row['mileage'], '"/>' ?>
</p>
<input type="submit" value="Save">
<input type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>
</div>
</body>
</html>
