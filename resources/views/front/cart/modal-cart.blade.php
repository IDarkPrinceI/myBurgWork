{{--Содержимое модальной корзины--}}
@if( session()->get('cart') )
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            {{--Шапка--}}
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
            {{--/Шапка--}}
            <tbody>
            {{--Вывод товаров корзины--}}
            @foreach( session()->get('cart') as $slug => $item)
                <tr id="cartTable">
                    <td><img src="{{ asset('/' . $item['img']) }}" height="50px" alt=""></td>
                    <td id="my_text_name">{{ $item['title'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{$item['price'] * $item['qty']}}</td>
                    <td><span data-slug="{{ $slug }}" class="glyphicon glyphicon-remove text-danger del-item"
                              aria-hidden="true" style="cursor: pointer; font-weight: bold;">X</span>
                    </td>
                </tr>
            @endforeach
            {{--/Вывод товаров корзины--}}
            {{--Итого/на сумму--}}
            <tr>
                <td colspan="5">Итого, шт:</td>
                <td id="cart-qty">{{ session('cartQtySum') }}</td>
            </tr>
            <tr>
                <td colspan="5">На сумму, руб:</td>
                <td id="cart-sum">{{ session('cartTotalPrice') }}</td>
            </tr>
            {{--Итого/на сумму--}}
            </tbody>
        </table>
    </div>
@else
    <h3>Корзина пуста</h3>
@endif
{{--Управление корзиной--}}
<div class="modal-footer">
    @if (session('cart'))
        <button onclick="cartClean()" type="button" class="btn btn-danger pull-left" id="cartClean">Очистить корзину
        </button>
    @endif
    <button type="button" class="btn btn-default cartClose" data-dismiss="modal">Продолжить покупки</button>
    @if (session('cart'))
        <a href="{{ route('cart.getOrder') }}" class="btn btn-success">Оформить заказ</a>
    @endif
</div>
{{--/Управление корзиной--}}

