<?php
    require_once("php/session.php");
    if ($_SESSION["admin"] != 1){
        header("Location: login.php");
        exit;
    }

    $userID = $_SESSION["userID"];
?>

<html>
    <head>
        <title>Settings | Project Manager</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.min.css">
    </head>
    <body>
        <?php
            include("header.php");
        ?>
        <div id="container">
            <div class="content">
                <div class="buttonHolder">
                    <form id="form" action="newUser.php">
                        <button>New user</button>
                    </form>
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Admin status</th>
                        <th></th>
                    </tr>
                    <?php
                        $sql = $db->query("SELECT userID, username, firstname, lastname, admin FROM users");
                    
                        while ($row = $sql->fetch()) {
                            echo "<tr>
                                    <td>".$row['userID']."</td>
                                    <td>"."<a href='user.php?id=".$row['userID']."'>".$row['username']."</a>"."</td>
                                    <td>".$row['firstname']."</td>
                                    <td>".$row['lastname']."</td>
                                    <td>".$row['admin']."</td>
                                </tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
