<?php 

session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Update Password</title>
		<style>
			.carousel-inner img{
			width: 100%;
				height: 664px;
			}
			.successMessage{
				color: #47ad4c;
			}
			.errorMessage{
				color: #b32b2b;
			}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.js"></script>
	</head>
	<body style="background-color: #BCD1A1;">
<?php 

	include "connection.php";

if(isset($_POST['send_email']))
{
	if(isset($_GET['token']))
	{
		$token = $_GET['token'];

		$new_password = $_POST['new_password'];
		$c_password = $_POST['c_password'];

		if($new_password === $c_password)
		{
	// for student password	
			$query_id1 = "SELECT * FROM students WHERE token = '$token'";
			$id_result1 = mysqli_query($connection,$query_id1);
			$id_count1 = mysqli_num_rows($id_result1);

			if($id_count1>0)
			{	
				$query1 = "UPDATE students SET password='$new_password' WHERE token='$token'";
				$result1 = mysqli_query($connection,$query1);

				$userdata1 = mysqli_fetch_assoc($id_result1);
				$db_id1 = $userdata1['id'];

				$query1 = "UPDATE users SET password='$new_password' WHERE id = '$db_id1'";
				$result1 = mysqli_query($connection,$query1);

				?>
					<p class="successMessage text-center mt-5  font-weight-bold">Your password has been updated Successfully! <br>Redirecting to Login Page...</p>
				<?php
					header("Refresh: 2 ; URL=login.php");
			}
			
	// for teacher password
			$query_id2 = "SELECT * FROM teachers WHERE token = '$token'";
			$id_result2 = mysqli_query($connection,$query_id2);
			$id_count2 = mysqli_num_rows($id_result2);

			if($id_count2>0)
			{
				$query2 = "UPDATE teachers SET password='$new_password' WHERE token='$token'";
				$result2 = mysqli_query($connection,$query2);

				$userdata2 = mysqli_fetch_assoc($id_result2);
				$db_id2 = $userdata2['id'];

				$query2 = "UPDATE users SET password='$new_password' WHERE id = '$db_id2'";
				$result2 = mysqli_query($connection,$query2);

				?>
					<p class="successMessage text-center mt-5  font-weight-bold">Your password has been updated Successfully! <br>Redirecting to Login Page...</p>
				<?php
					header("Refresh: 2 ; URL=login.php");
			}
	

	// for parent password
			$query_id3 = "SELECT * FROM parents WHERE token = '$token'";
			$id_result3 = mysqli_query($connection,$query_id3);
			$id_count3 = mysqli_num_rows($id_result3);

			if($id_count3>0)
			{
				$query3 = "UPDATE parents SET password='$new_password' WHERE token='$token'";
				$result3 = mysqli_query($connection,$query3);

				$userdata3 = mysqli_fetch_assoc($id_result3);
				$db_id3 = $userdata3['id'];

				$query3 = "UPDATE users SET password='$new_password' WHERE id = '$db_id3'";
				$result3 = mysqli_query($connection,$query3);

				?>
					<p class="successMessage text-center mt-5  font-weight-bold">Your password has been updated Successfully! <br>Redirecting to Login Page...</p>
				<?php
					header("Refresh: 2 ; URL=login.php");
			}			
		}
		else
		{
			?>
				<p class="errorMessage text-center mt-5 font-weight-bold">Password are not matching!</p>
			<?php
		}
	}
	else
	{
		?>
			<p class="errorMessage text-center mt-5 font-weight-bold">No Token Found!</p>
		<?php
	}
}


mysqli_close($connection);
 ?>

<div class="container mt-5">
	<form  method="post" action="">
		<div class="form-group col-lg-4  mx-auto">
			<input type="password" class="form-control mt-2" id="new_password" name="new_password" placeholder="New password" value="<?PHP if(isset($_POST['new_password'])) echo htmlspecialchars($_POST['new_password']); ?>" required>

			<input type="password" class="form-control mt-2" id="c_password" name="c_password" placeholder="Confirm Password" value="<?PHP if(isset($_POST['c_password'])) echo htmlspecialchars($_POST['c_password']); ?>" required>					
			<button name="send_email" type="submit" class="btn btn-primary col-lg-12 mt-4">Send Mail</button>
		</div>
		
	</form>
</div>
</div>


<script src="js/bootstrap.min.js"></script>
</body>
</html>