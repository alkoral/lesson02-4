<?php
require_once 'functions.php';

if(!isAuthorized()) {
$add_login = "\"index.php\">Авторизоваться";
}

if (!isset($_SESSION['guest']) and !isAuthorized()) {
  echo "<center><h2>Для прохождения теста необходимо авторизоваться</h2></center>";
  header('Refresh: 5; index.php');
  die;
}

$footer = file_get_contents(__DIR__ . '/footer.php');
$title = "Все тесты для задания";
include(__DIR__ . '/header.php');

$i=0;
$directory = "tests/";
$new_directory = "trash/";

if (!empty($_POST['file'])) {
  rename($directory.$_POST['file'], $new_directory.$_POST['file']);
}

if (!empty($_POST['restore'])) { // функция на возврат "удаленных" файлов срабатывает, но почему-то с выдачей предупреждений
$to = "tests/"; 
$from = "trash/"; 

if (is_dir($from)) { 
   if ($dh = opendir($from)) { 
       while (($file = readdir($dh)) !== false) { 
          if ($file != "." && $file != "..");
         {
        rename($from.$file, $to.$file);
          } 
        }
       closedir($dh);
   } 
  }
}

?>

<article>
<section>
  <h1>Все тесты</h1>
  <form method="POST">
<?php

  foreach (glob($directory."test-*.json") as $jsonname) {
    $get_test = file_get_contents($jsonname);
    $i = ++$i;
    if ($i<10) {
      $i="0$i";
    }
    $tests_arr = json_decode($get_test, true);
// проверяем, чтобы в список тестов не попали никакие другие файлы, кроме тех, что были подготовлены по единому шаблону тестов
    if (array_key_exists('quest', $tests_arr) & (!empty($_SESSION['user']))) {
      $jsonname = $tests_arr['quest'];
          echo "<input type='radio' name='file' value='test-$i.json'> <a href='test.php?num=".$i."'>".$jsonname."</a><br>\n";
          
      }
    else {
      $jsonname = $tests_arr['quest'];
     echo "&bull; <a href='test.php?num=".$i."'>".$jsonname."</a><br>\n"; 
    }
  }

  if (!empty($_SESSION['user'])) {
    echo "<br><center><input type='submit' value='Удалить выбранный тест'></center>\n";

    }
if (isAdmin()) {
    echo "<br><center><input type='submit' name='restore' value='Восстановить тесты'></center>\n";  
}

?>
  </form>
</section>
<?php echo $footer; ?>

<!-- 
<form method="post">
  <ol>
        <li>
      <a href="test.php?name=test2.json "> test2.json</a>
                <input type="checkbox" name="test2.json" value="test2.json" style="margin-left: 80px">
          </li>
      </ol>

    <input type="submit" value="Submit" />
 http://university.netology.ru/u/amakarov/my/homework-8/list.php 
</form>
 -->