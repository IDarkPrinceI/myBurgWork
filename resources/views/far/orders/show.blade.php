@extends('far.layouts.layout')

@section('content')

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form role="form" method="post" action="{{ route('orders.update', ['id' => $order['id']]) }}">
                    @csrf
                    <div style="display: flex; flex-direction: row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input name="name"
                                       id="name"
                                       type="text"
                                       class="form-control"
                                       disabled
                                       value="{{ $order->name }}">
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input
                                    class="form-control"
                                    name="email"
                                    id="email"
                                    disabled
                                    value="{{ $order->email }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                <input class="form-control"
                                       name="phone"
                                       id="phone"
                                       type="text"
                                       disabled
                                       value="{{ $order->phone }}">
                            </div>

                            <div class="form-group">
                                <label for="address">Адрес</label>
                                <textarea class="form-control"
                                          name="address"
                                          id="address"
                                          type="text"
                                          rows="3"
                                          disabled>{{ $order->address }}
                                </textarea>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="created_at">Дата создания</label>
                                <input class="form-control"
                                       name="created_at"
                                       id="created_at"
                                       type="text"
                                       disabled
                                       value="{{ $order->created_at }}">
                            </div>

                            <div class="form-group">
                                <label for="updated_at">Дата обновления</label>
                                <input class="form-control"
                                       name="updated_at"
                                       id="updated_at"
                                       type="text"
                                       disabled
                                       value="{{ $order->updated_at }}">
                            </div>

                            <div class="form-group">
                                <label for="qty">Кол-во товаров</label>
                                <input class="form-control"
                                       name="qty"
                                       id="qty"
                                       type="text"
                                       disabled
                                       value="{{ $order->qty }}">
                            </div>

                            <div class="form-group">
                                <label for="sum">Сумма заказа</label>
                                <input class="form-control"
                                       name="sum"
                                       id="sum"
                                       type="text"
                                       disabled
                                       value="{{ $order->sum }}">
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input"
                                           name="status"
                                           id="status"
                                           type="checkbox"
                                           @if( $order->status == 1 )
                                           value="1"
                                           checked
                                        @endif>
                                    <label class="custom-control-label" for="status">
                                        @if($order->status == 1)
                                            Завершен
                                        @else
                                            В работе
                                        @endif
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-body p-0">
                        <table id="tableIndex" class="table">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Название</th>
                                <th>Цена, руб</th>
                                <th>Количество, шт</th>
                                <th>Сумма, руб</th>
                                <th>Изображение</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php $i = $_SERVER['QUERY_STRING'] ? (5 * ( substr($_SERVER['QUERY_STRING'], 5) - 1) ) + 1 : 1 @endphp
                            @foreach($orderItems as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <a href="{{ route('products.show', ['product' => $item['product_id']])}}">{{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->sum }}</td>
                                    <td><img src="{{ asset($item->img) }}" alt="" width="80px"></td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-block bg-gradient-success btn-sm">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
