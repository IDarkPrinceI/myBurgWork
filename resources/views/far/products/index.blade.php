@extends('far.layouts.layout')

@section('content')

    <section id="index" class="content">

        <div class="sessionFlash">
            @if (session()->has('success-dell'))

                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Успешно</h5>
                    {{ session('success-dell') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('products.create') }}" class="btn btn-block bg-gray">
                    <i class="far fa-file"></i> Добавить товар</a>
            </div>
            <div class="col-md-6">
                <!-- SEARCH FORM -->
                <form method="get" action="{{ route('product.search') }}" class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" name="q" type="search" placeholder="Поиск"
                               aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="includeIndex">
            @if(gettype($products) == 'string')
                <div class="card mt-5">
                    <div class="container">
                        <div><h4>{{$products}}</h4></div>
                    </div>
                </div>
            @elseif ( count($products) !== 0)
                {{--            @elseif ( is_countable($products) !== 0)--}}
                <div class="card mt-2">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table id="tableIndex" class="table">
                            <thead>
                            <tr id="head">
                                <th style="width: 10px">
                                    <a href="{{ route('products.index') }}" class="text-dark">#
                                    </a>
                                </th>
                                <th>
                                    @widget('make_route', ['routeName' => 'Название',
                                    'typeSort' => 'title'])
                                </th>
                                <th>
                                    @widget('make_route', ['routeName' => 'Категория',
                                    'typeSort' => 'category_title'])
                                </th>
                                <th>
                                    @widget('make_route', ['routeName' => 'Цена',
                                    'typeSort' => 'price'])
                                </th>
                                <th>
                                    @widget('make_route', ['routeName' => 'Старая цена',
                                    'typeSort' => 'old_price'])
                                </th>
                                <th>
                                    @widget('make_route', ['routeName' => 'Новинка',
                                    'typeSort' => 'is_new'])
                                </th>
                                <th>
                                    @widget('make_route', ['routeName' => 'Хит',
                                    'typeSort' => 'is_hit'])
                                </th>
                                <th>
                                    @widget('make_route', ['routeName' => 'Просмотры',
                                    'typeSort' => 'view'])
                                </th>
                                <th>Картинка</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = request('page') ? (5 * (request('page') - 1)) + 1 : 1 @endphp
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a class="text-dark"
                                           href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
                                    </td>
                                    <td>{{ $product->category_title }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->old_price ?? '-' }}</td>
                                    <td class="text-green">{{ $product->is_new ? 'Новинка' : '-'}}</td>
                                    <td class="text-orange">{{ $product->is_hit ? 'Хит' : '-' }}</td>
                                    <td>{{ $product->view }}</td>
                                    <td><img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt=""
                                             height="100px"></td>
                                    <td>
                                        <div class="btn-group">
                                            <a id="test"
                                               href="{{ route('products.edit', ['product' => $product->id]) }}"
                                               class="btn btn-warning mr-1 rounded-right"><i class="fas fa-pen"></i>
                                            </a>
                                            <button id="modalDell" class="btn btn-danger rounded-left" type="button"
                                                    @if($product->img !== 'no-image.png')
                                                    data-img="1"
                                                    @else
                                                    data-img="0"
                                                    @endif
                                                    data-id="{{$product->id}}"
                                                    data-toggle="modal"
                                                    data-target="#modal-danger">
                                                <i data-id="{{$product->id}}"
                                                   @if($product->img !== 'no-image.png')
                                                   data-img="1"
                                                   @else
                                                   data-img="0"
                                                   @endif
                                                   class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- /.card-body -->
                </div>

                @widget('links_product', ['products' => $products])

            @else
                <div class="card mt-5">
                    <div class="container">
                        <div><h4>Список продуктов пуст</h4></div>
                    </div>
                </div>
            @endif
        </div>

    </section>

    <div class="modal" id="modal-danger" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Подтверждение удаления</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить данный товар?
                        <br>
                        Эта операция необратима</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <form role="form" id="dellForm">
                        <button id="onDellProduct" type="submit" class="btn btn-outline-light">Подтвердить удаление
                        </button>
                        <div id="indexOnDell" class="mt-4 d-none custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="onDellImg">
                            <label id="labelOnDellImg" class="custom-control-label" for="onDellImg">Переместить
                                изображение</label>
                        </div>
                    </form>
                    <button type="button" class="btn btn-outline-light bg-gradient-success" data-dismiss="modal">
                        Отмена
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.content -->
@endsection
