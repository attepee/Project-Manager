<?php
    require_once("php/session.php");
    require_once '/home/L9406/PasswordLib.phar';
    $lib = new PasswordLib\PasswordLib();

    if ($_SESSION["admin"] != 1){
        header("Location: login.php");
        exit;
    }

    $msg = "";

    if (isset($_POST["username"]) AND isset($_POST["firstname"]) AND isset($_POST["lastname"]) AND isset($_POST["password"]) AND isset($_POST["admin"])){
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $admin = $_POST["admin"];
        $hash = $lib->createPasswordHash($password, '$2a$', array('cost' => 12));
        
        $sql = "INSERT INTO users ( firstname, lastname, username, password, admin ) VALUES ( '$firstname', '$lastname', '$username', '$hash', '$admin')";
        
        if ($affected_rows = $db->exec($sql) === TRUE){
            $msg =  "New user created successfully";
        }
    }
    else{
        $msg = "";
    }
?>

<html>
    <head>
        <title>Profile | Project Manager</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.min.css">
    </head>
    <body>
        <?php
            include("header.php");
        ?>
        <div id="container">
            <div id="form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <label>Username</label><br>
                    <input type="text" name="username" required><br>
                    <label>Firstname</label><br>
                    <input type="text" name="firstname" required><br>
                    <label>Lastname</label><br>
                    <input type="text" name="lastname" required><br>
                    <label>Password</label><br>
                    <input type="password" name="password" required><br>
                    <label>Admin</label><br>
                    <select name="admin">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <input type="submit" name="action" value="Create user"><br>
                </form>
                <a href="settings.php"><button>Cancel</button></a>
            </div>
        </div>
    </body>
</html>
