<?php

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!$username || !$email || !$password || !$confirm_password) {
  $errors[] = 'All fields must be filled';
}

if ($email) {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email.";
  }
}

if ($password) {
  if (strlen($password) !== 6) {
    $errors[] = "Password must be at least 6 characters long.";
  }else if ($password !== $confirm_password) {
    $errors[] = "Password don't match, try again.";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }
}

