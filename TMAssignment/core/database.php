<?php

class Database
{
  public $conn;

  // Connection to the database
  function __construct()
  {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'ass1_taskmanager';

    $this->conn = new mysqli($servername, $username, $password, $dbname);

    if ($this->conn->connect_error) {
      die('Connection Failed' . $this->conn->connect_error);
    }
  }

  // registering a new user!
  public function registerUser($username, $email, $password)
  {
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $statement = $this->prepare($sql);
    $statement->bind_param('sss', $username, $email, $password);

    $statement->execute();
  }

  // get 1 data.
  public function findOne($where, $dbval, $tbl)
  {
    $sql = "SELECT * FROM $tbl WHERE $where = ?";
    $statement = $this->prepare($sql);
    $statement->bind_param('s', $dbval);
    $statement->execute();

    $result = $statement->get_result();
    return $result->fetch_assoc();
  }

  // get all task
  public function getAllTasks($where, $dbval)
  {
    $sql = "SELECT * FROM tasks WHERE $where = ? ORDER BY createdAt DESC";
    $statement = $this->prepare($sql);
    $statement->bind_param('s', $dbval);
    $statement->execute();

    $result = $statement->get_result();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }

  // create task
  public function createTask($task, $user_id)
  {
    $sql = "INSERT INTO tasks (task, users_id) VALUES (?, ?)";
    $statement = $this->prepare($sql);
    $statement->bind_param('ss', $task, $user_id);

    $statement->execute();
  }

  // update task
  public function updateTask($task, $completed, $id)
  {
    $sql = "UPDATE tasks SET task=?, completed=?  WHERE id = ?";
    $statement = $this->prepare($sql);
    $statement->bind_param('sss', $task, $completed, $id);

    $statement->execute();
  }

  // delete task
  public function deleteTask($id)
  {
    $sql = "DELETE FROM tasks WHERE id = ?";
    $statement = $this->prepare($sql);
    $statement->bind_param('s', $id);

    $statement->execute();
  }

  public function prepare($sql)
  {
    return $this->conn->prepare($sql);
  }
}
