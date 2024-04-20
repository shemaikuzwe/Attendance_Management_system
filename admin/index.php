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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
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
            <div class="col-sm-3 p-1 rounded-2 h-75" style="background-color: #4f47e6;">

                <div class="navbar-brand rounded ms-4">
                    <a href="#"><img src="logo.png" alt="Logo" style="width:100px;" class="rounded-pill"></a><br>
                    <a class="navbar-brand text-white" href="index.php"><b>Attendance Management system</b></a>
                </div>
                <ul class="nav flex-column mt-5 mb-3 p-3 ">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-light active" href="index.php"><i class="fa-solid fa-house"></i>&nbsp;Dashboard</a>
                    </li>
                    <li class="nav-item  mb-2">
                        <a class="nav-link text-light" href="students.php"><i class="fa-solid fa-user-graduate"></i> &nbsp;Students</a>
                    </li>
                    <li class="nav-item  mb-2">
                        <a class="nav-link text-light" href="Attendance.php"><i class="fa-brands fa-creative-commons-by"></i>&nbsp;Attandance</a>
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
                <div class="row mt-4 mx-2 gap-4">
                    <?php
                      $select_no_students=$conn->query("SELECT count(*) AS no_students FROM students");
                      if (mysqli_num_rows($select_no_students) >0){
                          foreach ($select_no_students as $no_student){

                     ?>
                    <div class="col-3 p-4  rounded-1 text-white" style="background-color: #111826">Students<br><?=$no_student['no_students']?><br><a href="students.php" class="btn btn-dark btn-sm"><i class="fa-solid fa-arrow-right"></i>&nbsp;More details</a></div>
                    <?php
                      }
                      }
                      $select_attendance=$conn->query("SELECT COUNT(*) AS no_of_attendance,missed FROM attendance");
                      $sum=0;
                      foreach ($select_attendance as $attendance){
                          $no_of_attendance=$attendance['no_of_attendance'];
                          $sum=$sum+$attendance['missed'];
                      }
                      $avg=$sum/$no_of_attendance;
                      $percentage=round($avg*100/$no_student['no_students'],1);
                      $attended=100-$percentage;
                      ?>
                    <div class="col-3 p-4 rounded-1 text-white" style="background-color: #21c45d">Attendance <br/><?=$attended?>%<br><a href="students.php" class="btn btn-dark btn-sm"><i class="fa-solid fa-arrow-right"></i>&nbsp;More details</a></div>

                    <div class="col-3   p-4  rounded-1 text-white" style="background-color: #4f47e6;">Missing <br/><?=$percentage?> %<br><a href="students.php" class="btn btn-dark btn-sm"><i class="fa-solid fa-arrow-right"></i>&nbsp;More details</a></div>
                    <div>
            </div>
                    <div class="card mb-5">
                        <div class="card-title"><h5 class="h5 text-sm-center">Recent Attendance</h5><div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead class="p-2" style="background-color:#0b5ed7;color: white;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Missed</th>
                                            <th>Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                          $select_attendance=$conn->query("SELECT * FROM attendance ORDER BY date DESC LIMIT 3");
                                          if (mysqli_num_rows($select_attendance) >0){
                                              foreach ($select_attendance as $attendance){
                                                  $id=$attendance['id'];
                                                  $date=date("D,F j,Y",strtotime($attendance['date']));
                                                  echo "<tr>
                                                        <td>".$attendance['id']."</td>
                                                         <td>".$attendance['attDesc']."</td>
                                                          <td>".$date."</td>
                                                           <td>".$attendance['missed']."</td>
                                                           <td><a href='missed.php?id=$id' class='btn btn-sm' style='background-color: #0b5ed7;color: white'><i class='fa-solid fa-arrow-right'></i>&nbsp;Details</a></td>
                                                     </tr>";
                                              }
                                          }
                                        ?>

                                        </tbody>
                                    </table>
                                    <div>
                                <div>

                            </div>

                                        <div class="card">
                                            <div class="card-title"><h5 class="h5 text-sm-center">Top  Absent students</h5><div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover">
                                                                <thead class="p-2" style="background-color:#0b5ed7;color: white;">
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name</th>
                                                                    <th>Class</th>
                                                                    <th>Times missed</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $select_missed=$conn->query("SELECT COUNT(*) AS times_missed,students.fName,students.studentId,students.lName,class.className FROM missed INNER JOIN students ON students.studentId=missed.student_id INNER JOIN class ON class.classId=students.classId GROUP BY missed.student_id LIMIT 3");
                                                                if (mysqli_num_rows($select_missed) >0){
                                                                    foreach ($select_missed as $missed){
                                                                        echo "<tr>
                                                       <td>".$missed['studentId']."</td>
                                                       <td>".$missed['fName']."</td>
                                                       <td>".$missed['lName']."</td>
                                                       <td>".$missed['className']."</td>
                                                       <td>".$missed['times_missed']."</td>
                                                   </tr>";
                                                                    }
                                                                }
                                                                ?>

                                                                </tbody>
                                                            </table>
                                                            <div>
                                                                <div>
                                                                </div>
                                    </div>
        <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>