@extends('far.layouts.layout')

@section('content')
    {{--Страница просмотра товара--}}

    <section class="content">
        <div class="col-md-3">
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-block bg-gray">
                <i class="fas fa-pen"></i> Редактировать продукт</a>
        </div>
        {{--Атрибуты товара--}}
        <div class="card mt-2">
            <div class="card-body">
                <form>
                    {{--Название--}}
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Название</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   readonly
                                   class="form-control"
                                   id="title"
                                   value="{{ $product->title }}">
                        </div>
                    </div>
                    {{--/Название--}}
                    {{--Категория--}}
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Категория</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   readonly
                                   class="form-control"
                                   id="category_id"
                                   value="{{ $product->category->title }}">
                        </div>
                    </div>
                    {{--/Категория--}}
                    {{--Цена--}}
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Цена</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   readonly
                                   class="form-control"
                                   id="price"
                                   value="{{ $product->price }}">
                        </div>
                    </div>
                    {{--/Цена--}}
                    {{--Старая цена--}}
                    <div class="form-group row">
                        <label for="old_price" class="col-sm-2 col-form-label">Старая цена</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   readonly
                                   class="form-control"
                                   id="old_price"
                                   value="{{ $product->old_price ?? '-' }}">
                        </div>
                    </div>
                    {{--/Старая цена--}}
                    {{--Новинка--}}
                    <div class="form-group row">
                        <label for="is_new" class="col-sm-2 col-form-label">Новинка</label>
                        <div class="col-sm-10">
                            <input disabled
                                   type="checkbox"
                                   class="form-control"
                                   id="is_new"
                                   @if( $product->is_new == 1 )
                                   value="1"
                                   checked
                                @endif>
                        </div>
                        {{--/Новинка--}}
                        {{--Хит--}}
                    </div>

                    <div class="form-group row">
                        <label for="is_hit" class="col-sm-2 col-form-label">Хит</label>
                        <div class="col-sm-10">
                            <input disabled
                                   type="checkbox"
                                   class="form-control"
                                   id="is_hit"
                                   @if( $product->is_hit == 1 )
                                   value="1"
                                   checked
                                @endif>
                        </div>
                    </div>
                    {{--/Хит--}}
                    {{--Описание--}}
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Описание</label>
                        <div class="col-sm-10">
                            <textarea class="form-control"
                                      id="description"
                                      rows="3" readonly
                            >{{ $product->description }}
                            </textarea>
                        </div>
                    </div>
                    {{--/Описание--}}
                    {{--Контент--}}
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Контент</label>
                        <div class="col-sm-10">
                            <textarea class="form-control"
                                      id="content"
                                      rows="3"
                                      readonly
                            >{{ $product->content }}
                            </textarea>
                        </div>
                    </div>
                    {{--/Контент--}}
                    {{--Ключевые слова--}}
                    <div class="form-group row">
                        <label for="keywords" class="col-sm-2 col-form-label">Ключевые слова</label>
                        <div class="col-sm-10">
                            <textarea class="form-control"
                                      id="keywords"
                                      rows="3"
                                      readonly
                            >{{ $product->keywords }}
                            </textarea>
                        </div>
                    </div>
                    {{--/Ключевые слова--}}
                    {{--Изображение--}}
                    <div class="form-group row">
                        <label for="oldImg" class="col-sm-2 col-form-label">Прикрепленное изображение</label>
                        @if($product->img !== 'no-image.png')
                            <div class="showImg">
                                <img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt="" id="oldImg">
                        @else
                                <img src="{{ asset('assets/far/img/product/no-image.png')}}" alt="" id="oldImg">
                            </div>
                        @endif
                    </div>
                    {{--/Изображение--}}
                </form>
            </div>
        </div>
        {{--/Атрибуты товара--}}
    </section>

@endsection
