<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Teacher Registration</title>
		<style>
			.carousel-inner img{
			width: 100%;
				height: 664px;
			}
			#sp , #birthday:focus
			{
				outline-width: 0;
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
						<a class="nav-link text-white" href="login.php">Login</a>
					</li>
					<!-- Dropdown -->
					<li class="nav-item dropdown ">
						<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
							Register As
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="student_regis.php">Student</a>
							<a class="dropdown-item active" href="teacher_regis.php">Teacher</a>
							<a class="dropdown-item" href="parent_regis.php">Parent</a>
						</div>
					</li>
				</ul>
			</nav>
		</header>

		<!-- Teacher Registrtaion Body Part -->
		<p class="text-danger font-weight-bold">NOTE: Please fill all given below fields with carefully and correct!</p>
		<div class="container">
			<h2 class="text-center font-weight-bold">Teacher Registration</h2>


<?php 
	
	include "connection.php";


	if(isset($_POST['submit']))
	{
		$fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$password =  mysqli_real_escape_string($connection, $_POST['password']);
		$cpassword =  mysqli_real_escape_string($connection, $_POST['cpassword']);
		$address = mysqli_real_escape_string($connection, $_POST['address']);
		$phone = mysqli_real_escape_string($connection, $_POST['phone']);
		$gender = mysqli_real_escape_string($connection, $_POST['gender']);
		$dob = mysqli_real_escape_string($connection, $_POST['dob']);
		$qualification = mysqli_real_escape_string($connection, $_POST['qualification']);	
		
		$status = "pending";
		$role = "undefined";
		 
		// generate token randomly 
		$token = bin2hex(random_bytes(15));


		if (ctype_alpha(str_replace(' ', '', $fullname)) === false) 
		{
  			?>
			<p class="errorMessage text-center font-weight-bold text-danger">fullname is not in correct format!</p>
  			<?php 
		}
		else
		{
			//check email already exist or not
			$emailquery = "SELECT * FROM teachers WHERE email = '$email'";
			$emailresult = mysqli_query($connection,$emailquery);

			$emailcount = mysqli_num_rows($emailresult);

			if($emailcount>0)
			{
				?>
					<p class="errorMessage text-center font-weight-bold text-danger">email already exist!</p>
	  			<?php 
			}
			else
			{
				if($password !== $cpassword)
				{
					?>
						<p class="errorMessage text-center font-weight-bold text-danger">password not matching!</p>
	  				<?php 
				}
				else
				{
					generate_again:
					// generating random student id 
					$id = 'T'.strval(rand(1000,10000)) ;

					// check id already generated or not
					$idquery = "SELECT * FROM teachers WHERE id = '$id'";
					$idresult = mysqli_query($connection,$idquery);

					$idcount = mysqli_num_rows($idresult);

					if($idcount>0)
					{
						goto generate_again;
					}
					else
					{
						// check phone number already exist or not
						$phonequery = "SELECT * FROM teachers WHERE phone = '$phone'";
						$phoneresult = mysqli_query($connection,$phonequery);

						$phonecount = mysqli_num_rows($phoneresult);

						if($phonecount>0)
						{
							?>
								<p class="errorMessage text-center font-weight-bold text-danger">phone number already exist!</p>
	  						<?php
						}
						else
						{

							$query1 = "INSERT INTO `teachers`(`id`, `fullname`, `email`, `password`, `address`, `phone`, `gender`, `dob`, `qualification`,`token`) VALUES ('$id','$fullname','$email','$password','$address','$phone','$gender','$dob','$qualification','$token')";
							
							$result1 = mysqli_query($connection,$query1);
							
							$query2 = "INSERT INTO `users`(`id`, `password`, `status`, `role`) VALUES ('$id','$password','$status','$role')";
							$result2 = mysqli_query($connection,$query2);


							$_POST['fullname'] = "";
							$_POST['email'] = "";
							$_POST['password'] = "";	
							$_POST['cpassword'] = "";
							$_POST['address'] = "";
							$_POST['phone'] = "";
							$_POST['gender'] = "";
							$_POST['birthday'] = "";
							$_POST['qualification'] = "";

							?>
								<p class="text-primary text-center font-weight-bold">Your request for registration is pending...! <br>Check continuing your email to get notification about approval or rejection from Admin</p>
		  					<?php 

						}
						

					}
					
				}
			}
		}
	}
	
mysqli_close($connection);
 ?>
			<div class="container ">
				<form name="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<div class="form-group col-lg-4  mx-auto">
						<input type="text" class="form-control mt-2" id="fn" name="fullname" placeholder="Full Name" value="<?PHP if(isset($_POST['fullname'])) echo htmlspecialchars($_POST['fullname']); ?>" required>
						
						<input type="email" class="form-control mt-2" id="email" name="email" placeholder="Email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required>
						<input type="password" class="form-control mt-2" id="psw" name="password" placeholder="Password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>" required>
						<input type="password" class="form-control mt-2" id="cpsw" name="cpassword" placeholder="Confirm Password" value="<?PHP if(isset($_POST['cpassword'])) echo htmlspecialchars($_POST['cpassword']); ?>" required>
						<input type="text" class="form-control mt-2" id="address" name="address" placeholder="Mailing Address" value="<?PHP if(isset($_POST['address'])) echo htmlspecialchars($_POST['address']); ?>" required>
						<input type="text" class="form-control mt-2" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" name="phone" placeholder="03xx-xxxxxxx" required>
						
						<label class="font-weight-bold">Gender</label>
						<input type="radio" class="mt-4 ml-4" id="gender" name="gender" value="male" required>&nbsp;Male
						<input type="radio" class="mt-4 ml-4" id="gender" name="gender" value="female">&nbsp;Female
							
						<br>
						<label class="font-weight-bold" for="birthday">Birthday:</label>
						<input class="mt-2 ml-3" type="date" id="dob" name="dob" required>
								
						<br>
						<label class="font-weight-bold">Qualification</label>
						<select class="mt-2 ml-3 w-50" name="qualification" id="qualification" required>
							<option value="">-------Select-------</option>
							<option value="bs_english">BS English</option>
							<option value="ma_urdu">MA Urdu</option>
							<option value="bs_physics">BS Physics</option>
							<option value="bs_math">BS Mathematics</option>
							<option value="bs_chemistry">BS Chemistry</option>
							<option value="bscs">BS Computer Science</option>
							<option value="ma_islamiat">MA Islamiat</option>
						</select>
						<br>
						<button name="submit" type="submit" class="btn btn-primary col-lg-12 mt-4">Register</button>
						<p class="text-center">Have an account? <a href="login.php">Login</a></p>
					</div>
					
				</form>
			</div>
		</div>
		
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>