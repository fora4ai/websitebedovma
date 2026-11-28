<?php
require_once(‘db.php’);

$link = mysqli_connect(‘127.0.0.1’, ‘kali’, ‘kali’, ‘webapp’);
$id = $_GET[‘id’];
$sql = «SELECT * FROM posts WHERE id=$id»;
$res = mysqli_query($link, $sql);
$rows = mysqli_fetch_array($res);
$title = $rows[‘title’];
$main_text = $rows[‘main_text’];
?>
<!DOCTYPE html>
<html lang=«ru»>
<head>
  <meta charset=«UTF-8»>
  <meta name=«viewport» content=«width=device-width, initial-scale=1.0»>
  <title>Пост</title>
  <link rel=«stylesheet» href=«https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css»>
</head>
<body>
  <main class=«container py-4»>
<?php
echo «<h1>$title</h1>»;
echo «<p>$main_text</p>»;
?>
    <a href=«/index.php»>На главную</a>
  </main>
</body>
</html>