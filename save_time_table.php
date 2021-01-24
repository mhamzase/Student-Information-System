<?php
include "connection.php";
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
if($_REQUEST['ttable']){
    $timeTable=$_POST['ttable'];
     $timekTable=json_decode($timeTable, true);
    for ($i=0; $i <sizeof($timekTable) ; $i++) { 
         $values=(explode("->",$timekTable[$i])); 
         $time=strval($values[0]);
         $bookName=strval($values[2]);
         $classId=$_SESSION['classname'];
         $teacherId=$_SESSION['id'];
         $teacherName=$_SESSION['teachername'];
         echo $time.$bookName;
         if($values[1]=="MONDAY"){
                $sql = "insert into schooltimetable(classname,subjectname,Monday,teacherId,teacherName) values('$classId','$bookName','$time','$teacherId','$teacherName')";

                mysqli_query($connection,$sql) or die(mysqli_error($connection));
                echo $values[1];

         }
        if($values[1]=="TUESDAY"){
             
            $sql = "insert into schooltimetable(classname,subjectname,TUESDAY,teacherId,teacherName) values('$classId','$bookName','$time','$teacherId','$teacherName')";
     
                mysqli_query($connection,$sql) or die(mysqli_error($connection));
              echo $values[1];
                

            
        }
        if($values[1]=="WEDNESDAY"){
             
            $sql = "insert into schooltimetable(classname,subjectname,WEDNESDAY,teacherId,teacherName) values('$classId','$bookName','$time','$teacherId','$teacherName')";
                   
                   mysqli_query($connection,$sql) or die(mysqli_error($connection));
                   
                   echo $values[1];
                    
           }
           if($values[1]=="THURSDAY"){
             
            $sql = "insert into schooltimetable(classname,subjectname,THURSDAY,teacherId,teacherName) values('$classId','$bookName','$time','$teacherId','$teacherName')";
                   
                   mysqli_query($connection,$sql) or die(mysqli_error($connection));
                   echo $values[1];
                   
                   
               
           }
           if($values[1]=="FRIDAY"){
             
            $sql = "insert into schooltimetable(classname,subjectname,FRIDAY,teacherId,teacherName) values('$classId','$bookName','$time','$teacherId','$teacherName')";
                    
                   mysqli_query($connection,$sql) or die(mysqli_error($connection));
                   
                   echo $values[1];
                   
               
           }
           if($values[1]=="SATURDAY"){
             
            $sql = "insert into schooltimetable(classname,subjectname,SATURDAY,teacherId,teacherName) values('$classId','$bookName','$time','$teacherId','$teacherName')";
                   
                   mysqli_query($connection,$sql) or die(mysqli_error($connection));
                   echo $values[1];
               
               
           }         
    }
    mysqli_query($connection,"insert into timetablerequests values('$teacherId','pending')");

}

// echo "ALLOCATED SUCCESSFULLY PLEASE REFRESH PAGE TO VIEW UPDATE RESULTS!";
echo var_dump($timekTable);


?>
