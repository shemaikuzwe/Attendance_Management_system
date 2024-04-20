<?php
include '../conn.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
   $delete=$conn->query("DELETE FROM students WHERE studentId=$id");
   if ($delete){
       header("location:students.php");
   }
   else{
       header("location:students.php");
   }
}
?>