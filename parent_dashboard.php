<?php 
session_start();

if(isset($_POST['logout']))
{
	session_destroy();
	header("Location: login.php");
}

if(isset($_SESSION['id']))
{
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
</head>
<body style="margin: 0;padding: 0">

<div class="container-fluid">
	<div class="row">

		<!-- left panel for student all informations -->
		<div class="col-3 bg-dark pt-3" style="height: 757px">
			<span style="width: 12px;height: 12px;background-color: #69f079;border-radius: 50%;display: inline-block;"></span>
			<span class="text-white ml-1">Online</span>
			<?php 
				include "connection.php";
				$id = $_SESSION['id'];

				$query_gender = "SELECT * FROM parents WHERE id = '$id'";
				$result_gender = mysqli_query($connection,$query_gender) or die(mysqli_error($connection));

				if($row = mysqli_fetch_array($result_gender))
				{
					$gender = $row['gender'];
					$fullname = $row['fullname'];
				}

				if($gender == "male")
				{
					?>
					<center><img src="images/male_parent.png" alt="male profile picture" width="180px"></center>
					<p class="text-center text-white font-weight-bold"><?php echo $fullname ?></p>
					<?php
				}
				if($gender == "female")
				{
					?>
					<center><img src="images/female.png" alt="female profile picture" width="180px"></center>
					<p class="text-center text-white font-weight-bold"><?php echo $fullname ?></p>
					<?php
				}
			 ?>
			 <hr width="100%">

			 
			 <button id="profile" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1; background-color: black">Profile</button>
			 <button id="child"  class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Child Profile</button>
			 <button id="results" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Results</button>	
			 <button id="attendance" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Attendance</button>
			 <button id="changePassword" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Change Password</button>
			 
			 <form action="" method="post">
			 <button name="logout" type="submit" value="logout" class="row btn btn-danger col-8 float-right mt-5">Logout</button>
			 </form>
				 
		</div>


		<!-- right side panel -->
		<div class="col-9"  style="margin: 0;padding: 0; background-color: #BCD1A1;" >

		

			<!-- parent profile -->
			<div id="profile_data" style="height: 100%;">
				<p class="text-center font-weight-bold display-4">Profile</p>
				<?php 

					$id = $row['id'];
					$fullname = $row['fullname'];
					$email = $row['email'];
					$address = $row['address'];
					$phone = $row['phone'];
					$gender = $row['gender'];
					$child_id = $row['child_id'];
	
				 ?>

				
				 <center>
				 	<div class="container" style="font-size: 20px;">
				 	<table class="table table-dark table-sm table-striped table-hover">
				 		<tr>	
					 		<td><span class="font-weight-bold" style="color:#BCD1A1">ID</span></td>
					 		<td><span> <?php echo $id ?> </span></td>
				 		</tr>
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Full Name</span></td>
				 			<td><span> <?php echo $fullname ?> </span></td>
				 		</tr>
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Email</span></td>
				 			<td><span> <?php echo $email ?> </span></td>
				 		</tr>
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Address</span></td>
				 			<td><span> <?php echo $address ?> </span></td>
				 		</tr>
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Phone</span></td>
				 			<td><span> <?php echo $phone ?> </span></td>
				 		</tr>
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Gender</span></td>
				 			<td><span> <?php echo $gender ?> </span></td>
				 		</tr>
				 		
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Child ID</span></td>
				 			<td><span> <?php echo $child_id ?> </span></td>
				 		</tr>

				 	</table>
				 	</div>
				 </center>
			</div>

			

			<!-- child profile -->
			<div id="child_data">
				<p class="display-4 font-weight-bold text-center">Child Profile</p>

				<?php 
						$query_child = "SELECT * FROM students WHERE id = '$child_id'";
						$result_child = mysqli_query($connection,$query_child)  or die(mysqli_error($connection));

						if($row_child = mysqli_fetch_array($result_child))
						{
							$child_id =  $row_child['id'];
							$child_fullname = $row_child['fullname'];
							$child_email = $row_child['email'];
							$child_address = $row_child['address'];
							$child_phone = $row_child['phone'];
							$child_parentID = $row_child['parent_id'];
						}

						?>

						<center>
				 	<div class="container" style="font-size: 20px;">
					 	<table class="table table-dark table-sm table-striped">
					 		<tr>	
						 		<td><span class="font-weight-bold" style="color:#BCD1A1">ID</span></td>
						 		<td><span> <?php echo $child_id ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Full Name</span></td>
					 			<td><span> <?php echo $child_fullname ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Email</span></td>
					 			<td><span> <?php echo $child_email ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Address</span></td>
					 			<td><span> <?php echo $child_address ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Phone</span></td>
					 			<td><span> <?php echo $child_phone ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Parent ID</span></td>
					 			<td><span> <?php echo $child_parentID ?> </span></td>
					 		</tr>
					 	</table>
				 	</div>
				 </center>


						<?php
					
				 ?> 
			</div>


			<!-- results -->
			<div id="results_data">
				<p class="display-4 font-weight-bold text-center">Results</p>
			</div>



			<!-- attendance -->
			<div id="attendance_data">
				<center>
					<p class="display-4 font-weight-bold text-center">Attendance</p>
					

				</center>
			</div>




			<!-- Change Password -->
			<div id="changePassword_data">
				<p class="display-4 font-weight-bold text-center">Change Password</p>
				<div class="alert alert-danger col-4 m-auto text-center" id="error_pass" style="display: none;">
				  <strong>Error!&nbsp;&nbsp;</strong><span id="error_name"></span>
				</div>
				<div class="alert alert-success col-4 m-auto text-center" id="success_pass" style="display: none;">
				   <strong>Success!&nbsp;&nbsp;</strong><span id="success_name"></span>
				</div>

				<?php 

				if(isset($_POST['updatePassword']))
				{
					$old_password = $_POST['old_password'];
					$new_password = $_POST['new_password'];
					$c_password = $_POST['c_password'];

					$id = $_SESSION['id'];

					$pass_query = mysqli_query($connection,"SELECT * FROM parents WHERE id = '$id'") or die(mysqli_error($connection));
					
					if($row_pass = mysqli_fetch_array($pass_query))
					{
						$old_pass = $row_pass['password'];

						if($old_pass == $old_password)
						{
							echo "<script>
							document.getElementById('success_name').innerHTML = 'Password Updated Successfully';
							document.getElementById('success_pass').style.display = 'block'
							</script>";
							$insert_query = mysqli_query($connection,"UPDATE parents SET password = $new_password WHERE id = '$id'") or die(mysqli_error($connection));
						}
						else
						{
							echo "<script>
							document.getElementById('error_name').innerHTML = 'Old Password Wrong';
							document.getElementById('error_pass').style.display = 'block'
							</script>";
						}

						
					}
				}
				 ?>


				<form name="changePassword" action="?" method="post" onsubmit="return userPassword()">
					<center>
						<div class="container_fluid mt-5">
							<input type="password" id="old_password" name="old_password" placeholder="Old Password" class="form-control col-3">
							<input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control col-3 mt-2">

							<input type="password" id="c_password" name="c_password" placeholder="Confirm Password" class="form-control col-3 mt-1">

							<button type="submit" name="updatePassword" class="btn btn-primary col-3 mt-5">Update Password</button>

						</div>
					</center>
				</form>
			</div>

		</div>
	</div>
</div>


<script>
		function userPassword()
		{	
			var old_password = document.forms['changePassword']['old_password'].value;
			var new_password = document.forms['changePassword']['new_password'].value
			var c_password = document.forms['changePassword']['c_password'].value

			if(old_password != "")
			{
				if(new_password != "")
				{
					if(c_password != "")
					{
						if(new_password == c_password)
						{
							document.getElementById("error_pass").style.display = "none";
							return true;
						}
						else
						{
							document.getElementById("error_name").innerHTML = "New and Confirm Password not matching";
							document.getElementById("error_pass").style.display = "block";
							return false;	
						}
					}
					else
					{
						document.getElementById("error_name").innerHTML = "Plesase fill confirm password";
						document.getElementById("error_pass").style.display = "block";
						return false;
					}
				}
				else 
				{
					document.getElementById("error_name").innerHTML = "Plesase fill new password";
					document.getElementById("error_pass").style.display = "block";
					return false;
				}
			}
			else
			{
				document.getElementById("error_name").innerHTML = "Plesase fill old password";
				document.getElementById("error_pass").style.display = "block";
				return false;
			}	
		}
	
	
	
	$("#child_data").hide();
	$("#results_data").hide();
	$("#attendance_data").hide();
	$("#changePassword_data").hide();

	$(document).ready(function(){
		$("#profile").click(function(){
			$("#child").css("backgroundColor","#343A40");
			$("#child_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#profile_data").show();
			$("#profile").css("backgroundColor","black");
		});

		$("#child").click(function(){
			
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#child_data").show();
			$("#child").css("backgroundColor","black");
		});

		

		$("#results").click(function(){
			

			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#child").css("backgroundColor","#343A40");
			$("#child_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#results_data").show();
			$("#results").css("backgroundColor","black");
		});

		$("#attendance").click(function(){
			
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#child").css("backgroundColor","#343A40");
			$("#child_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#attendance_data").show();
			$("#attendance").css("backgroundColor","black");
		});

		$("#changePassword").click(function(){
			
	
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#child").css("backgroundColor","#343A40");
			$("#child_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();

			$("#changePassword_data").show();
			$("#changePassword").css("backgroundColor","black");
		});




			



	});
	


</script>
</body>
</html>


<?php
}
else
{
	header("Location: login.php");
}


mysqli_close($connection);
 ?>