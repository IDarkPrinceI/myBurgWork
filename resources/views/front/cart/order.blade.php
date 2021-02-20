@extends('front.layouts.layout')

@section('content')
    <div id="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, .5); z-index: 2; display: none;">
        <div style="position: absolute; top: 50%; left: 50%; font-size: 30px; margin-left: -15px; margin-top: -15px; color: #000;">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
    <div class="best_burgers_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Оформление заказа</span>
                    </div>
                </div>
            </div>
            <div id="upOrderForm">
                <div id="orderForm" class="row"
                     style="background-color: rgba(230,230,230, .7); border-radius: 5%; padding-top: 30px;">
                        <div class="col-xl-12 col-md-6 col-lg-6" style="opacity: 100%">
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
                                            <td>{{ $item['price'] }}</td>
                                            <td>{{$item['price'] * $item['qty']}}</td>
                                            <td><span data-slug="{{ $slug }}"
                                                      class="glyphicon glyphicon-remove text-danger del-item"
                                                      aria-hidden="true"
                                                      style="cursor: pointer; font-weight: bold;">X</span></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">Итого, шт:</td>
                                        <td id="cart-qty">{{ session('cartQtySum') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">На сумму, руб:</td>
                                        <td id="cart-sum">{{ session('cartTotalPrice') }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="iteam_links">
                        <a class="boxed-btn5" href="{{ route('menu') }}"
                           style="font-size: 1.5em; color: whitesmoke !important; opacity: 0.7; background-color: #333"
                           onmouseover="this.style.backgroundColor='#d95a1f';"
                           onmouseout="this.style.backgroundColor='#333';"
                        >Посмотреть все меню</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection