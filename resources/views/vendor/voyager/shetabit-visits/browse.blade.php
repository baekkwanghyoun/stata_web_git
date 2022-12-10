@extends('voyager::master')
@section('page_title', '접속자 통계')
@section('css')
    <style>
    .voyager .nav-tabs>li.active>a:hover {
    color: grey;
    border-bottom: white;
    }

    .btn.btn-primary.active {
        background: #0081ca !important;
    }
    </style>

    <script src="/js/Chart.min.js"></script>
@endsection

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="icon voyager-bar-chart"></i>{{Str::title($type)}}별 접속자 통계
        </h1>
    </div>
@stop

@section('content')

    {{--tab--}}
    {{--
    <div class="panel">
        <div class="page-content settings container-fluid">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#chart" style="font-weight: bold">chart</a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#table" style="font-weight: bold">table</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="chart" class="tab-pane fade in  active " style="padding-top: 40px">
                    123
                </div>
                <div id="table" class="tab-pane fade in   " style="padding-top: 40px">

                </div>
            </div>
        </div>
    </div>
--}}



    <div class="page-content container-fluid">
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="row align-items-center">
                    <div class="col-lg-4"  >
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary @if(request('dv', 'month')=='month') active @endif "
                                   onclick="javascript:window.location.href='{{url()->current().'?dv=month&started_at='.request("started_at").'&ended_at='.request("ended_at")}}'; ">
                                <input type="radio" name="options"  @if(request('dv')=='month') checked @endif >월별
                            </label>

                            <label class="btn btn-primary @if(request('dv')=='day') active @endif "
                                   onclick="javascript:window.location.href='{{url()->current().'?dv=day&started_at='.request("started_at").'&ended_at='.request("ended_at")}}'; ">
                                <input type="radio" name="options"  @if(request('dv')=='day') checked @endif> 일별
                            </label>
                            <label class="btn btn-primary @if(request('dv')=='year') active @endif "
                                   onclick="javascript:window.location.href='{{url()->current().'?dv=year&started_at='.request("started_at").'&ended_at='.request("ended_at")}}'; " >
                                <input type="radio" name="options"  @if(request('dv')=='year') checked @endif> 연도별
                            </label>
                        </div>
                    </div>

                    <form method="post" class="form-search">
                        @csrf
                        <input type="hidden" name="dv" value="{{request('dv')}}">

                        <div class="col-lg-6 col-sm-8"  style="margin-top: 4px; display: flex; justify-content: end">
                            <div class="" style="padding-top: 5px; margin-right: 6px">시작일</div>
                            <div class='input-group date datepicker_silver' id='' style="margin-right: 30px">
                                <input type="datetime" class="form-control " name="started_at" style="width: 120px" value="{{request('started_at')??$started_atC->format('Y-m-d')}}">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar "></span>
                                </span>
                           </div>

                            <div class="" style="padding-top: 5px; margin-right: 6px">종료일</div>
                            <div class='input-group date datepicker_silver' id=''>
                                <input type="datetime" class="form-control " name="ended_at" style="width: 120px" value="{{request('ended_at')??$ended_atC->format('Y-m-d')}}">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-4 align-items-start" style="display: flex; justify-content: end" >
                            <button title="검색" class="btn btn-sm btn-primary pull-right edit">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">검색</span>
                            </button>

                            <a href="{{url()->current()}}"  class="btn btn-sm btn-info pull-right edit">
                                <i class="voyager-cancel"></i> <span class="hidden-xs hidden-sm">초기화</span>
                            </a>
                        </div>
                    </form>
                </div>




                <div class="row">
                    <div class="col-lg-12 col-md-12"  >
                        {!! $chartjs->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('javascript')

    <!-- DataTables -->

    <script>
        $(document).ready(function () {
            $(".datepicker_silver").datetimepicker({
                format: 'yyyy-MM-DD'
            });


        });

    </script>
@stop
