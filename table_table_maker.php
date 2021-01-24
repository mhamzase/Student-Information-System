<?php
session_start();
include("connection.php");
if($_SESSION['role']!="teacher"){
    header("location:index.php");

}
if(isset($_POST['submit']))
{
	session_destroy();
    header("Location: login.php");
    
}
$tchId=$_SESSION['id'];
$rls=mysqli_query($connection,"select*from timetablerequests where teacherId='$tchId' and status='pending'");
$num=mysqli_num_rows($rls);
if($num>0){
    header('Location:InfoMessage.php');
}
else{
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V03</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<div class="limiter">
		<div class="container-table100">


        <br/><br/><br/>

        <div class="wrap-table100" id="main">
        <div style="position: relative;top:-40px;left:-30px">
            <a href="/sis/teacher_dashboard.php"><img src="images/back_to_dashboard.png" alt="back to dashboard icon" width="5%"></a>
    <form acction="?" method="get" >

    <?php
    include("connection.php");
            $className=mysqli_query($connection,"select*from all_classes");
            echo"<select style='padding:10px;width:320px;outline:none' name='classname'>";
            echo "<option value=''>SELECT CLASS</option>";
            while($class=mysqli_fetch_array($className)){
                
                echo"
                    
                    <option>$class[0]</option>
                    
                ";
                
            }
            echo"</select>";
    ?>
    <button type="submit" style="background-color: black;color:white;padding:8px" name="yesLoad"   >LOAD TABLE TIME</button>
    <form method="post" action="?" style="position: relative; left:1230px">
		<input class="btn btn-danger mr-2 logout" name="submit" type="submit" value="logout" style="padding:10px;">
    </form>
       
</form>
</div>

            <div class="table100 ver1 m-b-110" style="position: relative;bottom:100px">
    <form action="?" method="POST">
                <table data-vertable="ver1">
						<thead>

				<div class="table100 ver2 m-b-110">
					<table data-vertable="ver2">
						<thead>
							<tr class="row100 head">
                                
								<th class="column100 column20" data-column="column1">CLASS NAME</th>
								
								<th class="column100 column1" data-column="column1">SUBJECT NAME</th>
								
								<th class="column100 column3" data-column="column3">Monday</th>
								<th class="column100 column4" data-column="column4">Tuesday</th>
								<th class="column100 column5" data-column="column5">Wednesday</th>
								<th class="column100 column6" data-column="column6">Thursday</th>
								<th class="column100 column7" data-column="column7">Friday</th>
								<th class="column100 column8" data-column="column8">Saturday</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            $times=array("9:00 AM","9:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 AM","12:30 AM","1:00 AM","1:30 AM","2:00 AM");
                            $days=array("MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY");
                            $accourateTImes=array();
                            if(isset($_GET['yesLoad'])){
                                $classId=$_GET['classname'];
                                $_SESSION['classname']=$classId;
                                $cla=$_GET['classname'];
                                if($classId!="SELECT CLASS"){
                                $className=$classId."_class_details";
                                $classData=mysqli_query($connection,"select subjects from $className where teacher_id='$_SESSION[id]'") or die(mysqli_connect_error());
                                while($subjects=mysqli_fetch_array($classData)){
                                echo"
                                <tr class='row100'>
                            <td class='column100 column1' data-column='column1'>$classId</td>
								    
                            <td class='column100 column1' data-column='column1'>$subjects[0]</td>
								<td class='column100 column2' data-column='column2'>
                                    <select id='time' style='border: 0;outline:0;' onchange='makeTable(event)'>
                                    <option>SELECT TIME</option>
                                    ";
                                    $i=0;
                                    $availabeTimes=mysqli_query($connection,"select*from timerecord where reservedClass='$cla'");      
                                        while($date=mysqli_fetch_array($availabeTimes)){
                                            for ($i=0; $i <sizeof($times) ; $i++) { 
                                                if($times[$i]==$date[0]){
                                                    unset($times[$i]);
                                                }
                                            }
                                    }
                                    for ($i=0; $i <sizeof($times) ; $i++) { 
                                        if($times[$i]!=""){
                                        echo"<option>$times[$i]|$subjects[0]</option>";
                                        }
                                        else{
                                            
                                        }
                                    }
                                echo "</select><span style='display:none'>MONDAY</span></td>
                                <td class='column100 column2' data-column='column2'>
                                    <select id='time' style='border: 0;outline:0;' onchange='makeTable(event)'>
                                    <option>SELECT TIME</option>
                                    ";
                                    $i=0;
                                    $availabeTimes=mysqli_query($connection,"select*from timerecord where reservedClass='$cla'");      
                                        while($date=mysqli_fetch_array($availabeTimes)){
                                            for ($i=0; $i <sizeof($times) ; $i++) { 
                                                if($times[$i]==$date[0]){
                                                    unset($times[$i]);
                                                }
                                            }
                                    }
                                    for ($i=0; $i <sizeof($times) ; $i++) { 
                                        if($times[$i]!=""){
                                            echo"<option>$times[$i]|$subjects[0]</option>";
                                        }
                                        else{
                                            
                                        }
                                    }
                                echo "</select><span style='display:none'>TUESDAY</span></td>
                                <td class='column100 column2' data-column='column2'>
                                    <select id='time' style='border: 0;outline:0;' onchange='makeTable(event)'>
                                    <option>SELECT TIME</option>
                                    ";
                                    $i=0;
                                    $availabeTimes=mysqli_query($connection,"select*from timerecord where reservedClass='$cla'");      
                                        while($date=mysqli_fetch_array($availabeTimes)){
                                            for ($i=0; $i <sizeof($times) ; $i++) { 
                                                if($times[$i]==$date[0]){
                                                    unset($times[$i]);
                                                }
                                            }
                                    }
                                    for ($i=0; $i <sizeof($times) ; $i++) { 
                                        if($times[$i]!=""){
                                            echo"<option>$times[$i]|$subjects[0]</option>";
                                        }
                                        else{
                                            
                                        }
                                    }
                                echo "</select><span style='display:none'>WEDNESDAY</span></td><td class='column100 column2' data-column='column2'>
                                <select id='time' style='border: 0;outline:0;' onchange='makeTable(event)'>
                                <option>SELECT TIME</option>
                                ";
                                $i=0;
                                $availabeTimes=mysqli_query($connection,"select*from timerecord where reservedClass='$cla'");      
                                    while($date=mysqli_fetch_array($availabeTimes)){
                                        for ($i=0; $i <sizeof($times) ; $i++) { 
                                            if($times[$i]==$date[0]){
                                                unset($times[$i]);
                                            }
                                        }
                                }
                                for ($i=0; $i <sizeof($times) ; $i++) { 
                                    if($times[$i]!=""){
                                        echo"<option>$times[$i]|$subjects[0]</option>";
                                    }
                                    else{
                                        
                                    }
                                }
                            echo "</select><span style='display:none'>THURSDAY</span></td><td class='column100 column2' data-column='column2'>
                            <select id='time' style='border: 0;outline:0;' onchange='makeTable(event)'>
                            <option>SELECT TIME</option>
                            ";
                            $i=0;
                            $availabeTimes=mysqli_query($connection,"select*from timerecord where reservedClass='$cla'");      
                                while($date=mysqli_fetch_array($availabeTimes)){
                                    for ($i=0; $i <sizeof($times) ; $i++) { 
                                        if($times[$i]==$date[0]){
                                            unset($times[$i]);
                                        }
                                    }
                            }
                            for ($i=0; $i <sizeof($times) ; $i++) { 
                                if($times[$i]!=""){
                                    echo"<option>$times[$i]|$subjects[0]</option>";
                                }
                                else{
                                    
                                }
                            }
                        echo "</select><span style='display:none'>FRIDAY</span></td><td class='column100 column2' data-column='column2'>
                        <select id='time' style='border: 0;outline:0;' onchange='makeTable(event)'>
                        <option>SELECT TIME</option>
                        ";
                        $i=0;
                        $availabeTimes=mysqli_query($connection,"select*from timerecord where reservedClass='$cla'");      
                            while($date=mysqli_fetch_array($availabeTimes)){
                                for ($i=0; $i <sizeof($times) ; $i++) { 
                                    if($times[$i]==$date[0]){
                                        unset($times[$i]);
                                    }
                                }
                        }
                        for ($i=0; $i <sizeof($times) ; $i++) { 
                            if($times[$i]!=""){
                                echo"<option>$times[$i]|$subjects[0]</option>";
                            }
                            else{
                                
                            }
                        }
                    echo "</select><span style='display:none'>SATURDAY</span></td>
                                </tr>";
							
							

                                
                                }

                                }
                                
                           echo "</tbody>
                           </table>
                           <br/>";
                        echo "   <button type='button'  style='background-color: black;color:white;padding:8px' name='saveData' onclick='save()'>Save time table</button>
                        ";   
                        }

                            
                            ?>
							

							
						
                  
                </form>
				</div>

				
				
			</div>
		</div>
	</div>
<script src="js/DataCenter.js"></script>
<script>
        i=0;
    const makeTable=(e)=>{
        day=e.target.nextSibling.innerHTML;
        timeAndSubject=e.target.value.split("|");
        time=timeAndSubject[0];
        subjectName=timeAndSubject[1];
        duplicate={}
       
       for(var key in table){
           obj=table[key].split("->");
           if(obj[2]==subjectName && obj[1]==day){
            table[key]=time+"->"+day+"->"+subjectName;
            return;
        }
        }
         
       table[++i]=time+"->"+day+"->"+subjectName;
    }
const save=()=> {
        // window.location("infoMessage.php");

    var jsTable=JSON.stringify(table);
				  $.post(
					  "save_time_table.php",
					  {ttable:jsTable},
					  function (response){
                          alert("Your Time Table Requested Successfully!");
                          location.reload();
					  }
				  )
				 
}
</script>

<?php
if(isset($_POST["saveData"])){
    
}

?>

	


	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>