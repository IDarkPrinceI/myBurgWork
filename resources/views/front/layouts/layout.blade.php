<!doctype html>
<html class="no-js" lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>myBurg</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/front/img/favicon.png') }}">

    {{--    YandexMap--}}
    <script src="https://api-maps.yandex.ru/2.1/?apikey=8a3ecadb-e4ca-48eb-9d4e-cbc2af213efb&amp;lang=ru-RU"></script>
{{--    YandexMap--}}
<!-- CSS here -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/front/css/front.css') }}">
</head>

<body>
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area" style="padding: 0">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters" style="background-color: #0b0b0b; height: 150px">
                    <div class="col-xl-5 col-lg-5">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation" style="padding: 50px">
                                    <li><a class="active" href="{{ route('index') }}">Главная</a></li>
                                    <li><a href="{{ route('menu') }}">Меню</a></li>
                                    <li><a href="about.html">About</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('assets/front/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 d-none d-lg-block">
                        <div class="book_room" style="padding: 50px">
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        {{--cartCheck--}}
                                        <a id="cartCheck" style="cursor: pointer">
                                            <i class="fa fa-cart-arrow-down" aria-hidden="true">
                                                <span class="cart-qty" id="cart-qty">{{ session('cartQtySum') ?? '0'}} </span><span> шт. на сумму:</span>
                                                <span class="cart-sum" id="cart-sum">{{ session('cartTotalPrice') ?? '0' }} </span><span> руб.</span>
                                            </i>
                                        </a>
                                    </li>
                                    {{--userMenu--}}
                                    @widget('login_link_widget', ['userRole' => session('role') ?? 'guest'])
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
{{--Флешсообщения--}}
@include('front.layouts.alert')
{{--Content--}}
@yield('content')
<!-- modalCart -->
<div class="modal" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 750px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Моя корзина</h4>

                <button type="button" class="close cartClose" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- Содержимое корзины--}}
                @include('front.cart.modal-cart')
            </div>
        </div>
    </div>
</div>
<!-- modalCart -->
<footer class="footer">
    {{--    footer--}}
</footer>


<!-- JS here -->
<script src={{ asset('assets/front/js/front.js') }}></script>
<script src={{ asset('assets/front/js/mainFront.js') }}></script>

</body>
</html>
