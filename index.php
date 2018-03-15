<?php
$footer = file_get_contents(__DIR__ . '/footer.php');
$title = "Страница авторизации";

require_once 'functions.php';

if (!empty($_POST)) {
	foreach (getUsers() as $user) {
		if ($_POST['login'] == $user['login'] && $_POST['password'] == $user['password']) {
			$_SESSION['user'] = $user;
			redirect('list');
			}
			elseif ($_POST['login'] == $user['login'] && $_POST['password'] !== $user['password']){
				echo "<center><font color=red>Неверный пароль</font><br><br><center>";
			}
			elseif ($_POST['login'] !== $user['login'] && $_POST['password'] == $user['password']){
				echo "<center><font color=red>Проверьте правильность написания логина</font><br><br></center>";
			}
		}
	}
	if (!empty($_POST['login']) and empty($_POST['password'])) {
		$_SESSION['guest'] = $_POST['login'];
		redirect('list');
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
<section>
	<h1>Авторизоваться</h1>
<center>
		(если вы не авторизованы, вместо логина введите свое имя)<br><br>
</center>
<form method="post" action="">
	<input type='text' name='login' placeholder='Логин' size='19' maxlength='30'> Имя &nbsp; 
	<input type='password' name='password' placeholder='Пароль' size='19' maxlength='30'> Пароль &nbsp; 
	<input type="submit" name="submit" value="Войти">
</form>
</section>

<?php echo $footer; ?>