
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "admin") {
    header("location:../../admin/login.php");
} else {
}

include '../includes/database.php';
$id = $_REQUEST['id'];
$query = "DELETE FROM faculty_data WHERE id=$id";
$result = mysqli_query($connect, $query);
header("Location: edit_admin_record.php");
?>