<?php
session_start();

if(isset($_POST['logout']))
{
	session_destroy();
	header("Location: login.php");
}


			include "connection.php";
			$id = $_SESSION['id'];

			$query_session = "SELECT * FROM students WHERE id = '$id'";
			$result_session = mysqli_query($connection,$query_session) or die(mysqli_error($connection));

			if($row_session = mysqli_fetch_array($result_session))
			{
				$enrolled_class = $row_session['enrolled_class'];
			}


if(isset($_SESSION['id']) && $enrolled_class == "undefined")
{
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Subjects Selection</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.js"></script>
	</head>
	<body style="background-color: #BCD1A1;">

		<div class="row">
			<div class="col-lg-12">
				<form action="?" method="post">
					<input class="btn btn-danger float-right mt-3 mr-3" name="logout" type="submit" value="logout">
		    	</form>
			</div>
		</div>
			
		

	<div style="margin-top: 100px;">
			
		
		<?php
			$query1 = "SELECT * FROM students WHERE id = '$id'";
			$result1 = mysqli_query($connection,$query1) or die(mysqli_error($connection));
			
			$subjects_name = array();


			if($row1 = mysqli_fetch_array($result1))
			{
				$study_prog = $row1['study_program'];

				$query2 = "SELECT * FROM $study_prog";
				$result2 = mysqli_query($connection,$query2) or die(mysqli_error($connection));

				if($row2 = mysqli_fetch_array($result2))
				{
					$total_subjects = $row2['totalSubjects'];
					$min_required = $row2['minRequired'];
				}

				$prog_details = $study_prog."_class_details";

				$query3 = "SELECT subjects FROM $prog_details";
				$result3 = mysqli_query($connection,$query3) or die(mysqli_error($connection));
			}
			

			?>

			<div id="error" style="display: none; font-size: 20px" class="text-center font-weight-bold text-danger">Minimum <?php echo $min_required ?> subjects required!</div>

			<?php


			echo "<form action='?' method='get' onsubmit='return check()'>
			<table class='table table-striped table-dark w-25 m-auto'>
			<tr class='text-center'><td>Total Subjects : <b class='text-warning' style='font-size:20px'>$total_subjects</b></td><td>  Minimum Required:<b class='text-info' style='font-size:20px'> $min_required</b></td></tr>
				<tr><th class='text-center' colspan='2'>Class <span class='text-danger' style='font-size:20px'>$study_prog</span> Subjects Offered List</th></tr>";

				if (mysqli_num_rows($result3) > 0) 
				{
					$count=1;
					$i=0;

					while($row3 = mysqli_fetch_assoc($result3)) 
					{
						$subjects_name[$i] = $row3["subjects"];

					    echo "<tr class='text-center'><td><input type='checkbox' name='subjects[]' id='$count' value='".$row3['subjects']."'></td><td>".$row3['subjects']."</td></tr>";

					    $count++;
					    $i++;
					}

					$class_students = $study_prog."_class_students";

					$val = mysqli_query($connection,"SELECT 1 FROM $class_students LIMIT 1");


					function five(){
						global $val , $subjects_name, $connection , $class_students;

						$id = $_SESSION['id'];
						$val = mysqli_query($connection,"SELECT 1 FROM $class_students LIMIT 1");

						if($val == FALSE)
						{

							$query_table = "CREATE TABLE $class_students(
										st_id varchar(255) primary key,
										$subjects_name[0] text,
										$subjects_name[1] text,
										$subjects_name[2] text,
										$subjects_name[3] text,
										$subjects_name[4] text,
										totalMarks int,
										obtainMarks int)";
							$result_table = mysqli_query($connection,$query_table) or die (mysqli_error($connection));

							$query_five = mysqli_query($connection,"INSERT INTO $class_students VALUES ('$id','unselected','unselected','unselected','unselected','unselected','0','0')") or die(mysqli_error($connection));
						
					}
				}

					function six(){
						$id = $_SESSION['id'];

						global $val , $subjects_name, $connection , $class_students;
						$val = mysqli_query($connection,"SELECT 1 FROM $class_students LIMIT 1");

						if($val == FALSE)
						{
							five();

							$query_s = mysqli_query($connection,"ALTER TABLE $class_students ADD $subjects_name[5] text NOT NULL AFTER $subjects_name[4]");
							$query_six = mysqli_query($connection,"UPDATE $class_students SET $subjects_name[5] = 'unselected' WHERE st_id = '$id'");
						}
						else
						{
							$query_s = mysqli_query($connection,"ALTER TABLE $class_students ADD $subjects_name[5] text NOT NULL AFTER $subjects_name[4]");
							$query_six = mysqli_query($connection,"UPDATE $class_students SET $subjects_name[5] = 'unselected' WHERE st_id = '$id'");
						}
						
					}
					

					function seven(){
						$id = $_SESSION['id'];
						global $val , $subjects_name, $connection , $class_students;
						if($val == FALSE)
						{
							five();
							six();
							$query_s = mysqli_query($connection,"ALTER TABLE $class_students ADD $subjects_name[6] text NOT NULL AFTER $subjects_name[5]");
							$query_six = mysqli_query($connection,"UPDATE $class_students SET $subjects_name[6] = 'unselected' WHERE st_id = '$id'");
						}
						else
						{
							$query_s = mysqli_query($connection,"ALTER TABLE $class_students ADD $subjects_name[6] text NOT NULL AFTER $subjects_name[5]");
							$query_six = mysqli_query($connection,"UPDATE $class_students SET $subjects_name[6] = 'unselected' WHERE st_id = '$id'");
						}
						
					}
					

				}		
			echo "</table>
			<center><button type='submit' name='dashboard' class='btn btn-primary w-25 mt-3'>Go To Dashboard</button></center>
			</form>";



			if(isset($_GET['dashboard']))
			{
				global $count;

						if($count-1 == 5)
						{
							five();
						}
					    
					    if($count-1 == 6)
						{
							six();
						}

						if($count-1 == 7)
						{
							seven();
						}


				$name = $_GET['subjects'];
				$totalMarks = 0;

				foreach ($name as $sub){ 
					echo $sub."<br />";

					$query_marks = mysqli_query($connection,"SELECT total_marks FROM $prog_details WHERE subjects = '$sub'")  or die(mysqli_error($connection));

					while ($marks = mysqli_fetch_array($query_marks)) {
						$totalMarks = $totalMarks + (int)$marks[0];
					}

					$id = $_SESSION['id'];
					$query_update = mysqli_query($connection,"UPDATE $class_students SET $sub = 'selected' , totalMarks = '$totalMarks' WHERE st_id = '$id'");
				}


				$query4 = "UPDATE students SET enrolled_class = '$study_prog' WHERE id = '$id'";
				$result4 = mysqli_query($connection,$query4) or die(mysqli_error($connection));


				header("Location: student_dashboard.php");
			}


		?>


		



		<script>
			function check()
			{
				var total = <?php echo $total_subjects ?>;
				var min = <?php echo $min_required ?>;

				var counter=0

				if(total == 5)
				{
					var sub1 = document.getElementById("1");
					var sub2 = document.getElementById("2");
					var sub3 = document.getElementById("3");
					var sub4 = document.getElementById("4");
					var sub5 = document.getElementById("5");

					if(sub1.checked)
					{
						counter++;
					}
					if(sub2.checked)
					{
						counter++;
					}
					if(sub3.checked)
					{
						counter++;
					}
					if(sub4.checked)
					{
						counter++;
					}
					if(sub5.checked)
					{
						counter++;
					}

					if(total == counter || min == counter)
					{
						document.getElementById("error").style.display = "none";
						return true;
					}
					else
					{
						document.getElementById("error").style.display = "block";
						return false;
					}
				}

				if(total == 6)
				{
					var sub1 = document.getElementById("1");
					var sub2 = document.getElementById("2");
					var sub3 = document.getElementById("3");
					var sub4 = document.getElementById("4");
					var sub5 = document.getElementById("5");
					var sub6 = document.getElementById("6");

					if(sub1.checked)
					{
						counter++;
					}
					if(sub2.checked)
					{
						counter++;
					}
					if(sub3.checked)
					{
						counter++;
					}
					if(sub4.checked)
					{
						counter++;
					}
					if(sub5.checked)
					{
						counter++;
					}
					if(sub6.checked)
					{
						counter++;
					}

					if(total == counter || min == counter)
					{
						document.getElementById("error").style.display = "none";
						return true;
					}
					else
					{
						document.getElementById("error").style.display = "block";
						return false;
					}
				}

				if(total == 7)
				{
					var sub1 = document.getElementById("1");
					var sub2 = document.getElementById("2");
					var sub3 = document.getElementById("3");
					var sub4 = document.getElementById("4");
					var sub5 = document.getElementById("5");
					var sub6 = document.getElementById("6");
					var sub7 = document.getElementById("7");

					if(sub1.checked)
					{
						counter++;
					}
					if(sub2.checked)
					{
						counter++;
					}
					if(sub3.checked)
					{
						counter++;
					}
					if(sub4.checked)
					{
						counter++;
					}
					if(sub5.checked)
					{
						counter++;
					}
					if(sub6.checked)
					{
						counter++;
					}

					if(sub7.checked)
					{
						counter++;
					}

					if(total == counter || min == counter)
					{
						document.getElementById("error").style.display = "none";
						return true;
					}
					else
					{
						document.getElementById("error").style.display = "block";
						return false;
					}
				}
				
				
			}
		</script>

	</div>	
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php 
}
else
{
	if(isset($_SESSION['id']) && $enrolled_class != "undefined")
	{
		header("Location: student_dashboard.php");
	}
	else
	{
		header("Location: login.php");
	}
	
}

mysqli_close($connection);
 ?>