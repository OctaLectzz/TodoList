<?php

    // Errors No Data //
    $errors = "";


    // Conect To The Database //
    $db = mysqli_connect('localhost', 'root', '', 'TodoList');

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "ERROR!!! you must fill in the Task";
        }else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }


    // Delete Task //
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>    




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">


    <title>TodoList - Lectzz</title>
  </head>
  <body>


    <!-- Header -->
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="head">TODOLIST</h2>
            </div>
        </div>
    </div>
    <!-- Header -->


    <!-- TodoList -->
    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Add TodoList -->
                <form method="POST" action="index.php" autocomplete="off">
                    <?php if (isset($errors)) { ?>
                        <p><b><?php echo $errors; ?></b></p>
                    <?php } ?>
                    <input type="text" placeholder="Add TodoList" name="task" class="task_input">
                    <button type="submit" class="add_btn" name="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                </form>
                <!-- Add TodoList -->


                <!-- Show TodoList -->
                <div class="bg">
                    <?php while ($row = mysqli_fetch_array($tasks)) { ?>
                    <div class="todo-item">

                        <!-- Remove TodoList -->
                        <a href="index.php?del_task=<?php echo $row['id']; ?>" class="remove-to-do">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                            </svg>
                        </a>
                        <!-- Remove TodoList -->

                        <!-- CheckBox -->
                        <?php if($row['checked']) { ?>
                            <input type="checkbox"
                                class="check-box"
                                data-todo-id ="<?php echo $row['id']; ?>"
                                checked />
                            <h2 class="checked"><?php echo $row['task'] ?></h2>
                        <?php } else { ?>
                            <input type="checkbox"
                                data-todo-id ="<?php echo $row['id']; ?>"
                                class="check-box" />
                        <!-- CheckBox -->

                        <!-- List -->
                        <h2><?php echo $row['task'] ?></h2>
                        <?php } ?>
                        <!-- List -->
                        
                        <!-- Date Time -->
                        <small>created: <?php echo $row['date_time'] ?></small> 
                        <!-- Sate Time -->

                    </div>
                    <?php } ?>
                </div>
                <!-- Show TodoList -->

            </div>
        </div>
    </div>
    <!-- TodoList -->




    



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>