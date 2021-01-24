<?php
include "connection.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
if($_REQUEST['table']){
    $BookTable=$_POST['table'];
    
    $BookTable=json_decode($BookTable, true);
    for ($i=0; $i <sizeof($BookTable) ; $i++) { 
         $values=(explode("->",$BookTable[$i])); 
         $sql = "UPDATE 9th_class_details  set teacher_id='$values[0]' where subjects='$values[1]'";
         mysqli_query($connection,$sql) or die(mysqli_error($connection));
         
    }
}
echo "ALLOCATED SUCCESSFULLY PLEASE REFRESH PAGE TO VIEW UPDATE RESULTS!";
?>
