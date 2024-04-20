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
                <a class="nav-link text-light" href="students.php"><i class="fa-solid fa-user-graduate"></i> &nbsp;Students</a>
            </li>
            <li class="nav-item  mb-2">
                <a class="nav-link text-light active" href="Attendance.php"><i class="fa-brands fa-creative-commons-by"></i>&nbsp;Attandance</a>
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
        <div class="col-sm-8 ">
            <div class="row">
                <?php
                $select_attendance=$conn->query("SELECT * FROM attendance ORDER BY date DESC");
                if (mysqli_num_rows($select_attendance) >0){
                    foreach ($select_attendance as $attendance){
                        $id=$attendance['id'];
                        $date=$attendance['date'];
                        $formatedDate=date('D,F j,Y',strtotime($date));
                        echo "<div class='col-3 p-4 '>
                               <div class='card p-2 shadow-sm'>
                                  <div class='card-title'><h5 class='h5 text-sm-center'>".$attendance['attDesc']."</h5></div>
                                   <div class='card-body d-block'><div class='mb-2'>Date:".$formatedDate."</div> <div class='mb-2'>Absent:".$attendance['missed']."</div><div class='mb-2'><a  href='missed.php?id=$id' class='btn  btn-sm' style='background-color: #0b5ed7;color: white;'>View absent</a></div></div>
                                  </div>
                               </div>";
                    }
                }
                else{
                    echo "No attendance found";
                }
                ?>
            </div>

        </div>
        <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>