@extends('far.layouts.layout')

@section('content')
    {{--Страниц построения графика уникальных пользователей--}}

    <div class="content">
        {{--Календарь выбора даты "С"--}}
        <div>
            <label for="datePickerStart">Выберите дату "С":</label>
            <p><input name="dataPicker" type="text" id="datePickerStart"></p>
        </div>
        {{--/Календарь выбора даты "С"--}}
        {{--Календарь выбора даты "ДО"--}}
        <div id="dataPickerFinishDiv" class="d-none">
            <label for="dataPickerFinish">Выберите дату "ДО":</label>
            <p><input name="datePickerFinish" type="text" id="datePickerFinish"></p>
        </div>
        {{--/Календарь выбора даты "ДО"--}}
        <button class="d-none btn btn-primary" id="chartBuild">Сформировать график</button>
        {{--График уникальных пользователей--}}
        <canvas id="myChart" width="900" height="500"></canvas>
        {{--/График уникальных пользователей--}}
    </div>

@endsection
