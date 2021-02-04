@extends('front.layouts.layout')

@section('content')
    <!-- features_room_startt -->

    <div class="Burger_President_area best_burgers_area" style="padding: 150px; ">
        <div class="section_title text-center mb-80">
            <span>Burger Menu</span>
        </div>
        <div style="background-color: white;" class="Burger_President_here">
            @foreach($categories as $category)
                <div class="single_Burger_President">
                    <div class="room_thumb">
                        <img src="{{ asset('assets/far/img/category/'. $category->img) }}" alt="" height="282px"
                             style="opacity: 0.75">
                        <div class="room_heading d-flex justify-content-between align-items-center"
                             style="bottom: 30px">
                            <div class="room_heading_inner">
                                <h3>{{ $category->title }}</h3>
                                <p style="min-height: 56px">{{ $category->description }}</p>
                                <a href="{{ route('menu.show', ['slug' => $category->slug]) }}" class="boxed-btn3"
                                   onmouseover="this.style.backgroundColor='#d95a1f';"
                                   onmouseout="this.style.backgroundColor='#F2C64D';"
                                >Посмотреть</a>
                                <p>Всего наименований: <span style="color: whitesmoke;
                                                             font-size: 20px;
display: inline">{{ $category->countCategory }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- features_room_end -->
@endsection
