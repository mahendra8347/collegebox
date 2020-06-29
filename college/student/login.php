<?php
session_start();
session_destroy();
session_start();

if (isset($_SESSION['en_no'])) {
    header("location:student_panal.php");
    exit;
}

include '../includes/database.php';

$en_no_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $en_no = $_POST['en_no'];
    $password = $_POST['password'];

    $my_option = trim($en_no);
    $my_option1 = trim($password);

    //-------------------------------validate the enrollment number and password ----------------------------

    if (empty($my_option) || empty($my_option1)) {
        $err = "plesse enter the enrollment and password";
    }elseif(strlen($my_option)<12 || strlen($my_option)>12) {
        $en_no_err = "Pleace Enter The Valid Enrollment Number";
    }else {
        $en_no = trim($_POST['en_no']);
        $password = md5(trim($_POST['password']));

        if (empty($err)) {
            $sql_e = "select en_no,profile from student_data where en_no='$en_no'";
            $res_e = mysqli_query($connect, $sql_e);
            $rows = mysqli_fetch_assoc($res_e);
            $_SESSION['profile_photo'] = $rows['profile'];
            if (mysqli_num_rows($res_e) == 0) {
                $en_no_err = "You are not registerd";
            } else {
                $sql = "select en_no,first_name,profile,password from student_data where en_no=?";
                $stmt = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($stmt, "s", $param_en_no);
                $param_en_no = $en_no;
    
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $en_no, $first_name,$profile_photo, $password2);
                        if (mysqli_stmt_fetch($stmt)) {
                            if ($password == $password2) {
                                //this means the password is correct . allow to login
                                session_start();
                                $_SESSION['en_no'] = $en_no;
                                $_SESSION['loggedin'] = "student";
                                $_SESSION['first_name'] = $first_name;
                               
    
                                //redirect usre to welcome page
                                header("location:student_panal.php");
                            } else {
                                $password_err = "password dose not match";
                            }
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Collegebox</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div><?php include("navigation.php"); ?></div>
    <div class="p-3 bg-info text-white">
        <form class="container col-lg-8 " action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Enrollment No </label>
                    <input type="number" class="form-control" id="inputEmail4" placeholder="Enrollment No" required name="en_no" maxlength="12" autocomplete="off">
                    <?php if (isset($en_no_err)) { ?>
                        <span style="color:red;"> <?php echo $en_no_err ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" required name="password">
                    <?php if (isset($password_err)) { ?>
                        <span style="color:red;"> <?php echo $password_err ?></span>
                    <?php } ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputState">Branch</label>
                    <select id="inputState" class="form-control" name="department">
                        <option selected>IT</option>
                        <option>CE</option>
                        <option>EC</option>
                        <option>PRODUCTION</option>
                        <option>CIVIL</option>
                        <option>MECHANICAL</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
            <div>
                <a href="#" style="color:black;">Forgot Password! </a>
                <label> Or Not registerd </label>
                <a href="registration.php" style="color:black;">Register</a>
            </div>
        </form>
    </div>
    <div><?php include("../includes/footer.php"); ?></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>