<?php
session_start();
// Для вывода ошибок и предупреждений
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
  Получение списка пользователей
 */
function getUsers()
{
    $fileData = file_get_contents(__DIR__ . '/login.json');
    $users = json_decode($fileData, true);
    if (!$users) {
        return [];
    }
    return $users;
}

/*
  Перенаправление на другую страницу
 */
function redirect($page) {
    header("Location: $page.php");
    die;
}

/*
  Идентификация пользователей
*/
function isAuthorized()
{
  return !empty($_SESSION['user']);
}

/*
  Проверка пользователя на права суперадмина
*/
function isAdmin()
{
    return isAuthorized() && $_SESSION['user']['is_admin'] == 1;
}
?>