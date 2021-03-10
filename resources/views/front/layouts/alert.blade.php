<div id="alertWindow" class="col-12" style="z-index: 10; position: absolute; margin-top: 140px;">
    {{--    Вывод ошибок--}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button id="buttonCloseAlert" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h6><i class="fa fa-times" aria-hidden="true"></i> Ошибка!</h6>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    {{--    Вывод сессия успех--}}
    <div id="sessionSuccess" class="sessionFlash">
        @if (session()->has('success'))
            <div class=" alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="fa fa-coffee" aria-hidden="true"></i> Успешно</h5>
                {{ session('success') }}
            </div>
        @endif
    </div>
    {{--    Вывод сессия ошибка--}}
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="fa fa-times" aria-hidden="true"></i> Ошибка!</h5>
            {{ session('error') }}
        </div>
    @endif
</div>







