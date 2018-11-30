<?php
    require_once("php/session.php");
    require_once "/home/L9406/PasswordLib.phar";
    $lib = new PasswordLib\PasswordLib();

    //redirect to login if user is not admin
    if ($_SESSION["admin"] != 1){
        header("Location: login.php");
        exit;
    }

    $id = $_GET["id"];

    switch($_POST["action"]){
        case "Update user":
            //Update user info
            if (isset($_POST["username"]) AND isset($_POST["firstname"]) AND isset($_POST["lastname"]) AND isset($_POST["admin"])){
                $username = $_POST["username"];
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $admin = $_POST["admin"];

                $sql = $db->query("UPDATE users SET firstname = '$firstname', lastname = '$lastname', username = '$username', admin = $admin WHERE userID = '$id'");
                
                $db->exec($sql);
                header("Location: settings.php");
            }
            break;
        case "Remove user":
            //Remove user
            $sql = "DELETE FROM tasks WHERE taskID = '$id'";
        
            $db->exec($sql);
            header("Location: settings.php");
            break;
        case "Reset password":
            //Reset users password
            if (isset($_POST["password"])){
                $password = $_POST["password"];
                $hash = $lib->createPasswordHash($password,  '$2a$', array('cost' => 12));
                $sql = "UPDATE users SET password = '$hash' WHERE userID = '$id'";

                $db->exec($sql);
            }
            break;
    }
?>

<html>
    <head>
        <title>User | Project Manager</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.min.css">
    </head>
    <body>
        <?php
            include("header.php");
        ?>
        <div id="container">
            <div id="form">
                <div class="buttonHolder">
                    <form id="form" method="post" action="<?php echo "user.php?id=".$id;?>">
                        <input type=submit name="action" value="Remove user"><br>
                    </form>
                </div>
                <div class="buttonHolder"><button id="passButton" onclick="showPassForm()">Change password</button><br></div>
                <form method="post" action="<?php echo "user.php?id=".$id;?>" class="hiddenForm" id="passForm">
                    <label>New password</label><br>
                    <input type="password" name="password"><br>
                    <input type="submit" name="action" value="Reset password">
                    <a id="hidePassForm">Cancel</a>
                </form>
                <form method="post" action="<?php echo "user.php?id=".$id;?>">
                    <?php
                        //Get user data
                        $sql = $db->query("SELECT * FROM users WHERE userID = '$id'");
                        $row = $sql->fetch();

                        echo "<label>Username</label><br>
                            <input type='text' name='username' value='".$row['username']."' required><br>
                            <label>Firstname</label><br>
                            <input type='text' name='firstname' value='".$row['firstname']."' required><br>
                            <label>Lastname</label><br>
                            <input type='text' name='lastname' value='".$row['lastname']."' required><br>
                            <label>Admin</label><br>
                            <select name='admin'>
                                <option value='0'>No</option>
                                <option value='1'>Yes</option>
                            </select>
                            <input type='submit' name='action' value='Update user'><br>";
                    ?>
                </form>
                <form action="settings.php">
                    <button>Cancel</button>
                </form>
            </div>
        </div>
        <script>   
            function showPassForm(){
                var id = document.getElementById("passForm");
                id.style.display = "block";
                document.getElementById("hidePassForm").onclick = function(){
                    id.style.display = "none";
                };
            }
        </script>
    </body>
</html>
