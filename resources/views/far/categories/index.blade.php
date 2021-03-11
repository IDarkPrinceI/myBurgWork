@extends('far.layouts.layout')

@section('content')
    {{--Страница вывода категорий--}}

    <section id="index" class="content">
        {{--Флеш сообщение--}}
        <div class="sessionFlash">
            @if (session()->has('success-dell'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i>Успешно</h5>
                    {{ session('success-dell') }}
                </div>
            @endif
        </div>
        {{--/Флеш сообщение--}}
        {{--Добавить категорию--}}
        <div class="col-md-3">
            <a href="{{ route('categories.create') }}" class="btn btn-block bg-gray">
                <i class="far fa-file"></i> Добавить категорию</a>
        </div>
        {{--/Добавить категорию--}}
        {{--Вывод категорий--}}
        @if ( count($categories) !== 0)
            <div class="card mt-2">
                <div class="card-body p-0">
                    <table id="tableIndex" class="table">
                        {{--Заголовок--}}
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Название</th>
                            <th>Слаг</th>
                            <th>Описание</th>
                            <th>Ключевые слова</th>
                            <th>Изображение</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        {{--/Заголовок--}}
                        {{--Вывод списка категорий--}}
                        <tbody>
                        @php $i = $_SERVER['QUERY_STRING'] ? (5 * (substr($_SERVER['QUERY_STRING'], 5) - 1)) + 1 : 1 @endphp
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->keywords }}</td>
                                <td>
                                    <img src="{{ asset('assets/far/img/category/' . $category->img) }}" alt=""
                                         height="100px">
                                </td>
                                <td>
                                    <div class="btn-group">
                                        {{--Редактировать--}}
                                        <a id="test"
                                           href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                           class="btn btn-warning mr-1 rounded-right"><i class="fas fa-pen"></i>
                                        </a>
                                        {{--/Редактировать--}}
                                        {{--Удалить--}}
                                        <button id="modalDell" class="btn btn-danger rounded-left" type="button"
                                                @if($category->img !== 'no-image.png')
                                                data-img="1"
                                                @else
                                                data-img="0"
                                                @endif
                                                data-id="{{ $category->id }}"
                                                data-toggle="modal"
                                                data-target="#modal-danger">
                                            <i data-id="{{ $category->id }}"
                                               @if($category->img !== 'no-image.png')
                                               data-img="1"
                                               @else
                                               data-img="0"
                                               @endif
                                               class="fas fa-trash">
                                            </i>
                                        </button>
                                        {{--/Удалить--}}
                                    </div>
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                        {{--/Вывод списка категорий--}}
                    </table>
                </div>
            </div>
            {{--Пагинация--}}
            {{ $categories->links('vendor.pagination.bootstrap-4') }}
            {{--/Пагинация--}}
        @else
            <div class="card mt-5">
                <div class="container">
                    <div><h4>Список категорий пуст</h4></div>
                </div>
            </div>
        @endif
        {{--/Вывод категорий--}}
    </section>
    {{--Модальное окно удаления--}}
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
                        Эта операция необратима</p>
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
                    <button class="btn btn-outline-light bg-gradient-success" data-dismiss="modal" type="button">
                        Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{--/Модальное окно удаления--}}

@endsection
