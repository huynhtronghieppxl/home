$(function () {
    dateTimePickerMonthYear($("#time-report"));
    $('#time-report').on('dp.change', function () {
        chartPie();
    })
    chartPie();
    chartLine();
})

async function chartPie() {
    let method = "get",
        url = "revenue-report.data",
        params = {
            from: moment($('#time-report').val(), 'MM/YYYY').format('MM/01/YYYY'),
            to: moment($('#time-report').val(), 'MM/YYYY').endOf('month').format('MM/DD/YYYY'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);

    let chartDom = document.getElementById('revenue-pie');
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'item'
        },
        title: {
            left: 'center',
            top: 0,
            textStyle: {
                rich: {
                    a: {
                        fontSize: 16,
                        color: '#000',
                        fontWeight: '600',
                        fontFamily: 'Roboto'
                    },
                    b: {
                        fontSize: 16,
                        color: '#FA6342',
                        fontWeight: '600',
                        fontFamily: 'Roboto'
                    }
                }
            },
        },
        legend: {
            orient: 'vertical',
            left: 'right',
            type: 'scroll',
            formatter: function (name) {
                let series = myChart.getOption().series[0];
                let value = series.data.filter(row => row.name === name)[0].value
                let itemData = res.data[0].find(function (item) {
                    return item.name === name;
                });
                let percent = ((itemData.value / res.data[1]) * 100).toFixed(2);
                return name + ':  (' + formatNumber(value) + ') ' + percent + '%';
            },
            textStyle: {
                fontWeight: "normal",
                fontFamily: "Roboto"
            }
        },
        series: [
            {
                type: 'pie',
                radius: '50%',
                data: res.data[0],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                },
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    formatter: '{b}: ({d}%)',
                },
                labelLine: {
                    show: true
                },
            },
        ]
    };
    option && myChart.setOption(option);
    $(window).on('resize', function () {
        myChart.resize();
    });
}

async function chartLine() {
    let method = "get",
        url = "revenue-report.all",
        params = {
            from: moment($('#time-report').val(), 'MM/YYYY').format('MM/01/YYYY'),
            to: moment($('#time-report').val(), 'MM/YYYY').endOf('month').format('MM/DD/YYYY'),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);

    let chartDom = document.getElementById('revenue-line');
    let myChart = echarts.init(chartDom);
    let option = {
        tooltip: {
            trigger: 'axis',
        },
        grid: {
            top: '15%',
            left: '1%',
            right: '2%',
            bottom: '1%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: res.data[0].timeline,
            axisLabel: {
                margin: 10.5
            }
        },
        yAxis: {
            type: 'value',
            axisLabel: {
                formatter: function (value, index) {
                    return nFormatter(value);
                }
            }
        },
        series: [
            {
                name: 'Chi phí',
                type: 'line',
                smooth: true,
                markPoint: {
                    data: [
                        {type: 'max', name: 'Max'},
                    ],
                    itemStyle: {
                        color: "#fe5d70",
                    },
                    label: {
                        color: "#000",
                        formatter: function (params) {
                            return formatNumber(params.value);
                        }
                    }
                },
                itemStyle: {
                    color: '#fe5d70',
                },
                data: res.data[0].value
            }
        ]
    };
    option && myChart.setOption(option);
    $(window).on('resize', function () {
        myChart.resize();
    });
}
