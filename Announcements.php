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



<style>
    html,body{
        height: 100%;
    }
    #ans{
        background-color: white;
        width: 50%;
       height: 500px;
       top: 20px;
        position: relative;
    
    }
    ul{
        list-style: none;
        position: relative;
        top: 20px;
    }
    li{
        padding: 10px;
    }
</style>
<!-- Body -->
<a href="/sis/teacher_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a>
<center>

	<div id="ans">
        <h1>Announcements</h1>
        <div id="secotion">
    <ul>
<?php
    $ans=mysqli_query($connection,"select*from announcements");
    while($singe=mysqli_fetch_array($ans)){
        echo"<li>$singe[0].$singe[1]</li>";
    }

?>
   
    </ul>
        </div>
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


