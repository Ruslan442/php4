<?php



$db = mysqli_connect('localhost','root','','php4');

$email = $_POST['email'];
$password = $_POST['password'];

// Валидация данных
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die('Invalid email address');
}

if (strlen($password) < 8 ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[!\\?]/', $password) ||
    !preg_match('/[A-Z]/', $password)) {
  die('Invalid password');
}

// Поиск пользователя в базе данных

$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
$res = mysqli_query($db,$sql);
$user = mysqli_fetch_assoc($res);

echo $user['name'];
// Проверка пароля
if ($user && $password == $user['password']) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header('Location: index.php');
    exit();
  }
  elseif ($user) {
    die('Invalid password');
  } 
  else {
    die('Invalid email');
  }