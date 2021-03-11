<div id="includeIndex">

    @if(gettype($products) == 'string')
        <div class="card mt-5">
            <div class="container">
                <div><h4>{{ $products }}</h4></div>
            </div>
        </div>

    @elseif ( count($products) !== 0)
        <div class="card mt-2">
            <div class="card-body p-0">
                <table id="tableIndex" class="table">
                    <thead>
                    <tr id="head">
                        <th style="width: 10px">
                            <a href="{{ route('products.index') }}" class="text-dark">#
                            </a>
                        </th>
                        {{--                        Виджеты для формирования сортировки--}}
                        <th>
                            @widget('make_route', ['routeName' => 'Название',
                            'typeSort' => 'title'])
                        </th>
                        <th>
                            @widget('make_route', ['routeName' => 'Категория',
                            'typeSort' => 'category_title'])
                        </th>
                        <th>
                            @widget('make_route', ['routeName' => 'Цена',
                            'typeSort' => 'price'])
                        </th>
                        <th>
                            @widget('make_route', ['routeName' => 'Старая цена',
                            'typeSort' => 'old_price'])
                        </th>
                        <th>
                            @widget('make_route', ['routeName' => 'Новинка',
                            'typeSort' => 'is_new'])
                        </th>
                        <th>
                            @widget('make_route', ['routeName' => 'Хит',
                            'typeSort' => 'is_hit'])
                        </th>
                        <th>
                            @widget('make_route', ['routeName' => 'Просмотры',
                            'typeSort' => 'view'])
                        </th>
                        <th>Картинка</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = request('page') ? (5 * (request('page') - 1)) + 1 : 1 @endphp
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><a class="text-dark"
                                   href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
                            </td>
                            <td>{{ $product->category_title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->old_price ?? '-' }}</td>
                            <td class="text-green">{{ $product->is_new ? 'Новинка' : '-'}}</td>
                            <td class="text-orange">{{ $product->is_hit ? 'Хит' : '-' }}</td>
                            <td>{{ $product->view }}</td>
                            <td><img src="{{ asset('assets/far/img/product/' . $product->img) }}" alt=""
                                     height="100px"></td>
                            <td>
                                <div class="btn-group">
                                    <a id="test"
                                       href="{{ route('products.edit', ['product' => $product->id]) }}"
                                       class="btn btn-warning mr-1 rounded-right"><i class="fas fa-pen"></i>
                                    </a>
                                    <button id="modalDell" class="btn btn-danger rounded-left" type="button"
                                            @if($product->img !== 'no-image.png')
                                            data-img="1"
                                            @else
                                            data-img="0"
                                            @endif
                                            data-id="{{ $product->id }}"
                                            data-toggle="modal"
                                            data-target="#modal-danger">
                                        <i data-id="{{$product->id}}"
                                           @if($product->img !== 'no-image.png')
                                           data-img="1"
                                           @else
                                           data-img="0"
                                           @endif
                                           class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if(session()->has('typeSort'))
            {{ $products->appends(['sort' => session()->get('typeSort')])->links('vendor.pagination.bootstrap-4') }}
        @elseif(session()->has('search'))
            {{ $products->appends(['q' => session()->get('search')])->links('vendor.pagination.bootstrap-4') }}
        @else
            {{ $products->links('vendor.pagination.bootstrap-4') }}
        @endif
    @else
        <div class="card mt-5">
            <div class="container">
                <div><h4>Список товаров пуст</h4></div>
            </div>
        </div>
    @endif
</div>
