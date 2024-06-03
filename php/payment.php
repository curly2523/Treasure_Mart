<?php

include_once 'config.php';
session_start();

if(isset($_POST["submit"])) {

	$cardno=$_POST['cardnumber'];
	$name=$_POST['cardname'];
	$date=$_POST['date'];
	$cvv=$_POST['securitykey'];

	$sql = "INSERT INTO payment (cardno , name , date , cvv, user)
	VALUES ('$cardno','$name','$date','$cvv', '" . $_SESSION['id'] . "')";

	if ($con->query($sql) === TRUE) 
	{
		header("Location: ../php/MyProfile.php");
	}
	else
	{
		echo "SQL Error";
	}
}
?>