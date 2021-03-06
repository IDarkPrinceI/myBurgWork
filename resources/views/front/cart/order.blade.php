@extends('front.layouts.layout')

@section('content')
    {{--Страница оформления заказа--}}

    {{--Слой для пересчета карты--}}
    <div id="overlay"
         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, .5); z-index: 2; display: none;">
        <div
            style="position: absolute; top: 50%; left: 50%; font-size: 30px; margin-left: -15px; margin-top: -15px; color: #000;">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
    {{--/Слой для пересчета карты--}}
    <div class="best_burgers_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Оформление заказа</span>
                    </div>
                </div>
            </div>
            <div id="orderForm" class="row"
                 style="background-color: rgba(230,230,230, .4); border-radius: 5%; padding-top: 30px; color: whitesmoke">
                <div class="col-xl-12 col-md-6 col-lg-6" style="opacity: 100%">
                    {{--Таблица корзины--}}
                    <div id="upOrderForm">
                        @if(session('cart'))
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Фото</th>
                                        <th>Наименование</th>
                                        <th>Кол-во</th>
                                        <th>Цена за единицу, руб.</th>
                                        <th>Общая цена, руб.</th>
                                        <th><span class="glyphicon glyphicon-remove" id="not_visible"
                                                  aria-hidden="false"></span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( session()->get('cart') as $slug => $item)
                                        <tr id="cartTable">
                                            <td><img src="{{ asset('/' . $item['img']) }}" height="50px" alt=""></td>
                                            <td id="my_text_name">{{ $item['title'] }}</td>
                                            {{--Плюс/минус--}}
                                            <td>
                                                <button class="genric-btn primary-border circle singleMinus"
                                                        style="display: inline; background-color: #F2C64D"
                                                        onmouseover="this.style.backgroundColor='#d95a1f';"
                                                        onmouseout="this.style.backgroundColor='#F2C64D';"
                                                >-
                                                </button>
                                                <h5 class="singleResult" data-slug="{{ $slug }}"
                                                    style="display: inline; font-weight: bold">{{ $item['qty'] }}</h5>
                                                <button class="genric-btn primary-border circle singlePlus"
                                                        style="display: inline; background-color: #F2C64D"
                                                        onmouseover="this.style.backgroundColor='#d95a1f';"
                                                        onmouseout="this.style.backgroundColor='#F2C64D';"
                                                >+
                                                </button>
                                            </td>
                                            {{--/Плюс/минус--}}
                                            <td>{{ $item['price'] }}</td>
                                            <td>{{$item['price'] * $item['qty']}}</td>
                                            {{--Удаление позиции из списка--}}
                                            <td><span data-slug="{{ $slug }}"
                                                      class="glyphicon glyphicon-remove text-danger del-item"
                                                      aria-hidden="true"
                                                      style="cursor: pointer; font-weight: bold;">X</span>
                                            </td>
                                            {{--/Удаление позиции из списка--}}
                                        </tr>
                                    @endforeach
                                    {{--Итого/на сумму--}}
                                    <tr>
                                        <td colspan="5">Итого, шт:</td>
                                        <td id="cart-qty">{{ session('cartQtySum') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">На сумму, руб:</td>
                                        <td id="cart-sum">{{ session('cartTotalPrice') }}</td>
                                    </tr>
                                    {{--/Итого/на сумму--}}
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    {{--/Таблица корзины--}}
                    {{--Данные заказа--}}
                    <div id="orderAttributes" class="col-lg-12"
                         style="display: flex; justify-content: space-around; flex-direction: row">
                        <form class="form-contact contact_form" action="{{ route('cart.confirmOrder') }}"
                              method="post" id="orderForm">
                            @csrf
                            {{--Email--}}
                            <div class="col-md-12">
                                <label for="email" style="color: black">Введите Email *</label>
                                <input class="form-control"
                                       name="email"
                                       id="email"
                                       type="text"
                                       value="{{ $user['email'] }}"
                                       style="font-size: medium; color: #f4f5f6; @error('email') border-color: #ee0d0d!important; @enderror">
                            </div>
                            {{--/Email--}}
                            {{--Имя--}}
                            <div class="col-md-12">
                                <label for="name" style="color: black">Введите имя *</label>
                                <input class="form-control"
                                       name="name"
                                       id="name"
                                       type="text"
                                       value="{{ $user['name'] }}"
                                       style="font-size: medium; color: #f4f5f6; @error('name') border-color: #ee0d0d!important; @enderror">
                            </div>
                            {{--/Имя--}}
                            {{--Телефон--}}
                            <div class="col-md-12">
                                <label for="phone" style="color: black">Введите телефон *</label>
                                <input class="form-control"
                                       name="phone"
                                       id="phone"
                                       type="text"
                                       value="{{ $user['phone'] }}"
                                       style="font-size: medium; color: #f4f5f6; @error('phone') border-color: #ee0d0d!important; @enderror">
                            </div>
                            {{--/Телефон--}}
                            {{--Адрес--}}
                            <div class="col-md-12">
                                <label for="address" style="color: black">Выберите адрес на карте *</label>
                                <textarea class="form-control valid @error('address') is-invalid @enderror"
                                          name="address"
                                          id="address"
                                          rows="4"
                                          type="text"
                                          readonly
                                          style="font-size: medium; color: #f4f5f6; @error('address') border-color: #ee0d0d!important; @enderror">{{ $user['address'] }}
                                    </textarea>
                            </div>
                            {{--/Адрес--}}

                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Оформить
                                    заказ
                                </button>
                            </div>
                        </form>
                        {{--Yandex карта--}}
                        <div style="width: 50%; height: 400px; padding: 0.5em" id="map"></div>
                        {{--/Yandex карта--}}
                    </div>
                    {{--/Данные заказа--}}
                </div>
                @else
                    <div class="col-sm-12" style="text-align: center">
                        <h3>Ваша корзина пуста</h3>
                    </div>
                    {{--Меню--}}
                    <div class="col-lg-12">
                        <div class="iteam_links">
                            <a class="boxed-btn5" href="{{ route('menu') }}"
                               style="font-size: 1.5em; color: whitesmoke !important; opacity: 0.7; background-color: #333"
                               onmouseover="this.style.backgroundColor='#d95a1f';"
                               onmouseout="this.style.backgroundColor='#333';"
                            >Посмотреть все меню</a>
                        </div>
                    </div>
                    {{--/Меню--}}
                @endif
            </div>
        </div>
    </div>

@endsection
