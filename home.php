<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
$query = "SELECT * FROM questions";
$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
$total = mysqli_num_rows($run);
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
			<div class="container">
				<h2>Welcome to PHP Quiz !</h2>
				<p>This is just a simple quiz game to test your knowledge!</p>
				<ul>
				    <li><strong>Number of questions: </strong><?php echo $total; ?></li>
				    <li><strong>Type: </strong>Multiple Choice</li>
				    <li>Estimate time : <?php echo $total*1.5 ; ?> นาที</li>
				     <li><strong>Score: </strong>   &nbsp; ข้อละ 1 คะแนน</li>
				</ul>
				<a href="question.php?n=" class="start">Start Quiz</a>
				<a href="exit.php" class="add">Exit</a>

			</div>
		</main>

		<footer>
			<div class="container">
				
			</div>
		</footer>

	</body>
</html>
<?php unset($_SESSION['score']); ?>
<?php }
else 
{
	header("location:index.php");
}
?>