<?php

session_start();
include("connection.php");
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
		<title>Teacher Dashboard</title>
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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script src="js/jquery.js"></script>
	</head>
	<body style="background-color: #BCD1A1; overflow-x:hidden" >
		
<!-- Header -->
<div class= "row bg-dark text-white ">
	<img class="ml-4" src="images/admin_profile.png" alt="Admin profile image">
	<h3 class=" font-weight-bold mt-4 ml-3">
	<?php
				$data=mysqli_query($connection,"select fullname from teachers where id='$_SESSION[id]'");
				$data=mysqli_fetch_array($data);
				$_SESSION['teachername']=$data[0];
				echo  strtoupper($data[0]);
	?>
		
	</h3>
	<style>
			.logout{
				position: relative;
				left: 20px;
				top: 10px;
				
			}
	</style>
	
	<form method="post" action="?"  id="logout">
		<input class="btn btn-danger mr-2 logout" name="submit" type="submit" value="logout">
	</form> 

	</div>


<!-- Body -->
<center>
	<div class="row mt-3 container-fluid pending_requests ">
	<div class="col-4 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 60%;">
			<h4>SCHEDULE CLASSES   </h4>
			<a href="table_table_maker.php"><button class="btn btn-dark w-100" name="request_btn"><br/><p class="font-weight-bold text-center"><img src="images/timeTableIcon.png" alt="timeTable users logo" width="25%"><br/>TIME TABLE</p></button></a>
		</div>
	

	
	 	
	 	<div class="col-3 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 60%;">
			<h4>ATTENDANCE </h4>
			<a href="mark_attendance.php"><button class="btn btn-dark w-100" name="request_btn"><br/><img src="images/attendanceIcon.png" alt="ATTENDANCE users logo" width="25%"><br/><br><p class="font-weight-bold text-center">MARK ATTENDANCE </p></button></a>
		</div>


	 	
	 	<div class="col-4 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 60%;">
			<h4>STUDENTS RESULT</h4>
			<a href="feed-marks.php"><button class="btn btn-dark w-100" name="request_btn"><br/><img src="images/databaseIcon.png" alt="database users logo" width="25%"><br/><p class="font-weight-bold text-center">FEED MARKS</p></button></a>
		</div>
 

 		<hr width="100%">

	</div>
	<div class="row mt-3 container-fluid pending_requests ">
	<div class="col-4 ml-4" style="border-left:10px solid #343A40; background-color:#bbbcbd; padding-bottom: 1%;width: 60%;">
			<h4>Announcements</h4>
			<a href="Announcements.php"><button class="btn btn-dark w-100" name="request_btn"><br/><p class="font-weight-bold text-center"><img src="images/anncoucements.png" alt="timeTable users logo" width="25%"><br/>Announcements </p></button></a>
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


