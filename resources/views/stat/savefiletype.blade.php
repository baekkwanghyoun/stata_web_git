
@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' 저장 파일 타입별 통계')

@section('css')
    <script src="/js/Chart.min.js"></script>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-pie-graph"></i> 저장 파일 타입별 통계
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">

        <div class="panel panel-bordered">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12" >
                        {!! $chartjs->render() !!}
                    </div>

                    <div class="col-lg-6 col-md-12" >
                        {!! $chartjs2->render() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

