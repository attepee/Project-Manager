<?php
    require_once("config.php");
    session_start();

    $username = $_SESSION["username"];

    $user = $db->query("SELECT firstname, userID, admin from users WHERE username = '$username'")->fetch();
    $_SESSION["firstname"] = $user[0];
    $_SESSION["userID"] = $user[1];
    $_SESSION["admin"] = $user[2];

    if (!isset($_SESSION["app2_islogged"]) || $_SESSION["app2_islogged"] !== true) {
        header("Location: login.php");
        exit;
    }
?>