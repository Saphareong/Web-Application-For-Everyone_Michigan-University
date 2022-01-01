<?php
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'fred', 'zap');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//magical of php is if you close the code above require_once wont run
//well i have not documenting clearly about this so duh.