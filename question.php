<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
	
	if (isset($_GET['n']) && is_numeric($_GET['n'])) 
	{
	        $qno = $_GET['n'];
	        if ($qno == 1) {
	        	$_SESSION['quiz'] = 1;
	        }
	        }
	        else 
	        {
	        	header('location: question.php?n=1'.$_SESSION['quiz']);
	        } 
	        if (isset($_SESSION['quiz']) && $_SESSION['quiz'] == $qno) 
	        {
			
			$query = "SELECT * FROM questions ORDER BY RAND()" ;
			$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
			
			if (mysqli_num_rows($run) > 0) 
			{

				$row = mysqli_fetch_array($run);

				$qid = $row['qid'];

				$qno = $row['qno'];
				$question = $row['question'];
				$ans1 = $row['ans1'];
                 $ans2 = $row['ans2'];
                 $ans3 = $row['ans3'];
                 $ans4 = $row['ans4'];
                 $correct_answer = $row['correct_answer'];
                 $question = $row['question'];
                 $_SESSION['quiz'] = $qno;
                 $checkqsn = "SELECT DISTINCT * FROM questions " ;
                 $runcheck = mysqli_query($conn , $checkqsn) or die(mysqli_error($conn));
                 $countqsn = mysqli_num_rows($runcheck);
                 $time = time();
                 $_SESSION['start_time'] = $time;
                 $allowed_time = $countqsn*0.05;
                 $_SESSION['time_up'] = $_SESSION['start_time'] + ($allowed_time * 60) ;
                 

			}
			else 
			{
				echo "<script> alert('something went wrong');
			window.location.href = 'home.php'; </script> " ;
			}
		}
		else 
		{
		echo "<script> alert('error');
			window.location.href = 'home.php'; </script> " ;
	}
?>
<?php 
$total = "SELECT * FROM questions " ;
$totalqn = mysqli_num_rows($run);
$run = mysqli_query($conn , $total) or die(mysqli_error($conn));

?>
<html>
	<head>
		<title>PHP-Quiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<a href="https://tonnygaric.com/blog/create-a-seconds-countdown-in-6-lines-of-javascript" target="_blank"></a>
	</head>

	<body>
		<header>
			<div class="container">
				<h1>PHP-Quiz</h1>
			</div>
		</header>

		<main>
			
			<div class= "container">
				<div class= "container">
				<div class= "current">Question <?php echo $totalqn-1; ?></div>
				<p class="question"><?php echo $question; ?></p>
				<form method="post" action="process.php">
					<ul class="choices">
					   <li><input name="choice" type="radio" value="a" required=""><?php echo $ans1; ?></li>
					   <li><input name="choice" type="radio" value="b" required=""><?php echo $ans2; ?></li>
					   <li><input name="choice" type="radio" value="c" required=""><?php echo $ans3; ?></li>
					   <li><input name="choice" type="radio" value="d" required=""><?php echo $ans4; ?></li>
					 
					</ul>
					<input type="submit" value="Submit"> 
					<input type="hidden" name="number" value="<?php echo $qno;?>">
					<br>
					<br>
					<a href="results.php" class="start">Stop Quiz</a>
				</form>
			</div>
			<center>

				<h2>เหลือเวลาอีก : <div id="countdown"><?php echo 90; ?></div>วินาที</center></h2>
				
		</main>
		
</body>
<script type="text/javascript">
var seconds = document.getElementById("countdown").textContent;
var countdown = setInterval(function() 
	{
    seconds--;
    document.getElementById("countdown").textContent = seconds;
    if (seconds == 0)
		location.reload('https://127.0.0.1/xampp/question.php?n');
}, <?php echo $totalqn*60; ?>);
</script>
</html>

<?php } 
else 
{
	header("location: home.php");
}

?>