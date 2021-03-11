@extends('front.layouts.layout')

@section('content')
    {{--Страница входа--}}

    <div class="best_burgers_area">
        <div class="container" style="padding-top: 50px; width: 40%">
            <div class="row" style="background-color: rgba(21,19,19,0.7); border-radius: 5%; padding-top: 30px;">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Вход</span>
                    </div>
                </div>
                {{--Форма входа пользователя--}}
                <div class="col-lg-12">
                    <form class="form-contact contact_form" action="{{ route('login.authenticate') }}" method="post"
                          id="loginForm">
                        @csrf
                        <div class="row"
                             style="display: flex; justify-content: center; align-items: center; flex-direction: column; color: #f4f5f6">
                            {{--Email--}}
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="email"
                                           id="email"
                                           type="text"
                                           placeholder="Введите e-mail *"
                                           value="{{ old('email') }}"
                                           style="font-size: medium; color: #f4f5f6; @error('email') border-color: #ee0d0d!important; @enderror">
                                </div>
                            </div>
                            {{--/Email--}}
                            {{--Пароль--}}
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="password"
                                           id="password"
                                           type="password"
                                           placeholder="Введите пароль *"
                                           style="font-size: medium; color: #f4f5f6; @error('password') border-color: #ee0d0d!important; @enderror">
                                </div>
                            </div>
                            {{--/Пароль--}}
                            {{--Запомнить меня--}}
                            <div class="switch-wrap d-flex justify-content-between">
                                <p style="color: #f4f5f6">Запомнить меня </p>
                                <div class="primary-checkbox" style="margin-left: 10px">
                                    <input type="checkbox"
                                           name="rememberMe"
                                           id="rememberMe">
                                    <label for="rememberMe"></label>
                                </div>
                            </div>
                            {{--/Запомнить меня--}}
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Войти</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{--/Форма входа пользователя--}}
            </div>
        </div>
    </div>

@endsection

