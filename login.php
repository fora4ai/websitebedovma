<?php
require_once(‘db.php’);

if (isset($_COOKIE[‘User’])) {
  header(«Location: profile.php»);
  exit;
}

$link = mysqli_connect(‘127.0.0.1’, ‘kali’, ‘kali’, ‘webapp’);
$error = ‘’;

if (isset($_POST[‘submit’])) {
  $username = $_POST[‘username’];
  $pass = $_POST[‘password’];

  if (!$username || !$pass) {
    die(‘Пожалуйста введите все значения!’);
  }

  $sql = «SELECT * FROM users WHERE username=‘$username’ AND password=‘$pass’»;
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) == 1) {
    setcookie(«User», $username, time() + 7200, «/«);
    header(«Location: profile.php»);
    exit;
  } else {
    $error = «не правильное имя или пароль»;
  }
}
?>
<!DOCTYPE html>
<html lang=«ru»>
<head>
  <meta charset=«UTF-8»>
  <meta name=«viewport» content=«width=device-width, initial-scale=1.0»>
  <title>Вход</title>
  <link rel=«stylesheet» href=«https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css»>
</head>
<body>
  <main class=«container py-4» style=«max-width: 500px;»>
    <h1>Вход</h1>
    <?php if ($error) echo «<p class=‘text-danger’>$error</p>»; ?>
    <form method=«POST» action=«/login.php»>
      <input type=«text» name=«username» placeholder=«Логин» class=«form-control mb-2»>
      <input type=«password» name=«password» placeholder=«Пароль» class=«form-control mb-2»>
      <button type=«submit» name=«submit» value=«1» class=«btn btn-primary»>Войти</button>
    </form>
  </main>
</body>
</html>