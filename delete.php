<?php


$db = new mysqli('127.0.0.1','root','','php_quiz');
$qno = $_GET['qno']; 

$del = mysqli_query($db,"delete from questions where qno = '$qno'");

if($del)
{
    mysqli_close($db);
    header("location:allquestions.php");
    exit;	
}
else
{
    echo "Error deleting record";
}
?>