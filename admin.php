<?php
session_start();
include "connection.php";
if (isset($_SESSION['admin'])) 
{
	header("location: adminhome.php");
}
if (isset($_POST['password']))  {
	$password = mysqli_real_escape_string($conn , $_POST['password']);
	$adminpass = '$2y$10$8WkSLFcoaqhJUJoqjg3K8eWixJWswsICf7FTxehKmx8hpmIKYWqju';
	if (password_verify($password , $adminpass)) 
	{
		$_SESSION['admin'] = "active";
		header("Location: adminhome.php");
	}
	else 
	{
		echo  "<script> alert('wrong password');</script>";
	}
}


?>



<html>
	<head>
		<title>PHP-Quiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	
	</head>

	<body>
		<header>
			<div class="container">
				<h1>PHP-Quiz</h1>
				<a href="index.php" class="start">หน้าแรก</a>

			</div>
		</header>

		<main>
		<div class="container">
				<h2>Enter Password</h2>
				<form method="POST" action="">
				<input type="password" name="password" placeholder="Password for Admin" required="" >
				<br> <br>
				<input type="submit" name="submit" value="Enter"> 

			</div>


		</main>

		<footer>
			<div class="container">
				
			</div>
		</footer>

	</body>
</html>