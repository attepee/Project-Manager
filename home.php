<?php
    require_once("php/session.php");

    $userID = $_SESSION["userID"];
?>

<html>
    <head>
        <title>Home | Project Manager</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.min.css">
    </head>
    <body>
        <?php
            include("header.php");
        ?>
        <div id="container">
            <div class="content">
                <h1>Welcome, <?php echo $_SESSION["firstname"]?>!</h1>
                <h2>Your projects</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due date</th>
                    </tr>
                    <?php     
                        $sql = $db->query("SELECT projectID, title, due_date FROM projects WHERE owner = '$userID' ORDER BY due_date ASC");
                    
                        while ($row = $sql->fetch()) {
                            echo "<tr>
                                    <td>".$row['projectID']."</td>
                                    <td>"."<a href='project.php?projectid=".$row['projectID']."'>".$row['title']."</a>"."</td>
                                    <td>".$row['due_date']."</td>
                                </tr>";
                        }
                    ?>
                </table>
            </div>
            <div class="content">
                <h2>Your tasks</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due date</th>
                    </tr>
                <?php
                    $sql = $db->query("SELECT taskID, title, due_date, assigned_user FROM tasks WHERE assigned_user = '$userID' ORDER BY due_date ASC");
                    
                        while ($row = $sql->fetch()) {
                            echo "<tr>
                                    <td>".$row['taskID']."</td>
                                    <td>".$row['title']."</td>
                                    <td>".$row['due_date']."</td>
                                </tr>";
                        }
                ?>
                </table>
            </div>
            <div class="content">
                <h2>Hours worked</h2>
                <?php
                    $hours = 0;
                    $sql = $db->query("SELECT SUM(hours_worked) as sum FROM task_notes WHERE assigned_user = '$userID'");

                    $row = $sql->fetch();
                    echo "<p>".$row['sum']." hours</p>";
                ?>
            </div>
        </div>
    </body>
</html>