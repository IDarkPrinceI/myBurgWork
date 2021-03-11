@extends('front.layouts.layout')

@section('content')
    {{--Страница просмотра одного товара --}}
    <h1>{{ $product->title }}</h1>
    <div class="best_burgers_area">
        <div class="container">
            {{--Меню--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <a class="section_title"
                           href="{{ route('menu.show', ['slug' => $product->category->slug]) }}"><span>Burger Menu</span></a>
                    </div>
                </div>
            </div>
            {{--Меню--}}
            {{--Данные товара--}}
            <div class="row" style="background-color: rgba(230,230,230, .7); border-radius: 5%; padding-top: 30px;">
                <div class="col-xl-6 col-md-6 col-lg-6" style="opacity: 100%">
                    <div class="single_delicious d-flex align-items-center">
                        <div class="thumb">
                            <img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt=""
                                 style="max-width: 400px">
                            @if($product->is_new)
                                <img src="{{ asset('assets/far/img/product/status/new.png') }}" alt=""
                                     style="position: absolute; width: 20%; left: -30px;">
                            @endif
                            @if($product->is_hit)
                                <img src="{{ asset('assets/far/img/product/status/hit.png') }}" alt=""
                                     style="position: absolute; width: 16%; left: -20px; top: 90px;">
                            @endif
                        </div>
                        <div class="info" style="min-width: 250px">
                            <h3 style="min-height: 72px">{{ $product->title }}</h3>
                            <h4><i class="fa fa-eye" style="color: whitesmoke"> {{ $product->view }} </i></h4>
                        </div>

                        <div class="info">
                            <h5 style="font-weight: bold">Описание:</h5>
                            <h5 style="text-align: justify; min-width: 400px">{{ $product->description }}</h5>
                            <span style="display: inline; margin-right: 20px; color: whitesmoke; font-size: 20px">{{ $product->price }} руб</span>

                            @if ($product->old_price)
                                <span
                                    style="display: inline; text-decoration: line-through; font-size: 20px; margin-right: 10px;">{{ $product->old_price }} руб</span>
                            @endif

                            <div style=" margin-top: 60px; margin-left: auto; margin-right: auto; width: 41%;">
                                <button class="singleMinus genric-btn primary-border circle"
                                        style="display: inline; background-color: #F2C64D"
                                        onmouseover="this.style.backgroundColor='#d95a1f';"
                                        onmouseout="this.style.backgroundColor='#F2C64D';"
                                >-
                                </button>
                                <h5 class="singleResult" style="display: inline; font-weight: bold">1</h5>
                                <button class="singlePlus genric-btn primary-border circle"
                                        style="display: inline; background-color: #F2C64D"
                                        onmouseover="this.style.backgroundColor='#d95a1f';"
                                        onmouseout="this.style.backgroundColor='#F2C64D';"
                                >+
                                </button>
                            </div>
                            <div style=" margin-top: 10px; margin-left: auto; margin-right: auto; width: 50%;">
                                <button class="boxed-btn3 cartAdd" style="width: 200px; height: 35px; padding: 5px 30px"
                                        data-slug="{{ $product->slug  }}"
                                        onmouseover="this.style.backgroundColor='#d95a1f';"
                                        onmouseout="this.style.backgroundColor='#F2C64D';"
                                >Заказать
                                </button>
                            </div>
                        </div>
                    </div>
                    <div style="width: 200%; padding: 30px">
                        <h5 style="font-weight: bold">Содержание: </h5>
                        {{ $product->content }}
                    </div>
                </div>
            </div>
            {{--/Данные товара--}}
        </div>
    </div>

@endsection
