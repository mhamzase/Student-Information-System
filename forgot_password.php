<?php 

session_start();
include "connection.php";

if(isset($_SESSION['id']))
{

	$session_id = $_SESSION['id'];

	$user_query = "SELECT * FROM users WHERE id = '$session_id'";
	$user_result = mysqli_query($connection,$user_query);

	$user_data = mysqli_fetch_assoc($user_result);
	$db_role = $user_data['role'];

		if($db_role === 'admin')
		{
			header("Location: admin_dashboard.php");
		}
		elseif ($db_role === 'student') {
			header("Location: student_dashboard.php");
		}
		elseif ($db_role === 'student') {
			header("Location: teacher_dashboard.php");
		}
		else{
			header("Location: parent_dashboard.php");
		}
}
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Forgot Password</title>
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
		<!-- Header Part -->
		<header>
			<nav class="navbar navbar-expand-sm bg-dark text-dark">
				<!-- Brand -->
				<a class="navbar-brand" href="index.php"><img class="float-left mr-3" src="images/sis.png" width="10%" alt="Brand Image"><p class="pt-3 pl-5 text-white">Student Information System</p></a>
				<!-- Links -->
				<ul class="nav nav-pills ml-auto ">
					<li class="nav-item ">
						<a class="nav-link text-white " href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white " href="login.php">Login</a>
					</li>
					<!-- Dropdown -->
					<li class="nav-item dropdown ">
						<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
							Register As
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item " href="student_regis.php">Student</a>
							<a class="dropdown-item" href="teacher_regis.php">Teacher</a>
							<a class="dropdown-item" href="parent_regis.php">Parent</a>
						</div>
					</li>
				</ul>
			</nav>
		</header>
		
		<!-- Login Body Part -->
		<div class="container">
			<h2 class="display-4 mt-4 text-center font-weight-bold">Forgot Password!</h2>

<?php 

	include "connection.php";

	if(isset($_POST['submit']))
	{
		$email = $_POST['email'];

// for student
		$query = "SELECT * FROM students WHERE email = '$email'";
		$query_result = mysqli_query($connection,$query);
		$result_count = mysqli_num_rows($query_result);
// for teacher
		$query1 = "SELECT * FROM teachers WHERE email = '$email'";
		$query_result1 = mysqli_query($connection,$query1);
		$result_count1 = mysqli_num_rows($query_result1);
// for parent
		$query2 = "SELECT * FROM parents WHERE email = '$email'";
		$query_result2 = mysqli_query($connection,$query2);
		$result_count2 = mysqli_num_rows($query_result2);

		if($result_count>0)
		{
			$userdata = mysqli_fetch_array($query_result);
			$token = $userdata['token'];
			$fullname = $userdata['fullname'];

			$subject = "Reset Password";
			$body = "Hi | $fullname | Click the link to reset your password http://localhost/sis/update_password.php?token=$token";
			$senderEmail = "From: sidrachoudry56@gmail.com";

			if(mail($email,$subject,$body,$senderEmail))
			{
				?>
	        		<p class="successMessage text-center font-weight-bold">Check your mail at <?php echo $email ?> to reset your password</p>
	        	<?php
	        	$_POST['email'] = "";
			}
			else
			{
				?>
	       			<p class="errorMessage text-center font-weight-bold">Email Sending Faild...</p>
	       		 <?php
			}
		}

		elseif($result_count1>0)
		{
			$userdata = mysqli_fetch_array($query_result1);
			$token = $userdata['token'];
			$fullname = $userdata['fullname'];

			$subject = "Reset Password";
			$body = "Hi | $fullname | Click the link to reset your password http://localhost/sis/update_password.php?token=$token";
			$senderEmail = "From: sidrachoudry56@gmail.com";

			if(mail($email,$subject,$body,$senderEmail))
			{
				?>
	        		<p class="successMessage text-center font-weight-bold">Check your mail at <?php echo $email ?> to reset your password</p>
	        	<?php
	        	$_POST['email'] = "";
			}
			else
			{
				?>
	       			<p class="errorMessage text-center font-weight-bold">Email Sending Faild...</p>
	       		 <?php
			}
		}

		elseif($result_count2>0)
		{
			$userdata = mysqli_fetch_array($query_result2);
			$token = $userdata['token'];
			$fullname = $userdata['fullname'];

			$subject = "Reset Password";
			$body = "Hi | $fullname | Click the link to reset your password http://localhost/sis/update_password.php?token=$token";
			$senderEmail = "From: sidrachoudry56@gmail.com";

			if(mail($email,$subject,$body,$senderEmail))
			{
				?>
	        		<p class="successMessage text-center font-weight-bold">Check your mail at <?php echo $email ?> to reset your password</p>
	        	<?php
	        	$_POST['email'] = "";
			}
			else
			{
				?>
	       			<p class="errorMessage text-center font-weight-bold">Email Sending Faild...</p>
	       		 <?php
			}
		}
		else
		{
			?>
				<p class="errorMessage text-center font-weight-bold">Email doesn't exist in our database</p>
  			<?php
		}
	}
mysqli_close($connection);
 ?>
<div class="container mt-5">
	<form name="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<div class="form-group col-lg-4  mx-auto">
			<input type="text" class="form-control mt-2" id="email" name="email" placeholder="Email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required>
			
			<button name="submit" type="submit" class="btn btn-primary col-lg-12 mt-4">Send Mail</button>
		</div>
		
	</form>
</div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>