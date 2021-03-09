@extends('far.layouts.layout')

@section('content')

    <div class="content">
        <div>
            <label for="datePickerStart">Выберите дату "С":</label>
            <p><input name="dataPicker" type="text" id="datePickerStart"></p>
        </div>
        <div id="dataPickerFinishDiv" class="d-none">
            <label for="dataPickerFinish">Выберите дату "ДО":</label>
            <p><input name="datePickerFinish" type="text" id="datePickerFinish"></p>
        </div>
        <button class="d-none btn btn-primary" id="chartBuild">Сформировать график</button>
{{--        график уникальных пользователей--}}
        <canvas id="myChart" width="900" height="500"></canvas>
    </div>

@endsection
