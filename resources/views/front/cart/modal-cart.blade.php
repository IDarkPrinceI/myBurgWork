<?php if(!empty($session['cart'])): ?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Фото</th>
            <th>Наименование</th>
            <th>Кол-во</th>
            <th>Цена за единицу, руб.</th>
            <th>Общая цена, руб.</th>
            <th><span class="glyphicon glyphicon-remove" id="not_visible" aria-hidden="false"></span></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($session['cart'] as $id => $item):?>
        <tr>
{{--            <td><?= \yii\helpers\Html::img("@web/uploads/product/{$item['img']}", ['alt' => $item['name'], 'height' => 50]) ?></td>--}}
            <td id="my_text_name"><?= $item['name']?></td>
            <td id="my_text_qty"><?= $item['qty']?></td>
            <td><?= $item['price']?></td>
            <td><?= $item['price'] * $item['qty'] ?></td>
            <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
        </tr>
        <?php endforeach?>
        <tr>
            <td colspan="5">Итого, шт: </td>
            <td id="cart-qty"><?= $session['cart.qty']?></td>
        </tr>
        <tr>
            <td colspan="5">На сумму, руб: </td>
            <td id="cart-sum"><?= $session['cart.sum']?></td>
        </tr>
        </tbody>
    </table>
</div>
<?php else: ?>
<h3>Корзина пуста</h3>
<?php endif;?>
