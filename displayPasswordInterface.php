<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once("helpers/encryptionStuff.php");
include_once("helpers/functions.php");
include_once("helpers/queries.php");
	include_once("helpers/db_connect.php");

?>

<head>
	<meta charset="UTF-8"><br>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Passwords</title>
	<link rel="stylesheet" href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css">
	
</head>

<body>
	<style>
		.label{
			color: white;
		}
		.pagination {
			clear: both;
			text-align: center;
		}
		.pagination a, .pagination span {
			display: inline-block;
			padding: 5px 10px;
			margin: 0 5px;
			background-color: #eee;
			color: #333;
			text-decoration: none;
			border-radius: 3px;
		}
		.pagination a:hover {
			background-color: #ccc;
		}
		.pagination .active {
			background-color: #333;
			color: #fff;
		}
		.bg-box {
			padding: 70px;
			border-radius: 30px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 1);
			background-color: #FFFFF0, rgba(0, 0, 0, 0.2);
			forced-color-adjust: white;
			font-size: 20px;
			margin-left: -175px;
			width: 1000px;
			height: 600px;
			text-align: left;
  			
			
		}

		body {
			background-color: #79003A;
			background-image: url("./assets/images/mountain.png");
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			height: 800px;

		}

		.title {
			color: #ff5349;
			font-family:"Optima", sans-serif;
		}

		.btn-primary {
			border-radius: 15px;
			padding: 5px 20px;
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
		}

		.btn-secondary:hover {
			background-color: #5a6268;
		}
		th {
			margin: 10px 20px; /* increase the margin to add more space */
		}
		.logout {
			text-align: right;
			margin-right: 5%;
		}
		.logout button{
			border-radius: 15px;
			padding: 5px 20px;
			font-size: 18px;
			background-color: #007bff;
		}
	</style>
	<form method="post" action="">
	<div class="logout">
		<button name="logout" id="submit" type="submit" value="logout" class="btn btn-primary">Logout</button>
	</div>
	</form>
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-8 col-sm-10">
				<h1 class="text-center mb-4 title">Passwords</h1>
				<div class="bg-box" style= align-items:center;>
					<form method="post" action="">
					<?php
					if (!isset($_SESSION['id'])) {
						redirect("index.php");
					}
						if (isset($_POST['logout'])) {
							session_unset();
							session_destroy();
							redirect("index.php");
						}
						$user= decryptor($_SESSION["id"]);
						
						if(!isset($_POST['submit'])){
						$result = SelectPassword($user);
						
						$dblink = db_connect("rowdytable");
						$query = "SELECT count(*) as count FROM `Passwords` WHERE `userId` = '$user'";
						$numResult = $dblink->query($query) or
							die("Something went wrong with $query: " . $dblink->error);
						$amount = $numResult->fetch_array(MYSQLI_ASSOC);
						if($amount['count']>0){
							$records_per_page = 5;
						$page = isset($_GET['page']) ? explode("-", $_GET['page']) : [1,0];
						if(!isset($_GET['page'])){
							$total_pages = ceil($amount['count'] / $records_per_page);
						}else{
							$total_pages= $page[1];
						}
						$offset = (intval($page[0]) - 1) * $records_per_page;
						$sql = "SELECT * FROM `Passwords` where `userId`='$user' LIMIT $records_per_page OFFSET $offset";
						$result = $dblink->query($sql) or
							die("Something went wrong with: $sql<br>".$dblink->error);
						echo '<div class="pagination">';
						if ($page[0] > 1) {
							echo '<a href="?page='.($page[0]-1).'-'.$total_pages.'">&laquo Previous</a>';
						}
						$count=0;
						for ($i = $page[0]; $i <= $total_pages; $i++) {
							if($page[0] != 1 && $count == 0){
								echo '<a href="?page=1-'.$total_pages.'"> 1 </a>';
								if($page != 2){
									echo '<span> ... </span>';
								}
							}
							if($count < 3){
								if ($i == $page[0]) {
									echo '<span class="active"> ' . $i . ' </span>';
								} else {
									echo '<a href="?page=' . $i . '-'.$total_pages.'">' . $i . ' </a>';
								}
								$count++;
							}else{
								echo '<span> ... </span>';
								echo '<a href="?page='.$total_pages.'-'.$total_pages.'">'.$total_pages.' </a>';
								break;
							}
						}
						if ($result->num_rows == $records_per_page) {
							echo '<a href="?page='.($page[0]+1).'-'.$total_pages.'">Next &raquo</a>';
						}
						echo '</div>';
						echo '<br>';
						echo '<table border="1" class="label" style="margin-left:auto; margin-right:auto;">';
						$counter = 1;
						echo '<thead>';
						echo "<tr>";
						echo "<th>ID</th>";
						echo "<th>Name</th>";
						echo "<th>Username</th>";
						echo "<th>Password</th>";
						echo "<th>Site</th>";
						echo "</tr>";
						echo '</thead>';
							echo '<tbody>';
						while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
							echo "<tr>";
							echo "<td>$counter</td>";
							$counter += 1;
							echo "<td>$row[Description]</td>";
							echo "<td>$row[User]</td>";
							$pw = decryptor($row['Password']);
							echo "<td>$pw</td>";
							echo "<td>$row[Domain]</td>";
							echo '<td border="0"><button type="submit" name="delete" value="'.$row["autoId"].'">Delete</button></td>';
							echo "</tr>";
						}
							echo '</tbody>';
						echo "</table>";
					}else{
							echo '<p style="text-align: center; font-size: 30px">You currently have no entries</p>';
						}
						}
					if(isset($_POST['delete'])){
						$sql="Delete from `Passwords` where `autoId`= $_POST[delete]";
						$dblink->query($sql) or
							die("Something went wrong with the $sql".$dblink->error);
						redirect("displayPasswordInterface.php");
					}
						


					?>
					<br>
				</br>
				
					<?php if(isset($_POST['submit'])){ ?>
					<div class="form-group">
						<label for="username" class="label">Enter username:</label>
						<input type="text" name="username" class="form-control" placeholder="Enter username" required>
					</div>
					<div class="form-group">
							<label for="password" class="label">Password</label>
							<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
						<button name="submit" id="generatePassword" type="submit" value="submit" class="btn" style="color: white">Generate Password</button>
							<div id="output" style="color: white; font-size: 12px;"></div>
						</div>
					<div class="form-group">
						<label for="username" class="label">Enter domain:</label>
						<input type="text" name="domain" class="form-control" placeholder="Enter domain name" required>
					</div>
					<div class="form-group">
						<label for="username" class="label">Enter description:</label>
						<input type="text" name="description" class="form-control" placeholder="State a discription for the account" >
					</div>
					<div style="text-align: center;">
						<button name="createEntry" type="submit" value="submit" class="btn btn-primary btn-block" style="margin-top: 5%">Confirm</button>
					</div>
					<?php } ?>
					<?php if(!isset($_POST['submit'])){ ?>
					<div style="text-align: center;">
						<button name="submit" id="submit" type="submit" value="submit" class="btn btn-primary btn-block">Create entry</button>
					</div>
						<?php } ?>
					<?php
						if(isset($_POST['createEntry'])){
							$pw = addslashes(encryptor($_POST['password']));
							$query = "INSERT INTO `Passwords` (`userId`, `User`, `Password`, `Domain`, `Description`) VALUES ('$user', '$_POST[username]', '$pw', '$_POST[domain]', '$_POST[description]');";
							$dblink->query($query) or
								die("Something went wrong with $query: " . $dblink->error);
							redirect("displayPasswordInterface.php");
						}
					?>
				</form>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/generatePassword.js"></script>
</body>

</html>