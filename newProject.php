<?php
    require_once("php/config.php");
    require_once("php/session.php");

    $errmsg = "OK";

    if (isset($_POST["title"]) AND isset($_POST["desc"]) AND isset($_POST["duedate"])){
        $title = $_POST["title"];
        $desc = $_POST["desc"];
        $date = date("Y-m-d");
        $duedate = $_POST["duedate"];
        $userID = $_SESSION["userID"];

        $sql = "INSERT INTO projects ( title, description, create_date, due_date, status, owner ) VALUES ( '$title', '$desc', '$date', '$duedate', 1, '$userID')";

        if ($affected_rows = $db->exec($sql) === TRUE){
            echo "New project created successfully";
        }
    }
    else{
        $errmsg = "";
    }
?>

<html>
    <head>
        <title>Profile | Project Manager</title>
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
            <div class="content">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <label>Project title</label><br>
                    <input type="text" name="title" required><br>
                    <label>Project description</label><br>
                    <textarea type="text" name="desc" required></textarea><br>
                    <label>Due date</label><br>
                    <input type="date" name="duedate"><br>
                    <input type="submit" name="action" value="Create project">
                </form>
            </div>
        </div>
    </body>
</html>
