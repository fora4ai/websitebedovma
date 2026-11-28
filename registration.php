<?php
require_once(‘db.php’);

if (isset($_COOKIE[‘User’])) {
  header(«Location: profile.php»);
  exit;
}

$link = mysqli_connect(‘127.0.0.1’, ‘kali’, ‘kali’, ‘webapp’);

if (isset($_POST[‘submit’])) {
  $email = $_POST[‘email’];
  $username = $_POST[‘username’];
  $password = $_POST[‘password’];

  if (!$email  !$username  !$password) {
    die(‘Пожалуйста введите все значения!’);
  }

  $sql = «INSERT INTO users (email, username, password) VALUES (‘$email’, ‘$username’, ‘$password’)»;
  if (!mysqli_query($link, $sql)) {
    echo «Не удалось добавить пользователя»;
  } else {
    header(«Location: login.php»);
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang=«ru»>
<head>
  <meta charset=«UTF-8»>
  <meta name=«viewport» content=«width=device-width, initial-scale=1.0»>
  <title>Регистрация</title>
  <link rel=«stylesheet» href=«https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css»>
</head>
<body>
  <main class=«container py-4» style=«max-width: 500px;»>
    <h1>Регистрация</h1>
    <form method=«POST» action=«/registration.php»>
      <input type=«email» name=«email» placeholder=«Почта» class=«form-control mb-2»>
      <input type=«text» name=«username» placeholder=«Логин» class=«form-control mb-2»>
      <input type=«password» name=«password» placeholder=«Пароль» class=«form-control mb-2»>
      <button type=«submit» name=«submit» value=«1» class=«btn btn-primary»>Зарегистрироваться</button>
    </form>
  </main>
</body>
</html>