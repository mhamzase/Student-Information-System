<?php 
session_start();

if(isset($_SESSION['id']))
{
	?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Students Requests</title>
		<style>
			.header_font{
				font-size: 18px;
			}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.js"></script>
	</head>
	<body style="background-color: #BCD1A1;">
	
	<a href="/sis/admin_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a>
	<h1 class="text-center text-danger">Pending Requests <span class="text-dark font-weight-bold">(Time Table)</span></h1>	



		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
		
	<?php

	include "connection.php";
?>

<?php
	
	if(isset($_POST['approve']))
	{
		$message="Admin have approved your time table 🎉🎉";
		$date=date("Y/m/d");
		mysqli_query($connection,"update schooltimetable set status='accepted' where status='pendding'");
		mysqli_query($connection,"insert into Announcements value('$message','$date')");
		mysqli_query($connection,"update timetablerequests set status='accepted'");


	}	
	

	if(isset($_POST['reject']))
	{
		$message="Admin have rejected your time table 😢😢";
		$date=date("Y/m/d");
		mysqli_query($connection,"delete from schooltimetable where status='pendding'");
		mysqli_query($connection,"insert into Announcements value('$message','$date')");
		mysqli_query($connection,"delete from  timetablerequests where status='pending'");
		
	}


	echo"
	<table border='1px solid black'  class='text-dark w-100 text-center header_font'>
	<tr class='bg-dark text-white'>
	<th>classname</th> <th>subjectname</th> <th>Monday</th> <th>TUESDAY</th>  <th>WEDNESDAY</th> <th>THURSDAY</th><th>FRIDAY</th><th>SATURDAY</th><th>teacherName</th><th>teacherId</th> 
	</tr>";
	$status = "pendding";
	$query_id = "SELECT * FROM schooltimetable WHERE status = '$status'";
	$query_result1 = mysqli_query($connection,$query_id);
	$result1_count = mysqli_num_rows($query_result1);

	if($result1_count >0)
	{
		
		while ($row2 = mysqli_fetch_array($query_result1))
		{
		
		
			echo "
			<tr>
			<form method='post' action='?'>";
			
	     	echo "<td><input name='user_id' type='hidden' value='$row2[0]'>".$row2[0]."</td>";
	     	echo "<td>".$row2[1]."</td>";
	     	echo "<td>".$row2[2]."</td>";
	     	echo "<td>".$row2[3]."</td>";
	     	echo "<td>".$row2[4]."</td>";
             echo "<td>".$row2[5]."</td>";
             echo "<td>".$row2[6]."</td>";
             echo "<td>".$row2[7]."</td>";
             echo "<td>".$row2[8]."</td>";
             echo "<td>".$row2[9]."</td>";
             

             
	     	
			 
			 echo "
			
			 
			</tr>";

						
		}			
		echo "
	
		</table><br/> <button class='btn btn-success text-white' id='approve_btn' type='submit' name='approve' >Approve</button>
		<button class='btn btn-danger text-white ' type='submit' name='reject' >Reject</button>
		</form>";
	}	
	

    

	
?>

<?php
mysqli_close($connection);
}
else
{
	header("Location: login.php");
}

 ?>