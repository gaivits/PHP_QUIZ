<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
	?>
	<?php if(!isset($_SESSION['score'])) 
	{
		header("location:question.php?n".$_SESSION['score']);
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
			</div>
		</header>

		<main>
			<div class= "container">
			<h2>คุณทำแบบทดสอบสำเร็จ!</h2> 
				<p>คุณทำแบบทดสอบสำเร็จ คะแนนของคุณ</p>
				<p>คะแนน: <?php if (isset($_SESSION['score'])) 
				{
					echo $_SESSION['score']; 
				}; 
				?> </p>
		<a href="question.php?n" class="start">Start Again</a>
		<a href="home.php" class="start">Go Home</a>
		</div>
		</main>
		</body>
		</html>

		<?php 
		$score = $_SESSION['score'];
		$email = $_SESSION['email'];
		$query = "UPDATE users SET score = '$score' WHERE email = '$email'";
		$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
 		?>


<?php unset($_SESSION['score']); ?>
<?php unset($_SESSION['time_up']); ?>
<?php unset($_SESSION['start_time']); ?>
<?php }
else {
	header("location: home.php");
}
?>

