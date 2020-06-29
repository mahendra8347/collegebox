<?php
session_start();

include '../includes/database1.php';

$title_err = $detail_err = "";

$title = $_POST['title'];
$detail = $_POST['detail'];
$date = date("Y-m-d");
$type = $_POST['type'];
$submited_by = $_SESSION['en_no'];
$picture = "";

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
        $res_e = mysqli_prepare($connect, "INSERT INTO genral_complain (title,detail,picture,type,submited_by,date)
        VALUES ('$title','$detail','$picture','$type',$submited_by,'$date')");
        if (mysqli_stmt_execute($res_e)) {
            header("location:show_complain.php");
        } else {
            echo "something went wring ..... can not redirect!";
        }
    }
}

?>

<?php

$sel_query = "SELECT * FROM genral_complain ";
$result = mysqli_query($connect, $sel_query);
$total_row = mysqli_num_rows($result);
$res_it = mysqli_prepare($connect, "DELETE FROM it_dep");
mysqli_stmt_execute($res_it);
$res_genral = mysqli_prepare($connect, "DELETE FROM genral_dep");
mysqli_stmt_execute($res_genral);
$res_ce = mysqli_prepare($connect, "DELETE FROM ce_dep");
mysqli_stmt_execute($res_ce);
for ($i = 0; $i < ($row = mysqli_fetch_assoc($result)); $i++) {
    $title = $row['title'];
    $detail = $row['detail'];
    $submited_by = $row['submited_by'];
    $date = $row['date'];
    $type = $row['type'];
    $picture = $row['picture'];
    if ($type == 'it') {
        $res_e = mysqli_prepare($connect, "INSERT INTO it_dep (title,detail,picture,submited_by,date)
    VALUES ('$title','$detail','$picture',$submited_by,'$date')");
        mysqli_stmt_execute($res_e);
    } elseif ($type == 'ce') {
        $res_e = mysqli_prepare($connect, "INSERT INTO ce_dep (title,detail,picture,submited_by,date)
    VALUES ('$title','$detail','$picture',$submited_by,'$date')");
        mysqli_stmt_execute($res_e);
    } else {
        $res_e = mysqli_prepare($connect, "INSERT INTO genral_dep (title,detail,picture,submited_by,date)
    VALUES ('$title','$detail','$picture',$submited_by,'$date')");
        mysqli_stmt_execute($res_e);
    }
}
?>