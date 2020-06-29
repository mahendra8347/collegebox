<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "admin") {
    header("location:../../admin/login.php");
} else {
}

include '../../includes/database.php';
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
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Title</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                $sel_query = "Select * from news ORDER by id desc";
                $result = mysqli_query($connect, $sel_query);
                $total_records = mysqli_num_rows($result);
                if ($total_records == 0) { ?>
                    <tr>
                        <td>
                            <h3 style="color:red"><?php echo "No Any Racord Here" ?></h3>
                        </td>
                    </tr>
                    <?php } else {

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo substr($row["detail"], 0, 50); ?><a href="more_detail.php?id=<?php echo $row["id"]; ?>">Show More</a></td>
                            <td><?php echo $row["date"]; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
                            </td>
                        </tr>
                <?php $count++;
                    }
                } ?>
            </tbody>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <div><?php include("../../includes/footer.php"); ?></div>
</body>

</html>