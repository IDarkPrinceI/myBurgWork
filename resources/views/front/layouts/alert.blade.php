<div class="col-12" style="z-index: 10; position: absolute; padding-top: 130px;">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h6><i class="fa fa-times" aria-hidden="true"></i> Ошибка!</h6>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <div class="sessionFlash">
        @if (session()->has('success'))
            <div class=" alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i>Успешно</h5>
                {{ session('success') }}
            </div>
        @endif
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Ошибка!</h5>
            {{ session('error') }}
        </div>
    @endif
</div>







