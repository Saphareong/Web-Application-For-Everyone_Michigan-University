<?php session_start(); ?>
<?php require_once "bootstrap.php"; ?>
<?php
	require_once "pdo.php";
	if(isset($_POST['LessGo']))
	{
		$rowid = $_REQUEST['autos_id'];
		$stmt = $pdo->prepare('DELETE FROM autos WHERE autos_id = :ai');
        $stmt->execute(array(
        ':ai' => $rowid));
        $_SESSION['success'] = "deleted";
        header("Location: view.php");
        return;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Saphareong</title>
</head>
<body>
	<div class="container" style="margin-top: 20px;">
		Are you sure?<br/>
		<form method="post">
			<button name="LessGo">Delete </button>
		</form>
		<a href="view.php">Cancel</a>
	</div>
</body>
</html>