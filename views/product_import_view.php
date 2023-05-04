<?php require_once 'views/header_view.php'; ?>
<div class="wrapper">
    <div class="content">
        <form class="form__import" enctype="multipart/form-data" method="POST">
            <p>
                <input type="file" name="userfile">
                <input type="submit" value="Импортировать">
            </p>
        </form>
        <?php if (isset($errors['invalid_csv'])): ?>
            <?php foreach($errors['invalid_csv'] as $error): ?>
                <p class="text_error"><?=$error?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <h2>Таблица Product</h2>
        <?php if (isset($countRowUpdated) && isset($countRowInserts)):?>
            <p class="block-status"><span class="text_count_inserts">Добавлено <?= $countRowInserts; ?></span> / <span class="text_count_updated">Обновлено <?= $countRowUpdated?></span></p>
        <?php endif;?>
        <table class="table__products">
            <thead>
            <tr>
                <th>id (PK)</th>
                <th>name</th>
                <th>name_trans</th>
                <th>price</th>
                <th colspan>small_text</th>
                <th colspan>big_text</th>
                <th colspan>user_id (PK)</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product):?>
                <tr>
                    <td class="column-id"><?= $product['id'];?></td>
                    <td><?= $product['name'];?></td>
                    <td><?= $product['name_trans'];?></td>
                    <td><?= $product['price'];?></td>
                    <td><?= $product['small_text'];?></td>
                    <td><?= $product['big_text'];?></td>
                    <td class="column-id"><?= $product['user_id'];?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>