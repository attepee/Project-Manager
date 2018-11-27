<?php
    require_once("php/session.php");

    $id = $_GET["id"];


    switch($_POST["action"]){
        case "Add note":
            //Add notes
            if (isset($_POST["noteTitle"]) AND isset($_POST["note"]) AND isset($_POST["hours"])){
                $title = $_POST["noteTitle"];
                $note = $_POST["note"];
                $hours = $_POST["hours"];
                $userID = $_SESSION["userID"];

                $sql = $db->query("SELECT projectID, owner FROM tasks WHERE taskID = '$id'");
                $row = $sql->fetch();

                $projectID = $row['projectID'];
                $owner = $row['owner'];

                $sql = "INSERT INTO task_notes ( title, note, hours_worked, taskID, projectID, owner, assigned_user ) VALUES ( '$title', '$note', '$hours', '$id' , '$projectID', '$owner','$userID')";

                if ($affected_rows = $db->exec($sql) === TRUE){
                    echo "New note created successfully";
                }
            }
            else{
                $errmsg = "";
            }
            break;
        case "Remove task":
            $sql = "DELETE FROM tasks WHERE taskID = '$id'";
        
            if ($affected_rows = $db->exec($sql) === TRUE){
                header("Location: projects.php");
            }
            break;
        case "Close task":
            $sql = "UPDATE tasks SET status = 0 WHERE taskID = '$id'";
        
            if ($affected_rows = $db->exec($sql) === TRUE){
                header("Location: projects.php");
            }
            break;
    }
?>

<html>
    <head>
        <title>Task | Project Manager</title>
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
                    <form id="form" method="post" action="<?php echo "task.php?id=".$id;?>">
                        <input type=submit name="action" value="Remove task"><br>
                        <input type="submit" name="action" value="Close task">
                    </form>
                </div>
                <?php
                    //Get Project data
                    $sql = $db->query("SELECT * FROM tasks WHERE taskID = '$id'");
                    $row = $sql->fetch();
                
                    echo "<h1>".$row['title']."</h1>
                        <p class='small'>Task created ".$row['create_date']."</p>
                        <p class='small'>Task due ".$row['due_date']."</p>
                        <p>".$row['description']."</p>";
                ?>
                <div class="buttonHolder"><button id="noteButton" onclick="showNoteForm()">Add note</button><br></div>
                <form method="post" action="<?php echo "task.php?id=".$id;?>" class="hiddenForm" id="noteForm">
                    <label>Title</label><br>
                    <input type="text" name="noteTitle"><br>
                    <label>Note</label><br>
                    <textarea type="text" name="note" required></textarea><br>
                    <label>Hours worked</label><br>
                    <input type="number" name="hours" required><br>
                    <input type="submit" name="action" value="Add note">
                    <a id="hideNoteForm">Cancel</a>
                </form>
                <h2>Task notes</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Note</th>
                        <th>Hours Worked</th>
                    </tr>
                <?php
                    //Get notes
                    $sql = $db->query("SELECT task_noteID, title, note, hours_worked FROM task_notes WHERE taskID = '$id'");
                    
                    while ($row = $sql->fetch()) {
                        echo "<tr>
                                <td>".$row['task_noteID']."</td>
                                <td>".$row['title']."</td>
                                <td>".$row['note']."</td>
                                <td>".$row['hours_worked']."</td>
                            </tr>";
                    }
                ?>
                </table>
            </div>
        </div>
        <script>        
            function showNoteForm(){
                var id = document.getElementById("noteForm");
                id.style.display = "block";
                document.getElementById("hideNoteForm").onclick = function(){
                    id.style.display = "none";
                };
            }
        </script>
    </body>
</html>
