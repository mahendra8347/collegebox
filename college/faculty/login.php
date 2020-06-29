<?php
session_start();
session_destroy();
session_start();
include '../includes/database.php';

$user_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $dep = $_POST['department'];

    $my_option = trim($username);
    $my_option1 = trim($password);

    //-------------------------------validate the username number and password ----------------------------

    if (empty($my_option) || empty($my_option1)) {
        $err = "plesse enter the username and password";
    } elseif (strlen($my_option) < 5) {
        $user_err = "Username is at least 5 character long";
    } else {
        $username = $_POST['username'];
        $password = md5(trim($_POST['password']));

        if (empty($err)) {
            $sql_e = "select username,password from faculty_data where username='$username'";
            $res_e = mysqli_query($connect, $sql_e);
            $rows = mysqli_fetch_assoc($res_e);
            if (mysqli_num_rows($res_e) == 0) {
                $user_err = "You are not registerd";
            } else {
                $password2 = $rows['password'];
                if ($password == $password2) {
                    //this means the password is correct . allow to login
                    $_SESSION['username'] = $username;
                    $_SESSION['loggedin'] = "faculty";
                    $_SESSION['first_name'] = $username;
                    $_SESSION['dep'] = $dep;

                    //redirect usre to welcome page
                    header("location:faculty_panal.php");
                } else {
                    $password_err = "password dose not match";
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
    <title>Document</title>
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
                    <label for="inputEmail4">User Name</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="User Name" required name="username" autocomplete="off">
                    <?php if (isset($user_err)) { ?>
                        <span style="color:red;"> <?php echo $user_err ?></span>
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
                    <label for="inputState">Department</label>
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
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
    <div><?php include("../includes/footer.php"); ?></div>
</body>

</html>