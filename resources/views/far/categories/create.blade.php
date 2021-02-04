@extends('far.layouts.layout')

@section('content')

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form role="form" method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="titleInput form-group">
                            <label for="title">Название*</label>
                            <input name="title"
                                   id="title"
                                   type="text"
                                   class="form-control @error('title') is-invalid @enderror" placeholder="Введите название"
                                   value="{{ old('title') }}">
                        </div>

                        <div class="descriptionInput form-group" style="display: none;">
                            <label for="description">Описание</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control" rows="3"
                                      placeholder="Введите описание"
                            >{{ old('description') }}</textarea>
                        </div>

                        <div class="keywordsInput form-group" style="display: none;">
                            <label for=keywords">Ключевые слова</label>
                            <textarea name="keywords"
                                      id="keywords"
                                      class="form-control" rows="3"
                                      placeholder="Введите ключевые слова"
                            >{{ old('keywords') }}</textarea>
                        </div>

                        <div class="imgInput form-group" style="display: none;">
                            <label for="img">Изображение</label>
                            <div class="custom-file">
                                <input type="file"
                                       name="img"
                                       class="custom-file-input @error('img') is-invalid @enderror"
                                       id="img">
                                <label class="custom-file-label" for="img">Выберите изображение</label>
                            </div>
                        </div>
                        <button class="buttonAdd btn btn-block bg-gradient-success btn-sm" disabled type="submit" style="display: none;">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
