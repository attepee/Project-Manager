<?php
    session_start();
    require_once("php/config.php");
    require_once "/home/L9406/PasswordLib.phar";
    $lib = new PasswordLib\PasswordLib();

    $errmsg = "OK";
    if (isset($_POST["username"]) AND isset($_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT userID, username, password FROM users WHERE username = :username";

        $stmt = $db->prepare($sql);
        $stmt->execute(array($username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 1 AND $lib->verifyPasswordHash($password, $row["password"])){
            $_SESSION["app2_islogged"] = true;
            $_SESSION["username"] = $_POST["username"];
            header("Location: home.php");
        }
    }
    else{
        $errmsg = "<span>Username or password wrong</span>";
    }
?>

<html>
    <head>
        <title>Projects | Project Manager</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.min.css">
    </head>
    <body>
        <div id="container">
            <div id="form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <p><i class="fas fa-project-diagram"></i>Project Manager</p>
                    <label>Username</label><br>
                    <input type="text" name="username" required><br>
                    <label>Password</label><br>
                    <input type="password" name="password" required><br>
                    <input type="submit" name="action" value="Login">
                </form>
            </div>
        </div>
    </body>
</html>