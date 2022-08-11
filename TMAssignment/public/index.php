<?php

require_once '../views/header.php';

?>
<?php

session_start();
$user = $_SESSION;

if (!$user) : ?>

  <div class="body">
    <h2>
      Login to Task manager.
    </h2>
    <br>
    <p>Or Register if you don't have an account.</p>
  </div>
  </div>

<?php else : header('Location: home.php'); ?>

<?php endif ?>

</body>

</html>