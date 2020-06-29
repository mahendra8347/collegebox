<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "admin") {
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
    <div><?php include("navigation.php"); ?></div>
    <div class="container">
        <h3 class="text-primary text-center">Department Admin List</h3>
        <div class="d-flex justify-content-end">
            <button id="button" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                Add New Admin
            </button>
        </div>
        <h3 class="text-danger">All Records</h3>

        <div id="records_contant">
        </div>

        <!-- modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Record Here</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="home.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">User Name</label>
                                <input type="text" class="form-control" name="" id="username" placeholder="Enter User Name">
                                <?php if (isset($user_err)) { ?>
                                    <span style="color:red;"> <?php echo $user_err ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="" id="password" placeholder="Password">
                                <?php if (isset($password_err)) { ?>
                                    <span style="color:red;"> <?php echo $password_err ?></span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="inputState">Department</label>
                                <select id="inputState" class="form-control" name="" id="department">
                                    <option selected>IT</option>
                                    <option>CE</option>
                                    <option>EC</option>
                                    <option>PRODUCTION</option>
                                    <option>CIVIL</option>
                                    <option>MECHANICAL</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary " data-dismiss="modal" onclick="addRecord()" id="submit">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div><?php include("../includes/footer.php"); ?></div>


    <script type="text/javascript" src="jquery-1.6.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#submit').click(function() {
                var username = $('#username').val();
                var password = $('#password').val();
                var department = $('#department').val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: 'backend.php',
                    data: {
                        'username': username,
                        'password': password,
                        'department': department,
                    },
                    success: function(data) {
                        alert('data has been stored to database');
                    }
                });
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>