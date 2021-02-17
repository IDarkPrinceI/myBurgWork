
@if( session()->get('cart') )
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
@foreach( session()->get('cart') as $item)

        <tr>
            @php $test = 'assets/far/img/product/' . $item['img']@endphp
            <td><img src="{{ asset($test) }}" height="50px" alt=""></td>

            <td id="my_text_name">{{ $item['title'] }}</td>
            <td>{{ $item['qty'] }}</td>
            <td>{{ $item['price'] }}</td>
            <td>{{$item['price'] * $item['qty']}}</td>
{{--            <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>--}}
        </tr>
@endforeach
        <tr>
            <td colspan="5">Итого, шт: </td>
{{--            <td id="cart-qty"><?= $session['cart.qty']?></td>--}}
            <td id="cart-qty">{{ session('cart.qtySum') }}</td>
        </tr>
        <tr>
            <td colspan="5">На сумму, руб: </td>
{{--            <td id="cart-sum"><?= $session['cart.sum']?></td>--}}
            <td id="cart-sum">{{ session('cart.totalPrice') }}</td>
        </tr>
        </tbody>
    </table>
</div>
@else
<h3>Корзина пуста</h3>
@endif
