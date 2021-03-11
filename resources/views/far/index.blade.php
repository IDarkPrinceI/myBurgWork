@extends('far.layouts.layout')

@section('content')
    {{--Главная страница админки--}}

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Статистика магазина</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    {{--Категории--}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $categories }}</h3>
                                <p>Категории</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-carrot nav-icon"></i>
                            </div>
                            <a href="{{ route('categories.index') }}" class="small-box-footer">Список категорий
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    {{--/Категории--}}
                    {{--Продукты--}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $products }}</h3>
                                <p>Товары</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-pepper-hot nav-icon"></i>
                            </div>
                            <a href="{{ route('products.index') }}" class="small-box-footer">Список товаров
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    {{--/Продукты--}}
                    {{--Заказы--}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $orders }}</h3>
                                <p>В работе: {{ $ordersInWork }} </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-leaf nav-icon"></i>
                            </div>
                            <a href="{{ route('orders.index') }}" class="small-box-footer">Список заказов
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    {{--/Заказы--}}
                    {{--Пользователи--}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $users }}</h3>
                                <p>Пользователи </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <a href="{{ route('statistic.users') }}" class="small-box-footer">Список пользователей
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    {{--/Пользователи--}}
                </div>
            </div>
            <div class="card-footer">
                Footer
            </div>
        </div>
    </section>

@endsection

