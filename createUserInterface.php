<!DOCTYPE html>
<html lang="en">
<?php
include_once("helpers/encryptionStuff.php");
include_once("helpers/functions.php");
include_once("helpers/queries.php");
?>

<head>
	<meta charset="UTF-8"><br>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Account</title>
	<link rel="stylesheet" href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css">
</head>

<body>
	<style>
		.bg-box {
			background-color: #FFFFF0, rgba(0, 0, 0, 0.2);
			padding: 20px;
			border-radius: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 1);
			font-size: 20px;
			color: white;
			margin: auto;

		}

		body {
			background-color: #7B7B7C;
			background-image: url("./assets/images/mountain.png");
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			

		}

		.title {
			color: #ff5349;
		}

		.btn-primary {
			border-radius: 20px;
			padding: 15px 30px;
			font-size: 18px;
			background-color: #007bff;
			border: none;
			opacity: 5;
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
	</style>

	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-10">
			<br>
				<h1 class="text-center mb-4 title">Create Account</h1>
				<div class="bg-box">
					<form method="post" action="">
						<div class="mb-3">
							<label for="inputName" class="form-label">Username</label><br>
							<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Enter your name" required>
						</div>
						<div class="mb-3">
							<label for="inputPassword" class="form-label" required>Password</label>
							<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Enter your password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$" required>
						
						</div>
						<div id="requirements"></div>
						
						<div class="mb-3">
							<label for="inputConfirmPassword" class="form-label" required>Confirm Password</label>
							<input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" placeholder="Confirm your password" required>
						</div>
						<div id="output"></div>
						<div class="mb-3">
							<label for="inputEmail" class="form-label" required>Email address</label>
							<input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter your email" required>
						</div>
						<div style="text-align: center;">
							<button name="submit" id="submit" type="submit" value="submit" class="btn btn-primary btn-block">Create Account</button>
						</div>
					</form>
					<?php
					if (isset($_POST['submit'])) {
						if($_POST['inputConfirmPassword'] == $_POST['inputPassword']){
							$user = $_POST['inputName'];
							// $pw = $_POST['inputPassword'];
							$pw = addslashes(encryptor($_POST['inputPassword']));
							$email = $_POST['inputEmail'];
							$result = InsertUser($user, $pw, $email);
							if ($result) {
								redirect('index.php');
							}
						}
					}
					?>
					<p class="text-center mt-3" style= color:white>Already have an account?</p>
					<div style="text-align: center;">
						<a href="logInInterface.php" class="btn btn-secondary btn-block">Log in</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/createUserInterface.js"></script>
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>