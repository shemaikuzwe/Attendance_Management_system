<?php
include '../conn.php';
if (!isset($_SESSION['user'])){
    header("location:../index.php");
}
if(!isset($_GET['id'])){
  header("location:students.php");
}
$id=$_GET['id'];
if (isset($_POST['submit'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $class=$_POST['class'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $select_class=$conn->query("SELECT classId FROM class WHERE className='$class'");
    foreach ($select_class as $cId){
        $classId=$cId['classId'];
    }
    $insert=$conn->query("UPDATE students SET fName='$fname',lName='$lname',age=$age,classId='$classId',gender='$gender' WHERE studentId=$id");
    if ($insert){
        header("location:students.php");
    }

}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Edit</title>
</head>
<style>
    li a:hover,.active{
        background-color: #4438c9;
        border-radius:7px;
    }

</style>
<body>
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-3 p-1 rounded-2" style="background-color: #4f47e6;">

      <div class="navbar-brand rounded ms-4">
          <a href="#"><img src="logo.png" alt="Logo" style="width:100px;" class="rounded-pill"></a><br>
          <a class="navbar-brand text-white" href="index.php"><b>Attendance Management system</b></a>
      </div>
      <ul class="nav flex-column mt-5 mb-3 p-3 ">
          <li class="nav-item mb-2">
              <a class="nav-link text-light " href="index.php"><i class="fa-solid fa-house"></i>&nbsp;Dashboard</a>
          </li>
          <li class="nav-item  mb-2">
              <a class="nav-link text-light active" href="students.php"><i class="fa-solid fa-user-graduate"></i> &nbsp;Students</a>
          </li>
          <li class="nav-item  mb-2">
              <a class="nav-link text-light" href="attendance.php"><i class="fa-brands fa-creative-commons-by"></i>&nbsp;Attandance</a>
          </li>
          <li class="nav-item  mb-2">
              <a class="nav-link text-light" href="new_attendance.php"><i class="fa-solid fa-clipboard-user"></i>&nbsp;New attendance</a>
          </li>


          <div class="nav-brand ms-3  mt-3">
              <a href="logout.php"><img src="user.png" alt="Avatar Logo" style="width:80px;"
                                        class="rounded-pill">
              </a></div>
          <li class="nav-item  mb-2 mt-auto">
              <a class="nav-link text-light " href="logout.php"><i
                          class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
          </li>
      </ul>
  </div>
    <div class="col-sm-8 mt-5">
      <div class="card">
        <div class="card-header">Edit student</div>
        <div class="card-body">
            <?php
              $select_student=$conn->query("SELECT students.*,class.className FROM students inner join class
               on students.classId=class.classId WHERE studentId=$id");
              foreach ($select_student as $student){

            ?>
          <form action="" method="post" >

            <div class="input-group mb-2"><span class="input-group-text">First name</span>
              <input class="form-control" name="fname" value="<?=$student['fName']?>">
            </div>
            <div class="input-group mb-2"><span class="input-group-text">Last name</span>
              <input class="form-control" name="lname" value="<?=$student['lName']?>">
            </div>
            <div class="input-group mb-2"><span class="input-group-text">class</span>
             <input type="text" name="class" class="form-control" value="<?=$student['className']?>">
            </div>
            <div class="input-group mb-2"><span class="input-group-text">Age</span>
              <input class="form-control" name="age"  type="number" value="<?=$student['age']?>">
            </div>
            <input type="radio" name="gender" value="male" checked="checked">
            <span>Male</span>

            <input type="radio" name="gender" value="male">
            <span class="input">FeMale</span>
              <?php
              }
              ?>

            <center><button class="btn btn-dark" type="submit" name="submit">Edit</button></center>
          </form></div>
      </div>
    </div>
    <div>
</body>
</html>
