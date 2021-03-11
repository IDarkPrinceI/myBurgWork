{{--Подключаемая форма ввода атрибутов категории--}}

<div class="col-sm-6">
    {{--Название--}}
    <div class="titleInput form-group">
        <label for="title">Название*</label>
        <input name="title"
               id="title"
               type="text"
               class="form-control @error('title') is-invalid @enderror"
               placeholder="Введите название"
               value="{{ $category->title ?? old('title') }}">
    </div>
    {{--/Название--}}
    {{--Описание--}}
    <div class="descriptionInput form-group" style="display: none;">
        <label for="description">Описание</label>
        <textarea name="description"
                  id="description"
                  class="form-control" rows="3"
                  placeholder="Введите описание"
        >{{ $category->description ?? old('description') }}</textarea>
    </div>
    {{--/Описание--}}
    {{--Ключевые слова--}}
    <div class="keywordsInput form-group" style="display: none;">
        <label for=keywords">Ключевые слова</label>
        <textarea name="keywords"
                  id="keywords"
                  class="form-control" rows="3"
                  placeholder="Введите ключевые слова">{{ $category->keywords ?? old('keywords') }}</textarea>
    </div>
    {{--/Ключевые слова--}}
    {{--Прекрепленное изображение--}}
    @if(!empty($category) && $category->img !== 'no-image.png')
        <div class="showImg">
            <label for="oldImg">Прикрепленное изображение</label>
            <img src="{{ asset('assets/far/img/category/' . $category->img) }}" alt=""
                 id="oldImg">
        </div>
        {{--Удалить/переместить изображение--}}
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
        {{--/Удалить/переместить изображение--}}
        {{--                            <div id="oldImgBox">--}}
        {{--                            </div>--}}
    @endif
    {{--/Прекрепленное изображение--}}
    {{--Изображение--}}
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
    {{--/Изображение--}}
    <button class="buttonAdd btn btn-block bg-gradient-success btn-sm" disabled type="submit"
            style="display: none;">@if( !empty($category) ) Сохранить
        @else Добавить
        @endif
    </button>
</div>

