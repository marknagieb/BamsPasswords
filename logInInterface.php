<?php

session_start();
include_once("helpers/encryptionStuff.php");
include_once("helpers/functions.php");
include_once("helpers/queries.php");
include_once("helpers/timer.php");
?>

<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<title>Account Log In</title>
	<link rel="stylesheet" href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css">
	<style>
		body {
			background-color: #7B7B7C;
			background-image: url("./assets/images/mountain.png");
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			

		}


		.bg-box {
			padding: 60px;
			border-radius: 30px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 2);
			font-size: 22px;
			background-color: #FFFFF0, rgba(0, 0, 0, 0.2);
			color: white;
			margin: auto;

		}

		body {
			background-color: #7B7B7C;
		}

		.title {
			color: #ff5349;
			font-family:"Optima", sans-serif;
		}

		.btn-primary {
			border-radius: 20px;
			padding: 15px 30px;
			font-size: 18px;
			background-color: #007bff;
			border: none;
		}

		.btn-primary:hover {
			background-color: #0069d9;
		}

		.btn-secondary {
			border-radius: 20px;
			padding: 15px 30px;
			font-size: 18px;
			background-color: #6c757d;
			border: none;
			text-align: center;
			background-color: #B80F0A;
		}

		.btn-secondary:hover {
			background-color: #800000;
		}

		.centerContent {
			text-align: center;
		}
	</style>
</head>

<body>
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-10">
				<br>
				<h1 class="text-center mb-4 title">Log In</h1>
				<div class="bg-box">
					<form method="post" action="">
						<div class="form-group">
							<label for="email">Username</label>
							<input type="text" name="inputName" class="form-control" id="text" placeholder="Enter username" required>
						</div>
						<br>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="inputPassword" class="form-control" id="password" placeholder="Password" required>
						</div>
						<br>
						<div class="centerContent">
							<button name="submit" id="submit" type="submit" value="submit" class="btn btn-primary btn-block">Log in</button>
						</div>
					</form>

					<?php
					if (isset($_SESSION["id"])) {
						redirect("displayPasswordInterface.php");
					}
					if (isset($_POST['submit'])) {
						$start = tStart();
						$user = $_POST['inputName'];
						$pw = addslashes(encryptor($_POST['inputPassword']));


						$result = SelectLogin($user);

						if (isset($result['User']) and $result['User'] == $user and $result['Password'] == $pw) {
							$time = tTotal($start);
							logTime("Users",$time,"Login",1);
							$_SESSION["id"] = encryptor($result["autoId"]);
							redirect("displayPasswordInterface.php");
						} else {
							$time = tTotal($start);
							logTime("Users",$time,"Login",0);
							redirect("logInInterface.php");
						}
					}
					?>
					<br><br>
					<hr>
					<p class="text-center mt-3">Don't have an account?</p>
					<div style="text-align: center;">
						<a href="createUserInterface.php" class="btn btn-secondary btn-block">Create an account</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>

</html>