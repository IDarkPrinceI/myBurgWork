@extends('far.layouts.layout')

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Статистика магазина</h3>

                {{--                    <div class="card-tools">--}}
                {{--                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
                {{--                            <i class="fas fa-minus"></i></button>--}}
                {{--                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">--}}
                {{--                            <i class="fas fa-times"></i></button>--}}
                {{--                    </div>--}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $categories }}</h3>
                                <p>Категории</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-carrot nav-icon"></i>
                            </div>
                            <a href="{{ route('categories.index') }}" class="small-box-footer">Список категорий <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $products }}</h3>

                                <p>Товары</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-pepper-hot nav-icon"></i>
                            </div>
                            <a href="{{ route('products.index') }}" class="small-box-footer">Список товаров <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>


@endsection

