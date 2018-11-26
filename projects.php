<?php
    require_once("php/session.php");

    $errmsg = "OK";
    $userID = $_SESSION["userID"];

    $stmt = $db->query("SELECT projectID, title, due_date, owner FROM projects WHERE owner = '$userID' ORDER BY due_date ASC");
?>

<html>
    <head>
        <title>Projects | Project Manager</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.min.css">
  </head>
    <body>
        <?php
            include("header.php");
        ?>
        <div id="container">
            <a href="newProject.php"><button>New project</button></a>
            <div class="content">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due date</th>
                        <th>manager</th>
                    </tr>
                    <?php
                        while ($row = $stmt->fetch()) {
                            echo "<tr>
                                    <td>".$row['projectID']."</td>
                                    <td>"."<a href='project.php?projectid=".$row['projectID']."'>".$row['title']."</a>"."</td>
                                    <td>".$row['due_date']."</td>
                                    <td>".$row['owner']."</td>
                                </a></tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
