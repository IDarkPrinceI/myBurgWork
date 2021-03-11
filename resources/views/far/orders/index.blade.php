@extends('far.layouts.layout')

@section('content')
    {{--Страница просмотра заказов--}}

    <section id="index" class="content">
        {{--Флеш сообщения--}}
        <div class="sessionFlash">
            @if ( session()->has('success-dell') )
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Успешно</h5>
                    {{ session('success-dell') }}
                </div>
            @endif
        </div>
        {{--/Флеш сообщения--}}

        @if ( count($orders) !== 0)
            <div class="card mt-2">
                <div class="card-body p-0">
                    <table id="tableIndex" class="table">
                        {{--Заголовки--}}
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Оформлен</th>
                            <th>Кол-во продуктов, шт</th>
                            <th>Сумма заказа, руб</th>
                            <th>Статус</th>
                            <th>Действия</th>

                        </tr>
                        </thead>
                        {{--/Заголовки--}}
                        {{--Вывод заказов--}}
                        <tbody>
                        @php $i = $_SERVER['QUERY_STRING'] ? (5 * (substr($_SERVER['QUERY_STRING'], 5) - 1) ) + 1 : 1 @endphp
                        @foreach($orders as $order)
                            <tr style="background-color: @if($order->status === 1) #11ec11 @else #e9ec07 @endif">
                                <td>{{ $i }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>{{ $order->sum }}</td>
                                <td>@if ($order->status === 1)
                                        Завершен
                                    @else
                                        В работе
                                    @endif
                                </td>
                                {{--Просмотр заказа--}}
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('orders.show', ['id' => $order['id']]) }}"
                                           class="btn btn-warning mr-1 rounded-right"><i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                                {{--/Просмотр заказа--}}
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                        {{--/Вывод заказов--}}
                    </table>
                </div>
            </div>
            {{--Пагинация--}}
            {{ $orders->links('vendor.pagination.bootstrap-4') }}
            {{--/Пагинация--}}
        @else
            <div class="card mt-5">
                <div class="container">
                    <div><h4>Список заказов пуст</h4></div>
                </div>
            </div>
        @endif
    </section>

@endsection
