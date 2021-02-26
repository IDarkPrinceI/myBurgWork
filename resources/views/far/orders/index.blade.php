@extends('far.layouts.layout')

@section('content')

    <section id="index" class="content">
        <div class="sessionFlash">
            @if ( session()->has('success-dell') )
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Успешно</h5>
                    {{ session('success-dell') }}
                </div>
            @endif
        </div>

        @if ( count($orders) !== 0)
            <div class="card mt-2">
                <div class="card-body p-0">
                    <table id="tableIndex" class="table">
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
                                <td>
                                    <div class="btn-group">
                                        <a  href="{{ route('orders.show', ['id' => $order['id']]) }}" class="btn btn-warning mr-1 rounded-right"><i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $orders->links('vendor.pagination.bootstrap-4') }}
        @else
            <div class="card mt-5">
                <div class="container">
                    <div><h4>Список заказов пуст</h4></div>
                </div>
            </div>
        @endif

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
                    <p>Вы действительно хотите удалить данную категорию?
                        <br>
                        Эта операция необратима
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <form role="form" id="dellForm">
                        <button id="onDellCategory" type="submit" class="btn btn-outline-light">Подтвердить удаление
                        </button>
                        <div id="indexOnDell"
                             class="mt-4 d-none custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="onDellImg">
                            <label id="labelOnDellImg" class="custom-control-label" for="onDellImg">Переместить
                                изображение</label>
                        </div>
                    </form>
                    <button  class="btn btn-outline-light bg-gradient-success" data-dismiss="modal" type="button">
                        Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
