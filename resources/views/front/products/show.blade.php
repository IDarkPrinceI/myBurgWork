@extends('front.layouts.layout')

@section('content')

    <div class="best_burgers_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Burger Menu</span>
                    </div>
                </div>
            </div>
            <div class="row" style="background-color: rgba(230,230,230, .3); border-radius: 5%; padding-top: 30px;">
                @foreach($products as $product)
                    <div class="col-xl-6 col-md-6 col-lg-6" style="opacity: 100%">
                        <div class="single_delicious d-flex align-items-center">
                            <div class="thumb">
                                <img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt="" height="200px">
                                @if($product->is_new)
                                    <img src="{{ asset('assets/far/img/product/status/new.png') }}" alt="" style="position: absolute; width: 20%; left: -30px;">
                                @endif
                                @if($product->is_hit)
                                    <img src="{{ asset('assets/far/img/product/status/hit.png') }}" alt="" style="position: absolute; width: 16%; left: -20px; top: 90px;">
                                @endif
                            </div>
                            <div class="info">
                                <h3 style="min-height: 72px"><a href="{{ route('menu.single', ['category' => $product->category_slug, 'slug' => $product->slug]) }}">{{$product->title}}</a></h3>
                                <span style="display: inline; margin-right: 30px; color: whitesmoke; font-size: 20px">{{$product->price}} руб</span>
                                @if ($product->old_price)
                                    <span style="display: inline; text-decoration: line-through; font-size: 20px">{{$product->old_price}} руб</span>
                                @endif
                                <div style="display: inline-block; padding-top: 10px">
                                    <button class="boxed-btn3 cartAdd" style="width: 200px; height: 35px; padding: 5px 30px"
                                       data-slug="{{ $product->slug  }}"
                                       onmouseover="this.style.backgroundColor='#d95a1f';"
                                       onmouseout="this.style.backgroundColor='#F2C64D';"
                                    >Заказать</button>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="opacity: 0.7; margin-left: auto;
                margin-right: auto; width: 6em; padding-top: 55px">
                {{ $products->links('vendor.pagination.bootstrap-4') }}

            </div>
        </div>
    </div>

@endsection
