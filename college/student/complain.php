<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "student") {
    header("location:login.php");
} else {
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
    <div><?php include("new_navigation.php"); ?></div>
    <div class="p-3 bg-info text-white" style="height: 525px">
        <form class="container col-lg-8 " action="backend_complain.php" method="POST">
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
            <div class="form-group col-md-6">
                <label for="inputState">Select Complain Type</label>
                <select id="inputState" class="form-control" name="type">
                    <option value="genral" selected>Genral</option>
                    <option value="it">To IT Department</option>
                    <option value="ce">To CE Department</option>
                    <!-- <option value="ec">To EC Department</option>
                    <option value="production">To PRODUCTION Department</option>
                    <option value="civil">To CIVIL Department</option>
                    <option value="mechanical">To MECHANICAL Department</option> -->
                </select>
            </div>
            <!-- <div class="form-group col-md-6">
                <input type="file" name="profile_photo" value="upload picture here">
                <label for="inputimage">Upload Picture Here</label>
            </div> -->
            <button type="submit" class="btn btn-primary" name="Register">Submit</button>
        </form>
    </div>

    <div>
        <?php include("../includes/footer.php"); ?>
    </div>

    <script type="text/javascript" src="../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>