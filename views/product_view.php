<?php require_once 'views/header_view.php'; ?>
<div class="wrapper">
    <div class="content">
        <h2>Таблица Product</h2>
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