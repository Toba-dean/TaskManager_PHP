<?php


$email = $_POST['email'];
$password = $_POST['password'];

if (!$email || !$password) {
  $errors[] = 'All fields must be filled';
}

if ($email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email.";
  }
}
