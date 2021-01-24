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
		elseif ($db_role === 'teacher') {
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
		<title>Login</title>
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
								<a class="nav-link text-white active" href="login.php">Login</a>
							</li>
							<!-- Dropdown -->
							<li class="nav-item dropdown ">
								<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
									Register As
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="student_regis.php">Student</a>
									<a class="dropdown-item" href="teacher_regis.php">Teacher</a>
									<a class="dropdown-item" href="parent_regis.php">Parent</a>
								</div>
							</li>
						</ul>
					</nav>
				</header>
	
				<!-- Login Body Part -->
				<div class="container">
					<h2 class="display-2 mt-4 text-center font-weight-bold">Login</h2>
					<p class="text-danger font-weight-bold">NOTE! &nbsp;ID BE LIKE <br>
						<b class="bg-dark text-white">Student ID: S1234</b><br>
						<b class="bg-dark text-white">Teacher ID: T1234</b><br>
						<b class="bg-dark text-white">Parent ID: P1234</b>
					</p>

<?php 

	include "connection.php";

	if(isset($_POST['submit']))
	{

		$id = mysqli_real_escape_string($connection, $_POST['id']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$status = 'active';

		$user_query = "SELECT * FROM users WHERE id = '$id'";
		$user_result = mysqli_query($connection,$user_query);
		$user_count = mysqli_num_rows($user_result);

		if($user_count>0)
		{
			$user_data = mysqli_fetch_assoc($user_result);

			$db_password = $user_data['password'];

			if($password === $db_password)
			{
				$db_status = $user_data['status'];

				if($db_status === $status)
				{
					$db_role = $user_data['role'];
					if($db_role === 'admin')
					{
						$_SESSION['id'] = $id;
						$_SESSION['role']=$db_role;

						header("Location: admin_dashboard.php");
					}
					elseif ($db_role == 'student') 
					{
						$_SESSION['id'] = $id;
						$_SESSION['role']=$db_role;
						header("Location: subjects_selection.php");
					
					}
					elseif ($db_role == 'teacher') 
					{
						$_SESSION['id'] = $id;
						$_SESSION['role']=$db_role;
						
						header("Location: teacher_dashboard.php");
					}
					else{
						$_SESSION['id'] = $id;
						$_SESSION['role']=$db_role;
						header("Location: parent_dashboard.php");
					}
				}
				else
				{	
					?>
						<p class="text-danger text-center font-weight-bold">Your request is still pending!</p>
  					<?php
				}
			}
			else
			{
				?>
					<p class="text-danger text-center font-weight-bold">ID or Passord incorrect!</p>
  				<?php
  			}				
		}
		else
		{
			?>
				<p class="text-danger text-center font-weight-bold">ID or Passord incorrect!</p>
  			<?php
		}
	}

mysqli_close($connection);
 ?>
					<div class="container ">
						<form name="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
							<div class="form-group col-lg-4  mx-auto">
								<input type="text" class="form-control mt-2" id="id" name="id" placeholder="ID" value="<?PHP if(isset($_POST['id'])) echo htmlspecialchars($_POST['id']); ?>" required>
							
								<input type="password" class="form-control mt-2" id="psw" name="password" placeholder="Password"  value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>" required>

								<a href="forgot_password.php" class="float-right">Forgot Password?</a>
								<button name="submit" type="submit" class="btn btn-primary col-lg-12 mt-4">Login</button>

							</div>
							
						</form>
					</div>
				</div>
				

				<script src="js/bootstrap.min.js"></script>
			</body>
		</html>