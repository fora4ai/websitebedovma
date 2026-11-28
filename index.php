<?php
require_once(‘db.php’);

if (!isset($_COOKIE[‘User’])) {
  header(«Location: login.php»);
  exit;
}

$link = mysqli_connect(‘127.0.0.1’, ‘kali’, ‘kali’, ‘webapp’);

if (isset($_POST[‘submit’])) {
  $title = $_POST[‘title’];
  $main_text = $_POST[‘text’];

  if (!$title || !$main_text) {
    die(«Заполните все поля»);
  }

  if (!empty($_FILES[‘file’][‘name’])) {
    $allowed = [‘image/jpeg’, ‘image/png’, ‘image/gif’];
    if (!in_array($_FILES[‘file’][‘type’], $allowed)) {
      die(«Можно загружать только изображения»);
    }
    if ($_FILES[‘file’][‘size’] > 2 * 1024 * 1024) {
      die(«Файл больше 2 МБ»);
    }
    $name = time() . ‘_’ . basename($_FILES[‘file’][‘name’]);
    move_uploaded_file($_FILES[‘file’][‘tmp_name’], DIR . ‘/upload/‘ . $name);
    $main_text .= «<br><img src=‘/upload/$name’ width=‘400’>»;
  }

  $sql = «INSERT INTO posts (title, main_text) VALUES (‘$title’, ‘$main_text’)»;
  if (!mysqli_query($link, $sql)) {
    die(«Не удалось добавить пост»);
  }
  header(«Location: profile.php»);
  exit;
}
?>
<!DOCTYPE html>
<html lang=«ru»>
<head>
  <meta charset=«UTF-8»>
  <meta name=«viewport» content=«width=device-width, initial-scale=1.0»>
  <title>Профиль</title>
  <link rel=«stylesheet» href=«https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css»>
</head>
<body>
  <nav class=«navbar navbar-dark bg-dark»>
    <div class=«container»>
      <a class=«navbar-brand» href=«/index.php»>Главная</a>
    </div>
  </nav>
  <main class=«container py-4» style=«max-width: 600px;»>
    <h1>Добро пожаловать, <?= htmlspecialchars($_COOKIE[‘User’]) ?>!</h1>

    <h2 class=«mt-4»>Новый пост</h2>
    <form method=«POST» action=«/profile.php» enctype=«multipart/form-data» name=«upload»>
      <input type=«text» name=«title» placeholder=«Заголовок» class=«form-control mb-2»>
      <textarea name=«text» placeholder=«Текст» class=«form-control mb-2» rows=«5»></textarea>
      <input type=«file» name=«file» class=«form-control mb-2»><br>
      <button type=«submit» name=«submit» value=«1» class=«btn btn-success»>Сохранить</button>
    </form>
  </main>
</body>
</html>