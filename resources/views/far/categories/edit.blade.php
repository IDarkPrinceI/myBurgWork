@extends('far.layouts.layout')

@section('content')

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form role="form" method="post" action="{{ route('categories.update', ['category' => $category->id]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input name="title"
                                   id="title"
                                   type="text"
                                   class="form-control @error('title') is-invalid @enderror" placeholder="..."
                                   value="{{ $category->title }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control" rows="3"
                                      placeholder="..."
                            >{{ $category->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for=keywords">Ключевые слова</label>
                            <textarea name="keywords"
                                      id="keywords"
                                      class="form-control" rows="3"
                                      placeholder="..."
                            >{{ $category->keywords }}</textarea>
                        </div>

                        @if($category->img !== 'no-image.png')
                            <div class="showImg">
                                <label for="oldImg">Прикрепленное изображение</label>
                                <img src="{{ asset('assets/far/img/category/' . $category->img) }}" alt=""
                                     id="oldImg">
                            </div>

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

                            <div id="oldImgBox">
                            </div>

                        @endif

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
                        <button type="submit" class="btn btn-block bg-gradient-success btn-sm">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
