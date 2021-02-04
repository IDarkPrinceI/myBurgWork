
@if(session()->has('typeSort'))
    {{ $config['products']->appends(['sort' => session()->get('typeSort')])->links('vendor.pagination.bootstrap-4') }}
@elseif(session()->has('search'))
    {{ $config['products']->appends(['q' => session()->get('search')])->links('vendor.pagination.bootstrap-4') }}
@else
    {{ $config['products']->links('vendor.pagination.bootstrap-4') }}
@endif
