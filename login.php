<?php
require('database.php');

function validateLogin($username, $password, $mysqli) {
  $user = getUserName($username, $mysqli);
  return $password == $user['pass'];
}

$username = $_POST['username'];
$password = $_POST['password'];
$create = $_POST['new_account'];

if (empty($username)) {
  exit('enterUser');
}

if (empty($password)) {
  exit('enterPass');
}

if ($create === 'create') {
  $user = getUserName($username, $mysqli);

  if ($user['name']) exit('taken');
  addUser($username, $password, $mysqli);

  $user = getUserName($username, $mysqli);
  session_start();
  $_SESSION['username'] = $username;
  $_SESSION['id'] = $user['id'];
  exit('valid');
}

if (validateLogin($username, $password, $mysqli)) {
  $user = getUserName($username, $mysqli);
  session_start();
  $_SESSION['name'] = $username;
  $_SESSION['id'] = $user['id'];
  exit('valid');
} else {
  exit('error');
}
