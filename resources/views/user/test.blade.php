{{--{{dd($user)}}--}}
@foreach($user as $key)
    {{$key->token->token}}
@endforeach
