{{--Хлебные крошки--}}

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            @if (!Request::is('far'))
                <div class="col-sm-6">
                    <h1>{{ session('levelTwo') ?? session('levelOne') }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('far.index') }}">Главная</a>
                        </li>
                        {{--Уровень один--}}
                        @if(session('levelOne'))
                            <li class="breadcrumb-item">
                                @if(session('levelTwo') !== null)
                                    <a href="{{ route(session('levelOneRoute')) }}">
                                        @endif
                                        {{ session('levelOne') }}
                                    </a>
                            </li>
                        @endif
                        {{--/Уровень один--}}
                        {{--Уровень два--}}
                        @if(session('levelTwo'))
                            <li class="breadcrumb-item">
                                {{ session('levelTwo') }}
                            </li>
                        @endif
                        {{--/Уровень два--}}

                    </ol>
                </div>
            @endif
        </div>
    </div>
</section>
