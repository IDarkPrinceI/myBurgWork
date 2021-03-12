@extends('far.layouts.layout')

@section('content')
    {{--Страница создания товара--}}

    <section class="content">
        <div class="card">
            <div class="card-body">
                {{--Форма ввода атрибутов товара--}}
                <form role="form" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{--Подключаемая страница атрибутов товара--}}
                    @include('far.products.form')
                    {{--/Подключаемая страница атрибутов товара--}}
                </form>
                {{--/Форма ввода атрибутов товара--}}
            </div>
        </div>
    </section>

@endsection
