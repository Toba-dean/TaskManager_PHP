<?php

require_once '../core/database.php';

session_start();
$user = $_SESSION['user'];

// grt the id from the url when the edit button is clicked.
$id = $_GET['id'];
$db = new Database;

// if no id redirect to the home page
if (!$id) {
  header('Location: home.php');
  exit;
}

// get the task with that id
$tasks = $db->findOne('id', $id, 'tasks');

// set the task and completed to te values from the db
$task = $tasks['task'];
$completed = $tasks["completed"];

// on submit update the tasks.
if (isset($_POST['edit'])) {
  $task = $_POST['task'];
  $completed = $_POST['completed'];

  $db->updateTask($task, $completed, $id);

  header('Location: home.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">

  <!-- font awesome -->
  <link rel="stylesheet" href="assets/all.min.css">
  <title>Document</title>
</head>

<body>

  <?php if ($user) : ?>
    
    <!-- Nav -->
    <div class="container">
      <div class="nav">
        <h1><a href="index.php">TMs</a></h1>
        <div class="right">
          <a href="logout.php" style="margin-right: 10px;">logout</a>
          <a href="dashboard.php"><?php echo $user['username']; ?></a>
        </div>
      </div>
    </div>
    <!-- End -->

    <!-- Edit Form -->
    <div class="container">
      <form class="single-task-form" method="post">
        <h4>Edit Task</h4>

        <div class="form-control">
          <label>Task ID</label>
          <p class="task-edit-id">
            <?php echo $tasks['id'] ?>
          </p>
        </div>

        <div class="form-control">
          <label for="name">Task</label>
          <input type="text" name="task" class="task-edit-name" value="<?php echo $tasks['task'] ?>" />
        </div>

        <div class="form-control">
          <label>Completed</label>
          <input 
            type="checkbox" 
            name="completed" 
            class="task-edit-completed" 
            value="1" 
            <?php echo $tasks['completed'] ? "checked" : ''?> 
          />
        </div>

        <button type="submit" class="block btn task-edit-btn" name="edit">edit task</button>

      </form>
      <!-- End -->

      <a href="home.php" class="btn back-link">back to tasks</a>
    </div>

  <?php else : header('Location: login.php'); ?>

  <?php endif ?>
</body>

</html>