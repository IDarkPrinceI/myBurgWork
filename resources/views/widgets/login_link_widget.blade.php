
@if ($config['userRole'] === 'guest')

    <li><a href="{{ route('login') }}">Вход</a></li>

    <li><a href="{{ route('register.create') }}">Регистрация</a></li>

@elseif ($config['userRole'] === 'user')

    <li><a href="{{ route('logout') }}">Выйти</a></li>

@elseif ($config['userRole'] === 'far')

    <li><a href="{{ route('far.index') }}">Админская часть</a></li>

    <li><a href="{{ route('logout') }}">Выйти</a></li>

@endif
