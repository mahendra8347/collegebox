
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "admin") {
    header("location:../../admin/login.php");
} else {
}

include '../../includes/database.php';
$id = $_REQUEST['id'];
$query = "DELETE FROM news WHERE id=$id";
$result = mysqli_query($connect, $query);
header("Location: editnews.php");
?>