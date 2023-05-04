<?php
require_once 'lib/autoload.php';
require_once 'lib/dev.php';

session_start();
if (isset($_POST['new_user_id']) && $_POST['new_user_id'] > 0)
{
    $_SESSION['user_id'] = (int)$_POST['new_user_id'];
    header("Location: /");
}
else if (!isset($_SESSION['user_id']))
{
    /* Согласно ТЗ: Предположим что в сессии есть ключ user_id,
    в котором лежит iD авторизованного пользователя, который совершает импорт */
    $_SESSION['user_id'] = rand(1,100);
}

$router = new core\Router();
$router->start();