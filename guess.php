<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Saphareong</title>
</head>
<body>
	<h1>Welcome to my guessing game</h1>
	<?php 
	if($_GET["guess"] == null)
	{
		echo("Missing guess parameter");
	}
	if($_GET["guess"] == "fred")
	{
		echo("Your guess is not a number");
	}
	if($_GET["guess"] == 63)
	{
		echo("Your guess is too low");
	}
	if($_GET["guess"] == 65)
	{
		echo("Your guess is too high");
	}
	if($_GET["guess"] == 64)
	{
		echo("Congratulations - You are right");
	}
	if($_GET["guess"] == "")
	{
		echo("Your guess is too short");
	}
	?>
	
</body>
</html>