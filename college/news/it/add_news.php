<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "faculty") {
    header("location:login.php");
} else {
}

include '../includes/database.php';

if (isset($_POST['Register'])) {

    $title = $_POST['title'];
    $detail = $_POST['detail'];
    $date = date("Y-m-d");

    $my_option = trim($title);
    $my_option1 = trim($detail);
    $my_option2 = trim($date);


    if (empty($my_option)) {
        if (empty($my_option1)) {
            $err = "Please enter the title and detail ";
        } else {
            $err = "please enter the Title";
        }
    } else {
        if (empty($my_option1)) {
            $detail_err = "please enter the detail ";
        } else {
            $res_e = mysqli_prepare($connect, "INSERT INTO it_department_news (title,detail,date)
        VALUES ('$title','$detail','$date')");
            if (mysqli_stmt_execute($res_e)) {
                header("location: ../../faculty/faculty_panal.php");
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
</head>

<body>
    <div><?php include("new_navigation.php"); ?></div>
    <div class="p-3 bg-info text-white">
        <form class="container col-lg-8 " action="includenews.php" method="POST">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title">
                <?php if (isset($err)) { ?>
                    <span style="color:red;"> <?php echo $err ?></span>
                <?php } ?>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Detail</label>
                <textarea class="form-control z-depth-1" name="detail" rows="3" placeholder="Write Detail here..."></textarea>
                <?php if (isset($detail_err)) { ?>
                    <span style="color:red;"> <?php echo $detail_err ?></span>
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-primary" name="Register">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <div><?php include("../includes/footer.php"); ?></div>
</body>

</html>