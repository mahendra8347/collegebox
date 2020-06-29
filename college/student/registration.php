<?php
session_start();

include '../includes/database.php';

$en_no_err = $password_err = $email_err = $mobile_err = "";

$mobile_error = $password_error = $email_error = "";

if (isset($_POST['Register'])) {

    // create a variable

    $en_no = $_POST['en_no'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_no = $_POST['mobile_no'];
    //$profile_photo = $_POST['profile_photo'];

    //chack enrollment is empty....
    $my_option = trim($en_no);
    if (empty($my_option)) {
        $en_no_err = "Enrollment cannot be blank";
    } elseif (strlen($my_option) < 12 || strlen($my_option) > 12) {
        $en_no_err = "Pleace Enter The Valid Enrollment Number";
    } else {

        //Execute the query

        $sql_e = "SELECT en_no FROM student_data WHERE en_no='$en_no'";
        $res_e = mysqli_prepare($connect, $sql_e);
        if ($res_e) {
            if (mysqli_stmt_execute($res_e)) {
                mysqli_stmt_store_result($res_e);
                if (mysqli_stmt_num_rows($res_e) > 0) {
                    $en_no_err = " This Enrollment is already registerd ";
                } else {
                    $enr_no = trim($_POST['en_no']);
                }
            } else {
                echo "something went wrong";
            }
        }
        mysqli_stmt_close($res_e);
    }

    //profile photo
    // $profile_photo = time() . '_' . $_FILES['profile_photo']['name'];
    // $target = '../student_images/' . $profile_photo;
    // move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target);
    //If there is no error, than add data


    //chack for all validation
    $pattern_mobile = "^((0091)|(\+91)|0?)[6-9]{1}\d{9}$^";
    $pattern_password = "^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$^";
    $pattern_email = "^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$^";
    if(!preg_match($pattern_mobile,$mobile_no)){
        $mobile_err = "please enter velid mobilenumber.";
    }elseif(!preg_match($pattern_password,$password)){
        $password_err = "please enter velid password.";
    }elseif(!preg_match($pattern_email,$email)){
        $email_err = "please enter velid email.";
    }else{
        if (empty($en_no_err) && empty($mobile_err) && empty($password_err) && empty($email_err)) {
            $password = md5($password);
            $res_e = mysqli_prepare($connect, "INSERT INTO student_data (password,en_no,first_name,last_name,mobile_no,department,email,profile)
            VALUES ('$password','$en_no','$first_name','$last_name','$mobile_no','$department','$email','$profile_photo')");
            if (mysqli_stmt_execute($res_e)) {
                header("location:../index.php");
            } else {
                echo "something went wring ..... can not redirect!";
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
    <script>
        function ValidateEmail() {
            var email = document.getElementById("txtEmail").value;
            var emailError = document.getElementById("emailError");
            var emailError1 = document.getElementById("emailError1");
            emailError.innerHTML = "";
            emailError1.innerHTML = "";
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (!expr.test(email)) {
                emailError.innerHTML = "Invalid email address.";
            }
        }

        function ValidateMobile() {
            var mobile = document.getElementById("txtMobile").value;
            var mobileError = document.getElementById("mobileError");
            mobileError.innerHTML = "";
            var mobileError1 = document.getElementById("mobileError1");
            mobileError1.innerHTML = "";
            var expr_mobile = /^((0091)|(\+91)|0?)[6-9]{1}\d{9}$/;
            if (!expr_mobile.test(mobile)) {
                mobileError.innerHTML = "Inavalid mobile number.";
            }
        }

        function ValidatePassword() {
            var password = document.getElementById("txtPassword").value;
            var passwordError = document.getElementById("passwordError");
            passwordError.innerHTML = "";
            var passwordError1 = document.getElementById("passwordError1");
            passwordError1.innerHTML = "";
            var expr_password = /^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/;
            if (!expr_password.test(password)) {
                passwordError.innerHTML = "Password must contain at least one letter, at least one number, and be longer than six charaters.";
            }
        }
    </script>
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
                    <label for="inputEmail4">First Name </label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" required name="first_name" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Last Name </label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Last Name" name="last_name" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="text" class="form-control" id="txtEmail" placeholder="Email" required name="email" autocomplete="off" onkeyup="ValidateEmail();" />
                    <span id="emailError" style="color: red"></span>
                    <?php if (isset($en_no_err)) { ?>
                        <span id="emailError1" style="color:red;"> <?php echo $email_err ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Mobile No </label>
                    <input type="text" class="form-control" id="txtMobile" placeholder="Moblie No" required name="mobile_no" autocomplete="off" onkeyup="ValidateMobile();" />
                    <span id="mobileError" style="color: red"></span>
                    <?php if (isset($en_no_err)) { ?>
                        <span id="mobileError1" style="color:red;"> <?php echo $mobile_err ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="txtPassword" placeholder="Password" required name="password" onkeyup="ValidatePassword();" />
                    <span id="passwordError" style="color: red"></span>
                    <?php if (isset($en_no_err)) { ?>
                        <span id="passwordError1" style="color:red;"> <?php echo $password_err ?></span>
                    <?php } ?>
                </div>
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
                <!-- <div class="form-group col-md-6 text-center">
                    <img src="../student_images/placeholder.jpg" style="display: block; width: 70px; height:70px; margin: 10px auto;border-radius:50%; " onclick="triggerClick()" id="profileDisplay" />
                    <label for="inputimage">Your Profile Photo</label>
                    <input type="file" style="display:none" onchange="displayImage(this)" id="profileImage" name="profile_photo">
                </div> -->
            </div>
            <button type="submit" class="btn btn-primary" name="Register">Register</button>
            <div>
                <label>Already Registered ? </label>
                <a href="login.php" style="color:black;">Login</a>
            </div>
        </form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
    <div><?php include("../includes/footer.php"); ?></div>
    <script type="text/javascript" src="scripts.js"></script>
</body>

</html>