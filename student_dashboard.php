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

				$query_gender = "SELECT * FROM students WHERE id = '$id'";
				$result_gender = mysqli_query($connection,$query_gender) or die(mysqli_error($connection));

				if($row = mysqli_fetch_array($result_gender))
				{
					$gender = $row['gender'];
					$fullname = $row['fullname'];
				}

				if($gender == "male")
				{
					?>
					<center><img src="images/male.png" alt="male profile picture" width="180px"></center>
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

			 <button id="subjects" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1; background-color: black">Subjects</button>
			 <button id="profile" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Profile</button>

			 <button id="parents" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Parents Profile</button>
			 <button id="results" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Results</button>
			 <button id="attendance" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Attendance</button>
			 <button id="changePassword" class="row btn btn-dark col-8 float-right" style="border-bottom: 1px solid #BCD1A1">Change Password</button>

			 <form action="?" method="post">
			 <button name="logout" type="submit" value="logout" class="row btn btn-danger col-8 float-right mt-5">Logout</button>
			 </form>

		</div>


		<!-- right side panel -->
		<div class="col-9"  style="margin: 0;padding: 0; background-color: #BCD1A1;" >

			<!-- student subjects -->
			<div id="subjects_data">
				<p class="display-4 font-weight-bold text-center">Subjects</p>

				<?php

				$study_prog = $row['study_program'];
				$class_student = $study_prog."_class_students";

				$prog_details = $study_prog."_class_details";
				$query_books = mysqli_query($connection,"SELECT * FROM $prog_details");

				?>
				<center>
					<table class="table table-dark table-striped table-hover col-3 text-center font-weight-bold">
						<thead>
							<tr></tr>
						</thead>
				<?php
				while ($row_books = mysqli_fetch_array($query_books))
				{
					$query_class = mysqli_query($connection,"SELECT * FROM $class_student");
					while ($row_class = mysqli_fetch_array($query_class))
					{
						$temp_query = mysqli_query($connection,"SELECT $row_books[1] FROM $class_student WHERE st_id = '$id' AND $row_books[1] = 'selected'") or die (mysqli_error($connection));

						while ($temp_row = mysqli_fetch_array($temp_query))
						{
							?>
						 		<tr>
							 		<td><span> <?php echo $row_books[1] ?> </span></td>
						 		</tr>
							<?php
						}
					}
				}
				?>
					</table>
				</center>

			</div>

			<!-- student profile -->
			<div id="profile_data" style="height: 100%;">
				<p class="text-center font-weight-bold display-4">Profile</p>
				<?php

					$id = $row['id'];
					$fullname = $row['fullname'];
					$email = $row['email'];
					$address = $row['address'];
					$phone = $row['phone'];
					$gender = $row['gender'];
					$dob = $row['dob'];
					$study_prog = $row['study_program'];
					$parent_id = $row['parent_id'];
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
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Date Of Birth</span></td>
				 			<td><span> <?php echo $dob ?> </span></td>
				 		</tr>
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Enrolled Class</span></td>
				 			<td><span> <?php echo $study_prog ?> </span></td>
				 		</tr>
				 		<tr>
				 			<td><span class="font-weight-bold" style="color:#BCD1A1">Parents ID</span></td>
				 			<td><span> <?php echo $parent_id ?> </span></td>
				 		</tr>

				 	</table>
				 	</div>
				 </center>
			</div>



			<!-- parent profile realted to student -->
			<div id="parents_data">
				<p class="display-4 font-weight-bold text-center">Parents Profile</p>

				<?php
					if($parent_id == "")
					{
						?>
						<p class="display-4 font-weight-bold text-center text-danger">Parents Not Found</p>
						<?php
					}
					else
					{
						$query_parents = "SELECT * FROM parents WHERE id = '$parent_id'";
						$result_parents = mysqli_query($connection,$query_parents)  or die(mysqli_error($connection));

						if($row_parent = mysqli_fetch_array($result_parents))
						{
							$p_fullname = $row_parent['fullname'];
							$p_email = $row_parent['email'];
							$p_address = $row_parent['address'];
							$p_phone = $row_parent['phone'];
							$p_childID = $row_parent['child_id'];
						}

						?>

						<center>
				 	<div class="container" style="font-size: 20px;">
					 	<table class="table table-dark table-sm table-striped">
					 		<tr>
						 		<td><span class="font-weight-bold" style="color:#BCD1A1">ID</span></td>
						 		<td><span> <?php echo $parent_id ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Full Name</span></td>
					 			<td><span> <?php echo $p_fullname ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Email</span></td>
					 			<td><span> <?php echo $p_email ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Address</span></td>
					 			<td><span> <?php echo $p_address ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Phone</span></td>
					 			<td><span> <?php echo $p_phone ?> </span></td>
					 		</tr>
					 		<tr>
					 			<td><span class="font-weight-bold" style="color:#BCD1A1">Child ID</span></td>
					 			<td><span> <?php echo $p_childID ?> </span></td>
					 		</tr>
					 	</table>
				 	</div>
				 </center>


						<?php
					}
				 ?>
			</div>


			<!-- results -->
			<div id="results_data">
				<p class="display-4 font-weight-bold text-center">Results</p>


				<?php

				$study_prog = $row['study_program'];
				$class_student = $study_prog."_class_students";

				$prog_details = $study_prog."_class_details";
				$query_books = mysqli_query($connection,"SELECT * FROM $prog_details");

				?>
				<center>
					<table class="table table-striped table-hover col-5 text-center font-weight-bold">
						<thead>
							<tr>
								<th class="bg-dark text-white">Subjects</th>
								<th class="bg-dark text-white">Total Marks</th>
								<th class="bg-dark text-white">Obtain Marks</th>
							</tr>
						</thead>
				<?php
				$total_marks = 0;
				$total_obtain = 0;

				while ($row_books = mysqli_fetch_array($query_books))
				{
					$query_class = mysqli_query($connection,"SELECT * FROM $class_student");
					while ($row_class = mysqli_fetch_array($query_class))
					{
						$temp_query = mysqli_query($connection,"SELECT $row_books[1] FROM $class_student WHERE st_id = '$id' AND $row_books[1] = 'selected'") or die (mysqli_error($connection));


						$class_result = $study_prog."_class_result";
						$query_obtain_marks = mysqli_query($connection,"SELECT * FROM $class_result WHERE student_id = '$id'");

						while ($row_obtain = mysqli_fetch_array($query_obtain_marks)) {
							$total_obtain = $total_obtain + (int)$row_obtain[4];
						}

						while ($temp_row = mysqli_fetch_array($temp_query))
						{


							?>
						 		<tr>
							 		<td class="bg-light"><span> <?php echo $row_books[1] ?> </span></td>
							 		<td class="bg-light"><span> <?php echo $row_books[2] ?> </span></td>
									<td class="bg-light"><span> <?php echo "-" ?></span></td>

						 		</tr>

							<?php

								$total_marks = $total_marks + (int)$row_books[2];
						}

					}
				}


				?>
				<tr>
					<th class="bg-dark text-white">Result</th>
					<th class="bg-light border border-dark"><?php echo $total_marks; ?></th>
					<th class="bg-light border border-dark"><?php echo "-" ?></th>
				</tr>
					</table>
				</center>

			</div>



			<!-- attendance -->
			<div id="attendance_data">
				<center>
					<p class="display-4 font-weight-bold text-center">Attendance</p>
                    <div class="container" style="font-size: 20px;">
                        <table class="table table-striped">
                        <thead class="bg-dark text-white">
                            <th>Course name</th>
                            <th>Attendance status</th>
                            <th>Date&Time</th>
                        </thead>

					<?php
                    $id = $_SESSION['id'];
                    $class_attendance = $study_prog."_class_attendance";
                    $query = mysqli_query($connection,"SELECT * FROM $class_attendance");
                    while($result = mysqli_fetch_array($query))
                    {
                        ?>
                        <tr class="bg-white">
                            <td><span> <?php echo $result['course_name'] ?> </span></td>
                            <td><span> <?php echo $result['attendance_status'] ?> </span></td>
                            <td><span> <?php echo $result['date'] ?> </span></td>
                        </tr>
                        <?php
                    }
                    ?>
                        </table>
                    </div>
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

					$pass_query = mysqli_query($connection,"SELECT * FROM students WHERE id = '$id'") or die(mysqli_error($connection));

					if($row_pass = mysqli_fetch_array($pass_query))
					{
						$old_pass = $row_pass['password'];

						if($old_pass == $old_password)
						{
							echo "<script>
							document.getElementById('success_name').innerHTML = 'Password Updated Successfully';
							document.getElementById('success_pass').style.display = 'block'
							</script>";
							$insert_query = mysqli_query($connection,"UPDATE students SET password = $new_password WHERE id = '$id'") or die(mysqli_error($connection));
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

	$("#profile_data").hide();
	$("#teacher_data").hide();
	$("#parents_data").hide();
	$("#results_data").hide();
	$("#attendance_data").hide();
	$("#changePassword_data").hide();

	$(document).ready(function(){
		$("#subjects").click(function(){
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#teacher").css("backgroundColor","#343A40");
			$("#teacher_data").hide();
			$("#parents").css("backgroundColor","#343A40");
			$("#parents_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#subjects_data").show();
			$("#subjects").css("backgroundColor","black");
		});

		$("#profile").click(function(){

			$("#subjects").css("backgroundColor","#343A40");
			$("#subjects_data").hide();
			$("#teacher").css("backgroundColor","#343A40");
			$("#teacher_data").hide();
			$("#parents").css("backgroundColor","#343A40");
			$("#parents_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#profile_data").show();
			$("#profile").css("backgroundColor","black");
		});

		$("#teacher").click(function(){

			$("#subjects").css("backgroundColor","#343A40");
			$("#subjects_data").hide();
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#parents").css("backgroundColor","#343A40");
			$("#parents_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#teacher_data").show();
			$("#teacher").css("backgroundColor","black");
		});

		$("#parents").click(function(){

			$("#subjects").css("backgroundColor","#343A40");
			$("#subjects_data").hide();
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#teacher").css("backgroundColor","#343A40");
			$("#teacher_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#parents_data").show();
			$("#parents").css("backgroundColor","black");
		});

		$("#results").click(function(){

			$("#subjects").css("backgroundColor","#343A40");
			$("#subjects_data").hide();
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#teacher").css("backgroundColor","#343A40");
			$("#teacher_data").hide();
			$("#parents").css("backgroundColor","#343A40");
			$("#parents_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#results_data").show();
			$("#results").css("backgroundColor","black");
		});

		$("#attendance").click(function(){

			$("#subjects").css("backgroundColor","#343A40");
			$("#subjects_data").hide();
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#teacher").css("backgroundColor","#343A40");
			$("#teacher_data").hide();
			$("#parents").css("backgroundColor","#343A40");
			$("#parents_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#changePassword").css("backgroundColor","#343A40");
			$("#changePassword_data").hide();

			$("#attendance_data").show();
			$("#attendance").css("backgroundColor","black");
		});

		$("#changePassword").click(function(){

			$("#subjects").css("backgroundColor","#343A40");
			$("#subjects_data").hide();
			$("#profile").css("backgroundColor","#343A40");
			$("#profile_data").hide();
			$("#teacher").css("backgroundColor","#343A40");
			$("#teacher_data").hide();
			$("#parents").css("backgroundColor","#343A40");
			$("#parents_data").hide();
			$("#results").css("backgroundColor","#343A40");
			$("#results_data").hide();
			$("#attendance").css("backgroundColor","#343A40");
			$("#attendance_data").hide();

			$("#changePassword_data").show();
			$("#changePassword").css("backgroundColor","black");
		});




		$("#attendace_btn").click(function(){
			$(this).prop('disabled', true);
			// $(this).css("backgroundColor","gray");

			$(this).css("border","1px solid #999999");
			// $(this).css("color","black");

			$("#notify_attendance").text('You attendance marked successfully for TODAY');

const span = document.getElementById('showtimer')

const deadline = new Date
deadline.setHours(0)
deadline.setMinutes(0)
deadline.setSeconds(0)

function displayRemainingTime() {
  if (deadline < new Date) deadline.setDate(deadline.getDate() + 1)
  const remainingTime = deadline - new Date
  const extract = (maximum, factor) => Math.floor((remainingTime % maximum) / factor)
  const seconds = extract(   10000, 1000   )
  const minutes = extract( 1000000, 10000  )
  const hours   = extract(86400000, 1000000)
  const string = `${hours} Hours ${minutes} Minutes ${seconds} Seconds Remaining`
  span.innerText = `${hours} Hours ${minutes} Minutes ${seconds} Seconds Remaining`
}
window.setInterval(displayRemainingTime, 1000)
displayRemainingTime()



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
