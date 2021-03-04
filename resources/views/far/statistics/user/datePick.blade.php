@extends('far.layouts.layout')

@section('content')

    <div class="content">
        <label for="dataPicker">Выберите дату :</label>
    <p><input name="dataPicker" type="text" id="datepicker"></p>

        <canvas id="myChart" width="900" height="500"></canvas>

{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        <div class="d-flex">--}}
{{--            <p class="d-flex flex-column">--}}
{{--                <span class="text-bold text-lg">820</span>--}}
{{--                <span>Visitors Over Time</span>--}}
{{--            </p>--}}
{{--            <p class="ml-auto d-flex flex-column text-right">--}}
{{--                    <span class="text-success">--}}
{{--                      <i class="fas fa-arrow-up"></i> 12.5%--}}
{{--                    </span>--}}
{{--                <span class="text-muted">Since last week</span>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        <!-- /.d-flex -->--}}

{{--        <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>--}}
{{--        </div>--}}

{{--        <div class="d-flex flex-row justify-content-end">--}}
{{--                  <span class="mr-2">--}}
{{--                    <i class="fas fa-square text-primary"></i> This Week--}}
{{--                  </span>--}}

{{--            <span>--}}
{{--                    <i class="fas fa-square text-gray"></i> Last Week--}}
{{--                  </span>--}}
{{--        </div>--}}
    </div>

@endsection
