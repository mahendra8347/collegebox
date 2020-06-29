<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "admin") {
    header("location:login.php");
} else {
}
?>

<?php
include '../includes/database.php';

$user_err = $password_err = "";

if (isset($_POST['Register'])) {

    // create a variable

    $username = $_POST['username'];
    $department = $_POST['department'];
    $email = $_POST['email'];

    //check for password

    $my_option = trim($_POST['password']);

    if (empty($my_option)) {
        $password_err = "password can not be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "password can not be less than 5 characters ";
    } else {
        $password = md5(trim($_POST['password']));
    }

    //chack username is empty....

    $my_option = trim($username);

    if (empty($my_option)) {
        $user_err = "Username can not be blank";
    } elseif (strlen($my_option) < 5) {
        $user_err = "Username Must Be More Than 5 Characters";
    } else {

        //Execute the query

        $sql_e = "SELECT username FROM faculty_data WHERE username='$username'";
        $res_e = mysqli_prepare($connect, $sql_e);
        if ($res_e) {
            if (mysqli_stmt_execute($res_e)) {
                mysqli_stmt_store_result($res_e);
                if (mysqli_stmt_num_rows($res_e) > 0) {
                    $user_err = " This Username is already registerd ";
                } else {
                    $username = trim($_POST['username']);
                    if (empty($en_no_err) && empty($password_err)) {
                        $res_e = mysqli_prepare($connect, "INSERT INTO faculty_data (username,email,password,department)VALUES ('$username','$email','$password','$department')");
                        if (mysqli_stmt_execute($res_e)) {
                            header("location:edit_admin_record.php");
                        } else {
                            echo "something went wring ..... can not redirect!";
                        }
                    }
                }
            } else {
                echo "something went wrong";
            }
        } else {
            echo "Some thing want`s wrong";
        }
        mysqli_stmt_close($res_e);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Collegebox</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
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
                    <input type="text" class="form-control" id="inputEmail4" placeholder="User Name" required name="username">
                    <?php if (isset($user_err)) { ?>
                        <span style="color:red;"> <?php echo $user_err ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" required name="email">
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
            <button type="submit" class="btn btn-primary" name="Register">Register</button>
        </form>
    </div>
    <div><?php include("../includes/footer.php"); ?></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>


