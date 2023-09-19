@extends('layouts.layout')
@section('content')
    <style>
        .title-report {
            border-bottom: 1px solid #f2f2f2;
        }

        .time-report {
            position: absolute;
            right: 15px;
            border: 1px solid #7b7b7b;
            width: 90px !important;
            display: inline-block;
            text-align: center;
            font-size: 13px;
            border-radius: 3px;
            font-weight: 500;
            color: #606060;
            margin-top: 3px;
        }
    </style>
    <div class="crm-contain-wrapper">
        <div class="card card-block pt-3">
            <div class="widget">
                <h4 class="widget-title title-report">Báo cáo chi phí tháng</h4>
                <input class="time-report" type="text"
                       value="{{date('m/Y')}}" autocomplete="off" id="time-report"/>
                <div id="revenue-pie" style="height: 250px; margin-top: 35px"></div>
                <h4 class="widget-title title-report">Thống kê chi phí</h4>
                <div id="revenue-line" style="height: 300px; margin-top: 35px"></div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script src="/js/report/cost.js"></script>
@endpush
