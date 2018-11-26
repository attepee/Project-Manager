<?php
    require_once("config.php");
    session_start();

    $username = $_SESSION["username"];

    $user = $db->query("SELECT userID, admin from users WHERE username = '$username'")->fetch();
    $_SESSION["userID"] = $user[0];
    $_SESSION["admin"] = $user[1];

    if (!isset($_SESSION["app2_islogged"]) || $_SESSION["app2_islogged"] !== true) {
        header("Location: login.php");
        exit;
    }
?>