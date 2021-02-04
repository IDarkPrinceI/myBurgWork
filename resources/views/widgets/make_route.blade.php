
<a class="text-dark"
   href="
   @if (session()->get('typeSort') . '-' . session()->get('direction')  === $config['typeSort'] . '-' . $config['direction_ask'])
        {{ route('products.index', ['sort' => $config['typeSort'], 'direction' => $config['direction_desk']])}}
       ">{{$config['routeName']}}
        <i class="fa fa-caret-down" aria-hidden="true"></i>

   @elseif (session()->get('typeSort') . '-' . session()->get('direction')  === $config['typeSort'] . '-' . $config['direction_desk'])
        {{ route('products.index', ['sort' => $config['typeSort'], 'direction' => $config['direction_ask']])}}
        ">{{$config['routeName']}}
        <i class="fa fa-caret-up" aria-hidden="true"></i>

   @else
        {{ route('products.index', ['sort' => $config['typeSort'], 'direction' => $config['direction_ask']])}}">{{$config['routeName']}}

   @endif
</a>
