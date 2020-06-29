<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "admin") {
    header("location:../../admin/login.php");
} else {
}

include '../../includes/database.php';
$id = $_REQUEST['id'];
$query = "Select * from news where id='" . $id . "'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Collegebox</title>
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div><?php include("../navigation.php"); ?></div>
    <?php
    $status = "";
    if (isset($_POST['new']) && $_POST['new'] == 1) {
        $id = $_REQUEST['id'];
        $date = date("Y-m-d");
        $title = $_REQUEST['title'];
        $detail = $_REQUEST['detail'];
        $update = "update news set date ='" . $date . "',title='" . $title . "',detail='" . $detail . "' where id='" . $id . "'";
        mysqli_query($connect, $update);
        $status = "record updeted Successfuly";
        echo '<script>alert("record updeted Successfuly")</script>';
        header('Location:editnews.php');
    } else {
    ?>
        <div class="p-3 bg-info text-white">
            <form class="container col-lg-8 " action="" method="POST" name="form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="hidden" class="form-control" name="new" value="1" />
                        <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" name="id" />
                        <label for="inputEmail4">Title</label>
                        <input type="text" class="form-control" required name="title" placeholder="Enter Title" value="<?php echo $row['title']; ?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Old Detail</label>
                        <input type="textarea" class="form-control" required name="detail" placeholder="Enter Detail" value="<?php echo $row['detail']; ?>" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>
        </div>
    <?php } ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <div><?php include("../../includes/footer.php"); ?></div>

</body>

</html>