<?php
session_start();

$footer = file_get_contents(__DIR__ . '/footer.php');
$title = "Все тесты для задания";
$add_login = "\"index.php\">Авторизоваться";
include(__DIR__ . '/header.php');

    $errors = [];
    if (!empty($_POST)) {
        $_SESSION['guest'] = $_POST['login'];
        $fileData = file_get_contents(__DIR__ . '/users.json');
        $users = json_decode($fileData, true);
        foreach ($users as $user) {
            if ($_POST['login'] == $user['login'] && $_POST['password'] == $user['password']) {
                $_SESSION['user'] = $user;
            }
                header('Location: list.php');
        }
        $errors[] = 'Неверный логин или пароль';
    }
?>

<article>
<section>
  <h1>Авторизоваться</h1>
<center>
    (если вы не авторизованы, вместо логина введите свое имя)<br><br>
</center>
<form method="post" action="">
	<input type='text' name='login' placeholder='Логин'> Имя &nbsp; 
	<input type='password' name='password' placeholder='Пароль'> Имя &nbsp; 
	<input type="submit" name="submit" value="Войти">
</form>

</section>
<?php echo $footer; ?>