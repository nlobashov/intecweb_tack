<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тестовое задание</title>
    <link rel="stylesheet" type="text/css" href="/resources/style/style1.css">
</head>

<body>
    <header>
        <p>Тестовое задание на позицию <b>Backend разработчика</b></p>
        <nav>
            <a href="/import">Импорт</a>
            <a href="/export">Экспорт</a>
        </nav>
        <?php if (isset($_SESSION['user_id'])): ?>
        <div class="div__user-info">
            <p>Текущий ID пользователя: <?= $_SESSION['user_id']; ?></p>
            <form action="" method="POST">
                <input type="text" name="new_user_id" autocomplete="off">
                <input type="submit" value="Сменить">
            </form>
        </div>
        <?php endif;?>
    </header>