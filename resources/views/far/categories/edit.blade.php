@extends('far.layouts.layout')

@section('content')
    {{--Страница редактирования категории--}}

    <section class="content">
        <div class="card">
            {{--Форма ввода атрибутов категории--}}
            <div class="card-body">
                <form role="form" method="post" action="{{ route('categories.update', ['category' => $category->id]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{--Подключаемая форма ввода атрибутов категории--}}
                    @include('far.categories.form')
                </form>
            </div>
            {{--/Форма ввода атрибутов категории--}}
        </div>
    </section>

@endsection
