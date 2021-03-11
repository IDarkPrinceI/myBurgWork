@extends('front.layouts.layout')

@section('content')
    {{--Страница регистрации--}}

    <div class="best_burgers_area">
        <div class="container" style="padding-top: 50px; width: 40%">
            <div class="row" style="background-color: rgba(21,19,19,0.7); border-radius: 5%; padding-top: 30px;">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Регистрация</span>
                    </div>
                </div>
                {{--Форма регистрации--}}
                <div class="col-lg-12">
                    <form class="form-contact contact_form" action="{{ route('register.store') }}" method="post"
                          id="contactForm">
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
                            {{--Подтверждение пароля--}}
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           type="password"
                                           placeholder="Подтвердите пароль *"
                                           style="font-size: medium; color: #f4f5f6; @error('password_confirmation') border-color: #ee0d0d!important; @enderror">
                                </div>
                            </div>
                            {{--/Подтверждение пароля--}}
                            {{--Имя--}}
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="name"
                                           id="name"
                                           type="text"
                                           placeholder="Введите имя"
                                           value="{{ old('name') }}"
                                           style="font-size: medium; color: #f4f5f6; @error('name') border-color: #ee0d0d!important; @enderror">
                                </div>
                            </div>
                            {{--/Имя--}}
                            {{--Телефон--}}
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input class="form-control valid @error('phone') is-invalid @enderror"
                                           name="phone"
                                           id="phone"
                                           type="text"
                                           placeholder="Телефон"
                                           value="{{ old('phone') }}"
                                           style="font-size: medium; color: #f4f5f6; @error('phone') border-color: #ee0d0d!important; @enderror">
                                </div>
                            </div>
                            {{--/Телефон--}}

                            {{--Адрес--}}
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <textarea class="form-control valid @error('address') is-invalid @enderror"
                                              name="address"
                                              id="address"
                                              rows="3"
                                              type="text"
                                              readonly
                                              style="font-size: medium; color: #f4f5f6; @error('phone') border-color: #ee0d0d!important; @enderror">Выберите адрес на карте
                                    </textarea>
                                </div>
                            </div>
                            {{--/Адрес--}}

                            {{--Yandex карта--}}
                            <div style="width: 100%; height: 400px; padding: 0.5em" id="map"></div>
                            {{--/Yandex карта--}}
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Зарегистрироваться
                                </button>
                            </div>
                        </div>
                    </form>
                    {{--/Форма регистрации--}}
                </div>
            </div>
        </div>
    </div>

@endsection

