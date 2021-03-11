@extends('far.layouts.layout')

@section('content')
    {{--Страница редактирования пользователя--}}

    <section class="content">
        <div class="card">
            <div class="card-body" style="display: flex; flex-direction: row; justify-content: space-between">
                @if ($user)
                    {{--Форма редактирования--}}
                    <form role="form" method="post" action="{{ route('statistic.user.update', ['id' => $user->id]) }}">
                        @csrf
                        @method('POST')
                        <div class="col-md-12" style="min-width: 450px">
                            {{--Роль--}}
                            <div class="form-group">
                                <label for="role">Роль</label>
                                <select name="role"
                                        id="role"
                                        class="form-control @error('role') is-invalid @enderror">
                                    <option
                                        @if($user->role === 'admin')
                                        selected
                                        @endif>
                                        admin
                                    </option>
                                    <option
                                        @if($user->role === 'user')
                                        selected
                                        @endif>
                                        user
                                    </option>
                                </select>
                            </div>
                            {{--/Роль--}}
                            {{--Email--}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email"
                                       id="email"
                                       type="text"
                                       @if ($user->role !=='admin') readonly @endif
                                       class="form-control @error('email') is-invalid @enderror" placeholder="..."
                                       value="{{ $user->email }}">
                            </div>
                            {{--/Email--}}
                            {{--Имя--}}
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input name="name"
                                       id="name"
                                       type="text"
                                       @if ($user->role !=='admin') readonly @endif
                                       class="form-control @error('name') is-invalid @enderror" placeholder="..."
                                       value="{{ $user->name }}">
                            </div>
                            {{--/Имя--}}
                            {{--Телефон--}}
                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                <input name="phone"
                                       id="phone"
                                       type="text"
                                       @if ($user->role !=='admin') readonly @endif
                                       class="form-control @error('phone') is-invalid @enderror" placeholder="..."
                                       value="{{ $user->phone }}">
                            </div>
                            {{--/Телефон--}}
                            {{--Адрес--}}
                            <div class="form-group">
                                <label for="address">Адрес</label>
                                <textarea name="address"
                                          id="address"
                                          class="form-control" rows="3"
                                          @if ($user->role !=='admin') readonly @endif
                                          placeholder="..."
                                >{{ $user->address }}
                                </textarea>
                            </div>
                            {{--/Адрес--}}
                            <button type="submit" class="btn btn-block bg-gradient-success btn-sm">Сохранить</button>
                        </div>
                    </form>
                    {{--/Форма редактирования--}}
                    <div class="col-md-6" style="width: 50%; height: 400px; padding: 0.5em" id="map"></div>
            </div>
            @else
                <h3>Пользователь не найден</h3>
            @endif
        </div>
    </section>

@endsection
