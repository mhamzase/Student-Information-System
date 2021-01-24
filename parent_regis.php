<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Parent Registration</title>
		<style>
			.carousel-inner img{
			width: 100%;
				height: 664px;
			}
			#sp , #birthday:focus{
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
							<a class="dropdown-item " href="student_regis.php">Student</a>
							<a class="dropdown-item" href="teacher_regis.php">Teacher</a>
							<a class="dropdown-item active" href="parent_regis.php">Parent</a>
						</div>
					</li>
				</ul>
			</nav>
		</header>
		<!-- Parent Registrtaion Body Part -->
<p class="text-danger font-weight-bold">NOTE: Please fill all given below fields with carefully and correct!</p>
		<div class="container">
			<h2 class=" mt-4 text-center font-weight-bold">Parent Registration</h2>
			


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
		$child_id = mysqli_real_escape_string($connection, $_POST['child_id']);
		
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
			$emailquery = "SELECT * FROM parents WHERE email = '$email'";
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
					$id = 'P'.strval(rand(1000,10000)) ;

					// check id already generated or not
					$idquery = "SELECT * FROM parents WHERE id = '$id'";
					$idresult = mysqli_query($connection,$idquery);

					$idcount = mysqli_num_rows($idresult);

					if($idcount>0)
					{
						goto generate_again;
					}
					else
					{
						// check phone number already exist or not
						$phonequery = "SELECT * FROM parents WHERE phone = '$phone'";
						$phoneresult = mysqli_query($connection,$phonequery);

						$phonecount = mysqli_num_rows($phoneresult);

						if($phonecount>0)
						{
							?>
								<p class="errorMessage text-center text-danger font-weight-bold">phone number already exist!</p>
	  						<?php
						}
						else
						{

							$query_stduent = "SELECT * FROM students WHERE id = '$child_id'";
							$query_result = mysqli_query($connection,$query_stduent);
							$count_stid = mysqli_num_rows($query_result);

							if($count_stid>0)
							{
								$student_data = mysqli_fetch_assoc($query_result);

								$parent_id = $student_data['parent_id'];
								$child_id = $student_data['id'];

								if($parent_id == NULL)
								{
									$query1 = "INSERT INTO `parents`(`id`, `fullname`, `email`, `password`, `address`, `phone`, `gender`, `child_id`, `token`) VALUES ('$id','$fullname','$email','$password','$address','$phone','$gender','$child_id','$token')";
									$query1_result = mysqli_query($connection,$query1);

									$query2 = "INSERT INTO `users`(`id`, `password`, `status`, `role`) VALUES ('$id','$password','$status','$role')";
									$query2_result = mysqli_query($connection,$query2);


									$query3 = "UPDATE students SET parent_id = '$id' WHERE id='$child_id'";
									$query3_result = mysqli_query($connection,$query3); 

									$_POST['fullname'] = "";
									$_POST['email'] = "";
									$_POST['password'] = "";	
									$_POST['cpassword'] = "";
									$_POST['address'] = "";
									$_POST['phone'] = "";
									$_POST['gender'] = "";

									?>
										<p class="text-primary text-center font-weight-bold">Your request for registration is pending...! <br>Check continuing your email to get notification about approval or rejection from Admin</p>
		  							<?php 
								}
								else
								{
									?>
										<p class="errorMessage text-center font-weight-bold text-danger">This child id has already relation with his parent</p>
	  								<?php
								}		 							
							}
							else
							{
								?>
									<p class="errorMessage text-center font-weight-bold text-danger">Child ID doesn't exist in our database</p>
	  							<?php
							}
						}
					}	
				}
			}
		}
	}
mysqli_close($connection);
 ?>
			<div class="container ">
				<form  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<div class="form-group col-lg-4  mx-auto">
						<input type="text" class="form-control mt-2" id="fn" name="fullname" placeholder="Full Name" value="<?PHP if(isset($_POST['fullname'])) echo htmlspecialchars($_POST['fullname']); ?>" required>
						
						<input type="email" class="form-control mt-2" id="email" name="email" placeholder="Email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required>
						
						<input type="password" class="form-control mt-2" id="psw" name="password" placeholder="Password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>" required>

						<input type="password" class="form-control mt-2" id="cpsw" name="cpassword" placeholder="Confirm Password" value="<?PHP if(isset($_POST['cpassword'])) echo htmlspecialchars($_POST['cpassword']); ?>" required>

						<input type="text" class="form-control mt-2" id="address" name="address" placeholder="Mailing Address" value="<?PHP if(isset($_POST['address'])) echo htmlspecialchars($_POST['address']); ?>" required>

						<input type="text" class="form-control mt-2" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" name="phone" placeholder="03xx-xxxxxxx" required>

						<input type="text" class="form-control mt-2" id="child_id" name="child_id" placeholder="Children ID" value="<?PHP if(isset($_POST['child_id'])) echo htmlspecialchars($_POST['child_id']); ?>" required>
						
						<label class="font-weight-bold">Gender</label>
						<input type="radio" class="mt-4 ml-4" id="gender" name="gender" value="male" required>&nbsp;Male
						<input type="radio" class="mt-4 ml-4" id="gender" name="gender" value="female">&nbsp;Female
						
						<button name="submit" type="submit" class="btn btn-primary col-lg-12 mt-4">Register</button>
						<p class="text-center">Have an account? <a href="login.php">Login</a></p>
					</div>
				</form>
			</div>
		</div>
		
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

























