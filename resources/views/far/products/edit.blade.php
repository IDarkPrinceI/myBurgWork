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
                    {{--Подключаемая страница атрибутов товара--}}
                    @include('far.products.form')
                    {{--/Подключаемая страница атрибутов товара--}}
                </form>
            </div>
        </div>
    </section>

@endsection
