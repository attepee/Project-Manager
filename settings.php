<?php
    require_once("php/session.php");

    $errmsg = "OK";
    $userID = $_SESSION["userID"];

    $stmt = $db->query("SELECT userID, username, firstname, lastname, admin FROM users");
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
            <div class="content">
                <a href="newUser.php"><button>New user</button></a>
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
                        while ($row = $stmt->fetch()) {
                            echo "<tr>
                                    <td>".$row['userID']."</td>
                                    <td>"."<a href='.php?userID=".$row['userID']."'>".$row['username']."</a>"."</td>
                                    <td>".$row['firstname']."</td>
                                    <td>".$row['lastname']."</td>
                                    <td>".$row['admin']."</td>
                                </a></tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
