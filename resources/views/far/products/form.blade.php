{{--Подключаемая страница атрибутов товара--}}
<div class="col-sm-6">
    {{--Название--}}
    <div class="form-group">
        <label for="title">Название <span class="text-red">*</span></label>
        <input name="title"
               id="title"
               type="text"
               class="form-control @error('title') is-invalid @enderror"
               placeholder="Введите название"
               value="{{ $product->title ?? old('title') }}">
    </div>
    {{--/Название--}}
    {{--Категория--}}
    <div class="categoryInput form-group" style="display: none;">
        <label for="category_id">Категория <span class="text-red">*</span></label>
        <select
            name="category_id"
            id="category_id"
            class="form-control @error('category_id') is-invalid @enderror">
            @if( empty($product) )
                <option
                    selected="true"
                    disabled="disabled">Выберите категорию
                </option>
            @endif
            {{--Выпадающий список--}}
            @foreach($categories as $key => $category)
                <option
                    @if( !empty($product) && $product->category_id == $category->id) selected @endif
                @if( old('category_id') && old('category_id') == $category->id) selected @endif
                    id="{{ $category->id }}"
                    value="{{ $category->id }}"
                >{{ $category->title }}
                </option>
            @endforeach
            {{--Выпадающий список--}}
        </select>
    </div>
    {{--/Категория--}}
    {{--Цена--}}
    <div style="display: none;" class="priceInput form-group">
        <label for="price">Цена <span class="text-red">*</span></label>
        <input name="price"
               id="price"
               type="text"
               class="form-control @error('price') is-invalid @enderror" placeholder="Введите цену"
               value="{{ $product->price ?? old('price') }}">
    </div>
    {{--/Цена--}}
    {{--Старая цена--}}
    <div style="display: none;" class="oldPriceInput form-group">
        <label for="old_price">Старая цена</label>
        <input name="old_price"
               id="old_price"
               type="text"
               class="form-control @error('old_price') is-invalid @enderror"
               placeholder="Введите старую цену"
               value="{{ $product->old_price ?? old('old_price') }}">
    </div>
    {{--/Старая цена--}}
    {{--Новинка--}}
    <div style="display: none;" class="is_newInput form-group">
        <div class="custom-control custom-switch">
            <input class="custom-control-input"
                   name="is_new"
                   id="is_new"
                   type="checkbox"
                   @if( !empty($product) && $product->is_new == 1 ?? old('is_new') )
                   value="1"
                   checked
                   @else
                   value="0"
                @endif
            >
            <label class="custom-control-label" for="is_new">Новинка</label>
        </div>
    </div>
    {{--/Новинка--}}
    {{--Хит--}}
    <div style="display: none;" class="is_hitInput form-group">
        <div class="custom-control custom-switch">
            <input name="is_hit"
                   id="is_hit"
                   type="checkbox"
                   @if( !empty($product) && $product->is_hit == 1 ?? old('is_hit') )
                   value="1"
                   checked
                   @else
                   value="0"
                   @endif
                   class="custom-control-input"
            >
            <label class="custom-control-label" for="is_hit">Хит</label>
        </div>
    </div>
    {{--/Хит--}}
    {{--Описание--}}
    <div style="display: none;" class="descriptionInput form-group">
        <label for="description">Описание <span class="text-red">*</span></label>
        <textarea class="form-control" rows="3"
                  name="description"
                  id="description"
                  placeholder="Введите описание"
        >{{ $product->description ?? old('description') }}</textarea>
    </div>
    {{--/Описание--}}
    {{--Контент--}}
    <div style="display: none;" class=" contentInput form-group">
        <label for="content">Контент</label>
        <textarea class="form-control" rows="3"
                  name="content"
                  id="content"
                  placeholder="Введите контент"
        >{{ $product->content ?? old('content') }}</textarea>
    </div>
    {{--/Контент--}}
    {{--Ключевые слова--}}
    <div style="display: none;" class="keywordsInput form-group">
        <label for=keywords">Ключевые слова</label>
        <textarea class="form-control" rows="2"
                  name="keywords"
                  id="keywords"
                  placeholder="Введите ключевые слова"
        >{{ $product->keywords ?? old('keywords') }}</textarea>
    </div>
    {{--/Ключевые слова--}}
    @if(!empty($product) && $product->img !== 'no-image.png')
        <div class="showImg">
            <label for="oldImg">Прикрепленное изображение</label>
            <img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt=""
                 id="oldImg">
        </div>
        {{--/Прикрепленное изображение--}}
        {{--Выбор удалить/переместить изображение--}}
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
        {{--/Выбор удалить/переместить изображение--}}
    @endif
    {{--Изображение--}}
    <div style="display: none;" class="imgInput form-group">
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
    <button disabled class="buttonAdd btn btn-block bg-gradient-success btn-sm"
            style="display: none;" type="submit">@if( !empty($product) )Сохранить
        @else Добавить
        @endif
    </button>
</div>
