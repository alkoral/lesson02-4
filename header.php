<?php
if (!isset($add_login) || $add_login=="") {
$add_login = "\"admin.php\">Добавить тест";
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<article>
  <nav>
    <ul>
      <li><a href=<?php echo $add_login; ?></a></li>
      <li><a href="list.php">Список тестов</a></li>
      <li><a href="logout.php">Выйти</a></li>
    </ul>
  </nav>