<?php

require_once '../core/database.php';

$db = new Database;

session_start();
$user = $_SESSION['user'];

$userID = $user['id'];

$tasks = $db->getAllTasks('users_id', $userID);

$pendingCount = 0;
$completedCount = 0;

// loop through the tasks gotten from db, if completed is true add 1 to the complete count else add 1 to the pending count.
foreach ($tasks as $task) {
  if ($task['completed']) {
    $completedCount++;
  } else {
    $pendingCount++;
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
  <title>Task Manager</title>
</head>

<body>

  <?php if ($user) : ?>

    <!-- Nav -->
    <div class="container">
      <div class="nav">
        <h1><a href="home.php">TMs</a></h1>
      </div>
    </div>
    <!-- end -->
    <table class="task-form">

      <!-- Table to display result -->
      <thead>
        <tr>
          <th colspan="2">
            <h1 style="font-style: italic;">DASHBOARD</h1>
          </th>
        </tr>
        <tr>
          <th>
            <h2>STATUS</h2>
          </th>
          <th>
            <h2>COUNT</h2>
          </th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td style="font-weight: 900;">Pending Task(s)</td>
          <td style="font-weight: 900;  text-align: center;">
            <?php echo $pendingCount; ?>
          </td>
        </tr>
        <tr>
          <td style="font-weight: 900;">Completed Task(s)</td>
          <td style="font-weight: 900;  text-align: center;"><?php echo $completedCount; ?></td>
        </tr>
      </tbody>
    </table>
    <!-- end -->

  <?php else : header('Location: login.php'); ?>

  <?php endif ?>


</body>

</html>