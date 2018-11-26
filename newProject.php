<?php
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
        <?php
            include("header.php");
        ?>
        <div id="container">
            <div id="form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <label>Project title</label><br>
                    <input type="text" name="title" required><br>
                    <label>Project description</label><br>
                    <textarea type="text" name="desc" required></textarea><br>
                    <label>Due date</label><br>
                    <input type="date" name="duedate"><br>
                    <input type="submit" name="action" value="Create project">
                </form>
                <a href="projects.php"><button>Cancel</button></a>
            </div>
        </div>
    </body>
</html>
