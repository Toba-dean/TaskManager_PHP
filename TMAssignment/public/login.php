<?php

require_once '../core/database.php';

// initial state of the fields.
$email = '';
$password = '';
$errors = [];

$db = new Database;

// onsubmit validate the form
if (isset($_POST['login'])) {

  require_once '../core/utils/validateLog.php';

  // find the user with the email.
  $user = $db->findOne('email', $email, 'users');

  // check if password is the same as the one in the db
  if (!password_verify($password, $user['password'] ?? null)) {
    $errors[] = 'Password Incorrect<br>';
  }

  // no error, login the user.
  if (empty($errors)) {

    session_start();
    $_SESSION['user'] = $user;

    if ($user) {
      header('Location: home.php');
    }
  }
}

?>

<?php

session_start();
$user = $_SESSION;

if (!$user) : 

?>

  <?php

  require_once '../views/authHeader.php';

  ?>

<!-- Login form -->
  <form class="task-form" method="POST">
    <h4>Login</h4>

    <?php require_once "../core/utils/error.php"; ?>

    <div class="form-control" style="margin-bottom: 10px;">
      <input type="text" name="email" class="task-input" placeholder="Enter your email" value="<?php echo $email ?>" />
    </div>

    <div class="form-control" style="margin-bottom: 10px;">
      <input type="password" name="password" class="task-input" placeholder="Enter password" />
    </div>

    <button type="submit" class="btn" name="login">
      Login
    </button>
    
    <p>
      Don't have an account?
      <a href="register.php">
        <b>Register Now.</b>
      </a>
    </p>
  </form>
  <!-- End -->

<?php else : header('Location: home.php'); ?>

<?php endif ?>

</body>

</html>