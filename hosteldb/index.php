<?php

	error_reporting(0);
	session_start();
	session_destroy();

	if($_SESSION['message'])
	{
		$message=$_SESSION['message'];

		echo "<script type='text/javascript'>

		alert('message');
		 </script>";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
 label {
 display: inline-block;
 text-align: right;
 width: 100px;
 padding-top: 10px;
 padding-bottom: 10px;
 }
 .div_deg {
 background-color: lightpink;
 width: 400px;
 padding-top: 70px;
 padding-bottom: 70px;
 }
 </style>

	<meta charset="utf-8">
	<title>hostel management system</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
	<body>
		<nav>
			<label class="logo">VCET-Hostel
			</label>
<ul>
	<li><a href="">Home</a></li>
	<li><a href="">contact</a></li>
	<li><a href="">Admission</a>
	</li>
	<li><a href="login.php" class="btn btn-success">Login</a></li>

		</nav>

		<div class="section1">

			<img class="main_img" src="hostel9.jpg">
		</div>
		
				
				<center>
		<h1 class="adm">Admission Form</h1>

	</center>


	<div align="center" class="admission_form">

		<form action="data_check.php" method="POST">
			
		<div class="adm_int">
			<label class="label_text">Name</label>
			<input class="input_deg" type="text" name="name">
		</div>

		<div class="adm_int">
			<label class="label_text">Email</label>
			<input class="input_deg" type="text" name="email">
		</div>

		<div class="adm_int">
			<label class="label_text">Phone</label>
			<input class="input_deg" type="text" name="phone">
		</div>
		<div class="adm_int">
			<label class="label_text">Message</label>
			<textarea class="input_txt" name="message"></textarea>
		</div>

		<div class="adm_int" >
			
			<input class="btn btn-primary" id="submit" type="submit" value="apply" name="apply">
		</div>


		</form>
	</div>
			

	</body>

</html>










