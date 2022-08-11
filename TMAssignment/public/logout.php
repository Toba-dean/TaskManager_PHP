<?php

session_start();
$user = $_SESSION['user'];

// on logout unset the session and destroy it!!
unset($_SESSION['user']);
session_destroy();

// redirect to the index page.
header('Location: index.php');
