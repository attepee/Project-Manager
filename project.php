<?php
    require_once("php/session.php");

    $id = $_GET["id"];

    $stmt = $db->query("SELECT * FROM projects WHERE projectID = '$id'");
    $row = $stmt->fetch()
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
                <div class="buttonHolder"><button>Remove project</button></div>
                <?php
                    echo "<h1>".$row['title']."</h1>
                        <p class='small'>Project created ".$row['create_date']."</p>
                        <p class='small'>Project due ".$row['due_date']."</p>
                        <p>".$row['description']."</p>";
                ?>
                <div class="buttonHolder"><button id="noteButton" onclick="showNoteForm()">Add note</button><br></div>
                <form class="hiddenForm" id="noteForm">
                    <label>Title</label><br>
                    <input type="text" name="noteTitle"><br>
                    <label>Note</label><br>
                    <textarea type="text" name="note" required></textarea><br>
                    <input type="submit" name="action" value="Add note">
                    <a id="hideNoteForm">Cancel</a>
                </form>
                <?php
                    echo "<h2>Project notes</h2>
                        <div class='note'></div>";
                ?>
                <div class="buttonHolder"><button id="taskButton" onclick="showTaskForm('noteForm')">Add task</button><br></div>
                <form class="hiddenForm" id="taskForm">
                    <label>Title</label><br>
                    <input type="text" name="noteTitle"><br>
                    <label>Note</label><br>
                    <textarea type="text" name="note" required></textarea><br>
                    <label>Due date</label><br>
                    <input type="date" name="duedate"><br>
                    <input type="submit" name="action" value="Add task">
                    <a id="hideTaskForm">Cancel</a>
                </form>
                <?php
                    echo "<h2>Project tasks</h2>
                        <div class='note'></div>";
                ?>
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
