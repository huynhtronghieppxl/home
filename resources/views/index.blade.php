@extends('layouts.layout')
@section('content')
    <div class="crm-contain-wrapper row">
        <div class="col-6 card-block">
            <div class="card" id="main1" style="height: 250px"></div>
        </div>
        <div class="col-6 card-block">
            <div class="card" id="main2" style="height: 250px"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script>
        var chartDom = document.getElementById('main1');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            title: {
                text: 'Doanh thu tháng này',
                subtext: moment('MM/YYYY'),
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [
                {
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 40,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [
                        {value: 1048, name: 'Search Engine'},
                        {value: 735, name: 'Direct'},
                        {value: 580, name: 'Email'},
                        {value: 484, name: 'Union Ads'},
                        {value: 300, name: 'Video Ads'}
                    ]
                }
            ]
        };

        option && myChart.setOption(option);

    </script>
    <script>
        var chartDom = document.getElementById('main2');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            title: {
                text: 'Chi phí tháng này',
                // subtext: '2023',
                left: 'center',
                // top: 30
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [
                {
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 40,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: [
                        {value: 1048, name: 'Search Engine'},
                        {value: 735, name: 'Direct'},
                        {value: 580, name: 'Email'},
                        {value: 484, name: 'Union Ads'},
                        {value: 300, name: 'Video Ads'}
                    ]
                }
            ]
        };

        option && myChart.setOption(option);

    </script>
@endpush
