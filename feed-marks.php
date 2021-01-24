<?php
session_start();
if(isset($_SESSION['id']))
{
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Feed Marks</title>
		<style>
			.width_height{
				width: 30%;
				height: 80%;
				margin-left: 2%;
			}
			.mc{
				margin-left: 1500%;
				width: 120%;
			}
			.pending_requests{
				width: 100%;
			}
			div[class="hidden"]{
				display: none;
			}
			div[class="shown"]{
				display: block;
			}
			.successMessage{
				color: #47ad4c;
			}
			.errorMessage{
				color: #b32b2b;
			}
		</style>
		<script src="js/jquery.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body style="background-color: #BCD1A1;">
<a href="/sis/teacher_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a>

		<h2 class="display-4 text-center font-weight-bold mb-5">Feed Marks</h2>


<?php 

	include "connection.php";

	$id = $_SESSION['id'];

	$query_class = mysqli_query($connection,"SELECT * FROM all_classes");

	echo "<center>";
	echo "<form action='' method='post'>";	

	echo "<select class='form-control col-3 mb-5' name='student_row' required>";

	echo "<option class='text-center' value='' >------ Select student with course ------</option>";
	echo "<option class='text-center' value='' disabled>Student_Id - Name - Course Name - Total Marks </option>";

	
	while ($row_class = mysqli_fetch_array($query_class)) {

		$class = $row_class['classId'];
		$class_details = $row_class['classId'].'_class_details';

		$query_subjects = mysqli_query($connection,"SELECT * FROM $class_details WHERE teacher_id = '$id'");

		$query_student = mysqli_query($connection,"SELECT * FROM students WHERE study_program = '$class'");

		while ($row_student = mysqli_fetch_array($query_student)) {
		 	
		 	while ($row_subjects = mysqli_fetch_array($query_subjects)) {

			echo "<option class='text-center'>".$row_student['id']." - ".$row_student['fullname']." - ".$row_subjects['subjects']." - ".$row_subjects['total_marks']."</option>";
			}

		 }
	}
		
	

	echo "</select>";

	echo "Obtain marks:";
	
	if(isset($_POST['student_row']))
	{
		$class_result = $class.'_class_result';
		$student_row = $_POST['student_row'];
		$selected_student_id = substr($student_row,0,5);
		$obtain_marks = $_POST['obtain_marks'];
		$row = explode("-",$student_row);
		$course_name = $row[2];
		$total_marks = $row[3];

		$check = mysqli_query($connection,"SELECT * FROM $class_result WHERE student_id = '$selected_student_id' AND course_name = '$course_name'");
		$row = mysqli_num_rows($check);

		if($row)
		{
			$query_update_result = mysqli_query($connection,"UPDATE $class_result SET `student_id`='$selected_student_id',`course_name`='$course_name',`total_marks`='$total_marks',`obtain_marks`='$obtain_marks' WHERE student_id = '$selected_student_id'  AND course_name = '$course_name' "); 

			echo "<p class='text-primary'>Marks update  successfully!</p>";
		}
		else
		{

		$query_update_result = mysqli_query($connection,"INSERT INTO $class_result(student_id,course_name,total_marks,obtain_marks) VALUES ('$selected_student_id','$course_name','$total_marks','$obtain_marks') ");

			echo "<p class='text-primary'>Marks feeded successfully!</p>";
		}


		
	}

	

	echo "<input class='form-control col-1 mb-3' name='obtain_marks' type='number' max=100 min=0 required>";
	
	echo "<input class='form-control col-3 btn btn-dark mt-5' type='submit' value='Feed Marks'>";

	echo "</form>";
	echo "</center>";
?>
	
<?php
}
else
{
	header("Location: login.php");
}
?>