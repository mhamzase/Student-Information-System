<?php 
session_start();
if(isset($_POST['submit']))
{
	session_destroy();
	header("Location: login.php");
}
if(isset($_SESSION['id']))
{
	?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Dashboard</title>
		<style>
			.width_height{
				width: 30%;
				height: 79%;
				margin-left: 2%;
			}
			.logout{
				float: right;
				width: 100%;
				margin-top: 15px;
			}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.js"></script>
	</head>
	<body style="background-color: #BCD1A1; overflow-x:hidden" >
		
<!-- Header -->
<div class= "row bg-dark text-white ">
	<img class="ml-4" src="images/admin_profile.png" alt="Admin profile image">
	<h3 class=" font-weight-bold mt-4 ml-3">Administrator</h3>
	<form method="post" action="?" class="ml-3 mt-1">
		<input class="btn btn-danger ml-5 logout" name="submit" type="submit" value="logout">
	</form>
</div>
		

<!-- Body -->
<center>
	<div class="row mt-3 container-fluid pending_requests ">
		<div class="ml-1 col-5 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 100%;">
			<h4>Pending Requests</h4>
			<a href="students_regis_requests.php"><button class="btn btn-dark width_height pt-3" name="request_btn"><img src="images/student_pic.png" alt="pending users logo" width="25%"><p class="font-weight-bold text-center">STUDENTS</p></button></a>

		  	<a href="teachers_regis_requests.php"><button class="btn btn-dark width_height pt-3" name="request_btn"><img src="images/teacher.png" alt="pending users logo" width="26%"><p class="font-weight-bold text-center">TEACHERS</p></button></a>

		  	<a href="parents_regis_requests.php"><button class="btn btn-dark width_height pt-3" name="request_btn"><img src="images/parent.png" alt="pending users logo" width="25%"><p class="font-weight-bold text-center">PARENTS</p></button></a>

		</div>

	 	
	 	<div class="col-4 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 60%;">
			<h4>Create Classes</h4>
			<a href="create_classes.php"><button class="btn btn-dark w-100" name="request_btn"><img src="images/createclass.png" alt="pending users logo" width="25%"><p class="font-weight-bold text-center">Create</p></button></a>
		</div>
			
	 	
	 	
 

 		<hr width="100%">

	</div>
	<div class="row mt-3 container-fluid pending_requests ">

	<div class="col-4 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 60%;">
			<h4>Allocate Course(s) to a Teacher.</h4>
			<a href="allocate_courses.php"><button class="btn btn-dark w-100" name="request_btn"><img src="images/allocate_courses.png" alt="pending users logo" width="25%"><p class="font-weight-bold text-center">Allocate Course(s)</p></button></a>
	</div>	

	<div class="ml-1 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 50%;">
			<h4>Pending Requests</h4>
			<a href="time_table_requests.php"><button class="btn btn-dark width_height pt-3" name="request_btn"><img src="images/timeTableIcon.png" alt="pending users logo" width="50%"><p class="font-weight-bold text-center">TimeTable</p></button></a>
	</div>

	 	
	 	
 

 		<hr width="100%">

	</div>
	
</center>

		<script src="js/bootstrap.min.js"></script>
	</body>
</html>


<?php
}
else
{
	header("Location: login.php");
}
 ?>


