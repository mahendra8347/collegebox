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
    $dep = $_SESSION['dep'];

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

            //---------------------- adding news to particular department-----------------------------

            //---------------------- IT department --------------------------

            if ($dep == 'IT') {
                $res_e = mysqli_prepare($connect, "INSERT INTO it_department_news (title,detail,date)
                VALUES ('$title','$detail','$date')");
                if (mysqli_stmt_execute($res_e)) {
                    header("location:faculty_panal.php");
                } else {
                    echo "something went wring ..... can not redirect!";
                }
            } 
            
            //---------------------- CE department --------------------------
            
            elseif ($dep == "CE") {
                $res_e = mysqli_prepare($connect, "INSERT INTO ce_department_news (title,detail,date)
                VALUES ('$title','$detail','$date')");
                if (mysqli_stmt_execute($res_e)) {
                    header("location:faculty_panal.php");
                } else {
                    echo "something went wring ..... can not redirect!";
                }
            } else {
            }
        }
    }
}
