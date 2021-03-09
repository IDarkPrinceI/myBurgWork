<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @if (Request::is('far'))
            Главная
        @else
            {{ session('levelTwo') ?? session('levelOne') }}
        @endif
        :: Admin
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    {{--    YandexMap--}}
    <script src="https://api-maps.yandex.ru/2.1/?apikey=8a3ecadb-e4ca-48eb-9d4e-cbc2af213efb&amp;lang=ru-RU"></script>
    {{--    YandexMap--}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
{{--    Стили AdminLte--}}
    <link rel="stylesheet" href="{{ asset('assets/far/css/far.css') }}">
</head>
<body class="sidebar-mini layout-fixed" style="margin-bottom: 29px; height: auto;">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    </nav>
    {{--  SideBar --}}
    @include('far.layouts.sidebar')

    <div class="content-wrapper">
        {{--    BreadCrumbs--}}
        @include('far.layouts.breadcrumbs')
        {{--    Alert--}}
        @include('far.layouts.alert')
        {{--   Content--}}
        @yield('content')
    </div>

    <footer class="main-footer">
    {{--        Footer--}}
    </footer>
</div>
{{--Скрипты AdminLTE--}}
<script src="{{ asset('assets/far/js/far.js') }}"></script>
{{--Скрипты админки--}}
<script src="{{ asset('assets/far/js/main.js') }}"></script>
{{--Скрипт построения графика уникальных пользователей--}}
<script src="{{ asset('assets/far/js/myChart.js') }}"></script>

</body>
</html>
