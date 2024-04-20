<?php
session_start();
include "conn.php";
if (isset($_POST['submit'])){
    $uname=$_POST['uname'];
    $psw=$_POST['pass'];
    $select=$conn->query("SELECT * FROM users WHERE userName='$uname' AND  password ='$psw'");
    if(mysqli_num_rows($select) >0){
       $_SESSION['user']=$uname;
       header("location:admin/");
    }
    else{
        header("location:index.php?error=invalid username or password");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-3 mt-5">
            </div>
            <div class="col-sm-4 mt-5 border rounded p-5 shadow ms-5">
                <h2 class="text-align-center">Welcome Back</h2>
                <form method="post">
                    <?php
                    if(isset($_GET['error'])){
                     $error=$_GET['error'];
                        echo "<div class='alert alert-danger alert-dismissible'>
                          <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                           ".$error."
                        </div>";
                    }
                    ?>
                    <div class="input-group mt-3">
                        <span class="input-group-text">
                           @ &nbsp;Username
                        </span>
                <input type="text" name="uname" class="form-control" placeholder="Enter username" required />
            </div>
            <div class="input-group mt-3">
                        <span class="input-group-text">
                            <i class="fa-solid fa-lock"></i>&nbsp;  Password
                        </span>
                <input type="password" name="pass" class="form-control" placeholder="Enter password" required />
            </div>
            <div class="form-check mt-3 me-2">
                <input class="form-check-input" type="checkbox"  checked/>
                <label class="form-check-label">Remember Me</label>
            </div>
            <!-- <div class="d-flex justify-content-end mb-2"><a href="" class="nav-link"> forgot password</a></div> -->
            <center><button type="submit" name="submit"  class="btn col-4" style="background-color: #0b5ed7;color: white;"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;SIGNIN</button></center>
            </form>
        </div>
    </div>
        <script src="resources/js/bootstrap.min.js"></script>
</body>
</html>