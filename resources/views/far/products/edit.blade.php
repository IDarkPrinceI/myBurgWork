@extends('far.layouts.layout')

@section('content')
    {{--Страница редактирования товара--}}

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form role="form" method="post" action="{{ route('products.update', ['product' => $product->id]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{--Атрибуты товара--}}
                    <div class="col-sm-6">
                        {{--Название--}}
                        <div class="form-group">
                            <label for="title">Название <span class="text-red">*</span></label>
                            <input name="title"
                                   id="title"
                                   type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Введите название"
                                   value="{{ $product->title }}">
                        </div>
                        {{--/Название--}}
                        {{--Категория--}}
                        <div class="form-group">
                            <label for="category_id">Категория <span class="text-red">*</span></label>
                            <select
                                class="form-control @error('category_id') is-invalid @enderror"
                                name="category_id"
                                id="category_id"
                            >
                                {{--Выпадающий список--}}
                                @foreach($categories as $key => $category)
                                    <option
                                        @if( $product->category_id == $category->id) selected @endif
                                    id="{{ $category->id }}"
                                        value="{{ $category->id }}"
                                    >{{ $category->title }}
                                    </option>
                                @endforeach
                                {{--/Выпадающий список--}}
                            </select>
                        </div>
                        {{--/Категория--}}
                        {{--Цена--}}
                        <div class="form-group">
                            <label for="price">Цена <span class="text-red">*</span></label>
                            <input class="form-control @error('price') is-invalid @enderror" placeholder="Введите цену"
                                   name="price"
                                   id="price"
                                   type="text"
                                   value="{{ $product->price }}">
                        </div>
                        {{--/Цена--}}
                        {{--Старая цена--}}
                        <div class="form-group">
                            <label for="old_price">Старая цена</label>
                            <input class="form-control @error('old_price') is-invalid @enderror"
                                   placeholder="Введите старую цену"
                                   name="old_price"
                                   id="old_price"
                                   type="text"
                                   value="{{ $product->old_price }}">
                        </div>
                        {{--/Старая цена--}}
                        {{--Новинка--}}
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input"
                                       name="is_new"
                                       id="is_new"
                                       type="checkbox"
                                       @if( $product->is_new == 1 )
                                       value="1"
                                       checked
                                    @endif
                                >
                                <label class="custom-control-label" for="is_new">Новинка</label>
                            </div>
                        </div>
                        {{--/Новинка--}}
                        {{--Хит--}}
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input class="custom-control-input"
                                       name="is_hit"
                                       id="is_hit"
                                       type="checkbox"
                                       @if( $product->is_hit == 1 )
                                       value="1"
                                       checked
                                    @endif
                                >
                                <label class="custom-control-label" for="is_hit">Хит</label>
                            </div>
                        </div>
                        {{--/Хит--}}
                        {{--Описание--}}
                        <div class="form-group">
                            <label for="description">Описание <span class="text-red">*</span></label>
                            <textarea class="form-control" rows="3"
                                      name="description"
                                      id="description"
                                      placeholder="Введите описание"
                            >{{ $product->description }}</textarea>
                        </div>
                        {{--/Описание--}}
                        {{--Контент--}}
                        <div class="form-group">
                            <label for="content">Контент</label>
                            <textarea class="form-control" rows="3"
                                      name="content"
                                      id="content"
                                      placeholder="Введите контент"
                            >{{ $product->content }}</textarea>
                        </div>
                        {{--/Контент--}}
                        {{--Ключевые слова--}}
                        <div class="form-group">
                            <label for=keywords">Ключевые слова</label>
                            <textarea class="form-control" rows="2"
                                      name="keywords"
                                      id="keywords"
                                      placeholder="Введите ключевые слова"
                            >{{ $product->keywords }}
                            </textarea>
                        </div>
                        {{--/Ключевые слова--}}
                        {{--Прикрепленное изображение--}}
                        @if($product->img !== 'no-image.png')
                            <div class="showImg">
                                <label for="oldImg">Прикрепленное изображение</label>
                                <img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt=""
                                     id="oldImg">
                            </div>
                            {{--/Прикрепленное изображение--}}
                            {{--Выбор удалить/переместить изображение--}}
                            <div id="oldImgBox">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="oldImg"
                                               id="onDell"
                                               type="checkbox"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="onDell">Удалить прикрепленное
                                            изображение</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input name="onMove"
                                               id="onMove"
                                               type="checkbox"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="onMove">Переместить прикрепленное
                                            изображение</label>
                                    </div>
                                </div>
                            </div>
                            {{--/Выбор удалить/переместить изображение--}}
                            {{--                            <div id="oldImgBox">--}}
                            {{--                            </div>--}}
                        @endif
                        {{--Загрузка изображения--}}
                        <div class="form-group">
                            <label for="img">Изображение</label>
                            <div class="custom-file">
                                <input type="file"
                                       name="img"
                                       class="custom-file-input @error('img') is-invalid @enderror"
                                       id="img">
                                <label class="custom-file-label" for="img">Выберите изображение</label>
                            </div>
                        </div>
                        {{--/Загрузка изображения--}}
                        <button type="submit" class="btn btn-block bg-gradient-success btn-sm">Сохранить</button>
                    </div>
                    {{--/Атрибуты товара--}}
                </form>
            </div>
        </div>
    </section>

@endsection
