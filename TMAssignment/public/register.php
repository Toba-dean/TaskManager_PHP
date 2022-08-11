<?php

require_once '../core/database.php';

// initial state of the fields.
$username = '';
$email = '';
$password = '';
$confirm_password = '';
$errors = [];

$db = new Database;

// onsubmit validate the form
if (isset($_POST['register'])) {

  require_once '../core/utils/validate.php';

  // if no errors register user withe the entered details
  if (empty($errors)) {
    $db->registerUser($username, $email, $password);

    // then get the user.
    $user = $db->findOne('email', $email, 'users');

    // save it in the session.
    session_start();
    $_SESSION['user'] = $user;

    // redirect to the home page on successful registration.
    if ($user) {
      header('Location: home.php');
    } else {
      header('Location: register.php');
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

<!-- Registration form -->
  <form class="task-form" method="POST">
    <h4>Register</h4>

    <?php require_once "../core/utils/error.php"; ?>

    <div class="form-control" style="margin-bottom: 10px;">
      <input type="text" name="username" class="task-input" placeholder="Enter your name" value="<?php echo $username ?>" />
    </div>

    <div class="form-control" style="margin-bottom: 10px;">
      <input type="text" name="email" class="task-input" placeholder="Enter your email" value="<?php echo $email ?>" />
    </div>

    <div class="form-control" style="margin-bottom: 10px;">
      <input type="password" name="password" class="task-input" placeholder="Create password" />
    </div>

    <div class="form-control" style="margin-bottom: 20px;">
      <input type="password" name="confirm_password" class="task-input" placeholder="Confirm Password" />
    </div>

    <button type="submit" name="register" class="btn">
      Register
    </button>

    <p>
      Have an account?
      <a href="login.php">
        <b>Login Now.</b>
      </a>
    </p>
  </form>
  <!-- End -->

<?php else : header('Location: home.php'); ?>

<?php endif ?>

</body>

</html>