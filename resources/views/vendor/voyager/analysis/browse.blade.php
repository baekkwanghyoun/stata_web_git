@extends('voyager::master')
@section('page_title', '분석 통계')
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
            <i class="icon voyager-bar-chart"></i>
            @if(in_array($type, ['wave']))
                차수 통계
            @elseif(in_array($type, ['wave']))
            @else
                {{Str::title($type)}} 변수 통계
            @endif
        </h1>
    </div>
@stop

@section('content')


    <div class="page-content container-fluid">
        <div class="panel panel-bordered">
            <div class="panel-body">

                <div class="row align-items-center">
                    <div class="col-lg-3 col-sm-12"  >

                    </div>

                    <form id="frm" name="frm" method="post" class="form-search">
                        @csrf
                        <input type="hidden" name="dv" value="{{request('dv')}}">
                        <div class="col-lg-6"  style="margin-top: 4px; display: flex; justify-content: end">
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

                        <div class="col-lg-3 align-items-start" style="display: flex; justify-content: end" >
                            <button title="검색" class="btn btn-sm btn-primary pull-right edit">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">검색</span>
                            </button>

                            <a href="{{url()->current()}}"  class="btn btn-sm btn-info pull-right edit">
                                <i class="voyager-cancel"></i> <span class="">초기화</span> {{--hidden-xs hidden-sm--}}
                            </a>
                            <a id="excel" title="다운로드" class="btn btn-sm btn-warning pull-right edit">
                                <i class="voyager-book-download"></i> <span class="hidden-xs hidden-sm">다운로드</span>
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
            $('#excel').click(function() {
                $("<input>").attr({
                    name: "type",
                    id: "type",
                    type: "hidden",
                    value: 'csv'
                }).appendTo("#frm");
                $( "#frm" ).submit();

                $("#type").remove();//사용후 삭제
            });

            $(".datepicker_silver").datetimepicker({
                format: 'yyyy-MM-DD'
            });


        });

    </script>
@stop
