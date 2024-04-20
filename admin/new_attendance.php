<?php
include '../conn.php';
session_start();
if (!isset($_SESSION['user'])){
    header("location:../index.php");
}
if (isset($_POST['submit'])){
   $select_missed_student=$conn->query("SELECT * FROM  students");
   $i=0;
   foreach ($select_missed_student as $missed_student){
       if (!isset($_POST['status'][$missed_student['studentId']])){
           echo "student".$missed_student['fName']." ".$missed_student['lName']."is absent <br>";
        $i ++;
       }
   }
   echo $i;
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
    <title>Attendance</title>
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
                <a class="nav-link text-light" href="students.php"><i class="fa-solid fa-user-graduate"></i> &nbsp;Students</a>
            </li>
            <li class="nav-item  mb-2">
                <a class="nav-link text-light" href="Attendance.php"><i class="fa-brands fa-creative-commons-by"></i>&nbsp;Attandance</a>
            </li>
            <li class="nav-item  mb-2">
                <a class="nav-link text-light active" href="new_attendance.php"><i class="fa-solid fa-clipboard-user"></i>&nbsp;New attendance</a>
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
                <div class="card-header"> <h5 class="h5 fw-bold text-xl-center text-black">New Attendance</h5></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="list.php">
                            <div class="input-group mb-2"><span class="input-group-text">Description</span><input type="text" value="Daily attendence" name="desc" class="form-control">
                            </div>
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="p-2 text-white" style="background-color: #0b5ed7">
                                <tr>
                                    <th>ID</th>
                                    <th>Names</th>
                                    <th>Class</th>
                                    <th>status</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $select_student=$conn->query("SELECT students.*,class.className FROM students INNER JOIN class ON 
                               students.classId=class.classId ORDER BY students.fName");
                                foreach ($select_student as $student){
                                    $id=$student['studentId'];
                                    echo "<tr> 
                                         <td>".$student['studentId']."</td>
                                         <td>".$student['fName']." ".$student['lName']."</td>
                                          <td>".$student['className']."</td>
                                          <td><input type='checkbox' name='status[$id]' class='form-check-input' checked></td>
                                       </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                            <center><button class=" btn" style="background-color: #0b5ed7;color: white;" name="submit" type="submit">Generate</button></center>
                            <div>
                            </div>
                        </form>
                    </div>

                </div>
                <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>