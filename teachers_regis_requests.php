<?php 
session_start();

if(isset($_SESSION['id']))
{
	?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Teachers Requests</title>
		<style>
			.header_font{
				font-size: 18px;
			}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body style="background-color: #BCD1A1;">
	
	<a href="/sis/admin_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a>
	<h1 class="text-center text-danger">Pending Requests <span class="text-dark font-weight-bold">(TEACHERS)</span></h1>	



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
		$user_id=$_POST['user_id'];

		$query = "UPDATE users SET status='active', role='teacher' WHERE id = '$user_id'";
		$query_result = mysqli_query($connection,$query);

		$query2 = "SELECT * FROM teachers WHERE id = '$user_id'";
		$query2_result = mysqli_query($connection,$query2);
		
		if($get_data = mysqli_fetch_array($query2_result))
		{
			$fullname = $get_data['fullname'];
			$password = $get_data['password'];
			$email = $get_data['email'];
			$subject = "Registration";		
$body = "Dear Teacher | $fullname | Your Registration request has been approved.
Your ID and PASSWORD is given below:
ID: $user_id
PASSWORD: $password";
			$senderEmail = "From: sidrachoudry56@gmail.com";

			mail($email,$subject,$body,$senderEmail);	
		}	
}

if(isset($_POST['reject']))
{
		$user_id=$_POST['user_id'];

		$query2 = "SELECT * FROM teachers WHERE id = '$user_id'";
		$query2_result = mysqli_query($connection,$query2);

		if($get_data = mysqli_fetch_array($query2_result))
		{
			$fullname = $get_data['fullname'];
			$email = $get_data['email'];
			$subject = "Registration";		
			$body = "Dear Teacher | $fullname | Your Registration request has been rejected.";
			$senderEmail = "From: sidrachoudry56@gmail.com";

			mail($email,$subject,$body,$senderEmail);	
		}

		$delete_query = "DELETE FROM users WHERE id='$user_id'";
		$query_result = mysqli_query($connection,$delete_query);

		$delete_query1 = "DELETE FROM teachers WHERE id='$user_id'";
		$query_result1 = mysqli_query($connection,$delete_query1);
}

	echo"
	<table border='1px solid black' class='text-dark w-100 text-center header_font'>
	<tr class='bg-dark text-white'>
	<th>ID</th> <th>Fullname</th> <th>Email</th> <th>Gender</th>  <th>Qualification</th> <th>Action</th>
	</tr>";

	$status = "pending";

	$query_id = "SELECT id FROM users WHERE status = '$status'";
	$query_result1 = mysqli_query($connection,$query_id);
	$result1_count = mysqli_num_rows($query_result1);

	if($result1_count >0)
	{
		while ($row = mysqli_fetch_array($query_result1))
		{
			$db_id = $row['id'];

			$query_data2 = "SELECT * FROM teachers WHERE id = '$db_id'";
			$query_result2 = mysqli_query($connection,$query_data2);
			while($row2 = mysqli_fetch_array($query_result2)){


			echo "<tr>
			<form method='post' action='?'>";
			
	     	echo "<td><input name='user_id' type='hidden' value='$row2[0]'>".$row2[0]."</td>";
	     	echo "<td>".$row2[1]."</td>";
	     	echo "<td>".$row2[2]."</td>";
	     	echo "<td>".$row2[6]."</td>";
	     	echo "<td>".$row2[8]."</td>";
	     	echo "<td>
	     	<button class='btn btn-success text-white' id='approve_btn' type='submit' name='approve' >Approve</button>
			<button class='btn btn-danger text-white ' type='submit' name='reject' >Reject</button>
	     	</td>";
	     	echo "</form></tr>";


			}			
		}			
	}	
    echo "</table> ";

?>

<?php
mysqli_close($connection);
}
else
{
	header("Location: login.php");
}

 ?>