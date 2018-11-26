<?php
    session_start();

    if (isset($_SESSION['app2_islogged'])) {
        unset($_SESSION['app2_islogged']);
    }

    header("Location: login.php");
?>