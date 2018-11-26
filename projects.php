<?php
    require_once("php/config.php");
    require_once("php/session.php");

    $errmsg = "OK";

    $stmt = $db->query("SELECT projectID, title, due_date, owner FROM projects");
?>

<html>
    <head>
        <title>Projects | Project Manager</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.min.css">
  </head>
    <body>
        <div id="header">
            <div id=logo>
                <p><i class="fas fa-project-diagram"></i>Project Manager</p>
            </div>
            <div id="navBar">
                <ul>
                    <li><a href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a></li>
                    <li><a href="profile.php">Settings <i class="fas fa-cog"></i></a></li>
                    <li><a href="statistics.php">Statistics <i class="fas fa-chart-bar"></i></a></li>
                    <li><a href="projects.php">Projects <i class="fas fa-project-diagram"></i></a></li>
                    <li><a href="home.php">Home <i class="fas fa-home"></i></a></li>
                </ul>
            </div>
        </div>
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
