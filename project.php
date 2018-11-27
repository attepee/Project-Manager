<?php
    require_once("php/session.php");

    $errmsg = "";

    $id = $_GET["id"];

    //Add notes and tasks
    switch($_POST["action"]){
        case "Add note":
            if (isset($_POST["noteTitle"]) AND isset($_POST["note"])){
                $title = $_POST["noteTitle"];
                $note = $_POST["note"];
                $userID = $_SESSION["userID"];

                $sql = "INSERT INTO project_notes ( title, note, projectID, owner ) VALUES ( '$title', '$note', '$id', '$userID')";

                if ($affected_rows = $db->exec($sql) === TRUE){
                    echo "New note created successfully";
                }
            }
            else{
                $errmsg = "";
            }
            break;
        case "Add task":
            if (isset($_POST["taskTitle"]) AND isset($_POST["description"]) AND isset($_POST["duedate"]) AND isset($_POST["user"])){
                $title = $_POST["taskTitle"];
                $desc = $_POST["description"];
                $date = date("Y-m-d");
                $duedate = $_POST["duedate"];
                $owner = $_SESSION["userID"];
                $user = $_POST["user"];

                $sql = "INSERT INTO tasks ( title, description, create_date, due_date, status, projectID, owner, assigned_user ) VALUES ( '$title', '$desc', '$date', '$duedate', '1', '$id', '$owner', '$user')";

                if ($affected_rows = $db->exec($sql) === TRUE){
                    echo "New project created successfully";
                }
            }
            else{
                $errmsg = "";
            }
            break;
    }
?>

<html>
    <head>
        <title>Project | Project Manager</title>
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
                    <button>Remove project</button>
                    <button>Close project</button>
                </div>
                <?php
                    //Get Project data
                    $stmt = $db->query("SELECT * FROM projects WHERE projectID = '$id'");
                    $row = $stmt->fetch();
                
                    echo "<h1>".$row['title']."</h1>
                        <p class='small'>Project created ".$row['create_date']."</p>
                        <p class='small'>Project due ".$row['due_date']."</p>
                        <p>".$row['description']."</p>";
                ?>
                <div class="buttonHolder"><button id="noteButton" onclick="showNoteForm()">Add note</button><br></div>
                <form method="post" action="<?php echo "project.php?id=".$id;?>" class="hiddenForm" id="noteForm">
                    <label>Title</label><br>
                    <input type="text" name="noteTitle"><br>
                    <label>Note</label><br>
                    <textarea type="text" name="note" required></textarea><br>
                    <input type="submit" name="action" value="Add note">
                    <a id="hideNoteForm">Cancel</a>
                </form>
                <h2>Project notes</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Note</th>
                    </tr>
                <?php
                    //Get notes
                    $stmt = $db->query("SELECT * FROM project_notes WHERE projectID = '$id'");
                
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                                <td>".$row['project_noteID']."</td>
                                <td>".$row['title']."</td>
                                <td>".$row['note']."</td>
                            </tr>";
                    }
                ?>
                </table>
                <div class="buttonHolder"><button id="taskButton" onclick="showTaskForm('noteForm')">Add task</button><br></div>
                <form method="post" action="<?php echo "project.php?id=".$id;?>" class="hiddenForm" id="taskForm">
                    <label>Title</label><br>
                    <input type="text" name="taskTitle"><br>
                    <label>Description</label><br>
                    <textarea type="text" name="description" required></textarea><br>
                    <label>Due date</label><br>
                    <input type="date" name="duedate"><br>
                    <select name="user">
                    <?php
                        //Get list of users
                        $stmt = $db->query("SELECT userID, username FROM users");
                    
                        while ($row = $stmt->fetch()) {
                            echo "<option value='".$row['userID']."'>".$row['username']."</option>";
                        }
                    ?>
                    </select>
                    <input type="submit" name="action" value="Add task">
                    <a id="hideTaskForm">Cancel</a>
                </form>
                <h2>Open tasks</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due date</th>
                        <th>Assigned user</th>
                    </tr>
                <?php
                    //Get open tasks
                    $stmt = $db->query("SELECT * FROM tasks WHERE projectID = '$id' and status = 1");
                
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                                <td>".$row['taskID']."</td>
                                <td>"."<a href='task.php?id=".$row['taskID']."'>".$row['title']."</a>"."</td>
                                <td>".$row['due_date']."</td>
                                <td>".$row['assigned_user']."</td>
                            </tr>";
                    }
                ?>
                </table>
                <h2>Closed tasks</h2>
                <table class="small">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due date</th>
                        <th>Assigned user</th>
                    </tr>
                <?php
                    //Get closed tasks
                    $stmt = $db->query("SELECT * FROM tasks WHERE projectID = '$id' and status = 0");
                
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                                <td>".$row['taskID']."</td>
                                <td>"."<a href='task.php?id=".$row['taskID']."'>".$row['title']."</a>"."</td>
                                <td>".$row['due_date']."</td>
                                <td>".$row['assigned_user']."</td>
                            </tr>";
                    }
                ?>
                </table>
            </div>
        </div>
        <script>
            function removeProject(){
                <?php
                    
                ?>
            }
            
            function showNoteForm(){
                var id = document.getElementById("noteForm");
                id.style.display = "block";
                document.getElementById("hideNoteForm").onclick = function(){
                    id.style.display = "none";
                };
            }
            
            function showTaskForm(){
                var id = document.getElementById("taskForm");
                id.style.display = "block";
                document.getElementById("hideTaskForm").onclick = function(){
                    id.style.display = "none";
                };
            }
        </script>
    </body>
</html>
