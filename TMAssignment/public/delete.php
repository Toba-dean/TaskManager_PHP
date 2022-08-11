<?php

require_once '../core/database.php';


$db = new Database;

$id = $_POST['id'];

$db->deleteTask($id);

header('Location: home.php');
