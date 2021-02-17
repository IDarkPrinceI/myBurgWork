@extends('front.layouts.layout')

@section('content')

    <div class="best_burgers_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Burger Menu</span>
                        <h3 style="color: #F2C64D">Самые популярные товары</h3>
                    </div>
                </div>
            </div>

            <div class="row" style="background-color: rgba(230,230,230, .3); border-radius: 5%; padding-top: 30px;">
                @foreach($products as $product)
                    <div class="col-xl-6 col-md-6 col-lg-6" style="opacity: 100%">
                        <div class="single_delicious d-flex align-items-center">
                            <div class="thumb" style="min-width: 301px; min-height: 224px">
                                <img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt="" width="80%">
                                @if($product->is_new)
                                    <img src="{{ asset('assets/far/img/product/status/new.png') }}" alt="" style="position: absolute; width: 20%; left: -30px;">
                                @endif
                                @if($product->is_hit)
                                    <img src="{{ asset('assets/far/img/product/status/hit.png') }}" alt="" style="position: absolute; width: 16%; left: -20px; top: 90px;">
                                @endif
                            </div>
                            <div class="info" style="min-height: 205px">
                                <h3 style="min-height: 108px"><a href="{{ route('menu.single', ['category' => $product->category_slug, 'slug' => $product->slug]) }}">{{$product->title}}</a></h3>
                                <span style="display: inline; margin-right: 30px; color: whitesmoke; font-size: 20px">{{$product->price}} руб</span>
                                @if ($product->old_price)
                                    <span style="display: inline; text-decoration: line-through; font-size: 20px">{{$product->old_price}} руб</span>
                                @endif
                                <div style="display: inline-block">
{{--                                    <a href="#" class="boxed-btn3 cardAdd"--}}
                                    <button class="boxed-btn3 cardAdd"
                                       style="width: 200px; height: 35px; padding: 5px 30px;"
                                       data-slug={{ $product->slug  }}
                                       onmouseover="this.style.backgroundColor='#d95a1f';"
                                       onmouseout="this.style.backgroundColor='#F2C64D';"
                                    >Заказать</button>
                                    <i class="fa fa-eye" style="color: whitesmoke"> {{$product->view}}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="iteam_links">
                        <a class="boxed-btn5" href="{{ route('menu') }}"
                           style="font-size: 1.5em; color: whitesmoke !important; opacity: 0.7; background-color: #333"
                           onmouseover="this.style.backgroundColor='#d95a1f';"
                           onmouseout="this.style.backgroundColor='#333';"
                        >Посмотреть все меню</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
