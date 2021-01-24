<?php
session_start();
if(isset($_SESSION['id']))
{
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Create Class</title>
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


		<a href="/sis/admin_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a>
		<h2 class="display-4 text-center font-weight-bold mb-5">Create Class</h2>


<?php 

	include "connection.php";

	if(isset($_POST['submit']))
	{
		$class_id = $_POST['class_id'];
		$class_name = $_POST['class_name'];

		$select_subjects = $_POST['select_subjects'];
		$min_required = $_POST['min_required'];

		if($select_subjects == '5')                        
		{
			$class = "CREATE TABLE $class_name (
			        classId int(10)  PRIMARY KEY, 
			        totalSubjects VARCHAR(10) NOT NULL,
			        minRequired VARCHAR(10)
			        )";

			if (mysqli_query($connection, $class))
			{
				?>
				<p class="successMessage text-center font-weight-bold">Class Created Successfully!</p>
  				<?php
			}
			else
			{
				?>
				<p class="errorMessage text-center font-weight-bold">Error! to creating class</p>
  				<?php
			}

			$insert_query = "INSERT INTO $class_name values ('$class_id' , '$select_subjects' , '$min_required')";
			$result = mysqli_query($connection,$insert_query) or die(mysqli_error($connection));

			$insertAllClasses = "INSERT INTO all_classes values ('$class_name')";
			mysqli_query($connection,$insertAllClasses);

			$class_details_name = $class_name.'_class_details';

			$class_details = "CREATE TABLE $class_details_name (
					class_name VARCHAR(30),
			        subjects VARCHAR(255) , 
			        total_marks VARCHAR(30),
			        teacher_id VARCHAR(30)
			        )";
			mysqli_query($connection, $class_details);


			$class_attendance = $class_name.'_class_attendance';

			$class_attend = "CREATE TABLE $class_attendance (
			        attendance_id int(10) PRIMARY KEY AUTO_INCREMENT, 
			        student_id varchar(10),
			        student_name varchar (50),
			        course_name varchar (40),
			        attendance_status VARCHAR(30),
			        date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
			        
			        )";
			mysqli_query($connection, $class_attend);


			$class_result = $class_name.'_class_result';

			$class_res = "CREATE TABLE $class_result (
			        f_m int(30) PRIMARY KEY AUTO_INCREMENT, 
			        student_id VARCHAR(10),
			        course_name VARCHAR(30),
			        total_marks VARCHAR(30),
			        obtain_marks VARCHAR(30)
			        )";
			mysqli_query($connection, $class_res);

			$subject1 = $_POST['subject1'];
			$subject2 = $_POST['subject2'];
			$subject3 = $_POST['subject3'];
			$subject4 = $_POST['subject4'];
			$subject5 = $_POST['subject5'];

			$sub1marks = $_POST['sub1marks'];
			$sub2marks = $_POST['sub2marks'];
			$sub3marks = $_POST['sub3marks'];
			$sub4marks = $_POST['sub4marks'];
			$sub5marks = $_POST['sub5marks'];

			$record1 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject1','$sub1marks','unallocate')";
			$result1 = mysqli_query($connection,$record1) or die(mysqli_error($connection));

			$record2 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject2','$sub2marks','unallocate')";
			$result2 = mysqli_query($connection,$record2) or die(mysqli_error($connection));

			$record3 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject3','$sub3marks','unallocate')";
			$result3 = mysqli_query($connection,$record3) or die(mysqli_error($connection));

			$record4 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject4','$sub4marks','unallocate')";
			$result4 = mysqli_query($connection,$record4) or die(mysqli_error($connection));

			$record5 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject5','$sub5marks','unallocate')";
			$result5 = mysqli_query($connection,$record5) or die(mysqli_error($connection));

			$_POST['class_id'] = "";
			$_POST['class_name'] = "";
		
		}
		if ($select_subjects == '6') {
			$class = "CREATE TABLE $class_name (
			        classId VARCHAR(10)  PRIMARY KEY, 
			        totalSubjects VARCHAR(10) NOT NULL,
			        minRequired VARCHAR(10)
			        )";

			if (mysqli_query($connection, $class))
			{
				?>
				<p class="successMessage text-center font-weight-bold">Class Created Successfully!</p>
  				<?php
			}
			else
			{
				?>
				<p class="errorMessage text-center font-weight-bold">Error! to creating class</p>
  				<?php
			}

			$insert_query = "INSERT INTO $class_name values ('$class_id' , '$select_subjects' , '$min_required')";
			$result = mysqli_query($connection,$insert_query) or die(mysqli_error($connection));

			$insertAllClasses = "INSERT INTO all_classes values ('$class_name')";
			mysqli_query($connection,$insertAllClasses);

			$class_details_name = $class_name.'_class_details';

			$class_details = "CREATE TABLE $class_details_name (
					class_name VARCHAR(30) ,
			        subjects VARCHAR(255) , 
			        total_marks VARCHAR(30),
			        teacher_id VARCHAR(30)
			        )";
			mysqli_query($connection, $class_details);

			$class_attendance = $class_name.'_class_attendance';

			$class_attend = "CREATE TABLE $class_attendance (
			        attendance_id int(10) PRIMARY KEY AUTO_INCREMENT, 
			        student_id varchar (10),
			        student_name varchar (50),
			        course_name varchar (40),
			        attendance_status VARCHAR(30),
			        date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
			        
			        )";
			mysqli_query($connection, $class_attend);

			$class_result = $class_name.'_class_result';

			$class_res = "CREATE TABLE $class_result (
			        f_m int(30) PRIMARY KEY AUTO_INCREMENT, 
			        student_id VARCHAR(10),
			        course_name VARCHAR(30),
			        total_marks VARCHAR(30),
			        obtain_marks VARCHAR(30)
			        )";
			mysqli_query($connection, $class_res);

			$subject1 = $_POST['subject1'];
			$subject2 = $_POST['subject2'];
			$subject3 = $_POST['subject3'];
			$subject4 = $_POST['subject4'];
			$subject5 = $_POST['subject5'];
			$subject6 = $_POST['subject6'];

			$sub1marks = $_POST['sub1marks'];
			$sub2marks = $_POST['sub2marks'];
			$sub3marks = $_POST['sub3marks'];
			$sub4marks = $_POST['sub4marks'];
			$sub5marks = $_POST['sub5marks'];
			$sub6marks = $_POST['sub6marks'];


			$record1 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject1','$sub1marks','unallocate')";
			$result1 = mysqli_query($connection,$record1) or die(mysqli_error($connection));

			$record2 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject2','$sub2marks','unallocate')";
			$result2 = mysqli_query($connection,$record2) or die(mysqli_error($connection));

			$record3 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject3','$sub3marks','unallocate')";
			$result3 = mysqli_query($connection,$record3) or die(mysqli_error($connection));

			$record4 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject4','$sub4marks','unallocate')";
			$result4 = mysqli_query($connection,$record4) or die(mysqli_error($connection));

			$record5 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject5','$sub5marks','unallocate')";
			$result5 = mysqli_query($connection,$record5) or die(mysqli_error($connection));

			$record6 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject6','$sub6marks','unallocate')";
			$result6 = mysqli_query($connection,$record6) or die(mysqli_error($connection));

			$_POST['class_id'] = "";
			$_POST['class_name'] = "";
		}

		if ($select_subjects == '7') {
			$class = "CREATE TABLE $class_name (
			        classId VARCHAR(10)  , 
			        totalSubjects VARCHAR(10) NOT NULL,
			        minRequired VARCHAR(10)
			        )";

			if (mysqli_query($connection, $class))
			{
				?>
				<p class="successMessage text-center font-weight-bold">Class Created Successfully!</p>
  				<?php
			}
			else
			{
				?>
				<p class="errorMessage text-center font-weight-bold">Error! to creating class</p>
  				<?php
			}

			$insert_query = "INSERT INTO $class_name values ('$class_id' , '$select_subjects' , '$min_required')";
			$result = mysqli_query($connection,$insert_query) or die(mysqli_error($connection));

			$insertAllClasses = "INSERT INTO all_classes values ('$class_name')";
			mysqli_query($connection,$insertAllClasses);

			$class_details_name = $class_name.'_class_details';

			$class_details = "CREATE TABLE $class_details_name (
					class_name VARCHAR(30) ,
			        subjects VARCHAR(255) , 
			        total_marks VARCHAR(30),
			        teacher_id VARCHAR(30)
			        )";
			mysqli_query($connection, $class_details);


			$class_attendance = $class_name.'_class_attendance';

			$class_attend = "CREATE TABLE $class_attendance (
			        attendance_id int(10) PRIMARY KEY AUTO_INCREMENT, 
			        student_id varchar (10),
			        student_name varchar (50),
			        course_name varchar (40),
			        attendance_status VARCHAR(30),
			        date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
			        
			        )";
			mysqli_query($connection, $class_attend);

			$class_result = $class_name.'_class_result';

			$class_res = "CREATE TABLE $class_result (
			        f_m int(30) PRIMARY KEY AUTO_INCREMENT, 
			        student_id VARCHAR(10),
			        course_name VARCHAR(30),
			        total_marks VARCHAR(30),
			        obtain_marks VARCHAR(30)
			        )";
			mysqli_query($connection, $class_res);

			$subject1 = $_POST['subject1'];
			$subject2 = $_POST['subject2'];
			$subject3 = $_POST['subject3'];
			$subject4 = $_POST['subject4'];
			$subject5 = $_POST['subject5'];
			$subject6 = $_POST['subject6'];
			$subject7 = $_POST['subject7'];

			$sub1marks = $_POST['sub1marks'];
			$sub2marks = $_POST['sub2marks'];
			$sub3marks = $_POST['sub3marks'];
			$sub4marks = $_POST['sub4marks'];
			$sub5marks = $_POST['sub5marks'];
			$sub6marks = $_POST['sub6marks'];
			$sub7marks = $_POST['sub7marks'];

			$record1 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject1','$sub1marks','unallocate')";
			$result1 = mysqli_query($connection,$record1) or die(mysqli_error($connection));

			$record2 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject2','$sub2marks','unallocate')";
			$result2 = mysqli_query($connection,$record2) or die(mysqli_error($connection));

			$record3 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject3','$sub3marks','unallocate')";
			$result3 = mysqli_query($connection,$record3) or die(mysqli_error($connection));

			$record4 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject4','$sub4marks','unallocate')";
			$result4 = mysqli_query($connection,$record4) or die(mysqli_error($connection));

			$record5 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject5','$sub5marks','unallocate')";
			$result5 = mysqli_query($connection,$record5) or die(mysqli_error($connection));

			$record6 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject6','$sub6marks','unallocate')";
			$result6 = mysqli_query($connection,$record6) or die(mysqli_error($connection));

			$record7 = "INSERT INTO $class_details_name(class_name,subjects, total_marks, teacher_id) VALUES ('$class_name','$subject7','$sub7marks','unallocate')";
			$result7 = mysqli_query($connection,$record7) or die(mysqli_error($connection));

			$_POST['class_id'] = "";
			$_POST['class_name'] = "";
		}

	}

mysqli_close($connection);
 ?>

		<div class="container ">
			<form name="createclass" method="post" action="?"  onsubmit="return validate()">
				<div class="form-group col-lg-4  mx-auto">


					<p class="errorMessage text-center font-weight-bold" id="allerror" style="display: none">All Fields Requireds !</p>

					<input type="text" class="form-control mt-2" id="class_id" name="class_id" placeholder="Class ID" value="<?PHP if(isset($_POST['class_id'])) echo htmlspecialchars($_POST['class_id']); ?>" >

					<input type="text" class="form-control mt-2" id="class_name" name="class_name" placeholder="Class Name" value="<?PHP if(isset($_POST['class_name'])) echo htmlspecialchars($_POST['class_name']); ?>">
					<br>
					<span class="font-weight-bold">Select Number of Subjects</span>
					<select class="mt-2 ml-3 col-4" name="select_subjects" onmousedown="this.value='';" onchange="select_sub(this.value)">
						<option value="default">Select</option>
						<option id="sub5" value="5">5</option>
						<option id="sub6" value="6">6</option>
						<option id="sub7" value="7">7</option>
					</select>
					<br><br>
					
					<div class="container-fluid">
						<div class="row" id="min_required">
							<span class="font-weight-bold">Minimum Subjects Required</span>
							<select class="mt-2 ml-3 col-4" name="min_required" onmousedown="this.value='';">
								<option value="default">Select</option>
								<option id="min" value=""></option>
								<option id="max" value=""></option>
							</select>
						</div>

						<div class="row" id="book1">
							<input type="text" class="form-control col-6 mt-2" name="subject1" id="input1" placeholder="Subject 1 Name ">
							<select name="sub1marks" class=" mt-2 ml-4" id='marks1'>
								<option value="default">Total Marks</option>

								<option value="100">100</option>
							</select>
						</div>
						
						<div class="row" id="book2">
							<input type="text" class="form-control col-6 mt-2" name="subject2" id="input2" placeholder="Subject 2 Name ">
							<select name="sub2marks" class=" mt-2 ml-4" id='marks2'>
								<option value="default">Total Marks</option>

								<option value="100">100</option>
							</select>
						</div>

						<div class="row" id="book3">
							<input type="text" class="form-control col-6 mt-2" name="subject3" id="input3" placeholder="Subject 3 Name ">
							<select name="sub3marks" class=" mt-2 ml-4" id='marks3'>
								<option value="default">Total Marks</option>

								<option value="100">100</option>
							</select>
						</div>

						<div class="row" id="book4">
							<input type="text" class="form-control col-6 mt-2" name="subject4" id="input4" placeholder="Subject 4 Name ">
							<select name="sub4marks" class=" mt-2 ml-4" id='marks4'>
								<option value="default">Total Marks</option>

								<option value="100">100</option>
							</select>
						</div>

						<div class="row" id="book5">
							<input type="text" class="form-control col-6 mt-2" name="subject5" id="input5" placeholder="Subject 5 Name ">
							<select name="sub5marks" class=" mt-2 ml-4" id='marks5'>
								<option value="default">Total Marks</option>

								<option value="100">100</option>
							</select>
						</div>

						<div class="row" id="book6">
							<input type="text" class="form-control col-6 mt-2" name="subject6" id="input6" placeholder="Subject 6 Name " >
							<select name="sub6marks" class=" mt-2 ml-4" id="marks6">
								<option value="default">Total Marks</option>

								<option value="100">100</option>
							</select>
						</div>

						<div class="row" id="book7">
							<input type="text" class="form-control col-6 mt-2" name="subject7" id="input7" placeholder="Subject 7 Name " >
							<select name="sub7marks" class=" mt-2 ml-4" id="marks7">
								<option value="default">Total Marks</option>

								<option value="100">100</option>
							</select>
						</div>
						
					</div>	

					<button name="submit" type="submit" class="btn btn-primary col-lg-12 mt-4">Create Class</button>
				</div>
			</form>
		</div>

		<script>


			function validate()
			{
				var class_id = document.forms['createclass']['class_id'].value;
				var class_name = document.forms['createclass']['class_name'].value;

				var select_subjects = document.forms['createclass']['select_subjects'].value;

				var min_required = document.forms['createclass']['min_required'].value;

				if(class_id == "" || !class_id.trim() || class_name == "" || !class_name.trim() || select_subjects == "default" )
				{
					document.getElementById("allerror").style.display = 'block';
					return false;
				}

				if(select_subjects == 5)
				{
					var temp = validateFive();

					if(temp == false)
					{
						return false;
					}

					if(min_required == "default")
					{
						document.getElementById("allerror").style.display = 'block';
						return false;
					}
				}
				if(select_subjects == 6)
				{
					var temp1 = validateSix();

					if(temp1 == false)
					{
						return false;
					}

					if(min_required == "default")
					{
						document.getElementById("allerror").style.display = 'block';
						return false;
					}
				}
				if(select_subjects == 7)
				{
					var temp2 = validateSeven();

					if(temp2 == false)
					{
						return false;
					}

					if(min_required == "default")
					{
						document.getElementById("allerror").style.display = 'block';
						return false;
					}

				}
				
			}

			function validateFive()
			{
				var book1 = document.getElementById("input1").value;
				var book2 = document.getElementById("input2").value;
				var book3 = document.getElementById("input3").value;
				var book4 = document.getElementById("input4").value;
				var book5 = document.getElementById("input5").value;

				var e = document.getElementById("marks1");
				var marks1 = e.options[e.selectedIndex].value;

				var e1 = document.getElementById("marks2");
				var marks2 = e1.options[e1.selectedIndex].value;

				var e2 = document.getElementById("marks3");
				var marks3 = e2.options[e2.selectedIndex].value;

				var e3 = document.getElementById("marks4");
				var marks4 = e3.options[e3.selectedIndex].value;

				var e4 = document.getElementById("marks5");
				var marks5 = e4.options[e4.selectedIndex].value;

				if(book1 == "" || !book1.trim() || marks1 == "default" || book2 == "" || !book2.trim() || marks2 == "default" || book3 == "" || !book3.trim() || marks3 == "default" || book4 == "" || !book4.trim() || marks4 == "default" || book5 == "" || !book5.trim() || marks5 == "default" )
				{
					document.getElementById("allerror").style.display = 'block';
					return false;
				}
			}

			function validateSix()
			{
				var check = validateFive();

				if(check == false)
				{
					document.getElementById("allerror").style.display = 'block';
					return false;
				}
				else
				{
					var book6 = document.getElementById("input6").value;

					var e6 = document.getElementById("marks6");
					var marks6 = e6.options[e6.selectedIndex].value;

					if(book6 == "" || !book6.trim() || marks6 == "default" )
					{
						document.getElementById("allerror").style.display = 'block';
						return false;
					}
				}
			}

			function validateSeven()
			{
				var checkFive = validateFive();
				var checkSix = validateSix();

				if(checkFive == false || checkSix == false)
				{
					document.getElementById("allerror").style.display = 'block';
					return false;
				}
				else
				{
					var book7 = document.getElementById("input7").value;

					var e7 = document.getElementById("marks7");
					var marks7 = e7.options[e7.selectedIndex].value;

					if(book7 == "" || !book7.trim() || marks7 == "default" )
					{
						document.getElementById("allerror").style.display = 'block';
						return false;
					}
				}
			}



			$("#book1").hide();
			$("#book2").hide();
			$("#book3").hide();
			$("#book4").hide();
			$("#book5").hide();
			$("#book6").hide();
			$("#book7").hide();
			$("#min_required").hide();

			function select_sub(value)
			{

				$("#min_required").show();

				var min=value-1 , max=value;

				$("#min").text(min);
				$("#max").text(max);

				$("#min").val(min);
				$("#max").val(max);

				if(value == 5)
				{
					$("#book1").show();
					$("#book2").show();
					$("#book3").show();
					$("#book4").show();
					$("#book5").show();
						$("#book6").hide();
						$("#book7").hide();
				}
				else if(value == 6)
				{
					$("#book1").show();
					$("#book2").show();
					$("#book3").show();
					$("#book4").show();
					$("#book5").show();
					$("#book6").show();
						$("#book7").hide();
				}
				else if(value == 7)
				{
					$("#book1").show();
					$("#book2").show();
					$("#book3").show();
					$("#book4").show();
					$("#book5").show();
					$("#book6").show();
					$("#book7").show();
				}
				else if(value == "default")
				{
					$("#book1").hide();
					$("#book2").hide();
					$("#book3").hide();
					$("#book4").hide();
					$("#book5").hide();
					$("#book6").hide();
					$("#book7").hide();
					$("#min_required").hide();
				}		
			 }	
		</script>

		<script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>
<?php
}
else
{
	header("Location: login.php");
}
?>