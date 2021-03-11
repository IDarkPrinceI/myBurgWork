{{--Сайдбар--}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        {{--Главная страница админки--}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{ route('far.index') }}">
                    <img src="{{ asset('assets/far/img/iconMainGrey.png') }}"
                         class="brand-image img-circle elevation-3"
                         alt="Admin">
                    <span class="brand-text font-weight-light">Главная</span>
                </a>
            </div>
        </div>
        {{--/Главная страница админки--}}

        {{--Главная страница пользовательская--}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/far/img/iconSiteGrey.png') }}"
                         class="brand-image img-circle elevation-3"
                         alt="Site">
                    <span class="brand-text font-weight-light">На сайт</span>
                </a>
            </div>
        </div>
        {{--/Главная страница пользовательская--}}
        {{--Сайтбар--}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{--Категории--}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-carrot nav-icon"></i>
                        <p>Категории
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--Список категорий--}}
                        <li class="nav-item ml-2">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список категорий</p>
                            </a>
                        </li>
                        {{--/Список категорий--}}
                        {{--Добавить категорию--}}
                        <li class="nav-item ml-2">
                            <a href="{{ route('categories.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить категорию</p>
                            </a>
                        </li>
                        {{--/Добавить категорию--}}
                    </ul>
                </li>
                {{--/Категории--}}
                {{--Продукты--}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-pepper-hot nav-icon"></i>
                        <p>Продукты
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--Список продуктов--}}
                        <li class="nav-item ml-2">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список продуктов</p>
                            </a>
                        </li>
                        {{--/Список продуктов--}}
                        {{--Добавить товар--}}
                        <li class="nav-item ml-2">
                            <a href="{{ route('products.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить товар</p>
                            </a>
                        </li>
                        {{--/Добавить товар--}}
                    </ul>
                </li>
                {{--/Продукты--}}
                {{--Заказы--}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>Заказы
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--Список заказов--}}
                        <li class="nav-item ml-2">
                            <a href="{{ route('orders.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список заказов</p>
                            </a>
                        </li>
                        {{--/Список заказов--}}
                    </ul>
                </li>
                {{--/Заказы--}}
                {{--Статистика--}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-seedling"></i>
                        <p>Статистика
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--Пользователи--}}
                        <li class="nav-item">
                            <a href="{{ route('statistic.users') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Пользователи</p>
                            </a>
                        </li>
                        {{--/Пользователи--}}
                        {{--График--}}
                        <li class="nav-item">
                            <a href="{{ route('statistic.user.datePick') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Таблица</p>
                            </a>
                        </li>
                        {{--/График--}}
                    </ul>
                </li>
                {{--/Статистика--}}
            </ul>
        </nav>
        {{--/Сайтбар--}}
    </div>
</aside>
