
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-carrot nav-icon"></i>
                        <p>
                            Категории
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-2">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список категорий</p>
                            </a>
                        </li>
                        <li class="nav-item ml-2">
                            <a href="{{ route('categories.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить категорию</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-pepper-hot nav-icon"></i>
                        <p>
                            Продукты
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-2">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список продуктов</p>
                            </a>
                        </li>
                        <li class="nav-item ml-2">
                            <a href="{{ route('products.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить товар</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>
                            Заказы
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ml-2">
                            <a href="{{ route('orders.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Список заказов</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="../tables/data.html" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>2</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Посетители
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../tables/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../tables/data.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../tables/jsgrid.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Tables
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../tables/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Tables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../tables/data.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DataTables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../tables/jsgrid.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>jsGrid</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
