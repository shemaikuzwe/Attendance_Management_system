<?php
include '../conn.php';
session_start();
if (!isset($_SESSION['user'])){
    header("location:../index.php");
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
    <title>Dashboard</title>
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
                <div class="card-header"> <h5 class="h5 fw-bold text-xl-center text-black">All students</h5></div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover">
                            <thead class="p-2" style="background-color: #0b5ed7;color: white;">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Class</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             $select_student=$conn->query("SELECT students.*,class.className FROM students INNER JOIN class ON students.classId=class.classId");
                             if(mysqli_num_rows($select_student) > 0){
                                 foreach ($select_student as $student){
                                     $id=$student['studentId'];
                                     echo "
                                     <tr>
                                       <td>".$student['studentId']."</td>
                                       <td>".$student['fName']."</td>
                                       <td>".$student['lName']."</td>
                                       <td>".$student['age']."</td>
                                       <td>".$student['gender']."</td>
                                       <td>".$student['className']."</td>
                                       <td><a href='update.php?id=$id' class='btn btn-success btn-sm'><i class='fa-solid fa-pen''></i>&nbsp;Edit</a></td>
                                       <td><a href='delete.php?id=$id' class='btn btn-danger btn-sm'><i class='fa-solid fa-trash''></i>&nbsp;Delete</a></td>
                                     </tr>
                                     ";
                                 }
                             }
                             else{
                                 echo "<h1>No students found</h1>";
                             }
                            ?>
                            </tbody>
                        </table>
                        <center><a href="new.php" class=" btn " style="background-color: #0b5ed7;color: white;"><i class="fa-solid fa-plus"></i>&nbsp;New</a></center>
                        <div>
                </div>
            </div>

                    </div>
                    <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>