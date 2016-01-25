<?php
include_once('config.php'); //to get the $db connection

$isLogged = true;
session_start(); // Start/resume session

if (!empty($_SESSION)) { //if have $_SESSION variables
    $user_check = $_SESSION['login_user'];

    $ses_sql = mysqli_query($db, "select username from admin where username='$user_check' ");

    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
    $login_session = $row['username'];

//PHP_SELF is a variable that returns the current script being executed. 
//This variable returns the name and path of the current file (from the root folder). 
    if (!isset($login_session) && $_SERVER['PHP_SELF'] != '/index.php') { //if login_session is NULL & we're not on index.php
        header("Location: login.php"); //redirect to login

    }

} else if ($_SERVER['PHP_SELF'] != '/index.php') { //if we're not on /index.php //DO WE NEED THIS???
    header("Location: login.php"); // redirect to login

} else {
    $isLogged = false;
}
?>