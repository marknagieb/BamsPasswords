<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login or Create an Account</title>
	<link rel="stylesheet" href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css">
	<style>
		body {
			background-color: #900609;
			background-image: url("assets/images/mountain.png");
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			
		}

		.bg-box {
			background-color: #FFFFF0, rgba(0, 0, 0, 0.2);;
			padding: 10px;
			border-radius: 30px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 1);
			font-size: 30px;
			width: 500px;
  			height: 600px;
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
			font-size:20px;
		}

		.btn-primary:hover {
			background-color: #0069d9;
		}

		.btn-secondary {
			border-radius: 20px;
			padding: 15px 30px;
			font-size: 18px;
			background-color: #B80F0A;
			border: none;
			text-align: center;
			font-size:20px;
		}

		.btn-secondary:hover {
			background-color: #800000;
		}

		.centerContent {
			text-align: center;
		}
		.buttonSection{
			display: block;
  			margin: 20% 0px 20% 0;
		}
	</style>
</head>

<body>
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-10">
			<br>
				<h1 class="text-center mb-4 title" style= font-weight:400 >Bams Passwords</h1>
				<div class="bg-box">
					<div class="buttonSection">
						<p class="text-center" style= font-size:25px>Already have an account?</p>
						<div class="centerContent">
							<a type="submit" class="btn btn-primary btn-block" href="logInInterface.php">Log in</a>
						</div>
					</div>
					<hr>
					<div class="buttonSection">
						<p class="text-center" style= font-size:25px>Don't have an account yet?</p>
						<div class="centerContent">
							<a href="createUserInterface.php" class="btn btn-secondary btn-block">Create an account</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>

</html>