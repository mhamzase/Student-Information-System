<?php 

session_start();
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
			.heading{
				background-color: black;
    width: 33%;
    padding: 9px;
    position: relative;
    top: 2px;
    color: white;
			}
.moveUp{
	width: 49%;
    position: relative;
    top: -48px;
}
.fm{
	position: relative;
    bottom: 50px;
    left: 27px;
}
.infoClass{
	position: relative;
    top: -27px;
    background: red;
    color: white;
    font-size: 1.2em;
    padding: 10px;
}
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/DataCenter.js"></script>
		
		<script src="js/jquery.js"></script>

		<style>
		.allocate{
			width: 154px;
		}
		.hide{
			display: none;
		}
		.btnDesign{
			height: 42px;
		    position: relative;
		    bottom: 10px;
		    left: 9px;
			
		    top: -56px;
		}
		</style>
	</head>
	<body style="background-color: #BCD1A1; overflow-x:hidden" >

		 <!-- <a href="/sis/admin_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a> -->
	<center>	 <h3 class="heading">Allocate <span id="className"></span> Course(s) to a Teacher.</h3>
	</center>
	<a href="/sis/admin_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a> 

	<center>
		
		<div>
				<?php 
				$i=0;
					include "connection.php";

					$id = $_SESSION['id'];

					$query_classes = mysqli_query($connection,"SELECT * FROM all_classes") or die(mysqli_error($connection));

					echo "<form action='?' method='get'><select name='classList' id='classes' style='width: 365px;
					height: 42px;
					border: 0.2px;' class='moveUp'><option value=''>&nbsp;&nbsp;&nbsp;&nbsp;Select Class&nbsp;&nbsp;&nbsp;&nbsp;</option>";
					while($row = mysqli_fetch_array($query_classes))
					{
						echo "<option value='$row[0]'>$row[0]</option>";
					}
					echo "</select>";

					
					echo "<button name='loadData' type='submit' class='btn btn-dark mt-3 btnDesign'>Load Subjects</button>
					</form>";


			 		if(isset($_GET['loadData']))
			 		{
			 			if(!empty($_GET['classList']))
			 			{
			 				$selectOption = $_GET['classList'];
			 				$class = $selectOption."_class_details";

			 				setcookie("classid", "$selectOption", time()+30*24*60*60);
			 				setcookie("classdetails", "$class", time()+30*24*60*60);

					 		$query_subjects = mysqli_query($connection,"SELECT * FROM $class") or die(mysqli_error($connection));
							?>
							<span class="infoClass">
							Allocate 
							<span id=classId>
								<mark>
<?php
								echo $selectOption;
								?>
								</mark>
							</span>
								Course(s) to a Teacher.
							</span>
							<br/>
							<p id="message" style="color: blue;">
								
							</p>
							
							<?php
							 echo "<form action='?' method='get' class='fm'>	
							 <table class='table col-6 mt-5 border  text-center'>
					 		<tr class='bg-dark text-white text-center'>
					 			<th>Subject Name</th>
					 			<th>Allocated Teacher</th>
					 			<th>Select Teacher</th>
					 			
					 		</tr>";
								$k=0;
					 		while($row1 = mysqli_fetch_array($query_subjects))
					 		{
					 			echo "<tr class='bg-light'>
								 <td><input type='hidden' value='$row1[subjects]' name='$k' >$row1[subjects]</td>";
								 if($row1['teacher_id']!="unallocate"){
									 $data=mysqli_query($connection,"SELECT id,fullname from teachers where id='$row1[teacher_id]'");
										$rows=mysqli_fetch_array($data);
									echo "<td class='text-success'>$rows[0] | $rows[1]</td>";
								 }
								 else{
									echo "<td class='text-primary'>UNALLOCATED</td>";
								 }
								 
								echo "<td>
								
					 			<select name='$row1[subjects]' onchange='getSelected(this)' id='$row1[subjects]'>
					 				<option value=''>Select Teacher</option>";
					 				$query_teachers = mysqli_query($connection,"SELECT * FROM teachers") or die(mysqli_error($connection));
					 			while($row2 = mysqli_fetch_array($query_teachers))
								{
									echo "<option>$row2[id]|$row2[fullname]</option>";
								}	
					 			echo "</select>
								 </td>
								 
							     
							   </form>
								 </tr>";
								 $k=$k+1;
					 		}
							 echo "
							 <tr class='bg-light'>
							 <td>
							 ACTION
							 </td>
							 <td>
							 </td>
							 <td>
							 <button type='button' name='allocate' class='btn btn-primary allocate ' onclick='save()'  id='allocateCrouses'>Allocate</button>

							 </td>
							 </tr>
							 </table>
							 
							 </form>";
			 			}
			 			else
			 			{
			 				echo "<p class='text-danger font-weight-bold'>No Class Selected</p>";
			 			}
			 		}
			 	?>
				 
				

			 	
		</div>
	</center>










		 
		<script src="js/bootstrap.min.js"></script>
		
		<script>
			var	  i=0;
		</script>
		<script>
				
        	      function getSelected(selectObject) {
				  _className=document.getElementById("classId").innerText;
				  var value = selectObject.value;  
				  var id=value.split("|");
				  var subjectName = selectObject.getAttribute("id");  
				  bookTable[i++]=id[0]+"->"+subjectName;
				  


				  
}
function save(){
	var jsTable=JSON.stringify(bookTable);
				  $.post(
					  "do_allocation.php",
					  {table:jsTable},
					  function (response){
						  console.log(response);
						  $("#message").html("<div style='position: relative;left: 24px;padding: 14px;'><mark>MESSAGE</mark>: ALLOCATED SUCCESSFULLY PLEASE REFRESH PAGE TO VIEW UPDATE RESULTS!</div>");

					  }
				  )
				 

}








		</script>
		<script>
			$(document).ready(function(){
$("#allocateCrouses").onClick(function(){
        alert("hi");
});
});

		</script>
	</body>
</html>


<?php
mysqli_close($connection);
}
else
{
	header("Location: login.php");
}
 ?>
















