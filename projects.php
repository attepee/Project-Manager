<?php
    require_once("php/session.php");
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
            <div class="buttonHolder">
                <form id="form" action="newProject.php">
                    <button>New project</button>
                </form>
            </div>
            <div class="content">
                <h2>Open projects</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due date</th>
                        <th>manager</th>
                    </tr>
                    <?php
                        // Get open projects
                        $sql = $db->query("SELECT projectID, title, due_date, owner FROM projects WHERE status = 1 ORDER BY due_date ASC");
                    
                        while ($row = $sql->fetch()) {
                            echo "<tr>
                                    <td>".$row['projectID']."</td>
                                    <td>"."<a href='project.php?id=".$row['projectID']."'>".$row['title']."</a>"."</td>
                                    <td>".$row['due_date']."</td>
                                    <td>".$row['owner']."</td>
                                </tr>";
                        }
                    ?>
                </table>
                <h2>Closed projects</h2>
                <table class="small">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due date</th>
                        <th>manager</th>
                    </tr>
                    <?php
                        // Get closed projects
                        $sql = $db->query("SELECT projectID, title, due_date, owner FROM projects WHERE status = 0 ORDER BY due_date ASC");
                    
                        while ($row = $sql->fetch()) {
                            echo "<tr>
                                    <td>".$row['projectID']."</td>
                                    <td>"."<a href='project.php?id=".$row['projectID']."'>".$row['title']."</a>"."</td>
                                    <td>".$row['due_date']."</td>
                                    <td>".$row['owner']."</td>
                                </tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
