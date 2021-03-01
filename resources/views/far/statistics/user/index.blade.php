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
{{--userIndex--}}
        @if ( count($users) !== 0)
            <div class="card mt-2">
                <div class="card-body p-0">
                    <table id="tableIndex" class="table">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Адрес</th>
                            <th>Зарегистрирован</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = $_SERVER['QUERY_STRING'] ? (5 * (substr($_SERVER['QUERY_STRING'], 5) - 1) ) + 1 : 1 @endphp
                        @foreach($users as $user)
                            <tr @if ($user->role === 'admin') style="background-color: greenyellow" @endif>
                                <td>{{ $i }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('statistic.user.edit', ['id' => $user['id']]) }}" class="btn btn-warning mr-1 rounded-right"><i class="fas fa-pen"></i></a>
                                        <button href="{{ route('statistic.user.dell', ['id' => $user['id']]) }}"
                                                class="btn btn-danger mr-1 rounded-left rounded-right"
{{--                                                data-id="{{ $user->id }}"--}}
                                                data-toggle="modal"
                                                data-target="#modal-danger"
                                        ><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        @else
            <div class="card mt-5">
                <div class="container">
                    <div><h4>Список пользователей пуст</h4></div>
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
                    <p>Вы действительно хотите удалить учетную запись?
                        <br>
                        Эта операция необратима
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <form role="form">
                        <button id="onDellUser" type="submit" class="btn btn-outline-light">Подтвердить удаление
                        </button>
                    </form>
                    <button  class="btn btn-outline-light bg-gradient-success" data-dismiss="modal" type="button">
                        Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
