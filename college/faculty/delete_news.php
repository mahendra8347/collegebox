
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "faculty") {
    header("location:login.php");
} else {
}

include '../includes/database.php';
$id = $_REQUEST['id'];
$department = $_SESSION['dep'];
if ($department == 'IT') {
    $query = "DELETE FROM it_department_news WHERE id=$id";
}elseif($department == 'CE'){
    $query = "DELETE FROM ce_department_news WHERE id=$id";
}
$result = mysqli_query($connect, $query);
header("Location: editnews.php");
?>