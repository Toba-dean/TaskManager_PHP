<?php

require_once '../core/database.php';

// getting user data from the session.
session_start();
$user = $_SESSION['user'];

// initial state of the fields.
$task = '';
$errors = [];

// database instance
$db = new Database;

// getting the user id
$userID = $user['id'];

// getting all the task by logged in user.
$tasks = $db->getAllTasks('users_id', $userID);

// onsubmit check for errors, if none create a new task and save into the db.
if (isset($_POST['submit'])) {
  $task = $_POST['task'];

  if (!$task) {
    $errors[] = 'This field cannot be empty';
  }

  if (empty($errors)) {
    $db->createTask($task, $userID);
    header('Location: home.php');
  }
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

  <!-- if there is a user in the session show page else route to the login page. -->
  <?php if ($user) : ?>

    <!-- Nav -->
    <div class="container">
      <div class="nav">
        <h1><a href="index.php">TMs</a></h1>
        <div class="right">
          <a href="dashboard.php" style="margin-right: 10px;"><?php echo $user['username']; ?></a>
          <a href="logout.php">logout</a>
        </div>
      </div>
    </div>
    <!-- end -->

    <!-- edit form section -->
    <form class="task-form" method="POST">
      <h4>task manager</h4>

      <?php require_once "../core/utils/error.php"; ?>

      <div class="form-control">
        <input type="text" name="task" class="task-input" placeholder="e.g. watch anime!" value="<?php echo $task; ?>" />
        <input type="hidden" name="userID">
        <button type="submit" class="btn submit-btn" name="submit">submit</button>
      </div>
    </form>
    <!-- end -->

    <!-- the task list -->
    <section class="tasks-container">
      <div class="tasks">
        </pre>
        <?php foreach ($tasks as $i => $task) { ?>

          <!-- All task goes here -->
          <div class="single-task <?php echo $task['completed'] ? 'task-completed' : '' ?>">
            <h5>
              <!-- this shows on edit -->
              <span><i class="fas fa-check-circle"></i></span>
              <!-- end -->
              <?php
              echo $task['task'];
              ?>
            </h5>
            <div class="task-links">

              <!-- edit link to complete and edit the task -->
              <a href="edit.php?id=<?php echo $task['id'] ?>" class="edit-link">
                <i class="fas fa-edit"></i>
              </a>

              <!-- delete btn -->
              <form style="width: 0; padding: 0;" method="post" action="delete.php">
                <input type="hidden" name="id" value="<?php echo $task['id'] ?>" />
                <button type="submit" class="delete-btn">
                  <i class="fas fa-trash"></i>
                </button>
              </form>

            </div>
          </div>
        <?php } ?>
      </div>
    </section>
    <!-- end -->

  <?php else : header('Location: login.php'); ?>

  <?php endif ?>
</body>

</html>